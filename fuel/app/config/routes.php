<?php
return array(
//	'_root_'  => 'welcome/index',  // The default route
	'_root_'  => 'board/latest',  // The default route
	'_404_'   => 'welcome/404',    // The main 404 route

	'image/(:num)/image' => 'image/image/$1',
	'image/(:num)/thumbnail' => 'image/thumbnail/$1',
	'top/latest' => 'board/latest',
	
	'hello(/:name)?' => array('welcome/hello', 'name' => 'hello'),
);
