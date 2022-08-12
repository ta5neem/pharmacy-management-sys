<?php


Route::group(['namespace'=>'purchase'], function (){

  Route::get('/inventory/add', 'InventoryController@showaddview');
  Route::get('/manufacturer/add', 'WarehouseControllerer@showaddview');
  Route::get('/manufaturerreturnlist/add','WarehousereturnlistControllerer@showaddview');
  Route::get('/message/add','messageController@showaddview');
  Route::get('/responses/add','ResponseController@showaddview');
 Route::get('/order/add','BuyorderController@showaddview');
  Route::get('/recieved order/add','BuybillControllerer@showaddview');
  Route::get('/order/reciev/{id}','BuybillControllerer@showaddview');


  Route::POST('/inventory/store','InventoryController@store');
  Route::POST('/manufacturer/store','WarehouseControllerer@store');
  Route::POST('/orders/store','BuyorderController@store');

  Route::POST('/manufaturerreturnlist/store','WarehousereturnlistControllerer@store');
  Route::POST('/message/store','messageController@store');
  Route::POST('/response/store','ResponseController@store');
  Route::POST('/buybill/store/{id}','BuybillControllerer@store');
  Route::POST('/payment/store/{id}','BuybillControllerer@store_payment');
  //Route::POST('/buybill/store','BuybillControllerer@store');


  Route::get('/inventory/all','InventoryController@all');
  Route::get('/manufacturer/all','WarehouseControllerer@all');
  Route::get('/manufacturerreturnlist/all','WarehousereturnlistControllerer@all');
  Route::get('/message/all','MessageController@all');
  Route::get('/orders/all','BuyorderController@all');
  Route::get('/orders/warhouse/all','BuyorderController@all_warehose_order');
  Route::get('/orders/invevtory/all','BuyorderController@all_inventory_order');
  Route::get('/response/all','ResponseController@all');
  Route::get('/recieved order/all','BuybillControllerer@all');
  Route::get('/recieved_ware/all','BuybillControllerer@all_ware_recieved');
  Route::get('/recieved_inventory/all','BuybillControllerer@all_inventory_recieved');
  Route::get('/reports/all','OptionsController@allreports');
  Route::get('/order/buybill/{id}','BuybillControllerer@buybillfromorder');

  Route::get('/inventory/delete/{id}','InventoryController@delete');
  Route::get('/manufacturer/delete/{id}','WarehouseControllerer@delete');
  Route::get('/manufactorerreturnlists/delete/{id}','WarehousereturnlistControllerer@delete');
  Route::get('/message/delete/{id}','MessageController@delete');
  Route::get('/orders/delete/{id}','BuyorderController@delete');
  Route::POST('/responses/delete/{id}','ResponseController@delete');
  Route::get('/recieve order/delete/{id}','BuybillControllerer@return');
  Route::get('/buybillproduct/delete/{id}','BuybillproductControllerer@return');
  Route::get('/orders/product/delete/{id}','BuyproductController@delete');


  Route::get('/inventory/edit/{id}','InventoryController@edit');
  Route::get('/manufacturer/edit/{id}','WarehouseControllerer@edit');
  Route::get('/manufactorerreturnlists/edit/{id}','WarehousereturnlistControllerer@edit');
  Route::get('/messages/edit/{id}','MessageController@edit');
  Route::get('/purchace/edit/{id}','PurchaceController@edit');
  Route::get('/responses/edit/{id}','ResponseController@edit');
  Route::get('/orders/edit/{id}','BuyorderController@edit');
  Route::get('/recieved_order/edit/{id}','BuybillControllerer@edit');
  Route::get('/order/products/edit/{id}','BuyproductController@edit');
  Route::get('/buybillproduct/edit/{id}','BuybillproductControllerer@edit');


  Route::POST('/inventory/update/{id}','InventoryController@update');
  Route::POST('/manufacturer/update/{id}','WarehouseControllerer@update');
  Route::POST('/orders/update/{id}','BuyorderController@update');
  Route::POST('/manufaturerreturnlist/update/{id}','WarehousereturnlistControllerer@update');
  Route::POST('/message/update/{id}','messageController@update');
  Route::POST('/response/update/{id}','ResponseController@update');
  Route::POST('/buybill/update/{id}','BuybillControllerer@update');
  Route::POST('/buybillproduct/update/{id}','BuybillproductControllerer@update');
  Route::POST('/order/products/update/{id}','BuyproductController@update');
  Route::Post('/inven_orders/store','InventoryController@storeTheOrder');

  Route::POST('/manufacturer/soft_delete/{id}','WarehouseControllerer@soft_delete');


  Route::POST('/order/Search','BuyorderController@search');
  Route::POST('/order/Transfer/Search','BuyorderController@transfer_order_search');
  Route::POST('/recieved_order/Search','BuybillControllerer@search');
  Route::POST('/recieved_order/inventory/Search','BuybillControllerer@inventory_search');

  Route::POST('/order/reports','OptionsController@reports');
  Route::POST('/do/remove','OptionsController@do_the_remove');
  Route::POST('/manufacturer/search','WarehouseControllerer@search');
  Route::Post('/buyorder/send/do','BuyorderController@store_after_send');


  Route::get('/order/products/{id}','BuyproductController@all');
  Route::get('/order/recieved_products/{id}','BuybillproductControllerer@all');
  Route::get('/order/send/{id}','BuyorderController@send_order');
  Route::get('/paid/search','BuyorderController@paid_search');
  Route::get('/Nonpaid/search','BuyorderController@Non_paid_search');
  Route::POST('/rep/search','BuyorderController@reportsearch');

  Route::get('/recieve order/pay/{id}','BuybillControllerer@pay');
  Route::get('/remove/order','OptionsController@remove');
  Route::get('/order/product/search','OptionsController@search');
  Route::get('/Financial/reports','OptionsController@financial');
  Route::get('/inventory/Quantities/{id}','InventoryController@ProductQuantities');
  Route::get('/inventory/transfer','InventoryController@TransferOrder');
  Route::get('/inventory/dotransfering','InventoryController@TransferingTheOrder');
  Route::get('/inventory/this/Inv/Transfering/List','InventoryController@TransferingOrderList');
  Route::get('/Totalbill/reports','OptionsController@Totalbill');
  Route::get('/required/order/all','BuyorderController@all_required_order');
  Route::get('/reverse/warehouse','BuybillproductControllerer@reverse');
  Route::get('/inventory/Transfering/send/{id}','InventoryController@send_order_transfer');
  Route::get('/orders/sending',function(){return back();});
  Route::get('/warehouse/report','OptionsController@display_warehouse_reports');
  Route::get('/warehouse/order/report','OptionsController@display_order_reports');
  Route::POST('/warehouse/search/report','OptionsController@search_warehouse_reports');
  Route::get('/active/ware','OptionsController@active_ware');
  Route::get('/inactive/ware','OptionsController@inactive_ware');

  //Route::get('/export-pdf/{title}/{title2}/{date}','PDFController@downloadPdf');
  Route::get('/export-pdf/{buybill}','PDFController@downloadPdf')->name('export.export-pdf');
/*  Route::get('/themes',function(){
    return view('dashboard.themes');
  });*/
});
