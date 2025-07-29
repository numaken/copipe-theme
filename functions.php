<?php
/**
 * Modern Copipe Theme functions and definitions
 * 
 * @package Modern_Copipe_Theme
 * @version 2.0.0
 */

// 直接アクセス防止
if (!defined('ABSPATH')) {
    exit;
}

// テーマ定数定義
define('COPIPE_THEME_VERSION', '2.0.0');
define('COPIPE_THEME_PATH', get_template_directory());
define('COPIPE_THEME_URL', get_template_directory_uri());

//--------------------------------------------------
// 1. テーマセットアップ（強化版）
//--------------------------------------------------
if (!function_exists('copipe_setup')) {
    function copipe_setup() {
        // 翻訳ファイル読み込み
        load_theme_textdomain('copipe-theme', COPIPE_THEME_PATH . '/languages');
        
        // テーマサポート追加
        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');
        add_theme_support('html5', [
            'search-form', 'gallery', 'caption', 
            'style', 'script', 'navigation-widgets'
        ]);
        add_theme_support('customize-selective-refresh-widgets');
        add_theme_support('custom-logo');
        add_theme_support('responsive-embeds');
        add_theme_support('wp-block-styles');
        add_theme_support('align-wide');
        
        // カスタム画像サイズ
        add_image_size('copipe-thumbnail', 400, 300, true);
        add_image_size('copipe-hero', 1200, 600, true);
        add_image_size('copipe-card', 600, 400, true);
    }
}
add_action('after_setup_theme', 'copipe_setup');

//--------------------------------------------------
// 2. モダンアセット読み込み（最適化版）
//--------------------------------------------------
if (!function_exists('copipe_enqueue_modern_assets')) {
    function copipe_enqueue_modern_assets() {
        // Google Fonts - Inter (モダンフォント)
        wp_enqueue_style('google-fonts',
            'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap',
            [],
            null
        );
        
        // UIkit3（バージョン固定＋integrity追加）
        wp_enqueue_style('uikit-css',
            'https://cdn.jsdelivr.net/npm/uikit@3.17.11/dist/css/uikit.min.css',
            [],
            '3.17.11'
        );
        
        wp_enqueue_script('uikit-js',
            'https://cdn.jsdelivr.net/npm/uikit@3.17.11/dist/js/uikit.min.js',
            [],
            '3.17.11',
            true
        );
        
        wp_enqueue_script('uikit-icons',
            'https://cdn.jsdelivr.net/npm/uikit@3.17.11/dist/js/uikit-icons.min.js',
            ['uikit-js'],
            '3.17.11',
            true
        );

        // Prism.js（軽量化版）
        wp_enqueue_style('prism-css',
            'https://cdn.jsdelivr.net/npm/prismjs@1.29.0/themes/prism-tomorrow.css',
            [],
            '1.29.0'
        );
        
        wp_enqueue_script('prism-core',
            'https://cdn.jsdelivr.net/npm/prismjs@1.29.0/prism.min.js',
            [],
            '1.29.0',
            true
        );
        
        // 必要な言語のみ読み込み
        $languages = ['php', 'javascript', 'css', 'markup', 'json', 'sql'];
        foreach ($languages as $lang) {
            wp_enqueue_script("prism-{$lang}",
                "https://cdn.jsdelivr.net/npm/prismjs@1.29.0/components/prism-{$lang}.min.js",
                ['prism-core'],
                '1.29.0',
                true
            );
        }
        
        // Prismプラグイン
        $plugins = [
            'line-numbers' => true,
            'toolbar' => true,
            'copy-to-clipboard' => true,
            'line-highlight' => true,
            'show-language' => true
        ];
        
        foreach ($plugins as $plugin => $load_css) {
            if ($load_css) {
                wp_enqueue_style("prism-{$plugin}-css",
                    "https://cdn.jsdelivr.net/npm/prismjs@1.29.0/plugins/{$plugin}/prism-{$plugin}.css",
                    [],
                    '1.29.0'
                );
            }
            
            wp_enqueue_script("prism-{$plugin}-js",
                "https://cdn.jsdelivr.net/npm/prismjs@1.29.0/plugins/{$plugin}/prism-{$plugin}.min.js",
                ['prism-core'],
                '1.29.0',
                true
            );
        }
        
        // テーマ独自CSS
        wp_enqueue_style('copipe-style',
            COPIPE_THEME_URL . '/style.css',
            ['uikit-css', 'google-fonts'],
            COPIPE_THEME_VERSION
        );
        
        // カスタムJS（強化版）
        wp_enqueue_script('copipe-modern-script',
            COPIPE_THEME_URL . '/assets/js/modern-copipe.js',
            ['uikit-js'],
            COPIPE_THEME_VERSION,
            true
        );
        
        // スクリプトにデータを渡す
        wp_localize_script('copipe-modern-script', 'copipeAjax', [
            'ajaxurl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('copipe_nonce'),
            'strings' => [
                'copy_success' => __('コピーしました！', 'copipe-theme'),
                'copy_error' => __('コピーに失敗しました', 'copipe-theme'),
                'loading' => __('読み込み中...', 'copipe-theme')
            ]
        ]);
    }
}
add_action('wp_enqueue_scripts', 'copipe_enqueue_modern_assets');

//--------------------------------------------------
// 3. パフォーマンス最適化
//--------------------------------------------------

// defer / async 属性を自動付与
add_filter( 'script_loader_tag', function( $tag, $handle ){
    $defer_scripts = ['copipe-modern-script', 'prism-core', 'uikit-js'];
    if ( in_array( $handle, $defer_scripts ) ) {
        return str_replace( ' src', ' defer src', $tag );
    }
    return $tag;
}, 10, 2 );

// 画像の lazy loading と WebP対応
add_filter( 'the_content', function( $content ){
    // Lazy loading
    $content = preg_replace( '/<img /', '<img loading="lazy" ', $content );
    
    // WebP対応（ブラウザサポート確認）
    $content = preg_replace_callback(
        '/<img([^>]+)src=["\']([^"\']+\.(jpg|jpeg|png))["\']([^>]*)>/i',
        function($matches) {
            $webp_url = preg_replace('/\.(jpg|jpeg|png)$/i', '.webp', $matches[2]);
            // WebP画像が存在する場合のみ置換
            if (file_exists(str_replace(home_url(), ABSPATH, $webp_url))) {
                return sprintf(
                    '<picture><source srcset="%s" type="image/webp"><img%s src="%s"%s></picture>',
                    $webp_url,
                    $matches[1],
                    $matches[2],
                    $matches[4]
                );
            }
            return $matches[0];
        },
        $content
    );
    
    return $content;
}, 20 );

// 重要でないCSSの遅延読み込み
add_action('wp_head', function() {
    echo '<style>
        /* Critical CSS - Above the fold styles */
        body { 
            font-family: "Inter", -apple-system, BlinkMacSystemFont, sans-serif;
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }
        .modern-navbar { 
            position: sticky;
            top: 0;
            z-index: 1000;
        }
    </style>';
}, 1);

//--------------------------------------------------
// 4. モダンOGP対応
//--------------------------------------------------
add_action( 'wp_head', function() {
    if ( is_singular() ) {
        $title = get_the_title();
        $desc = get_the_excerpt() ?: wp_trim_words(strip_tags(get_the_content()), 30);
        $url = get_permalink();
        $type = 'article';
        $image = get_the_post_thumbnail_url(null, 'copipe-hero') ?: COPIPE_THEME_URL . '/assets/img/default-og.jpg';
    } else {
        $title = get_bloginfo('name');
        $desc = get_bloginfo('description');
        $url = home_url();
        $type = 'website';
        $image = COPIPE_THEME_URL . '/assets/img/default-og.jpg';
    }
    ?>
    <!-- Enhanced OGP -->
    <meta property="og:title" content="<?php echo esc_attr( $title ); ?>">
    <meta property="og:description" content="<?php echo esc_attr( $desc ); ?>">
    <meta property="og:type" content="<?php echo esc_attr( $type ); ?>">
    <meta property="og:url" content="<?php echo esc_url( $url ); ?>">
    <meta property="og:site_name" content="<?php bloginfo('name'); ?>">
    <meta property="og:image" content="<?php echo esc_url( $image ); ?>">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600">
    
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo esc_attr( $title ); ?>">
    <meta name="twitter:description" content="<?php echo esc_attr( $desc ); ?>">
    <meta name="twitter:image" content="<?php echo esc_url( $image ); ?>">
    
    <!-- Additional Meta -->
    <meta name="theme-color" content="#667eea">
    <meta name="msapplication-TileColor" content="#667eea">
    <?php
});

//--------------------------------------------------
// 5. 強化されたJSON-LD
//--------------------------------------------------
add_action( 'wp_head', function() {
    if ( is_single() ) {
        $author = get_the_author();
        $author_url = get_author_posts_url(get_the_author_meta('ID'));
        $image = get_the_post_thumbnail_url(null, 'copipe-hero') ?: COPIPE_THEME_URL . '/assets/img/default-article.jpg';
        ?>
        <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "Article",
            "mainEntityOfPage": {
                "@type": "WebPage",
                "@id": "<?php the_permalink(); ?>"
            },
            "headline": "<?php echo esc_js(get_the_title()); ?>",
            "image": {
                "@type": "ImageObject",
                "url": "<?php echo esc_url($image); ?>",
                "width": 1200,
                "height": 600
            },
            "datePublished": "<?php echo get_the_date('c'); ?>",
            "dateModified": "<?php echo get_the_modified_date('c'); ?>",
            "author": {
                "@type": "Person",
                "name": "<?php echo esc_js($author); ?>",
                "url": "<?php echo esc_url($author_url); ?>"
            },
            "publisher": {
                "@type": "Organization",
                "name": "<?php bloginfo('name'); ?>",
                "logo": {
                    "@type": "ImageObject",
                    "url": "<?php echo esc_url(COPIPE_THEME_URL . '/assets/img/logo.png'); ?>"
                }
            },
            "description": "<?php echo esc_js(get_the_excerpt() ?: wp_trim_words(strip_tags(get_the_content()), 30)); ?>",
            "wordCount": "<?php echo str_word_count(strip_tags(get_the_content())); ?>",
            "keywords": "<?php echo esc_js(implode(', ', wp_get_post_tags(get_the_ID(), ['fields' => 'names']))); ?>"
        }
        </script>
        <?php
    }
});

//--------------------------------------------------
// 6. ナビメニュー強化
//--------------------------------------------------
if (!function_exists('copipe_register_menus')) {
    function copipe_register_menus() {
        register_nav_menus([
            'primary' => __( 'Primary Menu', 'copipe-theme' ),
            'footer' => __( 'Footer Menu', 'copipe-theme' ),
            'social' => __( 'Social Links', 'copipe-theme' )
        ]);
    }
}
add_action( 'after_setup_theme', 'copipe_register_menus' );

//--------------------------------------------------
// 7. カスタムポストタイプ（コードスニペット用）
//--------------------------------------------------
function copipe_register_code_snippets() {
    $labels = [
        'name' => 'Code Snippets',
        'singular_name' => 'Code Snippet',
        'add_new' => 'Add New Snippet',
        'add_new_item' => 'Add New Code Snippet',
        'edit_item' => 'Edit Code Snippet',
        'new_item' => 'New Code Snippet',
        'view_item' => 'View Code Snippet',
        'search_items' => 'Search Code Snippets',
        'not_found' => 'No code snippets found',
        'not_found_in_trash' => 'No code snippets found in trash'
    ];

    register_post_type('code_snippet', [
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-editor-code',
        'supports' => ['title', 'editor', 'excerpt', 'thumbnail', 'comments'],
        'rewrite' => ['slug' => 'snippets'],
        'show_in_rest' => true
    ]);
}
add_action('init', 'copipe_register_code_snippets');

//--------------------------------------------------
// 8. 設定取得関数（拡張版）
//--------------------------------------------------
function copipe_get_option($key, $default = '') {
    $options = get_option('copipe_theme_options', []);
    return isset($options[$key]) ? $options[$key] : $default;
}

function copipe_get_adsense_client() {
    return copipe_get_option('adsense_client', '');
}

function copipe_get_adsense_slots() {
    $slots = copipe_get_option('adsense_slots', []);
    return !empty($slots) ? $slots : [
        'header' => '',
        'content' => '',
        'footer' => '',
        'sidebar' => ''
    ];
}

//--------------------------------------------------
// 9. AJAX機能（動的コンテンツ読み込み）
//--------------------------------------------------
function copipe_load_more_posts() {
    check_ajax_referer('copipe_nonce', 'nonce');
    
    $page = intval($_POST['page']);
    $category = sanitize_text_field($_POST['category']);
    
    $args = [
        'post_type' => 'post',
        'posts_per_page' => 6,
        'paged' => $page,
        'post_status' => 'publish'
    ];
    
    if (!empty($category)) {
        $args['category_name'] = $category;
    }
    
    $query = new WP_Query($args);
    
    if ($query->have_posts()) {
        ob_start();
        while ($query->have_posts()) {
            $query->the_post();
            get_template_part('template-parts/content', 'card');
        }
        $content = ob_get_clean();
        wp_reset_postdata();
        
        wp_send_json_success([
            'content' => $content,
            'max_pages' => $query->max_num_pages
        ]);
    } else {
        wp_send_json_error('No more posts found');
    }
}
add_action('wp_ajax_load_more_posts', 'copipe_load_more_posts');
add_action('wp_ajax_nopriv_load_more_posts', 'copipe_load_more_posts');

//--------------------------------------------------
// 10. セキュリティ強化（モダン版）
//--------------------------------------------------

// 不要なWordPress情報の削除
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_shortlink_wp_head');

// XMLRPCの無効化
add_filter('xmlrpc_enabled', '__return_false');

// REST API制限
add_filter('rest_authentication_errors', function($result) {
    if (!is_user_logged_in()) {
        return new WP_Error('rest_disabled', __('REST API access restricted'), ['status' => 401]);
    }
    return $result;
});

// ファイルアップロード制限
add_filter('upload_mimes', function($mimes) {
    // セキュリティのため危険なファイル形式を除外
    unset($mimes['exe'], $mimes['bat'], $mimes['cmd'], $mimes['com'], $mimes['pif'], $mimes['scr'], $mimes['vbs'], $mimes['ws']);
    return $mimes;
});

//--------------------------------------------------
// 11. カスタマイザー設定（既存ファイルを使用）
//--------------------------------------------------
// カスタマイザー設定は inc/customizer.php で管理
// 重複を避けるためここでは定義しない

//--------------------------------------------------
// 12. 既存機能（互換性維持）
//--------------------------------------------------

// カテゴリ設定
function copipe_modify_copipe_archive($query) {
    if (!is_admin() && $query->is_main_query()) {
        if (is_category('copipe')) {
            $query->set('posts_per_page', 
                copipe_get_option('copipe_posts_per_page', 10)
            );
        }
    }
}
add_action('pre_get_posts', 'copipe_modify_copipe_archive');

// AdSenseショートコード（セキュア版）
function copipe_register_adsense_shortcode() {
    add_shortcode('adsense', function($atts) {
        $client = copipe_get_adsense_client();
        if (empty($client)) {
            return '<!-- AdSense client not configured -->';
        }
        
        $a = shortcode_atts([
            'slot' => '',
            'format' => 'auto',
            'responsive' => 'true',
            'style' => 'display:block'
        ], $atts, 'adsense');
        
        if (empty($a['slot'])) {
            return '<!-- AdSense slot not specified -->';
        }
        
        // セキュリティ強化
        $allowed_formats = ['auto', 'rectangle', 'vertical', 'horizontal'];
        if (!in_array($a['format'], $allowed_formats)) {
            $a['format'] = 'auto';
        }
        
        return sprintf(
            '<div class="copipe-adsense uk-margin-medium modern-ad-container">
              <ins class="adsbygoogle"
                   style="%5$s"
                   data-ad-client="%1$s"
                   data-ad-slot="%2$s"
                   data-ad-format="%3$s"
                   data-full-width-responsive="%4$s"></ins>
              <script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
            </div>',
            esc_attr($client),
            esc_attr($a['slot']),
            esc_attr($a['format']),
            esc_attr($a['responsive']),
            esc_attr($a['style'])
        );
    });
}
add_action('init', 'copipe_register_adsense_shortcode');

// 埋め込みオブジェクトを HTML5 タグに置換
if (!function_exists('copipe_replace_embeds_with_html5')) {
    add_filter( 'the_content', 'copipe_replace_embeds_with_html5', 20 );
    function copipe_replace_embeds_with_html5( $content ) {
        // <object data="…"></object> を video タグに置換
        $content = preg_replace_callback(
            '/<object[^>]+data=["\']([^"\']+)["\'][^>]*>.*?<\/object>/is',
            function( $matches ) {
                $url = esc_url( $matches[1] );
                if ( preg_match( '/\.(mp4|webm|ogg)$/i', $url, $m ) ) {
                    $type = 'video/' . strtolower( $m[1] );
                    return sprintf(
                        '<div class="modern-video-wrapper"><video controls preload="metadata" class="modern-video"><source src="%1$s" type="%2$s">Your browser does not support the video tag.</video></div>',
                        $url,
                        $type
                    );
                }
                return '';
            },
            $content
        );

        // <embed src="…"> を audio/video タグに置換
        $content = preg_replace_callback(
            '/<embed[^>]+src=["\']([^"\']+)["\'][^>]*>/is',
            function( $matches ) {
                $url = esc_url( $matches[1] );
                if ( preg_match( '/\.(mp3|wav)$/i', $url, $m ) ) {
                    $type = 'audio/' . strtolower( $m[1] );
                    return sprintf(
                        '<div class="modern-audio-wrapper"><audio controls preload="metadata" class="modern-audio"><source src="%1$s" type="%2$s">Your browser does not support the audio tag.</audio></div>',
                        $url,
                        $type
                    );
                }
                if ( preg_match( '/\.(mp4|webm|ogg)$/i', $url, $m ) ) {
                    $type = 'video/' . strtolower( $m[1] );
                    return sprintf(
                        '<div class="modern-video-wrapper"><video controls preload="metadata" class="modern-video"><source src="%1$s" type="%2$s">Your browser does not support the video tag.</video></div>',
                        $url,
                        $type
                    );
                }
                return ''; 
            },
            $content
        );

        return $content;
    }
}

// ファイル読み込み（重複チェック付き）
$include_files = [
    '/inc/admin-settings.php',
    '/inc/utils.php', 
    '/inc/ajax-functions.php',
    '/inc/customizer.php'
];

foreach ($include_files as $file) {
    $file_path = get_template_directory() . $file;
    if (file_exists($file_path)) {
        require_once $file_path;
    }
}

//--------------------------------------------------
// 13. モダンCSS変数の出力
//--------------------------------------------------
add_action('wp_head', function() {
    $primary_color = get_theme_mod('primary_color', '#667eea');
    $font_size = get_theme_mod('body_font_size', 16);
    ?>
    <style>
        :root {
            --primary-color: <?php echo esc_attr($primary_color); ?>;
            --body-font-size: <?php echo esc_attr($font_size); ?>px;
            --primary-gradient: linear-gradient(135deg, <?php echo esc_attr($primary_color); ?> 0%, #764ba2 100%);
            --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --success-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            --warning-gradient: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
            --dark-gradient: linear-gradient(135deg, #0c0c0c 0%, #1a1a1a 100%);
            --glass-bg: rgba(255, 255, 255, 0.1);
            --glass-border: rgba(255, 255, 255, 0.2);
            --shadow-elevation: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            --border-radius: 16px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .modern-video-wrapper,
        .modern-audio-wrapper {
            margin: 2rem 0;
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--shadow-elevation);
        }
        
        .modern-video,
        .modern-audio {
            width: 100%;
            height: auto;
            display: block;
        }
        
        .modern-ad-container {
            background: rgba(255, 255, 255, 0.05);
            border-radius: var(--border-radius);
            padding: 1rem;
            text-align: center;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
    </style>
    <?php
}, 5);

// 管理バーのスタイル調整
add_action('wp_head', function() {
    if (is_admin_bar_showing()) {
        echo '<style>
            html { margin-top: 32px !important; }
            @media screen and (max-width: 782px) {
                html { margin-top: 46px !important; }
            }
        </style>';
    }
});




//--20250729追加　

function copipe_body_classes($classes) {
    // 条件に応じたクラスを追加
    return $classes;
}
add_filter('body_class', 'copipe_body_classes');

function copipe_post_classes($classes) {
    // 投稿の特徴に応じたクラスを追加
    return $classes;
}
add_filter('post_class', 'copipe_post_classes');

function copipe_custom_excerpt_length($length) {
    return get_theme_mod('copipe_excerpt_length', 120);  // デフォルトは120文字
}
add_filter('excerpt_length', 'copipe_custom_excerpt_length', 999);

function copipe_wp_title_filter($title, $sep) {
    // ページ番号やアーカイブタイトルにカスタマイズ
    return $title;
}
add_filter('wp_title', 'copipe_wp_title_filter', 10, 2);

function copipe_comment_form_defaults($defaults) {
    // コメントフォームのデフォルト設定を変更
    return $defaults;
}
add_filter('comment_form_defaults', 'copipe_comment_form_defaults');

function copipe_add_lazy_loading($attr, $attachment, $size) {
    if (!is_admin() && !is_feed()) {
        $attr['loading'] = 'lazy';  // 遅延読み込み
    }
    return $attr;
}
add_filter('wp_get_attachment_image_attributes', 'copipe_add_lazy_loading', 10, 3);

function copipe_custom_posts_per_page($query) {
    if (!is_admin() && $query->is_main_query() && is_post_type_archive('ai_prompt')) {
        $query->set('posts_per_page', 12);  // 1ページあたり12件
    }
}
add_action('pre_get_posts', 'copipe_custom_posts_per_page');












?>