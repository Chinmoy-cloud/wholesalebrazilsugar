<?php

defined('BASEPATH') OR exit('No direct script access allowed');
$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


$route['about'] = 'home/about';
$route['contact'] = 'home/contact';
$route['contact-save-data'] = 'home/contactSaveData';
$route['enquery-modal'] = 'home/enqueryModal';


$route['terms-and-condition'] = 'home/termsAndCondition';
$route['shipping-policy'] = 'home/shippingPolicy';
$route['return-policy'] = 'home/returnPolicy';
$route['privacy-policy'] = 'home/privacyPolicy';

$route['products'] = 'products';
$route['product-search-data'] = 'products/ajaxPaginationSearch';
$route['product-search-data/(:num)'] = 'products/ajaxPaginationSearch/$1';
$route['product/(:any)'] = 'products/details/$1';

// Admin



$route['admin'] = 'login';

$route['admin/login'] = 'login/login';

$route['admin/logout'] = 'login/logout';



$route['admin/sendotp'] = 'login/sendotp';

$route['admin/checkotp'] = 'login/checkotp';

$route['admin/change_pass'] = 'login/change_pass';



$route['admin/dashboard'] = 'admin/dashboard';



$route['admin/admins'] = 'admin/admins';

$route['admin/admin-search-data'] = 'admin/admins/ajaxPaginationSearch';

$route['admin/admin-search-data/(:num)'] = 'admin/admins/ajaxPaginationSearch/$1';

$route['admin/add-admin'] = 'admin/admins/manageAdmin';

$route['admin/edit-admin/(:num)'] = 'admin/admins/manageAdmin/$1';

$route['admin/admin-save-data'] = 'admin/admins/saveData';

$route['admin/change-status-admin'] = 'admin/admins/statusChange';

$route['admin/delete-admin'] = 'admin/admins/deleteData';



$route['admin/brands'] = 'admin/brands';

$route['admin/brand-search-data'] = 'admin/brands/ajaxPaginationSearch';

$route['admin/brand-search-data/(:num)'] = 'admin/brands/ajaxPaginationSearch/$1';

$route['admin/add-brand'] = 'admin/brands/manageBrand';

$route['admin/edit-brand/(:num)'] = 'admin/brands/manageBrand/$1';

$route['admin/brand-save-data'] = 'admin/brands/saveData';

$route['admin/change-status-brand'] = 'admin/brands/statusChange';

$route['admin/delete-brand'] = 'admin/brands/deleteData';



$route['admin/products'] = 'admin/products';

$route['admin/product-search-data'] = 'admin/products/ajaxPaginationSearch';

$route['admin/product-search-data/(:num)'] = 'admin/products/ajaxPaginationSearch/$1';

$route['admin/add-product'] = 'admin/products/manageProduct';

$route['admin/edit-product/(:any)'] = 'admin/products/manageProduct/$1';

$route['admin/product-save-data'] = 'admin/products/saveData';

$route['admin/change-status-product'] = 'admin/products/statusChange';

$route['admin/delete-product'] = 'admin/products/deleteData';

$route['admin/change-featured-product'] = 'admin/products/changeFeaturedProduct';



$route['admin/contacts'] = 'admin/contacts';

$route['admin/contact-search-data'] = 'admin/contacts/ajaxPaginationSearch';

$route['admin/contact-search-data/(:num)'] = 'admin/contacts/ajaxPaginationSearch/$1';

$route['admin/add-contact'] = 'admin/contacts/manageContact';

$route['admin/edit-contact/(:num)'] = 'admin/contacts/manageContact/$1';

$route['admin/contact-save-data'] = 'admin/contacts/saveData';

$route['admin/change-status-contact'] = 'admin/contacts/statusChange';

$route['admin/delete-contact'] = 'admin/contacts/deleteData';







$route['admin/subcategories'] = 'admin/subcategories';

$route['admin/subcategory-search-data'] = 'admin/subcategories/ajaxPaginationSearch';

$route['admin/subcategory-search-data/(:num)'] = 'admin/subcategories/ajaxPaginationSearch/$1';

$route['admin/add-subcategory'] = 'admin/subcategories/manageSubCategory';

$route['admin/edit-subcategory/(:any)'] = 'admin/subcategories/manageSubCategory/$1';

$route['admin/subcategory-save-data'] = 'admin/subcategories/saveData';

$route['admin/change-status-subcategory'] = 'admin/subcategories/statusChange';

$route['admin/delete-subcategory'] = 'admin/subcategories/deleteData';

$route['admin/subcategory-alias'] = 'admin/subcategories/AliasManage';



$route['admin/blogs'] = 'admin/blogs';

$route['admin/blog-search-data'] = 'admin/blogs/ajaxPaginationSearch';

$route['admin/blog-search-data/(:num)'] = 'admin/blogs/ajaxPaginationSearch/$1';

$route['admin/add-blog'] = 'admin/blogs/manageBlog';

$route['admin/edit-blog/(:any)'] = 'admin/blogs/manageBlog/$1';

$route['admin/blog-save-data'] = 'admin/blogs/saveData';

$route['admin/change-status-blog'] = 'admin/blogs/statusChange';

$route['admin/delete-blog'] = 'admin/blogs/deleteData';

$route['admin/save-blog-ordering'] = 'admin/blogs/saveOrdering';

$route['admin/change-featured-blog'] = 'admin/blogs/changeFeaturedBlog';



$route['admin/pages'] = 'admin/pages';

$route['admin/page-search-data'] = 'admin/pages/ajaxPaginationSearch';

$route['admin/page-search-data/(:num)'] = 'admin/pages/ajaxPaginationSearch/$1';

$route['admin/add-page'] = 'admin/pages/managePage';

$route['admin/edit-page/(:any)'] = 'admin/pages/managePage/$1';

$route['admin/page-save-data'] = 'admin/pages/saveData';

$route['admin/page-alias'] = 'admin/pages/AliasManage';

$route['admin/delete-page'] = 'admin/pages/deleteData';



$route['admin/seo/(:any)/(:num)'] = 'admin/seoes/SeoesManage';

$route['admin/seo-save-data'] = 'admin/seoes/saveData';



$route['admin/banners/(:any)/(:num)'] = 'admin/banners/BannersManage';

$route['admin/banner-save-data'] = 'admin/banners/saveData';



$route['admin/menu-settings'] = 'admin/menusettings';

$route['admin/menu-save-data'] = 'admin/menusettings/saveData';

$route['admin/get-menu-data'] = 'admin/menusettings/getData';



$route['admin/faqs'] = 'admin/faqs';

$route['admin/faq-search-data'] = 'admin/faqs/ajaxPaginationSearch';

$route['admin/faq-search-data/(:num)'] = 'admin/faqs/ajaxPaginationSearch/$1';

$route['admin/add-faq'] = 'admin/faqs/manageFaq';

$route['admin/edit-faq/(:any)'] = 'admin/faqs/manageFaq/$1';

$route['admin/faq-save-data'] = 'admin/faqs/saveData';

$route['admin/change-status-faq'] = 'admin/faqs/statusChange';

$route['admin/delete-faq'] = 'admin/faqs/deleteData';

$route['admin/save-faq-ordering'] = 'admin/faqs/saveOrdering';



$route['admin/gallery/blog/(:any)'] = 'admin/gallerys/manageGallery/$1';

$route['admin/gallery-save-data'] = 'admin/gallerys/SaveData';

$route['admin/gallery-get-data/(:any)/(:num)'] = 'admin/gallerys/GateData/$1';

$route['admin/gallery-remove-data/(:any)'] = 'admin/gallerys/RemoveData';



$route['admin/video-url/blog/(:any)'] = 'admin/videourls/manageVideoUrl/$1';

$route['admin/video-save-data'] = 'admin/videourls/saveData';

$route['admin/ajax-video-div-load'] = 'admin/videourls/ajaxLoadDiv';



$route['admin/emails'] = 'admin/emails';

$route['admin/edit-search-data'] = 'admin/emails/ajaxPaginationSearch';

$route['admin/edit-search-data/(:num)'] = 'admin/emails/ajaxPaginationSearch/$1';

$route['admin/edit-email/(:num)'] = 'admin/emails/manageEmail/$1';

$route['admin/email-save-data'] = 'admin/emails/saveData';

$route['admin/site-settings'] = 'admin/sitesettings/manageSettings';

$route['admin/site-settings-save-data'] = 'admin/sitesettings/saveData';



$route['admin/run-cron'] = 'admin/cron/remove_data';