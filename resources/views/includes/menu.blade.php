{{--<!-- #menu -->
<ul id="menu" class="bg-dark dker">
    <li class="nav-divider"></li>

    @foreach($items as $routeName => $values)
    <li class="">
        <a href="{{ route($values['link']) }}">
            <i class="{{ $values['icon'] }}"></i>
            <span class="link-title">&nbsp; {{ $routeName }}</span>
            @if(isset($value['items']) && sizeof($values['items'])>0)
                <span class="fa fa-angle-down"></span>
            @endif
        </a>
    </li>
    @endforeach

</ul><!-- /#menu -->
--}}



<!-- #menu -->
<ul id="menu" class="bg-dark dker">
 <!--<li class="nav-header">Menu</li>-->
 <li class="nav-divider"></li>
 <li class="">
     <a href="dashboard.html">
         <i class="fa fa-dashboard"></i>
         <span class="link-title">&nbsp;Principal</span>
     </a>
 </li>
 <li class="">
     <a href="">
         <i class="fa fa-users "></i>
         <span class="link-title">Conductores</span>
         <span class="fa arrow"></span>
     </a>
     <ul>
         <li>
             <a href="{{ route('allDrivers') }}">
                 <i class="fa fa-angle-right"></i>&nbsp; Nuevo conductor </a>
         </li>
         <li>
             <a href="{{ route('allDrivers') }}">
                 <i class="fa fa-angle-right"></i>&nbsp; Todos los conductores </a>
         </li>
     </ul>
 </li>
 <li class="">
     <a href="javascript:;">
         <i class="fa fa-tasks"></i>
         <span class="link-title">Components</span>
         <span class="fa arrow"></span>
     </a>
     <ul>
         <li>
             <a href="bgcolor.html">
                 <i class="fa fa-angle-right"></i>&nbsp; Bg Color </a>
         </li>
         <li>
             <a href="bgimage.html">
                 <i class="fa fa-angle-right"></i>&nbsp; Bg Image </a>
         </li>
         <li>
             <a href="button.html">
                 <i class="fa fa-angle-right"></i>&nbsp; Buttons </a>
         </li>
         <li>
             <a href="icon.html">
                 <i class="fa fa-angle-right"></i>&nbsp; Icon </a>
         </li>
         <li>
             <a href="pricing.html">
                 <i class="fa fa-angle-right"></i>&nbsp; Pricing Table </a>
         </li>
         <li>
             <a href="progress.html">
                 <i class="fa fa-angle-right"></i>&nbsp; Progress </a>
         </li>
     </ul>
 </li>
 <li class="">
     <a href="javascript:;">
         <i class="fa fa-pencil"></i>
       <span class="link-title">
     Forms
</span>
         <span class="fa arrow"></span>
     </a>
     <ul>
         <li>
             <a href="form-general.html">
                 <i class="fa fa-angle-right"></i>&nbsp; Form General </a>
         </li>
         <li>
             <a href="form-validation.html">
                 <i class="fa fa-angle-right"></i>&nbsp; Form Validation </a>
         </li>
         <li>
             <a href="form-wizard.html">
                 <i class="fa fa-angle-right"></i>&nbsp; Form Wizard </a>
         </li>
         <li>
             <a href="form-wysiwyg.html">
                 <i class="fa fa-angle-right"></i>&nbsp; Form WYSIWYG </a>
         </li>
     </ul>
 </li>
 <li>
     <a href="table.html">
         <i class="fa fa-table"></i>
         <span class="link-title">Tables</span>
     </a>
 </li>
 <li>
     <a href="file.html">
         <i class="fa fa-file"></i>
       <span class="link-title">
File Manager
   </span> </a>
 </li>
 <li>
     <a href="typography.html">
         <i class="fa fa-font"></i>
       <span class="link-title">
     Typography
   </span>  </a>
 </li>
 <li>
     <a href="maps.html">
         <i class="fa fa-map-marker"></i><span class="link-title">
     Maps
   </span> </a>
 </li>
 <li>
     <a href="chart.html">
         <i class="fa fa fa-bar-chart-o"></i>
       <span class="link-title">
     Charts
   </span> </a>
 </li>
 <li>
     <a href="calendar.html">
         <i class="fa fa-calendar"></i>
       <span class="link-title">
     Calendar
   </span> </a>
 </li>
 <li>
     <a href="javascript:;">
         <i class="fa fa-exclamation-triangle"></i>
       <span class="link-title">
       Error Pages
     </span>
         <span class="fa arrow"></span>
     </a>
     <ul>
         <li>
             <a href="403.html">
                 <i class="fa fa-angle-right"></i>&nbsp;403</a>
         </li>
         <li>
             <a href="404.html">
                 <i class="fa fa-angle-right"></i>&nbsp;404</a>
         </li>
         <li>
             <a href="405.html">
                 <i class="fa fa-angle-right"></i>&nbsp;405</a>
         </li>
         <li>
             <a href="500.html">
                 <i class="fa fa-angle-right"></i>&nbsp;500</a>
         </li>
         <li>
             <a href="503.html">
                 <i class="fa fa-angle-right"></i>&nbsp;503</a>
         </li>
         <li>
             <a href="offline.html">
                 <i class="fa fa-angle-right"></i>&nbsp;offline</a>
         </li>
         <li>
             <a href="countdown.html">
                 <i class="fa fa-angle-right"></i>&nbsp;Under Construction</a>
         </li>
     </ul>
 </li>
 <li>
     <a href="grid.html">
         <i class="fa fa-columns"></i>
       <span class="link-title">
Grid
</span>
     </a>
 </li>
 <li>
     <a href="blank.html">
         <i class="fa fa-square-o"></i>
       <span class="link-title">
Blank Page
</span>
     </a>
 </li>
 <li class="nav-divider"></li>
 <li>
     <a href="login.html">
         <i class="fa fa-sign-in"></i>
       <span class="link-title">
Login Page
</span>
     </a>
 </li>
 <li>
     <a href="javascript:;">
         <i class="fa fa-code"></i>
       <span class="link-title">
 Unlimited Level Menu
 </span>
         <span class="fa arrow"></span> </a>
     <ul>
         <li>
             <a href="javascript:;">Level 1  <span class="fa arrow"></span>  </a>
             <ul>
                 <li> <a href="javascript:;">Level 2</a>  </li>
                 <li> <a href="javascript:;">Level 2</a>  </li>
                 <li>
                     <a href="javascript:;">Level 2  <span class="fa arrow"></span>  </a>
                     <ul>
                         <li> <a href="javascript:;">Level 3</a>  </li>
                         <li> <a href="javascript:;">Level 3</a>  </li>
                         <li>
                             <a href="javascript:;">Level 3  <span class="fa arrow"></span>  </a>
                             <ul>
                                 <li> <a href="javascript:;">Level 4</a>  </li>
                                 <li> <a href="javascript:;">Level 4</a>  </li>
                                 <li>
                                     <a href="javascript:;">Level 4  <span class="fa arrow"></span>  </a>
                                     <ul>
                                         <li> <a href="javascript:;">Level 5</a>  </li>
                                         <li> <a href="javascript:;">Level 5</a>  </li>
                                         <li> <a href="javascript:;">Level 5</a>  </li>
                                     </ul>
                                 </li>
                             </ul>
                         </li>
                         <li> <a href="javascript:;">Level 4</a>  </li>
                     </ul>
                 </li>
                 <li> <a href="javascript:;">Level 2</a>  </li>
             </ul>
         </li>
         <li> <a href="javascript:;">Level 1</a>  </li>
         <li>
             <a href="javascript:;">Level 1  <span class="fa arrow"></span>  </a>
             <ul>
                 <li> <a href="javascript:;">Level 2</a>  </li>
                 <li> <a href="javascript:;">Level 2</a>  </li>
                 <li> <a href="javascript:;">Level 2</a>  </li>
             </ul>
         </li>
     </ul>
 </li>
</ul><!-- /#menu -->