<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\StudentRecord;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function studentView(){
        $idStudents = StudentRecord::all();
        return view('pages.stu-welcome', compact('idStudents'));
    }
    public function index()
    {
        $students = DB::table('student_records')->where('accepted', 0)->paginate(10);
        return view('pages.IDcardadmin.studentRecord.index', compact('students'));
    }
    public function pending()
    {
        $pendingstudents = DB::table('student_records')->where('accepted', 0)->paginate(10);
        return view('pages.IDcardadmin.studentRecord.pending', compact('pendingstudents'));
    }
    public function accepted()
    {
        $acceptedStudents = DB::table('student_records')->where('accepted', 1)->paginate(10);
        return view('pages.IDcardAdmin.studentRecord.accepted', compact('acceptedStudents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.IDcardadmin.studentRecord.student-form');
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
        $duplicateFound = StudentRecord::where('student_id_no', $request->student_id_no)
            ->orWhere('student_email', $request->student_email)
            ->orWhere('student_nic_no', $request->student_nic_no)
            ->exists();

        if ($duplicateFound) {
            return redirect()->route('studentrecords.create')->with('alert', [
                'type' => 'danger',
                'message' => 'This student record already exists. Please check your input.'
            ]);
        }

        // Use a database transaction to store the student record
        DB::transaction(function () use ($request) {
            if ($request->hasFile('photo')) {
                $path = $request->file('photo')->store('images', 'public');
            } else {
                $path = null; // or any default value you want to assign
            }

            StudentRecord::create([
                'student_photo' => $path ?? 'not provided',
                'student_name' => $request->student_name,
                'relationship_status' => $request->relationship_status,
                'father_husband' => $request->father_husband,
                'department' => $request->department,
                'duration' => $request->duration,
                'student_id_no' => $request->student_id_no,
                'student_email' => $request->student_email,
                'student_dob' => $request->student_dob,
                'student_bg' => $request->student_bg ?? 'unknown',
                'student_contact_no' => $request->student_contact_no,
                'student_emergency_contact_no' => $request->student_emergency_contact_no ?? 'N/A',
                'student_address' => $request->student_address ?? 'not Provided',
                'student_nic_no' => $request->student_nic_no ?? 'not Provided',
                'user_id' => $request->user_id,
            ]);
        });

        return redirect()->route('studentrecords.create')->with('success', 'Successful form submitted');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $students = StudentRecord::find($id);
        return view('pages.IDcardAdmin.studentRecord.single-student', ['students' => $students]);
    }
    public function sendMessage(string $id)
    {
        $students = StudentRecord::where('user_id',$id)->get();
        return view('pages.IDcardAdmin.message', ['students' => $students]);
    }

    public function accept($id)
    {
        $students = StudentRecord::find($id);    
        if (!$students) {
            return redirect()->back()->with('error', 'Student ID Card service request not found.');
        }
        $students->accepted = true;
        $students->save();
    
        return redirect()->back()->with('success', 'This student form has been accepted.');
    }
    
    public function reject($id)
    {
        $students = StudentRecord::find($id);    
        $students->delete();
    
        return redirect()->back()->with('reject', 'This student form has been rejected.');
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
    public function update(Request $request, String $id)
    {
        //
        $users = User::find($id);
        $users->name=$request->name;
        $users->password=Hash::make($request->password);
        $users->save();
        
        return redirect()->route('idcard-admin-panel.editUser', ['user' => $id])->with('success', 'User Data Updated Successfully ');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $students = StudentRecord::find($id);
        $students->delete();

        return redirect()->route('studentrecords.index');
    }
    public function psearch(Request $request)
    {
        $query = $request->input('search');
        $pendingstudents = StudentRecord::where('student_name', 'like', '%' . $query . '%')
                       ->orWhere('student_id_no', 'like', '%' . $query . '%')
                       ->orWhere('student_email', 'like', '%' . $query . '%')
                       ->get();

        return view('pages.IDcardAdmin.studentRecord.pending', compact('pendingstudents'));
    }
    public function asearch(Request $request)
    {
        $query = $request->input('search');
        $acceptedStudents = StudentRecord::where('student_name', 'like', '%' . $query . '%')
                       ->orWhere('student_id_no', 'like', '%' . $query . '%')
                       ->orWhere('student_email', 'like', '%' . $query . '%')
                       ->get();

        return view('pages.IDcardAdmin.studentRecord.accepted', compact('acceptedStudents'));
    }
}
