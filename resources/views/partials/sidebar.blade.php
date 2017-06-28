@inject('request', 'Illuminate\Http\Request')
<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <ul class="page-sidebar-menu"
            data-keep-expanded="false"
            data-auto-scroll="true"
            data-slide-speed="200">
            
            <li class="{{ $request->segment(1) == 'home' ? 'active' : '' }}">
                <a href="{{ url('/') }}">
                    <i class="fa fa-wrench"></i>
                    <span class="title">@lang('quickadmin.qa_dashboard')</span>
                </a>
            </li>

            
            @can('user_management_access')
            <li class="">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span class="title">@lang('quickadmin.user-management.title')</span>
                    <span class="fa arrow"></span>
                </a>
                <ul class="sub-menu">
                
                @can('role_access')
                <li class="{{ $request->segment(2) == 'roles' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.roles.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                                @lang('quickadmin.roles.title')
                            </span>
                        </a>
                    </li>
                @endcan
                @can('user_access')
                <li class="{{ $request->segment(2) == 'users' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.users.index') }}">
                            <i class="fa fa-user"></i>
                            <span class="title">
                                @lang('quickadmin.users.title')
                            </span>
                        </a>
                    </li>
                @endcan
                </ul>
            </li>
            @endcan
            @can('product_access')
            <li class="{{ $request->segment(2) == 'products' ? 'active' : '' }}">
                <a href="{{ route('admin.products.index') }}">
                    <i class="fa fa-gears"></i>
                    <span class="title">@lang('quickadmin.products.title')</span>
                </a>
            </li>
            @endcan
              @can('review_access')
            <li class="{{ $request->segment(2) == 'reviews' ? 'active' : '' }}">
                <a href="{{ route('admin.reviews.index') }}">
                    <i class="fa fa-gears"></i>
                    <span class="title">@lang('quickadmin.reviews.title')</span>
                </a>
            </li>
            @endcan
            @can('category_access')
            <li class="{{ $request->segment(2) == 'categories' ? 'active' : '' }}">
                <a href="{{ route('admin.categories.index') }}">
                    <i class="fa fa-stack-overflow"></i>
                    <span class="title">@lang('quickadmin.category.title')</span>
                </a>
            </li>
            @endcan
            
              
          
            
            
            @can('specification_access')
            <li class="{{ $request->segment(2) == 'specifications' ? 'active' : '' }}">
                <a href="{{ route('admin.specifications.index') }}">
                    <i class="fa fa-bars"></i>
                    <span class="title">@lang('quickadmin.specification.title')</span>
                </a>
            </li>
            @endcan
            
             @can('menu_access')
            <li class="{{ $request->segment(2) == 'menus' ? 'active' : '' }}">
                <a href="{{ route('admin.menus.index') }}">
                    <i class="fa fa-gears"></i>
                    <span class="title">@lang('quickadmin.menu.title')</span>
                </a>
            </li>
            @endcan
            
            @can('item_access')
            <li class="{{ $request->segment(2) == 'items' ? 'active' : '' }}">
                <a href="{{ route('admin.items.index') }}">
                    <i class="fa fa-gears"></i>
                    <span class="title">@lang('quickadmin.item.title')</span>
                </a>
            </li>
            @endcan
            
            @can('news_access')
            <li class="{{ $request->segment(2) == 'news' ? 'active' : '' }}">
                <a href="{{ route('admin.news.index') }}">
                    <i class="fa fa-gears"></i>
                    <span class="title">@lang('quickadmin.news.title')</span>
                </a>
            </li>
            @endcan
               @can('page_access')
            <li class="{{ $request->segment(2) == 'pages' ? 'active' : '' }}">
                <a href="{{ route('admin.pages.index') }}">
                    <i class="fa fa-gears"></i>
                    <span class="title">@lang('quickadmin.pages.title')</span>
                </a>
            </li>
            @endcan
        @can('banners_access')
            <li class="{{ $request->segment(2) == 'banners' ? 'active' : '' }}">
                <a href="{{ route('admin.banners.index') }}">
                    <i class="fa fa-gears"></i>
                    <span class="title">@lang('quickadmin.banners.title')</span>
                </a>
            </li>
            @endcan
            @can('order_access')
            <li class="{{ $request->segment(2) == 'orders' ? 'active' : '' }}">
                <a href="{{ route('admin.orders.index') }}">
                    <i class="fa fa-gears"></i>
                    <span class="title">@lang('quickadmin.order.title')</span>
                </a>
            </li>
            @endcan

            

            <li class="{{ $request->segment(1) == 'change_password' ? 'active' : '' }}">
                <a href="{{ route('auth.change_password') }}">
                    <i class="fa fa-key"></i>
                    <span class="title">Change password</span>
                </a>
            </li>

            <li>
                <a href="#logout" onclick="$('#logout').submit();">
                    <i class="fa fa-arrow-left"></i>
                    <span class="title">@lang('quickadmin.qa_logout')</span>
                </a>
            </li>
        </ul>
    </div>
</div>
{!! Form::open(['route' => 'auth.logout', 'style' => 'display:none;', 'id' => 'logout']) !!}
<button type="submit">@lang('quickadmin.logout')</button>
{!! Form::close() !!}
