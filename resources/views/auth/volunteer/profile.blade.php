@extends('auth.volunteer.partial.dashboard')

@section('title')
    {{ $title = 'Profile' }}
@endsection

@section('css')
    <!-- Date Picker -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.css" />
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
                <div class="card border-left-success shadow py-2">
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
                    <form class="needs-validation" action="{{ route('update_volunteer_profile') }}" method="POST">
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
                            <div class="col-4 pt-3" id="sandbox-container">
                                <label for="date"> Date of Birth: </label>
                                <input type="text" class="form-control @error('date') is-invalid @enderror" id="date" name="date" value="@if(auth()->user()->dateOfBirth != null){{ auth()->user()->dateOfBirth }}@else{{ old('dateOfBirth') }}@endif" placeholder="yyyy-mm-dd" required  autocomplete="off" @if(auth()->user()->dateOfBirth != null) disabled @else readonly style="background-color: #fff" @endif onchange="changeVal(event)">
                                @error('date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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
                            <div class="col-4 pt-3 pb-5">
                                <label for="occupation"> Occupation: </label>
                                <input id="occupation" class="form-control" name="occupation" value="@if(auth()->user()->occupation != null){{ auth()->user()->occupation }}@else{{ old('occupation') }}@endif" placeholder="Occupation" required>
                                @error('occupatione')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <hr>
                        <div class="d-flex" style="justify-content: flex-end">
                            <button class="btn btn-primary" type="submit"  id="submit" @if(auth()->user()->schoolID === null)disabled @endif> Update Profile Data </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

    <!-- Auto Numeric -->
    <script src="/scripts/autoNumeric/autoNumeric.min.js" type="text/javascript"></script>

    <!-- Datepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>

    <!-- Phone Input -->
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

    <!-- Submit Enable -->
    <script type="text/javascript">
        
        function changeVal(e){

            document.getElementById("submit").disabled = false;

        };            

    </script>
    
    <!-- Datepicker -->
    <script>
        $('#sandbox-container input').datepicker({
            autoclose: true
        });

        $('#sandbox-container input').on('show', function(e) {

            console.debug('show', e.date, $(this).data('stickyDate'));

            if (e.date) {
                $(this).data('stickyDate', e.date);
            } else {
                $(this).data('stickyDate', null);
            }
        });

        $('#sandbox-container input').on('hide', function(e) {
            console.debug('hide', e.date, $(this).data('stickyDate'));
            var stickyDate = $(this).data('stickyDate');

            if (!e.date && stickyDate) {
                console.debug('restore stickyDate', stickyDate);
                $(this).datepicker('setDate', stickyDate);
                $(this).data('stickyDate', null);
            }
        });
    </script>

@endsection