<?php

class phpOutput{
	
	private $objectName;
	private $filehande;
	private $fileName;
	private $filePath;
	
	private $nextline="\n";
	
	
	//to initial the $filename /$filepass(default current dictionary ) and so on  !!! $filehandle ,
	function __construct(){
		
		
	}
	
	//out put the array by example.
	function arrayOutput(){
		
	}
	
	//out put the complex variable such as nest object 
	function outputUnknowType(){
		
	}
	
	//out put the general variable with string boolean and others.
	//will out put the type of the variable;
	function generalVariableOutput(){}
	
	//out put controller to determine the which method will be called.
	function output(){} 
	
	//close the file
	function closeFile(){}
	
}


?>