<?php
header('Content-Type: application/json');


$mon= $_POST['mon'];
$year= $_POST['year'];
$dopage= $_POST['dopage'];
$branch= $_POST['branch'];


//
//$mon= "8";
//$year="2024";
//$branch="1";
//$dopage= "";

include('../functionPDO.php') ;
$tdy="01/".$mon."/".$year;
$date=date_create_from_format("d/m/Y",$tdy);
$ledger_date= date_format($date,"Y-m-d");


$where=array(array('ledger_date',$ledger_date,'STR'));

$st_branch="";
if ($branch != "0") {
    $branchCondition = array('branch',$branch,'STR');
    array_push($where, $branchCondition);
    
    $st_branch= ' AND branch = :branch';
}


    
$statement='SELECT * FROM company_ledger WHERE ledger_date < :ledger_date'.$st_branch;

//echo $statement;
//print_r($where);

$rows=do_query($statement,$where);

//print_r($rows);
$open_bal=0;

foreach($rows as $row)
{
if($row[debit])
$open_bal=$open_bal-$row[debit];
else if($row[credit])
$open_bal=$open_bal+$row[credit];	
}

$res=array();
$where=array(array('year',$year,'STR'),array('mon',$mon,'STR'));


$st_branch="";
if ($branch != "0") {
    $branchCondition = array('branch',$branch,'STR');
    array_push($where, $branchCondition);
    
    $st_branch= ' AND branch = :branch';
}




//$statement='SELECT DISTINCT day FROM company_ledger WHERE year = :year AND mon = :mon ORDER BY day';

$statement='SELECT DISTINCT EXTRACT(DAY FROM ledger_date) AS day
FROM company_ledger
WHERE EXTRACT(YEAR FROM ledger_date) = :year
  AND EXTRACT(MONTH FROM ledger_date) = :mon'.$st_branch.' ORDER BY day;
';

$rowdays=do_query($statement,$where);
//print_r($rowdays);
//echo $statement;
//print_r($where);

$i=0;
foreach($rowdays as $dayr)
{
$tdy=$dayr[day]."/".$mon."/".$year;
$date=date_create_from_format("d/m/Y",$tdy);
$ledger_date= date_format($date,"Y-m-d");

$where=array(array('ledger_date',$ledger_date,'STR'));
$statement='SELECT * FROM company_ledger WHERE ledger_date = :ledger_date';
$rows=do_query($statement,$where);

$sale=0;
$sale_p=0;
$purchase=0;
$purchase_p=0;
//$rsale=0;
//$rpurchase=0;
$invest=0;
$expense=0;
$salary=0;
    
    
foreach($rows as $row)
{
if($row[tabl]=="invest")
$invest=$invest+$row[credit];
if($row[tabl]=="daily_sale")
$sale=$sale+$row[credit];
if($row[tabl]=="daily_purchase")
$purchase=$purchase+$row[debit];
//if($row[tabl]=="return_sale_payment")
//$rsale=$rsale+$row[debit];
//if($row[tabl]=="return_purchase_payment")
//$rpurchase=$rpurchase+$row[credit];
if($row[tabl]=="expense")
$expense=$expense+$row[debit];
    
if($row[tabl]=="salary_payments")
$salary=$salary+$row[debit];
    
if($row[tabl]=="payment_purchase")
$purchase_p=$purchase_p+$row[debit];
    
    
if($row[tabl]=="payment_sale")
$sale_p=$sale_p+$row[credit];
}
	
//$close_bal=$open_bal+$invest+$sale-$purchase-$rsale+$rpurchase-$expense;
$close_bal=$open_bal+$invest+$sale-$purchase-$rsale+$rpurchase-$expense-$salary-$purchase_p+$sale_p;

array_push($res,array('day'=>$dayr[day],'open_bal'=>$open_bal,'sale'=>$sale,'purchase'=>$purchase,
                      
                      'sale_p'=>$sale_p,'purchase_p'=>$purchase_p,'salary'=>$salary,
                      'expense'=>$expense,'invest'=>$invest,'close_bal'=>$close_bal));

$open_bal=$close_bal;
}

echo json_encode($res);

//echo json_encode($cnama);




?>

