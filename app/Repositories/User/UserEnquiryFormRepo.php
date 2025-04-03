<?php

namespace App\Repositories\User;
use App\Models\UserEnquiryForm;

class UserEnquiryFormRepo
{
    public function getAll()
    {
        return UserEnquiryForm::where('delete_status','1')->get();
    }

    public function findById($id)
    {
        return UserEnquiryForm::findOrFail($id);
    }

    public function create(array $data)
    {
        return UserEnquiryForm::create($data);
    }

    public function update($id, array $data)
    {
        $enquiry = UserEnquiryForm::findOrFail($id);
        $enquiry->update($data);
        return $enquiry;
    }

    public function delete($id)
    {
        $enquiry = UserEnquiryForm::findOrFail($id);
        return $enquiry->delete();
    }
}
