<?php

// server1.icall26.com/superadmin/system/admin/test

class system_testAction extends mfAction {
    
   
    function execute(mfWebRequest $request) {              
        $messages = mfMessages::getInstance();             
        //" > ".$this->log_file->getFile()." 2>&1 & echo $!"
      //  $return=SystemTar::getInstance()->tar('-zcf /data/www/html/tmp/test.tar.gz /data/www/html/sites/site_isoxxdev1 > /data/www/html/log/test.log 2>&1 & echo $!');
        
       // var_dump($return,(string)$return->getFirst());
        
        // ps -p 6901 -h
        /*
         *  PID TTY          TIME CMD
            6901 ?        00:14:47 backup-manager-

         */
      //  var_dump(SystemShell::getInstance()->ps("-p ".$pid."-h"));
     /*   $dir=mfConfig::get('mf_root_dir')."/transfers";
        mfFileSystem::mkdirs($dir);
        $return = SystemMySqlDump::getInstance(new SystemMySqlServer('localhost','root','icall26#2'))
                      ->setDatabase('site_gehcpdev')
                      ->setOutput($dir."/database.sql")
                      ->execute("-u{user} -p{password} {database} > {output}",true);
      //  var_dump($return);*/
        // A tester
     //   $return=SystemTar::getInstance()->tar('-zcf /data/www/html/tmp/test.tar.gz /data/www/html/sites/site_isoxxdev1 2>&1 & echo $!');
     //   var_dump($return);
        
        // " 4061 ?        S      0:00 tar -zcf /data/www/html/transfers/1/site.tar.gz /data/www/html/sites/site_gehcpdev"
      
        /* $return=SystemMySql::getInstance(new SystemMySqlServer('localhost','root','icall26#2'),
                                               'site_test99')
                      ->import(mfConfig::get('mf_root_dir')."/transfers/22/database.sql",true);
         var_dump($return);*/
         
        // 2> /dev/null & echo $!  // &1 & echo $!
         $ret=exec("mysql -uroot -picall26#2 --one-database  site_test99 2> /dev/null < /data/www/html/transfers/22/database.sql & echo $!");
        
         $ret=exec("mysql -uroot -picall26#2 --one-database  site_test99 < /data/www/html/transfers/22/database.sql &");
         
          $ret=exec("cat /data/www/html/transfers/22/database.sql | mysql -uroot -picall26#2 site_test99 2> /dev/null & echo $!");
         var_dump($ret);
        die(__METHOD__);
    }
}
