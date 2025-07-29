<?php
/**
 * The template for displaying AI Prompt posts
 *
 * @package copipe-theme
 * @version 3.0.0
 */

get_header(); ?>

<main id="primary" class="main-content">
    <div class="container">
        <div class="content-area">
            
            <?php while (have_posts()) : the_post(); ?>
                
                <article id="post-<?php the_ID(); ?>" <?php post_class('ai-prompt-post'); ?>>
                    
                    <header class="entry-header">
                        <div class="prompt-type-badge">
                            <span class="badge-icon">🤖</span>
                            <span class="badge-text">AIプロンプト</span>
                        </div>
                        
                        <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
                        
                        <div class="prompt-meta">
                            <div class="meta-grid">
                                <div class="meta-item">
                                    <span class="meta-label">公開日</span>
                                    <time class="meta-value" datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                                        <?php echo esc_html(get_the_date('Y年m月d日')); ?>
                                    </time>
                                </div>
                                
                                <div class="meta-item">
                                    <span class="meta-label">難易度</span>
                                    <span class="meta-value difficulty-<?php echo esc_attr(get_field('difficulty') ?: 'beginner'); ?>">
                                        <?php
                                        $difficulty = get_field('difficulty') ?: 'beginner';
                                        $difficulty_labels = array(
                                            'beginner' => '初級',
                                            'intermediate' => '中級',
                                            'advanced' => '上級'
                                        );
                                        echo esc_html($difficulty_labels[$difficulty] ?? '初級');
                                        ?>
                                    </span>
                                </div>
                                
                                <div class="meta-item">
                                    <span class="meta-label">用途</span>
                                    <span class="meta-value">
                                        <?php echo esc_html(get_field('use_case') ?: 'コンテンツ作成'); ?>
                                    </span>
                                </div>
                                
                                <div class="meta-item">
                                    <span class="meta-label">推定時間</span>
                                    <span class="meta-value">
                                        <?php echo esc_html(get_field('estimated_time') ?: '5分'); ?>
                                    </span>
                                </div>
                            </div>
                        </div><!-- .prompt-meta -->
                    </header><!-- .entry-header -->
                    
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="prompt-thumbnail">
                            <?php the_post_thumbnail('copipe-featured', array(
                                'alt' => the_title_attribute(array('echo' => false))
                            )); ?>
                        </div>
                    <?php endif; ?>
                    
                    <!-- Prompt Overview -->
                    <div class="prompt-overview">
                        <h2 class="overview-title">プロンプトの概要</h2>
                        <div class="overview-content">
                            <?php if (get_the_excerpt()) : ?>
                                <p class="prompt-description"><?php the_excerpt(); ?></p>
                            <?php endif; ?>
                            
                            <?php if (get_field('prompt_benefits')) : ?>
                                <div class="prompt-benefits">
                                    <h3>このプロンプトで得られること</h3>
                                    <ul class="benefits-list">
                                        <?php
                                        $benefits = get_field('prompt_benefits');
                                        if (is_array($benefits)) :
                                            foreach ($benefits as $benefit) :
                                        ?>
                                            <li>✅ <?php echo esc_html($benefit['benefit']); ?></li>
                                        <?php
                                            endforeach;
                                        else :
                                            // テキストエリアの場合の処理
                                            $benefits_array = explode("\n", $benefits);
                                            foreach ($benefits_array as $benefit) :
                                                if (trim($benefit)) :
                                        ?>
                                            <li>✅ <?php echo esc_html(trim($benefit)); ?></li>
                                        <?php
                                                endif;
                                            endforeach;
                                        endif;
                                        ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <!-- Main Prompt -->
                    <div class="main-prompt-section">
                        <h2 class="prompt-section-title">
                            <span class="section-icon">🎯</span>
                            メインプロンプト
                        </h2>
                        
                        <?php if (get_field('main_prompt')) : ?>
                            <div class="prompt-container">
                                <div class="prompt-header">
                                    <div class="prompt-label">
                                        <span class="prompt-icon">💬</span>
                                        <span>コピーして使用してください</span>
                                    </div>
                                    <button class="copy-btn" onclick="copyPrompt('main-prompt')">
                                        <span class="copy-icon">📋</span>
                                        <span class="copy-text">コピー</span>
                                    </button>
                                </div>
                                <div class="prompt-content" id="main-prompt">
                                    <?php echo nl2br(esc_html(get_field('main_prompt'))); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Usage Instructions -->
                    <div class="usage-instructions">
                        <h2 class="prompt-section-title">
                            <span class="section-icon">📖</span>
                            使用方法
                        </h2>
                        
                        <div class="instructions-content">
                            <?php if (get_field('usage_steps')) : ?>
                                <div class="usage-steps">
                                    <?php
                                    $steps = get_field('usage_steps');
                                    if (is_array($steps)) :
                                        $step_number = 1;
                                        foreach ($steps as $step) :
                                    ?>
                                        <div class="usage-step">
                                            <div class="step-number"><?php echo $step_number; ?></div>
                                            <div class="step-content">
                                                <h4 class="step-title"><?php echo esc_html($step['step_title']); ?></h4>
                                                <p class="step-description"><?php echo esc_html($step['step_description']); ?></p>
                                            </div>
                                        </div>
                                    <?php
                                        $step_number++;
                                        endforeach;
                                    endif;
                                    ?>
                                </div>
                            <?php else : ?>
                                <div class="default-instructions">
                                    <div class="usage-step">
                                        <div class="step-number">1</div>
                                        <div class="step-content">
                                            <h4 class="step-title">プロンプトをコピー</h4>
                                            <p class="step-description">上記のメインプロンプトをコピーボタンでコピーしてください。</p>
                                        </div>
                                    </div>
                                    <div class="usage-step">
                                        <div class="step-number">2</div>
                                        <div class="step-content">
                                            <h4 class="step-title">AIツールに貼り付け</h4>
                                            <p class="step-description">ChatGPTやClaude、Geminiなどのお好みのAIツールに貼り付けてください。</p>
                                        </div>
                                    </div>
                                    <div class="usage-step">
                                        <div class="step-number">3</div>
                                        <div class="step-content">
                                            <h4 class="step-title">実行して結果を確認</h4>
                                            <p class="step-description">プロンプトを実行し、出力された結果を確認してください。</p>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <!-- Example Output -->
                    <?php if (get_field('example_output')) : ?>
                        <div class="example-output-section">
                            <h2 class="prompt-section-title">
                                <span class="section-icon">💡</span>
                                出力例
                            </h2>
                            
                            <div class="example-container">
                                <div class="example-header">
                                    <span class="example-label">実際の出力例</span>
                                </div>
                                <div class="example-content">
                                    <?php echo nl2br(esc_html(get_field('example_output'))); ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                    <!-- Tips and Notes -->
                    <?php if (get_field('tips_and_notes')) : ?>
                        <div class="tips-section">
                            <h2 class="prompt-section-title">
                                <span class="section-icon">💡</span>
                                コツ・注意点
                            </h2>
                            
                            <div class="tips-content">
                                <?php echo wpautop(esc_html(get_field('tips_and_notes'))); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                    <!-- Variations -->
                    <?php if (get_field('prompt_variations')) : ?>
                        <div class="variations-section">
                            <h2 class="prompt-section-title">
                                <span class="section-icon">🔄</span>
                                バリエーション
                            </h2>
                            
                            <div class="variations-grid">
                                <?php
                                $variations = get_field('prompt_variations');
                                if (is_array($variations)) :
                                    foreach ($variations as $index => $variation) :
                                ?>
                                    <div class="variation-item">
                                        <div class="variation-header">
                                            <h4 class="variation-title"><?php echo esc_html($variation['variation_title']); ?></h4>
                                            <button class="copy-btn small" onclick="copyPrompt('variation-<?php echo $index; ?>')">
                                                <span class="copy-icon">📋</span>
                                            </button>
                                        </div>
                                        <div class="variation-description">
                                            <?php echo esc_html($variation['variation_description']); ?>
                                        </div>
                                        <div class="variation-prompt" id="variation-<?php echo $index; ?>">
                                            <?php echo nl2br(esc_html($variation['variation_prompt'])); ?>
                                        </div>
                                    </div>
                                <?php
                                    endforeach;
                                endif;
                                ?>
                            </div>
                        </div>
                    <?php endif; ?>
                    
                    <div class="entry-content">
                        <?php
                        the_content(sprintf(
                            wp_kses(
                                __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'copipe-theme'),
                                array(
                                    'span' => array(
                                        'class' => array(),
                                    ),
                                )
                            ),
                            wp_kses_post(get_the_title())
                        ));
                        
                        wp_link_pages(array(
                            'before' => '<div class="page-links">' . esc_html__('Pages:', 'copipe-theme'),
                            'after'  => '</div>',
                        ));
                        ?>
                    </div><!-- .entry-content -->
                    
                    <footer class="entry-footer">
                        <?php
                        $tags = get_the_tags();
                        if (!empty($tags)) :
                        ?>
                            <div class="tag-cloud">
                                <h3 class="tags-title">関連タグ</h3>
                                <div class="tag-list">
                                    <?php
                                    foreach ($tags as $tag) {
                                        echo '<a href="' . esc_url(get_tag_link($tag->term_id)) . '" class="tag-item">' . esc_html($tag->name) . '</a>';
                                    }
                                    ?>
                                </div>
                            </div>
                        <?php endif; ?>
                        
                        <!-- Social Share -->
                        <div class="social-share">
                            <h3 class="share-title">このプロンプトをシェア</h3>
                            <div class="share-buttons">
                                <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title() . ' - 便利なAIプロンプト'); ?>" 
                                   target="_blank" 
                                   rel="noopener"
                                   class="share-btn twitter">
                                    <span class="share-icon">🐦</span>
                                    <span class="share-text">Twitter</span>
                                </a>
                                
                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" 
                                   target="_blank" 
                                   rel="noopener"
                                   class="share-btn facebook">
                                    <span class="share-icon">📘</span>
                                    <span class="share-text">Facebook</span>
                                </a>
                                
                                <a href="https://social-plugins.line.me/lineit/share?url=<?php echo urlencode(get_permalink()); ?>" 
                                   target="_blank" 
                                   rel="noopener"
                                   class="share-btn line">
                                    <span class="share-icon">💬</span>
                                    <span class="share-text">LINE</span>
                                </a>
                                
                                <button class="share-btn copy-url" onclick="copyURL()">
                                    <span class="share-icon">📋</span>
                                    <span class="share-text">URLコピー</span>
                                </button>
                            </div>
                        </div>
                    </footer><!-- .entry-footer -->
                    
                </article><!-- #post-<?php the_ID(); ?> -->
                
                <!-- Related Prompts -->
                <?php
                $related_prompts = copipe_get_related_ai_prompts(get_the_ID(), 3);
                if (!empty($related_prompts)) :
                ?>
                    <div class="related-prompts">
                        <h3 class="related-title">関連するAIプロンプト</h3>
                        <div class="related-prompts-grid">
                            <?php foreach ($related_prompts as $related_prompt) : ?>
                                <article class="related-prompt-item">
                                    <a href="<?php echo esc_url(get_permalink($related_prompt->ID)); ?>" class="related-prompt-link">
                                        <div class="related-prompt-header">
                                            <span class="prompt-badge">🤖 AIプロンプト</span>
                                            <span class="difficulty-badge difficulty-<?php echo esc_attr(get_field('difficulty', $related_prompt->ID) ?: 'beginner'); ?>">
                                                <?php
                                                $difficulty = get_field('difficulty', $related_prompt->ID) ?: 'beginner';
                                                $difficulty_labels = array(
                                                    'beginner' => '初級',
                                                    'intermediate' => '中級',
                                                    'advanced' => '上級'
                                                );
                                                echo esc_html($difficulty_labels[$difficulty] ?? '初級');
                                                ?>
                                            </span>
                                        </div>
                                        
                                        <?php if (has_post_thumbnail($related_prompt->ID)) : ?>
                                            <div class="related-prompt-thumbnail">
                                                <?php echo get_the_post_thumbnail($related_prompt->ID, 'copipe-thumbnail'); ?>
                                            </div>
                                        <?php endif; ?>
                                        
                                        <div class="related-prompt-content">
                                            <h4 class="related-prompt-title">
                                                <?php echo esc_html(get_the_title($related_prompt->ID)); ?>
                                            </h4>
                                            <div class="related-prompt-meta">
                                                <span class="use-case">
                                                    📝 <?php echo esc_html(get_field('use_case', $related_prompt->ID) ?: 'コンテンツ作成'); ?>
                                                </span>
                                                <span class="estimated-time">
                                                    ⏱️ <?php echo esc_html(get_field('estimated_time', $related_prompt->ID) ?: '5分'); ?>
                                                </span>
                                            </div>
                                        </div>
                                    </a>
                                </article>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
                
                <!-- CTA to PostPilot -->
                <div class="postpilot-cta">
                    <div class="cta-content">
                        <h3 class="cta-title">
                            <span class="cta-icon">🚀</span>
                            もっと高度なAIライティングをお求めですか？
                        </h3>
                        <p class="cta-description">
                            PostPilotなら、このようなプロンプトを自動で生成し、さらに高品質な記事まで一気に作成できます。
                        </p>
                        <a href="/postpilot" class="cta-button">
                            PostPilotを無料で試す
                        </a>
                    </div>
                </div>
                
                <!-- Post Navigation -->
                <nav class="post-navigation" aria-label="AIプロンプトナビゲーション">
                    <div class="nav-links">
                        <?php
                        $prev_post = get_previous_post();
                        $next_post = get_next_post();
                        ?>
                        
                        <?php if ($prev_post) : ?>
                            <div class="nav-previous">
                                <a href="<?php echo esc_url(get_permalink($prev_post->ID)); ?>" class="nav-link">
                                    <div class="nav-direction">← 前のプロンプト</div>
                                    <div class="nav-title"><?php echo esc_html(get_the_title($prev_post->ID)); ?></div>
                                </a>
                            </div>
                        <?php endif; ?>
                        
                        <?php if ($next_post) : ?>
                            <div class="nav-next">
                                <a href="<?php echo esc_url(get_permalink($next_post->ID)); ?>" class="nav-link">
                                    <div class="nav-direction">次のプロンプト →</div>
                                    <div class="nav-title"><?php echo esc_html(get_the_title($next_post->ID)); ?></div>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </nav><!-- .post-navigation -->
                
                <?php
                // If comments are open or we have at least one comment, load up the comment template.
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif;
                ?>
                
            <?php endwhile; // End of the loop. ?>
            
        </div><!-- .content-area -->
        
        <aside id="secondary" class="widget-area">
            <!-- Custom AI Prompt Sidebar -->
            <div class="widget ai-prompt-widget">
                <h3 class="widget-title">AIプロンプト活用Tips</h3>
                <div class="widget-content">
                    <ul class="tips-list">
                        <li>🎯 具体的な指示で精度向上</li>
                        <li>🔄 複数回試して最適化</li>
                        <li>📝 出力を元に追加質問</li>
                        <li>⚡ 短いプロンプトから開始</li>
                    </ul>
                </div>
            </div>
            
            <?php dynamic_sidebar('sidebar-1'); ?>
        </aside><!-- #secondary -->
        
    </div><!-- .container -->
</main><!-- #primary -->

<style>
/* AI Prompt Post Styles */
.ai-prompt-post {
    background: white;
    border-radius: 15px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    overflow: hidden;
    margin-bottom: 3rem;
}

/* Prompt Type Badge */
.prompt-type-badge {
    background: linear-gradient(135deg, #2c5aa0, #ff6b35);
    color: white;
    padding: 0.8rem 2rem;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    border-radius: 0 0 15px 0;
    font-weight: 600;
    margin-bottom: 2rem;
}

.badge-icon {
    font-size: 1.2rem;
}

/* Entry Header */
.ai-prompt-post .entry-header {
    padding: 2rem 2.5rem 1.5rem;
}

.ai-prompt-post .entry-title {
    font-size: clamp(1.8rem, 4vw, 2.5rem);
    line-height: 1.3;
    color: #2c5aa0;
    margin-bottom: 2rem;
    font-weight: 700;
}

/* Prompt Meta */
.prompt-meta {
    background: #f8f9fa;
    padding: 1.5rem;
    border-radius: 10px;
    margin-bottom: 2rem;
}

.meta-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
}

.meta-item {
    background: white;
    padding: 1rem;
    border-radius: 8px;
    text-align: center;
}

.meta-label {
    display: block;
    font-size: 0.8rem;
    color: #666;
    margin-bottom: 0.5rem;
    text-transform: uppercase;
    font-weight: 600;
}

.meta-value {
    display: block;
    font-size: 1rem;
    font-weight: 600;
    color: #333;
}

.difficulty-beginner {
    color: #00c851;
}

.difficulty-intermediate {
    color: #ff6b35;
}

.difficulty-advanced {
    color: #d63031;
}

/* Prompt Thumbnail */
.prompt-thumbnail {
    margin: 0 2.5rem 2rem;
    border-radius: 10px;
    overflow: hidden;
}

.prompt-thumbnail img {
    width: 100%;
    max-height: 300px;
    object-fit: cover;
}

/* Section Styles */
.prompt-overview,
.main-prompt-section,
.usage-instructions,
.example-output-section,
.tips-section,
.variations-section {
    padding: 0 2.5rem;
    margin-bottom: 3rem;
}

.overview-title,
.prompt-section-title {
    color: #2c5aa0;
    font-size: 1.8rem;
    margin-bottom: 1.5rem;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.section-icon {
    font-size: 1.5rem;
}

/* Overview Content */
.overview-content {
    background: #f8f9fa;
    padding: 2rem;
    border-radius: 15px;
}

.prompt-description {
    font-size: 1.2rem;
    line-height: 1.6;
    color: #555;
    margin-bottom: 2rem;
    text-align: center;
}

.prompt-benefits h3 {
    color: #2c5aa0;
    margin-bottom: 1rem;
}

.benefits-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.benefits-list li {
    padding: 0.5rem 0;
    color: #333;
    font-weight: 500;
}

/* Prompt Container */
.prompt-container,
.example-container {
    background: #2d3748;
    border-radius: 15px;
    overflow: hidden;
    margin: 1rem 0;
}

.prompt-header,
.example-header {
    background: #1a202c;
    padding: 1rem 1.5rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.prompt-label,
.example-label {
    color: #e2e8f0;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.prompt-icon {
    font-size: 1.1rem;
}

.copy-btn {
    background: linear-gradient(135deg, #2c5aa0, #ff6b35);
    color: white;
    border: none;
    padding: 0.5rem 1rem;
    border-radius: 8px;
    cursor: pointer;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 0.3rem;
    transition: all 0.3s ease;
}

.copy-btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.3);
}

.copy-btn.small {
    padding: 0.3rem 0.6rem;
    font-size: 0.8rem;
}

.prompt-content,
.example-content {
    padding: 2rem;
    color: #e2e8f0;
    font-family: 'Courier New', monospace;
    line-height: 1.8;
    white-space: pre-wrap;
    background: #2d3748;
}

/* Usage Steps */
.usage-steps,
.default-instructions {
    margin: 1rem 0;
}

.usage-step {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    margin-bottom: 2rem;
    padding: 1.5rem;
    background: #f8f9fa;
    border-radius: 15px;
}

.step-number {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, #2c5aa0, #ff6b35);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 1.2rem;
    flex-shrink: 0;
}

.step-content {
    flex: 1;
}

.step-title {
    color: #2c5aa0;
    font-size: 1.2rem;
    margin-bottom: 0.5rem;
    font-weight: 600;
}

.step-description {
    color: #555;
    line-height: 1.6;
    margin: 0;
}

/* Tips Content */
.tips-content {
    background: linear-gradient(135deg, #fff3cd, #ffeaa7);
    padding: 2rem;
    border-radius: 15px;
    border-left: 4px solid #ffa726;
}

.tips-content p {
    color: #856404;
    line-height: 1.7;
    margin-bottom: 1rem;
}

.tips-content p:last-child {
    margin-bottom: 0;
}

/* Variations */
.variations-grid {
    display: grid;
    gap: 2rem;
}

.variation-item {
    background: #f8f9fa;
    border-radius: 15px;
    overflow: hidden;
}

.variation-header {
    background: #e9ecef;
    padding: 1rem 1.5rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.variation-title {
    color: #2c5aa0;
    font-size: 1.1rem;
    margin: 0;
    font-weight: 600;
}

.variation-description {
    padding: 1rem 1.5rem;
    color: #555;
    line-height: 1.6;
    border-bottom: 1px solid #dee2e6;
}

.variation-prompt {
    padding: 1.5rem;
    background: #2d3748;
    color: #e2e8f0;
    font-family: 'Courier New', monospace;
    line-height: 1.6;
    white-space: pre-wrap;
}

/* Related Prompts */
.related-prompts {
    background: #f8f9fa;
    padding: 2rem;
    border-radius: 15px;
    margin-bottom: 3rem;
}

.related-title {
    color: #2c5aa0;
    font-size: 1.5rem;
    margin-bottom: 1.5rem;
    font-weight: 600;
    text-align: center;
}

.related-prompts-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 1.5rem;
}

.related-prompt-item {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    transition: all 0.3s ease;
}

.related-prompt-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

.related-prompt-link {
    display: block;
    text-decoration: none;
    color: inherit;
}

.related-prompt-header {
    padding: 1rem;
    background: #f8f9fa;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.prompt-badge {
    background: linear-gradient(135deg, #2c5aa0, #ff6b35);
    color: white;
    padding: 0.3rem 0.8rem;
    border-radius: 15px;
    font-size: 0.8rem;
    font-weight: 500;
}

.difficulty-badge {
    padding: 0.3rem 0.8rem;
    border-radius: 15px;
    font-size: 0.8rem;
    font-weight: 500;
    color: white;
}

.difficulty-badge.difficulty-beginner {
    background: #00c851;
}

.difficulty-badge.difficulty-intermediate {
    background: #ff6b35;
}

.difficulty-badge.difficulty-advanced {
    background: #d63031;
}

.related-prompt-thumbnail {
    height: 150px;
    overflow: hidden;
}

.related-prompt-thumbnail img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.related-prompt-item:hover .related-prompt-thumbnail img {
    transform: scale(1.05);
}

.related-prompt-content {
    padding: 1.5rem;
}

.related-prompt-title {
    color: #2c5aa0;
    font-size: 1.1rem;
    line-height: 1.4;
    margin-bottom: 1rem;
    font-weight: 600;
}

.related-prompt-meta {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
    font-size: 0.9rem;
    color: #666;
}

/* PostPilot CTA */
.postpilot-cta {
    background: linear-gradient(135deg, #2c5aa0, #1e3f73);
    color: white;
    padding: 3rem 2rem;
    border-radius: 20px;
    text-align: center;
    margin-bottom: 3rem;
    position: relative;
    overflow: hidden;
}

.postpilot-cta::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-image: 
        radial-gradient(circle at 30% 30%, rgba(255, 107, 53, 0.1) 0%, transparent 50%);
}

.cta-content {
    position: relative;
    z-index: 2;
}

.cta-title {
    font-size: 1.8rem;
    margin-bottom: 1rem;
    font-weight: 700;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}

.cta-icon {
    font-size: 1.5rem;
}

.cta-description {
    font-size: 1.1rem;
    margin-bottom: 2rem;
    opacity: 0.9;
    line-height: 1.6;
}

.cta-button {
    background: linear-gradient(135deg, #ff6b35, #ffa726);
    color: white;
    text-decoration: none;
    padding: 1.2rem 2.5rem;
    border-radius: 50px;
    font-weight: 700;
    font-size: 1.1rem;
    transition: all 0.3s ease;
    display: inline-block;
}

.cta-button:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(255, 107, 53, 0.4);
    color: white;
}

/* AI Prompt Widget */
.ai-prompt-widget {
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    border: 2px solid #2c5aa0;
}

.ai-prompt-widget .widget-title {
    background: #2c5aa0;
    color: white;
    margin: -1.5rem -1.5rem 1rem -1.5rem;
    padding: 1rem 1.5rem;
}

.tips-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.tips-list li {
    padding: 0.8rem 0;
    border-bottom: 1px solid #dee2e6;
    color: #333;
    font-weight: 500;
}

.tips-list li:last-child {
    border-bottom: none;
}

/* Mobile Responsive */
@media (max-width: 767px) {
    .ai-prompt-post .entry-header {
        padding: 1.5rem 1.5rem 1rem;
    }
    
    .prompt-overview,
    .main-prompt-section,
    .usage-instructions,
    .example-output-section,
    .tips-section,
    .variations-section {
        padding: 0 1.5rem;
    }
    
    .prompt-thumbnail {
        margin: 0 1.5rem 2rem;
    }
    
    .meta-grid {
        grid-template-columns: 1fr;
    }
    
    .overview-content,
    .usage-step,
    .tips-content {
        padding: 1.5rem;
    }
    
    .prompt-content,
    .example-content,
    .variation-prompt {
        padding: 1rem;
        font-size: 0.9rem;
    }
    
    .usage-step {
        flex-direction: column;
        gap: 1rem;
    }
    
    .step-number {
        width: 50px;
        height: 50px;
        align-self: center;
    }
    
    .related-prompts-grid {
        grid-template-columns: 1fr;
    }
    
    .postpilot-cta {
        padding: 2rem 1rem;
    }
    
    .cta-title {
        font-size: 1.5rem;
        flex-direction: column;
    }
}

/* Copy Success Animation */
@keyframes copySuccess {
    0% { transform: scale(1); }
    50% { transform: scale(1.1); }
    100% { transform: scale(1); }
}

.copy-btn.success {
    animation: copySuccess 0.3s ease;
}
</style>

<script>
// Copy prompt function
function copyPrompt(elementId) {
    const element = document.getElementById(elementId);
    const text = element.textContent || element.innerText;
    
    navigator.clipboard.writeText(text).then(function() {
        // Find the copy button for this element
        const copyBtn = element.closest('.prompt-container, .variation-item').querySelector('.copy-btn');
        const originalText = copyBtn.querySelector('.copy-text').textContent;
        
        // Show success state
        copyBtn.classList.add('success');
        copyBtn.querySelector('.copy-text').textContent = 'コピー完了！';
        copyBtn.querySelector('.copy-icon').textContent = '✅';
        
        // Reset after 2 seconds
        setTimeout(function() {
            copyBtn.classList.remove('success');
            copyBtn.querySelector('.copy-text').textContent = originalText;
            copyBtn.querySelector('.copy-icon').textContent = '📋';
        }, 2000);
    }).catch(function() {
        // Fallback for older browsers
        const textArea = document.createElement('textarea');
        textArea.value = text;
        document.body.appendChild(textArea);
        textArea.select();
        document.execCommand('copy');
        document.body.removeChild(textArea);
        
        // Show success message
        alert('プロンプトをクリップボードにコピーしました！');
    });
}

// Copy URL function
function copyURL() {
    const url = window.location.href;
    navigator.clipboard.writeText(url).then(function() {
        const btn = document.querySelector('.copy-url .share-text');
        const originalText = btn.textContent;
        btn.textContent = 'コピー完了！';
        
        setTimeout(function() {
            btn.textContent = originalText;
        }, 2000);
    }).catch(function() {
        // Fallback for older browsers
        const textArea = document.createElement('textarea');
        textArea.value = url;
        document.body.appendChild(textArea);
        textArea.select();
        document.execCommand('copy');
        document.body.removeChild(textArea);
        
        const btn = document.querySelector('.copy-url .share-text');
        const originalText = btn.textContent;
        btn.textContent = 'コピー完了！';
        
        setTimeout(function() {
            btn.textContent = originalText;
        }, 2000);
    });
}
</script>

<?php
get_footer();

// Helper function for related AI prompts
function copipe_get_related_ai_prompts($post_id, $limit = 3) {
    $categories = wp_get_post_categories($post_id);
    
    if (empty($categories)) {
        return array();
    }
    
    $args = array(
        'post_type' => 'ai_prompt',
        'category__in' => $categories,
        'post__not_in' => array($post_id),
        'posts_per_page' => $limit,
        'orderby' => 'rand'
    );
    
    $related_prompts = get_posts($args);
    
    // If no related prompts found, get random prompts
    if (empty($related_prompts)) {
        $args = array(
            'post_type' => 'ai_prompt',
            'post__not_in' => array($post_id),
            'posts_per_page' => $limit,
            'orderby' => 'rand'
        );
        
        $related_prompts = get_posts($args);
    }
    
    return $related_prompts;
}
?>