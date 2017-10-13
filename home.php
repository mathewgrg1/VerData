<?php
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
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <script src="js/spark-md5.js"></script>
    <script>
        var secondHash="";
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
        document.getElementById('fileNameField').value = fileName;
        var fileSize = document.getElementById('files').files[0].size;
        document.getElementById('fileSizeField').value = fileSize;
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
    var move = function(width) {
        var elem = document.getElementById("myBar");
        elem.style.width = width + '%'; 
        elem.innerHTML = width * 1 + '%';
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
        function init() {
                document.getElementById('files').addEventListener('change', function () {
                    dispDetails();
                    document.getElementById('saveBtn').setAttribute('disabled',true);
                    document.getElementById('compareBtn').setAttribute('disabled',true);
                    document.getElementById('clearBtn').setAttribute('disabled',true);
                    var blobSlice = File.prototype.slice || File.prototype.mozSlice || File.prototype.webkitSlice,
                        file = this.files[0],
                        chunkSize = 2097152,                             // Read in chunks of 2MB
                        chunks = Math.ceil(file.size / chunkSize),
                        currentChunk = 0,
                        spark = new SparkMD5.ArrayBuffer(),
                        fileReader = new FileReader();

                    fileReader.onload = function (e) {
//                        console.log('read chunk nr', currentChunk + 1, 'of', chunks);
                        var percent = ((currentChunk+1)/chunks)*100;
                        
                        move(Number(percent.toFixed(0)));
                        spark.append(e.target.result);                   // Append array buffer
                        currentChunk++;

                        if (currentChunk < chunks) {
                            loadNext();
                        } else {
//                            console.log('finished loading');
//                            console.info('computed hash', spark.end());  // Compute hash
                            document.getElementById('hash_string').value = spark.end();
                            document.getElementById('saveBtn').removeAttribute('disabled');
                            document.getElementById('compareBtn').removeAttribute('disabled');
                            document.getElementById('clearBtn').removeAttribute('disabled');
                        }
                    };

                    fileReader.onerror = function () {
                        console.warn('oops, something went wrong.');
                    };

                    function loadNext() {
                        var start = currentChunk * chunkSize,
                            end = ((start + chunkSize) >= file.size) ? file.size : start + chunkSize;

                        fileReader.readAsArrayBuffer(blobSlice.call(file, start, end));
                    }

                    loadNext();
                });
            }
        var compare = function (){
            var hash_string = document.getElementById('hash_string');
            if(hash_string.value == null) {
                return;
            }
            if(document.getElementById('dbVal').checked)
                var radioVal = 0;
            else if(document.getElementById('strVal').checked)
                var radioVal = 1;
            else if(document.getElementById('anFile').checked)
                var radioVal = 2;
            
            if(radioVal == 0) {
                checkDB(hash_string.value);
            }
            else if(radioVal == 1) {
                compareStr();
            }
            else if(radioVal == 2) {
                compareFile();
            }
        }
        var checkDB = function(hash) {
            var hashForm = document.getElementById('hashForm');
            hashForm.setAttribute('action','src/fetchHash.php');
            hashForm.submit();
        }
        var compareStr = function() {
            var hashString = document.getElementById('hash_string').value;
            var hashString2 = document.getElementById('hash_string2').value;
            document.getElementById('resultHead').innerHTML = "Result";
            if(hashString == hashString2)
                document.getElementById('resultLabel').innerHTML = "Strings match";
            else
                document.getElementById('resultLabel').innerHTML = "Strings do not match";
        }
        var compareFile = function() {
            document.getElementById('saveBtn').setAttribute('disabled',true);
            document.getElementById('compareBtn').setAttribute('disabled',true);
            document.getElementById('clearBtn').setAttribute('disabled',true);  
            var blobSlice = File.prototype.slice || File.prototype.mozSlice || File.prototype.webkitSlice,
                file = document.getElementById('hash_string2').files[0],
                chunkSize = 2097152,                             // Read in chunks of 2MB
                chunks = Math.ceil(file.size / chunkSize),
                currentChunk = 0,
                spark = new SparkMD5.ArrayBuffer(),
                fileReader = new FileReader();

            fileReader.onload = function (e) {
//                        console.log('read chunk nr', currentChunk + 1, 'of', chunks);
                var percent = ((currentChunk+1)/chunks)*100;

                move(Number(percent.toFixed(0)));
                spark.append(e.target.result);                   // Append array buffer
                currentChunk++;

                if (currentChunk < chunks) {
                    loadNext();
                } else {
//                            console.log('finished loading');
//                            console.info('computed hash', spark.end());  // Compute hash
//                    document.getElementById('hash_string').value = spark.end();
                    document.getElementById('resultHead').innerHTML = "Result";
                    if(document.getElementById('hash_string').value == spark.end())
                        document.getElementById('resultLabel').innerHTML = "Files Match";
                    else
                        document.getElementById('resultLabel').innerHTML = "Files do not match";
                    document.getElementById('saveBtn').removeAttribute('disabled');
                    document.getElementById('compareBtn').removeAttribute('disabled');
                    document.getElementById('clearBtn').removeAttribute('disabled');
                }
            };

            fileReader.onerror = function () {
                console.warn('oops, something went wrong.');
            };

            function loadNext() {
                var start = currentChunk * chunkSize,
                    end = ((start + chunkSize) >= file.size) ? file.size : start + chunkSize;

                fileReader.readAsArrayBuffer(blobSlice.call(file, start, end));
            }

            loadNext();
        }
        var saveHash = function() {
            var hashForm = document.getElementById('hashForm');
            hashForm.setAttribute('action','src/saveHash.php');
            hashForm.submit();
        }
        var clearFields = function() {
            document.getElementById('file_name_label').innerHTML = "No File Selected";
            document.getElementById('fileNameField').value = "";
            document.getElementById('file_size_label').innerHTML = "0 Bytes";
            document.getElementById('fileSizeField').value = "";
            document.getElementById('hash_string').value = "";
            window.location = "src/clearValues.php";
        }
    </script>
</head>  
<body style="margin:20px auto" onload="init();">  
    <div id="header">
    <?php
     include('src/header.php');
    ?>
    </div>

    <!--content-->
    <div id="MD5FileDiv" class="fieldset" style="width: 74%; margin-left: 13%;">

<form action="src/fetchHash.php" method="post" id="hashForm">
<div class="tips_text tips_text1" id="HashFile">
<div id="result">Generate and verify the MD5 checksum of a file without uploading it.</div>

<input type="file" id="files" name="files[]">
    
<div id="drop_zone" onclick="document.getElementById('files').click();return false;">Click to select a file, or drag and drop it here...</div>

<div id="file_info">
	
<div id="file_name" class="line"><div class="lineLeft">Filename:</div><div id="file_name_label" class="lineRight"><?php
    if(isset($_SESSION['fileName']))
        echo $_SESSION['fileName'];
    else
        echo "No File Selected";
    ?></div>
<input type="text" name="fileName" id="fileNameField" value="" hidden>
    </div>


<div id="file_size" class="line"><div class="lineLeft">File size:</div><div id="file_size_label" class="lineRight">
    <?php
    if(isset($_SESSION['fileSize'])) {
        $fileSize=$_SESSION['fileSize'];
        if($fileSize < 1024)
//            document.getElementById('file_size_label').innerHTML = fileSize + " B";
            echo round($fileSize,2) ." Bytes";
        else if($fileSize < 1048576)
//            document.getElementById('file_size_label').innerHTML = roundTo(fileSize/1024, 2) + " KB";
            echo round(($fileSize/1024),2) ." KB";
        else if($fileSize < 1073741824)
//            document.getElementById('file_size_label').innerHTML = roundTo(fileSize/1048576, 2) + " MB";
            echo round(($fileSize/1048576),2) ." MB";
        else
//            document.getElementById('file_size_label').innerHTML = roundTo(fileSize/1073741824, 2) + " GB";
            echo round(($fileSize/1073741824),2) ." GB";
    }
    else
        echo "0 Bytes";
    ?></div>
    <input type="text" name="fileSize" id="fileSizeField" value="" hidden>
</div>


<div id="file_checksum" class="line"><div class="lineLeft">File checksum:</div>
<input type="text" class="hash_string_text" id="hash_string" name="hash_string" value="<?php 
                                        if(isset($_SESSION['hash_string']))
                                            echo $_SESSION['hash_string'];
                                        else
                                            echo "";
                                                                                       ?>">
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
    <input type="text" class="hash_string_text" id="hash_string2" name="hash_string2" disabled>
    </div>
</div>



<div id="progress_box" class="line"><div class="lineLeft" id="ProcessDiv">Progress:</div>
<div id="progress_bar"><div id="percent"></div><div id="percentText"><div id="myProgress">
  <div id="myBar">0%</div>
</div></div></div>
</div>
</div>

    
<div id="resultArea">
<center>
    <br><br>
    <?php
    $h3 = null;
    $label = null;
    if(isset($_SESSION['msg'])) {
        $h3 = "Result";
        if($_SESSION['msg']=="success")
            $label = "Match found.<br>File name: ".$_SESSION['fileName'];
        else if($_SESSION['msg']=="fail")
            $label = "Match not found.<br>Either hash not saved or this file is altered.";
        else if($_SESSION['msg']=="saved")
            $label = "Hash Saved.<a href=\"history.php\">View</a> saved hashes.";
        else if($_SESSION['msg']=="alreadyExists")
            $label = "Hash of the file already saved.<br>File name: ".$_SESSION['fileName']."<br>Time: ".$_SESSION['timestamp']."<br><a href=\"history.php\">View</a> saved hashes.";
    }
    ?>
    <h3 style="color: red" id="resultHead"><?php echo $h3 ?></h3>
    <label id="resultLabel"><?php echo $label; $_SESSION['msg']=null ?></label>
</center>
</div>



<div id="Buttons">
<input class="Btn" type="button" id="saveBtn" value="Save hash" onclick="saveHash();">
<input class="Btn" type="button" id="compareBtn" value="Compare" onclick="compare();">
<input class="Btn" type="button" id="clearBtn" value="Clear" onclick="clearFields();">
</div>


</div>
</form>
        
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