<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Contact;
use App\Client;
use Session;

class ContactController extends Controller
{
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
      $contacts = Contact::orderBy('contact_name', 'asc')->paginate(10);
      return view("contacts.index")->with('contacts', $contacts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //to use data from another table, select all from that table using Model (add use for namespacing issues)
        $clients = Client::all();
        return view("contacts.create")->with('clients', $clients);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      //validate from data ja buus errori tos ievietos $errors array, flash sessionā! un atgriezīsies pie create!
      $this->validate($request, array(
        //ja vairāki noteikumi izmanto |
        "contact_name"=>'required|max:255'
      ));
      //store in database
        //create new model instance
      $contact = new Contact;
      $user = Auth::id();
        //bind data
      $contact->contact_name = $request->contact_name;
      $contact->phone = $request->phone;
      $contact->email = $request->email;
      $contact->position = $request->position;
      // TODO: Jāpārveido form text laukā ievadītais nosaukums ar id un jāstoro ID
      $contact->client_id = $request->client_id;
      $contact->user_id = $user;
        //save to DB
      $contact->save();
      //flash message in session flash('key', 'value')
      Session::flash('success', 'Kontakts veiksmīgi izveidots!');
      //redirect to show
      return redirect()->route('contacts.show', $contact->id);
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
      $contact = Contact::find($id);
      if (!$client) {
        return abort(404, 'Contact not found');
      } else {
      //pass $client saturu no DB, uz skatu (izmanto with metodi)
      //with(nosaukums skatā, mainīgā nosaukums kurs satur info)
        return view('contacts.show')->with('contact', $contact);
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
      $clients = Client::all();
      $contact = Contact::find($id);
      return view('contacts.edit')->with('contact', $contact)->with('clients', $clients);
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
      //validē formu
      $this->validate($request, array(
        //ja vairāki noteikumi izmanto |
        "contact_name"=>'required|max:255'
      ));
      //atrodi kontaktu DB
      $contact = Contact::find($id);
      //updeito formu
      $contact->contact_name = $request->contact_name;
      $contact->phone = $request->phone;
      $contact->email = $request->email;
      $contact->position = $request->position;
      $contact->client_id = $request->client_id;
      //commit save to DB
      $contact->save();
      //flash message in session flash('key', 'value')
      Session::flash('success', 'Kontakts veiksmīgi labots!');
      //redirect to show
      return redirect()->route('contacts.show', $contact->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $contact = Contact::find($id);
      $contact->delete();
      Session::flash('success', 'Kontaktpersona veiksmīgi izdzēsta!');
      return redirect()->route('contacts.index');
    }

    public function search(Request $request)
    {
      if ($request->ajax()) {
        //atrodam DB
        $contacts = Contact::where("contact_name", 'LIKE', '%'.$request->input('term').'%')->with('client')->get();
        $returnView = view('contacts.ajaxviews.search')->with('contacts', $contacts)->render();
        return response()->json($returnView);
      }
    }
}
