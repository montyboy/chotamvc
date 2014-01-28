<?php

/** Configuration Variables **/
define ('DEVELOPMENT_ENVIRONMENT',TRUE);

/** Database config */
define('DB', false);
define('DB_NAME', 'CHANGE DB NAME HERE');
define('DB_USER', 'CHANGE USER NAME HERE');
define('DB_PASSWORD', '');
define('DB_HOST', '127.0.0.1');

/** CSRF token key **/
define('CSRF_HASH', 'asjdfhiauf7938ry3hfjdkjfy3ryhf');



/** Define default routes */
define('HOME_PAGE', '/');
define('ERROR_404', '/site/error404');
define('USER_MODULE', true);

define('DEFAULT_TEMPLATE', "default");


$routes = array(
    
    '/' => array('module'=> 'site', 'action'=>'home'),
    '/about' => array('module'=> 'site', 'action'=>'about'),
    '/contact' => array('module'=> 'site', 'action'=>'contact'),
    '/hello/:name' => array('module'=> 'site', 'action'=>'hello'),
    '/hello/:name/:event' => array('module'=> 'site', 'action'=>'hello'),
    '/hi/:name/:event' => array('module'=> 'site', 'action'=>'hello'),
    '/admin' => array('module'=> 'admin', 'action'=>'index'),
    
);
