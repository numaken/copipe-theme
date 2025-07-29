<?php
/**
 * Hero Section Template
 * PostPilot LP Hero Section
 *
 * @package copipe-theme
 * @version 3.0.0
 */
?>

<section id="hero" class="hero-section lp-section">
    <div class="uk-container">
        <div class="uk-text-center">
            <div class="hero-content scroll-animation">
                <h1 class="hero-title uk-margin-medium">
                    <span class="uk-text-bold">AI時代の</span><br>
                    <span class="highlight">最強ライティングツール</span><br>
                    <span class="uk-text-primary">PostPilot</span>
                </h1>
                
                <p class="hero-subtitle uk-margin-medium">
                    わずか3分で高品質な記事を自動生成<br>
                    SEO対策も完璧、収益化まで一気通貫
                </p>
                
                <div class="hero-features uk-margin-medium">
                    <div class="uk-grid uk-child-width-1-3@s uk-child-width-1-1" uk-grid>
                        <div>
                            <div class="feature-badge">
                                <span class="badge-icon">⚡</span>
                                <span class="badge-text">3分で記事完成</span>
                            </div>
                        </div>
                        <div>
                            <div class="feature-badge">
                                <span class="badge-icon">🎯</span>
                                <span class="badge-text">SEO自動最適化</span>
                            </div>
                        </div>
                        <div>
                            <div class="feature-badge">
                                <span class="badge-icon">💰</span>
                                <span class="badge-text">収益化支援</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="hero-cta-container uk-margin-large">
                    <a href="#download" class="hero-cta lp-button pulse-animation">
                        <span class="cta-text">今すぐ無料でダウンロード</span>
                        <span class="cta-subtext">※メールアドレス登録のみ</span>
                    </a>
                </div>
                
                <div class="hero-trust uk-margin-medium">
                    <div class="trust-indicators">
                        <span class="trust-item">
                            <strong>10,000+</strong> ダウンロード突破
                        </span>
                        <span class="trust-separator">|</span>
                        <span class="trust-item">
                            満足度 <strong>98%</strong>
                        </span>
                        <span class="trust-separator">|</span>
                        <span class="trust-item">
                            <strong>完全無料</strong>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Background Video/Animation -->
    <div class="hero-background">
        <div class="hero-animation">
            <div class="floating-elements">
                <div class="floating-element" style="--delay: 0s;">📝</div>
                <div class="floating-element" style="--delay: 1s;">🚀</div>
                <div class="floating-element" style="--delay: 2s;">⭐</div>
                <div class="floating-element" style="--delay: 3s;">💡</div>
                <div class="floating-element" style="--delay: 4s;">📊</div>
            </div>
        </div>
    </div>
    
    <!-- Scroll indicator -->
    <div class="scroll-indicator">
        <div class="scroll-arrow">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <p class="scroll-text">スクロールして詳細を見る</p>
    </div>
</section>

<style>
/* Hero Section Styles */
.hero-section {
    min-height: 100vh;
    display: flex;
    align-items: center;
    position: relative;
    overflow: hidden;
    background: linear-gradient(135deg, #1e3f73 0%, #2c5aa0 50%, #3d6bb0 100%);
}

.hero-content {
    position: relative;
    z-index: 10;
    padding: 2rem 0;
}

.hero-title {
    font-size: clamp(2rem, 5vw, 4rem);
    line-height: 1.2;
    margin-bottom: 1.5rem;
    color: white;
    text-shadow: 0 2px 10px rgba(0,0,0,0.3);
}

.highlight {
    background: linear-gradient(90deg, #ff6b35, #ffa726);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    font-weight: 700;
}

.hero-subtitle {
    font-size: clamp(1.1rem, 2.5vw, 1.4rem);
    color: rgba(255, 255, 255, 0.9);
    max-width: 600px;
    margin: 0 auto 2rem;
    line-height: 1.6;
}

.hero-features {
    margin: 3rem auto;
}

.feature-badge {
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(10px);
    border-radius: 50px;
    padding: 1rem 1.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    font-weight: 600;
    color: white;
    border: 1px solid rgba(255, 255, 255, 0.2);
    transition: all 0.3s ease;
}

.feature-badge:hover {
    transform: translateY(-5px);
    background: rgba(255, 255, 255, 0.25);
}

.badge-icon {
    font-size: 1.5rem;
}

.badge-text {
    font-size: 0.9rem;
    white-space: nowrap;
}

.hero-cta {
    display: inline-flex;
    flex-direction: column;
    align-items: center;
    background: linear-gradient(45deg, #ff6b35, #ff8a65);
    color: white;
    text-decoration: none;
    padding: 1.5rem 3rem;
    border-radius: 60px;
    font-weight: 700;
    font-size: 1.2rem;
    box-shadow: 0 10px 30px rgba(255, 107, 53, 0.4);
    transition: all 0.3s ease;
    border: 3px solid rgba(255, 255, 255, 0.2);
    position: relative;
    overflow: hidden;
}

.hero-cta:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 40px rgba(255, 107, 53, 0.6);
    color: white;
}

.cta-text {
    font-size: 1.2rem;
    margin-bottom: 0.2rem;
}

.cta-subtext {
    font-size: 0.8rem;
    opacity: 0.9;
    font-weight: 400;
}

.hero-trust {
    margin-top: 3rem;
}

.trust-indicators {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-wrap: wrap;
    gap: 1rem;
    color: rgba(255, 255, 255, 0.8);
    font-size: 0.9rem;
}

.trust-item strong {
    color: #ffa726;
    font-size: 1.1rem;
}

.trust-separator {
    opacity: 0.5;
}

/* Background Animation */
.hero-background {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 1;
}

.floating-elements {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
}

.floating-element {
    position: absolute;
    font-size: 2rem;
    opacity: 0.3;
    animation: float 6s ease-in-out infinite;
    animation-delay: var(--delay);
}

.floating-element:nth-child(1) { top: 20%; left: 10%; }
.floating-element:nth-child(2) { top: 40%; right: 15%; }
.floating-element:nth-child(3) { top: 60%; left: 20%; }
.floating-element:nth-child(4) { top: 30%; right: 25%; }
.floating-element:nth-child(5) { top: 70%; left: 70%; }

@keyframes float {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-20px) rotate(180deg); }
}

/* Scroll Indicator */
.scroll-indicator {
    position: absolute;
    bottom: 2rem;
    left: 50%;
    transform: translateX(-50%);
    text-align: center;
    color: rgba(255, 255, 255, 0.8);
    z-index: 10;
}

.scroll-arrow {
    margin-bottom: 0.5rem;
}

.scroll-arrow span {
    display: block;
    width: 2px;
    height: 8px;
    background: white;
    margin: 2px auto;
    animation: arrow-move 2s infinite;
}

.scroll-arrow span:nth-child(2) {
    animation-delay: -0.4s;
}

.scroll-arrow span:nth-child(3) {
    animation-delay: -0.8s;
}

@keyframes arrow-move {
    0% { opacity: 0; transform: translateY(-10px); }
    50% { opacity: 1; }
    100% { opacity: 0; transform: translateY(10px); }
}

.scroll-text {
    font-size: 0.8rem;
    margin: 0;
    opacity: 0.7;
}

/* Mobile Responsive */
@media (max-width: 767px) {
    .hero-section {
        min-height: 80vh;
        padding: 2rem 0;
    }
    
    .hero-features .uk-grid {
        gap: 1rem;
    }
    
    .feature-badge {
        padding: 0.8rem 1rem;
        font-size: 0.8rem;
    }
    
    .badge-icon {
        font-size: 1.2rem;
    }
    
    .hero-cta {
        padding: 1.2rem 2rem;
        font-size: 1rem;
    }
    
    .trust-indicators {
        flex-direction: column;
        gap: 0.5rem;
    }
    
    .trust-separator {
        display: none;
    }
    
    .floating-element {
        font-size: 1.5rem;
    }
}

/* High contrast mode support */
@media (prefers-contrast: high) {
    .hero-section {
        background: #000;
        color: #fff;
    }
    
    .feature-badge {
        background: #333;
        border-color: #fff;
    }
}

/* Reduced motion support */
@media (prefers-reduced-motion: reduce) {
    .floating-element,
    .scroll-arrow span,
    .pulse-animation {
        animation: none;
    }
    
    .hero-cta:hover {
        transform: none;
    }
}
</style>