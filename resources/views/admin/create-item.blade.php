@extends('layouts.app')

@section('content')
    <div class="row">

        <div class="col-md-7">
            <div class="card-box">
                <h4 class="card-title">Create Item</h4>
                @if($errors->any())
                {{ implode('', $errors->all('<div>:message</div>')) }}
            @endif
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
                        <label>Function Type</label><br>
                        @foreach ($function_types as $function_type)
                            <input type="checkbox" id="attach_func_type{{ $function_type->id }}" name="attach_func_type[]" value="{{ $function_type->id }}"> <label for="attach_func_type{{ $function_type->id }}"> {{ $function_type->name }}</label>  <br>
                        @endforeach
                    </div>

                    <div class="form-group">
                        <label>Item Price</label>
                        <input name="item_price" id="item_price" value="{{ old('item_price') }}" type="number" class="form-control" autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label>Designing Charge</label>
                        <input name="design_charge" id="design_charge" value="{{ old('design_charge') }}" type="number" class="form-control" autocomplete="off">
                    </div>

                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
    
@endsection