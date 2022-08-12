
<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/home', function () {
    return view('home');
});

Auth::routes();

Route::group(['namespace' => 'PharmacyBranch'], function () {

 
//,'role:employeePharmacy,admin'
Route::group(['middleware' => ['auth']], function () {
//Location
    Route::get('/locations/add','LocationController@add');
    Route::post('/locations/store','LocationController@store');
    Route::get('/locations/all','LocationController@all');
    Route::get('/locations/Delete/{id}','LocationController@delete');
    Route::get('/locations/Edit/{id}','LocationController@edit');
    Route::post('/locations/Update/{id}','LocationController@update');

//Branch
    Route::get('/branchs/add','BranchController@add');
    Route::post('/branchs/store','BranchController@store');
    Route::get('/branchs/all','BranchController@all');
    Route::get('/branchs/Delete/{id}','BranchController@delete');
    Route::get('/branchs/Edit/{id}','BranchController@edit');
    Route::post('/branchs/Update/{id}','BranchController@update');



//Customer
    Route::get('/Customer/all','CustomerController@all');
    Route::get('/Customer/add','CustomerController@add');
    Route::post('/Customer/store','CustomerController@store');
    Route::get('/Customer/Delete/{id}','CustomerController@delete');
 Route::get('/Customer/Delete_loan/{id}','CustomerController@delete_loan');
    Route::get('/Customer/Edit/{id}','CustomerController@edit');
    Route::post('/Customer/Update/{id}','CustomerController@update');
// Route::get('/Customer/Search','CustomerController@search');
    Route::post('/Customer/Paid_reckon/{id}','CustomerController@paid_reckon');
// Route::get('/Customer/Invoice/{id}','CustomerController@Invoice');
    Route::get('Customer/report', 'CustomerController@report_customer')->name('report');
    Route::get('/Customer/all_reckons/{id}','CustomerController@all_reckons');

    Route::get('/Customer/AllInvoiceF/{id}','CustomerController@all_invoice_F');
    Route::get('/Customer/AllInvoice/{id}','CustomerController@all_invoice');
    Route::get('/Customer/Invoice_Branch/{C_id}/{B_id}','CustomerController@all_invoice_Branch');
    Route::get('/Customer/All/product/{id}','CustomerController@all_product');
    Route::get('/Customer/Delete_loan/{id}','CustomerController@delete_loan');


//return
    Route::get('/Customer/AllReturnInvoiceF/{id}','CustomerController@all_Rinvoice_F');
    Route::get('/Customer/AllRInvoice/{id}','CustomerController@all_Rinvoice');
    Route::get('/Customer/RInvoice_Branch/{C_id}/{B_id}','CustomerController@all_Rinvoice_Branch');


//PharmacyRuleController
    Route::get('/PharmacyRule/add','PharmacyRuleController@add');
    Route::post('/PharmacyRule/store','PharmacyRuleController@store');
    Route::get('/PharmacyRule/all','PharmacyRuleController@all');
    Route::get('/PharmacyRule/Delete/{id}','PharmacyRuleController@delete');
    Route::get('/PharmacyRule/Edit/{id}','PharmacyRuleController@edit');
    Route::post('/PharmacyRule/Update/{id}','PharmacyRuleController@update');

//User
    Route::get('/User/all','UserController@all');
    Route::get('/User/Delete/{id}','UserController@delete');
    Route::get('/User/Edit/{id}','UserController@edit');
    Route::get('/User/Transfer/{id}','UserController@transfer');
    Route::post('/User/Update/{id}','UserController@update');
    Route::post('/User/Update/Branch/{id}','UserController@update_branch');
    Route::post('/User/select/Branch/{id}','UserController@selectBranch');


    Route::get('/User/Info','UserController@info_user');
    Route::post('/User/Update','UserController@update_user');
    Route::get('/User/Edit','UserController@edit_user');
    Route::get('/report', 'UserController@user_betweenTwoDate')->name('userTwoDate');


//Product
// Route::get('/addToCart/{bIn_id}/{p_name}/{p_price}', 'Product2Controller@addToCart')->name('cart.add');
// Route::get('/shopping-cart', 'Product2Controller@showCart')->name('cart.show');
// Route::put('/products/{product}', 'Product2Controller@update')->name('product.update');
// Route::delete('/products/{product}', 'Product2Controller@destroy')->name('product.remove');




//Invoice
    
        Route::get('/Invoice/print_invoice/{id}','InvoiceController@print_invoice');
        Route::post('/Invoice/store','InvoiceController@store');
        Route::get('/Invoice/add','InvoiceController@index');
        Route::get('/Invoice/show/{id}','InvoiceController@show')->name('invoice.show');
        // Route::get('/checkout/{amount}', 'InvoiceController@checkout')->name('cart.checkout');
        // Route::post('/charge', 'InvoiceController@charge')->name('cart.charge');
        Route::get('/Invoice/delete/{id}', 'InvoiceController@delete_Invoice')->name('invoice.delete');
        Route::get('/RInvoice/delete/{id}', 'InvoiceController@delete_returnInvoice')->name('Rinvoice.delete');
        Route::get('/RInvoice/Branch/{id}','InvoiceController@all_returnInvoice_forBranch');
        Route::get('/Invoice/Branch/{type_file}/{id}','InvoiceController@all_invoice_forBranch');
                Route::get('/ReturnInvoice/Branch/{type_file}/{id}','InvoiceController@all_return_invoice_forBranch');

        // Route::get('/ReturnInvoice/All','InvoiceController@report_returnInvoice');
        Route::get('/Reckon/All','InvoiceController@reckon_all');
        Route::get('/Invoice/All/{type_file}','InvoiceController@all_invoice');
        Route::get('/ReturnInvoice/All/{type_file}','InvoiceController@all_retuen_invoice');
     Route::get('/DelayedInvoice/All/{type_file}','InvoiceController@all_delayed_invoice');

     Route::get('/AnnualInvoice/report','Invoice2Controller@annual_invoice');

        
        // Route::get('/ReturnInvoice/All/{x}','InvoiceController@report+returnInvoice');
        // Route::get('/Reckon/All/{x}','InvoiceController@report_reckon');
        Route::get('/Invoice/return_invoice/{id}','InvoiceController@return_invoice');
        Route::post('/Invoice/Return/{IP_id}','InvoiceController@returnI');
        Route::get('/Customer/ReturnInvoice','InvoiceController@ReturnInvoice');
        Route::get('/productsR/{IP}','InvoiceController@destroyR')->name('product.removeR');
        Route::get('/Cart/cartReturn', 'InvoiceController@showCartReturn')->name('cartReturn.show');

    // Route::get('/stripe1',
    //     function()

    //     {
    //         $amount=100;
    //         return view('dashboard.Invoice.checkout',compact('amount'));
    //     }
    // );

//stripe
  Route::get('stripe', 'StripePaymentController@stripe');
Route::post('stripe', 'StripePaymentController@stripePost')->name('stripe.post');

});





    Route::get('/themes',function()
    {

        return view('themes');

    });

});



Route::get('/themes', function () {
    // return view('themes');
    return view('index');
});



    Route::get('/medicin_grid','Product\MedicineController@getAllGrid');
    Route::get('/test','Invoice2Controller@test');
