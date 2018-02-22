@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card card-default">
        <div class="card-header">Nodes</div>
        <div class="card-body">
          @if (session('status'))
            <div class="alert alert-success">
              {{ session('status') }}
            </div>
          @endif
          <div><a href="{{ route('nodes.create') }}">Add new node.</a></span></div>
          @if (empty($nodes))
            <div>No nodes currently exist.</div>
          @else
            @foreach ($nodes as $node)
              <div>
                <span>{{ $node->title }}</span>
                <span><a href="{{ route('nodes.edit', $node->id) }}">Edit.</a></span>
                <span><a href="{{ route('nodes.slug', $node->slug) }}">View.</a></span>
                <span><a href="{{ route('nodes.status', $node->id) }}">{{ $node->status ? 'Disable' : 'Enable' }}</a></span>
              </div>
            @endforeach
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
