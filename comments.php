<?php
/**
 * The template for displaying comments
 *
 * @package copipe-theme
 * @version 3.0.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area">
    
    <?php
    // You can start editing here -- including this comment!
    if (have_comments()) :
    ?>
        <h2 class="comments-title">
            <span class="comments-icon">💬</span>
            <span class="comments-text">
                <?php
                $comment_count = get_comments_number();
                if ('1' === $comment_count) {
                    printf(
                        /* translators: 1: title. */
                        esc_html__('One comment on &ldquo;%1$s&rdquo;', 'copipe-theme'),
                        '<span>' . wp_kses_post(get_the_title()) . '</span>'
                    );
                } else {
                    printf(
                        /* translators: 1: comment count number, 2: title. */
                        esc_html(_nx('%1$s件のコメント', '%1$s件のコメント', $comment_count, 'comments title', 'copipe-theme')),
                        number_format_i18n($comment_count)
                    );
                }
                ?>
            </span>
        </h2><!-- .comments-title -->
        
        <?php the_comments_navigation(); ?>
        
        <ol class="comment-list">
            <?php
            wp_list_comments(array(
                'style' => 'ol',
                'short_ping' => true,
                'callback' => 'copipe_comment',
            ));
            ?>
        </ol><!-- .comment-list -->
        
        <?php
        the_comments_navigation();
        
        // If comments are closed and there are comments, let's leave a little note, shall we?
        if (!comments_open()) :
        ?>
            <p class="no-comments">
                <span class="no-comments-icon">🔒</span>
                <span class="no-comments-text"><?php esc_html_e('Comments are closed.', 'copipe-theme'); ?></span>
            </p>
        <?php
        endif;
        
    endif; // Check for have_comments().
    
    // Comment form
    $commenter = wp_get_current_commenter();
    $req = get_option('require_name_email');
    $aria_req = ($req ? " aria-required='true'" : '');
    
    $comment_args = array(
        'title_reply' => '<span class="reply-icon">✍️</span><span class="reply-text">コメントを残す</span>',
        'title_reply_to' => '<span class="reply-icon">↩️</span><span class="reply-text">%s に返信</span>',
        'cancel_reply_link' => '返信をキャンセル',
        'label_submit' => 'コメントを投稿',
        'comment_field' => '<div class="comment-form-comment">
            <label for="comment" class="comment-label">
                <span class="label-icon">💭</span>
                <span class="label-text">コメント</span>
                ' . ($req ? '<span class="required">*</span>' : '') . '
            </label>
            <textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" 
                      placeholder="ここにコメントを入力してください..." class="comment-textarea"></textarea>
        </div>',
        'fields' => array(
            'author' => '<div class="comment-form-author">
                <label for="author" class="author-label">
                    <span class="label-icon">👤</span>
                    <span class="label-text">お名前</span>
                    ' . ($req ? '<span class="required">*</span>' : '') . '
                </label>
                <input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" 
                       size="30"' . $aria_req . ' placeholder="お名前を入力してください" class="author-input" />
            </div>',
            'email' => '<div class="comment-form-email">
                <label for="email" class="email-label">
                    <span class="label-icon">📧</span>
                    <span class="label-text">メールアドレス</span>
                    ' . ($req ? '<span class="required">*</span>' : '') . '
                </label>
                <input id="email" name="email" type="email" value="' . esc_attr($commenter['comment_author_email']) . '" 
                       size="30"' . $aria_req . ' placeholder="メールアドレスを入力してください" class="email-input" />
            </div>',
            'url' => '<div class="comment-form-url">
                <label for="url" class="url-label">
                    <span class="label-icon">🌐</span>
                    <span class="label-text">ウェブサイト</span>
                </label>
                <input id="url" name="url" type="url" value="' . esc_attr($commenter['comment_author_url']) . '" 
                       size="30" placeholder="ウェブサイトのURLを入力してください（任意）" class="url-input" />
            </div>',
        ),
        'class_submit' => 'submit-button',
        'submit_field' => '<div class="form-submit">
            %1$s %2$s
        </div>',
        'comment_notes_before' => '<div class="comment-notes">
            <p class="comment-notes-text">
                <span class="notes-icon">ℹ️</span>
                メールアドレスが公開されることはありません。
                ' . ($req ? '<span class="required-text">必須フィールドには<span class="required">*</span>が付いています。</span>' : '') . '
            </p>
        </div>',
        'comment_notes_after' => '<div class="comment-policy">
            <p class="policy-text">
                <span class="policy-icon">🛡️</span>
                コメントは承認後に表示されます。不適切なコメントは削除される場合があります。
            </p>
        </div>',
    );
    
    comment_form($comment_args);
    ?>
    
</div><!-- #comments -->

<style>
/* Comments Area Styles */
.comments-area {
    background: white;
    border-radius: 15px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    padding: 2rem;
    margin-top: 3rem;
}

/* Comments Title */
.comments-title {
    color: #2c5aa0;
    font-size: 1.8rem;
    font-weight: 600;
    margin-bottom: 2rem;
    padding-bottom: 1rem;
    border-bottom: 2px solid #f0f0f0;
    display: flex;
    align-items: center;
    gap: 0.8rem;
}

.comments-icon {
    font-size: 1.5rem;
}

/* Comment List */
.comment-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.comment-list .comment {
    margin-bottom: 2rem;
    padding: 1.5rem;
    background: #f8f9fa;
    border-radius: 15px;
    border-left: 4px solid #2c5aa0;
    position: relative;
}

.comment-list .children {
    list-style: none;
    margin-top: 1.5rem;
    margin-left: 2rem;
    padding-left: 2rem;
    border-left: 2px solid #e0e0e0;
}

.comment-author {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1rem;
}

.comment-author .avatar {
    border-radius: 50%;
    border: 3px solid #2c5aa0;
}

.comment-author .fn {
    color: #2c5aa0;
    font-weight: 600;
    font-size: 1.1rem;
    text-decoration: none;
}

.comment-author .fn:hover {
    color: #ff6b35;
}

.says {
    display: none;
}

.comment-metadata {
    margin-left: auto;
    display: flex;
    align-items: center;
    gap: 1rem;
    font-size: 0.9rem;
    color: #666;
}

.comment-metadata a {
    color: #666;
    text-decoration: none;
}

.comment-metadata a:hover {
    color: #2c5aa0;
}

.comment-content {
    margin: 1rem 0;
    line-height: 1.7;
    color: #333;
}

.comment-content p {
    margin-bottom: 1rem;
}

.comment-content p:last-child {
    margin-bottom: 0;
}

.reply {
    margin-top: 1rem;
}

.comment-reply-link {
    background: #2c5aa0;
    color: white;
    text-decoration: none;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.9rem;
    font-weight: 500;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 0.3rem;
}

.comment-reply-link:hover {
    background: #ff6b35;
    color: white;
    transform: translateY(-1px);
}

.comment-reply-link::before {
    content: "↩️";
    font-size: 0.8rem;
}

/* Comment Form */
.comment-respond {
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    padding: 2rem;
    border-radius: 15px;
    margin-top: 3rem;
}

.comment-reply-title {
    color: #2c5aa0;
    font-size: 1.5rem;
    font-weight: 600;
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.reply-icon {
    font-size: 1.3rem;
}

.comment-form {
    display: grid;
    gap: 1.5rem;
}

.comment-form-author,
.comment-form-email,
.comment-form-url {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.comment-form-comment {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
    grid-column: 1 / -1;
}

.author-label,
.email-label,
.url-label,
.comment-label {
    color: #333;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.label-icon {
    font-size: 1.1rem;
}

.required {
    color: #d63031;
    font-weight: 700;
}

.author-input,
.email-input,
.url-input,
.comment-textarea {
    padding: 1rem;
    border: 2px solid #e0e0e0;
    border-radius: 10px;
    background: white;
    font-size: 1rem;
    transition: all 0.3s ease;
    font-family: inherit;
}

.author-input:focus,
.email-input:focus,
.url-input:focus,
.comment-textarea:focus {
    outline: none;
    border-color: #2c5aa0;
    box-shadow: 0 0 0 3px rgba(44, 90, 160, 0.1);
}

.comment-textarea {
    resize: vertical;
    min-height: 120px;
    line-height: 1.6;
}

.form-submit {
    grid-column: 1 / -1;
    display: flex;
    align-items: center;
    gap: 1rem;
}

.submit-button {
    background: linear-gradient(135deg, #2c5aa0, #ff6b35);
    color: white;
    border: none;
    padding: 1rem 2rem;
    border-radius: 25px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.submit-button:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(44, 90, 160, 0.3);
}

.submit-button::before {
    content: "📝";
    font-size: 1rem;
}

/* Comment Notes */
.comment-notes {
    grid-column: 1 / -1;
    background: #fff3cd;
    padding: 1rem;
    border-radius: 10px;
    border-left: 4px solid #ffc107;
}

.comment-notes-text {
    margin: 0;
    color: #856404;
    font-size: 0.9rem;
    display: flex;
    align-items: flex-start;
    gap: 0.5rem;
    line-height: 1.5;
}

.notes-icon {
    font-size: 1rem;
    flex-shrink: 0;
    margin-top: 0.1rem;
}

.required-text {
    display: block;
    margin-top: 0.5rem;
}

.comment-policy {
    grid-column: 1 / -1;
    background: #d1ecf1;
    padding: 1rem;
    border-radius: 10px;
    border-left: 4px solid #17a2b8;
}

.policy-text {
    margin: 0;
    color: #0c5460;
    font-size: 0.9rem;
    display: flex;
    align-items: flex-start;
    gap: 0.5rem;
    line-height: 1.5;
}

.policy-icon {
    font-size: 1rem;
    flex-shrink: 0;
    margin-top: 0.1rem;
}

/* Comment Navigation */
.comment-navigation {
    margin: 2rem 0;
    padding: 1rem;
    background: white;
    border-radius: 10px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.nav-previous,
.nav-next {
    flex: 1;
}

.nav-next {
    text-align: right;
}

.nav-previous a,
.nav-next a {
    background: #2c5aa0;
    color: white;
    text-decoration: none;
    padding: 0.8rem 1.5rem;
    border-radius: 25px;
    font-weight: 500;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.nav-previous a:hover,
.nav-next a:hover {
    background: #ff6b35;
    transform: translateY(-1px);
    color: white;
}

.nav-previous a::before {
    content: "←";
}

.nav-next a::after {
    content: "→";
}

/* No Comments */
.no-comments {
    text-align: center;
    padding: 2rem;
    color: #666;
    font-style: italic;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}

.no-comments-icon {
    font-size: 1.2rem;
}

/* Comment Status Messages */
.comment-awaiting-moderation {
    background: #fff3cd;
    color: #856404;
    padding: 0.5rem 1rem;
    border-radius: 5px;
    font-size: 0.9rem;
    margin-top: 0.5rem;
    border-left: 4px solid #ffc107;
}

.comment-awaiting-moderation::before {
    content: "⏳ ";
}

/* Pingback/Trackback Styles */
.comment-list .pingback,
.comment-list .trackback {
    background: #e9ecef;
    border-left-color: #6c757d;
}

.comment-list .pingback .comment-content,
.comment-list .trackback .comment-content {
    font-style: italic;
}

.comment-list .pingback .comment-content::before,
.comment-list .trackback .comment-content::before {
    content: "🔗 ";
}

/* Mobile Responsive */
@media (max-width: 767px) {
    .comments-area {
        padding: 1.5rem;
    }
    
    .comments-title {
        font-size: 1.5rem;
        flex-direction: column;
        gap: 0.5rem;
        text-align: center;
    }
    
    .comment-list .comment {
        padding: 1rem;
    }
    
    .comment-list .children {
        margin-left: 1rem;
        padding-left: 1rem;
    }
    
    .comment-author {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.5rem;
    }
    
    .comment-metadata {
        margin-left: 0;
        margin-top: 0.5rem;
    }
    
    .comment-respond {
        padding: 1.5rem;
    }
    
    .comment-form {
        grid-template-columns: 1fr;
    }
    
    .form-submit {
        flex-direction: column;
        align-items: stretch;
    }
    
    .submit-button {
        text-align: center;
        justify-content: center;
    }
    
    .comment-navigation {
        flex-direction: column;
        gap: 1rem;
    }
    
    .nav-next {
        text-align: center;
    }
}

/* Print Styles */
@media print {
    .comment-respond,
    .comment-navigation,
    .reply {
        display: none;
    }
    
    .comment-list .comment {
        box-shadow: none;
        border: 1px solid #ccc;
    }
}

/* High Contrast Mode */
@media (prefers-contrast: high) {
    .comment-list .comment {
        border: 2px solid #000;
    }
    
    .submit-button,
    .comment-reply-link {
        border: 1px solid #000;
    }
}

/* Reduced Motion */
@media (prefers-reduced-motion: reduce) {
    .submit-button:hover,
    .comment-reply-link:hover,
    .nav-previous a:hover,
    .nav-next a:hover {
        transform: none;
    }
}
</style>

<?php
/**
 * Custom comment callback function
 */
function copipe_comment($comment, $args, $depth) {
    if ('pingback' == $comment->comment_type || 'trackback' == $comment->comment_type) : ?>
        
        <li id="comment-<?php comment_ID(); ?>" <?php comment_class('pingback'); ?>>
            <div class="comment-body">
                <?php esc_html_e('Pingback:', 'copipe-theme'); ?> <?php comment_author_link(); ?> <?php edit_comment_link(esc_html__('Edit', 'copipe-theme'), '<span class="edit-link">', '</span>'); ?>
            </div>
        
    <?php else : ?>
        
        <li id="comment-<?php comment_ID(); ?>" <?php comment_class(empty($args['has_children']) ? '' : 'parent'); ?>>
            <article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
                <footer class="comment-meta">
                    <div class="comment-author vcard">
                        <?php if (0 != $args['avatar_size']) echo get_avatar($comment, $args['avatar_size']); ?>
                        <?php
                        /* translators: %s: comment author link */
                        printf(__('%s <span class="says">says:</span>', 'copipe-theme'),
                            sprintf('<cite class="fn">%s</cite>', get_comment_author_link())
                        );
                        ?>
                    </div><!-- .comment-author -->
                    
                    <div class="comment-metadata">
                        <a href="<?php echo esc_url(get_comment_link($comment->comment_ID)); ?>">
                            <time datetime="<?php comment_time('c'); ?>">
                                <?php
                                /* translators: 1: comment date, 2: comment time */
                                printf(esc_html__('%1$s at %2$s', 'copipe-theme'), get_comment_date(), get_comment_time());
                                ?>
                            </time>
                        </a>
                        <?php edit_comment_link(esc_html__('Edit', 'copipe-theme'), '<span class="edit-link">', '</span>'); ?>
                    </div><!-- .comment-metadata -->
                    
                    <?php if ('0' == $comment->comment_approved) : ?>
                        <p class="comment-awaiting-moderation"><?php esc_html_e('Your comment is awaiting moderation.', 'copipe-theme'); ?></p>
                    <?php endif; ?>
                </footer><!-- .comment-meta -->
                
                <div class="comment-content">
                    <?php comment_text(); ?>
                </div><!-- .comment-content -->
                
                <?php
                comment_reply_link(array_merge($args, array(
                    'add_below' => 'div-comment',
                    'depth' => $depth,
                    'max_depth' => $args['max_depth'],
                    'before' => '<div class="reply">',
                    'after' => '</div>',
                )));
                ?>
            </article><!-- .comment-body -->
        
    <?php endif;
}
?>