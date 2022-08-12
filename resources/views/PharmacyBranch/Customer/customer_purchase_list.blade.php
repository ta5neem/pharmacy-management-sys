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



    <link rel="stylesheet" href="{{asset('css/master.css')}}">
    <link rel="stylesheet" href="{{asset('css/add_branch.css')}}">


    <link rel="stylesheet" href="{{asset('css/master.css')}}">
    <link rel="stylesheet" href="{{asset('css/customer_purchase_list.css')}}">

    

    <title>Pharmacy</title>
    <link rel="icon" href="img/logo.png" sizes="16x16 32x32" type="image/png">

</head>

<body>

    
@include('sidebar&navbar')
    <!-- Start Body -->



    <div class="body-page" id="body-page">
        <div class="customer-purchase-list">
            <div class="card">
                <div class="card-header d-flex justify-content-between bd-highlight mb-3">
                    <div class="p-2 bd-highlight">
                        Customer Purshase List
                    </div>
                    <div class="p-2 bd-highlight">
                        <a href="/Customer/all"><button type="button" class="btn btn-list"><i class="fa fa-align-justify"></i> &nbsp;Customer List</button></a>
                    </div>
                </div>
                <div class="card-body">
   


                    <table id="table" class="table table-striped table-bordered dt-responsive nowrap"
                        style="width:100%">
                        <thead>

                            <tr>
                                <th scope="col">Invoice Id</th>
                                <th scope="col">Date</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Product Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Return Quantity</th>
                                <th scope="col">Action</th>
                            <th scope="col">Return Product</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $one)
                            <tr>
                                <th scope="row">{{$one->invoice_id}}</th>
                                <td>{{$one->created_at}}</td>
                                <td>{{$one->product_name}}</td>
                                <td>{{$one->product_price}}</td>
                                <td>{{$one->product_num}}</td>
                                <td>{{$one->product_return}}</td>
                                <td>
                                    <div class="row" style="margin-left: 15px;">
                                        <a href="/Invoice/show/{{$one->invoice_id}}" title="Display Invoice"><i class="fas fa-expand-arrows-alt"></i></a>
                                    </div>
                                </td>
                                <td> 
                                <form action="/Invoice/Return/{{$one->id}}" method="POST">
                                @csrf
                                <input type="decimal" name="num_return" placeholder="Enter Number to Return">

                                <input type="submit" name="return" value="return">
                                </form>

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


    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.7/js/responsive.bootstrap4.min.js"></script>




     <script src="{{asset('js/main.js')}}"></script>
     <script src="{{asset('js/themes.js')}}"></script>
</body>

</html>