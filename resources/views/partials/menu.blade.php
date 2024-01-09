<?php
    $loginuser_id = Auth::user()->id;
    $current_role =DB::table('role_user')->where('user_id', '=', $loginuser_id)->get();
?>

<div class="w-[19.5%] h-screen bg-white">
    <div class="pt-6 pb-10">
        <?php 
            $logo = \App\Page::where('id',1)->first();
        ?>
        @if($logo->logo)
            <a href="./">
                <img src="{{url($logo->logo)}}" class="w-1/2 mx-auto">
            </a>
        @else
            <a href="./">  
                <label class="logo">BT</label>
            </a>
        @endif
    </div>
   
    @foreach($current_role as $user)
        @if($user->role_id == 1)
        {{-- <ul class="nav">
            <li class="nav-item ">
                <a href="{{ route("admin.home") }}" class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt color_icon">

                    </i>
                    {{ trans('global.dashboard') }}
                </a>
            </li>
            <li class="nav-item {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
                <a href="{{ route("admin.users.index") }}" class="nav-link " style="color:black">
                    <i class="fas fa-users nav-icon"></i>
                    {{ trans('global.userManagement.title') }}
                </a>
            </li>
            <li class="{{ request()->is('admin') || request()->is('admin/project-trees/*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route("admin.home") }}">
                    <i class="nc-icon nc-notes color_icon"></i>
                    <p>Project Tree</p>
                </a>
            </li>
            <li class="{{ request()->is('admin/room-type') || request()->is('admin/room-type/*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url("admin/room-type") }} ">
                    <i class="nc-icon nc-paper-2 color_icon"></i>
                    <p>Room Type</p>
                </a>
            </li>
            <li class="{{ request()->is('admin/ext-room-type') || request()->is('admin/ext-room-type/*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url("admin/ext-room-type") }} ">
                    <i class="nc-icon nc-paper-2 color_icon"></i>
                    <p>Ext. Room Type</p>
                </a>
            </li>
            <li class="{{ request()->is('admin/stack-room-type') || request()->is('admin/stack-room-type/*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url("admin/stack-room-type") }} ">
                    <i class="nc-icon nc-paper-2 color_icon"></i>
                    <p>Stack Room Type</p>
                </a>
            </li>
            <li class="{{ request()->is('admin/building-type') || request()->is('admin/building-type/*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url("admin/building-type") }}">
                    <i class="nc-icon nc-atom color_icon"></i>
                    <p>Building Type</p>
                </a>
            </li>
            <li class="{{ request()->is('admin/plot-type') || request()->is('admin/plot-type/*') ? 'active' : '' }}">
                <a class="nav-link " href="{{ url("admin/plot-type") }}">
                    <i class="nc-icon nc-pin-3 color_icon"></i>
                    <p>Plot Type</p>
                </a>
             </li>
             <li class="nav-item hov-elemnt">
                <a class="nav-link dropdown-toggle" id="drop_type" href="#sidebar-dropdown" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="dropdown">
                <i class="nc-icon nc-pin-3 color_icon"></i>
                <p>Elements</p>
                </a>
            </li>
            <div class="collapse multi-collapse" id="sidebar-dropdown" style="background-color:#dab8bb;"aria-labelledby="dropdownMenuLink" >
                <ul class="nav mt-1 pl-2">
                    <li class="{{ request()->is('admin/wall-type') || request()->is('admin/wall-type/*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url("admin/wall-type") }}">
                            <i class="nc-icon nc-pin-3 color_icon"></i>
                            <p>Walls Type</p>
                        </a>
                    </li>
                    <li class="{{ request()->is('admin/floor-type') || request()->is('admin/floor-type/*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url("admin/floor-type") }}">
                            <i class="nc-icon nc-pin-3 color_icon"></i>
                            <p>Floor Type</p>
                        </a>
                    </li>
                    <li class="{{ request()->is('admin/door-type') || request()->is('admin/door-type/*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url("admin/door-type") }}">
                            <i class="nc-icon nc-pin-3 color_icon"></i>
                            <p>Door Type</p>
                        </a>
                    </li>
                    <li class="{{ request()->is('admin/window-type') || request()->is('admin/window-type/*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url("admin/window-type") }}">
                            <i class="nc-icon nc-pin-3 color_icon"></i>
                            <p>Window Type</p>
                        </a>
                    </li>
                    <li class="{{ request()->is('admin/ceiling-type') || request()->is('admin/ceiling-type/*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url("admin/ceiling-type") }}">
                            <i class="nc-icon nc-pin-3 color_icon"></i>
                            <p>Ceiling Type</p>
                        </a>
                    </li>
                    <li class="{{ request()->is('admin/railing-type') || request()->is('admin/railing-type/*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url("admin/railing-type") }}">
                            <i class="nc-icon nc-pin-3 color_icon"></i>
                            <p>Railing Type</p>
                        </a>
                    </li>
                    <li class="{{ request()->is('admin/furniture-type') || request()->is('admin/furniture-type/*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url("admin/furniture-type") }}">
                            <i class="nc-icon nc-pin-3 color_icon"></i>
                            <p>Furniture Type</p>
                        </a>
                    </li>
                    <li class="{{ request()->is('admin/lights-type') || request()->is('admin/lights-type/*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url("admin/lights-type") }}">
                            <i class="nc-icon nc-pin-3 color_icon"></i>
                            <p>Lights Type</p>
                        </a>
                    </li>
                </ul>
            </div>
            <li class="{{ request()->is('admin/blog') || request()->is('admin/blog') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url("admin/blog") }}">
                    <i class="nc-icon nc-paper-2 color_icon"></i>
                    <p>Blogs</p>
                </a>
            </li>
            <li class="{{ request()->is('admin/faqs') || request()->is('admin/faqs') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url("admin/faqs") }}">
                    <i class="nc-icon nc-paper-2 color_icon"></i>
                    <p>FAQS</p>
                </a>
            </li>
            <li class="{{ request()->is('admin/subscriptions') || request()->is('admin/subscriptions') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url("admin/subscriptions") }}">
                    <i class="nc-icon nc-paper-2 color_icon"></i>
                    <p>Subscriptions</p>
                </a>
            </li>
            <li>
                <a class="nav-link" href="{{ url("admin/models") }}">
                    <i class="nc-icon nc-paper-2 color_icon"></i>
                    <p>3D Models</p>
                </a>
            </li>
            <li>
                <a class="nav-link" href="{{ url("admin/view-csv-file") }}">
                    <i class="nc-icon nc-cloud-download-93 mr-2 color_icon"></i>
                    <p>View CSV File </p>
                </a>
            </li>
            <li class="{{ request()->is('admin/view-json-file') || request()->is('admin/view-json-file') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url("admin/view-json-file") }}">
                    <i class="nc-icon nc-cloud-download-93 mr-2 color_icon"></i>
                    <p>View Json File </p>
                </a>
            </li>
            <li class="{{ request()->is('admin/3d-view-model') || request()->is('admin/3d-view-model') ? 'active' : '' }}">
                <a class="nav-link" href="/admin/3d-view-model">
                    <i class="nc-icon nc-planet color_icon"></i>
                    <p>3D View</p>
                </a>
            </li>
            <li class="{{ request()->is('admin/pages') || request()->is('admin/pages') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url("admin/pages") }} ">
                    <i class="nc-icon nc-paper-2 color_icon"></i>
                    <p>Page Content</p>
                </a>
            </li>
            <li class="{{ request()->is('admin/usersetting') || request()->is('admin/usersetting') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url("admin/usersetting") }} ">
                    <i class="nc-icon nc-paper-2 color_icon"></i>
                    <p>User Setting</p>
                </a>
            </li>
            <li class="{{ request()->is('admin/site-settings') || request()->is('admin/site-settings') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url("admin/site-settings") }} ">
                    <i class="nc-icon nc-paper-2 color_icon"></i>
                    <p>Site Setting</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <i class="nav-icon fas fa-sign-out-alt ">

                    </i>
                    {{ trans('global.logout') }}
                </a>
            </li>
        </ul> --}}
            <a class="hover:no-underline" href="{{ route("admin.home") }}">
                <div class="w-full flex flex-row items-center justify-start h-16 px-6 box-border gap-[10px] text-base hover:bg-neutral-500 hover:text-white rounded-r-xl {{ request()->is('admin') ? 'text-white bg-black' : ''}} ">
                    <i class="text-xl w-6 fas fa-th-large {{ request()->is('admin') ? 'text-red-500' : '' }}"></i>
                    <div class="relative leading-[100%] font-semibold">{{ trans('global.dashboard') }}</div>
                </div>
            </a>
            <a class="hover:no-underline" href="{{ route("admin.users.index") }}">
                <div class="w-full flex flex-row items-center justify-start h-16 px-6 box-border gap-[10px] text-base hover:bg-neutral-500 hover:text-white rounded-r-xl {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'text-white bg-black' : ''}} ">
                    <i class="text-xl w-6 fas fa-user {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'text-red-500' : '' }}"></i>
                    <div class="relative leading-[100%] font-semibold">{{ trans('global.userManagement.title') }}</div>
                </div>
            </a>
            <a class="hover:no-underline" href="{{ url("admin/room-type") }}">
                <div class="w-full flex flex-row items-center justify-start h-16 px-6 box-border gap-[10px] text-base hover:bg-neutral-500 hover:text-white rounded-r-xl {{ request()->is('admin/room-type') || request()->is('admin/room-type/*') ? 'text-white bg-black' : ''}} ">
                    <i class="text-xl w-6 fas fa-gear {{ request()->is('admin/room-type') || request()->is('admin/room-type/*') ? 'text-red-500' : '' }}"></i>
                    <div class="relative leading-[100%] font-semibold">Room Type</div>
                </div>
            </a>
            <a class="hover:no-underline" href="{{ url("admin/ext-room-type") }}">
                <div class="w-full flex flex-row items-center justify-start h-16 px-6 box-border gap-[10px] text-base hover:bg-neutral-500 hover:text-white rounded-r-xl {{ request()->is('admin/ext-room-type') || request()->is('admin/ext-room-type/*') ? 'text-white bg-black' : ''}} ">
                    <i class="text-xl w-6 fa fa-gear {{ request()->is('admin/ext-room-type') || request()->is('admin/ext-room-type/*') ? 'text-red-500' : '' }}"></i>
                    <div class="relative leading-[100%] font-semibold">Ext. Room Type</div>
                </div>
            </a>
            <a class="hover:no-underline" href="{{ url("admin/stack-room-type") }}">
                <div class="w-full flex flex-row items-center justify-start h-16 px-6 box-border gap-[10px] text-base hover:bg-neutral-500 hover:text-white rounded-r-xl {{ request()->is('admin/stack-room-type') || request()->is('admin/stack-room-type/*') ? 'text-white bg-black' : ''}} ">
                    <i class="text-xl w-6 fa fa-gear {{ request()->is('admin/stack-room-type') || request()->is('admin/stack-room-type/*') ? 'text-red-500' : '' }}"></i>
                    <div class="relative leading-[100%] font-semibold">Stack Room Type</div>
                </div>
            </a>
            <a class="hover:no-underline" href="{{ url("admin/building-type") }}">
                <div class="w-full flex flex-row items-center justify-start h-16 px-6 box-border gap-[10px] text-base hover:bg-neutral-500 hover:text-white rounded-r-xl {{ request()->is('admin/building-type') || request()->is('admin/building-type/*') ? 'text-white bg-black' : ''}} ">
                    <i class="text-xl w-6 fa fa-gear {{ request()->is('admin/building-type') || request()->is('admin/building-type/*') ? 'text-red-500' : '' }}"></i>
                    <div class="relative leading-[100%] font-semibold">Building Type</div>
                </div>
            </a>
            <a class="hover:no-underline" href="{{ url("admin/plot-type") }}">
                <div class="w-full flex flex-row items-center justify-start h-16 px-6 box-border gap-[10px] text-base hover:bg-neutral-500 hover:text-white rounded-r-xl {{ request()->is('admin/plot-type') || request()->is('admin/plot-type/*') ? 'text-white bg-black' : ''}} ">
                    <i class="text-xl w-6 fa fa-gear {{ request()->is('admin/plot-type') || request()->is('admin/plot-type/*') ? 'text-red-500' : '' }}"></i>
                    <div class="relative leading-[100%] font-semibold">Plot Type</div>
                </div>
            </a>
            <a class="hover:no-underline" href="{{ url("admin/ext-room-type") }}">
                <div class="w-full flex flex-row items-center justify-start h-16 px-6 box-border gap-[10px] text-base hover:bg-neutral-500 hover:text-white rounded-r-xl {{ request()->is('admin/ext-room-type/*') ? 'text-white bg-black' : ''}} ">
                    <i class="text-xl w-6 fa fa-gear {{ request()->is('admin/ext-room-type/*') ? 'text-red-500' : '' }}"></i>
                    <div class="relative leading-[100%] font-semibold">Ext. Room Type</div>
                </div>
            </a>
            <a class="hover:no-underline" href="{{ url("admin/ext-room-type") }}">
                <div class="w-full flex flex-row items-center justify-start h-16 px-6 box-border gap-[10px] text-base hover:bg-neutral-500 hover:text-white rounded-r-xl {{ request()->is('admin/ext-room-type/*') ? 'text-white bg-black' : ''}} ">
                    <i class="text-xl w-6 fa fa-gear {{ request()->is('admin/ext-room-type/*') ? 'text-red-500' : '' }}"></i>
                    <div class="relative leading-[100%] font-semibold">Ext. Room Type</div>
                </div>
            </a>
        @endif

        @if($user->role_id == 2)
        {{-- <ul class="nav">
            <li class="nav-item ">
                <a href="{{ route("admin.home") }}" class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt color_icon">

                    </i>
                    {{ trans('global.dashboard') }}
                </a>
            </li>
            
           <li class="{{ request()->is('admin') || request()->is('admin') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route("admin.home") }}">
                    <i class="nc-icon nc-notes color_icon"></i>
                    <p>Project Tree</p>
                </a>
            </li> --}}
           <!-- <li>
                <a class="nav-link" href="{{ url("admin/room-type") }} ">
                    <i class="nc-icon nc-paper-2"></i>
                    <p>Room Type</p>
                </a>
            </li>-->
            
            <!--<li>
                <a class="nav-link" href="{{ url("admin/plot-type") }}">
                    <i class="nc-icon nc-pin-3"></i>
                    <p>Plot Type</p>
                </a>
            </li>-->

           <!--  <li>
                <a class="nav-link" href="{{ url("admin/view-csv-file") }}">
                    <i class="nc-icon nc-cloud-download-93 mr-2"></i>
                    <p>View CSV File </p>
                </a>
            </li>
            
            <li>
                <a class="nav-link" href="/admin/3d-view-model">
                    <i class="nc-icon nc-planet"></i>
                    <p>3D View</p>
                </a>
            </li> -->
            {{-- <li class="{{ request()->is('admin/projectSetting') || request()->is('admin/projectSetting') ? 'active' : '' }}">
                <a class="nav-link" href="/admin/projectSetting">
                    <i class="nc-icon nc-planet color_icon"></i>
                    <p>Accounts</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <i class="nav-icon fas fa-sign-out-alt">

                    </i>
                    {{ trans('global.logout') }}
                </a>
            </li>
        </ul> --}}
            <a class="hover:no-underline" href="{{ route("admin.home") }}">
                <div class="w-full flex flex-row items-center justify-start h-16 px-6 box-border gap-[10px] text-base hover:bg-neutral-500 hover:text-white rounded-r-xl {{ request()->is('admin') ? 'text-white bg-black' : ''}} ">
                    <i class="text-xl w-6 fas fa-th {{ request()->is('admin') ? 'text-red-500' : '' }}"></i>
                    <div class="relative leading-[100%] font-semibold">{{ trans('global.dashboard') }}</div>
                </div>
            </a>
            <a class="hover:no-underline" href="/admin/projectSetting">
                <div class="w-full flex flex-row items-center justify-start h-16 px-6 box-border gap-[10px] text-base hover:bg-neutral-500 hover:text-white rounded-r-xl {{ request()->is('admin/projectSetting') || request()->is('admin/projectSetting') ? 'text-white bg-black' : ''}} ">
                    <i class="text-xl w-6 fas fa-user {{ request()->is('admin/projectSetting') || request()->is('admin/projectSetting') ? 'text-red-500' : '' }}"></i>
                    <div class="relative leading-[100%] font-semibold">Accounts</div>
                </div>
            </a>
        @endif
    @endforeach

</div>
