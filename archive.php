<?php
/**
 * The template for displaying archive pages
 *
 * @package copipe-theme
 * @version 3.0.0
 */

get_header(); ?>

<main id="primary" class="main-content">
    <div class="container">
        <div class="content-area">
            
            <?php if (have_posts()) : ?>
                
                <header class="page-header">
                    <?php
                    the_archive_title('<h1 class="page-title">', '</h1>');
                    the_archive_description('<div class="archive-description">', '</div>');
                    ?>
                    
                    <!-- Archive Meta Info -->
                    <div class="archive-meta">
                        <div class="archive-stats">
                            <span class="post-count">
                                <span class="count-icon">📄</span>
                                <span class="count-text"><?php echo $wp_query->found_posts; ?>件の記事</span>
                            </span>
                            
                            <?php if (is_category() || is_tag()) : ?>
                                <span class="archive-type">
                                    <span class="type-icon">
                                        <?php echo is_category() ? '📂' : '🏷️'; ?>
                                    </span>
                                    <span class="type-text">
                                        <?php echo is_category() ? 'カテゴリー' : 'タグ'; ?>
                                    </span>
                                </span>
                            <?php endif; ?>
                            
                            <?php if (is_date()) : ?>
                                <span class="archive-type">
                                    <span class="type-icon">📅</span>
                                    <span class="type-text">日付別</span>
                                </span>
                            <?php endif; ?>
                            
                            <?php if (is_author()) : ?>
                                <span class="archive-type">
                                    <span class="type-icon">✍️</span>
                                    <span class="type-text">著者別</span>
                                </span>
                            <?php endif; ?>
                        </div>
                        
                        <!-- Sort Options -->
                        <div class="sort-options">
                            <label for="sort-select" class="sort-label">並び替え:</label>
                            <select id="sort-select" class="sort-select" onchange="handleSort(this.value)">
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
                                    コメント数順
                                </option>
                            </select>
                        </div>
                    </div>
                </header><!-- .page-header -->
                
                <!-- View Toggle -->
                <div class="view-toggle">
                    <div class="toggle-buttons">
                        <button class="toggle-btn active" data-view="grid" title="グリッド表示">
                            <span class="toggle-icon">⊞</span>
                            <span class="toggle-text">グリッド</span>
                        </button>
                        <button class="toggle-btn" data-view="list" title="リスト表示">
                            <span class="toggle-icon">☰</span>
                            <span class="toggle-text">リスト</span>
                        </button>
                    </div>
                </div>
                
                <div class="posts-container grid-view" id="posts-container">
                    <?php while (have_posts()) : the_post(); ?>
                        
                        <article id="post-<?php the_ID(); ?>" <?php post_class('archive-post-item'); ?>>
                            
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="post-thumbnail">
                                    <a href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
                                        <?php the_post_thumbnail('copipe-featured', array(
                                            'alt' => the_title_attribute(array('echo' => false))
                                        )); ?>
                                    </a>
                                    
                                    <!-- Post Type Badge -->
                                    <?php if (get_post_type() === 'ai_prompt') : ?>
                                        <div class="post-type-badge ai-prompt">
                                            <span class="badge-icon">🤖</span>
                                            <span class="badge-text">AIプロンプト</span>
                                        </div>
                                    <?php endif; ?>
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
                                            
                                            <?php if (function_exists('get_field') && get_field('reading_time')) : ?>
                                                <span class="reading-time">
                                                    <span class="meta-icon">⏱️</span>
                                                    <span class="reading-time-text"><?php echo esc_html(get_field('reading_time')); ?>分</span>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                        
                                        <?php
                                        $categories = get_the_category();
                                        if (!empty($categories)) :
                                        ?>
                                            <div class="meta-secondary">
                                                <div class="cat-links">
                                                    <?php
                                                    foreach (array_slice($categories, 0, 2) as $category) {
                                                        echo '<a href="' . esc_url(get_category_link($category->term_id)) . '" class="category-tag">' . esc_html($category->name) . '</a>';
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
                                    <a href="<?php the_permalink(); ?>" class="read-more-btn">
                                        <span class="btn-text">続きを読む</span>
                                        <span class="btn-arrow">→</span>
                                    </a>
                                    
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
                                            
                                            <?php if (get_field('use_case')) : ?>
                                                <span class="use-case-tag">
                                                    📝 <?php echo esc_html(get_field('use_case')); ?>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                </footer><!-- .entry-footer -->
                            </div><!-- .post-content -->
                            
                        </article><!-- #post-<?php the_ID(); ?> -->
                        
                    <?php endwhile; ?>
                </div><!-- .posts-container -->
                
                <?php
                // Pagination
                $pagination_args = array(
                    'mid_size' => 2,
                    'prev_text' => '<span class="nav-icon">←</span><span class="nav-text">前のページ</span>',
                    'next_text' => '<span class="nav-text">次のページ</span><span class="nav-icon">→</span>',
                );
                
                echo '<nav class="pagination-wrapper" aria-label="ページナビゲーション">';
                echo paginate_links($pagination_args);
                echo '</nav>';
                ?>
                
            <?php else : ?>
                
                <section class="no-results not-found">
                    <header class="page-header">
                        <h1 class="page-title">記事が見つかりませんでした</h1>
                    </header><!-- .page-header -->
                    
                    <div class="page-content">
                        <div class="no-results-content">
                            <div class="no-results-icon">😔</div>
                            <p class="no-results-message">
                                申し訳ございませんが、該当する記事が見つかりませんでした。<br>
                                以下の方法をお試しください。
                            </p>
                            
                            <div class="suggestions">
                                <div class="suggestion-item">
                                    <h3>🔍 検索してみる</h3>
                                    <?php get_search_form(); ?>
                                </div>
                                
                                <div class="suggestion-item">
                                    <h3>📂 カテゴリーから探す</h3>
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
            
            <!-- Archive Filters Widget -->
            <div class="widget archive-filters">
                <h3 class="widget-title">絞り込み</h3>
                <div class="widget-content">
                    
                    <!-- Category Filter -->
                    <div class="filter-section">
                        <h4 class="filter-title">カテゴリー</h4>
                        <ul class="filter-list">
                            <?php
                            $categories = get_categories(array(
                                'orderby' => 'count',
                                'order' => 'DESC',
                                'hide_empty' => true
                            ));
                            
                            foreach (array_slice($categories, 0, 8) as $category) :
                            ?>
                                <li class="filter-item">
                                    <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" 
                                       class="filter-link <?php echo (is_category($category->term_id)) ? 'active' : ''; ?>">
                                        <span class="filter-name"><?php echo esc_html($category->name); ?></span>
                                        <span class="filter-count"><?php echo $category->count; ?></span>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    
                    <!-- Date Filter -->
                    <div class="filter-section">
                        <h4 class="filter-title">期間</h4>
                        <ul class="filter-list">
                            <?php
                            $archives = wp_get_archives(array(
                                'type' => 'monthly',
                                'limit' => 6,
                                'echo' => false,
                                'format' => 'custom',
                                'before' => '<li class="filter-item"><a href="',
                                'after' => '</a></li>',
                                'show_post_count' => true
                            ));
                            
                            // Custom formatting for archives
                            $archives = str_replace(array('</a> (', ')'), array(' <span class="filter-count">', '</span></a>'), $archives);
                            $archives = str_replace('<a href="', '<a href="', $archives);
                            $archives = str_replace('" title="', '" class="filter-link" title="', $archives);
                            
                            echo $archives;
                            ?>
                        </ul>
                    </div>
                    
                    <?php if (get_post_type() === 'ai_prompt' || is_post_type_archive('ai_prompt')) : ?>
                        <!-- AI Prompt Filters -->
                        <div class="filter-section">
                            <h4 class="filter-title">難易度</h4>
                            <ul class="filter-list">
                                <li class="filter-item">
                                    <a href="<?php echo add_query_arg('difficulty', 'beginner', get_post_type_archive_link('ai_prompt')); ?>" 
                                       class="filter-link">
                                        <span class="filter-name">初級</span>
                                    </a>
                                </li>
                                <li class="filter-item">
                                    <a href="<?php echo add_query_arg('difficulty', 'intermediate', get_post_type_archive_link('ai_prompt')); ?>" 
                                       class="filter-link">
                                        <span class="filter-name">中級</span>
                                    </a>
                                </li>
                                <li class="filter-item">
                                    <a href="<?php echo add_query_arg('difficulty', 'advanced', get_post_type_archive_link('ai_prompt')); ?>" 
                                       class="filter-link">
                                        <span class="filter-name">上級</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    <?php endif; ?>
                    
                </div>
            </div>
            
            <?php dynamic_sidebar('sidebar-1'); ?>
        </aside><!-- #secondary -->
        
    </div><!-- .container -->
</main><!-- #primary -->

<style>
/* Archive Page Styles */
.page-header {
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    padding: 3rem 2rem;
    border-radius: 15px;
    text-align: center;
    margin-bottom: 3rem;
    position: relative;
    overflow: hidden;
}

.page-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-image: 
        radial-gradient(circle at 20% 20%, rgba(44, 90, 160, 0.05) 0%, transparent 50%),
        radial-gradient(circle at 80% 80%, rgba(255, 107, 53, 0.05) 0%, transparent 50%);
}

.page-title {
    color: #2c5aa0;
    font-size: clamp(2rem, 4vw, 3rem);
    margin-bottom: 1rem;
    font-weight: 700;
    position: relative;
    z-index: 2;
}

.archive-description {
    color: #555;
    font-size: 1.1rem;
    line-height: 1.6;
    max-width: 600px;
    margin: 0 auto 2rem;
    position: relative;
    z-index: 2;
}

/* Archive Meta */
.archive-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 1rem;
    background: rgba(255,255,255,0.8);
    backdrop-filter: blur(10px);
    padding: 1rem 1.5rem;
    border-radius: 10px;
    position: relative;
    z-index: 2;
}

.archive-stats {
    display: flex;
    gap: 1.5rem;
    flex-wrap: wrap;
}

.post-count,
.archive-type {
    display: flex;
    align-items: center;
    gap: 0.3rem;
    color: #666;
    font-size: 0.9rem;
    font-weight: 500;
}

.count-icon,
.type-icon {
    font-size: 1rem;
}

/* Sort Options */
.sort-options {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.sort-label {
    color: #666;
    font-size: 0.9rem;
    font-weight: 500;
}

.sort-select {
    padding: 0.5rem 1rem;
    border: 2px solid #e0e0e0;
    border-radius: 25px;
    background: white;
    color: #333;
    font-size: 0.9rem;
    cursor: pointer;
    transition: all 0.3s ease;
}

.sort-select:focus {
    outline: none;
    border-color: #2c5aa0;
}

/* View Toggle */
.view-toggle {
    display: flex;
    justify-content: center;
    margin-bottom: 2rem;
}

.toggle-buttons {
    display: flex;
    background: #f8f9fa;
    border-radius: 25px;
    padding: 0.3rem;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

.toggle-btn {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.8rem 1.5rem;
    background: transparent;
    border: none;
    border-radius: 20px;
    cursor: pointer;
    transition: all 0.3s ease;
    color: #666;
    font-weight: 500;
}

.toggle-btn.active {
    background: #2c5aa0;
    color: white;
    box-shadow: 0 2px 8px rgba(44, 90, 160, 0.3);
}

.toggle-icon {
    font-size: 1.1rem;
}

/* Posts Container */
.posts-container {
    margin-bottom: 3rem;
}

.posts-container.grid-view {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 2rem;
}

.posts-container.list-view {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

/* Archive Post Item */
.archive-post-item {
    background: white;
    border-radius: 15px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    overflow: hidden;
    transition: all 0.3s ease;
    display: flex;
    flex-direction: column;
}

.archive-post-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

.list-view .archive-post-item {
    flex-direction: row;
    height: auto;
}

/* Post Thumbnail */
.post-thumbnail {
    position: relative;
    overflow: hidden;
}

.grid-view .post-thumbnail {
    height: 200px;
}

.list-view .post-thumbnail {
    width: 200px;
    flex-shrink: 0;
}

.post-thumbnail img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.archive-post-item:hover .post-thumbnail img {
    transform: scale(1.05);
}

/* Post Type Badge */
.post-type-badge {
    position: absolute;
    top: 1rem;
    left: 1rem;
    background: linear-gradient(135deg, #2c5aa0, #ff6b35);
    color: white;
    padding: 0.4rem 0.8rem;
    border-radius: 15px;
    font-size: 0.8rem;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 0.3rem;
}

.badge-icon {
    font-size: 0.9rem;
}

/* Post Content */
.post-content {
    padding: 1.5rem;
    flex: 1;
    display: flex;
    flex-direction: column;
}

.list-view .post-content {
    padding: 2rem;
}

.entry-title {
    font-size: 1.3rem;
    line-height: 1.4;
    margin-bottom: 1rem;
    font-weight: 600;
}

.entry-title a {
    color: #2c5aa0;
    text-decoration: none;
    transition: color 0.3s ease;
}

.entry-title a:hover {
    color: #ff6b35;
}

/* Entry Meta */
.entry-meta {
    margin-bottom: 1rem;
}

.meta-primary {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
    margin-bottom: 0.8rem;
}

.meta-secondary {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
}

.posted-on,
.comments-count,
.reading-time {
    display: flex;
    align-items: center;
    gap: 0.3rem;
    color: #666;
    font-size: 0.8rem;
}

.meta-icon {
    font-size: 0.9rem;
}

.category-tag {
    background: #f0f8ff;
    color: #2c5aa0;
    padding: 0.2rem 0.6rem;
    border-radius: 12px;
    text-decoration: none;
    font-size: 0.7rem;
    font-weight: 500;
    transition: all 0.3s ease;
}

.category-tag:hover {
    background: #2c5aa0;
    color: white;
}

/* Entry Excerpt */
.entry-excerpt {
    color: #555;
    line-height: 1.6;
    margin-bottom: 1.5rem;
    flex: 1;
}

.entry-excerpt p {
    margin: 0;
}

/* Entry Footer */
.entry-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 1rem;
}

.read-more-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: linear-gradient(135deg, #2c5aa0, #ff6b35);
    color: white;
    text-decoration: none;
    padding: 0.6rem 1.2rem;
    border-radius: 20px;
    font-size: 0.9rem;
    font-weight: 500;
    transition: all 0.3s ease;
}

.read-more-btn:hover {
    transform: translateX(3px);
    box-shadow: 0 4px 12px rgba(44, 90, 160, 0.3);
    color: white;
}

.btn-arrow {
    transition: transform 0.3s ease;
}

.read-more-btn:hover .btn-arrow {
    transform: translateX(2px);
}

/* Prompt Meta */
.prompt-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    align-items: center;
}

.difficulty-badge {
    padding: 0.3rem 0.8rem;
    border-radius: 12px;
    font-size: 0.8rem;
    font-weight: 500;
    color: white;
}

.difficulty-badge.difficulty-beginner {
    background: #00c851;
}

.difficulty-badge.difficulty-intermediate {
    background: #ff6b35;
}

.difficulty-badge.difficulty-advanced {
    background: #d63031;
}

.use-case-tag {
    color: #666;
    font-size: 0.8rem;
    font-weight: 500;
}

/* Pagination */
.pagination-wrapper {
    display: flex;
    justify-content: center;
    margin-top: 3rem;
}

.pagination-wrapper .page-numbers {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.pagination-wrapper a,
.pagination-wrapper span {
    display: flex;
    align-items: center;
    gap: 0.3rem;
    padding: 0.8rem 1rem;
    background: white;
    color: #2c5aa0;
    text-decoration: none;
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.3s ease;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.pagination-wrapper a:hover {
    background: #2c5aa0;
    color: white;
    transform: translateY(-2px);
}

.pagination-wrapper .current {
    background: #2c5aa0;
    color: white;
}

/* No Results */
.no-results {
    text-align: center;
    padding: 4rem 2rem;
    background: white;
    border-radius: 15px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.no-results .page-title {
    color: #2c5aa0;
    font-size: 2rem;
    margin-bottom: 2rem;
}

.no-results-content {
    max-width: 600px;
    margin: 0 auto;
}

.no-results-icon {
    font-size: 4rem;
    margin-bottom: 1rem;
}

.no-results-message {
    color: #666;
    font-size: 1.1rem;
    line-height: 1.6;
    margin-bottom: 3rem;
}

.suggestions {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
    text-align: left;
}

.suggestion-item {
    background: #f8f9fa;
    padding: 2rem;
    border-radius: 15px;
}

.suggestion-item h3 {
    color: #2c5aa0;
    margin-bottom: 1rem;
    font-size: 1.2rem;
}

.category-links {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.category-link {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.5rem 1rem;
    background: white;
    color: #2c5aa0;
    text-decoration: none;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.category-link:hover {
    background: #2c5aa0;
    color: white;
}

.count {
    color: #666;
    font-size: 0.8rem;
}

.category-link:hover .count {
    color: rgba(255,255,255,0.8);
}

.home-link {
    display: inline-block;
    background: #2c5aa0;
    color: white;
    text-decoration: none;
    padding: 1rem 2rem;
    border-radius: 25px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.home-link:hover {
    background: #1e3f73;
    transform: translateY(-2px);
    color: white;
}

/* Archive Filters Widget */
.archive-filters {
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    border: 2px solid #2c5aa0;
}

.archive-filters .widget-title {
    background: #2c5aa0;
    color: white;
    margin: -1.5rem -1.5rem 1.5rem -1.5rem;
    padding: 1rem 1.5rem;
}

.filter-section {
    margin-bottom: 2rem;
}

.filter-section:last-child {
    margin-bottom: 0;
}

.filter-title {
    color: #2c5aa0;
    font-size: 1rem;
    margin-bottom: 1rem;
    font-weight: 600;
}

.filter-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.filter-item {
    margin-bottom: 0.3rem;
}

.filter-link {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.5rem 0.8rem;
    background: white;
    color: #666;
    text-decoration: none;
    border-radius: 6px;
    font-size: 0.9rem;
    transition: all 0.3s ease;
}

.filter-link:hover,
.filter-link.active {
    background: #2c5aa0;
    color: white;
}

.filter-count {
    background: #e9ecef;
    color: #666;
    padding: 0.2rem 0.5rem;
    border-radius: 10px;
    font-size: 0.8rem;
    font-weight: 600;
}

.filter-link:hover .filter-count,
.filter-link.active .filter-count {
    background: rgba(255,255,255,0.2);
    color: white;
}

/* Mobile Responsive */
@media (max-width: 767px) {
    .page-header {
        padding: 2rem 1rem;
    }
    
    .archive-meta {
        flex-direction: column;
        gap: 1rem;
    }
    
    .archive-stats {
        justify-content: center;
    }
    
    .posts-container.grid-view {
        grid-template-columns: 1fr;
    }
    
    .list-view .archive-post-item {
        flex-direction: column;
    }
    
    .list-view .post-thumbnail {
        width: 100%;
        height: 200px;
    }
    
    .list-view .post-content {
        padding: 1.5rem;
    }
    
    .toggle-btn .toggle-text {
        display: none;
    }
    
    .pagination-wrapper .nav-text {
        display: none;
    }
    
    .suggestions {
        grid-template-columns: 1fr;
    }
    
    .meta-primary {
        flex-direction: column;
        gap: 0.5rem;
    }
    
    .entry-footer {
        flex-direction: column;
        align-items: flex-start;
    }
}

/* Print Styles */
@media print {
    .view-toggle,
    .sort-options,
    .pagination-wrapper,
    .widget-area {
        display: none;
    }
    
    .archive-post-item {
        box-shadow: none;
        border: 1px solid #ccc;
        break-inside: avoid;
        margin-bottom: 2rem;
    }
    
    .post-thumbnail {
        max-height: 150px;
    }
}

/* High Contrast Mode */
@media (prefers-contrast: high) {
    .archive-post-item {
        border: 2px solid #000;
    }
    
    .category-tag,
    .difficulty-badge,
    .read-more-btn {
        border: 1px solid #000;
    }
}

/* Reduced Motion */
@media (prefers-reduced-motion: reduce) {
    .archive-post-item:hover,
    .read-more-btn:hover,
    .home-link:hover {
        transform: none;
    }
    
    .post-thumbnail img {
        transition: none;
    }
}
</style>

<script>
// Sort handling
function handleSort(value) {
    const [orderby, order] = value.split('-');
    const currentUrl = new URL(window.location);
    
    currentUrl.searchParams.set('orderby', orderby);
    currentUrl.searchParams.set('order', order.toUpperCase());
    
    window.location.href = currentUrl.toString();
}

// View toggle
document.addEventListener('DOMContentLoaded', function() {
    const toggleButtons = document.querySelectorAll('.toggle-btn');
    const postsContainer = document.getElementById('posts-container');
    
    toggleButtons.forEach(button => {
        button.addEventListener('click', function() {
            const view = this.dataset.view;
            
            // Update active button
            toggleButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            
            // Update container view
            postsContainer.className = `posts-container ${view}-view`;
            
            // Store preference in localStorage
            localStorage.setItem('archive-view', view);
        });
    });
    
    // Load saved view preference
    const savedView = localStorage.getItem('archive-view');
    if (savedView) {
        const targetButton = document.querySelector(`[data-view="${savedView}"]`);
        if (targetButton) {
            targetButton.click();
        }
    }
});
</script>

<?php
get_footer();
?>