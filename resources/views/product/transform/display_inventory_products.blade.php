<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">



    <!-- start select -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css">
    <!-- end select -->

    <script src="https://kit.fontawesome.com/18695b64bb.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <script src="{{asset('js/popper.min.js')}}"></script>


    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>



    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css">



    <link rel="stylesheet" href="{{asset('css/master.css')}}">
    <link rel="stylesheet" href="{{asset('css/display_inventory_products.css')}}">



    <title>Pharmacy</title>
    <link rel="icon" href="{{asset('img/logo.png')}}" sizes="16x16 32x32" type="image/png">

</head>

<body>

@include('sidebar&navbar')

    <!-- Start Body -->


    <div class="body-page" id="body-page">
        <div class="display-inventory-products">
            <div class="card">
                <div class="card-header d-flex justify-content-between bd-highlight mb-3">
                    <div class="p-2 bd-highlight">
                        Display Inventory Products
                    </div>
                    <div class="p-2 bd-highlight">
                        <a href="/inventory/all"><button type="button" class="btn btn-list"><i
                                    class="fa fa-align-justify"></i> &nbsp;Inventory List</button></a>
                    </div>
                </div>
                <div class="card-body">
                    <table id="table" class="table table-striped table-bordered dt-responsive nowrap"
                        style="width:100%">
                        <thead>

                            <tr>
                                <th scope="col">Convert To Pharmacy</th>
                                <th scope="col">Batch Id</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Expiry Date</th>
                                <th scope="col">Purchasing Price</th>
                                <th scope="col">Selling Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Image</th>

                            </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>
                                    <div class="input-group">
                                        <button type="submit" class="btn" data-toggle="modal" data-target="#paidModal"
                                                aria-describedby="btnGroupAddon"><i class="fa fa-exchange">&nbsp;
                                                Convert</i> </button>
                                    </div>

                                    <div class="modal fade" id="paidModal" tabindex="-1" role="dialog"
                                         aria-labelledby="paidModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="modal-title" id="paidModalLabel">Convert To Pharmacy</h3>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">

                                                    <form class="form" method="POST" action="{{route('transform.store')}}">
                                                        @csrf
                                          <input type="hidden" value="{{$product->id}}" name="buy_bill_product_id">

                                                        <div class="form-row" style="margin-top: 10px;">
                                                            <label for="branch" class="col-lg-3 label-input">Pharmacy<i
                                                                    class="text-danger">
                                                                    * </i>:</label>
                                                            <select class="selectpicker col-lg-7 branch" name="branch_id"
                                                                    data-live-search="true" required>
                                                                <option value=""></option>
                                                                @foreach($pharmacies as $pharmacy)
                                                                <option value="{{$pharmacy->id}}">{{$pharmacy -> name}}</option>
                                                                @endforeach

                                                            </select>
                                                        </div>
                                                        <div class="form-row">
                                                            <label for="quantity"
                                                                   class="col-lg-3 label-input">Quantity<i
                                                                    class="text-danger">
                                                                    * </i>:</label>
                                                            <input type="number" class="form-control2 col-lg-7"
                                                                   id="quantity" name="quantity" required>
                                                        </div>
                                                        <div class="form-row">
                                                            <label for="closet"
                                                                   class="col-lg-3 label-input">Closet:</label>
                                                            <input type="text" class="form-control2 col-lg-7"
                                                                   id="closet" name="closet">
                                                        </div>
                                                        <div class="form-row">
                                                            <label for="rack" class="col-lg-3 label-input">Rack:</label>
                                                            <input type="text" class="form-control2 col-lg-7"
                                                                   id="rack" name="rack">
                                                        </div>
                                                        <div class="form-row">
                                                            <label for="drawer"
                                                                   class="col-lg-3 label-input">Drawer:</label>
                                                            <input type="text" class="form-control2 col-lg-7"
                                                                   id="drawer" name="drawer">
                                                        </div>
                                                        <button type="submit" class="btn btn-list float-right add">Convert</button>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>{{$product -> id}}</td>
                                <td>{{$product -> name}}</td>
                                <td>{{$product -> expired_date}}</td>
                                <td>{{$product -> purchasing_price}}</td>
                                <td>{{$product -> selling_price}}</td>
                                <td>{{$product -> available_quantity}}</td>
                                <td><img src="{{asset('images/products/'.$product->image)}}"></td>

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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/i18n/defaults-*.min.js"></script> -->



    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.7/js/responsive.bootstrap4.min.js"></script>



    <script src="{{asset('js/main.js')}}"></script>
    <script src="{{asset('js/themes.js')}}"></script>
</body>

</html>
