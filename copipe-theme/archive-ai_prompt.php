<?php get_header(); ?>

<div class="prompt-archive">
    <h1>🎯 AIプロンプト実践集</h1>
    
    <!-- フィルター -->
    <div class="prompt-filters">
        <select id="genre-filter">
            <option value="">ジャンルで絞り込み</option>
            <?php 
            $genres = get_terms('prompt_genre');
            foreach($genres as $genre) {
                echo "<option value='{$genre->slug}'>{$genre->name}</option>";
            }
            ?>
        </select>
        
        <select id="revenue-filter">
            <option value="">収益目標で絞り込み</option>
            <option value="beginner">🥉 月1-10万円</option>
            <option value="intermediate">🥈 月10-50万円</option>
            <option value="advanced">🥇 月50万円以上</option>
        </select>
        
        <select id="difficulty-filter">
            <option value="">難易度で絞り込み</option>
            <option value="1">⭐ 超簡単</option>
            <option value="2">⭐⭐ 標準</option>
            <option value="3">⭐⭐⭐ 上級</option>
        </select>
    </div>
    
    <!-- プロンプト一覧 -->
    <div class="prompt-grid">
        <?php while(have_posts()): the_post(); ?>
            <div class="prompt-card">
                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                
                <div class="prompt-meta">
                    <span class="revenue">💰 <?php echo get_field('revenue_goal'); ?>万円/月</span>
                    <span class="time">⏰ <?php echo get_field('time_required'); ?>分</span>
                    <span class="difficulty">
                        <?php 
                        $diff = get_field('difficulty');
                        echo str_repeat('⭐', $diff);
                        ?>
                    </span>
                </div>
                
                <div class="prompt-tools">
                    <?php 
                    $tools = get_field('tools_used');
                    if($tools) {
                        foreach($tools as $tool) {
                            echo "<span class='tool-tag'>📱 {$tool}</span>";
                        }
                    }
                    ?>
                </div>
                
                <p class="excerpt"><?php the_excerpt(); ?></p>
                
                <a href="<?php the_permalink(); ?>" class="read-more-btn">詳細を見る</a>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<?php get_footer(); ?>