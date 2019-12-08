@extends('layout')

@section('styles')
  @include('share.flatpickr.styles')
@endsection

@section('content')
  <div class="container">
    <div class="row">
      <div class="col col-md-offset-3 col-md-6">
        <nav class="panel panel-default">
          <div class="panel-heading">タスクシェア</div>
          <div class="panel-body">
          @if($errors->any())
              <div class="alert alert-danger">
                @foreach($errors->all() as $message)
                  <p>{{ $message }}</p>
                @endforeach
              </div>
            @endif
            <form
                action="{{ route('tasks.share', ['id' => $task->folder_id, 'task_id' => $task->id]) }}"
                method="GET"
            >
              @csrf

              <div class="form-group">
                <label for="title">タイトル</label>
                <p>{{ old('title', $task->title) }}</p>
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
            </form>
          </div>
        </nav>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
  @include('share.flatpickr.scripts')
  @endsection
