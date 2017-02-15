<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Action;
use App\Client;
use Session;

class ActionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $actions = Action::orderBy('due_date', 'asc')->orderBy('due_time', 'asc')->paginate(10);
      return view("actions.index")->with('actions', $actions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = Client::all();
        return view("actions.create")->with('clients', $clients);
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
        "client_id"=>'required',
        "title"=>'required|max:255'
      ));
      //store in database
        //create new model instance
      $action = new Action;
        //bind data
      $action->client_id = $request->client_id;
      $action->title = $request->title;
      $action->content = $request->content;
      $action->due_date = date('Y-m-d', strtotime($request->due_date));
      $action->due_time = date('H:i:s', strtotime($request->due_time));
        //save to DB
      $action->save();
      //flash message in session flash('key', 'value')
      Session::flash('success', 'Darbība veiksmīgi izveidota!');
      //redirect to show
      return redirect()->route('actions.show', $action->id);
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
      $action = Action::find($id);
      //pass $client saturu no DB, uz skatu (izmanto with metodi)
      //with(nosaukums skatā, mainīgā nosaukums kurs satur info)
        return view('actions.show')->with('action', $action);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $action = Action::find($id);
      $clients = Client::all();
      $due_date = date('d.m.Y', strtotime($action->due_date));
      $due_time = date('H:i', strtotime($action->due_time));
      return view('actions.edit')->with('action', $action)->with('clients', $clients)->with('due_date', $due_date)->with('due_time', $due_time);
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
      //validate from data ja buus errori tos ievietos $errors array, flash sessionā! un atgriezīsies pie create!
      $this->validate($request, array(
        //ja vairāki noteikumi izmanto |
        "title"=>'required|max:255',
        "client_id"=>'required'
      ));
      //store in database
        //create new model instance
      $action = Action::find($id);
        //bind data
      $action->client_id = $request->client_id;
      $action->title = $request->title;
      $action->content = $request->content;
      $action->due_date = date('Y-m-d', strtotime($request->due_date));
      $action->due_time = date('H:i:s', strtotime($request->due_time));
        //save to DB
      $action->save();
      //flash message in session flash('key', 'value')
      Session::flash('success', 'Darbība veiksmīgi labota!');
      //redirect to show
      return redirect()->route('actions.show', $action->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $action = Action::find($id);
      $action->delete();
      Session::flash('success', 'Darbība veiksmīgi izdzēsta!');
      return redirect()->route('actions.index');
    }
}
