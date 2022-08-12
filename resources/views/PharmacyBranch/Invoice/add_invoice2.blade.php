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
    <link rel="stylesheet" href="{{asset('css/add_invoice.css')}}">
    <title>Pharmacy</title>
    <link rel="icon" href="{{asset('img/logo.png')}}" sizes="16x16 32x32" type="image/png">

</head>

<body>

 @include('sidebar&navbar')

    <!-- Start Body -->

    <div class="body-page" id="body-page">
        <div class="add-invoice">
            <div class="card">
                <div class="card-header d-flex justify-content-between bd-highlight mb-3">
                    <div class="p-2 bd-highlight">
                        Add Invoice
                    </div>
                    <div class="p-2 bd-highlight">
                        <a ><button type="button" class="btn btn-list" data-toggle="modal"
                                            data-target="#AddCustomarModal" aria-describedby="btnGroupAddon"><i
                                    class="fa fa-plus-square-o"></i> &nbsp;Add Customer</button></a>
                        <div class="modal fade" id="AddCustomarModal" tabindex="-1" role="dialog"
                                        aria-labelledby="AddCustomerModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="modal-title" id="AddCustomerModalLabel">Add Customer</h3>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="needs-validation" novalidate>
                                                        <div class="col">
                                                            <input type="text"placeholder="Name" class="form-control input" required>
                                                            
                                                            
                                                            <div class="invalid-feedback">
                                                                This field is required.
                                                            </div>
                                                            
                                                        </div>
                                                        <div class="col">
                                                            <input type="text" placeholder="Phone"class="form-control input" minlength="10" onkeypress="return onlyNumberKey(event)" >
                                                            
                                                            <div class="invalid-feedback">
                                                                Please enter a valid phone number.
                                                            </div>
                                                        </div>
                                                        
                                                        <button type="submit" class="btn btn-list float-right">Add</button>
                                                    </form>
                                                   
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                        <a href="/Invoice/All/list"><button type="button" class="btn btn-list"><i
                                    class="fa fa-align-justify"></i> &nbsp;Invoice List</button></a>
                    </div>
                </div>
                <div class="card-body">
                   <form class="form"  onsubmit="deleteLocal()"  action="/Invoice/store" method="POST">
                        @csrf
                        <div class="form-row">
                            <label for="CustomerName" class="col-lg-2 label-input">Customer Name<i class="text-danger">
                                    * </i>:</label>
                            <select class="selectpicker col-lg-3 select-customer" data-live-search="true"
                        id="select-customer" onchange="doSomething();"  name="customer">
                                <option data-value="Choose" selected>Choose</option>
                                @foreach($customers as $one)
                                <option value="{{$one->id}}">{{$one->name}} : {{$one->mobile}}</option>
                              @endforeach
                            </select>

                            <div class="col-lg-1"></div>

                            <label for="InvoiceDate" class="col-lg-2 label-input">Date<i class="text-danger"> *
                                </i>:</label>
                            <input class="form-control2 col-lg-3" id="InvoiceDate" data-provide="datepicker" required
                                data-date-format="yyyy-mm-dd" name="date">

                        </div>


                        <div class="table-responsive">
                            <table class="table table-bordered table-invoice text-nowrap custom-table" id="invoice_details">
                                <thead>
                                    <tr class="table-background">
                                        <th class="text-center" scope="col">Product Name</th>
                                        <th class="text-center" scope="col">Avail Qty</th>
                                        <th class="text-center" scope="col">batch number
</th>
                                        <th class="text-center" scope="col">Quantity<i class="text-danger"> * </i></th>
                                        <th class="text-center" scope="col">Price</th>
                                        <th class="text-center" scope="col">Discount % </th>
                                        <th class="text-center" scope="col">Total</th>
                                        <th class="text-center" scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody onload="buildTable()">
                                
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="5" rowspan="1"></td>
                                        <td class="text-center" colspan="1"style="padding-top:18px"><b>Total Amount</b></td>
                                        <td><input type="number" name="total_amount" class="total_amount readonly" id="total_amount" readonly="readonly" style="width: 100%;"></td>

                                        <td class="text-center">        
                                            <ul class="dropdown" >
                                                <li><a class="btn-add"><i class="fa fa-plus" aria-hidden="true"></i></a> 
                                                    <ul>
                                                        <li><a href="medicine_grid">Medicine</a></li>
                                                        <li><a href="medicalFood_grid">Medical Food</a></li>
                                                        <li><a href="medicalDevices_grid">Medical Devices</a></li>
                                                        <li><a href="cosmetics_grid">Cosmetics</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td colspan="5" rowspan="1"></td>
                                        <td class="text-center" colspan="1" style="padding-top:18px"><b>Invoice Discount %</b></div>
                                        </td>
                                        <td><input type="number" class="invoice_discount" id="invoice_discount" name="invoice_discount" style="width: 100%;" min="0"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="5" rowspan="1"></td>
                                        <td class="text-center" colspan="1"style="padding-top:18px"><b>Due Amount</b></td>
                                        <td><input type="number" name="due_amount" class="due_amount readonly" id="due_amount" readonly="readonly"
                                                style="width: 100%;"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="5" rowspan="1"></td>
                                        <td class="text-center" colspan="1"style="padding-top:18px"><b>Paid Amount</b></td>
                                        <td><input type="number" class="paid_amount" id="paid_amount" name="paid_amount" style="width: 100%;" required="required" min="0" ></td>
                                    </tr>

                                </tfoot>
                            </table>
                        </div>
    <div class="form-row">
                                       <div class="form-row">
                                    <div class="col-lg-9">
                                        <label for="Status"  class="col-lg-3 label-input text-left">Bay by:</label>

                                        <label class="col-lg-4 container">Stripe
                                            <input type="radio" checked="checked" name="radio" value="1">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="col-lg-4 container" >Cash
                                            <input type="radio" name="radio" value="0">
                                            <span class="checkmark"></span>
                                        </label>


                                    </div>

                                </div>

                                </div>

                        <button type="submit" class="btn btn-list float-right add">Add</button>

                    </form>
                </div>
            </div>
        </div>

    </div>
    <!-- End Body -->


    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>



     <script src="{{asset('js/main.js')}}"></script>
     <script src="{{asset('js/themes.js')}}"></script>



     <script src="{{asset('js/bootbox.min.js')}}"></script>
     <script src="{{asset('js/jquery.form.js')}}"></script>

     <script src="{{asset('js/jquery.validate.min.js')}}"></script>
     <script src="{{asset('js/additional-methods.min.js')}}"></script>


    <script>

        var products = [];
        products = JSON.parse(localStorage.getItem('products'));
        

        $(document).ready(function(){
            buildTable();
        
            $('#invoice_details').on('keyup mouseover', '.quantity', function () {
                let $row = $(this).closest('tr');
                var row_id = $(this).closest('tr').attr('id');


                let quantity = $row.find('.quantity').val() || 0;
                let price = $row.find('.price').val() || 0;
                let discount = $row.find('.discount').val()  || 0;
                if (discount != 0){
                    price = price - price * (discount / 100);
                }
                $row.find('.total').val((price * quantity));

                $('#total_amount').val(total_amount('.total'));
                $('#due_amount').val(total_amount('.total'));
                $('#due_amount').val(due_amount());

                if (quantity > Number(products[row_id].quantity_product)) {

                    bootbox.confirm ({
                        message: "You can select maximum " + products[row_id].quantity_product + " items",
                            buttons: {
                                confirm: {
                                    label: 'OK',
                                    className: 'btn-success'
                                },
                            },
                           callback: function (result) {
                               if (result){
                                    $row.find('.quantity').val(0);
                               }
                            }
                    });
                }
                if (quantity < 0) {
                    bootbox.confirm ({
                        message: "You can't choose a quantity less than zero",
                            buttons: {
                                confirm: {
                                    label: 'OK',
                                    className: 'btn-success'
                                },
                            },
                           callback: function (result) {
                               if (result){
                                // console.log(result);
                                // console.log(quantity);
                                $row.find('.quantity').val(0);
                                // console.log(quantity);
                               }
                            }
                    });
                }
                products[row_id].quantity = quantity;
            
                localStorage.removeItem('products');
       
                localStorage.setItem('products', JSON.stringify(products));
            });

            $('#invoice_details').on('keyup mouseover', '.discount', function () {
                let $row = $(this).closest('tr');
                let quantity = $row.find('.quantity').val() || 0;
                let price = $row.find('.price').val() || 0;
                let discount = $row.find('.discount').val()  || 0;
                if (discount != 0){
                    price = price - price * (discount / 100);
                }
                $row.find('.total').val((price * quantity));

                $('#total_amount').val(total_amount('.total'));
                $('#due_amount').val(total_amount('.total'));
                $('#due_amount').val(due_amount());

                if ((discount) < 0) {
                    bootbox.confirm({
                        message: "You can't input discount less than zero",
                        buttons: {
                            confirm: {
                                label: 'OK',
                                className: 'btn-success'
                            },
                        },
                        callback: function (result) {
                            if (result) {
                                $row.find('.discount').val(0);
                            }
                        }
                    });
                }

            });

            let total_amount = function ($selector) {
                let sum = 0;
                $($selector).each(function () {
                    let selectorVal = $(this).val() != '' ? $(this).val() : 0;
                    sum += parseFloat(selectorVal);
                });
                return sum;
            }

            $('#invoice_details').on('keyup mouseover', '.invoice_discount', function () {
                let $row = $(this).closest('tr');
                let invoice_discount = $row.find('.invoice_discount').val()  || 0;

                if ((invoice_discount) < 0) {
                    bootbox.confirm({
                        message: "You can't input discount less than zero",
                        buttons: {
                            confirm: {
                                label: 'OK',
                                className: 'btn-success'
                            },
                        },
                        callback: function (result) {
                            if (result) {
                                $row.find('.invoice_discount').val(0);
                            }
                        }
                    });
                }

                $('#due_amount').val(due_amount());
            });

            let due_amount = function () {
                let total_amount = $('.total_amount').val() || 0;
                let invoice_discount = parseFloat($('.invoice_discount').val()) || 0;
                let discountVal = invoice_discount != 0 ? total_amount * (invoice_discount / 100) : 0;
                let result = (total_amount - discountVal);
                return result;
            }

            $('#invoice_details').on('blur', '.paid_amount', function () {
                let $row = $(this).closest('tr');
                let paid_amount = $row.find('.paid_amount').val()  || 0;
                $('#due_amount').val(due_amount() - paid_amount);

                if ($('#due_amount').val() < 0) {

                    bootbox.confirm ({
                        message: "You must return " + $('#due_amount').val()*-1 + " to customer",
                            buttons: {
                                confirm: {
                                    label: 'OK',
                                    className: 'btn-success'
                                },
                            },
                           callback: function (result) {
                               if (result){
                                    $row.find('.paid_amount').val(0);
                               }
                            }
                    });
                }

                if (paid_amount < 0) {
                    bootbox.confirm({
                        message: "You can't paid amount less than zero",
                        buttons: {
                            confirm: {
                                label: 'OK',
                                className: 'btn-success'
                            },
                        },
                        callback: function (result) {
                            if (result) {
                                $row.find('.paid_amount').val(0);
                            }
                        }
                    });
                }

                

            });

            // var rowCount = $('#invoice_details >tbody >tr');

            $(document).on('click', '.btn-delete', function(e){
                // var rowCount = $('#invoice_details >tbody >tr');
                let $row = $(this).closest('tr');
                var row_id = $(this).closest('tr').attr('id');


                $(this).closest("tr").remove();
               
                console.log("row_id: " + row_id);
                
                e.preventDefault();
                
                
                $('#total_amount').val(total_amount('.total'));
                $('#due_amount').val(total_amount('.total'));
                $('#due_amount').val(due_amount());
             

                var id_delete = products[row_id].id_product;
                console.log("id_delete: " + id_delete);
                console.log(products);
                // products.splice('id_product',id_delete);
                

                
                var index = products.findIndex(function(o){
                     return o.id_product === (id_delete);
                })
                if (index !== -1) 
                    products.splice(index, 1);

                console.log(products);

                // localStorage.removeItem('products');
       
                localStorage.setItem('products', JSON.stringify(products));
                // location.reload();
                // $('#invoice_details').load('add_invoice #invoice_details');
                // $('#invoice_details').reload();
                // buildTable();

            });


        function buildTable(){
                for (var i=0; i<products.length; i++){
                    $('#invoice_details').find('tbody').append($('' + 
                        '<tr class="cloning-row" id="' + i + '">' +
                            '<td><input type="text" name="product_name['+i+']" id="product_name" class="product_name readonly" readonly="readonly" style="width: 100%;" value="'+products[i].name_product+'"></td>'+

                            '<td><input type="number" class="avail_qty readonly" style="width: 100%;" name="avail_qty['+i+']" id="avail_qty" readonly="readonly" value="'+products[i].quantity_product+'"></td>' +

                            '<td><input type="text" class="id_product readonly" id="id_product" readonly="readonly" style="width: 100%;" name="id_product['+i+']" value="'+products[i].id_product+'"></td>'+

                            '<td><input type="number" required name="quantity['+i+']" id="quantity" class="quantity" style="width: 100%;" value="'+products[i].quantity+'"></td>'+

                            '<td><input type="number" class="price readonly" style="width: 100%;" name="price['+i+']" id="price" readonly="readonly" value="'+products[i].price_product+'"> </td>'+

                            '<td><input type="number" style="width: 100%;" name="discount['+i+']" class="discount" id="discount" min="0"></td>'+

                            '<td><input type="number" class="total readonly" readonly="readonly" name="total['+i+']" id="total" style="width: 100%;"></td>'+
                            '<td class="text-center"><a class="btn-delete"><i class="fa fa-minus" aria-hidden="true"></i></a></td>'+
                        '</tr>'
                    ));
                }
            }

        });

        var due_amount = document.getElementById('due_amount');
        var paid_amount = document.getElementById('paid_amount');
       


        (function () {
            
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })() 
        
        // Accept Only Number
        function onlyNumberKey(evt) {
          
            // Only ASCII character in that range allowed
            var ASCIICode = (evt.which) ? evt.which : evt.keyCode
            if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
                return false;
            return true;
        }

        $('form').on('submit', function(e){

            $('input.quantity').each(function(){

                $(this).rules("add", {required: true, digits: true });
            });
            $('input.discount').each(function(){

                $(this).rules("add", { digits: true });
            });
            $('input.invoice_discount').each(function(){

                $(this).rules("add", { digits: true });
            });
            $('input.paid_amount').each(function(){

                $(this).rules("add", { digits: true});
            });
            e.preventDefault();
        });
        
        function deleteLocal(){
            localStorage.removeItem('products');
        }

        function doSomething(){
            var phone = document.getElementsByClassName('phone');
            console.log(phone);
            var phoneBack = document.getElementById('phone-customer').innerText;
            phone.value = phoneBack;
            phone.innerHTML = phoneBack;
            console.log(phoneBack);
            console.log(phone.value);
        }
    </script>

</body>
</html>

