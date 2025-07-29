<?php
/**
 * The template for displaying all pages
 *
 * @package copipe-theme
 * @version 3.0.0
 */

get_header(); ?>

<main id="primary" class="main-content">
    <div class="container">
        <div class="content-area">
            
            <?php while (have_posts()) : the_post(); ?>
                
                <article id="post-<?php the_ID(); ?>" <?php post_class('page-content'); ?>>
                    
                    <?php if (has_post_thumbnail() && !is_page_template('page-postpilot.php')) : ?>
                        <div class="page-hero-image">
                            <?php the_post_thumbnail('copipe-hero', array(
                                'alt' => the_title_attribute(array('echo' => false))
                            )); ?>
                        </div>
                    <?php endif; ?>
                    
                    <header class="entry-header">
                        <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
                        
                        <?php if (get_the_excerpt()) : ?>
                            <div class="page-excerpt">
                                <?php the_excerpt(); ?>
                            </div>
                        <?php endif; ?>
                        
                        <div class="page-meta">
                            <div class="meta-item updated-date">
                                <span class="meta-icon">🔄</span>
                                <time class="updated" datetime="<?php echo esc_attr(get_the_modified_date('c')); ?>">
                                    最終更新: <?php echo esc_html(get_the_modified_date('Y年m月d日')); ?>
                                </time>
                            </div>
                        </div>
                    </header><!-- .entry-header -->
                    
                    <div class="entry-content">
                        <?php
                        the_content();
                        
                        wp_link_pages(array(
                            'before' => '<div class="page-links">' . esc_html__('Pages:', 'copipe-theme'),
                            'after'  => '</div>',
                        ));
                        ?>
                    </div><!-- .entry-content -->
                    
                    <?php if (is_page('about') || is_page('profile')) : ?>
                        <!-- About/Profile specific content -->
                        <div class="about-additional">
                            <?php if (function_exists('get_field') && get_field('skills')) : ?>
                                <section class="skills-section">
                                    <h3>スキル・専門分野</h3>
                                    <div class="skills-list">
                                        <?php
                                        $skills = get_field('skills');
                                        if ($skills) :
                                            foreach ($skills as $skill) :
                                        ?>
                                            <span class="skill-tag"><?php echo esc_html($skill['skill_name']); ?></span>
                                        <?php
                                            endforeach;
                                        endif;
                                        ?>
                                    </div>
                                </section>
                            <?php endif; ?>
                            
                            <?php if (function_exists('get_field') && get_field('achievements')) : ?>
                                <section class="achievements-section">
                                    <h3>実績・経歴</h3>
                                    <div class="achievements-list">
                                        <?php
                                        $achievements = get_field('achievements');
                                        if ($achievements) :
                                            foreach ($achievements as $achievement) :
                                        ?>
                                            <div class="achievement-item">
                                                <div class="achievement-year"><?php echo esc_html($achievement['year']); ?></div>
                                                <div class="achievement-content">
                                                    <h4><?php echo esc_html($achievement['title']); ?></h4>
                                                    <p><?php echo esc_html($achievement['description']); ?></p>
                                                </div>
                                            </div>
                                        <?php
                                            endforeach;
                                        endif;
                                        ?>
                                    </div>
                                </section>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if (is_page('contact')) : ?>
                        <!-- Contact form or additional contact info -->
                        <div class="contact-additional">
                            <div class="contact-methods">
                                <h3>お問い合わせ方法</h3>
                                <div class="contact-options">
                                    <div class="contact-option">
                                        <div class="contact-icon">📧</div>
                                        <h4>メール</h4>
                                        <p>お気軽にメールでお問い合わせください。24時間以内に返信いたします。</p>
                                    </div>
                                    
                                    <?php if (get_option('copipe_line_url')) : ?>
                                        <div class="contact-option">
                                            <div class="contact-icon">💬</div>
                                            <h4>LINE</h4>
                                            <p>LINEでのお問い合わせも受け付けております。</p>
                                            <a href="<?php echo esc_url(get_option('copipe_line_url')); ?>" 
                                               class="contact-btn line-btn"
                                               target="_blank"
                                               rel="noopener">
                                                LINE公式アカウント
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <div class="contact-option">
                                        <div class="contact-icon">⚡</div>
                                        <h4>返信時間</h4>
                                        <p>平日: 9:00-18:00<br>土日祝日: 10:00-17:00</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                </article><!-- #post-<?php the_ID(); ?> -->
                
                <?php
                // If comments are open or we have at least one comment, load up the comment template.
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif;
                ?>
                
            <?php endwhile; // End of the loop. ?>
            
        </div><!-- .content-area -->
        
        <?php if (!is_page_template('page-postpilot.php')) : ?>
            <aside id="secondary" class="widget-area">
                <?php dynamic_sidebar('sidebar-1'); ?>
            </aside><!-- #secondary -->
        <?php endif; ?>
        
    </div><!-- .container -->
</main><!-- #primary -->

<style>
/* Page Content Styles */
.page-content {
    background: white;
    border-radius: 15px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    overflow: hidden;
    margin-bottom: 3rem;
}

/* Page Hero Image */
.page-hero-image {
    position: relative;
    max-height: 350px;
    overflow: hidden;
}

.page-hero-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* Entry Header */
.entry-header {
    padding: 2rem 2.5rem 1.5rem;
}

.page-content .entry-title {
    font-size: clamp(2rem, 4vw, 3rem);
    line-height: 1.2;
    color: #2c5aa0;
    margin-bottom: 1rem;
    font-weight: 700;
    text-align: center;
}

/* Page Excerpt */
.page-excerpt {
    background: #f8f9fa;
    padding: 1.5rem;
    border-radius: 10px;
    margin: 1.5rem 0;
    border-left: 4px solid #2c5aa0;
    font-size: 1.1rem;
    line-height: 1.6;
    color: #555;
    text-align: center;
}

/* Page Meta */
.page-meta {
    display: flex;
    justify-content: center;
    padding: 1rem 0;
    border-top: 1px solid #f0f0f0;
    margin-top: 1rem;
}

.page-meta .meta-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.9rem;
    color: #666;
}

.meta-icon {
    font-size: 1rem;
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
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    border-left: 4px solid #2c5aa0;
    padding: 1.5rem;
    margin: 2rem 0;
    font-style: italic;
    border-radius: 0 15px 15px 0;
    position: relative;
}

.entry-content blockquote::before {
    content: '"';
    font-size: 4rem;
    color: #2c5aa0;
    opacity: 0.3;
    position: absolute;
    top: -10px;
    left: 20px;
    font-family: serif;
}

.entry-content img {
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.entry-content .wp-block-image {
    text-align: center;
    margin: 2rem 0;
}

.entry-content .wp-block-image figcaption {
    color: #666;
    font-size: 0.9rem;
    font-style: italic;
    margin-top: 0.5rem;
}

/* Table Styles */
.entry-content table {
    width: 100%;
    border-collapse: collapse;
    margin: 2rem 0;
    background: white;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.entry-content th {
    background: linear-gradient(135deg, #2c5aa0, #1e3f73);
    color: white;
    padding: 1rem;
    text-align: left;
    font-weight: 600;
}

.entry-content td {
    padding: 1rem;
    border-bottom: 1px solid #f0f0f0;
}

.entry-content tr:last-child td {
    border-bottom: none;
}

.entry-content tr:nth-child(even) {
    background: #f8f9fa;
}

/* About/Profile Additional Content */
.about-additional {
    padding: 0 2.5rem 2rem;
}

.skills-section,
.achievements-section {
    margin: 3rem 0;
    padding: 2rem;
    background: #f8f9fa;
    border-radius: 15px;
}

.skills-section h3,
.achievements-section h3 {
    color: #2c5aa0;
    font-size: 1.5rem;
    margin-bottom: 1.5rem;
    text-align: center;
    font-weight: 600;
}

.skills-list {
    display: flex;
    flex-wrap: wrap;
    gap: 0.8rem;
    justify-content: center;
}

.skill-tag {
    background: linear-gradient(135deg, #2c5aa0, #ff6b35);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.9rem;
    font-weight: 500;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.achievements-list {
    position: relative;
}

.achievements-list::before {
    content: '';
    position: absolute;
    left: 30px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: linear-gradient(180deg, #2c5aa0, #ff6b35);
}

.achievement-item {
    display: flex;
    gap: 2rem;
    margin-bottom: 2rem;
    position: relative;
}

.achievement-year {
    background: #2c5aa0;
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-weight: 600;
    width: 80px;
    text-align: center;
    flex-shrink: 0;
    z-index: 2;
    position: relative;
}

.achievement-year::after {
    content: '';
    position: absolute;
    top: 50%;
    right: -11px;
    width: 20px;
    height: 20px;
    background: #ff6b35;
    border-radius: 50%;
    transform: translateY(-50%);
}

.achievement-content {
    flex: 1;
    background: white;
    padding: 1.5rem;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.achievement-content h4 {
    color: #2c5aa0;
    margin-bottom: 0.5rem;
    font-size: 1.2rem;
}

.achievement-content p {
    color: #555;
    line-height: 1.6;
    margin: 0;
}

/* Contact Additional Content */
.contact-additional {
    padding: 0 2.5rem 2rem;
}

.contact-methods {
    background: #f8f9fa;
    padding: 2rem;
    border-radius: 15px;
    margin-top: 2rem;
}

.contact-methods h3 {
    color: #2c5aa0;
    font-size: 1.5rem;
    text-align: center;
    margin-bottom: 2rem;
    font-weight: 600;
}

.contact-options {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
}

.contact-option {
    background: white;
    padding: 2rem;
    border-radius: 15px;
    text-align: center;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}

.contact-option:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

.contact-icon {
    font-size: 3rem;
    margin-bottom: 1rem;
}

.contact-option h4 {
    color: #2c5aa0;
    font-size: 1.3rem;
    margin-bottom: 1rem;
    font-weight: 600;
}

.contact-option p {
    color: #555;
    line-height: 1.6;
    margin-bottom: 1rem;
}

.contact-btn {
    display: inline-block;
    background: linear-gradient(135deg, #00c300, #00a000);
    color: white;
    text-decoration: none;
    padding: 0.8rem 1.5rem;
    border-radius: 25px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.contact-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 195, 0, 0.3);
    color: white;
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

/* Mobile Responsive */
@media (max-width: 767px) {
    .entry-header {
        padding: 1.5rem 1.5rem 1rem;
    }
    
    .page-content .entry-title {
        font-size: 2rem;
    }
    
    .entry-content {
        padding: 0 1.5rem 1.5rem;
        font-size: 1rem;
    }
    
    .about-additional {
        padding: 0 1.5rem 1.5rem;
    }
    
    .contact-additional {
        padding: 0 1.5rem 1.5rem;
    }
    
    .skills-section,
    .achievements-section,
    .contact-methods {
        padding: 1.5rem;
    }
    
    .contact-options {
        grid-template-columns: 1fr;
    }
    
    .achievement-item {
        flex-direction: column;
        gap: 1rem;
    }
    
    .achievements-list::before {
        display: none;
    }
    
    .achievement-year {
        width: auto;
        align-self: flex-start;
    }
    
    .achievement-year::after {
        display: none;
    }
    
    .page-excerpt {
        padding: 1rem;
        font-size: 1rem;
    }
}

/* Print Styles */
@media print {
    .page-content {
        box-shadow: none;
        border: 1px solid #ccc;
    }
    
    .contact-btn,
    .skill-tag {
        color: #000 !important;
        background: #f0f0f0 !important;
    }
    
    .achievement-item {
        break-inside: avoid;
    }
}

/* High Contrast Mode */
@media (prefers-contrast: high) {
    .page-content {
        border: 2px solid #000;
    }
    
    .page-excerpt,
    .skills-section,
    .achievements-section,
    .contact-methods {
        border: 1px solid #000;
    }
}

/* Reduced Motion */
@media (prefers-reduced-motion: reduce) {
    .contact-option:hover,
    .contact-btn:hover {
        transform: none;
    }
}
</style>

<?php
get_footer();
?>