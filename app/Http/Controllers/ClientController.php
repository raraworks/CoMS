<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App\Contact;
use App\Section;
use App\Action;
use Session;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::orderBy('title', 'asc')->paginate(10);
        return view("clients.index")->with('clients', $clients);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("clients.create");
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
          "title"=>'required|max:255'
        ));
        //store in database
          //create new model instance
        $client = new Client;
          //bind data
        $client->title = $request->title;
        $client->address = $request->address;
        // $client->contact_name = $request->contact_name;
        // $client->phone = $request->phone;
        // $client->email = $request->email;
          //save to DB
        $client->save();
        //flash message in session flash('key', 'value')
        Session::flash('success', 'Klients veiksmīgi izveidots!');
        //redirect to show
        return redirect()->route('clients.show', $client->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     //sajaa gadiijumaa show(parametrs) - parametrs ir jebkas kas atrodas aiz /clients/...., tas tiek padots ieks funkcijas
    public function show($id)
    {
      //find id in database
      //ja atrod pieskir $client visu array (row) no DB

      $client = Client::find($id);
      //find all related contacts
      $contacts = Client::find($id)->contacts;
      $sections = Client::find($id)->sections;
      $actions = Action::where('client_id', '=', $id)->orderBy('due_date', 'desc')->paginate(10, ['*']);
      //pass $client saturu no DB, uz skatu (izmanto with metodi)
      //with(nosaukums skatā, mainīgā nosaukums kurs satur info)
        return view('clients.show')->with('client', $client)->with('contacts', $contacts)->with('sections', $sections)->with('actions', $actions);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $client = Client::find($id);
      return view('clients.edit')->with('client', $client);
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
        "title"=>'required|max:255'
      ));
      //atrodi klientu DB
      $client = Client::find($id);
      //updeito formu
      $client->title = $request->title;
      $client->address = $request->address;
      // $client->contact_name = $request->contact_name;
      // $client->phone = $request->phone;
      // $client->email = $request->email;
      //commit save to DB
      $client->save();
      //flash message in session flash('key', 'value')
      Session::flash('success', 'Klients veiksmīgi labots!');
      //redirect to show
      return redirect()->route('clients.show', $client->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = Client::find($id);
        $client->delete();
        Session::flash('success', 'Klients veiksmīgi izdzēsts!');
        return redirect()->route('clients.index');
    }
}
