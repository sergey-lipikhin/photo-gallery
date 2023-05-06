<?php
/*
Template Name: MyGallery
 */

get_header();?>

<div class="header-div">
    <nav class="header-nav">
        <ul class="nav-ul">
            <li><a href="#" class="filter-button" data-filter="all">All</a></li>
            <?php $terms = get_terms('gallery_photo_category');
            foreach ($terms as  $term){ ?>
            <li><a href="#" class="filter-button" data-filter="<?php  echo $term->slug; ?>"><?php echo $term->name; ?></a></li>
            <?php  } ?>
        </ul>
    </nav>
</div>

<div class="grid-container">
    <?php $args = array(
        'post_type' => 'gallery_photo',
        'posts_per_page' => 8);
        $query = new WP_Query($args);
        while ($query->have_posts()) {
            $query->the_post();
            $termsArray = get_the_terms($post->ID, 'gallery_photo_category');
            $termsSLug = "";
            foreach ($termsArray as $term) {
                $termsSLug .= $term->slug;
            }
            ?>
            <article class="location-listing location-listing-<?php echo $termsSLug; ?>">
                <div class="location-title">
                    <?php the_title();?>
                </div>
                <div class="location-image">
                    <img class="image-super-syle" src="<?php the_post_thumbnail_url(); ?>">
                </div>
            </article>
        <?php  } wp_reset_postdata();?>
</div>

<script type="text/javascript">
    jQuery(document).ready(function($) {
        $('.nav-ul a').click(function(e){
            e.preventDefault();

            var str_filter = $(this).closest('a').data('filter');
            console.log(str_filter);

            $.ajax({
                type: 'POST',
                url: <?php echo json_encode(admin_url( 'admin-ajax.php')) ?>,
                data: {
                    security: <?php echo json_encode(wp_create_nonce( 'pb-image-filter' )) ?>,
                    action: 'pb_filter',
                    category: str_filter
                },
                success: function(res){
                    $('.grid-container').find('article.location-listing').remove();
                    $('.grid-container').prepend(res);
                },
                error: function(){
                    alert("Error!");
                }
            })
        });
    });
</script>

<?php get_footer();?>