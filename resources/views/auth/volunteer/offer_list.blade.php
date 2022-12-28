@extends('auth.volunteer.partial.dashboard')

@section('title')
    {{ $title = 'Offer Made History' }}
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
        <h1 class="h3 mb-0 text-gray-800">List of Offers Made</h1>
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
                                            <th class="text-center" style="width:15%"> Offer Date </th>
                                            <th class="text-center"> Request ID </th>
                                            <th class="text-center" style="width:15%"> Offer Status </th>
                                            <th class="text-center" style="width:40%"> Remarks </th>
                                            <th class="text-center"> Misc. </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $datacount = 0;
                                        @endphp
                                        @foreach($offer as $key => $data)
                                            @php
                                                $datacount++;
                                            @endphp
                                            <tr>
                                                <td class="text-center"> {{ $datacount }} </td>
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
                                                    {{ $data->remarks }}
                                                </td>
                                                <td class="text-center"> 
                                                    @foreach($request as $key => $data2)
                                                        @if($data2->requestID == $data->requestID)
                                                            @foreach($school as $key => $data3)
                                                                @if($data3->id == $data2->schoolID)
                                                                    @php
                                                                        $requester = $data3->schoolName . " | " .  $data3->address . ", " . $data3->city 
                                                                    @endphp
                                                                @endif
                                                            @endforeach
                                                            @if($data2->requestType == "Resource")
                                                                <a href="#resourceModal" class="text-lg" title="Detail" data-bs-toggle="modal"
                                                                data-requester="{{ $requester }}"
                                                                data-reqdate="{{ $data2->requestDate }}" 
                                                                data-status="@if($data2->status == true) Fulfilled Request @else Unfulfilled Request @endif" 
                                                                data-desc="{{ $data2->description }}" 
                                                                data-type="{{ $data2->resourceType }}" 
                                                                data-numreq="{{ $data2->numRequired }}"> 
                                                                    <span class="badge bg-warning">
                                                                        Request Detail
                                                                    </span>
                                                                </a>
                                                            @else
                                                                <a href="#tutorialModal" class="text-lg" title="Detail" data-bs-toggle="modal" data-target="tutorialModal"
                                                                data-requester="{{ $requester }}"
                                                                data-reqdate="{{ $data2->requestDate }}" 
                                                                data-status="@if($data2->status == true) Fulfilled Request @else Unfulfilled Request @endif" 
                                                                data-desc="{{ $data2->description }}" 
                                                                data-datetime="{{ $data2->proposedDate }} @ {{ date("h:i a", strtotime($data2->proposedTime)) }}" 
                                                                data-level="{{ $data2->studentLevel }}" 
                                                                data-student="{{ $data2->numStudent }}">
                                                                    <span class="badge bg-warning">
                                                                        Request Detail
                                                                    </span>
                                                                </a>
                                                            @endif
                                                        @endif
                                                    @endforeach
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
                    <h5 class="modal-title" id="exampleModalLabel">Request Data (Resource)</h5>
                    <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-12 pt-3">
                        <label for="requester"> Requester: </label>
                        <input type="text" class="form-control" id="requester" name="requester" readonly>
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
                    <h5 class="modal-title" id="exampleModalLabel">Request Data (Tutorial)</h5>
                    <button class="close" type="button" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-12 pt-3">
                        <label for="requester"> Requester: </label>
                        <input type="text" class="form-control" id="requester" name="requester" readonly>
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

    <!-- Request Detail -->
    <script>

        $('#resourceModal').on('show.bs.modal', function(e) {

            //get data-id attribute of the clicked element
            var requester = String($(e.relatedTarget).data('requester'));
            var reqDate = String($(e.relatedTarget).data('reqdate'));
            var reqStatus = $(e.relatedTarget).data('status');
            var desc = $(e.relatedTarget).data('desc');
            var type = $(e.relatedTarget).data('type');
            var numreq = $(e.relatedTarget).data('numreq');

            //populate the textbox
            $(e.currentTarget).find('input[name="requester"]').val(requester);
            $(e.currentTarget).find('input[name="requestDate"]').val(reqDate);
            $(e.currentTarget).find('input[name="requestStatus"]').val(reqStatus);
            $(e.currentTarget).find('textarea[name="description"]').val(desc);
            $(e.currentTarget).find('input[name="resourceType"]').val(type);
            $(e.currentTarget).find('input[name="numRequired"]').val(numreq);
        });

        $('#tutorialModal').on('show.bs.modal', function(e) {

            //get data-id attribute of the clicked element
            var requester = String($(e.relatedTarget).data('requester'));
            var reqDate = String($(e.relatedTarget).data('reqdate'));
            var reqStatus = $(e.relatedTarget).data('status');
            var desc = $(e.relatedTarget).data('desc');
            var datetime =  $(e.relatedTarget).data('datetime');
            var level = $(e.relatedTarget).data('level');
            var student = $(e.relatedTarget).data('student');

            //populate the textbox
            $(e.currentTarget).find('input[name="requester"]').val(requester);
            $(e.currentTarget).find('input[name="requestStatus"]').val(reqStatus);
            $(e.currentTarget).find('input[name="requestDate"]').val(reqDate);
            $(e.currentTarget).find('textarea[name="description"]').val(desc);
            $(e.currentTarget).find('input[name="datetime"]').val(datetime);
            $(e.currentTarget).find('input[name="studentLevel"]').val(level);
            $(e.currentTarget).find('input[name="numStudent"]').val(student);
        });
    
    </script>

@endsection