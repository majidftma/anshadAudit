<?php
header('Content-Type: application/json');


$from_date= $_POST['from_date'];
$to_date= $_POST['to_date'];
$cat= $_POST['cat'];
$branch= $_POST['branch'];
$title= $_POST['title'];



//$from_date="09/08/2024";
//$to_date="09/08/2024";
//$cat= "";
//$title="";
//$branch="1"

    
//    echo $from_date;
//    echo $to_date;
$date=date_create_from_format("d/m/Y",$from_date);
$fromdate= date_format($date,"Y-m-d");

$date=date_create_from_format("d/m/Y",$to_date);
$todate= date_format($date,"Y-m-d");

include('../functionPDO.php') ;


$where=array(array('fromdate',$fromdate,'STR'),
             array('todate',$todate,'STR')
             
            );

if($cat!="")
{
array_push($where,array('cat',$cat,'STR'));
$st1=" AND cat = :cat";
}
if($cat!="" && $cat!="other")
{
array_push($where,array('name_id',$title,'STR'));
$st2=" AND name_id = :name_id";
}




if($branch!="")
{
array_push($where,array('branch',$branch,'STR'));
$st3=" AND branch = :branch";
}


$statement='SELECT DISTINCT exp_date  FROM expense WHERE exp_date >= :fromdate AND exp_date <= :todate'.$st1.$st2.$st3;
$rowdays=do_query($statement,$where);

if($cat=="")
{
$res=array();
foreach($rowdays as $dayr)
{
$where=array(array('exp_date',$dayr[exp_date],'STR'));
  

if($branch!="")
{
array_push($where,array('branch',$branch,'STR'));
$st4=" AND branch = :branch";
}
    
$statement='SELECT * FROM expense WHERE exp_date = :exp_date'.$st4;
$rows=do_query($statement,$where);

$operating=0;
$salary=0;
$owner=0;
$other=0;
$total=0;
foreach($rows as $row)
{
if($row[cat]=="operating")
$operating=$operating+$row[amount];
if($row[cat]=="salary")
$salary=$salary+$row[amount];
if($row[cat]=="owner")
$owner=$owner+$row[amount];
if($row[cat]=="other")
$other=$other+$row[amount];
}
$total=$operating+$salary+$owner+$other;

$date=date_create_from_format("Y-m-d",$dayr[exp_date]);
$exp_date= date_format($date,"d-M-Y");

array_push($res,array('day'=>$exp_date,'operating'=>$operating,'salary'=>$salary,'owner'=>$owner,'other'=>$other,'total'=>$total));
}
}

else
{
$res=array();
foreach($rowdays as $dayr)
{
$where=array(array('exp_date',$dayr[exp_date],'STR'));
if($cat!="")
{
array_push($where,array('cat',$cat,'STR'));
$st1=" AND cat = :cat";
}
if($cat!="" && $cat!="other")
{
array_push($where,array('name_id',$title,'STR'));
$st2=" AND name_id = :name_id";
}
$rowthis=getrow('expense',$where);

$date=date_create_from_format("Y-m-d",$rowthis[exp_date]);
$exp_date= date_format($date,"d-M-Y");
array_push($res,array('day'=>$exp_date,'total'=>$rowthis[amount]));

}
}

echo json_encode($res);

//echo json_encode($cnama);




?>

