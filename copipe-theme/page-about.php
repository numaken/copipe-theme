<?php
/**
 * Template Name: About Page
 * Description: サイト紹介用の固定ページテンプレート
 */

get_header();
?>

<!-- Hero セクション -->
<section class="uk-section uk-section-primary uk-section-large">
  <div class="uk-container">
    <h1 class="uk-heading-medium uk-text-center">開発効率×収益化を加速する<br>Copipe スニペットライブラリ</h1>
    <p class="uk-text-lead uk-text-center">AIで量産された即コピペ可能なコードで、あなたのWordPress開発を次のレベルへ。</p>
    <div class="uk-text-center uk-margin-large-top">
      <a href="<?php echo esc_url( get_category_link( get_cat_ID('copipe') ) ); ?>"
         class="uk-button uk-button-secondary uk-button-large">スニペット一覧を見る</a>
    </div>
  </div>
</section>

<!-- Mission セクション -->
<section class="uk-section uk-section-default">
  <div class="uk-container">
    <h2 class="uk-heading-line uk-text-center"><span>Our Mission</span></h2>
    <div class="uk-child-width-1-3@m uk-text-center uk-margin" uk-grid>
      <div>
        <span uk-icon="icon:flash;ratio:2"></span>
        <h3 class="uk-margin-small-top">高速開発</h3>
        <p>定番スニペットを即コピペ。開発時間を大幅に短縮します。</p>
      </div>
      <div>
        <span uk-icon="icon:cloud-upload;ratio:2"></span>
        <h3 class="uk-margin-small-top">AI自動生成</h3>
        <p>Pythonスクリプト×OpenAI APIで記事を自動量産。</p>
      </div>
      <div>
        <span uk-icon="icon:credit-card;ratio:2"></span>
        <h3 class="uk-margin-small-top">マネタイズ</h3>
        <p>広告・アフィリエイト・PDF販売でストック収益を構築。</p>
      </div>
    </div>
  </div>
</section>

<!-- Features セクション -->
<section class="uk-section">
  <div class="uk-container">
    <h2 class="uk-heading-line uk-text-center"><span>Features</span></h2>
    <div class="uk-child-width-1-2@m uk-child-width-1-4@l uk-grid-match uk-grid-small" uk-grid>
      <div>
        <div class="uk-card uk-card-default uk-card-body uk-text-center">
          <span uk-icon="icon:code;ratio:3"></span>
          <h4 class="uk-margin-small-top">豊富なスニペット</h4>
          <p>WPからGutenbergまで、300以上の例を用意。</p>
        </div>
      </div>
      <div>
        <div class="uk-card uk-card-default uk-card-body uk-text-center">
          <span uk-icon="icon:bolt;ratio:3"></span>
          <h4 class="uk-margin-small-top">低コスト量産</h4>
          <p>10記事あたり数十円〜。スケールしても安心。</p>
        </div>
      </div>
      <div>
        <div class="uk-card uk-card-default uk-card-body uk-text-center">
          <span uk-icon="icon:paint-tool;ratio:3"></span>
          <h4 class="uk-margin-small-top">スタイリッシュUI</h4>
          <p>UIkit＋Prism.jsで見やすいデザイン。</p>
        </div>
      </div>
      <div>
        <div class="uk-card uk-card-default uk-card-body uk-text-center">
          <span uk-icon="icon:users;ratio:3"></span>
          <h4 class="uk-margin-small-top">コミュニティ</h4>
          <p>有料サロンで質問し放題＆レビュー付き。</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- How It Works セクション -->
<section class="uk-section uk-section-muted">
  <div class="uk-container">
    <h2 class="uk-heading-line uk-text-center"><span>How It Works</span></h2>
    <div class="uk-grid-small uk-flex-middle" uk-grid>
      <div class="uk-width-1-3@m uk-text-center">
        <span uk-icon="icon:github;ratio:4"></span>
        <h4 class="uk-margin-small-top">1. トピック設定</h4>
        <p>トピックリストをスクリプトに登録</p>
      </div>
      <div class="uk-width-1-3@m uk-text-center">
        <span uk-icon="icon:cloud;ratio:4"></span>
        <h4 class="uk-margin-small-top">2. AI生成</h4>
        <p>OpenAI APIでスニペット記事を生成</p>
      </div>
      <div class="uk-width-1-3@m uk-text-center">
        <span uk-icon="icon:upload;ratio:4"></span>
        <h4 class="uk-margin-small-top">3. WP自動投稿</h4>
        <p>REST APIでWordPressに自動投稿</p>
      </div>
    </div>
  </div>
</section>

<!-- Get Started セクション -->
<section class="uk-section uk-section-primary">
  <div class="uk-container uk-text-center">
    <h2 class="uk-heading-large">今すぐ始めよう</h2>
    <p class="uk-text-lead">無料でPDFをダウンロードして、Copipeの全貌を手に入れよう！</p>
    <a href="/download/" class="uk-button uk-button-secondary uk-button-large">無料PDFをダウンロード</a>
  </div>
</section>

<!-- Testimonials/CTA セクション -->
<section class="uk-section uk-section-default">
  <div class="uk-container uk-text-center">
    <h2 class="uk-heading-line"><span>ユーザーの声</span></h2>
    <blockquote class="uk-text-lead">
      "このスニペットで開発時間が半分になりました！"  
      <cite>— Webエンジニア Aさん</cite>
    </blockquote>
    <p>もっと詳しく知りたい方は、コミュニティに参加！</p>
    <a href="/community/" class="uk-button uk-button-primary">コミュニティを見る</a>
  </div>
</section>

<?php get_footer(); ?>
