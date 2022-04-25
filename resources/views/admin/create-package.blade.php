@extends('layouts.app')

@section('content')
    <div class="row">

        <div class="col-md-7">
            <div class="card-box">
                <h4 class="card-title">Create Package</h4>

                @if(session('failed'))
                    <div class="alert alert-danger">
                        {{ session('failed') }}
                    </div>
                @endif

                <form action="{{ route('package.store') }}" method="POST">
                    @csrf
                    
                    <div class="form-group">
                        <label>Package Code</label>
                        <input name="package_code" value="{{ old('package_code') }}" type="text" required class="form-control @error('package_code') is-invalid @enderror" autocomplete="off">
                        @error('package_code') <p class="text-danger">{{$message}}</p> @enderror
                    </div>

                    <div class="form-group">
                        <label>Package Name</label>
                        <input name="name" value="{{ old('name') }}" type="text" required class="form-control" autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label>Package Description</label>
                        <input name="desc" value="{{ old('desc') }}" type="text" required class="form-control" autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label>Function Type</label>
                        <select name="function_type_id" id="function_type_id" class="form-control">
                            @foreach ($function_types as $function_type)
                                <option value="{{ $function_type->id }}">{{ $function_type->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Package Price</label>
                        <input name="package_price" id="package_price" value="{{ old('package_price') }}" type="number" class="form-control" autocomplete="off">
                    </div>


                    <div class="form-group">
                        <label for="item" class="col-form-label text-md-end">{{ __('Item Name') }}</label>
    
                        <div class="form-control mt-2 border border-success" id="display_area" style="height: 192px; overflow: auto">
                            No Items
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
    <script>
        $(document).ready(function(){
            var function_type_id = $('#function_type_id').val();
            $.ajax({
                url: "../get/item/"+function_type_id,
                type: "GET",
                success: function(data){
                    html = '';
                    if(data.length != 0) {
                        data.forEach(element => {
                            html += '<div class="form-check">';
                            html += '<input class="form-check-input" type="checkbox" value="'+ element.id +'" name="items[]" id="items'+ element.id +'">';
                            html += '<label class="form-check-label" for="items'+ element.id +'">';
                            html += element.item_desc;
                            html += '</label></div>';
                        });
                    }else{
                        html = 'No Items';
                    }
                    $("#display_area").html(html);
                }
            })
            $("#function_type_id").change(function(){
                var function_type_id = $('#function_type_id').val();
                $.ajax({
                    url: "../get/item/"+function_type_id,
                    type: "GET",
                    success: function(data){
                        html = '';
                        if(data.length != 0) {
                            data.forEach(element => {
                                html += '<div class="form-check">';
                                html += '<input class="form-check-input" type="checkbox" value="'+ element.id +'" name="items[]" id="items'+ element.id +'">';
                                html += '<label class="form-check-label" for="items'+ element.id +'">';
                                html += element.item_desc;
                                html += '</label></div>';
                            });
                        }else{
                            html = 'No Items';
                        }
                        $("#display_area").html(html);
                    }
                })
            });
        });
    </script>
@endsection