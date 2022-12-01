@extends('layouts.main')

@section('title')
  {{ $title = "Login" }}
@endsection

@section('hero')

    <div class="container">
        <div class="row">
            <div class="col-xl-4">
                <form class="need-validation" action="{{ route('login')}}" method="POST">
                    @csrf
                    <h2 data-aos="fade-up" data-aos-delay="200">Login</h2>
                    <br>
                    <div class="col-12 pt-3" data-aos="fade-up" data-aos-delay="200">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="E-mail" required autocomplete="off" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-12 pt-3" data-aos="fade-up" data-aos-delay="200">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="d-flex pt-3" data-aos="fade-up" data-aos-delay="200" style="justify-content:flex-end">
                        <button class="w-25 btn btn-lg btn-primary mb-3" type="submit" style="font-size: 12px">Submit</button>
                    </div>
                </form>
                <div class="d-flex pt-3" data-aos="fade-up" data-aos-delay="200"  style="justify-content:flex-end">
                    <p> <b> <span style="color:white"> Don't have an account yet? </span> <a href="/register"> Register Now</a></b></p>
                </div>
            </div>
        </div>
    </div>

@endsection