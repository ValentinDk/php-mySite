<?php

return [

    'product/([0-9]+)' => 'product/view/$1',

    'catalog' => 'catalog/index',

    'catalog/page-([0-9]+)' => 'catalog/index/$1',
    'category/([0-9]+)/page-([0-9]+)' => 'catalog/category/$1/$2',
    'category/([0-9]+)' => 'catalog/category/$1',

    'user' => 'user/index',
    'user/register' => 'user/register',
    'user/login' => 'user/login',
    'user/logout' => 'user/logout',
    'user/edit' => 'user/edit',
    'user/history' => 'user/history',

    'cart' => 'cart/index',
    'cart/addAjax/([0-9]+)' => 'cart/addAjax/$1',
    'cart/checkout' => 'cart/checkout',
    'cart/deleteAjax/([0-9]+)' => 'cart/deleteAjax/$1',

    'about' => 'site/about',
    'support' => 'site/support',

    'admin' => 'admin/index',
    'admin/page-([0-9]+)' => 'admin/index/$1',

    'adminProducts/hidden' => 'adminProducts/hidden',
    'adminProducts/edit/([0-9]+)' => 'adminProducts/edit/$1',
    'adminProducts/delete/([0-9]+)' => 'adminProducts/delete/$1',
    'adminProducts/create' => 'adminProducts/create',

    'adminCategory/([0-9]+)' => 'adminCategory/index/$1',
    'adminCategory/edit/([0-9]+)' => 'adminCategory/edit/$1',
    'adminCategory/create' => 'adminCategory/create',
    'adminCategory/delete/([0-9]+)' => 'adminCategory/delete/$1',

    'adminOrders' => 'adminOrders/index',
    'adminOrders/([0-9]+)' => 'adminOrders/view/$1',
    'adminOrders/delete/([0-9]+)' => 'adminOrders/delete/$1',

    'adminUsers' => 'adminUsers/index',
    'adminUsers/delete/([0-9]+)' => 'adminUsers/delete/$1',
    

    '' => 'site/index',
 ];