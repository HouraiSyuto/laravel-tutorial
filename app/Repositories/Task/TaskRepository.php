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
}