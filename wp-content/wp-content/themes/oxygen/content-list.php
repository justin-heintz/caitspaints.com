<?php
/**
 * @package Oxygen
 * @since Oxygen 0.2.2
 */
?>
<?php global $odd_or_even; ?>
<article id="post-<?php the_ID(); ?>" <?php post_class( $odd_or_even ); ?>>

	<header class="entry-header">
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'oxygen' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
	</header><!-- .entry-header -->

	<footer class="entry-meta">
		<?php oxygen_posted_on(); ?>

		<span class="sep">&frasl;</span>

		<?php oxygen_posted_by(); ?>

		<span class="sep">&frasl;</span>

		<?php
			$categories_list = get_the_category_list( __( ', ', 'oxygen' ) );
			if ( $categories_list && oxygen_categorized_blog() ) :
		?>
		<span class="cat-links">
			<?php printf( __( 'In %1$s', 'oxygen' ), $categories_list ); ?>
		</span>
		<?php endif; // End if categories ?>

		<span class="sep">&frasl;</span>

		<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
			<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'oxygen' ), __( '1 Comment', 'oxygen' ), __( '% Comments', 'oxygen' ) ); ?></span>
		<?php endif; ?>

		<span class="sep">&frasl;</span>

		<?php edit_post_link( __( 'Edit', 'oxygen' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->

</article><!-- #post-<?php the_ID(); ?> -->