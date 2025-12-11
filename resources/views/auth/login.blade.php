<!doctype html>
<html lang="en">
  <!-- [Head] start -->
  <head>
    @include('layouts.head-page-meta', ['title' => 'Login'])
    @include('layouts.head-css')
  </head>
  <!-- [Head] end -->
  <!-- [Body] Start -->
  <body>
    @include('layouts.loader')
    <div class="auth-main relative">
      <div class="auth-wrapper v1 flex items-center w-full h-full min-h-screen">
        <div class="auth-form flex items-center justify-center grow flex-col min-h-screen relative p-6 ">
          <div class="w-full max-w-[350px] relative">
            <div class="auth-bg ">
              <span class="absolute top-[-100px] right-[-100px] w-[300px] h-[300px] block rounded-full bg-theme-bg-1 animate-[floating_7s_infinite]"></span>
              <span class="absolute top-[150px] right-[-150px] w-5 h-5 block rounded-full bg-primary-500 animate-[floating_9s_infinite]"></span>
              <span class="absolute left-[-150px] bottom-[150px] w-5 h-5 block rounded-full bg-theme-bg-1 animate-[floating_7s_infinite]"></span>
              <span class="absolute left-[-100px] bottom-[-100px] w-[300px] h-[300px] block rounded-full bg-theme-bg-2 animate-[floating_9s_infinite]"></span>
            </div>
            <div class="card sm:my-12  w-full shadow-none">
              <div class="card-body !p-10">
                <div class="text-center mb-8">
                  <a href="#"><img src="{{ asset('assets/images/logo-dark.svg') }}" alt="img" class="mx-auto auth-logo"/></a>
                </div>
                <h4 class="text-center font-medium mb-4">Login</h4>
                
                @if ($errors->any())
                  <div class="alert alert-danger mb-4">
                    <ul class="mb-0">
                      @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                  </div>
                @endif

                @if (session('success'))
                  <div class="alert alert-success mb-4">
                    {{ session('success') }}
                  </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                  @csrf
                  <div class="mb-3">
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="floatingInput" placeholder="Email Address" value="{{ old('email') }}" required />
                    @error('email')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="mb-4">
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="floatingInput1" placeholder="Password" required />
                    @error('password')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="flex mt-1 justify-between items-center flex-wrap">
                    <div class="form-check">
                      <input class="form-check-input input-primary" type="checkbox" name="remember" id="customCheckc1" />
                      <label class="form-check-label text-muted" for="customCheckc1">Remember me?</label>
                    </div>
                    <h6 class="font-normal text-primary-500 mb-0">
                      <a href="#"> Forgot Password? </a>
                    </h6>
                  </div>
                  <div class="mt-4 text-center">
                    <button type="submit" class="btn btn-primary mx-auto shadow-2xl w-100">Login</button>
                  </div>
                </form>
                
                <div class="mt-3 text-center">
                  <a href="{{ route('skip-login') }}" class="btn btn-outline-secondary w-100">
                    <i data-feather="eye" class="me-1"></i> Skip Login (Guest View)
                  </a>
                </div>
                
                <div class="flex justify-between items-end flex-wrap mt-4">
                  <h6 class="font-medium mb-0">Don't have an Account?</h6>
                  <a href="{{ route('register') }}" class="text-primary-500">Create Account</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- [ Main Content ] end -->
    @include('layouts.footer-js')
  </body>
  <!-- [Body] end -->
</html>

