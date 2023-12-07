@extends('backend.layouts.master')
@section('css_after')

@endsection
@section('content')
    <div class="content">
        <!-- Quick Actions -->

        <div class="row">
            <div class="col-6">
                <a class="block block-rounded block-link-shadow text-center" href="{{url('user/profile/'.$user->id.'/edit')}}">
                    <div class="block-content block-content-full">
                        <div class="font-size-h2 text-dark">
                            <i class="fa fa-pencil-alt"></i>
                        </div>
                    </div>
                    <div class="block-content py-2 bg-body-light">
                        <p class="font-w600 font-size-sm text-muted mb-0">
                            Edit Profile
                        </p>
                    </div>
                </a>
            </div>
            <div class="col-6">
                <a class="block block-rounded block-link-shadow text-center" href="{{url('change_password')}}">
                    <div class="block-content block-content-full">
                        <div class="font-size-h2 text-danger">
                            <i class="fa fa-lock-open"></i>
                        </div>
                    </div>
                    <div class="block-content py-2 bg-body-light">
                        <p class="font-w600 font-size-sm text-danger mb-0">
                            Change Password
                        </p>
                    </div>
                </a>
            </div>
        </div>
        <!-- END Quick Actions -->

        <!-- User Info -->
        <div class="block block-rounded">
            <div class="block-content text-center">
                <div class="py-4">
                    <div class="mb-3">
                        <img class="img-avatar" src="{{ asset('backend/media/avatars/avatar13.jpg') }}" alt="">
                    </div>
                    <h1 class="font-size-lg mb-0">
                        {{ $user->full_name }} <i class="fa fa-star text-warning" data-toggle="tooltip" title="Premium Member"></i>
                    </h1>
                    <p class="font-size-sm text-muted"></p>
                </div>
            </div>
            <div class="block-content bg-body-light text-center">
                <div class="row items-push text-uppercase">
                    <div class="col-12">
                        <div class="font-w600 text-dark mb-1 text-center">Available Leaves</div>
                        <a class="link-fx font-size-h3 text-primary text-center" href="{{url('leaveApply/manage')}}">{{$available_leave}}</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- END User Info -->

        <!-- User Information -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">User Information</h3>
            </div>
            <div class="block-content">
                <div class="row">
                    <div class="col-lg-6">
                        <!-- Billing Address -->
                        <div class="block block-rounded block-bordered">
                            <div class="block-header border-bottom">
                                <h3 class="block-title">Official Information</h3>
                            </div>
                            <div class="block-content">
                                <div class="font-size-h4 mb-1">{{$user->full_name}}</div>
                                <div class="font-size-sm">
                                    Employee ID: {{$user->employee_id}}<br>
                                    @if($user_official_info)
                                    Designation: {{$user_official_info->designation_name}}<br>
                                    Role: {{$user_official_info->role_name}}<br>
                                    Department: {{$user_official_info->department_name}}<br>
                                    Branch:{{$user_official_info->branch_name}}<br>
                                    @endif
                                    <br><br>
                                    <i class="fa fa-phone"></i> {{$user->phone_number}}<br>
                                    <i class="fa fa-envelope-o"></i> <a href="javascript:void(0)">{{$user->email}}</a><br>
                                    @if($user->basicInfo)
                                    <i class="fa fa-envelope-o"></i> <a href="javascript:void(0)">{{$user->basicInfo->personal_email}}</a><br>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- END Billing Address -->
                    </div>

                    <div class="col-lg-6">
                        <!-- Shipping Address -->
                        @if($user->personalInfo)
                        <div class="block block-rounded block-bordered">
                            <div class="block-header border-bottom">
                                <h3 class="block-title">Personal Information</h3>
                            </div>
                            <div class="block-content">
                                {{--<div class="font-size-h4 mb-1">John Parker</div>--}}

                                <div class="font-size-sm">
                                    Father name: {{$user->personalInfo->father_name}}<br>
                                    Mother name: {{$user->personalInfo->mother_name}}<br>
                                    NID: {{$user->personalInfo->nid}}<br>
                                    Birth Certificate: {{$user->personalInfo->birth_certificate}}<br>
                                    Passport No: {{$user->personalInfo->passport_no}}<br>
                                    Date of Birth: {{$user->personalInfo->dob}}<br> Gender:
                                    @if(Config::get('variable_constants.gender.male')==$user->personalInfo->gender)
                                        male<br>
                                    @endif
                                    @if(Config::get('variable_constants.gender.female')==$user->personalInfo->gender)
                                        female<br>
                                    @endif
                                    Religion:
                                    @if(Config::get('variable_constants.religion.islam')==$user->personalInfo->religion)
                                        islam<br>
                                    @endif
                                    @if(Config::get('variable_constants.religion.hindu')==$user->personalInfo->religion)
                                        hindu<br>
                                    @endif
                                    @if(Config::get('variable_constants.religion.christian')==$user->personalInfo->religion)
                                        christian<br>
                                    @endif
                                    @if(Config::get('variable_constants.religion.buddhist')==$user->personalInfo->religion)
                                        buddhist<br>
                                    @endif
                                    @if(Config::get('variable_constants.religion.others')==$user->personalInfo->religion)
                                        others<br>
                                    @endif
                                    Blood group:
                                    @if(Config::get('variable_constants.blood_group.O+')==$user->personalInfo->blood_group)
                                        O+<br>
                                    @endif
                                    @if(Config::get('variable_constants.blood_group.O-')==$user->personalInfo->blood_group)
                                        O-<br>
                                    @endif
                                    @if(Config::get('variable_constants.blood_group.A+')==$user->personalInfo->blood_group)
                                        A+<br>
                                    @endif
                                    @if(Config::get('variable_constants.blood_group.A-')==$user->personalInfo->blood_group)
                                        A-<br>
                                    @endif
                                    @if(Config::get('variable_constants.blood_group.B+')==$user->personalInfo->blood_group)
                                        B+<br>
                                    @endif
                                    @if(Config::get('variable_constants.blood_group.B-')==$user->personalInfo->blood_group)
                                        B-<br>
                                    @endif
                                    @if(Config::get('variable_constants.blood_group.AB+')==$user->personalInfo->blood_group)
                                        AB+<br>
                                    @endif
                                    @if(Config::get('variable_constants.blood_group.AB-')==$user->personalInfo->blood_group)
                                        AB-<br>
                                    @endif
                                    Marital status:
                                    @if(Config::get('variable_constants.marital_status.unmarried')==$user->personalInfo->marital_status)
                                        unmarried<br>
                                    @endif
                                    @if(Config::get('variable_constants.marital_status.married')==$user->personalInfo->marital_status)
                                        married<br>
                                    @endif
                                    @if(Config::get('variable_constants.marital_status.divorced')==$user->personalInfo->marital_status)
                                        divorced<br>
                                    @endif
                                    @if(Config::get('variable_constants.marital_status.widowed')==$user->personalInfo->marital_status)
                                        widowed<br>
                                    @endif
                                    No of Children {{$user->personalInfo->no_of_children}}<br>
                                    <br>
                                </div>

                            </div>
                        </div>
                    @endif
                        <!-- END Shipping Address -->
                    </div>
                </div>
            </div>
        </div>
        <!-- END User Information -->
        <!-- Emergency Contact -->
        @if(count($user->emergencyContacts)>1)
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Emergency Contact</h3>
            </div>
            <div class="block-content">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="block block-rounded block-bordered">
                            <div class="block-header border-bottom">
                                <h3 class="block-title">Emergency Contact 1</h3>
                            </div>
                            <div class="block-content">
                                <div class="font-size-h4 mb-1">{{$user->emergencyContacts[0]->name}}</div>
                                <div class="font-size-sm">
                                    Relation: {{$user->emergencyContacts[0]->relation}}<br>
                                    <br>
                                    <i class="fa fa-phone"></i> {{$user->emergencyContacts[0]->phone_number}}<br>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">

                        <div class="block block-rounded block-bordered">
                            <div class="block-header border-bottom">
                                <h3 class="block-title">Emergency Contact 1</h3>
                            </div>
                            <div class="block-content">
                                <div class="font-size-h4 mb-1">{{$user->emergencyContacts[1]->name}}</div>
                                <div class="font-size-sm">
                                    Relation: {{$user->emergencyContacts[1]->relation}}<br>
                                    <br>
                                    <i class="fa fa-phone"></i> {{$user->emergencyContacts[1]->phone_number}}<br>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        @endif
        <!-- END Emergency Contact -->

        <!-- Addresses -->
        @if(count($user_address)>1)
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Addresses</h3>
            </div>
            <div class="block-content">
                <div class="row">
                    <div class="col-lg-6">
                        <!-- Billing Address -->
                        <div class="block block-rounded block-bordered">
                            <div class="block-header border-bottom">
                                <h3 class="block-title">Present Address</h3>
                            </div>
                            <div class="block-content">
                                <div class="font-size-h4 mb-1">{{$user_address[0]->address}}</div>
                            </div>
                        </div>
                        <!-- END Billing Address -->
                    </div>
                    <div class="col-lg-6">
                        <!-- Shipping Address -->
                        <div class="block block-rounded block-bordered">
                            <div class="block-header border-bottom">
                                <h3 class="block-title">Permanent Address</h3>
                            </div>
                            <div class="block-content">
                                <div class="font-size-h4 mb-1">{{$user_address[1]->address}}</div>
                            </div>
                        </div>
                        <!-- END Shipping Address -->
                    </div>
                </div>
            </div>
        </div>
        @endif
        <!-- END Addresses -->
        <!-- Academic Info -->
        @if(count($user->academicInfo)>0)
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Academic Information</h3>
            </div>

            <div class="block-content">
                <?php $index=0 ?>
                @foreach($user->academicInfo  as $academy)
                        <div class="row">
                            @for($i=0; $i<2 && $index<count($user->academicInfo); $i=$i+1)
                            <div class="col-lg-6">
                                <!-- Billing Address -->
                                <div class="block block-rounded block-bordered">
                                    <div class="block-header border-bottom">
                                        <h3 class="block-title">{{$userInstituteDegree[$index]['degree_name']}}</h3>
                                    </div>
                                    <div class="block-content">
                                        <div class="font-size-h4 mb-1">{{$academy->major}}</div>
                                        <div class="font-size-sm">
                                            GPA: {{$academy->gpa}}<br>
                                            Institute: {{$userInstituteDegree[$index]['institute_name']}}<br>
                                            Passing Year: {{$academy->passing_year}}<br><br>
                                        </div>
                                    </div>
                                </div>
                                <!-- END Billing Address -->
                            </div>
                                <?php $index=$index+1 ?>
                                @endfor
                        </div>
                @endforeach
            </div>


        </div>
        @endif

        <!-- END Academic Info -->

        <!-- Banking -->
        @if($banking)
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">Banking Information</h3>
            </div>
            <div class="block-content">
                <div class="row">
                    <div class="col-lg-6">
                        <!-- Billing Address -->
                        <div class="block block-rounded block-bordered">
                            <div class="block-header border-bottom">
                                <h3 class="block-title">Bank Info</h3>
                            </div>
                            <div class="block-content">
                                <div class="font-size-h4 mb-1">{{$banking->account_name}}</div>
                                <div class="font-size-sm">
                                    Account no: {{$banking->account_number}}<br>
                                    Routing no: {{$banking->routing_no}}<br>
                                    Bank: {{$banking->bank_name}}<br>
                                    Branch: {{$banking->branch}}<br>
                                    <br><br>
                                </div>
                            </div>
                        </div>
                        <!-- END Billing Address -->
                    </div>
                    <div class="col-lg-6">
                        <!-- Shipping Address -->
                        <div class="block block-rounded block-bordered">
                            <div class="block-header border-bottom">
                                <h3 class="block-title">Nominee</h3>
                            </div>
                            <div class="block-content">
                                <div class="font-size-h4 mb-1">{{$banking->name}}<br></div>
                                <div class="font-size-sm">
                                    NID: {{$banking->nid}}<br>
                                    Relation: {{$banking->relation}}<br>
                                    <br>
                                    <i class="fa fa-phone"></i> ({{$banking->phone_number}}<br><br>
                                    <i class="fa fa-envelope-o"></i> <a href="javascript:void(0)">{{$banking->email}}<br></a>
                                </div>
                            </div>
                        </div>
                        <!-- END Shipping Address -->
                    </div>
                </div>
            </div>
        </div>
        @endif
        <!-- END Banking -->

    </div>

@endsection

@section('js_after')

@endsection
