<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\StudentItService;
use App\Models\StuPersonalRecord;
use App\Models\Indox;
use Illuminate\Support\Facades\DB;
use App\Models\StudentItCredentials;
use Illuminate\Support\Facades\Hash;

class StudentItServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function studentView(){
        $itStudents = StudentItService::all();
        return view('pages.stu-welcome', compact('itStudents'));
    }
    public function index()
    {
        //
        $students = StudentItService::all();

        // dd($students);
        // dd($students);
        
        return view('pages.ITservicesAdmin.studentItServicesRecord.index', compact('students'));
    }
    public function pending()
    {
        //
        $students = DB::table('student_it_services')->where('accepted', 0)->paginate(10);

        // dd($students);
        // dd($students);
        
        return view('pages.ITservicesAdmin.studentItServicesRecord.pending', compact('students'));
    }
    public function accepted()
    {
        //
        $students = DB::table('student_it_services')->where('accepted', 1)->paginate(10);

        // dd($students);
        // dd($students);
        
        return view('pages.ITservicesAdmin.studentItServicesRecord.accepte', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('pages.ITservicesAdmin.studentItServicesRecord.stud-it-services-form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // return dd($request->all());

        // $request->validate([
        //     'student_name' => 'required|string',
        //     'student_id_no' => 'required',
        //     'department' => 'required|string',
        //     'degree_program' => 'required|string',
        //     'current_semester' => 'required|numeric',
        //     'duration' => 'required|string',
        //     'gender' => 'required',
        //     'student_email' => 'required|email',
        //     'student_contact_no' => 'required|numeric',
        //     'hostel_name' => 'string',
        //     'floor_no' => 'numeric',
        //     'room_no' => 'numeric',
        //     'user_id'=>'required',
        //     // 'services_1' => 'required',
        //     // 'services_2' => 'required',
        // ]);

        // Check for duplicate records
        $duplicateFound = StudentItService::where('user_id', $request->user_id)
            ->orWhere('student_email', $request->student_email)
            ->exists();

        if ($duplicateFound) {
            return redirect()->back()->with('alert', [
                'type' => 'danger',
                'message' => 'This student IT service record already exists. Please check your input.'
            ]);
        }

        StudentItService::create([
            'registration_no'=> $request->registration_no,
            'student_name' => $request->student_name,
            'student_id_no' => $request->student_id_no,
            'department' => $request->department,
            'degree_program' => $request->degree_program,
            'current_semester' => $request->current_semester ?? 0,
            'duration' => $request->duration,
            'gender' => $request->gender,
            'student_email' => $request->student_email,
            'student_contact_no' => $request->student_contact_no,
            'hostel_name' => $request->hostel_name,
            'floor_no' => $request->floor_no,
            'room_no' => $request->room_no,
            'user_id' => $request->user_id,
            // 'it_services' => implode(',',[$request->services_1,$request->services_2,]) ?? 'Not Provided',
        ]);

        session()->flash('status', 'Successful form submitted');

        return redirect()->route('student-it-services.create')->with('status','Successful form submitted');
    }

    /**
     * Display the specified resource.
     */
    public function show(StudentItService $studentItService)
    {
        // Fetch the student record
    $students = StudentItService::find($studentItService);
    return view('pages.ITservicesAdmin.studentItServicesRecord.single-stud', [
        'students' => $students,
    ]);
    }

    public function sendMessage(string $id)
    {
        $students = StudentItService::where('user_id',$id)->get();
        return view('pages.ITservicesAdmin.studentItServicesRecord.message', ['students' => $students]);
    }

    public function storeCredentials(Request $request, $id)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
            'user_id' => 'required|string'
        ]);

        $student = StudentItService::find($id);

        if (!$student) {
            return redirect()->back()->with('error', 'Student IT service request not found.');
        }

        $duplicateFound = StudentItCredentials::where('username', $request->username)->exists();

        if ($duplicateFound) {
            return redirect()->back()->with('alert', [
                'type' => 'danger',
                'message' => 'This student IT service record already exists. Please check your input.'
            ]);
        }

        // Insert student record with credentials
        $credentials = new StudentItCredentials();
        $credentials->username = $request->username;
        $credentials->password = $request->password;
        $credentials->user_id = $request->user_id;
        $credentials->save();

        $student->accepted = true;
        $student->save();

        return redirect()->route('student-it-services.show' , ['student' => $student->id])->with('success', 'This student form has been accepted and credentials have been saved.');
    }

    public function viewCredentials()
    {
        // Fetch all students with their credentials
        $credentials = StudentItCredentials::all();

        // Return the view with the students and their credentials
        return view('pages.credential', [
            'credentials' => $credentials,
        ]);
    }
    
    public function accept($id)
    {
        $student = StudentItService::find($id);

        if (!$student) {
            return redirect()->back()->with('error', 'Student IT service request not found.');
        }
        $student->accepted = true;
        $student->save();

        // Return a response with an alert
        return redirect()->back()->with('success', 'This student form has been accepted.');
    }

    public function reject(Request $request)
    {
        // return dd($request->reciever_name);
        Indox::create([
            'reciever_id' => $request->reciever_id,
            'sender_id' => $request->sender_id,
            'sender_name' => $request->sender_name,
            'reciever_name' => $request->reciever_name,
            'message' => $request->message,
        ]);
        $student = StudentItService::find($request->id);
        // Delete the record
        $student->delete();

        return redirect()->route('student-it-services.pending',)->with('reject', 'This student form has been rejected.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        //
        $users = User::find($id);
        return view('pages.ITservicesAdmin.updateUser' , compact('users'));

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
        
        return redirect()->route('itservice-admin-panel.editUser', ['user' => $id])->with('success', 'User Data Updated Successfully ');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StudentItService $studentItService)
    {
        //
        $students = StudentItService::find($studentItService->id);
        $students->delete();
        return redirect()->route('student-it-services.index');
    }


    public function psearch(Request $request)
    {
        $query = $request->input('search');
        $students = StudentItService::where('student_name', 'like', '%' . $query . '%')
                       ->orWhere('student_id_no', 'like', '%' . $query . '%')
                       ->orWhere('registration_no', 'like', '%' . $query . '%')
                       ->orWhere('student_email', 'like', '%' . $query . '%')
                       ->get();

        return view('pages.ITservicesAdmin.studentItServicesRecord.pending', compact('students'));
    }
    public function asearch(Request $request)
    {
        $query = $request->input('search');
        $students = StudentItService::where('student_name', 'like', '%' . $query . '%')
                       ->orWhere('student_id_no', 'like', '%' . $query . '%')
                       ->orWhere('registration_no', 'like', '%' . $query . '%')
                       ->orWhere('student_email', 'like', '%' . $query . '%')
                       ->get();

        return view('pages.ITservicesAdmin.studentItServicesRecord.accepted', compact('students'));
    }
}
