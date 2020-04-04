@extends('layout')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col col-md-offset-3 col-md-6">
        <nav class="panel panel-default">
          <div class="panel-heading">タスク詳細</div>
          <div class="panel-body">
            <div class="form-group">
              <label for="title">タイトル</label>
              <p>{{ $task->title }}</p>
            </div>
            <div class="form-group">
              <label for="status">状態</label><br>
              <p class="label {{ $task->status_class }}">{{ $task->status_label }}</p>
            </div>
            <div class="form-group">
              <label for="due_date">期限</label>
              <p>{{ $task->formatted_due_date }}</p>
            </div>
            <div class="form-group">
              <label for="details">詳細</label>
              <p>{{ $task->details }}</p>
            </div>
            <div class="form-group">
              <label for="image_url">画像</label>
              <br>
              <img src="{{ $task->image_url }}" width="300" height="300" >
            </div>
            <div class="form-group">
              <td>
              <a href="{{ route('tasks.url', ['id' => $task->folder_id, 'task_id' => $task->id]) }}">
                シェア
              </a>
              </td>
              <td>
                <a href="{{ route('tasks.edit', ['id' => $task->folder_id, 'task_id' => $task->id]) }}">
                  編集
                </a>
              </td>
            </div>
            <div class="text-right">
              <a href="{{ route('home') }}">
                <button type="button" class="btn btn-primary">戻る</button>
              </a>
            </div>
          </div>
        </nav>
      </div>
    </div>
  </div>
@endsection
