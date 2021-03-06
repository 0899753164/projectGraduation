<?php ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); ?>
?>
<?php
require_once("../Project/database/Db.php");   ///connect database
$objDb = new Db();							//ให้ตัวแปร $objDb เรียกใช้ฟังก์ชั่น Db()
$db = $objDb->database;

$staff_id = $_GET['staff_id'];    //getting id from url

	$sql = 'SELECT * FROM staff WHERE staff_id=:staff_id';    //เรียกข้อมูลที่ต้องการแก้ไขมา 1 แถว
		$stmt = $db->prepare($sql);//เป็น method ในการเตรียมคำสั่งที่จะใช้ประมวลผล และจะส่งค่ากลับ (return) เป็น Object PDOStatement
		$stmt->execute([':staff_id' => $staff_id]); //เป็น method ในการประมวลผลคำสั่ง $stmt ที่ได้ทำการ prepare() แล้ว
		$select = $stmt->fetch(PDO::FETCH_OBJ); //method ในการดึงข้อมูลของแถวในฐานข้อมูล ส่งค่ากลับเป็น anonymous object
?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit data Staff</title>
	<link rel="stylesheet" type="text/css" href="/Project/CSS/form.css"><!--form used-->
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
	<b><h3>แก้ไขข้อมูลพนักงาน</h3></b>
	<form id="myForm" class="" action="./source/edit.php" method="post" target="blank">
		 <div class="form-group row">
			<b><h4 id="fh4">แก้ไขข้อมูลพนักงาน</h4></b>
		</div>
	  <div class="form-group row">
	  	<div class="col-sm-10">
	  		<input type="hidden" class="form-control" id="input" name="staff_id" placeholder="" value="<?php echo $select->staff_id; ?>">
	  	</div>
	  </div>
	  <div class="form-group row">
	    <label for="" class="col-sm-2 col-form-label">ชื่อพนักงาน :</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="input" name="staff_name" placeholder="" value="<?php echo $select->staff_name; ?>" required>
	    </div>
	  </div>

	  <div class="form-group row">
	    <label for="" class="col-sm-2 col-form-label">นามสกุล :</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="input" name="staff_surname" placeholder="" value="<?php echo $select->staff_surname; ?>" required>
	    </div>
	  </div>

	   <div class="form-group row">
	    <label for="" class="col-sm-2 col-form-label">เลขบัตรประชาชน :</label>
	    <div class="col-sm-10">
	      <input type="number" class="form-control" id="input" name="staff_passportid" placeholder="" 
	      value="<?php echo $select->staff_passportid; ?>" required>
	    </div>
	  </div>
	
	 <div class="form-group row">
	    <label for="" class="col-sm-2 col-form-label">ที่อยู่ :</label>
	    <div class="col-sm-10">
	       <textarea type="text" class="form-control" rows="6" name="staff_add" placeholder="ที่อยู่" value="" required><?php echo $select->staff_add; ?></textarea>
	    </div>
	  </div>
	  
	  <div class="form-group row">
	    <label for="" class="col-sm-2 col-form-label">วันที่เริ่มทำงาน :</label>
	    <div class="col-sm-10">
	      <input type="date" class="form-control" id="input" name="staff_stwd" placeholder="" value="<?php echo $select->staff_stwd; ?>">
	    </div>
	  </div>

	  <div class="form-group row">
	    <label for="" class="col-sm-2 col-form-label">เบอร์โทร :</label>
	    <div class="col-sm-10">
	      <input type="number" class="form-control" id="input" name="staff_phone" placeholder="" value="<?php echo $select->staff_phone; ?>">
	    </div>
	  </div>

	 <div class="form-group col" align="right">
	   <div class="col-sm-3">
	     <div class="btn-group">
	     	<button type="submit" name="staffupdate" value="" class="btn btn-primary btn-md">อัพเดท</button>
	     </input>
	      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	      <button type="button" name="cancle" value="" class="btn btn-secondary btn-md" >ยกเลิก</button>
	  </div>
	    </div>
	</div>
</form>
	<div id="showdata">
  		<? include("../Project/source/edit.php");?>
  	</div>
</script>
</div>
</body>
</html>