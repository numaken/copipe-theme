<?php
// inc/utils.php

// 遅延読み込み：記事内の<img>にloading="lazy" を付与
add_filter( 'the_content', function( $content ) {
    return preg_replace( '/<img /', '<img loading="lazy" ', $content );
} );

// ページキャッシュ（簡易版）
add_action( 'template_redirect', function(){
    if ( is_singular() && ! is_user_logged_in() ) {
        $cache_file = WP_CONTENT_DIR . '/cache/page-' . get_queried_object_id() . '.html';
        if ( file_exists( $cache_file ) && filemtime( $cache_file ) + HOUR_IN_SECONDS > time() ) {
            echo file_get_contents( $cache_file );
            exit;
        }
        ob_start( function( $html ) use ( $cache_file ) {
            file_put_contents( $cache_file, $html );
            return $html;
        } );
    }
} );

// 画像最適化：upload_dir に WebP 変換済みバージョンを生成（ライブラリ別途必要）
add_filter( 'wp_generate_attachment_metadata', function( $metadata, $attachment_id ){
    $file = get_attached_file( $attachment_id );
    // Imagick が利用可能なら WebP 保存
    if ( class_exists('Imagick') ) {
        $img = new Imagick( $file );
        $webp = preg_replace('/\.\w+$/', '.webp', $file );
        $img->setImageFormat('webp');
        $img->writeImage( $webp );
        $metadata['sizes']['webp'] = ['file'=>basename($webp),'width'=>$img->getImageWidth(),'height'=>$img->getImageHeight(),'mime-type'=>'image/webp'];
    }
    return $metadata;
}, 10, 2 );
