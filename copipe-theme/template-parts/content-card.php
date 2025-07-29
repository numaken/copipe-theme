<?php
/**
 * template-parts/content-card.php
 * カード形式記事表示テンプレート（改善版）
 * 
 * @package Copipe_Theme
 */

if (!defined('ABSPATH')) {
    exit;
}

$post_id = get_the_ID();
$post_type = get_post_type();
$is_copipe = in_category('copipe', $post_id);
?>

<article <?php post_class('copipe-card uk-card uk-card-default uk-card-hover uk-transition-toggle'); ?> id="post-<?php echo $post_id; ?>">
    
    <!-- カード画像 -->
    <?php if (has_post_thumbnail()) : ?>
        <div class="uk-card-media-top uk-cover-container uk-height-small">
            <a href="<?php the_permalink(); ?>" class="uk-link-reset" aria-label="<?php echo esc_attr(get_the_title()); ?>">
                <?php 
                the_post_thumbnail('copipe-thumbnail', [
                    'class' => 'uk-cover',
                    'uk-cover' => true,
                    'loading' => 'lazy',
                    'alt' => get_the_title()
                ]); 
                ?>
            </a>
            
            <!-- カテゴリバッジ（画像上） -->
            <div class="copipe-card-badges uk-position-top-right uk-margin-small">
                <?php if ($is_copipe) : ?>
                    <span class="uk-label uk-label-success">
                        <span uk-icon="icon:code;ratio:0.8"></span>
                        <?php _e('スニペット', 'copipe-theme'); ?>
                    </span>
                <?php endif; ?>
                
                <?php
                $difficulty = get_post_meta($post_id, 'copipe_difficulty', true);
                if ($difficulty) :
                    $difficulty_labels = [
                        'beginner' => ['label' => __('初級', 'copipe-theme'), 'class' => 'uk-label-success'],
                        'intermediate' => ['label' => __('中級', 'copipe-theme'), 'class' => 'uk-label-warning'],
                        'advanced' => ['label' => __('上級', 'copipe-theme'), 'class' => 'uk-label-danger']
                    ];
                    
                    if (isset($difficulty_labels[$difficulty])) :
                ?>
                    <span class="uk-label <?php echo esc_attr($difficulty_labels[$difficulty]['class']); ?> uk-margin-small-left">
                        <?php echo esc_html($difficulty_labels[$difficulty]['label']); ?>
                    </span>
                <?php endif; endif; ?>
            </div>
            
            <!-- ビデオ/ライブバッジ -->
            <?php if (get_post_format() === 'video') : ?>
                <div class="uk-position-center">
                    <span uk-icon="icon:play-circle;ratio:3" class="uk-text-white uk-drop-shadow"></span>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>
    
    <div class="uk-card-body">
        
        <!-- カテゴリ表示（画像がない場合） -->
        <?php if (!has_post_thumbnail()) : ?>
            <div class="copipe-card-categories uk-margin-small-bottom">
                <?php
                $categories = get_the_category();
                if (!empty($categories)) :
                    foreach (array_slice($categories, 0, 2) as $category) :
                ?>
                    <a href="<?php echo esc_url(get_category_link($category)); ?>" 
                       class="uk-label uk-label-default uk-margin-small-right">
                        <?php echo esc_html($category->name); ?>
                    </a>
                <?php 
                    endforeach;
                endif; 
                ?>
            </div>
        <?php endif; ?>
        
        <!-- タイトル -->
        <h2 class="uk-card-title uk-margin-small-bottom">
            <a href="<?php the_permalink(); ?>" class="uk-link-reset uk-transition-fade">
                <?php the_title(); ?>
            </a>
        </h2>
        
        <!-- メタ情報 -->
        <div class="copipe-card-meta uk-text-meta uk-margin-small-bottom">
            <div class="uk-grid-small uk-flex-middle" uk-grid>
                <div class="uk-width-auto">
                    <time datetime="<?php echo get_the_date('c'); ?>">
                        <span uk-icon="icon:calendar;ratio:0.8"></span>
                        <?php echo get_the_date(); ?>
                    </time>
                </div>
                
                <?php if (get_the_modified_time('U') !== get_the_time('U')) : ?>
                    <div class="uk-width-auto">
                        <time datetime="<?php echo get_the_modified_date('c'); ?>" class="uk-text-warning">
                            <span uk-icon="icon:refresh;ratio:0.8"></span>
                            <?php echo get_the_modified_date(); ?>
                        </time>
                    </div>
                <?php endif; ?>
                
                <!-- 読了時間 -->
                <div class="uk-width-auto">
                    <?php copipe_display_reading_time($post_id); ?>
                </div>
                
                <!-- ビュー数 -->
                <?php 
                $view_count = get_post_meta($post_id, 'copipe_view_count', true);
                if ($view_count) :
                ?>
                    <div class="uk-width-auto">
                        <span uk-icon="icon:eye;ratio:0.8"></span>
                        <?php echo number_format_i18n($view_count); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- コンテンツプレビュー -->
        <div class="copipe-card-content">
            <?php if ($is_copipe) : ?>
                
                <!-- コードプレビュー -->
                <?php
                $content = get_the_content();
                if (preg_match('/```(\w+)?\s*(.*?)\s*```/s', $content, $matches)) :
                    $language = !empty($matches[1]) ? $matches[1] : 'php';
                    $code = trim($matches[2]);
                    
                    // 最初の4行のみ表示
                    $lines = explode("\n", $code);
                    $preview_lines = array_slice($lines, 0, 4);
                    $preview_code = implode("\n", $preview_lines);
                    
                    if (count($lines) > 4) {
                        $preview_code .= "\n// ...";
                    }
                ?>
                    <div class="copipe-code-preview uk-margin-small-bottom">
                        <pre class="language-<?php echo esc_attr($language); ?> uk-margin-remove"><code><?php echo esc_html($preview_code); ?></code></pre>
                        
                        <div class="copipe-code-overlay">
                            <button class="uk-button uk-button-primary uk-button-small" onclick="location.href='<?php the_permalink(); ?>'">
                                <span uk-icon="icon:code"></span>
                                <?php _e('コードを見る', 'copipe-theme'); ?>
                            </button>
                        </div>
                    </div>
                <?php else : ?>
                    <!-- 通常の抜粋 -->
                    <div class="copipe-card-excerpt uk-text-small">
                        <?php echo copipe_custom_excerpt(get_the_excerpt(), 80); ?>
                    </div>
                <?php endif; ?>
                
            <?php else : ?>
                
                <!-- 通常記事の抜粋 -->
                <div class="copipe-card-excerpt">
                    <?php echo copipe_custom_excerpt(get_the_excerpt(), 120); ?>
                </div>
                
            <?php endif; ?>
        </div>
        
        <!-- タグ -->
        <?php
        $tags = get_the_tags();
        if (!empty($tags) && count($tags) > 0) :
        ?>
            <div class="copipe-card-tags uk-margin-small-top">
                <?php foreach (array_slice($tags, 0, 3) as $tag) : ?>
                    <a href="<?php echo esc_url(get_tag_link($tag)); ?>" 
                       class="uk-label uk-label-muted uk-margin-small-right">
                        #<?php echo esc_html($tag->name); ?>
                    </a>
                <?php endforeach; ?>
                
                <?php if (count($tags) > 3) : ?>
                    <span class="uk-text-meta uk-text-small">+<?php echo count($tags) - 3; ?></span>
                <?php endif; ?>
            </div>
        <?php endif; ?>
        
    </div>
    
    <!-- カードフッター -->
    <div class="uk-card-footer">
        <div class="uk-grid-small uk-flex-between uk-flex-middle" uk-grid>
            
            <div class="uk-width-auto">
                <!-- 作成者 -->
                <div class="copipe-card-author uk-grid-small uk-flex-middle" uk-grid>
                    <div class="uk-width-auto">
                        <?php echo get_avatar(get_the_author_meta('ID'), 24, '', '', ['class' => 'uk-border-circle']); ?>
                    </div>
                    <div class="uk-width-expand">
                        <div class="uk-text-small">
                            <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" 
                               class="uk-link-muted">
                                <?php the_author(); ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="uk-width-auto">
                <!-- アクションボタン -->
                <div class="copipe-card-actions uk-grid-small uk-flex-middle" uk-grid>
                    
                    <!-- いいねボタン -->
                    <?php
                    $likes_count = get_post_meta($post_id, "copipe_likes_{$post_id}", true) ?: 0;
                    ?>
                    <div class="uk-width-auto">
                        <button class="copipe-like-button uk-button uk-button-text uk-text-small" 
                                data-post-id="<?php echo $post_id; ?>"
                                title="<?php _e('いいね', 'copipe-theme'); ?>">
                            <span uk-icon="icon:heart;ratio:0.8"></span>
                            <span class="copipe-likes-count"><?php echo $likes_count; ?></span>
                        </button>
                    </div>
                    
                    <!-- コメント数 -->
                    <?php if (comments_open() || get_comments_number()) : ?>
                        <div class="uk-width-auto">
                            <a href="<?php comments_link(); ?>" 
                               class="uk-button uk-button-text uk-text-small"
                               title="<?php _e('コメント', 'copipe-theme'); ?>">
                                <span uk-icon="icon:comment;ratio:0.8"></span>
                                <?php echo get_comments_number(); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                    
                    <!-- 詳細ボタン -->
                    <div class="uk-width-auto">
                        <a href="<?php the_permalink(); ?>" 
                           class="uk-button uk-button-primary uk-button-small">
                            <?php _e('詳細', 'copipe-theme'); ?>
                            <span uk-icon="icon:arrow-right;ratio:0.8"></span>
                        </a>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    
    <!-- ホバーエフェクト用の追加要素 -->
    <div class="copipe-card-overlay uk-transition-fade uk-position-cover uk-flex uk-flex-center uk-flex-middle" style="display: none;">
        <div class="uk-text-center">
            <a href="<?php the_permalink(); ?>" 
               class="uk-button uk-button-primary uk-button-large">
                <?php if ($is_copipe) : ?>
                    <span uk-icon="icon:code"></span>
                    <?php _e('コピペする', 'copipe-theme'); ?>
                <?php else : ?>
                    <span uk-icon="icon:read"></span>
                    <?php _e('記事を読む', 'copipe-theme'); ?>
                <?php endif; ?>
            </a>
        </div>
    </div>
    
</article>

<style>
/* カード専用スタイル */
.copipe-card {
    position: relative;
    overflow: hidden;
    height: 100%;
    display: flex;
    flex-direction: column;
    transition: var(--copipe-transition);
}

.copipe-card:hover {
    transform: translateY(-4px);
    box-shadow: var(--copipe-shadow-lg);
}

.copipe-card .uk-card-body {
    flex: 1;
    display: flex;
    flex-direction: column;
}

.copipe-card-content {
    flex: 1;
}

.copipe-card-badges {
    z-index: 2;
}

.copipe-card-badges .uk-label {
    backdrop-filter: blur(4px);
    background: rgba(255, 255, 255, 0.9);
    color: var(--copipe-text-primary);
}

.copipe-code-preview {
    position: relative;
    border-radius: var(--copipe-border-radius);
    overflow: hidden;
}

.copipe-code-preview pre {
    background: #2d3748;
    color: #e2e8f0;
    padding: var(--copipe-spacing-sm);
    margin: 0;
    font-size: 0.75rem;
    line-height: 1.4;
    max-height: 120px;
    overflow: hidden;
}

.copipe-code-overlay {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: linear-gradient(transparent, rgba(45, 55, 72, 0.9));
    padding: var(--copipe-spacing-sm);
    opacity: 0;
    transition: var(--copipe-transition);
}

.copipe-code-preview:hover .copipe-code-overlay {
    opacity: 1;
}

.copipe-card-meta .uk-grid-small > * {
    padding-left: var(--copipe-spacing-xs);
}

.copipe-card-meta .uk-grid-small > *:first-child {
    padding-left: 0;
}

.copipe-card-tags .uk-label {
    font-size: 0.7rem;
    padding: 2px 6px;
}

.copipe-card-author {
    align-items: center;
}

.copipe-card-actions .uk-button {
    padding: 4px 8px;
    min-height: auto;
}

.copipe-like-button {
    transition: var(--copipe-transition);
}

.copipe-like-button:hover,
.copipe-like-button.liked {
    color: #e91e63 !important;
}

.copipe-card-overlay {
    background: rgba(0, 0, 0, 0.8);
    backdrop-filter: blur(4px);
    z-index: 10;
}

/* レスポンシブ調整 */
@media (max-width: 640px) {
    .copipe-card {
        margin-bottom: var(--copipe-spacing-md);
    }
    
    .copipe-card-meta .uk-grid-small {
        flex-wrap: wrap;
    }
    
    .copipe-card-actions {
        justify-content: space-between;
        width: 100%;
    }
    
    .copipe-code-preview pre {
        font-size: 0.7rem;
        max-height: 80px;
    }
}

/* プリント用 */
@media print {
    .copipe-card-overlay,
    .copipe-code-overlay,
    .copipe-card-actions {
        display: none !important;
    }
}

/* ダークモード対応 */
[data-theme="dark"] .copipe-card {
    background: var(--copipe-bg-secondary);
    border-color: var(--copipe-border);
}

[data-theme="dark"] .copipe-card-badges .uk-label {
    background: rgba(0, 0, 0, 0.8);
    color: white;
}

/* アクセシビリティ */
@media (prefers-reduced-motion: reduce) {
    .copipe-card {
        transition: none;
    }
    
    .copipe-card:hover {
        transform: none;
    }
}

/* フォーカス表示 */
.copipe-card a:focus {
    outline: 2px solid var(--copipe-primary);
    outline-offset: 2px;
}

/* 読み込み中スタイル */
.copipe-card.loading {
    opacity: 0.6;
    pointer-events: none;
}

.copipe-card.loading::after {
    content: "";
    position: absolute;
    top: 50%;
    left: 50%;
    width: 20px;
    height: 20px;
    margin: -10px 0 0 -10px;
    border: 2px solid var(--copipe-primary);
    border-top-color: transparent;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    to { transform: rotate(360deg); }
}
</style>

<script>
// カードインタラクション
document.addEventListener('DOMContentLoaded', function() {
    // ホバーエフェクト
    const cards = document.querySelectorAll('.copipe-card');
    
    cards.forEach(card => {
        const overlay = card.querySelector('.copipe-card-overlay');
        
        if (overlay) {
            card.addEventListener('mouseenter', () => {
                if (window.innerWidth > 768) { // デスクトップのみ
                    overlay.style.display = 'flex';
                    setTimeout(() => overlay.classList.add('uk-animation-fade'), 10);
                }
            });
            
            card.addEventListener('mouseleave', () => {
                overlay.classList.remove('uk-animation-fade');
                setTimeout(() => overlay.style.display = 'none', 200);
            });
        }
    });
    
    // いいねボタン
    const likeButtons = document.querySelectorAll('.copipe-like-button');
    
    likeButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            
            const postId = this.dataset.postId;
            const countElement = this.querySelector('.copipe-likes-count');
            const currentCount = parseInt(countElement.textContent);
            
            // 楽観的UI更新
            this.classList.add('liked');
            countElement.textContent = currentCount + 1;
            
            // Ajax でいいね数を更新
            fetch(copipeAjax.ajaxurl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams({
                    action: 'copipe_like_post',
                    post_id: postId,
                    like_action: 'like',
                    nonce: copipeAjax.nonce
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    countElement.textContent = data.data.likes;
                    if (data.data.is_liked) {
                        this.classList.add('liked');
                    }
                } else {
                    // エラー時は元に戻す
                    this.classList.remove('liked');
                    countElement.textContent = currentCount;
                }
            })
            .catch(error => {
                // エラー時は元に戻す
                this.classList.remove('liked');
                countElement.textContent = currentCount;
                console.error('Error:', error);
            });
        });
    });
});
</script>