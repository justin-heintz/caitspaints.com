<?php /*
	This is the loop, which fetches entries from your database. It is used in some
	form on most of the K2 pages. Because of that, to make editing all of them easier,
	it has been placed in its own file, which is then included where needed.
*/ ?>

<?php is_tag(); ?>
<?php /* Initialize The Loop */ if (have_posts()) { $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>

	<?php // Headlines for archives
	if (!is_single() && !is_home() or is_paged()) { ?>
	<div class="pagetitle">
		<h2>
			<?php
				if ( is_category() ) {
					printf( __( 'Archive for the &lsquo;%1$s&rsquo; Category', 'unsleepable' ),
						single_cat_title( '', false )
					);

				} elseif ( is_tag() ) {
					printf( __( 'Posts Tagged &lsquo;%1$s&rsquo;', 'unsleepable' ),
						single_tag_title( '', false )
					);

				} elseif ( is_day() ) {
					printf( __( 'Archive for %1$s' ),
						get_the_time('F jS, Y')
					);

				}  elseif ( is_month() ) {
					printf( __( 'Archive for %1$s' ),
						get_the_time('F, Y')
					);

				}   elseif ( is_year() ) {
					printf( __( 'Archive for %1$s' ),
						get_the_time('Y')
					);

				} elseif ( is_search() ) {
					printf( __( 'Search results for &lsquo;%1$s&rsquo;', 'unsleepable' ),
						get_search_query()
					);

				} elseif ( is_author() ) {
					$curauth = get_userdata( intval( $author ) );
					printf( __( 'Author Archive for &lsquo;%1$s&rsquo;', 'unsleepable' ),
						$curauth->first_name . ' ' . $curauth->last_name
					);
				}
			?>
		</h2>
	</div>

	<?php } ?>

	<?php /*
		The 'next page' and 'previous page' navigation for permalinks have to be inside the loop.
		The exact opposite is true for the same navigation links on all other pages.
		Also, we don't want them at the top of the frontpage: */

		if (!is_single() && !is_home() or is_paged()) include ( get_template_directory() . '/navigation.php' );

		/* Start The Loop */ while (have_posts()) { the_post();

		if (is_single()) include ( get_template_directory() . '/navigation.php');
	?>

		<?php
			/* Include the Post-Format-specific template for the content.
			 * If you want to overload this in a child theme then include a file
			 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
			 */
			get_template_part( 'content' );
		?>

<?php
	/* End The Loop */ }

	/* Insert Paged Navigation */ if (!is_single()) { include ( get_template_directory() . '/navigation.php'); } ?>

<?php /* If there is nothing to loop */  } else { $notfound = '1'; /* So we can tell the sidebar what to do */ ?>

			<div class="center">
				<h2><?php _e( 'Not Found', 'unsleepable' ); ?></h2>
			</div>

			<div class="item">
				<div class="itemtext2">
				<p><?php _e( 'Oh no! You&rsquo;re looking for something which just isn&rsquo;t here! Fear not however,
				errors are to be expected, and luckily there are tools on the sidebar for you to
				use in your search for what you need.', 'unsleepable' ); ?></p>
				</div>
			</div>

<?php /* End Loop Init */ } ?>
