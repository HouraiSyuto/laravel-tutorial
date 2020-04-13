<?php

namespace App\Repositories\User;

interface UserRepositoryInterface
{
    /**
     * シェアタスクのnameを取得
     *
     * @param $user_id
     * @return mixed
     */
    public function getTaskCreator($user_id);

}