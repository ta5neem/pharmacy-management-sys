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





    <link rel="stylesheet" href="{{asset('css/master.css')}}">
    <link rel="stylesheet" href="{{asset('css/received_warehouse_order_list.css')}}">

    <title>Pharmacy</title>

    <link rel="icon" href="{{asset('img/logo.png')}}" sizes="16x16 32x32" type="image/png">

</head>

<body>
   @include('sidebar&navbar')

    <!-- Start Body -->


    <div class="body-page" id="body-page">
        <div class="received-warehouse-order-list">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        Received Warehouse Order List
                        <a href="/order/add"><button type="button" class="btn add-up"><i
                                    class="fa fa-plus-square-o"></i>&nbsp; Add Order To Warehouse</button></a>
                    </div>
                </div>

                <div class="card-body">
                  <form action="/recieved_order/Search" method="POST" role="search" autocomplete="off">
                       {{ csrf_field() }}
                    <div class="row form-search-date">

                        <div class="col-lg-5 col-md-12">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Start Date</span>
                                </div>
                                <input class="form-control search-date" placeholder="Start Date"
                                   name="start_at"  data-date-format="yyyy-mm-dd" aria-describedby="basic-addon1" data-provide="datepicker">
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-12">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">End Date</span>
                                </div>
                                <input class="form-control search-date" placeholder="End Date"
                                  name="end_at"  aria-describedby="basic-addon1" data-date-format="yyyy-mm-dd" data-provide="datepicker">

                            </div>
                        </div>
                        <div class="col-lg-2">
                            <button type="submit" class="btn float-lg-left float-md-right find">Find</button>
                        </div>
                    </div>
                     </form>
                    <div class="line"></div>
                        <table id="table" class="table table-striped table-bordered dt-responsive nowrap"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Order Id</th>
                                <th scope="col">Warehouse Name</th>
                                <th scope="col">Received Date</th>
                                <th scope="col">Total Price</th>
                                <th scope="col">Total Payment Amount</th>
                                <th scope="col">Amount to be paid</th>

                                <th scope="col">Employee</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach($buybill as $one)
                            <tr>
                                <th scope="row">{{$one->id}}</th>
                                <td>{{ $one->buy_order_id}}</td>
                                <td>{{\App\Models\Warehouse::select('name')->where('id',$one->warehouse_id)->value('name')}}</td>
                                <td>{{ $one->recieve_date}}</td>
                                <td>{{ $one->total_price}}</td>
                                <td>{{ $one->total_payment}}</td>
                                <td>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text paid_amount" id="btnGroupAddon"
                                                id="paid_amount" name="paid_amount">
                                                {{$one->total_price-$one->total_payment}}</div>
                                        </div>
                                        <button type="submit" class="btn btn-list" data-toggle="modal"
                                            data-target="#paidModal" aria-describedby="btnGroupAddon">Paid</button>
                                    </div>

                                    <div class="modal fade" id="paidModal" tabindex="-1" role="dialog"
                                        aria-labelledby="paidModalLabel" aria-hidden="true" >
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="modal-title" id="paidModalLabel">Payment</h3>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <div class="modal-body">
                                                    <form action="/payment/store/{{$one->id}}" method="POST">
                                                        @csrf
                                                        <div class="row">
                                                            <input type="text" class="form-control paid" name="payment"  placeholder="Payment Amount">
                                                        </div>

                                                        <div class="row">
                                                            <input class="form-control paid" id="Date" name="date" data-provide="datepicker"
                                                                required data-date-format="yyyy-mm-dd" placeholder="Payment Date">
                                                        </div>

                                                        <button type="submit" class="btn btn-list float-right"
                                                            style="font-size: 15px; ">Paid</button>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td>{{\App\User::select('name')->where('id',$one->user_id)->value('name')}}</td>
                                <td>
                                    <div class="row">
                                        <a href="/recieved_order/edit/{{ $one->id }}" title="Edit"><i class="fas fa-edit"></i></a>
                                        <a href="/order/recieved_products/{{$one->id}}" title="Return"><i class="fa fa-retweet"
                                                aria-hidden="true"></i></a>
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



    <script src="{{asset('js/main.js')}}"></script>
     <script src="{{asset('js/themes.js')}}"></script>


</body>

</html>
