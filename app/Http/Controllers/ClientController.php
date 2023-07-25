<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Client;
use App\Models\ClientProject;
use Illuminate\Http\Request;
use App\Exports\ClientExport;
use App\Http\Requests\ClientRequest;
use App\Http\Requests\CSVFileRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Imports\ClientImport;
use App\Models\Contact;
use Maatwebsite\Excel\Facades\Excel;

use function PHPUnit\Framework\returnSelf;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $clients = Client::where([
            ['name', '!=', Null],
            [function ($query) use ($request) {
                if (($search = $request->search)) {
                    $query->orWhere('name', 'LIKE', '%' . $search . '%')
                        ->orWhere('abn', 'LIKE', '%' . $search . '%')
                        ->get();
                }
            }]
        ])
            ->orderBy('name', 'asc')
            ->paginate(10);

        //$clients = Client::orderBy('id', 'desc')->paginate(10);
        return view('clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $projects = Project::select('id', 'project_name')->orderBy('project_name', 'ASC')->get();

        return view('clients.create', compact('projects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientRequest $request)
    {
        $validated = $request->validated();
        $client = Client::create($validated);
        $client->project()->attach($request->input('project_id', []));

        //contact details 
        // $contactNames = $request->input('contact_name');
        // $contactEmails = $request->input('contact_email');
        // $contactPhones = $request->input('contact_phone');
        // $isPrimaryList = $request->input('is_primary');
        // $status = $request->input('status');

        // foreach ($contactNames as $key => $value) {
        //     $contact = new Contact;
        //     $contact->contact_name = $contactNames[$key];
        //     $contact->contact_email = $contactEmails[$key];
        //     $contact->contact_phone = $contactPhones[$key];
        //     $contact->is_primary = isset($isPrimaryList[$key]) ? $isPrimaryList[$key] : 0;
        //     $contact->status = $status[$key];

        //     $client->contacts()->save($contact);
        // }

        $allContact = Json_decode($request->allContact);
        
        if(isset($allContact)){
            foreach ($allContact as $key => $contact) {
                $clientContact = new Contact();
                $clientContact->client_id = $client->id;
                $clientContact->contact_name = $contact->contact_name;
                $clientContact->contact_email = $contact->contact_email;
                $clientContact->contact_phone = $contact->contact_phone;
                $clientContact->is_primary = $contact->is_primary;
                $clientContact->status = $contact->status;
                $clientContact->save();
            }
        }


        return redirect()->route('clients.index')->with('success', 'Client Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        return view('clients.view', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = Client::with('contacts')->find($id);

        $projects = Project::select('id', 'project_name')->orderBy('project_name', 'ASC')->get();
        return view('clients.edit', [
            'projects' => $projects, 'client' => $client
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClientRequest $request, Client $client)
    {
        $validated = $request->validated();

        //contact details 
        // $contactIds = $request->input('contact_id');
        // $contactNames = $request->input('contact_name');
        // $contactEmails = $request->input('contact_email');
        // $contactPhones = $request->input('contact_phone');
        // $isPrimary = $request->get('is_primary');
        // $status = $request->input('status');

        // foreach ($contactNames as $key => $value) {
        //     $contact = Contact::find($contactIds[$key]);
        //     if(empty($contact)){
        //         $contact = new Contact();
        //     }
        //     $contact->contact_name = !empty($contactNames[$key])?$contactNames[$key]:'';
        //     $contact->contact_email = !empty($contactEmails[$key])?$contactEmails[$key]:'';
        //     $contact->contact_phone = !empty($contactPhones[$key])?$contactPhones[$key]:'';
        //     $contact->is_primary = !empty($isPrimary[$key+1])?$isPrimary[$key+1]:0;
        //     $contact->status = $status[$key];
        //     $client->contacts()->save($contact);
        // }

        $client->update($validated);
        $client->project()->sync($request->input('project_id', []));


        //Contact
        $allContact = Json_decode($request->allContact);

        $contact_ids = [];

        if(isset($allContact)){
            foreach ($allContact as $key => $contact) {
                if (is_null($contact->id)) {
                    continue;
                }
                $contact_ids[] = $contact->id;
            }
        }

        Contact::where('client_id','=',$client->id)->whereNotIn('id',$contact_ids)->delete();

        foreach ($allContact as $key => $contact) {

            $clientContact = Contact::where('client_id','=',$client->id)->where('id','=',$contact->id)->first();
            $clientContact = (!$clientContact) ? new Contact : $clientContact;
            $clientContact->client_id = $client->id;
            $clientContact->contact_name = $contact->contact_name;
            $clientContact->contact_email = $contact->contact_email;
            $clientContact->contact_phone = $contact->contact_phone;
            $clientContact->is_primary = $contact->is_primary;
            $clientContact->status = $contact->status;
            $clientContact->save();
        }

        return redirect()->route('clients.index')->with('success', 'Client Updated Successfully');
    }

    public function checkBadCredit(Client $client)
{
    $badCredit = $client->bad_credit;
    return response($badCredit ? '1' : '0')->header('Content-Type', 'text/plain');
}


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('clients.index')->with('success', 'Client Deleted Suceessfully');
    }

    public function export(Request $request)
    {
        if ($request->download_type == 'all') {
            return Excel::download(new ClientExport($request->download_type), 'clients.xlsx');
        }
        return Excel::download(new ClientExport($request->download_type), 'clients.csv');
    }

    public function import(CSVFileRequest $request)
    {
        if ($request->file('file')) {
            $fileUpload = Excel::import(new ClientImport, $request->file('file'));
        }

        if ($fileUpload) {
            return redirect()->route('clients.index')->with('success', 'Client Data Imported Suceessfully');
        } else {
            return back()->with('error', 'Alert! file not uploaded');
        }
    }

    public function getClientProjects($id = 0)
    {
        $projects = ClientProject::leftJoin('projects', 'projects.id', '=', 'client_project.project_id')
        ->where('client_id', $id)
        ->selectRaw('project_id as id, project_name, project_notes, project_order_number')
        ->get();

        $x = 0;

        if($projects){
            foreach ($projects as $key => $project) {
                $proj = Project::with('addresses')->with('contacts')->where('id', $project->id)->first();
                $projects[$x]['addresses'] = $proj->addresses;
                $projects[$x]['contacts'] = $proj->contacts;
                $x++;
            }
        }
        
        return response()->json(['success' => 1, 'data' => $projects], 200);
    }
}
