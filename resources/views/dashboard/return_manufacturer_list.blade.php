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
    <link rel="stylesheet" href="{{asset('css/return_manufacturer_list.css')}}">



    <title>Pharmacy</title>
    <link rel="icon" href="{{asset('img/logo.png')}}" sizes="16x16 32x32" type="image/png">


</head>

<body>

  @include('sidebar&navbar')


    <!-- Start Body -->


    <div class="body-page" id="body-page">
        <div class="return-warehouse-list">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        Return Warehouse List
                    </div>
                </div>
                <div class="card-body">

                    <table id="table" class="table table-striped table-bordered dt-responsive nowrap"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col">Product ID</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Production Date</th>
                                <th scope="col">Expiry Date</th>
                                <th scope="col">Purchasing Price</th>
                                <th scope="col">Selling Price</th>
                                <th scope="col">Received Quantity</th>

                                <th scope="col">Return Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach($buybillproduct as $one)
                            <tr>

                                <td>{{\App\Models\BuyBillProduct::join('buy_products','buy_products.id','buy_bill_products.buy_product_id')->where('buy_bill_products.id',$one->id)->value('product_id')}}</td>
                                <td>{{\App\Models\Medicine::where('product_id',\App\Models\BuyBillProduct::join('buy_products','buy_products.id','buy_bill_products.buy_product_id')->where('buy_bill_products.id',$one->id)->value('product_id'))->value('generic_name')}}
                                  {{\App\Models\MedicalSupply::where('product_id',\App\Models\BuyBillProduct::join('buy_products','buy_products.id','buy_bill_products.buy_product_id')->where('buy_bill_products.id',$one->id)->value('product_id'))->value('name')}}
                                  {{\App\Models\MedicalFood::where('product_id',\App\Models\BuyBillProduct::join('buy_products','buy_products.id','buy_bill_products.buy_product_id')->where('buy_bill_products.id',$one->id)->value('product_id'))->value('name')}}</td>
                                 <td>{{$one->production_date}}</td>
                                 <td>{{$one->expired_date}}</td>
                                  <td>{{$one->purchasing_price}}</td>
                                  <td>{{$one->selling_price}}</td>
                                 <td>{{$one->quantity_recived}}</td>

                                 <td>{{$one->reverse}}</td>
                            </tr>
                        </tbody>
                      @endforeach
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
