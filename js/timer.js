var totalTime = 420;  //In seconds
		if (localStorage.getItem("timer") === null) {
  			localStorage.setItem("timer", totalTime);
		}

		function timeout()
		{
			if (localStorage.timer < 0) {

    	    	localStorage.setItem("timer", totalTime);
    	    	clearInterval(x);
    	    	document.getElementById("auto-submit").submit();
    		} else {
    	    	minutes = Math.floor(localStorage.timer / 60);
    	    	seconds = localStorage.timer % 60;
    	    	document.getElementById("count-down").innerHTML = minutes + "m " + seconds + "s ";
            document.getElementById("time").value = localStorage.timer;
    		}
    		localStorage.timer--;
    		var x = setTimeout(function() {timeout()}, 1000);
		}

    function resetTimerStorage()
    {
      localStorage.setItem("timer", totalTime);
    }
