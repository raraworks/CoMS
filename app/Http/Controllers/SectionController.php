<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Section;
use App\Client;
use App\Attachment;
use Session;
use Storage;

class SectionController extends Controller
{
  //constructor, applies middleware
  public function __construct()
  {
    $this->middleware('auth');
  }

  /**
   * Show the form for creating a new resource.
   * @param $client from route {client}
   */
  public function create($client)
  {
    //find client in db
    $clientOne = Client::find($client);
    return view("sections.create")->with('clientOne', $clientOne);
  }

  /**
   * Store a newly created resource in DB.
   */
  public function store(Request $request)
  {
    //validate from data
    $this->validate($request, array(
      "section_name"=>'required|max:255'
    ));
    //instantiate class
    $section = new Section;
    //bind data
    $section->section_name = $request->section_name;
    $section->content = $request->content;
    $section->client_id = $request->client;
    //save to DB
    $section->save();
    //if form contained files save them to DB and store in storage
    if ($request->hasFile('attachments')) {
      $files = $request->file('attachments');
      foreach ($files as $file) {
        $attachment = new Attachment();
        $filename = $file->getClientOriginalName();
        $attachment->mime = $file->getClientMimeType();
        $attachment->filename = $section->id."_".$filename;
        $section->attachments()->save($attachment);
        $file->storeAs('sectionAttach', $section->id."_".$filename);
      }
    }
    //flash message in session flash('key', 'value')
    Session::flash('success', 'Sadaļa veiksmīgi izveidota!');
    //redirect to show
    return redirect()->route('clients.show', $request->client);
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit($client, $id)
  {
    $clientOne = Client::find($client);
    $section = Section::find($id);
    return view('sections.edit')->with('section', $section)->with('clientOne', $clientOne);
  }

  /**
   * Update the specified resource in DB.
   */
  public function update(Request $request)
  {
    //validate from data
    $this->validate($request, array(
      "section_name"=>'required|max:255'
    ));
    //fin in db
    $section = Section::find($request->id);
    //bind data
    $section->section_name = $request->section_name;
    $section->content = $request->content;
    $section->client_id = $request->client;
    //save to DB
    $section->save();
    // if form has files, instantiate class, save to database and save file in storage
    if ($request->hasFile('attachments')) {
      $files = $request->file('attachments');
      foreach ($files as $file) {
        $attachment = new Attachment();
        $filename = $file->getClientOriginalName();
        $attachment->mime = $file->getClientMimeType();
        $attachment->filename = $section->id."_".$filename;
        $section->attachments()->save($attachment);
        $file->storeAs('sectionAttach', $section->id."_".$filename);
      }
    }
    //flash message in session flash('key', 'value')
    Session::flash('success', 'Sadaļa veiksmīgi labota!');
    //redirect to show
    return redirect()->route('clients.show', $request->client);
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Request $request)
  {
    $section = Section::find($request->id);
    $attachments = $section->attachments;
    foreach ($attachments as $attachment) {
      Storage::delete('/sectionAttach/'.$attachment->filename);
    }
    $section->delete();
    Session::flash('success', 'Sadaļa veiksmīgi izdzēsta!');
    return redirect()->route('clients.show', $request->client);
  }
}
