setInterval( function() {
var d =  new Date();

var h = d.getUTCHours();
var hufa = h+5;
if (hufa == 24) { var hufa = 0}
else if (hufa == 25) {
            var hufa = 1
        }
else if (hufa == 26) {
            var hufa = 2
        }
else if (hufa == 27) {
            var hufa = 3
        }
else if (hufa == 28) {
            var hufa = 4
        }
else if (hufa == 29) {
            var hufa = 5
        }
var minutes = d.getUTCMinutes();
if (minutes <10 ){
    var minutes = '0'+ minutes;
}
var day = d.getUTCDays;
   if (hufa < 9 || hufa > 17 || 6<day>0){
$(".longa-fill").css({'width' : '100%' });
} else{
        if (hufa == 9) {
            $(".longa-fill").css({'width' : '5%' });
        }
        else if (hufa == 10) {
            $(".longa-fill").css({'width' : '11%' });
        }
        else if (hufa == 11) {
            $(".longa-fill").css({'width' : '22%' });
        }
        else if (hufa == 12) {
            $(".longa-fill").css({'width' : '33%' });
        }
        else if (hufa == 13) {
            $(".longa-fill").css({'width' : '44%' });
        }
        else if (hufa == 14) {
            $(".longa-fill").css({'width' : '55%' });
        }
        else if (hufa == 15) {
            $(".longa-fill").css({'width' : '66%' });
        }
        else if (hufa == 16) {
            $(".longa-fill").css({'width' : '77%' });
        }
        else if (hufa == 17) {
            $(".longa-fill").css({'width' : '88%' });
        }
        
}

$(".curtime").html('Уфимское время: ' + hufa + ':' + minutes);
    }, 500);
  
