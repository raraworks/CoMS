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
    $actions = Action::whereDate('due_date', '=', date('Y-m-d'))->orderBy('due_time', 'asc')->paginate(null, ['*'], 'todopage');
    $actionsFuture = Action::orderBy('due_time', 'asc')->paginate(10, ['*'], 'futuretodopage');
    return view('welcome')->with('actions', $actions)->with('actionsFuture', $actionsFuture);
  }
}


?>
