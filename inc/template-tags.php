<?php
/**
 * 投稿データをテンプレートで表示するためのユーティリティ関数群
 * 例：投稿日、カテゴリ、タグ、サムネイルなど
 */

// 投稿日を表示
function copipe_posted_on() {
	echo '<span class="posted-on"><time datetime="' . esc_attr( get_the_date( 'c' ) ) . '">' . esc_html( get_the_date() ) . '</time></span>';
}

// 投稿者名を表示
function copipe_posted_by() {
	echo '<span class="byline">' . esc_html( get_the_author() ) . '</span>';
}

// 投稿のカテゴリを表示
function copipe_post_categories() {
	$categories = get_the_category();
	if ( ! empty( $categories ) ) {
		$cats = array();
		foreach ( $categories as $category ) {
			$cats[] = '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '">' . esc_html( $category->name ) . '</a>';
		}
		echo '<span class="post-categories">' . implode( ', ', $cats ) . '</span>';
	}
}

// タグを表示
function copipe_post_tags() {
	$tags = get_the_tags();
	if ( $tags ) {
		$tag_list = array();
		foreach ( $tags as $tag ) {
			$tag_list[] = '<a href="' . esc_url( get_tag_link( $tag->term_id ) ) . '">' . esc_html( $tag->name ) . '</a>';
		}
		echo '<span class="post-tags">' . implode( ', ', $tag_list ) . '</span>';
	}
}

// サムネイルを表示
function copipe_post_thumbnail( $size = 'medium' ) {
	if ( has_post_thumbnail() ) {
		echo '<div class="post-thumbnail">';
		the_post_thumbnail( $size );
		echo '</div>';
	}
}
