<?php
session_start ();
$mail = $_SESSION ['mail'];
?>
<html>
<head>
<style>
.btn-submit {
	position: relative;
	overflow: hidden;
}

.btn-submit input[type=submit] {
	position: absolute;
	top: 0;
	right: 0;
	min-width: 100%;
	min-height: 100%;
	font-size: 100px;
	text-align: right;
	filter: alpha(opacity = 0);
	opacity: 0;
	outline: none;
	background: white;
	cursor: inherit;
	display: block;
}

button {
	display: inline-block;
	line-height: 1.2;
	appearance: none;
	box-shadow: none;
	border-radius: 0;
}

button:focus {
	outline: none
}

section.gradient button {
	color: #fff;
	background-color: #ffffff;
	background-image: linear-gradient(top, #6496c8, #346392);
	border: none;
}
</style>
</head>
<body>	
<?php

$folder = 'upload';
try {
	$directory = new RecursiveDirectoryIterator ( $folder );
	$iterator = new RecursiveIteratorIterator ( $directory );
	$files = new RegexIterator ( $iterator, '/^.+\.(jpg|jpeg|png|gif)$/i', RecursiveRegexIterator::GET_MATCH );
} catch ( Exception $e ) {
	echo "Invalid Directory: " . $e->getMessage ();
}
// $files is an array with file name of all the valid images
if (isset ( $files ) && $files != null) {
	
	foreach ( $files as $filepath => $value ) {
		$newpath = "http://udaydungarwal.com/Project/" . $filepath;
		$pix = "javascript:pixlr.overlay.show({image:&quot;" . $newpath . "&quot;, title:&quot;" . $filepath . "&quot;, service:&quot;editor&quot;});";
		echo " <input type='checkbox' name='check[]' value='" . $filepath . "'/>
        				<a href='" . $pix . "'> <img src='./" . $filepath . "' alt='Cinque Terre' width='80' height='80'></a>";
	}
}
?>
<div>
		<br>
	</div>
	<div>
		<section class="gradient">
			<button data-dismiss="modal" aria-hidden="true" onclick="testGame()">
				<img src='logo1.png' alt='Cinque Terre' width='70' height='35'>
			</button>
		</section>
	</div>
	<div>
		<br>
	</div>
	<div>
		<input type="checkbox" id="checkAll"><font face="Comic Sans MS"
			size="2">SelectAll</font>
	</div>
	<div>
		<button class="btn btn-submit" data-dismiss="modal" aria-hidden="true"
			onclick="testAjax()">Delete</button>
	</div>
	<script type="text/javascript"
		src="http://developer.pixlr.com/_script/pixlr.js"></script>

	<script
		src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script type="text/javascript">
            $("#checkAll").change(function () {
                                  $("input:checkbox").prop('checked', $(this).prop("checked"));
                                  });

var pixlr = (function () {
    /*
     * IE only, size the size is only used when needed
     */
    function windowSize() {
        var w = 0,
            h = 0;
        if (document.documentElement.clientWidth !== 0) {
            w = document.documentElement.clientWidth;
            h = document.documentElement.clientHeight;
        } else {
            w = document.body.clientWidth;
            h = document.body.clientHeight;
        }
        return {
            width: w,
            height: h
        };
    }

    function extend(object, extender) {
        for (var attr in extender) {
            if (extender.hasOwnProperty(attr)) {
                object[attr] = extender[attr] || object[attr];
            }
        }
        return object;
    }

    function buildUrl(opt) {
        var url = 'http://pixlr.com/' + opt.service + '/?s=c', attr;
        for (attr in opt) {
            if (opt.hasOwnProperty(attr) && attr !== 'service') {
                url += "&" + attr + "=" + escape(opt[attr]);
            }
        }
        return url;
    }
    var bo = {
        ie: window.ActiveXObject,
        ie6: window.ActiveXObject && (document.implementation !== null) && (document.implementation.hasFeature !== null) && (window.XMLHttpRequest === null),
        quirks: document.compatMode === 'BackCompat' },
        return_obj = {
            settings: {
                'service': 'editor'
            },
            overlay: {
                show: function (options) { 
                    var opt = extend(return_obj.settings, options || {}),
                        iframe = document.createElement('iframe'),
                        div = pixlr.overlay.div = document.createElement('div'),
                        but = pixlr.overlay.but = document.createElement('button'),
                        idiv = pixlr.overlay.idiv = document.createElement('div');
                   

                    div.style.background = '#696969';
                    div.style.opacity = 0.8;
                    div.style.filter = 'alpha(opacity=80)';
                    div.id = 'overlay_div';
                    idiv.id = 'iframe_div';
                    idiv.style.position = 'relative';
                    
                   
                    var t = document.createTextNode("X");
                    but.appendChild(t); 

                   
                    
                    but.style.width = '20px';
                    but.style.top = '-18px';
                    but.style.right = '-4px';
                    but.style.position = 'absolute';
                    but.style.backgroundColor = 'black';
                    but.style.color = 'white';
                    
                   
                  
                    
                    but.onclick = function() {
                    	$(document).find("#overlay_div").remove();
                    	$(document).find("#iframe_div").remove();
                    };
                    
                    

                    if ((bo.ie && bo.quirks) || bo.ie6) {
                        var size = windowSize();
                        div.style.position = 'absolute';
                        div.style.width = size.width + 'px';
                        div.style.height = size.height + 'px';
                        div.style.setExpression('top', "(t=document.documentElement.scrollTop||document.body.scrollTop)+'px'");
                        div.style.setExpression('left', "(l=document.documentElement.scrollLeft||document.body.scrollLeft)+'px'");
                    } else {
                        div.style.width = '100%';
                        div.style.height = '100%';
                        div.style.top = '0';
                        div.style.left = '0';
                        div.style.position = 'fixed';
                    }
                    div.style.zIndex = 99998;

                    idiv.style.border = '1px solid #2c2c2c';
                    if ((bo.ie && bo.quirks) || bo.ie6) {
                        idiv.style.position = 'absolute';
                        idiv.style.setExpression('top', "25+((t=document.documentElement.scrollTop||document.body.scrollTop))+'px'");
                        idiv.style.setExpression('left', "35+((l=document.documentElement.scrollLeft||document.body.scrollLeft))+'px'");
                    } else {
                        idiv.style.position = 'fixed';
                        idiv.style.top = '25px';
                        idiv.style.left = '35px';
                    }
                    idiv.style.zIndex = 99999;

                    document.body.appendChild(div);
                    document.body.appendChild(idiv);
                    
                    
                    
                    
                    
                    //document.body.appendChild("<button>Remove</button>");

                    iframe.style.width = (div.offsetWidth - 70) + 'px';
                    iframe.style.height = (div.offsetHeight - 50) + 'px';
                    iframe.style.border = '1px solid #b1b1b1';
                    iframe.style.backgroundColor = '#606060';
                    iframe.style.display = 'block';
                    iframe.frameBorder = 0;
                    iframe.src = buildUrl(opt);
                    idiv.appendChild(but);
                    idiv.appendChild(iframe);
                },
                hide: function (callback) {
                	
                    if (pixlr.overlay.idiv && pixlr.overlay.div) {
                        document.body.removeChild(pixlr.overlay.idiv);
                        document.body.removeChild(pixlr.overlay.div);
                    }
                    if (callback) {
                        eval(callback);
                    }
                }
            },
            url: function(options) {
           
                return buildUrl(extend(return_obj.settings, options || {}));
            },
            edit: function (options) {
            	
                var opt = extend(return_obj.settings, options || {});
                location.href = buildUrl(opt);
            }
        };  
    return return_obj;
}());
            var urls = ['http://udaydungarwal.com/Project/delete.php'];

        	
            function testAjax() {
        	
            for(i=0; i<urls.length; i++)
            {
				sendMyAjax(urls[i]);
            }

            function sendMyAjax(URL_address){ 
                
            var checkedValues = $('input:checkbox[name="check[]"]:checked').map(function () {
            	    return $(this).val();
            	}).get();
        	
            $.ajax({        
                type: "POST",
                url: URL_address,
                data: { cValues : checkedValues },
                success: function(data) {
                alert(data);
                	}
             }); 
            }
            }

            function testGame(){ 
                  
                var checkedValue = $('input:checkbox[name="check[]"]:checked').map(function () {
                	    return $(this).val();
                	}).get();
                
                $.ajax({        
                    type: "POST",
                    url: 'http://udaydungarwal.com/Project/upload/thumb.php',
                    data: { cValues : checkedValue },
                    success: function(data) {
                    
                    	}
                 });

                window.location="http://udaydungarwal.com/Project/upload/game.php";
                
//                 window.open("http://udaydungarwal.com/Project/upload/game.php?", "socialPopupWindow",
//                 "location=no,width=600,height=600,scrollbars=yes,top=100,left=700,resizable = no");
                
                }

            pixlr.settings.target = 'http://udaydungarwal.com/Project/save.php';
       	 	//pixlr.settings.exit = 'http://udaydungarwal.com/Project/save.php';
       		pixlr.settings.method = 'GET';
       	    pixlr.settings.redirect = false;

        		</script>
	</script>
</body>
</html>