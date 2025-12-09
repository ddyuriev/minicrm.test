@extends('layouts.admin')

@section('content')

    <form method="POST" action="{{ route('login') }}" class="w-25 mx-auto mt-5">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="email" required>
            @error('email')
            <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Пароль</label>
            <input type="password" name="password" class="form-control" id="password" required>
            @error('password')
            <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="btn btn-primary">Войти</button>
    </form>

@endsection
