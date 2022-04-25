@extends('layouts.app')

@section('content')
    <div class="row">

        <div class="col-md-7">
            <div class="card-box">
                <h4 class="card-title">Edit Package</h4>

                @if(session('failed'))
                    <div class="alert alert-danger">
                        {{ session('failed') }}
                    </div>
                @endif

                <form action="{{ route('package.update', $package->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group">
                        <label>Package Code</label>
                        <input name="package_code" disabled value="{{ $package->package_code }}" type="text" required class="form-control @error('package_code') is-invalid @enderror" autocomplete="off">
                        @error('package_code') <p class="text-danger">{{$message}}</p> @enderror
                    </div>

                    <div class="form-group">
                        <label>Package Name</label>
                        <input name="name" value="{{ $package->name }}" type="text" required class="form-control" autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label>Package Description</label>
                        <input name="desc" value="{{ $package->desc }}" type="text" required class="form-control" autocomplete="off">
                    </div>

                    <div class="form-group">
                        <label>Package Price</label>
                        <input name="package_price" id="package_price" value="{{ $package->package_price }}" type="number" class="form-control" autocomplete="off">
                    </div>


                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
    
@endsection