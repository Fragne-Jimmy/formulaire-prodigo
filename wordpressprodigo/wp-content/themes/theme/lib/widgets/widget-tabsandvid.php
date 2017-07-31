<?php
/**
 * SP_tabbed_Sidebar class.
 * @since 1.0
 * @extends WP_Widget
 */
class SP_tabbed_Sidebar extends WP_Widget {

	public $display_thumbs;
	public $commentcount, $postcount;

	/**
	 * Constructor.
	 */
	public function __construct() {

		$widget_args = array(
			'classname'		=> 'sp_tabbed_sidebar',
			'description'	=> __( 'Tabbed posts, comments and tags.', 'studiopaul' ),
		);
		
		$this->WP_Widget('sp_tabbed_sidebar', '&raquo; Vuzz Tabbed', $widget_args);
		
		add_action( 'sp_tabbed_sidebar_tab-latest', array( &$this, 'latest_tab' ) );
		add_action( 'sp_tabbed_sidebar_tab-random', array( &$this, 'random_tab' ) );
		add_action( 'sp_tabbed_sidebar_tab-comments', array( &$this, 'comments_tab' ) );
		add_action( 'sp_tabbed_sidebar_tab-tags', array( &$this, 'tags_tab' ) );

		if ( is_active_widget( false, false, $this->id_base ) ) {
			add_action( 'wp_head', array( &$this, 'load_js' ) );
		}
		
	}
	
	/**
	 * load_js function.
	 */
	public function load_js() {	
		wp_enqueue_script( 'jquery-ui-tabs', null, array( 'jquery-ui-core', 'jquery' ), null, false );
		wp_enqueue_script( 'vuzztabbedwidget', null, false );
	}

	/**
	 * get_tabs function.
	 */
	public function get_tabs() {

		$_default_tabs = array(
			'latest'		=> __( 'Latest', 'studiopaul' ),
			'random'		=> __( 'Random', 'studiopaul' ),
			'comments'		=> __( 'Comments', 'studiopaul' ), 
			'tags'			=> __( 'Tags', 'studiopaul' ),
		);

		return apply_filters( 'sp_tabbed_sidebar_tabs', $_default_tabs );

	}

	/**
	 * widget function.
	 */
	public function widget( $args, $instance ) {

		global $wpdb;		
		extract( $args, EXTR_SKIP );

		$this->postcount = $instance[ 'postcount' ];
		$this->commentcount = $instance[ 'commentcount' ];
		$this->display_thumbs = $instance[ 'display_thumbs' ];

		if ( !$instance[ 'order' ] ) $instance[ 'order' ] = $this->get_tabs();

		if ( $instance[ 'display_home' ] && !is_home() )
			return false;
		?>
		<aside class="multi-sidebar-container">
			<div class="multi-sidebar clearfix">
			
				<ul class="tabs clearfix">
				<?php $this->render_sidebar_tabs( $instance[ 'order' ] ) ?>
				</ul>
				
				<?php
				foreach ( $instance['order'] as $tab ) {
					echo '<div id="s-' . $tab . '" class="widget clearfix">';
					do_action( 'sp_tabbed_sidebar_tab-' . $tab );
					echo '</div><!-- #s-' . $tab . ' -->';
				}
				?>
			</div>
		</aside>
		<?php

	}

	public function latest_tab() {

		studiopaul_widgets_post_loop( 'sidebar-latest', array (
			'show_thumbs'		=> $this->display_thumbs,
			'show_excerpt'		=> false,
			'query'				=> array (
				'posts_per_page'	=> $this->postcount
			)
		) );

	}

	public function random_tab() {

		studiopaul_widgets_post_loop( 'sidebar-random', array(
			'show_thumbs'		=> $this->display_thumbs,
			'show_excerpt'		=> false,
			'query'				=> array (
				'posts_per_page'	=> $this->postcount,
				'orderby'			=> 'rand',
			)
		) );

	}

	public function comments_tab() {

		$comments = get_comments( array( 'status' => 'approve', 'number' => $this->commentcount ) );	
		if ($comments) {
			echo '<ul class="sidebar-comments">';
			foreach ($comments as $comment) {
				$title = get_the_title($comment->comment_post_ID);
				echo '<li class="recentcomments clearfix">';
				if ( $this->display_thumbs ) echo get_avatar( $comment->user_id, 36 );
				echo '<span class="entry-author">' . $comment->comment_author . '</span><br />';
				echo '<a href="'. get_permalink($comment->comment_post_ID) . '#comment-' . $comment->comment_ID . '">' . get_the_title($comment->comment_post_ID) . '</a>';          
				echo '</li>';
			}
			echo '</ul>';
		}

	}

	public function tags_tab() {

		echo '<div class="tagcloud">';
		if ( function_exists( 'wp_cumulus_insert' ) ) {
			$args = array(
				'width'		=> 280,
				'height'	=> 280
			);
			wp_cumulus_insert( $args );
		} else {
			wp_tag_cloud();
		}
		echo '</div><div class="clear"></div>';

	}

	public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;
		$instance[ 'order' ] = $new_instance[ 'order' ];
		$instance[ 'display_home' ] = ( boolean )( $new_instance[ 'display_home' ] );
		$instance[ 'display_thumbs' ] = ( boolean )( $new_instance[ 'display_thumbs' ] );
		$instance[ 'postcount' ] = $new_instance[ 'postcount' ];
		$instance[ 'commentcount' ] = $new_instance[ 'commentcount' ];

		return $instance;

	}

	public function form( $instance ) {

		$instance = wp_parse_args( ( array )$instance, array ( 
			'order' => array ( 'latest', 'random', 'comments', 'tags' ), 
			'display_home' => false, 
			'display_thumbs' => true, 
			'postcount' => 8,
			'commentcount' => 8
		) );
		$order = $instance[ 'order' ];

		?>

		<p>
		<label for="<?php echo $this->get_field_id( 'order' ) ?>"><?php _e( 'Order:', 'studiopaul' ) ?></label><br />
		<select style="width: 200px" name="<?php echo $this->get_field_name( 'order' ) ?>[0]"><?php $this->get_tabbed_opts( $order[0], 'latest' ); ?></select><br />
		<select style="width: 200px" name="<?php echo $this->get_field_name( 'order' ) ?>[1]"><?php $this->get_tabbed_opts( $order[1], 'random' ); ?></select><br />
		<select style="width: 200px" name="<?php echo $this->get_field_name( 'order' ) ?>[2]"><?php $this->get_tabbed_opts( $order[2], 'comments' ); ?></select><br />
		<select style="width: 200px" name="<?php echo $this->get_field_name( 'order' ) ?>[3]"><?php $this->get_tabbed_opts( $order[3], 'tags' ); ?></select>
		</p>

		<p><label for="<?php echo $this->get_field_id( 'postcount' ) ?>"><?php _e( 'Post Count:', 'studiopaul' ) ?></label>
		<select id="<?php echo $this->get_field_id( 'postcount' ) ?>" name="<?php echo $this->get_field_name( 'postcount' ) ?>">
			<?php for ( $i = 1; $i <= 12; $i++ ) : ?>
			<option value="<?php echo $i ?>"<?php selected( $i, $instance[ 'postcount' ] ) ?>><?php echo $i ?>
			</option>
			<?php endfor; ?>
		</select><br />
		
		<label for="<?php echo $this->get_field_id( 'commentcount' ) ?>"><?php _e( 'Comments Count:', 'studiopaul' ) ?></label>
		<select id="<?php echo $this->get_field_id( 'commentcount' ) ?>" name="<?php echo $this->get_field_name( 'commentcount' ) ?>">
			<?php for ( $i = 1; $i <= 12; $i++ ) : ?>
			<option value="<?php echo $i ?>"<?php selected( $i, $instance[ 'commentcount' ] ) ?>><?php echo $i ?>
			</option>
			<?php endfor; ?>
		</select>
		</p>
		
		<p>	
		<input type="checkbox" name="<?php echo $this->get_field_name( 'display_thumbs' ) ?>" id="<?php echo $this->get_field_name( 'display_thumbs' ) ?>" <?php checked( $instance[ 'display_thumbs' ], 1 ) ?> />
		<label for="<?php echo $this->get_field_id( 'display_thumbs' ) ?>"><?php _e('Display thumbnails', 'studiopaul') ?></label>
		</p>
		<?php

	}

	public function get_tabbed_opts( $selected, $default ) {

		$opts = $this->get_tabs();

		if ( !$selected ) $selected = $default;

		foreach ( $opts as $id => $val ) {
			echo '<option value="' . $id . '" ';
			selected( $selected, $id );
			echo '>';

			echo $val;
			echo '</option>';
		}

	}

	public function render_sidebar_tabs( $order ) {

		$order = array_unique( $order );
		$list = $this->get_tabs();

		foreach ( $order as $t => $id ) : ?>
			<li><a href="#s-<?php echo $id ?>"><?php echo $list[ $id ] ?></a></li>
		<?php endforeach;

	}
}

/**
 * studiopaul_Video_Widget class.
 * @extends WP_Widget
 */
class studiopaul_Video_Widget extends WP_Widget {

	/**
	 * Constructor.
	 */
	public function __construct() {

		$widget_args = array (
			'classname'		=> 'studiopaul_video_widget',
			'description'	=> __( 'Widget that embeds a video from any supported video sites.', 'studiopaul' ),
		);
		$control_args = array ( 'width' => '', );
		
		$this->WP_Widget('studiopaul_video_widget', '&raquo; Vuzz Video', $widget_args, $control_args );
	}

	public function widget( $args, $instance ) {

		global $wp_embed;

		extract( $args, EXTR_SKIP );

		if ( $instance[ 'video' ] == '' ) return false;

		$title = apply_filters( 'widget_title', $instance[ 'title' ] );

		echo $before_widget;

		if ( $title != '' )
			echo $before_title . $title . $after_title;

		echo $wp_embed->run_shortcode( '[embed width="272"]' . $instance[ 'video' ] . '[/embed]' );

		echo $after_widget;

	}

	public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
		$instance[ 'video' ] = esc_url( $new_instance[ 'video' ] );

		return $instance;

	}

	public function form( $instance ) {

		$instance = wp_parse_args( ( array )$instance, array (
			'title' => __( 'Video', 'studiopaul' ), 
			'video'	=> '',
		) );

		?>
		<p><label for="<?php echo $this->get_field_id( 'title' ) ?>"><?php _e( 'Title:', 'studiopaul' ) ?></label><br />
		<input type="text" id="<?php echo $this->get_field_id( 'title' ) ?>" name="<?php echo $this->get_field_name( 'title' ) ?>" size="33" value="<?php echo strip_tags( $instance[ 'title' ] ) ?>" />
		</p>
		
		<p><label for="<?php echo $this->get_field_id( 'video' ) ?>"><?php _e( 'Video URL:', 'studiopaul' ) ?></label><br />
		<input type="text" id="<?php echo $this->get_field_id( 'video' ) ?>" name="<?php echo $this->get_field_name( 'video' ) ?>" size="43" value="<?php echo esc_url( $instance[ 'video' ] ) ?>" />
		</p>
		
		<p><a href="http://codex.wordpress.org/Embeds"><?php _e( 'Supported Video', 'studiopaul' ) ?></a></p>
		
		<?php

	}

}

function studiopaul_widgets_post_loop( $id, $args = array() ) {

	global $wp_query;

	$_defaults = array (
		'taxonomy'			=> 'category',
		'show_thumbs'		=> true,
		'show_excerpt'		=> true,
		'query'				=> array (
			'post_type'				=> 'post',
			'posts_per_page'		=> 5,
			'orderby'				=> 'date',
			'order'					=> 'DESC',
			'ignore_sticky_posts' 	=> 1,
		)
	);

	$args[ 'query' ] = wp_parse_args( $args[ 'query' ], $_defaults[ 'query' ] );
	$args = wp_parse_args( $args, $_defaults );

	$q = new WP_Query( $args[ 'query' ] );

	if ( $q->have_posts() ) {
		echo '<ul class="' . $id . '">';
		while( $q->have_posts() ) {

			$q->the_post();
			
			$wp_query->post = $q->post;

			setup_postdata( $q->post );

			?><li <?php post_class() ?>> 
			
			<?php if ( $args[ 'show_thumbs' ] ) : ?>
			
			<a class="entry-thumbnail" href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php global $post; echo get_the_post_thumbnail($post->ID, 'thumbnail'); ?></a>
			<?php endif ?>
			
			<a class="entry-title" rel="bookmark" href="<?php the_permalink() ?>"><?php the_title() ?></a><br />
			<small><?php studiopaul_posted_on(); ?></small>
			
			<?php if ( $args[ 'show_excerpt' ] ) : ?>
			<p class="entry-content">
			<?php echo get_the_excerpt() ?>
			</p>
			<?php endif ?>
			
			</li>
			<?php
		}
		echo '</ul>';
	} else {
		echo '<small>' . __('No posts at the moment.', 'studiopaul') . '</small>';
	}

	wp_reset_query();

}

// Register Widgets
function sp_widgets_init() {
	register_widget( 'sp_tabbed_Sidebar' );
	register_widget( 'studiopaul_Video_Widget' );
}
add_action('widgets_init', 'sp_widgets_init', 1);	
?>