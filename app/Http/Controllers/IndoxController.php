<?php

namespace App\Http\Controllers;

use App\Models\Indox;
use Illuminate\Http\Request;

class IndoxController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $messages = Indox::all();
        return view('pages.indox' , compact('messages'));
    }
    public function facIndex(){
        $messages = Indox::all();
        return view('pages.facinbox' , compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function idstore(Request $request)
    {
        //
        Indox::create([
            'reciever_id' => $request->reciever_id,
            'sender_name' => $request->sender_name,
            'message' => $request->message,
        ]);
        return redirect()->route('studentrecords.sendMessage',['id' => $request->reciever_id])->with('status','Message sent successfully');
    }
    public function stuitstore(Request $request)
    {
        //
        Indox::create([
            'reciever_id' => $request->reciever_id,
            'sender_name' => $request->sender_name,
            'message' => $request->message,
        ]);
        return redirect()->route('student-it-services.sendMessage',['id' => $request->reciever_id])->with('status','Message sent successfully');
    }
    public function facitstore(Request $request)
    {
        //
        Indox::create([
            'reciever_id' => $request->reciever_id,
            'sender_name' => $request->sender_name,
            'message' => $request->message,
        ]);
        return redirect()->route('faculty-it-services.sendMessage',['id' => $request->reciever_id])->with('status','Message sent successfully');
    }
    public function resultstore(Request $request)
    {
        //
        Indox::create([
            'reciever_id' => $request->reciever_id ?? null,
            'sender_name' => $request->sender_name,
            'message' => $request->message,
        ]);
        return redirect()->route('result-admin.sendMessage')->with('status','Message sent successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Indox $indox)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Indox $indox)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Indox $indox)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $indox = Indox::find($id);
        $indox->delete();
        return redirect()->route('student',['id' => $indox->reciever_id])->with('status','Message deleted successfully');
    }
}
