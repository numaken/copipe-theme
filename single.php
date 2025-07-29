<?php
/**
 * The template for displaying all single posts
 *
 * @package copipe-theme
 * @version 3.0.0
 */

get_header(); ?>

<main id="primary" class="main-content">
    <div class="container">
        <div class="content-area">
            
            <?php while (have_posts()) : the_post(); ?>
                
                <article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?>>
                    
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="post-hero-image">
                            <?php the_post_thumbnail('copipe-hero', array(
                                'alt' => the_title_attribute(array('echo' => false))
                            )); ?>
                        </div>
                    <?php endif; ?>
                    
                    <header class="entry-header">
                        <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
                        
                        <div class="entry-meta">
                            <div class="meta-item published-date">
                                <span class="meta-icon">📅</span>
                                <time class="entry-date published" datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                                    <?php echo esc_html(get_the_date('Y年m月d日')); ?>
                                </time>
                                <?php
                                $modified_time = get_the_modified_time('U');
                                $published_time = get_the_time('U');
                                if ($modified_time > $published_time + 86400) : // 1 day difference
                                ?>
                                    <span class="updated-date">
                                        （更新: <?php echo esc_html(get_the_modified_date('Y年m月d日')); ?>）
                                    </span>
                                <?php endif; ?>
                            </div>
                            
                            <?php
                            $categories = get_the_category();
                            if (!empty($categories)) :
                            ?>
                                <div class="meta-item categories">
                                    <span class="meta-icon">📂</span>
                                    <span class="cat-links">
                                        <?php
                                        foreach ($categories as $category) {
                                            echo '<a href="' . esc_url(get_category_link($category->term_id)) . '" class="category-link">' . esc_html($category->name) . '</a>';
                                        }
                                        ?>
                                    </span>
                                </div>
                            <?php endif; ?>
                            
                            <div class="meta-item reading-time">
                                <span class="meta-icon">⏱️</span>
                                <span class="reading-time-text">
                                    <?php echo copipe_get_reading_time(); ?>
                                </span>
                            </div>
                        </div><!-- .entry-meta -->
                    </header><!-- .entry-header -->
                    
                    <div class="entry-content">
                        <?php
                        the_content(sprintf(
                            wp_kses(
                                __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'copipe-theme'),
                                array(
                                    'span' => array(
                                        'class' => array(),
                                    ),
                                )
                            ),
                            wp_kses_post(get_the_title())
                        ));
                        
                        wp_link_pages(array(
                            'before' => '<div class="page-links">' . esc_html__('Pages:', 'copipe-theme'),
                            'after'  => '</div>',
                        ));
                        ?>
                    </div><!-- .entry-content -->
                    
                    <footer class="entry-footer">
                        <?php
                        $tags = get_the_tags();
                        if (!empty($tags)) :
                        ?>
                            <div class="tag-cloud">
                                <h3 class="tags-title">関連タグ</h3>
                                <div class="tag-list">
                                    <?php
                                    foreach ($tags as $tag) {
                                        echo '<a href="' . esc_url(get_tag_link($tag->term_id)) . '" class="tag-item">' . esc_html($tag->name) . '</a>';
                                    }
                                    ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        
                        <!-- Social Share Buttons -->
                        <div class="social-share">
                            <h3 class="share-title">この記事をシェア</h3>
                            <div class="share-buttons">
                                <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" 
                                   target="_blank" 
                                   rel="noopener"
                                   class="share-btn twitter">
                                    <span class="share-icon">🐦</span>
                                    <span class="share-text">Twitter</span>
                                </a>
                                
                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" 
                                   target="_blank" 
                                   rel="noopener"
                                   class="share-btn facebook">
                                    <span class="share-icon">📘</span>
                                    <span class="share-text">Facebook</span>
                                </a>
                                
                                <a href="https://social-plugins.line.me/lineit/share?url=<?php echo urlencode(get_permalink()); ?>" 
                                   target="_blank" 
                                   rel="noopener"
                                   class="share-btn line">
                                    <span class="share-icon">💬</span>
                                    <span class="share-text">LINE</span>
                                </a>
                                
                                <button class="share-btn copy-url" onclick="copyURL()">
                                    <span class="share-icon">📋</span>
                                    <span class="share-text">URLコピー</span>
                                </button>
                            </div>
                        </div>
                    </footer><!-- .entry-footer -->
                    
                </article><!-- #post-<?php the_ID(); ?> -->
                
                <!-- Author Bio -->
                <?php if (get_the_author_meta('description')) : ?>
                    <div class="author-bio">
                        <div class="author-info">
                            <div class="author-avatar">
                                <?php echo get_avatar(get_the_author_meta('ID'), 80); ?>
                            </div>
                            <div class="author-details">
                                <h3 class="author-name">
                                    <?php echo esc_html(get_the_author_meta('display_name')); ?>
                                </h3>
                                <div class="author-description">
                                    <?php echo wp_kses_post(get_the_author_meta('description')); ?>
                                </div>
                                <div class="author-links">
                                    <?php
                                    $author_website = get_the_author_meta('user_url');
                                    if ($author_website) :
                                    ?>
                                        <a href="<?php echo esc_url($author_website); ?>" 
                                           target="_blank" 
                                           rel="noopener"
                                           class="author-website">
                                            🌐 ウェブサイト
                                        </a>
                                    <?php endif; ?>
                                    
                                    <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" 
                                       class="author-posts">
                                        📝 <?php echo esc_html(get_the_author_meta('display_name')); ?>の記事一覧
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                
                <!-- Related Posts -->
                <?php
                $related_posts = copipe_get_related_posts(get_the_ID(), 3);
                if (!empty($related_posts)) :
                ?>
                    <div class="related-posts">
                        <h3 class="related-title">関連記事</h3>
                        <div class="related-posts-grid">
                            <?php foreach ($related_posts as $related_post) : ?>
                                <article class="related-post-item">
                                    <a href="<?php echo esc_url(get_permalink($related_post->ID)); ?>" class="related-post-link">
                                        <?php if (has_post_thumbnail($related_post->ID)) : ?>
                                            <div class="related-post-thumbnail">
                                                <?php echo get_the_post_thumbnail($related_post->ID, 'copipe-thumbnail'); ?>
                                            </div>
                                        <?php endif; ?>
                                        <div class="related-post-content">
                                            <h4 class="related-post-title">
                                                <?php echo esc_html(get_the_title($related_post->ID)); ?>
                                            </h4>
                                            <div class="related-post-meta">
                                                <time class="related-post-date">
                                                    <?php echo esc_html(get_the_date('Y.m.d', $related_post->ID)); ?>
                                                </time>
                                            </div>
                                        </div>
                                    </a>
                                </article>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
                
                <!-- Post Navigation -->
                <nav class="post-navigation" aria-label="投稿ナビゲーション">
                    <div class="nav-links">
                        <?php
                        $prev_post = get_previous_post();
                        $next_post = get_next_post();
                        ?>
                        
                        <?php if ($prev_post) : ?>
                            <div class="nav-previous">
                                <a href="<?php echo esc_url(get_permalink($prev_post->ID)); ?>" class="nav-link">
                                    <div class="nav-direction">← 前の記事</div>
                                    <div class="nav-title"><?php echo esc_html(get_the_title($prev_post->ID)); ?></div>
                                </a>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($next_post) : ?>
                            <div class="nav-next">
                                <a href="<?php echo esc_url(get_permalink($next_post->ID)); ?>" class="nav-link">
                                    <div class="nav-direction">次の記事 →</div>
                                    <div class="nav-title"><?php echo esc_html(get_the_title($next_post->ID)); ?></div>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </nav><!-- .post-navigation -->
                
                <?php
                // If comments are open or we have at least one comment, load up the comment template.
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif;
                ?>
                
            <?php endwhile; // End of the loop. ?>
            
        </div><!-- .content-area -->
        
        <aside id="secondary" class="widget-area">
            <?php dynamic_sidebar('sidebar-1'); ?>
        </aside><!-- #secondary -->
        
    </div><!-- .container -->
</main><!-- #primary -->

<style>
/* Single Post Styles */
.single-post {
    background: white;
    border-radius: 15px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    overflow: hidden;
    margin-bottom: 3rem;
}

/* Hero Image */
.post-hero-image {
    position: relative;
    max-height: 400px;
    overflow: hidden;
}

.post-hero-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* Entry Header */
.entry-header {
    padding: 2rem 2.5rem 1.5rem;
}

.single-post .entry-title {
    font-size: clamp(1.8rem, 4vw, 2.5rem);
    line-height: 1.3;
    color: #2c5aa0;
    margin-bottom: 1.5rem;
    font-weight: 700;
}

/* Entry Meta */
.entry-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 1.5rem;
    padding: 1rem 0;
    border-top: 1px solid #f0f0f0;
    border-bottom: 1px solid #f0f0f0;
    margin-bottom: 1rem;
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.9rem;
    color: #666;
}

.meta-icon {
    font-size: 1rem;
}

.updated-date {
    color: #999;
    font-size: 0.8rem;
    margin-left: 0.5rem;
}

.category-link {
    background: #f0f8ff;
    color: #2c5aa0;
    padding: 0.3rem 0.8rem;
    border-radius: 15px;
    text-decoration: none;
    font-size: 0.8rem;
    font-weight: 500;
    transition: all 0.3s ease;
    margin-right: 0.5rem;
}

.category-link:hover {
    background: #2c5aa0;
    color: white;
}

/* Entry Content */
.entry-content {
    padding: 0 2.5rem 2rem;
    color: #333;
    line-height: 1.8;
    font-size: 1.1rem;
}

.entry-content h2 {
    color: #2c5aa0;
    font-size: 1.8rem;
    margin: 2.5rem 0 1rem;
    padding-bottom: 0.5rem;
    border-bottom: 3px solid #f0f8ff;
    position: relative;
}

.entry-content h2::before {
    content: '';
    position: absolute;
    bottom: -3px;
    left: 0;
    width: 60px;
    height: 3px;
    background: linear-gradient(90deg, #2c5aa0, #ff6b35);
}

.entry-content h3 {
    color: #2c5aa0;
    font-size: 1.5rem;
    margin: 2rem 0 1rem;
    padding-left: 1rem;
    border-left: 4px solid #ff6b35;
}

.entry-content h4 {
    color: #2c5aa0;
    font-size: 1.3rem;
    margin: 1.5rem 0 0.8rem;
}

.entry-content p {
    margin-bottom: 1.5rem;
}

.entry-content ul,
.entry-content ol {
    margin: 1.5rem 0;
    padding-left: 2rem;
}

.entry-content li {
    margin-bottom: 0.8rem;
    line-height: 1.7;
}

.entry-content blockquote {
    background: #f8f9fa;
    border-left: 4px solid #2c5aa0;
    padding: 1.5rem;
    margin: 2rem 0;
    font-style: italic;
    border-radius: 0 10px 10px 0;
}

.entry-content img {
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.entry-content code {
    background: #f1f3f4;
    padding: 0.2rem 0.4rem;
    border-radius: 4px;
    font-family: 'Courier New', monospace;
    font-size: 0.9em;
    color: #d63031;
}

.entry-content pre {
    background: #2d3748;
    color: #e2e8f0;
    padding: 1.5rem;
    border-radius: 10px;
    overflow-x: auto;
    margin: 2rem 0;
}

.entry-content pre code {
    background: none;
    padding: 0;
    color: inherit;
}

/* Page Links */
.page-links {
    margin: 2rem 0;
    padding: 1rem;
    background: #f8f9fa;
    border-radius: 10px;
    text-align: center;
}

.page-links a {
    display: inline-block;
    padding: 0.5rem 1rem;
    margin: 0 0.2rem;
    background: #2c5aa0;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    transition: all 0.3s ease;
}

.page-links a:hover {
    background: #1e3f73;
}

/* Entry Footer */
.entry-footer {
    padding: 1.5rem 2.5rem 2rem;
    border-top: 1px solid #f0f0f0;
}

/* Tag Cloud */
.tag-cloud {
    margin-bottom: 2rem;
}

.tags-title {
    color: #2c5aa0;
    font-size: 1.2rem;
    margin-bottom: 1rem;
    font-weight: 600;
}

.tag-list {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
}

.tag-item {
    background: #f8f9fa;
    color: #666;
    padding: 0.4rem 1rem;
    border-radius: 20px;
    text-decoration: none;
    font-size: 0.9rem;
    transition: all 0.3s ease;
}

.tag-item:hover {
    background: #ff6b35;
    color: white;
    transform: translateY(-2px);
}

/* Social Share */
.social-share {
    margin-bottom: 2rem;
}

.share-title {
    color: #2c5aa0;
    font-size: 1.2rem;
    margin-bottom: 1rem;
    font-weight: 600;
}

.share-buttons {
    display: flex;
    flex-wrap: wrap;
    gap: 0.8rem;
}

.share-btn {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.8rem 1.2rem;
    border-radius: 25px;
    text-decoration: none;
    font-weight: 500;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
    font-size: 0.9rem;
}

.share-btn.twitter {
    background: #1da1f2;
    color: white;
}

.share-btn.facebook {
    background: #4267b2;
    color: white;
}

.share-btn.line {
    background: #00c300;
    color: white;
}

.share-btn.copy-url {
    background: #666;
    color: white;
}

.share-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

/* Author Bio */
.author-bio {
    background: #f8f9fa;
    padding: 2rem;
    border-radius: 15px;
    margin-bottom: 3rem;
}

.author-info {
    display: flex;
    gap: 1.5rem;
    align-items: flex-start;
}

.author-avatar img {
    border-radius: 50%;
    width: 80px;
    height: 80px;
}

.author-details {
    flex: 1;
}

.author-name {
    color: #2c5aa0;
    font-size: 1.3rem;
    margin-bottom: 0.8rem;
    font-weight: 600;
}

.author-description {
    color: #555;
    line-height: 1.6;
    margin-bottom: 1rem;
}

.author-links {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
}

.author-website,
.author-posts {
    color: #2c5aa0;
    text-decoration: none;
    font-size: 0.9rem;
    font-weight: 500;
    transition: color 0.3s ease;
}

.author-website:hover,
.author-posts:hover {
    color: #ff6b35;
}

/* Related Posts */
.related-posts {
    background: #f8f9fa;
    padding: 2rem;
    border-radius: 15px;
    margin-bottom: 3rem;
}

.related-title {
    color: #2c5aa0;
    font-size: 1.5rem;
    margin-bottom: 1.5rem;
    font-weight: 600;
    text-align: center;
}

.related-posts-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
}

.related-post-item {
    background: white;
    border-radius: 10px;
    overflow: hidden;
    transition: all 0.3s ease;
}

.related-post-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

.related-post-link {
    display: block;
    text-decoration: none;
    color: inherit;
}

.related-post-thumbnail {
    height: 150px;
    overflow: hidden;
}

.related-post-thumbnail img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.related-post-item:hover .related-post-thumbnail img {
    transform: scale(1.05);
}

.related-post-content {
    padding: 1rem;
}

.related-post-title {
    color: #2c5aa0;
    font-size: 1rem;
    line-height: 1.4;
    margin-bottom: 0.5rem;
    font-weight: 600;
}

.related-post-meta {
    color: #666;
    font-size: 0.8rem;
}

/* Post Navigation */
.post-navigation {
    margin-bottom: 3rem;
}

.post-navigation .nav-links {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 2rem;
}

.nav-link {
    display: block;
    background: white;
    padding: 1.5rem;
    border-radius: 10px;
    text-decoration: none;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}

.nav-link:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

.nav-direction {
    color: #666;
    font-size: 0.9rem;
    margin-bottom: 0.5rem;
    font-weight: 500;
}

.nav-title {
    color: #2c5aa0;
    font-weight: 600;
    line-height: 1.4;
}

.nav-next .nav-link {
    text-align: right;
}

/* Mobile Responsive */
@media (max-width: 767px) {
    .entry-header {
        padding: 1.5rem 1.5rem 1rem;
    }
    
    .entry-content {
        padding: 0 1.5rem 1.5rem;
        font-size: 1rem;
    }
    
    .entry-footer {
        padding: 1rem 1.5rem 1.5rem;
    }
    
    .entry-meta {
        flex-direction: column;
        gap: 1rem;
    }
    
    .share-buttons {
        justify-content: center;
    }
    
    .author-info {
        flex-direction: column;
        text-align: center;
    }
    
    .author-links {
        justify-content: center;
    }
    
    .related-posts-grid {
        grid-template-columns: 1fr;
    }
    
    .post-navigation .nav-links {
        grid-template-columns: 1fr;
    }
    
    .nav-next .nav-link {
        text-align: left;
    }
}
</style>

<script>
// Copy URL function
function copyURL() {
    const url = window.location.href;
    navigator.clipboard.writeText(url).then(function() {
        const btn = document.querySelector('.copy-url .share-text');
        const originalText = btn.textContent;
        btn.textContent = 'コピー完了！';
        
        setTimeout(function() {
            btn.textContent = originalText;
        }, 2000);
    }).catch(function() {
        // Fallback for older browsers
        const textArea = document.createElement('textarea');
        textArea.value = url;
        document.body.appendChild(textArea);
        textArea.select();
        document.execCommand('copy');
        document.body.removeChild(textArea);
        
        const btn = document.querySelector('.copy-url .share-text');
        const originalText = btn.textContent;
        btn.textContent = 'コピー完了！';
        
        setTimeout(function() {
            btn.textContent = originalText;
        }, 2000);
    });
}
</script>

<?php
get_footer();

// Helper functions
function copipe_get_reading_time() {
    $content = get_post_field('post_content', get_the_ID());
    $word_count = str_word_count(strip_tags($content));
    $reading_time = ceil($word_count / 200); // Assuming 200 words per minute
    
    return $reading_time . '分で読めます';
}

function copipe_get_related_posts($post_id, $limit = 3) {
    $categories = wp_get_post_categories($post_id);
    
    if (empty($categories)) {
        return array();
    }
    
    $args = array(
        'category__in' => $categories,
        'post__not_in' => array($post_id),
        'posts_per_page' => $limit,
        'orderby' => 'rand'
    );
    
    $related_posts = get_posts($args);
    
    return $related_posts;
}
?>