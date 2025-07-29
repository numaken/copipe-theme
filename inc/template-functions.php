<?php
/**
 * テンプレート機能関数
 * copipe-theme_postpilot_v3
 */

/**
 * body_class にカスタムクラスを追加
 */
function copipe_body_classes($classes) {
    // ページテンプレートに応じてクラス追加
    if (is_page_template('page-postpilot.php')) {
        $classes[] = 'postpilot-lp';
    }
    
    if (is_page_template('page-about.php')) {
        $classes[] = 'about-page';
    }
    
    if (is_page_template('page-profile.php')) {
        $classes[] = 'profile-page';
    }
    
    // 投稿タイプに応じてクラス追加
    if (is_singular('ai_prompt')) {
        $classes[] = 'ai-prompt-single';
    }
    
    // カスタマイザー設定に応じてクラス追加
    $blog_layout = get_theme_mod('copipe_blog_layout', 'list');
    if (is_home() || is_archive()) {
        $classes[] = 'blog-layout-' . $blog_layout;
    }
    
    // スティッキーヘッダー
    if (get_theme_mod('copipe_sticky_header', true)) {
        $classes[] = 'sticky-header';
    }
    
    // モバイル判定
    if (wp_is_mobile()) {
        $classes[] = 'is-mobile';
    }
    
    return $classes;
}
add_filter('body_class', 'copipe_body_classes');

/**
 * post_class にカスタムクラスを追加
 */
function copipe_post_classes($classes) {
    // 注目記事のクラス追加
    if (get_post_meta(get_the_ID(), '_copipe_featured', true)) {
        $classes[] = 'featured-post';
    }
    
    // 外部リンク記事のクラス追加
    if (get_post_meta(get_the_ID(), '_copipe_external_url', true)) {
        $classes[] = 'external-link';
    }
    
    // アイキャッチ画像の有無
    if (has_post_thumbnail()) {
        $classes[] = 'has-thumbnail';
    } else {
        $classes[] = 'no-thumbnail';
    }
    
    return $classes;
}
add_filter('post_class', 'copipe_post_classes');

/**
 * excerpt の文字数をカスタマイザー設定に従って変更
 */
function copipe_custom_excerpt_length($length) {
    return get_theme_mod('copipe_excerpt_length', 120);
}
add_filter('excerpt_length', 'copipe_custom_excerpt_length', 999);

/**
 * excerpt の省略記号をカスタマイズ
 */
function copipe_excerpt_more($more) {
    if (is_admin()) {
        return $more;
    }
    
    return '...';
}
add_filter('excerpt_more', 'copipe_excerpt_more');

/**
 * タイトルタグの出力をカスタマイズ
 */
function copipe_wp_title_filter($title, $sep) {
    if (is_feed()) {
        return $title;
    }
    
    global $page, $paged;
    
    // ページ番号を追加
    if (($paged >= 2 || $page >= 2) && !is_404()) {
        $title .= " {$sep} " . sprintf(__('Page %s', 'copipe-theme'), max($paged, $page));
    }
    
    return $title;
}
add_filter('wp_title', 'copipe_wp_title_filter', 10, 2);

/**
 * アーカイブタイトルの接頭辞を削除
 */
function copipe_archive_title($title) {
    if (is_category()) {
        $title = single_cat_title('', false);
    } elseif (is_tag()) {
        $title = single_tag_title('', false);
    } elseif (is_author()) {
        $title = '<span class="vcard">' . get_the_author() . '</span>';
    } elseif (is_post_type_archive('ai_prompt')) {
        $title = 'AIプロンプト';
    }
    
    return $title;
}
add_filter('get_the_archive_title', 'copipe_archive_title');

/**
 * メニューにカスタムクラスを追加
 */
function copipe_nav_menu_css_class($classes, $item, $args) {
    if ($args->theme_location == 'primary') {
        $classes[] = 'nav-item';
    }
    
    if (in_array('current-menu-item', $classes)) {
        $classes[] = 'active';
    }
    
    return $classes;
}
add_filter('nav_menu_css_class', 'copipe_nav_menu_css_class', 10, 3);

/**
 * メニューリンクにカスタム属性を追加
 */
function copipe_nav_menu_link_attributes($atts, $item, $args) {
    if ($args->theme_location == 'primary') {
        $atts['class'] = 'nav-link';
    }
    
    // 外部リンクの場合
    if (strpos($atts['href'], home_url()) === false && strpos($atts['href'], 'http') === 0) {
        $atts['target'] = '_blank';
        $atts['rel'] = 'noopener noreferrer';
    }
    
    return $atts;
}
add_filter('nav_menu_link_attributes', 'copipe_nav_menu_link_attributes', 10, 3);

/**
 * コメントフォームをカスタマイズ
 */
function copipe_comment_form_defaults($defaults) {
    $defaults['comment_field'] = '<p class="comment-form-comment"><label for="comment">' . _x('Comment', 'noun', 'copipe-theme') . '</label><textarea id="comment" name="comment" cols="45" rows="8" required aria-describedby="form-allowed-tags"></textarea></p>';
    
    $defaults['submit_button'] = '<input name="%1$s" type="submit" id="%2$s" class="%3$s btn btn-primary" value="%4$s" />';
    
    $defaults['title_reply'] = __('コメントを残す', 'copipe-theme');
    $defaults['title_reply_to'] = __('%s への返信', 'copipe-theme');
    $defaults['cancel_reply_link'] = __('返信をキャンセル', 'copipe-theme');
    $defaults['label_submit'] = __('コメントを投稿', 'copipe-theme');
    
    return $defaults;
}
add_filter('comment_form_defaults', 'copipe_comment_form_defaults');

/**
 * 検索フォームをカスタマイズ
 */
function copipe_search_form($form) {
    $form = '<form role="search" method="get" class="search-form" action="' . home_url('/') . '">
        <label class="screen-reader-text" for="search-field">' . __('Search for:', 'copipe-theme') . '</label>
        <input type="search" id="search-field" class="search-field" placeholder="' . esc_attr__('検索...', 'copipe-theme') . '" value="' . get_search_query() . '" name="s" />
        <button type="submit" class="search-submit" aria-label="' . esc_attr__('Search', 'copipe-theme') . '">
            <span class="search-icon" aria-hidden="true"></span>
        </button>
    </form>';
    
    return $form;
}
add_filter('get_search_form', 'copipe_search_form');

/**
 * ページネーションをカスタマイズ
 */
function copipe_pagination($args = array()) {
    $defaults = array(
        'mid_size' => 2,
        'prev_text' => __('&laquo; 前へ', 'copipe-theme'),
        'next_text' => __('次へ &raquo;', 'copipe-theme'),
        'type' => 'array',
    );
    
    $args = wp_parse_args($args, $defaults);
    $links = paginate_links($args);
    
    if ($links) {
        echo '<nav class="pagination-wrapper" aria-label="' . __('Posts navigation', 'copipe-theme') . '">';
        echo '<ul class="pagination">';
        foreach ($links as $link) {
            if (strpos($link, 'current') !== false) {
                echo '<li class="page-item active">' . str_replace('page-numbers', 'page-link', $link) . '</li>';
            } else {
                echo '<li class="page-item">' . str_replace('page-numbers', 'page-link', $link) . '</li>';
            }
        }
        echo '</ul>';
        echo '</nav>';
    }
}

/**
 * ウィジェットのHTMLをカスタマイズ
 */
function copipe_widget_title($title, $instance, $id_base) {
    if (empty($title)) {
        return $title;
    }
    
    return '<span class="widget-title-text">' . $title . '</span>';
}
add_filter('widget_title', 'copipe_widget_title', 10, 3);

/**
 * 画像の遅延読み込み対応
 */
function copipe_add_lazy_loading($attr, $attachment, $size) {
    if (!is_admin() && !is_feed()) {
        $attr['loading'] = 'lazy';
    }
    
    return $attr;
}
add_filter('wp_get_attachment_image_attributes', 'copipe_add_lazy_loading', 10, 3);

/**
 * ギャラリーショートコードをカスタマイズ
 */
function copipe_gallery_shortcode($output, $attr) {
    // デフォルトの出力を使用（必要に応じてカスタマイズ）
    return $output;
}
add_filter('post_gallery', 'copipe_gallery_shortcode', 10, 2);

/**
 * 投稿の閲覧数をカウント（シングルページのみ）
 */
function copipe_track_post_views() {
    if (is_single() && !is_user_logged_in()) {
        $post_id = get_the_ID();
        if ($post_id) {
            $count = get_post_meta($post_id, 'post_views_count', true);
            if (empty($count)) {
                $count = 0;
            }
            $count++;
            update_post_meta($post_id, 'post_views_count', $count);
        }
    }
}
add_action('wp_head', 'copipe_track_post_views');

/**
 * RSS フィードにアイキャッチ画像を追加
 */
function copipe_rss_post_thumbnail($content) {
    global $post;
    
    if (has_post_thumbnail($post->ID)) {
        $content = '<div>' . get_the_post_thumbnail($post->ID, 'medium') . '</div>' . $content;
    }
    
    return $content;
}
add_filter('the_excerpt_rss', 'copipe_rss_post_thumbnail');
add_filter('the_content_feed', 'copipe_rss_post_thumbnail');

/**
 * 投稿にnoindexを追加する条件
 */
function copipe_add_noindex() {
    // AIO SEO がある場合は何もしない
    if (function_exists('aioseo')) {
        return;
    }
    
    // 検索結果ページ
    if (is_search()) {
        echo '<meta name="robots" content="noindex,follow" />' . "\n";
    }
    
    // 404ページ
    if (is_404()) {
        echo '<meta name="robots" content="noindex,follow" />' . "\n";
    }
    
    // 特定のページ（必要に応じて追加）
    if (is_page('privacy-policy') || is_page('terms')) {
        echo '<meta name="robots" content="noindex,follow" />' . "\n";
    }
}
add_action('wp_head', 'copipe_add_noindex');

/**
 * プリロードリソースを追加
 */
function copipe_add_preload_resources() {
    // フォントのプリロード
    $font_family = get_theme_mod('copipe_font_family', 'noto-sans-jp');
    if ($font_family === 'noto-sans-jp') {
        echo '<link rel="preload" href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300;400;500;700&display=swap" as="style" onload="this.onload=null;this.rel=\'stylesheet\'">' . "\n";
        echo '<noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300;400;500;700&display=swap"></noscript>' . "\n";
    }
    
    // 重要なCSSのプリロード
    echo '<link rel="preload" href="' . get_stylesheet_uri() . '" as="style">' . "\n";
}
add_action('wp_head', 'copipe_add_preload_resources', 1);

/**
 * 管理バーのスタイル調整
 */
function copipe_admin_bar_style() {
    if (is_admin_bar_showing()) {
        echo '<style>
            @media screen and (max-width: 782px) {
                .site-header.sticky-header {
                    top: 46px;
                }
                .site-content {
                    padding-top: 126px;
                }
            }
            @media screen and (min-width: 783px) {
                .site-header.sticky-header {
                    top: 32px;
                }
                .site-content {
                    padding-top: 112px;
                }
            }
        </style>';
    }
}
add_action('wp_head', 'copipe_admin_bar_style');

/**
 * ページテンプレート選択肢を追加
 */
function copipe_page_templates($templates) {
    $templates['page-postpilot.php'] = 'PostPilot LPテンプレート';
    $templates['page-about.php'] = 'Aboutページテンプレート';
    $templates['page-profile.php'] = 'プロフィールページテンプレート';
    
    return $templates;
}
add_filter('theme_page_templates', 'copipe_page_templates');

/**
 * カスタム投稿タイプのアーカイブページでの投稿数制御
 */
function copipe_custom_posts_per_page($query) {
    if (!is_admin() && $query->is_main_query()) {
        if (is_post_type_archive('ai_prompt')) {
            $query->set('posts_per_page', 12);
        }
    }
}
add_action('pre_get_posts', 'copipe_custom_posts_per_page');
?>