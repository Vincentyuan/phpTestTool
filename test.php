<?php

require("output.php");

//$data=new phpOutput("sfdas","testitself","hehe");
$data="this is a string ";
$data =array("key" =>"name");
$handle = new phpOutput($data,"data","test for data");


$handle->output();

 ?>
