<div class="amp-wp-content amp-wp-article-tags amp-wp-article-category ampforwp-meta-taxonomy ">
<?php	global $redux_builder_amp;
			$ampforwp_tags=  get_the_terms( $this->ID, 'post_tag' );
			if ( $ampforwp_tags && ! is_wp_error( $ampforwp_tags ) ) :?>
		<?php do_action('ampforwp_before_meta_taxonomy_hook',$this); ?>
		<div class="amp-wp-meta amp-wp-content ampforwp-tax-tag">
				<?php foreach ($ampforwp_tags as $tag) {
          if($redux_builder_amp['ampforwp-archive-support']){
              echo ('<span class="amp-tag-'.$tag->term_id.'"><a href="'.trailingslashit( trailingslashit(get_tag_link($tag->term_taxonomy_id)).'amp') .'" >'. $tag->name  .'</a></span>');
        } else {
          echo '<span>'. $tag->name .'</span>';
        }
				} ?>
		</div>
<?php endif;?>
</div>
<?php

if( array_key_exists( 'amp-author-description' , $redux_builder_amp ) && is_single() ) {
	if( $redux_builder_amp['amp-author-description'] ) { ?>
	<div class="amp-wp-content amp_author_area ampforwp-meta-taxonomy">
	    <div class="amp_author_area_wrapper">
	        <?php $post_author = $this->get( 'post_author' );
	            if ( $post_author ) {

	                $author_avatar_url = get_avatar_url( $post_author->user_email, array( 'size' => 70 ) );
	                if ( $author_avatar_url ) { ?>
	                    <amp-img src="<?php echo $author_avatar_url; ?>" width="70" height="70" layout="fixed"></amp-img>
	                    <?php
	                } ?>
	                <strong><?php echo esc_html( $post_author->display_name ); ?></strong>: <?php echo  $post_author->description ; ?>

	        <?php } ?>
	    </div>
	</div> <?php
	}
}

do_action('ampforwp_before_meta_taxonomy_hook',$this);
