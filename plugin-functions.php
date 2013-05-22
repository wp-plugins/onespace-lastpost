<?php
/* OneSpace Last Post
 * Version: 0.1
 * Author: Ian Garcez
 * Author URI: http://onespace.com.br
 * License: 
 * 
 * Copyright 2013  Ian Garcez  (email : ian@onespace.com.br)
 * 
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2, as 
 * published by the Free Software Foundation.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

//init
add_action( 'wp_enqueue_scripts', 'os_lastpost_style' );
function os_lastpost_style() {
    wp_register_style( 'os-lastpost-style', plugins_url('style.css', __FILE__) );
    wp_enqueue_style( 'os-lastpost-style' );
}