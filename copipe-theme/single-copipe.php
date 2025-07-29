<?php
/**
 * Single Template: コピペ集
 */
get_header();

if ( ! class_exists('Parsedown') ) {
    require get_template_directory() . '/vendor/parsedown/Parsedown.php';
}
$Parsedown = new Parsedown();
?>
<div class="uk-section uk-container">
  <article <?php post_class('uk-article'); ?>>

    <h1 class="uk-article-title uk-margin-small-bottom"><?php the_title(); ?></h1>
    <p class="uk-text-meta uk-margin-remove-top">
      <time datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date(); ?></time>
      ｜ <?php the_category(', '); ?>
    </p>

    <div class="uk-card uk-card-default uk-card-body uk-margin-medium-top">
      <div class="uk-overflow-auto">
        <?php
          $md   = get_post_field('post_content', get_the_ID());
          $html = $Parsedown->text($md);
          // コード部分をそのまま出力（行ハイライト付き）
          if ( preg_match('@(<pre.*?>.*?</pre>)@is', $html, $m) ) {
            // ハイライトしたい行番号（例: 2〜3行目）
            $highlight = '2-3';
            $pre = str_replace(
              '<pre class="language-php">',
              '<pre class="language-php line-numbers" data-line="'. esc_attr( $highlight ) .'">',
              $m[1]
            );
            echo $pre;
          }
        ?>
      </div>
    </div>

    <div class="uk-card uk-card-default uk-card-body uk-margin-top">
      <?php
        // コード以外の説明部分
        if ( preg_match('@</pre>\s*(.+)$@is', $html, $m) ) {
          echo wpautop( wp_kses_post( $m[1] ) );
        }
      ?>
    </div>

    <div class="uk-margin-large-top uk-text-center">
      <?php previous_post_link('%link <span uk-icon="icon:arrow-left"></span>','%title'); ?>
      <?php next_post_link('<span uk-icon="icon:arrow-right"></span> %link','%title'); ?>
    </div>

  </article>
</div>
<?php get_footer(); ?>
