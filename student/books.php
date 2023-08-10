
<?php
include "connection.php";
  include "navigation.php";
  

?>
<!DOCTYPE html>
<html>
<head>
	<title>Books</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
	<style type="text/css">
		.srch
		{
			padding-left: 1000px;

		}
  </style>
</head>
<body>

	<!--___________________search bar________________________-->

	<div class="srch">
		<form class="navbar-form" method="post" name="form1">
			
				<input class="form-control" type="text" name="search" placeholder="search books.." required="">
				<button  type="submit" name="submit" class="btn btn-primary">
					<span class="glyphicon glyphicon-search"></span>
				</button>
		</form>
	</div>
	<!--___________________request book__________________-->
	<div class="srch">
		<form class="navbar-form" method="post" name="form1">
			
				<input class="form-control" type="text" name="bid" placeholder="Enter Book ID" required="">
				<button  type="submit" name="submit1" class="btn btn-primary">Request
				</button>
		</form>
	</div>

<div class="container">
<h2 style="text-align: center;">LIST OF BOOKS</h2>
<?php

	if(isset($_POST['submit']))
	{
		$q=mysqli_query($db,"SELECT * from books where name like '%$_POST[search]%' ");

		if(mysqli_num_rows($q)==0)
		{
			echo "Sorry! No book found. Try searching again.";
		}
		else
		{
	echo "<table class='table table-bordered table-hover' >";
		echo "<tr style='background-color: #24b7bde6;'>";
			//Table header
			echo "<th>"; echo "ID";	echo "</th>";
			echo "<th>"; echo "Book-Name";  echo "</th>";
			echo "<th>"; echo "Authors Name";  echo "</th>";
			echo "<th>"; echo "Edition";  echo "</th>";
			echo "<th>"; echo "Status";  echo "</th>";
			echo "<th>"; echo "Quantity";  echo "</th>";
			echo "<th>"; echo "Department";  echo "</th>";
		echo "</tr>";	

		while($row=mysqli_fetch_assoc($q))
		{
			echo "<tr>";
			echo "<td>"; echo $row['bid']; echo "</td>";
			echo "<td>"; echo $row['name']; echo "</td>";
			echo "<td>"; echo $row['authors']; echo "</td>";
			echo "<td>"; echo $row['edition']; echo "</td>";
			echo "<td>"; echo $row['status']; echo "</td>";
			echo "<td>"; echo $row['quantity']; echo "</td>";
			echo "<td>"; echo $row['department']; echo "</td>";

			echo "</tr>";
		}
	echo "</table>";
		}
	}
		/*if button is not pressed.*/
	else
	{
		$res=mysqli_query($db,"SELECT * FROM `books` ORDER BY `books`.`bid` ASC;");

	echo "<table class='table table-bordered table-hover' >";
		echo "<tr style='background-color: #24b7bde6;'>";
			//Table header
			echo "<th>"; echo "ID";	echo "</th>";
			echo "<th>"; echo "Book-Name";  echo "</th>";
			echo "<th>"; echo "Authors Name";  echo "</th>";
			echo "<th>"; echo "Edition";  echo "</th>";
			echo "<th>"; echo "Status";  echo "</th>";
			echo "<th>"; echo "Quantity";  echo "</th>";
			echo "<th>"; echo "Department";  echo "</th>";
		echo "</tr>";	

		while($row=mysqli_fetch_assoc($res))
		{
			echo "<tr>";
			echo "<td>"; echo $row['bid']; echo "</td>";
			echo "<td>"; echo $row['name']; echo "</td>";
			echo "<td>"; echo $row['authors']; echo "</td>";
			echo "<td>"; echo $row['edition']; echo "</td>";
			echo "<td>"; echo $row['status']; echo "</td>";
			echo "<td>"; echo $row['quantity']; echo "</td>";
			echo "<td>"; echo $row['department']; echo "</td>";

			echo "</tr>";
		}
	echo "</table>";
	}
	if(isset($_POST['submit1']))
		{
			if(isset($_SESSION['login_user']))
			{
				mysqli_query($db,"INSERT INTO issue_book Values('$_SESSION[login_user]', '$_POST[bid]', '', '', '');");
				?>
					<script type="text/javascript">
						window.location="request.php"
					</script>
				<?php
			}
			else
			{
				?>
					<script type="text/javascript">
						alert("You must login to Request a book");
					</script>
				<?php
			}
		}
;	?>
</body>
</html>