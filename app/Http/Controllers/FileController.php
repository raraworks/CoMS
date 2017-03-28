<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Attachment;

class FileController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }
  public function getActionFile($filename)
  {
    $fails = Attachment::where('filename', $filename)->where('related_type', 'App\Action')->first();
    return response()->file(storage_path('app/actionAttach/'.$filename), array('content-type'=>$fails->mime));
  }
  public function getSectionFile($filename)
  {
    $fails = Attachment::where('filename', $filename)->where('related_type', 'App\Section')->first();
    return response()->file(storage_path('app/sectionAttach/'.$filename), array('content-type'=>$fails->mime));
  }
  public function destroySectionFile($filename)
  {
    $failsDB = Attachment::where('filename', $filename)->where('related_type', 'App\Section')->first();
    $fails = Storage::delete('/sectionAttach/'.$filename);
    $failsDB->delete();
    return redirect()->back();
  }
  public function getProjectFile($filename)
  {
    $fails = Attachment::where('filename', $filename)->where('related_type', 'App\Project')->first();
    return response()->file(storage_path('app/projectAttach/'.$filename), array('content-type'=>$fails->mime));
  }
  public function destroyProjectFile($filename)
  {
    $failsDB = Attachment::where('filename', $filename)->where('related_type', 'App\Project')->first();
    $fails = Storage::delete('/projectAttach/'.$filename);
    $failsDB->delete();
    return redirect()->back();
  }
}
