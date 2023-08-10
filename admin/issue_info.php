<?php
  include "connection.php";
  include "navigation.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Book Request</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<style type="text/css">

		.srch
		{
			padding-left: 850px;

		}
		.form-control
		{
			width: 300px;
			height: 40px;
			background-color: black;
			color: white;
		}
		
		.img {
			background-image: url("images/reqback.jpg");
			background-repeat: no-repeat;
            height: 125%;
			background-size: 100% 100%;
			margin-top: -20px;
    }
.container
{
	height: 600px;
	background-color: black;
	opacity: .8;
	color: white;
}

th,td
{
  width: 10%;
}

	</style>

</head>
<body>
<section>
 <div class="img">
   <br>
   <br>
  <div class="container">
    <h3 style="text-align: center;">INFORMATION OF BORROWED BOOKS</h3><br>
    <?php
    $c=0;

      if(isset($_SESSION['login_user']))
      {
        $sql="SELECT student.username,regno,books.bid,name,authors,edition,issue_book.issue_date,issue_book.return_date FROM student inner join issue_book ON student.username=issue_book.username inner join books ON issue_book.bid=books.bid WHERE issue_book.approve ='Yes' ORDER BY `issue_book`.`return_date` ASC";
        $res=mysqli_query($db,$sql);
        
        
        echo "<table class='table table-bordered' style='width:100%;' >";
        //Table header
        
        echo "<tr style='background-color: #6db6b9e6;'>";
        echo "<th>"; echo "Username";  echo "</th>";
        echo "<th>"; echo "Reg No";  echo "</th>";
        echo "<th>"; echo "BID";  echo "</th>";
        echo "<th>"; echo "Book Name";  echo "</th>";
        echo "<th>"; echo "Authors Name";  echo "</th>";
        echo "<th>"; echo "Edition";  echo "</th>";
        echo "<th>"; echo "Issue Date";  echo "</th>";
        echo "<th>"; echo "Return Date";  echo "</th>";

      echo "</tr>"; 
      echo "</table>";

        echo "<table class='table table-bordered' >";
      while($row=mysqli_fetch_assoc($res))
      {
        $d=date("d-m-y");
        if($d > $row['return_date'])
        {
          $c=$c+1;
          $var='EXPIRED';

          mysqli_query($db,"UPDATE issue_book SET approve='$var' where `return_date`='$row[return_date]' and approve='Yes' limit $c;");
          
           
        }
      }
      $sql="SELECT student.username,regno,books.bid,name,authors,edition,issue_book.issue_date,issue_book.return_date FROM student inner join issue_book ON student.username=issue_book.username inner join books ON issue_book.bid=books.bid ORDER BY `issue_book`.`return_date` ASC";
      $res=mysqli_query($db,$sql);
      while($row=mysqli_fetch_assoc($res))
      {
        echo "<tr>";
          echo "<td>"; echo $row['username']; echo "</td>";
          echo "<td>"; echo $row['regno']; echo "</td>";
          echo "<td>"; echo $row['bid']; echo "</td>";
          echo "<td>"; echo $row['name']; echo "</td>";
          echo "<td>"; echo $row['authors']; echo "</td>";
          echo "<td>"; echo $row['edition']; echo "</td>";
          echo "<td>"; echo $row['issue_date']; echo "</td>";
          echo "<td>"; echo $row['return_date']; echo "</td>";
        echo "</tr>";
      }
      
    echo "</table>";
       
      }
      else
      {
        ?>
          <h3 style="text-align: center;">Login to see information of Borrowed Books</h3>
        <?php
      }
    ?>
  </div>
</div>
</body>
</html>