<?php
/*
Template Name: Threads
*/
get_header();
?>

<main class="threads-page main-content-width">
  <h1 class="text-[36px] mb-6 font-cormorant">Threads</h1>
  <div class="threads-grid grid md:grid-cols-2 lg:grid-cols-3 2xl:grid-cols-4 gap-16">

    <?php
    $args = array(
      'post_type' => 'post',
      'posts_per_page' => 12,
      'paged' => get_query_var('paged') ? get_query_var('paged') : 1
    );

    $query = new WP_Query($args);

    if ($query->have_posts()):
      while ($query->have_posts()):
        $query->the_post(); ?>
        <article class="bg-white overflow-hidden group">
          <?php if (has_post_thumbnail()): ?>
            <a href="<?php the_permalink(); ?>" class="block w-full aspect-square overflow-hidden">
              <?php the_post_thumbnail('medium', ['class' => 'w-full h-full object-cover group-hover:scale-110 transition-all duration-100']); ?>
            </a>
          <?php endif; ?>
          <div class="p-4">
            <h2 class="text-[24px] font-semibold mb-1 font-cormorant">
              <a href="<?php the_permalink(); ?>" class="text-black hover:underline"><?php the_title(); ?></a>
            </h2>
            <div class="text-sm text-gray-500">
              <?php echo get_the_author(); ?> — <?php the_time('F j, Y'); ?>
            </div>
          </div>
        </article>

      <?php endwhile; ?>
    </div>

    <!-- Pagination -->
    <div class="pagination mt-8">
      <?php
      echo paginate_links(array(
        'total' => $query->max_num_pages,
        'prev_text' => '&laquo;',
        'next_text' => '&raquo;',
        'mid_size' => 2,
        'type' => 'list',
        'before_page_number' => '<span>',
        'after_page_number' => '</span>'
      ));
      ?>
    </div>

    <?php
    else:
      echo '<p>No threads found.</p>';
    endif;

    wp_reset_postdata();
    ?>
</main>

<?php get_footer(); ?>