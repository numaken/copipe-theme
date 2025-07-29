<?php
/**
 * Copipe Theme Customizer
 *
 * @package copipe-theme
 * @version 3.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 */
function copipe_customize_register($wp_customize) {



  // すでにある設定の下に以下を追加（admin-settings.php でやっていた内容）

  // 例：CTAセクションの追加
  $wp_customize->add_section('copipe_cta_section', array(
    'title' => __('CTAエリア設定', 'copipe'),
    'priority' => 130,
  ));

  $wp_customize->add_setting('copipe_cta_text', array(
    'default' => '',
    'sanitize_callback' => 'sanitize_text_field',
  ));

  $wp_customize->add_control('copipe_cta_text', array(
    'label' => __('CTAテキスト', 'copipe'),
    'section' => 'copipe_cta_section',
    'type' => 'text',
  ));






    // Set transport method for built-in controls
    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport = 'postMessage';
    $wp_customize->get_setting('header_textcolor')->transport = 'postMessage';

    // Remove sections we don't need
    $wp_customize->remove_section('colors');
    $wp_customize->remove_section('background_image');

    /*
     * Theme Colors Section
     */
    $wp_customize->add_section('copipe_colors', array(
        'title' => __('テーマカラー', 'copipe-theme'),
        'priority' => 40,
        'description' => __('テーマの基本カラーを設定できます。', 'copipe-theme'),
    ));

    // Primary Color
    $wp_customize->add_setting('copipe_primary_color', array(
        'default' => '#2c5aa0',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'copipe_primary_color', array(
        'label' => __('プライマリーカラー', 'copipe-theme'),
        'description' => __('サイトのメインカラーです。', 'copipe-theme'),
        'section' => 'copipe_colors',
        'settings' => 'copipe_primary_color',
    )));

    // Secondary Color
    $wp_customize->add_setting('copipe_secondary_color', array(
        'default' => '#ff6b35',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'copipe_secondary_color', array(
        'label' => __('セカンダリーカラー', 'copipe-theme'),
        'description' => __('アクセントカラーです。', 'copipe-theme'),
        'section' => 'copipe_colors',
        'settings' => 'copipe_secondary_color',
    )));

    // Text Color
    $wp_customize->add_setting('copipe_text_color', array(
        'default' => '#333333',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'copipe_text_color', array(
        'label' => __('テキストカラー', 'copipe-theme'),
        'description' => __('本文のテキストカラーです。', 'copipe-theme'),
        'section' => 'copipe_colors',
        'settings' => 'copipe_text_color',
    )));

    /*
     * Layout Section
     */
    $wp_customize->add_section('copipe_layout', array(
        'title' => __('レイアウト設定', 'copipe-theme'),
        'priority' => 50,
        'description' => __('サイトのレイアウトを設定できます。', 'copipe-theme'),
    ));

    // Container Width
    $wp_customize->add_setting('copipe_container_width', array(
        'default' => '1200',
        'sanitize_callback' => 'absint',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control('copipe_container_width', array(
        'label' => __('コンテナ幅', 'copipe-theme'),
        'description' => __('サイトの最大幅をピクセル単位で設定します。', 'copipe-theme'),
        'section' => 'copipe_layout',
        'type' => 'number',
        'input_attrs' => array(
            'min' => 800,
            'max' => 1400,
            'step' => 50,
        ),
    ));

    // Sidebar Position
    $wp_customize->add_setting('copipe_sidebar_position', array(
        'default' => 'right',
        'sanitize_callback' => 'copipe_sanitize_sidebar_position',
        'transport' => 'refresh',
    ));

    $wp_customize->add_control('copipe_sidebar_position', array(
        'label' => __('サイドバーの位置', 'copipe-theme'),
        'description' => __('サイドバーの表示位置を選択します。', 'copipe-theme'),
        'section' => 'copipe_layout',
        'type' => 'radio',
        'choices' => array(
            'left' => __('左側', 'copipe-theme'),
            'right' => __('右側', 'copipe-theme'),
            'none' => __('非表示', 'copipe-theme'),
        ),
    ));

    /*
     * Typography Section
     */
    $wp_customize->add_section('copipe_typography', array(
        'title' => __('タイポグラフィ', 'copipe-theme'),
        'priority' => 60,
        'description' => __('フォントの設定を行います。', 'copipe-theme'),
    ));

    // Google Fonts
    $wp_customize->add_setting('copipe_google_fonts', array(
        'default' => 'noto_sans_jp',
        'sanitize_callback' => 'copipe_sanitize_google_fonts',
        'transport' => 'refresh',
    ));

    $wp_customize->add_control('copipe_google_fonts', array(
        'label' => __('Google Fonts', 'copipe-theme'),
        'description' => __('使用するGoogle Fontsを選択します。', 'copipe-theme'),
        'section' => 'copipe_typography',
        'type' => 'select',
        'choices' => copipe_get_google_fonts_choices(),
    ));

    // Base Font Size
    $wp_customize->add_setting('copipe_base_font_size', array(
        'default' => '16',
        'sanitize_callback' => 'absint',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control('copipe_base_font_size', array(
        'label' => __('基本フォントサイズ', 'copipe-theme'),
        'description' => __('基本のフォントサイズをピクセル単位で設定します。', 'copipe-theme'),
        'section' => 'copipe_typography',
        'type' => 'range',
        'input_attrs' => array(
            'min' => 12,
            'max' => 20,
            'step' => 1,
        ),
    ));

    // Line Height
    $wp_customize->add_setting('copipe_line_height', array(
        'default' => '1.8',
        'sanitize_callback' => 'copipe_sanitize_line_height',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control('copipe_line_height', array(
        'label' => __('行間', 'copipe-theme'),
        'description' => __('テキストの行間を設定します。', 'copipe-theme'),
        'section' => 'copipe_typography',
        'type' => 'select',
        'choices' => array(
            '1.4' => '1.4',
            '1.5' => '1.5',
            '1.6' => '1.6',
            '1.7' => '1.7',
            '1.8' => '1.8',
            '1.9' => '1.9',
            '2.0' => '2.0',
        ),
    ));

    /*
     * PostPilot LP Section
     */
    $wp_customize->add_section('copipe_postpilot', array(
        'title' => __('PostPilot LP設定', 'copipe-theme'),
        'priority' => 70,
        'description' => __('PostPilot LPページの設定を行います。', 'copipe-theme'),
    ));

    // LINE URL
    $wp_customize->add_setting('copipe_line_url', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport' => 'refresh',
    ));

    $wp_customize->add_control('copipe_line_url', array(
        'label' => __('LINE公式アカウントURL', 'copipe-theme'),
        'description' => __('LINE公式アカウントのURLを入力してください。', 'copipe-theme'),
        'section' => 'copipe_postpilot',
        'type' => 'url',
    ));

    // Hero Title
    $wp_customize->add_setting('copipe_hero_title', array(
        'default' => 'AI時代の最強ライティングツール PostPilot',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control('copipe_hero_title', array(
        'label' => __('ヒーロータイトル', 'copipe-theme'),
        'description' => __('LPのメインタイトルを設定します。', 'copipe-theme'),
        'section' => 'copipe_postpilot',
        'type' => 'text',
    ));

    // Hero Subtitle
    $wp_customize->add_setting('copipe_hero_subtitle', array(
        'default' => 'わずか3分で高品質な記事を自動生成 SEO対策も完璧、収益化まで一気通貫',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control('copipe_hero_subtitle', array(
        'label' => __('ヒーローサブタイトル', 'copipe-theme'),
        'description' => __('LPのサブタイトルを設定します。', 'copipe-theme'),
        'section' => 'copipe_postpilot',
        'type' => 'textarea',
    ));

    /*
     * Social Media Section
     */
    $wp_customize->add_section('copipe_social', array(
        'title' => __('ソーシャルメディア', 'copipe-theme'),
        'priority' => 80,
        'description' => __('ソーシャルメディアのリンクを設定します。', 'copipe-theme'),
    ));

    // Twitter URL
    $wp_customize->add_setting('copipe_twitter_url', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control('copipe_twitter_url', array(
        'label' => __('Twitter URL', 'copipe-theme'),
        'section' => 'copipe_social',
        'type' => 'url',
    ));

    // Facebook URL
    $wp_customize->add_setting('copipe_facebook_url', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control('copipe_facebook_url', array(
        'label' => __('Facebook URL', 'copipe-theme'),
        'section' => 'copipe_social',
        'type' => 'url',
    ));

    // YouTube URL
    $wp_customize->add_setting('copipe_youtube_url', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control('copipe_youtube_url', array(
        'label' => __('YouTube URL', 'copipe-theme'),
        'section' => 'copipe_social',
        'type' => 'url',
    ));

    // Instagram URL
    $wp_customize->add_setting('copipe_instagram_url', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control('copipe_instagram_url', array(
        'label' => __('Instagram URL', 'copipe-theme'),
        'section' => 'copipe_social',
        'type' => 'url',
    ));

    /*
     * Performance Section
     */
    $wp_customize->add_section('copipe_performance', array(
        'title' => __('パフォーマンス', 'copipe-theme'),
        'priority' => 90,
        'description' => __('サイトのパフォーマンス設定を行います。', 'copipe-theme'),
    ));

    // Enable Lazy Loading
    $wp_customize->add_setting('copipe_lazy_loading', array(
        'default' => true,
        'sanitize_callback' => 'copipe_sanitize_checkbox',
    ));

    $wp_customize->add_control('copipe_lazy_loading', array(
        'label' => __('遅延読み込みを有効にする', 'copipe-theme'),
        'description' => __('画像の遅延読み込みを有効にしてページ速度を向上させます。', 'copipe-theme'),
        'section' => 'copipe_performance',
        'type' => 'checkbox',
    ));

    // Minify CSS
    $wp_customize->add_setting('copipe_minify_css', array(
        'default' => false,
        'sanitize_callback' => 'copipe_sanitize_checkbox',
    ));

    $wp_customize->add_control('copipe_minify_css', array(
        'label' => __('CSS圧縮を有効にする', 'copipe-theme'),
        'description' => __('CSSファイルを圧縮してファイルサイズを削減します。', 'copipe-theme'),
        'section' => 'copipe_performance',
        'type' => 'checkbox',
    ));

    // Enable WebP Support
    $wp_customize->add_setting('copipe_webp_support', array(
        'default' => false,
        'sanitize_callback' => 'copipe_sanitize_checkbox',
    ));

    $wp_customize->add_control('copipe_webp_support', array(
        'label' => __('WebP画像サポート', 'copipe-theme'),
        'description' => __('WebP形式の画像サポートを有効にします。', 'copipe-theme'),
        'section' => 'copipe_performance',
        'type' => 'checkbox',
    ));

    /*
     * Footer Section
     */
    $wp_customize->add_section('copipe_footer', array(
        'title' => __('フッター設定', 'copipe-theme'),
        'priority' => 100,
        'description' => __('フッターの設定を行います。', 'copipe-theme'),
    ));

    // Copyright Text
    $wp_customize->add_setting('copipe_copyright_text', array(
        'default' => '© 2025 Numaken. All rights reserved.',
        'sanitize_callback' => 'sanitize_text_field',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control('copipe_copyright_text', array(
        'label' => __('コピーライト', 'copipe-theme'),
        'description' => __('フッターに表示するコピーライトテキストを設定します。', 'copipe-theme'),
        'section' => 'copipe_footer',
        'type' => 'text',
    ));

    // Footer Background Color
    $wp_customize->add_setting('copipe_footer_bg_color', array(
        'default' => '#333333',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'copipe_footer_bg_color', array(
        'label' => __('フッター背景色', 'copipe-theme'),
        'description' => __('フッターの背景色を設定します。', 'copipe-theme'),
        'section' => 'copipe_footer',
        'settings' => 'copipe_footer_bg_color',
    )));

    // Show Footer Social Icons
    $wp_customize->add_setting('copipe_show_footer_social', array(
        'default' => true,
        'sanitize_callback' => 'copipe_sanitize_checkbox',
    ));

    $wp_customize->add_control('copipe_show_footer_social', array(
        'label' => __('フッターにソーシャルアイコンを表示', 'copipe-theme'),
        'description' => __('フッターにソーシャルメディアのアイコンを表示します。', 'copipe-theme'),
        'section' => 'copipe_footer',
        'type' => 'checkbox',
    ));

    /*
     * Custom CSS Section
     */
    $wp_customize->add_section('copipe_custom_css', array(
        'title' => __('カスタムCSS', 'copipe-theme'),
        'priority' => 200,
        'description' => __('追加のCSSスタイルを記述できます。', 'copipe-theme'),
    ));

    $wp_customize->add_setting('copipe_custom_css', array(
        'default' => '',
        'sanitize_callback' => 'copipe_sanitize_css',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control('copipe_custom_css', array(
        'label' => __('追加CSS', 'copipe-theme'),
        'description' => __('カスタムCSSを追加できます。', 'copipe-theme'),
        'section' => 'copipe_custom_css',
        'type' => 'textarea',
        'input_attrs' => array(
            'placeholder' => '/* ここにCSSを記述してください */',
            'rows' => 10,
        ),
    ));
}
add_action('customize_register', 'copipe_customize_register');

/**
 * Render the site title for the selective refresh partial.
 */
function copipe_customize_partial_blogname() {
    bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 */
function copipe_customize_partial_blogdescription() {
    bloginfo('description');
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function copipe_customize_preview_js() {
    wp_enqueue_script('copipe-customizer', COPIPE_THEME_URL . '/js/customizer.js', array('customize-preview'), COPIPE_THEME_VERSION, true);
}
add_action('customize_preview_init', 'copipe_customize_preview_js');

/**
 * Sanitization Functions
 */

/**
 * Sanitize checkbox values
 */
function copipe_sanitize_checkbox($checked) {
    return ((isset($checked) && true == $checked) ? true : false);
}

/**
 * Sanitize sidebar position
 */
function copipe_sanitize_sidebar_position($input) {
    $valid = array('left', 'right', 'none');
    return (in_array($input, $valid)) ? $input : 'right';
}

/**
 * Sanitize Google Fonts
 */
function copipe_sanitize_google_fonts($input) {
    $valid = array_keys(copipe_get_google_fonts_choices());
    return (in_array($input, $valid)) ? $input : 'noto_sans_jp';
}

/**
 * Sanitize line height
 */
function copipe_sanitize_line_height($input) {
    $valid = array('1.4', '1.5', '1.6', '1.7', '1.8', '1.9', '2.0');
    return (in_array($input, $valid)) ? $input : '1.8';
}

/**
 * Sanitize CSS
 */
function copipe_sanitize_css($css) {
    return wp_strip_all_tags($css);
}

/**
 * Get Google Fonts choices
 */
function copipe_get_google_fonts_choices() {
    return array(
        'noto_sans_jp' => 'Noto Sans JP',
        'inter' => 'Inter',
        'roboto' => 'Roboto',
        'open_sans' => 'Open Sans',
        'lato' => 'Lato',
        'source_sans_pro' => 'Source Sans Pro',
        'montserrat' => 'Montserrat',
        'poppins' => 'Poppins',
        'nunito' => 'Nunito',
        'raleway' => 'Raleway',
    );
}

/**
 * Generate CSS variables for customizer settings
 */
function copipe_customizer_css_variables() {
    $primary_color = get_theme_mod('copipe_primary_color', '#2c5aa0');
    $secondary_color = get_theme_mod('copipe_secondary_color', '#ff6b35');
    $text_color = get_theme_mod('copipe_text_color', '#333333');
    $container_width = get_theme_mod('copipe_container_width', '1200');
    $base_font_size = get_theme_mod('copipe_base_font_size', '16');
    $line_height = get_theme_mod('copipe_line_height', '1.8');
    $footer_bg_color = get_theme_mod('copipe_footer_bg_color', '#333333');
    $custom_css = get_theme_mod('copipe_custom_css', '');

    $css = ":root {
        --copipe-primary-color: {$primary_color};
        --copipe-secondary-color: {$secondary_color};
        --copipe-text-color: {$text_color};
        --copipe-container-width: {$container_width}px;
        --copipe-base-font-size: {$base_font_size}px;
        --copipe-line-height: {$line_height};
        --copipe-footer-bg-color: {$footer_bg_color};
    }";

    // Apply CSS variables
    $css .= "
    .container {
        max-width: var(--copipe-container-width);
    }
    
    body {
        font-size: var(--copipe-base-font-size);
        line-height: var(--copipe-line-height);
        color: var(--copipe-text-color);
    }
    
    .site-footer {
        background-color: var(--copipe-footer-bg-color);
    }
    
    /* Primary Color Applications */
    .site-title a,
    .entry-title,
    .entry-title a,
    .category-title,
    .search-title,
    .comments-title,
    .widget-title {
        color: var(--copipe-primary-color);
    }
    
    .btn,
    .read-more-btn,
    .nav-previous a,
    .nav-next a,
    .search-submit,
    .submit-button {
        background-color: var(--copipe-primary-color);
    }
    
    /* Secondary Color Applications */
    .hero-cta,
    .dl-cta,
    .cta-button {
        background: linear-gradient(135deg, var(--copipe-secondary-color), #ffa726);
    }
    
    .highlight,
    .search-highlight {
        background-color: var(--copipe-secondary-color);
    }";

    // Add custom CSS
    if (!empty($custom_css)) {
        $css .= "\n/* Custom CSS */\n" . $custom_css;
    }

    return $css;
}

/**
 * Output customizer CSS
 */
function copipe_customizer_css() {
    ?>
    <style type="text/css" id="copipe-customizer-css">
        <?php echo copipe_customizer_css_variables(); ?>
    </style>
    <?php
}
add_action('wp_head', 'copipe_customizer_css');

/**
 * Add Google Fonts
 */
function copipe_add_google_fonts() {
    $google_font = get_theme_mod('copipe_google_fonts', 'noto_sans_jp');
    
    $font_urls = array(
        'noto_sans_jp' => 'https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;500;700&display=swap',
        'inter' => 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap',
        'roboto' => 'https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap',
        'open_sans' => 'https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap',
        'lato' => 'https://fonts.googleapis.com/css2?family=Lato:wght@400;700;900&display=swap',
        'source_sans_pro' => 'https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@400;600;700&display=swap',
        'montserrat' => 'https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap',
        'poppins' => 'https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap',
        'nunito' => 'https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap',
        'raleway' => 'https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600;700&display=swap',
    );
    
    if (isset($font_urls[$google_font])) {
        wp_enqueue_style('copipe-google-fonts', $font_urls[$google_font], array(), null);
    }
}
add_action('wp_enqueue_scripts', 'copipe_add_google_fonts');

/**
 * Add selective refresh support for customizer
 */
function copipe_customize_selective_refresh($wp_customize) {
    // Check if selective refresh is available
    if (!isset($wp_customize->selective_refresh)) {
        return;
    }

    // Add partial for site title
    $wp_customize->selective_refresh->add_partial('blogname', array(
        'selector' => '.site-title a',
        'render_callback' => 'copipe_customize_partial_blogname',
    ));

    // Add partial for site description
    $wp_customize->selective_refresh->add_partial('blogdescription', array(
        'selector' => '.site-description',
        'render_callback' => 'copipe_customize_partial_blogdescription',
    ));

    // Add partial for hero title
    $wp_customize->selective_refresh->add_partial('copipe_hero_title', array(
        'selector' => '.hero-title',
        'render_callback' => function() {
            return get_theme_mod('copipe_hero_title', 'AI時代の最強ライティングツール PostPilot');
        },
    ));

    // Add partial for copyright text
    $wp_customize->selective_refresh->add_partial('copipe_copyright_text', array(
        'selector' => '.copyright',
        'render_callback' => function() {
            return get_theme_mod('copipe_copyright_text', '© 2025 Numaken. All rights reserved.');
        },
    ));
}
add_action('customize_register', 'copipe_customize_selective_refresh');

/**
 * Enqueue customizer controls scripts
 */
function copipe_customize_controls_js() {
    wp_enqueue_script(
        'copipe-customizer-controls',
        COPIPE_THEME_URL . '/js/customizer-controls.js',
        array('customize-controls'),
        COPIPE_THEME_VERSION,
        true
    );
    
    wp_localize_script('copipe-customizer-controls', 'copipeCustomizer', array(
        'preview_url' => home_url('/'),
        'postpilot_url' => home_url('/postpilot/'),
    ));
}
add_action('customize_controls_enqueue_scripts', 'copipe_customize_controls_js');

/**
 * Add custom CSS classes based on customizer settings
 */
function copipe_body_classes($classes) {
    $sidebar_position = get_theme_mod('copipe_sidebar_position', 'right');
    $google_font = get_theme_mod('copipe_google_fonts', 'noto_sans_jp');
    
    // Add sidebar position class
    $classes[] = 'sidebar-' . $sidebar_position;
    
    // Add font class
    $classes[] = 'font-' . str_replace('_', '-', $google_font);
    
    // Add performance classes
    if (get_theme_mod('copipe_lazy_loading', true)) {
        $classes[] = 'lazy-loading-enabled';
    }
    
    if (get_theme_mod('copipe_webp_support', false)) {
        $classes[] = 'webp-support';
    }
    
    return $classes;
}
add_filter('body_class', 'copipe_body_classes');

/**
 * Get theme customization URL for admin
 */
function copipe_get_customizer_url($section = '') {
    $url = admin_url('customize.php');
    
    if (!empty($section)) {
        $url = add_query_arg('autofocus[section]', $section, $url);
    }
    
    return $url;
}

/**
 * Add customizer quick links to admin bar
 */
function copipe_admin_bar_customize_menu($wp_admin_bar) {
    if (!is_admin() && current_user_can('customize')) {
        $wp_admin_bar->add_menu(array(
            'id' => 'copipe-customize',
            'title' => 'テーマ設定',
            'href' => copipe_get_customizer_url(),
            'meta' => array(
                'class' => 'copipe-customize-link',
            ),
        ));
        
        // Add sub-menus for common sections
        $wp_admin_bar->add_menu(array(
            'parent' => 'copipe-customize',
            'id' => 'copipe-customize-colors',
            'title' => 'カラー設定',
            'href' => copipe_get_customizer_url('copipe_colors'),
        ));
        
        $wp_admin_bar->add_menu(array(
            'parent' => 'copipe-customize',
            'id' => 'copipe-customize-postpilot',
            'title' => 'PostPilot設定',
            'href' => copipe_get_customizer_url('copipe_postpilot'),
        ));
    }
}
add_action('admin_bar_menu', 'copipe_admin_bar_customize_menu', 999);
?>