<?php get_header(); ?>

<div class="content">

	<div id="primary" class="primary">

		<?php include ( get_template_directory() . '/theloop.php'); ?>

	</div>

	<?php get_sidebar(); ?>

<?php if (!is_paged() && is_home()) { ?>
	<?php include("bottomblock.php"); ?>
	<?php } ?>

</div>
<?php get_footer(); ?>