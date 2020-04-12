<?php

namespace App\Repositories\Folder;

use App\Folder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class FolderRepository implements FolderRepositoryInterface
{
    protected $folder;
    
    /**
    * @param Folder $folder
    */
    public function __construct(Folder $folder)
    {
        $this->folder = $folder;
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

}