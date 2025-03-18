<?php
header('Content-Type: application/json');


$title= $_POST['title'];
$amount= $_POST['amount'];
$exp_date= $_POST['exp_date'];
$branch= $_POST['branch'];


include('../functionPDO.php') ;


$date=date_create_from_format("d/m/Y",$exp_date);
$bill_new_date= date_format($date,"Y-m-d");
$y_date= date_format($date,"Y");
$m_date= date_format($date,"m");
$d_date= date_format($date,"d");


$where=array(array('cat','other','STR'),array('name',$title,'STR'),
             array('branch',$branch,'STR'), array('amount',$amount,'STR'),array(exp_date,$bill_new_date,'STR'));	
$mid=insertrow('expense',$where);
	


 $branch_name=getfield('branch','id',$branch,'INT','name');
        
  $title="Payment towards Expense for other expenses: ".$branch_name;
$value=array(array('xid',$mid,'INT'),array('tabl','expense','STR'),
             array('title',$title,'STR'),
             array('branch',$branch,'STR'),
             array('debit',$amount,'STR'),array('ledger_date',$bill_new_date,'STR'));
insertrow('company_ledger',$value);


echo json_encode($mid);

//echo json_encode($cnama);




?>

