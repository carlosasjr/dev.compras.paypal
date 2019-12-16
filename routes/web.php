<?php
route::get('adicionar-carrinho/{id}', 'CartController@add')->name('add.cart');
route::get('decrementar-carrinho/{id}', 'CartController@decrement')->name('decrement.cart');
route::get('carrinho', 'CartController@index')->name('cart');
route::get('logout', 'UserController@logout')->name('user.logout');


route::group(['middleware' => 'auth'], function (){
    route::get('meu-perfil', 'UserController@profile')->name('user.profile');
    route::post('atualizar-perfil', 'UserController@profileUpdate')->name('update.profile');

    route::get('minha=senha', 'UserController@password')->name('user.password');
    route::post('atualizar-senha', 'UserController@passwordUpdate')->name('update.password');


    route::get('paypal', 'PayPalController@paypal')->name('paypal');
    route::get('return-paypal', 'PayPalController@returnPayPal')->name('return.paypal');

    route::get('meus-pedidos', 'StoreController@orders')->name('orders');
    route::get('detalhes-pedido/{id}', 'StoreController@orderDetail')->name('order.products');
});

Auth::routes();

route::get('/', 'StoreController@index')->name('home');


