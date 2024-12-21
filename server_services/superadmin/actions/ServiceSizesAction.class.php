<?php


class server_services_ServiceSizesAction extends mfAction{
    
    public function execute(\mfWebRequest $request) {
        $shell= new SystemShell();
        $shell->df();
        $db= new SystemMySql();
        $db->update();
        $db->getSize();
        foreach ($shell->getReturn() as $line)
        {
              $data=preg_split('/\s+/',$line);
              if (strpos($data[5],"/data")===false)
                 continue;
             return array('status'=>'OK','total_size'=>$data[1],'available_size'=>$data[3],'used_size'=>$data[2],'db_size'=>$db->getSize());              
        }
      return array('status'=>'OK');
    }

}
