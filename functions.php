<?php
/**
 * Copipe Theme PostPilot v3 Functions
 * 
 * @package copipe-theme
 * @version 3.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Define theme constants
define('COPIPE_THEME_VERSION', '3.0.0');
define('COPIPE_THEME_PATH', get_template_directory());
define('COPIPE_THEME_URL', get_template_directory_uri());

/**
 * Theme setup
 */
function copipe_theme_setup() {
    // Make theme available for translation
    load_theme_textdomain('copipe-theme', COPIPE_THEME_PATH . '/languages');

    // Add default posts and comments RSS feed links to head
    add_theme_support('automatic-feed-links');

    // Let WordPress manage the document title
    add_theme_support('title-tag');

    // Enable support for Post Thumbnails on posts and pages
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(1200, 600, true);

    // Add custom image sizes
    add_image_size('copipe-hero', 1920, 800, true);
    add_image_size('copipe-featured', 800, 400, true);
    add_image_size('copipe-thumbnail', 300, 200, true);

    // Switch default core markup to output valid HTML5
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));

    // Set up the WordPress core custom background feature
    add_theme_support('custom-background', apply_filters('copipe_custom_background_args', array(
        'default-color' => 'ffffff',
        'default-image' => '',
    )));

    // Add theme support for selective refresh for widgets
    add_theme_support('customize-selective-refresh-widgets');

    // Add support for core custom logo
    add_theme_support('custom-logo', array(
        'height'      => 80,
        'width'       => 300,
        'flex-width'  => true,
        'flex-height' => true,
    ));

    // This theme uses wp_nav_menu() in multiple locations
    register_nav_menus(array(
        'primary' => esc_html__('Primary Menu', 'copipe-theme'),
        'footer'  => esc_html__('Footer Menu', 'copipe-theme'),
    ));

    // Add support for Block Styles
    add_theme_support('wp-block-styles');

    // Add support for full and wide align images
    add_theme_support('align-wide');

    // Add support for editor styles
    add_theme_support('editor-styles');

    // Enqueue editor styles
    add_editor_style('style-editor.css');

    // Add custom editor font sizes
    add_theme_support('editor-font-sizes', array(
        array(
            'name' => esc_html__('Small', 'copipe-theme'),
            'size' => 14,
            'slug' => 'small'
        ),
        array(
            'name' => esc_html__('Regular', 'copipe-theme'),
            'size' => 16,
            'slug' => 'regular'
        ),
        array(
            'name' => esc_html__('Large', 'copipe-theme'),
            'size' => 20,
            'slug' => 'large'
        ),
        array(
            'name' => esc_html__('Extra Large', 'copipe-theme'),
            'size' => 24,
            'slug' => 'extra-large'
        )
    ));

    // Disable custom colors in favor of theme colors
    add_theme_support('disable-custom-colors');

    // Add custom color palette
    add_theme_support('editor-color-palette', array(
        array(
            'name'  => esc_html__('Primary Blue', 'copipe-theme'),
            'slug'  => 'primary-blue',
            'color' => '#2c5aa0',
        ),
        array(
            'name'  => esc_html__('Secondary Orange', 'copipe-theme'),
            'slug'  => 'secondary-orange',
            'color' => '#ff6b35',
        ),
        array(
            'name'  => esc_html__('Success Green', 'copipe-theme'),
            'slug'  => 'success-green',
            'color' => '#00c851',
        ),
        array(
            'name'  => esc_html__('Dark Gray', 'copipe-theme'),
            'slug'  => 'dark-gray',
            'color' => '#333333',
        ),
        array(
            'name'  => esc_html__('Light Gray', 'copipe-theme'),
            'slug'  => 'light-gray',
            'color' => '#f8f9fa',
        ),
        array(
            'name'  => esc_html__('White', 'copipe-theme'),
            'slug'  => 'white',
            'color' => '#ffffff',
        ),
    ));
}
add_action('after_setup_theme', 'copipe_theme_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet
 */
function copipe_content_width() {
    $GLOBALS['content_width'] = apply_filters('copipe_content_width', 1200);
}
add_action('after_setup_theme', 'copipe_content_width', 0);

/**
 * Register widget area
 */
function copipe_widgets_init() {
    register_sidebar(array(
        'name'          => esc_html__('Sidebar', 'copipe-theme'),
        'id'            => 'sidebar-1',
        'description'   => esc_html__('Add widgets here.', 'copipe-theme'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'name'          => esc_html__('Footer Widget Area', 'copipe-theme'),
        'id'            => 'footer-1',
        'description'   => esc_html__('Add widgets here to appear in your footer.', 'copipe-theme'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'copipe_widgets_init');

/**
 * Enqueue scripts and styles
 */
function copipe_scripts() {
    // Main stylesheet
    wp_enqueue_style('copipe-style', get_stylesheet_uri(), array(), COPIPE_THEME_VERSION);

    // Google Fonts
    wp_enqueue_style('copipe-fonts', 'https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;500;700&family=Inter:wght@400;500;600;700&display=swap', array(), null);

    // Main theme script
    wp_enqueue_script('copipe-script', COPIPE_THEME_URL . '/js/theme.js', array('jquery'), COPIPE_THEME_VERSION, true);

    // Comment reply script
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }

    // Mobile menu script
    wp_enqueue_script('copipe-mobile-menu', COPIPE_THEME_URL . '/js/mobile-menu.js', array('jquery'), COPIPE_THEME_VERSION, true);

    // LP専用UIkit読み込み（PostPilotページのみ）
    if (is_page_template('page-postpilot.php') || is_page('postpilot')) {
        wp_enqueue_style('uikit-css', 'https://cdn.jsdelivr.net/npm/uikit@3.17.11/dist/css/uikit.min.css', array(), '3.17.11');
        wp_enqueue_script('uikit-js', 'https://cdn.jsdelivr.net/npm/uikit@3.17.11/dist/js/uikit.min.js', array(), '3.17.11', true);
        wp_enqueue_script('uikit-icons', 'https://cdn.jsdelivr.net/npm/uikit@3.17.11/dist/js/uikit-icons.min.js', array('uikit-js'), '3.17.11', true);
    }

    // Localize script for AJAX
    wp_localize_script('copipe-script', 'copipe_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('copipe_nonce'),
    ));
}
add_action('wp_enqueue_scripts', 'copipe_scripts');

/**
 * Enqueue admin scripts and styles
 */
function copipe_admin_scripts($hook) {
    if ('appearance_page_copipe-settings' !== $hook) {
        return;
    }
    
    wp_enqueue_style('copipe-admin-style', COPIPE_THEME_URL . '/css/admin.css', array(), COPIPE_THEME_VERSION);
    wp_enqueue_script('copipe-admin-script', COPIPE_THEME_URL . '/js/admin.js', array('jquery'), COPIPE_THEME_VERSION, true);
}
add_action('admin_enqueue_scripts', 'copipe_admin_scripts');

/**
 * Custom post types
 */
function copipe_register_post_types() {
    // AI Prompt post type
    register_post_type('ai_prompt', array(
        'labels' => array(
            'name'               => 'AI プロンプト',
            'singular_name'      => 'AI プロンプト',
            'add_new'            => '新規追加',
            'add_new_item'       => '新しいAIプロンプトを追加',
            'edit_item'          => 'AIプロンプトを編集',
            'new_item'           => '新しいAIプロンプト',
            'view_item'          => 'AIプロンプトを表示',
            'search_items'       => 'AIプロンプトを検索',
            'not_found'          => 'AIプロンプトが見つかりませんでした',
            'not_found_in_trash' => 'ゴミ箱にAIプロンプトはありませんでした'
        ),
        'public'              => true,
        'has_archive'         => true,
        'publicly_queryable'  => true,
        'query_var'           => true,
        'rewrite'             => array('slug' => 'ai-prompt'),
        'capability_type'     => 'post',
        'hierarchical'        => false,
        'supports'            => array('title', 'editor', 'excerpt', 'thumbnail', 'custom-fields'),
        'menu_icon'           => 'dashicons-lightbulb',
        'show_in_rest'        => true,
    ));
}
add_action('init', 'copipe_register_post_types');

/**
 * SEO and meta optimization
 */
function copipe_meta_tags() {
    global $post;
    
    if (is_home() || is_front_page()) {
        $description = get_bloginfo('description');
        $title = get_bloginfo('name');
    } elseif (is_single() || is_page()) {
        $description = get_the_excerpt();
        $title = get_the_title();
        
        // AIO SEO Proがアクティブな場合は、そちらに任せる
        if (function_exists('aioseo')) {
            return;
        }
    } else {
        return;
    }
    
    // Remove extra whitespace
    $description = trim(preg_replace('/\s+/', ' ', strip_tags($description)));
    
    if ($description && !function_exists('aioseo')) {
        echo '<meta name="description" content="' . esc_attr($description) . '">' . "\n";
    }
    
    // Open Graph tags
    if (!function_exists('aioseo')) {
        echo '<meta property="og:title" content="' . esc_attr($title) . '">' . "\n";
        echo '<meta property="og:description" content="' . esc_attr($description) . '">' . "\n";
        echo '<meta property="og:type" content="' . (is_single() ? 'article' : 'website') . '">' . "\n";
        echo '<meta property="og:url" content="' . esc_url(get_permalink()) . '">' . "\n";
        
        if (has_post_thumbnail() && (is_single() || is_page())) {
            $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
            if ($thumbnail) {
                echo '<meta property="og:image" content="' . esc_url($thumbnail[0]) . '">' . "\n";
            }
        }
    }
    
    // Twitter Card tags
    if (!function_exists('aioseo')) {
        echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
        echo '<meta name="twitter:title" content="' . esc_attr($title) . '">' . "\n";
        echo '<meta name="twitter:description" content="' . esc_attr($description) . '">' . "\n";
    }
}
add_action('wp_head', 'copipe_meta_tags');

/**
 * Custom excerpt length
 */
function copipe_excerpt_length($length) {
    return 40;
}
add_filter('excerpt_length', 'copipe_excerpt_length');

/**
 * Custom excerpt more text
 */
function copipe_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'copipe_excerpt_more');

/**
 * Add breadcrumb support
 */
function copipe_breadcrumb() {
    if (is_front_page()) {
        return;
    }
    
    $breadcrumb = '<nav class="breadcrumb" aria-label="breadcrumb">';
    $breadcrumb .= '<ol class="breadcrumb-list" itemscope itemtype="https://schema.org/BreadcrumbList">';
    
    // Home link
    $breadcrumb .= '<li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
    $breadcrumb .= '<a href="' . home_url() . '" itemprop="item"><span itemprop="name">ホーム</span></a>';
    $breadcrumb .= '<meta itemprop="position" content="1" />';
    $breadcrumb .= '</li>';
    
    $position = 2;
    
    if (is_category()) {
        $category = get_queried_object();
        $breadcrumb .= '<li class="breadcrumb-item active" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
        $breadcrumb .= '<span itemprop="name">' . $category->name . '</span>';
        $breadcrumb .= '<meta itemprop="position" content="' . $position . '" />';
        $breadcrumb .= '</li>';
    } elseif (is_single()) {
        $categories = get_the_category();
        if (!empty($categories)) {
            $category = $categories[0];
            $breadcrumb .= '<li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
            $breadcrumb .= '<a href="' . get_category_link($category->term_id) . '" itemprop="item"><span itemprop="name">' . $category->name . '</span></a>';
            $breadcrumb .= '<meta itemprop="position" content="' . $position . '" />';
            $breadcrumb .= '</li>';
            $position++;
        }
        
        $breadcrumb .= '<li class="breadcrumb-item active" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
        $breadcrumb .= '<span itemprop="name">' . get_the_title() . '</span>';
        $breadcrumb .= '<meta itemprop="position" content="' . $position . '" />';
        $breadcrumb .= '</li>';
    } elseif (is_page()) {
        $breadcrumb .= '<li class="breadcrumb-item active" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">';
        $breadcrumb .= '<span itemprop="name">' . get_the_title() . '</span>';
        $breadcrumb .= '<meta itemprop="position" content="' . $position . '" />';
        $breadcrumb .= '</li>';
    }
    
    $breadcrumb .= '</ol>';
    $breadcrumb .= '</nav>';
    
    return $breadcrumb;
}

/**
 * Performance optimizations
 */
function copipe_performance_optimizations() {
    // Remove query strings from static resources
    if (!is_admin()) {
        add_filter('script_loader_src', 'copipe_remove_query_strings', 15, 1);
        add_filter('style_loader_src', 'copipe_remove_query_strings', 15, 1);
    }
    
    // Disable emojis
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
    
    // Remove unnecessary meta tags
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wp_shortlink_wp_head');
}
add_action('init', 'copipe_performance_optimizations');

/**
 * Remove query strings from static resources
 */
function copipe_remove_query_strings($src) {
    $rqs = explode('?ver', $src);
    return $rqs[0];
}

/**
 * Custom admin settings page
 */
function copipe_admin_menu() {
    add_theme_page(
        'テーマ設定',
        'テーマ設定',
        'manage_options',
        'copipe-settings',
        'copipe_settings_page'
    );
}
add_action('admin_menu', 'copipe_admin_menu');

/**
 * Settings page content
 */
function copipe_settings_page() {
    ?>
    <div class="wrap">
        <h1>Copipe Theme 設定</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('copipe_settings_group');
            do_settings_sections('copipe_settings_group');
            ?>
            <table class="form-table">
                <tr>
                    <th scope="row">LINE誘導URL</th>
                    <td>
                        <input type="url" name="copipe_line_url" value="<?php echo esc_attr(get_option('copipe_line_url')); ?>" class="regular-text" />
                        <p class="description">LPでのLINE誘導先URLを設定してください。</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">Google Analytics ID</th>
                    <td>
                        <input type="text" name="copipe_ga_id" value="<?php echo esc_attr(get_option('copipe_ga_id')); ?>" class="regular-text" />
                        <p class="description">Google Analytics測定IDを入力してください（例: G-XXXXXXXXXX）。</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">フッターコピーライト</th>
                    <td>
                        <input type="text" name="copipe_copyright" value="<?php echo esc_attr(get_option('copipe_copyright', '© 2025 Numaken. All rights reserved.')); ?>" class="regular-text" />
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

/**
 * Register settings
 */
function copipe_admin_init() {
    register_setting('copipe_settings_group', 'copipe_line_url');
    register_setting('copipe_settings_group', 'copipe_ga_id');
    register_setting('copipe_settings_group', 'copipe_copyright');
}
add_action('admin_init', 'copipe_admin_init');

/**
 * Add Google Analytics
 */
function copipe_google_analytics() {
    $ga_id = get_option('copipe_ga_id');
    if ($ga_id && !is_admin() && !current_user_can('manage_options')) {
        ?>
        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo esc_attr($ga_id); ?>"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());
          gtag('config', '<?php echo esc_attr($ga_id); ?>');
        </script>
        <?php
    }
}
add_action('wp_head', 'copipe_google_analytics');

/**
 * Include customizer settings
 */
require_once get_template_directory() . '/inc/customizer.php';

/**
 * Include admin settings
 */
require_once get_template_directory() . '/inc/admin-settings.php';

/**
 * Custom template tags for this theme
 */
require_once get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress
 */
require_once get_template_directory() . '/inc/template-functions.php';