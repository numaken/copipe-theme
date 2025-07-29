<?php
/**
 * Template Name: PostPilot LP
 * The template for displaying PostPilot Landing Page
 *
 * @package copipe-theme
 * @version 3.0.0
 */

get_header(); ?>

<div class="lp-page">
    
    <?php
    // Hero Section
    get_template_part('template-parts/lp/section', 'hero');
    
    // Problem Section
    get_template_part('template-parts/lp/section', 'problem');
    
    // Solution Section
    get_template_part('template-parts/lp/section', 'solution');
    
    // Download Section
    get_template_part('template-parts/lp/section', 'dl');
    
    // Voice Section (お客様の声)
    get_template_part('template-parts/lp/section', 'voice');
    
    // Final CTA Section
    get_template_part('template-parts/lp/section', 'cta');
    ?>
    
</div><!-- .lp-page -->

<!-- LP専用のスタイル追加 -->
<style>
/* LP専用の追加スタイル */
.lp-page .site-header {
    box-shadow: none;
    background: transparent;
    position: absolute;
    width: 100%;
    z-index: 1000;
}

.lp-page .site-header .site-title a {
    color: white;
}

.lp-page .main-navigation .nav-menu a {
    color: white;
}

.lp-page .mobile-menu-toggle .hamburger-icon span {
    background: white;
}

/* UIkit grid system integration */
.uk-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 15px;
}

@media (min-width: 640px) {
    .uk-container {
        padding: 0 30px;
    }
}

@media (min-width: 960px) {
    .uk-container {
        padding: 0 40px;
    }
}

/* UIkit utilities for LP */
.uk-text-center { text-align: center; }
.uk-text-left { text-align: left; }
.uk-text-right { text-align: right; }

.uk-margin { margin-bottom: 20px; }
.uk-margin-small { margin-bottom: 10px; }
.uk-margin-medium { margin-bottom: 40px; }
.uk-margin-large { margin-bottom: 70px; }

.uk-padding { padding: 30px; }
.uk-padding-small { padding: 15px; }
.uk-padding-large { padding: 70px; }

@media (max-width: 959px) {
    .uk-padding { padding: 15px; }
    .uk-padding-large { padding: 30px; }
}

/* Animation classes */
.uk-animation-fade {
    animation: uk-fade 0.5s ease-out;
}

.uk-animation-slide-bottom {
    animation: uk-slide-bottom 0.5s ease-out;
}

@keyframes uk-fade {
    0% { opacity: 0; }
    100% { opacity: 1; }
}

@keyframes uk-slide-bottom {
    0% {
        opacity: 0;
        transform: translateY(100px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Grid system */
.uk-grid {
    display: flex;
    flex-wrap: wrap;
    margin: 0 -15px;
    padding: 0;
    list-style: none;
}

.uk-grid > * {
    padding-left: 15px;
    padding-right: 15px;
}

.uk-child-width-1-1 > * { width: 100%; }
.uk-child-width-1-2 > * { width: 50%; }
.uk-child-width-1-3 > * { width: 33.333%; }

@media (max-width: 767px) {
    .uk-child-width-1-2\@s > *,
    .uk-child-width-1-3\@s > * {
        width: 100%;
    }
}

@media (min-width: 768px) {
    .uk-child-width-1-2\@s > * { width: 50%; }
    .uk-child-width-1-3\@s > * { width: 33.333%; }
}

/* Button animations */
.lp-button {
    position: relative;
    overflow: hidden;
    transform: translateZ(0);
}

.lp-button::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.5s;
}

.lp-button:hover::before {
    left: 100%;
}

/* Scroll animations */
.scroll-animation {
    opacity: 0;
    transform: translateY(50px);
    transition: all 0.8s ease-out;
}

.scroll-animation.animated {
    opacity: 1;
    transform: translateY(0);
}

/* Pulse animation for CTA buttons */
@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); }
}

.pulse-animation {
    animation: pulse 2s infinite;
}
</style>

<!-- LP専用JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Smooth scrolling for anchor links
    const anchorLinks = document.querySelectorAll('a[href^="#"]');
    anchorLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href').substring(1);
            const targetElement = document.getElementById(targetId);
            
            if (targetElement) {
                const headerHeight = document.querySelector('.site-header').offsetHeight;
                const targetPosition = targetElement.offsetTop - headerHeight;
                
                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });
    
    // Scroll animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animated');
            }
        });
    }, observerOptions);
    
    // Observe all scroll animation elements
    const scrollElements = document.querySelectorAll('.scroll-animation');
    scrollElements.forEach(el => {
        observer.observe(el);
    });
    
    // CTA button tracking (Google Analytics)
    const ctaButtons = document.querySelectorAll('.cta-button, .hero-cta, .dl-cta');
    ctaButtons.forEach(button => {
        button.addEventListener('click', function() {
            if (typeof gtag !== 'undefined') {
                gtag('event', 'click', {
                    'event_category': 'CTA',
                    'event_label': this.textContent.trim(),
                    'value': 1
                });
            }
        });
    });
    
    // Form submission tracking
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function() {
            if (typeof gtag !== 'undefined') {
                gtag('event', 'form_submit', {
                    'event_category': 'Form',
                    'event_label': 'PostPilot LP',
                    'value': 1
                });
            }
        });
    });
    
    // Scroll progress indicator
    const progressBar = document.createElement('div');
    progressBar.id = 'scroll-progress';
    progressBar.style.cssText = `
        position: fixed;
        top: 0;
        left: 0;
        width: 0%;
        height: 3px;
        background: linear-gradient(90deg, #2c5aa0, #ff6b35);
        z-index: 9999;
        transition: width 0.1s ease;
    `;
    document.body.appendChild(progressBar);
    
    window.addEventListener('scroll', function() {
        const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
        const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        const scrolled = (winScroll / height) * 100;
        progressBar.style.width = scrolled + '%';
    });
    
    // Lazy loading for images
    const images = document.querySelectorAll('img[data-src]');
    const imageObserver = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src;
                img.classList.remove('lazy');
                imageObserver.unobserve(img);
            }
        });
    });
    
    images.forEach(img => {
        imageObserver.observe(img);
    });
});
</script>

<?php get_footer(); ?>