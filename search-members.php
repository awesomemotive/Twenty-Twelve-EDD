<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */

get_header(); ?>

	<div class="content-wrap clearfix" id="primary">

		<?php get_template_part('notification', 'area'); ?>

		<div id="main" class="main-content">

			<div id="entries-wrap">
				<div id="entries">
					<h2 id="search-results">Search Results for <span class="orange"><?php the_search_query(); ?></span></h2>
					<div id="member-search-results">
						<?php
						$search = trim( urldecode( $_GET['s'] ) );
						$args = array(
							'blog_id' => 1,
							'search'  => $search,
							'search_columns' => array(
								'user_login',
								'ID',
								'user_nicename',
								'user_email',
								'user_url',
								'display_name'
							),
							'number'  => 999
						);
						if( ! is_email( $search ) && ! is_numeric( $search ) && filter_var( $search, FILTER_VALIDATE_URL ) === FALSE && preg_match( '/\s/', $search ) ) {
							// Searching for user name with spaces so assume it is a first / last name search
							$names = explode( ' ', $search );
							//print_r( $names ); exit;
							$args['meta_query'] = array(
								'relation' => 'OR',
								array(
									'key'  => 'first_name',
									'value'=> $names[0],
									'compare' => 'LIKE'
								),
								array(
									'key'  => 'last_name',
									'value'=> $names[1],
									'compare' => 'LIKE'
								)
							);
							unset( $args['search'] );
						}
						echo '<pre>'; print_r( $args ); echo '</pre>'; exit;
						$members = new WP_User_Query( $args ); ?>
						<?php if ( !empty( $members->results ) ) : ?>

							<?php foreach ( $members->results as $member ) : ?>

								<div class="member">
									<h3 class="member-name">
										<a href="<?php echo network_home_url( '/profile/' . $member->user_login ); ?>" title="View member's profile">
											<?php echo $member->display_name; ?>
										</a>
										<a href="<?php echo network_home_url( '/profile/' . $member->user_login ); ?>" title="View member's profile">
											<?php echo get_avatar( $member->ID, '96' ); ?>
										</a>
									</h3>
								</div>

							<?php endforeach; ?>
						<?php else : ?>
							<div id="no-members-found">
								<p>No members matching your search results were found.</p>
							</div>
						<?php endif; ?>
					</div>
				</div><!--end entries-->
			</div><!--end entries-wrap-->
		</div><!--end main-content-->


	</div><!--end content wrap-->

<?php get_footer(); ?>