<?php

namespace App\Repositories\Task;

interface TaskRepositoryInterface
{
    /**
     * シェアタスクを1レコード取得
     *
     * @param $share_url
     * @return mixed
     */
    public function getFirstRecordByShareUrl($share_url);

    /**
     * シェアタスクのフォルダを取得
     *
     * @param $folder_id
     * @return mixed
     */
    public function getFolderCreator($folder_id);

    /**
     * シェアタスクのnameを取得
     *
     * @param $user_id
     * @return mixed
     */
    public function getTaskCreator($user_id);
}