<?php
/**
 * WordPress カスタマイザー設定
 * copipe-theme_postpilot_v3
 */

/**
 * カスタマイザー設定を追加
 */
function copipe_customize_register($wp_customize) {
    
    // ========== サイト基本設定 ==========
    $wp_customize->add_section('copipe_site_settings', array(
        'title' => 'サイト基本設定',
        'priority' => 30,
    ));
    
    // サイトロゴ
    $wp_customize->add_setting('copipe_logo', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'copipe_logo', array(
        'label' => 'サイトロゴ',
        'section' => 'copipe_site_settings',
        'settings' => 'copipe_logo',
        'description' => 'ヘッダーに表示するロゴ画像',
    )));
    
    // ファビコン
    $wp_customize->add_setting('copipe_favicon', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'copipe_favicon', array(
        'label' => 'ファビコン',
        'section' => 'copipe_site_settings',
        'settings' => 'copipe_favicon',
        'description' => '32x32px の .ico または .png ファイル',
    )));
    
    // メタ説明文
    $wp_customize->add_setting('copipe_site_description', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));
    
    $wp_customize->add_control('copipe_site_description', array(
        'label' => 'サイト説明文',
        'section' => 'copipe_site_settings',
        'type' => 'textarea',
        'description' => 'SEO用のサイト説明文（160文字以内推奨）',
    ));
    
    // ========== ヘッダー設定 ==========
    $wp_customize->add_section('copipe_header_settings', array(
        'title' => 'ヘッダー設定',
        'priority' => 31,
    ));
    
    // ヘッダー固定
    $wp_customize->add_setting('copipe_sticky_header', array(
        'default' => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ));
    
    $wp_customize->add_control('copipe_sticky_header', array(
        'label' => 'ヘッダーを固定表示',
        'section' => 'copipe_header_settings',
        'type' => 'checkbox',
    ));
    
    // 検索ボックス表示
    $wp_customize->add_setting('copipe_header_search', array(
        'default' => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ));
    
    $wp_customize->add_control('copipe_header_search', array(
        'label' => 'ヘッダーに検索ボックスを表示',
        'section' => 'copipe_header_settings',
        'type' => 'checkbox',
    ));
    
    // ========== フッター設定 ==========
    $wp_customize->add_section('copipe_footer_settings', array(
        'title' => 'フッター設定',
        'priority' => 32,
    ));
    
    // コピーライト表示
    $wp_customize->add_setting('copipe_copyright_text', array(
        'default' => '© ' . date('Y') . ' ' . get_bloginfo('name'),
        'sanitize_callback' => 'sanitize_text_field',
    ));
    
    $wp_customize->add_control('copipe_copyright_text', array(
        'label' => 'コピーライト',
        'section' => 'copipe_footer_settings',
        'type' => 'text',
    ));
    
    // フッターロゴ
    $wp_customize->add_setting('copipe_footer_logo', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'copipe_footer_logo', array(
        'label' => 'フッターロゴ',
        'section' => 'copipe_footer_settings',
        'settings' => 'copipe_footer_logo',
    )));
    
    // ========== カラー設定 ==========
    $wp_customize->add_section('copipe_color_settings', array(
        'title' => 'カラー設定',
        'priority' => 33,
    ));
    
    // メインカラー
    $wp_customize->add_setting('copipe_main_color', array(
        'default' => '#2c3e50',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'copipe_main_color', array(
        'label' => 'メインカラー',
        'section' => 'copipe_color_settings',
        'settings' => 'copipe_main_color',
    )));
    
    // アクセントカラー
    $wp_customize->add_setting('copipe_accent_color', array(
        'default' => '#3498db',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'copipe_accent_color', array(
        'label' => 'アクセントカラー',
        'section' => 'copipe_color_settings',
        'settings' => 'copipe_accent_color',
    )));
    
    // リンクカラー
    $wp_customize->add_setting('copipe_link_color', array(
        'default' => '#3498db',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'copipe_link_color', array(
        'label' => 'リンクカラー',
        'section' => 'copipe_color_settings',
        'settings' => 'copipe_link_color',
    )));
    
    // ========== フォント設定 ==========
    $wp_customize->add_section('copipe_font_settings', array(
        'title' => 'フォント設定',
        'priority' => 34,
    ));
    
    // フォントファミリー
    $wp_customize->add_setting('copipe_font_family', array(
        'default' => 'noto-sans-jp',
        'sanitize_callback' => 'copipe_sanitize_select',
    ));
    
    $wp_customize->add_control('copipe_font_family', array(
        'label' => 'フォントファミリー',
        'section' => 'copipe_font_settings',
        'type' => 'select',
        'choices' => array(
            'noto-sans-jp' => 'Noto Sans JP',
            'hiragino' => 'ヒラギノ角ゴ',
            'meiryo' => 'メイリオ',
            'system' => 'システムフォント',
        ),
    ));
    
    // 本文フォントサイズ
    $wp_customize->add_setting('copipe_font_size', array(
        'default' => '16',
        'sanitize_callback' => 'absint',
    ));
    
    $wp_customize->add_control('copipe_font_size', array(
        'label' => '本文フォントサイズ (px)',
        'section' => 'copipe_font_settings',
        'type' => 'number',
        'input_attrs' => array(
            'min' => 12,
            'max' => 24,
            'step' => 1,
        ),
    ));
    
    // ========== ブログ設定 ==========
    $wp_customize->add_section('copipe_blog_settings', array(
        'title' => 'ブログ設定',
        'priority' => 35,
    ));
    
    // 記事一覧レイアウト
    $wp_customize->add_setting('copipe_blog_layout', array(
        'default' => 'list',
        'sanitize_callback' => 'copipe_sanitize_select',
    ));
    
    $wp_customize->add_control('copipe_blog_layout', array(
        'label' => '記事一覧レイアウト',
        'section' => 'copipe_blog_settings',
        'type' => 'select',
        'choices' => array(
            'list' => 'リスト表示',
            'grid' => 'グリッド表示',
            'card' => 'カード表示',
        ),
    ));
    
    // 記事抜粋文字数
    $wp_customize->add_setting('copipe_excerpt_length', array(
        'default' => 120,
        'sanitize_callback' => 'absint',
    ));
    
    $wp_customize->add_control('copipe_excerpt_length', array(
        'label' => '記事抜粋文字数',
        'section' => 'copipe_blog_settings',
        'type' => 'number',
        'input_attrs' => array(
            'min' => 50,
            'max' => 300,
            'step' => 10,
        ),
    ));
    
    // 関連記事表示
    $wp_customize->add_setting('copipe_show_related_posts', array(
        'default' => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ));
    
    $wp_customize->add_control('copipe_show_related_posts', array(
        'label' => '関連記事を表示',
        'section' => 'copipe_blog_settings',
        'type' => 'checkbox',
    ));
    
    // ========== SNS設定 ==========
    $wp_customize->add_section('copipe_sns_settings', array(
        'title' => 'SNS設定',
        'priority' => 36,
    ));
    
    // Twitter URL
    $wp_customize->add_setting('copipe_twitter_url', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('copipe_twitter_url', array(
        'label' => 'Twitter URL',
        'section' => 'copipe_sns_settings',
        'type' => 'url',
    ));
    
    // Facebook URL
    $wp_customize->add_setting('copipe_facebook_url', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('copipe_facebook_url', array(
        'label' => 'Facebook URL',
        'section' => 'copipe_sns_settings',
        'type' => 'url',
    ));
    
    // Instagram URL
    $wp_customize->add_setting('copipe_instagram_url', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('copipe_instagram_url', array(
        'label' => 'Instagram URL',
        'section' => 'copipe_sns_settings',
        'type' => 'url',
    ));
    
    // YouTube URL
    $wp_customize->add_setting('copipe_youtube_url', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('copipe_youtube_url', array(
        'label' => 'YouTube URL',
        'section' => 'copipe_sns_settings',
        'type' => 'url',
    ));
    
    // ========== PostPilot LP設定 ==========
    $wp_customize->add_section('copipe_postpilot_settings', array(
        'title' => 'PostPilot LP設定',
        'priority' => 37,
    ));
    
    // ヒーロー背景画像
    $wp_customize->add_setting('copipe_postpilot_hero_bg', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'copipe_postpilot_hero_bg', array(
        'label' => 'ヒーロー背景画像',
        'section' => 'copipe_postpilot_settings',
        'settings' => 'copipe_postpilot_hero_bg',
    )));
    
    // デモ動画URL
    $wp_customize->add_setting('copipe_postpilot_demo_video', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    
    $wp_customize->add_control('copipe_postpilot_demo_video', array(
        'label' => 'デモ動画URL (YouTube)',
        'section' => 'copipe_postpilot_settings',
        'type' => 'url',
        'description' => 'YouTubeの埋め込み用URL',
    ));
    
    // 特徴アイコン
    for ($i = 1; $i <= 3; $i++) {
        $wp_customize->add_setting("copipe_postpilot_feature_{$i}_icon", array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        ));
        
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, "copipe_postpilot_feature_{$i}_icon", array(
            'label' => "特徴 {$i} アイコン",
            'section' => 'copipe_postpilot_settings',
            'settings' => "copipe_postpilot_feature_{$i}_icon",
        )));
        
        $wp_customize->add_setting("copipe_postpilot_feature_{$i}_title", array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        
        $wp_customize->add_control("copipe_postpilot_feature_{$i}_title", array(
            'label' => "特徴 {$i} タイトル",
            'section' => 'copipe_postpilot_settings',
            'type' => 'text',
        ));
        
        $wp_customize->add_setting("copipe_postpilot_feature_{$i}_desc", array(
            'default' => '',
            'sanitize_callback' => 'sanitize_textarea_field',
        ));
        
        $wp_customize->add_control("copipe_postpilot_feature_{$i}_desc", array(
            'label' => "特徴 {$i} 説明",
            'section' => 'copipe_postpilot_settings',
            'type' => 'textarea',
        ));
    }
}
add_action('customize_register', 'copipe_customize_register');

/**
 * select用のサニタイズ関数
 */
function copipe_sanitize_select($input, $setting) {
    $input = sanitize_key($input);
    $choices = $setting->manager->get_control($setting->id)->choices;
    return (array_key_exists($input, $choices) ? $input : $setting->default);
}

/**
 * カスタマイザーCSS出力
 */
function copipe_customizer_css() {
    $main_color = get_theme_mod('copipe_main_color', '#2c3e50');
    $accent_color = get_theme_mod('copipe_accent_color', '#3498db');
    $link_color = get_theme_mod('copipe_link_color', '#3498db');
    $font_family = get_theme_mod('copipe_font_family', 'noto-sans-jp');
    $font_size = get_theme_mod('copipe_font_size', 16);
    
    // フォントファミリーの設定
    $font_stack = '';
    switch ($font_family) {
        case 'noto-sans-jp':
            $font_stack = '"Noto Sans JP", sans-serif';
            break;
        case 'hiragino':
            $font_stack = '"Hiragino Kaku Gothic ProN", "ヒラギノ角ゴ ProN W3", sans-serif';
            break;
        case 'meiryo':
            $font_stack = 'Meiryo, "メイリオ", sans-serif';
            break;
        case 'system':
            $font_stack = '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif';
            break;
    }
    
    ?>
    <style type="text/css">
        :root {
            --main-color: <?php echo esc_attr($main_color); ?>;
            --accent-color: <?php echo esc_attr($accent_color); ?>;
            --link-color: <?php echo esc_attr($link_color); ?>;
            --font-family: <?php echo $font_stack; ?>;
            --font-size: <?php echo absint($font_size); ?>px;
        }
        
        body {
            font-family: var(--font-family);
            font-size: var(--font-size);
        }
        
        .site-header {
            background-color: var(--main-color);
        }
        
        .btn-primary, .button-primary {
            background-color: var(--accent-color);
            border-color: var(--accent-color);
        }
        
        .btn-primary:hover, .button-primary:hover {
            background-color: color-mix(in srgb, var(--accent-color) 80%, black);
            border-color: color-mix(in srgb, var(--accent-color) 80%, black);
        }
        
        a {
            color: var(--link-color);
        }
        
        a:hover {
            color: color-mix(in srgb, var(--link-color) 80%, black);
        }
        
        .entry-meta a,
        .breadcrumb a {
            color: var(--main-color);
        }
        
        /* LP固有のスタイル */
        .postpilot-hero {
            background-image: url('<?php echo esc_url(get_theme_mod('copipe_postpilot_hero_bg')); ?>');
        }
        
        <?php if (get_theme_mod('copipe_sticky_header', true)): ?>
        .site-header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
        }
        
        .site-content {
            padding-top: 80px;
        }
        <?php endif; ?>
        
        <?php if (!get_theme_mod('copipe_header_search', true)): ?>
        .header-search {
            display: none;
        }
        <?php endif; ?>
    </style>
    <?php
}
add_action('wp_head', 'copipe_customizer_css');

/**
 * カスタマイザー用のGoogle Fonts読み込み
 */
function copipe_customizer_fonts() {
    $font_family = get_theme_mod('copipe_font_family', 'noto-sans-jp');
    
    if ($font_family === 'noto-sans-jp') {
        wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@300;400;500;700&display=swap', array(), null);
    }
}
add_action('wp_enqueue_scripts', 'copipe_customizer_fonts');
?>