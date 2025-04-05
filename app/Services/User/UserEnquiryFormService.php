<?php
namespace App\Services\User;

use App\Repositories\User\UserEnquiryFormRepo;
use Illuminate\Validation\ValidationException;

class UserEnquiryFormService
{
    protected $userEnquiryFormRepo;

    public function __construct(UserEnquiryFormRepo $repository)
    {
        $this->userEnquiryFormRepo = $repository;
    }

    public function getAllEnquiries($perPage = 10)
    {
        return $this->userEnquiryFormRepo->getAll($perPage);
    }

    public function createEnquiry(array $data)
    {
        return $this->userEnquiryFormRepo->create($data);
    }

    public function updateEnquiry($id, array $data)
    {
        return $this->userEnquiryFormRepo->update($id, $data);
    }

    public function deleteEnquiry($id)
    {
        return $this->userEnquiryFormRepo->delete($id);
    }
}
