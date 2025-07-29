<?php
/**
 * Modern Single Post Template
 * 
 * @package Modern_Copipe_Theme
 */

get_header();
?>

<style>
  /* Modern Single Post Styles */
  .modern-single-container {
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(10px);
    border-radius: 24px;
    border: 1px solid rgba(255, 255, 255, 0.1);
    margin: 2rem;
    overflow: hidden;
    box-shadow: var(--shadow-elevation);
  }

  .single-hero {
    background: var(--primary-gradient);
    padding: 4rem 2rem 3rem;
    text-align: center;
    position: relative;
    overflow: hidden;
  }

  .single-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.08'%3E%3Cpath d='M0 0h100v100H0V0zm10 10v80h80V10H10zm10 10v60h60V20H20zm10 10v40h40V30H30zm10 10v20h20V40H40z' /%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    opacity: 0.3;
  }

  .single-hero-content {
    position: relative;
    z-index: 2;
    max-width: 900px;
    margin: 0 auto;
  }

  .post-category {
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(10px);
    color: white;
    padding: 0.7rem 1.8rem;
    border-radius: 25px;
    font-weight: 600;
    text-decoration: none;
    display: inline-block;
    margin-bottom: 2rem;
    border: 1px solid rgba(255, 255, 255, 0.3);
    transition: all 0.3s ease;
    font-size: 0.9rem;
  }

  .post-category:hover {
    background: rgba(255, 255, 255, 0.25);
    transform: translateY(-2px);
    color: white;
    text-decoration: none;
  }

  .single-title {
    font-size: 3.5rem;
    font-weight: 800;
    color: white;
    margin-bottom: 2rem;
    text-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
    line-height: 1.2;
  }

  .single-meta {
    display: flex;
    justify-content: center;
    gap: 3rem;
    flex-wrap: wrap;
    margin-bottom: 2rem;
  }

  .meta-item {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    padding: 1rem 2rem;
    border-radius: 20px;
    border: 1px solid rgba(255, 255, 255, 0.2);
    color: white;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 0.7rem;
    transition: all 0.3s ease;
  }

  .meta-item:hover {
    background: rgba(255, 255, 255, 0.2);
    transform: translateY(-2px);
  }

  .reading-progress {
    background: rgba(255, 255, 255, 0.2);
    height: 6px;
    border-radius: 3px;
    overflow: hidden;
    position: relative;
  }

  .reading-progress-bar {
    height: 100%;
    background: var(--secondary-gradient);
    width: 0%;
    transition: width 0.3s ease;
    border-radius: 3px;
  }

  .single-content {
    padding: 4rem 3rem;
    max-width: 900px;
    margin: 0 auto;
  }

  .breadcrumb-modern {
    background: rgba(255, 255, 255, 0.08);
    backdrop-filter: blur(10px);
    border-radius: 16px;
    border: 1px solid rgba(255, 255, 255, 0.15);
    padding: 1.2rem 2rem;
    margin-bottom: 2rem;
  }

  .content-wrapper {
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(15px);
    border-radius: 20px;
    border: 1px solid rgba(255, 255, 255, 0.1);
    padding: 3rem;
    margin-bottom: 3rem;
    line-height: 1.8;
    font-size: 1.1rem;
    color: rgba(255, 255, 255, 0.9);
  }

  .content-wrapper h2,
  .content-wrapper h3,
  .content-wrapper h4 {
    color: white;
    margin-top: 3rem;
    margin-bottom: 1.5rem;
    font-weight: 700;
  }

  .content-wrapper h2 {
    font-size: 2rem;
    background: var(--secondary-gradient);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
  }

  .content-wrapper p {
    margin-bottom: 1.5rem;
  }

  .content-wrapper pre {
    background: rgba(0, 0, 0, 0.4) !important;
    border-radius: 16px !important;
    border: 1px solid rgba(255, 255, 255, 0.15) !important;
    margin: 2rem 0 !important;
    position: relative;
    overflow: hidden;
  }

  .content-wrapper pre::before {
    content: 'Code';
    position: absolute;
    top: 12px;
    right: 16px;
    background: var(--secondary-gradient);
    color: white;
    padding: 0.4rem 1rem;
    border-radius: 8px;
    font-size: 0.75rem;
    font-weight: 700;
    z-index: 3;
  }

  .content-wrapper pre code {
    padding: 2.5rem !important;
    font-size: 0.9rem !important;
    line-height: 1.7 !important;
  }

  .content-wrapper blockquote {
    background: rgba(255, 255, 255, 0.1);
    border-left: 4px solid var(--secondary-gradient);
    border-radius: 12px;
    padding: 1.5rem 2rem;
    margin: 2rem 0;
    font-style: italic;
    position: relative;
  }

  .content-wrapper blockquote::before {
    content: '"';
    font-size: 4rem;
    color: var(--secondary-gradient);
    position: absolute;
    top: -10px;
    left: 15px;
    font-family: serif;
  }

  .content-wrapper ul,
  .content-wrapper ol {
    padding-left: 2rem;
    margin-bottom: 1.5rem;
  }

  .content-wrapper li {
    margin-bottom: 0.5rem;
  }

  .action-buttons {
    display: flex;
    justify-content: center;
    gap: 2rem;
    flex-wrap: wrap;
    margin-top: 3rem;
  }

  .action-btn {
    background: var(--secondary-gradient);
    color: white;
    border: none;
    padding: 1.2rem 3rem;
    border-radius: 30px;
    font-weight: 700;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 1rem;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    font-size: 1.1rem;
  }

  .action-btn.secondary {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
  }

  .action-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 35px rgba(245, 87, 108, 0.4);
    color: white;
    text-decoration: none;
  }

  .action-btn.secondary:hover {
    background: rgba(255, 255, 255, 0.2);
    box-shadow: 0 15px 35px rgba(255, 255, 255, 0.1);
  }

  .floating-share {
    position: fixed;
    left: 30px;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 25px;
    padding: 1rem;
    display: flex;
    flex-direction: column;
    gap: 1rem;
    z-index: 1000;
    opacity: 0;
    transition: all 0.3s ease;
  }

  .floating-share.visible {
    opacity: 1;
  }

  .share-btn {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    border: none;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    cursor: pointer;
    text-decoration: none;
  }

  .share-btn.twitter { background: #1da1f2; }
  .share-btn.threads { background: #000; }
  .share-btn.facebook { background: #1877f2; }
  .share-btn.copy { background: var(--secondary-gradient); }

  .share-btn:hover {
    transform: scale(1.1);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
  }

  .scroll-top {
    position: fixed;
    bottom: 30px;
    right: 30px;
    width: 60px;
    height: 60px;
    background: var(--secondary-gradient);
    border: none;
    border-radius: 50%;
    color: white;
    font-size: 1.5rem;
    cursor: pointer;
    transition: all 0.3s ease;
    z-index: 1000;
    opacity: 0;
    transform: translateY(20px);
  }

  .scroll-top.visible {
    opacity: 1;
    transform: translateY(0);
  }

  .scroll-top:hover {
    transform: scale(1.1);
    box-shadow: 0 10px 25px rgba(245, 87, 108, 0.4);
  }

  /* Table of Contents */
  .toc {
    background: rgba(255, 255, 255, 0.08);
    backdrop-filter: blur(15px);
    border-radius: 16px;
    border: 1px solid rgba(255, 255, 255, 0.15);
    padding: 2rem;
    margin: 2rem 0;
    position: sticky;
    top: 100px;
  }

  .toc h3 {
    color: white;
    font-size: 1.3rem;
    margin-bottom: 1rem;
    background: var(--secondary-gradient);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
  }

  .toc ul {
    list-style: none;
    padding: 0;
    margin: 0;
  }

  .toc li {
    margin-bottom: 0.5rem;
  }

  .toc a {
    color: rgba(255, 255, 255, 0.8);
    text-decoration: none;
    transition: color 0.3s ease;
  }

  .toc a:hover {
    color: white;
  }

  /* レスポンシブ */
  @media (max-width: 1200px) {
    .floating-share {
      display: none;
    }
  }

  @media (max-width: 768px) {
    .modern-single-container {
      margin: 1rem;
      border-radius: 16px;
    }

    .single-hero {
      padding: 3rem 1.5rem 2rem;
    }

    .single-title {
      font-size: 2.5rem;
    }

    .single-meta {
      gap: 1.5rem;
    }

    .single-content {
      padding: 3rem 2rem;
    }

    .content-wrapper {
      padding: 2rem;
    }

    .action-buttons {
      gap: 1rem;
    }

    .action-btn {
      padding: 1rem 2rem;
      font-size: 1rem;
    }

    .scroll-top {
      bottom: 20px;
      right: 20px;
      width: 50px;
      height: 50px;
    }
  }

  @media (max-width: 480px) {
    .single-title {
      font-size: 2rem;
    }

    .meta-item {
      padding: 0.8rem 1.5rem;
      font-size: 0.9rem;
    }

    .content-wrapper {
      font-size: 1rem;
    }
  }
</style>

<div class="modern-single-container">
  
  <!-- Single Post Hero -->
  <header class="single-hero">
    <div class="single-hero-content">
      
      <!-- Post Category -->
      <?php $categories = get_the_category(); ?>
      <?php if (!empty($categories)) : ?>
        <a href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>" 
           class="post-category">
          📁 <?php echo esc_html($categories[0]->name); ?>
        </a>
      <?php endif; ?>
      
      <!-- Post Title -->
      <h1 class="single-title"><?php the_title(); ?></h1>
      
      <!-- Post Meta -->
      <div class="single-meta">
        <div class="meta-item">
          <span>📅</span>
          <span><?php echo get_the_date('F j, Y'); ?></span>
        </div>
        
        <div class="meta-item">
          <span>👤</span>
          <span><?php the_author(); ?></span>
        </div>
        
        <?php if (get_comments_number() > 0) : ?>
          <div class="meta-item">
            <span>💬</span>
            <span><?php echo get_comments_number(); ?> Comments</span>
          </div>
        <?php endif; ?>
        
        <div class="meta-item">
          <span>⏱</span>
          <span><?php echo ceil(str_word_count(strip_tags(get_the_content())) / 200); ?> min read</span>
        </div>
      </div>
      
      <!-- Reading Progress -->
      <div class="reading-progress">
        <div class="reading-progress-bar" id="progressBar"></div>
      </div>
    </div>
  </header>
  
  <!-- Single Content -->
  <div class="single-content">
    
    <!-- Breadcrumb -->
    <?php if (function_exists('get_template_part')) : ?>
      <div class="breadcrumb-modern">
        <?php get_template_part('breadcrumb'); ?>
      </div>
    <?php endif; ?>
    
    <!-- Article Content -->
    <article <?php post_class(); ?>>
      <div class="content-wrapper">
        <?php
        // Display the content with proper formatting
        the_content();
        ?>
      </div>
      
      <!-- Action Buttons -->
      <div class="action-buttons">
        <a href="<?php echo esc_url(get_category_link(get_the_category()[0]->term_id ?? 2)); ?>" 
           class="action-btn secondary">
          ← Back to <?php echo get_the_category()[0]->name ?? 'Collection'; ?>
        </a>
        
        <button onclick="copyToClipboard()" class="action-btn">
          📋 Copy Code
        </button>
        
        <button onclick="sharePost()" class="action-btn secondary">
          🔗 Share Post
        </button>
      </div>
    </article>
  </div>
</div>

<!-- Floating Share Buttons -->
<div class="floating-share" id="floatingShare">
  <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" 
     target="_blank" class="share-btn twitter" title="Share on Twitter">
    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
      <path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"/>
    </svg>
  </a>

  <a href="https://www.threads.net/intent/post?text=<?php echo urlencode(get_the_title() . ' ' . get_permalink()); ?>" 
     target="_blank" class="share-btn threads" title="Share on Threads">
    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
      <path d="M15.3 8.9c-.3-.1-.6-.1-.9-.1-1.8 0-3.2 1.4-3.2 3.2 0 1.8 1.4 3.2 3.2 3.2 1.8 0 3.2-1.4 3.2-3.2v-.3c.8.5 1.7.8 2.6.8h.3c0 2.8-2.3 5.1-5.1 5.1s-5.1-2.3-5.1-5.1 2.3-5.1 5.1-5.1c.9 0 1.8.2 2.6.6v.9z"/>
      <circle cx="15.3" cy="8.9" r="1.1"/>
      <path d="M8.5 12c0-1.9 1.6-3.5 3.5-3.5s3.5 1.6 3.5 3.5-1.6 3.5-3.5 3.5-3.5-1.6-3.5-3.5zm2 0c0 .8.7 1.5 1.5 1.5s1.5-.7 1.5-1.5-.7-1.5-1.5-1.5-1.5.7-1.5 1.5z"/>
    </svg>
  </a>
  
  <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" 
     target="_blank" class="share-btn facebook" title="Share on Facebook">
    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
      <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
    </svg>
  </a>
  
  <button onclick="copyToClipboard()" class="share-btn copy" title="Copy Link">
    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
      <path d="M16 1H4c-1.1 0-2 .9-2 2v14h2V3h12V1zm3 4H8c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h11c1.1 0 2-.9 2-2V7c0-1.1-.9-2-2-2zm0 16H8V7h11v14z"/>
    </svg>
  </button>
</div>

<!-- Scroll to Top Button -->
<button class="scroll-top" id="scrollTop" onclick="scrollToTop()">
  ↑
</button>

<script>
// Reading progress
function updateProgressBar() {
    const contentHeight = document.querySelector('.content-wrapper').offsetHeight;
    const windowHeight = window.innerHeight;
    const scrollTop = window.pageYOffset;
    const docHeight = contentHeight - windowHeight;
    const scrollPercent = (scrollTop / docHeight) * 100;
    
    const progressBar = document.getElementById('progressBar');
    if (progressBar) {
        progressBar.style.width = Math.min(100, Math.max(0, scrollPercent)) + '%';
    }
}

// Floating elements visibility
function updateFloatingElements() {
    const scrolled = window.pageYOffset;
    const floatingShare = document.getElementById('floatingShare');
    const scrollTop = document.getElementById('scrollTop');
    
    if (scrolled > 500) {
        floatingShare.classList.add('visible');
        scrollTop.classList.add('visible');
    } else {
        floatingShare.classList.remove('visible');
        scrollTop.classList.remove('visible');
    }
}

// Copy functionality
function copyToClipboard() {
    const codeBlocks = document.querySelectorAll('pre code');
    if (codeBlocks.length > 0) {
        const code = codeBlocks[0].textContent;
        navigator.clipboard.writeText(code).then(() => {
            showNotification('Code copied to clipboard! 📋');
        });
    } else {
        navigator.clipboard.writeText(window.location.href).then(() => {
            showNotification('Link copied to clipboard! 🔗');
        });
    }
}

// Share functionality
function sharePost() {
    if (navigator.share) {
        navigator.share({
            title: document.title,
            url: window.location.href
        });
    } else {
        copyToClipboard();
    }
}

// Scroll to top
function scrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
}

// Show notification
function showNotification(message) {
    const notification = document.createElement('div');
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        background: var(--secondary-gradient);
        color: white;
        padding: 1rem 2rem;
        border-radius: 12px;
        z-index: 10000;
        animation: slideInRight 0.3s ease;
    `;
    notification.textContent = message;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.style.animation = 'slideOutRight 0.3s ease';
        setTimeout(() => {
            notification.remove();
        }, 300);
    }, 3000);
}

// Smooth scrolling for internal links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

// Event listeners
window.addEventListener('scroll', () => {
    updateProgressBar();
    updateFloatingElements();
});

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    updateProgressBar();
    updateFloatingElements();
    
    // Add animations to content elements
    const elements = document.querySelectorAll('.content-wrapper > *');
    elements.forEach((el, index) => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(30px)';
        el.style.transition = 'all 0.6s ease';
        
        setTimeout(() => {
            el.style.opacity = '1';
            el.style.transform = 'translateY(0)';
        }, index * 100);
    });
});

// Add animation styles
const style = document.createElement('style');
style.textContent = `
    @keyframes slideInRight {
        from { transform: translateX(100%); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }
    @keyframes slideOutRight {
        from { transform: translateX(0); opacity: 1; }
        to { transform: translateX(100%); opacity: 0; }
    }
`;
document.head.appendChild(style);
</script>

<?php get_footer(); ?>