<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">Main</li>
                <li class="active">
                    <a href=""><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a>
                </li>

                <li>
                    <a href="{{ route('customer.create') }}"><i class="fas fa-clipboard-list"></i> <span>Create New</span></a>
                </li>

                <li>
                    <a href=""><i class="fas fa-users"></i> <span>Events List</span></a>
                </li>

                <li class="submenu">
                    <a href="#"><i class="fa fa-user"></i> <span> Master </span> <span><i class="fas fa-caret-down"></i></span></a>
                    <ul style="display: none;">
                        <li><a href="">Function Type</a></li>
                        <li><a href="">Packages</a></li>
                        <li><a href="{{ route('item.create') }}">Items</a></li>
                        @if (auth()->check())
                        @if (auth()->user()->is_admin())
                            <li><a href="">Branches</a></li>
                        @endif
                        @endif
                    </ul>
                </li>

                <li class="submenu">
                    <a href="#"><i class="fas fa-book"></i> <span> Reports </span> <span><i class="fas fa-caret-down"></i></span></a>
                    <ul style="display: none;">
                        <li><a href="">Wedding Reservation</a></li>
                        <li><a href="">Reserved Items</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>