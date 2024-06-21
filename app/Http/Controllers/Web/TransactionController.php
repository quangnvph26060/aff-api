<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function __construct()
    {
        
    }
    public function index(){
        $data = Transaction::with('user','wallet','method')->get();
        return view('admin.transaction.index',compact('data'));
    }
    public function getTransacTion(){

    }
}
