window.addEventListener('DOMContentLoaded', function() {
    var row = document.getElementById('table_id').rows.length;
    var ninzu = document.getElementById('output');
    // 表示人数
    ninzu.innerHTML = '<p id="output">' + row + '人表示中</p>';
});

function alertValue(r) {
    const textbox = document.getElementById("quick_search").value;
    var ninzu = document.getElementById('output');
    var row = document.getElementById('table_id').rows.length - 2;
    var shain_ID = document.querySelectorAll('.shain_search');
    var log = function() {
        var count = 0;

        if (textbox != "") {
            for (var i = 1; i <= row; i++) {
                var style = window.getComputedStyle(shain_ID[i]);
                var value = style.getPropertyValue('display');
                if (value != 'none') {
                    count++;
                }
            }
        } else {
            count = row + 2;
        }
        ninzu.innerHTML = '<p id="output">' + count + '人表示中</p>';
    };
    setTimeout(log, 30);
}