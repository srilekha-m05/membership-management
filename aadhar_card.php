<?php

  include 'include/database_connection.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Youth Serve India</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" >
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" ></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" ></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="./css/style.css" />
	<link rel="stylesheet" type="text/css" href="./css/print_table.css" media="print">
<style type="text/css">
	
	
</style>
</head>
<body >
<nav class="navbar navbar-dark bg-primary navbar-expand-md justify-content-between">
  <a class="navbar-brand" href="#" style="font-family:Lucida Console;font-weight: bold;">YOUTH FOR SERVE</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
   
  <form class="form-inline my-1" method="POST" action="aadhar_card.php">
  	<div class="collapse navbar-collapse " id="navbarNav">
    <ul class="navbar-nav">
    	
       <li class="nav-item">

        <a class="nav-link " style="color: white" href="index.php"><b> Home </b></a>
      </li>
      <li class="nav-item">

        <a class="nav-link " style="color: white" href="list.php"><b> Entries </b></a>
      </li>

      <li>
      	<a class="nav-link " style="color: white" href="members.php"><b> Members </b></a>
      </li>
     

  </ul>
</div>
    
  </form>

</nav>
<div class="container" style="margin-top: 6%;margin-bottom: 3%;">
  <div class="text-center"> 
     <form action="aadhar_card.php" method="POST">
 Enter Member Id or Aadhar Number or Enroll Number:  <input type="text" name="mid" id="mid" style="border:1px solid blue;">
  <input type="submit" class="btn btn-primary" name="check" value="submit" style="">
  
</form>

   </div>
   </div>

<?php


if(isset($_POST["check"]))
{
  $val=$_POST["mid"];
  $sql="SELECT * from members WHERE member_id='$val' OR aadhar_no='$val' OR enroll_no='$val'";
  $ret = $db->query($sql);
  $q="SELECT count(*) as count from members WHERE member_id='$val' OR aadhar_no='$val' OR enroll_no='$val'";
     $rows = $db->query($q);
      $row = $rows->fetchArray();
      $numRows = $row['count'];
      if($numRows == 0)
      {

        echo "<h5 class=text-center>No results Found</h5>";
      } 
      else
      {
        echo '<table class="table table-bordered" id="t1">
      <tr style="margin-bottom:2%"><th>Id</th><th>Enroll No</th><th>Name</th><th>Father Name</th>
      <th>Gender</th><th>Phone Number</th><th>Email Id</th><th>Aadhar Number</th><th>DOB</th><th>Blood Group</th><th>Address</th></tr>';
      
      while($row = $ret->fetchArray(SQLITE3_ASSOC))
      {

        echo '<tr>
        <td>' . $row['member_id'] .'</td>
        <td>' . $row['enroll_no'] .'</td>
        <td>' . $row['member_name'] .'</td>
        <td>' . $row['father_name'] .'</td>
        <td>' . $row['gender'] .'</td>
        <td>' . $row['mphone_no'] .'</td>
        <td>' . $row['memail_id'] .'</td>
        <td>' . $row['aadhar_no'] .'</td>
        <td>' . date_create_from_format("Y-m-d",$row["dob"])->format("d-m-Y") .'</td>
        <td>' . $row['blood_group'] .'</td>
        <td>' . $row['address'] .'</td>
      
        </tr></table>';
    
      echo '<img src="data:image/*;base64,'.$row['aadhar_front'].'" height="200" width="300" style="border: 1px solid #ddd;border-radius: 10px;padding: 5px;margin-left:10%;" />' ;
       echo '<img src="data:image/*;base64,'.$row['aadhar_back'] .'"  style="border: 1px solid #ddd;border-radius: 10px;padding: 5px;margin-left:3%;" height="200" width="400"/>';



      }
}
}


?>
</body>
</html>