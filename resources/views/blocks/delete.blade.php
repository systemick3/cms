@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card card-default">
        <div class="card-header">Block deletion.</div>
        <div class="card-body">
          <div>
            You are about to delete the block {{ $block->display_name }}. Are you sure you want to delete? This action cannot be undone.
          </div>
          <div>
            <a href="{{ route('blocks.delete_confirmed', $block->id) }}"><button type="button">Delete!</button></a>
          </div>
          <div>
            <a href="{{ route('blocks.index') }}">Cancel</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
