<?php get_header(); ?>

<div class="prompt-single">
    <?php while(have_posts()): the_post(); ?>
        <h1><?php the_title(); ?></h1>
        
        <!-- 基本情報 -->
        <div class="prompt-info">
            <div class="info-grid">
                <div class="info-item">
                    <strong>💰 収益目標:</strong> <?php echo get_field('revenue_goal'); ?>万円/月
                </div>
                <div class="info-item">
                    <strong>⏰ 所要時間:</strong> <?php echo get_field('time_required'); ?>分
                </div>
                <div class="info-item">
                    <strong>🎯 難易度:</strong> 
                    <?php echo str_repeat('⭐', get_field('difficulty')); ?>
                </div>
            </div>
        </div>

        <!-- プロンプト本文 -->
        <div class="prompt-content">
            <h2>📝 プロンプトで何ができるか</h2>
            <div class="prompt-text">
                <?php echo nl2br(get_field('prompt_whats_text')); ?>
            </div>
        </div>

        <!-- プロンプト本文 -->
        <div class="prompt-content">
            <h2>📝 プロンプト文</h2>
            <div class="prompt-text">
                <?php echo nl2br(get_field('prompt_text')); ?>
            </div>
        </div>
        
        <!-- 使用手順 -->
        <div class="prompt-instructions">
            <h2>🚀 使用手順</h2>
            <?php 
            $instructions = get_field('instructions');
            if($instructions) {
                echo "<ol>";
                foreach($instructions as $step) {
                    echo "<li>" . $step['手順'] . "</li>";
                }
                echo "</ol>";
            }
            ?>
        </div>
        
        <!-- 注意点・コツ -->
        <div class="prompt-tips">
            <h2>💡 注意点・コツ</h2>
            <div class="tips-content">
                <?php echo nl2br(get_field('tips')); ?>
            </div>
        </div>
        
        <!-- 期待できる結果 -->
        <div class="prompt-results">
            <h2>🎯 期待できる結果</h2>
            <div class="results-content">
                <?php echo nl2br(get_field('expected_results')); ?>
            </div>
        </div>
        
    <?php endwhile; ?>
</div>

<?php get_footer(); ?>