<?php
/**
* Loop item view
 */

$postID = $post->ID;
$postTitle = $post->post_title;
$postUrl = get_permalink($post->ID);
$postDate = wp_date( get_option('date_format'), get_post_timestamp() );
$postExcerpt = substr($post->post_excerpt, 0, 195).'...';
$term_obj_list = get_the_terms($post->ID, 'category');
$termIterator = 0;

?>
<div class="news__item">
	<div class="news__item-content">
		<div class="news__thumbnail">
            <a href="<?php echo $postUrl ?>" title="<?php echo $postTitle ?>">
			<img src="<?php echo postFeaturedImage($postID) ?>" alt="" class="img-fluid" width="152" />
            </a>
		</div>
		<div class="news__item-text">
            <a href="<?php echo $postUrl ?>" title="<?php echo $postTitle ?>">
                <h2><?php echo $postTitle ?></h2>
            </a>
			<div class="news__meta">
				<div class="news__date">
                    <img src="<?php echo get_template_directory_uri() ?>/templates/news/assets/images/date.svg" alt="News date icon" />
                    <span><?php echo $postDate ?></span></div>
				<div class="news__terms-wrap">
					<?php foreach ($term_obj_list as $key => $termItem) {
                        
                        $termID= $termItem->term_id;
                        $termName = $termItem->name;
                        $termLink = get_term_link($termID);
                        
                        ?>
						<a href="<?php echo $termLink ?>" class="news__term-item" style="--category-color: <?php echo getCategoryColor($termItem->term_id);?>; color: #fff"><?php echo $termName ?></a>
					    <?php if(++$termIterator == 2) break; } ?>
				</div>
			</div>
			<p class="news__item-excerpt"><?php echo $postExcerpt ?></p>
		</div>
	</div>
</div>