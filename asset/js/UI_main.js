// $(function() {
//     $('.acoTriger').click(function(){
//       $(this).toggleClass('opened').next().stop().slideToggle('600');
//     return false;
//     });
// });    

// $(function(){
//   // #で始まるリンクをクリックした場合
//   $('a[href^="#"]').click(function() {
//     // スクロールの速度
//     let speed = 400;
//     // スクロールタイプ
//     let type = 'swing';
//     // href属性の取得
//     let href= $(this).attr("href");
//     // 移動先の取得（hrefが#indexならトップ$(html)に、）
//     let target = $(href == "#index" ? 'html' : href);
//     // 移動先のポジション取得
//     let position = target.offset().top;
//     // animateでスムーススクロール
//     $('body,html').animate({scrollTop:position}, speed, type);
//     return false;
//   });

$(function(){
    $("#button").bind("click",function(){

    var abc , def;
    abc = $("#naiyo").val();
    def = $("#tanto_name").val();
    re = new RegExp(abc);
    re2 = new RegExp(def);

        $("#data tbody tr").each(function(){
            var txt = $(this).find("td").text();
            if(txt.match(re) != null){

              if(txt.match(re2) != null){
                  $(this).show();
              }else{
                  $(this).hide();
              }
            }else{
                $(this).hide();
            }
        });
    });

    // $("#button2").bind("click",function(){
    //     $("#data tr").show();
    // });
});