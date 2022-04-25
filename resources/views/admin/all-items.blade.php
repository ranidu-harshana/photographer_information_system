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
                                        <td>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#itemDeleteModal{{ $item->id }}">
                                                Delete
                                            </button>
                                        </td>
                                        <div class="modal fade" id="itemDeleteModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="itemDeleteModal{{ $item->id }}Label" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="itemDeleteModal{{ $item->id }}Label">Modal title</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('item.destroy', $item->id) }}" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            Are you sure you want to delete this item?
                                                    </div>
                                                    <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                                            <button type="submit" class="btn btn-danger">Yes</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
