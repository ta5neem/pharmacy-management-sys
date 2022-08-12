<?php

Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]],function(){

Route::group(['prefix' => 'medicalSupply', 'namespace' => 'Product'], function () {

    Route::get('create', 'MedicalSupplyController@create');
    Route::post('store', 'MedicalSupplyController@store')->name('medicalSupply.store');


    Route::get('edit/{id}', 'MedicalSupplyController@edit');
    Route::post('update/{id}', 'MedicalSupplyController@update')->name('medicalSupply.update');

    Route::get('all', 'MedicalSupplyController@getAll');
    Route::get('delete/{id}', 'MedicalSupplyController@delete')->name('medicalSupply.delete');

    Route::get('/supply_grid','MedicalSupplyController@getAllGrid');
    Route::get('/show_details/{id}', 'MedicalSupplyController@showDetails');
    Route::get('/show_batch/{id}', 'MedicalSupplyController@showBatches');
});

Route::group(['prefix' => 'medicalFood', 'namespace' => 'Product'], function () {

    Route::get('create', 'MedicalFoodController@create');
    Route::post('store', 'MedicalFoodController@store')->name('medicalFood.store');


    Route::get('edit/{id}', 'MedicalFoodController@edit');
    Route::post('update/{id}', 'MedicalFoodController@update')->name('medicalFood.update');

    Route::get('all', 'MedicalFoodController@getAll');
    Route::get('delete/{id}', 'MedicalFoodController@delete')->name('medicalFood.delete');

    Route::get('/food_grid','MedicalFoodController@getAllGrid');
    Route::get('/show_details/{id}', 'MedicalFoodController@showDetails');
    Route::get('/show_batch/{id}', 'MedicalFoodController@showBatches');
});

Route::group(['prefix' => 'cosmeticProduct', 'namespace' => 'Product'], function () {

    Route::get('create', 'CosmeticProductController@create');
    Route::post('store', 'CosmeticProductController@store')->name('cosmeticProduct.store');


    Route::get('edit/{id}', 'CosmeticProductController@edit');
    Route::post('update/{id}', 'CosmeticProductController@update')->name('cosmeticProduct.update');

    Route::get('all', 'CosmeticProductController@getAll');
    Route::get('delete/{id}', 'CosmeticProductController@delete')->name('cosmeticProduct.delete');

    Route::get('/cosmetic_grid','CosmeticProductController@getAllGrid');
    Route::get('/show_details/{id}', 'CosmeticProductController@showDetails');
    Route::get('/show_batch/{id}', 'CosmeticProductController@showBatches');
});

Route::group(['prefix' => 'medicine', 'namespace' => 'Product'], function () {

    Route::get('create', 'MedicineController@create');
    Route::post('store', 'MedicineController@store')->name('medicine.store');

    Route::get('edit/{id}', 'MedicineController@edit');
    Route::post('update/{id}', 'MedicineController@update')->name('medicine.update');

    Route::get('all', 'MedicineController@getAll');
    Route::get('delete/{id}', 'MedicineController@delete')->name('medicine.delete');

    Route::get('/medicine_grid','MedicineController@getAllGrid');
    Route::get('/show_details/{id}', 'MedicineController@showDetails');
    Route::get('/show_batch/{id}', 'MedicineController@showBatches');
});

Route::group(['prefix' => 'type', 'namespace' => 'Product'], function () {

    Route::get('create', 'TypeController@create');
    Route::post('store', 'TypeController@store')->name('type.store');


    Route::get('edit/{id}', 'TypeController@edit');
    Route::post('update/{id}', 'TypeController@update')->name('type.update');

    Route::get('all', 'TypeController@getAll');
    Route::get('delete/{id}', 'TypeController@delete')->name('type.delete');
});

Route::group(['prefix' => 'ageGroup', 'namespace' => 'Product'], function () {

    Route::get('create', 'AgeGroupController@create');
    Route::post('store', 'AgeGroupController@store')->name('ageGroup.store');


    Route::get('edit/{id}', 'AgeGroupController@edit');
    Route::post('update/{id}', 'AgeGroupController@update')->name('ageGroup.update');

    Route::get('all', 'AgeGroupController@getAll');
    Route::get('delete/{id}', 'AgeGroupController@delete')->name('ageGroup.delete');
});

Route::group(['prefix' => 'category', 'namespace' => 'Product'], function () {

    Route::get('create', 'CategoryController@create');
    Route::post('store', 'CategoryController@store')->name('category.store');


    Route::get('edit/{id}', 'CategoryController@edit');
    Route::post('update/{id}', 'CategoryController@update')->name('category.update');

    Route::get('all', 'CategoryController@getAll');
    Route::get('delete/{id}', 'CategoryController@delete')->name('category.delete');
});

Route::group(['prefix' => 'effectiveMaterial', 'namespace' => 'Product'], function () {

    Route::get('create', 'EffectiveMaterialController@create');
    Route::post('store', 'EffectiveMaterialController@store')->name('effectiveMaterial.store');

    Route::get('edit/{id}', 'EffectiveMaterialController@edit');
    Route::post('update/{id}', 'EffectiveMaterialController@update')->name('effectiveMaterial.update');

    Route::get('all', 'EffectiveMaterialController@getAll');
    Route::get('delete/{id}', 'EffectiveMaterialController@delete')->name('effectiveMaterial.delete');
});

Route::group(['prefix' => 'notification', 'namespace' => 'Notification'], function () {

    Route::get('/store', 'NotificationController@amount');
    Route::get('/store', 'NotificationController@expiredDate');
    Route::get('display/notification', 'NotificationController@getNotification');

    Route::get('show_notification/{id}', 'NotificationController@showExpiredNote');
});

Route::group(['prefix' => 'mail', 'namespace' => 'Mail'], function () {

    Route::get('write-mail', 'MailController@writeEmail');
    Route::get('send-mail', 'MailController@sendEmail')->name('mail.send');
});

Route::group(['prefix' => 'report', 'namespace' => 'Product'], function () {

    Route::get('medicineAmount', 'ReportController@medicineAmount');
    Route::get('medicalSupplyAmount', 'ReportController@medicalSupplyAmount');
    Route::get('medicalFoodAmount', 'ReportController@medicalFoodAmount');
    Route::get('cosmeticProductAmount', 'ReportController@cosmeticProductAmount');

    Route::get('medicineExpired', 'ReportController@medicineExpired');
    Route::get('medicalFoodExpired', 'ReportController@medicalFoodExpired');
    Route::get('cosmeticProductExpired', 'ReportController@cosmeticProductExpired');

    Route::get('medicineOutOfStock', 'ReportController@medicineOutOfStock');
    Route::get('medicalSupplyOutOfStock', 'ReportController@medicalSupplyOutOfStock');
    Route::get('medicalFoodOutOfStock', 'ReportController@medicalFoodOutOfStock');
    Route::get('cosmeticProductOutOfStock', 'ReportController@cosmeticProductOutOfStock');

    Route::get('aboutProduct', 'ReportController@aboutProduct');
});

Route::group(['prefix' => 'inventory', 'namespace' => 'Product'], function () {

    Route::get('all', 'TransformController@showAllInventory');
    Route::get('products/{inventory_id}', 'TransformController@showProduct');
    Route::post('transform', 'TransformController@transform')->name('transform.store');
   // Route::post('store', 'TransformController@store')->name('transform.store');
});








});


