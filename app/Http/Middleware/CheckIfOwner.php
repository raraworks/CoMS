<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use App\Action;
use App\Client;
use App\Contact;
use Auth;

class CheckIfOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      $urli = $request->segment(1, $request->path());
      switch ($urli) {
        case 'actions':
          $modelis = new Action();
          $iden = "action";
          break;
        case 'clients':
          $modelis = new Client();
          $iden = "client";
          break;
        case 'contacts':
          $modelis = new Contact();
          $iden = "contact";
          break;
      }

      $requested = $modelis::find($request->route($iden));
      if($requested->user_id == Auth::user()->id || Auth::user()->hasRole('admin'))
      {
        return $next($request);
      }
      else {
        return back()->withErrors(['Jūs neesat autorizēti veikt šādu darbību!']);
      }

    }
}

// if ($request->user()->hasRole('admin')) {
//   return $next($request);
// }
// else {
// }
