@extends('layouts.app')

@section('content')

<div class="container">
<form>

    <div class="form-group">
        <label for="name">Search</label>
        <input type="text" class="form-control" placeholder="Enter product" id="name" name="name">
     </div>
    
    <button type="button" id="search" name="search" class="btn btn-primary" >Submit</button>

</form>
<table class="table table-bordered">
    <thead>
      <tr>
         <th>Id</th>
        <th>name</th>
       <th> price </th>
      </tr>
    </thead>
    <tbody id="searchtable" class="searchtable">
    </tbody>
    </table>
</div>

    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                   create invoice
                </div>

                <div class="card-body">
                    <form action="{{ route('invoice.store') }}" method="post" class="form">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="customer_name">Customer Name</label>
                                    <input required="required" type="text" name="customer_name" class="form-control">
                                
                                </div>
                            </div>
                          
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="customer_mobile">customer_mobile</label>
                                    <input required="required" type="text" name="customer_mobile" class="form-control">
                                 
                                </div>
                            </div>
                        </div>
                     

                        <div class="table-responsive">
                            <table class="table" id="invoice_details">
                                <thead>
                                       
                                <tr>
                                    <th></th>
                        
                                    <th>product name</th>
                                     <th>product ID</th>
                                    <th>quantity</th>
                                    <th>unit price</th>
                                    <th>product subtotal</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr class="cloning_row" id="0">
                                <td><button type="button" class="btn btn-danger ">delete</button></td>'
                                    <td>
                                        <input required="required" type="text"  name="product_name[0]" id="product_name" class="product_name form-control">
                                      
                                    </td>
                                     <td>
                                        <input required="required" type="text" name="product_id[0]" id="product_id" class="product_id form-control">
                                    
                                    </td>
                                
                                    <td>
                                        <input required="required" type="number" name="quantity[0]" step="1" id="quantity" class="quantity form-control">
                                    
                                    </td>
                                    <td>
                                        <input required="required" type="number" name="unit_price[0]" step="1" id="unit_price" class="unit_price form-control">
                                      
                                    </td>
                                    <td>
                                        <input required="required" type="number" step="1" name="row_sub_total[0]" id="row_sub_total" class="row_sub_total form-control" readonly="readonly">
                                    
                                    </td>
                                </tr>
                                </tbody>

                                <tfoot>
                                <tr>
                                    <td colspan="5">
                                        <button type="button" class="btn_add btn btn-primary ">add_another_product</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3"></td>
                                    <td colspan="2">sub_total</td>
                                    <td><input required="required" type="number" step="1" name="sub_total" id="sub_total" class="sub_total form-control" readonly="readonly"></td>
                                </tr>
                                <tr>
                                    <td colspan="3"></td>
                                    <td colspan="2">discount</td>
                                    <td>
                                        <div class="input-group mb-3">
                                            <select name="discount_type" id="discount_type" class="discount_type custom-select">
                                                <option value="fixed">sr</option>
                                                <option value="percentage">percentage</option>
                                            </select>
                                            <div class="input-group-append">
                                                <input required="required" type="number" step="1" name="discount_value" id="discount_value" class="discount_value form-control" value="0.00">
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="3"></td>
                                    <td colspan="2">vat</td>
                                    <td><input type="number" step="1" name="vat_value" id="vat_value" value="0" class="vat_value form-control" readonly="readonly"></td>
                                </tr>
                                <tr>
                                    <td colspan="3"></td>
                                    <td colspan="2">shipping</td>
                                    <td><input required="required" value="0" type="number" step="1" name="shipping" id="shipping" class="shipping form-control"></td>
                                </tr>
                                <tr>
                                    <td colspan="3"></td>
                                    <td colspan="2">total_due</td>
                                    <td><input required="required" type="number"  name="total_due" id="total_due" class="total_due form-control" readonly="readonly"></td>
                                </tr>
                                    <tr>
                                    <td colspan="3"></td>
                                    <td colspan="2">paid</td>
                                    <td><input type="number" value="0" step="0.01" name="paid" id="paid" class="paid form-control"></td>
                                </tr>

                                 <tr>
                                    <td colspan="2"></td>
                                    <td colspan="2"><input required="required" type="text" name="ResidualT" id="ResidualT" class="ResidualT form-control" readonly="readonly"></td>
                                    <td><input type="number" value="0" name="Residual" id="Residual" class="Residual form-control" readonly="readonly"></td>
                                </tr>

                                </tfoot>
                            </table>
                        </div>

                        <div class="text-right pt-3">
                            <button type="submit" name="save" class="btn btn-primary">save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('script')
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>


 <script src="{{ asset('frontend/js/form_validation/jquery.form.js') }}"></script>
    <script src="{{ asset('frontend/js/form_validation/jquery.validate.min.js') }}"></script>

<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.js"></script>


    <script src="{{ asset('frontend/js/form_validation/additional-methods.min.js') }}"></script>


<script>


    $(document).ready(function(){
 $('#invoice_details').on('keyup blur', '.quantity', function () {
        //we know the row in (this) table
        let $row = $(this).closest('tr');
        //we return the quantity ,unit_price
        let quantity = $row.find('.quantity').val() || 0;
        let unit_price = $row.find('.unit_price').val() || 0;
         //give two zeros after the comma
        $row.find('.row_sub_total').val((quantity * unit_price).toFixed(2));

        $('#sub_total').val(sum_total('.row_sub_total'));
        $('#vat_value').val(calculate_vat());
        $('#total_due').val(sum_due_total());

    }); 

 
  $('#invoice_details').on('keyup blur', '.unit_price', function () {
        //we know the row in (this) table
        let $row = $(this).closest('tr');
        //we return the quantity ,unit_price
        let quantity = $row.find('.quantity').val() || 0;
        let unit_price = $row.find('.unit_price').val() || 0;
         //give two zeros after the comma
        $row.find('.row_sub_total').val((quantity * unit_price).toFixed(2));

        $('#sub_total').val(sum_total('.row_sub_total'));
        $('#vat_value').val(calculate_vat());
        $('#total_due').val(sum_due_total());

    }); 
   $('#invoice_details').on('keyup blur', '.discount_type', function () {
        $('#vat_value').val(calculate_vat());
        $('#total_due').val(sum_due_total());
    });

    $('#invoice_details').on('keyup blur', '.discount_value', function () {
        $('#vat_value').val(calculate_vat());
        $('#total_due').val(sum_due_total());
    });

    $('#invoice_details').on('keyup blur', '.shipping', function () {
       // $('#vat_value').val(calculate_vat());
        $('#total_due').val(sum_due_total());
    });
    $('#invoice_details').on('keyup blur', '.paid', function () {
      
        $('#Residual').val(sum_Residual());
    });





  //selector = id Fields to be collected
   let sum_total = function ($selector) {
        let sum = 0;
        //$($selector).each = All fields
        $($selector).each(function () {
            let selectorVal = $(this).val() != '' ? $(this).val() : 0;
            //To make it float
            sum += parseFloat(selectorVal);
        });
        return sum.toFixed(2);
    }

  let calculate_vat = function () {
        let sub_totalVal = $('.sub_total').val() || 0;
        let discount_type = $('.discount_type').val();
        let discount_value = parseFloat($('.discount_value').val()) || 0;
        let discountVal = discount_value != 0 ? discount_type == 'percentage' ? sub_totalVal * (discount_value / 100) : discount_value : 0;

        let vatVal = (sub_totalVal - discountVal) * 0.05;

        return vatVal.toFixed(2);
    }
     let sum_due_total = function () {
        let sum = 0;
        let sub_totalVal = $('.sub_total').val() || 0;
        let discount_type = $('.discount_type').val();
        let discount_value = parseFloat($('.discount_value').val()) || 0;
        let discountVal = discount_value != 0 ? discount_type == 'percentage' ? sub_totalVal * (discount_value / 100) : discount_value : 0;

        let vatVal = parseFloat($('.vat_value').val()) || 0;
        let shippingVal = parseFloat($('.shipping').val()) || 0;

        sum += sub_totalVal;
        sum -= discountVal;
        sum += vatVal;
        sum += shippingVal;

        return sum.toFixed(2);
    }
     let sum_Residual = function () {
     
        let total_dueVal = $('.total_due').val() || 0;
        let paidVal = $('.paid').val() || 0;
        let sum=total_dueVal-paidVal;
            if(sum<0)
            {
              $('#ResidualT').val("The rest brought it back");   
            }
            else
            {
                  $('#ResidualT').val("The rest is paid");  
            }
        return sum.toFixed(2);
    }

   
    $(document).on('click', '.btn_add', function () {
        let trCount = $('#invoice_details').find('tr.cloning_row:last').length;
        let numberIncr = trCount > 0 ? parseInt($('#invoice_details').find('tr.cloning_row:last').attr('id')) + 1 : 0;

        $('#invoice_details').find('tbody').append($('' +
'<tr class="cloning_row" id="' + numberIncr + '">' +

'<td><button type="button" class="btn btn-danger delegated-btn ">delete</button></td>' +

'<td><input required="required" type="text"  name="product_name[' + numberIncr + ']" class="product_name form-control" ></td>' +

'<td><input required="required" type="text" name="product_id[' + numberIncr + ']" class="product_id form-control"></td>' +

'<td><input required="required" type="number" name="quantity[' + numberIncr + ']" step="1" class="quantity form-control"></td>' +

'<td><input required="required"  type="number" name="unit_price[' + numberIncr + ']" step="1" class="unit_price form-control"></td>' +

'<td><input required="required" type="number" name="row_sub_total[' + numberIncr + ']" step="0.01" class="row_sub_total form-control" readonly="readonly"></td>' +
'</tr>'));
    });

  $(document).on('click', '.delegated-btn', function (e) {
        e.preventDefault();
        $(this).parent().parent().remove();
        $('#sub_total').val(sum_total('.row_sub_total'));
        $('#vat_value').val(calculate_vat());
        $('#total_due').val(sum_due_total());
    });
 

  });
  

</script>
@endsection
 
@section('script1')
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
       
        function load_data(full_texte_search_query='')
        {
             var _token=$("input[name=_token]").val();
             $.ajax({
                url:"{{route('product.add')}}",
                method:"POST",
                data:{full_texte_search_query:full_texte_search_query , _token:_token },
                dataType:"json",
                success:function(data)
                {
                    var output='';
                    if(data.length>0)
                    {
                        for(var count=0; count < data.length ; count++)
                        {
                            output += '<tr>';
                         
                             output += '<td>'+data[count].id+'</td>';
                             output += '<td>'+data[count].name+'</td>';
                             output += '<td>'+data[count].price+'</td>';
                             output += '</tr>';
                        }

                    }
                    else
                    {
                       output += '<tr>';
                             output += '<td colspan="2">No Data</td>';
                           
                             output += '</tr>';  

                    }
                    $('tbody.searchtable').html(output);
                }


             });
             
        }
  $('#search').click(function(){
    var full_texte_search_query=$('#name').val();
    load_data(full_texte_search_query);
  });


  


    });
</script>
@endsection

   
