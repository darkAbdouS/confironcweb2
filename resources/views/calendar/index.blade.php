@extends('layouts.app')

@section('content')
  <h1 class="text-3xl font-bold mb-6 text-gray-800">🗓 Conference Schedule</h1>

  <div class="space-y-4">
    @forelse ($speakers as $speaker)
      <div class="bg-white p-6 shadow rounded border-l-4 border-blue-500">
        <h2 class="text-xl font-semibold">{{ $speaker->name }}</h2>
        <p class="text-gray-600">{{ $speaker->bio }}</p>
        <p class="mt-2 font-semibold text-blue-600">
          {{ \Carbon\Carbon::parse($speaker->schedule_time)->format('F j, Y g:i A') }}
        </p>
      </div>
    @empty
      <div class="text-center text-gray-500">No scheduled speakers yet.</div>
    @endforelse
  </div>
@endsection
