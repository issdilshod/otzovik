<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/admin/dashboard') }}" class="brand-link">
      <img src="{{ asset('assets/admin/dist/img/AdminLTELogo.png') }}" alt="{{env('APP_NAME')}} Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">{{env('APP_NAME')}}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('assets/admin/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">USER</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
                <a href="{{ url('/admin/dashboard') }}" class="nav-link {{ (request()->is('admin/dashboard*')) ? 'active' : '' }}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        {{__('menu_dashboard_title')}}
                    </p>
                </a>
            </li>

            <li class="nav-item {{ (request()->is('admin/universit*')) ? 'menu-open' : '' }}">
                <a href="{{ url('/admin/universities') }}" class="nav-link {{ (request()->is('admin/universit*')) ? 'active' : '' }}">
                    <i class="nav-icon fas fa-building"></i>
                    <p>
                        {{__('menu_universities_title')}}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ url('/admin/reviews') }}" class="nav-link {{ (request()->is('admin/review*')) ? 'active' : '' }}">
                    <i class="nav-icon fas fa-star"></i>
                    <p>
                        {{__('menu_reviews_title')}}
                    </p>
                </a>
            </li>

            <li class="nav-item {{ (request()->is('admin/blog*')) ? 'menu-open' : '' }}">
                <a href="{{ url('/admin/blog') }}" class="nav-link {{ (request()->is('admin/blog*')) ? 'active' : '' }}">
                    <i class="nav-icon fas fa-book"></i>
                    <p>
                        {{__('menu_blog_title')}}
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ url('/admin/blog/articles') }}" class="nav-link {{ (request()->is('admin/blog/article*')) ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>{{__('menu_articles_title')}}</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/admin/blog/comments') }}" class="nav-link {{ (request()->is('admin/blog/comment*')) ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>{{__('menu_comments_title')}}</p>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a href="{{ url('/admin/users') }}" class="nav-link {{ (request()->is('admin/user*')) ? 'active' : '' }}">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        {{__('menu_staff_title')}}
                    </p>
                </a>
            </li>

            <li class="nav-item {{ (request()->is('admin/settings*')) ? 'menu-open' : '' }}">
                <a href="#" class="nav-link {{ (request()->is('admin/settings*')) ? 'active' : '' }}">
                    <i class="nav-icon fas fa-cog"></i>
                    <p>
                        {{__('menu_settings_title')}}
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ url('/admin/settings/cities') }}" class="nav-link {{ (request()->is('admin/settings/cit*')) ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>{{__('menu_cities_title')}}</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/admin/settings/education_levels') }}" class="nav-link {{ (request()->is('admin/settings/education_level*')) ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>{{__('menu_education_level_title')}}</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/admin/settings/directions') }}" class="nav-link {{ (request()->is('admin/settings/direction*')) ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>{{__('menu_directions_title')}}</p>
                        </a>
                    </li>
                    <li class="nav-item {{ (request()->is('admin/settings/templates*')) ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ (request()->is('admin/settings/templates*')) ? 'active' : '' }}">
                            <i class="far fa-file nav-icon"></i>
                            <p>{{__('menu_templates_title')}}</p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ url('/admin/settings/templates/index') }}" class="nav-link {{ (request()->is('admin/settings/templates/index')) ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{__('menu_templates_index_title')}}</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/admin/settings/templates/search') }}" class="nav-link {{ (request()->is('admin/settings/templates/search')) ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{__('menu_templates_search_title')}}</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/admin/settings/templates/search2') }}" class="nav-link {{ (request()->is('admin/settings/templates/search2')) ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{__('menu_templates_search_title')}}2</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/admin/settings/templates/top') }}" class="nav-link {{ (request()->is('admin/settings/templates/top')) ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{__('menu_templates_top_title')}}</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/admin/settings/templates/universities') }}" class="nav-link {{ (request()->is('admin/settings/templates/universities')) ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{__('menu_templates_universities_title')}}</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/admin/settings/templates/university') }}" class="nav-link {{ (request()->is('admin/settings/templates/university')) ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{__('menu_templates_university_title')}}</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/admin/settings/templates/reviews') }}" class="nav-link {{ (request()->is('admin/settings/templates/reviews')) ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{__('menu_templates_reviews_title')}}</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/admin/settings/templates/review') }}" class="nav-link {{ (request()->is('admin/settings/templates/review')) ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{__('menu_templates_review_title')}}</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/admin/settings/templates/review_add') }}" class="nav-link {{ (request()->is('admin/settings/templates/review_add')) ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{__('menu_templates_review_add_title')}}</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/admin/settings/templates/articles') }}" class="nav-link {{ (request()->is('admin/settings/templates/articles')) ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{__('menu_templates_articles_title')}}</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/admin/settings/templates/about') }}" class="nav-link {{ (request()->is('admin/settings/templates/about')) ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{__('menu_templates_about_title')}}</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/admin/settings/templates/faq') }}" class="nav-link {{ (request()->is('admin/settings/templates/faq')) ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{__('menu_templates_faq_title')}}</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/admin/settings/templates/educational') }}" class="nav-link {{ (request()->is('admin/settings/templates/educational')) ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>{{__('menu_templates_educational_title')}}</p>
                                </a>
                            </li-->
                        </ul>
                    </li>
                    <!--li class="nav-item">
                        <a href="{{ url('/admin/setting/education-types') }}" class="nav-link {{ (request()->is('admin/setting/education-type*')) ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>{{__('menu_education_type_title')}}</p>
                        </a>
                    </li-->
                </ul>
            </li>
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>