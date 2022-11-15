<?php
class Paging{
	//表示させる件数
	//ページングのパラメータ $_GET[]に入る部分
	public $param = 'page';
	//現在のページの前後に表示させる数
	public $items = 2;
	//最初と最後に繋ぐ文字
	public $between_str = '…';
	//「前へ」にあたる文字
	public $prev_str = '≪';
	//「次へ」にあたる文字
	public $next_str = '≫';
	//ulに付くclass
	public $ul_class = 'paging';
	//aタグを除外する $_GETではなくajax等の処理に
	public $atag_remove_flg = false;
	
	public $page = 1;
	public $url = '';
	public $html = '';
	
	//HTMLを生成 プロパティhtmlに代入
	public function setHtml($sum = 0){
		$this -> getPage();
		
		$max_page = ceil($sum / $this -> count);
		if($max_page == 1 || 1 > $this -> page || !is_numeric($this -> page)){
			$this -> page = 1;
		}
		if($this -> page > $max_page){
			$this -> page = $max_page;
		}
		
		$aryCmp = [];
		for($i = 1; $i <= $max_page; $i++){
			$aryCmp[$i] = true;
		}
		
		$loop_count = 0;
		for($i = ($this -> page + 1); $i <= $max_page; $i++){
			$loop_count++;
			if($loop_count > $this -> items && $i != $max_page){
				unset($aryCmp[$i]);
			}
		}
		
		$loop_count = 0;
		for($i = ($this -> page - 1); $i >= 1; $i--){
			$loop_count++;
			if($loop_count > $this -> items && $i != 1){
				unset($aryCmp[$i]);
			}
		}
		
		$aryResult = [];
		
		foreach($aryCmp as $key => $value){
			$aryResult[] = $key;
			if($max_page == $key){
				break;
			}
			if(!isset( $aryCmp[($key + 1)] ) && $this -> between_str){
				$aryResult[] = $this -> between_str;
			}
		}
		
		if(!$aryResult){
			return '';
		}
		
		$html = '';
		$html .= '<ul class="'.$this -> ul_class.'">';
		
		$aryList = [];
		
		if($this -> page != 1 && $this -> prev_str){
			$aryList[] = '<li>'.$this -> getQuery(($this -> page - 1), $this -> prev_str).'</li>';
		}
		
		foreach($aryResult as $key => $value){
			if(is_numeric($value)){
				$aryList[] = '<li>'.$this -> getQuery($value, $value).'</li>';
			}else{
				$aryList[] = '<li>'.$this -> getQuery(0, $value).'</li>';
			}
		}
		
		if($this -> page != $max_page && $this -> next_str){
			$aryList[] = '<li>'.$this -> getQuery(($this -> page + 1), $this -> next_str).'</li>';
		}
		
		$this -> html = '<ul class="'.$this -> ul_class.'">'.implode('', $aryList).'</ul>';
	}
	
	//現在のページURLを取得 atag_remove_flgがtrueの場合は行わない
	private function getPage(){
		if($this -> atag_remove_flg) return;
		if(isset($_GET[$this -> param]) && is_numeric($_GET[$this -> param])){
			$this -> page = $_GET[$this -> param];
		}else{
			$this -> page = 1;
		}
	}
	
	//ページ内リンクを生成
	private function getQuery($page, $str){
		$url = $this -> url;
		if(!$url){
			$url = ((isset($_SERVER['HTTPS'])) ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
			if(isset($_SERVER['QUERY_STRING'])){
				$url = str_replace('?'.$_SERVER['QUERY_STRING'], '', $url);
			}
		}
		$html = '';
		
		if($this -> page == $page){
			return '<span class="active">'.$str.'</span>';
		}
		
		if($page == 0){
			return '<span class="between">'.$str.'</span>';
		}
		
		if(!$this -> atag_remove_flg){
			$aryQuery = [];
			if($_GET){
				$aryQuery = $_GET;
			}
			$aryQuery[$this -> param] = $page;
			if($page == 1){
				unset($aryQuery[$this -> param]);
			}
		
			if($aryQuery){
				return '<a href="'.$url.'?'.http_build_query($aryQuery).'">'.$str.'</a>';
			}else{
				return '<a href="'.$url.'">'.$str.'</a>';
			}
		}else{
			return '<span data-page="'.$page.'">'.$str.'</span>';
		}
	}
}
?>