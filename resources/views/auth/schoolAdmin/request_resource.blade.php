@extends('auth.schoolAdmin.partial.dashboard')

@section('title')
    {{ $title = 'New Resource Request' }}
@endsection

@section('css')

    <!-- Date Picker -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.css" />
    
    <!-- Day.js  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dayjs/1.11.4/dayjs.min.js" integrity="sha512-Ot7ArUEhJDU0cwoBNNnWe487kjL5wAOsIYig8llY/l0P2TUFwgsAHVmrZMHsT8NGo+HwkjTJsNErS6QqIkBxDw==" crossorigin="anonymous" referrerpolicy="no-referrer" defer="defer"></script>

    <!-- Popover -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js" integrity="sha512-nnzkI2u2Dy6HMnzMIkh7CPd1KX445z38XIu4jG1jGw7x5tSL3VBjE44dY4ihMU1ijAQV930SPM12cCFrB18sVw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection

@section('content')
    
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add a New Resource Request</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        @if(session()->has('message'))
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Success!
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ session()->get('message') }}</div>
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
                    <h6 class="m-0 font-weight-bold text-primary">New Request Data</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <form class="needs-validation" action="{{ route('resource_request') }}" method="POST">
                        @csrf
                        <div class="col-12 pt-1" style="margin-left: 0px; padding-left:0px">
                            <!-- Resource Request -->
                            <div class="col-12" style="margin-left: 0px; padding-left:0px" id="resourceReq">
                                <div class="d-flex col-8" style="margin-left: 0px; padding-left:0px">
                                    <div class="col-6 pt-3">
                                        <label for="resourceType"> Resource Type: </label>
                                        <input id="resourceType" class="form-control @error('resourceType') is-invalid @enderror" name="resourceType" required>
                                        @error('resourceType')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-6 pt-3">
                                        <label for="numRequired"> Number Required: </label>
                                        <input id="numRequired" class="form-control @error('numRequired') is-invalid @enderror" name="numRequired" autocomplete="off" required>
                                        @error('numRequired')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="col-8 pt-3">
                            <label for="description"> Description: </label>
                            <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" type="textarea" rows="4"  required> </textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <hr>
                        <div class="d-flex" style="justify-content: flex-end">
                            <button class="btn btn-primary" type="submit"  id="submit"> Input Data </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    
    <!-- Auto Numeric -->
    <script src="~/Scripts/autoNumeric/autoNumeric.min.js" type="text/javascript"></script>

    <!-- Datepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js" type="text/javascript"></script>

    <!-- Timepicker -->
    <script src="js/timepicker-bs4.js" type="text/javascript"></script>

    <!-- AutoNumeric 1 -->
    <script type="text/javascript">
        (function($, undefined) {

            "use strict";

            // When ready.
            $(function() {
            
            var $input= $( "#numRequired" );

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

     <!-- AutoNumeric 2 -->
     <script type="text/javascript">
        (function($, undefined) {

            "use strict";

            // When ready.
            $(function() {
            
            var $input= $( "#studentLevel" );

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

     <!-- AutoNumeric 3 -->
     <script type="text/javascript">
        (function($, undefined) {

            "use strict";

            // When ready.
            $(function() {
            
            var $input= $( "#numStudent" );

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

    <!-- Timepicker -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            jQuery('#sandbox-container-2 input').timepicker({
                minTime:'08:00',
                maxTime:'18:00',
                step: 60,
                format:'hh:mm A',
            });
        });
    </script>

    <!-- Change Form -->
    <script type="text/javascript">
        
        function changeVal(e){

            var e = document.getElementById("requestType");
            var tutorReq = document.getElementById("tutorReq");
            var resourceReq = document.getElementById("resourceReq");

            if(e.value == "Resource"){
                tutorReq.hidden = "true";
                resourceReq.removeAttribute("hidden");
            }

            if(e.value == "Tutorial"){
                tutorReq.removeAttribute("hidden");
                resourceReq.hidden = "true";
            }
            
        };            

    </script>

@endsection