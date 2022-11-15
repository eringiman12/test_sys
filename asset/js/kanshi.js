
// function test1(){
//     var test = document.getElementById('Main');
//     test.insertAdjacentHTML('beforeend', '<div class="test">BeforeEnd</div>');
// }

// // 監視ターゲットの取得
// const target = document.getElementById('Main')

// // オブザーバーの作成
// const observer = new MutationObserver(records => {
//   // 変化が発生したときの処理を記述
//   var frame = document.getElementById('Main');
//   var frame_children = frame.children;
  
//   for (var i = 0; i < frame_children.length; i++) {
//       let classNames = frame_children[i].className;//class名取得

//       alert(classNames);
//   }
// })

// // 監視の開始
// observer.observe(target, {
//   childList: true
// })
// function inputChange(event){
//   alert(event.currentTarget.value);
// }

// let text = document.getElementById('nametext');
// text.addEventListener('input', inputChange);
// 要素を取得
// var inputElement = document.getElementById( "contents" ) ;

// // 処理を定義
// var action = function() {
// 	alert("aa");
// }

// // イベントを設定 ( addEventListener )
// inputElement.addEventListener( "input", action ) ;

// // イベントを削除
// inputElement.removeEventListener( "input", action ) ;
// let input = document.querySelector('input');
// let log = document.getElementById('contents');

// input.oninput = handleInput;

// function handleInput(e) {
//   alert("ssssssssssss");
// }
function inputChange() {
  // $this.nextSibling.innerHTML = $this.value;
  alert("aaaaaa");
}

function alertValue($this) {
  alert("aaaaaa");
}