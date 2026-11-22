@extends('layouts.app')

@section('title', 'Log in')

@section('content')
    <h2>Log in</h2>

    <form method="POST" action="{{ route('login.store') }}">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email"
                   class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email') }}">
            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" id="password" class="form-control">
        </div>

        <button class="btn btn-primary">Log in</button>
    </form>
@endsection