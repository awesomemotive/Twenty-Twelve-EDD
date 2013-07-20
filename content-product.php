<?php
/**
 * The template for displaying products
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="entry-header">
			<header>
				<h2><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'twentytwelve' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php echo the_title(); ?></a></h2>
				<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'twentytwelve' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">
					<?php the_post_thumbnail( 'store-grid' ); ?>
				</a>
			</header>
		</div><!-- .entry-header -->

		<div class="entry-content">
			<div class="product-meta clear">
				<span class="product-price">
					<?php if( edd_has_variable_prices( get_the_ID() ) ) : ?>
						<?php echo edd_price_range( get_the_ID() ); ?>
					<?php else : ?>
						<?php edd_price( get_the_ID() ); ?>
					<?php endif; ?>
				</span><!-- .product-price -->
				<span class="product-link">
					<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'twentytwelve' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">
						<?php _e( 'View Details', 'twentytwelve' ); ?>&rarr;
					</a>
				</span><!-- .product-link -->
			</div><!-- .product-meta -->
		</div><!-- .entry-content -->

	</article><!-- #post -->
