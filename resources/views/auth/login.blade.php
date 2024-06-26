@extends('layouts.auth')

@section('content')
    <div class="login-box">
      <div class="login-logo">
        <!-- <img src="dist/img/acominlogoo.jpg" alt="" /> -->
        <h3>
        <b style="color:orange">ACCOMIS</b>
        </h3>
      </div>
      <!-- /.login-logo -->
      <div class="card">
        <div class="card-body login-card-body">
          <p class="login-box-msg">Sign in to start your session</p>

          <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="input-group mb-3">
              <input
                id="email"
                type="email"
                class="form-control @error('email') is-invalid @enderror"
                name="email"
                value="{{ old('email') }}"
                required
                autocomplete="email"
                autofocus
                placeholder="Email"
              />
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
              @error('email')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            <div class="input-group mb-3">
              <input
                id="password"
                placeholder="Password"
                type="password"
                class="form-control @error('password') is-invalid @enderror"
                name="password"
                required
                autocomplete="current-password"
              />
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
              @error('password')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            <div class="row">
              <div class="col-8">
                <div class="icheck-primary">
                  <input type="checkbox" name="remember" id="remember" {{
                  old('remember') ? 'checked' : '' }}>

                  <label for="remember"> {{ __('Remember Me') }} </label>
                </div>
              </div>
              <div class="col-4">
                <button type="submit" class="btn btn-primary">
                  {{ __('Sign in') }}
                </button>
              </div>
            </div>


          </form>

          <!-- /.social-auth-links -->
          @if (Route::has('password.request'))
          <p class="mb-1">
            <a class="btn btn-link" href="{{ route('password.request') }}">
              {{ __('Forgot Your Password?') }}
            </a>
          </p>
          @endif

        </div>
        <!-- /.login-card-body -->
      </div>
    </div>
    <!-- /.login-box -->
@endsection
