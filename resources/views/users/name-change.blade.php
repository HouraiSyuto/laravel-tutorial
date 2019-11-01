@extends('layout')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col col-md-offset-3 col-md-6">
        <nav class="panel panel-default">
          <div class="panel-heading">ユーザ名変更</div>
          <div class="panel-body">
            @if($errors->any())
              <div class="alert alert-danger">
                @foreach($errors->all() as $message)
                  <p>{{ $message }}</p>
                @endforeach
              </div>
            @endif
            <form action="{{ route('users.name-change')}}" method="POST">
              @csrf
              <input type="hidden" name="id" value="{{ Auth::user()->name }}">
              <div class="form-group">
                <label for="name">ユーザ名</label>
                @foreach($items as $item)
                  <input type="text" disabled="disabled" class="form-control" id="name" name="name" value="{{ $item->name }}" />
                @endforeach
              </div>
              <div class="form-group">
                <label for="changename">新しいユーザ名</label>
                <input type="text" class="form-control" id="changename" name="changename" />
              </div>
              <div class="text-right">
                <button type="submit" class="btn btn-primary">送信</button>
              </div>
            </form>
          </div>
        </nav>
      </div>
    </div>
  </div>
@endsection
