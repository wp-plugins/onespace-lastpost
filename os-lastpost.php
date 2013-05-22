<?php
/*
Plugin Name: OneSpace Last Post
Plugin URI: http://onespace.com.br/lastpost
Description: Shortcode to get latest post with criteria.
Version: 0.1
Author: Ian Garcez
Author URI: http://onespace.com.br
License: 

    Copyright 2013  Ian Garcez  (email : ian@onespace.com.br)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
include_once 'load.php';

$obj = new Os_lastpost;
$obj->register_shortcode();