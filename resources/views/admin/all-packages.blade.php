@extends('layouts.app_dataTable')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">
                <div class="card-block">
                    <h6 class="card-title text-bold">All Packages</h6>
                    @if (session('package-created'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('package-created') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @elseif(session('package-updated'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('package-updated') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @elseif(session('package-deleted'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('package-deleted') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
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
                                            <div class="btn-group btn-group-sm" role="group" data-toggle="tooltip" data-trigger="hover" data-placement="top" title="View Items">
                                                <button type="button" class="btn btn-warning btn-sm" name="view" id="view" data-toggle="modal" data-target="#viewPackageItemsModal{{ $package->id }}"><i class="far fa-eye"></i> </button>
                                                <div class="modal fade" id="viewPackageItemsModal{{ $package->id }}" tabindex="-1" role="dialog" aria-labelledby="viewPackageItemsModal{{ $package->id }}Label" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="viewPackageItemsModal{{ $package->id }}Label">All Items - <span class="badge badge-success">{{ $package->package_code }}</span></h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                @foreach ($package->items as $item)
                                                                    <input type="checkbox" checked disabled name="" id=""> {{ $item->item_desc }} <br>
                                                                @endforeach
                                                            </div>
                                                            <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="btn-group" role="group" aria-label="attach" data-toggle="tooltip" data-trigger="hover" data-placement="bottom" title="Attach Items">
                                                <form action="{{ route('item.attach', $package->id) }}" method="post">
                                                    @csrf
                                                    <button type="button" class="btn btn-success btn-sm" onclick="openModal({{$package->id}})" >
                                                        <i class="fas fa-paperclip"></i>
                                                    </button>
                                                    <div class="modal fade" id="attachPackageModal{{ $package->id }}" tabindex="-1" role="dialog" aria-labelledby="attachPackageModal{{ $package->id }}Label" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="attachPackageModal{{ $package->id }}Label">Attach Items - <span class="badge badge-success">{{ $package->package_code }}</span> </h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body" id="attachPackageModalBody{{ $package->id }}">
                                                                    
                                                                </div>
                                                                <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                                        <button type="submit" class="btn btn-success">Done</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="btn-group btn-group-sm" role="group" aria-label="detach" data-toggle="tooltip" data-trigger="hover" data-placement="top" title="Detach Items">
                                                <form action="{{ route('item.detach', $package->id) }}" method="post">
                                                    @csrf
                                                    @method("DELETE")
                                                    <button type="button" class="btn btn-danger btn-sm" name="mark_as_done" data-toggle="modal" data-target="#detachItemsModal{{ $package->id }}"><i class="fas fa-unlink"></i></button>
                                                    <div class="modal fade" id="detachItemsModal{{ $package->id }}" tabindex="-1" role="dialog" aria-labelledby="detachItemsModal{{ $package->id }}Label" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="detachItemsModal{{ $package->id }}Label">Dettach Items - <span class="badge badge-success">{{ $package->package_code }}</span></h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    @foreach ($package->items as $item)
                                                                        <input type="checkbox" id="detach_items{{ $package->id }}{{ $item->id }}" name="detach_items[]" value="{{ $item->id }}"> <label for="detach_items{{ $package->id }}{{ $item->id }}"> {{ $item->item_desc }}</label>  <br>
                                                                    @endforeach
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-danger">Done</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
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

    <script>
        function openModal(package_id) {
            $('#attachPackageModal'+package_id).modal('show');
            

            $.ajax({
				url: "get_package_items/"+package_id,
				type: "GET",
				success: function(data){
                    html = '';
                    if (data.length != 0) {
                        data.forEach(element => {
                            html += '<input type="checkbox" id="attach_items'+package_id+''+element.id+'" name="attach_items[]" value="'+element.id+'"> <label for="attach_items'+package_id+''+element.id+'">'+element.item_desc+'</label> <br>';
                        });
                    }else{
                        html = '<div class="alert alert-success" role="alert">No any Items for this Package</div>';
                    }
					
                    $("#attachPackageModalBody"+package_id).html(html);
				}
			})
        }
    </script>
@endsection
