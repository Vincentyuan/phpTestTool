<?php


$level=0;
$nextline="\n";
$fileName="test.txt";
$filePath="./";
if ($filePath == "./") {
	$filehandle=fopen($fileName,"w");
}else {
	$path=$filePath.$fileName;
	$filehandle=fopen($path,"w");
}



function printData($objectToHandle,$objectName,$message){
	
	
	if (gettype($objectToHandle) == "Null") {
		fwrite($filehandle, $getLevelTab()."the $objectToHandle is null \n");
	}elseif(gettype($objectToHandle) == "object"){
		$outputUnknowType($objectToHandle);
	}elseif (gettype($objectToHandle) == "array") {
		$outputArray($objectToHandle);
	}else {
		$outputGeneral($objectToHandle);
	}

	$closeFile();
	
}

function outputArray($typecallArray){
	fwrite($filehandle,$getLevelTab()."this is one array.length is ".count($typecallArray).". \n");
	$level++;

//	foreach($typecallArray as $key => $value){
	foreach($typecallArray as $key => $value) {
		fwrite($filehandle,$getLevelTab()."$key :");
		if(gettype($value) == "object"){
		//	$level++;
			$outputUnknowType($value);
		}elseif (gettype($value) == "array") {
		//		$level++;
			$outputArray($value);
		}else {
			$outputGeneral($value);
		}
	}



	$level--;
	fwrite($filehandle,$getLevelTab()."the array is end \n");

}


//out put the complex variable such as nest object
function outputUnknowType($unknowObject){


	fwrite($filehandle,$getLevelTab()."the object start\n");
	$level++;
	if(gettype($unknowObject) =="object"){
		//use loop to check every attribute in the class
		foreach($unknowObject as $key => $value) {

				fwrite($filehandle, $getLevelTab()." $key :");

				if(gettype($value) == "object"){ //if there exist another object as an atrribute
					$outputUnknowType($value);
				}elseif (gettype($value) == "array") { //the atrribute is array.
					$outputArray($value);
				}else {                           //the atrribute is a gneral variable
					$outputGeneral($value);
				}

		}

	}

	$level--;
	fwrite($filehandle,$getLevelTab()."the object end\n");

}

//out put the general variable with string boolean and others.
//will out put the type of the variable;
function outputGeneral($generalVariable){
	fwrite($filehandle,$getLevelTab().$generalVariable."      ======>the type of the value is :".gettype($generalVariable)."\n");
//	echo $generalVariable;
}



//close the file
function closeFile(){
	fwrite($filehandle,"this is end of object $objectName \n");
	fclose($filehandle);
}

function getLevelTab(){

	$tab="";
	for ($i=0; $i <$level ; $i++) {

		$tab=$tab."\t";

	}
	return $tab;
}


function writeStringMessage($message ){
	
	fwrite($filehandle," \n\n $message \n\n");
}




?>