@extends('layouts.app')

@section('content')
<h1 class="pb-3 text-center">Dashboard</h1>
<hr>
<div class="container d-flex flex-wrap gap-4 justify-content-start align-items-start mt-4">
  <div class="rounded-2xl overflow-hidden shadow-lg" style="min-width:320px; max-width:400px; flex: 0 1 350px;">
    <div class="px-6 py-4">
      <div class="font-bold text-xl mb-2 text-center">Users</div>
      <hr>
      @foreach($users as $user)
        <p class="text-gray-700 text-lg d-flex justify-between">
          {{ $user->email }} 
          <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-success">
            <i class="bi bi-vector-pen pr-1"></i>Change
          </a>
        </p>
      @endforeach
    </div>
  </div>
  <div class="rounded-2xl overflow-hidden shadow-lg" style="min-width:320px; max-width:400px; flex: 0 1 350px;">
    <div class="px-6 py-4">
      <div class="font-bold text-xl mb-2 text-center">Categories</div>
      <hr>
      <p class="text-gray-700 text-lg d-flex justify-between">
        Entrepreneurships 
        <a href="{{ route('entrepreneurship.create') }}" class="btn btn-sm btn-success">
          <i class="bi bi-plus-circle pr-1"></i>Add
        </a>
      </p>
      <p class="text-gray-700 text-lg d-flex justify-between">
        Events 
        <a href="{{ route('events.create') }}" class="btn btn-sm btn-success">
          <i class="bi bi-plus-circle pr-1"></i>Add
        </a>
      </p>
      <p class="text-gray-700 text-lg d-flex justify-between">
        Hackathons
        <a href="{{ route('hackathons.create') }}" class="btn btn-sm btn-success">
          <i class="bi bi-plus-circle pr-1"></i>Add
        </a>
      </p>
      <p class="text-gray-700 text-lg d-flex justify-between">
        Jobs 
        <a href="{{ route('jobs.create') }}" class="btn btn-sm btn-success">
          <i class="bi bi-plus-circle pr-1"></i>Add
        </a>
      </p>
      <p class="text-gray-700 text-lg d-flex justify-between">
        Media Categories 
        <a href="{{ route('mediaCategories.create') }}" class="btn btn-sm btn-success">
          <i class="bi bi-plus-circle pr-1"></i>Add
        </a>
      </p>
      <p class="text-gray-700 text-lg d-flex justify-between">
        Media Items
        <a href="{{ route('mediaItems.create') }}" class="btn btn-sm btn-success">
          <i class="bi bi-plus-circle pr-1"></i>Add
        </a>
      </p>
      <p class="text-gray-700 text-lg d-flex justify-between">
        News
        <a href="{{ route('news.create') }}" class="btn btn-sm btn-success">
          <i class="bi bi-plus-circle pr-1"></i>Add
        </a>
      </p>
      <p class="text-gray-700 text-lg d-flex justify-between">
        Sliders
        <a href="{{ route('sliders.create') }}" class="btn btn-sm btn-success">
          <i class="bi bi-plus-circle pr-1"></i>Add
        </a>
      </p>
      <p class="text-gray-700 text-lg d-flex justify-between">
        Workshops
        <a href="{{ route('workshops.create') }}" class="btn btn-sm btn-success">
          <i class="bi bi-plus-circle pr-1"></i>Add
        </a>
      </p>
    </div>
  </div>
  <div style="min-width:340px; max-width:400px; flex: 1 1 350px; max-height: 600px; overflow-y: auto;">
    @if ($timeline->count())
      <ol
        class="relative space-y-8 before:absolute before:-ml-px before:h-full before:w-0.5 before:rounded-full before:bg-gray-200"
      >
        @foreach ($timeline as $data)
          <li class="relative -ms-1.5 flex items-start gap-4">
            <span class="size-3 shrink-0 rounded-full bg-blue-600"></span>

            <div class="-mt-2">
              <time class="text-xs/none font-medium text-gray-700">{{ $data->created_at->format('d-m-Y h:m:s') }}</time>

              <h3 class="text-lg font-bold text-gray-900">{{ $data->event }}</h3>

              <p class="mt-0.5 text-sm text-gray-700">
                {{ $data->operation }}
              </p>
            </div>
          </li>
        @endforeach
      </ol>
    @else
      <h4 class="text-center">No timeline records</h4>
    @endif
  </div>
</div>
@endsection