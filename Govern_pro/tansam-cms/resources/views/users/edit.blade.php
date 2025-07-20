@extends('layouts.app')

@section('content')

<form method="POST" action="{{ route('users.update',$user->id) }}">
    @csrf
    <div class="container">
        <div class="mb-3">
            <label for="username" class="form-label">Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" autofocus>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password (Leave blank to keep the current password)</label>
            <input type="password" name="password" class="form-control">
        </div>
        @if($errors->any())
            <div class="alert alert-danger">{{ $errors->first() }}</div>
        @endif
        <button type="submit" class="btn btn-primary w-100">Update</button>
    </div>
</form>

@endsection