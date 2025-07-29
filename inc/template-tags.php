<?php
/**
 * テンプレートタグ・ヘルパー関数
 * copipe-theme_postpilot_v3
 */

/**
 * 投稿メタ情報を表示
 */
function copipe_posted_on() {
    $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
    if (get_the_time('U') !== get_the_modified_time('U')) {
        $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
    }

    $time_string = sprintf($time_string,
        esc_attr(get_the_date('c')),
        esc_html(get_the_date()),
        esc_attr(get_the_modified_date('c')),
        esc_html(get_the_modified_date())
    );

    $posted_on = sprintf(
        esc_html_x('投稿日: %s', 'post date', 'copipe-theme'),
        '<a href="' . esc_url(get_permalink()) . '" rel="bookmark">' . $time_string . '</a>'
    );

    echo '<span class="posted-on">' . $posted_on . '</span>';
}

/**
 * 投稿者情報を表示
 */
function copipe_posted_by() {
    $byline = sprintf(
        esc_html_x('投稿者: %s', 'post author', 'copipe-theme'),
        '<span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>'
    );

    echo '<span class="byline"> ' . $byline . '</span>';
}

/**
 * カテゴリーリンクを表示
 */
function copipe_category_list() {
    $categories_list = get_the_category_list(esc_html__(', ', 'copipe-theme'));
    if ($categories_list) {
        printf('<span class="cat-links">' . esc_html__('カテゴリー: %1$s', 'copipe-theme') . '</span>', $categories_list);
    }
}

/**
 * タグリンクを表示
 */
function copipe_tag_list() {
    $tags_list = get_the_tag_list('', esc_html_x(', ', 'list item separator', 'copipe-theme'));
    if ($tags_list) {
        printf('<span class="tags-links">' . esc_html__('タグ: %1$s', 'copipe-theme') . '</span>', $tags_list);
    }
}

/**
 * 編集リンクを表示
 */
function copipe_edit_link() {
    edit_post_link(
        sprintf(
            wp_kses(
                __('編集 <span class="screen-reader-text">"%s"</span>', 'copipe-theme'),
                array(
                    'span' => array(
                        'class' => array(),
                    ),
                )
            ),
            get_the_title()
        ),
        '<span class="edit-link">',
        '</span>'
    );
}

/**
 * アーカイブタイトルを取得
 */
function copipe_get_archive_title() {
    if (is_category()) {
        $title = single_cat_title('', false);
    } elseif (is_tag()) {
        $title = single_tag_title('', false);
    } elseif (is_author()) {
        $title = '<span class="vcard">' . get_the_author() . '</span>';
    } elseif (is_year()) {
        $title = get_the_date(_x('Y年', 'yearly archives date format', 'copipe-theme'));
    } elseif (is_month()) {
        $title = get_the_date(_x('Y年n月', 'monthly archives date format', 'copipe-theme'));
    } elseif (is_day()) {
        $title = get_the_date(_x('Y年n月j日', 'daily archives date format', 'copipe-theme'));
    } elseif (is_tax('ai_prompt_category')) {
        $title = single_term_title('', false);
    } elseif (is_post_type_archive()) {
        $title = post_type_archive_title('', false);
    } else {
        $title = __('アーカイブ', 'copipe-theme');
    }
    
    return $title;
}

/**
 * アーカイブ説明を取得
 */
function copipe_get_archive_description() {
    $description = '';
    
    if (is_category() || is_tag() || is_tax()) {
        $description = term_description();
    } elseif (is_author()) {
        $description = get_the_author_meta('description');
    } elseif (is_post_type_archive()) {
        $description = get_the_archive_description();
    }
    
    return $description;
}

/**
 * 関連記事を取得
 */
function copipe_get_related_posts($post_id = null, $limit = 4) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    
    $categories = wp_get_post_categories($post_id);
    if (empty($categories)) {
        return array();
    }
    
    $args = array(
        'category__in' => $categories,
        'post__not_in' => array($post_id),
        'posts_per_page' => $limit,
        'no_found_rows' => true,
        'orderby' => 'rand',
    );
    
    return get_posts($args);
}

/**
 * 人気記事を取得
 */
function copipe_get_popular_posts($limit = 5) {
    $args = array(
        'posts_per_page' => $limit,
        'meta_key' => 'post_views_count',
        'orderby' => 'meta_value_num',
        'order' => 'DESC',
        'no_found_rows' => true,
    );
    
    return get_posts($args);
}

/**
 * 注目記事を取得
 */
function copipe_get_featured_posts($limit = 3) {
    $args = array(
        'posts_per_page' => $limit,
        'meta_key' => '_copipe_featured',
        'meta_value' => '1',
        'no_found_rows' => true,
    );
    
    return get_posts($args);
}

/**
 * 投稿の閲覧数をカウント
 */
function copipe_set_post_views($post_id) {
    $count_key = 'post_views_count';
    $count = get_post_meta($post_id, $count_key, true);
    if ($count == '') {
        $count = 0;
        delete_post_meta($post_id, $count_key);
        add_post_meta($post_id, $count_key, '0');
    } else {
        $count++;
        update_post_meta($post_id, $count_key, $count);
    }
}

/**
 * 投稿の閲覧数を取得
 */
function copipe_get_post_views($post_id) {
    $count_key = 'post_views_count';
    $count = get_post_meta($post_id, $count_key, true);
    if ($count == '') {
        delete_post_meta($post_id, $count_key);
        add_post_meta($post_id, $count_key, '0');
        return 0;
    }
    return $count;
}

/**
 * 読了時間を計算
 */
function copipe_get_reading_time($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    
    $content = get_post_field('post_content', $post_id);
    $word_count = str_word_count(strip_tags($content));
    $reading_time = ceil($word_count / 200); // 1分間に200語として計算
    
    return max(1, $reading_time); // 最低1分
}

/**
 * ソーシャルシェアボタンを生成
 */
function copipe_social_share_buttons($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }
    
    $url = get_permalink($post_id);
    $title = get_the_title($post_id);
    $encoded_url = urlencode($url);
    $encoded_title = urlencode($title);
    
    $buttons = array(
        'twitter' => array(
            'url' => "https://twitter.com/intent/tweet?url={$encoded_url}&text={$encoded_title}",
            'label' => 'Twitter',
            'icon' => 'twitter'
        ),
        'facebook' => array(
            'url' => "https://www.facebook.com/sharer/sharer.php?u={$encoded_url}",
            'label' => 'Facebook',
            'icon' => 'facebook'
        ),
        'line' => array(
            'url' => "https://social-plugins.line.me/lineit/share?url={$encoded_url}",
            'label' => 'LINE',
            'icon' => 'line'
        ),
        'pocket' => array(
            'url' => "https://getpocket.com/edit?url={$encoded_url}&title={$encoded_title}",
            'label' => 'Pocket',
            'icon' => 'pocket'
        )
    );
    
    $output = '<div class="social-share-buttons">';
    $output .= '<p class="share-text">この記事をシェア</p>';
    $output .= '<ul class="share-buttons">';
    
    foreach ($buttons as $key => $button) {
        $output .= sprintf(
            '<li class="share-button share-%s"><a href="%s" target="_blank" rel="noopener" aria-label="%sでシェア"><span class="icon-%s"></span><span class="share-label">%s</span></a></li>',
            $key,
            esc_url($button['url']),
            esc_attr($button['label']),
            $button['icon'],
            esc_html($button['label'])
        );
    }
    
    $output .= '</ul>';
    $output .= '</div>';
    
    return $output;
}

/**
 * 前後の記事ナビゲーション
 */
function copipe_post_navigation() {
    $prev_post = get_previous_post();
    $next_post = get_next_post();
    
    if (!$prev_post && !$next_post) {
        return;
    }
    
    echo '<nav class="post-navigation" aria-label="記事ナビゲーション">';
    echo '<h2 class="screen-reader-text">記事ナビゲーション</h2>';
    echo '<div class="nav-links">';
    
    if ($prev_post) {
        echo '<div class="nav-previous">';
        echo '<a href="' . get_permalink($prev_post) . '" rel="prev">';
        echo '<span class="nav-subtitle">前の記事</span>';
        echo '<span class="nav-title">' . get_the_title($prev_post) . '</span>';
        echo '</a>';
        echo '</div>';
    }
    
    if ($next_post) {
        echo '<div class="nav-next">';
        echo '<a href="' . get_permalink($next_post) . '" rel="next">';
        echo '<span class="nav-subtitle">次の記事</span>';
        echo '<span class="nav-title">' . get_the_title($next_post) . '</span>';
        echo '</a>';
        echo '</div>';
    }
    
    echo '</div>';
    echo '</nav>';
}

/**
 * パンくずリスト用のJSON-LD構造化データ
 */
function copipe_breadcrumb_schema() {
    if (is_home() || is_front_page()) {
        return;
    }
    
    $breadcrumbs = array();
    $breadcrumbs[] = array(
        '@type' => 'ListItem',
        'position' => 1,
        'item' => array(
            '@id' => home_url('/'),
            'name' => get_bloginfo('name')
        )
    );
    
    $position = 2;
    
    if (is_category()) {
        $cat = get_queried_object();
        $breadcrumbs[] = array(
            '@type' => 'ListItem',
            'position' => $position,
            'item' => array(
                '@id' => get_category_link($cat->term_id),
                'name' => $cat->name
            )
        );
    } elseif (is_single()) {
        $categories = get_the_category();
        if (!empty($categories)) {
            $cat = $categories[0];
            $breadcrumbs[] = array(
                '@type' => 'ListItem',
                'position' => $position++,
                'item' => array(
                    '@id' => get_category_link($cat->term_id),
                    'name' => $cat->name
                )
            );
        }
        
        $breadcrumbs[] = array(
            '@type' => 'ListItem',
            'position' => $position,
            'item' => array(
                '@id' => get_permalink(),
                'name' => get_the_title()
            )
        );
    }
    
    $schema = array(
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => $breadcrumbs
    );
    
    echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_UNICODE) . '</script>';
}

/**
 * 記事用のJSON-LD構造化データ
 */
function copipe_article_schema() {
    if (!is_single()) {
        return;
    }
    
    $schema = array(
        '@context' => 'https://schema.org',
        '@type' => 'Article',
        'headline' => get_the_title(),
        'description' => get_the_excerpt(),
        'datePublished' => get_the_date('c'),
        'dateModified' => get_the_modified_date('c'),
        'author' => array(
            '@type' => 'Person',
            'name' => get_the_author()
        ),
        'publisher' => array(
            '@type' => 'Organization',
            'name' => get_bloginfo('name'),
            'logo' => array(
                '@type' => 'ImageObject',
                'url' => get_template_directory_uri() . '/images/logo.png'
            )
        )
    );
    
    if (has_post_thumbnail()) {
        $schema['image'] = array(
            '@type' => 'ImageObject',
            'url' => get_the_post_thumbnail_url(get_the_ID(), 'large')
        );
    }
    
    echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_UNICODE) . '</script>';
}
?>