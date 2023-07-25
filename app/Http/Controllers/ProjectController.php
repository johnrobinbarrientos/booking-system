<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Exports\ProjectExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\CSVFileRequest;
use App\Http\Requests\ProjectRequest;
use App\Imports\ProjectImport;
use App\Models\ProjectAddress;
use App\Models\ProjectContact;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $projects = Project::with('addresses')->where([
            ['project_name', '!=', Null],
            [function ($query) use ($request) {
                if (($search = $request->search)) {
                    $query->orWhere('project_name', 'LIKE', '%' . $search . '%')
                        ->get();
                }
            }]
        ])
            ->orderBy('project_name', 'asc')
            ->paginate(10);

        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {

        $validated = $request->validated();
        $project = Project::create($validated);

        //address details 
        // $addresses = $request->input('address');
        // $suburbs = $request->input('suburb');
        // $states = $request->input('state');
        // $postcodes = $request->input('postcode');

        // foreach ($addresses as $key => $value) {
        //     $projectAddress = new ProjectAddress;
        //     $projectAddress->address = $addresses[$key];
        //     $projectAddress->suburb = $suburbs[$key];
        //     $projectAddress->state = $states[$key];
        //     $projectAddress->postcode = $postcodes[$key];

        //     $project->addresses()->save($projectAddress);
        // }

        $allAddress = Json_decode($request->allAddress);
        
        if(isset($allAddress)){
            foreach ($allAddress as $key => $address) {
                $projectAddress = new ProjectAddress();
                $projectAddress->project_id = $project->id;
                $projectAddress->address = $address->address;
                $projectAddress->suburb = $address->suburb;
                $projectAddress->state = $address->state;
                $projectAddress->postcode = $address->postcode;
                $projectAddress->save();
            }
        }

        $allContact = Json_decode($request->allContact);
        
        if(isset($allContact)){
            foreach ($allContact as $key => $contact) {
                $projectContact = new ProjectContact();
                $projectContact->project_id = $project->id;
                $projectContact->contact_name = $contact->contact_name;
                $projectContact->contact_email = $contact->contact_email;
                $projectContact->contact_phone = $contact->contact_phone;
                $projectContact->is_primary = $contact->is_primary;
                $projectContact->status = $contact->status;
                $projectContact->save();
            }
        }

        //contact details 
        // $contactNames = $request->input('contact_name');
        // $contactEmails = $request->input('contact_email');
        // $contactPhones = $request->input('contact_phone');
        // $isPrimaryList = $request->input('is_primary');
        // $status = $request->input('status');

        // foreach ($contactNames as $key => $value) {
        //     $contact = new ProjectContact;
        //     $contact->contact_name = $contactNames[$key];
        //     $contact->contact_email = $contactEmails[$key];
        //     $contact->contact_phone = $contactPhones[$key];
        //     $contact->is_primary = isset($isPrimaryList[$key]) ? $isPrimaryList[$key] : 0;
        //     $contact->status = $status[$key];

        //     $project->contacts()->save($contact);
        // }

    
        return redirect()->route('projects.index')->with('success', 'Project And their Contacts Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::with('addresses')->with('contacts')->find($id);
        return view('projects.edit', ['project' => $project]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectRequest $request, Project $project)
    {
        $validated = $request->validated();

        //address details 
        // $addressIds = $request->input('address_id');
        // $addresses = $request->input('address');
        // $suburbs = $request->input('suburb');
        // $states = $request->input('state');
        // $postcodes = $request->input('postcode');

        // if (!empty($addresses)) {
        //     foreach ($addresses as $key => $value) {
        //         $projectAddress = ProjectAddress::find($addressIds[$key]);

        //         if (empty($projectAddress)) {
        //             $projectAddress = new ProjectAddress();
        //         }
        //         $projectAddress->address = !empty($addresses[$key]) ? $addresses[$key] : null;
        //         $projectAddress->suburb = !empty($suburbs[$key]) ? $suburbs[$key] : null;
        //         $projectAddress->state = !empty($states[$key]) ? $states[$key] : null;
        //         $projectAddress->postcode = !empty($postcodes[$key]) ? $postcodes[$key] : null;

        //         $project->addresses()->save($projectAddress);
        //     }
        // }

        //contact details 
        // $contactIds = $request->input('contact_id');
        // $contactNames = $request->input('contact_name');
        // $contactEmails = $request->input('contact_email');
        // $contactPhones = $request->input('contact_phone');
        // $isPrimary = $request->get('is_primary');
        // $status = $request->input('status');

        // foreach ($contactNames as $key => $value) {
        //     $contact = ProjectContact::find($contactIds[$key]);
        //     if(empty($contact)){
        //         $contact = new ProjectContact();
        //     }
        //     $contact->contact_name = !empty($contactNames[$key])?$contactNames[$key]:'';
        //     $contact->contact_email = !empty($contactEmails[$key])?$contactEmails[$key]:'';
        //     $contact->contact_phone = !empty($contactPhones[$key])?$contactPhones[$key]:'';
        //     $contact->is_primary = !empty($isPrimary[$key+1])?$isPrimary[$key+1]:0;
        //     $contact->status = $status[$key];
        //     $project->contacts()->save($contact);
        // }

        $project->update($validated);

        //Address
        $allAddress = Json_decode($request->allAddress);

        $address_ids = [];

        if(isset($allAddress)){
            foreach ($allAddress as $key => $address) {
                if (is_null($address->id)) {
                    continue;
                }
                $address_ids[] = $address->id;
            }
        }

        ProjectAddress::where('project_id','=',$project->id)->whereNotIn('id',$address_ids)->delete();

        foreach ($allAddress as $key => $address) {

            $projectAddress = ProjectAddress::where('project_id','=',$project->id)->where('id','=',$address->id)->first();
            $projectAddress = (!$projectAddress) ? new ProjectAddress : $projectAddress;
            $projectAddress->project_id = $project->id;
            $projectAddress->address = $address->address;
            $projectAddress->suburb = $address->suburb;
            $projectAddress->state = $address->state;
            $projectAddress->postcode = $address->postcode;
            $projectAddress->save();
        }


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

        ProjectContact::where('project_id','=',$project->id)->whereNotIn('id',$contact_ids)->delete();

        foreach ($allContact as $key => $contact) {

            $projectContact = ProjectContact::where('project_id','=',$project->id)->where('id','=',$contact->id)->first();
            $projectContact = (!$projectContact) ? new ProjectContact : $projectContact;
            $projectContact->project_id = $project->id;
            $projectContact->contact_name = $contact->contact_name;
            $projectContact->contact_email = $contact->contact_email;
            $projectContact->contact_phone = $contact->contact_phone;
            $projectContact->is_primary = $contact->is_primary;
            $projectContact->status = $contact->status;
            $projectContact->save();
        }



        return redirect()->route('projects.index')->with('success', 'Project Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();
        //Project::find($id)->delete();
        return redirect()->route('projects.index')->with('success', 'Project Deleted Suceessfully');
    }

    public function export(Request $request)
    {
        if ($request->download_type == 'all') {
            return Excel::download(new ProjectExport($request->download_type), 'projects.xlsx');
        }
        return Excel::download(new ProjectExport($request->download_type), 'projects.csv');
    }

    public function import(CSVFileRequest $request)
    {
        if ($request->file('file')) {
            $fileUpload = Excel::import(new ProjectImport, $request->file('file'));
        }

        if ($fileUpload) {
            return redirect()->route('projects.index')->with('success', 'Project Imported Suceessfully');
        } else {
            return back()->with('error', 'Alert! file not uploaded');
        }
    }

    /*public function getProjectDetails($id = 0)
    {
        $data = Project::with('addresses')->find($id);
        return response()->json($data);
    }*/
}
