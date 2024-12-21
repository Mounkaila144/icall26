<?php


class SystemMuTool extends SystemCore
{
    function getErrorCode(){
        return $this->error_code;
    }
    
    function hasError(){
        return $this->has_error;
    }
    
    
    function getVersion()
    {
        
        
    }
    
    function getParams()
    {
        $this->params = array(
            
        );
        return $this->params;
    }
    
    function getResults($fields=array())
    {
        if ($fields)
        {
            $values=new mfArray();
            foreach ($fields as $field)
              $values[$field]=isset($this->results[$field])?$this->results[$field]:null;
            return $values;
        }    
        return $this->results;
    }
    
    protected function getName($extension="xml")
    {
        return $this->getOption("file_src").".".$extension;
    }
    
    protected function getCommand($path,$name,$extension="html",$option1='show',$option2='grep',$option3='"Signature"')
    {
        $exec="mutool";
        if (mfTools::isWindowsServer())
        {
            //mutool show document.pdf grep 'Signature'>out.txt
            $cmd=$_SERVER['DOCUMENT_ROOT'].'/../../../../../../../ProgramData/mupdf/%s %s %s %s %s>%s 2>&1';             
        }
        else
        {
           $cmd="/usr/bin/%s %s %s %s %s>%s";
        }         
        $path=$path?$path:$this->getOption('path');
        mfFileSystem::mkdirs($path);        
        //'-layout',''
        $name=$name?$name.".".$extension:$this->getName($extension);
        echo  sprintf($cmd, $exec, $option1,$this->getOption('path')."/".$this->getName("pdf"),$option2,$option3, $path."/".$name)."<br />";
        return  sprintf($cmd, $exec, $option1,$this->getOption('path')."/".$this->getName("pdf"),$option2,$option3, $path."/".$name);
    }
//    
//    function generateXml($path=null,$name="")
//    {    
//        system($this->getCommand($path,$name,"xml"),$return);          
//        return $this;
//    }
    
    function generateText($path=null,$name="")
    {           
        system($this->getCommand($path,$name,"txt"),$return);     //-layout     
        return $this;
    }
    
    function generateHtml($path=null,$name="")
    {           
        system($this->getCommand($path,$name,"html"),$return);     //-layout     
        return $this;
    }
    
//    function generatePicture($path=null,$name="")
//    {       
//        $this->createHtmlFile();                
//        system($this->getCommand("--quality 80 ",$path,$name,"png"),$return);          
//        return $this;
//    }
//    
//    protected function createHtmlFile()
//    {        
//        $file = new File($this->getOption('path')."/".$this->getName("html"));        
//        $file->putContent($this->getHtml());       
//        return $this;
//    }
   
    function getResult($name,$default=null)
    {        
        return isset($this->results[$name])?$this->results[$name]:$default;
    }
    
    function getErrors()
    {
        return $this->errors;
    }
   
}
