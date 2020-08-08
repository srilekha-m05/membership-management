<?php

  include 'include/database_connection.php';
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" >
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" ></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" ></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="./css/style.css" />
	<link rel="stylesheet" type="text/css" href="./css/print.css" media="print">
<style type="text/css">
	@media screen
	{
		h3{
		display: none;
	}
	h5{
		display: none;
	}
	}
</style>
</head>
<body>
<nav class="navbar navbar-dark bg-primary indigo justify-content-between navbar-expand-md">
  <a class="navbar-brand" href="#" style="font-family:Lucida Console;font-weight: bold;">YOUTH FOR SERVE</a>
  <form class="form-inline my-1" method="post" action="">
  <div class="collapse navbar-collapse " id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link " style="margin-right: 40%;color: white" href="index.php"><b> Home </b></a>
      </li>
      <li class="nav-item">

        <a class="nav-link " style="color: white" href="list.php"><b> Entries </b></a>
      </li>
      <li class="nav-item">

        <a class="nav-link " style="color: white" href="aadhar_card.php"><b> Details </b></a>
      </li>
      <li class="nav-item">

        <button class="btn" onclick="window.print();" style="border:1px solid white;color:white;">Print</button>
      </li>


  </ul>
</div>
    
  </form>
</nav>

<?php

echo '<table class="table table-bordered" >
			<tr><th>Id</th><th>Enrollment No</th><th>Name</th><th>Father Name</th>
			<th>Gender</th><th>Phone Number</th><th>Email Id</th><th>Aadhar Number</th><th>DOB</th><th>Blood Group</th><th>Address</th></tr>';

			$sql="SELECT * from members";
			$ret = $db->query($sql);
			$rows = $db->query("SELECT COUNT(*) as count FROM members");
			$row = $rows->fetchArray();
			$numRows = $row['count'];
			
	        echo "<br><br><h4 class=text-center>Total Number of Members Joined: " .$numRows."</h4><br>";
	         echo "<h3 class=text-center>Youth For Serve</h3><br>
			<h5 class=text-center>Members List</h5>
	         <br>";
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
				<td>' . date_create_from_format("Y-m-d",$row['dob'])->format("d-m-Y") .'</td>
				<td>' . $row['blood_group'] .'</td>
				<td>' . $row['address'] .'</td>
				
				</tr>';
			}
			echo '</table>';

		
?>
</body>
</html>