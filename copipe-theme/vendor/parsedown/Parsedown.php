<?php
// single-copipe.php のコードブロック出力前に追記
if ( ! class_exists('Parsedown') ) {
  require get_template_directory() . '/vendor/parsedown/Parsedown.php';
}
$Parsedown = new Parsedown();

// 投稿データを Markdown として取得
$raw = get_post_field( 'post_content', get_the_ID() );
// Markdown→HTML変換
$html = $Parsedown->text( $raw );
// HTML をそのまま出力
echo '<div class="uk-markup">' . $html . '</div>';
?>
