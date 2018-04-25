<?php

get_header(); ?>

<?php if (have_posts()): while (have_posts()): the_post();
    $event_img = get_field('event_img');
    $event_date1 = get_field('event_date1');
    $event_date2 = get_field('event_date2');
    $event_place = get_field('event_place');

    ?>


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
//if( $_POST['date'] ) { $date = $_POST['date']; }
//if( $_POST['action']=='prev' ) { $date = $date-($num*60*60*24); }
//if( $_POST['action']=='next' ) { $date = $date+($num*60*60*24); }
    $year = date("Y", $date);
    $month = date("n", $date);
    $day = date("j", $date);
    ?>

    <?php get_sidebar(); ?>
  <div class="large-12 small-12 cell">
    <div class="grid-x">
      <div class="large-16 small-12 cell border_lb">
        <div class="inner-texts mb30 pt30_sp">
          <h2 class="text-bold">ギャラリーツアーカレンダー</h2>
        </div>
      </div>
      <div class="large-16 small-12 cell border_lb border_b_sp">
        <div class="grid-x">
          <div class="large-14 ie12 small-12 cell">
            <div class="event-calender inner-texts mb100 This">
              <div class="thismonth-nav opa05"><a class="this-month"><span class="arrow-x2">今月</span></a></div>
              <div class="nextmonth-nav"><a class="next-month"><span class="arrow-x">翌月</span></a></div>

                <?php
                echo output_single_calendar(date('Y'), date('n'));
                ?>

              <p><span class="text-bold">AM</span> ： 午前11時～　<span class="text-bold">PM</span> ： 午後2時～　- ： お休み</p>
            </div>

            <div class="event-calender inner-texts mb100 Next">
              <div class="thismonth-nav"><a class="this-month"><span class="arrow-x2">今月</span></a></div>
              <div class="nextmonth-nav"><a class="next-month"><span class="arrow-x">翌月</span></a></div>

                <?php
                echo output_single_calendar(date('Y'), date('n') + 1);
                ?>

              <p><span class="text-bold">AM</span> ： 午前11時～　<span class="text-bold">PM</span> ： 午後2時～　- ： お休み</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php endwhile; ?>
<?php else: ?>
    <?php wp_redirect(get_bloginfo('siteurl') . '/404', 404);
    exit; ?>
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

    $calendar = <<<EOM
<table class="mb15">
  <caption>{$year}.{$month}</caption>
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
    //$calendar .= '<p class="summary">◯…予約可能　×…予約不可</p>'."\n";
    return $calendar;
}

?>
<?php get_footer();
