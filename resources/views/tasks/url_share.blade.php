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
              <input type="text" disabled="disabled" class="form-control" name="title" id="title"
                      value="{{ old('title', $task->title) }}" />
            </div>
            <div class="form-group">
              <label for="status">状態</label>
              <select name="status" disabled="disabled" id="status" class="form-control">
                @foreach(\App\Task::STATUS as $key => $val)
                  <option
                      value="{{ $key }}"
                      {{ $key == old('status', $task->status) ? 'selected' : '' }}
                  >
                    {{ $val['label'] }}
                  </option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="due_date">期限</label>
              <input type="text" class="form-control" name="due_date" disabled="disabled" id="due_date"
                      value="{{ old('due_date', $task->formatted_due_date) }}" />
            </div>
          </div>
        </nav>
      </div>
    </div>
  </div>
@endsection
