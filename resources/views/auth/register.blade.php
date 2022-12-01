@extends('layouts.main')

@section('title')
  {{ $title = "Register" }}
@endsection

@section('hero')

    <div class="container">
        <div class="row">
            <div class="col-xl-4">
                <form class="need-validation" action="{{ route('register')}}" method="POST" autocomplete="off">
                    @csrf
                    <h2 data-aos="fade-up" data-aos-delay="200">Register</h2>
                    <br>
                    <div class="col-12" data-aos="fade-up" data-aos-delay="200">
                        <input id="username" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" placeholder="Username" autocomplete="off" required autofocus>
                        @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-12 pt-3"  data-aos="fade-up" data-aos-delay="200" >
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        @error('confirmpassword')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-12 pt-3"  data-aos="fade-up" data-aos-delay="200" >
                        <input id="confirmpassword" type="password" class="form-control @error('confirmpassword') is-invalid @enderror" name="confirmpassword" placeholder="Confirm Password" required>
                    </div>
                    <div class="col-12 pt-3"  data-aos="fade-up" data-aos-delay="200" >
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="E-Mail" required >
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="d-flex pt-3" data-aos="fade-up" data-aos-delay="200">
                        <input id="firstName" class="form-control @error('firstName') is-invalid @enderror" name="firstName" placeholder="First Name" required> &nbsp;
                        <input id="lastName" class="form-control @error('lastName') is-invalid @enderror" name="lastName" placeholder="Last Name" required>
                    </div>
                    <br>
                    <div class="d-flex form-check text-white" data-aos="fade-up" data-aos-delay="200" style="justify-content:flex-end;">
                        <input class="form-check-input" type="radio" name="radio" id="administrator" value="administrator">
                        <label class="form-check-label" for="administrator">
                            &nbsp; I'm a school representative
                        </label>
                        &emsp; &emsp;
                        <input class="form-check-input" type="radio" name="radio" id="volunteer" value="volunteer" checked>
                        <label class="form-check-label" for="volunteer"> 
                            &nbsp; I'm a volunteer
                        </label>
                    </div>
                    <br>
                    <div class="d-flex" data-aos="fade-up" data-aos-delay="200" style="justify-content:flex-end">
                        <button class="w-25 btn btn-lg btn-primary mb-3" type="submit" style="font-size: 12px">Submit</button>
                    </div>
                </form>
                <div class="d-flex pt-5" data-aos="fade-up" data-aos-delay="20"  style="justify-content:flex-end">
                    <p> <b> <a href="/login">Already have an account? Login now</a></b></p>
                </div>
            </div>
        </div>
    </div>

@endsection