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
			padding-left: 420px;

		}
		.form-control
		{
      padding
      align:"center";
			width: 300px;
			height: 40px;
			/*background-color: black;
			color: white;*/
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
	margin-top: 20px;
}

	</style>

</head>
<body>
<section>
  <div class="img">

<br>
<div class="container">
<br><h3 style="text-align: center;">Approve Request</h3><br><br>
<div class="srch">
    <form class="Approve" action="" method="post">
        <input class="form-control" type="text" name="approve" placeholder="Yes or No" required=""><br>

        <input type="text" name="issue" placeholder="Issue Date dd-mm-yy" required="" class="form-control"><br>

        <input type="text" name="return" placeholder="Return Date dd-mm-yy" required="" class="form-control"><br>
        <button class="btn btn-default" type="submit" name="submit">Approve</button>
    </form>
  
  </div>
</div>
</div>

<?php
  if(isset($_POST['submit']))
  {
    mysqli_query($db,"UPDATE  `issue_book` SET  `approve` =  '$_POST[approve]', `issue_date` =  '$_POST[issue]', `return_date` =  '$_POST[return]' WHERE username='$_SESSION[name]' and bid='$_SESSION[bid]';");

    mysqli_query($db,"UPDATE books SET quantity = quantity-1 where bid='$_SESSION[bid]' ;");

    $res=mysqli_query($db,"SELECT quantity from books where bid='$_SESSION[bid];");

    while($row=mysqli_fetch_assoc($res))
    {
      if($row['quantity']==0)
      {
        mysqli_query($db,"UPDATE books SET status='not-available' where bid='$_SESSION[bid]';");
      }
    }
    ?>
      <script type="text/javascript">
        alert("Updated successfully.");
        window.location="request.php"
      </script>
    <?php
  }
?>
</body>
</html>