/**
 * ページ読み込み時の処理
 */
 $(function(){

	// リッチテキストの設定
	$('#contents').summernote({
		height: 200,
		width:500,
		fontNames: ["YuGothic","Yu Gothic","Hiragino Kaku Gothic Pro","Meiryo","sans-serif", "Arial","Arial Black","Comic Sans MS","Courier New","Helvetica Neue","Helvetica","Impact","Lucida Grande","Tahoma","Times New Roman","Verdana"],
		lang: "ja-JP",
		toolbar: [
			['style', ['bold', 'italic', 'underline', 'clear']],
			['font', ['strikethrough']],
			['fontsize', ['fontsize']],
			['color', ['color']],
			['table', ['table']],
			['insert', ['link', 'picture']],
			['view', ['fullscreen']],
			['para', ['ul', 'ol', 'paragraph']],
		]
	});

});