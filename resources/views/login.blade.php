@extends('layout')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-3">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Login</div>
                @if (session('error'))
                <span class="alert alert-danger">
                    <strong>{{ session('error') }}</strong>
                </span>
                @endif
                <div class="card-body">
                    <form method="POST">
                        @csrf

                        

                        <div class="mb-3">
                            <label for="email" class="form-label">E-Mail Address</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autofocus>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">
                            Login
                        </button>
                        <a href="/register" class="btn btn-secondary">
                            No account?
                        </a>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection