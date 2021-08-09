<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use RealRashid\SweetAlert\Facades\Alert;
//use App\Http\Controllers\UsersController;
use Auth;

//Users - Admin

Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('can:manage-users')->group(function(){
    Route::resource('/users', 'UsersController',['except'=>['show','create','store','profile']]);
});
 
//Users

Route::group(['middleware'=>'auth', 'prefix'=> 'users'], function(){
    Route::get('/profile', 'UserController@profile')->name('users.profile');
});


// Areas

Route::group(['middleware'=>'auth', 'prefix'=> 'areas'], function(){

    Route::get('/show/{area}', 'AreaController@show')->name('areas.show');
    
    Route::get('/create', 'AreaController@create')->name('areas.create');
    
    Route::get('/list', 'AreaController@index')->name('areas.index');

    Route::delete('/delete/{id}', 'AreaController@destroy')->name('areas.destroy');

    Route::post('/store', 'AreaController@store')->name('areas.store');
});

// Offers

Route::group(['middleware'=>'auth', 'prefix'=> 'offers'], function(){

    Route::get('/verify', 'OfferController@verify')->name('offers.verify');
    
    Route::post('/new/{area}', 'OfferController@addblog')->name('offers.addblog');

    Route::get('/show/{offer}', 'OfferController@show')->name('offers.show');
    
    Route::get('/edit/{offer}', 'OfferController@edit')->name('offers.edit');

    Route::post('/update/{offer}', 'OfferController@update')->name('offers.update');

    Route::get('/list', 'OfferController@index')->name('offers.index');

    Route::get('/{area}', 'OfferController@create')->name('offers.create');

    Route::post('/{area}', 'OfferController@store')->name('offers.store');

    Route::get('/buy/{offer}', 'OfferController@buy')->name('offers.buy');

    Route::post('/confirm/{offer}', 'OfferController@confirm')->name('offers.confirm');
    
    Route::delete('/{id}', 'OfferController@destroy')->name('offers.destroy');
    
  
});

//Comments

Route::group(['middleware'=>'auth', 'prefix'=> 'comments'], function(){
    
    Route::post('/new/{offer}', 'CommentController@addpost')->name('comments.addpost');

    Route::get('/show/{comment}', 'CommentController@show')->name('comments.show');
    
    Route::get('/edit/{comment}', 'CommentController@edit')->name('comments.edit');

    Route::post('/update/{comment}', 'CommentController@update')->name('comments.update');

    Route::get('/list', 'CommentController@index')->name('comments.index');

    Route::get('/{offer}', 'CommentController@create')->name('comments.create');

    Route::post('/{offer}', 'CommentController@store')->name('comments.store');
    
    Route::delete('/{id}', 'CommentController@destroy')->name('comments.destroy');
});


//Documents

Route::group(['middleware'=>'auth', 'prefix'=> 'documents'], function(){
    
    Route::get('/new/{document}', 'DocumentController@create')->name('documents.create');
    
    Route::post('/store/{offer}', 'DocumentController@store')->name('documents.store');

    Route::get('/show/{offer}', 'DocumentController@show')->name('documents.show');
    
    Route::post('/edit/{offer}', 'DocumentController@edit')->name('documents.edit');

   // Route::get('/show/{comment}', 'CommentController@show')->name('comments.show');
    
});

//blockchain
Route::group(['middleware'=>'auth', 'prefix'=> 'blockchains'], function(){
    
    Route::post('/create/{offer}', 'BlockchainController@create')->name('blockchains.create');

   // Route::post('/store/{offer}', 'BlockchainController@store')->name('blockchains.store');

   // Route::post('/confirm/{offer}', 'BlockchainController@confirm')->name('blockchains.confirm');

    //Route::get('/show', 'BlockchainController@show')->name('blockchains.show');
    
});

Route::get('/send-mail', function(){
  //  $details =[
//'title'=>'Mail from Surfside Media',
//'body'=>'This is from RSBlockchain email'
   // ];
   // \Mail::to('shalan.blockchain@gmail.com')->send(new \App\Mail\RSBlockchain($details));
   // echo "Enail has been sent";
});

Auth::routes();

Route::get('/','HomeController@index')->name('home');

Route::get('/home','HomeController@index')->name('home');

Route::get('/analysis', 'HomeController@analysis')->name('personal.analysis');

