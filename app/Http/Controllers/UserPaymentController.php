<?php

namespace App\Http\Controllers;

use App\Models\UserPayment;
use Illuminate\Http\Request;
use App\Services\User\UserPaymentService;

class UserPaymentController extends Controller
{
    protected $userPaymentService;

    public function __construct(UserPaymentService $userPaymentService)
    {
        $this->userPaymentService = $userPaymentService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return $this->userPaymentService->getUserPayment();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required',
            'payment_method' => 'required',
            'amount' => 'required',
            'transaction_id' => 'required',
            'delete_status' => 'nullable|integer',
        ]);

        //$userPayment = $this->userPaymentService->createUserPayment($validated);

        // return response()->json([
        //     'status' => true,
        //     'message' => "User Payment successfully",
        //     'userPayment' => $userPayment
        // ], 201);

        return 'test';
    }

    /**
     * Display the specified resource.
     */
    public function show(UserPayment $userPayment)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserPayment $userPayment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserPayment $userPayment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserPayment $userPayment)
    {
        //
    }

    public function getUserPaymentsByUserId($user_id)
    {
        return $this->userPaymentService->getUserPaymentsByUserId($user_id);
    }
}
