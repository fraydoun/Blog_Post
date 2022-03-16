 <!--  BEGIN SIDEBAR  -->
 <div class="sidebar-wrapper sidebar-theme">
            
    <nav id="sidebar">
        <div class="shadow-bottom"></div>

        <ul class="list-unstyled menu-categories" id="accordionExample">
            <li class="menu">
                <a href="{{route('home')}}" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <i data-feather="home"></i>
                        <span>داشبرد</span>
                    </div>
                </a>
            </li>



            <li class="menu">
                <a href="#blogcategory" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <i data-feather="map-pin"></i>
                        <span> ویبلاگ دسته بندی</span>
                    </div>
                    <div>
                        <i data-feather="chevron-right"></i>                        
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="blogcategory" data-parent="#accordionExample">
                    <li>
                        <a href="{{route('category')}}">   لیست دسته بندی ها </a>
                    </li>

                </ul>
            </li>
            <li class="menu">
                <a href="#blogpost" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <i data-feather="map-pin"></i>
                        <span> پست</span>
                    </div>
                    <div>
                        <i data-feather="chevron-right"></i>                        
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="blogpost" data-parent="#accordionExample">
                    

                    <li>
                        <a href="{{route('post')}}"> لیست  پست ها </a>
                    </li>
                    {{-- <li>
                        <a href="{{route('postCreate')}}">   ایجاد پست  </a>
                    </li> --}}
                    {{-- <li>
                        <a href="{{route('postUpdate')}}">   ویرایش پست  </a>
                    </li> --}}
                </ul>
            </li>
            <li class="menu">
                <a href="#blogcomment" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <i data-feather="map-pin"></i>
                        <span> نظرات</span>
                    </div>
                    <div>
                        <i data-feather="chevron-right"></i>                        
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="blogcomment" data-parent="#accordionExample">
                    <li>
                        <a href="{{route('comment')}}"> لیست  نظرات </a>
                    </li>
                    
                </ul>
            </li>
            
            
        </ul>
        
    </nav>

</div>
<!--  END SIDEBAR  -->
