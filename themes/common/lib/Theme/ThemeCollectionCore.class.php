<?php


abstract class ThemeCollectionCore extends mfObjectCollection2 {
       
    
    function getNames()
    {
        $names=array();
        foreach ($this->collection as $item)
            $names[]=$item->get('name');
        return $names;
    }
    
    function getNamesI18n()
    {
        $names=array();
        foreach ($this->collection as $item)
        {
            $names[$item->get('name')]=__($item->getName());
        }    
        return $names;
    }
}

