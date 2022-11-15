function set2fig(num) {
    var ret;
    if(num < 10 ) {
        ret = "0" + num;
    } else {
        ret = num;
    }
    return ret;
 }
 function showClock2() {
    var nowTime = new Date();
    var nowHour = set2fig( nowTime.getHours() );
    var nowMin  = set2fig( nowTime.getMinutes() );
    var nowSec  = set2fig( nowTime.getSeconds() );
    var msg = nowHour + ":" + nowMin + ":" + nowSec;
    document.getElementById("RealtimeClockArea").innerHTML = msg;
 }
 setInterval('showClock2()',0);