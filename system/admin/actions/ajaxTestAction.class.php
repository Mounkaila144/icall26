<?php

// www.ecosol28.net/admin/module/system/admin/Test

class system_ajaxTestAction extends mfAction {
    
        
    
    function execute(mfWebRequest $request)
    {
        $messages = mfMessages::getInstance();                      
                 
       
        $dump=new SystemMySqlDump(new SystemMySqlServer('localhost','root','ewebmarket#1'),"site_iso6b","t_users");
       // var_dump($dump->getVersion());             
        $dump->setOutput(__DIR__."/test.sql");
        $dump->execute("-u{user} -p{password} --no-create-info {database} {tables} > {output}");
        
         $sql=new SystemMySql(new SystemMySqlServer('localhost','root','ewebmarket#1'),'site_test');
         $sql->import(__DIR__."/test.sql");
        
        die(__METHOD__);
    }
}

