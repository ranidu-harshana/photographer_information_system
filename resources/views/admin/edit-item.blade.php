@extends('layouts.app')

@section('content')
    <div class="row">

        <div class="col-md-7">
            <div class="card-box">
                <h4 class="card-title">Edit Item</h4>

                @if(session('failed'))
                    <div class="alert alert-danger">
                        {{ session('failed') }}
                    </div>
                @endif

                <form action="{{ route('item.update', $item->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group">
                        <label>Item Code</label>
                        <input name="item_code" value="{{ $item->item_code }}" type="text" required class="form-control @error('item_code') is-invalid @enderror" autocomplete="off">
                        @error('item_code') <p class="text-danger">{{$message}}</p> @enderror
                    </div>

                    <div class="form-group">
                        <label>Item Description</label>
                        <input name="item_desc" value="{{ $item->item_desc }}" type="text" required class="form-control" autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label>Item Type</label>
                        <select name="function_type_id" id="" class="form-control">
                            <option value="{{ $item->function_type_id }}">{{ $item->function_type->name }}</option>
                            @foreach ($function_types as $function_type)
                                @if ($function_type->name != $item->function_type->name)
                                    <option value="{{ $function_type->id }}">{{ $function_type->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Item Price</label>
                        <input name="item_price" id="item_price" value="{{ $item->item_price }}" type="number" class="form-control" autocomplete="off">
                    </div>


                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
    
@endsection