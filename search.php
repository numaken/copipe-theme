<?php
/**
 * The template for displaying search results
 *
 * @package copipe-theme
 * @version 3.0.0
 */

get_header(); ?>

<main id="primary" class="main-content">
    <div class="container">
        <div class="content-area">
            
            <header class="search-header">
                <div class="search-info">
                    <div class="search-icon">🔍</div>
                    <div class="search-details">
                        <span class="search-label">検索結果</span>
                        <h1 class="search-title">
                            <?php if (have_posts()) : ?>
                                「<span class="search-query"><?php echo get_search_query(); ?></span>」の検索結果
                            <?php else : ?>
                                検索結果が見つかりませんでした
                            <?php endif; ?>
                        </h1>
                        
                        <?php if (have_posts()) : ?>
                            <div class="search-stats">
                                <span class="results-count">
                                    <span class="count-icon">📄</span>
                                    <span class="count-text"><?php echo $wp_query->found_posts; ?>件見つかりました</span>
                                </span>
                                
                                <span class="search-time">
                                    <span class="time-icon">⚡</span>
                                    <span class="time-text">検索時間: <?php echo number_format(microtime(true) - $_SERVER['REQUEST_TIME_FLOAT'], 3); ?>秒</span>
                                </span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- Search Form -->
                <div class="search-form-container">
                    <form role="search" method="get" class="enhanced-search-form" action="<?php echo esc_url(home_url('/')); ?>">
                        <div class="search-input-wrapper">
                            <input type="search" 
                                   class="search-field" 
                                   placeholder="キーワードで検索..." 
                                   value="<?php echo get_search_query(); ?>" 
                                   name="s" 
                                   title="検索キーワードを入力" />
                            <button type="submit" class="search-submit">
                                <span class="search-submit-icon">🔍</span>
                                <span class="search-submit-text">検索</span>
                            </button>
                        </div>
                        
                        <!-- Advanced Search Options -->
                        <div class="search-options" id="search-options">
                            <div class="options-toggle">
                                <button type="button" class="toggle-btn" onclick="toggleSearchOptions()">
                                    <span class="toggle-text">詳細検索</span>
                                    <span class="toggle-arrow">▼</span>
                                </button>
                            </div>
                            
                            <div class="options-content" id="options-content">
                                <div class="option-group">
                                    <label for="search-category">カテゴリー:</label>
                                    <select name="category_name" id="search-category">
                                        <option value="">すべてのカテゴリー</option>
                                        <?php
                                        $categories = get_categories(array('hide_empty' => true));
                                        foreach ($categories as $category) :
                                        ?>
                                            <option value="<?php echo esc_attr($category->slug); ?>" 
                                                    <?php selected(get_query_var('category_name'), $category->slug); ?>>
                                                <?php echo esc_html($category->name); ?> (<?php echo $category->count; ?>)
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                
                                <div class="option-group">
                                    <label for="search-post-type">投稿タイプ:</label>
                                    <select name="post_type" id="search-post-type">
                                        <option value="">すべてのタイプ</option>
                                        <option value="post" <?php selected(get_query_var('post_type'), 'post'); ?>>記事</option>
                                        <option value="ai_prompt" <?php selected(get_query_var('post_type'), 'ai_prompt'); ?>>AIプロンプト</option>
                                        <option value="page" <?php selected(get_query_var('post_type'), 'page'); ?>>固定ページ</option>
                                    </select>
                                </div>
                                
                                <div class="option-group">
                                    <label for="search-date">期間:</label>
                                    <select name="date_filter" id="search-date">
                                        <option value="">すべての期間</option>
                                        <option value="last_week" <?php selected(get_query_var('date_filter'), 'last_week'); ?>>過去1週間</option>
                                        <option value="last_month" <?php selected(get_query_var('date_filter'), 'last_month'); ?>>過去1ヶ月</option>
                                        <option value="last_year" <?php selected(get_query_var('date_filter'), 'last_year'); ?>>過去1年</option>
                                    </select>
                                </div>
                                
                                <div class="option-group">
                                    <label for="search-orderby">並び順:</label>
                                    <select name="orderby" id="search-orderby">
                                        <option value="relevance" <?php selected(get_query_var('orderby'), 'relevance'); ?>>関連度順</option>
                                        <option value="date" <?php selected(get_query_var('orderby'), 'date'); ?>>新しい順</option>
                                        <option value="title" <?php selected(get_query_var('orderby'), 'title'); ?>>タイトル順</option>
                                        <option value="comment_count" <?php selected(get_query_var('orderby'), 'comment_count'); ?>>人気順</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </header><!-- .search-header -->
            
            <?php if (have_posts()) : ?>
                
                <!-- Search Filters -->
                <div class="search-filters">
                    <div class="filter-tabs">
                        <button class="filter-tab active" data-filter="all">
                            すべて (<?php echo $wp_query->found_posts; ?>)
                        </button>
                        
                        <?php
                        // Count posts by type
                        $post_types_count = array();
                        while (have_posts()) : the_post();
                            $post_type = get_post_type();
                            if (!isset($post_types_count[$post_type])) {
                                $post_types_count[$post_type] = 0;
                            }
                            $post_types_count[$post_type]++;
                        endwhile;
                        rewind_posts();
                        
                        $post_type_labels = array(
                            'post' => '記事',
                            'ai_prompt' => 'AIプロンプト',
                            'page' => 'ページ'
                        );
                        
                        foreach ($post_types_count as $post_type => $count) :
                            $label = isset($post_type_labels[$post_type]) ? $post_type_labels[$post_type] : $post_type;
                        ?>
                            <button class="filter-tab" data-filter="<?php echo esc_attr($post_type); ?>">
                                <?php echo esc_html($label); ?> (<?php echo $count; ?>)
                            </button>
                        <?php endforeach; ?>
                    </div>
                    
                    <div class="view-options">
                        <div class="sort-select-wrapper">
                            <select class="sort-select" onchange="handleSearchSort(this.value)">
                                <option value="relevance" <?php selected(get_query_var('orderby'), 'relevance'); ?>>関連度順</option>
                                <option value="date" <?php selected(get_query_var('orderby'), 'date'); ?>>新しい順</option>
                                <option value="title" <?php selected(get_query_var('orderby'), 'title'); ?>>タイトル順</option>
                                <option value="comment_count" <?php selected(get_query_var('orderby'), 'comment_count'); ?>>人気順</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="search-results" id="search-results">
                    <?php while (have_posts()) : the_post(); ?>
                        
                        <article id="post-<?php the_ID(); ?>" <?php post_class('search-result-item'); ?> data-post-type="<?php echo esc_attr(get_post_type()); ?>">
                            
                            <div class="result-content">
                                <header class="result-header">
                                    <div class="result-meta-top">
                                        <span class="result-type <?php echo esc_attr(get_post_type()); ?>">
                                            <?php
                                            $post_type = get_post_type();
                                            switch ($post_type) {
                                                case 'ai_prompt':
                                                    echo '🤖 AIプロンプト';
                                                    break;
                                                case 'page':
                                                    echo '📄 ページ';
                                                    break;
                                                default:
                                                    echo '📝 記事';
                                            }
                                            ?>
                                        </span>
                                        
                                        <span class="result-date">
                                            <span class="date-icon">📅</span>
                                            <time class="entry-date" datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                                                <?php echo esc_html(get_the_date('Y.m.d')); ?>
                                            </time>
                                        </span>
                                    </div>
                                    
                                    <?php the_title('<h2 class="result-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>'); ?>
                                    
                                    <div class="result-url">
                                        <span class="url-icon">🔗</span>
                                        <span class="url-text"><?php echo esc_url(get_permalink()); ?></span>
                                    </div>
                                </header><!-- .result-header -->
                                
                                <div class="result-excerpt">
                                    <?php
                                    $excerpt = get_the_excerpt();
                                    $search_query = get_search_query();
                                    
                                    // Highlight search terms in excerpt
                                    if ($search_query && $excerpt) {
                                        $highlighted_excerpt = preg_replace(
                                            '/(' . preg_quote($search_query, '/') . ')/i',
                                            '<mark class="search-highlight">$1</mark>',
                                            $excerpt
                                        );
                                        echo $highlighted_excerpt;
                                    } else {
                                        echo $excerpt;
                                    }
                                    ?>
                                </div><!-- .result-excerpt -->
                                
                                <footer class="result-footer">
                                    <div class="result-meta">
                                        <?php
                                        $categories = get_the_category();
                                        if (!empty($categories)) :
                                        ?>
                                            <div class="result-categories">
                                                <span class="cat-icon">📂</span>
                                                <?php
                                                foreach (array_slice($categories, 0, 2) as $category) {
                                                    echo '<a href="' . esc_url(get_category_link($category->term_id)) . '" class="result-category">' . esc_html($category->name) . '</a>';
                                                }
                                                ?>
                                            </div>
                                        <?php endif; ?>
                                        
                                        <?php if (get_comments_number() > 0) : ?>
                                            <span class="result-comments">
                                                <span class="comments-icon">💬</span>
                                                <span class="comments-count"><?php comments_number('0', '1', '%'); ?></span>
                                            </span>
                                        <?php endif; ?>
                                        
                                        <?php if (get_post_type() === 'ai_prompt' && get_field('difficulty')) : ?>
                                            <span class="result-difficulty difficulty-<?php echo esc_attr(get_field('difficulty')); ?>">
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
                                    
                                    <div class="result-actions">
                                        <a href="<?php the_permalink(); ?>" class="read-more-btn">
                                            <span class="btn-text">詳細を見る</span>
                                            <span class="btn-arrow">→</span>
                                        </a>
                                        
                                        <div class="quick-share">
                                            <button class="share-toggle" onclick="toggleQuickShare(this)">
                                                <span class="share-icon">📤</span>
                                            </button>
                                            <div class="share-options">
                                                <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" 
                                                   target="_blank" 
                                                   rel="noopener"
                                                   class="share-option twitter">🐦</a>
                                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" 
                                                   target="_blank" 
                                                   rel="noopener"
                                                   class="share-option facebook">📘</a>
                                                <button class="share-option copy" onclick="copyResultURL('<?php echo esc_js(get_permalink()); ?>')">📋</button>
                                            </div>
                                        </div>
                                    </div>
                                </footer><!-- .result-footer -->
                            </div><!-- .result-content -->
                            
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="result-thumbnail">
                                    <a href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
                                        <?php the_post_thumbnail('copipe-thumbnail', array(
                                            'alt' => the_title_attribute(array('echo' => false))
                                        )); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                            
                        </article><!-- #post-<?php the_ID(); ?> -->
                        
                    <?php endwhile; ?>
                </div><!-- .search-results -->
                
                <?php
                // Pagination
                $pagination_args = array(
                    'mid_size' => 2,
                    'prev_text' => '<span class="nav-icon">←</span><span class="nav-text">前のページ</span>',
                    'next_text' => '<span class="nav-text">次のページ</span><span class="nav-icon">→</span>',
                );
                
                echo '<nav class="search-pagination" aria-label="検索結果ページナビゲーション">';
                echo paginate_links($pagination_args);
                echo '</nav>';
                ?>
                
            <?php else : ?>
                
                <section class="no-search-results">
                    <div class="no-results-content">
                        <div class="no-results-icon">🔍</div>
                        <h2 class="no-results-title">
                            「<?php echo get_search_query(); ?>」に一致する結果が見つかりませんでした
                        </h2>
                        <p class="no-results-message">
                            検索条件を変更して再度お試しください。
                        </p>
                        
                        <div class="search-suggestions">
                            <h3 class="suggestions-title">検索のコツ</h3>
                            <ul class="suggestions-list">
                                <li>💡 別のキーワードで検索してみてください</li>
                                <li>💡 より一般的な用語を使用してみてください</li>
                                <li>💡 スペルや表記に間違いがないか確認してください</li>
                                <li>💡 カテゴリーや投稿タイプで絞り込んでみてください</li>
                            </ul>
                        </div>
                        
                        <div class="alternative-actions">
                            <h3 class="alternatives-title">他の方法で探す</h3>
                            <div class="alternatives-grid">
                                <div class="alternative-item">
                                    <h4>📂 カテゴリーから探す</h4>
                                    <div class="category-links">
                                        <?php
                                        $popular_categories = get_categories(array(
                                            'orderby' => 'count',
                                            'order' => 'DESC',
                                            'number' => 6,
                                            'hide_empty' => true
                                        ));
                                        
                                        foreach ($popular_categories as $category) :
                                        ?>
                                            <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" 
                                               class="category-link">
                                                <?php echo esc_html($category->name); ?>
                                            </a>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                
                                <div class="alternative-item">
                                    <h4>🤖 AIプロンプトを見る</h4>
                                    <a href="<?php echo esc_url(get_post_type_archive_link('ai_prompt')); ?>" 
                                       class="archive-link">
                                        AIプロンプト一覧
                                    </a>
                                </div>
                                
                                <div class="alternative-item">
                                    <h4>🔥 人気記事を見る</h4>
                                    <div class="popular-posts">
                                        <?php
                                        $popular_posts = get_posts(array(
                                            'posts_per_page' => 3,
                                            'orderby' => 'comment_count',
                                            'order' => 'DESC'
                                        ));
                                        
                                        foreach ($popular_posts as $popular_post) :
                                        ?>
                                            <a href="<?php echo esc_url(get_permalink($popular_post->ID)); ?>" 
                                               class="popular-post-link">
                                                <?php echo esc_html(get_the_title($popular_post->ID)); ?>
                                            </a>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section><!-- .no-search-results -->
                
            <?php endif; ?>
            
        </div><!-- .content-area -->
        
        <aside id="secondary" class="widget-area">
            
            <!-- Search Stats Widget -->
            <div class="widget search-stats-widget">
                <h3 class="widget-title">🔍 検索情報</h3>
                <div class="widget-content">
                    <?php if (have_posts()) : ?>
                        <div class="stats-grid">
                            <div class="stat-item">
                                <span class="stat-value"><?php echo $wp_query->found_posts; ?></span>
                                <span class="stat-label">件の結果</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-value"><?php echo max_num_pages; ?></span>
                                <span class="stat-label">ページ</span>
                            </div>
                            <div class="stat-item">
                                <span class="stat-value"><?php echo number_format(microtime(true) - $_SERVER['REQUEST_TIME_FLOAT'], 3); ?></span>
                                <span class="stat-label">秒で検索</span>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                    <div class="search-tips">
                        <h4>💡 検索のコツ</h4>
                        <ul class="tips-list">
                            <li>複数のキーワードをスペースで区切る</li>
                            <li>「"」で囲んで完全一致検索</li>
                            <li>カテゴリーで絞り込み</li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <!-- Popular Searches Widget -->
            <div class="widget popular-searches-widget">
                <h3 class="widget-title">🔥 人気の検索</h3>
                <div class="widget-content">
                    <div class="popular-searches">
                        <?php
                        // These would typically come from a search analytics plugin
                        $popular_searches = array(
                            'ChatGPT' => 125,
                            'AIプロンプト' => 98,
                            'WordPress' => 87,
                            'SEO' => 76,
                            'ブログ' => 65,
                            'アフィリエイト' => 54
                        );
                        
                        foreach ($popular_searches as $search_term => $count) :
                        ?>
                            <a href="<?php echo esc_url(home_url('/?s=' . urlencode($search_term))); ?>" 
                               class="popular-search-item">
                                <span class="search-term"><?php echo esc_html($search_term); ?></span>
                                <span class="search-count"><?php echo $count; ?></span>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            
            <!-- Related Categories Widget -->
            <div class="widget related-categories-widget">
                <h3 class="widget-title">📂 関連カテゴリー</h3>
                <div class="widget-content">
                    <div class="categories-list">
                        <?php
                        $categories = get_categories(array(
                            'orderby' => 'count',
                            'order' => 'DESC',
                            'number' => 8,
                            'hide_empty' => true
                        ));
                        
                        foreach ($categories as $category) :
                        ?>
                            <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>" 
                               class="category-item">
                                <span class="category-name"><?php echo esc_html($category->name); ?></span>
                                <span class="category-count"><?php echo $category->count; ?></span>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            
            <?php dynamic_sidebar('sidebar-1'); ?>
        </aside><!-- #secondary -->
        
    </div><!-- .container -->
</main><!-- #primary -->

<style>
/* Search Header */
.search-header {
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    padding: 3rem 2rem;
    border-radius: 20px;
    margin-bottom: 3rem;
    position: relative;
    overflow: hidden;
}

.search-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-image: 
        radial-gradient(circle at 30% 30%, rgba(44, 90, 160, 0.1) 0%, transparent 50%),
        radial-gradient(circle at 70% 70%, rgba(255, 107, 53, 0.1) 0%, transparent 50%);
}

.search-info {
    display: flex;
    align-items: flex-start;
    gap: 2rem;
    margin-bottom: 2rem;
    position: relative;
    z-index: 2;
}

.search-icon {
    font-size: 4rem;
    color: #2c5aa0;
    flex-shrink: 0;
}

.search-details {
    flex: 1;
}

.search-label {
    color: #666;
    font-size: 0.9rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 0.5rem;
    display: block;
}

.search-title {
    color: #2c5aa0;
    font-size: clamp(1.8rem, 4vw, 3rem);
    margin-bottom: 1rem;
    font-weight: 700;
    line-height: 1.2;
}

.search-query {
    background: linear-gradient(90deg, #ff6b35, #ffa726);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    font-weight: 800;
}

.search-stats {
    display: flex;
    gap: 2rem;
    flex-wrap: wrap;
}

.results-count,
.search-time {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: #666;
    font-size: 0.9rem;
    font-weight: 500;
}

/* Enhanced Search Form */
.search-form-container {
    position: relative;
    z-index: 2;
}

.enhanced-search-form {
    background: rgba(255,255,255,0.9);
    backdrop-filter: blur(10px);
    padding: 2rem;
    border-radius: 15px;
    border: 1px solid rgba(255,255,255,0.3);
}

.search-input-wrapper {
    display: flex;
    gap: 0.5rem;
    margin-bottom: 1rem;
}

.search-field {
    flex: 1;
    padding: 1rem 1.5rem;
    border: 2px solid #e0e0e0;
    border-radius: 50px;
    background: white;
    font-size: 1.1rem;
    transition: all 0.3s ease;
}

.search-field:focus {
    outline: none;
    border-color: #2c5aa0;
    box-shadow: 0 0 0 3px rgba(44, 90, 160, 0.1);
}

.search-submit {
    background: linear-gradient(135deg, #2c5aa0, #ff6b35);
    color: white;
    border: none;
    padding: 1rem 2rem;
    border-radius: 50px;
    cursor: pointer;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s ease;
}

.search-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(44, 90, 160, 0.3);
}

/* Search Options */
.search-options {
    border-top: 1px solid #e0e0e0;
    padding-top: 1rem;
}

.options-toggle {
    text-align: center;
    margin-bottom: 1rem;
}

.toggle-btn {
    background: none;
    border: none;
    color: #2c5aa0;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 500;
    margin: 0 auto;
    transition: all 0.3s ease;
}

.toggle-btn:hover {
    color: #ff6b35;
}

.toggle-arrow {
    transition: transform 0.3s ease;
}

.toggle-btn.expanded .toggle-arrow {
    transform: rotate(180deg);
}

.options-content {
    display: none;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
    margin-top: 1rem;
}

.options-content.expanded {
    display: grid;
}

.option-group {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.option-group label {
    color: #666;
    font-size: 0.9rem;
    font-weight: 500;
}

.option-group select {
    padding: 0.8rem;
    border: 2px solid #e0e0e0;
    border-radius: 8px;
    background: white;
    font-size: 0.9rem;
}

.option-group select:focus {
    outline: none;
    border-color: #2c5aa0;
}

/* Search Filters */
.search-filters {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: white;
    padding: 1.5rem 2rem;
    border-radius: 15px;
    margin-bottom: 2rem;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    flex-wrap: wrap;
    gap: 1rem;
}

.filter-tabs {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
}

.filter-tab {
    background: #f8f9fa;
    border: 2px solid transparent;
    color: #666;
    padding: 0.8rem 1.5rem;
    border-radius: 25px;
    cursor: pointer;
    font-weight: 500;
    transition: all 0.3s ease;
}

.filter-tab.active,
.filter-tab:hover {
    background: #2c5aa0;
    color: white;
    border-color: #2c5aa0;
}

.sort-select-wrapper {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.sort-select {
    padding: 0.8rem 1rem;
    border: 2px solid #e0e0e0;
    border-radius: 8px;
    background: white;
    cursor: pointer;
}

/* Search Results */
.search-results {
    display: flex;
    flex-direction: column;
    gap: 2rem;
    margin-bottom: 3rem;
}

.search-result-item {
    background: white;
    border-radius: 15px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    overflow: hidden;
    transition: all 0.3s ease;
    display: flex;
    gap: 2rem;
    padding: 2rem;
}

.search-result-item:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

.result-content {
    flex: 1;
    display: flex;
    flex-direction: column;
}

.result-header {
    margin-bottom: 1rem;
}

.result-meta-top {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 0.8rem;
    flex-wrap: wrap;
    gap: 1rem;
}

.result-type {
    display: flex;
    align-items: center;
    gap: 0.3rem;
    background: #f8f9fa;
    padding: 0.4rem 1rem;
    border-radius: 15px;
    font-size: 0.8rem;
    font-weight: 600;
    color: #666;
}

.result-type.ai_prompt {
    background: linear-gradient(135deg, #2c5aa0, #1e3f73);
    color: white;
}

.result-type.page {
    background: linear-gradient(135deg, #00c851, #00a844);
    color: white;
}

.result-date {
    display: flex;
    align-items: center;
    gap: 0.3rem;
    color: #666;
    font-size: 0.8rem;
}

.result-title {
    font-size: 1.5rem;
    line-height: 1.4;
    margin-bottom: 0.8rem;
    font-weight: 600;
}

.result-title a {
    color: #2c5aa0;
    text-decoration: none;
    transition: color 0.3s ease;
}

.result-title a:hover {
    color: #ff6b35;
}

.result-url {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-bottom: 1rem;
}

.url-text {
    color: #00c851;
    font-size: 0.9rem;
    font-family: monospace;
}

.result-excerpt {
    color: #555;
    line-height: 1.7;
    margin-bottom: 1.5rem;
    flex: 1;
}

.search-highlight {
    background: #ffeb3b;
    padding: 0.1rem 0.2rem;
    border-radius: 3px;
    font-weight: 600;
}

.result-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 1rem;
}

.result-meta {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
    align-items: center;
}

.result-categories {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.result-category {
    background: #f0f8ff;
    color: #2c5aa0;
    padding: 0.2rem 0.6rem;
    border-radius: 10px;
    text-decoration: none;
    font-size: 0.8rem;
    font-weight: 500;
    transition: all 0.3s ease;
}

.result-category:hover {
    background: #2c5aa0;
    color: white;
}

.result-comments {
    display: flex;
    align-items: center;
    gap: 0.3rem;
    color: #666;
    font-size: 0.8rem;
}

.result-difficulty {
    padding: 0.3rem 0.8rem;
    border-radius: 12px;
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

.result-actions {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.read-more-btn {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    background: linear-gradient(135deg, #2c5aa0, #ff6b35);
    color: white;
    text-decoration: none;
    padding: 0.8rem 1.5rem;
    border-radius: 25px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.read-more-btn:hover {
    transform: translateX(3px);
    color: white;
}

.quick-share {
    position: relative;
}

.share-toggle {
    background: #f8f9fa;
    border: none;
    padding: 0.8rem;
    border-radius: 50%;
    cursor: pointer;
    transition: all 0.3s ease;
}

.share-toggle:hover {
    background: #e9ecef;
}

.share-options {
    position: absolute;
    top: -50px;
    right: 0;
    background: white;
    padding: 0.5rem;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    display: none;
    gap: 0.5rem;
}

.share-options.active {
    display: flex;
}

.share-option {
    width: 35px;
    height: 35px;
    border-radius: 50%;
    border: none;
    background: #f8f9fa;
    color: #666;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
}

.share-option:hover {
    transform: translateY(-2px);
}

.result-thumbnail {
    width: 200px;
    height: 150px;
    overflow: hidden;
    border-radius: 10px;
    flex-shrink: 0;
}

.result-thumbnail img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.search-result-item:hover .result-thumbnail img {
    transform: scale(1.05);
}

/* No Results */
.no-search-results {
    text-align: center;
    padding: 4rem 2rem;
    background: white;
    border-radius: 20px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.no-results-icon {
    font-size: 5rem;
    margin-bottom: 2rem;
    opacity: 0.5;
}

.no-results-title {
    color: #2c5aa0;
    font-size: 2rem;
    margin-bottom: 1rem;
    font-weight: 600;
}

.no-results-message {
    color: #666;
    font-size: 1.1rem;
    line-height: 1.6;
    margin-bottom: 3rem;
}

.search-suggestions {
    background: #f8f9fa;
    padding: 2rem;
    border-radius: 15px;
    margin-bottom: 3rem;
    text-align: left;
}

.suggestions-title {
    color: #2c5aa0;
    font-size: 1.3rem;
    margin-bottom: 1rem;
    text-align: center;
}

.suggestions-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.suggestions-list li {
    padding: 0.8rem 0;
    color: #555;
    line-height: 1.6;
}

.alternative-actions {
    text-align: left;
}

.alternatives-title {
    color: #2c5aa0;
    font-size: 1.3rem;
    margin-bottom: 2rem;
    text-align: center;
}

.alternatives-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
}

.alternative-item {
    background: #f8f9fa;
    padding: 2rem;
    border-radius: 15px;
}

.alternative-item h4 {
    color: #2c5aa0;
    margin-bottom: 1rem;
    font-size: 1.1rem;
}

.category-links,
.popular-posts {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.category-link,
.archive-link,
.popular-post-link {
    background: white;
    color: #2c5aa0;
    text-decoration: none;
    padding: 0.8rem 1rem;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.category-link:hover,
.archive-link:hover,
.popular-post-link:hover {
    background: #2c5aa0;
    color: white;
}

/* Search Widgets */
.search-stats-widget,
.popular-searches-widget,
.related-categories-widget {
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    border: 2px solid #2c5aa0;
}

.search-stats-widget .widget-title,
.popular-searches-widget .widget-title,
.related-categories-widget .widget-title {
    background: #2c5aa0;
    color: white;
    margin: -1.5rem -1.5rem 1.5rem -1.5rem;
    padding: 1rem 1.5rem;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(80px, 1fr));
    gap: 1rem;
    margin-bottom: 2rem;
}

.stat-item {
    background: white;
    padding: 1rem;
    border-radius: 8px;
    text-align: center;
}

.stat-value {
    display: block;
    font-size: 1.5rem;
    font-weight: 700;
    color: #2c5aa0;
}

.stat-label {
    font-size: 0.8rem;
    color: #666;
}

.search-tips h4 {
    color: #2c5aa0;
    margin-bottom: 1rem;
}

.tips-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.tips-list li {
    background: white;
    padding: 0.8rem;
    border-radius: 6px;
    margin-bottom: 0.5rem;
    font-size: 0.9rem;
    color: #555;
}

.popular-searches,
.categories-list {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.popular-search-item,
.category-item {
    background: white;
    padding: 0.8rem 1rem;
    border-radius: 8px;
    text-decoration: none;
    color: #333;
    display: flex;
    justify-content: space-between;
    align-items: center;
    transition: all 0.3s ease;
}

.popular-search-item:hover,
.category-item:hover {
    background: #2c5aa0;
    color: white;
}

.search-term,
.category-name {
    font-weight: 500;
}

.search-count,
.category-count {
    background: #f8f9fa;
    color: #666;
    padding: 0.2rem 0.6rem;
    border-radius: 10px;
    font-size: 0.8rem;
    font-weight: 600;
}

.popular-search-item:hover .search-count,
.category-item:hover .category-count {
    background: rgba(255,255,255,0.2);
    color: white;
}

/* Mobile Responsive */
@media (max-width: 767px) {
    .search-header {
        padding: 2rem 1rem;
    }
    
    .search-info {
        flex-direction: column;
        align-items: center;
        text-align: center;
        gap: 1rem;
    }
    
    .search-icon {
        font-size: 3rem;
    }
    
    .search-stats {
        justify-content: center;
        flex-direction: column;
        gap: 1rem;
    }
    
    .enhanced-search-form {
        padding: 1.5rem;
    }
    
    .search-input-wrapper {
        flex-direction: column;
    }
    
    .options-content {
        grid-template-columns: 1fr;
    }
    
    .search-filters {
        flex-direction: column;
        align-items: stretch;
    }
    
    .filter-tabs {
        justify-content: center;
    }
    
    .search-result-item {
        flex-direction: column;
        padding: 1.5rem;
    }
    
    .result-thumbnail {
        width: 100%;
        height: 200px;
        order: -1;
    }
    
    .result-footer {
        flex-direction: column;
        align-items: stretch;
        gap: 1rem;
    }
    
    .result-meta {
        justify-content: center;
    }
    
    .result-actions {
        justify-content: center;
    }
    
    .alternatives-grid {
        grid-template-columns: 1fr;
    }
    
    .stats-grid {
        grid-template-columns: repeat(3, 1fr);
    }
}

/* Print Styles */
@media print {
    .search-filters,
    .widget-area,
    .search-pagination,
    .quick-share,
    .result-actions {
        display: none;
    }
    
    .search-result-item {
        box-shadow: none;
        border: 1px solid #ccc;
        break-inside: avoid;
    }
}
</style>

<script>
// Toggle search options
function toggleSearchOptions() {
    const toggleBtn = document.querySelector('.toggle-btn');
    const optionsContent = document.getElementById('options-content');
    
    toggleBtn.classList.toggle('expanded');
    optionsContent.classList.toggle('expanded');
}

// Handle search sort
function handleSearchSort(value) {
    const currentUrl = new URL(window.location);
    currentUrl.searchParams.set('orderby', value);
    window.location.href = currentUrl.toString();
}

// Filter tabs functionality
document.addEventListener('DOMContentLoaded', function() {
    const filterTabs = document.querySelectorAll('.filter-tab');
    const searchResults = document.querySelectorAll('.search-result-item');
    
    filterTabs.forEach(tab => {
        tab.addEventListener('click', function() {
            const filter = this.dataset.filter;
            
            // Update active tab
            filterTabs.forEach(t => t.classList.remove('active'));
            this.classList.add('active');
            
            // Filter results
            searchResults.forEach(result => {
                if (filter === 'all' || result.dataset.postType === filter) {
                    result.style.display = 'flex';
                } else {
                    result.style.display = 'none';
                }
            });
        });
    });
});

// Toggle quick share
function toggleQuickShare(button) {
    const shareOptions = button.nextElementSibling;
    shareOptions.classList.toggle('active');
    
    // Close other open share options
    document.querySelectorAll('.share-options').forEach(options => {
        if (options !== shareOptions) {
            options.classList.remove('active');
        }
    });
}

// Copy result URL
function copyResultURL(url) {
    navigator.clipboard.writeText(url).then(function() {
        alert('URLをクリップボードにコピーしました！');
    }).catch(function() {
        // Fallback for older browsers
        const textArea = document.createElement('textarea');
        textArea.value = url;
        document.body.appendChild(textArea);
        textArea.select();
        document.execCommand('copy');
        document.body.removeChild(textArea);
        alert('URLをクリップボードにコピーしました！');
    });
}

// Close share options when clicking outside
document.addEventListener('click', function(e) {
    if (!e.target.closest('.quick-share')) {
        document.querySelectorAll('.share-options').forEach(options => {
            options.classList.remove('active');
        });
    }
});
</script>

<?php
get_footer();
?>