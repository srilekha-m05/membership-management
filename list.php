
<?php

  include 'include/database_connection.php';
 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Youth For Serve</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" >
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" ></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" ></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="./css/style.css" />


</head>
<body >
<nav class="navbar navbar-dark bg-primary indigo justify-content-between navbar-expand-md">
  <a class="navbar-brand" href="#" style="font-family:Lucida Console;font-weight: bold;">YOUTH FOR SERVE</a>
  
  
  <form class="form-inline my-1" method="post" action="list.php">
  <div class="collapse navbar-collapse " id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link " style="margin-right: 40%;color: white" href="index.php"><b> Home </b></a>
      </li>
      <li>
        <a class="nav-link " style="color: white" href="members.php"><b> Members </b></a>
      </li>
      <li class="nav-item">

        <a class="nav-link " style="color: white" href="aadhar_card.php"><b> Details </b></a>
      </li>
  </ul>
</div>
    
  </form>
</nav>
<table class="table table-bordered " style="height: 30%;width: 30%;margin-left: 30%;margin-top: 5%;">
  <tr><th>Date</th><th>No of Entries</th></tr>
  <?php

      $sql="SELECT date_joined,count(*) as c from members GROUP BY date_joined ";
      $ret = $db->query($sql);
      while($row = $ret->fetchArray(SQLITE3_ASSOC))
      {
        echo '<tr>
        <td>' . date_create_from_format("Y-m-d",$row['date_joined'])->format("d/m/Y") .'</td>
        <td>' . $row['c'] .'</td>
        </tr>';
      }
  ?>

</table>

</body>
</html>

