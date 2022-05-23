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
                @if($errors->any())
                    {!! implode('', $errors->all('<div>:message</div>')) !!}
                @endif

                <form action="{{ route('customer.store') }}" method="POST">
                    @csrf
                    
                    <div class="form-group">
                        <label>Bill Number</label>
                        <input name="bill_nulber" value="{{ old('bill_nulber') }}" type="text" required class="form-control @error('bill_nulber') is-invalid @enderror" autocomplete="off">
                        @error('bill_nulber') <p class="text-danger">{{$message}}</p> @enderror
                    </div>

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
                        <label>Branch</label>
                        <select name="branch_id" id="" required class="form-control">
                            <option value="">Select Branch</option>
                            @foreach ($branches as $branch)
                                <option value="{{ $branch->id }}">{{ $branch->name }}</option>    
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Type </label>
                        <select name="function_type_id" id="function_type_id" required class="form-control" value="{{ old('type') }}">
                            <option value="">Select</option>
                            <option value="1">Wedding</option>
                            <option value="2">Event</option>
                        </select>
                    </div>

                    {{-- when function type is Wedding --}}
                    <div id="wedding_div">
                        <label>Wedding</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <input type="checkbox" id="wedding1" name="function_type_checkbox[]" value="1">
                                </div>
                                <input name="wedding_date" id="wedding_date" value="{{ old('wedding_date') }}" type="date" class="form-control @error('wedding_date') is-invalid @enderror" autocomplete="off" min="{{ date('Y-m-d') }}">
                                @error('wedding_date') <p class="text-danger">{{$message}}</p> @enderror
                            </div>
                            <input name="wedding_location" id="wedding_location" placeholder="Wedding Location" value="{{ old('wedding_location') }}" type="text" class="form-control" autocomplete="off">
                            <input type="text" name="" id="" class="form-control" value="50000">
                        </div>

                        <label>Homecomming</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <input type="checkbox" id="wedding2" name="function_type_checkbox[]" value="2">
                                </div>
                                <input name="home_com_date" id="home_com_date" value="{{ old('home_com_date') }}" type="date" class="form-control @error('home_com_date') is-invalid @enderror" autocomplete="off" min="{{ date('Y-m-d') }}">
                                @error('home_com_date') <p class="text-danger">{{$message}}</p> @enderror
                            </div>
                            <input name="home_com_location" id="home_com_location" placeholder="Homecomming Location" value="{{ old('home_com_location') }}" type="text" class="form-control" autocomplete="off">
                            <input type="text" name="" id="" class="form-control" value="50000">
                        </div>
                        
                        <label>Preshoot</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <input type="checkbox" id="wedding3" name="function_type_checkbox[]" value="3">
                                </div>
                                <input name="preshoot_date" id="preshoot_date" value="{{ old('preshoot_date') }}" type="date" class="form-control @error('preshoot_date') is-invalid @enderror" autocomplete="off" min="{{ date('Y-m-d') }}">
                                @error('preshoot_date') <p class="text-danger">{{$message}}</p> @enderror
                            </div>
                            <input name="preshoot_location" id="preshoot_location" placeholder="Preshoot Location" value="{{ old('preshoot_location') }}" type="text" class="form-control" autocomplete="off">
                            <input type="text" name="" id="" class="form-control">
                        </div>

                        <label>Going Away</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <input type="checkbox" id="wedding4" name="function_type_checkbox[]" value="4">
                                </div>
                                <input name="goingaway_date" id="goingaway_date" value="{{ old('goingaway_date') }}" type="date" class="form-control @error('goingaway_date') is-invalid @enderror" autocomplete="off" min="{{ date('Y-m-d') }}">
                                @error('goingaway_date') <p class="text-danger">{{$message}}</p> @enderror
                            </div>
                            <input name="goingaway_location" id="goingaway_location" placeholder="Going Away Location" value="{{ old('goingaway_location') }}" type="text" class="form-control" autocomplete="off">
                            <input type="text" name="" id="" class="form-control">
                        </div>

                        <label>Engagement</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <input type="checkbox" id="wedding5" name="function_type_checkbox[]" value="5">
                                </div>
                                <input name="engagement_date" id="engagement_date" value="{{ old('engagement_date') }}" type="date" class="form-control @error('engagement_date') is-invalid @enderror" autocomplete="off" min="{{ date('Y-m-d') }}">
                                @error('engagement_date') <p class="text-danger">{{$message}}</p> @enderror
                            </div>
                            <input name="engagement_location" id="engagement_location" placeholder="Engagement Location" value="{{ old('engagement_location') }}" type="text" class="form-control" autocomplete="off">
                            <input type="text" name="" id="" class="form-control">
                        </div>
                    </div>
                    {{-- End when function type is Wedding --}}


                    {{-- when function type is Event --}}
                    <div id="event_div">
                        <label>Event</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <input type="checkbox" id="wedding6" name="function_type_checkbox[]" value="6">
                                </div>
                                <input name="event_date" id="event_date" value="{{ old('event_date') }}" type="date" class="form-control @error('event_date') is-invalid @enderror" autocomplete="off" min="{{ date('Y-m-d') }}">
                                @error('event_date') <p class="text-danger">{{$message}}</p> @enderror
                            </div>
                            <input name="event_type" id="event_type" placeholder="Description" value="{{ old('event_type') }}" type="text" class="form-control" autocomplete="off">
                            <input name="event_location" id="event_location" placeholder="Event Location" value="{{ old('event_location') }}" type="text" class="form-control" autocomplete="off">
                            <input type="text" name="" id="" class="form-control">
                        </div>
                    </div>
                    {{-- end when function type is Event --}}





                    


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
    </div>

    <script>
        $(document).ready(() => {
            $('#wedding_div').hide();
            $('#event_div').hide();
            $('#function_type_id').change(() => {
                var function_type_id = $('#function_type_id').val()
                if(function_type_id == 1){
                    $('#wedding_div').show();
                    $('#event_div').hide();
                } else if (function_type_id == 2) {
                    $('#wedding_div').hide();
                    $('#event_div').show();
                } else {
                    $('#wedding_div').hide();
                    $('#event_div').hide();
                }
            })
        })

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