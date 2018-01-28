<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Contact;
use App\Client;
use Session;

class ContactController extends Controller
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
      $contacts = Contact::orderBy('contact_name', 'asc')->paginate(10);
      return view("contacts.index")->with('contacts', $contacts);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //retrieve info from another model to use in view
        $clients = Client::all();
        return view("contacts.create")->with('clients', $clients);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      //validate from data
      $this->validate($request, array(
        "contact_name"=>'required|max:255'
      ));
      //instantiate class
      $contact = new Contact;
      $user = Auth::id();
      //bind data
      $contact->contact_name = $request->contact_name;
      $contact->phone = $request->phone;
      $contact->email = $request->email;
      $contact->position = $request->position;
      $contact->client_id = $request->client_id;
      $contact->user_id = $user;
      //save to DB
      $contact->save();
      //flash message in session flash('key', 'value')
      Session::flash('success', 'Kontakts veiksmīgi izveidots!');
      //redirect to show
      if (!empty($request->client)) {
          return redirect()->route('clients.show', $request->client);
      }
      return redirect()->route('contacts.show', $contact->id);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
      //find id in database
      $contact = Contact::find($id);
      //if not found
      if (!$contact) {
        return abort(404, 'Kontaktpersona nav atrasta');
      } else {
        return view('contacts.show')->with('contact', $contact);
      }
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
      $clients = Client::all();
      $contact = Contact::find($id);
      return view('contacts.edit')->with('contact', $contact)->with('clients', $clients);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
      //validē formu
      $this->validate($request, array(
        "contact_name"=>'required|max:255'
      ));
      //find in DB
      $contact = Contact::find($id);
      //bind data
      $contact->contact_name = $request->contact_name;
      $contact->phone = $request->phone;
      $contact->email = $request->email;
      $contact->position = $request->position;
      $contact->client_id = $request->client_id;
      //update to DB
      $contact->update();
      //flash message in session flash('key', 'value')
      Session::flash('success', 'Kontakts veiksmīgi labots!');
      //redirect to show
      return redirect()->route('contacts.show', $contact->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
      $contact = Contact::find($id);
      $contact->delete();
      Session::flash('success', 'Kontaktpersona veiksmīgi izdzēsta!');
      return back();
    }

    /**
     * Find resource in DB (ajax)
     */
    public function search(Request $request)
    {
      if ($request->ajax()) {
        //find in DB
        $contacts = Contact::where("contact_name", 'LIKE', '%'.$request->input('term').'%')->with('client')->get();
        //return rendered partial view, to display
        $returnView = view('contacts.ajaxviews.search')->with('contacts', $contacts)->render();
        return response()->json($returnView);
      }
    }
}
