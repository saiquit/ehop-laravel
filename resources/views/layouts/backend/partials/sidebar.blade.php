<div class="left-side-bar">
		<div class="brand-logo">
			<a  href="{{ route('admin.dashboard') }}">
				<img src="{{ asset('assets/backend/vendors/images/deskapp-logo.svg') }}" alt="" class="dark-logo">
				<img src="{{ asset('assets/backend/vendors/images/deskapp-logo-white.svg') }}" alt="" class="light-logo">
			</a>
			<div class="close-sidebar" data-toggle="left-sidebar-close">
				<i class="ion-close-round"></i>
			</div>
		</div>
		<div class="menu-block customscroll">
			<div class="sidebar-menu">
				<ul id="accordion-menu">
                    @if (auth()->user()->role_id == 1)
                        <li>
                            <a href="{{ route('admin.dashboard') }}" class="dropdown-toggle no-arrow {{Request::is('admin/dashboard') ? 'active' : ''}}">
                                <span class="micon dw dw-house-1"></span><span class="mtext">Dashboard</span>
                            </a>
                        </li>
                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle {{Request::is('admin/product*') ? 'active' : ''}}">
                                <span class="micon dw dw-library"></span><span class="mtext">Product</span>
                            </a>
                            <ul class="submenu">
                                <li><a class="{{Request::is('admin/product') ? 'active' : ''}}" href="{{ route('admin.product.index') }}">All Products</a></li>
                                <li><a class="{{Request::is('admin/product/create') ? 'active' : ''}}" href="{{ route('admin.product.create') }}">Create Product</a></li>
                            </ul>
                        </li>

                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle {{Request::is('admin/category*') ? 'active' : ''}}">
                                <span class="micon dw dw-book-1"></span><span class="mtext">Category</span>
                            </a>
                            <ul class="submenu">
                                <li><a class="{{Request::is('admin/category') ? 'active' : ''}}" href="{{ route('admin.category.index') }}">All Categories</a></li>
                                <li><a class="{{Request::is('admin/category/create') ? 'active' : ''}}" href="{{ route('admin.category.create') }}">Create Category</a></li>
                            </ul>
                        </li>
                        <li>
                        <div class="dropdown-divider"></div>
                        </li>
                        <li>
                        <div class="sidebar-small-cap">Extra</div>
                        </li>
                        <li>
                        <a href="javascript:;" onclick="document.getElementById('logout_form').submit()" class="dropdown-toggle no-arrow">
                            <span class="micon dw dw-chat3"></span><span class="mtext">Log out</span>
                        </a>
                        <form id="logout_form" method="POST" action="{{ route('logout') }}" hidden >
                                @csrf
                        </form>
                        </li>
                    @endif


				</ul>
			</div>
		</div>
	</div>
