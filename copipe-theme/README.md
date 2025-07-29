# Copipe Theme - 改善版

WordPressコピペスニペット専用テーマの大幅改善版です。セキュリティ、パフォーマンス、保守性を重視して設計されています。

## 🚀 主な特徴

### ✨ 改善されたポイント

- **セキュリティ強化**: XSS対策、CSRF対策、レート制限、ログイン試行制限
- **パフォーマンス最適化**: 遅延読み込み、キャッシュ機能、画像最適化
- **保守性向上**: 設定管理画面、モジュール化、国際化対応
- **ユーザビリティ向上**: 検索機能強化、レスポンシブ対応、アクセシビリティ配慮
- **AdSense最適化**: 設定画面からの管理、自動挿入、収益最適化

### 🎨 デザイン機能

- **UIkit3フレームワーク**: モダンで美しいUIコンポーネント
- **Prism.js統合**: 高機能なシンタックスハイライト
- **ダークモード対応**: 自動切り替え機能
- **レスポンシブデザイン**: 全デバイス対応
- **カスタマイザー**: 豊富なカスタマイズオプション

## 📁 ファイル構成

```
copipe-theme/
├── style.css                      # メインスタイルシート
├── index.php                      # トップページテンプレート
├── functions.php                   # テーマ機能定義
├── header.php                     # ヘッダーテンプレート
├── footer.php                     # フッターテンプレート
├── single.php                     # 記事詳細テンプレート
├── page.php                       # 固定ページテンプレート
├── archive.php                    # アーカイブテンプレート
├── category-copipe.php            # コピペカテゴリテンプレート
├── search.php                     # 検索結果テンプレート
├── 404.php                        # 404エラーページテンプレート
├── comments.php                   # コメントテンプレート
├── page-about.php                 # Aboutページテンプレート
├── inc/
│   ├── admin-settings.php         # 管理画面設定
│   ├── ajax-functions.php         # Ajax処理関数
│   ├── security.php               # セキュリティ機能
│   ├── utils.php                  # ユーティリティ関数
│   ├── customizer.php             # カスタマイザー設定
│   └── customizer-controls.php    # カスタムコントロール
├── template-parts/
│   ├── content-card.php           # カード形式記事表示
│   └── content-list.php           # リスト形式記事表示
├── assets/
│   ├── js/
│   │   ├── copipe.js              # メインJavaScript
│   │   ├── customize-preview.js   # カスタマイザープレビュー
│   │   └── customize-controls.js  # カスタマイザーコントロール
│   └── css/
│       ├── customize-controls.css # カスタマイザースタイル
│       └── admin.css              # 管理画面スタイル
└── languages/                     # 翻訳ファイル
```

## 🔧 インストール・設定

### 1. 基本インストール

1. テーマファイルを `/wp-content/themes/copipe-theme/` にアップロード
2. WordPress管理画面で「外観 > テーマ」からテーマを有効化
3. 「外観 > テーマ設定」で基本設定を行う

### 2. 必須設定

#### 基本設定
- サイトロゴの設定
- ソーシャルメディアURL
- お問い合わせメールアドレス

#### AdSense設定
```php
// functions.php または設定画面で
$adsense_options = [
    'adsense_client' => 'ca-pub-xxxxxxxxxxxxxxxx',
    'adsense_slots' => [
        'header' => 'スロットID1',
        'content' => 'スロットID2',
        'footer' => 'スロットID3'
    ]
];
```

#### セキュリティ設定
```php
// 推奨設定
copipe_set_option('disable_xmlrpc', true);
copipe_set_option('max_login_attempts', 5);
copipe_set_option('enable_security_logging', true);
copipe_set_option('restrict_rest_api', true);
```

### 3. カテゴリー設定

「copipe」カテゴリーを作成し、コピペスニペット記事を投稿してください。

## 📝 使用方法

### 記事の投稿

#### Markdownでコードを記述
```markdown
# PHP配列の操作

```php
<?php
$array = [1, 2, 3, 4, 5];
$filtered = array_filter($array, function($value) {
    return $value > 2;
});
print_r($filtered);
```

このコードは配列から条件に合う要素を抽出します。
```

#### カスタムフィールド
- `copipe_difficulty`: 難易度設定（beginner/intermediate/advanced）
- `copipe_tags`: 追加タグ
- `copipe_featured`: おすすめ記事フラグ

### ショートコード

#### AdSenseショートコード
```php
[adsense slot="スロットID"]
[adsense slot="スロットID" format="rectangle"]
```

#### 統計情報ショートコード
```php
[copipe_stats] // サイト統計を表示
[copipe_popular_posts limit="5"] // 人気記事表示
```

### Ajax機能

#### 検索候補
```javascript
// 自動的に有効化
// リアルタイム検索候補を表示
```

#### クイックコピー
```javascript
// ボタンクリックでコードをクリップボードにコピー
document.querySelectorAll('.copipe-quick-copy').forEach(button => {
    button.addEventListener('click', function() {
        // 処理は自動実装済み
    });
});
```

## 🎨 カスタマイズ

### カスタマイザー

WordPress管理画面の「外観 > カスタマイズ」から以下を設定可能：

- **サイト基本設定**: ロゴ、ファビコン、説明文
- **ヘッダー設定**: レイアウト、固定表示、検索ボタン
- **カラー設定**: プライマリ、セカンダリ、アクセントカラー
- **タイポグラフィ**: フォント、サイズ、行間
- **レイアウト設定**: コンテナ幅、サイドバー、アーカイブ表示
- **コード表示設定**: テーマ、行番号、コピーボタン

### CSS カスタマイズ

```css
/* カスタムCSS例 */
:root {
    --copipe-primary: #your-color;
    --copipe-secondary: #your-color;
    --copipe-accent: #your-color;
}

.copipe-card {
    /* カード表示のカスタマイズ */
}

.copipe-code-container {
    /* コードブロックのカスタマイズ */
}
```

### PHPカスタマイズ

#### フック例
```php
// カスタム処理を追加
add_action('copipe_before_content', 'your_custom_function');
add_filter('copipe_search_results', 'your_filter_function');

// 新しいコードハイライトテーマを追加
add_filter('copipe_code_themes', function($themes) {
    $themes['custom'] = 'カスタムテーマ';
    return $themes;
});
```

## 🔒 セキュリティ機能

### 実装済みセキュリティ対策

1. **XSS対策**: 全ユーザー入力のエスケープ処理
2. **CSRF対策**: nonce検証の実装
3. **ログイン保護**: 試行回数制限、IP制限
4. **ファイルアップロード制限**: MIMEタイプ、サイズ制限
5. **REST API制限**: 未認証アクセスの制限
6. **XMLRPCセキュリティ**: 危険なメソッドの無効化
7. **セキュリティヘッダー**: CSP、XSS Protection等
8. **レート制限**: API、フォーム送信の制限

### セキュリティ設定

```php
// 緊急時のアクセス制限
copipe_set_option('emergency_mode', true);

// セキュリティログの有効化
copipe_set_option('enable_security_logging', true);

// 管理者メール通知
copipe_set_option('email_security_alerts', true);
```

## ⚡ パフォーマンス最適化

### 実装済み最適化

1. **遅延読み込み**: 画像、iframe、スクリプト
2. **キャッシュ機能**: ページ、オブジェクト、データベースクエリ
3. **画像最適化**: WebP対応、レスポンシブ画像
4. **CSS/JS最小化**: 本番環境での自動最適化
5. **CDN対応**: 外部リソースの効率的読み込み

### パフォーマンス設定

```php
// キャッシュの有効化
copipe_set_option('enable_caching', true);
copipe_set_option('cache_expiration', HOUR_IN_SECONDS);

// 遅延読み込み
copipe_set_option('enable_lazy_loading', true);

// 画像最適化
copipe_set_option('enable_webp_conversion', true);
```

## 📊 分析・統計

### ビルトイン分析機能

1. **ページビュー追跡**: 各記事のビュー数計測
2. **人気記事ランキング**: 自動生成
3. **イベント追跡**: コピー、いいね、シェア
4. **検索キーワード分析**: 内部検索の分析

### Google Analytics連携

```php
// GA4設定
copipe_set_option('google_analytics_id', 'G-XXXXXXXXXX');

// カスタムイベント送信
copipe_track_event('code_copy', 'user_interaction', 'post_123');
```

## 🌐 多言語対応

### 翻訳ファイル

テーマは完全に国際化対応しています：

```php
// 翻訳可能文字列の例
__('コピペ集', 'copipe-theme');
_e('詳細を見る', 'copipe-theme');
_n('1つのコメント', '%sつのコメント', $count, 'copipe-theme');
```

### 翻訳ファイルの場所
- `languages/copipe-theme.pot` - 翻訳テンプレート
- `languages/ja.po` - 日本語翻訳

## 🛠 トラブルシューティング

### よくある問題

#### コードハイライトが動作しない
```php
// Prism.jsの読み込み確認
if (!wp_script_is('prism-core', 'enqueued')) {
    wp_enqueue_script('prism-core');
}
```

#### AdSenseが表示されない
1. クライアントIDの確認
2. スロットIDの確認
3. 広告位置設定の確認

#### 検索機能が動作しない
```php
// Ajax URL の確認
console.log(copipeAjax.ajaxurl);

// nonce の確認
console.log(copipeAjax.nonce);
```

### デバッグモード

```php
// デバッグ情報の表示
define('WP_DEBUG', true);
define('COPIPE_DEBUG', true);

// ログの確認
copipe_log('Debug message', 'debug');
```

## 📈 収益化

### AdSense最適化

1. **自動広告配置**: 記事内の最適な位置に自動挿入
2. **レスポンシブ広告**: デバイスに応じたサイズ調整
3. **表示制御**: モバイルでの非表示設定など

### アフィリエイト対応

```php
// アフィリエイトリンクの管理
add_shortcode('affiliate', function($atts) {
    $a = shortcode_atts([
        'url' => '',
        'text' => 'リンク'
    ], $atts);
    
    return sprintf(
        '<a href="%s" target="_blank" rel="nofollow noopener">%s</a>',
        esc_url($a['url']),
        esc_html($a['text'])
    );
});
```

## 🤝 貢献・サポート

### バグレポート

問題を発見した場合は、以下の情報と共にご報告ください：

- WordPressバージョン
- PHPバージョン
- エラーメッセージ
- 再現手順

### 機能リクエスト

新機能のご提案は以下の形式でお願いします：

- 機能の説明
- 使用場面
- 期待される効果

## 📄 ライセンス

このテーマはGPL v2以降のライセンスの下で配布されています。

## 🔄 更新履歴

### v2.0.0 (改善版)
- セキュリティ機能の大幅強化
- パフォーマンス最適化
- 管理画面の追加
- カスタマイザーの拡張
- Ajax機能の実装
- レスポンシブ対応の改善

### v1.0.0 (初版)
- 基本機能の実装
- UIkit3 + Prism.js統合
- AdSense対応

---

## 💡 ベストプラクティス

### SEO最適化
- 構造化データの活用
- パンくずリストの実装
- サイトマップの自動生成
- メタタグの最適化

### セキュリティ
- 定期的なセキュリティスキャン実行
- 強力なパスワードの使用
- 不要なプラグインの削除
- 定期的なバックアップ

### パフォーマンス
- 画像の最適化
- 不要なプラグインの無効化
- キャッシュの活用
- CDNの利用

このテーマを使用して、効率的で収益性の高いコピペスニペットサイトを構築してください！