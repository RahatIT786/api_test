<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserDetail;
use App\Services\User\UserDetailService;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserDetailController extends Controller
{
    protected $userDetailService;

    public function __construct(UserDetailService $userDetailService)
    {
        $this->userDetailService = $userDetailService;
    }

    /**
     * Create a new user detail
     */
    public function createUserDetail(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:user_details',
            'mobile' => 'required',
            'dob' => 'required|date',
            'adhaar' => 'required',
            'address' => 'required',
            'password' => 'required|min:6',
            'user_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'delete_status' => 'nullable|integer',
        ]);

        if ($request->hasFile('user_image')) {
            $validated['user_image'] = $request->file('user_image')->store('uploads', 'public');
        }

        $userDetail = $this->userDetailService->createUserDetail($validated);

        return response()->json([
            'status' => true,
            'message' => "User detail created successfully",
            'userDetails' => $userDetail
        ], 201);
    }

    public function updateUserDetail(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'mobile' => 'required|string|max:15',
            'dob' => 'required|date',
            'adhaar' => 'required|string|max:20',
            'address' => 'required|string',
            'user_image' => 'nullable|string',
            'delete_status' => 'nullable|integer'
        ]);

        $userDetail = $this->userDetailService->updateUserDetail($validated, $id);

        return response()->json([
            'status' => true,
            'message' => "User detail updated successfully",
            'userDetails' => $userDetail
        ], 200);
    }

    /**
     * Get all user details where delete_status is 1 (Active users)
     */
    public function getUserDetail()
    {
        $userDetails = UserDetail::where('delete_status', 1)->get();

        if ($userDetails->isEmpty()) {
            return response()->json(['message' => 'No user details found'], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'User details retrieved successfully',
            'data' => $userDetails
        ]);
    }

    /**
     * Soft delete a user detail by changing delete_status to 2
     */
    public function deleteUserDetail($id)
    {
        $userDetail = UserDetail::find($id);

        if (!$userDetail) {
            return response()->json(['message' => 'User detail not found'], 404);
        }

        if ($userDetail->delete_status == 2) {
            return response()->json(['message' => 'User detail already deleted'], 400);
        }

        $userDetail->delete_status = 2;
        $userDetail->save();

        return response()->json(['message' => 'User detail deleted successfully']);
    }

    public function getUserDetailForUpdate($id)
    {
        return $this->userDetailService->getUserDetailForUpdate($id);
    }
}
