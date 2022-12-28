@extends('auth.schoolAdmin.partial.dashboard')

@section('title')
    {{ $title = 'View Offer List' }}
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
        <h1 class="h3 mb-0 text-gray-800">View Offer List</h1>
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
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Offer Data</h6>
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
                                            <th class="text-center" style="width:25%"> Offeror </th>
                                            <th class="text-center" style="width:15%"> Offer Date </th>
                                            <th class="text-center"> Request ID </th>
                                            <th class="text-center" style="width:15%"> Offer Status </th>
                                            <th class="text-center"> Misc. </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $datacount = 0;
                                            $display = false;
                                        @endphp
                                        @foreach($offer as $key => $data)
                                            @foreach($request as $key => $data2)
                                                @if($data2->requestID == $data->requestID)
                                                    @if($data2->schoolID == auth()->user()->schoolID && $data2->requestStatus == false)
                                                        @php
                                                            $display = true;
                                                        @endphp
                                                    @endif
                                                @endif
                                            @endforeach
                                            @if($display == true)
                                                @php
                                                    $datacount++;
                                                    $display = false;
                                                @endphp
                                                <tr>
                                                    <td class="text-center"> {{ $data->offerID }} </td>
                                                    @foreach($offeror as $key => $data3)
                                                        @if($data3->username == $data->username)                                                    
                                                            <td class="text-center"> {{ $data3->fullName }}, {{ $data3->occupation }} </td>
                                                        @endif
                                                    @endforeach
                                                    <td class="text-center">
                                                        {{ $data->offerDate }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $data->requestID }}
                                                    </td>
                                                    <td class="text-center text-md" style="color:antiquewhite">
                                                        @if($data->offerStatus == true)
                                                            <span class="badge bg-gradient-success">
                                                                Approved
                                                            </span>
                                                        @else
                                                            <span class="badge bg-gradient-danger">
                                                                Unapproved
                                                            </span>
                                                        @endif
                                                    </td>
                                                    <td class="text-center"> 
                                                        @foreach($request as $key => $data2)
                                                            @if($data2->requestID == $data->requestID)
                                                                @if($data2->requestType == "Resource")
                                                                    <a href="#resourceModal" class="text-lg" title="Detail" data-bs-toggle="modal"
                                                                    data-reqid="{{ $data2->requestID }}" 
                                                                    data-status="@if($data2->status == true) Fulfilled Request @else Unfulfilled Request @endif" 
                                                                    data-desc="{{ $data2->description }}" 
                                                                    data-type="{{ $data2->resourceType }}" 
                                                                    data-numreq="{{ $data2->numRequired }}"
                                                                    data-offerid="{{ $data->offerID }}"
                                                                    data-remark="{{ $data->remarks }}"> 
                                                                        <span class="badge bg-warning">
                                                                            More Info
                                                                        </span>
                                                                    </a>
                                                                @else
                                                                    <a href="#tutorialModal" class="text-lg" title="Detail" data-bs-toggle="modal" data-target="tutorialModal"
                                                                    data-reqid="{{ $data2->requestID }}" 
                                                                    data-status="@if($data2->status == true) Fulfilled Request @else Unfulfilled Request @endif" 
                                                                    data-desc="{{ $data2->description }}" 
                                                                    data-datetime="{{ $data2->proposedDate }} @ {{ date("h:i a", strtotime($data2->proposedTime)) }}" 
                                                                    data-level="Lvl. {{ $data2->studentLevel }} | {{ $data2->numStudent }} Student(s)" 
                                                                    data-offerid="{{ $data->offerID }}"
                                                                    data-remark="{{ $data->remarks }}">
                                                                        <span class="badge bg-warning">
                                                                            More Info
                                                                        </span>
                                                                    </a>
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                </tr>
                                            @endif
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
                                    {{ $offer->onEachSide(2)->links() }}
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
                    <h5 class="modal-title" id="exampleModalLabel">Offer Data (Resource)</h5>
                    <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="needs-validation" action="{{ route('approve_offer') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="d-flex col-12 pt-3" style="margin-left: 0px; padding-left:0px">
                            <div class="col-6 pt-3 mx-1">
                                <label for="offerID"> Offer ID: </label>
                                <input type="text" class="form-control" id="offerID" name="offerID" readonly>
                            </div>
                            <div class="col-6 pt-3">
                                <label for="requestID"> Request ID: </label>
                            <input type="text" class="form-control" id="requestID" name="requestID" readonly>
                            </div>
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
                        <div class="col-12 pt-3">
                            <label for="remark"> Offer Remarks:  </label>
                            <textarea class="form-control" id="remark" name="remark" readonly></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary" type="submit">Accept Offer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="tutorialModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Offer Data (Tutorial)</h5>
                    <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="needs-validation" action="{{ route('approve_offer') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="d-flex col-12 pt-3" style="margin-left: 0px; padding-left:0px">
                            <div class="col-6 pt-3 mx-1">
                                <label for="offerID"> Offer ID: </label>
                                <input type="text" class="form-control" id="offerID" name="offerID" readonly>
                            </div>
                            <div class="col-6 pt-3">
                                <label for="requestID"> Request ID: </label>
                            <input type="text" class="form-control" id="requestID" name="requestID" readonly>
                            </div>
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
                            <label for="studentLevel"> Student Level & Total Student: </label>
                            <input type="text" class="form-control" id="studentLevel" name="studentLevel" readonly>
                        </div>
                        <div class="col-12 pt-3">
                            <label for="remark"> Offer Remarks:  </label>
                            <textarea class="form-control" id="remark" name="remark" readonly></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary" type="submit">Accept Offer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

    <!-- Request Detail -->
    <script>

        $('#resourceModal').on('show.bs.modal', function(e) {

            //get data-id attribute of the clicked element
            var reqID = String($(e.relatedTarget).data('reqid'));
            var reqStatus = $(e.relatedTarget).data('status');
            var desc = $(e.relatedTarget).data('desc');
            var type = $(e.relatedTarget).data('type');
            var numreq = $(e.relatedTarget).data('numreq');
            var offerID = String($(e.relatedTarget).data('offerid'));
            var remark = $(e.relatedTarget).data('remark');

            //populate the textbox
            $(e.currentTarget).find('input[name="requestID"]').val(reqID);
            $(e.currentTarget).find('input[name="requestStatus"]').val(reqStatus);
            $(e.currentTarget).find('textarea[name="description"]').val(desc);
            $(e.currentTarget).find('input[name="resourceType"]').val(type);
            $(e.currentTarget).find('input[name="numRequired"]').val(numreq);
            $(e.currentTarget).find('input[name="offerID"]').val(offerID);
            $(e.currentTarget).find('textarea[name="remark"]').val(remark);
        });

        $('#tutorialModal').on('show.bs.modal', function(e) {

            //get data-id attribute of the clicked element
            var reqID = String($(e.relatedTarget).data('reqid'));
            var reqStatus = $(e.relatedTarget).data('status');
            var desc = $(e.relatedTarget).data('desc');
            var datetime =  $(e.relatedTarget).data('datetime');
            var level = $(e.relatedTarget).data('level');
            var offerID = String($(e.relatedTarget).data('offerid'));
            var remark = $(e.relatedTarget).data('remark');

            //populate the textbox
            $(e.currentTarget).find('input[name="requestID"]').val(reqID);
            $(e.currentTarget).find('input[name="requestStatus"]').val(reqStatus);
            $(e.currentTarget).find('textarea[name="description"]').val(desc);
            $(e.currentTarget).find('input[name="datetime"]').val(datetime);
            $(e.currentTarget).find('input[name="studentLevel"]').val(level);
            $(e.currentTarget).find('input[name="offerID"]').val(offerID);
            $(e.currentTarget).find('textarea[name="remark"]').val(remark);
        });

    </script>

@endsection