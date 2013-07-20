<?php
/**
 * Template Name: Store, Grid View 2 Column
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

	<div id="primary" class="site-content store-grid two-column">
		<div id="content" role="main">

			<?php
			$product_args = array(
				'post_type' => 'download',
				'paged'     => get_query_var('paged')
			);
			$products = new WP_Query( $product_args );
			if ( $products->have_posts() ) : $i = 1;
				while ( $products->have_posts() ) : $products->the_post();
					get_template_part( 'content', 'product' );
				endwhile;
				?>
				<div class="pagination">
					<?php
						$big = 999999999; // need an unlikely intege
						echo paginate_links( array(
							'base'    => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
							'format'  => '?paged=%#%',
							'current' => max( 1, get_query_var('paged') ),
							'total'   => $products->max_num_pages
						) );
					?>
				</div>
			<?php else : ?>

				<h2 class="center">Not Found</h2>
				<p class="center">Sorry, but you are looking for something that isn't here.</p>
				<?php get_search_form(); ?>

			<?php endif; ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>