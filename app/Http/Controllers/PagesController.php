<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Action;
use Session;
/**
 *
 */
class PagesController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth');
  }

  public function getIndex()
  {
    $actions = Action::where('user_id', Auth::id())->whereDate('due_date', '=', date('Y-m-d'))->orderBy('due_time', 'asc')->get();
    $actionsFuture = Action::where('user_id', Auth::id())->orderBy('due_date', 'asc')->orderBy('due_time', 'asc')->paginate(8, ['*'], 'futuretodopage');
    $actionsPast = Action::where('user_id', Auth::id())
      ->whereDate('due_date', '<', date('Y-m-d'))
      ->orderBy('due_date', 'desc')
      ->orderBy('due_time', 'desc')
      ->paginate(8, ['*'], 'pasttodopage');
    return view('welcome')->with('actions', $actions)->with('actionsFuture', $actionsFuture)->with('actionsPast', $actionsPast);
  }
}


?>
