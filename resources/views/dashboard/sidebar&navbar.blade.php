<!DOCTYPE html>
<html>
<body>

    <button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fas fa-arrow-up"></i></button>

    <!-- Start Sidebar -->

    <div class="wrapper">

        <nav id="sidebar" class="sidebar">

            <div class="sidebar-logo" id="sidebar-logo">
                <a href="dashboard.html">
                    <div class="row">
                        <i class="fas fa-laptop-medical"></i>
                        <h3>Pharmacy</h3>
                    </div>
                </a>
            </div>


            <div class="user-info">
                <div class="row">
                    <div class="user-img">
                        <img src="img/user3.jpg">
                    </div>
                    <div>
                        <p class="user-name">User Name</p>
                        <p class="user-email">admin@admin.com</p>
                    </div>
                </div>
            </div>

            <div class="accordion" id="accordionExample">

                <div class="card">
                    <div class="card-header">
                        <h2>
                            <button class="btn btn-link btn-block text-left" type="button">
                                <a href="dashboard.html" class="icon-home"><i
                                        class="fa fa-fw fa-home"></i><span>Home</span></a>
                            </button>
                        </h2>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h2>
                            <button class="btn btn-link btn-block text-left " type="button" data-toggle="collapse"
                                data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                <a class="option-name"><i class="fas fa-users"></i><span>Customar</span></a>
                            </button>
                        </h2>
                    </div>
                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">
                            <ul>
                                <li><a href="add_customer.html">Add Customar</a></li>
                                <li><a href="customer_list.html">Customar List</a></li>
                            </ul>
                        </div>
                    </div>

                </div>
                <div class="card">
                    <div class="card-header" id="headingTwo">
                        <h2>
                            <button class="btn btn-link btn-block text-left collapsed" type="button"
                                data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false"
                                aria-controls="collapseTwo">
                                <a class="option-name"><i class="fas fa-user-tie"></i><span>Warehouse</span></a>
                            </button>
                        </h2>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                        <div class="card-body">
                            <ul>
                                <li><a href="add_manufacturer.html">Add Warehouse</a></li>
                                <li><a href="manufacturer_list.html">Warehouse List</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header" id="headingThree">
                        <h2>
                            <button class="btn btn-link btn-block text-left collapsed" type="button"
                                data-toggle="collapse" data-target="#collapseThree" aria-expanded="false"
                                aria-controls="collapseThree">
                                <a class="option-name"><i class="fas fa-capsules"></i><span>Medicine</span></a>
                            </button>
                        </h2>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                        data-parent="#accordionExample">
                        <div class="card-body">
                            <ul>
                                <li><a href="add_category.html">Add Category</a></li>
                                <li><a href="category_list.html">Category List</a></li>
                                <li><a href="add_type.html">Add Type</a></li>
                                <li><a href="type_list.html">Type List</a></li>
                                <li><a href="add_agegroup.html">Add Age Group</a></li>
                                <li><a href="agegroup_list.html">Age Group List</a></li>
                                <li><a href="add_effective_material.html">Add Effective Material</a></li>
                                <li><a href="effective_material_list.html">Effective Material List</a></li>
                                <li><a href="add_medicine.html">Add Medicine</a></li>
                                <li><a href="medicine_list.html">Medicine List</a></li>

                            </ul>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header" id="headingFour">
                        <h2>
                            <button class="btn btn-link btn-block text-left collapsed" type="button"
                                data-toggle="collapse" data-target="#collapseFour" aria-expanded="false"
                                aria-controls="collapseFour">
                                <a class="option-name"><i class="	fas fa-seedling"></i><span>Medical Food</span></a>
                            </button>
                        </h2>
                    </div>
                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour"
                        data-parent="#accordionExample">
                        <div class="card-body">
                            <ul>
                                <li><a href="add_medicalFood.html">Add Medical Food</a></li>
                                <li><a href="medicalFood_list.html">Medical Food List</a></li>

                            </ul>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header" id="headingFive">
                        <h2>
                            <button class="btn btn-link btn-block text-left collapsed" type="button"
                                data-toggle="collapse" data-target="#collapseFive" aria-expanded="false"
                                aria-controls="collapseFive">
                                <a class="option-name"><i class="fa fa-sun-o"></i><span>Cosmetics</span></a>
                            </button>
                        </h2>
                    </div>
                    <div id="collapseFive" class="collapse" aria-labelledby="headingFive"
                        data-parent="#accordionExample">
                        <div class="card-body">
                            <ul>
                                <li><a href="add_cosmetics.html">Add Cosmetics</a></li>
                                <li><a href="cosmetics_list.html">Cosmetics List</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header" id="headingSix">
                        <h2>
                            <button class="btn btn-link btn-block text-left collapsed" type="button"
                                data-toggle="collapse" data-target="#collapseSix" aria-expanded="false"
                                aria-controls="collapseSix">
                                <a class="option-name"><i class="	fa fa-thermometer-2"></i><span>Medical
                                        Devices</span></a>
                            </button>
                        </h2>
                    </div>
                    <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordionExample">
                        <div class="card-body">
                            <ul>
                                <li><a href="add_medicalDevices.html">Add Medical Devices</a></li>
                                <li><a href="medicalDevices_list.html">Medical Devices List</a></li>

                            </ul>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header" id="headingSeven">
                        <h2>
                            <button class="btn btn-link btn-block text-left collapsed" type="button"
                                data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false"
                                aria-controls="collapseSeven">
                                <a class="option-name"><i class="fas fa-shopping-cart"></i><span>Purchase</span></a>
                            </button>
                        </h2>
                    </div>
                    <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven"
                        data-parent="#accordionExample">
                        <div class="card-body">
                            <ul>
                                <li><a href="add_order_to_warehouse.html">Add Order To Warehouse</a></li>
                                <li><a href="warehouse_order_list.html">Warehouse Order List</a></li>
                                <li><a href="received_warehouse_order_list.html">Received Warehouse Order List</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header" id="headingEight">
                        <h2>
                            <button class="btn btn-link btn-block text-left collapsed" type="button"
                                data-toggle="collapse" data-target="#collapseEight" aria-expanded="false"
                                aria-controls="collapseEight">
                                <a class="option-name"><i class="fas fa-warehouse"></i><span>Inventory</span></a>
                            </button>
                        </h2>
                    </div>
                    <div id="collapseEight" class="collapse" aria-labelledby="headingEight"
                        data-parent="#accordionExample">
                        <div class="card-body">
                            <ul>
                                <li><a href="chosse_inventory_to_transferring_from.html">Add Order Transferring Inventory</a></li>
                                <li><a href="inventory_order_list.html">Inventory Order List</a></li>
                                <li><a href="received_inventory_order_list.html">Received inventory Order List</a></li>
                                <li><a href="transferring_order_list.html">Transferring Order List</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header" id="headingNine">
                        <h2>
                            <button class="btn btn-link btn-block text-left collapsed" type="button"
                                data-toggle="collapse" data-target="#collapseNine" aria-expanded="false"
                                aria-controls="collapseNine">
                                <a class="option-name"><i class="fas fa-clinic-medical"></i><span>Pharmacy Orders</span></a>
                            </button>
                        </h2>
                    </div>
                    <div id="collapseNine" class="collapse" aria-labelledby="headingNine"
                        data-parent="#accordionExample">
                        <div class="card-body">
                            <ul>
                                <li><a href="add_order_from_pharmacy.html">Add Order From Pharmacy</a></li>
                                <li><a href="pharmacy_order_list.html">Pharmacy Order List</a></li>
                                <li><a href="received_pharmacy_order_list.html">Received Pharmacy Order List</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header" id="headingTen">
                        <h2>
                            <button class="btn btn-link btn-block text-left collapsed" type="button"
                                data-toggle="collapse" data-target="#collapseTen" aria-expanded="false"
                                aria-controls="collapseTen">
                                <a class="option-name"><i
                                        class="fas fa-hand-holding-usd mr-2"></i><span>Invoice</span></a>
                            </button>
                        </h2>
                    </div>
                    <div id="collapseTen" class="collapse" aria-labelledby="headingTen"
                        data-parent="#accordionExample">
                        <div class="card-body">
                            <ul>
                                <li><a href="add_invoice.html">Add Invoice</a></li>
                                <li><a href="invoice_list.html">Invoices List</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header" id="headingEleven">
                        <h2>
                            <button class="btn btn-link btn-block text-left collapsed" type="button"
                                data-toggle="collapse" data-target="#collapseEleven" aria-expanded="false"
                                aria-controls="collapseEleven">
                                <a class="option-name"><i class="fa fa-retweet"></i><span>Return</span></a>
                            </button>
                        </h2>
                    </div>
                    <div id="collapseEleven" class="collapse" aria-labelledby="headingEleven"
                        data-parent="#accordionExample">
                        <div class="card-body">
                            <ul>
                                <li><a href="return_invoice_list.html">Return Invoices List</a></li>
                                <li><a href="return_manufacturer_list.html">Return Warehouse List</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header" id="headingTwelve">
                        <h2>
                            <button class="btn btn-link btn-block text-left collapsed" type="button"
                                data-toggle="collapse" data-target="#collapseTwelve" aria-expanded="false"
                                aria-controls="collapseTwelve">
                                <a class="option-name"><i class="fa fa-money"></i><span>Reckoning</span></a>
                            </button>
                        </h2>
                    </div>
                    <div id="collapseTwelve" class="collapse" aria-labelledby="headingTwelve" data-parent="#accordionExample">
                        <div class="card-body">
                            <ul>
                                <li><a href="all_debt_invoices.html">All Dept Repayment Invoices</a></li>
                            </ul>
                        </div>
                    </div>
                </div>


                <div class="card">
                    <div class="card-header" id="headingThirteen">
                        <h2>
                            <button class="btn btn-link btn-block text-left collapsed" type="button"
                                data-toggle="collapse" data-target="#collapseThirteen" aria-expanded="false"
                                aria-controls="collapseThirteen">
                                <a class="option-name"><i class="fas fa-code-branch"
                                        aria-hidden="true"></i><span>Branch</span></a>
                            </button>
                        </h2>
                    </div>
                    <div id="collapseThirteen" class="collapse" aria-labelledby="headingThirteen"
                        data-parent="#accordionExample">
                        <div class="card-body">
                            <ul>
                                <li><a href="add_branch.html">Add Branch</a></li>
                                <li><a href="branch_list.html">Branch List</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header" id="headingFourteen">
                        <h2>
                            <button class="btn btn-link btn-block text-left collapsed" type="button"
                                data-toggle="collapse" data-target="#collapseFourteen" aria-expanded="false"
                                aria-controls="collapseFourteen">
                                <a class="option-name"><i class="fas fa-user-md"
                                        aria-hidden="true"></i><span>User</span></a>
                            </button>
                        </h2>
                    </div>
                    <div id="collapseFourteen" class="collapse" aria-labelledby="headingFourteen"
                        data-parent="#accordionExample">
                        <div class="card-body">
                            <ul>
                                <li><a href="user_list.html">User List</a></li>
                            </ul>
                        </div>
                    </div>
                </div>


                <div class="card">
                    <div class="card-header" id="headingFiveteen">
                        <h2>
                            <button class="btn btn-link btn-block text-left collapsed" type="button"
                                data-toggle="collapse" data-target="#collapseFiveteen" aria-expanded="false"
                                aria-controls="collapseFiveteen">
                                <a class="option-name"><i class="fa fa-file-text-o"
                                        aria-hidden="true"></i><span>Report</span></a>
                            </button>
                        </h2>
                    </div>
                    <div id="collapseFiveteen" class="collapse" aria-labelledby="headingFiveteen"
                        data-parent="#accordionExample">
                        <div class="card-body">
                            <ul>
                                <li><a href="invoice_report.html">Invoices Report</a></li>
                                <li><a href="return_invoice_report.html">Return Invoices Report</a></li>
                            </ul>
                        </div>
                    </div>
                </div>


                <div class="card">
                    <div class="card-header" id="headingSixteen">
                        <h2>
                            <button class="btn btn-link btn-block text-left collapsed" type="button"
                                data-toggle="collapse" data-target="#collapseFSixteen" aria-expanded="false"
                                aria-controls="collapseFSixteen">
                                <a class="option-name"><i class="fa fa-cog" aria-hidden="true"></i><span>Application
                                        Setting</span></a>
                            </button>
                        </h2>
                    </div>
                    <div id="collapseFSixteen" class="collapse" aria-labelledby="headingSixteen"
                        data-parent="#accordionExample">
                        <div class="card-body">
                            <ul>
                                <li><a href="language.html">Language</a></li>
                                <li><a href="themes.html">Themes</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>

    <!-- End Sidebar -->


    <!-- Start Navbar -->

    <div id="navbar">
        <nav class="navbar navbar-expand navbar-light ">
            <div class="collapse navbar-collapse">
                <div class="navbar-nav mr-auto">
                    <a href="#" class="btn btn-lg " id="sidebarCollapse">
                        <span class="glyphicon glyphicon-align-left"></span>
                    </a>

                </div>
                <div class="row">


                    <div class="dropdown d-flex notification" style="margin-left: auto;" id="notification">
                        <a role="button" data-toggle="dropdown" data-target="#" href="">
                            <i class="fas fa-bell"></i>
                            <span class="badge">0</span>
                        </a>

                        <ul class="dropdown-menu notifications" role="menu" aria-labelledby="dLabel">

                            <div class="notification-heading">
                                <h4 class="menu-title">NOTIFICATIONS</h4>
                                <h4 class="menu-title pull-right">View all<i
                                        class="glyphicon glyphicon-circle-arrow-right"></i>
                                </h4>
                            </div>
                            <li class="divider"></li>
                            <div class="notifications-wrapper">
                                <a class="content" href="#">

                                    <div class="notification-item">
                                        <div class="row">
                                            <div class="clock">
                                                <i class="fas fa-hourglass-end"></i>
                                            </div>
                                            <div>
                                                <h4 class="item-title">Date Expired Medicine</h4>
                                                <p class="item-info">Marketing 101, Video Assignment</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>

                                <li class="divider"></li>

                                <a class="content" href="#">
                                    <div class="notification-item">
                                        <div class="row">
                                            <div class="battery">
                                                <i class="fas fa-battery-quarter"></i>
                                            </div>
                                            <div>
                                                <h4 class="item-title">Out of Stock Medicine</h4>
                                                <p class="item-info">Marketing 101, Video Assignment</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>

                            </div>
                            <li class="divider"></li>
                            <div class="notification-footer">
                                <h4 class="menu-title">View all<i class="glyphicon glyphicon-circle-arrow-right"></i>
                                </h4>
                            </div>
                        </ul>

                    </div>


                    <div class="user dropdown d-flex" id="user">
                        <a role="button" data-toggle="dropdown" data-target="#" href="">
                            <i class="fas fa-user"></i>
                        </a>

                        <ul class="dropdown-menu user-profile" role="menu" aria-labelledby="dLabel">

                            <div class="user-heading">
                                <div><img src="img/user3.jpg" class="user-img2"></div>
                                <div class="user-name2">Tasneem Anas</div>
                                <div class="user-email2">tasneem@admin.com</div>
                                </h4>
                            </div>
                            <div class="user-wrapper">

                                <a class="content a-user dropdown-item" href="my_profile.html" id="a-user">

                                    <div class="drop-item">
                                        <div class="row row-user" style="margin-bottom: -2px;">
                                            <div>
                                                <i class="	fa fa-user-o" id="fa-user" style="margin-top: 1px"></i>
                                            </div>
                                            <div class="p-user">
                                                <p>My Profile</p>
                                            </div>
                                        </div>
                                    </div>

                                </a>
                                <li class="divider"></li>

                                <a class="content a-edit dropdown-item" href="edit_profile.html" id="a-user">
                                    <div class="drop-item">
                                        <div class="row row-user" style="margin-top: 5px">
                                            <div class="">
                                                <i class="fas fa-edit" id="fa-edit"></i>
                                            </div>
                                            <div class="p-user">
                                                <p>Edit Profile</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <li class="divider"></li>

                                <a class="content a-sign dropdown-item" href="#" id="a-user">
                                    <div class="drop-item">
                                        <div class="row row-user" style="margin-top: 5px">
                                            <div class="">
                                                <i class="fa fa-sign-out" id="fa-sign"></i>
                                            </div>
                                            <div class="p-user">
                                                <p>Sign Out</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </ul>
                    </div>
                </div>
            </div>

        </nav>
    </div>

    <!-- End Navbar -->

    
</body>

