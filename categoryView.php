<?php
/*
  * Category view template
  */

// Include functions
require_once('newsFunctions.php');

?>

<div class="tabs__content-wrap mt-4 <?php if(is_page('produkty')){?> col-12 posts__homepage-block <?php } ?>">
	<div class="news__navigation">
		<?php
		foreach ($categories as $key => $category) {
            
            // Change iterator to category ID on category page
            if (is_category()) {
                $key = $category->term_id;
            }
            ?>
			<a <?php if(is_category()) { echo 'href="' . get_term_link($key) . '"'; } else { echo 'data-tab-button'; }; ?> data-slug="<?php echo $category->slug ?>" style=" --category-color: <?php echo getCategoryColor($category->term_id); ?>" class="navigation-button <?php echo addActiveClass($key); ?>"><?php echo $category->name ?></a>
		<?php } ?>
	</div>
	<div class="news__tabs">
		<?php foreach ($categories as $key => $category) {
			
			// Change iterator to category ID on category page
			if (is_category()) {
				$key = $category->term_id;
			}
            
            ?>
			<a <?php if(is_category()) { echo 'href="' . get_term_link($key) . '"'; } else { echo 'data-tab-button'; }; ?> data-slug="<?php echo $category->slug ?>" class="navigation-button news__mobile-button <?php echo addActiveClass($key); ?>">
				<span><?php echo $category->name ?></span>
				<img src="<?php echo get_template_directory_uri() ?>/templates/news/assets/images/news_accordion_arrow.svg" alt="News accordion button arrow" />
			</a>
			<div data-tab-content data-content="<?php echo $category->slug ?>" class="<?php echo addActiveClass($key); ?>">
				<div class="news__items">
					<?php
					
					// Reset post data object
					wp_reset_postdata();
					
					// Get new query of posts
					$latestposts = getCategoryPost($category->term_id);
                    
                    
                    //var_dump($latestposts);
					
					// Display query items
					foreach ($latestposts as $post) {
						
						get_template_part('templates/news/loop', 'item');
						
					}
                    
                    ?>
					
                    <?php if(!is_category()) { ?>
					<div class="news__link-wrap">
						<a href="<?php echo get_term_link($category->term_id); ?>" class="more__red-link arrow-icon">Další články <img src="<?php echo get_template_directory_uri(); ?>/templates/news/assets/images/red_arrow.svg" alt="Next articles icon" /></a>
					</div>
                    <?php } ?>
					<?php if(is_category()) {
						$big = 999999999; // need an unlikely integer ?>
                        <div class="post__category-pagination">
                    <?php echo paginate_links( array(
							'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
							'format' => '?paged=%#%',
							'current' => max( 1, get_query_var('paged') ),
							'total' => $wp_query->max_num_pages,
                            'prev_text' => "<",
                            'next_text' => ">"
						) ); ?>
                        </div>
				 <?php } // end if category() ?>
				</div>
			</div>
		<?php } ?>
	</div>
</div>