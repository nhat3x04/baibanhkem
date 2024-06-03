<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;

use App\Models\Car;
use App\Models\cart;
use App\Models\User;



    

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
//Route::get('/', function () {
    //return view('welcome');
//});
//Route::get('/helo', function () {
    //return "<h1>helo <h1>";
//});
//Route::get('/hello2', function () {
    //return view('hello2');
//});
//Route::get('giaipt', [Giaicontroller::class,'getPt1'])->name('getPt1');

//Route::post('giaipt', [Giaicontroller::class,'postPt1'])->name ('postPt1');
    
//Route::get('car/{id}',[CarController::class,'show'])->name('car-show');

//Route::resource('car',CarController::class);
//Route::post('/car/search', [CarController::class, 'postSearch'])->name('car.search');
Route::get('index', function () {
    return view('banhang.index-show');
});

Route::get('checkout', function () {
    return view('cart.checkout');
});
Route::get('shoppingcart', function () {
    return view('cart.shopping_cart');
});
Route::get('pricing', function () {
    return view('cart.pricing');
});
Route::get('signup', function () {
    return view('acc.signup');
});
Route::get('login', function () {
    return view('acc.login');
});

Route::get('index',[PageController::class,'index'])->name('banhang.index-show');

Route::get('/product/{id}', [PageController::class, 'getChiTietsp'])->name('banhang.product');

Route::get('/add-to-cart/{id}',[PageController::class,'addToCart'])->name('banhang.addtocart');

Route::get('xoagiohang/{id}', [PageController::class, 'removeFromCart'])->name('banhang.xoagiohang');

Route::get('dathang', [PageController::class, 'getCheckout'])->name('banhang.getdathang');

Route::get('checkout',[PageController::class,'getCheckout'])->name('banhang.getdathang');

Route::post('checkout',[PageController::class,'postCheckout'])->name('banhang.postdathang');

Route::get('/detail/{id}', [PageController::class, 'show'])->name('detail.show');

Route::post('them',[PageController::class,'store'])->name('products.store');

Route::get('them',[PageController::class,'create'])->name('products.them');

Route::get('/dangky',[PageController::class,'getSignin'])->name('getsignin');

Route::post('/dangky',[PageController::class,'postSignin'])->name('postsignin');

Route::get('/dangnhap',[PageController::class,'getLogin'])->name('getlogin');

Route::post('/dangnhap',[PageController::class,'postLogin'])->name('postlogin');

Route::get('/dangxuat',[PageController::class,'getLogout'])->name('getlogout');

Route::post('products/search',[PageController::class,'postSearch'])->name('postSearch');

// Route::get('adminlist', function () {
//     return view('admin.list');
// })
// ;Route::get('admincreate', function () {
//     return view('admin.create');
// });
// ;Route::get('adminedit', function () {
//     return view('admin.edit');
// });

Route::get('/admin/dangnhap',[UserController::class,'getLogin'])->name('admin.getLogin');

Route::post('/admin/dangnhap',[UserController::class,'postLogin'])->name('admin.postLogin');

Route::get('/admin/dangxuat',[UserController::class,'getLogout']);


Route::get('destroy/{id}',[AdminController::class,'destroy'])->name('products.destroy');

Route::get('edit/{id}',[AdminController::class,'edit'])->name('products.edit');

Route::post('edit/{id}',[AdminController::class,'update'])->name('products.update');

Route::post('products/search',[AdminController::class,'postSearch'])->name('postSearch');


Route::get('danhsach',[AdminController::class,'show'])->name('admin.list');




Route::get('/input-email',[PageController::class,'getInputEmail'])->name('getInputEmail');

Route::post('/input-email',[PageController::class,'postInputEmail'])->name('postInputEmail');

Route::get('contact', function () {
    return view('emails.contacts');
});
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');
// Route cho trang danh sách liên hệ quản trị viên
Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');

// Route cho trả lời liên hệ
Route::post('/contacts/reply/{id}', [ContactController::class, 'reply'])->name('contacts.reply');

Route::get('/contacts/reply/{id}', [ContactController::class, 'showReplyForm'])->name('contacts.showReplyForm');
