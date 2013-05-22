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
class Os_lastpost_printer{
	public $html = '';

	private $querys_for_print = array();

	private $args = array(
		'id' => array(),
		'post_type' => 'post',
		'num' => 3,
		);

	private $info_to_print = array('title');

	// o construtor vai montar o html
	public function __construct($atts) {
		$this->makeArgs($atts);
		$this->makeQuerys($this->args);
		$this->makeHtml();
	}

	private function makeArgs($atts){
		if( $atts['id'] ){
			$list_ids = explode(',', $atts['id']);
			$this->args['id'] = $list_ids;
		}

		if( $atts['post_type'] != 'post'){
			$this->args['post_type'] = $atts['post_type'];
		}

		if( $atts['info'] ){
			$this->info_to_print = explode(',', $atts['info']);
		}

		if( $atts['num'] ){
			$this->args['num'] = $atts['num'];
		}
	}

	private function makeQuerys($a){
		if (!$a['id'] && $a['post_type'] == 'post'){
			$this->makeQueryForPostType($a);
		} else if($a['post_type'] != 'post') {
			$this->makeQueryForPostType($a);
		} else {
			$this->makeQueryForCats($a);
		}

	}

	private function makeQueryForPostType($a){
		$query_args = array(
			'post_type' => $a['post_type'],
			'posts_per_page' => $a['num'],
			);

		$this->querys_for_print[] = new WP_Query($query_args);

	}

	private function makeQueryForCats($a){
		foreach ($a['id'] as $cat) {
			$query_args = array(
				'category__in' => $cat,
				'post_type' => 'post',
				'posts_per_page' => $a['num'],
				);
			$this->querys_for_print[] = new WP_Query($query_args);
		}

		
	}

	private function makeHtml(){
		$this->html = '<div class="os-lastpost">';

		foreach ($this->querys_for_print as $q) {
			$this->html .= '<ul>';
			if ($q->have_posts()): while($q->have_posts()):	$q->the_post();
					$this->html .= '<li>';
					$this->makeHtmlWithInfo($q->post);
					$this->html .= '</li>';
				endwhile;
			endif;
			$this->html .= '</ul>';
		}
		$this->html .= '</div>';

	}

	private function makeHtmlWithInfo($p) {
		foreach ($this->info_to_print as $i) {
			if(strpos($i, 'title') !== false){
				$this->html .= '<h2 class="title"><a href="' . get_permalink($p->ID) . '">';
				$this->html .= get_the_title($p->ID).'</a></h2>';
			}

			if(strpos($i, 'date') !== false){
				$format = $this->getDateFormat($i);
				$this->html .= '<p class="date">'. get_the_time($format) . '</p>';
			}

			if(strpos($i, 'excerpt') !== false){
				$this->html .= $this->getTrimContentFromInfo($i, $p);
			}

			if(strpos($i, 'content') !== false){
				$this->html .= $this->getFullContentForInfo($i, $p);
			}

			if(strpos($i, 'thumb') !== false){
				$this->html .= $this->getThumbsForInfo($i, $p);
			}
		}
	}

	private function getDateFormat($string) {
		$string = explode(':', $string);
		if (count($string) > 1){
			return $string[1];
		} else {
			return 'm/d/y';
		}
	}

	private function getTrimContentFromInfo($string, $p) {
		$options = explode(':', $string);
		if (count($options) > 1){
			$max_char = intval($options[1]);
			$text = ($options[2]);

			return $this->trimContent($p, $max_char, $text);
		} else {
			return $this->trimContent($p);
		}

	}

	private function trimContent($p, $max_char = 60, $text = ' ...Read more') {
		$content = $p->post_content;
		if (strlen($content) > $max_char - strlen($text)){
			$content = substr($content, 0, $max_char) . $text;
		}

		$content = strip_tags($content);
		
		return '<p><a href="' . get_permalink($p->ID) . '">' . $content . '</a></p>';
	}

	private function getFullContentForInfo($string, $p){
		$content = $p->post_content;
		$content = apply_filters('the_content', $content);
		return $content;
	}

	private function getThumbsForInfo($string, $p){
		$string = explode(':', $string);
		$size = intval($string[1]);
		$size = array($size, $size);
		if ($size > 10){
			return '<a href="' . get_permalink($p->ID) . '">' .get_the_post_thumbnail( $p->ID, $size ) . '</a>';
		} else {
			return $this->printError("Tamanho da imagem inválido");
		}
	}

	private function printError($string){
		return '<div class="os_lastpost_error">' . $string . '</div>';
	}

	public function getHtml(){
		return $this->html;
	}
}