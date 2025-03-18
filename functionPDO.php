<?php
// $user='root';
// $pass='';
// $pdoconnection = new PDO('mysql:localhost', $user, $pass);
// $sth = $pdoconnection->prepare('use ehse');
// $sth->execute();


$user = 'root';  // Default XAMPP user
$pass = '';      // Default XAMPP password (empty)
$database = 'ehse'; // Change to your actual database name

try {
    // Corrected DSN format
    $pdoconnection = new PDO("mysql:host=localhost;dbname=$database;charset=utf8", $user, $pass);
    
    // Set PDO error mode to Exception for better debugging
    $pdoconnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Database connected successfully!";

} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}



function insertrow($table,$value)
{
$pdo=$GLOBALS["pdoconnection"];

foreach ($value as $item)
{
if(!$fields)
$fields=$item[0];
else
$fields=$fields.",".$item[0];
}

foreach ($value as $item)
{
if(!$values)
$values=":".$item[0];
else
$values=$values.",:".$item[0];
}

$sql = "INSERT INTO ".$table." (".$fields.") VALUES (".$values.")";
$doquery = $pdo->prepare($sql);
foreach ($value as $items) {
if($items[2]=='INT')
{
$curitem=filter_var($items[1], FILTER_VALIDATE_INT);
$doquery->bindValue(':'.$items[0], $curitem , PDO::PARAM_INT); 
}

if($items[2]=='STR')
{
$curitem=filter_var($items[1], FILTER_SANITIZE_STRING);
$curitem=strip_tags($curitem);
$doquery->bindValue(':'.$items[0], $curitem , PDO::PARAM_STR); 
}


if($items[2]=='HTML')
{
//$curitem=filter_var($items[1], FILTER_SANITIZE_STRING);
//$curitem=strip_tags($curitem);
$curitem=$items[1];
$doquery->bindValue(':'.$items[0], $curitem , PDO::PARAM_STR); 
}

}

$doquery->execute();
$newId= $pdo->lastInsertId();
return $newId;
};





function allrows($table,$where,$order)
{
if($where=="1")
$wherestat="1";
else
{
foreach ($where as $items) {
if(!$wherestat)
$wherestat=$items[0]." = :".$items[0];
else
$wherestat=$wherestat." AND ".$items[0]." = :".$items[0];
}
}

$pdo=$GLOBALS["pdoconnection"];
$doquery = $pdo->prepare('select * from '.$table.' where '.$wherestat.' ORDER BY '.$order);

if($where!="1")
foreach ($where as $items) {
if($items[2]=='INT')
{
$curitem=filter_var($items[1], FILTER_VALIDATE_INT);
$doquery->bindValue(':'.$items[0], $curitem , PDO::PARAM_INT); 
}

if($items[2]=='STR')
{
$curitem=filter_var($items[1], FILTER_SANITIZE_STRING);
$curitem=strip_tags($curitem);
$doquery->bindValue(':'.$items[0], $curitem , PDO::PARAM_STR); 
}

}

$doquery->execute();
$row = $doquery->fetchAll();
return $row;
};




function rowslimit($table,$where,$order,$asc,$lim)
{
if($where=="1")
$wherestat="1";
else
{
foreach ($where as $items) {
$signwhere=$items[3];
if(!$items[3])
$signwhere="=";	

if(!$wherestat)
$wherestat=$items[0]." ".$signwhere." :".$items[0];
else
$wherestat=$wherestat." AND ".$items[0]." ".$signwhere." :".$items[0];
}
}

$pdo=$GLOBALS["pdoconnection"];
$doquery = $pdo->prepare('select * from '.$table.' where '.$wherestat.' ORDER BY '.$order.' '.$asc.' LIMIT '.$lim);

if($where!="1")
foreach ($where as $items) {
if($items[2]=='INT')
{
$curitem=filter_var($items[1], FILTER_VALIDATE_INT);
$doquery->bindValue(':'.$items[0], $curitem , PDO::PARAM_INT); 
}

if($items[2]=='STR')
{
$curitem=filter_var($items[1], FILTER_SANITIZE_STRING);
$curitem=strip_tags($curitem);
$doquery->bindValue(':'.$items[0], $curitem , PDO::PARAM_STR); 
}

}

$doquery->execute();
$row = $doquery->fetchAll();
return $row;
};



function alldistrows($table,$where,$dist,$order)
{
if($where=="1")
$wherestat="1";
else
{
foreach ($where as $items) {
if(!$wherestat)
$wherestat=$items[0]." = :".$items[0];
else
$wherestat=$wherestat." AND ".$items[0]." = :".$items[0];
}
}

$pdo=$GLOBALS["pdoconnection"];
$doquery = $pdo->prepare('select * from '.$table.' where '.$wherestat.' GROUP BY '.$dist.' ORDER BY '.$order);

if($where!="1")
foreach ($where as $items) {
if($items[2]=='INT')
{
$curitem=filter_var($items[1], FILTER_VALIDATE_INT);
$doquery->bindValue(':'.$items[0], $curitem , PDO::PARAM_INT); 
}

if($items[2]=='STR')
{
$curitem=filter_var($items[1], FILTER_SANITIZE_STRING);
$curitem=strip_tags($curitem);
$doquery->bindValue(':'.$items[0], $curitem , PDO::PARAM_STR); 
}

}

$doquery->execute();
$row = $doquery->fetchAll();
return $row;
};









function allrowswhere($table,$where,$values,$order)
{

$pdo=$GLOBALS["pdoconnection"];
$doquery = $pdo->prepare('select * from '.$table.' where '.$where.' ORDER BY '.$order);

if($values)
{
foreach ($values as $items) {
if($items[2]=='INT')
{
$curitem=filter_var($items[1], FILTER_VALIDATE_INT);
$doquery->bindValue(':'.$items[0], $curitem , PDO::PARAM_INT); 
}

if($items[2]=='STR')
{
$curitem=filter_var($items[1], FILTER_SANITIZE_STRING);
$curitem=strip_tags($curitem);
$doquery->bindValue(':'.$items[0], $curitem , PDO::PARAM_STR); 
}

}
}

$doquery->execute();
$row = $doquery->fetchAll();
return $row;
};







function getrow($table,$where)
{
if($where=="1")
$wherestat="1";
else
{
  
foreach ($where as $items) {
if(!$wherestat)
$wherestat=$items[0]." = :".$items[0];
else
$wherestat=$wherestat." AND ".$items[0]." = :".$items[0];
}
}

$pdo=$GLOBALS["pdoconnection"];
$doquery = $pdo->prepare('select * from '.$table.' where '.$wherestat);

foreach ($where as $items) {
if($items[2]=='INT')
{
$curitem=filter_var($items[1], FILTER_VALIDATE_INT);
$doquery->bindValue(':'.$items[0], $curitem , PDO::PARAM_INT); 
}

if($items[2]=='STR')
{
$curitem=filter_var($items[1], FILTER_SANITIZE_STRING);
$curitem=strip_tags($curitem);
$doquery->bindValue(':'.$items[0], $curitem , PDO::PARAM_STR); 
}

}

$doquery->execute();
$row = $doquery->fetch();
return $row;
};




function getfield($table,$infield,$value,$type,$getfield)
{
$wherestat=$infield." = :".$infield;
$pdo=$GLOBALS["pdoconnection"];
$doquery = $pdo->prepare('select * from '.$table.' where '.$wherestat);
if($type=='INT')
{
$curitem=filter_var($value, FILTER_VALIDATE_INT);
$doquery->bindValue(':'.$infield, $curitem , PDO::PARAM_INT); 
}
if($type=='STR')
{
$curitem=filter_var($value, FILTER_SANITIZE_STRING);
$curitem=strip_tags($curitem);
$doquery->bindValue(':'.$infield, $curitem , PDO::PARAM_STR); 
}


$doquery->execute();
$row = $doquery->fetch();
return $row[$getfield];
};










function rownum($table,$where)
{
if($where=="1")
$wherestat="1";
else
{
foreach ($where as $items) {
if(!$wherestat)
$wherestat=$items[0]." = :".$items[0];
else
$wherestat=$wherestat." AND ".$items[0]." = :".$items[0];
}
}

$pdo=$GLOBALS["pdoconnection"];
$doquery = $pdo->prepare('select * from '.$table.' where '.$wherestat);

foreach ($where as $items) {
if($items[2]=='INT')
{
$curitem=filter_var($items[1], FILTER_VALIDATE_INT);
$doquery->bindValue(':'.$items[0], $curitem , PDO::PARAM_INT); 
}

if($items[2]=='STR')
{
$curitem=filter_var($items[1], FILTER_SANITIZE_STRING);
$curitem=strip_tags($curitem);
$doquery->bindValue(':'.$items[0], $curitem , PDO::PARAM_STR); 
}

}

$doquery->execute();
$total = $doquery->rowCount();
return $total;
};




function do_query($statement,$where)
{

$pdo=$GLOBALS["pdoconnection"];
$doquery = $pdo->prepare($statement);


foreach ($where as $items) {
	if($items[2]=='INT')
	{
	$curitem=filter_var($items[1], FILTER_VALIDATE_INT);
	$doquery->bindValue(':'.$items[0], $curitem , PDO::PARAM_INT); 
	}
	if($items[2]=='STR')
	{
	$curitem=filter_var($items[1], FILTER_SANITIZE_STRING);
	$curitem=strip_tags($curitem);
	$doquery->bindValue(':'.$items[0], $curitem , PDO::PARAM_STR); 
	}

}

$doquery->execute();
$row = $doquery->fetchAll();
return $row;
};





function updaterow($table,$value,$where)
{
$pdo=$GLOBALS["pdoconnection"];

foreach ($value as $items) {
if(!$wherestat)
$wherestat=$items[0]." = :".$items[0];
else
$wherestat=$wherestat.", ".$items[0]." = :".$items[0];
}

foreach ($where as $items) {
if(!$wheresmt)
$wheresmt=$items[0]." = :".$items[0];
else
$wheresmt=$wheresmt." AND ".$items[0]." = :".$items[0];
}


$sql = "UPDATE ".$table." SET ".$wherestat." WHERE ".$wheresmt;
$doquery = $pdo->prepare($sql);
foreach ($value as $items) {
if($items[2]=='INT')
{
$curitem=filter_var($items[1], FILTER_VALIDATE_INT);
$doquery->bindValue(':'.$items[0], $curitem , PDO::PARAM_INT); 
}

if($items[2]=='STR')
{
$curitem=filter_var($items[1], FILTER_SANITIZE_STRING);
$curitem=strip_tags($curitem);
$doquery->bindValue(':'.$items[0], $curitem , PDO::PARAM_STR); 
}


if($items[2]=='HTML')
{
$curitem=$items[1];
$doquery->bindValue(':'.$items[0], $curitem , PDO::PARAM_STR); 
}



}


foreach ($where as $items) {
if($items[2]=='INT')
{
$curitem=filter_var($items[1], FILTER_VALIDATE_INT);
$doquery->bindValue(':'.$items[0], $curitem , PDO::PARAM_INT); 
}

if($items[2]=='STR')
{
	
$curitem=filter_var($items[1], FILTER_SANITIZE_STRING);
$curitem=strip_tags($curitem);
$doquery->bindValue(':'.$items[0], $curitem , PDO::PARAM_STR); 
}





}

$doquery->execute();
};










function deleterow($table,$where)
{
$pdo=$GLOBALS["pdoconnection"];

foreach ($where as $items) {
if(!$wheresmt)
$wheresmt=$items[0]." = :".$items[0];
else
$wheresmt=$wheresmt." AND ".$items[0]." = :".$items[0];
}


$sql = "DELETE FROM ".$table." WHERE ".$wheresmt;
$doquery = $pdo->prepare($sql);

foreach ($where as $items) {
if($items[2]=='INT')
{
$curitem=filter_var($items[1], FILTER_VALIDATE_INT);
$doquery->bindValue(':'.$items[0], $curitem , PDO::PARAM_INT); 
}

if($items[2]=='STR')
{
$curitem=filter_var($items[1], FILTER_SANITIZE_STRING);
$curitem=strip_tags($curitem);
$doquery->bindValue(':'.$items[0], $curitem , PDO::PARAM_STR); 
}

}

$doquery->execute();
};




function  sentmail($to,$subject,$message)
{



$message=$message."
---------------------------------------------------------------------

This is a web generated mail.Do not reply to this mail.
For any technical assistance, mail to staffportal@tkmce.ac.in
";


$headers = 'From: Staff Portal <staffportal@tkmce.ac.in>' . "\r\n" ;
$headers .='Reply-To: staffportal@tkmce.ac.in' . "\r\n" ;
$headers .='X-Mailer: PHP/' . phpversion();
 


$randomVal = md5(time());
  $mimeBoundary = "==Multipart_Boundary_x{$randomVal}x";
 
  /* Header for File Attachment */
  $headers .= "\nMIME-Version: 1.0\n";
  $headers .= "Content-Type: multipart/mixed;\n" ;
  $headers .= " boundary=\"{$mimeBoundary}\"";
 
  /* Multipart Boundary above message */
  $message = "This is a multi-part message in MIME format.\n\n" .
  "--{$mimeBoundary}\n" .
  "Content-Type: text/plain; charset=\"iso-8859-1\"\n" .
  "Content-Transfer-Encoding: 7bit\n\n" .
  $message . "\n\n";




$flight=mail($to,$subject,$message,$headers) ;
return $flight;
};
?>