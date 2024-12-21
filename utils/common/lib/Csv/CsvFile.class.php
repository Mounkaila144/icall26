<?php


class CsvFile extends File {
    
 
    
   function getNumberOfLines()
   {
       $this->options="r";
       $this->open();
       $count=0;
       if ($this->handler)
       {                            
           while (fgetcsv($this->handler,0,$this->getOption('separator',';')) !== false) 
                $count++;           
           return $count;
       }    
   }
   
    function getContent($file_name,$delimiter=";",$enclosure=""){
       $content= new mfArray();
       $index=0;
        if (($handle = fopen($file_name, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1045, $delimiter)) !== FALSE) {
                $index++;
                $content[$index]=$data;
            }
            fclose($handle);
        }
        
        return $content;
   }
   
   
   function getDataFromColumn($column=0)
   {
        $list=new mfArray();
        if (($handle = fopen($this->getFile(), "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1045, $this->getOption('delimiter',';'))) !== FALSE) {
                $list[]=$data[$column];
            }
            fclose($handle);
        }
        return $list;
   }
   
    function getDataWithNameValue($file_name,$delimiter=";",$enclosure=""){
       $list=new mfArray();
        if (($handle = fopen($file_name, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1045, $delimiter)) !== FALSE) {
                $list[$data[0]]=$data[1];
            }
            fclose($handle);
        }
        return $list;
   }
   
   function getData()
   {          
       $content= new mfArray();    
       $index=0;     
        if (($handle = fopen($this->getFile(), "r")) !== FALSE) {                   
            while (($data = fgetcsv($handle, 1045, $this->getOption('delimiter',';'))) !== FALSE) {
                $index++;             
                $content[$index]=$data;                
            }
            fclose($handle);
        }   
        else
        {   
         
        }    
        return $content;   
   }
}

