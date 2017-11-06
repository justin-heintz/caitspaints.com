<div class="entry<?php if (is_page()) { echo " static"; } ?>">
	<div class="post-meta">
		<h1 class="post-title" id="post-<?php the_ID(); ?>"><?php the_title(); ?></h1>
<?php	if ( !is_page() ) : ?>
		<p class="post-metadata"><?php
			the_time(get_option('date_format'));
			if ( ! get_option( 'tarski_hide_categories' ) ) :
			?> in <?php
				the_category( ', ' );
				the_tags( __( ' | Tags: ', 'tarski' ), ', ', '' );
			endif;

			/* If there is more than one author, show author's name */
			if ( $count_users > 1 ) :
			?> | by <?php
				the_author_posts_link();
			endif;
			edit_post_link( __( 'Edit', 'tarski' ),' (',')' ); ?>
		</p>
<?php 	endif; ?>
	</div>
	<div class="post-content">
		<?php the_content( __( 'Read the rest of this entry &raquo;', 'tarski' ) ); ?>
	</div>
	<?php wp_link_pages(array('before' => '<p><strong>' . __( 'Pages:', 'tarski' ) . '</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
	<?php if ( is_page() ) { edit_post_link( __( 'edit page', 'tarski' ), '<p class="post-metadata">(', ')</p>'); } ?>
</div>
