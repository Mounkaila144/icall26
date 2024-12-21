<?php


class MenuTranslator extends mfTranslator { 
        
    protected function translateItems($menu)
    {       
        foreach ($menu as $item)    
        {           
           if ($item->has('module'))
           {   
               // FieldName to translate
               foreach (array('title','help') as $fieldName)
               {        
                 if ($item->has( $fieldName))
                        $this->translateMessage($item->get($fieldName),$item->get('module'));
               }                
           }  
           if ($item->hasChildren())
               $this->translateItems($item->getChildren());
        }   
    }             

}

