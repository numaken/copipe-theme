<?php
/**
 * Modern Archive Page Template
 * 
 * @package Modern_Copipe_Theme
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

$archive_obj = get_queried_object();
$archive_title = get_the_archive_title();
$archive_description = get_the_archive_description();
?>

<style>
  /* Modern Archive Styles */
  .modern-archive-container {
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(10px);
    border-radius: 24px;
    border: 1px solid rgba(255, 255, 255, 0.1);
    margin: 2rem;
    overflow: hidden;
    box-shadow: var(--shadow-elevation);
  }

  .modern-archive-hero {
    background: var(--primary-gradient);
    padding: 4rem 2rem;
    text-align: center;
    position: relative;
    overflow: hidden;
  }

  .modern-archive-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.1'%3E%3Ccircle cx='30' cy='30' r='4'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E") repeat;
    opacity: 0.3;
  }

  .archive-hero-content {
    position: relative;
    z-index: 2;
  }

  .archive-icon {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(20px);
    border-radius: 50%;
    width: 100px;
    height: 100px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 2rem;
    border: 1px solid rgba(255, 255, 255, 0.2);
    animation: iconFloat 3s ease-in-out infinite;
  }

  @keyframes iconFloat {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
  }

  .archive-title {
    font-size: 3rem;
    font-weight: 800;
    color: white;
    margin-bottom: 1rem;
    text-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
  }

  .archive-description {
    font-size: 1.2rem;
    color: rgba(255, 255, 255, 0.9);
    max-width: 600px;
    margin: 0 auto 2rem;
    line-height: 1.6;
  }

  .archive-stats {
    display: flex;
    justify-content: center;
    gap: 2rem;
    flex-wrap: wrap;
  }

  .stat-item {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    padding: 1rem 2rem;
    border-radius: 25px;
    border: 1px solid rgba(255, 255, 255, 0.2);
    color: white;
    font-weight: 600;
    transition: all 0.3s ease;
  }

  .stat-item:hover {
    background: rgba(255, 255, 255, 0.2);
    transform: translateY(-2px);
  }

  .modern-filters {
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(10px);
    padding: 2rem;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
  }

  .filter-search {
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 25px;
    padding: 1rem 2rem;
    color: white;
    font-size: 1rem;
    transition: all 0.3s ease;
    width: 100%;
    max-width: 400px;
  }

  .filter-search::placeholder {
    color: rgba(255, 255, 255, 0.6);
  }

  .filter-search:focus {
    outline: none;
    background: rgba(255, 255, 255, 0.15);
    border-color: rgba(255, 255, 255, 0.4);
    box-shadow: 0 0 20px rgba(255, 255, 255, 0.1);
  }

  .filter-select {
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 12px;
    padding: 0.75rem 1.5rem;
    color: white;
    font-size: 0.9rem;
    transition: all 0.3s ease;
    cursor: pointer;
  }

  .filter-select:focus {
    outline: none;
    background: rgba(255, 255, 255, 0.15);
    border-color: rgba(255, 255, 255, 0.4);
  }

  .archive-content {
    padding: 3rem 2rem;
  }

  .archive-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 2rem;
    opacity: 0;
    animation: fadeInUp 0.8s ease-out forwards;
    animation-delay: 0.3s;
  }

  .archive-card {
    background: linear-gradient(145deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.05));
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 20px;
    overflow: hidden;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    height: 100%;
    display: flex;
    flex-direction: column;
  }

  .archive-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: var(--secondary-gradient);
    transform: scaleX(0);
    transition: transform 0.3s ease;
  }

  .archive-card:hover::before {
    transform: scaleX(1);
  }

  .archive-card:hover {
    transform: translateY(-10px) scale(1.02);
    box-shadow: 0 35px 60px -12px rgba(0, 0, 0, 0.3);
    background: linear-gradient(145deg, rgba(255, 255, 255, 0.15), rgba(255, 255, 255, 0.1));
  }

  .card-header {
    padding: 2rem 2rem 1rem;
  }

  .card-title {
    color: white;
    font-weight: 700;
    font-size: 1.3rem;
    line-height: 1.3;
    margin: 0 0 1rem 0;
  }

  .card-title a {
    color: inherit;
    text-decoration: none;
    background: linear-gradient(45deg, #fff, #e2e8f0);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    transition: all 0.3s ease;
  }

  .archive-card:hover .card-title a {
    background: var(--secondary-gradient);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
  }

  .card-meta {
    color: rgba(255, 255, 255, 0.7);
    font-size: 0.875rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
  }

  .card-body {
    padding: 0 2rem;
    flex-grow: 1;
  }

  .card-code {
    background: rgba(0, 0, 0, 0.3);
    border-radius: 12px;
    overflow: hidden;
    margin: 1rem 0;
    border: 1px solid rgba(255, 255, 255, 0.1);
  }

  .card-code pre {
    margin: 0 !important;
    padding: 1.5rem !important;
    background: transparent !important;
    border-radius: 12px;
    font-size: 0.875rem;
    line-height: 1.6;
  }

  .card-excerpt {
    color: rgba(255, 255, 255, 0.8);
    line-height: 1.6;
    font-size: 0.95rem;
  }

  .card-footer {
    padding: 1rem 2rem 2rem;
    margin-top: auto;
  }

  .card-button {
    background: var(--secondary-gradient);
    color: white;
    border: none;
    padding: 0.75rem 2rem;
    border-radius: 25px;
    font-weight: 600;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  }

  .card-button:hover {
    transform: translateX(5px);
    box-shadow: 0 10px 25px rgba(245, 87, 108, 0.4);
    color: white;
    text-decoration: none;
  }

  .modern-pagination {
    display: flex;
    justify-content: center;
    gap: 1rem;
    margin-top: 4rem;
    flex-wrap: wrap;
  }

  .modern-pagination a, 
  .modern-pagination span {
    background: rgba(255, 255, 255, 0.1);
    color: rgba(255, 255, 255, 0.8);
    padding: 0.75rem 1.5rem;
    border-radius: 12px;
    text-decoration: none;
    border: 1px solid rgba(255, 255, 255, 0.2);
    transition: all 0.3s ease;
  }

  .modern-pagination a:hover {
    background: var(--secondary-gradient);
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
  }

  .modern-pagination .current {
    background: var(--secondary-gradient);
    color: white;
  }

  .no-posts {
    text-align: center;
    padding: 4rem 2rem;
    color: rgba(255, 255, 255, 0.8);
  }

  .no-posts-icon {
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    width: 120px;
    height: 120px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 2rem;
    border: 1px solid rgba(255, 255, 255, 0.2);
  }

  .modern-sidebar {
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    border: 1px solid rgba(255, 255, 255, 0.1);
    padding: 3rem 2rem;
    margin-top: 4rem;
  }

  .sidebar-section {
    margin-bottom: 3rem;
  }

  .sidebar-title {
    color: white;
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 1.5rem;
    background: var(--secondary-gradient);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
  }

  .tag-cloud a {
    background: rgba(255, 255, 255, 0.1);
    color: rgba(255, 255, 255, 0.8);
    padding: 0.5rem 1rem;
    border-radius: 20px;
    text-decoration: none;
    display: inline-block;
    margin: 0.25rem;
    transition: all 0.3s ease;
    border: 1px solid rgba(255, 255, 255, 0.2);
  }

  .tag-cloud a:hover {
    background: var(--secondary-gradient);
    color: white;
    transform: translateY(-2px);
  }

  .sidebar-list {
    list-style: none;
    padding: 0;
    margin: 0;
  }

  .sidebar-list li {
    padding: 1rem 0;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
  }

  .sidebar-list li:last-child {
    border-bottom: none;
  }

  .sidebar-list a {
    color: rgba(255, 255, 255, 0.8);
    text-decoration: none;
    transition: color 0.3s ease;
  }

  .sidebar-list a:hover {
    color: white;
  }

  /* レスポンシブ */
  @media (max-width: 768px) {
    .modern-archive-container {
      margin: 1rem;
      border-radius: 16px;
    }

    .modern-archive-hero {
      padding: 3rem 1.5rem;
    }

    .archive-title {
      font-size: 2rem;
    }

    .archive-stats {
      gap: 1rem;
    }

    .archive-grid {
      grid-template-columns: 1fr;
      gap: 1.5rem;
    }

    .modern-filters {
      padding: 1.5rem;
    }

    .archive-content {
      padding: 2rem 1.5rem;
    }
  }
</style>

<!-- JSON-LD Structured Data -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "CollectionPage",
  "name": "<?php echo esc_js($archive_title); ?>",
  "description": "<?php echo esc_js($archive_description ?: sprintf(__('%s のアーカイブ', 'copipe-theme'), $archive_title)); ?>",
  "url": "<?php echo esc_url(get_permalink()); ?>",
  "mainEntity": {
    "@type": "ItemList",
    "numberOfItems": "<?php echo $wp_query->found_posts; ?>"
  }
}
</script>

<div class="modern-archive-container">
  
  <!-- Archive Hero Section -->
  <header class="modern-archive-hero">
    <div class="archive-hero-content">
      
      <!-- Archive Icon -->
      <div class="archive-icon">
        <?php if (is_category()) : ?>
          <svg width="48" height="48" viewBox="0 0 24 24" fill="white">
            <path d="M10 3H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1zM9 9H5V5h4v4zm11-6h-6a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1zm-1 6h-4V5h4v4zm-9 4H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-6a1 1 0 0 0-1-1zm-1 6H5v-4h4v4zm11-6h-6a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-6a1 1 0 0 0-1-1zm-1 6h-4v-4h4v4z"/>
          </svg>
        <?php elseif (is_tag()) : ?>
          <svg width="48" height="48" viewBox="0 0 24 24" fill="white">
            <path d="M21.41 11.58l-9-9C12.05 2.22 11.55 2 11 2H4c-1.1 0-2 .9-2 2v7c0 .55.22 1.05.59 1.42l9 9c.36.36.86.58 1.41.58.55 0 1.05-.22 1.41-.59l7-7c.37-.36.59-.86.59-1.41 0-.55-.23-1.06-.59-1.42zM5.5 7C4.67 7 4 6.33 4 5.5S4.67 4 5.5 4 7 4.67 7 5.5 6.33 7 5.5 7z"/>
          </svg>
        <?php elseif (is_date()) : ?>
          <svg width="48" height="48" viewBox="0 0 24 24" fill="white">
            <path d="M9 11H7v2h2v-2zm4 0h-2v2h2v-2zm4 0h-2v2h2v-2zm2-7h-1V2h-2v2H8V2H6v2H5c-1.1 0-1.99.9-1.99 2L3 20c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V9h14v11z"/>
          </svg>
        <?php elseif (is_author()) : ?>
          <svg width="48" height="48" viewBox="0 0 24 24" fill="white">
            <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
          </svg>
        <?php else : ?>
          <svg width="48" height="48" viewBox="0 0 24 24" fill="white">
            <path d="M10 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.89 2 2 2h16c1.1 0 2-.9 2-2V8c0-1.1-.9-2-2-2h-8l-2-2z"/>
          </svg>
        <?php endif; ?>
      </div>
      
      <h1 class="archive-title"><?php echo esc_html($archive_title); ?></h1>
      
      <?php if ($archive_description) : ?>
        <div class="archive-description"><?php echo $archive_description; ?></div>
      <?php endif; ?>
      
      <!-- Archive Statistics -->
      <div class="archive-stats">
        <div class="stat-item">
          📄 <?php printf(_n('%d Article', '%d Articles', $wp_query->found_posts, 'copipe-theme'), number_format_i18n($wp_query->found_posts)); ?>
        </div>
        
        <?php if (is_category() || is_tag()) : ?>
          <?php
          $recent_post = get_posts([
              'posts_per_page' => 1,
              'tax_query' => [
                  [
                      'taxonomy' => $archive_obj->taxonomy,
                      'field' => 'term_id',
                      'terms' => $archive_obj->term_id
                  ]
              ]
          ]);
          
          if (!empty($recent_post)) :
          ?>
            <div class="stat-item">
              🕒 <?php printf(__('Latest: %s', 'copipe-theme'), get_the_date('M j', $recent_post[0])); ?>
            </div>
          <?php endif; ?>
        <?php endif; ?>
      </div>
    </div>
  </header>
  
  <!-- Filters -->
  <?php if ($wp_query->found_posts > 5) : ?>
    <div class="modern-filters">
      <div class="uk-grid-small uk-flex-between uk-flex-middle" uk-grid>
        <div class="uk-width-expand@s">
          <!-- Archive Search -->
          <form method="get">
            <input class="filter-search" 
                   type="search" 
                   name="s" 
                   value="<?php echo esc_attr(get_search_query()); ?>"
                   placeholder="<?php _e('Search in this archive...', 'copipe-theme'); ?>"
                   aria-label="<?php _e('Archive search', 'copipe-theme'); ?>">
            
            <!-- Preserve archive parameters -->
            <?php if (is_category()) : ?>
                <input type="hidden" name="cat" value="<?php echo $archive_obj->term_id; ?>">
            <?php elseif (is_tag()) : ?>
                <input type="hidden" name="tag" value="<?php echo $archive_obj->slug; ?>">
            <?php elseif (is_author()) : ?>
                <input type="hidden" name="author" value="<?php echo get_query_var('author'); ?>">
            <?php endif; ?>
          </form>
        </div>
        
        <div class="uk-width-auto">
          <!-- Sort Options -->
          <select class="filter-select" 
                  onchange="copipeArchiveSort(this.value)"
                  aria-label="<?php _e('Sort order', 'copipe-theme'); ?>">
            <?php
            $current_order = get_query_var('orderby', 'date');
            $sort_options = [
                'date' => __('Latest First', 'copipe-theme'),
                'title' => __('Title A-Z', 'copipe-theme'),
                'comment_count' => __('Most Commented', 'copipe-theme'),
                'modified' => __('Recently Updated', 'copipe-theme')
            ];
            
            foreach ($sort_options as $value => $label) :
            ?>
                <option value="<?php echo esc_attr($value); ?>" <?php selected($current_order, $value); ?>>
                    <?php echo esc_html($label); ?>
                </option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>
    </div>
  <?php endif; ?>
  
  <!-- Archive Content -->
  <div class="archive-content">
    <?php if (have_posts()) : ?>
      
      <!-- Search Results Notice -->
      <?php if (is_search() && get_query_var('s')) : ?>
        <div class="uk-alert-primary uk-margin-medium-bottom" uk-alert>
          <p>
            <?php
            printf(
                __('Search results for "%1$s" in %2$s: %3$d found', 'copipe-theme'),
                esc_html(get_query_var('s')),
                esc_html($archive_title),
                $wp_query->found_posts
            );
            ?>
          </p>
        </div>
      <?php endif; ?>
      
      <!-- Posts Grid -->
      <div class="archive-grid">
        <?php while (have_posts()) : the_post(); ?>
          <article class="archive-card">
            
            <!-- Card Header -->
            <div class="card-header">
              <h2 class="card-title">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
              </h2>
              <div class="card-meta">
                📅 <?php echo get_the_date(); ?>
                <?php if (get_comments_number() > 0) : ?>
                  • 💬 <?php echo get_comments_number(); ?>
                <?php endif; ?>
              </div>
            </div>
            
            <!-- Card Body -->
            <div class="card-body">
              <?php
              $raw = get_post_field('post_content', get_the_ID());

              // Extract first PHP code block
              if (preg_match('/```php\s*(.*?)\s*```/s', $raw, $m)) {
                  $code = esc_html(trim($m[1]));
                  $lines = explode("\n", $code);
                  if (count($lines) > 8) {
                      $code = implode("\n", array_slice($lines, 0, 8)) . "\n// ...";
                  }
                  
                  echo '<div class="card-code"><pre class="language-php line-numbers"><code class="language-php">' . $code . '</code></pre></div>';
              } else {
                  echo '<div class="card-excerpt"><p>' . wp_trim_words(strip_tags($raw), 40, '…') . '</p></div>';
              }
              ?>
            </div>
            
            <!-- Card Footer -->
            <div class="card-footer">
              <a href="<?php the_permalink(); ?>" class="card-button">
                <?php esc_html_e('Read More', 'copipe-theme'); ?>
                <span>→</span>
              </a>
            </div>
            
          </article>
        <?php endwhile; ?>
      </div>
      
      <!-- Pagination -->
      <div class="modern-pagination">
        <?php
        $big = 999999999;
        $pagination_args = [
            'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
            'format' => '?paged=%#%',
            'current' => max(1, get_query_var('paged')),
            'total' => $wp_query->max_num_pages,
            'mid_size' => 2,
            'prev_text' => '← ' . __('Previous', 'copipe-theme'),
            'next_text' => __('Next', 'copipe-theme') . ' →',
            'type' => 'array'
        ];
        
        if (get_query_var('s')) {
            $pagination_args['add_args'] = ['s' => get_query_var('s')];
        }
        
        $pagination = paginate_links($pagination_args);

        if ($pagination) {
            foreach ($pagination as $page) {
                echo $page;
            }
        }
        ?>
      </div>
      
    <?php else : ?>
      
      <!-- No Posts Found -->
      <div class="no-posts">
        <div class="no-posts-icon">
          <svg width="60" height="60" viewBox="0 0 24 24" fill="rgba(255, 255, 255, 0.5)">
            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
          </svg>
        </div>
        
        <?php if (is_search()) : ?>
          <h2><?php _e('No search results found', 'copipe-theme'); ?></h2>
          <p><?php printf(__('No articles match "%s" in this archive.', 'copipe-theme'), esc_html(get_search_query())); ?></p>
        <?php else : ?>
          <h2><?php _e('No articles yet', 'copipe-theme'); ?></h2>
          <p><?php _e('This archive doesn\'t have any articles posted yet.', 'copipe-theme'); ?></p>
        <?php endif; ?>
        
        <div style="margin-top: 2rem;">
          <a href="<?php echo esc_url(home_url('/')); ?>" 
             class="card-button">
            <?php _e('Back to Home', 'copipe-theme'); ?>
          </a>
          
          <?php if (is_search()) : ?>
            <a href="<?php echo esc_url(remove_query_arg('s')); ?>" 
               class="card-button" style="margin-left: 1rem;">
              <?php _e('View All Articles', 'copipe-theme'); ?>
            </a>
          <?php endif; ?>
        </div>
      </div>
      
    <?php endif; ?>
  </div>
  
  <!-- Archive Sidebar -->
  <?php if (copipe_get_option('show_archive_sidebar', true)) : ?>
    <aside class="modern-sidebar">
      <div class="uk-grid-medium" uk-grid>
        
        <!-- Popular Tags -->
        <div class="uk-width-1-2@m sidebar-section">
          <h3 class="sidebar-title">🔥 Popular Tags</h3>
          <?php
          $popular_tags = get_tags([
              'orderby' => 'count',
              'order' => 'DESC',
              'number' => 12,
              'hide_empty' => true
          ]);
          
          if (!empty($popular_tags)) :
          ?>
            <div class="tag-cloud">
              <?php foreach ($popular_tags as $tag) : ?>
                <a href="<?php echo esc_url(get_tag_link($tag)); ?>" 
                   title="<?php echo esc_attr($tag->name); ?> (<?php echo $tag->count; ?>)">
                  #<?php echo esc_html($tag->name); ?>
                </a>
              <?php endforeach; ?>
            </div>
          <?php else : ?>
            <p style="color: rgba(255, 255, 255, 0.6);"><?php _e('No tags available.', 'copipe-theme'); ?></p>
          <?php endif; ?>
        </div>
        
        <!-- Recent Comments -->
        <div class="uk-width-1-2@m sidebar-section">
          <h3 class="sidebar-title">💬 Recent Comments</h3>
          <?php
          $recent_comments = get_comments([
              'number' => 5,
              'status' => 'approve'
          ]);
          
          if (!empty($recent_comments)) :
          ?>
            <ul class="sidebar-list">
              <?php foreach ($recent_comments as $comment) : ?>
                <li>
                  <strong><?php echo esc_html($comment->comment_author); ?></strong>
                  <span style="color: rgba(255, 255, 255, 0.6);">on</span>
                  <a href="<?php echo esc_url(get_permalink($comment->comment_post_ID)); ?>#comment-<?php echo $comment->comment_ID; ?>">
                    <?php echo esc_html(get_the_title($comment->comment_post_ID)); ?>
                  </a>
                </li>
              <?php endforeach; ?>
            </ul>
          <?php else : ?>
            <p style="color: rgba(255, 255, 255, 0.6);"><?php _e('No comments yet.', 'copipe-theme'); ?></p>
          <?php endif; ?>
        </div>
      </div>
    </aside>
  <?php endif; ?>
</div>

<script>
// Archive sort functionality
function copipeArchiveSort(orderby) {
    const url = new URL(window.location);
    url.searchParams.set('orderby', orderby);
    window.location.href = url.toString();
}

// Animate cards on scroll
document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.archive-card');
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
                setTimeout(() => {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }, index * 100);
            }
        });
    });
    
    cards.forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(50px)';
        card.style.transition = 'all 0.6s ease';
        observer.observe(card);
    });
});
</script>

<?php
get_footer();

// Custom archive title filter
function copipe_custom_archive_title($title) {
    if (is_category()) {
        $title = single_cat_title('', false);
    } elseif (is_tag()) {
        $title = single_tag_title('', false);
    } elseif (is_author()) {
        $title = get_the_author();
    } elseif (is_year()) {
        $title = get_the_date('Y');
    } elseif (is_month()) {
        $title = get_the_date('F Y');
    } elseif (is_day()) {
        $title = get_the_date('F j, Y');
    }
    
    return $title;
}
add_filter('get_the_archive_title', 'copipe_custom_archive_title');
?>