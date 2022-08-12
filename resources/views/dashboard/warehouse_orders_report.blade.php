<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <script src="https://kit.fontawesome.com/18695b64bb.js" crossorigin="anonymous"></script>

    <!-- <script src="js/fontawesom.js"></script> -->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <script src="{{asset('js/popper.min.js')}}"></script>





    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">


    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>


    <link rel="stylesheet" src="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <link rel="stylesheet" src="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">




    <link rel="stylesheet" href="{{asset('css/master.css')}}">
    <link rel="stylesheet" href="{{asset('css/warehouse_orders_report.css')}}">



    <title>Pharmacy</title>
    <link rel="icon" href="{{asset('img/logo.png')}}" sizes="16x16 32x32" type="image/png">


</head>

<body>
@include('sidebar&navbar')

    <!-- Start Body -->


    <div class="body-page" id="body-page">
        <div class="warehouse-orders-report">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        Warehouse Orders Report
                    </div>
                </div>
                <div class="card-body">
                  <form action="/rep/search" method="POST" role="search" autocomplete="off">
                       {{ csrf_field() }}
                    <div class="row form-search-date">

                        <div class="col-lg-5 col-md-12">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Start Date</span>
                                </div>
                                <input class="form-control search-date" placeholder="Start Date"
                                    aria-describedby="basic-addon1" data-provide="datepicker" name="start"data-date-format="yyyy-mm-dd">
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-12">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">End Date</span>
                                </div>
                                <input class="form-control search-date" placeholder="End Date"
                                    aria-describedby="basic-addon1" data-provide="datepicker" name="end" data-date-format="yyyy-mm-dd">

                            </div>
                        </div>
                        <div class="col-lg-2">
                            <button type="submit" class="btn float-lg-left float-md-right find">Find</button>
                        </div>
                    </div>
                </form>

                    <div class="row row-filter">
                        <div class="btn-group dropdown">
                            <button type="button" class="btn dropdown-toggle btn-list btn-branch" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false" id="btn-branch">
                                <a class="btn-add">Select Type &nbsp;<i class="fas fa-angle-down"></i>
                            </button>
                            <div class="dropdown-menu">
                                <div class="list-group">
                                    <a href="/paid/search"
                                        class="list-group-item list-group-item-action list-group-item-invoice">Paid order</a>
                                    <a href="/Nonpaid/search"
                                        class="list-group-item list-group-item-action list-group-item-invoice">Non-paid order</a>

                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="line"></div>
                    <div class=" row-total">
                        <div class="address ">
                            <label class="detailed">Total report</label>
                            <form>
                                <div class="form-row">
                                    <div class="col-lg-5 col-md-12">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text total-span" id="basic-addon1">Total number
                                                    of orders:</span>
                                            </div>
                                            <input class="form-control read" readonly value="{{$num_order}}">
                                        </div>
                                    </div>
                                    <div class="col-lg-1"></div>
                                    <div class="col-lg-5 col-md-12">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text total-span" id="basic-addon1">Total value
                                                    of orders:</span>
                                            </div>
                                            <input class="form-control read" readonly value="{{$value_of_order}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col-lg-5 col-md-12">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text total-span" id="basic-addon1">Total value
                                                    paid of orders:</span>
                                            </div>
                                            <input class="form-control read"value="{{$paid_of_order}}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-lg-1"></div>
                                    <div class="col-lg-5 col-md-12">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text total-span" id="basic-addon1">Total number
                                                    of products:</span>
                                            </div>
                                            <input class="form-control read" readonly value="{{$num_of_product}}">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>


                    <div class="line"></div>
                    <div class=" row-detailed">
                        <div class="address ">
                            <label class="detailed">Detailed report</label>
                        </div>
                    </div>

                    <table id="table1" class="table table-striped table-bordered dt-responsive nowrap"
                        style="width:96.5%">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>

                                <th scope="col">Order Date</th>
                                <th scope="col">Employee</th>
                                <th scope="col">Warehouse</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach($buyordr as $one)
                            <tr>
                                <th scope="row">{{$one->id}}</th>
                                <td>{{$one->order_date}}</td>
                                <td>{{\App\User::select('name')->where('id',$one->user_id)->value('name')}}</td>
                                <td>{{\App\Models\Warehouse::select('name')->where('id',$one->warehouse_id)->value('name')}}</td>
                                <td>
                                    <div class="row">
                                        <a href=" /order/buybill/{{$one->id}}" title="Ordered products"><i class="fas fa-cart-arrow-down" aria-hidden="true"></i></a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>


    <!-- End Body -->

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.7/js/responsive.bootstrap4.min.js"></script>


    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>


    <script>
        $(document).ready(function () {
            $('#table1').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'excel', 'pdf', 'print'
                ]
            });
        });

    </script>

    <script src="{{asset('js/main.js')}}"></script>
    <script src="{{asset('js/themes.js')}}"></script>

</body>

</html>
