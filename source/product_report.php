<?php
ob_start();
require_once("../Project/database/Db.php");   //rquire connect Db file//
$objDb = new Db();
$db = $objDb->database;

require_once("../Project/mpdf_mpdf_7.1.5.0_require/vendor/autoload.php");	//require mPDF file//

	$sql = "SELECT product.*, producttype.producttype_name, manufacture.manufac_date, inventory.invent_amount 
FROM product 
INNER JOIN producttype ON product.producttype_fid = producttype.producttype_id 
INNER JOIN manufacture ON product.manufac_fid = manufacture.manufac_id 
INNER JOIN inventory ON product.invent_fid = inventory.invent_id 
ORDER BY product.product_id";
//$sql = "SELECT * FROM product";

$stmt = $db->prepare($sql);

   ///bind variable from customer table  to variable in php
$stmt->bindParam(":product_id", $product_id, PDO::PARAM_INT);
$stmt->bindParam(":product_name", $product_name, PDO::PARAM_STR);
$stmt->bindParam(":product_pricepd", $product_pricepd, PDO::PARAM_STR);
$stmt->bindParam(":product_amountpd", $product_amountpd, PDO::PARAM_STR);
$stmt->bindParam(":product_status", $product_status, PDO::PARAM_STR);

$stmt->execute();  ////execute statatement

$result = $stmt->execute(array(':product_id'=>$product_id, ':product_name'=>$product_name,
         ':product_pricepd'=>$product_pricepd, ':product_amountpd'=>$product_amountpd, ':product_status'=>$product_status));

	$table="";
	$table .= "

	<table align='center' style='width:100%;' >
	      <thead 'border:0' >
	        <tr style='background:grey;' >
	          <th style='width: 8%'>ลำดับ</th>
	          <th style='width: 15%'>วันที่ผลิต</th>
	          <th style='width: 32%'>ชิ่อสินค้า</th>
	          <th style='width: 20%'>ประเภท</th>
	          <th style='width: 10%'>ราคา</th>
	          <th style='width: 10%'>จำนวน</th>
	        </tr>
	    </thead>
	</table>
	";
ob_end_clean();
////////////////////////////////mPDF run class/////////////////////////////////////////
	$mpdf = new \Mpdf\Mpdf([
		'default_font_size' => 16,
		'default_font' => 'sarabun'
	]);

	$mpdf->setAutoTopMargin = 'stretch';			//Set margin = Auto stretch//
	$html = ob_get_contents();
	$mpdf->SetHeader('ระบบจัดการโรงงสนผลิตเซรามิค||{PAGENO}');	//Set header page//
	$mpdf->defaultheaderline=0;											//Set header line//
	$mpdf->defaultheaderfontsize=16;									//Set header font size//
	$mpdf->defaultheaderfontstyle='B';									//Set header font style//
	//END//
	//Set footer//
	$mpdf->defaultfooterfontsize=10;							//Set footer font size//
	$mpdf->defaultfooterfontstyle='BI';							//Set footer font style//
	$mpdf->defaultfooterline=0;									//Set footer line
	//END//
	$mpdf->WriteHTML('<h2 style="text-align: center">ข้อมูลสินค้า</h2></center>');	//write topic//
	$mpdf->WriteHTML("<hr>");														//write horizonetal line//
	$mpdf->WriteHTML($table);														//write table head// by variable//
	$mpdf->shrink_tables_to_fit = 1;												//Set to fit paper//

	$num_row= 0; //New variable use count row//
	while($row = $stmt->fetch(PDO::FETCH_OBJ))
	{
		$num_row++;   //row +1;
								//loop table row//
	    $mpdf->WriteHTML("<table border='0' width='100%' font='16px' style='font-size: 14pt;'>");
		$mpdf->WriteHTML("<tr style='border:1'>
							<td style='width: 8%'>$num_row</td>
							<td style='width: 15%'>$row->manufac_date</td>
							<td style='width: 32%'>$row->product_name</td>
		    				<td style='width: 20%'>$row->producttype_name</td>
		    				<td style='width: 10%'>$row->product_price</td>
		    				<td style='width: 10%'>$row->product_amount</td>
		    			</tr>");
		$mpdf->WriteHTML("</table>");
	}
	//END loop table//
//////////////////////////////footer//////////////////////////////////////
/*::footer details
	-Day-month-year
	-page No.
	-Description
*/
	$mpdf->SetHTMLFooter('
<table width="100%">
    <tr>
        <td width="33%">วันที่ : {DATE j-m-Y}</td>
        <td width="33%" align="center">{PAGENO}/{nbpg}</td>
        <td width="33%" style="text-align: right;">รายงานข้อมูลสินค้า</td>
    </tr>
</table>');
//////////////////////////////END footer///////////////////////////////////////
//following from above...Add page
$mpdf->AddPage();

$arr['L']['content'] = 'Chapter 2';
$mpdf->SetHeader($arr, 'O');
//END//
	$mpdf->Output();
	exit();


?>