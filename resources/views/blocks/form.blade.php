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
          <form class="form" method="POST" action="{{ route('blocks.store') }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group{{ $errors->has('display_name') ? ' has-error' : '' }}">
              @if (isset($block))
                <input type="hidden" name="id" value="{{ $block->id }}" />
              @endif
              <label for="display-name">Name:</label>
              <input type="text" id="display-name" name="display_name" value="{{ isset($block) ? $block->display_name : '' }}"/>
              <div class="form-description">
                This is the name that will be displayed in the list of blocks in the adin section.
              </div>
              @if ($errors->has('display_name'))
                <span class="help-block">
                  <strong>{{ $errors->first('display_name') }}</strong>
                </span>
              @endif
            </div>
            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
              @if (isset($block))
                <input type="hidden" name="id" value="{{ $block->id }}" />
              @endif
              <label for="title">Title:</label>
              <input type="text" id="title" name="title" value="{{ isset($block) ? $block->title : '' }}"/>
              <div class="form-description">
                The block must have a title but this can be hidden on the blocks configuration page.
              </div>
              @if ($errors->has('title'))
                <span class="help-block">
                  <strong>{{ $errors->first('title') }}</strong>
                </span>
              @endif
            </div>
            <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
              <label for="block-body">Body:</label>
              <textarea rows="10" cols="80" name="body" id="block-body">
                {{ isset($block) ? $block->body : '' }}
              </textarea>
              @if ($errors->has('body'))
                <span class="help-block">
                  <strong>{{ $errors->first('body') }}</strong>
                </span>
              @endif
            </div>
            @if (isset($block))
              <div class="form-group">
                Machine name: {{ $block->machine_name }}
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
      'block-body',
      {
        removeButtons: 'Source',
      }
    );
  </script>
@endsection
