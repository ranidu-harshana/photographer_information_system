@extends('layouts.app_dataTable')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">
                <div class="card-block">
                    <h6 class="card-title text-bold">All Customers</h6>
                    @if (session('package-created'))
                        <div class="alert alert-success">
                            {{ session('package-created') }}
                        </div>
                    @elseif(session('package-updated'))
                        <div class="alert alert-success">
                            {{ session('package-updated') }}
                        </div>
                    @elseif(session('measurment-date-updated'))
                        <div class="alert alert-success">
                            {{ session('measurment-date-updated') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table id="all-packages-datatable" class="table table-striped table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th>Package Code</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Type</th>
                                    <th>Action</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($packages as $package)
                                    <tr>
                                        <td>{{ $package->package_code }}</td>
                                        <td>{{ $package->name }}</td>
                                        <td>{{ $package->desc }}</td>
                                        <td>{{ $package->package_price }}</td>
                                        <td>{{ $package->function_type->name }}</td>
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group" aria-label="...">
                                                <button type="submit" class="btn btn-warning btn-sm" name="edit" id="edit_btn"><i class="far fa-eye"></i> </button>
                                            </div>
                                            <div class="btn-group" role="group" aria-label="attach">
                                                <form action="" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-success btn-sm" name="delete"><i class="fas fa-paperclip"></i> </button>
                                                </form>
                                            </div>
                                            <div class="btn-group btn-group-sm" role="group" aria-label="...">
                                                <form action="" method="post">
                                                    @csrf
                                                    @method("PUT")
                                                    <button type="submit" class="btn btn-danger btn-sm" name="mark_as_done"><i class="fas fa-unlink"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="{{ route('package.edit', $package->id) }}">
                                                <button type="button" class="btn btn-success btn-sm">Edit</button>
                                            </a>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#packageDeleteModal{{ $package->id }}">
                                                Delete
                                            </button>
                                        </td>
                                        <div class="modal fade" id="packageDeleteModal{{ $package->id }}" tabindex="-1" role="dialog" aria-labelledby="packageDeleteModal{{ $package->id }}Label" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="packageDeleteModal{{ $package->id }}Label">Modal title</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('package.destroy', $package->id) }}" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            Are you sure you want to delete this package?
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
                                    <th>Package Code</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Type</th>
                                    <th>Action</th>
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
