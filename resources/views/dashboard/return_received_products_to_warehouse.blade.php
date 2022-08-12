<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- start select -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css"
        rel="stylesheet" />


    <!-- end select -->

    <script src="https://kit.fontawesome.com/18695b64bb.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">


    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <script src="{{asset('js/popper.min.js')}}"></script>




    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>



    <link rel="stylesheet" href="{{asset('css/master.css')}}">
    <link rel="stylesheet" href="{{asset('css/return_received_products_to_warehouse.css')}}">

    <title>Pharmacy</title>

    <link rel="icon" href="{{asset('img/logo.png')}}" sizes="16x16 32x32" type="image/png">


</head>

<body>




 @include('sidebar&navbar')

    <!-- Start Body -->


    <div class="body-page" id="body-page">
        <div class="return-received-products-to-warehouse">
            <div class="card">
                <div class="card-header d-flex justify-content-between bd-highlight mb-3">
                    <div class="p-2 bd-highlight">
                        Return Recevied Products To Warehouse
                    </div>
                    <div class="p-2 bd-highlight">
                        <a href="/recieved_ware/all"><button type="button" class="btn btn-list"><i
                                    class="fa fa-align-justify"></i> &nbsp;Received Warehouse Order List</button></a>
                    </div>
                </div>
                <div class="card-body">
                    <form  action="/buybillproduct/delete/{{$ID}}">
                        <div class="form-row">
                            <label for="recevied_id" class="col-lg-2 label-input">Received Id:</label>
                            <input type="text" class="form-control2  col-lg-3 readonly" id="recevied_id" readonly
                                name="recevied_id" value="{{$ID}}">



                            <div class="col-lg-1"></div>

                            <label for="warehouse_name" class="col-lg-2 label-input">Warehouse Name:</label>
                            <input type="text" name="warehouse_name" value="{{\App\Models\BuyBillProduct::join('buy_products','buy_products.id','buy_bill_products.buy_product_id')
                            ->join('buy_orders','buy_orders.id','buy_products.buy_order_id')->value('buy_orders.warehouse_id')}} "class="form-control2  col-lg-3 readonly"
                                id="warehouse_name" readonly>

                        </div>
                        <div class="form-row">
                            <label for="total_amount_return" class="col-lg-2 label-input">Total Payment Return:</label>
                            <input type="text" class="form-control2  col-lg-3" name="total_amount_return"
                                id="total_amount_return">

                            <div class="col-lg-1"></div>

                            <label for="Date" class="col-lg-2 label-input">Date<i class="text-danger"> *
                                </i>:</label>
                            <input class="form-control2 col-lg-3" id="Date" name="date" data-provide="datepicker"
                                required data-date-format="yyyy-mm-dd">
                        </div>




                        <div class="table-responsive">
                            <table class="table table-bordered table-invoice text-nowrap custom-table "
                                id="invoice_details">
                                <thead>


                                    <tr class="table-background">
                                        <th class="text-center" scope="col">Product ID</th>
                                        <th class="text-center" scope="col">Product Name</th>
                                        <th class="text-center" scope="col">Production Date</th>
                                        <th class="text-center" scope="col">Expiry Date</th>
                                        <th class="text-center" scope="col">Purchasing Price</th>
                                        <th class="text-center" scope="col">Selling Price</th>
                                        <th class="text-center" scope="col">Received Quantity</th>
                                        <th class="text-center" scope="col">Return Quantity</th>
                                        <th class="text-center" scope="col" style="width: 100px;">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                              @foreach ($buybillproduct as $one)
                                    <tr>

                               <td class="text-center"><input type="number" class="readonly" readonly
                                                style="width: 100%;" name="product_id" value="{{$one->id}}"></td>

                                      <td>{{\App\Models\Medicine::where('product_id',\App\Models\BuyBillProduct::join('buy_products','buy_products.id','buy_bill_products.buy_product_id')->where('buy_bill_products.id',$one->id)->value('product_id'))->value('generic_name')}}
                                        {{\App\Models\MedicalSupply::where('product_id',\App\Models\BuyBillProduct::join('buy_products','buy_products.id','buy_bill_products.buy_product_id')->where('buy_bill_products.id',$one->id)->value('product_id'))->value('name')}}
                                        {{\App\Models\MedicalFood::where('product_id',\App\Models\BuyBillProduct::join('buy_products','buy_products.id','buy_bill_products.buy_product_id')->where('buy_bill_products.id',$one->id)->value('product_id'))->value('name')}}</td>

                                        <td class="text-center"><input class="readonly" readonly style="width: 100%;"
                                                name="production_date" value="{{ $one->production_date}}"></td>

                                        <td class="text-center"><input class="readonly" readonly style="width: 100%;"
                                                name="expiry_date" value="{{ $one->expired_date}}"></td>

                                        <td class="text-center"><input type="number" class="readonly purchasing_price"
                                                readonly style="width: 100%;" name="purchasing_price" value="{{ $one->purchasing_price}}"></td>

                                        <td class="text-center"><input type="number" class="readonly" readonly
                                                style="width: 100%;" name="selling_price" value="{{ $one->selling_price}}"></td>

                                        <td class="text-center"><input type="number" class="received_quantity readonly"
                                                readonly style="width: 100%;" value="{{ $one->quantity_recived}}" name="received_quantity" ></td>

                                        <td class="text-center"><input type="number" class="return_quantity"
                                                style="width: 100%;" name="number[]"></td>

                                        <td><input type="number" class="total readonly" style="width: 100%;"
                                                name="total" readonly="readonly"></td>

                                   
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <button type="submit" class="btn btn-list float-right add">Return</button>
                    </form>
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


    <script src="{{asset('js/bootbox.min.js')}}"></script>


    <script>
        $(document).ready(function () {
            $('#invoice_details').on('blur', '.return_quantity', function () {
                let $row = $(this).closest('tr');
                let return_quantity = $row.find('.return_quantity').val() || 0;
                let received_quantity = $row.find('.received_quantity').val() || 0;
                let purchasing_price = $row.find('.purchasing_price').val() || 0;

                if (Number(return_quantity) > Number(received_quantity)) {
                    bootbox.confirm({
                        message: "You can't return quantity more than " + received_quantity + " items",
                        buttons: {
                            confirm: {
                                label: 'OK',

                            },
                        },
                        callback: function (result) {
                            if (result) {
                                $row.find('.return_quantity').val(0);
                            }
                        }
                    });
                }
                if (return_quantity < 0) {
                    bootbox.confirm({
                        message: "You can't return a quantity less than zero",
                        buttons: {
                            confirm: {
                                label: 'OK',
                                className: 'btn-success'
                            },
                        },
                        callback: function (result) {
                            if (result) {
                                $row.find('.return_quantity').val(0);
                            }
                        }
                    });
                }


                $row.find('.total').val((purchasing_price * return_quantity));
                $('#total_amount_return').val(total_price('.total'));
            });

            let total_price = function ($selector) {
                let sum = 0;
                $($selector).each(function () {
                    let selectorVal = $(this).val() != '' ? $(this).val() : 0;
                    sum += Number(selectorVal);
                });
                return sum;
            }
        });

    </script>

    <script src="{{asset('js/main.js')}}"></script>
    <script src="{{asset('js/themes.js')}}"></script>
</body>

</html>
