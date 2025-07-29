<?php
/**
 * Download Section Template
 * PostPilot LP Download Section
 *
 * @package copipe-theme
 * @version 3.0.0
 */

// LINE URLを取得（設定から）
$line_url = get_option('copipe_line_url', '#');
?>

<section id="download" class="dl-section lp-section">
    <div class="uk-container">
        <div class="uk-text-center">
            
            <!-- Main Headline -->
            <div class="dl-headline scroll-animation uk-margin-large-bottom">
                <h2 class="dl-title">
                    <span class="title-accent">期間限定</span><br>
                    <span class="title-main">PostPilot 完全無料</span><br>
                    <span class="title-sub">ダウンロード開始！</span>
                </h2>
                <p class="dl-subtitle">
                    今だけ特別価格！通常29,800円 → <span class="price-highlight">完全無料</span><br>
                    メールアドレス登録のみでダウンロード可能
                </p>
            </div>
            
            <!-- Bonus Section -->
            <div class="bonus-section scroll-animation uk-margin-large-bottom">
                <h3 class="bonus-title">
                    🎁 <span class="highlight">さらに特典付き！</span>
                </h3>
                
                <div class="uk-grid uk-child-width-1-2@s uk-child-width-1-1" uk-grid>
                    <div>
                        <div class="bonus-item">
                            <div class="bonus-icon">📚</div>
                            <h4 class="bonus-item-title">AIライティング完全攻略ガイド</h4>
                            <p class="bonus-item-desc">
                                (価値: 9,800円)<br>
                                プロが教えるAIライティングのノウハウを全公開
                            </p>
                        </div>
                    </div>
                    
                    <div>
                        <div class="bonus-item">
                            <div class="bonus-icon">🚀</div>
                            <h4 class="bonus-item-title">収益化テンプレート100選</h4>
                            <p class="bonus-item-desc">
                                (価値: 19,800円)<br>
                                即使える高収益記事テンプレート集
                            </p>
                        </div>
                    </div>
                    
                    <div>
                        <div class="bonus-item">
                            <div class="bonus-icon">💎</div>
                            <h4 class="bonus-item-title">SEO最適化チェックリスト</h4>
                            <p class="bonus-item-desc">
                                (価値: 5,800円)<br>
                                検索上位を狙うための完全チェック項目
                            </p>
                        </div>
                    </div>
                    
                    <div>
                        <div class="bonus-item">
                            <div class="bonus-icon">📞</div>
                            <h4 class="bonus-item-title">個別サポート（30日間）</h4>
                            <p class="bonus-item-desc">
                                (価値: 50,000円)<br>
                                専門スタッフによる直接サポート
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="total-value uk-margin-medium-top">
                    <p class="value-text">
                        <span class="value-label">総額</span>
                        <span class="value-amount">85,200円相当</span>
                        <span class="value-arrow">→</span>
                        <span class="value-free">完全無料</span>
                    </p>
                </div>
            </div>
            
            <!-- Download Form/Button -->
            <div class="download-action scroll-animation uk-margin-large-bottom">
                <div class="action-container">
                    
                    <!-- Email Form -->
                    <div class="email-form-section">
                        <h3 class="form-title">
                            📧 メールアドレスを入力してダウンロード
                        </h3>
                        
                        <form class="download-form" id="download-form">
                            <div class="form-group">
                                <input type="email" 
                                       name="email" 
                                       id="email" 
                                       placeholder="メールアドレスを入力してください" 
                                       required 
                                       class="email-input">
                                <button type="submit" class="download-btn">
                                    <span class="btn-icon">⬇️</span>
                                    <span class="btn-text">今すぐ無料ダウンロード</span>
                                </button>
                            </div>
                            
                            <div class="form-note">
                                <p class="note-text">
                                    ※ 迷惑メール防止のため、gmail、yahoo、outlookなどのフリーメールをご利用ください<br>
                                    ※ 送信後、すぐにダウンロードリンクをお送りします
                                </p>
                            </div>
                        </form>
                    </div>
                    
                    <!-- LINE Section -->
                    <div class="line-section uk-margin-large-top">
                        <div class="or-divider">
                            <span class="or-text">または</span>
                        </div>
                        
                        <h3 class="line-title">
                            📱 LINEで受け取る（推奨）
                        </h3>
                        <p class="line-subtitle">
                            LINEなら即座にダウンロード！さらに限定情報も配信中
                        </p>
                        
                        <a href="<?php echo esc_url($line_url); ?>" 
                           class="line-btn lp-button"
                           target="_blank"
                           rel="noopener">
                            <span class="line-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M19.365 9.863c.349 0 .63.285.63.631 0 .345-.281.63-.63.63H17.61v1.125h1.755c.349 0 .63.283.63.63 0 .344-.281.629-.63.629h-2.386c-.345 0-.627-.285-.627-.629V8.108c0-.345.282-.63.63-.63h2.386c.346 0 .627.285.627.63 0 .349-.281.63-.63.63H17.61v1.125h1.755zm-3.855 3.016c0 .27-.174.51-.432.596-.064.021-.133.031-.199.031-.211 0-.391-.09-.51-.25l-2.443-3.317v2.94c0 .344-.279.629-.631.629-.346 0-.626-.285-.626-.629V8.108c0-.27.173-.51.43-.595.06-.023.136-.033.194-.033.195 0 .375.104.495.254l2.462 3.33V8.108c0-.345.282-.63.63-.63.345 0 .63.285.63.63v4.771zm-5.741 0c0 .344-.282.629-.631.629-.345 0-.627-.285-.627-.629V8.108c0-.345.282-.63.63-.63.346 0 .628.285.628.63v4.771zm-2.466.629H4.917c-.345 0-.63-.285-.63-.629V8.108c0-.345.285-.63.63-.63.348 0 .63.285.63.63v4.141h1.756c.348 0 .629.283.629.629 0 .344-.282.629-.629.629M24 10.314C24 4.943 18.615.572 12 .572S0 4.943 0 10.314c0 4.811 4.27 8.842 10.035 9.608.391.082.923.258 1.058.59.12.301.079.766.038 1.08l-.164 1.02c-.045.301-.24 1.186 1.049.645 1.291-.539 6.916-4.078 9.436-6.975C23.176 14.393 24 12.458 24 10.314"/>
                                </svg>
                            </span>
                            <span class="line-text">
                                <span class="line-main">LINE公式アカウント</span>
                                <span class="line-sub">今すぐ友だち追加</span>
                            </span>
                        </a>
                        
                        <div class="line-benefits uk-margin-medium-top">
                            <h4 class="benefits-title">LINE登録の特典</h4>
                            <div class="benefits-list">
                                <div class="benefit-item">✅ 即座にPostPilotダウンロード</div>
                                <div class="benefit-item">✅ 最新AIツール情報を定期配信</div>
                                <div class="benefit-item">✅ 限定セミナー・ウェビナー招待</div>
                                <div class="benefit-item">✅ 個別質問・相談対応</div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            
            <!-- Trust Indicators -->
            <div class="trust-section scroll-animation">
                <div class="trust-indicators">
                    <div class="trust-item">
                        <div class="trust-icon">🔒</div>
                        <div class="trust-text">
                            <strong>個人情報保護</strong><br>
                            SSL暗号化で安全
                        </div>
                    </div>
                    
                    <div class="trust-item">
                        <div class="trust-icon">📬</div>
                        <div class="trust-text">
                            <strong>スパム送信なし</strong><br>
                            必要な情報のみ配信
                        </div>
                    </div>
                    
                    <div class="trust-item">
                        <div class="trust-icon">✋</div>
                        <div class="trust-text">
                            <strong>いつでも解除可能</strong><br>
                            ワンクリックで配信停止
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Urgency Section -->
            <div class="urgency-section scroll-animation uk-margin-large-top">
                <div class="urgency-container">
                    <h3 class="urgency-title">
                        ⚠️ <span class="urgent-text">期間限定のお知らせ</span>
                    </h3>
                    <p class="urgency-text">
                        この無料キャンペーンは<strong>先着1000名限定</strong>です。<br>
                        定員に達し次第、予告なく終了いたします。
                    </p>
                    
                    <div class="countdown-timer" id="countdown-timer">
                        <div class="timer-label">キャンペーン終了まで</div>
                        <div class="timer-display">
                            <div class="timer-unit">
                                <span class="timer-number" id="days">05</span>
                                <span class="timer-text">日</span>
                            </div>
                            <div class="timer-unit">
                                <span class="timer-number" id="hours">12</span>
                                <span class="timer-text">時間</span>
                            </div>
                            <div class="timer-unit">
                                <span class="timer-number" id="minutes">34</span>
                                <span class="timer-text">分</span>
                            </div>
                            <div class="timer-unit">
                                <span class="timer-number" id="seconds">56</span>
                                <span class="timer-text">秒</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="remaining-counter">
                        <p class="remaining-text">
                            残り<span class="remaining-number" id="remaining-count">347</span>名
                        </p>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: 65.3%"></div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</section>

<style>
/* Download Section Styles */
.dl-section {
    background: linear-gradient(135deg, #2c5aa0 0%, #1e3f73 100%);
    color: white;
    position: relative;
    overflow: hidden;
}

.dl-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-image: 
        radial-gradient(circle at 20% 20%, rgba(255, 107, 53, 0.1) 0%, transparent 50%),
        radial-gradient(circle at 80% 80%, rgba(255, 167, 38, 0.1) 0%, transparent 50%);
}

.dl-headline {
    position: relative;
    z-index: 2;
}

.dl-title {
    font-size: clamp(2.5rem, 5vw, 4.5rem);
    line-height: 1.1;
    margin-bottom: 1.5rem;
    font-weight: 800;
}

.title-accent {
    background: linear-gradient(90deg, #ff6b35, #ffa726);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    font-size: 0.6em;
    display: block;
}

.title-main {
    color: white;
    text-shadow: 0 3px 10px rgba(0,0,0,0.3);
}

.title-sub {
    color: rgba(255,255,255,0.9);
    font-weight: 600;
    font-size: 0.7em;
}

.dl-subtitle {
    font-size: 1.2rem;
    color: rgba(255,255,255,0.9);
    line-height: 1.6;
}

.price-highlight {
    background: linear-gradient(90deg, #ff6b35, #ffa726);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    font-weight: 700;
    font-size: 1.3em;
}

/* Bonus Section */
.bonus-section {
    background: rgba(255,255,255,0.1);
    backdrop-filter: blur(15px);
    padding: 3rem 2rem;
    border-radius: 25px;
    border: 1px solid rgba(255,255,255,0.2);
    position: relative;
    z-index: 2;
}

.bonus-title {
    font-size: 2rem;
    margin-bottom: 2rem;
    font-weight: 700;
}

.bonus-item {
    background: rgba(255,255,255,0.15);
    backdrop-filter: blur(10px);
    padding: 2rem 1.5rem;
    border-radius: 15px;
    text-align: center;
    border: 1px solid rgba(255,255,255,0.2);
    height: 100%;
    transition: all 0.3s ease;
}

.bonus-item:hover {
    transform: translateY(-5px);
    background: rgba(255,255,255,0.2);
}

.bonus-icon {
    font-size: 3rem;
    margin-bottom: 1rem;
}

.bonus-item-title {
    font-size: 1.2rem;
    margin-bottom: 1rem;
    font-weight: 600;
    color: white;
}

.bonus-item-desc {
    color: rgba(255,255,255,0.9);
    line-height: 1.6;
    font-size: 0.95rem;
}

.total-value {
    background: linear-gradient(135deg, #ff6b35, #ffa726);
    padding: 1.5rem 2rem;
    border-radius: 15px;
    display: inline-block;
}

.value-text {
    font-size: 1.3rem;
    font-weight: 700;
    margin: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 1rem;
    flex-wrap: wrap;
}

.value-amount {
    text-decoration: line-through;
    opacity: 0.8;
}

.value-arrow {
    font-size: 1.5rem;
}

.value-free {
    font-size: 1.5em;
    text-shadow: 0 2px 5px rgba(0,0,0,0.3);
}

/* Download Action */
.download-action {
    position: relative;
    z-index: 2;
}

.action-container {
    background: white;
    color: #333;
    padding: 3rem 2rem;
    border-radius: 25px;
    box-shadow: 0 20px 50px rgba(0,0,0,0.2);
}

.form-title {
    font-size: 1.5rem;
    color: #2c5aa0;
    margin-bottom: 2rem;
    font-weight: 600;
}

.download-form {
    margin-bottom: 2rem;
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    max-width: 500px;
    margin: 0 auto;
}

.email-input {
    padding: 1.2rem 1.5rem;
    border: 2px solid #e0e0e0;
    border-radius: 15px;
    font-size: 1.1rem;
    transition: all 0.3s ease;
    background: #f8f9fa;
}

.email-input:focus {
    outline: none;
    border-color: #2c5aa0;
    background: white;
    box-shadow: 0 0 0 3px rgba(44, 90, 160, 0.1);
}

.download-btn {
    background: linear-gradient(135deg, #00c851, #00a844);
    color: white;
    border: none;
    padding: 1.5rem 2rem;
    border-radius: 15px;
    font-size: 1.2rem;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}

.download-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(0, 200, 81, 0.3);
}

.form-note {
    margin-top: 1rem;
}

.note-text {
    font-size: 0.85rem;
    color: #666;
    line-height: 1.5;
    margin: 0;
}

/* LINE Section */
.or-divider {
    position: relative;
    margin: 2rem 0;
}

.or-divider::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    height: 1px;
    background: #e0e0e0;
}

.or-text {
    background: white;
    padding: 0 1rem;
    color: #666;
    position: relative;
    z-index: 1;
}

.line-title {
    font-size: 1.5rem;
    color: #00c300;
    margin-bottom: 0.5rem;
    font-weight: 600;
}

.line-subtitle {
    color: #666;
    margin-bottom: 2rem;
}

.line-btn {
    background: linear-gradient(135deg, #00c300, #00a000);
    color: white;
    text-decoration: none;
    padding: 1.5rem 2.5rem;
    border-radius: 15px;
    display: inline-flex;
    align-items: center;
    gap: 1rem;
    font-weight: 600;
    transition: all 0.3s ease;
    box-shadow: 0 8px 25px rgba(0, 195, 0, 0.3);
}

.line-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 35px rgba(0, 195, 0, 0.4);
    color: white;
}

.line-icon {
    display: flex;
    align-items: center;
    justify-content: center;
}

.line-text {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
}

.line-main {
    font-size: 1.1rem;
    font-weight: 700;
}

.line-sub {
    font-size: 0.9rem;
    opacity: 0.9;
}

.line-benefits {
    background: #f0f8f0;
    padding: 2rem;
    border-radius: 15px;
    border: 2px solid #e0f0e0;
}

.benefits-title {
    color: #00c300;
    font-size: 1.2rem;
    margin-bottom: 1rem;
    font-weight: 600;
    text-align: center;
}

.benefits-list {
    display: grid;
    gap: 0.8rem;
}

.benefit-item {
    color: #333;
    font-weight: 500;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Trust Section */
.trust-section {
    position: relative;
    z-index: 2;
    margin-top: 3rem;
}

.trust-indicators {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 2rem;
    background: rgba(255,255,255,0.1);
    backdrop-filter: blur(10px);
    padding: 2rem;
    border-radius: 20px;
    border: 1px solid rgba(255,255,255,0.2);
}

.trust-item {
    text-align: center;
}

.trust-icon {
    font-size: 2rem;
    margin-bottom: 0.5rem;
}

.trust-text {
    font-size: 0.9rem;
    color: rgba(255,255,255,0.9);
    line-height: 1.4;
}

/* Urgency Section */
.urgency-section {
    position: relative;
    z-index: 2;
}

.urgency-container {
    background: linear-gradient(135deg, #ff6b35, #e55a2b);
    padding: 3rem 2rem;
    border-radius: 25px;
    text-align: center;
    box-shadow: 0 15px 40px rgba(255, 107, 53, 0.3);
}

.urgency-title {
    font-size: 1.8rem;
    margin-bottom: 1rem;
    font-weight: 700;
}

.urgent-text {
    animation: pulse-glow 2s infinite;
}

@keyframes pulse-glow {
    0%, 100% { text-shadow: 0 0 5px rgba(255,255,255,0.5); }
    50% { text-shadow: 0 0 20px rgba(255,255,255,0.8); }
}

.urgency-text {
    font-size: 1.1rem;
    margin-bottom: 2rem;
    line-height: 1.6;
}

.countdown-timer {
    margin-bottom: 2rem;
}

.timer-label {
    font-size: 1rem;
    margin-bottom: 1rem;
    opacity: 0.9;
}

.timer-display {
    display: flex;
    justify-content: center;
    gap: 1rem;
    flex-wrap: wrap;
}

.timer-unit {
    background: rgba(255,255,255,0.2);
    backdrop-filter: blur(10px);
    padding: 1rem;
    border-radius: 15px;
    min-width: 80px;
    border: 1px solid rgba(255,255,255,0.3);
}

.timer-number {
    display: block;
    font-size: 2rem;
    font-weight: 800;
    line-height: 1;
}

.timer-text {
    font-size: 0.8rem;
    opacity: 0.8;
}

.remaining-counter {
    background: rgba(255,255,255,0.15);
    backdrop-filter: blur(10px);
    padding: 1.5rem;
    border-radius: 15px;
    border: 1px solid rgba(255,255,255,0.2);
}

.remaining-text {
    font-size: 1.2rem;
    margin-bottom: 1rem;
    font-weight: 600;
}

.remaining-number {
    font-size: 1.5em;
    font-weight: 800;
    color: #ffeb3b;
}

.progress-bar {
    width: 100%;
    height: 8px;
    background: rgba(255,255,255,0.2);
    border-radius: 4px;
    overflow: hidden;
}

.progress-fill {
    height: 100%;
    background: linear-gradient(90deg, #4caf50, #8bc34a);
    border-radius: 4px;
    transition: width 0.3s ease;
}

/* Mobile Responsive */
@media (max-width: 767px) {
    .dl-section {
        padding: 3rem 0;
    }
    
    .bonus-section {
        padding: 2rem 1rem;
    }
    
    .bonus-item {
        padding: 1.5rem 1rem;
        margin-bottom: 1rem;
    }
    
    .action-container {
        padding: 2rem 1rem;
    }
    
    .form-group {
        gap: 1rem;
    }
    
    .email-input,
    .download-btn {
        padding: 1rem 1.5rem;
    }
    
    .line-btn {
        padding: 1.2rem 2rem;
        flex-direction: column;
        gap: 0.5rem;
    }
    
    .trust-indicators {
        grid-template-columns: 1fr;
        gap: 1rem;
        padding: 1.5rem;
    }
    
    .urgency-container {
        padding: 2rem 1rem;
    }
    
    .timer-display {
        gap: 0.5rem;
    }
    
    .timer-unit {
        min-width: 60px;
        padding: 0.8rem 0.5rem;
    }
    
    .timer-number {
        font-size: 1.5rem;
    }
    
    .value-text {
        flex-direction: column;
        gap: 0.5rem;
    }
}

/* Accessibility */
@media (prefers-reduced-motion: reduce) {
    .urgent-text,
    .bonus-item:hover,
    .download-btn:hover,
    .line-btn:hover {
        animation: none;
        transform: none;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Countdown Timer
    function updateCountdown() {
        const now = new Date().getTime();
        const endTime = now + (5 * 24 * 60 * 60 * 1000) + (12 * 60 * 60 * 1000) + (34 * 60 * 1000) + (56 * 1000); // 5 days, 12 hours, 34 minutes, 56 seconds from now
        
        const timeLeft = endTime - now;
        
        const days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
        const hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);
        
        document.getElementById('days').textContent = days.toString().padStart(2, '0');
        document.getElementById('hours').textContent = hours.toString().padStart(2, '0');
        document.getElementById('minutes').textContent = minutes.toString().padStart(2, '0');
        document.getElementById('seconds').textContent = seconds.toString().padStart(2, '0');
        
        if (timeLeft < 0) {
            document.getElementById('countdown-timer').innerHTML = '<p>キャンペーン終了</p>';
        }
    }
    
    // Update countdown every second
    updateCountdown();
    setInterval(updateCountdown, 1000);
    
    // Remaining counter animation
    function updateRemainingCount() {
        const counter = document.getElementById('remaining-count');
        const progressFill = document.querySelector('.progress-fill');
        
        if (counter && progressFill) {
            let count = parseInt(counter.textContent);
            if (count > 100) {
                count = Math.max(100, count - Math.floor(Math.random() * 3) - 1);
                counter.textContent = count;
                
                const percentage = ((1000 - count) / 1000) * 100;
                progressFill.style.width = percentage + '%';
            }
        }
    }
    
    // Update remaining count periodically
    setInterval(updateRemainingCount, 30000); // Every 30 seconds
    
    // Form submission
    const downloadForm = document.getElementById('download-form');
    if (downloadForm) {
        downloadForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const email = document.getElementById('email').value;
            const submitBtn = downloadForm.querySelector('.download-btn');
            const originalText = submitBtn.innerHTML;
            
            // Show loading state
            submitBtn.innerHTML = '<span class="btn-icon">⏳</span><span class="btn-text">送信中...</span>';
            submitBtn.disabled = true;
            
            // Simulate form submission (replace with actual form handling)
            setTimeout(function() {
                alert('ダウンロードリンクをメールでお送りしました！メールボックスをご確認ください。');
                
                // Reset button
                submitBtn.innerHTML = '<span class="btn-icon">✅</span><span class="btn-text">送信完了</span>';
                
                // Track conversion
                if (typeof gtag !== 'undefined') {
                    gtag('event', 'conversion', {
                        'event_category': 'Download',
                        'event_label': 'PostPilot Email Signup',
                        'value': 1
                    });
                }
                
                setTimeout(function() {
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                }, 3000);
            }, 2000);
        });
    }
});
</script>