<?php

namespace App\Repositories\User;
use App\Models\UserDetail;

class UserDetailRepo{
    public function createUserDetail(array $data){
        try{
            return UserDetail::create($data);
        }catch(QueryException $e){
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

    public function getUserDetail(){
        $userDetail = UserDetail::where('delete_status', 1)->get();
        return response()->json($userDetail);
    }

    public function getUserDetailForUpdate($id){
        $userDetail = UserDetail::where('id', $id)->get();
        return response()->json($userDetail, 200);
    }

    public function updateUserDetail(array $validated, $id){
        $userDetail = UserDetail::find($id);
        // Update all fields
        $userDetail->update($validated);

        return response()->json([
             $userDetail
        ], 200);
    }
}