<?php

namespace App\Repositories\Task;

use App\Task;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class TaskRepository implements TaskRepositoryInterface
{
    protected $task;

    /**
    * @param Task $task
    */
    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    /**
     * シェアタスクで1レコードを取得
     *
     * @var $task
     * @return object
     */
    public function getFirstRecordByShareUrl($share_url)
    {
        return Task::where('share_url', $share_url)->first();
    }

    /**
     * シェアタスクのフォルダを取得
     *
     * @param $folder_id
     * @return mixed
     */
    public function getFolderCreator($folder_id){
        return DB::table('folders')->where('id',$folder_id)->first();
    }

    /**
     * シェアタスクのnameを取得
     *
     * @param $user_id
     * @return mixed
     */
    public function getTaskCreator($user_id){
        return DB::table('users')->where('id',$user_id)->first();
    }
}