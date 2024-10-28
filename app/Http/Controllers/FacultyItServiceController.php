<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FacultyItService;
use App\Models\FacultyItCredential;
use App\Models\Indox;

class FacultyItServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $facultys = FacultyItService::all();
        // return $facultys;
        return view('pages.ITservicesAdmin.FacultyItServicesRecord.index', compact('facultys'));
    }
    public function pending()
    {
        //
        $facultys = FacultyItService::where('accepted', false)->get();
        // return $facultys;
        return view('pages.ITservicesAdmin.FacultyItServicesRecord.pending', compact('facultys'));
    }
    public function accepted()
    {
        //
        $facultys = FacultyItService::where('accepted', true)->get();
        // return $facultys;
        return view('pages.ITservicesAdmin.FacultyItServicesRecord.accepted', compact('facultys'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

        return view('pages.ITservicesadmin.FacultyItServicesRecord.faculty-it-services-form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'faculty_name' => 'required|string',
            'faculty_designation' => 'required|string',
            'department' => 'required|string',
            'faculty_status' => 'required|string',
            'faculty_id_no' => 'required|unique:faculty_it_services,faculty_id_no',
            'gender' => 'required|string',
            'faculty_email' => 'required|email|unique:faculty_it_services,faculty_email',
            'faculty_contact_no' => 'required|numeric',
            'hostel_name' => 'string',
            'floor_no' => 'numeric',
            'room_no' => 'numeric',
            'user_id' => 'required',
        ]);

        // Check for duplicate records
        $duplicateFound = FacultyItService::where('user_id', $request->user_id)
            ->orWhere('faculty_email', $request->faculty_email)
            ->exists();

        if ($duplicateFound) {
            return redirect()->back()->with('alert', [
                'type' => 'danger',
                'message' => 'This faculty IT service record already exists. Please check your input.'
            ]);
        }

        FacultyItService::create([
            'faculty_name' => $request->faculty_name,
            'faculty_designation' => $request->faculty_designation,
            'department' => $request->department,
            'faculty_status' => $request->faculty_status,
            'faculty_id_no' => $request->faculty_id_no,
            'gender' => $request->gender,
            'faculty_email' => $request->faculty_email,
            'faculty_contact_no' => $request->faculty_contact_no,
            'hostel_name' => $request->hostel_name,
            'floor_no' => $request->floor_no,
            'room_no' => $request->room_no,
            'user_id' => $request->user_id,
            'it_services' => implode(',', [$request->services_1, $request->services_2, $request->services_3, $request->services_4]),
        ]);

        return redirect()->route('faculty-it-services.create')->with('status', 'Successful form submitted');
    }

    /**
     * Display the specified resource.
     */
    public function show(FacultyItService $facultyItService)
    {
        //
        $facultys = FacultyItService::find($facultyItService->id);
        // return $students;
          return view('pages.ITservicesAdmin.FacultyItServicesRecord.single-faculty',['facultys' => $facultys]);
    }

    public function sendMessage(string $id)
    {
        $facultys = FacultyItService::where('user_id',$id)->get();
        return view('pages.ITservicesAdmin.FacultyItServicesRecord.message', ['facultys' => $facultys]);
    }

    public function storeCredentials(Request $request, $id)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
            'micro_username' => 'required|string',
            'micro_password' => 'required|string',
            'turnit_username' => 'required|string',
            'turnit_password' => 'required|string',
            'user_id' => 'required|string'
        ]);

        $faculty = FacultyItService::find($id);

        if (!$faculty) {
            return redirect()->back()->with('error', 'Faculty IT service request not found.');
        }

        $duplicateFound = FacultyItCredential::where('username', $request->username)->exists();

        if ($duplicateFound) {
            return redirect()->back()->with('alert', [
                'type' => 'danger',
                'message' => 'This faculty IT service record already exists. Please check your input.'
            ]);
        }

        // Insert student record with credentials
        $credentials = new FacultyItCredential();
        $credentials->username = $request->username;
        $credentials->password = $request->password;
        $credentials->micro_username = $request->micro_username;
        $credentials->micro_password = $request->micro_password;
        $credentials->turnit_username = $request->turnit_username;
        $credentials->turnit_password = $request->turnit_password;
        $credentials->user_id = $request->user_id;
        $credentials->save();

        $faculty->accepted = true;
        $faculty->save();

        return redirect()->route('faculty-it-services.show',['faculty' => $facultyItService->id])->with('success', 'This Faculty form has been accepted and credentials have been sent.');
    }

    public function viewCredentials()
    {
        // Fetch all students with their credentials
        $credentials = FacultyItCredential::all();

        // Return the view with the students and their credentials
        return view('pages.fac-credential', [
            'credentials' => $credentials,
        ]);
    }


    public function accept(Request $request)
    {
        $facultys = FacultyItService::find($request->id);
    
        if (!$facultys) {
            return redirect()->back()->with('error', 'Staff IT service request not found.');
        }
        $facultys->accepted = true;
        $facultys->save();
    
        // Return a response with an alert
        return redirect()->back()->with('success', 'This Staff form has been accepted.');
    }
    
    public function reject(Request $request)
    {
        Indox::create([
            'reciever_id' => $request->reciever_id,
            'sender_name' => $request->sender_name,
            'message' => $request->message,
        ]);
        $facultys = FacultyItService::find($request->id);
    
        // Delete the record
        $facultys->delete();
    
        return redirect()->route('faculty-it-services.pending')->with('reject', 'This Staff form has been rejected.');
    
        
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FacultyItService $facultyItService)
    {
        //

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FacultyItService $facultyItService)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FacultyItService $facultyItService)
    {
        //
        $facultys = FacultyItService::find($facultyItService->id);

        $facultys->delete();

        return redirect()->route('faculty-it-services.index')->with('success', 'Record delete successful');


    }

    public function psearch(Request $request)
    {
        $query = $request->input('search');
        $facultys = FacultyItService::where('faculty_name', 'like', '%' . $query . '%')
                       ->orWhere('faculty_id_no', 'like', '%' . $query . '%')
                       ->orWhere('department', 'like', '%' . $query . '%')
                       ->orWhere('faculty_email', 'like', '%' . $query . '%')
                       ->get();

        return view('pages.ITservicesAdmin.FacultyItServicesRecord.pending', compact('facultys'));
    }
    public function asearch(Request $request)
    {
        $query = $request->input('search');
        $facultys = FacultyItService::where('faculty_name', 'like', '%' . $query . '%')
                       ->orWhere('faculty_id_no', 'like', '%' . $query . '%')
                       ->orWhere('department', 'like', '%' . $query . '%')
                       ->orWhere('faculty_email', 'like', '%' . $query . '%')
                       ->get();

        return view('pages.ITservicesAdmin.FacultyItServicesRecord.accepted', compact('facultys'));
    }
}
