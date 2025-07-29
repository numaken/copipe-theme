<?php
/**
 * Modern Category Page Template
 * 
 * @package Modern_Copipe_Theme
 */

get_header();

$term = get_queried_object();
?>

<style>
  /* Modern Category Styles */
  .modern-category-container {
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(10px);
    border-radius: 24px;
    border: 1px solid rgba(255, 255, 255, 0.1);
    margin: 2rem;
    overflow: hidden;
    box-shadow: var(--shadow-elevation);
  }

  .category-hero {
    background: var(--primary-gradient);
    padding: 4rem 2rem;
    text-align: center;
    position: relative;
    overflow: hidden;
  }

  .category-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url("data:image/svg+xml,%3Csvg width='80' height='80' viewBox='0 0 80 80' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Cpath d='M0 0h80v80H0V0zm20 20v40h40V20H20zm20 35a15 15 0 1 1 0-30 15 15 0 0 1 0 30z' /%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    opacity: 0.3;
  }

  .category-icon {
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(20px);
    border-radius: 50%;
    width: 120px;
    height: 120px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 2rem;
    border: 2px solid rgba(255, 255, 255, 0.3);
    animation: iconPulse 3s ease-in-out infinite;
    position: relative;
    z-index: 2;
  }

  @keyframes iconPulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.05); }
  }

  .category-title {
    font-size: 3.5rem;
    font-weight: 800;
    color: white;
    margin-bottom: 1rem;
    text-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
    position: relative;
    z-index: 2;
  }

  .category-description {
    font-size: 1.3rem;
    color: rgba(255, 255, 255, 0.9);
    max-width: 700px;
    margin: 0 auto 2.5rem;
    line-height: 1.7;
    position: relative;
    z-index: 2;
  }

  .category-stats {
    display: flex;
    justify-content: center;
    gap: 2.5rem;
    flex-wrap: wrap;
    position: relative;
    z-index: 2;
  }

  .stat-badge {
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(15px);
    padding: 1.2rem 2.5rem;
    border-radius: 30px;
    border: 2px solid rgba(255, 255, 255, 0.3);
    color: white;
    font-weight: 700;
    font-size: 1.1rem;
    transition: all 0.4s ease;
    display: flex;
    align-items: center;
    gap: 0.8rem;
  }

  .stat-badge:hover {
    background: rgba(255, 255, 255, 0.25);
    transform: translateY(-3px);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
  }

  .category-content {
    padding: 3rem 2rem;
  }

  .posts-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(400px, 1fr));
    gap: 2.5rem;
    opacity: 0;
    animation: fadeInUp 0.8s ease-out forwards;
    animation-delay: 0.3s;
  }

  .post-card {
    background: linear-gradient(145deg, rgba(255, 255, 255, 0.12), rgba(255, 255, 255, 0.06));
    backdrop-filter: blur(25px);
    border: 1px solid rgba(255, 255, 255, 0.25);
    border-radius: 24px;
    overflow: hidden;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    height: 100%;
    display: flex;
    flex-direction: column;
  }

  .post-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 5px;
    background: var(--secondary-gradient);
    transform: scaleX(0);
    transition: transform 0.4s ease;
  }

  .post-card:hover::before {
    transform: scaleX(1);
  }

  .post-card:hover {
    transform: translateY(-12px) scale(1.02);
    box-shadow: 0 40px 70px -15px rgba(0, 0, 0, 0.4);
    background: linear-gradient(145deg, rgba(255, 255, 255, 0.18), rgba(255, 255, 255, 0.12));
  }

  .post-header {
    padding: 2.5rem 2.5rem 1.5rem;
  }

  .post-title {
    color: white;
    font-weight: 700;
    font-size: 1.4rem;
    line-height: 1.3;
    margin: 0 0 1.2rem 0;
  }

  .post-title a {
    color: inherit;
    text-decoration: none;
    background: linear-gradient(45deg, #fff, #e2e8f0);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    transition: all 0.3s ease;
  }

  .post-card:hover .post-title a {
    background: var(--secondary-gradient);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
  }

  .post-meta {
    color: rgba(255, 255, 255, 0.75);
    font-size: 0.9rem;
    display: flex;
    align-items: center;
    gap: 0.7rem;
  }

  .post-body {
    padding: 0 2.5rem;
    flex-grow: 1;
  }

  .code-preview {
    background: rgba(0, 0, 0, 0.4);
    border-radius: 16px;
    overflow: hidden;
    margin: 1.5rem 0;
    border: 1px solid rgba(255, 255, 255, 0.15);
    position: relative;
  }

  .code-preview::before {
    content: 'PHP';
    position: absolute;
    top: 12px;
    right: 16px;
    background: var(--secondary-gradient);
    color: white;
    padding: 0.3rem 0.8rem;
    border-radius: 8px;
    font-size: 0.75rem;
    font-weight: 600;
    z-index: 3;
  }

  .code-preview pre {
    margin: 0 !important;
    padding: 2rem !important;
    background: transparent !important;
    border-radius: 16px;
    font-size: 0.85rem;
    line-height: 1.7;
  }

  .post-excerpt {
    color: rgba(255, 255, 255, 0.85);
    line-height: 1.7;
    font-size: 1rem;
  }

  .post-footer {
    padding: 1.5rem 2.5rem 2.5rem;
    margin-top: auto;
  }

  .read-more-btn {
    background: var(--secondary-gradient);
    color: white;
    border: none;
    padding: 1rem 2.5rem;
    border-radius: 30px;
    font-weight: 700;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.8rem;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    font-size: 0.95rem;
  }

  .read-more-btn::after {
    content: '→';
    transition: transform 0.3s ease;
  }

  .read-more-btn:hover {
    transform: translateX(8px);
    box-shadow: 0 15px 35px rgba(245, 87, 108, 0.4);
    color: white;
    text-decoration: none;
  }

  .read-more-btn:hover::after {
    transform: translateX(5px);
  }

  .modern-pagination {
    display: flex;
    justify-content: center;
    gap: 1.2rem;
    margin-top: 4rem;
    flex-wrap: wrap;
  }

  .modern-pagination a, 
  .modern-pagination span {
    background: rgba(255, 255, 255, 0.12);
    color: rgba(255, 255, 255, 0.85);
    padding: 1rem 2rem;
    border-radius: 16px;
    text-decoration: none;
    border: 1px solid rgba(255, 255, 255, 0.25);
    transition: all 0.3s ease;
    font-weight: 600;
  }

  .modern-pagination a:hover {
    background: var(--secondary-gradient);
    color: white;
    transform: translateY(-3px);
    box-shadow: 0 12px 30px rgba(0, 0, 0, 0.25);
  }

  .modern-pagination .current {
    background: var(--secondary-gradient);
    color: white;
  }

  .no-posts {
    text-align: center;
    padding: 5rem 2rem;
    color: rgba(255, 255, 255, 0.8);
  }

  .no-posts-icon {
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    width: 140px;
    height: 140px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 2rem;
    border: 2px solid rgba(255, 255, 255, 0.2);
  }

  /* Breadcrumb styling */
  .modern-breadcrumb {
    background: rgba(255, 255, 255, 0.08);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    border: 1px solid rgba(255, 255, 255, 0.15);
    padding: 1.5rem 2rem;
    margin: 0 2rem 0;
  }

  /* レスポンシブ */
  @media (max-width: 768px) {
    .modern-category-container {
      margin: 1rem;
      border-radius: 16px;
    }

    .category-hero {
      padding: 3rem 1.5rem;
    }

    .category-title {
      font-size: 2.5rem;
    }

    .category-stats {
      gap: 1.5rem;
    }

    .posts-grid {
      grid-template-columns: 1fr;
      gap: 2rem;
    }

    .category-content {
      padding: 2rem 1.5rem;
    }

    .post-header,
    .post-body,
    .post-footer {
      padding-left: 2rem;
      padding-right: 2rem;
    }
  }

  @media (max-width: 480px) {
    .stat-badge {
      padding: 1rem 1.5rem;
      font-size: 1rem;
    }

    .category-title {
      font-size: 2rem;
    }

    .category-description {
      font-size: 1.1rem;
    }
  }
</style>

<!-- JSON-LD Structured Data -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "CollectionPage",
  "name": "<?php echo esc_js($term->name); ?> Collection",
  "description": "<?php echo esc_js($term->description ?: sprintf(__('%s category archive', 'copipe-theme'), $term->name)); ?>",
  "url": "<?php echo esc_url(get_category_link($term->term_id)); ?>",
  "mainEntity": {
    "@type": "ItemList",
    "numberOfItems": "<?php echo $wp_query->found_posts; ?>"
  }
}
</script>

<?php if (function_exists('get_template_part')) : ?>
  <div class="modern-breadcrumb">
    <?php get_template_part('breadcrumb'); ?>
  </div>
<?php endif; ?>

<div class="modern-category-container">
  
  <!-- Category Hero Section -->
  <header class="category-hero">
    
    <!-- Category Icon -->
    <div class="category-icon">
      <svg width="64" height="64" viewBox="0 0 24 24" fill="white">
        <path d="M10 3H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1zM9 9H5V5h4v4zm11-6h-6a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1zm-1 6h-4V5h4v4zm-9 4H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-6a1 1 0 0 0-1-1zm-1 6H5v-4h4v4zm11-6h-6a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-6a1 1 0 0 0-1-1zm-1 6h-4v-4h4v4z"/>
      </svg>
    </div>
    
    <h1 class="category-title"><?php single_cat_title(); ?></h1>
    
    <?php if ($term->description) : ?>
      <div class="category-description"><?php echo $term->description; ?></div>
    <?php else : ?>
      <div class="category-description">
        <?php printf(__('Explore our collection of %s articles and code snippets', 'copipe-theme'), strtolower($term->name)); ?>
      </div>
    <?php endif; ?>
    
    <!-- Category Statistics -->
    <div class="category-stats">
      <div class="stat-badge">
        <span>📄</span>
        <?php printf(_n('%d Article', '%d Articles', $wp_query->found_posts, 'copipe-theme'), number_format_i18n($wp_query->found_posts)); ?>
      </div>
      
      <?php
      $recent_post = get_posts([
          'category' => $term->term_id,
          'posts_per_page' => 1
      ]);
      
      if (!empty($recent_post)) :
      ?>
        <div class="stat-badge">
          <span>🕒</span>
          <?php printf(__('Latest: %s', 'copipe-theme'), get_the_date('M j', $recent_post[0])); ?>
        </div>
      <?php endif; ?>
      
      <div class="stat-badge">
        <span>🔥</span>
        <?php _e('Fresh Content', 'copipe-theme'); ?>
      </div>
    </div>
  </header>
  
  <!-- Category Content -->
  <div class="category-content">
    <?php if (have_posts()) : ?>
      
      <!-- Posts Grid -->
      <div class="posts-grid">
        <?php while (have_posts()) : the_post(); ?>
          <article <?php post_class('post-card'); ?>>
            
            <!-- Post Header -->
            <div class="post-header">
              <h2 class="post-title">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
              </h2>
              <div class="post-meta">
                <span>📅</span>
                <?php echo get_the_date(); ?>
                <?php if (get_comments_number() > 0) : ?>
                  <span>•</span>
                  <span>💬</span>
                  <?php echo get_comments_number(); ?>
                <?php endif; ?>
              </div>
            </div>
            
            <!-- Post Body -->
            <div class="post-body">
              <?php
              $raw = get_post_field('post_content', get_the_ID());

              // Extract first PHP code block
              if (preg_match('/```php\s*(.*?)\s*```/s', $raw, $m)) {
                  $code = esc_html(trim($m[1]));
                  $lines = explode("\n", $code);
                  if (count($lines) > 10) {
                      $code = implode("\n", array_slice($lines, 0, 10)) . "\n// ...";
                  }
                  
                  echo '<div class="code-preview"><pre class="language-php line-numbers" data-line="2-3"><code class="language-php">' . $code . '</code></pre></div>';
              } else {
                  echo '<div class="post-excerpt"><p>' . wp_trim_words(strip_tags($raw), 50, '…') . '</p></div>';
              }
              ?>
            </div>
            
            <!-- Post Footer -->
            <div class="post-footer">
              <a href="<?php the_permalink(); ?>" class="read-more-btn">
                <?php esc_html_e('Read Full Article', 'copipe-theme'); ?>
              </a>
            </div>
            
          </article>
        <?php endwhile; ?>
      </div>
      
      <!-- Pagination -->
      <div class="modern-pagination">
        <?php
        echo paginate_links([
          'mid_size'   => 2,
          'prev_text'  => '← ' . __('Previous', 'copipe-theme'),
          'next_text'  => __('Next', 'copipe-theme') . ' →',
          'type' => 'array'
        ]);
        ?>
      </div>
      
    <?php else : ?>
      
      <!-- No Posts Found -->
      <div class="no-posts">
        <div class="no-posts-icon">
          <svg width="70" height="70" viewBox="0 0 24 24" fill="rgba(255, 255, 255, 0.5)">
            <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z"/>
          </svg>
        </div>
        
        <h2 style="color: white; font-size: 2rem; margin-bottom: 1rem;">
          <?php _e('No articles yet', 'copipe-theme'); ?>
        </h2>
        <p style="font-size: 1.1rem; margin-bottom: 2rem;">
          <?php printf(__('We haven\'t published any articles in the %s category yet. Check back soon!', 'copipe-theme'), $term->name); ?>
        </p>
        
        <a href="<?php echo esc_url(home_url('/')); ?>" 
           class="read-more-btn">
          <?php _e('Explore All Categories', 'copipe-theme'); ?>
        </a>
      </div>
      
    <?php endif; ?>
  </div>
</div>

<script>
// Animate cards on scroll
document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.post-card');
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
                setTimeout(() => {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }, index * 150);
            }
        });
    });
    
    cards.forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(60px)';
        card.style.transition = 'all 0.8s cubic-bezier(0.4, 0, 0.2, 1)';
        observer.observe(card);
    });
    
    // Parallax effect for hero
    window.addEventListener('scroll', () => {
        const scrolled = window.pageYOffset;
        const hero = document.querySelector('.category-hero');
        if (hero) {
            hero.style.transform = `translateY(${scrolled * 0.5}px)`;
        }
    });
});
</script>

<?php get_footer(); ?>