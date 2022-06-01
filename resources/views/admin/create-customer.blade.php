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
                                <input name="wedding_date" id="date1" value="{{ old('wedding_date') }}" type="date" class="form-control @error('wedding_date') is-invalid @enderror" autocomplete="off" min="{{ date('Y-m-d') }}">
                                @error('wedding_date') <p class="text-danger">{{$message}}</p> @enderror
                            </div>
                            <input name="wedding_location" id="location1" placeholder="Wedding Location" value="{{ old('wedding_location') }}" type="text" class="form-control" autocomplete="off">
                            <input type="hidden" name="" id="amount1" class="form-control" value="50000">
                        </div>

                        <label>Homecomming</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <input type="checkbox" id="wedding2" name="function_type_checkbox[]" value="2">
                                </div>
                                <input name="home_com_date" id="date2" value="{{ old('home_com_date') }}" type="date" class="form-control @error('home_com_date') is-invalid @enderror" autocomplete="off" min="{{ date('Y-m-d') }}">
                                @error('home_com_date') <p class="text-danger">{{$message}}</p> @enderror
                            </div>
                            <input name="home_com_location" id="location2" placeholder="Homecomming Location" value="{{ old('home_com_location') }}" type="text" class="form-control" autocomplete="off">
                            <input type="hidden" name="" id="amount2" class="form-control" value="50000">
                        </div>
                        
                        <label>Preshoot</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <input type="checkbox" id="wedding3" name="function_type_checkbox[]" value="3">
                                </div>
                                <input name="preshoot_date" id="date3" value="{{ old('preshoot_date') }}" type="date" class="form-control @error('preshoot_date') is-invalid @enderror" autocomplete="off" min="{{ date('Y-m-d') }}">
                                @error('preshoot_date') <p class="text-danger">{{$message}}</p> @enderror
                            </div>
                            <input name="preshoot_location" id="location3" placeholder="Preshoot Location" value="{{ old('preshoot_location') }}" type="text" class="form-control" autocomplete="off">
                            <input type="hidden" name="" id="amount3" class="form-control" value="25000">
                        </div>

                        <label>Going Away</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <input type="checkbox" id="wedding4" name="function_type_checkbox[]" value="4">
                                </div>
                                <input name="goingaway_date" id="date4" value="{{ old('goingaway_date') }}" type="date" class="form-control @error('goingaway_date') is-invalid @enderror" autocomplete="off" min="{{ date('Y-m-d') }}">
                                @error('goingaway_date') <p class="text-danger">{{$message}}</p> @enderror
                            </div>
                            <input name="goingaway_location" id="location4" placeholder="Going Away Location" value="{{ old('goingaway_location') }}" type="text" class="form-control" autocomplete="off">
                            <input type="hidden" name="" id="amount4" class="form-control" value="10000">
                        </div>

                        <label>Engagement</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <input type="checkbox" id="wedding5" name="function_type_checkbox[]" value="5">
                                </div>
                                <input name="engagement_date" id="date5" value="{{ old('engagement_date') }}" type="date" class="form-control @error('engagement_date') is-invalid @enderror" autocomplete="off" min="{{ date('Y-m-d') }}">
                                @error('engagement_date') <p class="text-danger">{{$message}}</p> @enderror
                            </div>
                            <input name="engagement_location" id="location5" placeholder="Engagement Location" value="{{ old('engagement_location') }}" type="text" class="form-control" autocomplete="off">
                            <input type="hidden" name="" id="amount5" class="form-control" value="5000">
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
                                <input name="event_date" id="date6" value="{{ old('event_date') }}" type="date" class="form-control @error('event_date') is-invalid @enderror" autocomplete="off" min="{{ date('Y-m-d') }}">
                                @error('event_date') <p class="text-danger">{{$message}}</p> @enderror
                            </div>
                            <input name="event_type" id="event_type" placeholder="Description" value="{{ old('event_type') }}" type="text" class="form-control" autocomplete="off">
                            <input name="event_location" id="location6" placeholder="Event Location" value="{{ old('event_location') }}" type="text" class="form-control" autocomplete="off">
                            <input type="hidden" name="" id="amount6" class="form-control" value="20000">
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
                            <select name="discount_by" id="discount_by" class="form-control">
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
            for (let index = 1; index < 7; index++) {
                $("#date"+index).prop("disabled", true)
                $("#location"+index).prop("disabled", true)
                $("#amount"+index).prop("disabled", true)
                $('#wedding'+index).click(function(){
                    if($(this).prop("checked") == true){
                        $("#date"+index).prop("disabled", false)
                        $("#location"+index).prop("disabled", false)
                        $("#amount"+index).prop("disabled", false)
                        var amount = $("#amount"+index).val()
                        var total_payment = $('#total_payment').val()
                        $('#total_payment').val(Number(amount) + Number(total_payment))
                        $('#balance_to_be_paid').val(Number(amount) + Number(total_payment));
                    } else if($(this).prop("checked") == false){
                        $("#date"+index).prop("disabled", true)
                        $("#location"+index).prop("disabled", true)
                        $("#amount"+index).prop("disabled", true)
                        var amount = $("#amount"+index).val()
                        var total_payment = $('#total_payment').val()
                        $('#total_payment').val(Number(total_payment) - Number(amount))
                        $('#balance_to_be_paid').val(Number(total_payment) - Number(amount));
                    }
                    
                });
            }

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
            $('#discount_by_field').val(null);
            $('#discount').val(null);
            var total_payment = $('#total_payment').val()
            $('#balance_to_be_paid').val(total_payment);
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