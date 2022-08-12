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
                        <p class="user-name">{{auth()->guard('web')->user()->branch['name']}}</p>
                        <p class="user-email">{{auth()->guard('web')->user()->branch['email']}}</p>
                    </div>
                </div>
            </div>

            <div class="accordion" id="accordionExample">

                <div class="card dashboard">
                    <div class="card-header">
                        <h2>
                            <button class="btn btn-link btn-block text-left" type="button">
                                <a href="dashboard.html" class="icon-home"><i class="fa fa-fw fa-home"></i><span
                                        style="margin-left: 2px;">Dashboard</span></a>
                            </button>
                        </h2>
                    </div>
                </div>

                <div class="card medicine">
                    <div class="card-header" id="headingThree">
                        <h2>
                            <button class="btn btn-link btn-block text-left collapsed" type="button"
                                data-toggle="collapse" data-target="#collapseThree" aria-expanded="false"
                                aria-controls="collapseThree">
                                <a class="option-name"><i class="fas fa-capsules"></i><span
                                        style="margin-left:4px;">Medicine</span></a>
                            </button>
                        </h2>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                        data-parent="#accordionExample">
                        <div class="card-body">
                            <ul>
                                <li><a href="/category/create">Add Category</a></li>
                                <li><a href="/category/all">Category List</a></li>
                                <li><a href="/type/create">Add Type</a></li>
                                <li><a href="/type/all">Type List</a></li>
                                <li><a href="/ageGroup/create">Add Age Group</a></li>
                                <li><a href="/ageGroup/all">Age Group List</a></li>
                                <li><a href="/effectiveMaterial/create">Add Effective Material</a></li>
                                <li><a href="/effectiveMaterial/all">Effective Material List</a></li>
                                <li><a href="/medicine/create">Add Medicine</a></li>
                                <li><a href="/medicine/all">Medicine List</a></li>

                            </ul>
                        </div>
                    </div>
                </div>

                <div class="card medical-food">
                    <div class="card-header" id="headingFour">
                        <h2>
                            <button class="btn btn-link btn-block text-left collapsed" type="button"
                                data-toggle="collapse" data-target="#collapseFour" aria-expanded="false"
                                aria-controls="collapseFour">
                                <a class="option-name"><i class="	fas fa-seedling"></i><span
                                        style="margin-left: 6px">Medical Food</span></a>
                            </button>
                        </h2>
                    </div>
                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour"
                        data-parent="#accordionExample">
                        <div class="card-body">
                            <ul>
                                <li><a href="/medicalFood/create">Add Medical Food</a></li>
                                <li><a href="/medicalFood/all">Medical Food List</a></li>

                            </ul>
                        </div>
                    </div>
                </div>

                <div class="card cosmetics">
                    <div class="card-header" id="headingFive">
                        <h2>
                            <button class="btn btn-link btn-block text-left collapsed" type="button"
                                data-toggle="collapse" data-target="#collapseFive" aria-expanded="false"
                                aria-controls="collapseFive">
                                <a class="option-name"><i class="fa fa-sun-o"></i><span
                                        style="margin-left: 5px">Cosmetics</span></a>
                            </button>
                        </h2>
                    </div>
                    <div id="collapseFive" class="collapse" aria-labelledby="headingFive"
                        data-parent="#accordionExample">
                        <div class="card-body">
                            <ul>
                                <li><a href="/cosmeticProduct/create">Add Cosmetics</a></li>
                                <li><a href="/cosmeticProduct/all">Cosmetics List</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="card medical-supplies">
                    <div class="card-header" id="headingSix">
                        <h2>
                            <button class="btn btn-link btn-block text-left collapsed" type="button"
                                data-toggle="collapse" data-target="#collapseSix" aria-expanded="false"
                                aria-controls="collapseSix">
                                <a class="option-name"><i class="fa fa-thermometer-2"
                                        style="margin-left: 5px;"></i><span style="margin-left: 10px;">Medical
                                        Supplies</span></a>
                            </button>
                        </h2>
                    </div>
                    <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordionExample">
                        <div class="card-body">
                            <ul>
                                <li><a href="/medicalSupply/create">Add Medical Supplies</a></li>
                                <li><a href="/medicasupply/all">Medical Supplies List</a></li>


                            </ul>
                        </div>
                    </div>
                </div>

                <div class="card products-report">
                    <div class="card-header" id="headingSixteen">
                        <h2>
                            <button class="btn btn-link btn-block text-left collapsed" type="button"
                                data-toggle="collapse" data-target="#collapseSixteen" aria-expanded="false"
                                aria-controls="collapseSixteen">
                                <a class="option-name"><i class="fas fa-file-medical" aria-hidden="true"
                                        style="margin-left: 5px;"></i><span style="margin-left: 5px;">Products
                                        Report</span></a>
                            </button>
                        </h2>
                    </div>
                    <div id="collapseSixteen" class="collapse" aria-labelledby="headingSixteen"
                        data-parent="#accordionExample">
                        <div class="card-body">
                            <ul>
                                <li><a href="/report/medicineAmount">Available Medicine</a></li>
                                <li><a href="/report/medicalFoodAmount">Available Medical Food</a></li>
                                <li><a href="/report/medicalSupplyAmount">Available Medical Supply</a></li>
                                <li><a href="/report/cosmeticProductAmount">Available Cosmetics</a></li>
                                <li><a href="/report/medicineExpired">Medicine Expiration</a></li>
                                <li><a href="/report/medicalFoodExpired">Medical Food Expiration</a></li>
                                <li><a href="/report/cosmeticProductExpired">Cosmetic Products Expiration</a></li>
                                <li><a href="/report/medicineOutOfStock">Medicine Out Of Stock</a></li>
                                <li><a href="/report/medicalFoodOutOfStock">Medical Food Out Of Stock</a></li>
                                <li><a href="/report/medicalSupplyOutOfStock">Medical Supply Out Of Stock</a></li>
                                <li><a href="/report/cosmeticProductOutOfStock">Cosmetic Products Out Of Stock</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="card warehouse">
                    <div class="card-header" id="headingTwo">
                        <h2>
                            <button class="btn btn-link btn-block text-left collapsed" type="button"
                                data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false"
                                aria-controls="collapseTwo">
                                <a class="option-name"><i class="fas fa-user-tie" style="margin-left: 3px"></i><span
                                        style="margin-left: 5px;">Warehouse</span></a>
                            </button>
                        </h2>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                        <div class="card-body">
                            <ul>
                                <li><a href="/manufacturer/add">Add Warehouse</a></li>
                                <li><a href="/manufacturer/all">Warehouse List</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="card purchase">
                    <div class="card-header" id="headingSeven">
                        <h2>
                            <button class="btn btn-link btn-block text-left collapsed" type="button"
                                data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false"
                                aria-controls="collapseSeven">
                                <a class="option-name"><i class="fas fa-shopping-cart"
                                        style="margin-right: 22px;"></i><span
                                        style="margin-left: 6px">Purchase</span></a>
                            </button>
                        </h2>
                    </div>
                    <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven"
                        data-parent="#accordionExample">
                        <div class="card-body">
                            <ul>
                                <li><a href="/order/add">Add Order To Warehouse</a></li>
                                <li><a href="/orders/warhouse/all">Warehouse Order List</a></li>
                                <li><a href="/recieved_ware/all">Received Warehouse Order List</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="card inventory">
                    <div class="card-header" id="headingEight">
                        <h2>
                            <button class="btn btn-link btn-block text-left collapsed" type="button"
                                data-toggle="collapse" data-target="#collapseEight" aria-expanded="false"
                                aria-controls="collapseEight">
                                <a class="option-name"><i class="fas fa-warehouse" style="margin-right: 22px;"></i><span
                                        style="margin-left: 3px;">Inventory</span></a>
                            </button>
                        </h2>
                    </div>
                    <div id="collapseEight" class="collapse" aria-labelledby="headingEight"
                        data-parent="#accordionExample">
                        <div class="card-body">
                            <ul>
                                <li><a href="/inventory/all">Inventory List</a></li>
                                <li><a href="/inventory/transfer">Add Order Transferring Inventory</a></li>
                                <li><a href="/orders/invevtory/all">Inventory Order List</a></li>
                                <li><a href="/recieved_inventory/all">Received Inventory Order List</a></li>
                                <li><a href="/inventory/this/Inv/Transfering/List">Transferring Order List</a></li>

                            </ul>
                        </div>
                    </div>
                </div>

                <div class="card customer">
                    <div class="card-header" id="headingOne">
                        <h2>
                            <button class="btn btn-link btn-block text-left " type="button" data-toggle="collapse"
                                data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                <a class="option-name"><i class="fas fa-users"></i><span
                                        style="margin-left: 1px;">Customar</span></a>
                            </button>
                        </h2>
                    </div>
                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">
                            <ul>
                                <li><a href="/Customer/add">Add Customar</a></li>
                                <li><a href="/Customer/all">Customar List</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="card invoice">
                    <div class="card-header" id="headingTen">
                        <h2>
                            <button class="btn btn-link btn-block text-left collapsed" type="button"
                                data-toggle="collapse" data-target="#collapseTen" aria-expanded="false"
                                aria-controls="collapseTen">
                                <a class="option-name"><i class="fas fa-hand-holding-usd mr-2"></i><span
                                        style="margin-left: 23px;">Invoice</span></a>
                            </button>
                        </h2>
                    </div>
                    <div id="collapseTen" class="collapse" aria-labelledby="headingTen" data-parent="#accordionExample">
                        <div class="card-body">
                            <ul>
                                <li><a href="/Invoice/add">Add Invoice</a></li>
                                <li><a href="/Invoice/All/list">Invoices List</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="card return">
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
                                <li><a href="/ReturnInvoice/All/list">Return Invoices List</a></li>
                                <li><a href="/reverse/warehouse">Return Warehouse List</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="card reckoning">
                    <div class="card-header" id="headingTwelve">
                        <h2>
                            <button class="btn btn-link btn-block text-left collapsed" type="button"
                                data-toggle="collapse" data-target="#collapseTwelve" aria-expanded="false"
                                aria-controls="collapseTwelve">
                                <a class="option-name"><i class="fa fa-money"></i><span>Reckoning</span></a>
                            </button>
                        </h2>
                    </div>
                    <div id="collapseTwelve" class="collapse" aria-labelledby="headingTwelve"
                        data-parent="#accordionExample">
                        <div class="card-body">
                            <ul>
                                <li><a href="/Reckon/All">All Dept Repayment Invoices</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="card branch">
                    <div class="card-header" id="headingThirteen">
                        <h2>
                            <button class="btn btn-link btn-block text-left collapsed" type="button"
                                data-toggle="collapse" data-target="#collapseThirteen" aria-expanded="false"
                                aria-controls="collapseThirteen">
                                <a class="option-name"><i class="fas fa-code-branch" aria-hidden="true"
                                        style="margin-left: 6px;"></i><span style="margin-left: 4px;">Branch</span></a>
                            </button>
                        </h2>
                    </div>
                    <div id="collapseThirteen" class="collapse" aria-labelledby="headingThirteen"
                        data-parent="#accordionExample">
                        <div class="card-body">
                            <ul>
                                <li><a href="/branchs/add">Add Branch</a></li>
                                <li><a href="/branchs/all">Branch List</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="card user">
                    <div class="card-header" id="headingFourteen">
                        <h2>
                            <button class="btn btn-link btn-block text-left collapsed" type="button"
                                data-toggle="collapse" data-target="#collapseFourteen" aria-expanded="false"
                                aria-controls="collapseFourteen">
                                <a class="option-name"><i class="fas fa-user-md" aria-hidden="true"
                                        style="margin-left: 3px;"></i><span style="margin-left: 5px;">User</span></a>
                            </button>
                        </h2>
                    </div>
                    <div id="collapseFourteen" class="collapse" aria-labelledby="headingFourteen"
                        data-parent="#accordionExample">
                        <div class="card-body">
                            <ul>
                                <li><a href="/User/all">User List</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="card report">
                    <div class="card-header" id="headingFiveteen">
                        <h2>
                            <button class="btn btn-link btn-block text-left collapsed" type="button"
                                data-toggle="collapse" data-target="#collapseFiveteen" aria-expanded="false"
                                aria-controls="collapseFiveteen">
                                <a class="option-name"><i class="fa fa-file-text-o" aria-hidden="true"
                                        style="margin-left: 5px;"></i><span style="margin-left: 5px;">Report</span></a>
                            </button>
                        </h2>
                    </div>
                    <div id="collapseFiveteen" class="collapse" aria-labelledby="headingFiveteen"
                        data-parent="#accordionExample">
                        <div class="card-body">
                            <ul>
                                <li><a href="/Invoice/All/report">Invoices Report</a></li>
                                <li><a href="/ReturnInvoice/All/report">Return Invoices Report</a></li>
                                <li><a href="/warehouse/report">Warehouses Report</a></li>
                                <li><a href="/warehouse/order/report">Warehouse Orders Report</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="card application-setting">
                    <div class="card-header" id="headingSeventeen">
                        <h2>
                            <button class="btn btn-link btn-block text-left collapsed" type="button"
                                data-toggle="collapse" data-target="#collapseSeventeen" aria-expanded="false"
                                aria-controls="collapseSeventeen">
                                <a class="option-name"><i class="fa fa-cog" aria-hidden="true"
                                        style="margin-left: 3px;"></i><span style="margin-left: 2px;">Application
                                        Setting</span></a>
                            </button>
                        </h2>
                    </div>
                    <div id="collapseSeventeen" class="collapse" aria-labelledby="headingSeventeen"
                        data-parent="#accordionExample">
                        <div class="card-body">
                            <ul>
                                <li><a href="themes">Themes</a></li>
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
                            <span class="badge">{{count(auth()->user()->unreadnotifications)}}</span>
                        </a>

                        <ul class="dropdown-menu notifications" role="menu" aria-labelledby="dLabel">

                            <div class="notification-heading">
                                <h4 class="menu-title">NOTIFICATIONS</h4>

                            </div>
                            <li class="divider"></li>

                            <div class="notifications-wrapper">

                                <?php $chick =  new \App\Http\Controllers\Notification\NotificationController()?>
                                <?php $chick->expiredDate() ?>

                                @forelse(auth()->user()->notifications as $notification)

                                @if($notification->type == 'App\Notifications\ExpiredDateNotification')

                                <a class="content"
                                    href="{{url('/notification/show_notification/'.$notification->data['batch_id'])}}">

                                    <div class="notification-item">
                                        <div class="row">
                                            <div class="clock">
                                                <i class="fas fa-hourglass-end"></i>
                                            </div>
                                            <div>
                                                <h4 class="item-title">{{$notification->data['title']}}</h4>
                                                <p class="item-info">{{$notification->data['description']}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <li class="divider"></li>

                                @else

                                <a class="content" href="#">
                                    <div class="notification-item">
                                        <div class="row">
                                            <div class="battery">
                                                <i class="fas fa-battery-quarter"></i>
                                            </div>
                                            <div>
                                                <h4 class="item-title">{{$notification->data['title']}}</h4>
                                                <p class="item-info">description</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <li class="divider"></li>
                                @endif

                                @empty
                                <a class="dropdown-item">No Notification</a>
                                @endforelse

                            </div>



                        </ul>

                    </div>


                    <div class="user dropdown d-flex" id="user">
                        <a role="button" data-toggle="dropdown" data-target="#" href="">
                            <i class="fas fa-user"></i>
                        </a>

                        <ul class="dropdown-menu user-profile" role="menu" aria-labelledby="dLabel">

                            <div class="user-heading">
                                <div><img src="{{asset('img/user3.jpg')}}" class="user-img2"></div>
                                <div class="user-name2">{{auth()->guard('web')->user()->name}}</div>
                                <div class="user-email2">{{auth()->guard('web')->user()->email}}</div>
                                </h4>
                            </div>
                            <div class="user-wrapper">

                                <a class="content a-user dropdown-item" href="/User/Info" id="a-user">

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

                                <a class="content a-edit dropdown-item" href="/User/Edit" id="a-user">
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
