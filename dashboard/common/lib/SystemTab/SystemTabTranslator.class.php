<?php


class SystemTabTranslator extends mfTranslator { 
    

    protected function translateItems($tabs) {
        
        foreach ($tabs as $name=>$tab)    
        {   
            $this->translateMessage($name,$tab->get('module'));
            foreach (array('title') as $name)
            {        
              if (isset($tab[$name]))
                  $this->translateMessage($tab[$name],$tab['module']);                 
            }           
        }         
    }

}
