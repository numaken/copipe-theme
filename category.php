<?php
/**
 * The template for displaying category pages
 *
 * @package copipe-theme
 * @version 3.0.0
 */

get_header(); ?>

<main id="primary" class="main-content">
    <div class="container">
        <div class="content-area">
            
            <?php if (have_posts()) : ?>
                
                <header class="category-header">
                    <div class="category-info">
                        <div class="category-icon">📂</div>
                        <div class="category-details">
                            <span class="category-label">カテゴリー</span>
                            <h1 class="category-title"><?php single_cat_title(); ?></h1>
                            
                            <?php if (category_description()) : ?>
                                <div class="category-description">
                                    <?php echo category_description(); ?>
                                </div>
                            <?php endif; ?>
                            
                            <div class="category-stats">
                                <span class="post-count">
                                    <span class="count-icon">📄</span>
                                    <span class="count-text"><?php echo $wp_query->found_posts; ?>件の記事</span>
                                </span>
                                
                                <span class="category-rss">
                                    <a href="<?php echo get_category_feed_link(get_query_var('cat')); ?>" 
                                       class="rss-link"
                                       title="このカテゴリーのRSSフィード">
                                        <span class="rss-icon">📡</span>
                                        <span class="rss-text">RSS</span>
                                    </a>
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Related Categories -->
                    <?php
                    $current_category = get_queried_object();
                    $related_categories = get_categories(array(
                        'exclude' => $current_category->term_id,
                        'number' => 6,
                        'orderby' => 'count',
                        'order' => 'DESC',
                        'hide_empty' => true
                    ));
                    
                    if (!empty($related_categories)) :
                    ?>
                        <div class="related-categories">
                            <h3 class="related-title">関連カテゴリー</h3>
                            <div class="categories-grid">
                                <?php foreach ($related_categories as $category) : ?>
                                    <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" 
                                       class="category-card">
                                        <div class="card-icon">📁</div>
                                        <div class="card-content">
                                            <div class="card-title"><?php echo esc_html($category->name); ?></div>
                                            <div class="card-count"><?php echo $category->count; ?>件</div>
                                        </div>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                    <!-- Filters & Sort -->
                    <div class="category-controls">
                        <div class="control-group">
                            <div class="sort-options">
                                <label for="category-sort" class="sort-label">並び替え:</label>
                                <select id="category-sort" class="sort-select" onchange="handleCategorySort(this.value)">
                                    <option value="date-desc" <?php echo (get_query_var('orderby') === 'date' && get_query_var('order') === 'DESC') ? 'selected' : ''; ?>>
                                        新しい順
                                    </option>
                                    <option value="date-asc" <?php echo (get_query_var('orderby') === 'date' && get_query_var('order') === 'ASC') ? 'selected' : ''; ?>>
                                        古い順
                                    </option>
                                    <option value="title-asc" <?php echo (get_query_var('orderby') === 'title' && get_query_var('order') === 'ASC') ? 'selected' : ''; ?>>
                                        タイトル順
                                    </option>
                                    <option value="comment-desc" <?php echo (get_query_var('orderby') === 'comment_count') ? 'selected' : ''; ?>>
                                        人気順
                                    </option>
                                </select>
                            </div>
                            
                            <div class="view-toggle">
                                <div class="toggle-buttons">
                                    <button class="toggle-btn active" data-view="grid" title="グリッド表示">
                                        <span class="toggle-icon">⊞</span>
                                    </button>
                                    <button class="toggle-btn" data-view="list" title="リスト表示">
                                        <span class="toggle-icon">☰</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </header><!-- .category-header -->
                
                <div class="posts-container grid-view" id="category-posts-container">
                    <?php while (have_posts()) : the_post(); ?>
                        
                        <article id="post-<?php the_ID(); ?>" <?php post_class('category-post-item'); ?>>
                            
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="post-thumbnail">
                                    <a href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
                                        <?php the_post_thumbnail('copipe-featured', array(
                                            'alt' => the_title_attribute(array('echo' => false))
                                        )); ?>
                                    </a>
                                    
                                    <!-- Post Badges -->
                                    <div class="post-badges">
                                        <?php if (is_sticky()) : ?>
                                            <span class="badge sticky-badge">
                                                <span class="badge-icon">📌</span>
                                                <span class="badge-text">注目</span>
                                            </span>
                                        <?php endif; ?>
                                        
                                        <?php if (get_post_type() === 'ai_prompt') : ?>
                                            <span class="badge prompt-badge">
                                                <span class="badge-icon">🤖</span>
                                                <span class="badge-text">AIプロンプト</span>
                                            </span>
                                        <?php endif; ?>
                                        
                                        <?php if (get_comments_number() > 10) : ?>
                                            <span class="badge popular-badge">
                                                <span class="badge-icon">🔥</span>
                                                <span class="badge-text">人気</span>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                            
                            <div class="post-content">
                                <header class="entry-header">
                                    <?php the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>'); ?>
                                    
                                    <div class="entry-meta">
                                        <div class="meta-primary">
                                            <span class="posted-on">
                                                <span class="meta-icon">📅</span>
                                                <time class="entry-date published" datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                                                    <?php echo esc_html(get_the_date('Y.m.d')); ?>
                                                </time>
                                            </span>
                                            
                                            <?php if (get_comments_number() > 0) : ?>
                                                <span class="comments-count">
                                                    <span class="meta-icon">💬</span>
                                                    <span class="comments-number"><?php comments_number('0', '1', '%'); ?></span>
                                                </span>
                                            <?php endif; ?>
                                            
                                            <span class="reading-time">
                                                <span class="meta-icon">⏱️</span>
                                                <span class="reading-time-text"><?php echo copipe_get_reading_time(); ?></span>
                                            </span>
                                            
                                            <?php if (function_exists('get_field') && get_field('view_count')) : ?>
                                                <span class="view-count">
                                                    <span class="meta-icon">👁️</span>
                                                    <span class="view-number"><?php echo number_format(get_field('view_count')); ?></span>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                        
                                        <!-- Sub Categories -->
                                        <?php
                                        $categories = get_the_category();
                                        $other_categories = array_filter($categories, function($cat) use ($current_category) {
                                            return $cat->term_id !== $current_category->term_id;
                                        });
                                        
                                        if (!empty($other_categories)) :
                                        ?>
                                            <div class="meta-secondary">
                                                <div class="sub-categories">
                                                    <?php
                                                    foreach (array_slice($other_categories, 0, 3) as $category) {
                                                        echo '<a href="' . esc_url(get_category_link($category->term_id)) . '" class="sub-category-tag">' . esc_html($category->name) . '</a>';
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div><!-- .entry-meta -->
                                </header><!-- .entry-header -->
                                
                                <div class="entry-excerpt">
                                    <?php the_excerpt(); ?>
                                </div><!-- .entry-excerpt -->
                                
                                <footer class="entry-footer">
                                    <div class="footer-left">
                                        <a href="<?php the_permalink(); ?>" class="read-more-btn">
                                            <span class="btn-text">続きを読む</span>
                                            <span class="btn-arrow">→</span>
                                        </a>
                                    </div>
                                    
                                    <div class="footer-right">
                                        <?php if (get_post_type() === 'ai_prompt') : ?>
                                            <div class="prompt-meta">
                                                <?php if (get_field('difficulty')) : ?>
                                                    <span class="difficulty-badge difficulty-<?php echo esc_attr(get_field('difficulty')); ?>">
                                                        <?php
                                                        $difficulty = get_field('difficulty');
                                                        $difficulty_labels = array(
                                                            'beginner' => '初級',
                                                            'intermediate' => '中級',
                                                            'advanced' => '上級'
                                                        );
                                                        echo esc_html($difficulty_labels[$difficulty] ?? '初級');
                                                        ?>
                                                    </span>
                                                <?php endif; ?>
                                            </div>
                                        <?php else : ?>
                                            <!-- Share Buttons for Regular Posts -->
                                            <div class="share-buttons-mini">
                                                <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" 
                                                   target="_blank" 
                                                   rel="noopener"
                                                   class="share-btn-mini twitter"
                                                   title="Twitterでシェア">
                                                    🐦
                                                </a>
                                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" 
                                                   target="_blank" 
                                                   rel="noopener"
                                                   class="share-btn-mini facebook"
                                                   title="Facebookでシェア">
                                                    📘
                                                </a>
                                                <a href="https://social-plugins.line.me/lineit/share?url=<?php echo urlencode(get_permalink()); ?>" 
                                                   target="_blank" 
                                                   rel="noopener"
                                                   class="share-btn-mini line"
                                                   title="LINEでシェア">
                                                    💬
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </footer><!-- .entry-footer -->
                            </div><!-- .post-content -->
                            
                        </article><!-- #post-<?php the_ID(); ?> -->
                        
                    <?php endwhile; ?>
                </div><!-- .posts-container -->
                
                <?php
                // Pagination with improved design
                $pagination_args = array(
                    'mid_size' => 2,
                    'prev_text' => '<span class="nav-icon">←</span><span class="nav-text">前のページ</span>',
                    'next_text' => '<span class="nav-text">次のページ</span><span class="nav-icon">→</span>',
                );
                
                echo '<nav class="category-pagination" aria-label="カテゴリーページナビゲーション">';
                echo paginate_links($pagination_args);
                echo '</nav>';
                ?>
                
            <?php else : ?>
                
                <section class="no-results not-found">
                    <header class="page-header">
                        <h1 class="page-title">
                            「<?php single_cat_title(); ?>」の記事が見つかりませんでした
                        </h1>
                    </header><!-- .page-header -->
                    
                    <div class="page-content">
                        <div class="no-results-content">
                            <div class="no-results-icon">📂</div>
                            <p class="no-results-message">
                                このカテゴリーにはまだ記事がありません。<br>
                                他のカテゴリーをお探しいただくか、検索をお試しください。
                            </p>
                            
                            <div class="suggestions">
                                <div class="suggestion-item">
                                    <h3>🔍 検索してみる</h3>
                                    <?php get_search_form(); ?>
                                </div>
                                
                                <div class="suggestion-item">
                                    <h3>📂 他のカテゴリーを見る</h3>
                                    <div class="category-links">
                                        <?php
                                        $categories = get_categories(array(
                                            'orderby' => 'count',
                                            'order' => 'DESC',
                                            'number' => 5,
                                            'hide_empty' => true
                                        ));
                                        
                                        foreach ($categories as $category) :
                                        ?>
                                            <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" 
                                               class="category-link">
                                                <?php echo esc_html($category->name); ?>
                                                <span class="count">(<?php echo $category->count; ?>)</span>
                                            </a>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                
                                <div class="suggestion-item">
                                    <h3>🏠 ホームに戻る</h3>
                                    <a href="<?php echo esc_url(home_url('/')); ?>" class="home-link">
                                        トップページへ戻る
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div><!-- .page-content -->
                </section><!-- .no-results -->
                
            <?php endif; ?>
            
        </div><!-- .content-area -->
        
        <aside id="secondary" class="widget-area">
            
            <!-- Category Specific Widget -->
            <div class="widget category-widget">
                <h3 class="widget-title">
                    📂 「<?php single_cat_title(); ?>」について
                </h3>
                <div class="widget-content">
                    <?php if (category_description()) : ?>
                        <div class="category-description-widget">
                            <?php echo category_description(); ?>
                        </div>
                    <?php endif; ?>
                    
                    <div class="category-statistics">
                        <div class="stat-item">
                            <span class="stat-label">記事数</span>
                            <span class="stat-value"><?php echo $wp_query->found_posts; ?>件</span>
                        </div>
                        
                        <?php
                        $category_posts = get_posts(array(
                            'category' => get_query_var('cat'),
                            'posts_per_page' => -1,
                            'fields' => 'ids'
                        ));
                        
                        if (!empty($category_posts)) :
                            $total_comments = 0;
                            foreach ($category_posts as $post_id) {
                                $total_comments += get_comments_number($post_id);
                            }
                        ?>
                            <div class="stat-item">
                                <span class="stat-label">総コメント数</span>
                                <span class="stat-value"><?php echo number_format($total_comments); ?>件</span>
                            </div>
                        <?php endif; ?>
                        
                        <div class="stat-item">
                            <span class="stat-label">最終更新</span>
                            <span class="stat-value">
                                <?php
                                $latest_post = get_posts(array(
                                    'category' => get_query_var('cat'),
                                    'posts_per_page' => 1,
                                    'orderby' => 'date',
                                    'order' => 'DESC'
                                ));
                                
                                if (!empty($latest_post)) {
                                    echo esc_html(get_the_date('Y.m.d', $latest_post[0]->ID));
                                }
                                ?>
                            </span>
                        </div>
                    </div>
                    
                    <div class="category-actions">
                        <a href="<?php echo get_category_feed_link(get_query_var('cat')); ?>" 
                           class="action-btn rss-btn"
                           target="_blank"
                           rel="noopener">
                            <span class="btn-icon">📡</span>
                            <span class="btn-text">RSS購読</span>
                        </a>
                        
                        <?php if (is_user_logged_in()) : ?>
                            <button class="action-btn bookmark-btn" onclick="bookmarkCategory(<?php echo get_query_var('cat'); ?>)">
                                <span class="btn-icon">🔖</span>
                                <span class="btn-text">ブックマーク</span>
                            </button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            
            <!-- Popular Posts in Category -->
            <div class="widget popular-posts-widget">
                <h3 class="widget-title">
                    🔥 このカテゴリーの人気記事
                </h3>
                <div class="widget-content">
                    <?php
                    $popular_posts = get_posts(array(
                        'category' => get_query_var('cat'),
                        'posts_per_page' => 5,
                        'orderby' => 'comment_count',
                        'order' => 'DESC',
                        'meta_query' => array(
                            array(
                                'key' => 'view_count',
                                'compare' => 'EXISTS'
                            )
                        )
                    ));
                    
                    if (!empty($popular_posts)) :
                    ?>
                        <ul class="popular-posts-list">
                            <?php foreach ($popular_posts as $index => $popular_post) : ?>
                                <li class="popular-post-item">
                                    <div class="popular-rank"><?php echo $index + 1; ?></div>
                                    <div class="popular-content">
                                        <a href="<?php echo esc_url(get_permalink($popular_post->ID)); ?>" 
                                           class="popular-title">
                                            <?php echo esc_html(get_the_title($popular_post->ID)); ?>
                                        </a>
                                        <div class="popular-meta">
                                            <span class="popular-date">
                                                <?php echo esc_html(get_the_date('Y.m.d', $popular_post->ID)); ?>
                                            </span>
                                            <span class="popular-comments">
                                                💬 <?php echo get_comments_number($popular_post->ID); ?>
                                            </span>
                                        </div>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else : ?>
                        <p class="no-popular-posts">まだ人気記事がありません。</p>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- Recent Posts in Category -->
            <div class="widget recent-posts-widget">
                <h3 class="widget-title">
                    🆕 最新記事
                </h3>
                <div class="widget-content">
                    <?php
                    $recent_posts = get_posts(array(
                        'category' => get_query_var('cat'),
                        'posts_per_page' => 5,
                        'orderby' => 'date',
                        'order' => 'DESC'
                    ));
                    
                    if (!empty($recent_posts)) :
                    ?>
                        <ul class="recent-posts-list">
                            <?php foreach ($recent_posts as $recent_post) : ?>
                                <li class="recent-post-item">
                                    <a href="<?php echo esc_url(get_permalink($recent_post->ID)); ?>" 
                                       class="recent-post-link">
                                        <div class="recent-content">
                                            <div class="recent-title">
                                                <?php echo esc_html(get_the_title($recent_post->ID)); ?>
                                            </div>
                                            <div class="recent-date">
                                                <?php echo esc_html(get_the_date('Y.m.d', $recent_post->ID)); ?>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
            
            <?php dynamic_sidebar('sidebar-1'); ?>
        </aside><!-- #secondary -->
        
    </div><!-- .container -->
</main><!-- #primary -->

<style>
/* Category Header */
.category-header {
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    padding: 3rem 2rem;
    border-radius: 20px;
    margin-bottom: 3rem;
    position: relative;
    overflow: hidden;
}

.category-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-image: 
        radial-gradient(circle at 25% 25%, rgba(44, 90, 160, 0.1) 0%, transparent 50%),
        radial-gradient(circle at 75% 75%, rgba(255, 107, 53, 0.1) 0%, transparent 50%);
}

.category-info {
    display: flex;
    align-items: flex-start;
    gap: 2rem;
    margin-bottom: 3rem;
    position: relative;
    z-index: 2;
}

.category-icon {
    font-size: 4rem;
    color: #2c5aa0;
    flex-shrink: 0;
}

.category-details {
    flex: 1;
}

.category-label {
    color: #666;
    font-size: 0.9rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 0.5rem;
    display: block;
}

.category-title {
    color: #2c5aa0;
    font-size: clamp(2rem, 4vw, 3.5rem);
    margin-bottom: 1rem;
    font-weight: 700;
    line-height: 1.2;
}

.category-description {
    color: #555;
    font-size: 1.1rem;
    line-height: 1.6;
    margin-bottom: 1.5rem;
}

.category-stats {
    display: flex;
    gap: 2rem;
    flex-wrap: wrap;
}

.post-count,
.category-rss {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: #666;
    font-size: 0.9rem;
    font-weight: 500;
}

.rss-link {
    color: #ff6b35;
    text-decoration: none;
    transition: color 0.3s ease;
}

.rss-link:hover {
    color: #e55a2b;
}

/* Related Categories */
.related-categories {
    margin-bottom: 2rem;
    position: relative;
    z-index: 2;
}

.related-title {
    color: #2c5aa0;
    font-size: 1.3rem;
    margin-bottom: 1rem;
    font-weight: 600;
}

.categories-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
    gap: 1rem;
}

.category-card {
    background: rgba(255,255,255,0.8);
    backdrop-filter: blur(10px);
    padding: 1rem;
    border-radius: 12px;
    text-decoration: none;
    color: inherit;
    text-align: center;
    transition: all 0.3s ease;
    border: 1px solid rgba(255,255,255,0.3);
}

.category-card:hover {
    background: white;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.card-icon {
    font-size: 2rem;
    margin-bottom: 0.5rem;
    color: #2c5aa0;
}

.card-title {
    color: #2c5aa0;
    font-weight: 600;
    font-size: 0.9rem;
    margin-bottom: 0.3rem;
}

.card-count {
    color: #666;
    font-size: 0.8rem;
}

/* Category Controls */
.category-controls {
    position: relative;
    z-index: 2;
}

.control-group {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: rgba(255,255,255,0.8);
    backdrop-filter: blur(10px);
    padding: 1rem 1.5rem;
    border-radius: 12px;
    border: 1px solid rgba(255,255,255,0.3);
}

/* Category Post Item */
.category-post-item {
    background: white;
    border-radius: 15px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    overflow: hidden;
    transition: all 0.3s ease;
    position: relative;
}

.category-post-item:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 30px rgba(0,0,0,0.15);
}

/* Post Badges */
.post-badges {
    position: absolute;
    top: 1rem;
    left: 1rem;
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
    z-index: 10;
}

.badge {
    display: flex;
    align-items: center;
    gap: 0.3rem;
    padding: 0.4rem 0.8rem;
    border-radius: 15px;
    font-size: 0.8rem;
    font-weight: 600;
    color: white;
}

.sticky-badge {
    background: linear-gradient(135deg, #ff6b35, #e55a2b);
}

.prompt-badge {
    background: linear-gradient(135deg, #2c5aa0, #1e3f73);
}

.popular-badge {
    background: linear-gradient(135deg, #d63031, #b71c1c);
}

.badge-icon {
    font-size: 0.9rem;
}

/* Enhanced Entry Footer */
.entry-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 1rem;
    margin-top: auto;
}

.footer-left,
.footer-right {
    display: flex;
    align-items: center;
    gap: 1rem;
}

/* Share Buttons Mini */
.share-buttons-mini {
    display: flex;
    gap: 0.5rem;
}

.share-btn-mini {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    font-size: 1rem;
    transition: all 0.3s ease;
    background: #f8f9fa;
}

.share-btn-mini:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.2);
}

.share-btn-mini.twitter:hover {
    background: #1da1f2;
}

.share-btn-mini.facebook:hover {
    background: #4267b2;
}

.share-btn-mini.line:hover {
    background: #00c300;
}

/* Category Widgets */
.category-widget,
.popular-posts-widget,
.recent-posts-widget {
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    border: 2px solid #2c5aa0;
}

.category-widget .widget-title,
.popular-posts-widget .widget-title,
.recent-posts-widget .widget-title {
    background: #2c5aa0;
    color: white;
    margin: -1.5rem -1.5rem 1.5rem -1.5rem;
    padding: 1rem 1.5rem;
}

.category-description-widget {
    background: white;
    padding: 1rem;
    border-radius: 8px;
    margin-bottom: 1.5rem;
    color: #555;
    line-height: 1.6;
}

.category-statistics {
    display: grid;
    gap: 1rem;
    margin-bottom: 1.5rem;
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
    font-size: 1.1rem;
}

.category-actions {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
}

.action-btn {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.8rem 1.2rem;
    background: white;
    color: #2c5aa0;
    text-decoration: none;
    border: none;
    border-radius: 25px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 0.9rem;
}

.action-btn:hover {
    background: #2c5aa0;
    color: white;
    transform: translateY(-2px);
}

/* Popular Posts List */
.popular-posts-list,
.recent-posts-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.popular-post-item,
.recent-post-item {
    background: white;
    border-radius: 8px;
    margin-bottom: 1rem;
    overflow: hidden;
    transition: all 0.3s ease;
}

.popular-post-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem;
}

.popular-post-item:hover,
.recent-post-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.popular-rank {
    width: 30px;
    height: 30px;
    background: linear-gradient(135deg, #ff6b35, #e55a2b);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 0.9rem;
    flex-shrink: 0;
}

.popular-content {
    flex: 1;
}

.popular-title {
    color: #2c5aa0;
    text-decoration: none;
    font-weight: 600;
    font-size: 0.9rem;
    line-height: 1.4;
    display: block;
    margin-bottom: 0.5rem;
}

.popular-title:hover {
    color: #ff6b35;
}

.popular-meta {
    display: flex;
    gap: 1rem;
    font-size: 0.8rem;
    color: #666;
}

.recent-post-link {
    display: block;
    padding: 1rem;
    text-decoration: none;
    color: inherit;
}

.recent-title {
    color: #2c5aa0;
    font-weight: 600;
    font-size: 0.9rem;
    line-height: 1.4;
    margin-bottom: 0.5rem;
}

.recent-post-item:hover .recent-title {
    color: #ff6b35;
}

.recent-date {
    color: #666;
    font-size: 0.8rem;
}

.no-popular-posts {
    text-align: center;
    color: #666;
    font-style: italic;
    padding: 2rem;
}

/* Sub Categories */
.sub-categories {
    display: flex;
    flex-wrap: wrap;
    gap: 0.3rem;
}

.sub-category-tag {
    background: #e9ecef;
    color: #666;
    padding: 0.2rem 0.6rem;
    border-radius: 10px;
    text-decoration: none;
    font-size: 0.7rem;
    font-weight: 500;
    transition: all 0.3s ease;
}

.sub-category-tag:hover {
    background: #2c5aa0;
    color: white;
}

/* Mobile Responsive */
@media (max-width: 767px) {
    .category-header {
        padding: 2rem 1rem;
    }
    
    .category-info {
        flex-direction: column;
        align-items: center;
        text-align: center;
        gap: 1rem;
    }
    
    .category-icon {
        font-size: 3rem;
    }
    
    .category-stats {
        justify-content: center;
    }
    
    .categories-grid {
        grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
    }
    
    .control-group {
        flex-direction: column;
        gap: 1rem;
    }
    
    .posts-container.grid-view {
        grid-template-columns: 1fr;
    }
    
    .entry-footer {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .category-actions {
        justify-content: center;
    }
    
    .popular-post-item {
        flex-direction: column;
        text-align: center;
    }
    
    .popular-meta {
        justify-content: center;
    }
}

/* High Contrast Mode */
@media (prefers-contrast: high) {
    .category-post-item {
        border: 2px solid #000;
    }
    
    .badge,
    .action-btn {
        border: 1px solid #000;
    }
}

/* Reduced Motion */
@media (prefers-reduced-motion: reduce) {
    .category-post-item:hover,
    .action-btn:hover,
    .popular-post-item:hover,
    .recent-post-item:hover {
        transform: none;
    }
}
</style>

<script>
// Category sort handling
function handleCategorySort(value) {
    const [orderby, order] = value.split('-');
    const currentUrl = new URL(window.location);
    
    currentUrl.searchParams.set('orderby', orderby);
    currentUrl.searchParams.set('order', order.toUpperCase());
    
    window.location.href = currentUrl.toString();
}

// Category view toggle
document.addEventListener('DOMContentLoaded', function() {
    const toggleButtons = document.querySelectorAll('.toggle-btn');
    const postsContainer = document.getElementById('category-posts-container');
    
    toggleButtons.forEach(button => {
        button.addEventListener('click', function() {
            const view = this.dataset.view;
            
            // Update active button
            toggleButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            
            // Update container view
            postsContainer.className = `posts-container ${view}-view`;
            
            // Store preference
            localStorage.setItem('category-view', view);
        });
    });
    
    // Load saved view preference
    const savedView = localStorage.getItem('category-view');
    if (savedView) {
        const targetButton = document.querySelector(`[data-view="${savedView}"]`);
        if (targetButton) {
            targetButton.click();
        }
    }
});

// Bookmark category function
function bookmarkCategory(categoryId) {
    if (!categoryId) return;
    
    // Here you would implement the actual bookmark functionality
    // This could involve AJAX calls to save user preferences
    
    const btn = event.target.closest('.bookmark-btn');
    const icon = btn.querySelector('.btn-icon');
    const text = btn.querySelector('.btn-text');
    
    // Toggle bookmark state
    if (btn.classList.contains('bookmarked')) {
        btn.classList.remove('bookmarked');
        icon.textContent = '🔖';
        text.textContent = 'ブックマーク';
    } else {
        btn.classList.add('bookmarked');
        icon.textContent = '✅';
        text.textContent = 'ブックマーク済み';
    }
    
    // You would also save this state to the database here
    console.log('Category ' + categoryId + ' bookmark toggled');
}

// Reading time calculation
function copipe_get_reading_time() {
    // This function would be implemented in PHP, but here's the concept
    return '3分';
}
</script>

<?php
get_footer();

// Helper function for reading time
function copipe_get_reading_time() {
    $content = get_post_field('post_content', get_the_ID());
    $word_count = str_word_count(strip_tags($content));
    $reading_time = ceil($word_count / 200); // 200 words per minute
    
    return $reading_time . '分';
}
?>