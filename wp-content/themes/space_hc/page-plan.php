<?php
/* Template Name: spacehc-plan */
/**
 * Created by PhpStorm.
 * User: RikuTakenaka
 * Date: 2018/03/25
 * Time: 19:10
 */

get_header();

date_default_timezone_set('Asia/Tokyo');

?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
  <div class="page-top wrap">
    <h1 class="top-desc rl"><?php the_title(); ?></h1>
  </div>

  <div class="wrap">
    <div class="content rl">
      <ul class="plan-list">
        <li>・七五三</li>
        <li>・成人式</li>
        <li>・卒業式</li>
        <li>・入学式</li>
        <li>・マタニティ</li>
        <li>・お宮参り</li>
        <li>・家族写真</li>
        <li>・ウェディング</li>
      </ul>
    </div>
  </div>

  <div class="wrap bb">
    <div class="content rl">
      <?php the_content(); ?>
    </div>
  </div>
  <div class="wrap">
    <div class="content">
      <div class="flex">
        <div class="item">
            <?php
            //画像(返り値は「画像ID」)
            $img = get_field('page_img_1');
            $imgurl = wp_get_attachment_image_src($img, 'large'); //サイズは自由に変更してね
            if($imgurl){ ?><img src="<?php echo $imgurl[0]; ?>" alt="">
            <?php }
            ?>
          <?php the_field('page_img_1_text'); ?>
        </div>
        <div class="item">
            <?php
            //画像(返り値は「画像ID」)
            $img = get_field('page_img_2');
            $imgurl = wp_get_attachment_image_src($img, 'large'); //サイズは自由に変更してね
            if($imgurl){ ?><img src="<?php echo $imgurl[0]; ?>" alt="">
            <?php }
            ?>
            <?php the_field('page_img_2_text'); ?>
        </div>
        <div class="item">
            <?php
            //画像(返り値は「画像ID」)
            $img = get_field('page_img_3');
            $imgurl = wp_get_attachment_image_src($img, 'large'); //サイズは自由に変更してね
            if($imgurl){ ?><img src="<?php echo $imgurl[0]; ?>" alt="">
            <?php }
            ?>
            <?php the_field('page_img_3_text'); ?>
        </div>
        <div class="item">
            <?php
            //画像(返り値は「画像ID」)
            $img = get_field('page_img_4');
            $imgurl = wp_get_attachment_image_src($img, 'large'); //サイズは自由に変更してね
            if($imgurl){ ?><img src="<?php echo $imgurl[0]; ?>" alt="">
            <?php }
            ?>
            <?php the_field('page_img_4_text'); ?>
        </div>
      </div>
    </div>
  </div>
<?php endwhile; else : ?>
  <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
<?php endif; ?>
<?php
get_footer();