<?php
/**
 * inc/admin-settings.php
 * WordPress管理画面設定（改善版）
 * 
 * @package Copipe_Theme
 */

if (!defined('ABSPATH')) {
    exit;
}



if (!function_exists('copipe_admin_menu')) {
    /**
 * 管理画面のメニューを追加
 */
function copipe_admin_menu() {
    // メインメニューページ
    add_theme_page(
        __('Copipe Theme設定', 'copipe-theme'),
        __('テーマ設定', 'copipe-theme'),
        'manage_options',
        'copipe-theme-settings',
        'copipe_admin_main_page'
    );
    
    // サブメニューページ
    add_submenu_page(
        'copipe-theme-settings',
        __('AdSense設定', 'copipe-theme'),
        __('AdSense', 'copipe-theme'),
        'manage_options',
        'copipe-adsense-settings',
        'copipe_admin_adsense_page'
    );
    
    add_submenu_page(
        'copipe-theme-settings',
        __('SEO設定', 'copipe-theme'),
        __('SEO', 'copipe-theme'),
        'manage_options',
        'copipe-seo-settings',
        'copipe_admin_seo_page'
    );
    
    add_submenu_page(
        'copipe-theme-settings',
        __('パフォーマンス設定', 'copipe-theme'),
        __('パフォーマンス', 'copipe-theme'),
        'manage_options',
        'copipe-performance-settings',
        'copipe_admin_performance_page'
    );
    
    add_submenu_page(
        'copipe-theme-settings',
        __('セキュリティ設定', 'copipe-theme'),
        __('セキュリティ', 'copipe-theme'),
        'manage_options',
        'copipe-security-settings',
        'copipe_admin_security_page'
    );
    }
}
add_action('admin_menu', 'copipe_admin_menu');

/**
 * 設定の初期化
 */
function copipe_admin_init() {
    register_setting('copipe_theme_options', 'copipe_theme_options', [
        'sanitize_callback' => 'copipe_sanitize_options'
    ]);
}
add_action('admin_init', 'copipe_admin_init');

/**
 * メイン設定ページ
 */
function copipe_admin_main_page() {
    if (isset($_POST['submit'])) {
        $options = copipe_get_all_options();
        
        // 基本設定
        $options['site_description'] = sanitize_textarea_field($_POST['site_description'] ?? '');
        $options['contact_email'] = sanitize_email($_POST['contact_email'] ?? '');
        $options['copyright_text'] = sanitize_text_field($_POST['copyright_text'] ?? '');
        
        // レイアウト設定
        $options['show_sidebar'] = isset($_POST['show_sidebar']);
        $options['posts_per_page'] = intval($_POST['posts_per_page'] ?? 10);
        $options['archive_layout'] = sanitize_text_field($_POST['archive_layout'] ?? 'grid');
        
        update_option('copipe_theme_options', $options);
        
        echo '<div class="notice notice-success"><p>' . 
             __('設定を保存しました。', 'copipe-theme') . '</p></div>';
    }
    
    $options = copipe_get_all_options();
    ?>
    <div class="wrap copipe-admin-wrap">
        <h1><?php _e('Copipe Theme設定', 'copipe-theme'); ?></h1>
        
        <div class="copipe-admin-tabs">
            <h2 class="nav-tab-wrapper">
                <a href="#basic" class="nav-tab nav-tab-active"><?php _e('基本設定', 'copipe-theme'); ?></a>
                <a href="#layout" class="nav-tab"><?php _e('レイアウト', 'copipe-theme'); ?></a>
                <a href="#content" class="nav-tab"><?php _e('コンテンツ', 'copipe-theme'); ?></a>
            </h2>
            
            <form method="post" class="copipe-admin-form">
                <?php wp_nonce_field('copipe_admin_nonce'); ?>
                
                <!-- 基本設定タブ -->
                <div id="basic" class="copipe-tab-content">
                    <h3><?php _e('サイト基本情報', 'copipe-theme'); ?></h3>
                    <table class="form-table">
                        <tr>
                            <th scope="row"><?php _e('サイト詳細説明', 'copipe-theme'); ?></th>
                            <td>
                                <textarea name="site_description" rows="3" cols="50" class="large-text"><?php echo esc_textarea($options['site_description']); ?></textarea>
                                <p class="description"><?php _e('SEOやAboutページで使用される詳細な説明文', 'copipe-theme'); ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('お問い合わせメール', 'copipe-theme'); ?></th>
                            <td>
                                <input type="email" name="contact_email" value="<?php echo esc_attr($options['contact_email']); ?>" class="regular-text" />
                                <p class="description"><?php _e('フォームからの送信先メールアドレス', 'copipe-theme'); ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('コピーライト表示', 'copipe-theme'); ?></th>
                            <td>
                                <input type="text" name="copyright_text" value="<?php echo esc_attr($options['copyright_text']); ?>" class="large-text" />
                                <p class="description"><?php _e('フッターに表示されるコピーライト文。空欄の場合はデフォルト表示', 'copipe-theme'); ?></p>
                            </td>
                        </tr>
                    </table>
                </div>
                
                <!-- レイアウト設定タブ -->
                <div id="layout" class="copipe-tab-content" style="display:none;">
                    <h3><?php _e('ページレイアウト', 'copipe-theme'); ?></h3>
                    <table class="form-table">
                        <tr>
                            <th scope="row"><?php _e('サイドバー表示', 'copipe-theme'); ?></th>
                            <td>
                                <label>
                                    <input type="checkbox" name="show_sidebar" <?php checked($options['show_sidebar']); ?> />
                                    <?php _e('サイドバーを表示する', 'copipe-theme'); ?>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('1ページあたりの記事数', 'copipe-theme'); ?></th>
                            <td>
                                <input type="number" name="posts_per_page" value="<?php echo esc_attr($options['posts_per_page']); ?>" min="5" max="50" />
                                <p class="description"><?php _e('アーカイブページで表示する記事数', 'copipe-theme'); ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('アーカイブレイアウト', 'copipe-theme'); ?></th>
                            <td>
                                <fieldset>
                                    <label>
                                        <input type="radio" name="archive_layout" value="grid" <?php checked($options['archive_layout'], 'grid'); ?> />
                                        <?php _e('グリッド表示', 'copipe-theme'); ?>
                                    </label><br>
                                    <label>
                                        <input type="radio" name="archive_layout" value="list" <?php checked($options['archive_layout'], 'list'); ?> />
                                        <?php _e('リスト表示', 'copipe-theme'); ?>
                                    </label>
                                </fieldset>
                            </td>
                        </tr>
                    </table>
                </div>
                
                <!-- コンテンツ設定タブ -->
                <div id="content" class="copipe-tab-content" style="display:none;">
                    <h3><?php _e('コンテンツ表示設定', 'copipe-theme'); ?></h3>
                    <table class="form-table">
                        <tr>
                            <th scope="row"><?php _e('抜粋文字数', 'copipe-theme'); ?></th>
                            <td>
                                <input type="number" name="excerpt_length" value="<?php echo esc_attr($options['excerpt_length'] ?? 55); ?>" min="10" max="200" />
                                <p class="description"><?php _e('記事一覧で表示する抜粋の文字数', 'copipe-theme'); ?></p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('コメント表示', 'copipe-theme'); ?></th>
                            <td>
                                <label>
                                    <input type="checkbox" name="show_comments" <?php checked($options['show_comments'] ?? true); ?> />
                                    <?php _e('コメント機能を有効にする', 'copipe-theme'); ?>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('関連記事表示', 'copipe-theme'); ?></th>
                            <td>
                                <label>
                                    <input type="checkbox" name="show_related_posts" <?php checked($options['show_related_posts'] ?? true); ?> />
                                    <?php _e('記事下に関連記事を表示', 'copipe-theme'); ?>
                                </label>
                            </td>
                        </tr>
                    </table>
                </div>
                
                <?php submit_button(); ?>
            </form>
        </div>
        
        <!-- サイト統計 -->
        <div class="copipe-admin-stats uk-margin-large-top">
            <h2><?php _e('サイト統計', 'copipe-theme'); ?></h2>
            
            <div class="copipe-stats-grid">
                <?php
                $stats = copipe_get_site_stats();
                foreach ($stats as $stat) :
                ?>
                    <div class="copipe-stat-card">
                        <div class="copipe-stat-number"><?php echo esc_html($stat['value']); ?></div>
                        <div class="copipe-stat-label"><?php echo esc_html($stat['label']); ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    
    <script>
    jQuery(document).ready(function($) {
        // タブ切り替え
        $('.nav-tab').on('click', function(e) {
            e.preventDefault();
            
            $('.nav-tab').removeClass('nav-tab-active');
            $(this).addClass('nav-tab-active');
            
            $('.copipe-tab-content').hide();
            $($(this).attr('href')).show();
        });
    });
    </script>
    <?php
}

/**
 * AdSense設定ページ
 */
function copipe_admin_adsense_page() {
    if (isset($_POST['submit'])) {
        $options = copipe_get_all_options();
        
        $options['adsense_client'] = sanitize_text_field($_POST['adsense_client'] ?? '');
        $options['adsense_slots'] = [
            'header' => sanitize_text_field($_POST['adsense_slot_header'] ?? ''),
            'content' => sanitize_text_field($_POST['adsense_slot_content'] ?? ''),
            'sidebar' => sanitize_text_field($_POST['adsense_slot_sidebar'] ?? ''),
            'footer' => sanitize_text_field($_POST['adsense_slot_footer'] ?? '')
        ];
        $options['adsense_auto_ads'] = isset($_POST['adsense_auto_ads']);
        $options['disable_mobile_ads'] = isset($_POST['disable_mobile_ads']);
        
        update_option('copipe_theme_options', $options);
        
        echo '<div class="notice notice-success"><p>' . 
             __('AdSense設定を保存しました。', 'copipe-theme') . '</p></div>';
    }
    
    $options = copipe_get_all_options();
    $client = $options['adsense_client'];
    $slots = $options['adsense_slots'];
    ?>
    <div class="wrap">
        <h1><?php _e('AdSense設定', 'copipe-theme'); ?></h1>
        
        <div class="copipe-admin-notice">
            <h3><?php _e('AdSense設定について', 'copipe-theme'); ?></h3>
            <ul>
                <li><?php _e('AdSenseアカウントのパブリッシャーIDを入力してください', 'copipe-theme'); ?></li>
                <li><?php _e('各スロットIDは対応する広告ユニットのものを使用してください', 'copipe-theme'); ?></li>
                <li><?php _e('設定後は必ず表示確認を行ってください', 'copipe-theme'); ?></li>
            </ul>
        </div>
        
        <form method="post">
            <?php wp_nonce_field('copipe_adsense_nonce'); ?>
            
            <table class="form-table">
                <tr>
                    <th scope="row"><?php _e('AdSense クライアントID', 'copipe-theme'); ?></th>
                    <td>
                        <input type="text" name="adsense_client" value="<?php echo esc_attr($client); ?>" class="regular-text" placeholder="ca-pub-xxxxxxxxxxxxxxxx" />
                        <p class="description"><?php _e('AdSenseのパブリッシャーID（ca-pub-で始まる16桁の数字）', 'copipe-theme'); ?></p>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><?php _e('ヘッダー広告スロット', 'copipe-theme'); ?></th>
                    <td>
                        <input type="text" name="adsense_slot_header" value="<?php echo esc_attr($slots['header']); ?>" class="regular-text" />
                        <p class="description"><?php _e('ヘッダー部分に表示される広告のスロットID', 'copipe-theme'); ?></p>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><?php _e('コンテンツ内広告スロット', 'copipe-theme'); ?></th>
                    <td>
                        <input type="text" name="adsense_slot_content" value="<?php echo esc_attr($slots['content']); ?>" class="regular-text" />
                        <p class="description"><?php _e('記事本文中に表示される広告のスロットID', 'copipe-theme'); ?></p>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><?php _e('サイドバー広告スロット', 'copipe-theme'); ?></th>
                    <td>
                        <input type="text" name="adsense_slot_sidebar" value="<?php echo esc_attr($slots['sidebar']); ?>" class="regular-text" />
                        <p class="description"><?php _e('サイドバーに表示される広告のスロットID', 'copipe-theme'); ?></p>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><?php _e('フッター広告スロット', 'copipe-theme'); ?></th>
                    <td>
                        <input type="text" name="adsense_slot_footer" value="<?php echo esc_attr($slots['footer']); ?>" class="regular-text" />
                        <p class="description"><?php _e('フッター部分に表示される広告のスロットID', 'copipe-theme'); ?></p>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><?php _e('広告オプション', 'copipe-theme'); ?></th>
                    <td>
                        <fieldset>
                            <label>
                                <input type="checkbox" name="adsense_auto_ads" <?php checked($options['adsense_auto_ads'] ?? false); ?> />
                                <?php _e('自動広告を有効にする', 'copipe-theme'); ?>
                            </label><br>
                            <label>
                                <input type="checkbox" name="disable_mobile_ads" <?php checked($options['disable_mobile_ads'] ?? false); ?> />
                                <?php _e('モバイルで広告を無効にする', 'copipe-theme'); ?>
                            </label>
                        </fieldset>
                    </td>
                </tr>
            </table>
            
            <?php submit_button(); ?>
        </form>
        
        <!-- プレビュー -->
        <?php if (!empty($client)) : ?>
            <div class="copipe-adsense-preview">
                <h3><?php _e('広告プレビュー', 'copipe-theme'); ?></h3>
                <p><?php _e('設定されたAdSense設定:', 'copipe-theme'); ?></p>
                <ul>
                    <li><?php printf(__('クライアントID: %s', 'copipe-theme'), esc_html($client)); ?></li>
                    <?php foreach ($slots as $position => $slot) : ?>
                        <?php if (!empty($slot)) : ?>
                            <li><?php printf(__('%s: %s', 'copipe-theme'), esc_html(ucfirst($position)), esc_html($slot)); ?></li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
    </div>
    <?php
}

/**
 * SEO設定ページ
 */
function copipe_admin_seo_page() {
    if (isset($_POST['submit'])) {
        $options = copipe_get_all_options();
        
        $options['meta_description'] = sanitize_textarea_field($_POST['meta_description'] ?? '');
        $options['meta_keywords'] = sanitize_text_field($_POST['meta_keywords'] ?? '');
        $options['google_analytics'] = sanitize_text_field($_POST['google_analytics'] ?? '');
        $options['google_search_console'] = sanitize_text_field($_POST['google_search_console'] ?? '');
        $options['enable_schema_markup'] = isset($_POST['enable_schema_markup']);
        $options['enable_og_tags'] = isset($_POST['enable_og_tags']);
        
        update_option('copipe_theme_options', $options);
        
        echo '<div class="notice notice-success"><p>' . 
             __('SEO設定を保存しました。', 'copipe-theme') . '</p></div>';
    }
    
    $options = copipe_get_all_options();
    ?>
    <div class="wrap">
        <h1><?php _e('SEO設定', 'copipe-theme'); ?></h1>
        
        <form method="post">
            <?php wp_nonce_field('copipe_seo_nonce'); ?>
            
            <table class="form-table">
                <tr>
                    <th scope="row"><?php _e('メタディスクリプション', 'copipe-theme'); ?></th>
                    <td>
                        <textarea name="meta_description" rows="3" cols="50" class="large-text"><?php echo esc_textarea($options['meta_description']); ?></textarea>
                        <p class="description"><?php _e('サイト全体のデフォルトメタディスクリプション', 'copipe-theme'); ?></p>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><?php _e('メタキーワード', 'copipe-theme'); ?></th>
                    <td>
                        <input type="text" name="meta_keywords" value="<?php echo esc_attr($options['meta_keywords']); ?>" class="large-text" />
                        <p class="description"><?php _e('カンマ区切りでキーワードを入力', 'copipe-theme'); ?></p>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><?php _e('Google Analytics ID', 'copipe-theme'); ?></th>
                    <td>
                        <input type="text" name="google_analytics" value="<?php echo esc_attr($options['google_analytics']); ?>" class="regular-text" placeholder="G-XXXXXXXXXX" />
                        <p class="description"><?php _e('GA4の測定ID', 'copipe-theme'); ?></p>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><?php _e('Google Search Console', 'copipe-theme'); ?></th>
                    <td>
                        <input type="text" name="google_search_console" value="<?php echo esc_attr($options['google_search_console']); ?>" class="large-text" />
                        <p class="description"><?php _e('サイト確認用のメタタグのcontentの値', 'copipe-theme'); ?></p>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><?php _e('高度な設定', 'copipe-theme'); ?></th>
                    <td>
                        <fieldset>
                            <label>
                                <input type="checkbox" name="enable_schema_markup" <?php checked($options['enable_schema_markup'] ?? true); ?> />
                                <?php _e('構造化データを有効にする', 'copipe-theme'); ?>
                            </label><br>
                            <label>
                                <input type="checkbox" name="enable_og_tags" <?php checked($options['enable_og_tags'] ?? true); ?> />
                                <?php _e('OGタグを有効にする', 'copipe-theme'); ?>
                            </label>
                        </fieldset>
                    </td>
                </tr>
            </table>
            
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

/**
 * パフォーマンス設定ページ
 */
function copipe_admin_performance_page() {
    if (isset($_POST['submit'])) {
        $options = copipe_get_all_options();
        
        $options['enable_caching'] = isset($_POST['enable_caching']);
        $options['enable_minification'] = isset($_POST['enable_minification']);
        $options['enable_lazy_loading'] = isset($_POST['enable_lazy_loading']);
        $options['enable_webp_conversion'] = isset($_POST['enable_webp_conversion']);
        $options['cache_expiration'] = intval($_POST['cache_expiration'] ?? 3600);
        
        update_option('copipe_theme_options', $options);
        
        // キャッシュクリア
        if ($options['enable_caching']) {
            copipe_clear_cache();
        }
        
        echo '<div class="notice notice-success"><p>' . 
             __('パフォーマンス設定を保存しました。', 'copipe-theme') . '</p></div>';
    }
    
    $options = copipe_get_all_options();
    ?>
    <div class="wrap">
        <h1><?php _e('パフォーマンス設定', 'copipe-theme'); ?></h1>
        
        <form method="post">
            <?php wp_nonce_field('copipe_performance_nonce'); ?>
            
            <table class="form-table">
                <tr>
                    <th scope="row"><?php _e('キャッシュ機能', 'copipe-theme'); ?></th>
                    <td>
                        <label>
                            <input type="checkbox" name="enable_caching" <?php checked($options['enable_caching'] ?? false); ?> />
                            <?php _e('ページキャッシュを有効にする', 'copipe-theme'); ?>
                        </label>
                        <p class="description"><?php _e('ページの読み込み速度を向上させます', 'copipe-theme'); ?></p>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><?php _e('キャッシュ有効期限', 'copipe-theme'); ?></th>
                    <td>
                        <select name="cache_expiration">
                            <option value="1800" <?php selected($options['cache_expiration'] ?? 3600, 1800); ?>><?php _e('30分', 'copipe-theme'); ?></option>
                            <option value="3600" <?php selected($options['cache_expiration'] ?? 3600, 3600); ?>><?php _e('1時間', 'copipe-theme'); ?></option>
                            <option value="7200" <?php selected($options['cache_expiration'] ?? 3600, 7200); ?>><?php _e('2時間', 'copipe-theme'); ?></option>
                            <option value="21600" <?php selected($options['cache_expiration'] ?? 3600, 21600); ?>><?php _e('6時間', 'copipe-theme'); ?></option>
                            <option value="86400" <?php selected($options['cache_expiration'] ?? 3600, 86400); ?>><?php _e('24時間', 'copipe-theme'); ?></option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><?php _e('CSS/JS最適化', 'copipe-theme'); ?></th>
                    <td>
                        <label>
                            <input type="checkbox" name="enable_minification" <?php checked($options['enable_minification'] ?? false); ?> />
                            <?php _e('CSS/JavaScriptを圧縮する', 'copipe-theme'); ?>
                        </label>
                        <p class="description"><?php _e('ファイルサイズを削減して読み込み速度を向上', 'copipe-theme'); ?></p>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><?php _e('遅延読み込み', 'copipe-theme'); ?></th>
                    <td>
                        <label>
                            <input type="checkbox" name="enable_lazy_loading" <?php checked($options['enable_lazy_loading'] ?? true); ?> />
                            <?php _e('画像の遅延読み込みを有効にする', 'copipe-theme'); ?>
                        </label>
                        <p class="description"><?php _e('画面に表示される直前に画像を読み込みます', 'copipe-theme'); ?></p>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><?php _e('画像最適化', 'copipe-theme'); ?></th>
                    <td>
                        <label>
                            <input type="checkbox" name="enable_webp_conversion" <?php checked($options['enable_webp_conversion'] ?? false); ?> />
                            <?php _e('WebP形式への変換を有効にする', 'copipe-theme'); ?>
                        </label>
                        <p class="description"><?php _e('対応ブラウザでより軽量な画像形式を使用', 'copipe-theme'); ?></p>
                    </td>
                </tr>
            </table>
            
            <?php submit_button(); ?>
        </form>
        
        <!-- キャッシュ管理 -->
        <div class="copipe-cache-management">
            <h3><?php _e('キャッシュ管理', 'copipe-theme'); ?></h3>
            <p>
                <button type="button" class="button" onclick="copipeClearCache()">
                    <?php _e('キャッシュをクリア', 'copipe-theme'); ?>
                </button>
                <span id="cache-status"></span>
            </p>
        </div>
    </div>
    
    <script>
    function copipeClearCache() {
        const statusEl = document.getElementById('cache-status');
        statusEl.textContent = '<?php echo esc_js(__('処理中...', 'copipe-theme')); ?>';
        
        fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'action=copipe_clear_cache&nonce=<?php echo wp_create_nonce('copipe_clear_cache'); ?>'
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                statusEl.textContent = '<?php echo esc_js(__('キャッシュをクリアしました', 'copipe-theme')); ?>';
                statusEl.style.color = 'green';
            } else {
                statusEl.textContent = '<?php echo esc_js(__('エラーが発生しました', 'copipe-theme')); ?>';
                statusEl.style.color = 'red';
            }
            
            setTimeout(() => {
                statusEl.textContent = '';
            }, 3000);
        });
    }
    </script>
    <?php
}

/**
 * セキュリティ設定ページ
 */
function copipe_admin_security_page() {
    if (isset($_POST['submit'])) {
        $options = copipe_get_all_options();
        
        $options['disable_xmlrpc'] = isset($_POST['disable_xmlrpc']);
        $options['hide_wp_version'] = isset($_POST['hide_wp_version']);
        $options['disable_file_editing'] = isset($_POST['disable_file_editing']);
        $options['limit_login_attempts'] = isset($_POST['limit_login_attempts']);
        $options['max_login_attempts'] = intval($_POST['max_login_attempts'] ?? 5);
        $options['enable_security_headers'] = isset($_POST['enable_security_headers']);
        
        update_option('copipe_theme_options', $options);
        
        echo '<div class="notice notice-success"><p>' . 
             __('セキュリティ設定を保存しました。', 'copipe-theme') . '</p></div>';
    }
    
    $options = copipe_get_all_options();
    ?>
    <div class="wrap">
        <h1><?php _e('セキュリティ設定', 'copipe-theme'); ?></h1>
        
        <form method="post">
            <?php wp_nonce_field('copipe_security_nonce'); ?>
            
            <table class="form-table">
                <tr>
                    <th scope="row"><?php _e('基本セキュリティ', 'copipe-theme'); ?></th>
                    <td>
                        <fieldset>
                            <label>
                                <input type="checkbox" name="disable_xmlrpc" <?php checked($options['disable_xmlrpc'] ?? true); ?> />
                                <?php _e('XML-RPCを無効にする', 'copipe-theme'); ?>
                            </label><br>
                            <label>
                                <input type="checkbox" name="hide_wp_version" <?php checked($options['hide_wp_version'] ?? true); ?> />
                                <?php _e('WordPressバージョン情報を隠す', 'copipe-theme'); ?>
                            </label><br>
                            <label>
                                <input type="checkbox" name="disable_file_editing" <?php checked($options['disable_file_editing'] ?? true); ?> />
                                <?php _e('管理画面でのファイル編集を無効にする', 'copipe-theme'); ?>
                            </label>
                        </fieldset>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><?php _e('ログイン保護', 'copipe-theme'); ?></th>
                    <td>
                        <label>
                            <input type="checkbox" name="limit_login_attempts" <?php checked($options['limit_login_attempts'] ?? true); ?> />
                            <?php _e('ログイン試行回数を制限する', 'copipe-theme'); ?>
                        </label>
                        <p>
                            <?php _e('最大試行回数:', 'copipe-theme'); ?>
                            <input type="number" name="max_login_attempts" value="<?php echo esc_attr($options['max_login_attempts'] ?? 5); ?>" min="3" max="10" style="width: 60px;" />
                            <?php _e('回', 'copipe-theme'); ?>
                        </p>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><?php _e('セキュリティヘッダー', 'copipe-theme'); ?></th>
                    <td>
                        <label>
                            <input type="checkbox" name="enable_security_headers" <?php checked($options['enable_security_headers'] ?? true); ?> />
                            <?php _e('セキュリティヘッダーを有効にする', 'copipe-theme'); ?>
                        </label>
                        <p class="description"><?php _e('X-Frame-Options、X-XSS-Protection等を設定', 'copipe-theme'); ?></p>
                    </td>
                </tr>
            </table>
            
            <?php submit_button(); ?>
        </form>
        
        <!-- セキュリティ診断 -->
        <div class="copipe-security-check">
            <h3><?php _e('セキュリティ診断', 'copipe-theme'); ?></h3>
            <?php copipe_security_check_display(); ?>
        </div>
    </div>
    <?php
}

/**
 * オプションの取得
 */
function copipe_get_all_options() {
    $defaults = [
        'site_description' => '',
        'contact_email' => get_option('admin_email'),
        'copyright_text' => '',
        'show_sidebar' => false,
        'posts_per_page' => 10,
        'archive_layout' => 'grid',
        'excerpt_length' => 55,
        'show_comments' => true,
        'show_related_posts' => true,
        'adsense_client' => '',
        'adsense_slots' => ['header' => '', 'content' => '', 'sidebar' => '', 'footer' => ''],
        'adsense_auto_ads' => false,
        'disable_mobile_ads' => false,
        'meta_description' => '',
        'meta_keywords' => '',
        'google_analytics' => '',
        'google_search_console' => '',
        'enable_schema_markup' => true,
        'enable_og_tags' => true,
        'enable_caching' => false,
        'enable_minification' => false,
        'enable_lazy_loading' => true,
        'enable_webp_conversion' => false,
        'cache_expiration' => 3600,
        'disable_xmlrpc' => true,
        'hide_wp_version' => true,
        'disable_file_editing' => true,
        'limit_login_attempts' => true,
        'max_login_attempts' => 5,
        'enable_security_headers' => true
    ];
    
    return array_merge($defaults, get_option('copipe_theme_options', []));
}

/**
 * オプションのサニタイズ
 */
function copipe_sanitize_options($options) {
    $clean = [];
    
    foreach ($options as $key => $value) {
        switch ($key) {
            case 'site_description':
            case 'meta_description':
                $clean[$key] = sanitize_textarea_field($value);
                break;
            case 'contact_email':
                $clean[$key] = sanitize_email($value);
                break;
            case 'posts_per_page':
            case 'excerpt_length':
            case 'max_login_attempts':
            case 'cache_expiration':
                $clean[$key] = intval($value);
                break;
            case 'adsense_slots':
                if (is_array($value)) {
                    $clean[$key] = array_map('sanitize_text_field', $value);
                }
                break;
            default:
                if (is_bool($value)) {
                    $clean[$key] = $value;
                } else {
                    $clean[$key] = sanitize_text_field($value);
                }
        }
    }
    
    return $clean;
}

/**
 * サイト統計の取得
 */
function copipe_get_site_stats() {
    return [
        [
            'value' => wp_count_posts('post')->publish,
            'label' => __('投稿数', 'copipe-theme')
        ],
        [
            'value' => wp_count_posts('page')->publish,
            'label' => __('固定ページ数', 'copipe-theme')
        ],
        [
            'value' => wp_count_comments()->approved,
            'label' => __('承認済みコメント', 'copipe-theme')
        ],
        [
            'value' => count(get_categories(['hide_empty' => false])),
            'label' => __('カテゴリ数', 'copipe-theme')
        ]
    ];
}

/**
 * 管理画面用CSS
 */
//function copipe_admin_styles() {
//    wp_enqueue_style(
//        'copipe-admin-style',
//        get_template_directory_uri() . '/assets/css/admin.css',
//        [],
//        COPIPE_THEME_VERSION
//    );
//}
//add_action('admin_enqueue_scripts', 'copipe_admin_styles');
