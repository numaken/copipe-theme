<?php
// inc/security.php

// XML-RPC を無効化
add_filter( 'xmlrpc_enabled', '__return_false' );

// REST API：未ログインユーザーの投稿エンドポイントを制限
add_filter( 'rest_endpoints', function( $endpoints ) {
    if ( isset( $endpoints['/wp/v2/posts'] ) ) {
        // 認証済みユーザーだけに限定
        $endpoints['/wp/v2/posts'][0]['permission_callback'] = function(){
            return is_user_logged_in();
        };
    }
    return $endpoints;
});

// セキュリティヘッダー
add_action( 'send_headers', function(){
    header( "X-Content-Type-Options: nosniff" );
    header( "X-Frame-Options: SAMEORIGIN" );
    header( "Referrer-Policy: strict-origin-when-cross-origin" );
    header( "Content-Security-Policy: default-src 'self'; script-src 'self' https://cdn.jsdelivr.net; style-src 'self' https://cdn.jsdelivr.net;" );
});

// CSRF 対策：フォームに nonce を必ず付与、チェックするユーティリティ関数
function copipe_nonce_field( $action = -1 ) {
    return wp_nonce_field( $action, '_copipe_nonce', true, false );
}
function copipe_verify_nonce() {
    if ( empty( $_REQUEST['_copipe_nonce'] ) || ! wp_verify_nonce( $_REQUEST['_copipe_nonce'], '' ) ) {
        wp_die( '不正なリクエストです。' );
    }
}
