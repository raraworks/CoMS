<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Action;
use App\User;
use Session;
use Illuminate\Http\Request;
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
    $actionsFuture = Action::where('user_id', Auth::id())
      ->whereDate('due_date', '>', date('Y-m-d'))
      ->orderBy('due_date', 'asc')
      ->orderBy('due_time', 'asc')
      ->paginate(8, ['*'], 'futuretodopage');
    $actionsPast = Action::where('user_id', Auth::id())
      ->whereDate('due_date', '<', date('Y-m-d'))
      ->orderBy('due_date', 'desc')
      ->orderBy('due_time', 'desc')
      ->paginate(8, ['*'], 'pasttodopage');
    $subset = $actions->map(function($action){
      return collect($action->toArray())
      ->only(['due_time', 'title', 'content'])
      ->all();
    });
    return view('welcome')->with('actions', $actions)->with('actionsFuture', $actionsFuture)->with('actionsPast', $actionsPast)->with('subset', $subset);
  }
  public function adminPanel()
  {
    $users = User::all();
    return view('admin')->with('users', $users);
  }
  public function adminSearch(Request $request)
  {
    $user = User::find($request->query('id'));
    $userActions = Action::where('user_id', $user->id)->orderBy('due_date', 'desc')
    ->orderBy('due_time', 'desc')->paginate(8, ['*'], 'useractionlist');
    return view('searchactions')->with('userActions', $userActions)->with('user', $user);
  }
}


?>
