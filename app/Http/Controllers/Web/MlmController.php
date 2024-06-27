<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MlmController extends Controller
{
   public function __construct()
   {
    
   }
   public function index(){
    return view('admin.mlm.index');
   }
}
