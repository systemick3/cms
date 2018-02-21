@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card card-default">
        <div class="card-header">{{ $node->title }}</div>
        <div class="card-body">
          @if (!is_null($node->file_id))
            <div>
              <img class="img-fluid" src="{{ asset('storage/' . $node->file->filepath) }}" />
            </div>
          @endif
          <div>
            {!! $node->body !!}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
