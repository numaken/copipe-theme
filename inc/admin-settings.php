<?php
/**
 * 管理画面のカスタマイザー設定をまとめたファイル
 * 主に WordPress カスタマイザーでの色やロゴ、タイトル等のUI設定
 */

if ( ! function_exists( 'copipe_theme_customize_register' ) ) {
	function copipe_theme_customize_register( $wp_customize ) {
		// セクション追加：基本設定
		$wp_customize->add_section( 'copipe_theme_basic_section', array(
			'title'    => __( 'テーマ基本設定', 'copipe' ),
			'priority' => 10,
		) );

		// 設定項目：ロゴ画像
		$wp_customize->add_setting( 'copipe_logo' );
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'copipe_logo', array(
			'label'    => __( 'ロゴ画像', 'copipe' ),
			'section'  => 'copipe_theme_basic_section',
			'settings' => 'copipe_logo',
		) ) );

		// 設定項目：テーマカラー
		$wp_customize->add_setting( 'copipe_main_color', array(
			'default'   => '#1e90ff',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'copipe_main_color', array(
			'label'    => __( 'メインカラー', 'copipe' ),
			'section'  => 'copipe_theme_basic_section',
			'settings' => 'copipe_main_color',
		) ) );
	}
}
add_action( 'customize_register', 'copipe_theme_customize_register' );
