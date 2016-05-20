<?php




$PhPOutPutLevel=0;

function printData($objectToHandle,$objectName,$message){
	
	
	$nextline="\n";
	$fileName="test.txt";
	$filePath="./";
	$filehandle=fopen($fileName,"w");
	
	fwrite($filehandle,getLevelTab()."this is the information of \$$objectName( the test is for  $message )  \n");
		
	if (gettype($objectToHandle) == "Null") {
		fwrite($filehandle, getLevelTab()."the $objectToHandle is null \n");
	}elseif(gettype($objectToHandle) == "object"){
		outputUnknowType($objectToHandle,$filehandle);
	}elseif (gettype($objectToHandle) == "array") {
		outputArray($objectToHandle,$filehandle);
	}else {
		outputGeneral($objectToHandle,$filehandle);
	}

	closeFile($filehandle,$objectName);
	
}

function outputArray($typecallArray,$filehandle){
	global $PhPOutPutLevel;
	fwrite($filehandle,getLevelTab()."this is one array.length is ".count($typecallArray).". \n");
	$PhPOutPutLevel++;

//	foreach($typecallArray as $key => $value){
	foreach($typecallArray as $key => $value) {
		fwrite($filehandle,getLevelTab()."$key :");
		if(gettype($value) == "object"){
		//	$level++;
			outputUnknowType($value ,$filehandle);
		}elseif (gettype($value) == "array") {
		//		$level++;
			outputArray($value,$filehandle);
		}else {
			outputGeneral($value ,$filehandle);
		}
	}



	$PhPOutPutLevel--;
	fwrite($filehandle,getLevelTab()."the array is end \n");

}


//out put the complex variable such as nest object
function outputUnknowType($unknowObject ,$filehandle){
	global $PhPOutPutLevel;

	fwrite($filehandle,getLevelTab()."the object start\n");
	$PhPOutPutLevel++;
	if(gettype($unknowObject) =="object"){
		//use loop to check every attribute in the class
		foreach($unknowObject as $key => $value) {

				fwrite($filehandle, getLevelTab()." $key :");

				if(gettype($value) == "object"){ //if there exist another object as an atrribute
					outputUnknowType($value,$filehandle);
				}elseif (gettype($value) == "array") { //the atrribute is array.
					outputArray($value,$filehandle);
				}else {                           //the atrribute is a gneral variable
					outputGeneral($value,$filehandle);
				}

		}

	}

	$PhPOutPutLevel--;
	fwrite($filehandle,getLevelTab()."the object end\n");

}

//out put the general variable with string boolean and others.
//will out put the type of the variable;
function outputGeneral($generalVariable ,$filehandle){
	fwrite($filehandle,getLevelTab().$generalVariable."      ======>the type of the value is :".gettype($generalVariable)."\n");
//	echo $generalVariable;
}



//close the file
function closeFile($filehandle,$objectName){
	fwrite($filehandle,"this is end of object \$$objectName \n");
	fclose($filehandle);
}

function getLevelTab(){

	$tab="";
	global $PhPOutPutLevel;
	for ($i=0; $i <$PhPOutPutLevel ; $i++) {

		$tab=$tab."\t";

	}
	return $tab;
}


function writeStringMessage($message ,$filehandle ){
	
	fwrite($filehandle," \n\n $message \n\n");
}




?>