<?php
$section_title = get_field('section_title', 'option');
$section_bg = get_field('section_background_image', 'option');
?>

<section class="whyus" style="background-image: url('<?php echo esc_url($section_bg['url']); ?>');">

    <div class="section-title">
        <h2><?php echo esc_html($section_title); ?></h2>
    </div>

    <?php if (have_rows('items', 'option')): ?>
        <div class="whyus-slider swiper">
            <div class="swiper-wrapper">

                <?php while (have_rows('items', 'option')):
                    the_row();

                    $image = get_sub_field('image');
                    $title = get_sub_field('title');
                    $description = get_sub_field('description');
                    $link = get_sub_field('link');
                    ?>

                    <div class="whyus-card swiper-slide">
                        <img src="<?php echo esc_url($image['url']); ?>" alt="">
                        <div class="text-section">
                            <div class="card-title">
                                <?php echo esc_html($title); ?>
                            </div>
                            <p class="card-description">
                                <?php echo esc_html($description); ?>
                                <a href="<?php echo esc_url($link); ?>" class="card-arrow">
                                    <svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"
                                        fill="#ED1C24">
                                        <path
                                            d="M134,6479 L132.565,6480.393 L140.172,6488 L124,6488 L124,6490 L140.172,6490 L132.586,6497.586 L134,6499 C137.661,6495.339 140.496,6492.504 144,6489 L134,6479"
                                            transform="translate(-124,-6479)" />
                                    </svg>
                                </a>

                            </p>
                        </div>
                    </div>

                <?php endwhile; ?>

            </div>
        </div>
    <?php endif; ?>

</section>