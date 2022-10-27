<?php

// Get categories from category taxonomy
$categories = get_terms(array(
    'taxonomy' => 'category',
    'parent'   => 0,
    'exclude'  => 1
));


// Get category posts by category ID
function getCategoryPost($id) {
	
	// Change posts on page in category View
	if(is_category()) {
		$posts_per_page = 12;
	} else {
		$posts_per_page = 3;
	}
	
	// News category setting - test 9 - live 920072
	$newsID = 920072;
	
	if ($id == $newsID) {
		$lastposts = get_posts(array(
			'post_type' => 'post',
			'posts_per_page' => $posts_per_page,
			'orderby' => 'post_date',
			'order' => 'DESC'
		));
		
		return $lastposts;
	}
	
	$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
	$lastposts = get_posts(array(
		'post_type' => 'post',
		'paged' => $paged,
		'posts_per_page' => $posts_per_page,
		'tax_query' => array(
			array(
				'taxonomy' => 'category',
				'terms' => $id,
				'field' => 'term_id',
			)
		),
		'orderby' => 'post_date',
		'order' => 'DESC'
	));
	
	return $lastposts;
}

// Get category color (custom fields via ACF Pro)
function getCategoryColor($termID) {
	$color = get_field('category_color', 'category' . '_' . $termID);
	return $color;
}

// Get Post Thumbnail image
function postFeaturedImage($postId) {
	
	$imageUrl = get_the_post_thumbnail_url($postId);
	
	// Check if imageUrl exist
	if (!$imageUrl) {
		$imageUrl = 'https://xevos.store/wp-content/themes/xevos/img/store-no-image.png';
	}
	
	return $imageUrl;
}

function addActiveClass($key) {
	
	// Get category slug on Post category page and match active class
	if (is_category()) {
		
		global $cat;
		
		if ($key === $cat)
		return 'active';
		
	} else {
		
		// Add class to first item in list
		if ($key === 0) {
			return 'active';
		}
	}
}
