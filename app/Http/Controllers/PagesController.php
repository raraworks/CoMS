<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Action;
use App\User;
use Session;
use \Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Client;
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
    if ($request->ajax()) {

      $user = User::find($request->query('id'));
      $allActions = new Collection;
      $actions = new Collection;
      $typeArray = ['call' => 'Zvans', 'meeting' => 'Vizīte', 'offer'=> 'Piedāvājums'];
      $keys = array_keys($typeArray);
      foreach ($keys as $key) {
        if ($request->query($key)) {
          $actions = Action::where('title', $typeArray[$key])->where('user_id', $user->id)->get();
          $allActions = $allActions->merge($actions)->sortByDesc('due_date');
        }
      }
      if ($request->exists('status')) {
        if ($request->query('status') == "1") {
          $allActions = $allActions->where('is_done', 1);
        } elseif ($request->query('status') == "0") {
          $allActions = $allActions->where('is_done', 0);
        }
      }
      // to do implement search also by client name with all other criteria

      if ($request->query('client_name')) {
        $term = $request->query('client_name');
        $clientIds = Client::where('title', 'like', '%'.$term.'%')->get(['id']);
        $idArray = [];
        foreach ($clientIds as $clientId) {
          array_push($idArray, $clientId->id);
        }
        $allActions = $allActions->whereIn('client_id', $idArray);
        // $allActions = $idArray;
        // $allActions = Action::where('user_id', $user->id)->whereHas('client', function ($query) use ($term) {
        //   $query->where('title', 'like', '%'.$term.'%');
        // });
      // $allActions->get();
      // return response()->json($allActions);
      }
      $returnView = view('actions.ajaxviews.search')->with('allActions', $allActions)->render();
      return response()->json($returnView);
    }

    $user = User::find($request->query('id'));
    $userActions = Action::where('user_id', $user->id)->orderBy('due_date', 'desc')
    ->orderBy('due_time', 'desc')->paginate(8, ['*'], 'useractionlist');
    return view('searchactions')->with('userActions', $userActions)->with('user', $user);
  }
  public function getMap(Request $request){
      return view('map');
  }
}


?>
