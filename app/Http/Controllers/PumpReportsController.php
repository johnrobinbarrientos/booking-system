<?php

namespace App\Http\Controllers;

use App\Exports\Pumps\PumpFinancialHistoryExport;
use App\Exports\Pumps\PumpDocketHistoryExport;
use App\Models\Pump;
use App\Models\Booking;
use App\Models\Client;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

use App\Models\PdfReport;
use App\Models\WordReport;
use App\Models\SumCubicMetre;
use Barryvdh\DomPDF\Facade\Pdf;

use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

use Illuminate\Support\Facades\File;

class PumpReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getPumpFinancialHistory(Request $request)
    {
        $pastSevenYears = now()->subYears(1)->format('Y-m-d');
        if ($request->get('pump_history_filter') == 'past_7_years') {
            $pastSevenYears = now()->subYears(7)->format('Y-m-d');
        }
        $bookings = Booking::with(['pump', 'PumpCategory', 'PumpPrice'])
        ->where('job_date', '>=', $pastSevenYears)
        ->selectRaw('pump_id, pump_category_id, pump_price_id,
        sum(grand_total) as grand_total, sum(ex_gst) as total_amount_without_gst, count(DISTINCT project_id) as projects')
        ->groupBy(['pump_id', 'pump_category_id', 'pump_price_id'])
        ->paginate(10);

        return view('reports.pumps.financial', compact('bookings', 'request'));
    }

    public function export()
    {
        return Excel::download(new PumpFinancialHistoryExport, 'pump_financial_history.csv');
    }

    public function exportPumpHistory($client_id, $docket_no, $job_date, $pump_id)
    {
        return Excel::download(new PumpDocketHistoryExport($client_id, $docket_no, $job_date, $pump_id), 'pump_history.csv');
    }

    public function getpumpHistory(Request $request)
    {
        $job_date = $request->job_date;
        $docket_no = $request->docket_no;
        $client_id = $request->client_id;
        $pump_id = $request->pump_id;


        $bookings = Booking::leftJoin('pumps', 'pumps.id', '=', 'bookings.pump_id')
        ->leftJoin('concrete_types', 'concrete_types.id', '=', 'bookings.concrete_type_id')
        ->with('project.addresses')
        ->whereNotNull('pump_id')
        ->selectRaw('client_id, pump_id, job_date, docket_no, concrete_types.concrete_type as concrete_type, metres_pumped, pump_name, project_id, project_none_contact_address, grand_total');
  
        
        if (!empty($job_date)) {
            $dateRange = explode( ' - ', $job_date);
            $from = date_format(new DateTime($dateRange[0]), 'Y-m-d');
            $to = date_format(new DateTime($dateRange[1]), 'Y-m-d');
            
            $bookings = $bookings->whereBetween('job_date', [$from, $to]);
        }

        if (!empty($docket_no)) {
            $bookings = $bookings->where('docket_no','LIKE','%'.$docket_no.'%');
        }

        if (!empty($client_id)) {
            $bookings = $bookings->where('client_id', '=', $client_id);
        }

        if (!empty($pump_id)) {
            $bookings = $bookings->where('pump_id', '=', $pump_id);
        }

        $bookings = $bookings->orderBy('job_date', 'DESC')->paginate(10);
        

        $clients = Client::select('id', 'name')->orderBy('name', 'ASC')->get();

        $pumps = Pump::select('id', 'pump_name')->orderBy('pump_name', 'ASC')->get();

        return view('reports.pumps.history', [
        'bookings' => $bookings, 
        'job_date' => $job_date, 
        'docket_no' => $docket_no,
        'client_id' => $client_id,
        'pump_id' => $pump_id,
        'pumps' => $pumps,
        'clients' => $clients]);
    }

    public function getpumpHealth()
    {
        $pumps = Pump::select('id', 'pump_name','plant_number','registration','model')->get();
        $pdfs = PdfReport::latest()->paginate(10);
        $docxs = WordReport::latest()->paginate(10);
        return view('reports.pumps.health', compact('pdfs','pumps','docxs'));
    }

     // Generate PDF
     public function createPDF(Request $request) {
        $pump = Pump::find($request->pump_id);
        $totalMetresPumped = SumCubicMetre::where('pump_id', $request->pump_id)->sum('total_metres_pumped');
        if($totalMetresPumped != $request->total_metres_pumped){
            $totalMetresPumped = $request->total_metres_pumped;
        }
        $filename = 'pdf_'.time().'.pdf';
        if($request->file_name){
            $filename = $request->file_name.'.pdf';
        }
        $logo_path = public_path('rowland_logo-removebg-preview-300x105.png');
        $sign_path = public_path('signatuire-joe.jpg');
        
       $pdf = PDF::loadView('pages.report', ['pump' => $pump, 'total_metres_pumped' => $totalMetresPumped,'logo_path'=>$logo_path,'sign_path'=> $sign_path], ['paper' => 'a4', 'orientation' => 'landscape']);

        // $total_metres_pumped = $totalMetresPumped;

        // return view('pages.report',compact('pump','total_metres_pumped','logo_path','sign_path'));
        //save pdf in server
        $pdf_path = public_path('reportPdf/'.$filename);
        $pdf->save($pdf_path);
        //create record in pdf_reports table
        PdfReport::create([
            'name' => $filename,
            'path' => 'reportPdf/'.$filename,
            'user_id' => auth()->user()->id,
        ]);
        // download PDF file with download method
        return $pdf->download($filename);
    }

    public function createWord(Request $request) {

        $pump = Pump::find($request->pump_id_docx);
        $totalMetresPumped = SumCubicMetre::where('pump_id', $request->pump_id_docx)->sum('total_metres_pumped');
        if($totalMetresPumped != $request->total_metres_pumped_docx){
            $totalMetresPumped = $request->total_metres_pumped_docx;
        }

        $filename = 'doc_'.time().'.docx';

        if($request->file_name_docx){
            $filename = $request->file_name_docx.'.docx';
        }
        
        $my_template = new \PhpOffice\PhpWord\TemplateProcessor(public_path('template_rowland.docx'));

        $my_template->setValue('date_today', Carbon::now()->format('jS F Y'));
        $my_template->setValue('make', $pump->make ?? '');
        $my_template->setValue('plant_no', $pump->plant_number ?? '');
        $my_template->setValue('registration', $pump->registration ?? '');
        $my_template->setValue('total_metres', $totalMetresPumped ?? '');

        $file_path = storage_path('app/public/reportWord/');
        $file_path_with_filename = storage_path('app/public/reportWord/'.$filename);

        if (! File::exists($file_path)) {
            File::makeDirectory($file_path);
        }

        $my_template->saveAs($file_path_with_filename);

        WordReport::create([
            'name' => $filename,
            'path' => 'app/public/reportWord/'.$filename,
            'user_id' => auth()->user()->id,
        ]);

        Response::download($file_path_with_filename);

        return response()->download($file_path_with_filename);
    }
    

    public function download($id) {
        $pdf = PdfReport::findOrFail($id);
        return response()->download($pdf->path);
    }

    public function deletePdf($id) {
        $pdf = PdfReport::findOrFail($id);
        $pdf->delete();
        unlink(public_path($pdf->path));
        return redirect()->route('pumpHealth')->with('success', 'Deleted Successfully');
    }

    public function downloadDocx($id) {
        $docx = WordReport::findOrFail($id);
        return response()->download(storage_path($docx->path));
    }

    public function deleteDocx($id) {
        $docx = WordReport::findOrFail($id);
        $docx->delete();
        unlink(storage_path($docx->path));
        return redirect()->route('pumpHealth')->with('success', 'Deleted Successfully');
    }

}
