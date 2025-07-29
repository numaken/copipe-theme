<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package copipe-theme
 * @version 3.0.0
 */

get_header(); ?>

<main id="primary" class="main-content">
    <div class="container">
        <div class="content-area">
            
            <section class="error-404 not-found">
                <div class="error-container">
                    
                    <!-- Error Animation -->
                    <div class="error-animation">
                        <div class="error-number">
                            <span class="digit">4</span>
                            <span class="digit animated">0</span>
                            <span class="digit">4</span>
                        </div>
                        <div class="error-illustration">
                            <div class="floating-icons">
                                <span class="icon icon-1">😵</span>
                                <span class="icon icon-2">📄</span>
                                <span class="icon icon-3">🔍</span>
                                <span class="icon icon-4">❓</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Error Content -->
                    <header class="error-header">
                        <h1 class="error-title">
                            <span class="title-main">ページが見つかりません</span>
                            <span class="title-sub">Page Not Found</span>
                        </h1>
                        <p class="error-message">
                            申し訳ございません。お探しのページは移動、削除、または一時的にアクセスできない状態です。<br>
                            以下の方法で目的のページを見つけてください。
                        </p>
                    </header><!-- .error-header -->
                    
                    <!-- Quick Actions -->
                    <div class="quick-actions">
                        <div class="action-group">
                            <h3 class="action-title">🔍 すぐに検索</h3>
                            <form role="search" method="get" class="error-search-form" action="<?php echo esc_url(home_url('/')); ?>">
                                <div class="search-wrapper">
                                    <input type="search" 
                                           class="search-field" 
                                           placeholder="キーワードを入力してください..." 
                                           name="s" 
                                           title="検索キーワードを入力" />
                                    <button type="submit" class="search-submit">
                                        <span class="search-icon">🔍</span>
                                        <span class="search-text">検索</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                        
                        <div class="action-group">
                            <h3 class="action-title">🏠 ホームに戻る</h3>
                            <a href="<?php echo esc_url(home_url('/')); ?>" class="home-btn">
                                <span class="btn-icon">🏠</span>
                                <span class="btn-text">トップページへ</span>
                            </a>
                        </div>
                        
                        <div class="action-group">
                            <h3 class="action-title">📞 お問い合わせ</h3>
                            <?php if (get_page_by_path('contact')) : ?>
                                <a href="<?php echo esc_url(get_permalink(get_page_by_path('contact'))); ?>" class="contact-btn">
                                    <span class="btn-icon">📧</span>
                                    <span class="btn-text">お問い合わせ</span>
                                </a>
                            <?php else : ?>
                                <a href="mailto:info@example.com" class="contact-btn">
                                    <span class="btn-icon">📧</span>
                                    <span class="btn-text">メールで連絡</span>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <!-- Suggestions -->
                    <div class="error-suggestions">
                        <h2 class="suggestions-title">こちらもおすすめです</h2>
                        
                        <div class="suggestions-grid">
                            
                            <!-- Popular Categories -->
                            <div class="suggestion-card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <span class="card-icon">📂</span>
                                        人気のカテゴリー
                                    </h3>
                                </div>
                                <div class="card-content">
                                    <?php
                                    $popular_categories = get_categories(array(
                                        'orderby' => 'count',
                                        'order' => 'DESC',
                                        'number' => 6,
                                        'hide_empty' => true
                                    ));
                                    
                                    if (!empty($popular_categories)) :
                                    ?>
                                        <ul class="categories-list">
                                            <?php foreach ($popular_categories as $category) : ?>
                                                <li class="category-item">
                                                    <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" 
                                                       class="category-link">
                                                        <span class="category-name"><?php echo esc_html($category->name); ?></span>
                                                        <span class="category-count"><?php echo $category->count; ?>件</span>
                                                    </a>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php else : ?>
                                        <p class="no-categories">カテゴリーがまだありません。</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                            <!-- Recent Posts -->
                            <div class="suggestion-card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <span class="card-icon">🆕</span>
                                        最新記事
                                    </h3>
                                </div>
                                <div class="card-content">
                                    <?php
                                    $recent_posts = get_posts(array(
                                        'posts_per_page' => 5,
                                        'orderby' => 'date',
                                        'order' => 'DESC',
                                        'post_status' => 'publish'
                                    ));
                                    
                                    if (!empty($recent_posts)) :
                                    ?>
                                        <ul class="posts-list">
                                            <?php foreach ($recent_posts as $recent_post) : ?>
                                                <li class="post-item">
                                                    <a href="<?php echo esc_url(get_permalink($recent_post->ID)); ?>" 
                                                       class="post-link">
                                                        <div class="post-content">
                                                            <h4 class="post-title"><?php echo esc_html(get_the_title($recent_post->ID)); ?></h4>
                                                            <div class="post-meta">
                                                                <span class="post-date">
                                                                    📅 <?php echo esc_html(get_the_date('Y.m.d', $recent_post->ID)); ?>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php else : ?>
                                        <p class="no-posts">記事がまだありません。</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                            <!-- AI Prompts -->
                            <div class="suggestion-card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <span class="card-icon">🤖</span>
                                        AIプロンプト
                                    </h3>
                                </div>
                                <div class="card-content">
                                    <?php
                                    $ai_prompts = get_posts(array(
                                        'post_type' => 'ai_prompt',
                                        'posts_per_page' => 5,
                                        'orderby' => 'date',
                                        'order' => 'DESC',
                                        'post_status' => 'publish'
                                    ));
                                    
                                    if (!empty($ai_prompts)) :
                                    ?>
                                        <ul class="prompts-list">
                                            <?php foreach ($ai_prompts as $prompt) : ?>
                                                <li class="prompt-item">
                                                    <a href="<?php echo esc_url(get_permalink($prompt->ID)); ?>" 
                                                       class="prompt-link">
                                                        <div class="prompt-content">
                                                            <h4 class="prompt-title"><?php echo esc_html(get_the_title($prompt->ID)); ?></h4>
                                                            <div class="prompt-meta">
                                                                <?php if (get_field('difficulty', $prompt->ID)) : ?>
                                                                    <span class="prompt-difficulty difficulty-<?php echo esc_attr(get_field('difficulty', $prompt->ID)); ?>">
                                                                        <?php
                                                                        $difficulty = get_field('difficulty', $prompt->ID);
                                                                        $difficulty_labels = array(
                                                                            'beginner' => '初級',
                                                                            'intermediate' => '中級',
                                                                            'advanced' => '上級'
                                                                        );
                                                                        echo esc_html($difficulty_labels[$difficulty] ?? '初級');
                                                                        ?>
                                                                    </span>
                                                                <?php endif; ?>
                                                                
                                                                <?php if (get_field('use_case', $prompt->ID)) : ?>
                                                                    <span class="prompt-usecase">
                                                                        📝 <?php echo esc_html(get_field('use_case', $prompt->ID)); ?>
                                                                    </span>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                        
                                        <div class="view-all">
                                            <a href="<?php echo esc_url(get_post_type_archive_link('ai_prompt')); ?>" 
                                               class="view-all-link">
                                                すべてのAIプロンプトを見る →
                                            </a>
                                        </div>
                                    <?php else : ?>
                                        <p class="no-prompts">AIプロンプトがまだありません。</p>
                                        
                                        <!-- PostPilot CTA -->
                                        <div class="postpilot-cta-mini">
                                            <p class="cta-text">AIライティングに興味がありますか？</p>
                                            <a href="/postpilot" class="cta-link">
                                                PostPilotを試してみる
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                            <!-- Site Map -->
                            <div class="suggestion-card">
                                <div class="card-header">
                                    <h3 class="card-title">
                                        <span class="card-icon">🗺️</span>
                                        サイトマップ
                                    </h3>
                                </div>
                                <div class="card-content">
                                    <div class="sitemap-section">
                                        <h4 class="sitemap-section-title">主要ページ</h4>
                                        <ul class="sitemap-list">
                                            <li><a href="<?php echo esc_url(home_url('/')); ?>">ホーム</a></li>
                                            
                                            <?php if (get_option('page_for_posts')) : ?>
                                                <li><a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>">ブログ</a></li>
                                            <?php endif; ?>
                                            
                                            <?php if (get_page_by_path('about')) : ?>
                                                <li><a href="<?php echo esc_url(get_permalink(get_page_by_path('about'))); ?>">About</a></li>
                                            <?php endif; ?>
                                            
                                            <?php if (get_page_by_path('postpilot')) : ?>
                                                <li><a href="<?php echo esc_url(get_permalink(get_page_by_path('postpilot'))); ?>">PostPilot</a></li>
                                            <?php endif; ?>
                                            
                                            <?php if (get_page_by_path('contact')) : ?>
                                                <li><a href="<?php echo esc_url(get_permalink(get_page_by_path('contact'))); ?>">お問い合わせ</a></li>
                                            <?php endif; ?>
                                            
                                            <?php if (get_post_type_archive_link('ai_prompt')) : ?>
                                                <li><a href="<?php echo esc_url(get_post_type_archive_link('ai_prompt')); ?>">AIプロンプト一覧</a></li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                    
                                    <div class="sitemap-section">
                                        <h4 class="sitemap-section-title">カテゴリー</h4>
                                        <ul class="sitemap-list">
                                            <?php
                                            $main_categories = get_categories(array(
                                                'orderby' => 'count',
                                                'order' => 'DESC',
                                                'number' => 4,
                                                'hide_empty' => true
                                            ));
                                            
                                            foreach ($main_categories as $category) :
                                            ?>
                                                <li>
                                                    <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>">
                                                        <?php echo esc_html($category->name); ?>
                                                    </a>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    
                    <!-- Help Information -->
                    <div class="help-information">
                        <h2 class="help-title">💡 よくある原因</h2>
                        <div class="help-grid">
                            <div class="help-item">
                                <div class="help-icon">🔗</div>
                                <h3 class="help-item-title">リンクの入力ミス</h3>
                                <p class="help-description">URLに誤字・脱字がないか確認してください。</p>
                            </div>
                            
                            <div class="help-item">
                                <div class="help-icon">📱</div>
                                <h3 class="help-item-title">ブックマークが古い</h3>
                                <p class="help-description">保存されたブックマークが古い可能性があります。</p>
                            </div>
                            
                            <div class="help-item">
                                <div class="help-icon">🚧</div>
                                <h3 class="help-item-title">ページが移動・削除</h3>
                                <p class="help-description">該当のページが移動または削除されている可能性があります。</p>
                            </div>
                            
                            <div class="help-item">
                                <div class="help-icon">⏰</div>
                                <h3 class="help-item-title">一時的なエラー</h3>
                                <p class="help-description">サーバーの一時的な問題かもしれません。しばらく待ってから再度お試しください。</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Contact Support -->
                    <div class="support-section">
                        <div class="support-content">
                            <h3 class="support-title">🆘 まだ問題が解決しませんか？</h3>
                            <p class="support-message">
                                上記の方法で解決しない場合は、お気軽にお問い合わせください。<br>
                                できるだけ早くサポートいたします。
                            </p>
                            <div class="support-actions">
                                <?php if (get_page_by_path('contact')) : ?>
                                    <a href="<?php echo esc_url(get_permalink(get_page_by_path('contact'))); ?>" 
                                       class="support-btn primary">
                                        <span class="btn-icon">📧</span>
                                        <span class="btn-text">お問い合わせフォーム</span>
                                    </a>
                                <?php endif; ?>
                                
                                <?php if (get_option('copipe_line_url')) : ?>
                                    <a href="<?php echo esc_url(get_option('copipe_line_url')); ?>" 
                                       class="support-btn secondary"
                                       target="_blank"
                                       rel="noopener">
                                        <span class="btn-icon">💬</span>
                                        <span class="btn-text">LINE で相談</span>
                                    </a>
                                <?php endif; ?>
                            </div>
                            
                            <div class="response-time">
                                <span class="response-icon">⚡</span>
                                <span class="response-text">通常24時間以内に返信いたします</span>
                            </div>
                        </div>
                    </div>
                    
                </div><!-- .error-container -->
            </section><!-- .error-404 -->
            
        </div><!-- .content-area -->
        
        <aside id="secondary" class="widget-area">
            
            <!-- Error Stats Widget -->
            <div class="widget error-stats-widget">
                <h3 class="widget-title">📊 サイト統計</h3>
                <div class="widget-content">
                    <div class="stats-list">
                        <div class="stat-item">
                            <span class="stat-label">総記事数</span>
                            <span class="stat-value"><?php echo wp_count_posts()->publish; ?>件</span>
                        </div>
                        
                        <div class="stat-item">
                            <span class="stat-label">カテゴリー数</span>
                            <span class="stat-value"><?php echo wp_count_terms('category'); ?>個</span>
                        </div>
                        
                        <?php
                        $ai_prompt_count = wp_count_posts('ai_prompt');
                        if ($ai_prompt_count && $ai_prompt_count->publish > 0) :
                        ?>
                            <div class="stat-item">
                                <span class="stat-label">AIプロンプト数</span>
                                <span class="stat-value"><?php echo $ai_prompt_count->publish; ?>個</span>
                            </div>
                        <?php endif; ?>
                        
                        <div class="stat-item">
                            <span class="stat-label">最終更新</span>
                            <span class="stat-value">
                                <?php
                                $latest_post = get_posts(array(
                                    'posts_per_page' => 1,
                                    'orderby' => 'date',
                                    'order' => 'DESC'
                                ));
                                
                                if (!empty($latest_post)) {
                                    echo esc_html(get_the_date('Y.m.d', $latest_post[0]->ID));
                                } else {
                                    echo '---';
                                }
                                ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Quick Links Widget -->
            <div class="widget quick-links-widget">
                <h3 class="widget-title">🔗 クイックリンク</h3>
                <div class="widget-content">
                    <ul class="quick-links-list">
                        <li>
                            <a href="<?php echo esc_url(home_url('/')); ?>" class="quick-link">
                                <span class="link-icon">🏠</span>
                                <span class="link-text">ホーム</span>
                            </a>
                        </li>
                        
                        <?php if (get_page_by_path('about')) : ?>
                            <li>
                                <a href="<?php echo esc_url(get_permalink(get_page_by_path('about'))); ?>" class="quick-link">
                                    <span class="link-icon">ℹ️</span>
                                    <span class="link-text">サイトについて</span>
                                </a>
                            </li>
                        <?php endif; ?>
                        
                        <li>
                            <a href="<?php echo esc_url(home_url('/feed/')); ?>" class="quick-link" target="_blank">
                                <span class="link-icon">📡</span>
                                <span class="link-text">RSS フィード</span>
                            </a>
                        </li>
                        
                        <?php if (get_page_by_path('privacy-policy')) : ?>
                            <li>
                                <a href="<?php echo esc_url(get_permalink(get_page_by_path('privacy-policy'))); ?>" class="quick-link">
                                    <span class="link-icon">🔒</span>
                                    <span class="link-text">プライバシーポリシー</span>
                                </a>
                            </li>
                        <?php endif; ?>
                        
                        <?php if (get_page_by_path('terms')) : ?>
                            <li>
                                <a href="<?php echo esc_url(get_permalink(get_page_by_path('terms'))); ?>" class="quick-link">
                                    <span class="link-icon">📄</span>
                                    <span class="link-text">利用規約</span>
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
            
            <?php dynamic_sidebar('sidebar-1'); ?>
        </aside><!-- #secondary -->
        
    </div><!-- .container -->
</main><!-- #primary -->

<style>
/* 404 Error Page Styles */
.error-404 {
    padding: 2rem 0;
}

.error-container {
    max-width: 1000px;
    margin: 0 auto;
}

/* Error Animation */
.error-animation {
    text-align: center;
    margin-bottom: 3rem;
    position: relative;
}

.error-number {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 1rem;
    margin-bottom: 2rem;
}

.digit {
    font-size: clamp(4rem, 15vw, 8rem);
    font-weight: 800;
    color: #2c5aa0;
    text-shadow: 0 4px 8px rgba(44, 90, 160, 0.3);
}

.digit.animated {
    animation: bounce 2s infinite;
    background: linear-gradient(45deg, #ff6b35, #ffa726);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

@keyframes bounce {
    0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
    40% { transform: translateY(-20px); }
    60% { transform: translateY(-10px); }
}

.error-illustration {
    position: relative;
    height: 100px;
    margin: 2rem 0;
}

.floating-icons {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
}

.icon {
    position: absolute;
    font-size: 2rem;
    opacity: 0.6;
    animation: float 3s ease-in-out infinite;
}

.icon-1 { top: 20%; left: 20%; animation-delay: 0s; }
.icon-2 { top: 10%; right: 25%; animation-delay: 0.5s; }
.icon-3 { bottom: 20%; left: 30%; animation-delay: 1s; }
.icon-4 { bottom: 10%; right: 20%; animation-delay: 1.5s; }

@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-15px); }
}

/* Error Header */
.error-header {
    text-align: center;
    margin-bottom: 4rem;
}

.error-title {
    margin-bottom: 1.5rem;
}

.title-main {
    display: block;
    font-size: clamp(2rem, 5vw, 3.5rem);
    color: #2c5aa0;
    font-weight: 700;
    margin-bottom: 0.5rem;
}

.title-sub {
    display: block;
    font-size: 1.2rem;
    color: #666;
    font-weight: 400;
    font-style: italic;
}

.error-message {
    color: #555;
    font-size: 1.1rem;
    line-height: 1.8;
    max-width: 600px;
    margin: 0 auto;
}

/* Quick Actions */
.quick-actions {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
    margin-bottom: 4rem;
}

.action-group {
    background: white;
    padding: 2rem;
    border-radius: 15px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    text-align: center;
    transition: all 0.3s ease;
}

.action-group:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

.action-title {
    color: #2c5aa0;
    font-size: 1.2rem;
    margin-bottom: 1.5rem;
    font-weight: 600;
}

.error-search-form {
    margin-bottom: 1rem;
}

.search-wrapper {
    display: flex;
    gap: 0.5rem;
}

.search-field {
    flex: 1;
    padding: 1rem;
    border: 2px solid #e0e0e0;
    border-radius: 25px;
    background: #f8f9fa;
    transition: all 0.3s ease;
}

.search-field:focus {
    outline: none;
    border-color: #2c5aa0;
    background: white;
}

.search-submit {
    background: linear-gradient(135deg, #2c5aa0, #ff6b35);
    color: white;
    border: none;
    padding: 1rem 1.5rem;
    border-radius: 25px;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 600;
    transition: all 0.3s ease;
}

.search-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(44, 90, 160, 0.3);
}

.home-btn,
.contact-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.8rem;
    background: linear-gradient(135deg, #2c5aa0, #1e3f73);
    color: white;
    text-decoration: none;
    padding: 1.2rem 2rem;
    border-radius: 50px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.contact-btn {
    background: linear-gradient(135deg, #00c851, #00a844);
}

.home-btn:hover,
.contact-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.2);
    color: white;
}

/* Suggestions */
.error-suggestions {
    margin-bottom: 4rem;
}

.suggestions-title {
    color: #2c5aa0;
    font-size: 2rem;
    text-align: center;
    margin-bottom: 3rem;
    font-weight: 700;
}

.suggestions-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
}

.suggestion-card {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}

.suggestion-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

.card-header {
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    padding: 1.5rem;
    border-bottom: 1px solid #e0e0e0;
}

.card-title {
    color: #2c5aa0;
    font-size: 1.2rem;
    margin: 0;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.card-icon {
    font-size: 1.3rem;
}

.card-content {
    padding: 1.5rem;
}

.categories-list,
.posts-list,
.prompts-list,
.sitemap-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.category-item,
.post-item,
.prompt-item {
    margin-bottom: 0.8rem;
}

.category-link,
.post-link,
.prompt-link {
    display: block;
    padding: 1rem;
    background: #f8f9fa;
    border-radius: 8px;
    text-decoration: none;
    color: inherit;
    transition: all 0.3s ease;
}

.category-link:hover,
.post-link:hover,
.prompt-link:hover {
    background: #2c5aa0;
    color: white;
    transform: translateX(5px);
}

.category-link {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.category-name {
    font-weight: 500;
}

.category-count {
    background: white;
    color: #666;
    padding: 0.2rem 0.6rem;
    border-radius: 10px;
    font-size: 0.8rem;
    font-weight: 600;
}

.category-link:hover .category-count {
    background: rgba(255,255,255,0.2);
    color: white;
}

.post-title,
.prompt-title {
    color: #2c5aa0;
    font-size: 1rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
    line-height: 1.4;
}

.post-link:hover .post-title,
.prompt-link:hover .prompt-title {
    color: white;
}

.post-meta,
.prompt-meta {
    display: flex;
    gap: 1rem;
    align-items: center;
    font-size: 0.8rem;
    color: #666;
}

.post-link:hover .post-meta,
.prompt-link:hover .prompt-meta {
    color: rgba(255,255,255,0.8);
}

.prompt-difficulty {
    padding: 0.2rem 0.6rem;
    border-radius: 10px;
    font-size: 0.8rem;
    font-weight: 500;
    color: white;
}

.difficulty-beginner {
    background: #00c851;
}

.difficulty-intermediate {
    background: #ff6b35;
}

.difficulty-advanced {
    background: #d63031;
}

.view-all {
    margin-top: 1rem;
    text-align: center;
}

.view-all-link {
    color: #2c5aa0;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.3s ease;
}

.view-all-link:hover {
    color: #ff6b35;
}

.postpilot-cta-mini {
    background: linear-gradient(135deg, #f0f8ff, #e3f2fd);
    padding: 1.5rem;
    border-radius: 10px;
    text-align: center;
    border: 1px solid #2c5aa0;
}

.cta-text {
    margin-bottom: 1rem;
    color: #555;
}

.cta-link {
    background: #2c5aa0;
    color: white;
    text-decoration: none;
    padding: 0.8rem 1.5rem;
    border-radius: 25px;
    font-weight: 500;
    display: inline-block;
    transition: all 0.3s ease;
}

.cta-link:hover {
    background: #1e3f73;
    transform: translateY(-2px);
    color: white;
}

.sitemap-section {
    margin-bottom: 2rem;
}

.sitemap-section:last-child {
    margin-bottom: 0;
}

.sitemap-section-title {
    color: #2c5aa0;
    font-size: 1rem;
    margin-bottom: 1rem;
    font-weight: 600;
}

.sitemap-list li {
    margin-bottom: 0.5rem;
}

.sitemap-list a {
    color: #555;
    text-decoration: none;
    padding: 0.5rem 0;
    display: block;
    transition: all 0.3s ease;
}

.sitemap-list a:hover {
    color: #2c5aa0;
    padding-left: 1rem;
}

/* Help Information */
.help-information {
    margin-bottom: 4rem;
}

.help-title {
    color: #2c5aa0;
    font-size: 2rem;
    text-align: center;
    margin-bottom: 3rem;
    font-weight: 700;
}

.help-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
}

.help-item {
    background: #f8f9fa;
    padding: 2rem;
    border-radius: 15px;
    text-align: center;
    border-left: 4px solid #ff6b35;
}

.help-icon {
    font-size: 3rem;
    margin-bottom: 1rem;
}

.help-item-title {
    color: #2c5aa0;
    font-size: 1.2rem;
    margin-bottom: 1rem;
    font-weight: 600;
}

.help-description {
    color: #555;
    line-height: 1.6;
    margin: 0;
}

/* Support Section */
.support-section {
    background: linear-gradient(135deg, #2c5aa0, #1e3f73);
    color: white;
    padding: 3rem 2rem;
    border-radius: 20px;
    text-align: center;
    margin-bottom: 4rem;
}

.support-title {
    font-size: 1.8rem;
    margin-bottom: 1rem;
    font-weight: 700;
}

.support-message {
    font-size: 1.1rem;
    line-height: 1.6;
    margin-bottom: 2rem;
    opacity: 0.9;
}

.support-actions {
    display: flex;
    justify-content: center;
    gap: 1rem;
    flex-wrap: wrap;
    margin-bottom: 2rem;
}

.support-btn {
    display: flex;
    align-items: center;
    gap: 0.8rem;
    padding: 1.2rem 2rem;
    border-radius: 50px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
}

.support-btn.primary {
    background: #ff6b35;
    color: white;
}

.support-btn.secondary {
    background: #00c300;
    color: white;
}

.support-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.2);
    color: white;
}

.response-time {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.9rem;
    opacity: 0.8;
}

/* Error Widgets */
.error-stats-widget,
.quick-links-widget {
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    border: 2px solid #2c5aa0;
}

.error-stats-widget .widget-title,
.quick-links-widget .widget-title {
    background: #2c5aa0;
    color: white;
    margin: -1.5rem -1.5rem 1.5rem -1.5rem;
    padding: 1rem 1.5rem;
}

.stats-list {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.stat-item {
    background: white;
    padding: 1rem;
    border-radius: 8px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.stat-label {
    color: #666;
    font-size: 0.9rem;
    font-weight: 500;
}

.stat-value {
    color: #2c5aa0;
    font-weight: 700;
}

.quick-links-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.quick-links-list li {
    margin-bottom: 0.5rem;
}

.quick-link {
    background: white;
    padding: 1rem;
    border-radius: 8px;
    text-decoration: none;
    color: #333;
    display: flex;
    align-items: center;
    gap: 0.8rem;
    transition: all 0.3s ease;
}

.quick-link:hover {
    background: #2c5aa0;
    color: white;
    transform: translateX(5px);
}

.link-icon {
    font-size: 1.2rem;
}

.link-text {
    font-weight: 500;
}

/* Mobile Responsive */
@media (max-width: 767px) {
    .error-404 {
        padding: 1rem 0;
    }
    
    .digit {
        font-size: 3rem;
    }
    
    .error-number {
        gap: 0.5rem;
    }
    
    .quick-actions {
        grid-template-columns: 1fr;
    }
    
    .action-group {
        padding: 1.5rem;
    }
    
    .search-wrapper {
        flex-direction: column;
    }
    
    .suggestions-grid {
        grid-template-columns: 1fr;
    }
    
    .help-grid {
        grid-template-columns: 1fr;
    }
    
    .support-section {
        padding: 2rem 1rem;
    }
    
    .support-actions {
        flex-direction: column;
        align-items: center;
    }
    
    .icon {
        font-size: 1.5rem;
    }
}

/* Print Styles */
@media print {
    .error-animation,
    .widget-area,
    .support-section {
        display: none;
    }
    
    .suggestion-card {
        box-shadow: none;
        border: 1px solid #ccc;
        break-inside: avoid;
    }
}

/* High Contrast Mode */
@media (prefers-contrast: high) {
    .suggestion-card,
    .action-group,
    .help-item {
        border: 2px solid #000;
    }
}

/* Reduced Motion */
@media (prefers-reduced-motion: reduce) {
    .digit.animated,
    .icon,
    .action-group:hover,
    .suggestion-card:hover {
        animation: none;
        transform: none;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add some interactive elements
    const errorNumber = document.querySelector('.error-number');
    if (errorNumber) {
        errorNumber.addEventListener('click', function() {
            this.style.animation = 'bounce 0.5s ease';
            setTimeout(() => {
                this.style.animation = '';
            }, 500);
        });
    }
    
    // Focus on search field when page loads
    const searchField = document.querySelector('.search-field');
    if (searchField) {
        setTimeout(() => {
            searchField.focus();
        }, 1000);
    }
    
    // Add keyboard navigation for quick actions
    document.addEventListener('keydown', function(e) {
        // Press 'h' to go home
        if (e.key === 'h' || e.key === 'H') {
            const homeBtn = document.querySelector('.home-btn');
            if (homeBtn) {
                homeBtn.click();
            }
        }
        
        // Press 's' to focus search
        if (e.key === 's' || e.key === 'S') {
            e.preventDefault();
            const searchField = document.querySelector('.search-field');
            if (searchField) {
                searchField.focus();
            }
        }
    });
});
</script>

<?php
get_footer();
?>