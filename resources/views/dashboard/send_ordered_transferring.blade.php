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
    <link rel="stylesheet" href="{{asset('css/send_ordered_transferring.css')}}">

    <title>Pharmacy</title>

    <link rel="icon" href="{{asset('img/logo.png')}}" sizes="16x16 32x32" type="image/png">




</head>

<body>



  @include('sidebar&navbar')

    <!-- Start Body -->

    <div class="body-page" id="body-page">
        <div class="send-orderd-transferring">
            <div class="card">
                <div class="card-header d-flex justify-content-between bd-highlight mb-3">
                    <div class="p-2 bd-highlight">
                        Send Ordered Transferring
                    </div>
                    <div class="p-2 bd-highlight">
                        <a href="/inventory/this/Inv/Transfering/List"><button type="button" class="btn btn-list"><i
                                    class="fa fa-align-justify"></i> &nbsp;Transferring Order List</button></a>
                    </div>
                </div>
                <div class="card-body">
                    <form id="form" action="/orders/sending" >
                        <div class="form-row">
                            <label for="to_inventory" class="col-lg-2 label-input">To Inventory:</label>
                            <input type="text" name="to_inventory" value='{{$branch}}' class="form-control2  col-lg-3 readonly" id="to_inventory"
                                readonly>


                            <div class="col-lg-1"></div>

                            <label for="Date" class="col-lg-2 label-input">Transfer Date<i class="text-danger"> *
                            </i>:</label>
                            <input class="form-control2 col-lg-3" id="Date" name="transfer_date"
                                data-provide="datepicker" required data-date-format="yyyy-mm-dd">
                        </div>

                        <div class="form-row">
                            <label for="order_id" class="col-lg-2 label-input">Order Id:</label>
                            <input type="text" class="form-control2 readonly col-lg-3" readonly="readonly"
                                name="order_id"  value ="{{$id}}"id="order_id">


                            <div class="col-lg-1"></div>

                        </div>


                        <div class="table-responsive">
                            <table class="table table-bordered table-invoice text-nowrap custom-table"
                                id="invoice_details">
                                <thead>
                                    <tr class="table-background">
                                        <th class="text-center" scope="col">Product ID</th>
                                        <th class="text-center" scope="col">Product Name</th>

                                        <th class="text-center" scope="col">Ordered Quantity</th>
                                        <th class="text-center" scope="col">Send<i class="text-danger"> * </i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach($buy_products as $one )

                                    <tr class="cloning-row">

                                          <td><input type="number" class="order_quantity readonly" style="width: 100%;"
                                                  name="product_id[]"  readonly="readonly" value ="{{$one->product_id}}" ></td>
                                          <td>{{\App\Models\Medicine::where('product_id',$one->product_id)->value('generic_name')}}
                                            {{\App\Models\MedicalSupply::where('product_id',$one->product_id)->value('name')}}
                                            {{\App\Models\MedicalFood::where('product_id',$one->product_id)->value('name')}}</td>

                                        <td><input type="number" class="order_quantity readonly" style="width: 100%;"
                                                name="order_quantity" value ="{{$one->quantity_order}}" readonly="readonly" ></td>

                                        <td><input type="number" required="required" name="send[]" class="send"
                                                style="width: 100%;"></td>


                                    </tr>

                                     @endforeach

                                </tbody>
                            </table>
                        </div>
                        <button type="submit" class="btn btn-list float-right add">Add</button>
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

    <script src="js/bootbox.min.js"></script>




    <script>

        $(document).ready(function () {
            $('#invoice_details').on('blur', '.send', function () {
                let $row = $(this).closest('tr');
                let send = $row.find('.send').val() || 0;
                let available_quantity = $row.find('.available_quantity').val() || 0;
                let order_quantity = $row.find('.order_quantity').val() || 0;

                if (send > available_quantity) {
                    bootbox.confirm({
                        message: "You can send maximum " + available_quantity + " items",
                        buttons: {
                            confirm: {
                                label: 'OK',
                                className: 'btn-success'
                            },
                        },
                        callback: function (result) {
                            if (result) {
                                $row.find('.send').val(0);
                            }
                        }
                    });
                }

                if (send > order_quantity) {
                    bootbox.confirm({
                        message: "Ordered quantity is only " + order_quantity + " items",
                        buttons: {
                            confirm: {
                                label: 'OK',
                                className: 'btn-success'
                            },
                        },
                        callback: function (result) {
                            if (result) {
                                $row.find('.send').val(0);
                            }
                        }
                    });
                }

                if (send < 0) {
                    bootbox.confirm({
                        message: "You can't choose a quantity less than zero",
                        buttons: {
                            confirm: {
                                label: 'OK',
                                className: 'btn-success'
                            },
                        },
                        callback: function (result) {
                            if (result) {
                                $row.find('.send').val(0);
                            }
                        }
                    });
                }
            });
        });

    </script>

     <script src="{{asset('js/main.js')}}"></script>
     <script src="{{asset('js/themes.js')}}"></script>

</body>

</html>
