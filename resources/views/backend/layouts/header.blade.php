<div class="content-header">
    <!-- Left Section -->
    <div class="d-flex align-items-center">
        <!-- Toggle Sidebar -->
        <!-- Layout API, functionality initialized in Template._uiApiLayout()-->
        <button type="button" class="btn btn-sm btn-dual mr-2 d-lg-none" data-toggle="layout" data-action="sidebar_toggle">
            <i class="fa fa-fw fa-bars"></i>
        </button>
        <!-- END Toggle Sidebar -->

        <!-- Toggle Mini Sidebar -->
        <!-- Layout API, functionality initialized in Template._uiApiLayout()-->
        <button type="button" class="btn btn-sm btn-dual mr-2 d-none d-lg-inline-block" data-toggle="layout" data-action="sidebar_mini_toggle">
            <i class="fa fa-fw fa-ellipsis-v"></i>
        </button>
        <!-- END Toggle Mini Sidebar -->
    </div>
    <!-- END Left Section -->

    <!-- Right Section -->
    <div class="d-flex align-items-center">
        <!-- User Dropdown -->
        <div class="dropdown d-inline-block ml-2">
            <button type="button" class="btn btn-sm btn-dual d-flex align-items-center" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img class="rounded-circle" src="{{ asset('backend/media/avatars/avatar10.jpg') }}" alt="Header Avatar" style="width: 21px;">
                <span class="d-none d-sm-inline-block ml-2">{{ \Illuminate\Support\Facades\Auth::user()->nick_name }}</span>
                <i class="fa fa-fw fa-angle-down d-none d-sm-inline-block ml-1 mt-1"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-md dropdown-menu-right p-0 border-0" aria-labelledby="page-header-user-dropdown">
                <div class="p-3 text-center bg-primary-dark rounded-top">
                    <img class="img-avatar img-avatar48 img-avatar-thumb" src="{{ asset('backend/media/avatars/avatar10.jpg') }}" alt="">
                    <p class="mt-2 mb-0 text-white font-w500">{{ \Illuminate\Support\Facades\Auth::user()->full_name }}</p>
                    @if(\Illuminate\Support\Facades\Auth::user()->is_super_user == 1)
                        <p class="mb-0 text-white-50 font-size-sm">Super User</p>
                    @else
                        <p class="mb-0 text-white-50 font-size-sm">{{ session('user_data')['basic_info']->name }}</p>
                    @endif
                </div>
                <div class="p-2">
                    <a class="dropdown-item d-flex align-items-center justify-content-between" href="{{url('user/profile') }}">
                        <span class="font-size-sm font-w500">My Profile</span>
                    </a>
                    <a class="dropdown-item d-flex align-items-center justify-content-between" href="{{url('change_password')}}">
                        <span class="font-size-sm font-w500">Change Password</span>
                    </a>
                    <div role="separator" class="dropdown-divider"></div>
                    <a class="dropdown-item d-flex align-items-center justify-content-between" href="{{ route('logout') }}">
                        <span class="font-size-sm font-w500">Log Out</span>
                    </a>
                </div>
            </div>
        </div>
        <!-- END User Dropdown -->
    </div>
    <!-- END Right Section -->
</div>
