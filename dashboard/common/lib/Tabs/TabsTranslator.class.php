<?php

class TabsTranslator extends mfTranslator {
        
    protected function translateItems($tabs)
    {
        foreach ($tabs as $tab)    
        {          
               foreach (array('title','help') as $name)
               {        
                 if (isset($tab[$name]))
                     $this->translateMessage($tab[$name],$tab['module']);
               }                
        }       
    }
         
}

