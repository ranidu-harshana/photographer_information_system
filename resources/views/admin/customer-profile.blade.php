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
            <div class="col-md-12">
                <div class="profile-view">
                    <div class="profile-img-wrap">
                        <div class="profile-img">
                            <a href="#"><img class="avatar" src="{{ asset('assets/img/user.jpg') }}" alt=""></a>
                        </div>
                    </div>
                    <div class="profile-basic">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="profile-info-left">
                                    <h3 class="user-name m-t-0 mb-0">name</h3>
                                    <div class="staff-id">Bill Number : </div>
                                    <div class="staff-id">Booked On : </div>
                                    <div class="staff-id">Branch : </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <ul class="personal-info">
                                    <li>
                                        <span class="title">Phone 1</span>
                                        <span class="text"><a href="#">fsdfsf</a></span>
                                    </li>

                                    <li>
                                        <span class="title">Address</span>
                                        <span class="text">sdfsdfds</span>
                                    </li>


                                    <li>
                                        <span class="title">Place</span>
                                        <span class="text">fsfsdf</span>
                                    </li>
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
            <li class="nav-item" id="tab0"><a class="nav-link @if (session('tab0')) active @endif" href="#measurement_tab" data-toggle="tab">Measurements</a></li>
            <li class="nav-item" id="tab1"><a class="nav-link @if (session('tab1')) active @endif" href="#dress_selection_tab" data-toggle="tab">Dress Selection</a></li>
            <li class="nav-item" id="tab2"><a class="nav-link @if (session('tab2')) active @endif" href="#bill_tab" data-toggle="tab">Bill</a></li>
            <li class="nav-item" id="tab3"><a class="nav-link @if (session('tab3')) active @endif" href="#notes_tab" data-toggle="tab">Notes</a></li>
            <li class="nav-item" id="tab4"><a class="nav-link @if (session('tab4')) active @endif" href="#other_tab" data-toggle="tab">Other</a></li>
            
        </ul>

        <div class="tab-content">
            <div class="tab-pane @if (session('tab0')) show active @endif" id="measurement_tab" >
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <h4 class="card-title">Enter Measurements</h4>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane @if (session('tab1')) active @endif" id="dress_selection_tab">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card-box">
                            
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
                                
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-8">
                            
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