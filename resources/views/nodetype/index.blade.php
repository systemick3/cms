@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card card-default">
        <div class="card-header">Node Types</div>
        <div class="card-body">
          @if (session('status'))
            <div class="alert alert-success">
              {{ session('status') }}
            </div>
          @endif
          <div><a href="{{ route('nodetypes.create') }}">Add new node type.</a></span></div>
          @foreach ($types as $type)
            <div><span>{{ $type->display_name }}</span><span><a href="{{ route('nodetypes.edit', $type->id) }}">Edit.</a></span></div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
