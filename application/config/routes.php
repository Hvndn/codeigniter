<?php

$route['default_controller'] = 'IndexController';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['trang-chu'] = 'IndexController';


//home
$route['danh-muc/(:any)']['GET'] = 'IndexController/category/$1';

$route['thuong-hieu/(:any)']['GET'] = 'IndexController/brand/$1';
$route['gio-hang']['GET'] = 'IndexController/cart';
$route['add-to-cart']['POST'] = 'IndexController/add_to_cart';
$route['delete-all-cart']['GET'] = 'IndexController/delete_all_cart';
$route['update-cart-item']['POST'] = 'IndexController/update_cart_item';
$route['delete-item/(:any)']['GET'] = 'IndexController/delete_item/$1';
$route['dang-nhap']['GET'] = 'IndexController/login';
$route['checkout']['GET'] = 'IndexController/checkout';
$route['confirm-checkout']['POST'] = 'IndexController/confirm_checkout';
$route['thankyou']['GET'] = 'IndexController/thankyou';

$route['dang-xuat']['GET'] = 'IndexController/dang_xuat';
$route['don-hang'] = 'OrderController/index';

// Route tìm kiếm
$route['tim-kiem'] = 'IndexController/search';


//chat
$route['api/chat'] = 'chat/api_chat';
$route['admin/chat-history'] = 'ChatHistoryController/index';
$route['admin/chat-history/(:num)'] = 'ChatHistoryController/view/$1';




//login
$route['login']['GET'] = 'LoginController/index';
$route['register']['GET'] = 'IndexController/register';
$route['login-user']['POST'] = 'LoginController/login';
$route['login-customer']['POST'] = 'IndexController/login_customer';
$route['dang-ky']['POST'] = 'IndexController/dang_ky';


// dashboard
$route['dashboard']['GET'] = 'DashboardController/index';
$route['logout']['GET'] = 'DashboardController/logout';
//brand
$route['brand/create']['GET'] = 'BrandController/create';
$route['brand/list']['GET'] = 'BrandController/index';
$route['brand/edit/(:any)']['GET'] = 'BrandController/edit/$1';
$route['brand/update/(:any)']['POST'] = 'BrandController/update/$1';
$route['brand/delete/(:any)']['GET'] = 'BrandController/delete/$1';
$route['brand/store']['POST'] = 'BrandController/store';
// Category
$route['category/create']['GET'] = 'CategoryController/create';
$route['category/list']['GET'] = 'CategoryController/index';
$route['category/edit/(:any)']['GET'] = 'CategoryController/edit/$1';
$route['category/update/(:any)']['POST'] = 'CategoryController/update/$1';
$route['category/delete/(:any)']['GET'] = 'CategoryController/delete/$1';
$route['category/store']['POST'] = 'CategoryController/store';
//Product
$route['product/create']['GET'] = 'ProductController/create';
$route['product/list']['GET'] = 'ProductController/index';
$route['product/edit/(:any)']['GET'] = 'ProductController/edit/$1';
$route['product/update/(:any)']['POST'] = 'ProductController/update/$1';
$route['product/delete/(:any)']['GET'] = 'ProductController/delete/$1';
$route['product/store']['POST'] = 'ProductController/store';
// $route['admin/customers'] = 'CustomerController/index';
$route['admin/customers'] = 'CustomerController/index';

$route['admin/orders'] = 'OrderController/admin_index';
$route['admin/orders/(:num)'] = 'OrderController/admin_view/$1';
// Route chi tiết sản phẩm
$route['product/(:any)']['GET'] = 'IndexController/product/$1'; // chỉ slug sản phẩm