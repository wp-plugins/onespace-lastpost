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

class Os_lastpost_register {
	public function register(){
		add_shortcode('os_lastpost', array( __CLASS__, 'os_lastpost_main' ));
	}

	public static function os_lastpost_main( $atts ){
		//retorna erro se id ou post_type não estiverem definidos
		if(!isset($atts['id']) && !isset($atts['post_type']))
			return '<span class="os_lastpost_error">nada a buscar</span>';

		// não busquermos id caso tenhamos um post_type definido
		if (isset($atts['post_type']) && $atts['post_type']!='post'){
			unset($atts['id']);
		}

		if(!isset($atts['post_type'])){
			$atts['post_type'] = 'post';
		}

		$printer = new Os_lastpost_printer($atts);

		return $printer->getHtml();

	}
}