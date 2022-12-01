@extends('auth.schoolAdmin.partial.dashboard')

@section('title')
    {{ $title = 'Profile' }}
@endsection

@section('content')
    
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Profile</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        @if(auth()->user()->phone === null)            
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                    Warning!
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Please complete your profile setting before you can proceed to use the website</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if(session('success'))
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Success!
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ session('success') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </div>

    <!-- Content Row -->

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Edit Profile</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <form class="needs-validation" action="{{ route('update_profile') }}" method="POST">
                        @csrf
                        <div class="col-12 pt-1" style="margin-left: 0px; padding-left:0px">
                            <p class="mx-2" style="font-weight:bold; font-size: 17px">Profile Detail: </p>    
                            <div class="d-flex col-8" style="margin-left: 0px; padding-left:0px">
                                <div class="col-6 pt-3">
                                    <label for="email"> Email: </label>
                                    <input id="email" class="form-control " name="email" value="{{ auth()->user()->email }}" readonly>
                                </div>
                                <div class="col-6 pt-3">
                                    <label for="username"> Full Name: </label>
                                    <input id="username" class="form-control" name="username" value="{{ auth()->user()->fullName }}"readonly>
                                </div>
                            </div>
                            <div class="col-4 pt-3">
                                <label for="phone"> Phone Number: </label>
                                <input id="phone" class="form-control" name="phone" value="@if(auth()->user()->phone != null){{ auth()->user()->phone }}@else{{ old('phone') }}@endif" placeholder="Phone Number" autocomplete="off" maxlength="15" required>
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="d-flex col-12 pt-3" style="margin-left: 0px; padding-left:0px">
                                <div class="col-4 pt-3">
                                    <label for="staffID"> Staff ID: </label>
                                    <input id="staffID" class="form-control" name="staffID" value="@if(auth()->user()->staffID != null){{ auth()->user()->staffID }} @else{{ old('staffID') }}@endif" placeholder="Staff ID" maxlength="10" autocomplete="off" required @if(auth()->user()->staffID != null) readonly @endif)>
                                    @error('staffID')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-4 pt-3">
                                    <label for="position"> Position: </label>
                                    <input id="position" class="form-control" name="position" value="@if(auth()->user()->position != null){{ auth()->user()->position }}@else{{ old('position') }}@endif" placeholder="Position" required>
                                    @error('positione')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="col-12 pt-1" style="margin-left: 0px; padding-left:0px">
                            <p class="mx-2" style="font-weight:bold; font-size: 17px">School Detail: </p>
                            <div class="d-flex col-8" style="margin-left: 0px; padding-left:0px">
                                @if(auth()->user()->schoolID === null)
                                    <div class="col-8 pt-3">
                                        <label for="schoolID"> School Name: </label>
                                        <div class="input-group">
                                            <select id="schoolID" name="schoolID" class="form-select custom-select" onchange="changeVal(event)">
                                                <option selected disabled>Select Your Workplace</option>
                                                @if($schools->first() != null)
                                                    @foreach($schools as $key => $data)
                                                        <option value="{{ $data->id }}"> {{ $data->schoolName }} | {{ $data->address }}, {{ $data->city }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="button"  data-bs-toggle="modal" data-bs-target="#addSchoolModal">
                                                    <i class="fas fa-plus"></i> 
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <input id="schoolID" type="hidden" class="form-control" name="schoolID" value="{{ auth()->user()->schoolID }}" placeholder="School Name" readonly >
                                    <div class="col-6 pt-3">
                                        <label for="schoolName"> School Name: </label>
                                        <input id="schoolName" class="form-control" name="schoolName" value="{{ $schoolName }}" placeholder="School Name" readonly>
                                    </div>
                                    <div class="col-6 pt-3">
                                        <label for="address"> Address:  </label>
                                        <input id="address" class="form-control" name="address" value="{{ $schoolAddress }}" placeholder="School Address" readonly>
                                    </div>
                                    <div class="col-6 pt-3">
                                        <label for="city"> City: </label>
                                        <input id="city" class="form-control" name="city" value="{{ $schoolCity }}" placeholder="City Location" readonly>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <hr>
                        <div class="d-flex" style="justify-content: flex-end">
                            <button class="btn btn-danger" type="button"> Update Password </button> &emsp;
                            <button class="btn btn-primary" type="submit"  id="submit" @if(auth()->user()->schoolID === null)disabled @endif> Update Profile Data </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addSchoolModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New School Data</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="{{ route('add_school') }}" class="needs-validation" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="col-12 pt-3">
                            <label for="schoolName"> School Name: </label>
                            <input id="schoolName" class="form-control" name="schoolName" placeholder="School Name" focus autocomplete="off" required>
                        </div>
                        <div class="col-12 pt-3">
                            <label for="address"> Address:  </label>
                            <input id="address" class="form-control" name="address" placeholder="School Address" autocomplete="off" required>
                        </div>
                        <div class="col-12 pt-3">
                            <label for="city"> City: </label>
                            <input id="city" class="form-control" name="city" placeholder="City Location" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary" type="submit">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="updatePasswordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New School Data</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form action="{{ route('add_school') }}" class="needs-validation" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="col-12">
                            <label for="password"> Password (*fill if you want to change your password): </label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" required>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="confirmpassword"> Confirm Password: </label>
                            <input id="confirmpassword" type="password" class="form-control @error('confirmpassword') is-invalid @enderror" name="confirmpassword" placeholder="Confirm Password" required>
                            @error('confirmpassword')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary" type="submit">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

    <!-- Auto Numeric -->
    <script src="~/Scripts/autoNumeric/autoNumeric.min.js" type="text/javascript"></script>

    <script type="text/javascript">
        (function($, undefined) {

            "use strict";

            // When ready.
            $(function() {
            
            var $input= $( "#phone" );

            $input.on( "keyup", function( event ) {
                
                // When user select text in the document, also abort.
                var selection = window.getSelection().toString();
                if ( selection !== '' ) {
                    return;
                }
                
                // When the arrow keys are pressed, abort.
                if ( $.inArray( event.keyCode, [38,40,37,39] ) !== -1 ) {
                    return;
                }                
                
                var $this = $( this );
                
                // Get the value.
                var input = $this.val();
                
                var input = input.replace(/[\D\s\._\-]+/g, "");

                    $this.val( function() {
                        return ( input === 0 ) ? "" : input.toLocaleString( "en-US" );
                    } );
                } );            
            });
        })(jQuery);

    </script>

    <script type="text/javascript">
        
        function changeVal(e){

            document.getElementById("submit").disabled = false;

        };            

    </script>

@endsection