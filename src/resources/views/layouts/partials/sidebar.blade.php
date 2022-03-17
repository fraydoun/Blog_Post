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
                        <span>  مدیریت وبلاگ  </span>
                    </div>
                    <div>
                        <i data-feather="chevron-right"></i>                        
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled" id="blogcategory" data-parent="#accordionExample">
                    <li>
                        <a href="{{route('category')}}">   مدیریت دسته بندی ها </a>
                    </li>

                    <li>
                        <a href="{{route('post')}}"> مدیریت  پست ها </a>
                    </li>

                    <li>
                        <a href="{{route('comment')}}"> مدیریت  نظرات </a>
                    </li>

                </ul>
            </li>
            
            
        </ul>
        
    </nav>

</div>
<!--  END SIDEBAR  -->
