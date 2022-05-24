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

                    <div class="text-right">
                        <button type="submit" class="btn btn-primary" id="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        
    </div>

@endsection