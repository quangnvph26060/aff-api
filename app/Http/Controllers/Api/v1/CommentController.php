<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Product;
use App\Services\CommentService;
use Dotenv\Exception\ValidationException;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CommentController extends Controller
{
    protected $commentService;

    public function __construct(CommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    public function index(Request $request)
    {
        try {
            $comments = $this->commentService->getAllCommentsForProduct($request);
         
            return response()->json([
                'success' => true,
                'data' => $comments,
            ], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Sản phẩm không tìm thấy.',
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Đã xảy ra lỗi. Vui lòng thử lại sau.',
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $comment = $this->commentService->createComment($request);

            return response()->json([
                'success' => true,
                'data' => $comment,
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Dữ liệu không hợp lệ.',
                'errors' => $e->errors(),
            ], 422);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Sản phẩm không tìm thấy.',
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Đã xảy ra lỗi. Vui lòng thử lại sau.',
            ], 500);
        }
    }

    public function destroy(Comment $comment)
    {
        try {
            $result = $this->commentService->deleteComment($comment);

            return response()->json([
                'success' => $result['success'],
                'message' => $result['message'],
            ], $result['status']);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Bình luận không tìm thấy.',
            ], 404);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Đã xảy ra lỗi. Vui lòng thử lại sau.',
            ], 500);
        }
    }
}
