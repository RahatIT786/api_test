<?php 

namespace App\Services\User;
use App\Repositories\User\UserDetailRepo;

class UserDetailService{

    protected $userDetailRepo;

    public function __construct(UserDetailRepo $userDetailRepo){
        $this->userDetailRepo = $userDetailRepo;
    }

    public function createUserDetail(array $data){
        return $this->userDetailRepo->createUserDetail($data);
    }

    public function getUserDetail(){
        return $this->userDetailRepo->getuserDetail();
    }

    public function getUserDetailForUpdate($id){
        return $this->userDetailRepo->getUserDetailForUpdate($id);
    }

    public function updateUserDetail(array $validated, $id){
        return $this->userDetailRepo->updateUserDetail($validated, $id);
    }
}