<?php
/**
 * The main template file
 *
 * @package copipe-theme
 * @version 3.0.0
 */

get_header(); ?>

<main id="primary" class="main-content">
    <div class="container">
        <div class="content-area">
            
            <?php if (have_posts()) : ?>
                
                <?php if (is_home() && !is_front_page()) : ?>
                    <header class="page-header">
                        <h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
                    </header>
                <?php endif; ?>
                
                <div class="posts-container">
                    <?php while (have_posts()) : the_post(); ?>
                        
                        <article id="post-<?php the_ID(); ?>" <?php post_class('post-item'); ?>>
                            
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="post-thumbnail">
                                    <a href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
                                        <?php the_post_thumbnail('copipe-featured', array(
                                            'alt' => the_title_attribute(array('echo' => false))
                                        )); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                            
                            <header class="entry-header">
                                <?php
                                if (is_singular()) :
                                    the_title('<h1 class="entry-title">', '</h1>');
                                else :
                                    the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
                                endif;
                                ?>
                                
                                <?php if ('post' === get_post_type()) : ?>
                                    <div class="entry-meta">
                                        <span class="posted-on">
                                            <time class="entry-date published" datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                                                <?php echo esc_html(get_the_date()); ?>
                                            </time>
                                        </span>
                                        
                                        <?php
                                        $categories = get_the_category();
                                        if (!empty($categories)) :
                                        ?>
                                            <span class="cat-links">
                                                <?php
                                                foreach ($categories as $category) {
                                                    echo '<a href="' . esc_url(get_category_link($category->term_id)) . '" class="category-tag">' . esc_html($category->name) . '</a>';
                                                }
                                                ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            </header><!-- .entry-header -->
                            
                            <div class="entry-content">
                                <?php
                                if (is_singular() || is_home()) {
                                    the_excerpt();
                                } else {
                                    the_excerpt();
                                }
                                ?>
                                
                                <?php if (!is_singular()) : ?>
                                    <div class="read-more-container">
                                        <a href="<?php the_permalink(); ?>" class="read-more-btn">
                                            続きを読む
                                            <span class="read-more-arrow">→</span>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div><!-- .entry-content -->
                            
                            <?php if (is_singular()) : ?>
                                <footer class="entry-footer">
                                    <?php
                                    $tags = get_the_tags();
                                    if (!empty($tags)) :
                                    ?>
                                        <div class="tag-links">
                                            <span class="tags-label">タグ:</span>
                                            <?php
                                            foreach ($tags as $tag) {
                                                echo '<a href="' . esc_url(get_tag_link($tag->term_id)) . '" class="tag-link">' . esc_html($tag->name) . '</a>';
                                            }
                                            ?>
                                        </div>
                                    <?php endif; ?>
                                </footer><!-- .entry-footer -->
                            <?php endif; ?>
                            
                        </article><!-- #post-<?php the_ID(); ?> -->
                        
                    <?php endwhile; ?>
                </div><!-- .posts-container -->
                
                <?php
                // Pagination
                the_posts_navigation(array(
                    'prev_text' => '<span class="nav-subtitle">前のページ</span>',
                    'next_text' => '<span class="nav-subtitle">次のページ</span>',
                ));
                ?>
                
            <?php else : ?>
                
                <section class="no-results not-found">
                    <header class="page-header">
                        <h1 class="page-title"><?php esc_html_e('Nothing here', 'copipe-theme'); ?></h1>
                    </header><!-- .page-header -->
                    
                    <div class="page-content">
                        <?php if (is_home() && current_user_can('publish_posts')) : ?>
                            
                            <p><?php
                                printf(
                                    wp_kses(
                                        __('Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'copipe-theme'),
                                        array(
                                            'a' => array(
                                                'href' => array(),
                                            ),
                                        )
                                    ),
                                    esc_url(admin_url('post-new.php'))
                                );
                            ?></p>
                            
                        <?php elseif (is_search()) : ?>
                            
                            <p><?php esc_html_e('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'copipe-theme'); ?></p>
                            <?php get_search_form(); ?>
                            
                        <?php else : ?>
                            
                            <p><?php esc_html_e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'copipe-theme'); ?></p>
                            <?php get_search_form(); ?>
                            
                        <?php endif; ?>
                    </div><!-- .page-content -->
                </section><!-- .no-results -->
                
            <?php endif; ?>
            
        </div><!-- .content-area -->
        
        <?php if (!is_page_template('page-postpilot.php')) : ?>
            <aside id="secondary" class="widget-area">
                <?php dynamic_sidebar('sidebar-1'); ?>
            </aside><!-- #secondary -->
        <?php endif; ?>
        
    </div><!-- .container -->
</main><!-- #primary -->

<style>
/* Main Content Styles */
.main-content {
    display: grid;
    grid-template-columns: 1fr;
    gap: 2rem;
    padding: 2rem 0;
}

@media (min-width: 768px) {
    .main-content .container {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 3rem;
    }
}

/* Posts Container */
.posts-container {
    display: grid;
    gap: 2rem;
}

/* Post Item */
.post-item {
    background: white;
    border-radius: 15px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    overflow: hidden;
    transition: all 0.3s ease;
}

.post-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

/* Post Thumbnail */
.post-thumbnail {
    position: relative;
    overflow: hidden;
}

.post-thumbnail img {
    width: 100%;
    height: 250px;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.post-item:hover .post-thumbnail img {
    transform: scale(1.05);
}

/* Entry Header */
.entry-header {
    padding: 1.5rem 2rem 1rem;
}

.entry-title {
    font-size: 1.5rem;
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
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
    font-size: 0.9rem;
    color: #666;
    margin-bottom: 0.5rem;
}

.posted-on {
    display: flex;
    align-items: center;
    gap: 0.3rem;
}

.posted-on::before {
    content: "📅";
}

.cat-links {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
}

.category-tag {
    background: #f0f8ff;
    color: #2c5aa0;
    padding: 0.2rem 0.8rem;
    border-radius: 20px;
    text-decoration: none;
    font-size: 0.8rem;
    font-weight: 500;
    transition: all 0.3s ease;
}

.category-tag:hover {
    background: #2c5aa0;
    color: white;
}

/* Entry Content */
.entry-content {
    padding: 0 2rem 1.5rem;
    color: #555;
    line-height: 1.7;
}

.read-more-container {
    margin-top: 1.5rem;
}

.read-more-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: linear-gradient(135deg, #2c5aa0, #ff6b35);
    color: white;
    text-decoration: none;
    padding: 0.8rem 1.5rem;
    border-radius: 25px;
    font-weight: 500;
    transition: all 0.3s ease;
    font-size: 0.9rem;
}

.read-more-btn:hover {
    transform: translateX(5px);
    box-shadow: 0 5px 15px rgba(44, 90, 160, 0.3);
    color: white;
}

.read-more-arrow {
    transition: transform 0.3s ease;
}

.read-more-btn:hover .read-more-arrow {
    transform: translateX(3px);
}

/* Entry Footer */
.entry-footer {
    padding: 1rem 2rem 1.5rem;
    border-top: 1px solid #f0f0f0;
}

.tag-links {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 0.5rem;
}

.tags-label {
    color: #666;
    font-weight: 500;
    font-size: 0.9rem;
}

.tag-link {
    background: #f8f9fa;
    color: #666;
    padding: 0.3rem 0.8rem;
    border-radius: 15px;
    text-decoration: none;
    font-size: 0.8rem;
    transition: all 0.3s ease;
}

.tag-link:hover {
    background: #ff6b35;
    color: white;
}

/* Pagination */
.posts-navigation {
    margin-top: 3rem;
    padding: 2rem 0;
}

.nav-links {
    display: flex;
    justify-content: space-between;
    align-items: center;
    max-width: 500px;
    margin: 0 auto;
}

.nav-previous,
.nav-next {
    flex: 1;
}

.nav-next {
    text-align: right;
}

.nav-previous a,
.nav-next a {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: white;
    color: #2c5aa0;
    text-decoration: none;
    padding: 1rem 1.5rem;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    font-weight: 500;
}

.nav-previous a:hover,
.nav-next a:hover {
    background: #2c5aa0;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(44, 90, 160, 0.3);
}

.nav-previous a::before {
    content: "←";
}

.nav-next a::after {
    content: "→";
}

/* Sidebar */
.widget-area {
    background: #f8f9fa;
    padding: 2rem;
    border-radius: 15px;
    height: fit-content;
    position: sticky;
    top: 100px;
}

.widget {
    margin-bottom: 2rem;
    background: white;
    padding: 1.5rem;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.widget:last-child {
    margin-bottom: 0;
}

.widget-title {
    color: #2c5aa0;
    font-size: 1.2rem;
    font-weight: 600;
    margin-bottom: 1rem;
    padding-bottom: 0.5rem;
    border-bottom: 2px solid #f0f0f0;
}

.widget ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.widget li {
    padding: 0.5rem 0;
    border-bottom: 1px solid #f0f0f0;
}

.widget li:last-child {
    border-bottom: none;
}

.widget a {
    color: #555;
    text-decoration: none;
    transition: color 0.3s ease;
}

.widget a:hover {
    color: #2c5aa0;
}

/* No Results */
.no-results {
    text-align: center;
    padding: 3rem 2rem;
    background: white;
    border-radius: 15px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.no-results .page-title {
    color: #2c5aa0;
    font-size: 2rem;
    margin-bottom: 1rem;
}

.no-results .page-content {
    color: #666;
    line-height: 1.7;
}

.no-results .page-content p {
    margin-bottom: 1.5rem;
}

/* Search Form */
.search-form {
    display: flex;
    max-width: 400px;
    margin: 0 auto;
    gap: 0.5rem;
}

.search-field {
    flex: 1;
    padding: 0.8rem 1rem;
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
    background: #2c5aa0;
    color: white;
    border: none;
    padding: 0.8rem 1.5rem;
    border-radius: 25px;
    cursor: pointer;
    font-weight: 500;
    transition: all 0.3s ease;
}

.search-submit:hover {
    background: #1e3f73;
    transform: translateY(-1px);
}

/* Mobile Responsive */
@media (max-width: 767px) {
    .main-content {
        padding: 1rem 0;
    }
    
    .main-content .container {
        grid-template-columns: 1fr;
        gap: 2rem;
    }
    
    .entry-header {
        padding: 1rem 1.5rem 0.5rem;
    }
    
    .entry-title {
        font-size: 1.3rem;
    }
    
    .entry-content {
        padding: 0 1.5rem 1rem;
    }
    
    .entry-footer {
        padding: 0.8rem 1.5rem 1rem;
    }
    
    .widget-area {
        position: static;
        padding: 1.5rem;
    }
    
    .posts-navigation {
        margin-top: 2rem;
    }
    
    .nav-links {
        flex-direction: column;
        gap: 1rem;
    }
    
    .nav-next {
        text-align: center;
    }
    
    .search-form {
        flex-direction: column;
    }
}

/* Print Styles */
@media print {
    .widget-area,
    .posts-navigation,
    .read-more-container {
        display: none;
    }
    
    .post-item {
        box-shadow: none;
        border: 1px solid #ccc;
        break-inside: avoid;
    }
    
    .post-thumbnail img {
        max-height: 200px;
    }
}

/* High Contrast Mode */
@media (prefers-contrast: high) {
    .post-item {
        border: 2px solid #000;
    }
    
    .category-tag,
    .tag-link,
    .read-more-btn {
        border: 1px solid #000;
    }
}

/* Reduced Motion */
@media (prefers-reduced-motion: reduce) {
    .post-item:hover,
    .read-more-btn:hover,
    .nav-previous a:hover,
    .nav-next a:hover,
    .search-submit:hover {
        transform: none;
    }
    
    .post-thumbnail img {
        transition: none;
    }
}
</style>

<?php
get_footer();
?>