<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['profile_id']	= 'ga:85277414'; // GA profile id
$config['email']		= ' '; // GA Account mail
$config['password']		= ' '; // GA Account password

$config['cache_data']	= true; // request will be cached
$config['cache_folder']	= FCPATH.'/files/ga_files/'; // read/write
$config['clear_cache']	= array('date', '1 day ago'); // keep files 1 day
	
$config['debug']		= false; // print request url if true
