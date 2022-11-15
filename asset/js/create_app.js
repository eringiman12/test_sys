// // // <div id="target">...</div>などの要素にクリックイベントを設定
// // document.getElementById( "table1" ).onclick = function( event ) {
// // 	var x = event.pageX ;	// 水平の位置座標
// // 	var y = event.pageY ;	// 垂直の位置座標
// //   alert("aaaaa");
// // }
// 'use strict';
// //ファイルのドロップ対象要素

// //対象要素と子要素とでの移動フラグ
// // var innerFlag = false;
// // var targetE = document.getElementById('table1');
// // window.addEventListener("load",function(){
// //   const priceGet = document.getElementById("item-price");
// //   if (!priceGet){ return false;}
// //   targetE.addEventListener('dragover', function () {
// //     //フラグを上書きする
// //     innerFlag = false;
// //     //クラスをセット
// //     targetE.className = 'over';
// //     cosole.log("haite");
// //   }, false);
// //   targetE.addEventListener('dragleave', function () {
// //     targetE.className = '';
// //   }, false);
// // },false)

// var Drop_Num;
// function mouseDown(Num){
//   Drop_Num = Num;
//   if(Num == 1) {
//     Drop_Num = Num;

//     // var script = document.createElement("script")
//     // script.type = "text/javascript";
//     // script.src = "./js/Before_drop.js";
//     // document.body.appendChild(script);
//   } else {
//     Drop_Num = Num;
//     // ドロップ後のjsファイル読み込む
//   }
// }

// function dragStarted( $event ){
//     $('#label_html_tag').draggable({
//       // 範囲指定
//       containment: "#table1",
//       //カーソル指定
//       cursor: "move",
//     }); 
//   var id = $event.target.id;
//   console.log(id);
//   if(id =="label") {
    
//   }
//   ev.dataTransfer.setData("text", ev.currentTarget.id);
//   alert(ev.currentTarget.id);
//   console.log($event);
//     $event.dataTransfer.setData( "Text", $event.target.id );
    
//   };



// // 各イベント処理
// $(function() {
//   ドラッグ
//   $('#label').on('mousedown', function(){
//   });

//   $('.box').draggable({
//     // 要素複製
//     helper: "clone",
//     // 範囲指定
//     containment: ".tab_panel",
//     //カーソル指定
//     cursor: "move",
//   }); 
	
// 	// ドロップ処理
// 	$('#table1').droppable({
// 		// ドロップした時に呼び出される
//     containment: "#table1",
//     // ドロップ対象指定
//     accept: ".box",
//     // ドロップ操作
// 		drop: function(e, ui) { 

//       $( this )
//       　// div指定
//         .find('div')
//         // UIテキスト 取得
//         var label = ui.draggable.text()
//         // 範囲指定
//         var lavel_tag = document.getElementById('table1');
//         // htmlタグ追加関数
//         html_tag_create(label,lavel_tag);
// 		},
//   });
 
// })

// //htmlタグ付与
// function html_tag_create(tag_name,tag_ID) {
//   if( document.getElementById("Movemain") ){
//     var Movemain_Id = document.getElementById("Movemain");
//   } else {
//     tag_ID.insertAdjacentHTML('beforeend','<div id="Movemain"></div>');
//     var Movemain_Id = document.getElementById("Movemain");
//   }
//   var Movemain_Id = document.getElementById("test");
//   if(tag_name == "ラベル") {
//     Movemain_Id.insertAdjacentHTML('beforeend','<th id="label_html_tag" draggable="true" ondragstart="dragStarted(event)" ondragover="draggingOver(event)" ondrop="dropped(event)" ondrop="Drop(event)">ラベル</th>');
//   } else if(tag_name == "ボックス") {
//     tag_ID.insertAdjacentHTML('beforeend','<div id="Box_html_tag" draggable="true" ondragstart="dragStarted(event)" ondragover="draggingOver(event)" ondrop="dropped(event)" ondrop="Drop(event)">ボックス</div>');    
//   }

// }





// function draggingOver( $event ){
//   // console.log("aaaaa2");
//   // $event.dataTransfer.setData( "Text", $event.target.id );
// };

// document.getElementById("text-button").onclick = function() {
//   document.getElementById("text").innerHTML = "クリックされた！";
// };

// function test1(e){
// 	var aa = document.getElementById(e).id;
//   alert(aa);
// }
function on(e) {
  document.getElementById(e).style.display = "block";
}

function off(e) {
  document.getElementById(e).style.display = "none";
}