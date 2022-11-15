<?php
$aa = "s";
$bb ="2";
?>
<!-- アプリ作成ページ -->
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>アプリ作成</title>

</head>
<body> 　
	<!-- タイトル部分 -->
	<div class="title_bar">
		<a href="./index.php"><h1 class="title_name">TOP</h1></a>
	<div>

	<!-- サイドバーナビ -->
	<div class="tab_wrap">
		<input id="tab1" type="radio" name="tab_btn" checked>
		<input id="tab2" type="radio" name="tab_btn">
		<input id="tab3" type="radio" name="tab_btn">
		
		<div class="tab_area">
			<label class="tab1_label" for="tab1">フォーム</label>
			<label class="tab2_label" for="tab2">一覧</label>
			<label class="tab3_label" for="tab3">グラフ</label>
		</div>

		<!-- フォーム作成エリア -->
		<div class="panel_area">
			<input type="button" value="Exec" onclick="OnButtonClick();"/><br />
			<div id="output"></div>
			<div id="panel1" class="tab_panel">
				<div class="panel_sub">
					<div class="draggable-area">
						<div id="label" class="box" style="cursor:move;" draggable="true" ondragstart="dragStarted(event)">ラベル</div>
						<div id="label" class="box" style="cursor:move;" draggable="true">ボックス</div>
						
						<!-- <div id="text-button"><p id="text">クリック</p></div> -->
						<table id="table1" class="create_app_area">
							<tr id="test">
								<th style="border:1px solid black;">a</th>
									<th style="border:1px solid black;">b</th>
									<th style="border:1px solid black;">c</th>
									<th style="border:1px solid black;">d</th>
									<th style="border:1px solid black;">dd</th>
									<th style="border:1px solid black;">b</th>
									<th style="border:1px solid black;">c</th>
									<th style="border:1px solid black;">d</th>
									<th style="border:1px solid black;">dd</th>
									<th style="border:1px solid black;">dd</th>
								</tr>
							<?php for($i=0; $i <10; $i++) {?>
								
								<tr>
								<?php for($j=0; $j <10; $j++) {?>
									<td style="border:1px solid black;">
										<div id="<?php echo $aa.$i.$j;?>" class="overlay">
											<div class="test">
												<h1>HI</h1>
												<p>イベント入力日付:<?php echo $aa.$i.$j;?></p>
												<button onclick="off('<?php echo $aa.$i.$j;?>')">閉じる</button>
											</div>	
										</div>
										<a class="open" onclick="on('<?php echo $aa.$i.$j;?>')"></a>
									</td>
								<?php }?>
								</tr>
							<?php }?>
						<!-- <div id="table1" class="create_app_area"> -->
						<!-- この中に部品が作られる -->
						<!-- この中のタグを別途ファイルにすべて保存 -->
						<!-- </div> -->
						</table>
					</div>
				</div>
			</div>
			
			<div id="panel2" class="tab_panel">
				<p>panel2</p>
			</div>
			<div id="panel3" class="tab_panel">
				<p>panel3</p>
			</div>
		</div>
	</div>
	<div id="script_read"></div>

	<script type="text/javascript" src="./js/Before_drop.js"></script>
</body>

</html>
