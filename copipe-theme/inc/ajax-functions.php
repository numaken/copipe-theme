<?php
// inc/ajax-functions.php

// スクリプトに Ajax URL／Nonce を渡す
add_action( 'wp_enqueue_scripts', function() {
    wp_localize_script( 'copipe-js', 'copipeAjax', [
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'nonce'   => wp_create_nonce( 'copipe-ajax-nonce' ),
    ] );
} );

// 検索候補 (フロントエンド)
add_action( 'wp_ajax_nopriv_copipe_suggest', 'copipe_ajax_suggest' );
add_action( 'wp_ajax_copipe_suggest',        'copipe_ajax_suggest' );
function copipe_ajax_suggest() {
    // nonce チェック
    check_ajax_referer( 'copipe-ajax-nonce' );
    $term = isset( $_GET['q'] ) ? sanitize_text_field( $_GET['q'] ) : '';
    if ( ! $term ) {
        wp_send_json_error();
    }
    $posts = get_posts( [
        's'              => $term,
        'post_type'      => 'post',
        'posts_per_page' => 5,
    ] );
    $results = [];
    foreach ( $posts as $p ) {
        $results[] = [
            'id'    => $p->ID,
            'title' => get_the_title( $p ),
            'url'   => get_permalink( $p ),
        ];
    }
    wp_send_json_success( $results );
}

// コードクリップボード
add_action( 'wp_ajax_nopriv_copipe_copy', 'copipe_ajax_copy' );
add_action( 'wp_ajax_copipe_copy', 'copipe_ajax_copy' );
function copipe_ajax_copy() {
    check_ajax_referer( 'copipe-ajax-nonce' );
    $post_id = isset( $_POST['id'] ) ? intval( $_POST['id'] ) : 0;
    if ( ! $post_id ) {
        wp_send_json_error();
    }
    $raw = get_post_field( 'post_content', $post_id );
    if ( preg_match( '/```php\s*(.*?)\s*```/s', $raw, $m ) ) {
        $code = trim( $m[1] );
        wp_send_json_success( [ 'code' => $code ] );
    }
    wp_send_json_error();
}
