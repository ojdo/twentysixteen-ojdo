<?php
/**
 * The template for displaying category pages
 *
 * Creation Copied archive.php and added lines 23 to 39 as explained on
 * "How to add subcategories to templates in WordPress": 
 * http://www.ojdo.de/wp/?p=2934
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
				<?php
				    $parents = get_category_parents($cat, true, " +++ ");
				    $parents = explode(" +++ ", $parents);
				    $parents = array_slice($parents, 0, -2);
				?>
				<?php if ( count($parents) > 0 ) : ?>
				<div class="taxonomy-parents"><em>Parents:</em> <?php print(implode(', ',$parents)); ?></div>
				<?php endif; ?>
				
				<?php
				    // Subcategories
					$list = wp_list_categories('depth=-1&orderby=name&style=none&echo=0&title_li=&child_of='.$cat); 
					$list = substr(trim(str_replace('<br />', ', ', $list)), 0, -1); // replace newlines by commas, trim whitespace, cut of final comma
				?>
				<?php if ( !preg_match("/No categorie/",$list) ) : ?>
				<div class="taxonomy-subcategories"><em>Subcategories:</em> <?php echo $list; ?></div>
				<?php endif; ?>
			</header><!-- .page-header -->

			<?php
			// Start the Loop.
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_format() );

			// End the loop.
			endwhile;

			// Previous/next page navigation.
			the_posts_pagination( array(
				'prev_text'          => __( 'Previous page', 'twentysixteen' ),
				'next_text'          => __( 'Next page', 'twentysixteen' ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'twentysixteen' ) . ' </span>',
			) );

		// If no content, include the "No posts found" template.
		else :
			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

		</main><!-- .site-main -->
	</div><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
