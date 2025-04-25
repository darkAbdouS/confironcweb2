@extends('layouts.app')

@section('content')
  <h1 class="text-xl font-bold mb-4">Schedule Speaker</h1>

  <form method="POST" action="">
    @csrf
    <label class="block mb-2">Date & Time</label>
    <input type="datetime-local" name="schedule_time" class="border p-2 rounded w-full" required>
    <button class="mt-4 bg-blue-500 text-white px-4 py-2 rounded">Set Schedule</button>
  </form>
@endsection
