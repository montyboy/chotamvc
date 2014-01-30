<?php

/*
 * Routes configuration
 */
$routes = array(
  '/' => array('module'=> 'site', 'action'=>'index'),
  '/about' => array('module'=> 'site', 'action'=>'about'),
  '/contact' => array('module'=> 'site', 'action'=>'contact'),
  '/hello/:name' => array('module'=> 'site', 'action'=>'hello'),
  '/hello/:name/:event' => array('module'=> 'site', 'action'=>'hello'),
  '/hi/:name/:event' => array('module'=> 'site', 'action'=>'hello'),
  '/cmslogin' => array('module'=> 'admin', 'action'=>'login'),
);
