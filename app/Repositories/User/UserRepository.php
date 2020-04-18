<?php

namespace App\Repositories\User;

use App\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class UserRepository implements UserRepositoryInterface
{
    protected $user;
    
    /**
    * @param User $user
    */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * シェアタスクのnameを取得
     *
     * @param $user_id
     * @return mixed
     */
    public function getUserCreator($user_id){
        return DB::table('users')->where('id',$user_id)->first();
    }

}