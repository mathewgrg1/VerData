<?php
include('src/connect.php');
session_start();
if(!isset($_SESSION['user']))
    header("Location: index.php");
?>
<!DOCTYPE html>   
<html lang="en">   
<head>   
<meta charset="utf-8">   
<title>VerData</title> 
    <style>
    #myProgress {
        width: 100%;
        background-color: grey;
    }
    #myBar {
        width: 0%;
        height: 30px;
        background-color: #4CAF50;
        text-align: center; /* To center it horizontally (if you want) */
        line-height: 30px; /* To center it vertically */
        color: white; 
    }
    </style>
<meta name="description" content="Creating a Employee table with Twitter Bootstrap. Learn with example of a Employee Table with Twitter Bootstrap.">  
    <link rel="stylesheet" href="css/styleLanding.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.css">
    <link rel="stylesheet" href="css/team.css">
    <link rel="stylesheet" href="css/simplelightbox.min.css">
    <link rel="stylesheet" href="css/styleHome.css">
    <script>
        function roundTo(n, digits) {
     if (digits === undefined) {
       digits = 0;
     }

     var multiplicator = Math.pow(10, digits);
     n = parseFloat((n * multiplicator).toFixed(11));
     var test =(Math.round(n) / multiplicator);
     return +(test.toFixed(digits));
   }
    var dispDetails = function () {
        var fileName = document.getElementById('files').value.replace(/.*[\/\\]/, '');
        document.getElementById('file_name_label').innerHTML = fileName;
        var fileSize = document.getElementById('files').files[0].size;
        if(fileSize < 1024)
            document.getElementById('file_size_label').innerHTML = fileSize + " B";
        else if(fileSize < 1048576)
            document.getElementById('file_size_label').innerHTML = roundTo(fileSize/1024, 2) + " KB";
        else if(fileSize < 1073741824)
            document.getElementById('file_size_label').innerHTML = roundTo(fileSize/1048576, 2) + " MB";
        else
            document.getElementById('file_size_label').innerHTML = roundTo(fileSize/1073741824, 2) + " GB";
        //call hash function
    }
    var move = function() {
        var elem = document.getElementById("myBar"); 
        var width = 10;
        var id = setInterval(frame, 10);
        function frame() {
            if (width >= 100) {
                clearInterval(id);
            } else {
                width++; 
                elem.style.width = width + '%'; 
                elem.innerHTML = width * 1 + '%';
            }
        }
    }
        var compareWith = function() {
            var hash_string2 = document.getElementById('hash_string2');
            if(document.getElementById('dbVal').checked)
                var radioVal = 0;
            else if(document.getElementById('strVal').checked)
                var radioVal = 1;
            else if(document.getElementById('anFile').checked)
                var radioVal = 2;
            
            if(radioVal == 0) {
                hash_string2.type = 'text';
                hash_string2.disabled = true;
            }
            else if(radioVal == 1) {
                hash_string2.type = 'text';
                hash_string2.disabled = false;
            }
            else if(radioVal == 2) {
                hash_string2.type = 'file';
                hash_string2.disabled = false;
            }
        }
    </script>
</head>  
<body style="margin:20px auto">  
    <div id="header">
    <?php
     include('src/header.php');
    ?>
    </div>

    <!--content-->
    <div id="MD5FileDiv" class="fieldset" style="width: 74%; margin-left: 13%;">



<div class="tips_text tips_text1" id="HashFile">
<div id="result">Generate and verify the MD5 checksum of a file without uploading it.</div>

<input type="file" id="files" name="files[]" onchange="dispDetails()">
    
<div id="drop_zone" onclick="document.getElementById('files').click();return false;">Click to select a file, or drag and drop it here...</div>

<div id="file_info">
	
<div id="file_name" class="line"><div class="lineLeft">Filename:</div><div id="file_name_label" class="lineRight">No File Selected</div>
</div>


<div id="file_size" class="line"><div class="lineLeft">File size:</div><div id="file_size_label" class="lineRight">0 Bytes</div>
</div>


<div id="file_checksum" class="line"><div class="lineLeft">File checksum:</div>
<input type="text" class="hash_string_text" id="hash_string" onclick="SelectAll('hash_string');">
</div>
    
<div id="checksum_type" class="line"><div class="lineLeft">Compare with:</div>
<div class="lineRight">
<label><input type="radio" class="radiobtn" name="checksum_type_" id="dbVal" value="0" checked onclick="compareWith();">Database</label>
<label><input type="radio" class="radiobtn marginleft6px" name="checksum_type_" id="strVal" value="1" onclick="compareWith();">String</label>
<label><input type="radio" class="radiobtn marginleft6px" name="checksum_type_" id="anFile" value="2" onclick="compareWith();">Another file</label>
</div>
</div>

<div id="compare_with" class="line"><div class="lineLeft">Compare with: </div>
<div id="compare_ico">
    <input type="text" class="hash_string_text" id="hash_string2" disabled>
    </div>
</div>



<div id="progress_box" class="line"><div class="lineLeft" id="ProcessDiv">Progress:</div>
<div id="progress_bar"><div id="percent"></div><div id="percentText"><div id="myProgress">
  <div id="myBar">0%</div>
</div></div></div>
</div>
</div>




<div id="Buttons">
<input class="Btn" type="button" id="pauseBtn" onclick="pP();" value="Pause">
<input class="Btn" type="button" id="CompareBtn" onclick="move();" value="Compare">
<input class="Btn" type="button" onclick="aR();" value="Stop">
</div>


</div>

</div>

    <!--//content-->
    <br><br><br><br><br><br><br><br>
    <div class="clearfix"> </div>
    <div id="footer">
    <?php
     include('src/footer.php');
    ?>
    </div>
</body>
</html>