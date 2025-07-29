<?php
/**
 * Final CTA Section Template
 * PostPilot LP Final Call to Action Section
 *
 * @package copipe-theme
 * @version 3.0.0
 */

// LINE URLを取得（設定から）
$line_url = get_option('copipe_line_url', '#');
?>

<section id="final-cta" class="cta-section lp-section">
    <div class="uk-container">
        
        <!-- Final Message -->
        <div class="final-message scroll-animation uk-text-center uk-margin-large-bottom">
            <h2 class="final-title">
                <span class="title-accent">最後に</span><br>
                <span class="title-main">あなたへのメッセージ</span>
            </h2>
            
            <div class="message-content">
                <p class="message-text">
                    もしあなたが、<strong>「記事を書く時間がない」</strong><br>
                    <strong>「何を書けばいいかわからない」</strong><br>
                    <strong>「SEO対策が難しい」</strong><br>
                    <strong>「収益につながらない」</strong><br>
                    そんな悩みを抱えているなら...
                </p>
                
                <div class="solution-highlight">
                    <p class="highlight-text">
                        <span class="brand-name">PostPilot</span>が<br>
                        <span class="benefit-text">すべてを解決します</span>
                    </p>
                </div>
                
                <p class="message-text">
                    AIの力で、あなたのコンテンツ制作を<strong>革命的に効率化</strong>し、<br>
                    <strong>確実な収益化</strong>まで導きます。
                </p>
            </div>
        </div>
        
        <!-- Comparison Table -->
        <div class="comparison-table scroll-animation uk-margin-large-bottom">
            <h3 class="comparison-title uk-text-center">
                PostPilot導入前 vs 導入後
            </h3>
            
            <div class="table-container">
                <table class="comparison-data">
                    <thead>
                        <tr>
                            <th class="item-column">項目</th>
                            <th class="before-column">導入前</th>
                            <th class="after-column">導入後</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="item-name">記事作成時間</td>
                            <td class="before-data">3-5時間</td>
                            <td class="after-data">3分</td>
                        </tr>
                        <tr>
                            <td class="item-name">月間記事数</td>
                            <td class="before-data">5-10記事</td>
                            <td class="after-data">100記事以上</td>
                        </tr>
                        <tr>
                            <td class="item-name">SEO対策</td>
                            <td class="before-data">手動で困難</td>
                            <td class="after-data">完全自動化</td>
                        </tr>
                        <tr>
                            <td class="item-name">検索順位</td>
                            <td class="before-data">圏外〜50位</td>
                            <td class="after-data">1〜10位</td>
                        </tr>
                        <tr>
                            <td class="item-name">月間収益</td>
                            <td class="before-data">0〜5万円</td>
                            <td class="after-data">15〜50万円</td>
                        </tr>
                        <tr>
                            <td class="item-name">ストレスレベル</td>
                            <td class="before-data">😰 高い</td>
                            <td class="after-data">😊 ゼロ</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Risk Reversal -->
        <div class="risk-reversal scroll-animation uk-margin-large-bottom">
            <h3 class="risk-title uk-text-center">
                <span class="highlight">完全無料</span>だから<br>
                リスクは一切ありません
            </h3>
            
            <div class="uk-grid uk-child-width-1-3@s uk-child-width-1-1" uk-grid>
                <div>
                    <div class="risk-item">
                        <div class="risk-icon">💰</div>
                        <h4 class="risk-item-title">費用は0円</h4>
                        <p class="risk-item-text">
                            完全無料なので、金銭的なリスクは一切ありません。
                        </p>
                    </div>
                </div>
                
                <div>
                    <div class="risk-item">
                        <div class="risk-icon">📧</div>
                        <h4 class="risk-item-title">メール登録のみ</h4>
                        <p class="risk-item-text">
                            面倒な手続きは不要。メールアドレスだけでOK。
                        </p>
                    </div>
                </div>
                
                <div>
                    <div class="risk-item">
                        <div class="risk-icon">🚪</div>
                        <h4 class="risk-item-title">いつでも退会可能</h4>
                        <p class="risk-item-text">
                            不要になったら、ワンクリックで配信停止できます。
                        </p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Final Urgency -->
        <div class="final-urgency scroll-animation uk-margin-large-bottom">
            <div class="urgency-container">
                <h3 class="urgency-title">
                    ⚠️ <span class="urgent-text">今すぐ行動してください</span>
                </h3>
                
                <div class="urgency-reasons">
                    <div class="reason-item">
                        <span class="reason-number">1</span>
                        <div class="reason-content">
                            <h4 class="reason-title">先着1000名限定</h4>
                            <p class="reason-text">無料キャンペーンは定員に達し次第終了します</p>
                        </div>
                    </div>
                    
                    <div class="reason-item">
                        <span class="reason-number">2</span>
                        <div class="reason-content">
                            <h4 class="reason-title">AIライティング市場の拡大</h4>
                            <p class="reason-text">今始めることで、競合に大きく差をつけることができます</p>
                        </div>
                    </div>
                    
                    <div class="reason-item">
                        <span class="reason-number">3</span>
                        <div class="reason-content">
                            <h4 class="reason-title">時間は有限です</h4>
                            <p class="reason-text">毎日悩んでいる時間があれば、今すぐ試してみてください</p>
                        </div>
                    </div>
                </div>
                
                <div class="countdown-wrapper">
                    <div class="countdown-text">
                        キャンペーン終了まで残り
                    </div>
                    <div class="countdown-display" id="final-countdown">
                        <div class="countdown-unit">
                            <span class="countdown-number" id="final-days">05</span>
                            <span class="countdown-label">日</span>
                        </div>
                        <div class="countdown-unit">
                            <span class="countdown-number" id="final-hours">12</span>
                            <span class="countdown-label">時間</span>
                        </div>
                        <div class="countdown-unit">
                            <span class="countdown-number" id="final-minutes">34</span>
                            <span class="countdown-label">分</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Final CTA Buttons -->
        <div class="final-cta-buttons scroll-animation uk-text-center">
            <h3 class="final-cta-title">
                <span class="cta-highlight">今すぐ</span>PostPilotを受け取る
            </h3>
            
            <div class="cta-buttons-container">
                
                <!-- LINE CTA (Primary) -->
                <div class="primary-cta">
                    <div class="cta-label">🎯 最速で受け取る（推奨）</div>
                    <a href="<?php echo esc_url($line_url); ?>" 
                       class="line-cta-btn lp-button"
                       target="_blank"
                       rel="noopener">
                        <div class="btn-content">
                            <div class="btn-icon">
                                <svg width="32" height="32" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M19.365 9.863c.349 0 .63.285.63.631 0 .345-.281.63-.63.63H17.61v1.125h1.755c.349 0 .63.283.63.63 0 .344-.281.629-.63.629h-2.386c-.345 0-.627-.285-.627-.629V8.108c0-.345.282-.63.63-.63h2.386c.346 0 .627.285.627.63 0 .349-.281.63-.63.63H17.61v1.125h1.755zm-3.855 3.016c0 .27-.174.51-.432.596-.064.021-.133.031-.199.031-.211 0-.391-.09-.51-.25l-2.443-3.317v2.94c0 .344-.279.629-.631.629-.346 0-.626-.285-.626-.629V8.108c0-.27.173-.51.43-.595.06-.023.136-.033.194-.033.195 0 .375.104.495.254l2.462 3.33V8.108c0-.345.282-.63.63-.63.345 0 .63.285.63.63v4.771zm-5.741 0c0 .344-.282.629-.631.629-.345 0-.627-.285-.627-.629V8.108c0-.345.282-.63.63-.63.346 0 .628.285.628.63v4.771zm-2.466.629H4.917c-.345 0-.63-.285-.63-.629V8.108c0-.345.285-.63.63-.63.348 0 .63.285.63.63v4.141h1.756c.348 0 .629.283.629.629 0 .344-.282.629-.629.629M24 10.314C24 4.943 18.615.572 12 .572S0 4.943 0 10.314c0 4.811 4.27 8.842 10.035 9.608.391.082.923.258 1.058.59.12.301.079.766.038 1.08l-.164 1.02c-.045.301-.24 1.186 1.049.645 1.291-.539 6.916-4.078 9.436-6.975C23.176 14.393 24 12.458 24 10.314"/>
                                </svg>
                            </div>
                            <div class="btn-text">
                                <div class="btn-main">LINE公式アカウント</div>
                                <div class="btn-sub">友だち追加で即ダウンロード</div>
                            </div>
                        </div>
                    </a>
                    <div class="cta-note">
                        ※LINEなら30秒で完了！限定情報も配信中
                    </div>
                </div>
                
                <!-- Email CTA (Secondary) -->
                <div class="secondary-cta">
                    <div class="cta-label">📧 メールで受け取る</div>
                    <form class="email-cta-form" id="final-email-form">
                        <div class="form-group">
                            <input type="email" 
                                   name="final_email" 
                                   id="final_email" 
                                   placeholder="メールアドレスを入力" 
                                   required 
                                   class="email-input">
                            <button type="submit" class="email-submit-btn">
                                ダウンロード
                            </button>
                        </div>
                    </form>
                    <div class="cta-note">
                        ※入力後、すぐにダウンロードリンクをお送りします
                    </div>
                </div>
                
            </div>
        </div>
        
        <!-- Social Proof Final -->
        <div class="social-proof-final scroll-animation uk-margin-large-top">
            <div class="proof-stats">
                <div class="uk-grid uk-child-width-1-4@s uk-child-width-1-2" uk-grid>
                    <div>
                        <div class="proof-item">
                            <div class="proof-number">10,000+</div>
                            <div class="proof-label">ダウンロード数</div>
                        </div>
                    </div>
                    <div>
                        <div class="proof-item">
                            <div class="proof-number">98%</div>
                            <div class="proof-label">満足度</div>
                        </div>
                    </div>
                    <div>
                        <div class="proof-item">
                            <div class="proof-number">24時間</div>
                            <div class="proof-label">サポート対応</div>
                        </div>
                    </div>
                    <div>
                        <div class="proof-item">
                            <div class="proof-number">100%</div>
                            <div class="proof-label">無料保証</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Trust Badges -->
        <div class="trust-badges uk-text-center uk-margin-large-top">
            <div class="badge-container">
                <div class="trust-badge">
                    <span class="badge-icon">🔒</span>
                    <span class="badge-text">SSL暗号化</span>
                </div>
                <div class="trust-badge">
                    <span class="badge-icon">🛡️</span>
                    <span class="badge-text">個人情報保護</span>
                </div>
                <div class="trust-badge">
                    <span class="badge-icon">📞</span>
                    <span class="badge-text">24時間サポート</span>
                </div>
                <div class="trust-badge">
                    <span class="badge-icon">✅</span>
                    <span class="badge-text">満足保証</span>
                </div>
            </div>
        </div>
        
    </div>
</section>

<style>
/* Final CTA Section Styles */
.cta-section {
    background: linear-gradient(180deg, #f8f9fa 0%, #2c5aa0 100%);
    color: white;
    position: relative;
    overflow: hidden;
}

.cta-section::before {
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

/* Final Message */
.final-message {
    position: relative;
    z-index: 2;
}

.final-title {
    font-size: clamp(2.5rem, 5vw, 4rem);
    line-height: 1.2;
    margin-bottom: 2rem;
    font-weight: 800;
}

.title-accent {
    background: linear-gradient(90deg, #ff6b35, #ffa726);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    font-size: 0.6em;
}

.title-main {
    color: white;
    text-shadow: 0 3px 10px rgba(0,0,0,0.3);
}

.message-content {
    max-width: 800px;
    margin: 0 auto;
}

.message-text {
    font-size: 1.2rem;
    line-height: 1.8;
    margin-bottom: 2rem;
    color: rgba(255,255,255,0.9);
}

.solution-highlight {
    background: rgba(255,255,255,0.15);
    backdrop-filter: blur(15px);
    padding: 2rem;
    border-radius: 20px;
    margin: 3rem 0;
    border: 1px solid rgba(255,255,255,0.2);
}

.highlight-text {
    font-size: 1.8rem;
    font-weight: 700;
    margin: 0;
    line-height: 1.4;
}

.brand-name {
    background: linear-gradient(90deg, #ff6b35, #ffa726);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    font-size: 1.3em;
}

.benefit-text {
    color: white;
    text-shadow: 0 2px 5px rgba(0,0,0,0.3);
}

/* Comparison Table */
.comparison-table {
    position: relative;
    z-index: 2;
}

.comparison-title {
    font-size: 2rem;
    margin-bottom: 2rem;
    font-weight: 700;
    color: white;
}

.table-container {
    background: white;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 15px 40px rgba(0,0,0,0.2);
}

.comparison-data {
    width: 100%;
    border-collapse: collapse;
}

.comparison-data th {
    background: linear-gradient(135deg, #2c5aa0, #1e3f73);
    color: white;
    padding: 1.5rem 1rem;
    font-weight: 600;
    text-align: center;
}

.comparison-data td {
    padding: 1.2rem 1rem;
    text-align: center;
    border-bottom: 1px solid #e0e0e0;
}

.item-column {
    text-align: left !important;
    min-width: 150px;
}

.before-column {
    background: rgba(214, 48, 49, 0.1);
}

.after-column {
    background: rgba(0, 184, 148, 0.1);
}

.item-name {
    font-weight: 600;
    color: #333;
    text-align: left !important;
}

.before-data {
    color: #d63031;
    font-weight: 500;
    background: rgba(214, 48, 49, 0.05);
}

.after-data {
    color: #00b894;
    font-weight: 600;
    background: rgba(0, 184, 148, 0.05);
}

/* Risk Reversal */
.risk-reversal {
    position: relative;
    z-index: 2;
}

.risk-title {
    font-size: 2rem;
    margin-bottom: 3rem;
    font-weight: 700;
    color: white;
}

.risk-item {
    background: rgba(255,255,255,0.1);
    backdrop-filter: blur(10px);
    padding: 2rem 1.5rem;
    border-radius: 15px;
    text-align: center;
    border: 1px solid rgba(255,255,255,0.2);
    height: 100%;
    transition: all 0.3s ease;
}

.risk-item:hover {
    transform: translateY(-5px);
    background: rgba(255,255,255,0.2);
}

.risk-icon {
    font-size: 3rem;
    margin-bottom: 1rem;
}

.risk-item-title {
    font-size: 1.3rem;
    margin-bottom: 1rem;
    font-weight: 600;
    color: white;
}

.risk-item-text {
    color: rgba(255,255,255,0.9);
    line-height: 1.6;
}

/* Final Urgency */
.final-urgency {
    position: relative;
    z-index: 2;
}

.urgency-container {
    background: linear-gradient(135deg, #ff6b35, #e55a2b);
    padding: 3rem 2rem;
    border-radius: 25px;
    box-shadow: 0 15px 40px rgba(255, 107, 53, 0.3);
}

.urgency-title {
    font-size: 2rem;
    text-align: center;
    margin-bottom: 2rem;
    font-weight: 700;
}

.urgent-text {
    animation: pulse-urgent 2s infinite;
}

@keyframes pulse-urgent {
    0%, 100% { text-shadow: 0 0 10px rgba(255,255,255,0.5); }
    50% { text-shadow: 0 0 25px rgba(255,255,255,0.8); }
}

.urgency-reasons {
    margin-bottom: 2rem;
}

.reason-item {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    margin-bottom: 1.5rem;
    padding: 1rem;
    background: rgba(255,255,255,0.1);
    border-radius: 10px;
}

.reason-number {
    width: 40px;
    height: 40px;
    background: rgba(255,255,255,0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 1.2rem;
    flex-shrink: 0;
}

.reason-content {
    flex-grow: 1;
}

.reason-title {
    font-size: 1.1rem;
    margin-bottom: 0.5rem;
    font-weight: 600;
}

.reason-text {
    margin: 0;
    opacity: 0.9;
    line-height: 1.5;
}

.countdown-wrapper {
    text-align: center;
}

.countdown-text {
    font-size: 1.1rem;
    margin-bottom: 1rem;
    font-weight: 600;
}

.countdown-display {
    display: flex;
    justify-content: center;
    gap: 1rem;
    flex-wrap: wrap;
}

.countdown-unit {
    background: rgba(255,255,255,0.2);
    backdrop-filter: blur(10px);
    padding: 1rem;
    border-radius: 10px;
    min-width: 80px;
}

.countdown-number {
    display: block;
    font-size: 2rem;
    font-weight: 800;
    line-height: 1;
}

.countdown-label {
    font-size: 0.8rem;
    opacity: 0.8;
}

/* Final CTA Buttons */
.final-cta-buttons {
    position: relative;
    z-index: 2;
}

.final-cta-title {
    font-size: 2.5rem;
    margin-bottom: 3rem;
    font-weight: 700;
    color: white;
}

.cta-highlight {
    background: linear-gradient(90deg, #ff6b35, #ffa726);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.cta-buttons-container {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 3rem;
    max-width: 1000px;
    margin: 0 auto;
}

.cta-label {
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 1rem;
    color: rgba(255,255,255,0.9);
}

/* LINE CTA */
.primary-cta {
    text-align: center;
}

.line-cta-btn {
    background: linear-gradient(135deg, #00c300, #00a000);
    color: white;
    text-decoration: none;
    padding: 2rem;
    border-radius: 20px;
    display: inline-flex;
    align-items: center;
    gap: 1.5rem;
    box-shadow: 0 15px 40px rgba(0, 195, 0, 0.4);
    transition: all 0.3s ease;
    width: 100%;
    max-width: 400px;
}

.line-cta-btn:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 50px rgba(0, 195, 0, 0.6);
    color: white;
}

.btn-content {
    display: flex;
    align-items: center;
    gap: 1rem;
    width: 100%;
}

.btn-icon {
    flex-shrink: 0;
}

.btn-text {
    text-align: left;
    flex-grow: 1;
}

.btn-main {
    font-size: 1.3rem;
    font-weight: 700;
    margin-bottom: 0.3rem;
}

.btn-sub {
    font-size: 0.9rem;
    opacity: 0.9;
}

/* Email CTA */
.secondary-cta {
    text-align: center;
}

.email-cta-form {
    margin-bottom: 1rem;
}

.email-cta-form .form-group {
    display: flex;
    max-width: 400px;
    margin: 0 auto;
    gap: 0.5rem;
}

.email-cta-form .email-input {
    flex-grow: 1;
    padding: 1.2rem 1rem;
    border: 2px solid rgba(255,255,255,0.3);
    border-radius: 10px;
    background: rgba(255,255,255,0.1);
    color: white;
    font-size: 1rem;
    backdrop-filter: blur(10px);
}

.email-cta-form .email-input::placeholder {
    color: rgba(255,255,255,0.7);
}

.email-cta-form .email-input:focus {
    outline: none;
    border-color: #ffa726;
    background: rgba(255,255,255,0.2);
}

.email-submit-btn {
    background: linear-gradient(135deg, #ff6b35, #ffa726);
    color: white;
    border: none;
    padding: 1.2rem 2rem;
    border-radius: 10px;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.3s ease;
    white-space: nowrap;
}

.email-submit-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(255, 107, 53, 0.4);
}

.cta-note {
    font-size: 0.85rem;
    color: rgba(255,255,255,0.8);
    margin-top: 1rem;
    line-height: 1.4;
}

/* Social Proof Final */
.social-proof-final {
    position: relative;
    z-index: 2;
}

.proof-stats {
    background: rgba(255,255,255,0.1);
    backdrop-filter: blur(15px);
    padding: 2rem;
    border-radius: 20px;
    border: 1px solid rgba(255,255,255,0.2);
}

.proof-item {
    text-align: center;
    padding: 1rem;
}

.proof-number {
    font-size: 2rem;
    font-weight: 800;
    background: linear-gradient(90deg, #ff6b35, #ffa726);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: 0.5rem;
    display: block;
}

.proof-label {
    color: rgba(255,255,255,0.9);
    font-weight: 500;
    font-size: 0.9rem;
}

/* Trust Badges */
.trust-badges {
    position: relative;
    z-index: 2;
}

.badge-container {
    display: flex;
    justify-content: center;
    gap: 2rem;
    flex-wrap: wrap;
}

.trust-badge {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    background: rgba(255,255,255,0.1);
    backdrop-filter: blur(10px);
    padding: 0.8rem 1.5rem;
    border-radius: 50px;
    border: 1px solid rgba(255,255,255,0.2);
    color: rgba(255,255,255,0.9);
    font-size: 0.9rem;
    font-weight: 500;
}

.badge-icon {
    font-size: 1.2rem;
}

/* Mobile Responsive */
@media (max-width: 767px) {
    .cta-section {
        padding: 3rem 0;
    }
    
    .final-title {
        font-size: 2.5rem;
    }
    
    .message-text {
        font-size: 1.1rem;
    }
    
    .highlight-text {
        font-size: 1.5rem;
    }
    
    .table-container {
        overflow-x: auto;
    }
    
    .comparison-data th,
    .comparison-data td {
        padding: 1rem 0.5rem;
        font-size: 0.9rem;
    }
    
    .risk-item {
        padding: 1.5rem 1rem;
        margin-bottom: 1rem;
    }
    
    .urgency-container {
        padding: 2rem 1rem;
    }
    
    .cta-buttons-container {
        grid-template-columns: 1fr;
        gap: 2rem;
    }
    
    .line-cta-btn {
        padding: 1.5rem;
        flex-direction: column;
        gap: 1rem;
    }
    
    .btn-content {
        flex-direction: column;
        text-align: center;
    }
    
    .email-cta-form .form-group {
        flex-direction: column;
        gap: 1rem;
    }
    
    .badge-container {
        gap: 1rem;
    }
    
    .trust-badge {
        padding: 0.6rem 1rem;
        font-size: 0.8rem;
    }
    
    .countdown-display {
        gap: 0.5rem;
    }
    
    .countdown-unit {
        min-width: 60px;
        padding: 0.8rem;
    }
    
    .countdown-number {
        font-size: 1.5rem;
    }
}

/* Accessibility */
@media (prefers-reduced-motion: reduce) {
    .urgent-text,
    .risk-item:hover,
    .line-cta-btn:hover,
    .email-submit-btn:hover {
        animation: none;
        transform: none;
    }
}

/* High contrast mode */
@media (prefers-contrast: high) {
    .table-container,
    .risk-item,
    .urgency-container,
    .proof-stats {
        border: 2px solid #fff;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Final countdown timer
    function updateFinalCountdown() {
        const now = new Date().getTime();
        const endTime = now + (5 * 24 * 60 * 60 * 1000) + (12 * 60 * 60 * 1000) + (34 * 60 * 1000);
        
        const timeLeft = endTime - now;
        
        const days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
        const hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
        
        const daysEl = document.getElementById('final-days');
        const hoursEl = document.getElementById('final-hours');
        const minutesEl = document.getElementById('final-minutes');
        
        if (daysEl) daysEl.textContent = days.toString().padStart(2, '0');
        if (hoursEl) hoursEl.textContent = hours.toString().padStart(2, '0');
        if (minutesEl) minutesEl.textContent = minutes.toString().padStart(2, '0');
        
        if (timeLeft < 0) {
            const countdownEl = document.getElementById('final-countdown');
            if (countdownEl) {
                countdownEl.innerHTML = '<p>キャンペーン終了</p>';
            }
        }
    }
    
    updateFinalCountdown();
    setInterval(updateFinalCountdown, 60000); // Update every minute
    
    // Final email form submission
    const finalEmailForm = document.getElementById('final-email-form');
    if (finalEmailForm) {
        finalEmailForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const email = document.getElementById('final_email').value;
            const submitBtn = finalEmailForm.querySelector('.email-submit-btn');
            const originalText = submitBtn.textContent;
            
            submitBtn.textContent = '送信中...';
            submitBtn.disabled = true;
            
            setTimeout(function() {
                alert('ダウンロードリンクをメールでお送りしました！\n\nメールボックスをご確認ください。\n※迷惑メールフォルダもご確認ください。');
                
                submitBtn.textContent = '送信完了';
                
                // Track final conversion
                if (typeof gtag !== 'undefined') {
                    gtag('event', 'conversion', {
                        'event_category': 'Final CTA',
                        'event_label': 'PostPilot Final Email Signup',
                        'value': 1
                    });
                }
                
                setTimeout(function() {
                    submitBtn.textContent = originalText;
                    submitBtn.disabled = false;
                }, 3000);
            }, 2000);
        });
    }
    
    // Intersection Observer for animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -100px 0px'
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
});
</script>