/**
 * assets/js/customize-preview.js
 * WordPressカスタマイザープレビュー用JavaScript（改善版）
 * 
 * @package Copipe_Theme
 */

(function ($) {
  'use strict';

  // プレビュー更新のためのユーティリティ
  const preview = {

    // CSS変数を更新
    updateCSSVariable(property, value) {
      document.documentElement.style.setProperty(property, value);
    },

    // テキストコンテンツを更新
    updateText(selector, text) {
      const elements = document.querySelectorAll(selector);
      elements.forEach(element => {
        element.textContent = text;
      });
    },

    // HTML属性を更新
    updateAttribute(selector, attribute, value) {
      const elements = document.querySelectorAll(selector);
      elements.forEach(element => {
        element.setAttribute(attribute, value);
      });
    },

    // クラスの切り替え
    toggleClass(selector, className, condition) {
      const elements = document.querySelectorAll(selector);
      elements.forEach(element => {
        element.classList.toggle(className, condition);
      });
    },

    // スタイル要素を更新/追加
    updateStyleElement(id, css) {
      let styleElement = document.getElementById(id);

      if (!styleElement) {
        styleElement = document.createElement('style');
        styleElement.id = id;
        document.head.appendChild(styleElement);
      }

      styleElement.textContent = css;
    },

    // 要素の表示/非表示
    toggleVisibility(selector, visible) {
      const elements = document.querySelectorAll(selector);
      elements.forEach(element => {
        element.style.display = visible ? '' : 'none';
      });
    },

    // 背景画像を更新
    updateBackgroundImage(selector, imageUrl) {
      const elements = document.querySelectorAll(selector);
      elements.forEach(element => {
        if (imageUrl) {
          element.style.backgroundImage = `url(${imageUrl})`;
        } else {
          element.style.backgroundImage = 'none';
        }
      });
    }
  };

  // サイト基本設定
  wp.customize('blogname', (value) => {
    value.bind((newval) => {
      preview.updateText('.copipe-logo-text, .site-title', newval);
    });
  });

  wp.customize('blogdescription', (value) => {
    value.bind((newval) => {
      preview.updateText('.site-description', newval);
    });
  });

  wp.customize('copipe_site_description', (value) => {
    value.bind((newval) => {
      preview.updateText('.copipe-site-description', newval);
    });
  });

  // ロゴ設定
  wp.customize('copipe_logo', (value) => {
    value.bind((newval) => {
      const logoElements = document.querySelectorAll('.copipe-logo img');

      if (newval) {
        logoElements.forEach(element => {
          element.src = newval;
          element.style.display = 'block';
        });

        // テキストロゴを隠す
        preview.toggleVisibility('.copipe-logo-text', false);
      } else {
        logoElements.forEach(element => {
          element.style.display = 'none';
        });

        // テキストロゴを表示
        preview.toggleVisibility('.copipe-logo-text', true);
      }
    });
  });

  // カラー設定
  wp.customize('copipe_primary_color', (value) => {
    value.bind((newval) => {
      preview.updateCSSVariable('--copipe-primary', newval);

      // 特定の要素に直接適用
      const css = `
              .uk-button-primary {
                  background-color: ${newval} !important;
                  border-color: ${newval} !important;
              }
              .uk-text-primary {
                  color: ${newval} !important;
              }
              .uk-label-success {
                  background-color: ${newval} !important;
              }
          `;

      preview.updateStyleElement('copipe-primary-color-preview', css);
    });
  });

  wp.customize('copipe_secondary_color', (value) => {
    value.bind((newval) => {
      preview.updateCSSVariable('--copipe-secondary', newval);

      const css = `
              .uk-button-secondary {
                  background-color: ${newval} !important;
                  border-color: ${newval} !important;
              }
              .uk-text-secondary {
                  color: ${newval} !important;
              }
          `;

      preview.updateStyleElement('copipe-secondary-color-preview', css);
    });
  });

  wp.customize('copipe_accent_color', (value) => {
    value.bind((newval) => {
      preview.updateCSSVariable('--copipe-accent', newval);

      const css = `
              .uk-label-warning {
                  background-color: ${newval} !important;
              }
              .copipe-accent {
                  color: ${newval} !important;
              }
          `;

      preview.updateStyleElement('copipe-accent-color-preview', css);
    });
  });

  // タイポグラフィ設定
  wp.customize('copipe_body_font', (value) => {
    value.bind((newval) => {
      const fontFamilies = {
        'noto-sans-jp': "'Noto Sans JP', sans-serif",
        'hiragino': "'Hiragino Kaku Gothic ProN', 'ヒラギノ角ゴ ProN W3', sans-serif",
        'meiryo': "'Meiryo', 'メイリオ', sans-serif",
        'yu-gothic': "'Yu Gothic', '游ゴシック', sans-serif",
        'system': "-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif"
      };

      const fontFamily = fontFamilies[newval] || fontFamilies['system'];

      preview.updateCSSVariable('--copipe-font-family', fontFamily);

      const css = `
              body {
                  font-family: ${fontFamily} !important;
              }
          `;

      preview.updateStyleElement('copipe-body-font-preview', css);
    });
  });

  wp.customize('copipe_heading_font', (value) => {
    value.bind((newval) => {
      const fontFamilies = {
        'noto-sans-jp': "'Noto Sans JP', sans-serif",
        'hiragino': "'Hiragino Kaku Gothic ProN', 'ヒラギノ角ゴ ProN W3', sans-serif",
        'meiryo': "'Meiryo', 'メイリオ', sans-serif",
        'yu-gothic': "'Yu Gothic', '游ゴシック', sans-serif",
        'system': "-apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif"
      };

      const fontFamily = fontFamilies[newval] || fontFamilies['system'];

      const css = `
              h1, h2, h3, h4, h5, h6,
              .uk-heading-primary,
              .uk-heading-hero,
              .uk-heading-medium,
              .uk-heading-large {
                  font-family: ${fontFamily} !important;
              }
          `;

      preview.updateStyleElement('copipe-heading-font-preview', css);
    });
  });

  wp.customize('copipe_font_size', (value) => {
    value.bind((newval) => {
      preview.updateCSSVariable('--copipe-font-size', newval + 'px');

      const css = `
              body {
                  font-size: ${newval}px !important;
              }
          `;

      preview.updateStyleElement('copipe-font-size-preview', css);
    });
  });

  // レイアウト設定
  wp.customize('copipe_container_width', (value) => {
    value.bind((newval) => {
      preview.updateCSSVariable('--copipe-container-width', newval + 'px');

      const css = `
              .uk-container {
                  max-width: ${newval}px !important;
              }
          `;

      preview.updateStyleElement('copipe-container-width-preview', css);
    });
  });

  wp.customize('copipe_show_sidebar', (value) => {
    value.bind((newval) => {
      preview.toggleVisibility('.copipe-sidebar', newval);

      // メインコンテンツの幅を調整
      const mainContent = document.querySelector('.copipe-main-content');
      if (mainContent) {
        if (newval) {
          mainContent.classList.remove('uk-width-1-1');
          mainContent.classList.add('uk-width-expand@m');
        } else {
          mainContent.classList.remove('uk-width-expand@m');
          mainContent.classList.add('uk-width-1-1');
        }
      }
    });
  });

  wp.customize('copipe_archive_layout', (value) => {
    value.bind((newval) => {
      const archiveContainer = document.querySelector('.copipe-archive-posts');
      if (archiveContainer) {
        // 既存のレイアウトクラスを削除
        archiveContainer.classList.remove(
          'uk-child-width-1-1',
          'uk-child-width-1-2@s',
          'uk-child-width-1-3@m'
        );

        // 新しいレイアウトクラスを追加
        if (newval === 'grid') {
          archiveContainer.classList.add(
            'uk-child-width-1-2@s',
            'uk-child-width-1-3@m'
          );
        } else {
          archiveContainer.classList.add('uk-child-width-1-1');
        }
      }
    });
  });

  // ヘッダー設定
  wp.customize('copipe_header_layout', (value) => {
    value.bind((newval) => {
      const header = document.querySelector('.copipe-header');
      if (header) {
        // 既存のレイアウトクラスを削除
        header.classList.remove('copipe-header-default', 'copipe-header-centered', 'copipe-header-minimal');

        // 新しいレイアウトクラスを追加
        header.classList.add(`copipe-header-${newval}`);
      }
    });
  });

  wp.customize('copipe_header_sticky', (value) => {
    value.bind((newval) => {
      const header = document.querySelector('.copipe-header');
      if (header) {
        if (newval) {
          header.classList.add('uk-sticky');
          header.setAttribute('uk-sticky', '');
        } else {
          header.classList.remove('uk-sticky');
          header.removeAttribute('uk-sticky');
        }
      }
    });
  });

  wp.customize('copipe_show_search_button', (value) => {
    value.bind((newval) => {
      preview.toggleVisibility('.copipe-header-search', newval);
    });
  });

  // コード表示設定
  wp.customize('copipe_code_theme', (value) => {
    value.bind((newval) => {
      const codeThemes = {
        'default': '/wp-content/themes/copipe-theme/assets/css/prism-default.css',
        'tomorrow-night': 'https://cdn.jsdelivr.net/npm/prismjs@1.29.0/themes/prism-tomorrow.css',
        'dracula': 'https://cdn.jsdelivr.net/npm/prismjs@1.29.0/themes/prism-dracula.css',
        'monokai': 'https://cdn.jsdelivr.net/npm/prismjs@1.29.0/themes/prism-monokai.css',
        'github': 'https://cdn.jsdelivr.net/npm/prismjs@1.29.0/themes/prism-github.css'
      };

      // 既存のPrismテーマを削除
      const existingLink = document.querySelector('#copipe-prism-theme');
      if (existingLink) {
        existingLink.remove();
      }

      // 新しいテーマを追加
      if (codeThemes[newval]) {
        const link = document.createElement('link');
        link.id = 'copipe-prism-theme';
        link.rel = 'stylesheet';
        link.href = codeThemes[newval];
        document.head.appendChild(link);
      }
    });
  });

  wp.customize('copipe_show_line_numbers', (value) => {
    value.bind((newval) => {
      const codeBlocks = document.querySelectorAll('pre[class*="language-"]');
      codeBlocks.forEach(pre => {
        if (newval) {
          pre.classList.add('line-numbers');
        } else {
          pre.classList.remove('line-numbers');
        }
      });
    });
  });

  wp.customize('copipe_show_copy_button', (value) => {
    value.bind((newval) => {
      preview.toggleVisibility('.copipe-code-copy', newval);
    });
  });

  // フッター設定
  wp.customize('copipe_footer_text', (value) => {
    value.bind((newval) => {
      preview.updateText('.copipe-footer-text', newval);
    });
  });

  // ソーシャルリンク
  const socialNetworks = ['twitter', 'facebook', 'instagram', 'youtube', 'github', 'linkedin'];

  socialNetworks.forEach(network => {
    wp.customize(`copipe_social_${network}`, (value) => {
      value.bind((newval) => {
        const link = document.querySelector(`.copipe-social-${network}`);
        if (link) {
          if (newval) {
            link.href = newval;
            link.style.display = '';
          } else {
            link.style.display = 'none';
          }
        }
      });
    });
  });

  // 高度な設定
  wp.customize('copipe_custom_css', (value) => {
    value.bind((newval) => {
      preview.updateStyleElement('copipe-custom-css-preview', newval);
    });
  });

  // リアルタイム更新のためのヘルパー関数
  const livePreview = {

    // タイポグラフィ設定の一括更新
    updateTypography(settings) {
      const css = `
              body {
                  font-family: ${settings.font_family} !important;
                  font-size: ${settings.font_size}px !important;
                  font-weight: ${settings.font_weight} !important;
                  line-height: ${settings.line_height} !important;
                  letter-spacing: ${settings.letter_spacing}px !important;
              }
          `;

      preview.updateStyleElement('copipe-typography-preview', css);
    },

    // カラーパレットの一括更新
    updateColorPalette(colors) {
      const css = `
              :root {
                  --copipe-primary: ${colors.primary};
                  --copipe-secondary: ${colors.secondary};
                  --copipe-accent: ${colors.accent};
              }
          `;

      preview.updateStyleElement('copipe-color-palette-preview', css);
    },

    // レイアウト設定の一括更新
    updateLayout(settings) {
      const css = `
              .uk-container {
                  max-width: ${settings.container_width}px !important;
              }
              
              .copipe-header {
                  ${settings.header_sticky ? 'position: sticky; top: 0; z-index: 980;' : ''}
              }
          `;

      preview.updateStyleElement('copipe-layout-preview', css);
    }
  };

  // カスタマイザーの準備完了時に実行
  wp.customize.bind('ready', () => {

    // プレビューフレームにメッセージを送信
    wp.customize.preview.bind('active', () => {
      // カスタマイザーがアクティブになった時の処理
      document.body.classList.add('customize-active');

      // プレビュー専用のスタイルを追加
      const previewCSS = `
              .customize-active {
                  /* カスタマイザー専用のスタイル */
              }
              
              .customize-active .copipe-card:hover {
                  /* ホバーエフェクトを強調 */
                  transform: translateY(-6px);
              }
          `;

      preview.updateStyleElement('copipe-customize-preview', previewCSS);
    });

    // セクションフォーカス時のハイライト
    wp.customize.preview.bind('section-highlight', (sectionId) => {
      const sectionSelectors = {
        'copipe_site_settings': '.copipe-header',
        'copipe_colors': '.copipe-card, .uk-button',
        'copipe_typography': 'body, h1, h2, h3',
        'copipe_layout': '.uk-container',
        'copipe_code_settings': 'pre[class*="language-"]',
        'copipe_footer_settings': '.copipe-footer'
      };

      // 既存のハイライトを削除
      document.querySelectorAll('.customize-highlight').forEach(el => {
        el.classList.remove('customize-highlight');
      });

      // 新しいハイライトを追加
      const selector = sectionSelectors[sectionId];
      if (selector) {
        document.querySelectorAll(selector).forEach(el => {
          el.classList.add('customize-highlight');
        });

        // ハイライト用CSS
        const highlightCSS = `
                  .customize-highlight {
                      outline: 2px dashed #0073aa !important;
                      outline-offset: 2px !important;
                      transition: all 0.3s ease !important;
                  }
              `;

        preview.updateStyleElement('copipe-customize-highlight', highlightCSS);

        // 3秒後にハイライトを削除
        setTimeout(() => {
          document.querySelectorAll('.customize-highlight').forEach(el => {
            el.classList.remove('customize-highlight');
          });
        }, 3000);
      }
    });

    // プレビューリフレッシュの最適化
    wp.customize.preview.bind('refresh', () => {
      // リフレッシュ前に状態を保存
      const scrollPosition = window.pageYOffset;

      // リフレッシュ後に状態を復元
      wp.customize.preview.bind('ready', () => {
        window.scrollTo(0, scrollPosition);
      });
    });
  });

  // プレビュー用のデバッグ機能（開発時のみ）
  if (window.console && typeof console.log === 'function') {
    wp.customize.bind('ready', () => {
      console.log('Copipe Theme Customizer Preview Ready');

      // カスタマイザー設定の変更を監視
      wp.customize.settings.settings.forEach((setting, id) => {
        wp.customize(id, (value) => {
          value.bind((newval) => {
            console.log(`Setting changed: ${id} = ${newval}`);
          });
        });
      });
    });
  }

})(jQuery);