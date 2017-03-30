<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Action;
use App\Client;
use App\Attachment;
use Session;

class ActionController extends Controller
{

    //constructor, applies middleware
    public function __construct()
    {
      $this->middleware('auth');
      $this->middleware('owner', ['only' => ['edit', 'update', 'destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $actions = Action::where('user_id', '=', Auth::id())->orderBy('due_date', 'asc')->orderBy('due_time', 'asc')->paginate(8);
      return view("actions.index")->with('actions', $actions);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Client::all();
        return view("actions.create")->with('clients', $clients);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      //validate form data
      //if validation fails errors will be stored in session, and returned back to prev location
      $this->validate($request, array(
        "client_id"=>'required',
        "title"=>'required|max:255'
      ));
      //current authenticated user
      $user = Auth::id();
      //instantiate a class
      $action = new Action;
      //bind form data to model
      $action->client_id = $request->client_id;
      $action->title = $request->title;
      $action->content = $request->content;
      $action->due_date = date('Y-m-d', strtotime($request->due_date));
      $action->due_time = date('H:i:s', strtotime($request->due_time));
      $action->user_id = $user;
      //store in database
      $action->save();
      //checking if form contained attachments, and store them in database as a reference to laravel storage
      if ($request->hasFile('attachments')) {
        $files = $request->file('attachments');
        foreach ($files as $file) {
          $attachment = new Attachment();
          $filename = $file->getClientOriginalName();
          $attachment->mime = $file->getClientMimeType();
          $attachment->filename = $action->id."_".$filename;
          $action->attachments()->save($attachment);
          $file->storeAs('actionAttach', $action->id."_".$filename);
        }
      }
      //flash message in session flash('key', 'value')
      Session::flash('success', 'Darbība veiksmīgi izveidota!');
      //redirect to newly created resource
      return redirect()->route('actions.show', $action->id);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
      //find id in database
      $action = Action::find($id);
      //if not found throw 404
      if (!$action) {
        return abort(404, 'Darbība nav atrasta');
      } else {
        $att = $action->attachments;
        //pass $client saturu no DB, uz skatu (izmanto with metodi)
        return view('actions.show')->with('action', $action)->with('att', $att);
      }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
      $action = Action::find($id);
      $clients = Client::all()->except($action->client->id);
      $due_date = date('d.m.Y', strtotime($action->due_date));
      $due_time = date('H:i', strtotime($action->due_time));
      return view('actions.edit')->with('action', $action)->with('clients', $clients)->with('due_date', $due_date)->with('due_time', $due_time);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
      //case if request came from asynchronous environment
      if ($request->ajax()) {
        $action = Action::find($id);
        $numba = $request->input('done');
        if ($numba == 0) {
          $action->is_done = true;
          $action->update();
          return response()->json(["isDone" => 1]);
        }
        else {
          $action->is_done = false;
          $action->update();
          return response()->json(["isDone" => 0]);
        }
      }
      //validate from data
      $this->validate($request, array(
        "title"=>'required|max:255',
        "client_id"=>'required'
      ));
      //find in database
      $action = Action::find($id);
      //bind data
      $action->client_id = $request->client_id;
      $action->title = $request->title;
      $action->content = $request->content;
      $action->due_date = date('Y-m-d', strtotime($request->due_date));
      $action->due_time = date('H:i:s', strtotime($request->due_time));
      //update in DB
      $action->update();
      //flash message in session flash('key', 'value')
      Session::flash('success', 'Darbība veiksmīgi labota!');
      //redirect to show
      return redirect()->route('actions.show', $action->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
      //find in database
      $action = Action::find($id);
      //find related records
      $attachments = $action->attachments;
      //delete each file based on records
      foreach ($attachments as $attachment) {
        Storage::delete('/actionAttach/'.$attachment->filename);
      }
      //remove resource (related resources will be removed (detailed event handling in Providers/AppServiceProvider.php))
      $action->delete();
      Session::flash('success', 'Darbība veiksmīgi izdzēsta!');
      return redirect()->route('actions.index');
    }
}
