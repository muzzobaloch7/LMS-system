<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function loginMatch(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            switch ($user->role) {
                case 'mainadmin':
                    return redirect()->route('admin-panel.index');
                case 'idcardadmin':
                    return redirect()->route('admin-panel.id-card-services');
                case 'itservicesadmin':
                    return redirect()->route('admin-panel.it-services');
                case 'resultadmin':
                    return redirect()->route('result-admin.index');
                case 'student':
                    return redirect()->route('student');
                case 'staff':
                    return redirect()->route('staff'); // Consider adding specific routes for student and staff
                default:
                    return redirect()->route('user.login')->with('error', 'Invalid role');
            }
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    

    /**
     * Show the form for creating a new resource.
     */
    
    public function store(Request $request)
    {
        //
    

    }

    /**
     * Store a newly created resource in storage.
     */
    public function registerStore(Request $request)
    {
        $data = $request->validate([
            'name' =>'required',
            'email' =>'required|email|unique:users',
            'password' =>'required|confirmed|min:8',
            'role' => 'in:student,staff,itservicesadmin,idcardadmin,mainadmin',
        ]);

        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);

        if ($user) {
            Auth::login($user);
            switch ($user->role) {
                case 'mainadmin':
                    return redirect()->route('admin-panel.index');
                case 'idcardadmin':
                    return redirect()->route('admin-panel.id-card-services');
                case 'itservicesadmin':
                    return redirect()->route('admin-panel.it-services');
                case 'student':
                    return redirect()->route('student'); // Consider adding specific routes for student and staff
                    case 'staff':
                        return redirect()->route('staff'); // Consider adding specific routes for student and staff
                default:
                    return redirect()->route('user.login')->with('error', 'Invalid role');
            }
        }

        return back()->withErrors(['email' => 'Registration failed']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('user.login');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $users = User::find($id);
        return view('pages.adminPanel.updateUser' , compact('users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $users = User::find($id);
        $users->name=$request->name;
        $users->email=$request->email;
        $users->password=Hash::make($request->password);
        $users->save();
        
        return redirect()->route('admin-panel.editUser', ['user' => $id])->with('success', 'User Data Updated Successfully ');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function index()
    {
        $users = User::with('personalInfo')->get();
        return view('users.index', compact('users'));
    }
}