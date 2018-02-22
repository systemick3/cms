@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card card-default">
        <div class="card-header">Node deletion.</div>
        <div class="card-body">
          <div>
            You are about to delete the node {{ $node->display_name }}. Are you sure you want to delete? This action cannot be undone.
          </div>
          <div>
            <a href="{{ route('nodes.delete_confirmed', $node->id) }}"><button type="button">Delete!</button></a>
          </div>
          <div>
            <a href="{{ route('nodes.list') }}">Cancel</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
