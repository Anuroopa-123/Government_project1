@extends('layouts.app')

@section('content')

<form method="POST" action="{{ route('users.store') }}">
    @csrf
    <div class="container">
        <div class="mb-3">
            <label for="username" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required autofocus>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        @if($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif
        <button type="submit" class="btn btn-primary w-100">Create</button>
    </div>
</form>

@endsection