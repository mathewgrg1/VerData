<?php
include('src/connect.php');
session_start();
if(!isset($_SESSION['user']))
    header("Location: index.php");
$query=mysql_query("select * from hashvalues where userID=".$_SESSION['userID']);
?>
<!DOCTYPE html>   
<html lang="en">   
<head>   
<meta charset="utf-8">   
<title>VerData: Saved Hashes</title>   
<meta name="description" content="Creating a Employee table with Twitter Bootstrap. Learn with example of a Employee Table with Twitter Bootstrap.">  
<link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">   
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<link rel="stylesheet" href="http://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="css/styleLanding.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.css">
    <link rel="stylesheet" href="css/team.css">
    <link rel="stylesheet" href="css/simplelightbox.min.css">
<script type="text/javascript" src="http://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</head>  
<body style="margin:20px auto">  
    <div id="header">
    <?php
     include('src/header.php');
    ?>
    </div>
    
<div class="container">
<div class="row header" style="text-align:center;color:green">
<h3>Saved Hashes</h3>
</div>
<table id="myTable" class="table table-striped" >  
        <thead>  
          <tr>  
            <th>Sl. No.</th>  
            <th>File Name</th>  
            <th>File Size</th>  
            <th>Hash String</th>
            <th>Timestamp</th>
            <th>Action</th>
          </tr>  
        </thead>  
        <tbody>  
          <?php
            $i=0;
            if(mysql_num_rows($query) > 0) {
                while($fetch = mysql_fetch_array($query))
                    echo "<tr>
                    <td>".++$i."</td>
                    <td>".$fetch['fileName']."</td>
                    <td>".$fetch['fileSize']." KB</td>
                    <td>".$fetch['hashString']."</td>
                    <td>".$fetch['timestamp']."</td>
                    <td><a href=\"src/removeEntry.php?id=".$fetch['hashID']."\">Remove</a></td>
                    </tr>";
            }
            ?>
        </tbody>  
      </table>  
	  </div>
    <br><br><br><br><br><br><br><br>
    <div class="clearfix"> </div>
    <div id="footer">
    <?php
     include('src/footer.php');
    ?>
    </div>
</body>  
<script>
$(document).ready(function(){
    $('#myTable').dataTable();
});
</script>
</html>