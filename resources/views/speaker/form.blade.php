@extends('layouts.app')

@section('content')
  <h1 class="text-3xl font-bold text-gray-800 mb-6">📢 Apply to Be a Speaker</h1>

  <form method="POST" action="/become-speaker" class="space-y-4 bg-white p-6 rounded-lg shadow">
    @csrf

    <input name="name" placeholder="Full Name" class="w-full border p-2 rounded" required>
    <input name="email" type="email" placeholder="Email Address" class="w-full border p-2 rounded" required>
    <textarea name="bio" rows="4" placeholder="Your bio..." class="w-full border p-2 rounded"></textarea>

    <button class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded">
      Submit Request
    </button>
  </form>
@endsection
