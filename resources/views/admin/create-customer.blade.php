@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-7">
            <div class="card-box">
                <h4 class="card-title">Schedule</h4>

                @if(session('failed'))
                    <div class="alert alert-danger">
                        {{ session('failed') }}
                    </div>
                @endif

                <form action="{{ route('customer.store') }}" method="POST">
                    @csrf
                    
                    <div class="form-group">
                        <label>Bill Number</label>
                        <input name="bill_nulber" value="{{ old('bill_nulber') }}" type="text" required class="form-control @error('bill_nulber') is-invalid @enderror" autocomplete="off">
                        @error('bill_nulber') <p class="text-danger">{{$message}}</p> @enderror
                    </div>

                    {{-- <div class="form-group">
                        <label>Branch</label>
                        <select name="branch_id" required class="form-control" value="{{ old('branch_id') }}">
                            @foreach ($branches as $branch)
                                <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                            @endforeach
                        </select>
                    </div> --}}

                    <div class="form-group">
                        <label>Name</label>
                        <input name="name" value="{{ old('name') }}" type="text" required class="form-control" autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label>Address</label>
                        <input name="address" value="{{ old('address') }}" type="text" required class="form-control" autocomplete="off">
                    </div>
                    
                    <div class="form-group">
                        <label>Mobile No. 1</label>
                        <input name="mob_no1" value="{{ old('mob_no1') }}" type="text" required class="form-control" autocomplete="off">
                    </div>
                    
                    <div class="form-group">
                        <label>Mobile No. 2</label>
                        <input name="mob_no2" value="{{ old('mob_no2') }}" type="text" class="form-control" autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label>Type </label>
                        <select name="function_type_id" id="function_type_id" required class="form-control" value="{{ old('type') }}">
                            <option value="">Select Type</option>
                            <option value="1">Wedding</option>
                            <option value="2">Photoshoot</option>
                            <option value="3">Event</option>
                        </select>
                    </div>

                    {{-- when function type is Wedding --}}
                    <div id="wedding_type">
                        <div class="form-group">
                            <label>Wedding Type </label>
                            <select name="wedding_type_id" id="wedding_type_id" class="form-control" value="{{ old('type') }}">
                                <option value="">Select Type</option>
                                <option value="1">Wedding Only</option>
                                <option value="2">Homecomming Only</option>
                                <option value="3">Wedding & Hommcomming</option>
                            </select>
                        </div>
                    </div>
                    {{-- End when function type is Wedding --}}

                    {{-- when wedding type is Wedding only --}}
                    <div id="wedding_div">
                        <div class="form-group">
                            <label>Wedding Date</label>
                            <input name="wedding_date" id="wedding_date" value="{{ old('wedding_date') }}" type="date" class="form-control @error('wedding_date') is-invalid @enderror" autocomplete="off" min="{{ date('Y-m-d') }}">
                            @error('wedding_date') <p class="text-danger">{{$message}}</p> @enderror
                        </div>

                        <div class="form-group">
                            <label>Wedding Location</label>
                            <input name="wedding_location" id="wedding_location" value="{{ old('wedding_location') }}" type="text" class="form-control" autocomplete="off">
                        </div>
                    </div>
                    {{-- End when wedding type is Wedding only --}}

                    {{-- when wedding type is Homecomming only --}}
                    <div id="homecomming_div">
                        <div class="form-group">
                            <label>Homecomming Date</label>
                            <input name="home_com_date" id="home_com_date" value="{{ old('home_com_date') }}" type="date" class="form-control @error('home_com_date') is-invalid @enderror" autocomplete="off" min="{{ date('Y-m-d') }}">
                            @error('home_com_date') <p class="text-danger">{{$message}}</p> @enderror
                        </div>

                        <div class="form-group">
                            <label>Homecomming Location</label>
                            <input name="home_com_location" id="home_com_location" value="{{ old('home_com_location') }}" type="text" class="form-control" autocomplete="off">
                        </div>
                    </div> 
                    {{-- End when wedding type is Homecomming only --}}

                    {{-- when wedding type is Event --}}
                    <div id="event_div">
                        <div class="form-group">
                            <label>Event Date</label>
                            <input name="event_date" id="event_date" value="{{ old('event_date') }}" type="date" class="form-control @error('event_date') is-invalid @enderror" autocomplete="off" min="{{ date('Y-m-d') }}">
                            @error('event_date') <p class="text-danger">{{$message}}</p> @enderror
                        </div>

                        <div class="form-group">
                            <label>Event Location</label>
                            <input name="event_location" id="event_location" value="{{ old('event_location') }}" type="text" class="form-control" autocomplete="off">
                        </div>
                    </div>
                    {{-- End when wedding type is Event --}}

                    {{-- when wedding type is Photoshoot --}}
                    <div id="photosshoot_div">
                        <div class="form-group">
                            <label>Photoshoot Date</label>
                            <input name="photo_shoot_date" id="photo_shoot_date" value="{{ old('photo_shoot_date') }}" type="date" class="form-control @error('photo_shoot_date') is-invalid @enderror" autocomplete="off" min="{{ date('Y-m-d') }}">
                            @error('photo_shoot_date') <p class="text-danger">{{$message}}</p> @enderror
                        </div>

                        <div class="form-group">
                            <label>Photoshoot Location</label>
                            <input name="photo_shoot_location" id="photo_shoot_location" value="{{ old('photo_shoot_location') }}" type="text" class="form-control" autocomplete="off">
                        </div>
                    </div>
                    {{-- End when wedding type is Photoshoot --}}

                    <div class="form-group">
                        <label>Total Amount</label>
                        <input name="total_payment" id="total_payment" value="{{ old('total_payment') }}" type="text" class="form-control" autocomplete="off">
                    </div>
                    <label>Discount</label><br>
                    <div class="input-group mb-3">
                        
                        <div class="input-group-prepend">
                            <select name="" id="discount_by" class="form-control">
                                <option value="">Select</option>
                                <option value="1">By Amount</option>
                                <option value="2">By Percentage</option>
                            </select>
                        </div>
                        <input type="text" name="" id="discount_by_field" class="form-control" aria-label="Text input with dropdown button">
                        <input type="hidden" name="discount" id="discount">
                    </div>

                    <div class="form-group">
                        <label>Advance Payment</label>
                        <input name="advance_payment" id="advance_payment" value="{{ old('advance_payment') }}" type="text" class="form-control" autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label>Balance to be paid</label>
                        <input name="balance_to_be_paid" id="balance_to_be_paid" type="number" class="form-control" disabled>
                    </div>

                    <div class="text-right">
                        <button type="submit" class="btn btn-primary" id="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        {{-- <div class="col-md-5">
            <img src="{{ asset('assets/img/SIL1263.jpg') }}" alt="" class="image-responsive" width="100%">
        </div> --}}
    </div>


    {{-- 
        var path0 = "{{ route('autocomplete_wedding_location')  }}";
        $('#wedding_location').typeahead({
            
            source:  function (query0, process0) {
                return $.get(path0, { term0: query0 }, function (data0) {
                    return process0(data0);
                });
            }
        });

        var path = "{{ route('autocomplete_brida_place')  }}";
        $('#bridal_dressing_place').typeahead({
            
            source:  function (query, process) {
                return $.get(path, { term: query }, function (data) {
                    return process(data);
                });
            }
        });

        var path1 = "{{ route('autocomplete_photography_place')  }}";
        $('#photography_place').typeahead({
            
            source:  function (query1, process1) {
                return $.get(path1, { term1: query1 }, function (data1) {
                    return process1(data1);
                });
            }
        });  --}}


    <script>
        $(document).ready(function(){
            $("#submit").on('click',function(){
                $.ajaxSetup({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "../set_tab0_session",
                    type: "POST",
                })
            });

            $('#discount_by_field').prop("disabled", true);
            $('#wedding_type').hide();
            $('#wedding_div').hide();
            $('#homecomming_div').hide();
            $('#event_div').hide();
            $('#photosshoot_div').hide();
            $('#photo_shoot_date').prop('required', false)
            $('#home_com_date').prop('required', false)
            $('#wedding_date').prop('required', false)
            $('#event_date').prop('required', false)
            $('#wedding_type_id').prop('required', false)
            $('#function_type_id').change(function() {
                var function_type_id = $('#function_type_id').val()
                if(function_type_id == 2){
                    $('#wedding_type').hide();
                    $('#wedding_div').hide();
                    $('#homecomming_div').hide();
                    $('#event_div').hide();
                    $('#photosshoot_div').show();
                    $('#photo_shoot_date').prop('required', true)
                    $('#home_com_date').prop('required', false)
                    $('#wedding_date').prop('required', false)
                    $('#event_date').prop('required', false)
                    $('#wedding_type_id').prop('required', false)
                }else if (function_type_id == 1) {
                    $('#wedding_type').show();
                    $('#wedding_div').hide();
                    $('#homecomming_div').hide();
                    $('#event_div').hide();
                    $('#photosshoot_div').hide();
                    $('#wedding_type_id').prop('required', true)
                    $('#wedding_type_id').change(function() {
                        var wedding_type_id = $('#wedding_type_id').val();
                        if(wedding_type_id == 1) {
                            $('#wedding_type').show();
                            $('#wedding_div').show();
                            $('#homecomming_div').hide();
                            $('#event_div').hide();
                            $('#photosshoot_div').hide();
                            $('#photo_shoot_date').prop('required', false)
                            $('#home_com_date').prop('required', false)
                            $('#wedding_date').prop('required', true)
                            $('#event_date').prop('required', false)
                            $('#wedding_type_id').prop('required', false)
                        }else if(wedding_type_id == 2) {
                            $('#wedding_type').show();
                            $('#wedding_div').hide();
                            $('#homecomming_div').show();
                            $('#event_div').hide();
                            $('#photosshoot_div').hide();
                            $('#photo_shoot_date').prop('required', false)
                            $('#home_com_date').prop('required', true)
                            $('#wedding_date').prop('required', false)
                            $('#event_date').prop('required', false)
                            $('#wedding_type_id').prop('required', false)
                        }else if(wedding_type_id == 3) {
                            $('#wedding_type').show();
                            $('#wedding_div').show();
                            $('#homecomming_div').show();
                            $('#event_div').hide();
                            $('#photosshoot_div').hide();
                            $('#photo_shoot_date').prop('required', false)
                            $('#home_com_date').prop('required', true)
                            $('#wedding_date').prop('required', true)
                            $('#event_date').prop('required', false)
                            $('#wedding_type_id').prop('required', false)
                        }else{
                            $('#wedding_type').hide();
                            $('#wedding_div').hide();
                            $('#homecomming_div').hide();
                            $('#event_div').hide();
                            $('#photosshoot_div').hide();
                            $('#photo_shoot_date').prop('required', false)
                            $('#home_com_date').prop('required', false)
                            $('#wedding_date').prop('required', false)
                            $('#event_date').prop('required', false)
                            $('#wedding_type_id').prop('required', false)
                        }
                    });
                }else if(function_type_id == 3){
                    $('#wedding_type').hide();
                    $('#wedding_div').hide();
                    $('#homecomming_div').hide();
                    $('#event_div').show();
                    $('#photosshoot_div').hide();
                    $('#photo_shoot_date').prop('required', false)
                    $('#home_com_date').prop('required', false)
                    $('#wedding_date').prop('required', false)
                    $('#event_date').prop('required', true)
                    $('#wedding_type_id').prop('required', false)
                }else{
                    $('#wedding_type').hide();
                    $('#wedding_div').hide();
                    $('#homecomming_div').hide();
                    $('#event_div').hide();
                    $('#photosshoot_div').hide();
                    $('#photo_shoot_date').prop('required', false)
                    $('#home_com_date').prop('required', false)
                    $('#wedding_date').prop('required', false)
                    $('#event_date').prop('required', false)
                    $('#wedding_type_id').prop('required', false)
                }
            });
        });

        $("#discount_by").change(function(){
            if($("#discount_by").val() == 1){
                $('#discount_by_field').prop("disabled", false);
                $('#discount_by_field').val(null);
                $('#discount').val(null);
            }
            else if($("#discount_by").val() == 2){
                $('#discount_by_field').prop("disabled", false);
                $('#discount_by_field').val(null);
                $('#discount').val(null);
            }else{
                $('#discount_by_field').prop("disabled", true);
                $('#discount_by_field').val(null);
                $('#discount').val(null);
            }
        });
        $('#total_payment').keyup(function(){
            var total_payment = $('#total_payment').val()
            var discount = $('#discount').val()
            var advance_payment = $('#advance_payment').val()
            
            var balance_to_be_paid = Number(total_payment)-(Number(discount)+Number(advance_payment));
            $('#balance_to_be_paid').val(balance_to_be_paid);
        });

        $('#discount_by_field').keyup(function(){
            $('#discount').val($('#discount_by_field').val());
            var total_payment = $('#total_payment').val()
            var discount = $('#discount').val()
            var advance_payment = $('#advance_payment').val()
            var discount_by = $('#discount_by').val()
            if(discount_by == 1) {
                var balance_to_be_paid = Number(total_payment)-(Number(discount)+Number(advance_payment));
            }else if(discount_by == 2){
                var balance_to_be_paid = Number(total_payment)-(Number(total_payment)*(Number(discount)/100)+Number(advance_payment));
            }
            
            $('#balance_to_be_paid').val(balance_to_be_paid);
        });

        $('#advance_payment').keyup(function(){
            var total_payment = $('#total_payment').val()
            var discount = $('#discount').val()
            var advance_payment = $('#advance_payment').val()

            var balance_to_be_paid = Number(total_payment)-(Number(discount)+Number(advance_payment));
            $('#balance_to_be_paid').val(balance_to_be_paid);
        });
    </script>
@endsection