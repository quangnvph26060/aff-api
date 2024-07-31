<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Services\CommentService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class CommentController extends Controller
{
    protected $commentService;
    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    public function index()
    {
        $data = DB::table('comments')
        ->join('products', 'comments.product_id', '=', 'products.id')
        ->select('comments.product_id', 'products.name as product_name', DB::raw('AVG(comments.rate) as average_rate'))
        ->groupBy('comments.product_id', 'products.name')
        ->get();
       $title = 'Danh sách bình luận';
       return view('admin.comment.index',['data'=>$data,'title'=>$title]);
    }

    public function find($id) {
        $data = DB::table('comments')
        ->join('products', 'comments.product_id', '=', 'products.id')
        ->join('users', 'comments.user_id', '=', 'users.id')
        ->select('comments.id','comments.content','comments.product_id','comments.rate','users.name','products.name  as product_name')
        ->get();
        $title = 'Danh sách bình luận';
        $is_flag = true;
        return view('admin.comment.index',['data'=>$data,'title'=>$title,'is_flag'=>$is_flag]);
    }
    public function delete($id)
    {
        $data = Comment::find($id);
        
        if (!$data) {
            return response()->json([
                'status' => 'error',
                'message' => 'Comment not found'
            ], 404); 
        }
    
        $data->delete();
    
        return redirect()->back();
    }
}
