<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Attachment;
use App\Client;
use Storage;
use App\Contact;
use App\Section;
use App\Action;
use Session;

class ClientController extends Controller
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
        $clients = Client::orderBy('title', 'asc')->paginate(10);
        return view("clients.index")->with('clients', $clients);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("clients.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validate from data
        $this->validate($request, array(
          "title"=>'required|unique:clients|max:255'
        ));
        //instantiate class
        $client = new Client;
        $user = Auth::id();
        //bind data
        $client->title = $request->title;
        $client->address = $request->address;
        $client->user_id = $user;
        //save to DB
        $client->save();

        if ($request->contact_name) {
          $contact = new Contact;
          $contact->contact_name = $request->contact_name;
          $contact->phone = $request->phone;
          $contact->email = $request->email;
          $contact->position = $request->position;
          $contact->client_id = $client->id;
          $contact->user_id = $user;
          //save to DB
          $contact->save();
          Session::flash('success2', 'Klientam pievienots kontakts!');
        }
        //flash message in session flash('key', 'value')
        Session::flash('success', 'Klients veiksmīgi izveidots!');
        //redirect to show
        return redirect()->route('clients.show', $client->id);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
      //find id in database
      $client = Client::find($id);
      if (!$client) {
        return abort(404, 'Klients nav atrasts!');
      } else {
      //find all related contacts, sections and pass them to view
      $contacts = Client::find($id)->contacts;
      $sections = Client::find($id)->sections;
      $actions = Action::where('client_id', '=', $id)->orderBy('due_date', 'desc')->paginate(10, ['*']);
      return view('clients.show')->with('client', $client)->with('contacts', $contacts)->with('sections', $sections)->with('actions', $actions);
    }
  }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
      $client = Client::find($id);
      return view('clients.edit')->with('client', $client);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
      //form validation
      $this->validate($request, array(
        "title"=>'required|max:255'
      ));
      //find in DB
      $client = Client::find($id);
      //bind data
      $client->title = $request->title;
      $client->address = $request->address;
      //update to DB
      $client->update();
      //flash message in session flash('key', 'value')
      Session::flash('success', 'Klients veiksmīgi labots!');
      //redirect to show
      return redirect()->route('clients.show', $client->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
      //find in DB and find related records based on model relations
        $client = Client::find($id);
        $actions = Client::find($id)->actions;
        $sections = Client::find($id)->sections;
      //file deletion in storage (db records are deleted automatically, (AppServiceProvider.php))
        foreach ($actions as $aaa) {
          $ids = $aaa->id;
          $attachments = Attachment::where('related_id', '=', $ids)->where('related_type', 'App\Action')->get();
          foreach ($attachments as $attachment) {
            Storage::delete('/actionAttach/'.$attachment->filename);
          }
        }
        $sections = Client::find($id)->sections;
        foreach ($sections as $section) {
          $ids = $section->id;
          $attachments = Attachment::where('related_id', '=', $ids)->where('related_type', 'App\Section')->get();
          foreach ($attachments as $attachment) {
            Storage::delete('/sectionAttach/'.$attachment->filename);
          }
        }
        //delete resource and redirect with message
        $client->delete();
        Session::flash('success', 'Klients veiksmīgi izdzēsts!');
        return redirect()->route('clients.index');
    }

    /**
     * Search resource by title
     */
    public function search(Request $request)
    {
      //retrieve params from request
      $keyword = $request->input('term');
      $results = Client::where('title', 'LIKE', '%'.$keyword.'%')->get();
      return view('clients.search')->with('results', $results)->with('keyword', $keyword);
    }
}
