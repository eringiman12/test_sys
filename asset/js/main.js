// 社員管理　社員の編集ボタン押下
function clickBtn1() {
    for (var i = 1; i <= 27; i++) {
        var A = "b" + i;
        if (document.getElementById(A).disabled === true) {
            // disabled属性を削除
            document.getElementById(A).removeAttribute("disabled");
        } else if (document.getElementById(A).disabled === false) {
            document.getElementById(A).setAttribute("disabled", true);
        }
    }
}


// スケジュール管理各スケジュールリンク
function on(e) {
    document.getElementById(e).style.display = "block";
}

function off(e) {
    document.getElementById(e).style.display = "none";
}

function File_Trash_Over(x) {
    alert(x);
}

function File_Trash_leave(x) {
    alert("離れました");
}


function selectboxChange(e, v) {
    // 組織名配列
    var soshiki = [
        "<input type='checkbox' name='check_soshiki[]' value='1'><p>○○社</p><br>",
        "<input type='checkbox' name='check_soshiki[]' value='2'><p>株式会社テスト</p><br>",
        "<input type='checkbox' name='check_soshiki[]' value='3'><p>株式会社</p><br>",
        "<input type='checkbox' name='check_soshiki[]' value='4'><p>テスト事務所</p><br>",
        "<input type='checkbox' name='check_soshiki[]' value='5'><p>法人者</p><br>",
        "<input type='checkbox' name='check_soshiki[]' value='6'><p>株式会社てすとお</p><br>",
    ];

    // 課名配列
    var ka_mei = [
        "<option value='0'><p></p></option>",
        "<option value='1'><p>１課</p></option>",
        "<option value='2'><p>２課</p></option>",
        "<option value='3'><p>３課</p></option>",
        "<option value='4'><p>経略課</p></option>",
    ];

    // 部署名配列
    var busho_mei = [
        "<option value='0'><p></p></option>",
        "<option value='1'><p>代表</p></option>",
        "<option value='2'><p>相談役</p></option>",
        "<option value='11'><p>あ部</p></option>",
        "<option value='12'><p>い部</p></option>",
        "<option value='13'><p>う部</p></option>",
        "<option value='14'><p>え部</p></option>",
        "<option value='15'><p>お課</p></option>",
        "<option value='16'><p>か部</p></option>",
        "<option value='17'><p>き部</p></option>",
        "<option value='18'><p>く部</p></option>",
        "<option value='19'><p>け室</p></option>",
        "<option value='20'><p>こ課</p></option>",
        "<option value='21'><p>さ部</p></option>",
        "<option value='50'><p>しぶ</p></option>",
        "<option value='60'><p>あ</p></option>",
        "<option value='99'><p>その他</p></option>",

    ];

    // 役職名配列
    var yakushoku_mei = [
        "<option value='0'><p></p></option>",
        "<option value='1'><p>相談役</p></option>",
        "<option value='2'><p>会長</p></option>",
        "<option value='3'><p>代表</p></option>",
        "<option value='4'><p>支社長</p></option>",
        "<option value='5'><p>専務</p></option>",
        "<option value='6'><p>常務</p></option>",
        "<option value='7'><p>部長</p></option>",
        "<option value='8'><p>次長</p></option>",
        "<option value='9'><p>課長</p></option>",
        "<option value='10'><p>係長</p></option>",
        "<option value='11'><p>主任</p></option>",
        "<option value='12'><p>一般</p></option>",
        "<option value='13'><p>パート</p></option>",
        "<option value='14'><p>外注</p></option>",
        "<option value='15'><p>室長</p></option>",
        "<option value='16'><p>理事</p></option>",
        "<option value='17'><p>理事長</p></option>",
        "<option value='18'><p>常務理事</p></option>",
        "<option value='19'><p>監事</p></option>",
        "<option value='20'><p>代表取締役</p></option>",
        "<option value='21'><p>社長</p></option>",
        "<option value='22'><p>理事</p></option>",
        "<option value='23'><p>副社長</p></option>",
        "<option value='24'><p>理事長</p></option>",
        "<option value='25'><p>常務理事</p></option>",
    ];

    // 社員区分
    var shain_kubun = [
        "<option value='0'><p></p></option>",
        "<option value='1'><p>正社員</p></option>",
        "<option value='2'><p>短時間正社員</p></option>",
        "<option value='3'><p>パート</p></option>",
    ];

    // 性別
    var sibetu = [
        "<option value='0'><p></p></option>",
        "<option value='男'><p>男</p></option>",
        "<option value='女'><p>女</p></option>",
    ];

    // 学歴
    var gakureki = [
        "<option value='0'><p></p></option>",
        "<option value='1'><p>大学院</p></option>",
        "<option value='2'><p>大学</p></option>",
        "<option value='3'><p>短大</p></option>",
        "<option value='4'><p>専門学校</p></option>",
        "<option value='5'><p>高校</p></option>",
    ];

    // 部課名
    var bukamei = [
        "<option value='0'><p></p></option>",
        "<option value='11@1'><p>あ部　1課</p></option>",
        "<option value='11@2'><p>あ部　2課</p></option>",
        "<option value='11@3'><p>あ部　3課</p></option>",
        "<option value='11@4'><p>あ部　経略課</p></option>",
        "<option value='12@1'><p>い部　1課</p></option>",
        "<option value='12@2'><p>い部　2課</p></option>",
        "<option value='12@3'><p>い部　3課</p></option>",
    ];

    // select要素を取得
    var Now_button = e;

    // インデックス番号を取得する
    var index_no = document.getElementById(e).selectedIndex;
    // select value値
    var Now_val = v;

    // 現在選択中selectID
    var content_area = document.getElementById(Now_button);
    var onclick = ' class="batu" value="×" onclick="Delete_input(this.id,' + index_no + "," + '\'' + e + '\'' + ')";/>';
    // selectナンバー値
    var res = Now_button.replace(/[^0-9]/g, '');
    // IDにi足す
    var num = Number(res) + 1

    // value智判定とhtmlタグの追加
    switch (Now_val) {
        case "shain_ID":
            content_area.insertAdjacentHTML('beforebegin', '<div class="search_title_select" id="shain_id"><p class="title_select">社員ID</p><input type="number" min=1 max=99999 name="Serachbox[shain.ID]" value="" class="inuput_type_search" ><input type="button" id="shain_id_del"' + onclick + '');
            break;
        case "sei":
            content_area.insertAdjacentHTML('beforebegin', '<div class="search_title_select" id="sei_id"><p class="title_select">社員氏名(姓)</p><input value="" name="Serachbox[sei]" class="inuput_type_search" ><input type="button" id="sei_id_del"' + onclick + '');
            break;
        case "mei":
            content_area.insertAdjacentHTML('beforebegin', '<div class="search_title_select" id="mei_id"><p class="title_select">社員氏名(名)</p><input value="" name="Serachbox[mei]" class="inuput_type_search" ><input type="button" id="mei_id_del"' + onclick + '');
            break;
        case "sei_kana":
            content_area.insertAdjacentHTML('beforebegin', '<div class="search_title_select" id="sei_id_kana"><p class="title_select">社員氏名 姓(カナ)</p><input value="" name="Serachbox[sei_kana]" class="inuput_type_search" ><input type="button" id="sei_id_kana_del"' + onclick + '');
            break;
        case "mei_kana":
            content_area.insertAdjacentHTML('beforebegin', '<div class="search_title_select" id="mei_id_kana"><p class="title_select">社員氏名 名(カナ)</p><input value="" name="Serachbox[mei_kana]" class="inuput_type_search" ><input type="button" id="mei_id_kana_del"' + onclick + '');
            break;
        case "desknetsname":
            content_area.insertAdjacentHTML('beforebegin', '<div class="search_title_select" id="desknets_name_id"><p class="title_select">名名</p><input value="" name="Serachbox[desknets_name]" class="inuput_type_search" ><input type="button" id="desknets_name_id_del"' + onclick + '');
            break;
        case "shoshiki_name":
            content_area.insertAdjacentHTML('beforebegin', '<div class="search_title_check" id="soshiki"><p class="title_check">組織名</p><input type="button" id="soshiki_del"' + onclick + ' <div class="check_box">');
            // 二重入力防止
            var content_ar = document.getElementById('soshiki');
            for (const elem of soshiki) {
                content_ar.innerHTML += elem;
            }
            break;
        case "ka_name":
            content_area.insertAdjacentHTML('beforebegin', "<div class='search_title_select' id='ka_mei_id'><p class='title_select'>課名</p><br/><select id='ka_mei' name='Serachbox[equal_ka_ID]'>");
            var content_ar = document.getElementById('ka_mei');
            for (const elem of ka_mei) {
                content_ar.innerHTML += elem;
            }
            content_ar.insertAdjacentHTML('afterend', '<input type="button" id="ka_mei_id_del"' + onclick + '');
            break;
        case "busho_name":
            content_area.insertAdjacentHTML('beforebegin', "<div class='search_title_select' id='busho_mei_id'><p class='title_select'>部署名</p><select id='busho_mei' name='Serachbox[equal_bu_ID]'>");
            var content_ar = document.getElementById('busho_mei');
            for (const elem of busho_mei) {
                content_ar.innerHTML += elem;
            }
            content_ar.insertAdjacentHTML('afterend', '<input type="button" id="busho_mei_id_del"' + onclick + '');
            break;
        case "buka_name":
            content_area.insertAdjacentHTML('beforebegin', "<div class='search_title_select' id='buka_name_id'><p class='title_select'>部課名</p><select id='buka_name' name='Serachbox[equal_buka_name]'>");
            var content_ar = document.getElementById('buka_name');
            for (const elem of bukamei) {
                content_ar.innerHTML += elem;
            }
            content_ar.insertAdjacentHTML('afterend', '<input type="button" id="buka_name_id_del"' + onclick + '');
            break;
        case "yakushoku_name":
            content_area.insertAdjacentHTML('beforebegin', "<div class='search_title_select' id='yakushoku_name_id'><p class='title_select'>役職名</p><br/><select id='yakushoku_name' name='Serachbox[equal_yakushoku_id]'>");
            var content_ar = document.getElementById('yakushoku_name');
            for (const elem of yakushoku_mei) {
                content_ar.innerHTML += elem;
            }
            content_ar.insertAdjacentHTML('afterend', '<input type="button" id="yakushoku_name_id_del"' + onclick + '');
            break;
        case "shain_kubun":
            content_area.insertAdjacentHTML('beforebegin', "<div class='search_title_select' id='shain_kubun_id'><p class='title_select'>社員区分</p><br/><select id='shain_kubun' name='Serachbox[equal_shainkubun_ID]'>");
            var content_ar = document.getElementById('shain_kubun');
            for (const elem of shain_kubun) {
                content_ar.innerHTML += elem;
            }
            content_ar.insertAdjacentHTML('afterend', '<input type="button" id="shain_kubun_id_del"' + onclick + '');
            break;
        case "tel_no_main":
            content_area.insertAdjacentHTML('beforebegin', '<div class="search_title_select" id="tel_main_id"><p class="title_select">電話番号</p><input value="" name="Serachbox[tel_main]" class="inuput_type_search" ><input type="button" id="tel_main_id_del"' + onclick + '');
            break;
        case "tel_no_sub":
            content_area.insertAdjacentHTML('beforebegin', '<div class="search_title_select" id="tel_sub_id"><p class="title_select">電話番号２</p><input value="" name="Serachbox[tel_sub]" class="inuput_type_search" ><input type="button" id="tel_sub_id_del"' + onclick + '');
            break;
        case "nyusha_day":
            content_area.insertAdjacentHTML('beforebegin', '<div class="search_title_select" id="nyusha_nengapi_id"><p class="title_select">入社年月日</p><input type="date" value="" name="Serachbox[' + 'equal_nyusha_nengapi' + num + ']" class="inuput_type_day" ><input type="button" id="' + "nyusha" + num + '" class="shosai" value="詳細" onclick="OnButtonClick(this.id,' + '\'' + 'nusya' + num + '\'' + ');"/><input type="button"  id="nyusha_nengapi_id_del"' + onclick + '<br />');

            break;
        case "taisha_day":
            content_area.insertAdjacentHTML('beforebegin', '<div class="search_title_select" id="taisha_nengapi_id"><p class="title_select">退社年月日</p><input type="date" value="" name="Serachbox[' + 'equal_taisha_nengapi' + num + ']" class="inuput_type_day" ><input type="button" id="' + "nyusha" + num + '" class="shosai" value="詳細" onclick="OnButtonClick(this.id,' + '\'' + 'taisha' + num + '\'' + ');"/><input type="button"  id="taisha_nengapi_id_del"' + onclick + '<br />');
            break;
        case "Birth_day":
            content_area.insertAdjacentHTML('beforebegin', '<div class="search_title_select" id="Birth_day_id"><p class="title_select">生年月日</p><input type="date" value="" name="Serachbox[' + 'equal_seinengapi' + num + ']" class="inuput_type_day" ><input type="button" id="' + "birth" + num + '" class="shosai" value="詳細" onclick="OnButtonClick(this.id,' + '\'' + 'Birth_day' + num + '\'' + ');"/><input type="button"  id="Birth_day_id_del"' + onclick + '<br />');
            break;
        case "seibetu":
            content_area.insertAdjacentHTML('beforebegin', '<div class="search_title_select" id="seibetu_id"><p class="title_select">性別</p><br/><select id="seibetu" name="Serachbox[equal_seibetu]">');
            var content_ar = document.getElementById('seibetu');
            for (const elem of sibetu) {
                content_ar.innerHTML += elem;
            }
            content_ar.insertAdjacentHTML('afterend', '<input type="button" id="seibetu_id_del"' + onclick + '');
            break;
        case "shikaku":
            content_area.insertAdjacentHTML('beforebegin', '<div class="search_title_select" id="shikaku_id"><p class="title_select">資格</p><input value="" name="Serachbox[sikaku]" id="shikaku" class="inuput_type_search" ><input type="button" id="shikaku_id_del"' + onclick + '');
            break;
        case "gakureki":
            content_area.insertAdjacentHTML('beforebegin', '<div class="search_title_select" id="gakureki_id"><p class="title_select">学歴</p><br/><select id="gakureki" name="Serachbox[equal_gakureki_id]">');
            var content_ar = document.getElementById('gakureki');
            for (const elem of gakureki) {
                content_ar.innerHTML += elem;
            }
            content_ar.insertAdjacentHTML('afterend', '<input type="button" id="gakureki_id_del"' + onclick + '');
            break;
        case "sotugyoko":
            content_area.insertAdjacentHTML('beforebegin', '<div class="search_title" id="sotugyoko_id"><p class="title_select">卒業校</p><input value="" name="Serachbox[sotugyoko]" id="sotugyoko" class="inuput_type_search" ><input type="button" id="sotugyoko_id_del"' + onclick + '');
            break;
        case "biko":
            content_area.insertAdjacentHTML('beforebegin', '<div class="search_title_select" id="biko_id"><p class="title_select">備考</p><input value="" name="Serachbox[biko]" id="biko" class="inuput_type_search" ><input type="button" id="biko_id_del"' + onclick + '');
            break;
        default:
            console.log('default');
            break;
    }


    var clone_element = content_area.cloneNode(true);

    // selectタグとチェックボックスのみ非表示
    if (index_no >= 7 && index_no <= 11 || index_no == 17 || index_no == 19) {
        var content_area = content_area.options[index_no].style.display = 'none';
    }

    // 新しいselect要素の複製
    clone_element.id = 'select_Box' + num;
    content_area.after(clone_element);
    content_area.style.display = 'none';
}


// 詳細をクリック時
function OnButtonClick(ID, nusha) {
    // 含む　含まない　大きい 以上　以下　小さい　大きい
    var Hikaku = '<select name="condition[' + nusha + ']" class="hikaku">' +
        "<option value='0'><p></p></option>" +
        // "<option value='LIKE'><p>含む</p></option>"+
        // "<option value='<>'><p>含まない</p></option>"+
        '<option value=">"><p>より後</p></option>' +
        '<option value="<"><p>より前</p></option>' +
        '<option value=">="><p>以降</p></option>' +
        '<option value="<="><p>以前</p></option>' +
        '<option value="<>"><p>等しくない</p></option>' +
        '<option value="="><p>等しい</p></option>' +
        "</select>";
    var content_ar = document.getElementById(ID);
    content_ar.insertAdjacentHTML('beforebegin', Hikaku);
    content_ar.remove();
}


// 削除ボタンを押したとき
function Delete_input(ID, INDEX_NO, Box_No) {
    var select_new_area = document.getElementById(Box_No);
    select_new_area.options[INDEX_NO].style.display = '';
    var del_ID = ID.slice(0, -4);
    var Get_del_ID = document.getElementById(del_ID);
    Get_del_ID.remove();
}

function rbutton_sta(radio_sta) {
    var radi_sta_zo = (radio_sta + '_zo');
    var radi_sta_gen = (radio_sta + '_gen');

    // 選択したラジオボタンの値に応じた要素を表示
    document.getElementById(radi_sta_zo).style.display = "";
    document.getElementById(radi_sta_gen).style.display = "";

    if (radi_sta_zo == "hojin_zo") {
        document.getElementById('kojin_zo').style.display = "none";
        document.getElementById('komon_zo').style.display = "none";
    } else if (radi_sta_zo == "kojin_zo") {
        document.getElementById('hojin_zo').style.display = "none";
        document.getElementById('komon_zo').style.display = "none";
    } else if (radi_sta_zo == "komon_zo") {
        document.getElementById('hojin_zo').style.display = "none";
        document.getElementById('kojin_zo').style.display = "none";
    }


    if (radi_sta_gen == "hojin_gen") {
        document.getElementById('kojin_gen').style.display = "none";
        document.getElementById('komon_gen').style.display = "none";
    } else if (radi_sta_gen == "kojin_gen") {
        document.getElementById('hojin_gen').style.display = "none";
        document.getElementById('komon_gen').style.display = "none";
    } else if (radi_sta_gen == "komon_gen") {
        document.getElementById('hojin_gen').style.display = "none";
        document.getElementById('kojin_gen').style.display = "none";
    }

}

function rbutton_sta_osaka(radio_sta) {
    var radi_sta_zo = (radio_sta + '_zo');
    var radi_sta_gen = (radio_sta + '_gen');
    // 選択したラジオボタンの値に応じた要素を表示
    document.getElementById(radi_sta_zo).style.display = "";
    document.getElementById(radi_sta_gen).style.display = "";

    if (radi_sta_zo == "hojin_osaka_zo") {
        document.getElementById('kojin_osaka_zo').style.display = "none";
        document.getElementById('komon_osaka_zo').style.display = "none";
    } else if (radi_sta_zo == "kojin_osaka_zo") {
        document.getElementById('hojin_osaka_zo').style.display = "none";
        document.getElementById('komon_osaka_zo').style.display = "none";
    } else if (radi_sta_zo == "komon_osaka_zo") {
        document.getElementById('hojin_osaka_zo').style.display = "none";
        document.getElementById('kojin_osaka_zo').style.display = "none";
    }


    if (radi_sta_gen == "hojin_osaka_gen") {
        document.getElementById('kojin_osaka_gen').style.display = "none";
        document.getElementById('komon_osaka_gen').style.display = "none";
    } else if (radi_sta_gen == "kojin_osaka_gen") {
        document.getElementById('hojin_osaka_gen').style.display = "none";
        document.getElementById('komon_osaka_gen').style.display = "none";
    } else if (radi_sta_gen == "komon_osaka_gen") {
        document.getElementById('hojin_osaka_gen').style.display = "none";
        document.getElementById('kojin_osaka_gen').style.display = "none";
    }

}


function rbutton_sta_osaka(e) {
    var input_genders = document.querySelectorAll("input[name=company_kind_osaka]");

    for (var element of input_genders) {
        if (this.checked) {
            alert(this.value);
        }
    }
}

function Henko_sabun(Num) {
    var sabun_ID = document.getElementById(Num);
    sabun_ID.style.color = '#ffffff';
    sabun_ID.style.backgroundColor = '#ff0000';
}



$(function() {
    $('#openModal').click(function() {
        $('#modalArea').fadeIn();
    });
    $('#closeModal , #modalBg').click(function() {
        $('#modalArea').fadeOut();
    });
});


window.addEventListener("load", function() {

    var elem1 = this.document.getElementById("text1");
    var elem1rect = elem1.getBoundingClientRect();
    var ToolTip1 = document.getElementById("tooltip1");

    elem1.addEventListener("mouseover", function() {
        ToolTip1.style.left = (elem1rect.left + 32) + "px";
        ToolTip1.style.top = (elem1rect.top + 32) + "px";
        ToolTip1.classList.add("visible");
    });
    elem1.addEventListener("mouseleave", function() {
        ToolTip1.classList.remove("visible");
    });

    var elem2 = this.document.getElementById("text2");
    var elem2rect = elem2.getBoundingClientRect();
    var ToolTip2 = document.getElementById("tooltip2");
    elem2.addEventListener("mouseover", function() {
        ToolTip2.style.left = (elem2rect.left + 32) + "px";
        ToolTip2.style.top = (elem2rect.top + 32) + "px";
        ToolTip2.classList.add("visible");
    });
    elem2.addEventListener("mouseleave", function() {
        ToolTip2.classList.remove("visible");
    });

    var elem3 = this.document.getElementById("text3");
    var elem3rect = elem3.getBoundingClientRect();
    var ToolTip3 = document.getElementById("tooltip3");
    elem3.addEventListener("mouseover", function() {
        ToolTip3.style.left = (elem3rect.left + 32) + "px";
        ToolTip3.style.top = (elem3rect.top + 32) + "px";
        ToolTip3.classList.add("visible");
    });
    elem3.addEventListener("mouseleave", function() {
        ToolTip3.classList.remove("visible");
    });

})