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
              <label for="image">Banner image:</label>
              @if (!is_null($node->file_id))
                <div v-bind:class="{ 'd-none': imageAdded }">
                  <img width="200" height="100" src="{{ asset('storage/' . $node->file->filepath) }}" />

                </div>
                <div v-bind:class="{ 'd-none': imageAdded }"><a @click="imageAdded = !imageAdded;" class="change-image" href="#">Change image.</a></div>
                <div v-bind:class="{ 'd-none': !imageAdded }"><a @click="imageAdded = !imageAdded;" class="change-image" href="#">Show image.</a></div>
              @endif
              <div v-bind:class="{ 'd-none': !imageAdded }">
                <input type="file" name="image" id="image" />
              </div>
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
            <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
              <label for="node-type-id">Type:</label>
              <select name="node_type_id" id="node-type-id">
                <option value="">-- Select a type --</option>
                @foreach ($types as $type)
                  <option value="{{ $type->id }}" {{ isset($node) && $node->node_type_id === $type->id ? 'selected' : '' }}>{{ $type->display_name }}</option>
                @endforeach
              </select>
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
      }
    );
  </script>
@endsection
