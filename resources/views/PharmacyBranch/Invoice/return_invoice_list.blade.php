
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <script src="https://kit.fontawesome.com/18695b64bb.js" crossorigin="anonymous"></script>



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
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css"> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>





    <link rel="stylesheet" href="{{asset('css/master.css')}}">
    <link rel="stylesheet" href="{{asset('css/return_invoice_list.css')}}">


    <title>Pharmacy</title>
    <link rel="icon" href="img/logo.png" sizes="16x16 32x32" type="image/png">

</head>

<body>

   @include('sidebar&navbar')

    <!-- Start Body -->


    <div class="body-page" id="body-page">
        <div class="return-invoice-list">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        Return Invoices List
                    </div>
                </div>
                <div class="card-body">
                        <form action="/ReturnInvoice/All/list" method="GET">

    @csrf
                    <div class="row form-search-date">
                        <div class="col-lg-5 col-md-12">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Start Date</span>
                                </div>
                                <input   name="start_date" class="form-control search-date" placeholder="Start Date"
                                    aria-describedby="basic-addon1" data-provide="datepicker">
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-12">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">End Date</span>
                                </div>
                                <input  name="end_date" class="form-control search-date" placeholder="End Date"
                                    aria-describedby="basic-addon1" data-provide="datepicker">

                            </div>
                        </div>
                        <div class="col-lg-2">
                            <button type="submit" class="btn btn-list float-lg-left float-md-right find">Find</button>
                        </div>
                    </div>
 </form>

   <div class="row row-filter">
                        <div class="btn-group dropdown">
                            <button type="button" class="btn dropdown-toggle btn-list btn-branch" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false" id="btn-branch">
                                <a class="btn-add">Select Branch &nbsp;<i class="fas fa-angle-down"></i>
                            </button>
                            <div class="dropdown-menu">
                                <div class="list-group">
                                   

                                        @foreach($branches as $one)
                                    <a href="/ReturnInvoice/Branch/list/{{$one->id}}"
                                        class="list-group-item list-group-item-action list-group-item-invoice"><i
                                            class="fas fa-code-branch"></i>{{$one->name}}</a>
                                            @endforeach
                                  
                                </div>

                            </div>
                        </div>
            </div>


                    <div class="line"></div>

                    <table id="table" class="table table-striped table-bordered dt-responsive nowrap"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Customer Name</th>
                                <th scope="col">Return Invoice Date</th>
                                <th scope="col">Employee</th>
                                    <th scope="col">Branch</th>

                                <th scope="col">Paid</th>
                                <th scope="col">product number</th>

                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($invoices as $invoice)
                            <tr>
                                <th scope="row">{{$invoice->id}}</th>
                                <td>{{$invoice->customer['name']}}</td>
                                <td>{{$invoice->created_at}}</td>
                                <td>{{$invoice->User['name']}}</td>
                                <td>{{$invoice->branch['name']}}</td>

                                <td>{{$invoice->total_due}} PS</td>
                                <td>{{$invoice->total_num}} </td>

                                <td>
                                    <div class="row">
                                        <a href="#" title="Edit"><i class="fas fa-edit"></i></a>
                                        <a href="/RInvoice/delete/{{$invoice->id}}" title="Delete"><i class="fa fa-trash"></i></a>
                                        <a href="/Invoice/return_invoice/{{$invoice->id}}" title="Display"><i class="fa fa-eye"></i></a>
                                        <a href="#" title="Print"><i class="fa fa-print"></i></a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                           
                        </tbody>
                    <!--     <tfoot>
                            <tr>
                                <th colspan="5" class="text-right" rowspan="1">Total:</th>
                                <th class="total_sale text-left" rowspan="1" colspan="1" >19000 PS</th>
                                <th rowspan="1" colspan="1"></th>
                            </tr>
                        </tfoot> -->
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