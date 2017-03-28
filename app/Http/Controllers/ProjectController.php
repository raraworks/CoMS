<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Client;
use Auth;
use App\Attachment;
use Session;
use Storage;

class ProjectController extends Controller
{
  //implement middleware protection for certain routes
  public function __construct()
  {
    $this->middleware('auth');
    $this->middleware('owner', ['only' => ['edit', 'update', 'destroy']]);
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $projects = Project::where('user_id', '=', Auth::id())->orderBy('due_date', 'asc')->orderBy('due_time', 'asc')->paginate(8);
      return view("projects.index")->with('projects', $projects);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $clients = Client::all();
      return view("projects.create")->with('clients', $clients);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $user = Auth::id();
      $project = new Project;
        //bind data
      $project->client_id = $request->client_id;
      $project->project_name = $request->project_name;
      $project->content = $request->content;
      $project->due_date = date('Y-m-d', strtotime($request->due_date));
      $project->due_time = date('H:i:s', strtotime($request->due_time));
      $project->user_id = $user;
      $project->save();
      if ($request->hasFile('attachments')) {
        $files = $request->file('attachments');
        foreach ($files as $file) {
          $attachment = new Attachment();
          $filename = $file->getClientOriginalName();
          $attachment->mime = $file->getClientMimeType();
          $attachment->filename = $project->id."_".$filename;
          $project->attachments()->save($attachment);
          $file->storeAs('projectAttach', $project->id."_".$filename);
        }
      }
      //save to DB
      //flash message in session flash('key', 'value')
      Session::flash('success', 'Projekts veiksmīgi izveidots!');
      //redirect to show
      return redirect()->route('projects.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      //find id in database
      //ja atrod pieskir $client visu array (row) no DB
      $project = Project::find($id);
      if (!$project) {
        return abort(404, 'Project not found');
      } else {
        $att = $project->attachments;
        //pass $client saturu no DB, uz skatu (izmanto with metodi)
        //with(nosaukums skatā, mainīgā nosaukums kurs satur info)
        return view('projects.show')->with('project', $project)->with('att', $att);
      }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $project = Project::find($id);
      $clients = Client::all()->except($project->client->id);
      $due_date = date('d.m.Y', strtotime($project->due_date));
      $due_time = date('H:i', strtotime($project->due_time));
      return view('projects.edit')->with('project', $project)->with('clients', $clients)->with('due_date', $due_date)->with('due_time', $due_time);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $project = Project::find($id);
        //bind data
      $project->client_id = $request->client_id;
      $project->project_name = $request->project_name;
      $project->content = $request->content;
      $project->due_date = date('Y-m-d', strtotime($project->due_date));
      $project->due_time = date('H:i:s', strtotime($project->due_time));
        //save to DB
      $project->update();
      //flash message in session flash('key', 'value')
      Session::flash('success', 'Projekts veiksmīgi labots!');
      //redirect to show
      return redirect()->route('projects.show', $project->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $project = Project::find($id);
      $attachments = $project->attachments;
      foreach ($attachments as $attachment) {
        Storage::delete('/projectAttach/'.$attachment->filename);
      }
      $project->delete();
      Session::flash('success', 'Projekts veiksmīgi izdzēsts!');
      return redirect()->route('projects.index');
    }
}
