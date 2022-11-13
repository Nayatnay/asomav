@extends('layouts.acceso')

@section('content')

<div class="content_imgcard">

    <div class="imgfondo">
        
    </div>
    <div class="card">
        <div class="card-header">
            Iniciar sesión
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="row_mb-3">
                    <label for="email" class="col-md-4 col-form-label text-md-end">Dirección de Email</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="row_mb-3">
                    <label for="password" class="col-md-4 col-form-label text-md-end">Contraseña</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="row_mb-3">
                    <div class="col-md-6 offset-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" value="{{ old('remember') ? 'checked' : '' }}">

                            <label class="form-check-label" for="remember">
                                Recuérdame
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row_mb-0">
                    <div class="col-md-8-offset-md-4">
                        <button type="submit" class="btn-primary">
                            Iniciar sesión
                        </button>
                        @if (Route::has('password.request'))
                        <a class="btn-link" href="{{ route('password.request') }}">
                            ¿Has olvidado tu contraseña?
                        </a>
                        @endif

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection