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
        <h2 class="rl"><?php the_field('slide_text_1'); ?></h2>
        <a href="/space-plan/"><div class="circle"><svg class="shirt" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="width: 80px; height: 80px; opacity: 1;" xml:space="preserve">
<style type="text/css">
  .st0{fill:#4B4B4B;}
</style>
            <g>
              <path class="st0" d="M256,172.865c-3.274,0-5.922,2.654-5.922,5.922c0,3.274,2.648,5.922,5.922,5.922
		c3.274,0,5.922-2.648,5.922-5.922C261.922,175.52,259.274,172.865,256,172.865z" style="fill: rgb(255, 255, 255);"></path>
              <path class="st0" d="M256,223.928c-3.274,0-5.922,2.655-5.922,5.929c0,3.274,2.648,5.915,5.922,5.915
		c3.274,0,5.922-2.641,5.922-5.915C261.922,226.583,259.274,223.928,256,223.928z" style="fill: rgb(255, 255, 255);"></path>
              <path class="st0" d="M256,274.99c-3.274,0-5.922,2.655-5.922,5.929c0,3.268,2.648,5.915,5.922,5.915
		c3.274,0,5.922-2.647,5.922-5.915C261.922,277.645,259.274,274.99,256,274.99z" style="fill: rgb(255, 255, 255);"></path>
              <path class="st0" d="M256,377.115c-3.274,0-5.922,2.648-5.922,5.922c0,3.274,2.648,5.922,5.922,5.922
		c3.274,0,5.922-2.648,5.922-5.922C261.922,379.763,259.274,377.115,256,377.115z" style="fill: rgb(255, 255, 255);"></path>
              <path class="st0" d="M256,326.053c-3.274,0-5.922,2.648-5.922,5.922c0,3.274,2.648,5.922,5.922,5.922
		c3.274,0,5.922-2.648,5.922-5.922C261.922,328.701,259.274,326.053,256,326.053z" style="fill: rgb(255, 255, 255);"></path>
              <path class="st0" d="M442.787,158.263c-0.007-0.034-0.021-0.061-0.028-0.089l-0.014-0.062
		c-5.516-24.018-21.645-44.253-43.861-54.956l-57.789-27.828l-11.397-18.454l-0.158-0.227c-3.068-4.244-7.092-7.593-11.748-9.918
		c-7.016-3.501-15.187-4.938-25.167-5.695c-9.994-0.736-21.927-0.729-36.626-0.729c-19.609,0.014-34.259-0.041-46.028,1.761
		c-5.881,0.915-11.101,2.318-15.764,4.663c-4.656,2.325-8.68,5.675-11.748,9.918l-0.144,0.199l-11.411,18.482l-57.789,27.828
		c-22.216,10.703-38.346,30.938-43.862,54.956l-0.013,0.062c-0.007,0.028-0.021,0.055-0.028,0.089L0,434.849l84.593,22.299
		l39.17-149.143v163.69h105.165L256,437.367l27.065,34.328h105.172v-163.69l39.17,149.143L512,434.849L442.787,158.263z
		 M193.926,64.859c1.802-2.428,3.79-4.106,6.617-5.55c4.25-2.166,10.702-3.57,19.87-4.23c9.148-0.681,20.896-0.695,35.587-0.688
		c19.582-0.014,33.957,0.042,43.868,1.596c4.959,0.764,8.742,1.884,11.59,3.322c2.827,1.444,4.815,3.123,6.617,5.55l10.111,16.377
		l-26.687,69.874l-37.293-30.572l37.554-32.443l0.179-0.193c2.717-2.868,4.168-6.623,4.168-10.448c0-1.995-0.399-4.024-1.218-5.929
		l-0.007-0.028c-2.394-5.544-7.855-9.162-13.921-9.162h-69.922c-6.066,0-11.528,3.618-13.921,9.162
		c-0.825,1.932-1.224,3.962-1.224,5.97c-0.007,3.81,1.444,7.579,4.182,10.454l0.165,0.179l37.554,32.437l-37.293,30.572
		l-26.687-69.887L193.926,64.859z M256,113.666l-38.317-33.104c-0.798-0.866-1.224-1.967-1.224-3.095l0.364-1.788
		c0.736-1.692,2.387-2.779,4.216-2.779h69.922c1.83,0,3.48,1.087,4.223,2.793l0.358,1.761c0,1.128-0.433,2.242-1.231,3.123
		L256,113.666z M74.551,439.939L17.044,424.78l8.33-33.297l57.899,15.262L74.551,439.939z M426.947,399.936L388.12,252.114
		l-2.607-1.774l-5.144-3.514l-6.218,7.078v203.706h-84.249L256,414.621l-5.53,7.016l-28.372,35.972H137.85V253.895l-2.105-2.387
		l-4.112-4.684l-5.578,3.81l-2.174,1.478l-38.82,147.822l-57.975-15.283l55.85-223.198l0.02-0.069
		c4.519-19.905,17.883-36.68,36.268-45.539l56.173-27.051l30.47,79.785L256,127.477l50.134,41.096l30.47-79.778l56.173,27.051
		c18.384,8.859,31.749,25.634,36.268,45.539l0.02,0.076l55.85,223.192L426.947,399.936z M428.735,406.745l57.892-15.262l8.329,33.29
		l-57.507,15.159L428.735,406.745z" style="fill: rgb(255, 255, 255);"></path>
            </g>
</svg></div></a>
        <a href="/space-plan/">
          <div class="photo-box"><?php
            //画像(返り値は「画像ID」)
            $img1 = get_field('slide_img_1');
            $text1 = get_field('slide_text_1');
            $imgurl1 = wp_get_attachment_image_src($img1, 'large'); //サイズは自由に変更してね
            if ($imgurl1) { ?><img src="<?php echo $imgurl1[0]; ?>" alt=""><?php } ?></div></a>
      </div>
      <div class="swiper-slide">
        <h2 class="rl"><?php the_field('slide_text_2'); ?></h2>
        <a href="/space-plan/"><div class="circle">
          <svg class="baby" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="width: 80px; height: 80px; opacity: 1;" xml:space="preserve">
<style type="text/css">
  .st0{fill:#4B4B4B;}
</style>
            <g>
              <path class="st0" d="M204.99,262.937c0-10.436-8.456-18.889-18.892-18.889c-10.428,0-18.892,8.453-18.892,18.889
		c0,10.428,8.464,18.888,18.892,18.888C196.534,281.825,204.99,273.365,204.99,262.937z" style="fill: rgb(255, 255, 255);"></path>
              <path class="st0" d="M325.902,244.048c-10.428,0-18.892,8.453-18.892,18.889c0,10.428,8.464,18.888,18.892,18.888
		c10.436,0,18.892-8.46,18.892-18.888C344.794,252.501,336.337,244.048,325.902,244.048z" style="fill: rgb(255, 255, 255);"></path>
              <path class="st0" d="M494.017,230.848c-10.085-10.11-23.828-16.674-38.994-17.76c-9.448-44.37-33.033-83.5-66.012-112.18
		c-36.029-31.351-83.232-50.37-134.745-50.362c-51.437-0.008-98.582,18.954-134.593,50.232
		c-33.149,28.76-56.825,68.071-66.233,112.658c-13.754,1.795-26.158,8.098-35.458,17.412C6.894,241.92-0.007,257.357,0,274.27
		c-0.007,16.905,6.894,32.356,17.984,43.414c11.069,11.094,26.509,17.991,43.418,17.984c1.198,0,2.327-0.174,3.5-0.246
		c14.785,35.208,38.956,65.452,69.532,87.459c33.699,24.273,75.16,38.58,119.833,38.573c44.873,0.007,86.489-14.438,120.271-38.892
		c30.424-22.022,54.476-52.215,69.182-87.335c2.257,0.26,4.54,0.441,6.878,0.441c16.912,0.007,32.356-6.89,43.418-17.984
		c11.09-11.058,17.991-26.509,17.983-43.414C512.008,257.357,505.107,241.92,494.017,230.848z M284.81,81.593
		c1.013,1.172,2.07,2.497,3.119,4.082c4.476,6.788,8.988,17.455,9.014,34.332c0.004,12.744-2.7,29.122-10.255,49.71
		c-23.856-19.207-37.549-36.909-45.249-51.491c-8.388-15.907-9.904-28.202-9.915-35.324c0-0.919,0.043-1.664,0.087-2.403
		c7.432-0.955,14.956-1.614,22.655-1.614C264.699,78.886,274.885,79.863,284.81,81.593z M226.401,126.165
		c4.288,8.127,10.15,16.884,17.788,26.024c-7.657-3.097-15.336-5.992-22.55-9.046c-12.328-5.196-23.137-11-30.468-18.736
		c-3.691-3.879-6.582-8.214-8.648-13.461c-1.694-4.342-2.779-9.422-3.127-15.4c11.127-5.196,22.901-9.198,35.147-12.006
		C214.619,93.165,216.877,108.145,226.401,126.165z M473.978,297.645c-6.025,6.006-14.2,9.675-23.379,9.69
		c-3.789-0.008-7.433-0.68-10.95-1.91l-13.413-4.718l-4.664,13.432c-12.024,34.6-34.502,64.373-63.649,85.468
		c-29.161,21.089-64.883,33.5-103.655,33.507c-38.602-0.007-74.186-12.31-103.278-33.232
		c-29.078-20.922-51.564-50.471-63.711-84.832l-4.4-12.433l-12.715,3.495c-2.902,0.789-5.801,1.224-8.761,1.224
		c-9.18-0.015-17.347-3.684-23.379-9.69c-6.003-6.029-9.672-14.199-9.679-23.376c0.007-9.176,3.676-17.348,9.679-23.383
		c6.032-6,14.199-9.669,23.379-9.676c0.579-0.007,1.441,0.044,2.634,0.138l13.146,1.035l1.976-13.048
		c6.416-42.561,27.993-80.164,59.09-107.158c7.772-6.737,16.127-12.809,24.981-18.129c0.768,4.798,1.95,9.3,3.604,13.439
		c2.609,6.564,6.271,12.252,10.613,17.108c7.61,8.525,17.126,14.518,27.059,19.432c14.933,7.338,31.054,12.411,44.601,18.736
		c6.774,3.148,12.874,6.564,17.868,10.501c5.015,3.959,8.926,8.351,11.712,13.685c1.498,2.887,4.487,4.653,7.744,4.58
		c3.25-0.079,6.159-1.982,7.516-4.943c14.702-31.842,19.995-56.897,20.003-76.581c0.022-13.331-2.472-24.15-5.992-32.668
		c23.242,7.396,44.46,19.308,62.462,34.954c31.112,27.066,52.668,64.778,59.01,107.426l2.088,14.076l14.064-2.15
		c1.874-0.282,3.532-0.434,5.016-0.434c9.18,0.007,17.354,3.676,23.379,9.676c6.006,6.035,9.675,14.206,9.686,23.383
		C483.653,283.447,479.984,291.617,473.978,297.645z" style="fill: rgb(255, 255, 255);"></path>
              <path class="st0" d="M307.842,327.36c-11.81,16.362-30.978,26.552-51.842,26.546c-20.828,0.007-40.028-10.19-51.849-26.552
		c-3.21-4.437-9.408-5.435-13.844-2.229c-4.444,3.213-5.438,9.408-2.233,13.851c15.48,21.429,40.582,34.766,67.926,34.766
		c27.377,0,52.457-13.338,67.93-34.774c3.206-4.444,2.208-10.638-2.236-13.844C317.25,321.918,311.048,322.916,307.842,327.36z" style="fill: rgb(255, 255, 255);"></path>
            </g>
</svg>
          </div></a>
        <a href="/space-plan/">
          <div class="photo-box">
            <?php
            //画像(返り値は「画像ID」)
            $img2 = get_field('slide_img_2');
            $text2 = get_field('slide_text_2');
            $imgurl2 = wp_get_attachment_image_src($img2, 'large'); //サイズは自由に変更してね
            if ($imgurl2) { ?><img src="<?php echo $imgurl2[0]; ?>" alt="">
            <?php }
            ?></div></a>
      </div>
      <div class="swiper-slide">
        <h2 class="rl"><?php the_field('slide_text_3'); ?></h2>
        <a href="/space-plan/"><div class="circle">
          <svg class="kimono" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
               viewBox="0 0 297 297" style="width: 80px; height: 80px; opacity: 1;" xml:space="preserve">
<style type="text/css">
  .st0{fill:#FFFFFF;stroke:#FFFFFF;stroke-miterlimit:10;}
</style>
            <path class="st0" d="M290.3,108.3l-59.4-89.1c-0.9-1.4-2.2-2.6-3.8-3.3L197.4,1c-1.4-0.7-2.8-1-4.3-1c0,0-0.1,0-0.1,0H104
	c0,0,0,0-0.1,0c-1.5,0-2.9,0.3-4.3,1L69.9,15.9c-1.5,0.8-2.8,1.9-3.8,3.3L6.7,108.3c-2.1,3.2-2.2,7.4-0.1,10.6
	c0.9,1.4,21.2,32.9,72.7,46.9v121.3c0,5.4,4.4,9.8,9.8,9.8h118.8c5.4,0,9.8-4.4,9.8-9.8V165.9c51.5-14.1,71.8-45.6,72.7-46.9
	C292.5,115.7,292.4,111.5,290.3,108.3z M151.4,43.4l-23.8-23.8h44.2L151.4,43.4z M26.9,113.3L81,32.2L102,21.7l36.6,36.6l-39.3,45.8
	h-0.4V84c0-5.4-4.4-9.8-9.8-9.8s-9.8,4.4-9.8,9.8v61.5C49.9,136.3,33.6,121.1,26.9,113.3z M198.1,164.5H98.9v-41.2h99.2L198.1,164.5
	L198.1,164.5z M98.9,277.4v-93.6h99.2v93.6H98.9z M217.7,145.5V84c0-5.4-4.4-9.8-9.8-9.8s-9.8,4.4-9.8,9.8v20.1h-73L195.5,22
	L216,32.2l54.1,81.1C263.3,121.1,247.1,136.3,217.7,145.5z" style="fill: rgb(255, 255, 255);"/>
</svg>
          </div></a>
        <a href="/space-plan/">
          <div class="photo-box">
            <?php
            //画像(返り値は「画像ID」)
            $img3 = get_field('slide_img_3');
            $text3 = get_field('slide_text_3');
            $imgurl3 = wp_get_attachment_image_src($img3, 'large'); //サイズは自由に変更してね
            if ($imgurl3) { ?><img src="<?php echo $imgurl3[0]; ?>" alt="">
            <?php }
            ?></div></a>
      </div>
      <div class="swiper-slide">
        <h2 class="rl"><?php the_field('slide_text_4'); ?></h2>
        <a href="/space-plan/"><div class="circle"><svg class="shirt" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="width: 80px; height: 80px; opacity: 1;" xml:space="preserve">
<style type="text/css">
  .st0{fill:#4B4B4B;}
</style>
              <g>
                <path class="st0" d="M256,172.865c-3.274,0-5.922,2.654-5.922,5.922c0,3.274,2.648,5.922,5.922,5.922
		c3.274,0,5.922-2.648,5.922-5.922C261.922,175.52,259.274,172.865,256,172.865z" style="fill: rgb(255, 255, 255);"></path>
                <path class="st0" d="M256,223.928c-3.274,0-5.922,2.655-5.922,5.929c0,3.274,2.648,5.915,5.922,5.915
		c3.274,0,5.922-2.641,5.922-5.915C261.922,226.583,259.274,223.928,256,223.928z" style="fill: rgb(255, 255, 255);"></path>
                <path class="st0" d="M256,274.99c-3.274,0-5.922,2.655-5.922,5.929c0,3.268,2.648,5.915,5.922,5.915
		c3.274,0,5.922-2.647,5.922-5.915C261.922,277.645,259.274,274.99,256,274.99z" style="fill: rgb(255, 255, 255);"></path>
                <path class="st0" d="M256,377.115c-3.274,0-5.922,2.648-5.922,5.922c0,3.274,2.648,5.922,5.922,5.922
		c3.274,0,5.922-2.648,5.922-5.922C261.922,379.763,259.274,377.115,256,377.115z" style="fill: rgb(255, 255, 255);"></path>
                <path class="st0" d="M256,326.053c-3.274,0-5.922,2.648-5.922,5.922c0,3.274,2.648,5.922,5.922,5.922
		c3.274,0,5.922-2.648,5.922-5.922C261.922,328.701,259.274,326.053,256,326.053z" style="fill: rgb(255, 255, 255);"></path>
                <path class="st0" d="M442.787,158.263c-0.007-0.034-0.021-0.061-0.028-0.089l-0.014-0.062
		c-5.516-24.018-21.645-44.253-43.861-54.956l-57.789-27.828l-11.397-18.454l-0.158-0.227c-3.068-4.244-7.092-7.593-11.748-9.918
		c-7.016-3.501-15.187-4.938-25.167-5.695c-9.994-0.736-21.927-0.729-36.626-0.729c-19.609,0.014-34.259-0.041-46.028,1.761
		c-5.881,0.915-11.101,2.318-15.764,4.663c-4.656,2.325-8.68,5.675-11.748,9.918l-0.144,0.199l-11.411,18.482l-57.789,27.828
		c-22.216,10.703-38.346,30.938-43.862,54.956l-0.013,0.062c-0.007,0.028-0.021,0.055-0.028,0.089L0,434.849l84.593,22.299
		l39.17-149.143v163.69h105.165L256,437.367l27.065,34.328h105.172v-163.69l39.17,149.143L512,434.849L442.787,158.263z
		 M193.926,64.859c1.802-2.428,3.79-4.106,6.617-5.55c4.25-2.166,10.702-3.57,19.87-4.23c9.148-0.681,20.896-0.695,35.587-0.688
		c19.582-0.014,33.957,0.042,43.868,1.596c4.959,0.764,8.742,1.884,11.59,3.322c2.827,1.444,4.815,3.123,6.617,5.55l10.111,16.377
		l-26.687,69.874l-37.293-30.572l37.554-32.443l0.179-0.193c2.717-2.868,4.168-6.623,4.168-10.448c0-1.995-0.399-4.024-1.218-5.929
		l-0.007-0.028c-2.394-5.544-7.855-9.162-13.921-9.162h-69.922c-6.066,0-11.528,3.618-13.921,9.162
		c-0.825,1.932-1.224,3.962-1.224,5.97c-0.007,3.81,1.444,7.579,4.182,10.454l0.165,0.179l37.554,32.437l-37.293,30.572
		l-26.687-69.887L193.926,64.859z M256,113.666l-38.317-33.104c-0.798-0.866-1.224-1.967-1.224-3.095l0.364-1.788
		c0.736-1.692,2.387-2.779,4.216-2.779h69.922c1.83,0,3.48,1.087,4.223,2.793l0.358,1.761c0,1.128-0.433,2.242-1.231,3.123
		L256,113.666z M74.551,439.939L17.044,424.78l8.33-33.297l57.899,15.262L74.551,439.939z M426.947,399.936L388.12,252.114
		l-2.607-1.774l-5.144-3.514l-6.218,7.078v203.706h-84.249L256,414.621l-5.53,7.016l-28.372,35.972H137.85V253.895l-2.105-2.387
		l-4.112-4.684l-5.578,3.81l-2.174,1.478l-38.82,147.822l-57.975-15.283l55.85-223.198l0.02-0.069
		c4.519-19.905,17.883-36.68,36.268-45.539l56.173-27.051l30.47,79.785L256,127.477l50.134,41.096l30.47-79.778l56.173,27.051
		c18.384,8.859,31.749,25.634,36.268,45.539l0.02,0.076l55.85,223.192L426.947,399.936z M428.735,406.745l57.892-15.262l8.329,33.29
		l-57.507,15.159L428.735,406.745z" style="fill: rgb(255, 255, 255);"></path>
              </g>
</svg></div></a>
        <a href="/space-plan/">
          <div class="photo-box">
            <?php
            //画像(返り値は「画像ID」)
            $img4 = get_field('slide_img_4');
            $text4 = get_field('slide_text_4');
            $imgurl4 = wp_get_attachment_image_src($img4, 'large'); //サイズは自由に変更してね
            if ($imgurl4) { ?><img src="<?php echo $imgurl4[0]; ?>" alt="">
            <?php }
            ?></div></a>
      </div>
      <div class="swiper-slide">
        <h2 class="rl"><?php the_field('slide_text_5'); ?></h2>
        <a href="/space-plan/"><div class="circle"><svg class="shirt" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="width: 80px; height: 80px; opacity: 1;" xml:space="preserve">
<style type="text/css">
  .st0{fill:#4B4B4B;}
</style>
              <g>
                <path class="st0" d="M256,172.865c-3.274,0-5.922,2.654-5.922,5.922c0,3.274,2.648,5.922,5.922,5.922
		c3.274,0,5.922-2.648,5.922-5.922C261.922,175.52,259.274,172.865,256,172.865z" style="fill: rgb(255, 255, 255);"></path>
                <path class="st0" d="M256,223.928c-3.274,0-5.922,2.655-5.922,5.929c0,3.274,2.648,5.915,5.922,5.915
		c3.274,0,5.922-2.641,5.922-5.915C261.922,226.583,259.274,223.928,256,223.928z" style="fill: rgb(255, 255, 255);"></path>
                <path class="st0" d="M256,274.99c-3.274,0-5.922,2.655-5.922,5.929c0,3.268,2.648,5.915,5.922,5.915
		c3.274,0,5.922-2.647,5.922-5.915C261.922,277.645,259.274,274.99,256,274.99z" style="fill: rgb(255, 255, 255);"></path>
                <path class="st0" d="M256,377.115c-3.274,0-5.922,2.648-5.922,5.922c0,3.274,2.648,5.922,5.922,5.922
		c3.274,0,5.922-2.648,5.922-5.922C261.922,379.763,259.274,377.115,256,377.115z" style="fill: rgb(255, 255, 255);"></path>
                <path class="st0" d="M256,326.053c-3.274,0-5.922,2.648-5.922,5.922c0,3.274,2.648,5.922,5.922,5.922
		c3.274,0,5.922-2.648,5.922-5.922C261.922,328.701,259.274,326.053,256,326.053z" style="fill: rgb(255, 255, 255);"></path>
                <path class="st0" d="M442.787,158.263c-0.007-0.034-0.021-0.061-0.028-0.089l-0.014-0.062
		c-5.516-24.018-21.645-44.253-43.861-54.956l-57.789-27.828l-11.397-18.454l-0.158-0.227c-3.068-4.244-7.092-7.593-11.748-9.918
		c-7.016-3.501-15.187-4.938-25.167-5.695c-9.994-0.736-21.927-0.729-36.626-0.729c-19.609,0.014-34.259-0.041-46.028,1.761
		c-5.881,0.915-11.101,2.318-15.764,4.663c-4.656,2.325-8.68,5.675-11.748,9.918l-0.144,0.199l-11.411,18.482l-57.789,27.828
		c-22.216,10.703-38.346,30.938-43.862,54.956l-0.013,0.062c-0.007,0.028-0.021,0.055-0.028,0.089L0,434.849l84.593,22.299
		l39.17-149.143v163.69h105.165L256,437.367l27.065,34.328h105.172v-163.69l39.17,149.143L512,434.849L442.787,158.263z
		 M193.926,64.859c1.802-2.428,3.79-4.106,6.617-5.55c4.25-2.166,10.702-3.57,19.87-4.23c9.148-0.681,20.896-0.695,35.587-0.688
		c19.582-0.014,33.957,0.042,43.868,1.596c4.959,0.764,8.742,1.884,11.59,3.322c2.827,1.444,4.815,3.123,6.617,5.55l10.111,16.377
		l-26.687,69.874l-37.293-30.572l37.554-32.443l0.179-0.193c2.717-2.868,4.168-6.623,4.168-10.448c0-1.995-0.399-4.024-1.218-5.929
		l-0.007-0.028c-2.394-5.544-7.855-9.162-13.921-9.162h-69.922c-6.066,0-11.528,3.618-13.921,9.162
		c-0.825,1.932-1.224,3.962-1.224,5.97c-0.007,3.81,1.444,7.579,4.182,10.454l0.165,0.179l37.554,32.437l-37.293,30.572
		l-26.687-69.887L193.926,64.859z M256,113.666l-38.317-33.104c-0.798-0.866-1.224-1.967-1.224-3.095l0.364-1.788
		c0.736-1.692,2.387-2.779,4.216-2.779h69.922c1.83,0,3.48,1.087,4.223,2.793l0.358,1.761c0,1.128-0.433,2.242-1.231,3.123
		L256,113.666z M74.551,439.939L17.044,424.78l8.33-33.297l57.899,15.262L74.551,439.939z M426.947,399.936L388.12,252.114
		l-2.607-1.774l-5.144-3.514l-6.218,7.078v203.706h-84.249L256,414.621l-5.53,7.016l-28.372,35.972H137.85V253.895l-2.105-2.387
		l-4.112-4.684l-5.578,3.81l-2.174,1.478l-38.82,147.822l-57.975-15.283l55.85-223.198l0.02-0.069
		c4.519-19.905,17.883-36.68,36.268-45.539l56.173-27.051l30.47,79.785L256,127.477l50.134,41.096l30.47-79.778l56.173,27.051
		c18.384,8.859,31.749,25.634,36.268,45.539l0.02,0.076l55.85,223.192L426.947,399.936z M428.735,406.745l57.892-15.262l8.329,33.29
		l-57.507,15.159L428.735,406.745z" style="fill: rgb(255, 255, 255);"></path>
              </g>
</svg></div></a>
        <a href="/space-plan/">
          <div class="photo-box">
            <?php
            //画像(返り値は「画像ID」)
            $img5 = get_field('slide_img_5');
            $text5 = get_field('slide_text_5');
            $imgurl5 = wp_get_attachment_image_src($img5, 'large'); //サイズは自由に変更してね
            if ($imgurl5) { ?><img src="<?php echo $imgurl5[0]; ?>" alt="">
            <?php }
            ?></div></a>
      </div>
    </div>
    <!-- If we need pagination -->
    <div class="swiper-pagination"></div>
  </div>

  <div class="wrap">

    <div class="nav-bar">
      <ul class="ja rl">
        <a href="#contact">
          <li>連絡する</li>
        </a><a href="#calendar">
          <li>予約する</li>
        </a><a href="/space-access">
          <li>場所案内</li>
        </a><a href="/space-hc">
          <li>スペースのこと</li>
        </a><a href="/space-studio">
          <li>スタジオのこと</li>
        </a>
      </ul>
      <ul class="us">
        <a href="/space-studio">
          <li>studio HC</li>
        </a><a href="/space-hc">
          <li>space HC</li>
        </a><a href="/space-access">
          <li>accesss</li>
        </a><a href="#calendar">
          <li>reservation</li>
        </a><a href="#contact">
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

        <div class="calendar" id="calendar">
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
      <img class="icon_06" src="<?php echo get_template_directory_uri(); ?>/library/images/SVG/space-map.svg"
           alt="floor map">
    </div>
    <div class="arrow-under">
      <img class="icon_07" src="<?php echo get_template_directory_uri(); ?>/library/images/SVG/icon_07.svg"
           alt="icon_07.svg">
    </div>

    <div class="contact__form" id="contact">
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