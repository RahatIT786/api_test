<?php

namespace App\Http\Controllers;

use App\Services\User\UserEnquiryFormService;
use Illuminate\Http\Request;

class UserEnquiryFormController extends Controller
{
    protected $userEnquiryFormService;

    public function __construct(UserEnquiryFormService $service)
    {
        $this->userEnquiryFormService = $service;
    }

    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        return response()->json($this->userEnquiryFormService->getAllEnquiries($perPage));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'product_id' => 'required',
            'product_name' => 'required|string',
            'email' => 'nullable|email',
            'mobile' => 'required|string',
            'message' => 'nullable|string',
        ]);

        return response()->json($this->userEnquiryFormService->createEnquiry($data), 201);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'product_id' => 'sometimes|required',
            'product_name' => 'sometimes|required|string',
            'email' => 'nullable|email',
            'mobile' => 'required|string',
            'message' => 'nullable|string',
        ]);

        return response()->json($this->userEnquiryFormService->updateEnquiry($id, $data));
    }

    public function delete($id)
    {
        $this->userEnquiryFormService->deleteEnquiry($id);
        return response()->json(['message' => 'Enquiry deleted successfully']);
    }
}
