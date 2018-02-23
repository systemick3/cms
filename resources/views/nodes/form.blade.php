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
          <form class="form" method="POST" action="{{ route('nodes.store') }}" enctype="multipart/form-data">
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
            <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
              <image-input
                :initial-image="'{{ !empty($node) && !is_null($node->file_id) }}'"
                :file-id="'{{ !empty($node) && !is_null($node->file_id) ? $node->file_id : '' }}'"
                :image-url="'{{ !empty($node) && !is_null($node->file_id) ? asset('storage/' . $node->file->filepath) : '' }}'"
                >
              </image-edit>
              @if ($errors->has('image'))
                <span class="help-block">
                  <strong>{{ $errors->first('image') }}</strong>
                </span>
              @endif
            </div>
            <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
              <label for="node-body">Body:</label>
              <textarea rows="10" cols="80" name="body" id="node-body">
                {{ isset($node) ? $node->body : '' }}
              </textarea>
              @if ($errors->has('body'))
                <span class="help-block">
                  <strong>{{ $errors->first('body') }}</strong>
                </span>
              @endif
            </div>
            <div class="form-group{{ $errors->has('node_type_id') ? ' has-error' : '' }}">
              <label for="node-type-id">Type:</label>
              <select name="node_type_id" id="node-type-id">
                <option value="">-- Select a type --</option>
                @foreach ($types as $type)
                  <option value="{{ $type->id }}" {{ isset($node) && $node->node_type_id === $type->id ? 'selected' : '' }}>{{ $type->display_name }}</option>
                @endforeach
              </select>
              @if ($errors->has('node_type_id'))
                <span class="help-block">
                  <strong>{{ $errors->first('node_type_id') }}</strong>
                </span>
              @endif
            </div>
            @if (isset($node))
              <div class="form-group">
                URL: {{ $node->slug }}
              </div>
            @endif
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

@section('footerscripts')
  @parent
  @foreach ($scripts as $script)
    <script src="{{ asset($script) }}"></script>
  @endforeach
  <script>
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace(
      'node-body',
      {
        removeButtons: 'Source',

        filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
        filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
        filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
        filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
      }
    );
  </script>
@endsection
