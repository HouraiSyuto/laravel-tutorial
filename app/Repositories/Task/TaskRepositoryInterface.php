<?php

namespace App\Repositories\Task;

interface TaskRepositoryInterface
{
    /**
     * シェアタスクを1レコード取得
     *
     * @param $task
     * @return mixed
     */
    public function getFirstRecordByShareTask($task);
}