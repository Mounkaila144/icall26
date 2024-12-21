<?php
 

class server_services_ServiceStateAction extends mfAction{
    
    public function execute(\mfWebRequest $request) {
       
        $used="";
        $available="";
        $total="";
        $db= new SystemMySql();
        $db->update();
        $db->getSize();
        $shell= new SystemShell();
        $shell->df();
 

    foreach ($shell->getReturn() as $line)
    {

          $data=preg_split('/\s+/',$line);
          if (strpos($data[5],"/data")===false)
             continue;
          $total=$line[1];
          $used=$data[2];
          $available=$line[3];
          
    }
     
               
        
      return array('status'=>'OK','used_size'=>$used,'available_size'=>$available,'db_size'=>$db->getSize());
    }

}
