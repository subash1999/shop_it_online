<ul class="sidebar-menu">
    <div class=" sidebar" role="navigation" >
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li>
                    <div class="user-panel">
                        <div class="pull-left image"> 
                            <img src="{{ asset('prof_pic.jpeg') }}" class="img-circle" alt="User Image" />
                        </div>                        
                    </div>
                </li>
                <li class="sidebar-search">
                    <div class="input-group custom-search-form">
                        <input type="text" class="form-control" placeholder="Search...">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">
                                <i class="fa fa-search"></i>
                            </button>
                        </span>
                    </div>
                    <li class="header" style="text-align: center; font-family: Arial;">MAIN NAVIGATION</li>
                    <li >
                        <a href="{{ url('admin') }}">
                            <i class="fas fa-tachometer-alt"></i> <span>Dashboard</span> 
                        </a>                
                    </li>
                    <li >
                       <a href="{{ url('admin/admin_mail') }}">
                            <i class="fas fa-tachometer-alt"></i> <span>Send Mail</span> 
                        </a>   

                    </li>
                    <li >
                        <a >
                            <i class="fas fa-user"></i>
                            <span>  Users</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="nav nav-second-level ">
                            <li><a href="{{ url('admin/users/all_users') }}"><i class="fas fa-angle-double-right"></i>All Users</a></li>
                            <li><a href="{{ url('admin/users/deleted_users') }}"><i class="fas fa-angle-double-right"></i>Deleted Users</a></li>
                            <li><a href="{{ url('admin/users/add_admin') }}"><i class="fas fa-angle-double-right"></i>Add Admin</a></li>
                            <li><a href="{{ url('admin/users/user_types') }}"><i class="fas fa-angle-double-right"></i>User Types</a></li>                           
                        </ul>
                    </li>
                    <li >
                        <a href="#0">
                            <i class="fab fa-product-hunt"></i>
                            <span>  Products</span>
                            <i class="fa fa-angle-left pull-right"></i>
                        </a>
                        <ul class="nav nav-second-level">
                            <li><a href="{{ url('all_products') }}"><i class="fas fa-angle-double-right"></i> Product List</a></li>                            
                        </ul>
                    </li>                  
                    
                    <li>
                        <a href="{{ url('admin/categories') }}">
                            <i class="fas fa-tags"></i> <span>Categories</span>
                        </a>
                    </li> 
                     <li>
                        <a href="{{ url('admin/wallet_recharge') }}">
                            <i class="fas fa-tags"></i> <span>Wallet Recharge</span>
                        </a>
                    </li>                  
                    

                    <!-- /input-group -->

                </ul>
            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
    </ul>