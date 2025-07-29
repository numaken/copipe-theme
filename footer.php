<?php
/**
 * The template for displaying the footer
 *
 * @package copipe-theme
 * @version 3.0.0
 */

?>

    </div><!-- #content -->

    <footer id="colophon" class="site-footer">
        <div class="container">
            <div class="footer-content">
                
                <?php if (is_active_sidebar('footer-1')) : ?>
                    <div class="footer-widgets">
                        <div class="widget-area">
                            <?php dynamic_sidebar('footer-1'); ?>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="footer-navigation">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'footer',
                        'menu_id'        => 'footer-menu',
                        'menu_class'     => 'footer-menu',
                        'container'      => false,
                        'depth'          => 1,
                        'fallback_cb'    => 'copipe_footer_menu_fallback',
                    ));
                    ?>
                </div><!-- .footer-navigation -->

                <div class="site-info">
                    <div class="copyright">
                        <?php
                        $copyright_text = get_option('copipe_copyright', '© 2025 Numaken. All rights reserved.');
                        echo esc_html($copyright_text);
                        ?>
                    </div>
                    
                    <?php if (!is_page_template('page-postpilot.php')) : ?>
                        <div class="theme-credit">
                            <a href="<?php echo esc_url(__('https://wordpress.org/', 'copipe-theme')); ?>">
                                <?php
                                /* translators: %s: CMS name, i.e. WordPress. */
                                printf(esc_html__('Proudly powered by %s', 'copipe-theme'), 'WordPress');
                                ?>
                            </a>
                            <span class="sep"> | </span>
                            <?php
                            /* translators: 1: Theme name, 2: Theme author. */
                            printf(esc_html__('Theme: %1$s by %2$s.', 'copipe-theme'), 'Copipe Theme PostPilot v3', '<a href="https://numaken.net/">Numaken</a>');
                            ?>
                        </div>
                    <?php endif; ?>
                </div><!-- .site-info -->
            </div><!-- .footer-content -->
        </div><!-- .container -->
    </footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

<!-- モバイルメニュー用のスタイル -->
<style>
.mobile-navigation {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100vh;
    background: rgba(0, 0, 0, 0.9);
    z-index: 9999;
    overflow-y: auto;
}

.mobile-navigation.active {
    display: flex;
    align-items: center;
    justify-content: center;
}

.mobile-menu-inner {
    text-align: center;
}

.mobile-nav-menu {
    list-style: none;
    padding: 0;
    margin: 0;
}

.mobile-nav-menu li {
    margin-bottom: 2rem;
}

.mobile-nav-menu a {
    color: white;
    text-decoration: none;
    font-size: 1.5rem;
    font-weight: 500;
    transition: color 0.3s ease;
}

.mobile-nav-menu a:hover {
    color: #2c5aa0;
}

.hamburger-icon {
    display: flex;
    flex-direction: column;
    width: 24px;
    height: 18px;
    justify-content: space-between;
}

.hamburger-icon span {
    display: block;
    height: 2px;
    width: 100%;
    background: #333;
    transition: all 0.3s ease;
}

.mobile-menu-toggle.active .hamburger-icon span:first-child {
    transform: rotate(45deg) translate(5px, 5px);
}

.mobile-menu-toggle.active .hamburger-icon span:nth-child(2) {
    opacity: 0;
}

.mobile-menu-toggle.active .hamburger-icon span:last-child {
    transform: rotate(-45deg) translate(7px, -6px);
}

.breadcrumb-container {
    background: #f8f9fa;
    padding: 1rem 0;
    border-bottom: 1px solid #e0e0e0;
}

.breadcrumb {
    margin: 0;
}

.breadcrumb-list {
    display: flex;
    flex-wrap: wrap;
    list-style: none;
    margin: 0;
    padding: 0;
    font-size: 0.9rem;
}

.breadcrumb-item {
    display: flex;
    align-items: center;
}

.breadcrumb-item:not(:last-child)::after {
    content: ">";
    margin: 0 0.5rem;
    color: #666;
}

.breadcrumb-item a {
    color: #2c5aa0;
    text-decoration: none;
}

.breadcrumb-item a:hover {
    text-decoration: underline;
}

.breadcrumb-item.active {
    color: #666;
}

@media (min-width: 768px) {
    .mobile-navigation {
        display: none !important;
    }
    
    .main-navigation {
        display: block !important;
    }
}

@media (max-width: 767px) {
    .main-navigation {
        display: none;
    }
    
    .footer-menu {
        flex-direction: column;
        gap: 1rem !important;
        text-align: center;
    }
    
    .footer-content {
        text-align: center;
    }
    
    .site-info {
        text-align: center;
        font-size: 0.8rem;
    }
    
    .theme-credit {
        margin-top: 1rem;
    }
}
</style>

<!-- モバイルメニュー用のJavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
    const mobileMenu = document.querySelector('.mobile-navigation');
    
    if (mobileMenuToggle && mobileMenu) {
        mobileMenuToggle.addEventListener('click', function() {
            const isActive = mobileMenu.classList.contains('active');
            
            if (isActive) {
                mobileMenu.classList.remove('active');
                mobileMenuToggle.classList.remove('active');
                document.body.style.overflow = '';
            } else {
                mobileMenu.classList.add('active');
                mobileMenuToggle.classList.add('active');
                document.body.style.overflow = 'hidden';
            }
        });
        
        // メニュー項目をクリックしたときにメニューを閉じる
        const mobileMenuLinks = mobileMenu.querySelectorAll('a');
        mobileMenuLinks.forEach(function(link) {
            link.addEventListener('click', function() {
                mobileMenu.classList.remove('active');
                mobileMenuToggle.classList.remove('active');
                document.body.style.overflow = '';
            });
        });
        
        // オーバーレイをクリックしたときにメニューを閉じる
        mobileMenu.addEventListener('click', function(e) {
            if (e.target === mobileMenu) {
                mobileMenu.classList.remove('active');
                mobileMenuToggle.classList.remove('active');
                document.body.style.overflow = '';
            }
        });
    }
});
</script>

</body>
</html>

<?php
/**
 * Footer menu fallback
 */
function copipe_footer_menu_fallback() {
    echo '<ul class="footer-menu">';
    echo '<li><a href="' . esc_url(home_url('/')) . '">' . esc_html__('Home', 'copipe-theme') . '</a></li>';
    
    // プライバシーポリシーページ
    $privacy_page = get_page_by_path('privacy-policy');
    if ($privacy_page) {
        echo '<li><a href="' . esc_url(get_permalink($privacy_page->ID)) . '">' . esc_html__('Privacy Policy', 'copipe-theme') . '</a></li>';
    }
    
    // 利用規約ページ
    $terms_page = get_page_by_path('terms');
    if ($terms_page) {
        echo '<li><a href="' . esc_url(get_permalink($terms_page->ID)) . '">' . esc_html__('Terms of Service', 'copipe-theme') . '</a></li>';
    }
    
    // お問い合わせページ
    $contact_page = get_page_by_path('contact');
    if ($contact_page) {
        echo '<li><a href="' . esc_url(get_permalink($contact_page->ID)) . '">' . esc_html__('Contact', 'copipe-theme') . '</a></li>';
    }
    
    echo '</ul>';
}
?>