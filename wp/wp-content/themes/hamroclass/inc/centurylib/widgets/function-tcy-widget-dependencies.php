<?php
/**
 * Widget Title
 *
 * @since 1.0.0
 */

if( ! function_exists( 'centurylib_widget_title_callback' ) ) :

	function centurylib_widget_title_callback( $title_args ){

		extract($title_args);
		$title = (isset($title_args['title'])) ? $title_args['title'] : '';
		$title_target = (isset($title_args['title_target'])) ? $title_args['title_target'] : '';
		$title_link = (isset($title_args['title_link'])) ? $title_args['title_link'] : '';
		$before_title = (isset($title_args['before_title'])) ? $title_args['before_title'] : '';
		$after_title = (isset($title_args['after_title'])) ? $title_args['after_title'] : '';
		$slider_nav = (isset($title_args['slider_nav'])) ? $title_args['slider_nav'] : '';
		$title_terms = (isset($title_args['title_terms'])) ? $title_args['title_terms'] : '';
		$default_tablabel = (isset($title_args['default_tablabel'])) ? $title_args['default_tablabel'] : esc_html__('Default', 'hamroclass');
		$tab_taxonomy = (isset($title_args['tab_taxonomy'])) ? $title_args['tab_taxonomy'] : 'category';
		$tab_ajax_data = (isset($title_args['tab_ajax_data'])) ? $title_args['tab_ajax_data'] : array();

		if ( ! empty( $title ) ){
			echo $before_title; 
			if($title_target && $title_link){
				?><a href="<?php echo esc_url($title_link); ?>" target="<?php echo esc_attr($title_target); ?>"><?php 
			}
			echo esc_html( $title );
			if($title_target){
				?></a><?php 
			}
			$title_other_html = '';
			if($title_terms && $tab_taxonomy){
				$title_other_html .= '<ul class="wdgt-title-tabs">';
				if($default_tablabel){
					$title_other_html .= '<li class="wdgt-tab-term active-item">';
					$title_other_html .= '<a data-tab="centurylib-tab-alldata" class="dgwidgt-title-tab" href="#">';
					$title_other_html .= $default_tablabel;
					$title_other_html .= '</a>';
					$title_other_html .= '</li>';
				}
				foreach($title_terms as $tab_term_id){
					if(!term_exists($tab_term_id, $tab_taxonomy)){
						continue;
					}
					$tab_ajax_data['data']['terms_ids'] = $tab_term_id;
					$tab_term_detail = get_term_by( 'id', absint( $tab_term_id ), $tab_taxonomy );
					$title_other_html .= '<li class="wdgt-tab-term">';
					$title_other_html .= '<a data-tab="centurylib-tab-term-'.absint($tab_term_id).'" class="dgwidgt-title-tab" data-ajax-args=\'' . json_encode($tab_ajax_data) . '\' href="'.get_term_link($tab_term_id, $tab_taxonomy).'">';
					$title_other_html .= $tab_term_detail->name;
					$title_other_html .= '</a>';
					$title_other_html .= '</li>';
				}
				$title_other_html .= '</ul>';
			}

			if($slider_nav){
				$title_other_html .= '<div class="carousel-nav-action">';
				$title_other_html .= '<span class="centurylib-nav-prev centurylib-carousel-control">';
				$title_other_html .= '<i class="fa fa-angle-left"></i>';
				$title_other_html .= '</span>';
				$title_other_html .= '<span class="centurylib-nav-next centurylib-carousel-control">';
				$title_other_html .= '<i class="fa fa-angle-right"></i>';
				$title_other_html .= '</span>';
				$title_other_html .= '</div>';
			}

			if($title_other_html){
				$replace_tag = '</h2>';
				if(stripos( $after_title, $replace_tag ) !== false ){
					$after_title = str_replace( $replace_tag, $title_other_html.$replace_tag, $after_title );
				}else{
					$replace_tag = '</h4>';
					$after_title = str_replace( $replace_tag, $title_other_html.$replace_tag, $after_title );
				}
			}
			echo $after_title;
		}
	}

endif;

add_action( 'centurylib_widget_title', 'centurylib_widget_title_callback' );

if(!function_exists('centurylib_before_widget')):

	function centurylib_before_widget($args){

		$before_widget = (isset($args['before_widget'])) ? $args['before_widget'] : '';
		echo $before_widget;

	}

endif;

if(!function_exists('centurylib_after_widget')):

	function centurylib_after_widget($args){

		$after_widget = (isset($args['after_widget'])) ? $args['after_widget'] : '';
		echo $after_widget;

	}

endif;