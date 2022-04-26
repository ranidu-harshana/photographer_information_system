@extends('layouts.app_dataTable')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">
                <div class="card-block">
                    <h6 class="card-title text-bold">All Customers</h6>
                    @if (session('item-created'))
                        <div class="alert alert-success">
                            {{ session('item-created') }}
                        </div>
                    @elseif(session('item-updated'))
                        <div class="alert alert-success">
                            {{ session('item-updated') }}
                        </div>
                    @elseif(session('measurment-date-updated'))
                        <div class="alert alert-success">
                            {{ session('measurment-date-updated') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table id="all-customers-datatable" class="table table-striped table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th>Bill No</th>
                                    <th>Name</th>
                                    <th>Function Type</th>
                                    <th>Branch</th>
                                    <th>View</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customers as $customer)
                                    <tr>
                                        <td>{{ $customer->bill_nulber }}</td>
                                        <td>{{ $customer->name }}</td>
                                        <td>{{ $customer->function_type->name }}</td>
                                        <td>branch</td>
                                        <td>
                                            <a href="{{ route('customer.show', $customer->id) }}" class="btn btn-primary btn-sm">View</a>
                                        </td>
                                    </tr>    
                                @endforeach
                                
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Bill No</th>
                                    <th>Name</th>
                                    <th>Function Type</th>
                                    <th>Branch</th>
                                    <th>View</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
