@extends('super_admin.layouts.guest')

@section('contents')
<form
    method="POST"
    class="md-float-material form-material"
    aria-label="Login">
    @csrf

    <div class="text-center">
        <img src="{{ asset('images/logo.png') }}" alt="logo.png">
    </div>

    <div class="auth-box card">
        <div class="card-block">
            <div class="row m-b-20">
                <div class="col-md-12">
                    <h3 class="text-center">Login</h3>
                </div>
            </div>

            @if ($errors->all())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </ul>
            @endif

            <div class="form-group form-primary">
                <input id="email" type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                <span class="form-bar"></span>

                <label for="email" class="float-label">E-Mail Address</label>
            </div>

            <div class="form-group form-primary">
                <input id="password" type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                <span class="form-bar"></span>

                <label for="password" class="float-label">Password</label>
            </div>

            <div class="row m-t-25 text-left">
                <div class="col-12">
                    <div class="checkbox-fade fade-in-primary d-">
                        <label>
                            <input type="checkbox" value="1" name="remember" {{ old('remember') ? 'checked' : '' }}>

                            <span class="cr">
                                <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                            </span>

                            <span class="text-inverse">Remember</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="row m-t-30">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary btn-sm btn-block waves-effect waves-light text-center m-b-20">
                        Login
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
