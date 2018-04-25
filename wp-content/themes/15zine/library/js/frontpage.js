var swiper = new Swiper('.swiper-container', {
  slidesPerView: 3,
  spaceBetween: 100,
  speed: 1000,
  centeredSlides: true,
  loop: true,
  autoplay: {
    delay: 2500,
    disableOnInteraction: false,
  },
  pagination: {
    el: '.swiper-pagination',
    clickable: true,
  },
});

jQuery(function(){
  var $container = jQuery(".instagram");
  var html = "";

  jQuery.ajax({
    url: "/instagram.php",//PHPファイルURL
    type:"POST",
    dataType: "json"
  }).done(function(data){
    //通信成功時の処理
    jQuery.each(data.data,function(i,item){
      var imgurl = item.images.standard_resolution.url; //低解像度の画像のURLを取得
      var link = item.link; //リンクを取得
      html += "<li><a href='" + link + "' target='_blank'><img src='" + imgurl + "'></a></li>";
    });
  }).fail(function(){
    //通信失敗時の処理
    html = "<li>画像を取得できまへん。</li>";
  }).always(function(){
    //通信完了時の処理
    $container.html(html);
  });

  TweenMax.set(".tween-opa" , {opacity:0});

  jQuery('.studio').on('inview', function (event, isInView) {
    if (isInView) {
      TweenMax.to(".studio .tween-opa" , 1.5 , {opacity:1, delay:0.7});
    }
  });
  jQuery('.space').find('.tween-opa').on('inview', function (event, isInView) {
    if (isInView) {
      TweenMax.to(".space .tween-opa" , 1.5 , {opacity:1, delay:0.7});
    }
  });
});