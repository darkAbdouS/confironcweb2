@extends('layouts.app')

@section('content')
  <h1 class="text-3xl font-bold text-gray-800 mb-8 border-b pb-2">📋 Speaker Requests</h1>

  @if($requests->isEmpty())
    <div class="text-center text-gray-500 mt-10">No pending requests at the moment.</div>
  @else
    <div class="grid gap-6">
      @foreach($requests as $speaker)
        <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition">
          <div class="flex justify-between items-start">
            <div>
              <h2 class="text-xl font-semibold text-blue-700">{{ $speaker->name }}</h2>
              <p class="text-sm text-gray-600">{{ $speaker->email }}</p>
              <p class="mt-2 text-gray-700">{{ $speaker->bio }}</p>
            </div>

            <div class="flex flex-col space-y-2">
              <form action="/admin/approve/{{ $speaker->id }}" method="POST">
                @csrf
                <button class="bg-green-500 hover:bg-green-600 text-white px-4 py-1 rounded">
                  ✅ Approve
                </button>
              </form>

              <a href="/admin/schedule/{{ $speaker->id }}"
                 class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-1 rounded text-center">
                📅 Schedule
              </a>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  @endif
@endsection
