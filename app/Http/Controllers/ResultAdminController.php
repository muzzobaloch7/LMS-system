<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ResultAdmin;
use App\Models\RequstResult;
use Illuminate\Http\Request;
use App\Models\StudentItService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ResultAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $result = ResultAdmin::all();
        return view('pages.resultadmin.index' , compact('result'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('pages.resultadmin.result-form');
    }

    /**
     * Store a newly created resource in storage.
     * 
     */
    
   
    public function store(Request $request)
    {
        //
        $request->validate([
            'department' => 'required',
            'program' => 'required',
            'semester' => 'required',
            'term' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:3072'
        ]);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('resultimages', 'public');
        } else {
            $path = null; // or any default value you want to assign
        }
        ResultAdmin::create(
            [
                'department' => $request->department,
                'semester'=> $request->semester,
                'program' => $request->program,
                'term' => $request->term,
                'photo'=> $path,        
        ]
    );

    return redirect()->route('result-admin.index')->with('status','Successfull form submitted');

    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $result = ResultAdmin::all();
        $userId = Auth::id();
        $studentService = StudentItService::where('user_id', $userId)->first();
        return view('pages.resultadmin.show' , compact('result' , 'studentService'));
        
    }
    public function sendMessage(ResultAdmin $resultAdmin)
    {
        $result = ResultAdmin::all();
        // $userId = Auth::id();
        // $students = StudentItService::where('user_id', $userId)->first();
        return view('pages.resultadmin.message' , compact('result'));
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        $users = User::find($id);
        return view('pages.resultadmin.updateUser' , compact('users'));
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
        
        return redirect()->route('result-admin.edit', ['result_admin' => $id])->with('success', 'User Data Updated Successfully ');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ResultAdmin $resultAdmin)
    {
        //
    }
}
