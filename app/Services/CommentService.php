<?php

namespace App\Services;

use App\Models\Comment;
use App\Models\Config;
use App\Models\Product;
use App\Models\User;
use Dotenv\Exception\ValidationException;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CommentService 
{
    protected $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }
    public function getAllCommentsForProduct(Request $request)
    {
        Log::info($request->id);
        $product = Comment::where('product_id',$request->id)->with('user')->get();
        return $product;
    }
    public function createComment(Request $request)
    {
        DB::beginTransaction();
    
        try {
            // Validate input
            $request->validate([
                'content' => 'required|max:500',
                'rate' => 'nullable|integer|min:1|max:5',
                'parent_id' => 'nullable|exists:comments,id',
                'product_id' => 'required|exists:products,id' 
            ]);
            // Create and save comment
            $comment = new Comment();
            $comment->content = $request->content;
            $comment->user_id = auth()->id();
            $comment->product_id = $request->product_id;
            if ($request->filled('parent_id')) {
                $comment->parent_id = $request->parent_id;
            }
            $comment->rate = $request->rate;
            $comment->save();
    
            DB::commit();
    
            return $comment;
        } catch (ValidationException $e) {
            DB::rollBack();
            // Handle validation exceptions
            throw $e; // Re-throw to be caught by controller
        } catch (Exception $e) {
            DB::rollBack();
            // Handle general exceptions
            throw $e; // Re-throw to be caught by controller
        }
    }
   
}
