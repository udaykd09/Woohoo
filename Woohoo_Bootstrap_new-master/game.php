<?php
session_start ();
$mail = $_SESSION ['mail'];
?>

<!DOCTYPE html>
<html>
<head>
<META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
<META HTTP-EQUIV="EXPIRES" CONTENT="Mon, 22 Jul 2002 11:12:01 GMT">
<style>
.blank {
	border: 2px solid #f00;
}

.correct {
	border: 2px solid #090;
}

.normal {
	border: 2px solid #eeeeec;
}

.a {
	height: 100px;
	width: 100px;
	background-position: 0px 0px;
	background-image: url('test.jpg');
	background-repeat: no-repeat;
}

.d {
	height: 100px;
	width: 100px;
	background-position: -0px -100px;
	background-image: url('test.jpg');
	background-repeat: no-repeat;
}

.g {
	height: 100px;
	width: 100px;
	background-position: -0px -200px;
	background-image: url('test.jpg');
	background-repeat: no-repeat;
}

.b {
	height: 100px;
	width: 100px;
	background-position: -100px 0px;
	background-image: url('test.jpg');
	background-repeat: no-repeat;
}

.e {
	height: 100px;
	width: 100px;
	background-position: -100px -100px;
	background-image: url('test.jpg');
	background-repeat: no-repeat;
}

.h {
	height: 100px;
	width: 100px;
	background-position: -100px -200px;
	background-image: url('test.jpg');
	background-repeat: no-repeat;
}

.c {
	height: 100px;
	width: 100px;
	background-position: -200px 0px;
	background-image: url('test.jpg');
	background-repeat: no-repeat;
}

.f {
	height: 100px;
	width: 100px;
	background-position: -200px -100px;
	background-image: url('test.jpg');
	background-repeat: no-repeat;
}

.i {
	height: 100px;
	width: 100px;
	background-position: -200px -200px;
	background-image: url('test.jpg');
	background-repeat: no-repeat;
}
</style>

</head>
<body onload="initAll();">
	<div>
		<br>
	</div>
	<div>
		<br>
	</div>
	<!--        <table width="300" border="1" align="center" cellpadding="0" cellspacing="0">-->
	<!--            <tr>-->
	<!--        <td><div height='100' width='100' id='1' class="a" onclick="slide(1);"></div></td>-->
	<!--        <td><div height='100' width='100' id='' class="d" onclick="slide(4);"></div></td>-->
	<!--        <td><div height='100' width='100' id='7' class="g" onclick="slide(7);"></div></td>-->
	<!--            </tr><tr>-->
	<!--                <td><div height='100' width='100' id='2' class="b" onclick="slide(2);"></div></td>-->
	<!--                <td><div height='100' width='100' id='5' class="e" onclick="slide(5);"></div></td>-->
	<!--                <td><div height='100' width='100' id='8' class="h" onclick="slide(8);"></div></td>-->
	<!--            </tr>-->
	<!--            <tr>-->
	<!--                <td><div height='100' width='100' id='3'class="c" onclick="slide(3);"></div></td>-->
	<!--                <td><div height='100' width='100' id='6'class="f" onclick="slide(6);"></div></td>-->
	<!--                <td><div height='100' width='100' id='9'class="i" onclick="slide(9);"></div></td>-->
	<!--            </tr>-->
	<!--            </table>-->

	<table width="300" border="1" align="center" cellpadding="0"
		cellspacing="0">
		<tr>
			<td><div class="normal a" id="1" width="100" height="100"
					onclick="slide(1);"></div></td>
			<td><div class="normal b" id="2" width="100" height="100"
					onclick="slide(2);"></div></td>
			<td><div class="normal c" id="3" width="100" height="100"
					onclick="slide(3);"></div></td>
		</tr>
		<tr>
			<td><div class="normal d" id="4" width="100" height="100"
					onclick="slide(4);"></div></td>
			<td><div class="normal e" id="5" width="100" height="100"
					onclick="slide(5);"></div></td>
			<td><div class="normal f" id="6" width="100" height="100"
					onclick="slide(6);"></div></td>
		</tr>
		<tr>
			<td><div class="normal g" id="7" width="100" height="100"
					onclick="slide(7);"></div></td>
			<td><div class="normal h" id="8" width="100" height="100"
					onclick="slide(8);"></div></td>
			<td><div class="normal i" id="9" width="100" height="100"
					onclick="slide(9);"></div></td>
		</tr>
	</table>

	<br />
	<div id="101" align="center">
		<h3>
			<font face="Comic Sans MS">Moves: 0</font>
		</h3>
	</div>

	<div>
		<br>
	</div>
	<div>
		<br>
	</div>
	<button>
		<a href="http://udaydungarwal.com/Project/browse.php">Homepage</a>
	</button>

	<script
		src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script type="text/javascript">
    // JavaScript Document
    var flagNew=false;
    var fill;
    var mark;
    var moves = 0;
    var gameArr = new Array(9);
     var charArr = new Array('a','b','c','d','e','f','g','h','i');
    var gameFinal = new Array(0,1,2,3,4,5,6,7,8);
    var xhr = false;
    
    function initAll() {
        var i;
        fill = 0;
        for (i = 0; i < 9; i++) {
            var pos = generateNum();
            while (!findNum(pos)) {
                pos = generateNum();
            }

            gameArr[fill] = pos;
            if (pos == 0) mark = fill;
            var src = charArr[gameArr[fill]];
            fill++;
            document.getElementById(fill).className = src;
            
        }
        console.log(gameArr);
        console.log(charArr);
    }

function findNum(j) {
    for (var i = 0; i < fill; i++) {
        if (gameArr[i] == j) {
            return (false);
        }
    }
    return (true);
}

function generateNum() {
    return (Math.floor((Math.random() * 9)));
}

function slide(num) {
    num--;
   /* if (num == mark + 1 || num == mark - 1 || num == mark + 3 || num == mark - 3) {
        if ((num == mark + 1) && ((mark == 2 && num == 3) || (mark == 5 && num == 6))) {
            alert("Not movable");
            return;
        }
        if ((num == mark - 1) && ((mark == 3 && num == 2) || (mark == 6 && num == 5))) {
            alert("Not movable");
            return;
        }*/
   if(num==mark && flagNew==true){
       return;
   }
   
   if(flagNew==true){
        var tmp = document.getElementById(num + 1).className;
        document.getElementById(num + 1).className = document.getElementById(mark + 1).className;
        document.getElementById(mark + 1).className = tmp;
        tmp = gameArr[num];
        gameArr[num] = gameArr[mark];
        gameArr[mark] = tmp;
 //       mark = num;
        //document.getElementById(num+1).className = " blank";
        moves++;
        document.getElementById(101).innerHTML = "<h3>Moves:" + moves + "</h3>";
        checkWin();
        flagNew=false;
   }
   else {
       mark = num;
       document.getElementById(num+1).className += " blank";
       flagNew=true;
   }
    } //else alert("Not movable");
//}

function checkWin() {
    var flag = true;
    for (var i = 0; i < 9; i++) {
                document.getElementById(i+1).className.replace(" blank","");
                document.getElementById(i+1).className=document.getElementById(i+1).className.replace(" blank","");
//        if(document.getElementById(i + 1).className) += " normal";
        
        if (gameArr[i] == gameFinal[i]) {
            //document.getElementById(i + 1).className += " correct";
        } else {
            
        }
        if (flag == true && gameArr[i] != gameFinal[i]) {
            flag = false;
        }
    }
    if (flag) {
        alert("Woohoo! You Won");
       over();
    }
}

function over() {
	$.ajax({        
        type: "GET",
        url: 'http://udaydungarwal.com/Project/insertMoves.php?moves='+moves,
        success: function(data) {
        alert("Score updated");
        	}
     });
}

function showContents() {
    if (xhr.readyState == 4) {
        if (xhr.status == 200) {
            var outMsg = xhr.responseText;
        } else {
            var outMsg = "There was a problem with the request " + xhr.status;
        }
    }
}
</script>

</body>
</html>
