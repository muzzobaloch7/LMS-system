<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\FacultyRecord;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class FacultyRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function staffView(){
        $staffs = FacultyRecord::all();
        return view('pages.fac-welcome', compact('staffs'));
    }
    public function index()
    {
        $staffs = FacultyRecord::all();
        return view('pages.IDcardadmin.facultyRecord.index', compact('staffs'));
    }
    public function pending()
    {
        $pendingstaffs = FacultyRecord::where('accepted', 0)->get();
            return view('pages.IDcardAdmin.facultyRecord.pending', compact('pendingstaffs'));
    }
    public function accepted()
    {
        $acceptedStaffs = FacultyRecord::where('accepted', 1)->get();
            return view('pages.IDcardAdmin.facultyRecord.accepted', compact('acceptedStaffs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.IDcardadmin.facultyRecord.staff-form');
    }

    /**
     * Store a newly created resource in storage.
     */
   
    public function store(Request $request)
    {
        // $request->validate([
        //     'photo' => 'required|mimes:png,jpg,jpeg|max:3000',
        //     'student_name' => 'required',
        //     'relationship_status' => 'required',
        //     'father_husband' => 'required',
        //     'department' => 'required',
        //     'duration' => 'required',
        //     'student_id_no' => 'required|unique:student_records,student_id_no',
        //     'student_email' => 'required|email|unique:student_records,student_email',
        //     'student_dob' => 'required|date',
        //     'student_bg' => 'required',
        //     'student_contact_no' => 'required',
        //     'student_emergency_contact_no' => 'required',
        //     'student_address' => 'required',
        //     'student_nic_no' => 'required|unique:student_records,student_nic_no',
        //     'user_id' => 'required',
        // ]);

        // Check for duplicate records
        $duplicateFound = FacultyRecord::where('staff_id_no', $request->staff_id_no)
            ->orWhere('staff_email', $request->staff_email)
            ->orWhere('staff_nic_no', $request->staff_nic_no)
            ->exists();

        if ($duplicateFound) {
            return redirect()->route('facultyrecords.create')->with('alert', [
                'type' => 'danger',
                'message' => 'This staff record already exists. Please check your input.'
            ]);
        }
        // dd($request->all());
        // Use a database transaction to store the student record
        DB::transaction(function () use ($request) {
            if ($request->hasFile('photo')) {
                $path = $request->file('photo')->store('staff-photos', 'public');
            } else {
                $path = null; // or any default value you want to assign
            }

            FacultyRecord::create([
                'staff_photo' => $path ?? 'not provided',
                'staff_name' => $request->staff_name,
                'relationship_status' => $request->relationship_status,
                'father_husband' => $request->father_husband,
                'department' => $request->department,
                'duration' => $request->duration,
                'staff_id_no' => $request->staff_id_no,
                'staff_email' => $request->staff_email,
                'staff_dob' => $request->staff_dob,
                'staff_bg' => $request->staff_bg ?? 'unknown',
                'staff_contact_no' => $request->staff_contact_no,
                'staff_emergency_contact_no' => $request->staff_emergency_contact_no ?? 'N/A',
                'staff_address' => $request->staff_address ?? 'not Provided',
                'staff_nic_no' => $request->staff_nic_no ?? 'not Provided',
                'user_id' => $request->user_id,
            ]);
        });

        return redirect()->route('facultyrecords.create')->with('success', 'Successful form submitted');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $staff = FacultyRecord::find($id);
        return view('pages.IDcardAdmin.facultyRecord.single-staff', ['staff' => $staff]);
    }
    public function sendMessage(string $id)
    {
        $staffs = FacultyRecord::where('user_id',$id)->get();
        return view('pages.IDcardAdmin.message', ['staffs' => $staffs]);
    }

    public function accept($id)
    {
        $staffs = FacultyRecord::find($id);    
        if (!$staffs) {
            return redirect()->back()->with('error', 'Staff ID Card service request not found.');
        }
        $staffs->accepted = true;
        $staffs->save();
    
        return redirect()->back()->with('success', 'This Staff form has been accepted.');
    }
    
    public function reject($id)
    {
        $staffs = FacultyRecord::find($id);    
        $staffs->delete();
    
        return redirect()->back()->with('reject', 'This staff form has been rejected.');
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $users = User::find($id);
        return view('pages.IDcardAdmin.updateUser' , compact('users'));
    }

    /**
     * Update the specified resource in storage.
     */
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $staffs = FacultyRecord::find($id);
        $staffs->delete();

        return redirect()->route('facultyrecords.index');
    }
    public function psearch(Request $request)
    {
        $query = $request->input('search');
        $pendingstaffs = FacultyRecord::where('staff_name', 'like', '%' . $query . '%')
                       ->orWhere('staff_id_no', 'like', '%' . $query . '%')
                       ->orWhere('staff_email', 'like', '%' . $query . '%')
                       ->get();

        return view('pages.IDcardAdmin.facultyRecord.pending', compact('pendingstaffs'));
    }
    public function asearch(Request $request)
    {
        $query = $request->input('search');
        $acceptedStaffs = FacultyRecord::where('staff_name', 'like', '%' . $query . '%')
                       ->orWhere('staff_id_no', 'like', '%' . $query . '%')
                       ->orWhere('staff_email', 'like', '%' . $query . '%')
                       ->get();

        return view('pages.IDcardAdmin.facultyRecord.accepted', compact('acceptedStaffs'));
    }
}
