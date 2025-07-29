<?php
/**
 * 管理画面設定
 * copipe-theme_postpilot_v3
 */

// 管理画面メニュー追加
function copipe_admin_menu() {
    add_theme_page(
        'テーマ設定',
        'テーマ設定',
        'manage_options',
        'copipe-theme-settings',
        'copipe_admin_page'
    );
}
add_action('admin_menu', 'copipe_admin_menu');

// 管理画面ページ
function copipe_admin_page() {
    // 設定保存処理
    if (isset($_POST['submit'])) {
        check_admin_referer('copipe_settings');
        
        // LINE誘導URL設定
        update_option('copipe_line_url', sanitize_url($_POST['copipe_line_url']));
        
        // GA4トラッキングID
        update_option('copipe_ga4_id', sanitize_text_field($_POST['copipe_ga4_id']));
        
        // PostPilot LP設定
        update_option('copipe_postpilot_hero_title', sanitize_text_field($_POST['copipe_postpilot_hero_title']));
        update_option('copipe_postpilot_hero_subtitle', sanitize_textarea_field($_POST['copipe_postpilot_hero_subtitle']));
        update_option('copipe_postpilot_cta_text', sanitize_text_field($_POST['copipe_postpilot_cta_text']));
        
        // フッター設定
        update_option('copipe_footer_text', sanitize_textarea_field($_POST['copipe_footer_text']));
        
        echo '<div class="notice notice-success"><p>設定を保存しました。</p></div>';
    }
    
    // 現在の設定値取得
    $line_url = get_option('copipe_line_url', '');
    $ga4_id = get_option('copipe_ga4_id', '');
    $hero_title = get_option('copipe_postpilot_hero_title', 'PostPilot');
    $hero_subtitle = get_option('copipe_postpilot_hero_subtitle', 'SNS投稿を自動化するAIツール');
    $cta_text = get_option('copipe_postpilot_cta_text', '今すぐ無料で始める');
    $footer_text = get_option('copipe_footer_text', '');
    ?>
    
    <div class="wrap">
        <h1>copipe-theme テーマ設定</h1>
        
        <form method="post" action="">
            <?php wp_nonce_field('copipe_settings'); ?>
            
            <table class="form-table">
                <tr>
                    <th scope="row">
                        <label for="copipe_line_url">LINE誘導URL</label>
                    </th>
                    <td>
                        <input type="url" id="copipe_line_url" name="copipe_line_url" value="<?php echo esc_url($line_url); ?>" class="regular-text" />
                        <p class="description">PostPilot LPからのLINE誘導先URL</p>
                    </td>
                </tr>
                
                <tr>
                    <th scope="row">
                        <label for="copipe_ga4_id">GA4トラッキングID</label>
                    </th>
                    <td>
                        <input type="text" id="copipe_ga4_id" name="copipe_ga4_id" value="<?php echo esc_attr($ga4_id); ?>" class="regular-text" placeholder="G-XXXXXXXXXX" />
                        <p class="description">Google Analytics 4のトラッキングID</p>
                    </td>
                </tr>
            </table>
            
            <h2>PostPilot LP設定</h2>
            <table class="form-table">
                <tr>
                    <th scope="row">
                        <label for="copipe_postpilot_hero_title">ヒーロータイトル</label>
                    </th>
                    <td>
                        <input type="text" id="copipe_postpilot_hero_title" name="copipe_postpilot_hero_title" value="<?php echo esc_attr($hero_title); ?>" class="regular-text" />
                    </td>
                </tr>
                
                <tr>
                    <th scope="row">
                        <label for="copipe_postpilot_hero_subtitle">ヒーローサブタイトル</label>
                    </th>
                    <td>
                        <textarea id="copipe_postpilot_hero_subtitle" name="copipe_postpilot_hero_subtitle" rows="3" class="large-text"><?php echo esc_textarea($hero_subtitle); ?></textarea>
                    </td>
                </tr>
                
                <tr>
                    <th scope="row">
                        <label for="copipe_postpilot_cta_text">CTAボタンテキスト</label>
                    </th>
                    <td>
                        <input type="text" id="copipe_postpilot_cta_text" name="copipe_postpilot_cta_text" value="<?php echo esc_attr($cta_text); ?>" class="regular-text" />
                    </td>
                </tr>
            </table>
            
            <h2>サイト全般設定</h2>
            <table class="form-table">
                <tr>
                    <th scope="row">
                        <label for="copipe_footer_text">フッターテキスト</label>
                    </th>
                    <td>
                        <textarea id="copipe_footer_text" name="copipe_footer_text" rows="4" class="large-text"><?php echo esc_textarea($footer_text); ?></textarea>
                        <p class="description">フッターに表示するテキスト（HTMLタグ使用可）</p>
                    </td>
                </tr>
            </table>
            
            <?php submit_button('設定を保存'); ?>
        </form>
        
        <hr>
        
        <h2>テーマ情報</h2>
        <p><strong>テーマ名:</strong> copipe-theme_postpilot_v3</p>
        <p><strong>バージョン:</strong> 3.0.0</p>
        <p><strong>対応サイト:</strong> <a href="https://numaken.net/" target="_blank">https://numaken.net/</a></p>
        
        <h3>使用方法</h3>
        <ul>
            <li><strong>PostPilot LP作成:</strong> 固定ページ作成時に「PostPilot LPテンプレート」を選択</li>
            <li><strong>通常ページ:</strong> デフォルトテンプレートまたは「page-about.php」「page-profile.php」を使用</li>
            <li><strong>AIプロンプト投稿:</strong> 管理画面の「AIプロンプト」から投稿を作成</li>
        </ul>
        
        <h3>パフォーマンス</h3>
        <p>UIkitはLPページでのみ読み込まれ、通常ページでは軽量化を優先した設計になっています。</p>
    </div>
    <?php
}

// カスタムフィールド追加（投稿編集画面）
function copipe_add_custom_fields() {
    add_meta_box(
        'copipe_post_settings',
        '投稿設定',
        'copipe_post_settings_callback',
        'post',
        'side',
        'default'
    );
    
    add_meta_box(
        'copipe_post_settings',
        '投稿設定',
        'copipe_post_settings_callback',
        'ai_prompt',
        'side',
        'default'
    );
}
add_action('add_meta_boxes', 'copipe_add_custom_fields');

// カスタムフィールドのコールバック
function copipe_post_settings_callback($post) {
    wp_nonce_field(basename(__FILE__), 'copipe_post_nonce');
    
    $featured = get_post_meta($post->ID, '_copipe_featured', true);
    $external_url = get_post_meta($post->ID, '_copipe_external_url', true);
    ?>
    
    <p>
        <label>
            <input type="checkbox" name="copipe_featured" value="1" <?php checked($featured, 1); ?> />
            注目記事として表示
        </label>
    </p>
    
    <p>
        <label for="copipe_external_url">外部リンクURL:</label><br>
        <input type="url" id="copipe_external_url" name="copipe_external_url" value="<?php echo esc_url($external_url); ?>" style="width: 100%;" />
        <small>設定すると、記事タイトルクリック時に外部サイトに遷移します</small>
    </p>
    <?php
}

// カスタムフィールド保存
function copipe_save_post_settings($post_id) {
    if (!isset($_POST['copipe_post_nonce']) || !wp_verify_nonce($_POST['copipe_post_nonce'], basename(__FILE__))) {
        return $post_id;
    }
    
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return $post_id;
    if (!current_user_can('edit_post', $post_id)) return $post_id;
    
    // 注目記事設定
    $featured = isset($_POST['copipe_featured']) ? 1 : 0;
    update_post_meta($post_id, '_copipe_featured', $featured);
    
    // 外部URL設定
    $external_url = sanitize_url($_POST['copipe_external_url']);
    update_post_meta($post_id, '_copipe_external_url', $external_url);
}
add_action('save_post', 'copipe_save_post_settings');

// 管理画面CSS
function copipe_admin_styles() {
    echo '<style>
        .copipe-admin-notice {
            background: #e7f3ff;
            border-left: 4px solid #0073aa;
            padding: 10px;
            margin: 20px 0;
        }
        .copipe-settings-section {
            margin-bottom: 30px;
        }
        .copipe-feature-list {
            list-style: none;
            padding: 0;
        }
        .copipe-feature-list li {
            padding: 8px 0;
            border-bottom: 1px solid #eee;
        }
        .copipe-feature-list li:before {
            content: "✓ ";
            color: #46b450;
            font-weight: bold;
            margin-right: 8px;
        }
    </style>';
}
add_action('admin_head', 'copipe_admin_styles');

// Google Analytics 4 トラッキングコード挿入
function copipe_insert_ga4() {
    $ga4_id = get_option('copipe_ga4_id');
    if (empty($ga4_id)) return;
    ?>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo esc_attr($ga4_id); ?>"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '<?php echo esc_attr($ga4_id); ?>');
    </script>
    <?php
}
add_action('wp_head', 'copipe_insert_ga4');

// 管理バー非表示（フロントエンド）
function copipe_hide_admin_bar() {
    if (!current_user_can('administrator') && !is_admin()) {
        show_admin_bar(false);
    }
}
add_action('after_setup_theme', 'copipe_hide_admin_bar');
?>