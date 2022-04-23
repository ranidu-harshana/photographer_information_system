@extends('layouts.app')

@section('content')
    <div class="row">
        @if($errors->any())
    {{ implode('', $errors->all('<div>:message</div>')) }}
@endif
        <div class="col-md-7">
            <div class="card-box">
                <h4 class="card-title">Schedule</h4>

                @if(session('failed'))
                    <div class="alert alert-danger">
                        {{ session('failed') }}
                    </div>
                @endif

                <form action="{{ route('item.store') }}" method="POST">
                    @csrf
                    
                    <div class="form-group">
                        <label>Item Code</label>
                        <input name="item_code" value="{{ old('item_code') }}" type="text" required class="form-control @error('item_code') is-invalid @enderror" autocomplete="off">
                        @error('item_code') <p class="text-danger">{{$message}}</p> @enderror
                    </div>

                    <div class="form-group">
                        <label>Item Description</label>
                        <input name="item_desc" value="{{ old('item_desc') }}" type="text" required class="form-control" autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label>Item Type</label>
                        <select name="function_type_id" id="" class="form-control">
                            <option value="">Select</option>
                            <option value="1">Photo Shoot</option>
                            <option value="2">Wedding</option>
                            <option value="3">Event</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Item Price</label>
                        <input name="item_price" id="item_price" value="{{ old('item_price') }}" type="number" class="form-control" autocomplete="off">
                    </div>


                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
    
@endsection