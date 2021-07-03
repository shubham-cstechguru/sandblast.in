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
// Backend Routes
Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});
Route::get('rt-admin', 'admin\Dashboard@index');

Route::any('rt-admin/book', 'admin\Book@index');
Route::any('rt-admin/book/add/{nom?}', 'admin\Book@add');

Route::any('rt-admin/faq', 'admin\Faq@index');
Route::any('rt-admin/faq/add/{nom?}', 'admin\Faq@add');

Route::any('rt-admin/slider', 'admin\Slider@index');
Route::any('rt-admin/slider/add/{nom?}', 'admin\Slider@add');

// Route::any('rt-admin/collection', 'admin\Collection@index');
// Route::any('rt-admin/collection/add/{nom?}', 'admin\Collection@add');

Route::any('rt-admin/product', 'admin\Product@index');
Route::any('rt-admin/product/add/{nom?}', 'admin\Product@add');
Route::any('rt-admin/product-city', 'admin\ProductCity@index');
Route::any('rt-admin/product-country', 'admin\ProductCountry@index');
Route::any('rt-admin/city/{nom?}', 'admin\City@index');
Route::any('rt-admin/country/{nom?}', 'admin\Country@index');
Route::any('rt-admin/orders', 'admin\Orders@index');
Route::any('rt-admin/order/single/{nom?}', 'admin\Orders@view');
Route::any('rt-admin/order/single/{nom?}/change-staus', 'admin\Orders@changestatus');
// Route::any('rt-admin/order/shipment/shiprocket/{id?}', 'admin\Orders@shiprocket_shipment');

Route::any('rt-admin/partner', 'admin\Testimonials@index');
Route::any('rt-admin/partner/add/{nom?}', 'admin\Testimonials@add');

Route::any('rt-admin/page', 'admin\Pages@index');
Route::any('rt-admin/page/edit/{nom?}', 'admin\Pages@edit');

Route::any('rt-admin/blog-category/{nom?}', 'admin\Blog@index');
Route::any('rt-admin/blog-tags/{nom?}', 'admin\Blog@tags');
Route::any('rt-admin/post/add/{nom?}', 'admin\Blog@addpost');
Route::any('rt-admin/post/', 'admin\Blog@post');
Route::any('rt-admin/blog/edit/{nom?}', 'admin\Blog@edit');

Route::any('rt-admin/user/{nom?}', 'admin\Users@index');
Route::any('rt-admin/reviews/{nom?}', 'admin\Review@index');
// Route::any('rt-admin/user/{nom}', 'admin\User@index');

Route::any('rt-admin/topic/{nom?}', 'admin\Topic@index');

Route::any('rt-admin/question', 'admin\Question@index');
Route::any('rt-admin/question/add/{nom?}', 'admin\Question@add');

Route::any('rt-admin/paragraph', 'admin\Paragraph@index');
Route::any('rt-admin/paragraph/add/{nom?}', 'admin\Paragraph@add');

Route::any('rt-admin/blog', 'admin\Blog@index');
Route::any('rt-admin/blog/add/{nom?}', 'admin\Blog@add');

Route::any('rt-admin/color/{nom?}', 'admin\Color@index');

Route::any('rt-admin/category/{nom?}', 'admin\Category@index');
Route::any('rt-admin/collection/{nom?}', 'admin\Collection@index');

Route::any('rt-admin/coupon/{id?}', 'admin\CouponController@index');

Route::any('rt-admin/invoice/create/{id}', 'admin\InvoiceController@create');
Route::any('rt-admin/invoice/{id}', 'admin\InvoiceController@index');

Route::any('rt-admin/setting', 'admin\Setting@index');
Route::any('rt-admin/change-password', 'admin\User@change_password');
Route::any('rt-admin/logout', 'admin\User@logout');


Route::post('rt-admin/ajax/user_login', 'admin\Ajax@user_login');
Route::post('rt-admin/ajax/upload-image', 'admin\Ajax@upload_image');
Route::post('rt-admin/ajax/{action}', 'admin\Ajax@index');

// Frontend Routes
Route::view('order-mail', 'email.order_mail', ['subject' => 'Order Confirmation Mail', 'name' => 'Joe Due', 'order_no' => '#CHT03942', 'order_date' => '2019-10-23', 'text' => '<h3>Thank you for placing your order.</h3>
<p>Your order reference no. is #CHT03942.</p>
<p style="text-align: justify;">You\'ve successfully done your payment process. Your order is being processed and you will shortly recieve your order.</p>']);

Route::get('', 'HomeController@index');
// Route::any('contact', 'Contact@index');
// Route::any('wholesale', 'Wholesale@index');
// Route::get('blog', 'Blog@index');
// Route::get('blog/{slug}', 'Blog@single');
// Route::get('cart', 'Cart@index');
// Route::get('aboutus', 'Aboutus@index');
// Route::any('register', 'User@register');
// Route::any('user/verification', 'User@verify');
// Route::any('logout', 'User@logout');
// Route::any('user', 'User@index');
// Route::any('profile/{slug?}', 'User@index');
// Route::any('wishlist', 'User@wishlist');
// Route::any('change-password', 'User@change_password');
// Route::any('my-orders', 'User@my_orders');
// Route::any('order/{order_id}', 'User@order_info');
// Route::any('checkout', 'Checkout@index');
Route::any('product/{slug}/{clear?}', 'ProductController@single');
// Route::post('ajax/user_login', 'Ajax@user_login');
// Route::post('ajax/add-to-cart', 'Ajax@add_to_cart');
// Route::post('ajax/remove-to-cart', 'Ajax@remove_to_cart');
Route::post('ajax/update', 'Ajax@update');
// Route::post('ajax/wishlist', 'Ajax@wishlist');
Route::post('ajax/like', 'Ajax@like');
Route::post('ajax/{action}', 'Ajax@index');

Route::any('thank-you/{order_id}', 'ThanksController@index');
Route::any('callback', 'ThanksController@callback');

Route::get('captcha-code', 'CaptchaController@index');

Route::get('search', 'ProductController@index');
Route::get('page/{slug}', 'PageController@index');
Route::get('generate-sitemap', 'SitemapController@index');
Route::get('city/{city}', 'ProductController@index');
Route::get('country/{country}', 'ProductController@index');
Route::get('city/{city}/{slug}', 'ProductController@single');
Route::get('{mcategory}/{scategory?}', 'ProductController@index');

Route::any('rt-admin/location/countries/{slug?}', 'admin\Location@country');
Route::any('rt-admin/location/states/{slug?}', 'admin\Location@states');
Route::any('rt-admin/location/cities/{slug?}', 'admin\Location@cities');
