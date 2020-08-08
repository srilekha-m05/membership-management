<?php
  include 'include/database_connection.php';  
?>

<?php
$name = $mid=$fname =$address =$email=$aadhar=$phone=$dob=$enroll_no="";
$blood="null";
$gender="choose";
$aadhar_back=$aadhar_front="";

if($_SERVER["REQUEST_METHOD"] == "POST")
  {
  	 
  	 if(isset($_POST['insert']))
	 {
	 	
	 	
		$name=$_POST['name'];
		$fname=$_POST['fname'];
		$address=$_POST['address'];
		$blood=$_POST['blood'];
		$email=$_POST['email'];
		$aadhar=$_POST['aadhar_no'];
		$phone=$_POST['phone_no'];
		$gender=$_POST['gender'];
		$dob= $_POST['dob'];
		$enroll_no=$_POST['enroll_no'];
		$date= date("Y-m-d");
		$aadhar_back_img=base64_encode(file_get_contents($_FILES["aback"]["tmp_name"]));
		$aadhar_front_img=base64_encode(file_get_contents($_FILES["afront"]["tmp_name"]));
		$rows = $db->query("SELECT COUNT(*) as count FROM members where aadhar_no='$aadhar'");
		$row = $rows->fetchArray();
		$numRows = $row['count'];
		if($numRows == 0)
		{
			$rows1 = $db->query("SELECT COUNT(*) as count1 FROM members where enroll_no='$enroll_no'");
		$row1 = $rows1->fetchArray();
		$numRows1 = $row1['count1'];
		if($numRows1 == 0)
		{
			$sql= "INSERT INTO members(aadhar_no,member_name,father_name,mphone_no,memail_id,blood_group,gender,dob,address,aadhar_front,aadhar_back,date_joined,enroll_no) VALUES('$aadhar','$name','$fname',$phone,'$email','$blood','$gender','$dob','$address','$aadhar_front_img','$aadhar_back_img','$date','$enroll_no')";
			$ret = $db->exec($sql);
   			if(!$ret) {
   				
      			echo '<script> alert("Record cannot be inserted ")</script>';
      			echo $db->lastErrorMsg();;
   			} 
   			else {
   				
    			$ids = $db->query("SELECT last_insert_rowid() as id");
				$res = $ids->fetchArray();
				$mid = $res['id'];
			    echo '<script> alert("Record Inserted Successfully.\n Member Id is '.$mid.' and Enrollment Number is '.$enroll_no.' ")</script>';
			    $name =$mid= $fname =$address =$email=$aadhar=$phone=$dob=$enroll_no="";
$blood="null";
$gender="choose";
$aadhar_back=$aadhar_front="";
			    
			
   			
  			 }
  			}
  			 else
		{
			echo '<script> alert("Member with Entered Enrollment number already exists")</script>';
		
		}

		}
		else
		{
			echo '<script> alert("Member with Entered Aadhar card number already exists")</script>';
		
		}
		$db->close();
}

	


if(isset($_POST['update']))
	{
		$name=$_POST['name'];
		$fname=$_POST['fname'];
		$address=$_POST['address'];
		$blood=$_POST['blood'];
		$email=$_POST['email'];
		$aadhar=$_POST['aadhar_no'];
		$phone=$_POST['phone_no'];
		 $gender=$_POST['gender'];
		$dob= $_POST['dob'];
		$mid= $_POST['memid'];
		$enroll_no=$_POST['enroll_no'];
		$rows = $db->query("SELECT COUNT(*) as count FROM members where aadhar_no='$aadhar' AND member_id!='$mid'");
		$row = $rows->fetchArray();
		$numRows = $row['count'];
		if($numRows == 0)
		{
			$rows1 = $db->query("SELECT COUNT(*) as count1 FROM members where enroll_no='$enroll_no' AND member_id!='$mid'");
			$row1 = $rows1->fetchArray();
			$numRows1 = $row1['count1'];
			if($numRows1 == 0 )
			{
				 $sql="UPDATE members SET member_name='$name',father_name='$fname',address='$address',blood_group='$blood',aadhar_no='$aadhar',memail_id='$email',mphone_no=$phone,gender='$gender',dob='$dob',enroll_no='$enroll_no' where member_id='$mid'";
	
		 		$ret = $db->exec($sql);
   				if(!$ret) {
     				 echo '<script> alert("Record Cannot be Updated")</script>';
  				 }
  				  else {
 					 echo '<script> alert("Record Updated Successfully")</script>';
    				  $name = $fname =$address =$email=$aadhar=$phone=$dob=$enroll_no=$mid="";
					$blood="null";
					$gender="choose";
					$aadhar_back=$aadhar_front="";
 				  }
			}
		else
		{
			echo '<script> alert("Entered Enrollment number is already given to another person.please check ")</script>';
		
		}

}
	
		else
		{
			echo '<script> alert("Aadhar number you entered is already owned by another person.please check ")</script>';
		
		}

}


	if(isset($_POST['delete']))
	{
	
		$name=$_POST['name'];
		$fname=$_POST['fname'];
		$address=$_POST['address'];
		$blood=$_POST['blood'];
		$email=$_POST['email'];
		$aadhar=$_POST['aadhar_no'];
		$phone=$_POST['phone_no'];
		 $gender=$_POST['gender'];
		$dob= $_POST['dob'];
		$mid= $_POST['memid'];
		$enroll_no=$_POST['enroll_no'];	
		$rows = $db->query("SELECT COUNT(*) as count FROM members where member_id='$mid'");
		$row = $rows->fetchArray();
		$numRows = $row['count'];
		if($numRows == 1)
		{
		$sql="DELETE FROM members where member_id='$mid'";
		$ret = $db->exec($sql);
   if(!$ret){
     echo '<script>alert("Record cannot be Deleted")</script>';
   } else {
      echo '<script>alert("Deleted Successfully")</script>';
      $name = $mid=$fname =$address =$email=$aadhar=$phone=$dob=$enroll_no="";
$blood="null";
$gender="choose";
$aadhar_back=$aadhar_front="";
			}
		
		}
		else
		{
			echo '<script> alert("Member with this Enrollment number does not exists")</script>';
		}
}
}
		
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
	input
	{
		width: 70%;
	}
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
<body >
<nav class="navbar navbar-dark bg-primary navbar-expand-sm justify-content-between">
  <a class="navbar-brand" href="#" style="font-family:Lucida Console;font-weight: bold;">YOUTH FOR SERVE</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
   
  <form class="form-inline my-1" method="POST" action="index.php">
  	<div class="collapse navbar-collapse " id="navbarNav">
    <ul class="navbar-nav">
    	<li class="nav-item">
    		<button class="btn ml-auto" onclick="window.print()" style="border-radius: 20px;background-color: white;color:blue;">Print</button>
    	</li>
      <li class="nav-item">

        <a class="nav-link " style="color: white" href="list.php"><b> Entries </b></a>
      </li>

      <li>
      	<a class="nav-link " style="color: white" href="members.php"><b> Members </b></a>
      </li>
      <li class="nav-item">

        <a class="nav-link " style="color: white" href="aadhar_card.php"><b> Details </b></a>
      </li>

  </ul>
</div>
    <div class="md-form form-sm my-0">
    	
      <input class="form-control form-control-sm mr-sm-2 mb-0" type="text" placeholder="Enter Search value" name="val"
       id="val" aria-label="Search">

    </div>
    <button type="submit" class="btn btn-sm my-0" name="search" id="search" style="border:1px solid white;color:white;">Search</button>

  </form>

</nav>
<section>
<div class="container printer-discard" style="margin-top: 5%;">
	<form  action="index.php" onsubmit="return validateform()"  method="post" enctype="multipart/form-data" >
	<div class="row main-form">
	<div class=" col-md-12" style="">
		





			<div class="row form-row">
				<div class="col-md-2"> Enrollment No</div>
				<div class="col-md-4" ><input type="text" name="enroll_no" id="enroll_no" placeholder="Enter Enroll number" value="<?php echo($enroll_no); ?>" required>
					<span id="en" style="color: red;"></span>
				</div>

				<div class="col-md-2">Address</div>
				<div class="col-md-4 input-format">
					<input type="text" name="address" id="address" placeholder="Enter Address" value="<?php echo($address); ?>" required>
				</div>
			</div>




			<!-- row1-->
			<div class="row form-row">
				<div class="col-md-2"> Name</div>
				<div class="col-md-4" ><input type="text" name="name" id="name" placeholder="Enter name" value="<?php echo($name); ?>"required>
					<span id="na"></span>
				</div>

				<div class="col-md-2">Phone Number</div>
				<div class="col-md-4 input-format"><input type="text" name="phone_no" id="phone_no" placeholder="Enter Phone number" value="<?php echo($phone); ?>" required><span id="ph"  style="color: red;"></span></div>
			</div>



			<!-- row 2-->
			<div class="row form-row">
				<div class="col-md-2">Father's Name</div>
				<div class="col-md-4 input-format"><input type="text" name="fname" id="fname" placeholder="Enter Father name" value="<?php echo($fname); ?>" required>
				</div>

				<div class="col-md-2">Email Id</div>
				<div class="col-md-4 input-format"><input type="text" name="email" id="email" placeholder="Enter Email Id" value="<?php echo($email); ?>" ></div>
			</div>



			<!-- row 3-->
			<div class="row form-row">
				<div class="col-md-2">Blood Group</div>
				<div class="col-md-4 input-format"><select name="blood" id="blood">
					<option name="blood" value="null" <?php if($blood== "null") echo "selected"; ?>>Choose Group</option>
					<option name="blood" value="A+"  <?php if($blood== "A+") echo "selected"; ?>>A+</option>
					<option name="blood" value="A-"  <?php if($blood== "A-") echo "selected"; ?>>A-</option>
					<option name="blood" value="B+"<?php if($blood== "B+") echo "selected"; ?>>B+</option>
					<option name="blood" value="B-"<?php if($blood== "B-") echo "selected"; ?>>B-</option>
					<option name="blood" value="O+" <?php if($blood== "O+") echo "selected"; ?>>O+</option>
					<option name="blood" value="O-" <?php if($blood== "O-") echo "selected"; ?>>O-</option>
					<option name="blood" value="AB+" <?php if($blood== "AB+") echo "selected"; ?>>AB+</option>
					<option name="blood" value="AB-" <?php if($blood== "AB-") echo "selected"; ?>>AB-</option>
				</select>
				</div>

				<div class="col-md-2">Aadhar Number</div>
				<div class="col-md-4 input-forma"><input type="text" name="aadhar_no" id="aadhar_no" placeholder="Enter Aadhar number" value="<?php echo($aadhar); ?>"
					required><span id="ad" style="color: red;"></span></div>
			</div>


			<!-- row 4-->
			<div class="row form-row">
				<div class="col-md-2">Gender</div>
				<div class="col-md-4 input-format">
					<select name="gender" id="gender" required>
						<option name="gender" id="gender"  value="choose" <?php if($gender== "choose") echo "selected"; ?>>Choose Gender</option>
						<option name="gender" id="gender"  value="male" <?php if($gender== "male") echo "selected"; ?>>Male</option>
						<option name="gender" id="gender"  value="female" <?php if($gender== "female") echo "selected"; ?>>Female</option>
						<option name="gender" id="gender"  value="transgender" <?php if($gender== "transgender") echo "selected"; ?>>Transgender</option>
					</select><span id="g"  style="color: red;"></span>
				</div>

				<div class="col-md-2">Passport Photo</div>
				<div class="col-md-4"><input type="file" name="afront" id="afront" accept="image/*" onchange="document.getElementById('photo1').src = window.URL.createObjectURL(this.files[0])"  alt="Aadhar Card Back" value="<?php echo($aadhar_front); ?>">
					<span id="af" style="color: red;"></div>


						
			</div>


			<!-- row 5-->
			<div class="row form-row">
				<div class="col-md-2">Date of birth</div>
				<div class="col-md-4 input-format"><input type="date" name="dob" id="dob" placeholder="Enter Date of Birth" value="<?php echo($dob); ?>" required>
				</div>
				<div class="col-md-2">Aadhar Card Image</div>
				<div class="col-md-4"><input type="file" name="aback" id="aback" accept="image/*" onchange="document.getElementById('photo2').src = window.URL.createObjectURL(this.files[0])"  alt="Aadhar Card Back" value="<?php echo($aadhar_back); ?>">
					<span id="ab" style="color: red;"></div>


			</div>


			<!-- row 6-->
			<div class="row form-row">
				<div class="col-md-2"></div>
				<div class="col-md-2">
				<input type="submit" class="btn btn-primary" name="insert" onclick="clicked='insert'" value="insert" id="insert" style="align-self: center;width: 150px; border-radius: 20px;" ></div><div class="col-md-1"></div>
				<div class="col-md-2">
					<input type="submit" class="btn btn-primary" name="update" value="update" id="update" style="align-self: center;width: 150px; border-radius: 20px;">
				</div><div class="col-md-1"></div>
				<div class="col-md-2">
				<input type="submit" class="btn btn-primary" name="delete" value="delete" id="delete" style="align-self: center; width: 150px; border-radius: 20px;">
			</div>
				<div class="col-md-2"></div>
			</div>


			<!-- row 7-->
			<div class="container ">
				<div class="row">
					
					<div class="col-md-1">
						<input type="hidden" name="memid" id="memid" value="<?php echo $mid;?>">
					</div>
					<div class="col-md-4">
						<img src="" id="photo1" height="200" width="300" style="border: 1px solid #ddd;border-radius: 10px;padding: 5px;">
	
					</div>
					<div class="col-md-1">
						
					</div>
					<div class="col-md-4">
						<img src="" id="photo2" height="200" width="400"  style="border: 1px solid #ddd;border-radius: 10px;padding: 5px;">
					</div>
					<div class="col-md-2">
						
					</div>					
				
			</div>
</div>		
	</div>
	
</div>
</form>

</div>

<br><br>
</section>

<script type="text/javascript">

function validateform()                                    
{               
         
    var ad = document.getElementById("aadhar_no").value;
    var en = document.getElementById("enroll_no").value;  
    var name = document.getElementById("name").value;  
     var ph = document.getElementById("phone_no").value;  
     var g = document.getElementById("gender").value;  
        
             document.getElementById("g").innerHTML="";
             document.getElementById("ph").innerHTML="";
             document.getElementById("ad").innerHTML="";
             document.getElementById("na").innerHTML="";
             document.getElementById("en").innerHTML="";

   	var counter=0;
	if(en.length < 15 || en.length > 15 || isNaN(en))
    {
  
    	document.getElementById("en").innerHTML="Enroll number must be 15 digits";
    	counter=1;
    }
   	
	
    if(g == "choose")
    {
    	document.getElementById("g").innerHTML="please choose a gender"; 
    	counter=1;
    }
    if(ph.length < 10 || ph.length > 10 || isNaN(ph))
    	{
    
    	document.getElementById("ph").innerHTML="Phone number must be 10 digits";
    	counter=1;
    	}
    if(ad.length < 12 || ad.length > 12 || isNaN(ad))
    {
  
    	document.getElementById("ad").innerHTML="Aadhar number must be 12 digits";
    	counter=1;
    }

	
	 if(counter == 1)
   {
	return false;
   }   
    if(clicked == 'insert')
    {
    	clicked="";
    if ($('#afront').get(0).files.length === 0) {
    	document.getElementById("af").innerHTML="No files selected.";
    return false;
	}
	if ($('#afront').get(0).files.length !== 0) {
    	document.getElementById("af").innerHTML="";
	}

	if ($('#aback').get(0).files.length === 0) {
    	document.getElementById("ab").innerHTML="No files selected.";
    return false;
	}
	if ($('#aback').get(0).files.length !== 0) {
    	document.getElementById("ab").innerHTML="";
	}
    }
    


    return true;
  }


</script>

<?php


if(isset($_POST["search"]))
		{
 		$search_val=$_POST["val"];
 		if($search_val == "all")
	 	{
		
			echo '<table class="table table-bordered" id="t1">
			<tr><th>Id</th><th>Enrollment No</th><th>Name</th><th>Father Name</th>
			<th>Gender</th><th>Phone Number</th><th>Email Id</th><th>Aadhar Number</th><th>DOB</th><th>Blood Group</th><th>Address</th></tr>';
			$sql="SELECT * from members";

			$rows = $db->query("SELECT COUNT(*) as count FROM members");
			$row = $rows->fetchArray();
			$numRows = $row['count'];
			
	        echo "<br><br><h4 class=text-center>Number of Search Results found: " .$numRows."</h4><br>";
	     	echo "<h3 class=text-center>Youth For Serve</h3><br>
			<h5 class=text-center>Members List</h5>
	         <br>";
	         $ret = $db->query($sql);
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
			
				</tr>';
			
			}
			echo '</table>';
			

		}

		else
		{
	
 				echo '<table class="table table-bordered" id="t1" >
			<tr><th>Id</th><th>Enrollment No</th><th>Name</th><th>Father Name</th>
			<th>Gender</th><th>Phone Number</th><th>Email Id</th><th>Aadhar Number</th><th>DOB</th><th>Blood Group</th><th>Address</th></tr>';
			$search='/';
			if(strpos($search_val,'/') == true)
			{	
			if(substr_count($search_val, '/')==2)
			{ 
				if(preg_match("~^(0[1-9]|[1-2][0-9]|3[0-1])/(0[1-9]|1[0-2])/[0-9]{4}$~",$search_val))
			   {
					$search_val=date_create_from_format("d/m/Y",$search_val)->format("Y-m-d");

				}
	

				}
		
				

			}
				$sql="SELECT * from members where gender='$search_val' OR blood_group='$search_val' OR memail_id='$search_val' OR mphone_no='$search_val' OR address ='$search_val' OR member_name='$search_val' OR father_name='$search_val' OR aadhar_no='$search_val' OR date_joined='$search_val' OR member_id='$search_val' OR enroll_no='$search_val' OR address LIKE '%$search_val%'";
				
			
		
	
			$ret = $db->query($sql);
			$rows = $db->query("SELECT COUNT(*) as count from members where gender='$search_val' OR blood_group='$search_val' OR memail_id='$search_val' OR mphone_no='$search_val' OR address ='$search_val' OR member_name='$search_val' OR father_name='$search_val' OR aadhar_no='$search_val' OR date_joined='$search_val' OR member_id='$search_val' OR  enroll_no='$search_val' OR address LIKE '%$search_val%'");
			$row = $rows->fetchArray();
			$numRows = $row['count'];
	        echo "<br><br><h4 class=text-center>Number of Search Results found: " .$numRows."</h4><br>";
	        echo "<h3 class=text-center>Youth For Serve</h3><br>
			<h5 class=text-center>Members List</h5>
	         <br>";
			while($row = $ret->fetchArray(SQLITE3_ASSOC))
			{
				echo '<tr>
				<td>' . $row["member_id"] .'</td>
				<td>' . $row['enroll_no'] .'</td>
				<td>' . $row["member_name"] .'</td>
				<td>' . $row["father_name"] .'</td>
				<td>' . $row["gender"] .'</td>
				<td>' . $row["mphone_no"] .'</td>
				<td>' . $row["memail_id"] .'</td>
				<td>' . $row["aadhar_no"] .'</td>

				<td>' . date_create_from_format("Y-m-d",$row["dob"])->format("d-m-Y") .'</td>
				<td>' . $row["blood_group"] .'</td>
				<td>' . $row["address"] .'</td>
				
				</tr>';
			}
			echo '</table>';


 		}
}
		?>

<script>
		var table=document.getElementById('t1'), rIndex;
		var name=document.getElementById('name');
		var ph = document.getElementById("phone_no");
		
	function selectedRow(){
	for (var i = 0; i< table.rows.length; i++) {
		table.rows[i].onclick=function(){
			rIndex=this.rowIndex;
			console.log(rIndex);
			document.getElementById("memid").value =this.cells[0].innerText;
			document.getElementById("enroll_no").value =this.cells[1].innerText;
			
			document.getElementById("name").value = this.cells[2].innerText;
			document.getElementById("fname").value = this.cells[3].innerText;
			document.getElementById("gender").value = this.cells[4].innerText;
			document.getElementById("phone_no").value = this.cells[5].innerText;
			document.getElementById("email").value = this.cells[6].innerText;
			document.getElementById("aadhar_no").value=this.cells[7].innerText;


			 

			var str=this.cells[8].innerText;
			var res = str.split("-");
			var date=[res[1],res[0],res[2]].join('-');
		var today = new Date(date);
var dd= today.getDate();

var mm =''+ (today.getMonth()+1); 
var yyyy = today.getFullYear();
if(dd<10) 
{
    dd='0'+dd;
} 
if(mm<10) 
{
    mm='0'+mm;
} 
today = yyyy+'-'+mm+'-'+dd;
    			
    	document.getElementById("dob").value =today;
    	document.getElementById("blood").value = this.cells[9].innerText;
		document.getElementById("address").value =this.cells[10].innerText;
	
			
			

		};
	}
}
selectedRow();
</script>


</body>
</html>