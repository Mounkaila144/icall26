<?php


class SystemMenuCollection extends mfObjectCollection3 {
    
    function __construct($data = null, $site = null) {
        if ($data instanceof SystemMenu)
        {
           parent::__construct(null, $site); 
           $this->data=$data;
           return ;
        }            
        if ($data instanceof mfJson)
        {
          
           parent::__construct(null, $site); 
           $this->data=$data;
           $this->build();
           return ;
        } 
        parent::__construct($data, $site);
    }
    
    function getAll()
    {        
        if ($this->isLoaded())
           return $this;        
        if ($this->data instanceof SystemMenu)
        {    
         // var_dump($this->data->get('name'),$this->data->get('level'),$this->data->get('lb'),$this->data->get('rb'));echo "<br>";
            $db=mfSiteDatabase::getInstance()
               ->setParameters(array('lb'=>$this->data->get('lb'),'rb'=>$this->data->get('rb'),'levelplusone'=>$this->data->get('level')+1))
               ->setObjects(array('SystemMenu','SystemMenuI18n'))
            ->setQuery("SELECT {fields} FROM ".SystemMenu::getTable().
                       " LEFT JOIN ".SystemMenuI18n::getInnerForJoin('menu_id')." AND ".SystemMenuI18n::getTableField('lang')."='fr'".
                        " WHERE lb > {lb} AND rb < {rb}".
                       " AND level='{levelplusone}' ".      
                    //   " AND status='ACTIVE' ".      
                        " ORDER BY rb ASC".
                       ";")      
               ->makeSqlQuery(); 
        //   echo $db->getQuery(); echo "<br>";//die();
           if (!$db->getNumRows())
               return $this;  
          
           while ($items=$db->fetchObjects())
           {         
               $item=$items->getSystemMenu();  
               $item->setI18n($items->hasSystemMenuI18n()?$items->getSystemMenuI18n():0);
              
               $this[$item->get('id')]=$item;
             
           }
         
           $this->loaded();         
           $this->by_name=null;   
        }   
 
       return $this;
    }
    
    function byName()
    {
        if ($this->by_name===null)
        {           
            $this->by_name=new $this();          
            foreach ($this as $item)          
               $this->by_name[$item->get('name')]=$item;          
        }
        return $this->by_name;        
    }
    
    function build()
    {
         foreach($this->data->decode(true) as $name=>$menu)
        {
              //echo "<pre>"; var_dump($name); echo "</pre>"; 
              $this[$name]=new SystemMenu($menu);
              if (isset($menu['children']) && $menu['children'])
              {
                  foreach($menu['children'] as $child_name=>$child)
                  {
                     // $this[$child_name]=new SystemMenu($menu); 
                       // echo "<pre>--111-"; var_dump($child_name); echo "</pre>"; 
                      $this[$name]->getChildren()->push(new SystemMenu($child));
                  }    
              }    
             /*  if(!empty($menu['children']))
              {
                  foreach( $menu['children'] as $child_name=>$child)
                  {
                        echo "<pre>---"; var_dump($child_name); echo "</pre>"; 
                      $this[$child_name]=new SystemMenu($menu);
                      // echo "<pre>------- childs"; var_dump($child);echo "-----------</pre>";
                  }
              } */
              
         } 
         
         return $this;
    }
    
    function clear()
    {
       // parent::clear();
        $this->loaded=false;
        $this->collection=array();
        $this->by_name=null;
        return $this;
    }
    
    function getData()
    {
        return $this->collection;
    }
   
}

