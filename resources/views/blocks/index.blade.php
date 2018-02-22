@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card card-default">
        <div class="card-header">Blocks</div>
        <div class="card-body">
          @if (session('status'))
            <div class="alert alert-success">
              {{ session('status') }}
            </div>
          @endif
          <div><a href="{{ route('blocks.create') }}">Add new block.</a></span></div>
          @if (empty($blocks))
            <div>No blocks currently exist.</div>
          @else
            @foreach ($blocks as $block)
              <div>
                <span>{{ $block->display_name }}</span>
                @if (!$block->in_code)
                  <span><a href="{{ route('blocks.edit', $block->id) }}">Edit.</a></span>
                  <span><a href="{{ route('blocks.status', $block->id) }}">{{ $block->status ? 'Disable' : 'Enable' }}</a></span>
                  <span><a href="{{ route('blocks.delete', $block->id) }}">Delete</a></span>
                @endif
              </div>
            @endforeach
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
