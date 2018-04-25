<?php
/* Template Name: spacehc */
/**
 * Created by PhpStorm.
 * User: RikuTakenaka
 * Date: 2018/03/25
 * Time: 19:10
 */

get_header();

date_default_timezone_set('Asia/Tokyo');

$base_url = 'https://api.openweathermap.org/data/2.5/forecast';
$api_key = '46fe08b7b219092364fe3da353083f69';
$city_id = '2111149';

$response = file_get_contents(
    $base_url . '?id=' . $city_id . '&APPID=' . $api_key
);

$result = json_decode($response, true);

$weather = '';
$weather_arr = [];

for ($i = 8; $i <= 32; $i = $i + 8) {
    $clear = ['01d', '02d', '01n', '02n'];
    $cloud = ['03d', '04d', '03n', '04n'];
    $rain = ['09d', '10d', '11d', '09n', '10n', '11n'];
    $snow = ['13d', '13n'];
    $weather = $result['list'][$i]['weather'][0]['icon'];
    if (array_search($weather, $clear)) {
        $weather_arr[] = 'はれ';
    }
    if (array_search($weather, $cloud)) {
        $weather_arr[] = 'くもり';
    }
    if (array_search($weather, $rain)) {
        $weather_arr[] = 'あめ';
    }
    if (array_search($weather, $snow)) {
        $weather_arr[] = 'ゆき';
    }
}
//var_dump($weather_arr);

?>

  <div class="front-top wrap">
    <h1 class="top-desc rl">写真が人生を豊かにする<span class="serif">、</span>たぶん</h1>
    <dl class="weather">
        <?php for ($i = 0; $i <= 3; $i++) {
            echo '<dt>' . date('m/d', strtotime(+$i . ' day')) . '(' . strtoupper(date('D', strtotime(+$i . ' day'))) . ')/' . date('y', strtotime(+$i . ' day')) . ' ' . '</dt>' . '<dd>' . $weather_arr[$i] . '</dd>';
        } ?>
    </dl>
  </div>
  <!-- Slider main container -->
  <div class="swiper-container">
    <!-- Additional required wrapper -->
    <div class="swiper-wrapper">
      <!-- Slides -->
      <div class="swiper-slide">
        <h2 class="rl">七五三プラン</h2>
        <div class="circle"></div>
        <div class="photo-box"><img src="<?php echo get_template_directory_uri(); ?>/library/images/1x/0319-3.JPG"
                                    alt=""></div>
      </div>
      <div class="swiper-slide">
        <h2 class="rl">七五三プラン</h2>
        <div class="circle"></div>
        <div class="photo-box"><img src="<?php echo get_template_directory_uri(); ?>/library/images/1x/0319-3.JPG"
                                    alt=""></div>
      </div>
      <div class="swiper-slide">
        <h2 class="rl">七五三プラン</h2>
        <div class="circle"></div>
        <div class="photo-box"><img src="<?php echo get_template_directory_uri(); ?>/library/images/1x/0319-3.JPG"
                                    alt=""></div>
      </div>
      <div class="swiper-slide">
        <h2 class="rl">七五三プラン</h2>
        <div class="circle"></div>
        <div class="photo-box"><img src="<?php echo get_template_directory_uri(); ?>/library/images/1x/0319-3.JPG"
                                    alt=""></div>
      </div>
      <div class="swiper-slide">
        <h2 class="rl">七五三プラン</h2>
        <div class="circle"></div>
        <div class="photo-box"><img src="<?php echo get_template_directory_uri(); ?>/library/images/1x/0319-3.JPG"
                                    alt=""></div>
      </div>
    </div>
    <!-- If we need pagination -->
    <div class="swiper-pagination"></div>
  </div>

  <div class="wrap">

    <div class="nav-bar">
      <ul class="ja rl">
        <a href="">
          <li>連絡する</li>
        </a><a href="">
          <li>予約する</li>
        </a><a href="">
          <li>場所案内</li>
        </a><a href="">
          <li>スペースのこと</li>
        </a><a href="">
          <li>スタジオのこと</li>
        </a>
      </ul>
      <ul class="us">
        <a href="">
          <li>studio HC</li>
        </a><a href="">
          <li>space HC</li>
        </a><a href="">
          <li>accesss</li>
        </a><a href="">
          <li>reservation</li>
        </a><a href="">
          <li>contact</li>
        </a>
      </ul>
    </div>

    <div class="studio services">
      <div class="service-title rl tween-opa">
        <p>スタジオエイチシ<span class="serif">ー</span></p>
        <h3>studio HC</h3>
      </div>
      <img class="room-photo" src="<?php echo get_template_directory_uri(); ?>/library/images/1x/0412-1.JPG"
           secret="<?php echo get_template_directory_uri(); ?>/library/images/1x/studio_01-100.jpg 1x,
<?php echo get_template_directory_uri(); ?>/library/images/2x/studio_01@2x-100.jpg 2x" alt="studio_01">
      <img class="roof tween-opa" src="<?php echo get_template_directory_uri(); ?>/library/images/SVG/roof.svg" alt="roof">
      <img class="icon_01 tween-opa" src="<?php echo get_template_directory_uri(); ?>/library/images/SVG/icon_01.svg"
           alt="icon_01.svg">
      <div class="desc tween-opa">
        <p>１時間 三五〇〇円</p>
        <p>３時間 九〇〇〇円</p>
        <p class="small">※税別</p>
        <a href="/space-studio"><p class="detail rl small">詳細はこちら</p></a>
      </div>
    </div>

    <div class="arrow-up">
      <img class="icon_08" src="<?php echo get_template_directory_uri(); ?>/library/images/SVG/icon_08.svg"
           alt="icon_08.svg">
      <img class="icon_08" src="<?php echo get_template_directory_uri(); ?>/library/images/SVG/icon_08.svg"
           alt="icon_08.svg">
      <img class="icon_08" src="<?php echo get_template_directory_uri(); ?>/library/images/SVG/icon_08.svg"
           alt="icon_08.svg">
    </div>

    <div class="space services">
      <div class="service-title rl tween-opa">
        <p>スペースエイチシ<span class="serif">ー</span></p>
        <h3>space HC</h3>
      </div>
      <img class="room-photo room-photo2" src="<?php echo get_template_directory_uri(); ?>/library/images/1x/IMG_4823.jpg"
           secret="<?php echo get_template_directory_uri(); ?>/library/images/1x/studio_02-100.jpg 1x,
<?php echo get_template_directory_uri(); ?>/library/images/2x/studio_02@2x-100.jpg 2x" alt="studio_02">
      <img class="roof roof2 tween-opa" src="<?php echo get_template_directory_uri(); ?>/library/images/SVG/roof.svg" alt="roof">
      <img class="icon_02 tween-opa" src="<?php echo get_template_directory_uri(); ?>/library/images/SVG/icon_02.svg"
           alt="icon_02.svg">
      <div class="desc tween-opa">
        <p>１時間 三〇〇〇円</p>
        <p>３時間 八〇〇〇円</p>
        <p class="small">※税別</p>
        <a href="/space-hc"><p class="detail rl small">詳細はこちら</p></a>
      </div>
    </div>

      <?php
      $wp_query = new WP_Query(
          array(
              'post_type' => 'tour',
          )
      ); ?>
      <?php if (have_posts()): while (have_posts()): the_post(); ?>

          <?php
// 表示日数設定
          $num = 20;
//if($_POST['num']) { $num = $_POST['num']; }
          $nums = array('14', '20', '30', '40');
// 現在の日付を設定
          $year = date('Y');
          $month = date('n');
          $day = date('j');
          $date = mktime(0, 0, 0, $month, $day, $year);
          $today = $date;
// ページ送りの日付を設定
          $year = date("Y", $date);
          $month = date("n", $date);
          $day = date("j", $date);
          ?>

        <div class="calendar">
          <div class="calender-icon">
            <div class="apple">
              <img class="icon_03" src="<?php echo get_template_directory_uri(); ?>/library/images/SVG/icon_03.svg"
                   alt="icon_03.svg">
              <img class="icon_03" src="<?php echo get_template_directory_uri(); ?>/library/images/SVG/icon_03.svg"
                   alt="icon_03.svg">
            </div>
            <div class="triangle">
              <img class="icon_04" src="<?php echo get_template_directory_uri(); ?>/library/images/SVG/icon_04.svg"
                   alt="icon_04.svg">
              <img class="icon_04" src="<?php echo get_template_directory_uri(); ?>/library/images/SVG/icon_04.svg"
                   alt="icon_04.svg">
              <img class="icon_04" src="<?php echo get_template_directory_uri(); ?>/library/images/SVG/icon_04.svg"
                   alt="icon_04.svg">
            </div>
          </div>
          <div class="this-month">
            <div class="thismonth-nav"><a><span class="">今月</span></a></div>
            <div class="nextmonth-nav"><a><span class="">翌月</span></a></div>

              <?php
              echo output_single_calendar(date('Y'), date('n'));
              ?>

          </div>

          <div class="next-month hidden">
            <div class="thismonth-nav"><a><span class="">今月</span></a></div>
            <div class="nextmonth-nav"><a><span class="">翌月</span></a></div>

              <?php
              echo output_single_calendar(date('Y'), date('n') + 1);
              ?>

          </div>
        </div>

      <?php endwhile;
          wp_reset_query(); ?>
      <?php endif; ?>


      <?php
      function output_single_calendar($year, $month)
      {
          global $post;

          //翌月、翌々月が年をまたぐ場合
          if ($month > 12) {
              $year = $year + 1;
              $month = $month - 12;
          }
          //月末日の取得
          $l_day = date('t', strtotime($year . sprintf('%02d', $month) . '01'));
          //月初日の曜日の取得
          $first_week = date('w', strtotime($year . sprintf('%02d', $month) . '01'));
          //祝日を取得
          $holidays = japan_holiday_ics(date('Y'));
          $kan_month = num12kan($month);
          $old_month = old_month($month);

          $calendar = <<<EOM
<table class="mb15">
  <p class="kanji-month">{$kan_month}</p>
  <p class="old-month rl">{$old_month}</p>
  <tr class="border_tb opa-gray week_day">
    <th class="border_l text-bold">日</th>
    <th class="border_l text-bold">月</th>
    <th class="border_l text-bold">火</th>
    <th class="border_l text-bold">水</th>
    <th class="border_l text-bold">木</th>
    <th class="border_l text-bold">金</th>
    <th class="border_l text-bold">土</th>
  </tr>
EOM;
          /* calendar body start */
          for ($i = 1; $i <= $l_day + $first_week; $i++) {
              $day = $i - $first_week;
              if ($i % 7 == 1) {
                  $calendar .= '<tr class="border_b">' . "\n";
              }
              if ($day <= 0) {
                  $calendar .= '<th class="border_l">&nbsp;</th>' . "\n";
              } else {
                  if (mktime(0, 0, 0, $month, $day, $year) == mktime(0, 0, 0, date('n'), date('j'), date('Y'))) {
                      $class = ' class="today border_l"';
                  } elseif (date('w', mktime(0, 0, 0, $month, $day, $year)) == 0) {
                      $class = ' class="sun"';
                  } elseif (!empty($holidays[date("Ymd", mktime(0, 0, 0, $month, $day, $year))])) {
                      $class = ' class="holiday border_l"';
                  } else {
                      $class = ' class="border_l"';
                  }
                  $calendar .= '<th' . $class . '>';
                  $calendar .= '<span class="day" style="display:block;">' . $day . '</span>';
                  for ($j = 0; $j <= 9; $j++) {
                      $key = 'date' . $year . sprintf('%02d', $month) . sprintf('%02d', $day) . '-' . $j;
                      $value = get_post_meta($post->ID, $key, true);
                      if ($value == 0) {
                          $value = '<span class="off time_zone">0</span>';
                      } elseif (!$value) {
                          $value = '<span class="undecided">-</span>';
                      } elseif ($value == 1) {
                          $value = '<span class="undecided time_zone">1</span>';
                      }
                      $calendar .= $value;
                  }
                  $calendar .= '</th>' . "\n";
              }
          }

          if ($i % 7 > 1) {
              for ($td = 0; $td <= 7 - ($i % 7); $td++) {
                  $calendar .= '<th class="border_l">&nbsp;</th>' . "\n";
              }
          }
          $calendar .= '</tr>' . "\n";
          /* calendar body end   */
          $calendar .= '</table>' . "\n";
          return $calendar;
      }

      ?>

    <div class="two-lines">
      <img class="icon_05" src="<?php echo get_template_directory_uri(); ?>/library/images/SVG/icon_05.svg"
           alt="icon_05.svg">
      <img class="icon_05" src="<?php echo get_template_directory_uri(); ?>/library/images/SVG/icon_05.svg"
           alt="icon_05.svg">
      <img class="icon_05" src="<?php echo get_template_directory_uri(); ?>/library/images/SVG/icon_05.svg"
           alt="icon_05.svg">
    </div>

    <div class="floor-map">
      <img class="icon_06" src="<?php echo get_template_directory_uri(); ?>/library/images/SVG/icon_06.svg"
           alt="icon_06.svg">
    </div>
    <div class="arrow-under">
      <img class="icon_07" src="<?php echo get_template_directory_uri(); ?>/library/images/SVG/icon_07.svg"
           alt="icon_07.svg">
    </div>

    <div class="contact__form">
      <form id="contact-submit" action="mail.php" method="POST">
        <div class="contact__radio">
          <h1 class="contact__radio-title">
             連絡する
          </h1>
          <ul class="contact__radio-list">
            <li class="contact__radio-item">
              <input class="contact__radio-item-radio js-contact-option-qtype" type="radio" name="お問い合わせ種別" id="contact01" value="space" checked="">
              <label class="contact__radio-item-label" for="contact01">
                <img src="<?php echo get_template_directory_uri(); ?>/library/images/icon/design.svg" alt="">
                space
              </label>
            </li>
            <li class="contact__radio-item">
              <input class="contact__radio-item-radio js-contact-option-qtype" type="radio" name="お問い合わせ種別" id="contact02" value="studio">
              <label class="contact__radio-item-label" for="contact02">              <img src="<?php  echo get_template_directory_uri();?>/library/images/icon/photomovie.svg" alt="">
                studio</label>
            </li>
            <li class="contact__radio-item">
              <input class="contact__radio-item-radio js-contact-option-qtype" type="radio" name="お問い合わせ種別" id="contact03" value="内見希望">
              <label class="contact__radio-item-label" for="contact03">              <img src="<?php  echo get_template_directory_uri();?>/library/images/icon/web.svg" alt="">
                内見希望</label>
            </li>
            <li class="contact__radio-item">
              <input class="contact__radio-item-radio js-contact-option-qtype" type="radio" name="お問い合わせ種別" id="contact04" value="撮影プランご希望の方">
              <label class="contact__radio-item-label" for="contact04">
                <img src="<?php echo get_template_directory_uri(); ?>/library/images/icon/space.svg" alt="">
                撮影プランご希望の方</label>
            </li>
          </ul>
        </div>
        <div class="contact__body">
          <ul class="contact__body-list">
            <li class="contact__body-item" data-validation="required">
              <label class="contact__body-item-label" for="name">名前<span class="contact__body-item-required">*</span>
              </label>
              <input class="contact__body-item-input" type="text" name="名前" id="name">
              <p class="contact__body-item-error">お名前をご入力してください</p>
            </li>
            <li class="contact__body-item">
              <label class="contact__body-item-label" for="group">会社名・学校名                </label>
              <input class="contact__body-item-input" type="text" name="会社名・学校名" id="group">
              <p class="contact__body-item-error">必要事項を入力してください。</p>
            </li>
            <li class="contact__body-item" data-validation="required">
              <label class="contact__body-item-label" for="email">メール<span class="contact__body-item-required">*</span>
              </label>
              <input class="contact__body-item-input" type="email" name="メール" id="email">
              <p class="contact__body-item-error">ご連絡先をご入力してください</p>
            </li>
            <li class="contact__body-item" data-validation="">
              <label class="contact__body-item-label" for="tel">電話                </label>
              <input class="contact__body-item-input" type="tel" name="電話" id="tel">
              <p class="contact__body-item-error">必要事項を入力してください。</p>
            </li>
          </ul>
          <div class="contact__body-wide" data-validation="required">
            <label class="contact__body-item-label" for="subject">ご利用予定日<span class="contact__body-item-required">*</span></label>
            <input class="contact__body-item-input" id="subject" type="text" name="ご利用予定日">
            <p class="contact__body-item-error">お問い合せ件名をご入力ください</p>
          </div>
          <div class="contact__body-wide" data-validation="required">
            <label class="contact__body-item-label" for="body">用途・要望<span class="contact__body-item-required">*</span></label>
            <textarea class="contact__body-item-textarea" id="body" name="用途・要望"></textarea>
            <p class="contact__body-item-error">ご利用用途やご要望をご入力ください</p>
          </div>
          <p class="contact__body-button">
            <input class="contact__body-item-submit" type="submit" value="確認する">
          </p>
        </div>
      </form>
    </div>

    <ul class="instagram"></ul>


  </div>
<?php
get_footer();