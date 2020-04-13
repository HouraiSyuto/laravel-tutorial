<?php

namespace App\Http\Controllers;

use App\Repositories\Task\TaskRepositoryInterface;
use App\Repositories\Folder\FolderRepositoryInterface;
use App\Repositories\User\UserRepositoryInterface;

use App\Http\Requests\CreateTask;
use App\Http\Requests\EditTask;
use App\Task;
use App\Folder;
use App\User;
use Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function __construct(TaskRepositoryInterface $task_repository, FolderRepositoryInterface $folder_repository, UserRepositoryInterface $user_repository)
   {
      $this->task_repository = $task_repository;
      $this->folder_repository = $folder_repository;
      $this->user_repository = $user_repository;
   }

    /**
     * タスク一覧
     * @param Folder $folder
     * @return \Illuminate\View\View
     */
    public function index(Folder $folder)
    {
        // ユーザーのフォルダを取得する
        $folders = Auth::user()->folders()->get();

        // 選ばれたフォルダに紐づくタスクを取得する
        $tasks = $folder->tasks()->get();

        return view('tasks/index', [
            'folders' => $folders,
            'current_folder_id' => $folder->id,
            'tasks' => $tasks,
        ]);
    }

    /**
     * タスク作成フォーム
     * @param Folder $folder
     * @return \Illuminate\View\View
     */
    public function showCreateForm(Folder $folder)
    {
        return view('tasks/create', [
            'folder_id' => $folder->id,
        ]);
    }

    /**
     * タスク作成
     * @param Folder $folder
     * @param CreateTask $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Folder $folder, CreateTask $request)
    {
        $task = new Task();
        $task->title = $request->title;
        $task->due_date = $request->due_date;
        $task->share_url = uniqid();
        $task->details = $request->details;
        $task->image_url = $this->uploadImage($task, $request);
        if (isset($task->image_url)) {
            $folder->tasks()->save($task);
        }

        return redirect()->route('tasks.index', [
            'id' => $folder->id,
        ]);
    }

    /**
     * タスク編集フォーム
     * @param Folder $folder
     * @param Task $task
     * @return \Illuminate\View\View
     */
    public function showEditForm(Folder $folder, Task $task)
    {
        $this->checkRelation($folder, $task);

        return view('tasks/edit', [
            'task' => $task,
        ]);
    }

    /**
     * タスク編集
     * @param Folder $folder
     * @param Task $task
     * @param EditTask $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit(Folder $folder, Task $task, EditTask $request)
    {
        $this->checkRelation($folder, $task);

        $task->title = $request->title;
        $task->status = $request->status;
        $task->due_date = $request->due_date;
        $task->details = $request->details;
        $task->image_url = $this->uploadImage($task, $request);
        $task->save();

        return redirect()->route('tasks.index', [
            'id' => $task->folder_id,
        ]);
    }

    /**
     * フォルダとタスクの関連性があるか調べる
     * @param Folder $folder
     * @param Task $task
     */
    private function checkRelation(Folder $folder, Task $task)
    {
        if ($folder->id !== $task->folder_id) {
            abort(404);
        }
    }

    /**
     * タスクURLシェアフォーム
     * @param Folder $folder
     * @param Task $task
     * @return \Illuminate\View\View
     */
    public function showUrlShareForm(Folder $folder, Task $task)
    {
        $this->checkRelation($folder, $task);

        return view('tasks/url_share', [
            'task' => $task,
        ]);
    }

    /**
     * タスクシェアフォーム
     * @param Folder $folder
     * @param Task $task
     * @return \Illuminate\View\View
     */
    public function showShareForm(Request $request)
    {
        $task = $this->task_repository->getFirstRecordByShareUrl($request->share_url);
        
        if (is_null($task)) {
            abort(404);
        }

        $folder = $this->folder_repository->getFolderCreator($task->folder_id);
        $user = $this->user_repository->getTaskCreator($folder->user_id);


        if(Auth::check() && $folder->user_id === Auth::user()->id){
            return view('tasks/details', [
                'task' => $task,
            ]);
        }else{
            return view('tasks/share', [
                'task' => $task,
            ]);
        }  
    }

    /**
     * 画像アップロード
     */
    private function uploadImage($task, $request)
    {
        if ($request->has('file')) {
            $file = $request->file('file');
            $path = Storage::disk('s3')->putFile('/public', $file, 'public');
            if(empty($path)){
                throw new Exception('画像のアップロードに失敗しました。');
            }
            $image_url = Storage::disk('s3')->url($path);
        } else {
            $image_url = $task->image_url;
        }
        return $image_url;
    }
}
