@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
        


             <!-- Actualizacion TEMPLATE FREST -->
            <div class="container-xxl">
                <div class="authentication-wrapper authentication-basic container-p-y">
                  <div class="authentication-inner py-4">
                    <!-- Register -->
                    <div class="card">
                      <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center">
                          <a href="index.php" class="app-logo-syscomt"></a>
                            <span class="app-brand-text demo  mb-0 fw-bold">HAR</span>
                          
                          
                        </div>
                        
                        <!-- /Logo -->
                        <p></p>
                        <span><b> BIENVENIDOS A SYSCOMT! 👋</b></span>
                        <p class="mb-4">Por Favor inserte sus datos de acceso al sistema.</p>
                       
                        <form id="formAuthentication" class="mb-3" action="{{ route('login') }}" method="POST">
                            @csrf
                          <div class="mb-3">
                            <label for="email" class="form-label">Usuario</label>
                            <input
                              type="text"
                              class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}"
                              id="email"
                              name="username"
                              placeholder="Entre su Usuario"
                              value="{{ old('username') }}"
                              required 
                              autofocus
                            />
                                    @if ($errors->has('username'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                          </div>
                          <div class="mb-3 form-password-toggle">
                            <div class="d-flex justify-content-between">
                              <label class="form-label" for="password">Contraseña</label>
                              
                            </div>
                            <div class="input-group input-group-merge">
                              <input
                                type="password"
                                id="password"
                                class="form-control form-control-sm @error('password') is-invalid @enderror"
                                name="password"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                aria-describedby="password"
                                required autocomplete="current-password"
                              />
                             
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                              <span class="input-group-text cursor-pointer"></span>
                            </div>
                          </div>
                          <div class="mb-3">
                            
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Recordarme') }}
                                </label>
                            </div>
                          </div>
                          <div class="mb-3">
                            <button class="btn btn-primary d-grid w-100" type="submit">Iniciar Secci&oacute;n</button>
                            @if (Route::has('password.request'))
                            
                            @endif
                          </div>
                        </form>
          
                        <p class="text-center">
                          <span>Eres nuevo en la plataforma?</span>
                          <a href="{{ route('register') }}">
                            <span><b>Crear una cuenta.</b></span>
                          </a>
                        </p>
          
                        <div class="divider my-4">
                          <div class="divider-text"></div>
                        </div>
          
                        
                      </div>
                    </div>
                    <!-- /Register -->
                  </div>
              </div>
          
              <!-- / Content -->
        </div>
        </div>
       
    </div>

     <!-- Content -->

    
@endsection
