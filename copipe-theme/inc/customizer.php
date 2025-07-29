<?php
/**
 * inc/customizer.php
 * WordPress カスタマイザー設定
 * 
 * @package Copipe_Theme
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * カスタマイザーの設定
 */
function copipe_customize_register($wp_customize) {
    
    // カスタムコントロールの読み込み
    require_once get_template_directory() . '/inc/customizer-controls.php';
    
    //--------------------------------------------------
    // サイト基本設定
    //--------------------------------------------------
    $wp_customize->add_section('copipe_site_settings', [
        'title' => __('サイト基本設定', 'copipe-theme'),
        'priority' => 30,
        'description' => __('サイトの基本的な設定を行います。', 'copipe-theme')
    ]);
    
    // サイトロゴ
    $wp_customize->add_setting('copipe_logo', [
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport' => 'refresh'
    ]);
    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'copipe_logo', [
        'label' => __('サイトロゴ', 'copipe-theme'),
        'description' => __('ヘッダーに表示するロゴ画像をアップロードしてください。推奨サイズ: 200x60px', 'copipe-theme'),
        'section' => 'copipe_site_settings',
        'settings' => 'copipe_logo'
    ]));
    
    // ファビコン
    $wp_customize->add_setting('copipe_favicon', [
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    ]);
    
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'copipe_favicon', [
        'label' => __('ファビコン', 'copipe-theme'),
        'description' => __('ブラウザタブに表示されるアイコン。推奨サイズ: 32x32px', 'copipe-theme'),
        'section' => 'copipe_site_settings',
        'settings' => 'copipe_favicon'
    ]));
    
    // サイトの説明文（カスタム）
    $wp_customize->add_setting('copipe_site_description', [
        'default' => '',
        'sanitize_callback' => 'sanitize_textarea_field'
    ]);
    
    $wp_customize->add_control('copipe_site_description', [
        'label' => __('サイト詳細説明', 'copipe-theme'),
        'description' => __('SEOやAboutページで使用される詳細な説明文', 'copipe-theme'),
        'section' => 'copipe_site_settings',
        'type' => 'textarea'
    ]);
    
    //--------------------------------------------------
    // ヘッダー設定
    //--------------------------------------------------
    $wp_customize->add_section('copipe_header_settings', [
        'title' => __('ヘッダー設定', 'copipe-theme'),
        'priority' => 40
    ]);
    
    // ヘッダーレイアウト
    $wp_customize->add_setting('copipe_header_layout', [
        'default' => 'default',
        'sanitize_callback' => 'copipe_sanitize_select'
    ]);
    
    $wp_customize->add_control('copipe_header_layout', [
        'label' => __('ヘッダーレイアウト', 'copipe-theme'),
        'section' => 'copipe_header_settings',
        'type' => 'select',
        'choices' => [
            'default' => __('デフォルト', 'copipe-theme'),
            'centered' => __('中央寄せ', 'copipe-theme'),
            'minimal' => __('ミニマル', 'copipe-theme')
        ]
    ]);
    
    // ヘッダー固定
    $wp_customize->add_setting('copipe_header_sticky', [
        'default' => true,
        'sanitize_callback' => 'wp_validate_boolean'
    ]);
    
    $wp_customize->add_control('copipe_header_sticky', [
        'label' => __('ヘッダーを固定', 'copipe-theme'),
        'description' => __('スクロール時にヘッダーを画面上部に固定します', 'copipe-theme'),
        'section' => 'copipe_header_settings',
        'type' => 'checkbox'
    ]);
    
    // 検索ボタン表示
    $wp_customize->add_setting('copipe_show_search_button', [
        'default' => true,
        'sanitize_callback' => 'wp_validate_boolean'
    ]);
    
    $wp_customize->add_control('copipe_show_search_button', [
        'label' => __('検索ボタンを表示', 'copipe-theme'),
        'section' => 'copipe_header_settings',
        'type' => 'checkbox'
    ]);
    
    //--------------------------------------------------
    // カラー設定
    //--------------------------------------------------
    $wp_customize->add_section('copipe_colors', [
        'title' => __('カラー設定', 'copipe-theme'),
        'priority' => 50
    ]);
    
    // プライマリカラー
    $wp_customize->add_setting('copipe_primary_color', [
        'default' => '#1e87f0',
        'sanitize_callback' => 'sanitize_hex_color'
    ]);
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'copipe_primary_color', [
        'label' => __('プライマリカラー', 'copipe-theme'),
        'description' => __('サイトのメインカラーです', 'copipe-theme'),
        'section' => 'copipe_colors'
    ]));
    
    // セカンダリカラー
    $wp_customize->add_setting('copipe_secondary_color', [
        'default' => '#32d296',
        'sanitize_callback' => 'sanitize_hex_color'
    ]);
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'copipe_secondary_color', [
        'label' => __('セカンダリカラー', 'copipe-theme'),
        'section' => 'copipe_colors'
    ]));
    
    // アクセントカラー
    $wp_customize->add_setting('copipe_accent_color', [
        'default' => '#faa05a',
        'sanitize_callback' => 'sanitize_hex_color'
    ]);
    
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'copipe_accent_color', [
        'label' => __('アクセントカラー', 'copipe-theme'),
        'section' => 'copipe_colors'
    ]));
    
    //--------------------------------------------------
    // タイポグラフィ設定
    //--------------------------------------------------
    $wp_customize->add_section('copipe_typography', [
        'title' => __('タイポグラフィ', 'copipe-theme'),
        'priority' => 60
    ]);
    
    // メインフォント
    $wp_customize->add_setting('copipe_body_font', [
        'default' => 'noto-sans-jp',
        'sanitize_callback' => 'copipe_sanitize_select'
    ]);
    
    $wp_customize->add_control('copipe_body_font', [
        'label' => __('本文フォント', 'copipe-theme'),
        'section' => 'copipe_typography',
        'type' => 'select',
        'choices' => [
            'noto-sans-jp' => 'Noto Sans JP',
            'hiragino' => 'ヒラギノ角ゴシック',
            'meiryo' => 'メイリオ',
            'yu-gothic' => '游ゴシック',
            'system' => 'システムフォント'
        ]
    ]);
    
    // 見出しフォント
    $wp_customize->add_setting('copipe_heading_font', [
        'default' => 'noto-sans-jp',
        'sanitize_callback' => 'copipe_sanitize_select'
    ]);
    
    $wp_customize->add_control('copipe_heading_font', [
        'label' => __('見出しフォント', 'copipe-theme'),
        'section' => 'copipe_typography',
        'type' => 'select',
        'choices' => [
            'noto-sans-jp' => 'Noto Sans JP',
            'hiragino' => 'ヒラギノ角ゴシック',
            'meiryo' => 'メイリオ',
            'yu-gothic' => '游ゴシック',
            'system' => 'システムフォント'
        ]
    ]);
    
    // フォントサイズ
    $wp_customize->add_setting('copipe_font_size', [
        'default' => '16',
        'sanitize_callback' => 'absint'
    ]);
    
    $wp_customize->add_control('copipe_font_size', [
        'label' => __('基本フォントサイズ', 'copipe-theme'),
        'description' => __('px単位（14-20推奨）', 'copipe-theme'),
        'section' => 'copipe_typography',
        'type' => 'number',
        'input_attrs' => [
            'min' => 12,
            'max' => 24,
            'step' => 1
        ]
    ]);
    
    //--------------------------------------------------
    // レイアウト設定
    //--------------------------------------------------
    $wp_customize->add_section('copipe_layout', [
        'title' => __('レイアウト設定', 'copipe-theme'),
        'priority' => 70
    ]);
    
    // コンテナ幅
    $wp_customize->add_setting('copipe_container_width', [
        'default' => '1200',
        'sanitize_callback' => 'absint'
    ]);
    
    $wp_customize->add_control('copipe_container_width', [
        'label' => __('コンテナ最大幅', 'copipe-theme'),
        'description' => __('px単位（1000-1400推奨）', 'copipe-theme'),
        'section' => 'copipe_layout',
        'type' => 'number',
        'input_attrs' => [
            'min' => 800,
            'max' => 1600,
            'step' => 50
        ]
    ]);
    
    // サイドバー表示
    $wp_customize->add_setting('copipe_show_sidebar', [
        'default' => false,
        'sanitize_callback' => 'wp_validate_boolean'
    ]);
    
    $wp_customize->add_control('copipe_show_sidebar', [
        'label' => __('サイドバーを表示', 'copipe-theme'),
        'section' => 'copipe_layout',
        'type' => 'checkbox'
    ]);
    
    // アーカイブレイアウト
    $wp_customize->add_setting('copipe_archive_layout', [
        'default' => 'grid',
        'sanitize_callback' => 'copipe_sanitize_select'
    ]);
    
    $wp_customize->add_control('copipe_archive_layout', [
        'label' => __('アーカイブレイアウト', 'copipe-theme'),
        'section' => 'copipe_layout',
        'type' => 'radio',
        'choices' => [
            'grid' => __('グリッド表示', 'copipe-theme'),
            'list' => __('リスト表示', 'copipe-theme'),
            'masonry' => __('マソンリー表示', 'copipe-theme')
        ]
    ]);
    
    //--------------------------------------------------
    // コード表示設定
    //--------------------------------------------------
    $wp_customize->add_section('copipe_code_settings', [
        'title' => __('コード表示設定', 'copipe-theme'),
        'priority' => 80
    ]);
    
    // コードテーマ
    $wp_customize->add_setting('copipe_code_theme', [
        'default' => 'tomorrow-night',
        'sanitize_callback' => 'copipe_sanitize_select'
    ]);
    
    $wp_customize->add_control('copipe_code_theme', [
        'label' => __('コードテーマ', 'copipe-theme'),
        'section' => 'copipe_code_settings',
        'type' => 'select',
        'choices' => [
            'default' => __('デフォルト', 'copipe-theme'),
            'tomorrow-night' => __('Tomorrow Night', 'copipe-theme'),
            'dracula' => __('Dracula', 'copipe-theme'),
            'monokai' => __('Monokai', 'copipe-theme'),
            'github' => __('GitHub', 'copipe-theme')
        ]
    ]);
    
    // 行番号表示
    $wp_customize->add_setting('copipe_show_line_numbers', [
        'default' => true,
        'sanitize_callback' => 'wp_validate_boolean'
    ]);
    
    $wp_customize->add_control('copipe_show_line_numbers', [
        'label' => __('行番号を表示', 'copipe-theme'),
        'section' => 'copipe_code_settings',
        'type' => 'checkbox'
    ]);
    
    // コピーボタン表示
    $wp_customize->add_setting('copipe_show_copy_button', [
        'default' => true,
        'sanitize_callback' => 'wp_validate_boolean'
    ]);
    
    $wp_customize->add_control('copipe_show_copy_button', [
        'label' => __('コピーボタンを表示', 'copipe-theme'),
        'section' => 'copipe_code_settings',
        'type' => 'checkbox'
    ]);
    
    //--------------------------------------------------
    // フッター設定
    //--------------------------------------------------
    $wp_customize->add_section('copipe_footer_settings', [
        'title' => __('フッター設定', 'copipe-theme'),
        'priority' => 90
    ]);
    
    // フッターテキスト
    $wp_customize->add_setting('copipe_footer_text', [
        'default' => '',
        'sanitize_callback' => 'wp_kses_post'
    ]);
    
    $wp_customize->add_control('copipe_footer_text', [
        'label' => __('フッターテキスト', 'copipe-theme'),
        'description' => __('コピーライト表示をカスタマイズできます', 'copipe-theme'),
        'section' => 'copipe_footer_settings',
        'type' => 'textarea'
    ]);
    
    // ソーシャルリンク
    $social_networks = [
        'twitter' => 'Twitter',
        'facebook' => 'Facebook',
        'instagram' => 'Instagram',
        'youtube' => 'YouTube',
        'github' => 'GitHub',
        'linkedin' => 'LinkedIn'
    ];
    
    foreach ($social_networks as $network => $label) {
        $wp_customize->add_setting("copipe_social_{$network}", [
            'default' => '',
            'sanitize_callback' => 'esc_url_raw'
        ]);
        
        $wp_customize->add_control("copipe_social_{$network}", [
            'label' => $label . ' URL',
            'section' => 'copipe_footer_settings',
            'type' => 'url'
        ]);
    }
    
    //--------------------------------------------------
    // 高度な設定
    //--------------------------------------------------
    $wp_customize->add_section('copipe_advanced_settings', [
        'title' => __('高度な設定', 'copipe-theme'),
        'priority' => 100
    ]);
    
    // カスタムCSS
    $wp_customize->add_setting('copipe_custom_css', [
        'default' => '',
        'sanitize_callback' => 'wp_strip_all_tags'
    ]);
    
    $wp_customize->add_control('copipe_custom_css', [
        'label' => __('カスタムCSS', 'copipe-theme'),
        'description' => __('追加のCSSコードを記述できます', 'copipe-theme'),
        'section' => 'copipe_advanced_settings',
        'type' => 'textarea'
    ]);
    
    // カスタムJavaScript
    $wp_customize->add_setting('copipe_custom_js', [
        'default' => '',
        'sanitize_callback' => 'wp_strip_all_tags'
    ]);
    
    $wp_customize->add_control('copipe_custom_js', [
        'label' => __('カスタムJavaScript', 'copipe-theme'),
        'description' => __('追加のJavaScriptコードを記述できます', 'copipe-theme'),
        'section' => 'copipe_advanced_settings',
        'type' => 'textarea'
    ]);
    
    // Google Analytics
    $wp_customize->add_setting('copipe_google_analytics', [
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ]);
    
    $wp_customize->add_control('copipe_google_analytics', [
        'label' => __('Google Analytics ID', 'copipe-theme'),
        'description' => __('GA4の測定ID（G-XXXXXXXXXX）', 'copipe-theme'),
        'section' => 'copipe_advanced_settings',
        'type' => 'text'
    ]);
}
add_action('customize_register', 'copipe_customize_register');

/**
 * カスタマイザーのサニタイズ関数
 */
function copipe_sanitize_select($input, $setting) {
    $input = sanitize_key($input);
    $choices = $setting->manager->get_control($setting->id)->choices;
    return (array_key_exists($input, $choices) ? $input : $setting->default);
}

/**
 * カスタマイザー用CSS出力
 */
function copipe_customizer_css() {
    $primary_color = get_theme_mod('copipe_primary_color', '#1e87f0');
    $secondary_color = get_theme_mod('copipe_secondary_color', '#32d296');
    $accent_color = get_theme_mod('copipe_accent_color', '#faa05a');
    $font_size = get_theme_mod('copipe_font_size', 16);
    $container_width = get_theme_mod('copipe_container_width', 1200);
    $custom_css = get_theme_mod('copipe_custom_css', '');
    
    ?>
    <style type="text/css">
    :root {
        --copipe-primary: <?php echo esc_attr($primary_color); ?>;
        --copipe-secondary: <?php echo esc_attr($secondary_color); ?>;
        --copipe-accent: <?php echo esc_attr($accent_color); ?>;
        --copipe-font-size: <?php echo esc_attr($font_size); ?>px;
        --copipe-container-width: <?php echo esc_attr($container_width); ?>px;
    }
    
    body {
        font-size: var(--copipe-font-size);
    }
    
    .uk-container {
        max-width: var(--copipe-container-width);
    }
    
    .uk-button-primary {
        background-color: var(--copipe-primary);
        border-color: var(--copipe-primary);
    }
    
    .uk-button-secondary {
        background-color: var(--copipe-secondary);
        border-color: var(--copipe-secondary);
    }
    
    .uk-text-primary {
        color: var(--copipe-primary) !important;
    }
    
    .uk-text-secondary {
        color: var(--copipe-secondary) !important;
    }
    
    .uk-label-success {
        background-color: var(--copipe-secondary);
    }
    
    .uk-label-warning {
        background-color: var(--copipe-accent);
    }
    
    <?php if ($custom_css) : ?>
    /* カスタムCSS */
    <?php echo $custom_css; ?>
    <?php endif; ?>
    </style>
    <?php
}
add_action('wp_head', 'copipe_customizer_css');

/**
 * カスタマイザー用JavaScript出力
 */
function copipe_customizer_js() {
    $custom_js = get_theme_mod('copipe_custom_js', '');
    $google_analytics = get_theme_mod('copipe_google_analytics', '');
    
    if ($google_analytics) :
    ?>
    <!-- Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo esc_attr($google_analytics); ?>"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '<?php echo esc_attr($google_analytics); ?>');
    </script>
    <?php endif; ?>
    
    <?php if ($custom_js) : ?>
    <script>
    <?php echo $custom_js; ?>
    </script>
    <?php endif; ?>
    <?php
}
add_action('wp_footer', 'copipe_customizer_js');

/**
 * カスタマイザープレビュー用JavaScript
 */
function copipe_customize_preview_js() {
    wp_enqueue_script(
        'copipe-customize-preview',
        get_template_directory_uri() . '/assets/js/customize-preview.js',
        ['customize-preview'],
        COPIPE_THEME_VERSION,
        true
    );
}
add_action('customize_preview_init', 'copipe_customize_preview_js');

/**
 * カスタマイザーコントロール用CSS/JS
 */
function copipe_customize_controls_enqueue() {
    wp_enqueue_style(
        'copipe-customize-controls',
        get_template_directory_uri() . '/assets/css/customize-controls.css',
        [],
        COPIPE_THEME_VERSION
    );
    
    wp_enqueue_script(
        'copipe-customize-controls',
        get_template_directory_uri() . '/assets/js/customize-controls.js',
        ['customize-controls'],
        COPIPE_THEME_VERSION,
        true
    );
}
add_action('customize_controls_enqueue_scripts', 'copipe_customize_controls_enqueue');


add_action( 'customize_register', function( WP_Customize_Manager $wp_customize ) {

    // パネル
    $wp_customize->add_panel( 'copipe_panel', [
        'title'    => 'Copipe 設定',
        'priority' => 160,
    ] );

    // セクション: カラー
    $wp_customize->add_section( 'copipe_colors', [
        'title'    => 'カラー設定',
        'panel'    => 'copipe_panel',
        'priority' => 10,
    ] );
    // プライマリカラー
    $wp_customize->add_setting( 'copipe_primary_color', [
        'default'           => '#1e87f0',
        'sanitize_callback' => 'sanitize_hex_color',
    ] );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'copipe_primary_color_ctrl', [
        'label'    => 'プライマリカラー',
        'section'  => 'copipe_colors',
        'settings' => 'copipe_primary_color',
    ] ) );

    // セクション: 行番号
    $wp_customize->add_section( 'copipe_code', [
        'title'    => 'コード表示設定',
        'panel'    => 'copipe_panel',
        'priority' => 20,
    ] );
    // 行番号表示 on/off
    $wp_customize->add_setting( 'copipe_line_numbers', [
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ] );
    $wp_customize->add_control( 'copipe_line_numbers_ctrl', [
        'label'    => '行番号を表示する',
        'section'  => 'copipe_code',
        'settings' => 'copipe_line_numbers',
        'type'     => 'checkbox',
    ] );
} );
