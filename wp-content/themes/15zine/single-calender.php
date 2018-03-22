<?php get_header(); ?>

    <div id="content" class="reservation-content">

        <main id="main" role="main">
            <section class="reservation-single">

                <?php if ( have_posts() ): ?>
                    <header class="page-header">
                        <h1 class="page-title">予約状況<a href="<?php echo home_url();?>/reservation/"><small>一覧へ</small></a></h1>
                    </header>

                    <?php
// 表示日数設定
                    $num = 20;
//if($_POST['num']) { $num = $_POST['num']; }
                    $nums = array('14','20','30','40');
// 現在の日付を設定
                    $year	 = date('Y');
                    $month	 = date('n');
                    $day	 = date('j');
                    $date = mktime(0,0,0,$month,$day,$year);
                    $today = $date;
// ページ送りの日付を設定
//if( $_POST['date'] ) { $date = $_POST['date']; }
//if( $_POST['action']=='prev' ) { $date = $date-($num*60*60*24); }
//if( $_POST['action']=='next' ) { $date = $date+($num*60*60*24); }
                    $year	 = date("Y", $date);
                    $month	 = date("n", $date);
                    $day	 = date("j", $date);
                    ?>

                    <div class="reservationSingle">

                        <?php /* main loop start */ while ( have_posts() ): the_post(); ?>
                            <div class="profile">
                                <?php echo wp_get_attachment_image(post_custom('photo'), array(200,250)); ?>
                                <h2 class="name"><?php the_id(); ?> <small><?php echo get_post_meta($post->ID, 'kana', true); ?></small></h2>
                                <p class="course"><strong>担当科目</strong> : <?php echo get_post_meta($post->ID, 'course', true); ?></p>
                                <div class="introduction"><?php echo nl2br(get_the_content()); ?></div>
                            </div>
                            <?php
                            echo output_single_calendar(date('Y'),date('n'));
                            echo output_single_calendar(date('Y'),date('n')+1);
                            ?>
                        <?php /* main loop end   */ endwhile; ?>
                    </div>

                <?php else: ?>

                    <article>
                        <header class="page-header">
                            <h1 class="page-title">Not found.</h1>
                        </header>
                        <div class="page-content notfound">
                            <p>お探しのページが見つかりませんでした。検索をお試しください。</p>
                            <?php get_search_form(); ?>
                        </div><!-- .page-content -->
                    </article>

                <?php endif; ?>

                <p class="backToList"><a href="../">一覧ページに戻る</a></p>

            </section>
        </main>

    </div><!-- #content -->

<?php get_footer(); ?>
<?php
function output_single_calendar($year,$month) {
    global $post;

    //翌月、翌々月が年をまたぐ場合
    if( $month > 12 ) { $year = $year+1; $month = $month-12; }
    //月末日の取得
    $l_day = date('t', strtotime($year.sprintf('%02d',$month).'01'));
    //月初日の曜日の取得
    $first_week = date('w',strtotime($year.sprintf('%02d',$month).'01'));
    //祝日を取得
    $holidays = japan_holiday_ics(date('Y'));

    $calendar = <<<EOM
<table>
	<caption>{$year}年{$month}月</caption>
	<tr>
		<th class="sun">日</th>
		<th>月</th>
		<th>火</th>
		<th>水</th>
		<th>木</th>
		<th>金</th>
		<th>土</th>
	</tr>
EOM;
    /* calendar body start */
    for( $i=1; $i<=$l_day+$first_week; $i++ ) {
        $day = $i-$first_week;
        if( $i%7 == 1 ) { $calendar .= '<tr>'."\n"; }
        if( $day <= 0 ) {
            $calendar .= '<td>&nbsp;</td>'."\n";
        } else {
            $key = 'date'.$year.sprintf('%02d',$month).sprintf('%02d',$day);
            $value = get_post_meta($post->ID, $key, true);
            if( $value == '休' ) { $value = '<span class="off">休業日</span>'; }
            elseif( !$value ) { $value = '<span class="undecided">未設定</span>'; }
            if( mktime(0,0,0,$month,$day,$year) == mktime(0,0,0,date('n'),date('j'),date('Y')) ) { $class=' class="today"'; }
            elseif( date('w',mktime(0,0,0,$month,$day,$year)) == 0 ) { $class=' class="sun"'; }
            elseif( !empty($holidays[date("Ymd", mktime(0,0,0,$month,$day,$year))]) ) { $class=' class="holiday"'; }
            else { $class = ''; }
            $calendar .= '<td'.$class.'>';
            $calendar .= '<span class="day">'.$day.'</span>';
            $calendar .= $value;
            $calendar .= '</td>'."\n";
        }
    }
    if( $i%7 > 1 ) {
        for( $td=0; $td<=7-($i%7); $td++) {
            $calendar .= '<td>&nbsp;</td>'."\n";
        }
    }
    $calendar .= '</tr>'."\n";
    /* calendar body end   */
    $calendar .= '</table>'."\n";
    $calendar .= '<p class="summary">◯…予約可能　×…予約不可</p>'."\n";
    return $calendar;
}
?>