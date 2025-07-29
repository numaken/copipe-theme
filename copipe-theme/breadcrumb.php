<nav class="uk-margin" aria-label="breadcrumb">
  <ul class="uk-breadcrumb">
    <li><a href="<?php echo home_url(); ?>">Home</a></li>
    <?php if ( is_category() ) : ?>
      <li><span><?php single_cat_title(); ?></span></li>
    <?php elseif ( is_single() ) : ?>
      <li><a href="<?php echo get_category_link( get_the_category()[0]->term_id ); ?>">
        <?php echo get_the_category()[0]->name; ?></a></li>
      <li><span><?php the_title(); ?></span></li>
    <?php endif; ?>
  </ul>
</nav>
