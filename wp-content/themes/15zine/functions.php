<?php
define('CB_VER', '3.0.2');

/************* LOAD NEEDED FILES ***************/

require_once get_template_directory() . '/library/core.php';
require_once get_template_directory() . '/library/translation/translation.php';
add_filter('ot_show_pages', '__return_false');
add_filter('ot_show_new_layout', '__return_false');
add_filter('ot_theme_mode', '__return_true');
add_filter('ot_post_formats', '__return_true');

load_template(get_template_directory() . '/option-tree/ot-loader.php');
load_template(get_template_directory() . '/library/admin/cb-meta-boxes.php');
load_template(get_template_directory() . '/library/admin/cb-to.php');
require_once get_template_directory() . '/library/admin/cb-tgm.php';
require_once get_template_directory() . '/library/admin/extensions/github.php';
require_once get_template_directory() . '/library/admin/extensions/class-aqua-resizer.php';

/************* THUMBNAIL SIZE OPTIONS *************/
if (!function_exists('cb_image_thumbnails')) {
    function cb_image_thumbnails()
    {
        if (ot_get_option('cb_fi_100x65', 'on') == 'on') {
            add_image_size('cb-100-65', 100, 65, true); // Widgets
        }

        if (ot_get_option('cb_fi_260x170', 'on') == 'on') {
            add_image_size('cb-260-170', 260, 170, true); // Megamenu
        }

        if (ot_get_option('cb_fi_360x490', 'on') == 'on') {
            add_image_size('cb-360-490', 360, 490, true); // Portrait thumbnails
        }

        if (ot_get_option('cb_fi_360x240', 'on') == 'on') {
            add_image_size('cb-360-240', 360, 240, true); // Blog Style A/Mega menu
        }

        if (ot_get_option('cb_fi_378x300', 'on') == 'on') {
            add_image_size('cb-378-300', 378, 300, true); // Slider C, Grid small thumbnails
        }

        if (ot_get_option('cb_fi_759x300', 'on') == 'on') {
            add_image_size('cb-759-300', 759, 300, true); // Grid Medium thumbnails, Grid 3 Static Big Thumbnail
        }

        if (ot_get_option('cb_fi_759x500', 'on') == 'on') {
            add_image_size('cb-759-500', 759, 500, true); // Slider B, Standard featured image, Blog Style D/F/G, Module D
        }

        if (ot_get_option('cb_fi_759x600', 'on') == 'on') {
            add_image_size('cb-759-600', 759, 600, true); // Grid big thumbnails
        }

        if (ot_get_option('cb_fi_1400x600', 'on') == 'on') {
            add_image_size('cb-1400-600', 1400, 600, true); // Parallax/Full screen/Full screen slider
        }

    }
}

add_action('after_setup_theme', 'cb_image_thumbnails');

/*********************
 * SET CONTENT WIDTH
 *********************/
if (!function_exists('cb_15zine_content_width')) {
    function cb_15zine_content_width()
    {
        $GLOBALS['content_width'] = apply_filters('cb_15zine_content_width', 1200);
    }
}
add_action('after_setup_theme', 'cb_15zine_content_width', 0);

if (function_exists('buddypress')) {

    if (!defined('BP_AVATAR_FULL_WIDTH')) {
        define('BP_AVATAR_FULL_WIDTH', 150);
    }

    if (!defined('BP_AVATAR_FULL_HEIGHT')) {
        define('BP_AVATAR_FULL_HEIGHT', 150);
    }

    if (!defined('BP_AVATAR_THUMB_HEIGHT')) {
        define('BP_AVATAR_THUMB_HEIGHT', 80);
    }

    if (!defined('BP_AVATAR_THUMB_WIDTH')) {
        define('BP_AVATAR_THUMB_WIDTH', 80);
    }

}

/*********************
 * SCRIPTS & ENQUEUEING
 *********************/
add_action('after_setup_theme', 'cb_script_loaders', 15);

if (!function_exists('cb_script_loaders')) {
    function cb_script_loaders()
    {
        // enqueue base scripts and styles
        add_action('wp_enqueue_scripts', 'cb_scripts_and_styles', 999);
        // enqueue admin scripts and styles
        add_action('admin_enqueue_scripts', 'cb_post_admin_scripts_and_styles');
        // ie conditional wrapper
        add_filter('style_loader_tag', 'cb_ie_conditional', 10, 2);
        add_editor_style('library/admin/css/cb-editor.css');
    }
}

if (!function_exists('cb_scripts_and_styles')) {
    function cb_scripts_and_styles()
    {
        if (!is_admin()) {
            // Modernizr (without media query polyfill)
            wp_register_script('cb-modernizr', get_template_directory_uri() . '/library/js/modernizr.custom.min.js', array(), '2.6.2', false);
            wp_enqueue_script('cb-modernizr'); // enqueue it

            $cb_responsive_style = ot_get_option('cb_responsive_onoff', 'on');
            if (ot_get_option('cb_sliders_autoplay', 'on') == 'off') {
                $cb_slider_1 = false;
            } else {
                $cb_slider_1 = true;
            }
            $cb_slider = array(ot_get_option('cb_sliders_animation_speed', '600'), $cb_slider_1, ot_get_option('cb_sliders_speed', '7000'), ot_get_option('cb_sliders_hover_pause', 'on'));

            if (ot_get_option('cb_max_theme_width', 'default') == 'onesmaller') {
                $cb_site_size = '1020px';
            } else {
                $cb_site_size = NULL;
            }

            if ($cb_responsive_style == 'on') {
                if (is_rtl()) {
                    $cb_style_name = 'style-rtl' . $cb_site_size;
                } else {
                    $cb_style_name = 'style' . $cb_site_size;
                }
            } else {
                if (is_rtl()) {
                    $cb_style_name = 'style-rtl-unres' . $cb_site_size;
                } else {
                    $cb_style_name = 'style-unres' . $cb_site_size;
                }
            }

            if (is_singular()) {
                global $post;
                $cb_post_id = $post->ID;
            } else {
                $cb_post_id = NULL;
            }

            // Register main stylesheet
            wp_enqueue_style('cb-main-stylesheet', cb_file_location('library/css/' . $cb_style_name . '.css'), array(), CB_VER, 'all');
            $cb_font = cb_fonts();
            wp_enqueue_style('cb-font-stylesheet', $cb_font[0], array(), CB_VER, 'all');
            // ie-only stylesheet
            wp_enqueue_style('cb-ie-only', get_template_directory_uri() . '/library/css/ie.css', array(), CB_VER);
            // register font awesome stylesheet
            wp_enqueue_style('fontawesome', get_template_directory_uri() . '/library/css/font-awesome-4.6.3/css/font-awesome.min.css', array(), '4.6.3', 'all');
            if (class_exists('Woocommerce')) {
                wp_enqueue_style('cb-woocommerce-stylesheet', get_template_directory_uri() . '/woocommerce/css/woocommerce.css', array(), CB_VER, 'all');
            }
            if (is_single()) {
                if (get_post_meta($cb_post_id, 'cb_review_checkbox', true) != NULL) {
                    wp_enqueue_script('cb-cookie', get_template_directory_uri() . '/library/js/cookie.min.js', array('jquery'), CB_VER, true);
                }
            }
            // Add slider plugin theme and script
            // css
            wp_enqueue_style('swiper-css', cb_file_location('library/css/swiper.min.css'), array(), CB_VER, 'all');
            wp_enqueue_style('space-hc', cb_file_location('library/css/style-spacehc.css'), array(), CB_VER, 'all');

            // script
            wp_enqueue_script('swiper-js', get_template_directory_uri() . '/library/js/swiper.min.js', array('jquery'), CB_VER, true);
            wp_enqueue_script('frontpage-js', get_template_directory_uri() . '/library/js/frontpage.js', array('jquery'), CB_VER, true);
            wp_enqueue_script('inview-js', get_template_directory_uri() . '/library/js/jquery.inview.min.js', array('jquery'), CB_VER, true);
            wp_enqueue_script('TweenMax-js', get_template_directory_uri() . '/library/js/TweenMax.min.js', array('jquery'), CB_VER, true);

            // comment reply script for threaded comments
            if (is_singular() && comments_open() && (get_option('thread_comments') == 1)) {
                global $wp_scripts;
                $wp_scripts->add_data('comment-reply', 'group', 1);
                wp_enqueue_script('comment-reply');
            }
            // Load Extra Needed Javascript
            wp_enqueue_script('cb-js-ext', get_template_directory_uri() . '/library/js/cb-ext.js', array('jquery'), CB_VER, true);
            wp_localize_script('cb-js-ext', 'cbExt', array('cbLb' => ot_get_option('cb_lightbox_onoff', 'on')));
            // Load scripts
            $cb_minify_js_onoff = ot_get_option('cb_minify_js_onoff', 'on');
            if ($cb_minify_js_onoff != 'off') {
                wp_enqueue_script('cb-js', get_template_directory_uri() . '/library/js/cb-scripts.min.js', array('jquery', 'cb-js-ext'), CB_VER, true);
            } else {
                wp_enqueue_script('cb-js', get_template_directory_uri() . '/library/js/cb-scripts.source.js', array('jquery', 'cb-js-ext'), CB_VER, true);
            }

            wp_localize_script('cb-js', 'cbScripts', array('cbUrl' => admin_url('admin-ajax.php'), 'cbPostID' => $cb_post_id, 'cbFsClass' => 'cb-embed-fs', 'cbSlider' => $cb_slider, 'cbALlNonce' => wp_create_nonce('cbALlNonce'), 'cbPlURL' => plugins_url(), 'cbShortName' => ot_get_option('cb_disqus_shortname', NULL)));
        }
    }
}
add_filter('woocommerce_enqueue_styles', '__return_empty_array');

if (!function_exists('cb_post_admin_scripts_and_styles')) {
    function cb_post_admin_scripts_and_styles($hook)
    {
        if ($hook == 'post.php' || $hook == 'post-new.php' || $hook == 'edit-tags.php' || $hook == 'profile.php' || $hook == 'appearance_page_ot-theme-options' || $hook == 'user-edit.php' || $hook == 'appearance_page_radium_demo_installer' || $hook == 'edit-tags.php' || $hook == 'widgets.php') {

            wp_enqueue_script('admin-js', get_template_directory_uri() . '/library/admin/js/cb-admin.js', array(), CB_VER, true);
            wp_enqueue_style('cb-admin-ext', get_template_directory_uri() . '/library/admin/css/cb-admin-ext.css', array(), CB_VER);
            wp_enqueue_style('fontawesome', get_template_directory_uri() . '/library/css/font-awesome-4.6.3/css/font-awesome.min.css', array(), '4.6.3', 'all');
            wp_enqueue_script('suggest');
        }

        if (($hook == 'edit-tags.php') || ($hook == 'term.php')) {

            wp_enqueue_style('wp-color-picker');
            wp_enqueue_script('wp-color-picker');
        }

    }
}

// adding the conditional wrapper around ie8 stylesheet
// source: Gary Jones - http://code.garyjones.co.uk/ie-conditional-style-sheets-wordpress/
// GPLv2 or newer license
if (!function_exists('cb_ie_conditional')) {
    function cb_ie_conditional($tag, $handle)
    {
        if (('cb-ie-only' == $handle) || ('cb-select' == $handle)) {
            $tag = '<!--[if lt IE 10]>' . "\n" . $tag . '<![endif]-->' . "\n";
        }
        return $tag;
    }
}

// Sidebars & Widgetizes Areas
if (!function_exists('cb_register_sidebars')) {
    function cb_register_sidebars()
    {
        $cb_footer_layout = ot_get_option('cb_footer_layout', 'cb-footer-a');
        // Main Sidebar
        register_sidebar(array(
            'name' => 'Global Sidebar',
            'id' => 'sidebar-global',
            'before_widget' => '<div id="%1$s" class="cb-sidebar-widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="cb-sidebar-widget-title cb-widget-title">',
            'after_title' => '</h3>'
        ));
        // Footer Widget 1
        register_sidebar(array(
            'name' => 'Footer 1',
            'id' => 'footer-1',
            'before_widget' => '<div id="%1$s" class="cb-footer-widget clearfix %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="cb-footer-widget-title cb-widget-title">',
            'after_title' => '</h3>'
        ));
        if ($cb_footer_layout != 'cb-footer-e') {
            // Footer Widget 2
            register_sidebar(array(
                'name' => 'Footer 2',
                'id' => 'footer-2',
                'before_widget' => '<div id="%1$s" class="cb-footer-widget clearfix %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<h3 class="cb-footer-widget-title cb-widget-title">',
                'after_title' => '</h3>'
            ));
        }
        if (($cb_footer_layout != 'cb-footer-e') && ($cb_footer_layout != 'cb-footer-f')) {
            // Footer Widget 3
            register_sidebar(array(
                'name' => 'Footer 3',
                'id' => 'footer-3',
                'before_widget' => '<div id="%1$s" class="cb-footer-widget clearfix %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<h3 class="cb-footer-widget-title cb-widget-title">',
                'after_title' => '</h3>'
            ));
        }
        if ($cb_footer_layout == 'cb-footer-b') {
            // Footer Widget 4
            register_sidebar(array(
                'name' => 'Footer 4',
                'id' => 'footer-4',
                'before_widget' => '<div id="%1$s" class="cb-footer-widget clearfix %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<h3 class="cb-footer-widget-title cb-widget-title">',
                'after_title' => '</h3>'
            ));
        }
        register_sidebar(
            array(
                'name' => '15Zine Multi-Widgets Area',
                'id' => 'cb_multi_widgets',
                'description' => '1- Drag multiple widgets here 2- Drag the "15Zine Multi-Widget Widget" to the sidebar where you want to show the multi-widgets.',
                'before_widget' => '<div id="%1$s" class="widget cb-multi-widget tabbertab %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<h3 class="cb-widget-title">',
                'after_title' => '</h3>'
            )
        );


        register_sidebar(array(
            'name' => '15Zine Footer Instagram Area',
            'id' => 'cb-under-footer',
            'description' => 'Can be used for any widgets, but intended for Instagram one. Install the free "WP Instagram Widget" plugin and drag the widget in here.',
            'before_widget' => '<div id="%1$s" class="cb-footer-widget clearfix %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="cb-footer-widget-title cb-widget-title">',
            'after_title' => '</h3>'
        ));

        if (class_exists('Woocommerce')) {
            register_sidebar(array(
                'name' => '15Zine WooCommerce Sidebar',
                'id' => 'sidebar-woocommerce',
                'before_widget' => '<div id="%1$s" class="cb-sidebar-widget %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<h3 class="cb-sidebar-widget-title cb-widget-title">',
                'after_title' => '</h3>'
            ));
        }
        if (class_exists('bbPress')) {
            register_sidebar(array(
                'name' => '15Zine bbPress Sidebar',
                'id' => 'sidebar-bbpress',
                'before_widget' => '<div id="%1$s" class="cb-sidebar-widget %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<h3 class="cb-sidebar-widget-title cb-widget-title">',
                'after_title' => '</h3>'
            ));
        }

        if (function_exists('buddypress')) {
            register_sidebar(array(
                'name' => '15Zine BuddyPress Sidebar',
                'id' => 'sidebar-buddypress',
                'before_widget' => '<div id="%1$s" class="cb-sidebar-widget %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<h3 class="cb-sidebar-widget-title cb-widget-title">',
                'after_title' => '</h3>'
            ));
        }


        $cb_pages = get_pages(array('post_status' => array('publish', 'pending', 'private', 'draft')));
        foreach ($cb_pages as $page) {

            $cb_page_sidebar = get_post_meta($page->ID, 'cb_page_custom_sidebar_type', true);
            $cb_page_template = get_post_meta($page->ID, '_wp_page_template', true);

            if ($cb_page_sidebar == 'cb_unique_sidebar') {
                register_sidebar(array(
                    'name' => $page->post_title . ' (Page)',
                    'id' => 'page-' . $page->ID . '-sidebar',
                    'description' => 'This is the ' . $page->post_title . ' sidebar',
                    'before_widget' => '<div id="%1$s" class="cb-sidebar-widget %2$s">',
                    'after_widget' => '</div>',
                    'before_title' => '<h3 class="cb-sidebar-widget-title cb-widget-title">',
                    'after_title' => '</h3>'
                ));
            }

            if ($cb_page_template == 'page-15zine-builder.php') {

                // Homepage Section B Sidebar
                register_sidebar(array(
                    'name' => 'Section B Sidebar (' . $page->post_title . ' page)',
                    'id' => 'sidebar-hp-b-' . $page->ID,
                    'description' => 'Page: ' . $page->post_title,
                    'before_widget' => '<div id="%1$s" class="cb-sidebar-widget %2$s">',
                    'after_widget' => '</div>',
                    'before_title' => '<h3 class="cb-sidebar-widget-title cb-widget-title">',
                    'after_title' => '</h3>'
                ));
            }
        }

        if (function_exists('get_term_meta')) {
            $categories = get_categories(array('hide_empty' => 0));

            foreach ($categories as $category) {
                $cat_onoff = get_term_meta($category->cat_ID, 'cb_cat_sidebar', true);
                if ($cat_onoff == 'on') {
                    register_sidebar(array(
                        'name' => $category->cat_name,
                        'id' => $category->category_nicename . '-sidebar',
                        'description' => 'This is the ' . $category->cat_name . ' sidebar',
                        'before_widget' => '<div id="%1$s" class="cb-sidebar-widget %2$s">',
                        'after_widget' => '</div>',
                        'before_title' => '<h3 class="cb-sidebar-widget-title cb-widget-title">',
                        'after_title' => '</h3>'
                    ));
                }

            }
        }
        $cb_cpt_output = cb_get_custom_post_types();
        $cb_qry = new WP_Query(array('post_status' => array('publish', 'pending', 'private', 'draft'), 'post_type' => 'post', 'posts_per_page' => 30, 'meta_key' => 'cb_post_custom_sidebar_type', 'meta_value' => 'cb_unique_sidebar'));
        if ($cb_qry->have_posts()) : while ($cb_qry->have_posts()) : $cb_qry->the_post();
            global $post;
            $cb_sidebar_type = get_post_meta($post->ID, 'cb_post_sidebar', true);

            if ($cb_sidebar_type == 'off') {
                $cb_post_title = get_the_title($post->ID);

                register_sidebar(array(
                    'name' => $cb_post_title . ' (Post)',
                    'id' => 'post-' . $post->ID . '-sidebar',
                    'description' => 'This is the ' . $cb_post_title . ' sidebar',
                    'before_widget' => '<div id="%1$s" class="cb-sidebar-widget %2$s">',
                    'after_widget' => '</div>',
                    'before_title' => '<h3 class="cb-sidebar-widget-title cb-widget-title">',
                    'after_title' => '</h3>'
                ));
            }

        endwhile;
        endif;
        wp_reset_postdata();
    }
}
add_action('widgets_init', 'cb_register_sidebars');


if (class_exists('Cubell_Functionality')) {

    function cb_outdated_plugin_notice()
    {

        echo '<div class="error"><p>' . __('15Zine no longer requires Cubell Themes Functionality plugin, please delete it and instead install the new "15Zine Functionality" plugin, which can be done in Appearance -> Install Plugins.', 'cubell') . '</p></div>';

    }

    add_action('admin_notices', 'cb_outdated_plugin_notice');

}

if (!function_exists('cb_widgets')) {
    function cb_widgets()
    {

        require_once cb_file_location('library/widgets/cb-recent-posts-slider-widget.php');
        require_once cb_file_location('library/widgets/cb-widget-social-media.php');
        require_once cb_file_location('library/widgets/cb-single-image-widget.php');
        require_once cb_file_location('library/widgets/cb-reviews-widget.php');
        require_once cb_file_location('library/widgets/cb-facebook-like-widget.php');
        require_once cb_file_location('library/widgets/cb-google-follow-widget.php');
        require_once cb_file_location('library/widgets/cb-multi-widget.php');
        require_once cb_file_location('library/widgets/cb-popular-posts-widget.php');
        require_once cb_file_location('library/widgets/cb-recent-posts-widget.php');
        require_once cb_file_location('library/widgets/cb-125-ads-widget.php');
    }
}
add_action('after_setup_theme', 'cb_widgets');


/* --------------------------------------------------
  営業日
-------------------------------------------------- */
add_action('admin_menu', 'add_schedule');

function add_schedule()
{
    if (function_exists('add_schedule')) {
        add_meta_box('schedule', '予約表', 'insert_schedule_open', 'open', 'normal', 'high');
        add_meta_box('schedule', 'イベント', 'insert_schedule_tour', 'tour', 'normal', 'high');
    }
}

function insert_schedule_open()
{
    global $post;
    wp_nonce_field(wp_create_nonce(__FILE__), 'my_nonce');
    echo '<p>営業状況を選択してください。【○】営業日　【×】休業日</p>';
    //当月＋2ヵ月分の入力フォームを表示
    echo output_cf_calendar_open(date('Y'), date('n'));
    echo output_cf_calendar_open(date('Y'), date('n') + 1);
    echo output_cf_calendar_open(date('Y'), date('n') + 2);
}

function output_cf_calendar_open($year, $month)
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
    //セレクトメニューオプション
    $menu_options = array('○', '×');
    //祝日を取得
    $holidays = japan_holiday_ics(date('Y'));
    //$holidays = [];

    $calendar = <<<EOM
<table class="calendar">
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
    for ($i = 1; $i <= $l_day + $first_week; $i++) {
        $day = $i - $first_week;
        if ($i % 7 == 1) {
            $calendar .= '<tr>' . "\n";
        }
        if ($day <= 0) {
            $calendar .= '<td>&nbsp;</td>' . "\n";
        } else {
            $key = 'date' . $year . sprintf('%02d', $month) . sprintf('%02d', $day);
            $value = get_post_meta($post->ID, $key, true);
            $weekday = date('w', mktime(0, 0, 0, $month, $day, $year));
            $isHoliday = !empty($holidays[date("Ymd", mktime(0, 0, 0, $month, $day, $year))]);
            $holiday = '';
            if ($isHoliday) {
                $holiday = $holidays[date("Ymd", mktime(0, 0, 0, $month, $day, $year))]['title'];
            }
            //$isHoliday = false;
            if (mktime(0, 0, 0, $month, $day, $year) == mktime(0, 0, 0, date('n'), date('j'), date('Y'))) {
                $class = ' class="today"';
            } elseif ($weekday == 0) {
                $class = ' class="sun"';
            } elseif ($isHoliday) {
                $class = ' class="holiday"';
            } else {
                $class = '';
            }
            $calendar .= '<td' . $class . '>';
            $calendar .= $day . ($isHoliday ? '<span class="holidayName">' . $holiday . '</span>' : '');
            $calendar .= '<br>';
            $calendar .= '<select name="' . $key . '">';
            $index = 0;
            foreach ($menu_options as $option) {
                $value = getOpenDefaultStatus($value, $year, $month, $day);
                if ($index == $value) {
                    $select = ' selected';
                } else {
                    $select = '';
                }
                $calendar .= '<option value="' . $index . '"' . $select . '>' . $option . '</option>';

                $index++;
            }
            $calendar .= '</select>';
            $calendar .= '</td>' . "\n";
        }
    }
    if ($i % 7 > 1) {
        for ($td = 0; $td <= 7 - ($i % 7); $td++) {
            $calendar .= '<td>&nbsp;</td>' . "\n";
        }
    }
    $calendar .= '</tr>' . "\n";
    $calendar .= '</table>' . "\n";
    return $calendar;
}

function getOpenDefaultStatus($status, $year, $month, $day)
{
    $weekday = date('w', mktime(0, 0, 0, $month, $day, $year));
    if ($status == -1 || $status == '' || !isset($status)) {
        $status = 0;
        if ($weekday == 1) {
            $status = 1;
        }
    }

    return $status;
}

function getTodayOpenStatus()
{

    $year = date('Y');
    $month = date('n');
    $day = date('j');
    return getOpenStatus($year, $month, $day);
}

function getOpenStatus($year, $month, $day)
{
    $key_today = 'date' . $year . sprintf('%02d', $month) . sprintf('%02d', $day);
    $weekday = date('w', mktime(0, 0, 0, $month, $day, $year));

    $args = array(
        'post_type' => 'open',
        'posts_per_page' => 1
    );
    $query = new WP_Query($args);

    $ret = 0;
    if ($query->have_posts()) {
        while ($query->have_posts()) : $query->the_post();

            $ret = get_post_meta(get_the_ID(), $key_today, true);

            break;

        endwhile;
    } else {
        $ret = 0;
    }

    $ret = getOpenDefaultStatus($ret, $year, $month, $day);

    return $ret;
}

/* --------------------------------------------------
  ギャラリーツアー
-------------------------------------------------- */
function insert_schedule_tour()
{
    global $post;
    wp_nonce_field(wp_create_nonce(__FILE__), 'my_nonce');
//    echo '<p>ギャラリーツアー開催状況を選択してください。<br>【◎】…午前11時〜、午後2時〜　【○】…午後2時〜　【△】…午前11時〜　【×】…お休み</p>';
    echo '<p>スタジオの予約状況を入力してください。<br>※予約済みの時間にチェックを入れてください。</p>';
    //当月＋2ヵ月分の入力フォームを表示
    echo output_cf_calendar_tour(date('Y'), date('n'));
    echo output_cf_calendar_tour(date('Y'), date('n') + 1);
//    echo output_cf_calendar_tour(date('Y'),date('n')+2);
}

/* --------------------------------------------------
  カスタムフィールドのカレンダー生成
-------------------------------------------------- */
function output_cf_calendar_tour($year, $month)
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
    //セレクトメニューオプション
//    $menu_options = array('◎','○','△','×');
    $menu_options = array('10', '11', '12', '13', '14', '15', '16', '17', '18', '19');
    //祝日を取得
    $holidays = japan_holiday_ics(date('Y'));
    //$holidays = [];

    $calendar = <<<EOM
<table class="calendar">
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
    for ($i = 1; $i <= $l_day + $first_week; $i++) {
        $day = $i - $first_week;
        if ($i % 7 == 1) {
            $calendar .= '<tr>' . "\n";
        }
        if ($day <= 0) {
            $calendar .= '<td>&nbsp;</td>' . "\n";
        } else {
            $weekday = date('w', mktime(0, 0, 0, $month, $day, $year));
            $isHoliday = !empty($holidays[date("Ymd", mktime(0, 0, 0, $month, $day, $year))]);
            $holiday = '';
            if ($isHoliday) {
                $holiday = $holidays[date("Ymd", mktime(0, 0, 0, $month, $day, $year))]['title'];
            }
            //$isHoliday = false;
            if (mktime(0, 0, 0, $month, $day, $year) == mktime(0, 0, 0, date('n'), date('j'), date('Y'))) {
                $class = ' class="today"';
            } elseif ($weekday == 0) {
                $class = ' class="sun"';
            } elseif ($isHoliday) {
                $class = ' class="holiday"';
            } else {
                $class = '';
            }
            $calendar .= '<td' . $class . '>';
            $calendar .= $day . ($isHoliday ? '<span class="holidayName">' . $holiday . '</span>' : '');
            $calendar .= '<br>';
//            $calendar .= '<select name="'.$key.'">';

            $index = 0;

            foreach ($menu_options as $option) {
                $key = 'date' . $year . sprintf('%02d', $month) . sprintf('%02d', $day) . '-' . $index;
                $value = get_post_meta($post->ID, $key, true);
//                $value = getTourDefaultStatus($value, $year, $month, $day);
//                echo $value;
                if ($value == 1) {
//                    $select = ' selected';
                    $check = ' checked';
                } else {
//                    $select = '';
                    $check = '';
                }
//                $calendar .= '<option value="'.$index.'"'.$select.'>'.$option.'</option>';
                $calendar .= '<input type="checkbox" name="' . $key . '"' . $check . '>' . $option;

                $index++;
            }
//            $calendar .= '</select>';
            $calendar .= '</td>' . "\n";
        }
    }
    if ($i % 7 > 1) {
        for ($td = 0; $td <= 7 - ($i % 7); $td++) {
            $calendar .= '<td>&nbsp;</td>' . "\n";
        }
    }
    $calendar .= '</tr>' . "\n";
    $calendar .= '</table>' . "\n";
    return $calendar;
}

function getTourDefaultStatus($status, $year, $month, $day)
{
    $weekday = date('w', mktime(0, 0, 0, $month, $day, $year));
    if ($status == -1 || $status == '' || !isset($status)) {
        $status = 0;
        if ($weekday == 1 || $weekday == 4) {
            $status = 3;
        }
    }

    return $status;
}

function getTodayTourStatus()
{

    $year = date('Y');
    $month = date('n');
    $day = date('j');
    return getTourStatus($year, $month, $day);
}

function getTourStatus($year, $month, $day)
{
    $key_today = 'date' . $year . sprintf('%02d', $month) . sprintf('%02d', $day);
    $weekday = date('w', mktime(0, 0, 0, $month, $day, $year));

    $args = array(
        'post_type' => 'tour',
        'posts_per_page' => 1
    );
    $query = new WP_Query($args);

    $ret = 0;
    if ($query->have_posts()) {
        while ($query->have_posts()) : $query->the_post();

            $ret = get_post_meta(get_the_ID(), $key_today, true);

            break;

        endwhile;
    } else {
        $ret = 0;
    }

    $ret = getTourDefaultStatus($ret, $year, $month, $day);

    return $ret;
}

/* --------------------------------------------------
  GoogleカレンダーからiCal形式で祝日を取得
-------------------------------------------------- */
function japan_holiday_ics($year)
{
    // カレンダーID
    $calendar_id = urlencode('japanese__ja@holiday.calendar.google.com');
    $url = 'https://calendar.google.com/calendar/ical/' . $calendar_id . '/public/full.ics';
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $result = curl_exec($ch);
    curl_close($ch);
    if (!empty($result)) {
        $items = $sort = array();
        $start = false;
        $count = 0;
        foreach (explode("\n", $result) as $row => $line) {
            // 1行目が「BEGIN:VCALENDAR」でなければ終了
            if (0 === $row && false === stristr($line, 'BEGIN:VCALENDAR')) {
                break;
            }
            // 改行などを削除
            $line = trim($line);
            // 「BEGIN:VEVENT」なら日付データの開始
            if (false !== stristr($line, 'BEGIN:VEVENT')) {
                $start = true;
            } elseif ($start) {
                // 「END:VEVENT」なら日付データの終了
                if (false !== stristr($line, 'END:VEVENT')) {
                    $start = false;
                    // 次のデータ用にカウントを追加
                    ++$count;
                } else {
                    // 配列がなければ作成
                    if (empty($items[$count])) {
                        $items[$count] = array('date' => null, 'title' => null);
                    }
                    // 「DTSTART;～」（対象日）の処理
                    if (0 === strpos($line, 'DTSTART;VALUE')) {
                        $date = explode(':', $line);
                        $date = end($date);
                        $items[$count]['date'] = $date;
                        // ソート用の配列にセット
                        $sort[$count] = $date;
                    } // 「SUMMARY:～」（名称）の処理
                    elseif (0 === strpos($line, 'SUMMARY:')) {
                        list($title) = explode('/', substr($line, 8));
                        $items[$count]['title'] = trim($title);
                    }
                }
            }
        }
        // 日付でソート
        $items = array_combine($sort, $items);
        ksort($items);
        return $items;
    }
}

/* --------------------------------------------------
  メタボックスに入力された情報をDBに保存
-------------------------------------------------- */
add_action('save_post', 'save_schedule');

/**
 * @param $post_id
 * @return mixed
 */
function save_schedule($post_id)
{
    $my_nonce = isset($_POST['my_nonce']) ? $_POST['my_nonce'] : null;
    if (!wp_verify_nonce($my_nonce, wp_create_nonce(__FILE__))) {
        return $post_id;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return $post_id;
    }

    //前月＋当月＋2ヵ月分のmeta_keyを設定
//    $keys1 = set_calendar_keys(date('Y'),date('n')-1);
    $keys2 = set_calendar_keys(date('Y'), date('n'));
    $keys3 = set_calendar_keys(date('Y'), date('n') + 1);
//    $keys4 = set_calendar_keys(date('Y'),date('n')+2);
    $keys = array_merge($keys2, $keys3);
//    var_dump($keys);


    foreach ($keys as $key) {
//        var_dump($key);
//        var_dump($_POST[$key]);

        if (isset($_POST[$key])) {
            $data = $_POST[$key];
            if ($data == 'on') {
                $data = 1;
            }
//            echo '' . $key . PHP_EOL;
            if (get_post_meta($post_id, $key) == "") {
                add_post_meta($post_id, $key, $data, true);
            } elseif ($data != get_post_meta($post_id, $key, true)) {
                update_post_meta($post_id, $key, $data);
            } elseif ($data == "" || $data == "−") {
                delete_post_meta($post_id, $key, get_post_meta($post_id, $key, true));
            }
        } else {
            $data = 0;
//            echo var_dump(get_post_meta($post_id, $key)) . PHP_EOL;
            if (get_post_meta($post_id, $key)[0] == "") {
                add_post_meta($post_id, $key, $data, true);
            } elseif ($data != get_post_meta($post_id, $key, true)[0]) {
                update_post_meta($post_id, $key, $data);
            }
        }
    }
}

//カスタムフィールド書き出し時のmeta_key設定
function set_calendar_keys($year, $month)
{
    //前月、翌月、翌々月が年をまたぐ場合の処理
    if ($month > 12) {
        $year = $year + 1;
        $month = $month - 12;
    } elseif (!$month) {
        $year = $year - 1;
        $month = 12;
    }
    //月末日の取得
    $l_day = date('t', strtotime($year . sprintf('%02d', $month) . '01'));
    //一ヶ月分のmeta_key（dateYYYYMMDD）を配列$keysに格納
    for ($i = 1; $i <= $l_day; $i++) {
//        $keys[($i-1)] = 'date'.$year.sprintf('%02d',$month).sprintf('%02d',$i);
        for ($j = 0; $j <= 9; $j++) {
            $keys[($i . $j)] = 'date' . $year . sprintf('%02d', $month) . sprintf('%02d', $i) . '-' . $j;
        }
    }
    return $keys;
}

/* --------------------------------------------------
  reservationの編集画面のCSS設定
-------------------------------------------------- */
function reservation_output_css()
{
    $pt = get_post_type();
    if ($pt == 'open' || $pt == 'tour') {
        $pt_reservation_css = '<style type="text/css">';
        /*　カレンダー表示のカスタマイズ　*/
        $pt_reservation_css .= '#schedule .inside { text-align: center; }';
        $pt_reservation_css .= '#schedule table.calendar { border-collapse: collapse; border-spacing: 0; margin: 0 auto 20px; }';
        $pt_reservation_css .= '#schedule table.calendar caption { font-size: 150%; font-weight: bold; color: #999; padding: 5px 0; }';
        $pt_reservation_css .= '#schedule table.calendar tr th { border: solid 1px #ccc; padding: 3px; background: #666; color: #fff; }';
        $pt_reservation_css .= '#schedule table.calendar tr th.sun { background: #e66; }';
        $pt_reservation_css .= '#schedule table.calendar tr td { border: solid 1px #ccc; padding: 3px; text-align: left; }';
        $pt_reservation_css .= '#schedule table.calendar tr td.sun { background: #fee; }';
        $pt_reservation_css .= '#schedule table.calendar tr td.holiday { background: #fee; }';
        $pt_reservation_css .= '#schedule table.calendar tr td.holiday .holidayName{ font-size: 30%; margin-left: 3px}';
        $pt_reservation_css .= '#schedule table.calendar tr td.today { background: #ffe; }';
        $pt_reservation_css .= '#schedule table.calendar tr td select { width: 4em; margin: 5px 10px; }';
        $pt_reservation_css .= '</style>';
        echo $pt_reservation_css;
    }
}

add_action('admin_head', 'reservation_output_css');

/* --------------------------------------------------
  カレンダーで漢数字に変換
-------------------------------------------------- */
function num12kan($instr)
{
    $kantbl = array(0 => '〇', 1 => '一', 2 => '二', 3 => '三', 4 => '四', 5 => '五', 6 => '六', 7 => '七', 8 => '八', 9 => '九', 10 => '十', 11 => '十一', 12 => '十二');
    $outstr = '';
    $len = strlen($instr);
    for ($i = 0; $i < $len; $i++) {
        $ch = substr($instr, $i, 1);
        if ($ch == ',') continue;        //カンマは無視
        $outstr .= (isset($kantbl[$ch]) ? $kantbl[$ch] : '');
    }

    return $outstr;
}

function old_month($instr)
{
    $kantbl = array(0 => '〇', 1 => '睦月', 2 => '如月', 3 => '弥生', 4 => '卯月', 5 => '皐月', 6 => '水無月', 7 => '文月', 8 => '葉月', 9 => '長月', 10 => '神無月', 11 => '霜月', 12 => '師走');
    $outstr = '';
    $len = strlen($instr);
    for ($i = 0; $i < $len; $i++) {
        $ch = substr($instr, $i, 1);
        if ($ch == ',') continue;        //カンマは無視
        $outstr .= (isset($kantbl[$ch]) ? $kantbl[$ch] : '');
    }

    return $outstr;
}