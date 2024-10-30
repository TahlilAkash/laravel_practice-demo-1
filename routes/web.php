<?php

use App\Models\Customer;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/categories',CategoryController::class);


// id pass through url  ---
// question mark used to make it optional parameter
Route::get('/post/{id?}/comment/{commentId?}', function (string $id =null,string $comment=null) {
    if($id){
        return "<h1> The post id is: $id </h1>" . "<h1> The comment id is $comment</h1>";

    }
    else{
        return "<h1> The id is not given </h1>";
    }
});
// data pass through blade
Route::get('/dataPass',function(){
    $name="Akash";
    return view('Datapass.dataPass',['dataPassKey'=>"$name"]);
});
// multiple data pass krte hole
Route::get('/dataPass/multiple',function(){
    $name="akash";
    $city="dhaka";
    return view('Datapass.datapass',['nameKey'=>"$name", 'cityKey'=>"$city"]);
});
//component
Route::get('/component',function(){
    return view('exampleview.demo');
});

//many to many relations
// customer table with  role table -----> relation in customer_role table
Route::resource('customer', CustomerController::class);
Route::resource('role', RoleController::class);

//has one through relations member table | company table | phone_numbers
Route::resource('member',MemberController::class);
// comment addded to check the ssh key


// Authentication
Route::resource('registration',UserController::class);
Route::get('login', [UserController::class, 'login'])->name('user.login');
Route::post('login', [UserController::class, 'loginPost'])->name('login.submit');
Route::get('logout', [UserController::class, 'logOut'])->name('logout.user');
