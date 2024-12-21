<?php

class SitesDeleteForm extends SitesChangeForm  {
    
    function configure()
    {
         parent::configure();
         unset($this['value']); // No need >remove
    }
    
    function reorganize($validator,$values)
    {
        foreach ($values['selection'] as $index=>$item)
        {
            $values['sites'][$index]['site_host']=$item;
        }    
        return $values;
    }
}
