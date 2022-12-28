@extends('auth.schoolAdmin.partial.dashboard')

@section('title')
    {{ $title = 'View Request History' }}
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
        <h1 class="h3 mb-0 text-gray-800">List of Request Made History</h1>
    </div>

    <!-- Content Row -->

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Resource Request Data</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="col-12 pt-1" style="margin-left: 0px; padding-left:0px">
                        <!-- Resource Request -->
                        <div class="col-12 table-responsive" style="margin-left: 0px; padding-left:0px" id="tutorReq">
                            <div class="table-wrapper pt-3" style="margin-left: 0px; padding-left:0px">
                                <table class="table table-striped table-hover table-bordered" id="ResourceRequest">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width:3%"> # </th>
                                            <th class="text-center" style="width:15%"> Request Date </th>
                                            <th class="text-center" style="width:20%"> Request Status </th>
                                            <th class="text-center"> Resource Type </th>
                                            <th class="text-center"> Number Required </th>
                                            <th class="text-center" style="width:10%"> Misc. </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $datacount = 0;
                                        @endphp
                                        @foreach($resource_request as $key => $data)
                                            @php
                                                $datacount++;
                                            @endphp
                                            <tr>
                                                <td class="text-center"> {{ $data->requestID }} </td>
                                                <td class="text-center">
                                                    {{ $data->requestDate }}
                                                </td>
                                                <td class="text-center text-md" style="color:antiquewhite"> 
                                                    <h5>
                                                    @if($data->requestStatus == true)
                                                        <span class="badge bg-gradient-success">
                                                            Fulfilled Request
                                                        </span>
                                                    @else
                                                        <span class="badge bg-gradient-danger">
                                                            Unfulfilled Request
                                                        </span>
                                                    @endif
                                                    </h5>
                                                </td>
                                                <td class="text-center">
                                                    {{ $data->resourceType }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $data->numRequired }}
                                                </td>
                                                <td class="text-center"> 
                                                    <a href="#resourceModal" class="resource text-lg" title="Detail" data-bs-toggle="modal"
                                                    data-reqdate="{{ $data->requestDate }}" 
                                                    data-status="@if($data->status == true) Fulfilled Request @else Unfulfilled Request @endif" 
                                                    data-desc="{{ $data->description }}" 
                                                    data-type="{{ $data->resourceType }}" 
                                                    data-numreq="{{ $data->numRequired }}"> 
                                                        <span class="badge bg-warning">
                                                            More Info
                                                        </span>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        @if($datacount == 0)
                                            <tr class="text-center">
                                                <td colspan="6">
                                                    No matching data has been found
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                                <div class="clearfix d-flex flex-row-reverse">
                                    {{ $resource_request->onEachSide(2)->appends(['Tutorial' => $tutorial_request->currentPage()])->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Tutorial Request Data</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="col-12 pt-1" style="margin-left: 0px; padding-left:0px">
                        <!-- Tutorial Request -->
                        <div class="col-12 table-responsive" style="margin-left: 0px; padding-left:0px" id="tutorReq">
                            <div class="table-wrapper pt-3" style="margin-left: 0px; padding-left:0px">
                                <table class="table table-striped table-hover table-bordered" id="ResourceRequest">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="width:3%"> # </th>
                                            <th class="text-center" style="width:15%"> Request Date </th>
                                            <th class="text-center" style="width:20%"> Request Status </th>
                                            <th class="text-center" style="width:25%"> Proposed Date & Time </th>
                                            <th class="text-center"> Student Level </th>
                                            <th class="text-center"> Total Student </th>
                                            <th class="text-center" style="width:10%"> Misc. </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $datacount = 0;
                                        @endphp
                                        @foreach($tutorial_request as $key => $data)
                                            @php
                                                $datacount++;
                                            @endphp
                                            <tr>
                                                <td class="text-center"> {{ $data->requestID }} </td>
                                                <td class="text-center">
                                                    {{ $data->requestDate }}
                                                </td>
                                                <td class="text-center text-md" style="color:antiquewhite"> 
                                                    <h5>
                                                    @if($data->requestStatus == true)
                                                        <span class="badge bg-gradient-success">
                                                            Fulfilled Request
                                                        </span>
                                                    @else
                                                        <span class="badge bg-gradient-danger">
                                                            Unfulfilled Request
                                                        </span>
                                                    @endif
                                                    </h5>
                                                </td>
                                                <td class="text-center">
                                                    {{ $data->proposedDate }} @ {{ date("h:i a", strtotime($data->proposedTime)) }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $data->studentLevel }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $data->numStudent }}
                                                </td>
                                                <td class="text-center">
                                                    <a href="#tutorialModal" class="text-lg" title="Detail" data-bs-toggle="modal" data-target="tutorialModal"
                                                    data-reqdate="{{ $data->requestDate }}" 
                                                    data-status="@if($data->status == true) Fulfilled Request @else Unfulfilled Request @endif" 
                                                    data-desc="{{ $data->description }}" 
                                                    data-datetime="{{ $data->proposedDate }} @ {{ date("h:i a", strtotime($data->proposedTime)) }}" 
                                                    data-level="{{ $data->studentLevel }}" 
                                                    data-student="{{ $data->numStudent }}">
                                                        <span class="badge bg-warning">
                                                            More Info
                                                        </span>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        @if($datacount == 0)
                                            <tr class="text-center">
                                                <td colspan="7">
                                                    No matching data has been found
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                                <div class="clearfix d-flex flex-row-reverse">
                                    {{ $tutorial_request->onEachSide(2)->appends(['Resource' => $resource_request->currentPage()])->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="resourceModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Resource Data</h5>
                    <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-12 pt-3">
                        <label for="requestStatus"> Request Status: </label>
                        <input type="text" class="form-control" id="requestStatus" name="requestStatus" readonly>
                    </div>
                    <div class="col-12 pt-3">
                        <label for="requestDate"> Request Date: </label>
                        <input type="text" class="form-control" id="requestDate" name="requestDate" readonly>
                    </div>
                    <div class="col-12 pt-3">
                        <label for="description"> Description:  </label>
                        <textarea class="form-control" id="description" name="description" readonly></textarea>
                    </div>
                    <div class="col-12 pt-3">
                        <label for="resourceType"> Resource Type: </label>
                        <input type="text" class="form-control" id="resourceType" name="resourceType" readonly>
                    </div>
                    <div class="col-12 pt-3">
                        <label for="numRequired"> Total Number Required: </label>
                        <input type="text" class="form-control" id="numRequired" name="numRequired" readonly>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <div id="tutorialModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tutorial Data</h5>
                    <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-12 pt-3">
                        <label for="requestStatus"> Request Status: </label>
                        <input type="text" class="form-control" id="requestStatus" name="requestStatus" readonly>
                    </div>
                    <div class="col-12 pt-3">
                        <label for="requestDate"> Request Date: </label>
                        <input type="text" class="form-control" id="requestDate" name="requestDate" readonly>
                    </div>
                    <div class="col-12 pt-3">
                        <label for="description"> Description:  </label>
                        <textarea class="form-control" id="description" name="description" readonly></textarea>
                    </div>
                    <div class="col-12 pt-3">
                        <label for="datetime"> Proposed Date & Time: </label>
                        <input type="text" class="form-control" id="datetime" name="datetime" readonly>
                    </div>
                    <div class="col-12 pt-3">
                        <label for="studentLevel"> Student Level: </label>
                        <input type="text" class="form-control" id="studentLevel" name="studentLevel" readonly>
                    </div>
                    <div class="col-12 pt-3">
                        <label for="numStudent"> Number of Student: </label>
                        <input type="text" class="form-control" id="numStudent" name="numStudent" readonly>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

    <!-- Resource Request Detail -->
    <script>

        $('#resourceModal').on('show.bs.modal', function(e) {

            //get data-id attribute of the clicked element
            var reqStatus = $(e.relatedTarget).data('status');
            var reqDate = String($(e.relatedTarget).data('reqdate'));
            var desc = $(e.relatedTarget).data('desc');
            var type = $(e.relatedTarget).data('type');
            var numreq = $(e.relatedTarget).data('numreq');
            

            //populate the textbox
            $(e.currentTarget).find('input[name="requestStatus"]').val(reqStatus);
            $(e.currentTarget).find('input[name="requestDate"]').val(reqDate);
            $(e.currentTarget).find('textarea[name="description"]').val(desc);
            $(e.currentTarget).find('input[name="resourceType"]').val(type);
            $(e.currentTarget).find('input[name="numRequired"]').val(numreq);
        });

        $('#tutorialModal').on('show.bs.modal', function(e) {

            //get data-id attribute of the clicked element
            var reqStatus = $(e.relatedTarget).data('status');
            var reqDate = String($(e.relatedTarget).data('reqdate'));
            var desc = $(e.relatedTarget).data('desc');
            var datetime =  $(e.relatedTarget).data('datetime');
            var level = $(e.relatedTarget).data('level');
            var student = $(e.relatedTarget).data('student');


            //populate the textbox
            $(e.currentTarget).find('input[name="requestStatus"]').val(reqStatus);
            $(e.currentTarget).find('input[name="requestDate"]').val(reqDate);
            $(e.currentTarget).find('textarea[name="description"]').val(desc);
            $(e.currentTarget).find('input[name="datetime"]').val(datetime);
            $(e.currentTarget).find('input[name="studentLevel"]').val(level);
            $(e.currentTarget).find('input[name="numStudent"]').val(student);
        });
    
    </script>

@endsection