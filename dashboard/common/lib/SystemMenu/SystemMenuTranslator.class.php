<?php 

class SystemMenuTranslator extends mfTranslator { 
    

    protected function translateItems($menus) {
        foreach ($menus as $name=>$menu)    
        {   
            $this->translateMessage($name,$menu->get('module'));
            foreach (array('title') as $name)
            {        
              if (isset($menu[$name]))
                  $this->translateMessage($menu[$name],$menu['module']);                 
            }           
        }  
       // echo "<pre>";  var_dump($menus);echo "</pre>";
     /*   foreach ($menus as $name=>$menu)    
        {   
        //     echo "<pre>++";  var_dump($menu);echo "</pre>";
            if($menu->hasI18n())
            {   //echo "<pre>";  var_dump($menu->getI18n());echo "</pre>";
              $this->translateMessage($menu->getI18n()->get('value'),$menu->get('module'));
            }
            //foreach (array('title') as $name)
            //{        
             // if (isset($menu[$name]))
            //  echo "<pre>--";  var_dump($menu->get('name'));echo "</pre>";
             //     $this->translateMessage($menu->get('name'),$menu->get('module'));                 
           // }           
        }       */  
    }

}
