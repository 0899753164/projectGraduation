<?php
require_once("../Project/database/Db.php");   ///connect database
$objDb = new Db();
$db = $objDb->database;
?>

<!DOCTYPE html>
<html>
<head>
	<title>Product Form</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  	<link rel="stylesheet" type="text/css" href="/Project/bootstrap-4.1.3/bootstrap-4.1.3/dist/css/bootstrap.min.css">
  	<link rel="stylesheet" type="text/css" href="/Project/CSS/Form_login.css">
 	<script type="text/javascript" src="/Project/bootstrap-4.1.3/bootstrap-4.1.3/dist/js/bootstrap.min.js"></script>
  	<script type="text/javascript" src="/Project/jquery/jquery-3.3.1.min.js"></script>
  	<script type="text/javascript" src="/Project/jquery/jquery.form.js"></script>
<style>
form {
	background-color: #FFFFFF;
	padding-top: 20px;
	padding-right: 20px;
	padding-bottom: 20px;
	padding-left: 40px;
	border-radius: 20px;
	margin-top: 50px;
	text-decoration: none;
	overflow: hidden;
}
button {
	background-color: #21BAA1;
	float: right;
	width: 80px
}
#fh4 {
	padding-bottom: 50px;
	color: #21BAA1;
}
h3 {
	color: #2C394F;
}
#input {
	border-radius: 100px;
	background-color: #F2F2F2;
}
</style>

<script type="text/javascript">   //no refresh page when submit
  $(document).ready(function() {
    $('#myForm').ajaxForm({
      target: '#showdata',
      success: function() {
        $('#showdata').fadeIn('slow');
      }
    });
  });
  </script>

</head>
<body>
<!--Content!-->
<div class="main">
	<b><h3>ข้อมูลสินค้า</h3></b>
	<form id="myForm" class="" name="blog post" action="../Project/database/insert.php" method="post" target="blank">
		 <div class="form-group row">
			<b><h4 id="fh4">เพิ่มข้อมูลสินต้า</h4></b>
		</div>
	  <div class="form-group row">
	  	<label for="" class="col-sm-2 col-form-label">รหัสสินค้า :</label>
	  	<div class="col-sm-10">
	  		<input type="text" class="form-control" id="input" name="product_id" placeholder="รหัสลูกค้า">
	  	</div>
	  </div>

	  <div class="form-group row">
	    <label for="" class="col-sm-2 col-form-label">ชื่อสินค้า :</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="input" name="product_name" placeholder="ชื่อสินค้า" required>
	    </div>
	  </div>

	  <div class="form-group row">
	    <label for="" class="col-sm-2 col-form-label">ราคา :</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="input" name="product_pricepd" placeholder="ราคา" required>
	    </div>
	  </div>
	
	  <div class="form-group row">
	    <label for="" class="col-sm-2 col-form-label">จำนวน :</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="input" name="product_amountpd" placeholder="จำนวน" required>
	    </div>
	  </div>
	  
	  <div class="form-group row">
	    <label for="" class="col-sm-2 col-form-label">สถานะ :</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="input" name="product_status" placeholder="สถานะ">
	    </div>
	  </div>

	 <div class="form-group col" align="right">
	   <div class="col-sm-3">
	     <div class="btn-group"><a href="index.php?page=button"><button type="submit" name="submitproduct" value="" class="btn btn-primary btn-md">บันทึก</button></a>
	      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	      <a href="index.php?page=product"><button type="button" name="cancle" value="" class="btn btn-secondary btn-md" >ยกเลิก</button></a>
	  </div>
	    </div>
	</div>
</form>
<div id="showdata">
    <?include("../Project/database/insert.php");?>
  </div>
</div>

</body>
</html>
