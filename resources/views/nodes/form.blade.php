@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card card-default">
        <div class="card-header">{{ $action }} node.</div>
        <div class="card-body">
          @if (session('status'))
            <div class="alert alert-success">
              {{ session('status') }}
            </div>
          @endif
          <form class="form" method="POST" action="{{ route('nodes.store') }}">
            {{ csrf_field() }}
            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
              @if (isset($node))
                <input type="hidden" name="id" value="{{ $node->id }}" />
              @endif
              <label for="title">Title:</label>
              <input type="text" id="title" name="title" value="{{ isset($node) ? $node->title : '' }}"/>
              @if ($errors->has('title'))
                <span class="help-block">
                  <strong>{{ $errors->first('title') }}</strong>
                </span>
              @endif
            </div>
            <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
              <label for="body">Body:</label>
              <textarea rows="4" cols="50" name="body" id="body">
                {{ isset($node) ? $node->body : '' }}
              </textarea>
              @if ($errors->has('body'))
                <span class="help-block">
                  <strong>{{ $errors->first('body') }}</strong>
                </span>
              @endif
            </div>
            <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
              <label for="node-type-id">Type:</label>
              <select name="node_type_id" id="node-type-id">
                <option value="">-- Select a type --</option>
                @foreach ($types as $type)
                  <option value="{{ $type->id }}">{{ $type->display_name }}</option>
                @endforeach
              </select>
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
