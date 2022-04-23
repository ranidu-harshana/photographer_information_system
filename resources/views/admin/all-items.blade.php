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
                        <table id="all-items-datatable" class="table table-striped table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th>Item Code</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Type</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $item)
                                    <tr>
                                        <td>{{ $item->item_code }}</td>
                                        <td>{{ $item->item_desc }}</td>
                                        <td>{{ $item->item_price }}</td>
                                        <td>{{ $item->function_type->name }}</td>
                                        <td>
                                            <a href="{{ route('item.edit', $item->id) }}">
                                                <button type="button" class="btn btn-success btn-sm">Edit</button>
                                            </a>
                                        </td>
                                        <td>Delete</td>
                                    </tr>    
                                @endforeach
                                
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Item Code</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Type</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
