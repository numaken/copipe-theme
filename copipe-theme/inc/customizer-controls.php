<?php
/**
 * inc/customizer-controls.php
 * カスタマイザーカスタムコントロール（改善版）
 * 
 * @package Copipe_Theme
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * カスタムコントロールクラスの読み込み
 */
function copipe_load_custom_controls($wp_customize) {
    // 必要に応じてカスタムコントロールクラスを定義
}

/**
 * レンジコントロール
 */
class Copipe_Range_Control extends WP_Customize_Control {
    public $type = 'copipe_range';
    
    public function enqueue() {
        wp_enqueue_script(
            'copipe-range-control',
            get_template_directory_uri() . '/assets/js/customizer-range.js',
            ['customize-controls'],
            COPIPE_THEME_VERSION
        );
    }
    
    public function render_content() {
        $min = isset($this->input_attrs['min']) ? $this->input_attrs['min'] : 0;
        $max = isset($this->input_attrs['max']) ? $this->input_attrs['max'] : 100;
        $step = isset($this->input_attrs['step']) ? $this->input_attrs['step'] : 1;
        $suffix = isset($this->input_attrs['suffix']) ? $this->input_attrs['suffix'] : '';
        ?>
        <label>
            <?php if (!empty($this->label)) : ?>
                <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
            <?php endif; ?>
            
            <?php if (!empty($this->description)) : ?>
                <span class="description customize-control-description"><?php echo esc_html($this->description); ?></span>
            <?php endif; ?>
            
            <div class="copipe-range-wrap">
                <input type="range" 
                       id="<?php echo esc_attr($this->id); ?>"
                       name="<?php echo esc_attr($this->id); ?>"
                       value="<?php echo esc_attr($this->value()); ?>"
                       min="<?php echo esc_attr($min); ?>"
                       max="<?php echo esc_attr($max); ?>"
                       step="<?php echo esc_attr($step); ?>"
                       <?php $this->link(); ?>
                       class="copipe-range-input" />
                
                <span class="copipe-range-value">
                    <?php echo esc_html($this->value() . $suffix); ?>
                </span>
            </div>
        </label>
        <?php
    }
}

/**
 * ソートブルリストコントロール
 */
class Copipe_Sortable_Control extends WP_Customize_Control {
    public $type = 'copipe_sortable';
    public $choices = [];
    
    public function enqueue() {
        wp_enqueue_script('jquery-ui-sortable');
        wp_enqueue_script(
            'copipe-sortable-control',
            get_template_directory_uri() . '/assets/js/customizer-sortable.js',
            ['customize-controls', 'jquery-ui-sortable'],
            COPIPE_THEME_VERSION
        );
    }
    
    public function render_content() {
        $values = $this->value();
        if (!is_array($values)) {
            $values = explode(',', $values);
        }
        ?>
        <label>
            <?php if (!empty($this->label)) : ?>
                <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
            <?php endif; ?>
            
            <?php if (!empty($this->description)) : ?>
                <span class="description customize-control-description"><?php echo esc_html($this->description); ?></span>
            <?php endif; ?>
            
            <ul class="copipe-sortable-list" data-customize-setting-link="<?php echo esc_attr($this->settings['default']->id); ?>">
                <?php foreach ($values as $value) : ?>
                    <?php if (isset($this->choices[$value])) : ?>
                        <li data-value="<?php echo esc_attr($value); ?>" class="copipe-sortable-item">
                            <span class="copipe-sortable-handle">≡</span>
                            <span class="copipe-sortable-label"><?php echo esc_html($this->choices[$value]); ?></span>
                            <button type="button" class="copipe-sortable-toggle" aria-label="<?php _e('表示/非表示', 'copipe-theme'); ?>">
                                <span class="dashicons dashicons-visibility"></span>
                            </button>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
                
                <?php foreach ($this->choices as $key => $label) : ?>
                    <?php if (!in_array($key, $values)) : ?>
                        <li data-value="<?php echo esc_attr($key); ?>" class="copipe-sortable-item copipe-sortable-disabled">
                            <span class="copipe-sortable-handle">≡</span>
                            <span class="copipe-sortable-label"><?php echo esc_html($label); ?></span>
                            <button type="button" class="copipe-sortable-toggle" aria-label="<?php _e('表示/非表示', 'copipe-theme'); ?>">
                                <span class="dashicons dashicons-hidden"></span>
                            </button>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
            
            <input type="hidden" <?php $this->link(); ?> value="<?php echo esc_attr(implode(',', $values)); ?>" />
        </label>
        <?php
    }
}

/**
 * タイポグラフィコントロール
 */
class Copipe_Typography_Control extends WP_Customize_Control {
    public $type = 'copipe_typography';
    public $font_families = [];
    public $font_weights = [];
    
    public function __construct($manager, $id, $args = []) {
        parent::__construct($manager, $id, $args);
        
        $this->font_families = [
            'system' => 'システムフォント',
            'noto-sans-jp' => 'Noto Sans JP',
            'hiragino' => 'ヒラギノ角ゴシック',
            'meiryo' => 'メイリオ',
            'yu-gothic' => '游ゴシック',
            'georgia' => 'Georgia',
            'times' => 'Times New Roman',
            'arial' => 'Arial',
            'helvetica' => 'Helvetica'
        ];
        
        $this->font_weights = [
            '300' => 'Light',
            '400' => 'Normal',
            '500' => 'Medium',
            '600' => 'Semi Bold',
            '700' => 'Bold',
            '800' => 'Extra Bold'
        ];
    }
    
    public function enqueue() {
        wp_enqueue_script(
            'copipe-typography-control',
            get_template_directory_uri() . '/assets/js/customizer-typography.js',
            ['customize-controls'],
            COPIPE_THEME_VERSION
        );
    }
    
    public function render_content() {
        $value = $this->value();
        $defaults = [
            'font_family' => 'system',
            'font_weight' => '400',
            'font_size' => '16',
            'line_height' => '1.6',
            'letter_spacing' => '0'
        ];
        
        $value = wp_parse_args($value, $defaults);
        ?>
        <label>
            <?php if (!empty($this->label)) : ?>
                <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
            <?php endif; ?>
            
            <?php if (!empty($this->description)) : ?>
                <span class="description customize-control-description"><?php echo esc_html($this->description); ?></span>
            <?php endif; ?>
            
            <div class="copipe-typography-fields">
                
                <!-- フォントファミリー -->
                <div class="copipe-typography-field">
                    <label for="<?php echo esc_attr($this->id); ?>-font-family">
                        <span class="copipe-typography-label"><?php _e('フォントファミリー', 'copipe-theme'); ?></span>
                        <select id="<?php echo esc_attr($this->id); ?>-font-family" data-key="font_family">
                            <?php foreach ($this->font_families as $key => $family) : ?>
                                <option value="<?php echo esc_attr($key); ?>" <?php selected($value['font_family'], $key); ?>>
                                    <?php echo esc_html($family); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </label>
                </div>
                
                <!-- フォントウェイト -->
                <div class="copipe-typography-field">
                    <label for="<?php echo esc_attr($this->id); ?>-font-weight">
                        <span class="copipe-typography-label"><?php _e('フォントウェイト', 'copipe-theme'); ?></span>
                        <select id="<?php echo esc_attr($this->id); ?>-font-weight" data-key="font_weight">
                            <?php foreach ($this->font_weights as $weight => $label) : ?>
                                <option value="<?php echo esc_attr($weight); ?>" <?php selected($value['font_weight'], $weight); ?>>
                                    <?php echo esc_html($label); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </label>
                </div>
                
                <!-- フォントサイズ -->
                <div class="copipe-typography-field">
                    <label for="<?php echo esc_attr($this->id); ?>-font-size">
                        <span class="copipe-typography-label"><?php _e('フォントサイズ (px)', 'copipe-theme'); ?></span>
                        <input type="number" 
                               id="<?php echo esc_attr($this->id); ?>-font-size"
                               data-key="font_size"
                               value="<?php echo esc_attr($value['font_size']); ?>"
                               min="10" max="72" step="1" />
                    </label>
                </div>
                
                <!-- 行間 -->
                <div class="copipe-typography-field">
                    <label for="<?php echo esc_attr($this->id); ?>-line-height">
                        <span class="copipe-typography-label"><?php _e('行間', 'copipe-theme'); ?></span>
                        <input type="number" 
                               id="<?php echo esc_attr($this->id); ?>-line-height"
                               data-key="line_height"
                               value="<?php echo esc_attr($value['line_height']); ?>"
                               min="1" max="3" step="0.1" />
                    </label>
                </div>
                
                <!-- 文字間隔 -->
                <div class="copipe-typography-field">
                    <label for="<?php echo esc_attr($this->id); ?>-letter-spacing">
                        <span class="copipe-typography-label"><?php _e('文字間隔 (px)', 'copipe-theme'); ?></span>
                        <input type="number" 
                               id="<?php echo esc_attr($this->id); ?>-letter-spacing"
                               data-key="letter_spacing"
                               value="<?php echo esc_attr($value['letter_spacing']); ?>"
                               min="-2" max="10" step="0.1" />
                    </label>
                </div>
                
            </div>
            
            <input type="hidden" <?php $this->link(); ?> value="<?php echo esc_attr(json_encode($value)); ?>" class="copipe-typography-value" />
        </label>
        <?php
    }
}

/**
 * 複数選択コントロール
 */
class Copipe_Multiple_Select_Control extends WP_Customize_Control {
    public $type = 'copipe_multiple_select';
    public $choices = [];
    
    public function enqueue() {
        wp_enqueue_script(
            'copipe-multiple-select-control',
            get_template_directory_uri() . '/assets/js/customizer-multiple-select.js',
            ['customize-controls'],
            COPIPE_THEME_VERSION
        );
    }
    
    public function render_content() {
        $values = $this->value();
        if (!is_array($values)) {
            $values = !empty($values) ? explode(',', $values) : [];
        }
        ?>
        <label>
            <?php if (!empty($this->label)) : ?>
                <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
            <?php endif; ?>
            
            <?php if (!empty($this->description)) : ?>
                <span class="description customize-control-description"><?php echo esc_html($this->description); ?></span>
            <?php endif; ?>
            
            <div class="copipe-multiple-select-wrap">
                <?php foreach ($this->choices as $key => $label) : ?>
                    <label class="copipe-multiple-option">
                        <input type="checkbox" 
                               value="<?php echo esc_attr($key); ?>"
                               <?php checked(in_array($key, $values)); ?>
                               data-customize-setting-link="<?php echo esc_attr($this->settings['default']->id); ?>" />
                        <span class="copipe-multiple-label"><?php echo esc_html($label); ?></span>
                    </label>
                <?php endforeach; ?>
            </div>
            
            <input type="hidden" <?php $this->link(); ?> value="<?php echo esc_attr(implode(',', $values)); ?>" />
        </label>
        <?php
    }
}

/**
 * カラーパレットコントロール
 */
class Copipe_Color_Palette_Control extends WP_Customize_Control {
    public $type = 'copipe_color_palette';
    public $colors = [];
    
    public function __construct($manager, $id, $args = []) {
        parent::__construct($manager, $id, $args);
        
        $this->colors = [
            '#1e87f0' => 'プライマリブルー',
            '#32d296' => 'セカンダリグリーン',
            '#faa05a' => 'アクセントオレンジ',
            '#f0506e' => 'ダンジャーレッド',
            '#222222' => 'ダーク',
            '#666666' => 'グレー',
            '#999999' => 'ライトグレー',
            '#ffffff' => 'ホワイト'
        ];
    }
    
    public function enqueue() {
        wp_enqueue_script(
            'copipe-color-palette-control',
            get_template_directory_uri() . '/assets/js/customizer-color-palette.js',
            ['customize-controls'],
            COPIPE_THEME_VERSION
        );
    }
    
    public function render_content() {
        ?>
        <label>
            <?php if (!empty($this->label)) : ?>
                <span class="customize-control-title"><?php echo esc_html($this->label); ?></span>
            <?php endif; ?>
            
            <?php if (!empty($this->description)) : ?>
                <span class="description customize-control-description"><?php echo esc_html($this->description); ?></span>
            <?php endif; ?>
            
            <div class="copipe-color-palette">
                <?php foreach ($this->colors as $color => $name) : ?>
                    <button type="button" 
                            class="copipe-color-option <?php echo $this->value() === $color ? 'selected' : ''; ?>"
                            style="background-color: <?php echo esc_attr($color); ?>"
                            data-color="<?php echo esc_attr($color); ?>"
                            title="<?php echo esc_attr($name); ?>"
                            aria-label="<?php echo esc_attr($name); ?>">
                        <?php if ($this->value() === $color) : ?>
                            <span class="dashicons dashicons-yes"></span>
                        <?php endif; ?>
                    </button>
                <?php endforeach; ?>
                
                <button type="button" class="copipe-color-custom" title="<?php _e('カスタムカラー', 'copipe-theme'); ?>">
                    <span class="dashicons dashicons-admin-customizer"></span>
                </button>
            </div>
            
            <input type="text" 
                   class="copipe-color-input"
                   <?php $this->link(); ?>
                   value="<?php echo esc_attr($this->value()); ?>"
                   placeholder="<?php _e('#000000', 'copipe-theme'); ?>" />
        </label>
        <?php
    }
}

/**
 * インフォメーションコントロール
 */
class Copipe_Info_Control extends WP_Customize_Control {
    public $type = 'copipe_info';
    public $info_type = 'info'; // info, warning, success, danger
    
    public function render_content() {
        $class = 'copipe-info-control copipe-info-' . esc_attr($this->info_type);
        ?>
        <div class="<?php echo esc_attr($class); ?>">
            <?php if (!empty($this->label)) : ?>
                <h4 class="copipe-info-title"><?php echo esc_html($this->label); ?></h4>
            <?php endif; ?>
            
            <?php if (!empty($this->description)) : ?>
                <div class="copipe-info-content"><?php echo wp_kses_post($this->description); ?></div>
            <?php endif; ?>
        </div>
        
        <style>
        .copipe-info-control {
            padding: 12px;
            border-radius: 4px;
            margin: 12px 0;
        }
        
        .copipe-info-info {
            background: #e1f5fe;
            border-left: 4px solid #0288d1;
        }
        
        .copipe-info-warning {
            background: #fff8e1;
            border-left: 4px solid #ffa000;
        }
        
        .copipe-info-success {
            background: #e8f5e8;
            border-left: 4px solid #4caf50;
        }
        
        .copipe-info-danger {
            background: #ffebee;
            border-left: 4px solid #f44336;
        }
        
        .copipe-info-title {
            margin: 0 0 8px 0;
            font-size: 14px;
            font-weight: 600;
        }
        
        .copipe-info-content {
            font-size: 13px;
            line-height: 1.5;
        }
        
        .copipe-info-content p:last-child {
            margin-bottom: 0;
        }
        </style>
        <?php
    }
}

/**
 * カスタムコントロールの登録
 */
function copipe_register_custom_controls($wp_customize) {
    // カスタムコントロールクラスを登録
    $wp_customize->register_control_type('Copipe_Range_Control');
    $wp_customize->register_control_type('Copipe_Sortable_Control');
    $wp_customize->register_control_type('Copipe_Typography_Control');
    $wp_customize->register_control_type('Copipe_Multiple_Select_Control');
    $wp_customize->register_control_type('Copipe_Color_Palette_Control');
    $wp_customize->register_control_type('Copipe_Info_Control');
}
add_action('customize_register', 'copipe_register_custom_controls');

/**
 * カスタムコントロール用CSS
 */
function copipe_customize_controls_css() {
    ?>
    <style>
    /* レンジコントロール */
    .copipe-range-wrap {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-top: 8px;
    }
    
    .copipe-range-input {
        flex: 1;
        -webkit-appearance: none;
        height: 4px;
        border-radius: 2px;
        background: #ddd;
        outline: none;
    }
    
    .copipe-range-input::-webkit-slider-thumb {
        -webkit-appearance: none;
        appearance: none;
        width: 18px;
        height: 18px;
        border-radius: 50%;
        background: #0073aa;
        cursor: pointer;
    }
    
    .copipe-range-input::-moz-range-thumb {
        width: 18px;
        height: 18px;
        border-radius: 50%;
        background: #0073aa;
        cursor: pointer;
        border: none;
    }
    
    .copipe-range-value {
        min-width: 40px;
        text-align: center;
        font-weight: 600;
        color: #0073aa;
    }
    
    /* ソートブルリスト */
    .copipe-sortable-list {
        border: 1px solid #ddd;
        border-radius: 4px;
        max-height: 200px;
        overflow-y: auto;
        margin: 8px 0 0 0;
        padding: 0;
        background: #fff;
    }
    
    .copipe-sortable-item {
        display: flex;
        align-items: center;
        padding: 8px 12px;
        border-bottom: 1px solid #eee;
        cursor: move;
        transition: background-color 0.2s;
    }
    
    .copipe-sortable-item:hover {
        background-color: #f9f9f9;
    }
    
    .copipe-sortable-item.copipe-sortable-disabled {
        opacity: 0.6;
        background-color: #f5f5f5;
    }
    
    .copipe-sortable-handle {
        margin-right: 8px;
        color: #999;
        cursor: move;
    }
    
    .copipe-sortable-label {
        flex: 1;
        font-size: 13px;
    }
    
    .copipe-sortable-toggle {
        background: none;
        border: none;
        cursor: pointer;
        padding: 4px;
        color: #666;
    }
    
    .copipe-sortable-toggle:hover {
        color: #0073aa;
    }
    
    /* タイポグラフィコントロール */
    .copipe-typography-fields {
        display: grid;
        gap: 12px;
        margin-top: 8px;
    }
    
    .copipe-typography-field label {
        display: block;
    }
    
    .copipe-typography-label {
        display: block;
        font-size: 12px;
        font-weight: 600;
        margin-bottom: 4px;
        color: #555;
    }
    
    .copipe-typography-field select,
    .copipe-typography-field input {
        width: 100%;
        padding: 6px 8px;
        border: 1px solid #ddd;
        border-radius: 3px;
        font-size: 13px;
    }
    
    /* 複数選択コントロール */
    .copipe-multiple-select-wrap {
        border: 1px solid #ddd;
        border-radius: 4px;
        max-height: 150px;
        overflow-y: auto;
        margin-top: 8px;
        background: #fff;
    }
    
    .copipe-multiple-option {
        display: flex;
        align-items: center;
        padding: 8px 12px;
        border-bottom: 1px solid #eee;
        cursor: pointer;
        transition: background-color 0.2s;
    }
    
    .copipe-multiple-option:hover {
        background-color: #f9f9f9;
    }
    
    .copipe-multiple-option input[type="checkbox"] {
        margin: 0 8px 0 0;
    }
    
    .copipe-multiple-label {
        font-size: 13px;
    }
    
    /* カラーパレットコントロール */
    .copipe-color-palette {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 8px;
        margin: 8px 0;
    }
    
    .copipe-color-option,
    .copipe-color-custom {
        width: 40px;
        height: 40px;
        border: 2px solid #ddd;
        border-radius: 4px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
    }
    
    .copipe-color-option:hover,
    .copipe-color-custom:hover {
        border-color: #0073aa;
        transform: scale(1.05);
    }
    
    .copipe-color-option.selected {
        border-color: #0073aa;
        border-width: 3px;
    }
    
    .copipe-color-option .dashicons {
        color: #fff;
        text-shadow: 0 0 2px rgba(0,0,0,0.5);
    }
    
    .copipe-color-custom {
        background: linear-gradient(45deg, #f0f0f0 25%, transparent 25%), 
                    linear-gradient(-45deg, #f0f0f0 25%, transparent 25%), 
                    linear-gradient(45deg, transparent 75%, #f0f0f0 75%), 
                    linear-gradient(-45deg, transparent 75%, #f0f0f0 75%);
        background-size: 8px 8px;
        background-position: 0 0, 0 4px, 4px -4px, -4px 0px;
    }
    
    .copipe-color-input {
        width: 100%;
        margin-top: 8px;
        padding: 6px 8px;
        border: 1px solid #ddd;
        border-radius: 3px;
        font-family: monospace;
    }
    </style>
    <?php
}
add_action('customize_controls_print_styles', 'copipe_customize_controls_css');
?>