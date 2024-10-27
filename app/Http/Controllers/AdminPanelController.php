<?php

namespace App\Http\Controllers;

use App\Models\AdminPanel;
use Illuminate\Support\Facades\Auth; 
use App\Models\FacultyItService;
use App\Models\StudentItService;
use App\Models\StudentRecord;
use App\Models\FacultyRecord;
use App\Models\User;
use App\Models\ResultAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminPanelController extends Controller
{
   public function index(){
   
        $facultys = FacultyItService::all();
        $students = StudentItService::all();
        $student = StudentRecord::all();
        $staff = FacultyRecord::all();
        return view('pages.adminPanel.index', compact('facultys','students','student','staff'));
    
   }
   // ID Card Admin function start
   public function idCardAdmin(){
    $idAdmins = User::where('role','idcardadmin')->get();
    return view('pages.adminPanel.idadmin' , compact('idAdmins'));
   }
   public function idCardAdminDelete(string $id){
    $idAdminsDelete = User::find($id);
    $idAdminsDelete->delete();
    return redirect()->route('admin-panel.idadmin');
   }

   public function idCardAdminedit($id){
    $idAdminsEdit = User::find($id);
    return view('pages.adminPanel.idupdateUser', compact('idAdminsEdit'));
   }

   public function idCardAdminUpdate(Request $request, string $id){
    $idAdminsEdit = User::find($id);
    $idAdminsEdit->name=$request->name;
    $idAdminsEdit->email=$request->email;
    $idAdminsEdit->password=Hash::make($request->password);
    $idAdminsEdit->save();
    return redirect()->route('admin-panel.idadmin.edit', ['id' => $idAdminsEdit->id])->with('success', 'Successfully Updated');
   }
   // ID Card Admin function end
   
   public function itServicesAdmin(){
    $itAdmins = User::where('role','itservicesadmin')->get();
    return view('pages.adminPanel.itadmin' , compact('itAdmins'));
   }
   public function itServicesAdminDelete(string $id){
    $itAdminsDelete = User::find($id);
    $itAdminsDelete->delete();
    return redirect()->route('admin-panel.itadmin');
   }

   public function itservicesAdminedit($id){
    $itAdminsEdit = User::find($id);
    return view('pages.adminPanel.itupdateUser', compact('itAdminsEdit'));
   }

   public function itservicesAdminUpdate(Request $request, string $id){
    $itAdminsEdit = User::find($id);
    $itAdminsEdit->name=$request->name;
    $itAdminsEdit->email=$request->email;
    $itAdminsEdit->password=Hash::make($request->password);
    $itAdminsEdit->save();
    return redirect()->route('admin-panel.itadmin.edit', ['id' => $itAdminsEdit->id])->with('success', 'Successfully Updated');
   }

   public function resultAdmin(){
    $resultAdmins = User::where('role','resultadmin')->get();
    return view('pages.adminPanel.resultadmin' , compact('resultAdmins'));
   }

   public function resultAdminDelete(string $id){
    $resultAdminsDelete = User::find($id);
    $resultAdminsDelete->delete();
    return redirect()->route('admin-panel.resultadmin');
   }

   public function resultAdminedit($id){
    $resultAdminsEdit = User::find($id);
    return view('pages.adminPanel.resultupdateUser', compact('resultAdminsEdit'));
   }

   public function resultAdminUpdate(Request $request, string $id){
    $resultAdminsEdit = User::find($id);
    $resultAdminsEdit->name=$request->name;
    $resultAdminsEdit->email=$request->email;
    $resultAdminsEdit->password=Hash::make($request->password);
    $resultAdminsEdit->save();
    return redirect()->route('admin-panel.itadmin.edit', ['id' => $resultAdminsEdit->id])->with('success', 'Successfully Updated');
   }
    public function itServices()
    {
        //
        
            $facultys = FacultyItService::all();
            $students = StudentItService::all();
            // return $facultys;
            return view('pages.ITservicesAdmin.index', compact('facultys','students'));
        
    }

    public function idCardServices(){
            $students = StudentRecord::all();
            $staff = FacultyRecord::all();
            return view('pages.IDcardAdmin.index',compact('students','staff'));
        
        }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     //
    //     return view('pages.adminPanel.addUser');
    // }

    public function addUser(){
        
        return view('pages.adminPanel.addUser');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = $request->validate([
            'name' =>'required',
            'email' =>'required|email|unique:users',
            'password' =>'required|confirmed|min:6',
            'role' => 'required'
        ]);
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        
        return redirect()->route('admin-panel.addUser')->with('success', 'Successfully Form Submitted');
    }

    /**
     * Display the specified resource.
     */
    public function show(AdminPanel $AdminPanel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AdminPanel $AdminPanel)
    {
        //
        // $AdminPanel = User::find($AdminPanel->id);
        // return view('pages.adminPanel.updateUser', compact($'AdminPanel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AdminPanel $AdminPanel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AdminPanel $AdminPanel)
    {
         $user = User::find($id);
         $user->delete();
         return redirect()->route('admin-panel.addUser');
    }
}
