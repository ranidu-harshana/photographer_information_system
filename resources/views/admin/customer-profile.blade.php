@extends('layouts.app')

@section('content')
{{-- @if($errors->any())
    {!! implode('', $errors->all('<div>:message</div>')) !!}
@endif --}}
    @php $total_package_price = 0; @endphp
    @foreach ($customer->packages as $package)
        @php
            $total_package_price += $package->pivot->package_price;
        @endphp
    @endforeach

    @php $total_item_price = 0; @endphp
    @foreach ($customer->items as $item)
        @php
            $total_item_price += $item->pivot->item_price * $item->pivot->quantity;
        @endphp
    @endforeach

    @php $intering_payment = 0; @endphp
    @foreach ($customer->intering_payments as $value)
        @php $intering_payment += $value->intering_payment; @endphp 
    @endforeach
    @php $balance = ($customer->total_payment + $total_package_price + $total_item_price) - ($customer->discount + $customer->advance_payment  + $intering_payment) @endphp
    
    @if(session('customer-updated'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('customer-updated') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @elseif(session('intering-payment-saved'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('intering-payment-saved') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @elseif(session('intering-payment-updated'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('intering-payment-updated') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button> 
        </div>
    @elseif(session('bill-updated'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('bill-updated') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @elseif(session('note-created'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('note-created') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @elseif(session('note-updated'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('note-updated') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @elseif(session('note-deleted'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('note-deleted') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @elseif(session('note-mark-as-read')) 
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('note-mark-as-read') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @elseif(session('item-detach')) 
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('item-detach') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @elseif(session('item-attach')) 
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('item-attach') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @elseif(session('package-detach')) 
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('package-detach') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @elseif(session('package-attach')) 
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('package-attach') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button> 
        </div>
    @elseif(session('mark-as-delivered')) 
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('mark-as-delivered') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @elseif(session('customer-item-updated')) 
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('customer-item-updated') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @elseif(session('customer-package-updated')) 
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('customer-package-updated') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @elseif(session('wedding-posponed')) 
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('wedding-posponed') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @elseif(session('home-com-posponed')) 
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('home-com-posponed') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @elseif(session('preshoot-posponed')) 
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('preshoot-posponed') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @elseif(session('event-posponed')) 
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('event-posponed') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @elseif(session('photoshoot-posponed')) 
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('photoshoot-posponed') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="row">
        <div class="col-sm-2 col-6">
            <h4 class="page-title">Customer Profile</h4>
        </div>

        <div class="col-sm-5 col-6 text-left ">
            <form action="{{ route('invoice', $customer->id) }}" method="post">
                @csrf
                <button class="btn" style="background-color:#0275d8; color:white">Generate Bill</button>
            </form>
        </div>

        <div class="col-sm-5 col-6 text-right m-b-30 ">
            <a href="{{ route('customer.edit', $customer->id) }}" class="btn btn-success btn-rounded"><i class="fas fa-edit"></i> Edit</a>
            {{-- <a class="btn btn-warning btn-rounded" data-toggle="modal" data-target="#postponeModal"><i class="fa fa-plus"></i> Postpone</a> --}}
        </div>
        
    </div>
    <div class="card-box profile-header " id="profile-card" style="min-height: 260px; overflow:scroll; overflow-x: hidden;">
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
                                    <div class="staff-id">Branch : {{ $customer->branch->name }}</div>
                                    <div class="staff-id">Phone 1 : {{ $customer->mob_no1 }}</div>
                                    @if ($customer->mob_no2 != NULL)
                                        <div class="staff-id">Phone 2 : {{ $customer->mob_no2 }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-8">
                                <ul class="personal-info">
                                    <li>
                                        <span class="title ">Due Payment</span>
                                        @if ($balance == 0)
                                            <span class="text-success">Payment Success</span> 
                                        @else
                                        <span class="text "><a class="text-danger"><b>{{ $balance }}.00</b></a></span>
                                        @endif
                                        
                                    </li>

                                    @foreach ($customer->function_types as $function_type)
                                        @if ($function_type->pivot->date != NULL && $function_type->pivot->date >= explode(' ', now())[0])
                                            <li>
                                                <span class="title">{{ $function_type->name }}</span>
                                                <span class="text"><b>{{ $function_type->pivot->date }}</b></span>
                                            </li>
                                            @if ($function_type->pivot->location != NULL)
                                                <li>
                                                    <span class="title">Place</span>
                                                    <span class="text">{{ $function_type->pivot->location }}</span>
                                                </li>
                                            @endif
                                        @endif
                                    @endforeach
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
            <li class="nav-item" id="tab0"><a class="nav-link @if (session('tab0')) active @elseif (!session('tab0') && !session('tab1') && !session('tab2') && !session('tab3') && !session('tab4')  && !session('tab5')) active @endif" href="#overview_tab" data-toggle="tab">Overview</a></li>
            <li class="nav-item" id="tab1"><a class="nav-link @if (session('tab1')) active @endif" href="#packages_tab" data-toggle="tab">Packages</a></li>
            <li class="nav-item" id="tab2"><a class="nav-link @if (session('tab2')) active @endif" href="#items_tab" data-toggle="tab">Items</a></li>
            <li class="nav-item" id="tab3"><a class="nav-link @if (session('tab3')) active @endif" href="#bill_tab" data-toggle="tab">Bill</a></li>
            <li class="nav-item" id="tab4"><a class="nav-link @if (session('tab4')) active @endif" href="#notes_tab" data-toggle="tab">Notes</a></li>
            <li class="nav-item" id="tab5"><a class="nav-link @if (session('tab5')) active @endif" href="#other_tab" data-toggle="tab">Other</a></li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane @if (session('tab0')) show active @elseif (!session('tab0') && !session('tab1') && !session('tab2') && !session('tab3') && !session('tab4') && !session('tab5')) show active @endif" id="overview_tab" >
                <div class="row">
                    <div class="col-lg-6 row">
                        <div class="col-lg-12">
                            <div class="card-box">
                                <h4 class="card-title">Package Details</h4>
                                <div class="row mb-3">
                                    <label for="package_name" class="col-md-4 col-form-label text-md-end"><b>{{ __('Selected Packages') }}</b></label>
                
                                    <div class="col-md-6">
                                        @if ($customer->packages->count() != 0)
                                            @foreach ($customer->packages as $package)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" disabled checked>
                                                    <label class="form-check-label" for="packagees{{ $package->id }}">
                                                        {{ $package->name }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        @else
                                        <span class="text-primary">
                                            No any Selected Packages
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <ul class="personal-info">
                                    <li>
                                        <span class="title">Total Package Price </span>
                                        @if ($total_package_price != 0)
                                            <span class="text-primary"> {{ $total_package_price }}.00 </span>
                                        @else
                                            0.00
                                        @endif
                                        
                                    </li>
                                    
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="card-box">
                                <h4 class="card-title">Item Details</h4>
                                <div class="row mb-3">
                                    <label for="package_name" class="col-md-4 col-form-label text-md-end"><b>{{ __('Selected Items') }}</b></label>
                
                                    <div class="col-md-6">
                                        @if ($customer->items->count() != 0)
                                            @foreach ($customer->items as $item)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" disabled checked>
                                                    <label class="form-check-label" for="item{{ $item->id }}">
                                                        {{ $item->item_desc }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        @else
                                        <span class="text-primary">
                                            No any Selected Items
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <ul class="personal-info">
                                    
                                    <li>
                                        <span class="title">Total Item Price </span>
                                        
                                        @if ($total_item_price != 0)
                                            <span class="text-primary"> {{ $total_item_price }}.00 </span>
                                        @else
                                            0.00
                                        @endif
                                        
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card-box">
                            <div class="row">
                                <div class="col-3">
                                    <h4 class="card-title">Billing Details</h4>
                                </div>
                            </div>
                            
                            <ul class="personal-info">
                                <li>
                                    <span class="title">Amount</span>
                                    @if ($customer->total_payment != NULL || $customer->total_payment != 0)
                                        <span class="text-primary"> {{ $customer->total_payment }}.00 </span>
                                    @else
                                        0.00
                                    @endif
                                </li>

                                <li>
                                    <span class="title">Discount </span>
                                    @if ($customer->discount != NULL || $customer->discount != 0)
                                        <span class="text-primary"> {{ $customer->discount }}.00 </span>
                                    @else
                                        0.00
                                    @endif
                                </li>
                                
                                <li>
                                    <span class="title">Advance Payment </span>
                                    @if ($customer->advance_payment != NULL || $customer->advance_payment != 0)
                                        <span class="text-primary"> {{ $customer->advance_payment }}.00 </span>
                                    @else
                                        0.00
                                    @endif
                                    
                                </li>

                                <li>
                                    <span class="title">Total Amount</span>
                                    <span class="text-primary"><b> {{ $customer->total_payment + $total_package_price + $total_item_price }}.00 </b></span>
                                </li>
                                @php $intering_payment = 0; @endphp
                                @foreach ($customer->intering_payments as $value)
                                    @php $intering_payment += $value->intering_payment; @endphp
                                @endforeach
                                @php $balance = ($customer->total_payment + $total_package_price + $total_item_price) - ($customer->discount + $customer->advance_payment  + $intering_payment) @endphp
                                <li>
                                    <span class="title">Balance </span>
                                    <span class="text"><a href="#">
                                        @if ($balance == 0)
                                            <span class="text-success">Payment Success</span> 
                                        @else
                                            {{ $balance }}.00
                                        @endif
                                    </a></span>
                                </li>

                            </ul>

                        </div>
                    </div>

                </div>
            </div>
            <div class="tab-pane @if (session('tab1')) active @endif" id="packages_tab">
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
                                                            <input type="hidden" name="package_id" value="{{ $package->id }}">
                                                            <input type="checkbox" id="detach_packages{{$customer->id}}{{ $package->id }}" name="detach_packages[]" value="{{ $package->id }}"> <label for="detach_packages{{$customer->id}}{{ $package->id }}"> {{ $package->name }}</label>  <br>
                                                        @endforeach
                                                    @else
                                                        <div class="alert alert-success" role="alert">No any Package to Detach</div>
                                                    @endif
                                                    
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-danger">Done</button>
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
                                
                            @if ($customer->packages->count() != 0)
                                @foreach ($customer->packages as $package)
                                    <table class="table table-sm">
                                        <thead class="thead-light">
                                            <tr>
                                                <th scope="col">Package Code</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">Action</th>
                                                <th scope="col">Edit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ $package->package_code }}</td>
                                                <td>{{ $package->name }}</td>
                                                <td>{{ $package->pivot->package_price }}</td>
                                                <td>
                                                    <div class="btn-group btn-group-sm" role="group" data-toggle="tooltip" data-trigger="hover" data-placement="top" title="View & Detach Items">
                                                        <button type="button" class="btn btn-danger btn-sm" name="view" id="view" data-toggle="modal" data-target="#viewAndDetachPackageItemsModal{{ $package->id }}"><i class="fas fa-unlink"></i></button>
                                                        <div class="modal fade" id="viewAndDetachPackageItemsModal{{ $package->id }}" tabindex="-1" role="dialog" aria-labelledby="viewAndDetachPackageItemsModal{{ $package->id }}Label" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="viewAndDetachPackageItemsModal{{ $package->id }}Label">Detach Items from Package - <span class="badge badge-success">{{ $package->package_code }}</span></h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form action="{{ route('detach_package_item_customer') }}" method="post">
                                                                            @csrf
                                                                            <input type="hidden" name="customer_id" value="{{ $customer->id }}">
                                                                            <input type="hidden" name="package_id" value="{{ $package->id }}">
                                                                            @foreach ($package->items as $item)
                                                                                @php 
                                                                                    if($arr != [] && array_key_exists($package->id, $arr)) {
                                                                                        $item_arr = $arr[$package->id];
                                                                                    }
                                                                                @endphp
                                                                                @if ($arr != [] && array_key_exists($package->id, $arr))
                                                                                    @if (in_array($item->id, $item_arr))
                                                                                        <input type="checkbox" name="items[]" id="item{{ $package->id }}{{$item->id}}" value="{{$item->id}}"> <label for="item{{ $package->id }}{{$item->id}}"> {{ $item->item_desc }} </label><br>
                                                                                    @endif
                                                                                @else
                                                                                    <input type="checkbox" name="items[]" id="item{{ $package->id }}{{$item->id}}" value="{{$item->id}}"> <label for="item{{ $package->id }}{{$item->id}}"> {{ $item->item_desc }} </label><br>
                                                                                @endif
                                                                            @endforeach
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                            <button type="submit" class="btn btn-danger" name="detach_item_customer">Done</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="btn-group btn-group-sm" role="group" data-toggle="tooltip" data-trigger="hover" data-placement="top" title="View & Attach Items">
                                                        <button type="button" class="btn btn-success btn-sm" name="view" id="view" data-toggle="modal" data-target="#viewAndAttachPackageItemsModal{{ $package->id }}"><i class="fas fa-paperclip"></i></button>
                                                        <div class="modal fade" id="viewAndAttachPackageItemsModal{{ $package->id }}" tabindex="-1" role="dialog" aria-labelledby="viewAndAttachPackageItemsModal{{ $package->id }}Label" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="viewAndAttachPackageItemsModal{{ $package->id }}Label">Attach Items from Package - <span class="badge badge-success">{{ $package->package_code }}</span></h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form action="{{ route('attach_package_item_customer') }}" method="post">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <input type="hidden" name="customer_id" value="{{ $customer->id }}">
                                                                            <input type="hidden" name="package_id" value="{{ $package->id }}">
                                                                            @foreach ($package->items as $item)
                                                                                @php 
                                                                                    if($arr != [] && array_key_exists($package->id, $arr)) {
                                                                                        $item_arr = $arr[$package->id];
                                                                                    }
                                                                                @endphp
                                                                                @if ($arr != [] && array_key_exists($package->id, $arr))
                                                                                    @if (!in_array($item->id, $item_arr))
                                                                                        <input type="checkbox" name="items[]" id="item{{ $package->id }}{{$item->id}}" value="{{$item->id}}"> <label for="item{{ $package->id }}{{$item->id}}"> {{ $item->item_desc }} </label><br>
                                                                                    @endif
                                                                                @endif
                                                                            @endforeach
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                            <button type="submit" class="btn btn-success" name="detach_item_customer">Done</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#updateCustomerPackage{{ $package->pivot->id }}">
                                                        Edit
                                                    </button>
                                                    
                                                    <div class="modal fade" id="updateCustomerPackage{{ $package->pivot->id }}" tabindex="-1" role="dialog" aria-labelledby="updateCustomerPackage{{ $package->pivot->id }}Label" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="updateCustomerPackage{{ $package->pivot->id }}Label">Modal title</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{ route('update_customer_packages', $package->pivot->id) }}" method="POST">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="form-group row">
                                                                        <label class="col-md-3 col-form-label">Price</label>
                                                                        <div class="col-md-9">
                                                                            <input type="text" onkeypress="return isExactNumberKey(event)" autocomplete="off" name="package_price" class="form-control" value="{{ $package->pivot->package_price }}">
                                                                        </div>
                                                                    </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Item Code</th>
                                                <th>Name</th>
                                                <th>Quantity</th>
                                                <th>Status</th>
                                                <th>Edit</th>
                                            </tr>
                                            @foreach ($package->items as $item)
                                                @if($items_details_arr != [] && array_key_exists($package->id, $items_details_arr))
                                                        @php $items_arr = $items_details_arr[$package->id]; @endphp
                                                        
                                                        @if($items_arr != [] && array_key_exists($item->id, $items_arr))
                                                            @php $item_arr = $items_arr[$item->id]; @endphp
                                                            <tr>
                                                                <td>{{ $item->item_code }}</td>
                                                                <td>{{ $item->item_desc }}</td>
                                                                <td>{{ $item_arr[0] }}</td>
                                                                <td>
                                                                    @if ($item_arr[1] == 0)
                                                                        <span class="badge badge-pill badge-warning" style="cursor: pointer;" id="" data-toggle="modal" data-target="#markAsDeliveredModal{{ $item_arr[2] }}">Pending</span>
                                                                        <div class="modal fade" id="markAsDeliveredModal{{ $item_arr[2] }}" tabindex="-1" role="dialog" aria-labelledby="markAsDeliveredModal{{ $item_arr[2] }}Label" aria-hidden="true">
                                                                            <div class="modal-dialog" role="document">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h5 class="modal-title" id="markAsDeliveredModal{{ $item_arr[2] }}Label">Change Item Status</h5>
                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                            <span aria-hidden="true">&times;</span>
                                                                                        </button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        Are you sure you want mark this as Delivered?
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <form action="{{ route('customer_package_item_mark_as_delivered', $item_arr[2] ) }}" method="post">
                                                                                            @csrf
                                                                                            @method('PUT')
                                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                                            <button type="submit" class="btn btn-primary">Save</button>
                                                                                        </form>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @else
                                                                        <span class="badge badge-pill badge-success">Delivered</span>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#updateCustomerPackageItemQuantity{{ $item_arr[2] }}">
                                                                        Edit
                                                                    </button>
                                                                    
                                                                    <div class="modal fade" id="updateCustomerPackageItemQuantity{{ $item_arr[2] }}" tabindex="-1" role="dialog" aria-labelledby="updateCustomerPackageItemQuantity{{ $item_arr[2] }}Label" aria-hidden="true">
                                                                        <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="updateCustomerPackageItemQuantity{{ $item_arr[2] }}Label">Update</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <form action="{{ route('update_customer_package_items', $item_arr[2]) }}" method="POST">
                                                                                    @csrf
                                                                                    @method('PUT')
                                                                                    
                                                                                    <div class="form-group row">
                                                                                        <label class="col-md-3 col-form-label">Quantity</label>
                                                                                        <div class="col-md-9">
                                                                                            <input type="text" onkeypress="return isExactNumberKey(event)" autocomplete="off" name="quantity" class="form-control" value="{{ $item_arr[0] }}">
                                                                                        </div>
                                                                                    </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    
                                                @endif
                                                
                                                
                                            @endforeach
                                            
                                        </tbody>
                                    </table><br><hr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan='6' class="text-center">No any Items Attched</td>
                                </tr>
                            @endif
                                
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane @if (session('tab2')) active @endif" id="items_tab">
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
                                                        <div class="alert alert-success" role="alert">No any Items to Attach</div>
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
                                                    <button type="submit" class="btn btn-danger">Done</button>
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
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Edit</th>
                                    <th scope="col">Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @if ($customer->items->count() != 0)
                                        @foreach ($customer->items as $item)
                                            <tr>
                                                <th scope="row">{{ $item->pivot->id }}</th>
                                                <td>{{ $item->item_code }}</td>
                                                <td>{{ $item->item_desc }}</td>
                                                <td>{{ $item->pivot->item_price }}</td>
                                                <td>{{ $item->pivot->quantity }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#updateCustomerItem{{ $item->pivot->id }}">
                                                        Edit
                                                    </button>
                                                    
                                                    <div class="modal fade" id="updateCustomerItem{{ $item->pivot->id }}" tabindex="-1" role="dialog" aria-labelledby="updateCustomerItem{{ $item->pivot->id }}Label" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="updateCustomerItem{{ $item->pivot->id }}Label">Update</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="{{ route('update_customer_items', $item->pivot->id) }}" method="POST">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="form-group row">
                                                                        <label class="col-md-3 col-form-label">Price</label>
                                                                        <div class="col-md-9">
                                                                            <input type="text" onkeypress="return isExactNumberKey(event)" autocomplete="off" name="item_price" class="form-control" value="{{ $item->pivot->item_price }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <label class="col-md-3 col-form-label">Quantity</label>
                                                                        <div class="col-md-9">
                                                                            <input type="text" onkeypress="return isExactNumberKey(event)" autocomplete="off" name="quantity" class="form-control" value="{{ $item->pivot->quantity }}">
                                                                        </div>
                                                                    </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    @if ($item->pivot->status == 0)
                                                        <span class="badge badge-pill badge-warning" style="cursor: pointer;" id="" data-toggle="modal" data-target="#itemMarkAsDeliveredModal{{ $item->pivot->id }}">Pending</span>
                                                          
                                                        <div class="modal fade" id="itemMarkAsDeliveredModal{{ $item->pivot->id }}" tabindex="-1" role="dialog" aria-labelledby="itemMarkAsDeliveredModal{{ $item->pivot->id }}Label" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="itemMarkAsDeliveredModal{{ $item->pivot->id }}Label">Change Item Status</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        Are you sure you want mark this as Delivered?
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <form action="{{ route('mark_as_delivered', $item->pivot->id) }}" method="post">
                                                                            @csrf
                                                                            @method('PUT')
                                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                            <button type="submit" class="btn btn-primary">Save</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <span class="badge badge-pill badge-success">Delivered</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan='7' class="text-center">No any Items Attched</td>
                                        </tr>
                                    @endif
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane @if (session('tab3')) active @endif" id="bill_tab" >
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card-box">
                            <div class="row">
                                <div class="col-3">
                                    <h4 class="card-title">Billing</h4>
                                </div>
                                <div class="col-9 text-right">
                                    <button class="btn btn-sm" style="background-color:	#0275d8; color:white" type="button" data-toggle="modal" data-target="#editBillModal">Edit Bill</button>
                                </div>
                                <!-- Modal -->
                                <div class="modal fade" id="editBillModal" tabindex="-1" role="dialog" aria-labelledby="editBillLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editBillLabel">Edit Bill</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('edit_bill', $customer->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="form-group row">
                                                        <label class="col-md-3 col-form-label">Amount</label>
                                                        <div class="col-md-9">
                                                            <input type="text" onkeypress="return isExactNumberKey(event)" autocomplete="off" name="total_payment" class="form-control" value="{{ $customer->total_payment }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-3 col-form-label">Discount</label>
                                                        <div class="col-md-9">
                                                            <input type="text" onkeypress="return isExactNumberKey(event)" autocomplete="off" name="discount" class="form-control" value="{{ $customer->discount }}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-md-3 col-form-label">Advance Payment</label>
                                                        <div class="col-md-9">
                                                            <input type="text" onkeypress="return isExactNumberKey(event)" autocomplete="off" class="form-control" name="advance_payment" value="{{ $customer->advance_payment }}">
                                                        </div>
                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <ul class="personal-info">
                                <li>
                                    <span class="title">Amount</span>
                                    @if ($customer->total_payment != NULL || $customer->total_payment != 0)
                                        <span class="text-primary"> {{ $customer->total_payment }}.00 </span>
                                    @else
                                        0.00
                                    @endif
                                </li>

                                
                                <li>
                                    <span class="title">Total Package Price </span>
                                    
                                    @if ($total_package_price != 0)
                                        <span class="text-primary"> {{ $total_package_price }}.00 </span>
                                    @else
                                        0.00
                                    @endif
                                </li>
                                <li>
                                    <span class="title">Total Item Price </span>
                                    
                                    @if ($total_item_price != 0)
                                        <span class="text-primary"> {{ $total_item_price }}.00 </span>
                                    @else
                                        0.00
                                    @endif
                                </li>

                                <li>
                                    <span class="title">Total Amount</span>
                                    <span class="text-primary"><b> {{ $customer->total_payment + $total_package_price + $total_item_price }}.00 </b></span>
                                    
                                </li>
                                <li>
                                    <span class="title">Discount </span>
                                    @if ($customer->discount != NULL || $customer->discount != 0)
                                        <span class="text-primary"> {{ $customer->discount }}.00 </span>
                                    @else
                                        0.00
                                    @endif
                                </li>
                                
                                <li>
                                    <span class="title">Advance Payment </span>
                                    @if ($customer->advance_payment != NULL || $customer->advance_payment != 0)
                                        <span class="text-primary"> {{ $customer->advance_payment }}.00 </span>
                                    @else
                                        0.00
                                    @endif
                                    
                                </li>
                                <li>
                                    <span class="title">Balance </span>
                                    <span class="text"><a href="#">
                                        @if ($balance == 0)
                                            <span class="text-success">Payment Success</span> 
                                        @else
                                            {{ $balance }}.00
                                        @endif
                                    </a></span>
                                </li>

                            </ul>
                            @if ($balance != 0)
                                <form action="{{ route('intering_payment.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group row">
                                        <label class="col-form-label col-md-4">Intering Payment</label>
                                        <div class="col-md-4">
                                            <input type="hidden" name="customer_id" value="{{ $customer->id }}">
                                            <input type="text" class="form-control" name="intering_payment" onkeypress="return isExactNumberKey(event)" autocomplete="off">
                                        </div>
                                        <div class="col-md-2">
                                            <input type="submit" class="btn btn-primary">
                                        </div>
                                    </div>
                                </form>
                            @endif
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="card-box">
                            <h4 class="card-title">Interim Payments Details</h4>   
                            <table class="table table-striped table-hover table-sm">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Interim Payment</th>
                                        <th scope="col">Created At</th>
                                        <th>Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($customer->intering_payments) != 0)
                                        @php $counter = 1; @endphp
                                        @foreach ($customer->intering_payments as $intering_payment)
                                            <tr>
                                                <th scope="row">{{ $counter }}</th>
                                                <td>{{ $intering_payment->intering_payment }}.00</td>
                                                <td>{{ $intering_payment->created_at }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editInterimPayment{{ $intering_payment->id }}">
                                                        Edit
                                                    </button>
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="editInterimPayment{{ $intering_payment->id }}" tabindex="-1" role="dialog" aria-labelledby="editInterimPayment{{ $intering_payment->id }}Label" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editInterimPayment{{ $intering_payment->id }}Label">Edit Interim Payment</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('intering_payment.update', $intering_payment->id) }}" method="post">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="form-group row">
                                                                    <label class="col-md-3 col-form-label">Payment</label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" onkeypress="return isExactNumberKey(event)" autocomplete="off" name="intering_payment" class="form-control" value="{{ $intering_payment->intering_payment }}">
                                                                    </div>
                                                                </div>
                                                            
                                                        </div>
                                                        <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Save</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @php $counter++; @endphp
                                        @endforeach
                                    @else
                                        <tr>
                                            <td scope="row" colspan="4" class="text-center text-secondary">No Any Payments</td>
                                        </tr>  
                                    @endif
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane @if (session('tab4')) active @endif" id="notes_tab">
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
                        <div class="card-box">
                            <h4 class="card-title">All Notes</h4>
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
                                    @if ($customer->notes->count() != 0)
                                        @foreach ($customer->notes as $note)
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
            </div>
            <div class="tab-pane @if (session('tab5')) active @endif" id="other_tab" >
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card-box">
                            <h4 class="card-title">Postponed Details</h4>
                            <ul class="personal-info">
                                @if ($customer->wedding_date != NULL)
                                    @if ($customer->posponed_date != NULL)
                                        <li>
                                            <span class=""> Wedding Postponed From: </span>
                                            <span class="text-primary">&nbsp;&nbsp;&nbsp;<b>{{ $customer->posponed_date}}</b></span>
                                        </li>
                                    @endif
                                @endif

                                @if ($customer->home_com_date != NULL)
                                    @if ($customer->homecomming_posponed_date != NULL)
                                        <li>
                                            <span class="">Homecomming Postponed From: </span>
                                            <span class="text-primary">&nbsp;&nbsp;&nbsp;<b>{{ $customer->homecomming_posponed_date}}</b></span>
                                        </li>
                                    @endif
                                @endif

                                @if ($customer->event_date != NULL)
                                    @if ($customer->posponed_date != NULL)
                                        <li>
                                            <span class="">Event Postponed From: </span>
                                            <span class="text-primary">&nbsp;&nbsp;&nbsp;<b>{{ $customer->posponed_date}}</b></span>
                                        </li>
                                    @endif
                                @endif

                                @if ($customer->photo_shoot_date != NULL)
                                    @if ($customer->posponed_date != NULL)
                                        <li>
                                            <span class="">Photo Shoot Postponed From: </span>
                                            <span class="text-primary">&nbsp;&nbsp;&nbsp;<b>{{ $customer->posponed_date}}</b></span>
                                        </li>
                                    @endif
                                @endif
                                @if ($customer->preshoot_date != NULL)
                                    @if ($customer->preshoot_postponed_date != NULL)
                                        <li>
                                            <span class="">Preshoot Postponed From: </span>
                                            <span class="text-primary">&nbsp;&nbsp;&nbsp;<b>{{ $customer->preshoot_postponed_date}}</b></span>
                                        </li>
                                    @endif
                                @endif
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card-box">
                            <h4 class="card-title">Postponed or Cancel</h4>
                            <table class="table table-sm table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Type</th>
                                        <th scope="col">Postpone</th>
                                        <th scope="col">Cancel</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($customer->function_types as $function_type)
                                            <tr>
                                                <td>{{ $function_type->name }}</td>
                                                <td>
                                                    <a class="btn btn-warning btn-sm" data-toggle="modal" data-target="#postponeModal{{ $function_type->pivot->id }}">Postpone</a>
                                                    <div class="modal fade" id="postponeModal{{ $function_type->pivot->id }}" tabindex="-1" role="dialog" aria-labelledby="postponeModal{{ $function_type->pivot->id }}Label" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="postponeModal{{ $function_type->pivot->id }}Label">Postpone {{ $function_type->name }} Date</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="{{ route('postpone', $function_type->pivot->id) }}" method="post">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        
                                                                        <div class="form-group">
                                                                            <label>Date</label>
                                                                            <input name="date" type="date" class="form-control" required autocomplete="off">
                                                                        </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-primary">Done</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>Cancel</td>
                                            </tr>
                                        @endforeach
                                    
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('#cost_edit_form').hide()
        $('#cost_view_form').show()
        function showCostEditForm() {
            $('#cost_edit_form').show()
            $('#cost_view_form').hide()
        }
    </script>
@endsection