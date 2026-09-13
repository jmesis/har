@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
              

                <div class="card-body">
                  <div class="card-body">
                    <!-- Logo -->
                    <div class="app-brand justify-content-center">
                       <a href="index.php" class="app-logo-syscomt"></a>
                        <span class="app-brand-text demo mb-0 fw-bold">HAR</span>
                      </a>
                    </div>
                    <!-- /Logo -->

                  <span class="mb-0 app-brand-text fw-bold">Crear una cuenta 🚀</span>
              <p class="mb-4">Complete los siguientes campos</p>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-3">
                          <label for="username" class="form-label">Usuario</label>

                            <div class="mb-3">
                                <input id="username" 
                                type="text" class="form-control @error('username') is-invalid @enderror" 
                                name="username" value="{{ old('username') }}" 
                                required 
                                autocomplete="username" 
                                autofocus
                                >

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                          <label for="name" class="form-label">Nombre</label>

                            <div class="mb-3">
                                <input id="name" 
                                type="text" 
                                class="form-control @error('name') is-invalid @enderror" 
                                name="name" value="{{ old('name') }}" 
                                required 
                                autocomplete="name" 
                                autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> --}}

                        
                          <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>

                            <div class="mb-3">
                                <input id="password" 
                                type="password" 
                                class="form-control @error('password') is-invalid @enderror" 
                                name="password" 
                                required autocomplete="new-password"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                >

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 form-password-toggle">
                          <label class="form-label" for="password">Repetir Contraseña</label>

                          <div class="input-group input-group-merge">
                                <input 
                                id="password-confirm" 
                                type="password" 
                                class="form-control" 
                                name="password_confirmation" 
                                required 
                                autocomplete="new-password"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;">
                                <span class="input-group-text cursor-pointer"></span>

                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary d-grid w-100">
                                    {{ __('Register') }}
                                </button>
                            </div>
                            <p class="text-center">
                              <span>Ya tienes una Cuenta?</span>
                              <a href="{{ route('login') }}">
                                <span><b>Acceder al sistema.</b></span>
                              </a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>


             <!-- Content -->

    
  
        </div>
    </div>
</div>
@endsection
