<?php
header('Content-Type: application/json');


$mon= $_POST['mon'];
$year= $_POST['year'];
$staff_id= $_POST['staff'];

//
//$mon= "08";
//$year= "2024";
//$staff_id= "1";


include('../functionPDO.php') ;

$where=array(
    array('sid',$staff_id,'STR'),
    array('active','1','STR'),

);

$row_payslip=getrow('pay_slip',$where);


$where=array(
    array('staff_id',$staff_id,'STR'),
    array('mon',$mon,'STR'),
    array('year',$year,'STR')
);


    
$statement='SELECT * FROM salary_payments_manual WHERE staff_id = :staff_id AND mon =:mon AND year = :year';



$rows=do_query($statement,$where);


$manual_pays=0;

foreach($rows as $row)
{
if($row['total_amount'])
$manual_pays=$manual_pays+$row['total_amount'];	
}



$where=array(
    array('sid',$staff_id,'STR'),
    array('salary_mon',$mon,'STR'),
  array('salary_year',$year,'STR')
);

$statement='SELECT * FROM salary_process_details WHERE sid = :sid AND salary_mon = :salary_mon AND salary_year = :salary_year';




$rows_process=do_query($statement,$where);
//print_r($where);
//print_r($rows_process);
 $process_pays=0;
foreach($rows_process as $row_process)
{
$where=array(array('sid',$staff_id,'STR'),array('process_id',$row_process['id'],'INT'));

$statement='SELECT * FROM salary_payments WHERE staff_id = :sid AND process_id =:process_id';

	
$rows_pays=do_query($statement,$where);

foreach($rows_pays as $row_pays)
{
if($row_pays['amount'])
$process_pays=$process_pays+$row_pays['amount'];
	
}   
    
}



$res=array('total_pay'=>$row_payslip['total_pay'],'manual_pays'=>$manual_pays,'process_pays'=>$process_pays);


echo json_encode($res);

//echo json_encode($cnama);




?>

