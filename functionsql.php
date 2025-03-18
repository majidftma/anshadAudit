<?php

$host = "localhost";
$username = "id835862_main_data";
$password = "9744144505";
$database = "id835862_main_data";

mysql_connect($host,$username,$password);

mysql_select_db($database);



function allrows($table,$where,$order)
{
$queryc = ("SELECT * FROM $table WHERE $where ORDER BY  $order");
$resultc = mysql_query($queryc);
return $resultc;
};


function rownum($table,$where)
{
$queryc = ("SELECT * FROM $table WHERE $where ");
$resultc = mysql_query($queryc);
$resultc=mysql_num_rows($resultc);
return $resultc;
};


function getrow($table,$where)
{
$queryc = ("SELECT * FROM $table WHERE $where ");
$rows= mysql_query($queryc);
$row= mysql_fetch_array($rows);
return $row;
};


function alldistrows ($table,$where,$dist,$order)
{
$queryc = ("SELECT * from $table WHERE $where GROUP BY $dist  ");
$resultc = mysql_query($queryc);
return $resultc;
};


function getfield($table,$field1,$value,$field2)
{
$where="$field1='$value'";

$queryc = ("SELECT * FROM $table WHERE $where ");
$rows= mysql_query($queryc);
$row= mysql_fetch_array($rows);
$rowf=$row[$field2];
return $rowf;
};


function insertrow($table,$field,$value)
{
$sql=mysql_query("INSERT INTO $table ($field) values ($value)");

return $sql;
};


function updaterow($table,$fields,$where)
{


$sql=mysql_query("UPDATE $table SET $fields WHERE $where");


return $sql;
};