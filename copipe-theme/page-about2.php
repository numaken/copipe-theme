<?php
/**
 * Modern About Page Template
 * 
 * @package Modern_Copipe_Theme
 */

get_header();
?>

<style>
  /* Modern About Page Styles */
  .modern-about-container {
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(10px);
    border-radius: 24px;
    border: 1px solid rgba(255, 255, 255, 0.1);
    margin: 2rem;
    overflow: hidden;
    box-shadow: var(--shadow-elevation);
  }

  .about-hero {
    background: var(--primary-gradient);
    padding: 5rem 2rem;
    text-align: center;
    position: relative;
    overflow: hidden;
  }

  .about-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url("data:image/svg+xml,%3Csvg width='120' height='120' viewBox='0 0 120 120' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.08'%3E%3Cpath d='M0 0h120v120H0V0zm20 20v80h80V20H20zm20 20v40h40V40H40z' /%3E%3C/g%3E%3C/g%3E%3C/svg%3E") repeat;
    opacity: 0.3;
  }

  .hero-content {
    position: relative;
    z-index: 2;
    max-width: 800px;
    margin: 0 auto;
  }

  .hero-icon {
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
    animation: iconBounce 3s ease-in-out infinite;
  }

  @keyframes iconBounce {
    0%, 100% { transform: translateY(0px) scale(1); }
    50% { transform: translateY(-10px) scale(1.05); }
  }

  .hero-title {
    font-size: 4rem;
    font-weight: 800;
    color: white;
    margin-bottom: 1.5rem;
    text-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
  }

  .hero-subtitle {
    font-size: 1.4rem;
    color: rgba(255, 255, 255, 0.9);
    margin-bottom: 2rem;
    line-height: 1.6;
  }

  .hero-stats {
    display: flex;
    justify-content: center;
    gap: 3rem;
    flex-wrap: wrap;
  }

  .stat-item {
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(15px);
    padding: 1.5rem 2.5rem;
    border-radius: 25px;
    border: 2px solid rgba(255, 255, 255, 0.3);
    color: white;
    text-align: center;
    transition: all 0.3s ease;
  }

  .stat-item:hover {
    background: rgba(255, 255, 255, 0.25);
    transform: translateY(-5px);
  }

  .stat-number {
    font-size: 2.5rem;
    font-weight: 800;
    display: block;
    background: var(--secondary-gradient);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
  }

  .stat-label {
    font-size: 0.9rem;
    opacity: 0.8;
    margin-top: 0.5rem;
  }

  .about-content {
    padding: 4rem 3rem;
    max-width: 1000px;
    margin: 0 auto;
  }

  .section {
    margin-bottom: 4rem;
    opacity: 0;
    transform: translateY(50px);
    transition: all 0.8s ease;
  }

  .section.visible {
    opacity: 1;
    transform: translateY(0);
  }

  .section-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: white;
    margin-bottom: 2rem;
    text-align: center;
    background: var(--secondary-gradient);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
  }

  .section-content {
    background: rgba(255, 255, 255, 0.08);
    backdrop-filter: blur(15px);
    border-radius: 20px;
    border: 1px solid rgba(255, 255, 255, 0.15);
    padding: 3rem;
    color: rgba(255, 255, 255, 0.9);
    line-height: 1.8;
    font-size: 1.1rem;
  }

  .feature-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
    margin-top: 3rem;
  }

  .feature-card {
    background: linear-gradient(145deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.05));
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 20px;
    padding: 2.5rem;
    text-align: center;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
  }

  .feature-card::before {
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

  .feature-card:hover::before {
    transform: scaleX(1);
  }

  .feature-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 30px 60px -12px rgba(0, 0, 0, 0.3);
    background: linear-gradient(145deg, rgba(255, 255, 255, 0.15), rgba(255, 255, 255, 0.1));
  }

  .feature-icon {
    font-size: 3rem;
    margin-bottom: 1.5rem;
    display: block;
  }

  .feature-title {
    font-size: 1.3rem;
    font-weight: 700;
    color: white;
    margin-bottom: 1rem;
  }

  .feature-description {
    color: rgba(255, 255, 255, 0.8);
    line-height: 1.6;
  }

  .cta-section {
    background: var(--dark-gradient);
    border-radius: 24px;
    padding: 4rem 3rem;
    text-align: center;
    margin-top: 4rem;
    position: relative;
    overflow: hidden;
  }

  .cta-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 2px;
    background: var(--secondary-gradient);
  }

  .cta-title {
    font-size: 2.5rem;
    font-weight: 800;
    color: white;
    margin-bottom: 1.5rem;
  }

  .cta-description {
    font-size: 1.2rem;
    color: rgba(255, 255, 255, 0.8);
    margin-bottom: 2.5rem;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
  }

  .cta-buttons {
    display: flex;
    justify-content: center;
    gap: 2rem;
    flex-wrap: wrap;
  }

  .cta-button {
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

  .cta-button.secondary {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255, 255, 255, 0.3);
  }

  .cta-button:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 35px rgba(245, 87, 108, 0.4);
    color: white;
    text-decoration: none;
  }

  .cta-button.secondary:hover {
    background: rgba(255, 255, 255, 0.2);
    box-shadow: 0 15px 35px rgba(255, 255, 255, 0.1);
  }

  .tech-stack {
    display: flex;
    justify-content: center;
    gap: 2rem;
    flex-wrap: wrap;
    margin-top: 3rem;
  }

  .tech-item {
    background: rgba(255, 255, 255, 0.08);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.15);
    border-radius: 15px;
    padding: 1rem 2rem;
    color: rgba(255, 255, 255, 0.9);
    font-weight: 600;
    transition: all 0.3s ease;
  }

  .tech-item:hover {
    background: rgba(255, 255, 255, 0.15);
    transform: translateY(-2px);
  }

  /* レスポンシブ */
  @media (max-width: 768px) {
    .modern-about-container {
      margin: 1rem;
      border-radius: 16px;
    }

    .about-hero {
      padding: 4rem 1.5rem;
    }

    .hero-title {
      font-size: 2.8rem;
    }

    .hero-stats {
      gap: 1.5rem;
    }

    .about-content {
      padding: 3rem 2rem;
    }

    .section-content {
      padding: 2rem;
    }

    .feature-grid {
      grid-template-columns: 1fr;
    }

    .cta-section {
      padding: 3rem 2rem;
    }

    .cta-buttons {
      flex-direction: column;
      align-items: center;
      gap: 1rem;
    }

    .tech-stack {
      gap: 1rem;
    }
  }
</style>

<div class="modern-about-container">
  
  <!-- Hero Section -->
  <header class="about-hero">
    <div class="hero-content">
      
      <!-- Hero Icon -->
      <div class="hero-icon">
        <svg width="64" height="64" viewBox="0 0 24 24" fill="white">
          <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
        </svg>
      </div>
      
      <h1 class="hero-title">このサイトについて</h1>
      <p class="hero-subtitle">
        開発者のための実用的なコードスニペット集。<br>
        コピペで使える高品質なコードを厳選してお届けします。
      </p>
      
      <!-- Statistics -->
      <div class="hero-stats">
        <div class="stat-item">
          <span class="stat-number">500+</span>
          <div class="stat-label">コードスニペット</div>
        </div>
        <div class="stat-item">
          <span class="stat-number">50+</span>
          <div class="stat-label">カテゴリ</div>
        </div>
        <div class="stat-item">
          <span class="stat-number">10K+</span>
          <div class="stat-label">月間ユーザー</div>
        </div>
      </div>
    </div>
  </header>
  
  <!-- About Content -->
  <div class="about-content">
    
    <!-- Mission Section -->
    <section class="section">
      <h2 class="section-title">🚀 私たちのミッション</h2>
      <div class="section-content">
        <p>
          開発者の日常業務を効率化し、より創造的な作業に集中できる環境を提供することが私たちの使命です。
          実際のプロジェクトで使用され、テスト済みのコードスニペットを厳選し、
          すぐに活用できる形でお届けしています。
        </p>
        <p>
          時間のかかる定型作業を削減し、開発者がより高度な課題解決に取り組めるよう、
          品質の高いコードリソースを継続的に提供します。
        </p>
      </div>
    </section>
    
    <!-- Features Section -->
    <section class="section">
      <h2 class="section-title">✨ 特徴</h2>
      <div class="feature-grid">
        <div class="feature-card">
          <div class="feature-icon">🎯</div>
          <h3 class="feature-title">実用性重視</h3>
          <p class="feature-description">
            実際のプロジェクトで使用されている、テスト済みの実用的なコードのみを厳選
          </p>
        </div>
        
        <div class="feature-card">
          <div class="feature-icon">📝</div>
          <h3 class="feature-title">詳細な解説</h3>
          <p class="feature-description">
            コードの動作原理から応用方法まで、わかりやすく丁寧に解説
          </p>
        </div>
        
        <div class="feature-card">
          <div class="feature-icon">🔍</div>
          <h3 class="feature-title">高度な検索</h3>
          <p class="feature-description">
            カテゴリ別、技術別、難易度別の検索で、必要なコードを素早く発見
          </p>
        </div>
        
        <div class="feature-card">
          <div class="feature-icon">📱</div>
          <h3 class="feature-title">レスポンシブ対応</h3>
          <p class="feature-description">
            PC、スマートフォン、タブレットなど、あらゆるデバイスで快適に利用可能
          </p>
        </div>
        
        <div class="feature-card">
          <div class="feature-icon">🔄</div>
          <h3 class="feature-title">定期更新</h3>
          <p class="feature-description">
            最新の技術トレンドに対応した新しいコードスニペットを定期的に追加
          </p>
        </div>
        
        <div class="feature-card">
          <div class="feature-icon">🚀</div>
          <h3 class="feature-title">パフォーマンス重視</h3>
          <p class="feature-description">
            高速な読み込み速度と優れたUXで、ストレスフリーな学習環境を提供
          </p>
        </div>
      </div>
    </section>
    
    <!-- Technology Section -->
    <section class="section">
      <h2 class="section-title">🛠 技術スタック</h2>
      <div class="section-content">
        <p>
          このサイトは最新の技術を活用して構築されており、
          高いパフォーマンスとユーザビリティを実現しています。
        </p>
        
        <div class="tech-stack">
          <div class="tech-item">WordPress</div>
          <div class="tech-item">PHP 8.0+</div>
          <div class="tech-item">CSS3</div>
          <div class="tech-item">JavaScript ES6+</div>
          <div class="tech-item">UIkit3</div>
          <div class="tech-item">Prism.js</div>
          <div class="tech-item">MySQL</div>
        </div>
      </div>
    </section>
    
    <!-- CTA Section -->
    <section class="cta-section">
      <h2 class="cta-title">今すぐ始めましょう</h2>
      <p class="cta-description">
        豊富なコードスニペットをブラウズして、あなたの開発を効率化しませんか？
      </p>
      
      <div class="cta-buttons">
        <a href="<?php echo esc_url(get_category_link(get_cat_ID('copipe'))); ?>" class="cta-button">
          📚 コードを探す
        </a>
        <a href="mailto:numaken@gmail.com" class="cta-button secondary">
          ✉️ お問い合わせ
        </a>
      </div>
    </section>
  </div>
</div>

<script>
// Intersection Observer for animations
document.addEventListener('DOMContentLoaded', function() {
    const sections = document.querySelectorAll('.section');
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
                setTimeout(() => {
                    entry.target.classList.add('visible');
                }, index * 200);
            }
        });
    }, {
        threshold: 0.1
    });
    
    sections.forEach(section => {
        observer.observe(section);
    });
    
    // Counter animation for stats
    const statNumbers = document.querySelectorAll('.stat-number');
    
    const animateCounter = (element) => {
        const target = parseInt(element.textContent.replace(/[^\d]/g, ''));
        const duration = 2000;
        const step = target / (duration / 16);
        let current = 0;
        
        const counter = setInterval(() => {
            current += step;
            if (current >= target) {
                element.textContent = element.textContent.replace(/\d+/, target);
                clearInterval(counter);
            } else {
                element.textContent = element.textContent.replace(/\d+/, Math.floor(current));
            }
        }, 16);
    };
    
    // Trigger counter animation when stats come into view
    const statsObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                statNumbers.forEach(stat => animateCounter(stat));
                statsObserver.unobserve(entry.target);
            }
        });
    });
    
    const heroStats = document.querySelector('.hero-stats');
    if (heroStats) {
        statsObserver.observe(heroStats);
    }
});
</script>

<?php get_footer(); ?>