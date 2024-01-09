<?php

Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    return 'DONE'; //Return anything
});


//Route::redirect('/', '/login');

Route::redirect('/home', '/admin');
Route::get('password/reset/{token}', 'Auth\PasswordController@getEmail')->name('password.request');
Route::post('/password/reset/email', 'Auth\PasswordController@postEmail');
 Auth::routes();
Route::get('/foo', function () {
    Artisan::call('storage:link');
});



Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');

    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    
    Route::post('delete/plot/building', 'PlotTypeController@deleteBuilding')->name('plot.delete.building');

    Route::post('delete/plot/extroom', 'PlotTypeController@deleteExtroom')->name('plot.delete.extroom');

    Route::resource('permissions', 'PermissionsController');

    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');

    Route::resource('roles', 'RolesController');

    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');

    Route::resource('users', 'UsersController');

    Route::delete('products/destroy', 'ProductsController@massDestroy')->name('products.massDestroy');

    Route::resource('products', 'ProductsController');

    Route::get('category-tree-view','CategoryController@manageCategory')->name('category-tree-view');
  
    Route::post('add-category','CategoryController@addCategory')->name('add.category');
    route::post('add-floor','FloorController@addcategory')->name('add.floor'); 
    route::post('add-room','RoomController@addcategory')->name('add.room');
    route::post('add-extroom','RoomController@addextcategory')->name('add.extroom');
    route::post('getFloorForAddRoom','RoomController@getFloorForAddRoom');
    Route::post('admin.add-plot','CategoryController@addPlot')->name('add.plot');
    Route::post('add-building','CategoryController@addBuildings')->name('add.building');
    Route::get('user-project','HomeController@index')->name('user.project');
    Route::post('admin.add-project','HomeController@store')->name('add.project');
    Route::post('update-project','HomeController@update')->name('update.project');
    Route::post('update-Projectupdate','HomeController@Projectupdate')->name('update.Projectupdate');

    Route::post('postFloorSort','CategoryController@postFloorSort');

    Route::post('delete-project','HomeController@destroy')->name('delete.project');
    
    Route::post('delete_pro','CsvFileController@destroy');
    
    Route::get('project-trees/{id}/{rid}','CategoryController@showProject');

    Route::post('add-sketch-project', 'ProjectController@store')->name('project.store');

    Route::post('update-building','CategoryController@updateBuildings')->name('update.building');
    Route::post('update-floor','FloorController@updateFloor')->name('update.floor');
    Route::post('delete-child','CategoryController@deleteChild')->name('delete.child');
    Route::post('delete-plots','CategoryController@deletePlot')->name('delete.plot');
    Route::post('update-plots','CategoryController@updatePlot')->name('update.plot');
    route::post('update-rooms','RoomController@updateRoom')->name('update.room');
    route::post('checkParent','RoomController@checkParent')->name('update.room');
    route::post('update-extrooms','RoomController@updateExtRoom')->name('update.extroom');

    Route::get('/getPlotTypes','CategoryController@getPlotTypes');
    Route::get('/getBuildingTypes','CategoryController@getBuildingTypes');
    Route::get('/getRoomTypes','CategoryController@getRoomTypes');
    Route::get('/getextroomTypes','CategoryController@getextRoomTypes');
    Route::post('/getRoomArea','CategoryController@getRoomArea');
    Route::post('/getBuildingTypesArea','CategoryController@getBuildingTypesArea');
    
    Route::post('getRoom','CategoryController@getRoom');
    Route::post('getextroom','CategoryController@getextRoom');
    Route::post('getExternalRoom','CategoryController@getExternalRoom');
    Route::post('getPlotBuilding','CategoryController@getPlotBuilding');
    Route::post('getPlotRoom','CategoryController@getPlotRoom');
    Route::post('getStackRooms','CategoryController@getStackRooms');
    Route::post('getEditPlotRoom','CategoryController@getEditPlotRoom');
    Route::post('getEditFloorRoom','CategoryController@getEditFloorRoom');
    
    // newwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww
    Route::get('/getplot','CategoryController@getplot');
    Route::get('/getbuilding','CategoryController@getbuilding');
    Route::get('/getfloor','CategoryController@getfloor');
    Route::get('/getParentfloor','CategoryController@getParentfloor');

    Route::get('/geteditbuilding','CategoryController@geteditbuilding');
    Route::get('/geteditfloor','CategoryController@geteditfloor');
    Route::get('/geteditroom','CategoryController@geteditroom');
    Route::get('/getRoomRecord','CategoryController@getRoomRecord');
    Route::get('/getCateId','CategoryController@getCateId');
    
    //EMD NEWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWWW

    Route::get('tree-child-view','CategoryController@manageChildCategory')->name('tree-child-view');
   
    Route::get('/room-type','RoomTypeController@index')->name('room.type');
    Route::get('/ext-room-type','RoomTypeController@extroomtype')->name('room.type');
    Route::get('/stack-room-type','RoomTypeController@stackroomtype')->name('room.type');
    Route::post('/delete-room','RoomTypeController@destroy')->name('delete.room');
    route::post('add-room_type','RoomTypeController@addEditRoomType')->name('add.room_type');


    Route::get('/blog','BlogController@index')->name('admin.blog');
    Route::post('add-blog','BlogController@addBlog')->name('add.blog');
    Route::post('/delete-blog','BlogController@destroy')->name('delete.blog');
    Route::get('/edit-blog/{id}','BlogController@edit')->name('edit.blog');
    Route::post('/update-blog','BlogController@update')->name('update.blog');

    Route::get('/subscriptions','BlogController@subscriptions')->name('admin.subscriptions');
    Route::post('/delete-subscriptions','BlogController@destroysubscriptions')->name('delete.subscriptions');
    Route::get('/models','HomeController@models')->name('admin.models');

    Route::get('/faqs','FaqController@index')->name('admin.faqs');
    route::post('add-faqs','FaqController@addFaq')->name('add.faqs');
    Route::post('/delete-faqs','FaqController@destroy')->name('delete.faqs');
    Route::get('/edit-faqs/{id}','FaqController@edit')->name('edit.faqs');
    Route::post('/update-faqs','FaqController@update')->name('update.faqs');    

    Route::get('user-plot-list','PlotTypeController@userPlotList')->name('user.plot.list');

    Route::get('/building-type','buildingTypeController@index');

    Route::post('/delete-building','buildingTypeController@destroy')->name('delete.building');

    Route::post('add-building_type','buildingTypeController@addEditBuildingType')->name('add.building_type');
    Route::get('plot-type','PlotTypeController@index')->name('plot.type');
    Route::post('add-plot_type','PlotTypeController@addPlotType')->name('add.plot_type');
    Route::post('/delete-plot','PlotTypeController@destroy')->name('delete.plot');
//Types...................................................................................
    Route::get('wall-type','WallTypeController@index')->name('wall.type');
    Route::post('/update-wall','WallTypeController@update')->name('update.wall');
    Route::post('add-wall_type','WallTypeController@addWallType')->name('add.wall_type');
    Route::post('/delete_wall','WallTypeController@delete')->name('delete.wall');

    Route::get('floor-type','FloorTypeController@index')->name('floor.type');
    Route::post('/update-floor','FloorTypeController@update')->name('update.floor');
    Route::post('add-floor_type','FloorTypeController@addFloorType')->name('add.floor_type');
    Route::post('/delete-floor','FloorTypeController@delete')->name('delete.floor');

    Route::get('door-type','DoorTypeController@index')->name('door.type');
    Route::post('/update-door','DoorTypeController@update')->name('update.door');
    Route::post('add-door_type','DoorTypeController@addDoorType')->name('add.door_type');
    Route::post('/delete-door','DoorTypeController@delete')->name('delete.door');

    Route::get('window-type','WindowTypeController@index')->name('window.type');
    Route::post('/update-window','WindowTypeController@update')->name('update.window');
    Route::post('add-window_type','WindowTypeController@addWindowType')->name('add.window_type');
    Route::post('/delete-window','WindowTypeController@delete')->name('delete.window');

    Route::get('ceiling-type','CeilingTypeController@index')->name('ceiling.type');
    Route::post('/update-ceiling','CeilingTypeController@update')->name('update.ceiling');
    Route::post('add-ceiling_type','CeilingTypeController@addCeilingType')->name('add.ceiling_type');
    Route::post('/delete-ceiling','CeilingTypeController@delete')->name('delete.ceiling');

    Route::get('railing-type','RailingTypeController@index')->name('railing.type');
    Route::post('/update-railing','RailingTypeController@update')->name('update.railing');
    Route::post('add-railing_type','RailingTypeController@addRailingType')->name('add.railing_type');
    Route::post('/delete-railing','RailingTypeController@delete')->name('delete.railing');

    Route::get('furniture-type','FurnitureTypeController@index')->name('furniture.type');
    Route::post('/update-furniture','FurnitureTypeController@update')->name('update.furniture');
    Route::post('add-furniture_type','FurnitureTypeController@addFurnitureType')->name('add.furniture_type');
    Route::post('/delete-furniture','FurnitureTypeController@delete')->name('delete.furniture');

    Route::get('lights-type','LightsTypeController@index')->name('lights.type');
    Route::post('/update-lights','LightsTypeController@update')->name('update.lights');
    Route::post('add-lights_type','LightsTypeController@addLightsType')->name('add.lights_type');
    Route::post('/delete-lights','LightsTypeController@delete')->name('delete.lights');
//.......................................................................................

    Route::get('/edit-plot/{id}','PlotTypeController@edit')->name('edit.plot');
    Route::get('/show-plot-type','PlotTypeController@showAddPlotType')->name('show.plot.type');
    Route::post('/add-plot-type','PlotTypeController@addEditPlotType')->name('add.plot.type');
    Route::post('/update-plot','PlotTypeController@addEditPlotType')->name('update.plot');


    Route::get('/edit-room/{id}','RoomTypeController@edit')->name('edit.room');
    Route::get('/view-edit-room/{type}','RoomTypeController@showEditRoom')->name('view.edit.room');
    Route::post('/update-room','RoomTypeController@addEditRoomType')->name('update.room');
    Route::post('/delete-object-of-room','RoomTypeController@delObjOfRoom')->name('del.obj.room');

    Route::get('/edit-building/{id}','buildingTypeController@edit')->name('edit.building');
    Route::get('/show-edit-building','buildingTypeController@showbuildingedit')->name('show.building');
    Route::post('/update-buildings','buildingTypeController@addEditBuildingType')->name('update.building');


    Route::get('/exportCsv', 'CsvFileController@exportCsv');
    Route::get('/exportCsv2', 'CsvFileController@exportCsv2');
    Route::get('/exportJson2', 'CsvFileController@exportJson2');

    Route::get('/generate-Json', 'CsvFileController@GenerateCMJSON');
    Route::get('/gen-detail-model', 'CsvFileController@genDetailModel'); 
    Route::get('/manual-gen', 'CategoryController@manualgen'); 
    Route::get('/download-file', 'CategoryController@downloadjsonfile'); 
    Route::get('/gen-dwg', 'CsvFileController@gen_dwg_d'); 
    Route::get('/gen-pdf', 'CsvFileController@gen_pdf_d');
    Route::get('/update-msg-bar', 'CategoryController@updatemsgbar'); 


    Route::get('/view-csv-file', 'CsvFileController@index');
    Route::get('/view-json-file', 'JsonFileController@index');
    Route::get('/delete-json-file', 'JsonFileController@destroy');
    Route::get('/3d-view-model', 'HomeController@threeDview');
    Route::get('3d-view-model/{id}','CategoryController@showProject3Dview');
    route::post('/duplicate-record','CategoryController@duplicate')->name('duplicate.record');
    Route::get('/projectSetting', 'CategoryController@projectSetting'); 
    //Pages
    Route::get('/pages', 'PageController@index');
    Route::get('/add-company', 'PageController@add_company');
    Route::post('/store-company','PageController@companyStore')->name('update.company');
    Route::get('/add-feature-content', 'PageController@add_feature_content');
    Route::post('/feature-update','PageController@featureContent')->name('update.feature');
    Route::get('/add-faq-content', 'PageController@add_faq_content');
    Route::post('/faq-update','PageController@faqContent')->name('update.faq');
    Route::get('/add-support-content', 'PageController@add_support_content');
    Route::post('/support-update','PageController@supportContent')->name('update.support');
    Route::get('/add-landing-content', 'PageController@add_landing_content');
    Route::post('/landing-update','PageController@landingContent')->name('update.landing');
    Route::post('/filename-update','CategoryController@fileNameUpdate')->name('filename.update');


    Route::post('/removeprojectfiles','CategoryController@removeprojectfiles');
    Route::post('/lockfile','CategoryController@lockfile');
    Route::post('/getProjectData','CategoryController@getProjectData');
    Route::get('/usersetting', 'UserSettingController@index');
    //Route::get('/useredit/{$id}', 'UserSettingController@edit');
    Route::get('/user-edit/{id}','UserSettingController@edit')->name('usersetting.edit');
    Route::post('/user-update','UserSettingController@update')->name('usersetting.update');
    Route::get('/getLastCategoryId','CategoryController@getLastCategoryId');
    Route::get('/getLastRoomId','CategoryController@getLastRoomId');
    Route::get('/getLastextroomId','CategoryController@getLastExtRoomId');
    Route::get('/site-settings', 'UserSettingController@sitesettings');
    Route::post('/add-site-settings', 'UserSettingController@addsitesettings')->name('add.sitesettings');


    Route::get('/3dviewer', 'HomeController@new3dviewer')->name('3dnewviewer');



    //Add Plot 

    Route::get('add-plot-window','PlotTypeController@addPlotWindow')->name('add.plot.window');
    Route::post('add-plot-window','PlotTypeController@addPlot')->name('add.plot.window');
    Route::post('update-plot-window','PlotTypeController@updateplotwindow')->name('update.plot.window');
    Route::get('edit-plot-window/{id}','PlotTypeController@editPlotWindow')->name('edit.plot.window');
    Route::get('remove-proximity/{cat_id}/{cat_id_prox}','PlotTypeController@removeProximity');

    //Add Room 
    Route::get('add-room-window','RoomTypeController@addRoomWindow')->name('add.room.window');
    Route::post('add-room-window','RoomTypeController@addRoom')->name('add.room.window');
    Route::get('edit-room-window/{id}','RoomTypeController@editRoomWindow')->name('edit.room.window');
    
    //Add Floor 
    Route::get('add-floor-window','FloorController@addFloorWindow')->name('add.floor.window');
    Route::get('edit-floor-window/{id}','FloorController@editFloorWindow')->name('edit.floor.window');
    Route::post('update-floor-window','FloorController@updateFloorWindow')->name('update.floor.window');

    Route::post('add-floor-window','FloorController@addFloor')->name('add.floor.window');
    
    //Route::post('edit-plot-window','PlotTypeController@editPlotWindow')->name('edit.plot.window');
});


Route::get('/clear-cache-all', function() {

    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    dd("Cache Clear All");

});
Route::get('/support', 'PagesController@support');
Route::get('/faq', 'PagesController@faq');
Route::get('/about', 'PagesController@about');
Route::get('/feature', 'PagesController@feature');
Route::get('/', 'PagesController@home');
Route::get('/latestblogs', 'PagesController@latestblog')->name('latestblog');
Route::get('/allblogs', 'PagesController@allblogs')->name('allblogs');

Route::get('Blog/{slug}', 'PagesController@blogDetail')->name('blogDetail');
Route::post('add-subscription', 'PagesController@addsubscription')->name('addsubsription');

Route::get('ckeditor/create', 'CkeditorController@create')->name('ckeditor.create');
Route::post('ckeditor', 'CkeditorController@store')->name('ckeditor.upload');



//Route::post('/addPlotWindow','PlotWindowController@addPlotWindow');

//Route::get('add-plot-window','PlotTypeController@addPlotWindow');
