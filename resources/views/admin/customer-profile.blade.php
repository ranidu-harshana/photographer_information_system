@extends('layouts.app')

@section('content')
{{-- @if($errors->any())
    {!! implode('', $errors->all('<div>:message</div>')) !!}
@endif --}}
    <div class="row">
        <div class="col-sm-7 col-6">
            <h4 class="page-title">Customer Profile</h4>
        </div>
    
        <div class="col-sm-5 col-6 text-right m-b-30 ">
            <a href="" class="btn btn-success btn-rounded"><i class="fas fa-edit"></i> Edit</a>
            <a href="" class="btn btn-primary btn-rounded"><i class="fa fa-plus"></i> Postpone</a>
        </div>
    </div>
    <div class="card-box profile-header " id="profile-card">
        <div class="row">
            <div class="col-md-12 ">
                <div class="profile-view">
                    <div class="profile-img-wrap">
                        <div class="profile-img">
                            <a href="#"><img class="avatar" src="{{ asset('assets/img/user.jpg') }}" alt=""></a>
                        </div>
                    </div>
                    <div class="profile-basic ">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="profile-info-left">
                                    <h3 class="user-name m-t-0 mb-0">Name : {{ $customer->name }}</h3>
                                    <div class="staff-id">Address : {{ $customer->address }}</div>
                                    <div class="staff-id">Bill Number : {{ $customer->bill_nulber }}</div>
                                    <div class="staff-id">Booked On : {{ $customer->created_at }}</div>
                                    <div class="staff-id">Branch : </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <ul class="personal-info">
                                    <li>
                                        <span class="title">Phone 1</span>
                                        <span class="text"><a href="#">{{ $customer->mob_no1 }}</a></span>
                                    </li>

                                    @if ($customer->mob_no2 != NULL)
                                        <li>
                                            <span class="title">Phone 2</span>
                                            <span class="text"><a href="#">{{ $customer->mob_no2 }}</a></span>
                                        </li>
                                    @endif

                                    @if ($customer->wedding_date != NULL)
                                        <li>
                                            <span class="title">Wedding Date</span>
                                            <span class="text">{{ $customer->wedding_date }}</span>
                                        </li>
                                        @if ($customer->wedding_location != NULL)
                                            <li>
                                                <span class="title">Place</span>
                                                <span class="text">{{ $customer->wedding_location }}</span>
                                            </li>
                                        @endif
                                    @endif
                                    @if ($customer->home_com_date != NULL)
                                        <li>
                                            <span class="title">Homecomming Date</span>
                                            <span class="text">{{ $customer->home_com_date }}</span>
                                        </li>
                                        @if ($customer->home_com_location != NULL)
                                            <li>
                                                <span class="title">Place</span>
                                                <span class="text">{{ $customer->home_com_location }}</span>
                                            </li>
                                        @endif
                                    @endif
                                    
                                    @if ($customer->event_date != NULL)
                                        <li>
                                            <span class="title">Type</span>
                                            <span class="text">{{ $customer->event_type }}</span>
                                        </li>
                                        <li>
                                            <span class="title">Event Date</span>
                                            <span class="text">{{ $customer->event_date }}</span>
                                        </li>
                                        @if ($customer->event_location != NULL)
                                            <li>
                                                <span class="title">Place</span>
                                                <span class="text">{{ $customer->event_location }}</span>
                                            </li>
                                        @endif
                                    @endif
                                    @if ($customer->photo_shoot_date != NULL)
                                        <li>
                                            <span class="title">Photo Shoot Date</span>
                                            <span class="text">{{ $customer->photo_shoot_date }}</span>
                                        </li>
                                        @if ($customer->photo_shoot_location != NULL)
                                            <li>
                                                <span class="title">Place</span>
                                                <span class="text">{{ $customer->photo_shoot_location }}</span>
                                            </li>
                                        @endif
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>                        
            </div>
        </div>
    </div>
    <div class="profile-tabs">
        <ul class="nav nav-tabs nav-tabs-bottom">
            <li class="nav-item" id="tab0"><a class="nav-link @if (session('tab0')) active @endif" href="#packages_tab" data-toggle="tab">Packages</a></li>
            <li class="nav-item" id="tab1"><a class="nav-link @if (session('tab1')) active @endif" href="#items_tab" data-toggle="tab">Items</a></li>
            <li class="nav-item" id="tab2"><a class="nav-link @if (session('tab2')) active @endif" href="#bill_tab" data-toggle="tab">Bill</a></li>
            <li class="nav-item" id="tab3"><a class="nav-link @if (session('tab3')) active @endif" href="#notes_tab" data-toggle="tab">Notes</a></li>
            <li class="nav-item" id="tab4"><a class="nav-link @if (session('tab4')) active @endif" href="#other_tab" data-toggle="tab">Other</a></li>
            
        </ul>

        <div class="tab-content">
            <div class="tab-pane @if (session('tab0')) show active @endif" id="packages_tab" >
                <div class="row">
                    <div class="col-lg-3">
                        <div class="card-box">
                            <h4 class="card-title">Packages</h4>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#attachPackageModal">Attach</button>
                                <form action="{{ route('customer.package.attach', $customer->id) }}" method="post">
                                    @csrf
                                    <div class="modal fade" id="attachPackageModal" tabindex="-1" role="dialog" aria-labelledby="attachPackageModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="attachPackageModalLabel">Attach packages - <span class="badge badge-success">sdf</span> </h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    @if ($packages->count() != 0)
                                                        @foreach ($packages as $package)
                                                            <input type="checkbox" id="attach_packages{{$customer->id}}{{ $package->id }}" name="attach_packages[]" value="{{ $package->id }}"> <label for="attach_packages{{$customer->id}}{{ $package->id }}"> {{ $package->name }}</label>  <br>
                                                        @endforeach
                                                    @else
                                                        <div class="alert alert-success" role="alert">No any Packages to Detach</div>
                                                    @endif
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-success">Done</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#detachPackageModal">Detach</button>
                                <form action="{{ route('customer.package.detach', $customer->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal fade" id="detachPackageModal" tabindex="-1" role="dialog" aria-labelledby="detachPackageModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="detachPackageModalLabel">Detach Packages - <span class="badge badge-success">sdf</span> </h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    @if ($customer->packages->count() != 0)
                                                        @foreach ($customer->packages as $package)
                                                            <input type="checkbox" id="detach_packages{{$customer->id}}{{ $package->id }}" name="detach_packages[]" value="{{ $package->id }}"> <label for="detach_packages{{$customer->id}}{{ $package->id }}"> {{ $package->name }}</label>  <br>
                                                        @endforeach
                                                    @else
                                                        <div class="alert alert-success" role="alert">No any Package to Detach</div>
                                                    @endif
                                                    
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
                        </div>
                    </div>

                    <div class="col-lg-9">
                        <div class="card-box">
                            <h4 class="card-title">All Packages</h4>
                                <table class="table table-sm">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Package Code</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Price</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @if ($customer->packages->count() != 0)
                                            @foreach ($customer->packages as $package)
                                                <tr>
                                                    <th scope="row">1</th>
                                                    <td>{{ $package->package_code }}</td>
                                                    <td>{{ $package->name }}</td>
                                                    <td>{{ $package->package_price }}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan='4' class="text-center">No any Items Attched</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane @if (session('tab1')) active @endif" id="items_tab">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="card-box">
                            <h4 class="card-title">Items</h4>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#attachItemModal">Attach</button>
                                <form action="{{ route('customer.item.attach', $customer->id) }}" method="post">
                                    @csrf
                                    <div class="modal fade" id="attachItemModal" tabindex="-1" role="dialog" aria-labelledby="attachItemModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="attachItemModalLabel">Attach Items - <span class="badge badge-success">sdf</span> </h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    @if ($items->count() != 0)
                                                        @foreach ($items as $item)
                                                            <input type="checkbox" id="attach_items{{$customer->id}}{{ $item->id }}" name="attach_items[]" value="{{ $item->id }}"> <label for="attach_items{{$customer->id}}{{ $item->id }}"> {{ $item->item_desc }}</label>  <br>
                                                        @endforeach
                                                    @else
                                                        <div class="alert alert-success" role="alert">No any Items to Detach</div>
                                                    @endif
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-success">Done</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#detachItemModal">Detach</button>
                                <form action="{{ route('customer.item.detach', $customer->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal fade" id="detachItemModal" tabindex="-1" role="dialog" aria-labelledby="detachItemModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="detachItemModalLabel">Detach Items - <span class="badge badge-success">sdf</span> </h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    @if ($customer->items->count() != 0)
                                                        @foreach ($customer->items as $item)
                                                            <input type="checkbox" id="detach_items{{$customer->id}}{{ $item->id }}" name="detach_items[]" value="{{ $item->id }}"> <label for="detach_items{{$customer->id}}{{ $item->id }}"> {{ $item->item_desc }}</label>  <br>
                                                        @endforeach
                                                    @else
                                                        <div class="alert alert-success" role="alert">No any Items to Detach</div>
                                                    @endif
                                                    
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
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="card-box">
                            <h4 class="card-title">All Items</h4>
                            <table class="table table-sm">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Item Code</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Price</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @if ($customer->items->count() != 0)
                                        @foreach ($customer->items as $item)
                                            <tr>
                                                <th scope="row">1</th>
                                                <td>{{ $item->item_code }}</td>
                                                <td>{{ $item->item_desc }}</td>
                                                <td>{{ $item->item_price }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan='4' class="text-center">No any Items Attched</td>
                                        </tr>
                                    @endif
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane @if (session('tab2')) active @endif" id="bill_tab" >
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card-box">
                            <div class="row">
                                <div class="col-3">
                                    <h4 class="card-title">Billing</h4>
                                </div>
                                
                            </div>
                            
                            <ul class="personal-info">
                                <li>
                                    <span class="title">Total Amount</span>
                                    <span class="text-primary"> .00 </span>
                                </li>
                            </ul>
                            
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <table class="table table-striped table-hover table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Intering Payment</th>
                                    <th scope="col">Created At</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td scope="col">#</td>
                                    <td scope="col">Intering Payment</td>
                                    <td scope="col">Created At</td>
                                    <td>Edit</td>
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="tab-pane @if (session('tab3')) active @endif" id="notes_tab">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card-box">
                            <h3 class="card-title">Add Note</h3>
                            <div class="experience-box">
                                {{-- Note creating form --}}
                                <form action="{{ route('note.store') }}" method="post" style="display: block" id="note_create_form">
                                    @csrf
                                    <input type="hidden" name="customer_id" value="{{ $customer->id }}">
                                    <div class="form-group">
                                        <label>Note</label>
                                        <textarea name="note" required class="form-control" id="" cols="30" rows="5"></textarea>
                                    </div>

                                    <div class="text-right">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>

                                {{-- Note updating form --}}
                                <form action="" method="post" style="display: none" id="note_edit_form">
                                    @csrf
                                    @method("PUT")
                                    <div class="form-group">
                                        <label>Edit Note</label>
                                        <textarea name="note" required class="form-control" id="edit_note" cols="30" rows="5"></textarea>
                                    </div>

                                    <div class="text-right">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-8">
                        <table class="table table-striped table-hover table-sm">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Note</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @if ($notes->count() != 0)
                                    @foreach ($notes as $note)
                                        <tr>
                                            <td>
                                                @if ($note->status == 1)
                                                    <input type="checkbox" checked>
                                                @else
                                                    <input type="checkbox">
                                                @endif
                                                
                                            </td>
                                            <td>{{ $note->note }}</td>
                                            <td style="width: 110px">{{ $note->created_at }}</td>
                                            <td style="width: 100px">
                                                <div class="row">
                                                    <input type="hidden" value="{{ $note->id }}" id="note_id{{$i}}">
                                                    <button type="submit" class="btn btn-warning btn-sm" name="edit" id="edit_btn{{$i}}"><i class="fal fa-edit"></i> </button>&nbsp;
                                                    <form action="{{ route('note.destroy', $note->id) }}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm" name="delete"><i class="far fa-trash-alt"></i> </button>&nbsp;
                                                    </form>
                                                    <form action="{{ route('note.mark_as_read', $note->id) }}" method="post">
                                                        @csrf
                                                        @method("PUT")
                                                        <button type="submit" class="btn btn-success btn-sm" name="mark_as_done"><i class="fas fa-clipboard-check"></i> </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @php
                                            $i++;
                                        @endphp
                                    @endforeach
                                @else
                                <tr>
                                    <td colspan='4' class="text-center">No any Notes</td>
                                </tr>
                                @endif
                                <input type="hidden" name="" id="last_count_i" value="{{$i}}">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="tab-pane @if (session('tab4')) active @endif" id="other_tab" >
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card-box">
                            <h4 class="card-title">Other Details</h4>
                            <ul class="personal-info">
                                <li>
                                    <span class="title">Dressing Place </span>
                                    <span class="text-primary">
                                            In Home
                                    </span>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>

    {{-- Autocompleting Text Fields --}}
    <script>
        $('#cost_edit_form').hide()
        $('#cost_view_form').show()
        function showCostEditForm() {
            $('#cost_edit_form').show()
            $('#cost_view_form').hide()
        }
    </script>
@endsection     