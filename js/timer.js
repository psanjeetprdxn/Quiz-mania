var timeleft = 420;

function timeout()
{
    var minutes = Math.floor(timeleft/60);
    var seconds = timeleft%60;


    // If the count down is over, write some text
    if (timeleft < 0) {
        clearInterval(x);
        document.getElementById("auto-submit").submit();
    }else{
        document.getElementById('timer').value = timeleft;
        document.getElementById("count-down").innerHTML = minutes + "m " + seconds + "s ";

    }
    timeleft--;
    var x = setTimeout(function() {timeout()}, 1000);
}
