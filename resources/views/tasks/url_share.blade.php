@extends('layout')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col col-md-offset-3 col-md-6">
        <nav class="panel panel-default">
          <div class="panel-heading">タスクをシェアする</div>
          <div class="panel-body">              
            <div class="form-group">
              <label for="url">URL</label>
              <div class="form-control">
                <a href="{{ route('tasks.share', ['share_url' => $task->share_url]) }}" >
                  {{ route('tasks.share', ['share_url' => $task->share_url]) }}
                </a>
              </div>
            </div>
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
              <label for="s3_object_url">画像</label>
              <br>
              <img src="{{ $task->s3_object_url }}" width="300" height="300" >
            </div>
          </div>
        </nav>
      </div>
    </div>
  </div>
@endsection
