@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-7">
            <div class="card-box">
                {{-- @if($errors->any())
                    {!! implode('', $errors->all('<div>:message</div>')) !!}
                @endif --}}
                <h4 class="card-title">Edit Customer</h4>

                @if(session('failed'))
                    <div class="alert alert-danger">
                        {{ session('failed') }}
                    </div>
                @endif

                <form action="{{ route('customer.update', $customer->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group">
                        <label>Bill Number</label>
                        <input name="bill_nulber" value="{{ $customer->bill_nulber }}" class="form-control" type="text" disabled>
                    </div>

                    <div class="form-group">
                        <label>Name</label>
                        <input name="name" value="{{ $customer->name }}" type="text" required class="form-control" autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label>Address</label>
                        <input name="address" value="{{ $customer->address }}" type="text" required class="form-control" autocomplete="off">
                    </div>
                    
                    <div class="form-group">
                        <label>Mobile No. 1</label>
                        <input name="mob_no1" value="{{ $customer->mob_no1 }}" type="text" required class="form-control" autocomplete="off">
                    </div>
                    
                    <div class="form-group">
                        <label>Mobile No. 2</label>
                        <input name="mob_no2" value="{{ $customer->mob_no2 }}" type="text" class="form-control" autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label>Branch</label>
                        <select name="branch_id" id="" required class="form-control">
                            <option value="{{ $customer->branch->id }}">{{ $customer->branch->name }}</option>
                            @foreach ($branches as $branch)
                                @if ($branch->id != $customer->branch_id)
                                    <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    {{-- when wedding type is Wedding only --}}
                    @if ($customer->wedding_date != NULL)
                        <div id="wedding_div">
                            <div class="form-group">
                                <label>Wedding Date</label>
                                <input name="wedding_date" id="wedding_date" value="{{ $customer->wedding_date }}" type="date" class="form-control @error('wedding_date') is-invalid @enderror" autocomplete="off">
                                @error('wedding_date') <p class="text-danger">{{$message}}</p> @enderror
                            </div>

                            <div class="form-group">
                                <label>Wedding Location</label>
                                <input name="wedding_location" id="wedding_location" value="{{ $customer->wedding_location }}" type="text" class="form-control" autocomplete="off">
                            </div>
                        </div>
                    @endif
                    {{-- End when wedding type is Wedding only --}}

                    {{-- when wedding type is Homecomming only --}}
                    @if ($customer->wedding_date != NULL || $customer->home_com_date != NULL)
                        <div id="homecomming_div">
                            <div class="form-group">
                                <label>Homecomming Date</label>
                                <input name="home_com_date" id="home_com_date" value="{{ $customer->home_com_date }}" type="date" class="form-control @error('home_com_date') is-invalid @enderror" autocomplete="off">
                                @error('home_com_date') <p class="text-danger">{{$message}}</p> @enderror
                            </div>

                            <div class="form-group">
                                <label>Homecomming Location</label>
                                <input name="home_com_location" id="home_com_location" value="{{ $customer->home_com_location }}" type="text" class="form-control" autocomplete="off">
                            </div>
                        </div>
                    @endif
                    {{-- End when wedding type is Homecomming only --}}

                    {{-- when wedding type is Event --}}
                    @if ($customer->event_date != NULL)
                        <div id="event_div">
                            <div class="form-group">
                                <label>Event Date</label>
                                <input name="event_date" id="event_date" value="{{ $customer->event_date }}" type="date" class="form-control @error('event_date') is-invalid @enderror" autocomplete="off">
                                @error('event_date') <p class="text-danger">{{$message}}</p> @enderror
                            </div>

                            <div class="form-group">
                                <label>Event Location</label>
                                <input name="event_location" id="event_location" value="{{ $customer->event_location }}" type="text" class="form-control" autocomplete="off">
                            </div>
                        </div>
                    @endif
                    {{-- End when wedding type is Event --}}

                    {{-- when wedding type is Photoshoot --}}
                    @if ($customer->photo_shoot_date != NULL)
                        <div id="photosshoot_div">
                            <div class="form-group">
                                <label>Photoshoot Date</label>
                                <input name="photo_shoot_date" id="photo_shoot_date" value="{{ $customer->photo_shoot_date }}" type="date" class="form-control @error('photo_shoot_date') is-invalid @enderror" autocomplete="off">
                                @error('photo_shoot_date') <p class="text-danger">{{$message}}</p> @enderror
                            </div>

                            <div class="form-group">
                                <label>Photoshoot Location</label>
                                <input name="photo_shoot_location" id="photo_shoot_location" value="{{ $customer->photo_shoot_location }}" type="text" class="form-control" autocomplete="off">
                            </div>
                        </div>
                    @endif
                    {{-- End when wedding type is Photoshoot --}}

                    <div class="form-group">
                        <label>Preshoot Date</label>
                        <input name="preshoot_date" id="preshoot_date" value="{{ $customer->preshoot_date }}" type="date" class="form-control @error('preshoot_date') is-invalid @enderror" autocomplete="off">
                        @error('preshoot_date') <p class="text-danger">{{$message}}</p> @enderror
                    </div>

                    <div class="form-group">
                        <label>Preshoot Location</label>
                        <input name="preshoot_location" id="preshoot_location" value="{{ $customer->preshoot_location }}" type="text" class="form-control" autocomplete="off">
                    </div>

                    <div class="text-right">
                        <button type="submit" class="btn btn-primary" id="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        
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

@endsection