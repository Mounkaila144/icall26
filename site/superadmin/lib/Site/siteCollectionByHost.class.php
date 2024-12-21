<?php

class siteCollectionByHost extends siteCollection {   

    protected $class="Site";
    
    protected function getKeyForSelect()
    {
        return 'site_host';
    }        
            
}

