<?php

namespace App\Repositories\User;
use App\Models\UserPayment;

class UserPaymentRepo
{
    public function createUserPayment(array $data){
        try {
            return UserPayment::create($data);
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                return response()->json([
                    'success' => false,
                    'message' => 'Duplicate entry detected! Please use a unique email or phone number.',
                ], 409); // 409 Conflict HTTP status
            }

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong. Please try again.',
            ], 500);
        }
    }

    public function getUserPayment(){
        $userPayment = UserPayment::where('delete_status', 1)->get();
        if ($userPayment->isEmpty()){
            return response()->json([
                'status' => false,
                'message' => "No payment is there",
            ], 404);
        }
        
        return response()->json([
            'status' => true,
            'message' => 'Payment details',
            'data' => $userPayment
        ], 200);
    }

    public function getUserPaymentsByUserId($user_id){
        $userPayments = UserPayment::where('user_id', $user_id)->get();

        if($userPayments->isEmpty()){
            return response()->json([
                'status' => false,
                'message' => "No Payment found  for this user",
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Payments retrieved successfully',
            'data' => $userPayments
        ], 200);
    }
}