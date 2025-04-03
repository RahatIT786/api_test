<?php

namespace App\Services\User;
use App\Repositories\User\UserPaymentRepo;

class UserPaymentService{

    protected $userPaymentRepo;

    public function __construct(UserPaymentRepo $userPaymentRepo){
        $this->userPaymentRepo = $userPaymentRepo;
    }

    public function createUserPayment(array $data){
        return $this->userPaymentRepo->createUserPayment($data);
    }

    public function getUserPayment(){
        return $this->userPaymentRepo->getUserPayment();
    }

    public function getUserPaymentsByUserId($user_id){
        return $this->userPaymentRepo->getUserPaymentsByUserId($user_id);
    }
}