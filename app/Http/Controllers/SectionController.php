<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Section;
use App\Client;
use Session;

class SectionController extends Controller
{
  public function create($client)
  {
    $clientOne = Client::find($client);
    return view("sections.create")->with('clientOne', $clientOne);
  }
  public function store(Request $request)
  {
    //validate from data ja buus errori tos ievietos $errors array, flash sessionā! un atgriezīsies pie create!
    $this->validate($request, array(
      //ja vairāki noteikumi izmanto |
      "section_name"=>'required|max:255'
    ));
    //store in database
      //create new model instance
    $section = new Section;
      //bind data
    $section->section_name = $request->section_name;
    $section->content = $request->content;
    $section->client_id = $request->client;
    // TODO: Jāpārveido form text laukā ievadītais nosaukums ar id un jāstoro ID
      //save to DB
    $section->save();
    //flash message in session flash('key', 'value')
    Session::flash('success', 'Sadaļa veiksmīgi izveidota!');
    //redirect to show
    return redirect()->route('clients.show', $request->client);
  }
  public function edit($client, $id)
  {
    $clientOne = Client::find($client);
    $section = Section::find($id);
    return view('sections.edit')->with('section', $section)->with('clientOne', $clientOne);
  }
  public function update(Request $request)
  {
    //validate from data ja buus errori tos ievietos $errors array, flash sessionā! un atgriezīsies pie create!
    $this->validate($request, array(
      //ja vairāki noteikumi izmanto |
      "section_name"=>'required|max:255'
    ));
    //store in database
      //create new model instance
    $section = Section::find($request->id);
      //bind data
    $section->section_name = $request->section_name;
    $section->content = $request->content;
    $section->client_id = $request->client;
    // TODO: Jāpārveido form text laukā ievadītais nosaukums ar id un jāstoro ID
      //save to DB
    $section->save();
    //flash message in session flash('key', 'value')
    Session::flash('success', 'Sadaļa veiksmīgi labota!');
    //redirect to show
    return redirect()->route('clients.show', $request->client);
  }
  public function destroy(Request $request)
  {
    $section = Section::find($request->id);
    $section->delete();
    Session::flash('success', 'Sadaļa veiksmīgi izdzēsta!');
    return redirect()->route('clients.show', $request->client);
  }
}
