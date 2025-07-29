<?php
/**
 * The header for our theme
 *
 * @package copipe-theme
 * @version 3.0.0
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#primary">
        <?php esc_html_e('Skip to content', 'copipe-theme'); ?>
    </a>

    <header id="masthead" class="site-header">
        <div class="container">
            <div class="header-inner">
                <div class="site-branding">
                    <?php
                    // Custom logo or site title
                    if (function_exists('the_custom_logo') && has_custom_logo()) :
                        the_custom_logo();
                    else : ?>
                        <h1 class="site-title">
                            <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                                <?php bloginfo('name'); ?>
                            </a>
                        </h1>
                        <?php
                        $description = get_bloginfo('description', 'display');
                        if ($description || is_customize_preview()) : ?>
                            <p class="site-description"><?php echo $description; ?></p>
                        <?php endif;
                    endif; ?>
                </div><!-- .site-branding -->

                <nav id="site-navigation" class="main-navigation" aria-label="<?php esc_attr_e('Primary Navigation', 'copipe-theme'); ?>">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'menu_id'        => 'primary-menu',
                        'menu_class'     => 'nav-menu',
                        'container'      => false,
                        'fallback_cb'    => 'copipe_default_menu',
                    ));
                    ?>
                </nav><!-- #site-navigation -->

                <!-- Mobile Menu Toggle -->
                <button class="mobile-menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                    <span class="sr-only"><?php esc_html_e('Menu', 'copipe-theme'); ?></span>
                    <span class="hamburger-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </button>
            </div><!-- .header-inner -->
        </div><!-- .container -->

        <!-- Mobile Navigation -->
        <div class="mobile-navigation" id="mobile-menu">
            <div class="mobile-menu-inner">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'menu_id'        => 'mobile-primary-menu',
                    'menu_class'     => 'mobile-nav-menu',
                    'container'      => false,
                    'fallback_cb'    => 'copipe_default_mobile_menu',
                ));
                ?>
            </div>
        </div><!-- .mobile-navigation -->
    </header><!-- #masthead -->

    <?php
    // パンくずナビゲーション（LPページ以外で表示）
    if (!is_page_template('page-postpilot.php') && !is_front_page() && !is_home()) : ?>
        <div class="breadcrumb-container">
            <div class="container">
                <?php echo copipe_breadcrumb(); ?>
            </div>
        </div>
    <?php endif; ?>

    <div id="content" class="site-content">

<?php
/**
 * Fallback function for primary navigation
 */
function copipe_default_menu() {
    echo '<ul class="nav-menu">';
    echo '<li><a href="' . esc_url(home_url('/')) . '">' . esc_html__('Home', 'copipe-theme') . '</a></li>';
    
    // 投稿ページがある場合
    if (get_option('page_for_posts')) {
        echo '<li><a href="' . esc_url(get_permalink(get_option('page_for_posts'))) . '">' . esc_html__('Blog', 'copipe-theme') . '</a></li>';
    }
    
    // AboutページがあればlinkOAOTそれを表示
    $about_page = get_page_by_path('about');
    if ($about_page) {
        echo '<li><a href="' . esc_url(get_permalink($about_page->ID)) . '">' . esc_html__('About', 'copipe-theme') . '</a></li>';
    }
    
    // PostPilotページがあれば表示
    $postpilot_page = get_page_by_path('postpilot');
    if ($postpilot_page) {
        echo '<li><a href="' . esc_url(get_permalink($postpilot_page->ID)) . '">' . esc_html__('PostPilot', 'copipe-theme') . '</a></li>';
    }
    
    echo '</ul>';
}

/**
 * Fallback function for mobile navigation
 */
function copipe_default_mobile_menu() {
    echo '<ul class="mobile-nav-menu">';
    echo '<li><a href="' . esc_url(home_url('/')) . '">' . esc_html__('Home', 'copipe-theme') . '</a></li>';
    
    if (get_option('page_for_posts')) {
        echo '<li><a href="' . esc_url(get_permalink(get_option('page_for_posts'))) . '">' . esc_html__('Blog', 'copipe-theme') . '</a></li>';
    }
    
    $about_page = get_page_by_path('about');
    if ($about_page) {
        echo '<li><a href="' . esc_url(get_permalink($about_page->ID)) . '">' . esc_html__('About', 'copipe-theme') . '</a></li>';
    }
    
    $postpilot_page = get_page_by_path('postpilot');
    if ($postpilot_page) {
        echo '<li><a href="' . esc_url(get_permalink($postpilot_page->ID)) . '">' . esc_html__('PostPilot', 'copipe-theme') . '</a></li>';
    }
    
    echo '</ul>';
}
?>