<?php
namespace App\Http\Controllers;
use App\Action;
use Session;
/**
 *
 */
class PagesController extends Controller
{

  public function getIndex()
  {
    $actions = Action::whereDate('due_date', '=', date('Y-m-d'))->orderBy('due_time', 'asc')->get();
    $actionsFuture = Action::orderBy('due_date', 'asc')->orderBy('due_time', 'asc')->paginate(10, ['*'], 'futuretodopage');
    return view('welcome')->with('actions', $actions)->with('actionsFuture', $actionsFuture);
  }
}


?>
