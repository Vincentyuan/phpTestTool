<?php

class phpOutput{

	private $objectName;
	private $message;
	private $objectToHandle;
	private $filehande;
	private $fileName;
	private $filePath;

	private $nextline="\n";

	private $level; //control the tab number to show beautiful


	//to initial the $filename /$filepass(default current dictionary ) and so on  !!! $filehandle ,
	function __construct($objectName,$message,$objectToHandle,$fileName="test.txt",$filePath="./"){

		this->objectName=$objectName;
		this->message=$message;
		this->objectToHandle=$objectToHandle;


		this->fileName=$fileName;
		this->filePath=$filePath;

		this->filehandle=fopen(this->filePath+this->fileName,"w");


		outputHead();
		this->level=0;
	}

	function outputHead(){
		fwrite(this->filehande,this->getLevelTab()+"this is the information of this->objectName, the test is for  this->message");
	}

	//out put the array by example.
	function outputArray($typecallArray){
		this->level++;
		fwrite(this->filehande,this->getLevelTab()+"this is one array \n");
		foreach($typecallArray as $key=>$value)
		{
		　//　echo $key."=>".$value;
			fwrite(this->filehande,"$key :");
			if(gettype($value) == "object"){
				this->level++;
				this->outputUnknowType($value);
			}elseif (gettype($value) == "array") {
					this->level++;
				this->outputArray($value);
			}else {
				this->outputGeneral($value);
			}
		}

		this->level--;

	}

	//out put the complex variable such as nest object
	function outputUnknowType($unknowObject){
		this->level++;

		fwrite(this->filehande,this->getLevelTab()+"the object start\n");

		if(gettype($unknowObject) =="object"){
			//use loop to check every attribute in the class
			foreach($unknowObject as $key => $value) {

					fwrite(this->filehande, this->getLevelTab()+ " $key :");

					if(gettype($value) == "object"){ //if there exist another object as an atrribute
						this->outputUnknowType($value);
					}elseif (gettype($value) == "array") { //the atrribute is array.
						this->outputArray($value);
					}else {                           //the atrribute is a gneral variable
						this->outputGeneral($value);
					}

			}

		}

		this->level--;
		fwrite(this->filehande,this->getLevelTab()+"the object end\n");

	}

	//out put the general variable with string boolean and others.
	//will out put the type of the variable;
	function outputGeneral($generalVariable){
		fwrite(this->filehandle,this->getLevelTab()+$generalVariable+"\n");
	}

	//out put controller to determine the which method will be called.
	function output(){

		if (gettype(this->object) == "Null") {
			fwrite(this->filehandle, this->getLevelTab()+ "the this->object is null \n");
		}elseif(gettype(this->object) == "object"){
			this->outputUnknowType(this->object);
		}elseif (gettype(this0>object) == "array") {
			this->outputArray(this->object);
		}else {
			this->outputGeneral(this->object);
		}

	}

	//close the file
	function closeFile(){
		fwrite(this->filehandle,this->getLevelTab()+"this is end of object this->objectName \n");
	}

	function getLevelTab(){
		$tab="";
		for ($i=0; $i <this->level ; $i++) {
			# code...
			$tab+="\t";
		}
		return $tab;
	}

}


?>
