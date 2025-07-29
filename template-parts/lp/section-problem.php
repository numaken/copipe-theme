<?php
/**
 * Problem Section Template
 * PostPilot LP Problem Section
 *
 * @package copipe-theme
 * @version 3.0.0
 */
?>

<section id="problem" class="problem-section lp-section">
    <div class="uk-container">
        <div class="uk-text-center uk-margin-large-bottom">
            <h2 class="problem-title scroll-animation">
                <span class="title-accent">こんな悩み</span>ありませんか？
            </h2>
            <p class="problem-subtitle scroll-animation">
                ブログ・コンテンツ制作でお困りの方へ
            </p>
        </div>
        
        <div class="problem-list uk-grid uk-child-width-1-2@s uk-child-width-1-1" uk-grid>
            <div class="scroll-animation">
                <div class="problem-item">
                    <div class="problem-icon">⏰</div>
                    <h3 class="problem-item-title">記事を書く時間がない</h3>
                    <p class="problem-item-text">
                        「1記事書くのに3〜5時間かかる」<br>
                        「毎日更新したいけど時間が足りない」<br>
                        「本業が忙しくて記事が書けない」
                    </p>
                    <div class="problem-emotion">
                        😰 <span>時間に追われる毎日...</span>
                    </div>
                </div>
            </div>
            
            <div class="scroll-animation">
                <div class="problem-item">
                    <div class="problem-icon">📝</div>
                    <h3 class="problem-item-title">何を書けばいいかわからない</h3>
                    <p class="problem-item-text">
                        「ネタが思い浮かばない」<br>
                        「キーワード選定が苦手」<br>
                        「競合との差別化ができない」
                    </p>
                    <div class="problem-emotion">
                        😵 <span>アイデアが枯渇...</span>
                    </div>
                </div>
            </div>
            
            <div class="scroll-animation">
                <div class="problem-item">
                    <div class="problem-icon">📊</div>
                    <h3 class="problem-item-title">SEO対策がよくわからない</h3>
                    <p class="problem-item-text">
                        「検索上位に表示されない」<br>
                        「SEOのルールが複雑すぎる」<br>
                        「タイトルや見出しの付け方がわからない」
                    </p>
                    <div class="problem-emotion">
                        😤 <span>Google検索で見つからない...</span>
                    </div>
                </div>
            </div>
            
            <div class="scroll-animation">
                <div class="problem-item">
                    <div class="problem-icon">💸</div>
                    <h3 class="problem-item-title">記事を書いても収益につながらない</h3>
                    <p class="problem-item-text">
                        「アクセスはあるけど売上が上がらない」<br>
                        「どこにアフィリエイトリンクを入れればいいの？」<br>
                        「収益化の導線設計が難しい」
                    </p>
                    <div class="problem-emotion">
                        😭 <span>努力が報われない...</span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="problem-summary scroll-animation uk-margin-large-top">
            <div class="summary-card">
                <h3 class="summary-title">
                    <span class="emphasis-text">結果として...</span>
                </h3>
                <div class="summary-content">
                    <div class="summary-item">
                        <span class="summary-icon">❌</span>
                        <span class="summary-text">ブログ更新が滞る</span>
                    </div>
                    <div class="summary-item">
                        <span class="summary-icon">❌</span>
                        <span class="summary-text">検索流入が増えない</span>
                    </div>
                    <div class="summary-item">
                        <span class="summary-icon">❌</span>
                        <span class="summary-text">収益化できない</span>
                    </div>
                    <div class="summary-item">
                        <span class="summary-icon">❌</span>
                        <span class="summary-text">モチベーション低下</span>
                    </div>
                </div>
                <div class="summary-conclusion">
                    <p class="conclusion-text">
                        <strong>「ブログで成果を出したいのに、思うようにいかない...」</strong><br>
                        そんなあなたの悩みを解決するのが<span class="highlight-solution">PostPilot</span>です！
                    </p>
                </div>
            </div>
        </div>
        
        <div class="transition-arrow uk-text-center uk-margin-large-top">
            <div class="arrow-container scroll-animation">
                <span class="arrow-text">そこで開発されたのが</span>
                <div class="arrow-icon">⬇️</div>
                <span class="solution-hint">AI時代の最強ライティングツール</span>
            </div>
        </div>
    </div>
</section>

<style>
/* Problem Section Styles */
.problem-section {
    background: #f8f9fa;
    position: relative;
}

.problem-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 100px;
    background: linear-gradient(180deg, rgba(44, 90, 160, 0.1) 0%, transparent 100%);
}

.problem-title {
    font-size: clamp(2rem, 4vw, 3rem);
    color: #2c5aa0;
    margin-bottom: 1rem;
    font-weight: 700;
}

.title-accent {
    color: #ff6b35;
    position: relative;
}

.title-accent::after {
    content: '';
    position: absolute;
    bottom: -5px;
    left: 0;
    width: 100%;
    height: 3px;
    background: linear-gradient(90deg, #ff6b35, #ffa726);
    border-radius: 2px;
}

.problem-subtitle {
    font-size: 1.1rem;
    color: #666;
    margin-bottom: 3rem;
}

.problem-list {
    margin-bottom: 4rem;
}

.problem-item {
    background: white;
    padding: 2rem;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    border-left: 5px solid #ff6b35;
    transition: all 0.3s ease;
    height: 100%;
    display: flex;
    flex-direction: column;
    position: relative;
    overflow: hidden;
}

.problem-item::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 4px;
    height: 100%;
    background: linear-gradient(180deg, #ff6b35, #e55a2b);
}

.problem-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.15);
}

.problem-icon {
    font-size: 3rem;
    margin-bottom: 1rem;
    text-align: center;
}

.problem-item-title {
    font-size: 1.3rem;
    color: #2c5aa0;
    margin-bottom: 1rem;
    font-weight: 600;
    text-align: center;
}

.problem-item-text {
    color: #555;
    line-height: 1.8;
    margin-bottom: 1.5rem;
    flex-grow: 1;
    text-align: center;
}

.problem-emotion {
    background: #fff3f0;
    padding: 1rem;
    border-radius: 10px;
    text-align: center;
    border: 1px solid #ffe0d6;
    margin-top: auto;
}

.problem-emotion span {
    color: #d63031;
    font-weight: 500;
    margin-left: 0.5rem;
}

/* Summary Section */
.problem-summary {
    margin-top: 4rem;
}

.summary-card {
    background: linear-gradient(135deg, #2c5aa0, #1e3f73);
    color: white;
    padding: 3rem 2rem;
    border-radius: 20px;
    text-align: center;
    position: relative;
    overflow: hidden;
}

.summary-card::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
    animation: rotate 20s linear infinite;
}

@keyframes rotate {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.summary-title {
    font-size: 1.8rem;
    margin-bottom: 2rem;
    position: relative;
    z-index: 2;
}

.emphasis-text {
    background: linear-gradient(90deg, #ff6b35, #ffa726);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    font-weight: 700;
}

.summary-content {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
    margin-bottom: 2rem;
    position: relative;
    z-index: 2;
}

.summary-item {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    padding: 1rem;
    background: rgba(255,255,255,0.1);
    border-radius: 10px;
    backdrop-filter: blur(10px);
}

.summary-icon {
    font-size: 1.2rem;
}

.summary-text {
    font-weight: 500;
    font-size: 0.9rem;
}

.summary-conclusion {
    position: relative;
    z-index: 2;
}

.conclusion-text {
    font-size: 1.1rem;
    line-height: 1.8;
    margin: 0;
}

.highlight-solution {
    background: linear-gradient(90deg, #ff6b35, #ffa726);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    font-weight: 700;
    font-size: 1.3rem;
}

/* Transition Arrow */
.transition-arrow {
    margin-top: 4rem;
}

.arrow-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 1rem;
}

.arrow-text {
    font-size: 1.2rem;
    color: #2c5aa0;
    font-weight: 600;
}

.arrow-icon {
    font-size: 2rem;
    animation: bounce 2s infinite;
}

@keyframes bounce {
    0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
    40% { transform: translateY(-10px); }
    60% { transform: translateY(-5px); }
}

.solution-hint {
    font-size: 1rem;
    color: #ff6b35;
    font-weight: 600;
    padding: 0.5rem 1rem;
    background: rgba(255, 107, 53, 0.1);
    border-radius: 50px;
    border: 1px solid rgba(255, 107, 53, 0.3);
}

/* Mobile Responsive */
@media (max-width: 767px) {
    .problem-section {
        padding: 3rem 0;
    }
    
    .problem-item {
        padding: 1.5rem;
        margin-bottom: 1.5rem;
    }
    
    .problem-icon {
        font-size: 2.5rem;
    }
    
    .problem-item-title {
        font-size: 1.1rem;
    }
    
    .problem-item-text {
        font-size: 0.9rem;
    }
    
    .summary-card {
        padding: 2rem 1.5rem;
    }
    
    .summary-content {
        grid-template-columns: 1fr;
    }
    
    .summary-item {
        font-size: 0.8rem;
    }
    
    .conclusion-text {
        font-size: 1rem;
    }
    
    .arrow-container {
        gap: 0.5rem;
    }
    
    .arrow-text, .solution-hint {
        font-size: 0.9rem;
    }
}

/* Accessibility */
@media (prefers-reduced-motion: reduce) {
    .problem-item:hover {
        transform: none;
    }
    
    .arrow-icon,
    .summary-card::before {
        animation: none;
    }
}

/* High contrast mode */
@media (prefers-contrast: high) {
    .problem-item {
        border: 2px solid #000;
    }
    
    .summary-card {
        background: #000;
        border: 2px solid #fff;
    }
}

/* Print styles */
@media print {
    .problem-section {
        background: white;
        color: black;
    }
    
    .problem-item {
        break-inside: avoid;
        box-shadow: none;
        border: 1px solid #ccc;
    }
    
    .summary-card {
        background: white;
        color: black;
        border: 2px solid #ccc;
    }
}
</style>