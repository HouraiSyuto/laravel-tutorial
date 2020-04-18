<?php

namespace App\Repositories\Folder;

interface FolderRepositoryInterface
{
    /**
     * シェアタスクのフォルダを取得
     *
     * @param $folder_id
     * @return mixed
     */
    public function getFolderCreator($folder_id);

}