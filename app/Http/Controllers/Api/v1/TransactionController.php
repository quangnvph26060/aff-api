<?php

namespace App\Http\Controllers\Api\v1;

use App\Exceptions\UserNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Responses\ApiResponse;
use Illuminate\Http\Request;
use App\Services\TransactionService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Log;

class TransactionController extends Controller
{
    protected $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $transaction = $this->transactionService->getAllTransaction();
            return ApiResponse::success($transaction);
        } catch (\Exception $e) {
            Log::error('Failed to fetch transaction: ' . $e->getMessage());
            return ApiResponse::error('Failed to fetch transaction', 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $transaction = $this->transactionService->addTransaction($request->all());
            return ApiResponse::success($transaction, 'Transaction requested successfully',201);
        }
        catch(ModelNotFoundException $e)
        {
            $exception = new UserNotFoundException();
            return $exception -> render(request());
        }
        catch(\Exception $e){
            Log::error('Failed to create request :' . $e->getMessage());
            return ApiResponse::error('Failed to create request', 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
