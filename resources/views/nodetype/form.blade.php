@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card card-default">
        <div class="card-header">{{ $action }} node type</div>
        <div class="card-body">
          @if (session('status'))
            <div class="alert alert-success">
              {{ session('status') }}
            </div>
          @endif
          <form class="form-horizontal" method="POST" action="{{ route('nodetypes.store') }}">
            {{ csrf_field() }}
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
              <label for="display-name">Name:</label>
              @if (isset($type))
                <input type="hidden" name="id" value="{{ $type->id }}" />
              @endif
              <input type="text" id="display-name" name="display_name" value="{{ isset($type) ? $type->display_name : '' }}"/>
              @if ($errors->has('display_name'))
                <span class="help-block">
                  <strong>{{ $errors->first('image') }}</strong>
                </span>
              @endif
            </div>
            <div class="form-group">
              <input type="submit" value="Save"/>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
