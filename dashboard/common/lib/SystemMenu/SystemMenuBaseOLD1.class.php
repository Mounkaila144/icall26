<?php



class SystemMenuBaseOLd extends SystemMenuCore {
 
            
  /*  function __construct($parameters=null,$site=null) {
        parent::__construct(null,$site);
        $this->getDefaults(); 
        if ($parameters===null) return $this; 
        if (is_array($parameters)||$parameters instanceof ArrayAccess) {
            if (isset($parameters['name']))
                return $this->loadByName((string)$parameters['name']);
            if (isset($parameters['id']))
                return $this->loadById((string)$parameters['id']);
            return $this->add($parameters); 
        }              
    }  */
    
     
    
      protected function executeIsExistQuery($db)    
    {
       $key_condition=($this->getKey())?" AND ".self::getKeyName()."!='%s';":"";
        $db->setParameters(array('name'=>$this->get('name'),$this->getKey()))
           ->setQuery("SELECT ".self::getKeyName()." FROM ".self::getTable()." WHERE name='{name}' ".$key_condition)
           ->makeSqlQuery();  
    }
    
    static function load($name)
    {
       if (self::$instance[$name]===null) 
       { 
          self::$instance[$name]=new static($name);
          self::$instance[$name]->loadMenus();
       }
       return self::$instance[$name];
    }
    
    function getMenuManager()
    {
        return $this->menu_manager->getChildren();
    }
    
    function loadMenus(){
        if ($this->menus===null)
        {               
                     
        //  var_dump(mfConfig::get('mf_site_app_cache_dir')."/i18n/".mfcontext::getInstance()->getRequest()->getCulture()."/system.menu.".$this->menu_name);
         //  die(__METHOD__);           
            mfContext::getInstance()->getI18n()->addExternalMessageSources(
                    mfConfig::get('mf_site_app_cache_dir')."/i18n/menus/".mfcontext::getInstance()->getRequest()->getCulture()."/system.menu.".$this->get('name'));
                        
            // test cache
         $cache= new mfCacheFile('menus.'.$this->get('name'),'admin');
         $this->menu_manager= MenuManager::getInstance($this->get('name'))->getMenu(); 
          $this->menus=new MenuItem();                             
            if ($cache->isCached())                
            {                                  
                 //  $data= json_decode($cache->read(),true);
          /*  echo "<ul>";
            foreach ($data as $key_0=>$child_0)
            {
                echo "<li>".$key_0."</li>";
                if (isset($child_0['children']) && $child_0['children'])
                {
                    echo "<ul>";
                    foreach ($child_0['children'] as $key_1=>$child_1)
                    {
                          echo "<li>".$key_1."</li>";
                           echo "<ul>";
                            foreach ($child_1['children'] as $key_2=>$child_2)
                            {
                                  echo "<li>".$key_2."</li>";
                            }
                            echo "</ul>";
                    }
                    echo "</ul>";
                }    
            }    
            echo "<ul>";
            die(__METHOD__);  */
                
                
             $this->children=new SystemMenuCollection(new mfJson($cache->read()));     
             foreach ($this->children as $item){
                if($item->get('type')=="USER")
                {
                    $menu = $this->menu_manager->addChild($item->get('name'));
                }
                else
                 {                             
                    if(!$this->menu_manager->search($item->get('name')))
                       continue;
                    $menu = clone $this->menu_manager->search($item->get('name'));
                 }
              //  $menu = clone $this->menu_manager->search($item->get('name'));
                $menu->clearChildren();
                $menu->set('title',(string)$item->getI18n());      
                 if($item->get('status')=="DELETE")
                     continue;
                $this->menus->push($menu);                   
                if($item->hasChildren())
                {                     
                  foreach ($item->getChildren()->getAll()->byName() as  $child)
                  {
                      if($child->get('type')=="USER")
                        {
                            $sub_menu = $this->menu_manager->addChild($child->get('name'));
                        }
                        else
                        {                             
                           if(!$this->menu_manager->search($child->get('name')))
                              continue;
                           $sub_menu = clone $this->menu_manager->search($child->get('name'));
                        }
                      // $sub_menu = clone $this->menu_manager->search($child->get('name'));
                       $sub_menu->set('title',$child->getI18n()->get('value'));
                       $sub_menu->clearChildren();
                        if($child->get('status')=="DELETE")
                            continue;
                        $menu->push($sub_menu);                           
                        if($child->hasChildren())
                        {                     
                          foreach ($child->getChildren()->getAll()->byName() as  $child_1)
                          {
                              if($child_1->get('type')=="USER")
                                {
                                   $search=$this->menu_manager->addChild($child_1->get('name'));
                                    $sub_menu_1 = clone $search;
                                    $sub_menu_1->set('title',(string)$child_1->getI18n());
                                    $sub_menu_1->clearChildren();
                                    if($child_1->get('status')=="DELETE")
                                        continue;
                                    $sub_menu->push($sub_menu_1);        
                                }
                               
                                elseif($search=$this->menu_manager->search($child_1->get('name')))
                                {     
                                    
                                    $sub_menu_1 = clone $search;
                                    $sub_menu_1->set('title',(string)$child_1->getI18n());
                                    $sub_menu_1->clearChildren();
                                    if($child_1->get('status')=="DELETE")
                                        continue;
                                    $sub_menu->push($sub_menu_1);                                           
                                }
                               /* if ($search=$this->menu_manager->search($child_1->get('name')))
                                {        
                                    $sub_menu_1 = clone $search;
                                    $sub_menu_1->set('title',$child_1->getI18n()->get('value'));
                                    $sub_menu_1->clearChildren();
                                    if($child_1->get('status')=="DELETE")
                                        continue;
                                    $sub_menu->push($sub_menu_1);                                           
                                }*/
                          }               
                        }
                  }               
                }
              }             
              
           //   echo "<pre>"; var_dump($this->menus); die(__METHOD__);
                return $this->menus;
            }            
            
           $this->build($this->get('name'));                          
            
           foreach ($this->getSystemMenus()->getAll()->byName() as $item){              
               if($item->get('type')=="USER")
                {
                    $menu = $this->menu_manager->addChild($item->get('name'));
                }
                else{
                    $menu = clone $this->menu_manager->search($item->get('name'));
                }
               // $menu = clone $this->menu_manager->search($item->get('name'));
                $menu->clearChildren();
                $menu->set('title',(string)$item->getI18n());
                if($item->get('status')=="DELETE")
                    continue;
                $this->menus->push($menu);                    
                if($item->hasChildren())
                {                     
                  foreach ($item->getChildren()->getAll()->byName() as  $child)
                  {
                       if($child->get('type')=="USER")
                        {
                            $sub_menu = $this->menu_manager->addChild($child->get('name'));
                        }
                        else{
                             if(!$this->menu_manager->search($child->get('name')))
                               continue;
                             $sub_menu = clone $this->menu_manager->search($child->get('name'));
                        }
                     //  $sub_menu = clone $this->menu_manager->search($child->get('name'));
                       $sub_menu->clearChildren();
                       $sub_menu->set('title',(string)$child->getI18n());
                        if($child->get('status')=="DELETE")
                            continue;
                        $menu->push($sub_menu);                             
                        if($child->hasChildren())
                        {                     
                          foreach ($child->getChildren()->getAll()->byName() as  $child_1)
                          {
                               if($child_1->get('type')=="USER")
                                {
                                    $search=$this->menu_manager->addChild($child_1->get('name'));
                                    $sub_menu_1 = clone $search;
                                    $sub_menu_1->set('title',(string)$child_1->getI18n());
                                    $sub_menu_1->clearChildren();
                                    if($child_1->get('status')=="DELETE")
                                        continue;
                                    $sub_menu->push($sub_menu_1);        
                                }                               
                                elseif($search=$this->menu_manager->search($child_1->get('name')))
                                {     
                                    
                                    $sub_menu_1 = clone $search;
                                    $sub_menu_1->set('title',(string)$child_1->getI18n());
                                    $sub_menu_1->clearChildren();
                                    if($child_1->get('status')=="DELETE")
                                        continue;
                                    $sub_menu->push($sub_menu_1);                                           
                                }
                             /*   if ($search=$this->menu_manager->search($child_1->get('name')))
                                {        
                                    $sub_menu_1 = clone $search;
                                    $sub_menu_1->set('title',$child_1->getI18n()->get('value'));
                                    $sub_menu_1->clearChildren();
                                     if($child_1->get('status')=="DELETE")
                                         continue;
                                       $sub_menu->push($sub_menu_1);                                          
                                }*/
                          }               
                        }
                  }               
                }
            }   
            
          // echo "<pre>"; var_dump(json_decode($this->toJson(),true));
         /*   $data= json_decode($this->toJson(),true);
            echo "<ul>";
            foreach ($data as $key_0=>$child_0)
            {
                echo "<li>".$key_0."</li>";
                if (isset($child_0['children']) && $child_0['children'])
                {
                    echo "<ul>";
                    foreach ($child_0['children'] as $key_1=>$child_1)
                    {
                          echo "<li>".$key_1."</li>";
                    }
                    echo "</ul>";
                }    
            }    
            echo "<ul>";
            die(__METHOD__);*/
            $cache->register($this->toJson());
 
        }
        return $this;
    }          
    
    
    
    function getMenu()
    {
      return $this->menus;
    }
    
    function getSortedMenus()
    {     
      return $this->menus;
    }
    
    function hasMenus()
    {
        return !empty($this->menus);
    }      
    
    function buildNode($data,$node,$root){

         $collection = new SystemMenuI18nCollection();    
         foreach($data->getChildren() as $child)
        {          
            //echo "<pre>-0-"; var_dump($child['name']);echo "</pre>";
            if ($root->getAll()->byName()->hasItemByKey($child['name']))
            {                
                if($child->hasChildren())
                {    
                   $child_node = $root->getAll()->byName()->getItemByKey($child['name']);             
                   $this->buildNode($child, $child_node,$root);                
                }                 
            }
            else
            {          
                
                $child_node = new $this();
                $child_node->add(array('name'=>$child['name'],'module'=>$child['module']));
                $child_node->at($node)->asFirstChild()->save();  
                $node_i18n= new SystemMenuI18n(array('lang'=>'fr','menu_id'=>$child_node->get('id')));
                if($node_i18n->isNotLoaded())
                {

                        $node_i18n->add(array('menu_id'=>$child_node,'value'=>__($child['title']),'lang'=>mfContext::getInstance()->getUser()->getLanguage()));
                        $collection[]= $node_i18n;
                        $node->setI18n($node_i18n);
                }
                if($child->hasChildren())
                {    
                   $this->buildNode($child, $child_node,$root);                
                }        
            }
                                  
        }
      
        $collection->save();
        return $this; 
    }
    
    function build(){ 
                
       // create root & menu node      
       $this->save();               
     //  $menu_names=new mfArray(array_keys($this->menu_manager->getChildren()));
       $menu_names = new mfArray();
       foreach($this->menu_manager->getChildren() as $key=>$value)
       {
           $menu_names[]=$key;
           if($value->hasChildren())
           {
            foreach($value->getChildren() as $key_1=>$value_1)
            {
                $menu_names[]=$key_1;
                if($value_1->hasChildren())
                {
                 foreach($value_1->getChildren() as $key_2=>$value_2)
                 {
                  $menu_names[]=$key_2;
                 }
                }
            }
           }
       }
//       foreach ($menu_names as $name)
//       {
//              echo "<pre>"; var_dump($name);echo "</pre>";
//       } 
//       die();
    $this->deleteNotInChildrenByNames($menu_names); 
 
        foreach ($this->menu_manager->getChildren() as $key=>$data)
        {         
              // echo "<pre>"; var_dump($key);echo "</pre>";
              if ($this->getAll()->byName()->hasItemByKey($key))
              {               
                  // update                 
                  $this->getAll()->byName()->getItemByKey($key)->add(array('module'=>$data['module']));
              //    echo "--1--";
              }    
              elseif($this->getFirstChildByName($key))
              {
                //    echo "--2--";
                //   echo "<pre>"; var_dump((new $this($key))->get('name'));echo "</pre>";
                 // echo "TEST SOUAD";//die(__LINE__);
              }
              else
              {       
                //    echo "--3--";
                  $node = new $this();
                  $node->add(array('name'=>$key,'module'=>$data['module']));
                  $node->at($this)->asFirstChild()->save();  
                  $this->getChildren()->push($node);
              }                  
             
        }   
     //   echo "<pre>";var_dump($this->getChildren());echo "</pre>";
       // die();
        $this->getChildren()->loaded(); 
        $this->translate($this->menu_manager->getChildren());   
        $this->getChildren()->clear();
        $collection = new SystemMenuI18nCollection(); 
       foreach ($this->menu_manager->getChildren() as $key=>$data)
        {    
 
              if (!$this->getAll()->byName()->hasItemByKey($key))
              {
 
                    continue;
              }             
 
                  $node = $this->getAll()->byName()->getItemByKey($key);
                  $node_i18n= new SystemMenuI18n(array('lang'=>'fr','menu_id'=>$node->get('id')));
                
                   if($node_i18n->isNotLoaded())
                   {
                       
                           $node_i18n->add(array('menu_id'=>$node,'value'=>__($data['title']),'lang'=>mfContext::getInstance()->getUser()->getLanguage()));
                           $collection[]= $node_i18n;
                           $node->setI18n($node_i18n);
                   }                
        }   
 
        foreach ($this->menu_manager->getChildren() as $key=>$data)
        {    
 
              if ($this->getAll()->byName()->hasItemByKey($key))
              {
                   $node = $this->getAll()->byName()->getItemByKey($key);                   
                   $this->buildNode($data, $node,$this);                           
              }                                
        }
     
        $collection->save();
        $this->getChildren()->clear();        
       
        $this->loadById($this->get('id'));
       // die();   
        return $this;
    }
    
 
    function getSystemMenus()
    {
      
       return $this->system_menus=$this->system_menus===null?new SystemMenuCollection($this):$this->system_menus;
    } 
    
    function getComponents()
    {
        if ($this->components===null)
        {    
            $this->components=array();
            foreach ($this->menus as $name=>$menu)
            {
                if (isset($menu['component']))
                    $this->components[$name]=$menu;
            }
        }
        return $this->components;
    }
    
    function getModules()
    {
        if ($this->modules==null)
        {    
            $this->modules=new mfArray();
            foreach ($this->getComponents() as $menu) 
            {
                $module=basename(dirname($menu['component']));               
                if (isset($this->modules[$module]))
                    continue;
                $this->modules[$module]=$module;
            }    
        }
        return $this->components;
    }
       
    static function removeCache($menu,$site=null)
    {        
         mfCacheFile::removeCache('menus.'.$menu,'admin',$site);      
    } 
    
    
    function __toString() {
        return (string)$this->getI18n();
    }
    
    
    
    function loadI18n()
    {       
        
        mfContext::getInstance()->getI18n()->addExternalMessageSources(mfConfig::get('mf_site_app_cache_dir')."/i18n/menus/".mfcontext::getInstance()->getRequest()->getCulture()."/system.menu.".$this->get('name'));
        return $this;
    }
    
    
    function translate($menus=null){

        if(mfConfig::get('mf_i18n')){                   
            $this->translator=new SystemMenuTranslator(array('culture'=>mfcontext::getInstance()->getRequest()->getCulture(),'name'=>'system.menu.'.$this->get('name'),'type'=>'menus'));
           
           $menus_list= new mfArray();
            foreach($menus as $menu)
            {
                $menus_list[]=$menu;
                foreach($menu->getChildren() as $child_menu)
                {
                     $menus_list[]=$child_menu;
                }
            
            }

             $this->translator->translate($menus_list);             
        } 
        return $this;
    }
    
       function create()
    {
         $node=new $this();                                   
         $node->at($this)->asFirstChild();  // Insert as child otherwise insert from root                             
        return $node;
    }
    function hasChildren()
    {
        return (boolean)$this->getChildren();
    }
    
    function getChildren()
    {
      
       return  $this->children=$this->children===null?new SystemMenuCollection($this):$this->children;
                
       /*    $this->children=new SystemMenuCollection();
      /*  $db=mfSiteDatabase::getInstance()
            ->setParameters(array('lb'=>$this->lb,'lang'=>$lang?$lang:mfContext::getInstance()->getUser()->getLanguage(),'rb'=>$this->rb,'levelplusone'=>$this->get('level') + 1))
            ->setObjects(array('SystemMenu','SystemMenuI18n'))
            ->setQuery("SELECT {fields} FROM ".SystemMenu::getTable().
                       " LEFT JOIN ".SystemMenuI18n::getInnerForJoin('menu_id')." AND ".SystemMenuI18n::getTableField('lang')."='{lang}'".
                       " WHERE lb > {lb} AND rb < {rb} AND level='{levelplusone}' ".                          
                      // " ORDER BY ".SystemMenuI18n::getTableField('title')." COLLATE UTF8_GENERAL_CI ASC".
                       " ORDER BY rb ".$order.
                       ";")
            ->makeSqlQuery();
      //  echo $db->getQuery();
        if (!$db->getNumRows())
              return $this->children; 
         while ($items=$db->fetchObjects())
        {
           $this->children[$items->getSystemMenu()->get('id')]=$items->getSystemMenu()->setI18n($items->hasSystemMenuI18n()?$items->getSystemMenuI18n():false);
        }       
       }    */
     //  return $this->children;    
    }
      
      function getFathers()
    {
       if ($this->fathers===null)
       {            
           $this->fathers=new SystemMenuCollection();
        $db=mfSiteDatabase::getInstance()
            ->setParameters(array('lb'=>$this->lb,'rb'=>$this->rb,'lang'=>$this->hasI18n()?$this->getI18n()->get('lang'):mfcontext::getInstance()->getUser()->getLanguage()))
            ->setObjects(array('SystemMenu','SystemMenuI18n'))
            ->setQuery("SELECT {fields} FROM ".static::getTable().   
                       " LEFT JOIN ".SystemMenuI18n::getInnerForJoin('menu_id')." AND lang='{lang}'".
                       " WHERE lb<={lb} AND rb >={rb} AND level!=0 ".    
                     // " AND status='ACTIVE' ".      
                       " ORDER BY level ASC".
                       ";")
            ->makeSqlQuery();
         // echo $db->getQuery();
        if (!$db->getNumRows())
              return $this->fathers; 
         while ($items=$db->fetchObjects())
        {
           $this->fathers[$items->getSystemMenu()->get('id')]=$items->getSystemMenu()->setI18n($items->hasSystemMenuI18n()?$items->getSystemMenuI18n():false);
        }       
       }
       return $this->fathers;      
    }
    
     function getChildrenByName($name,$lang=null)
    {
        if ($this->children===null)
       {            
           $this->children=new SystemMenuCollection();
        $db=mfSiteDatabase::getInstance()
            ->setParameters(array('lb'=>$this->lb,'lang'=>$lang?$lang:mfContext::getInstance()->getUser()->getLanguage(),'rb'=>$this->rb,'levelplusone'=>$this->get('level') + 1,'name'=>$name))
            ->setObjects(array('SystemMenu','SystemMenuI18n'))
            ->setQuery("SELECT {fields} FROM ".SystemMenu::getTable().
                       " LEFT JOIN ".SystemMenuI18n::getInnerForJoin('menu_id')." AND ".SystemMenuI18n::getTableField('lang')."='{lang}'".
                       " WHERE lb > {lb} AND rb < {rb} AND level='{levelplusone}' ". 
                       " WHERE ".SystemMenu::getTableField('menu')."='{name}'".
                                           
                       ";")
            ->makeSqlQuery();
        // echo $db->getQuery();
        if (!$db->getNumRows())
              return $this->children; 
         while ($items=$db->fetchObjects())
        {
           $this->children[$items->getSystemMenu()->get('name')]=$items->getSystemMenu()->setI18n($items->hasSystemMenuI18n()?$items->getSystemMenuI18n():false);
        }       
       }    
       return $this->children;    
    }
    
   function deleteNotInChildrenByNames(mfArray $names)
    {
        if ($names->isEmpty())
            return $this;
  
        
      //  die(__METHOD__);
        $db=mfSiteDatabase::getInstance()
            ->setParameters(array('rb'=>$this->get('rb'),'lb'=>$this->get('lb'),'level'=>$this->get('level')))   
            ->setObjects(array('SystemMenu'))
            ->setQuery("SELECT {fields} FROM ".SystemMenu::getTable().                     
                       " WHERE lb > '{lb}' AND rb < '{rb}' ".
                       " AND level > '{level}'".
                       " AND name NOT IN ('".$names->implode("','")."')".
                       " AND type !='USER' ;")            
            ->makeSqlQuery();
        //   echo $db->getQuery();
        //   die();
         if (!$db->getNumRows())
              return $this; 
         $this->list=array();
         while ($items=$db->fetchObjects())
        {
              
           $this->list[]=$items->getSystemMenu();
        }       
        // recalcule rb / lb 
        foreach ($this->list as $menu){
           // var_dump($menu->get('name'));
            //$menu->delete();
            $menu->set('status','DELETE')->save();
        }
 //die(__METHOD__);
        $this->children=null;
        return $this;
    }
    
    
     public function hasI18n($lang=null)
     {
        return (boolean)$this->getI18n($lang);
     } 
     
 
     public function setI18n($i18n)
     {
         $this->i18n=$i18n;
         return $this;
     } 
     
     public function getI18n($lang=null)
     {      
         if ($this->i18n===null)
         {
              if ($lang==null)
                  $lang=  mfcontext::getInstance()->getUser()->getCountry();
             $this->i18n=new SystemMenuI18n(array('lang'=>$lang,"menu_id"=>$this->get('id')),$this->getSite());
         }   
         return $this->i18n;
     } 
     function toArray()
     {
      
         $values= parent::toArray();
         if($this->hasChildren())
         {       
             $list= array();
           foreach ($this->getChildren()->getAll()->byName() as $name=>$value)
            {
                   $list[$name]=$value->toArray();
            }
            $values['children']=$list;

         }
         return $values;
     }
       function toJson()
      {
          $values=new mfArray();
       
          foreach ($this->getChildren()->getAll()->byName() as $name=>$value)
          {
          
             $values[$name]=$value->toArray();
              
          }
          return  $values->toJson();
      }
      
     function findMenu($name_to_find)
     {
         
          foreach ($this->getChildren()->getAll()->byName() as $name=>$value)
          {
              
             if($name==$name_to_find)
             {
                 return  $value;
             }
             elseif($value->hasChildren())
             {
                foreach($value->getChildren() as $child_name=>$child)
                {
                    if($child_name==$name_to_find)
                    {
                        return  $child;
                    }
                }
             }
             return null; 
          }
     }
     
      function getChilds()
    {
      
     
         $this->children=new SystemMenuCollection();
        $db=mfSiteDatabase::getInstance()
            ->setParameters(array('lb'=>$this->lb,'lang'=>$lang?$lang:mfContext::getInstance()->getUser()->getLanguage(),'rb'=>$this->rb,'levelplusone'=>$this->get('level') + 1))
            ->setObjects(array('SystemMenu','SystemMenuI18n'))
            ->setQuery("SELECT {fields} FROM ".SystemMenu::getTable().
                       " LEFT JOIN ".SystemMenuI18n::getInnerForJoin('menu_id')." AND ".SystemMenuI18n::getTableField('lang')."='{lang}'".
                       " WHERE lb > {lb} AND rb < {rb} AND level='{levelplusone}' ".    
                    //    " AND status='ACTIVE' ".      
                      // " ORDER BY ".SystemMenuI18n::getTableField('title')." COLLATE UTF8_GENERAL_CI ASC".
                       " ORDER BY rb ".$order.
                       ";")
            ->makeSqlQuery();
      //  echo $db->getQuery();
        if (!$db->getNumRows())
              return $this->children; 
         while ($items=$db->fetchObjects())
        {
           $this->children[$items->getSystemMenu()->get('id')]=$items->getSystemMenu()->setI18n($items->hasSystemMenuI18n()?$items->getSystemMenuI18n():false);
        }       
           
       return $this->children;    
    }
    
     
    
  /*   static function reloadCache($name)
    {                     
      if (self::$instance[$name]===null) 
       { 
       
          self::$instance[$name]=new static($name);
         // self::$instance[$name]->getMenu();
          self::$instance[$name]->loadCache();
       }
       //   var_dump(self::$instance[$name]->getChilds());
      
       
    }
    */
     function loadCache()
    {
       /*  $this->menus=new menuItem();    
        
        $this->loadById($this->get('id'));
        $cache= new mfCacheFile('menus.'.$this->get('name'),'admin');
         $this->menu_manager= MenuManager::getInstance($this->get('name'))->getMenu();
        //  echo "<pre>";var_dump($this->getSystemMenus()->getAll()->byName());echo "</pre>";
         foreach ($this->getSystemMenus()->getAll()->byName() as $item){              
                $menu = clone $this->menu_manager->search($item->get('name'));
                $menu->clearChildren();
                $menu->set('title',$item->getI18n()->get('value'));
                $this->menus->push($menu);                      
                if($item->hasChildren())
                {                     
                  foreach ($item->getChildren()->getAll()->byName() as  $child)
                  {
                       $sub_menu = clone $this->menu_manager->search($child->get('name'));
                       $sub_menu->clearChildren();
                       $sub_menu->set('title',$child->getI18n()->get('value'));
                       $menu->push($sub_menu);     
                        if($child->hasChildren())
                        {                     
                          foreach ($child->getChildren()->getAll()->byName() as  $child_1)
                          {
                                if ($search=$this->menu_manager->search($child_1->get('name')))
                                {        
                                    $sub_menu_1 = clone $search;
                                    $sub_menu_1->set('title',$child_1->getI18n()->get('value'));
                                    $sub_menu_1->clearChildren();
                                    $sub_menu->push($sub_menu_1);                    
                                }
                          }               
                        }
                  }               
                }
            }     */ 
              mfCacheFile::removeCache('menus.'.$this->get('name'),'admin'); 
        //  $cache->register($this->toJson());
        return  $this->menus;                  
    }
    
    function getRootFather()
    {
       if ($this->root_father===null)
       {                       
        $db=mfSiteDatabase::getInstance()
            ->setParameters(array('lb'=>$this->lb,'rb'=>$this->rb))          
            ->setQuery("SELECT * FROM ".static::getTable().   
                       //" LEFT JOIN ".SystemMenuI18n::getInnerForJoin('menu_id')." AND lang='{lang}'".
                       " WHERE lb<={lb} AND rb >={rb} AND level=1 ".                           
                       " ORDER BY level ASC".
                      " LIMIT 0,1".
                       ";")
            ->makeSqlQuery();
       // var_dump($db->fetchRow());         
         return $this->root_father=$db->fetchObject('SystemMenu');         
       }       
       return $this->root_father;      
    }
    
    
    function getFirstChildByName($name)
    {
         if ($this->first_child===null)
       {                       
        $db=mfSiteDatabase::getInstance()
            ->setParameters(array('lb'=>$this->lb,'rb'=>$this->rb,'name'=>$name))          
            ->setQuery("SELECT * FROM ".static::getTable().   
                       //" LEFT JOIN ".SystemMenuI18n::getInnerForJoin('menu_id')." AND lang='{lang}'".
                       " WHERE lb>{lb} AND rb <{rb} ".
                       " AND name='{name}' ".   
                      " AND status='ACTIVE' ".      
                      // " ORDER BY level ASC".
                      " LIMIT 0,1".
                       ";")
            ->makeSqlQuery();
       // var_dump($db->fetchRow());         
         return $this->first_child=$db->fetchObject('SystemMenu');         
       }       
       return $this->first_child;      
    }
    
    
   function disable()
    {
        if ($this->isNotLoaded())
            return $this;
        $db=mfSiteDatabase::getInstance()
            ->setParameters(array('lb'=>$this->lb,'rb'=>$this->rb))          
            ->setQuery("UPDATE ".self::getTable()." SET status='DELETE'".
                      " WHERE lb>={lb} AND rb <={rb} ".
                       ";")
            ->makeSqlQuery();
        $this->set('status','DELETE');
        return $this;
    }
    
    
    function getAll()
    {
        if ($this->all===null)
        {
            $this->all=new SystemMenuCollection();
            $db=mfSiteDatabase::getInstance()
               ->setParameters(array('lb'=>$this->get('lb'),'rb'=>$this->get('rb'),'levelplusone'=>$this->get('level')+1))
               ->setObjects(array('SystemMenu','SystemMenuI18n'))
            ->setQuery("SELECT {fields} FROM ".SystemMenu::getTable().
                       " LEFT JOIN ".SystemMenuI18n::getInnerForJoin('menu_id')." AND ".SystemMenuI18n::getTableField('lang')."='fr'".
                        " WHERE lb > {lb} AND rb < {rb}".
                        " AND level >='{levelplusone}' ".      
                    //   " AND status='ACTIVE' ".      
                        " ORDER BY rb ASC".
                       ";")      
               ->makeSqlQuery(); 
        //   echo $db->getQuery(); echo "<br>";//die();
           if (!$db->getNumRows())
               return $this->all;  
          
           while ($items=$db->fetchObjects())
           {         
               $item=$items->getSystemMenu();  
               $item->setI18n($items->hasSystemMenuI18n()?$items->getSystemMenuI18n():0);              
               $this->all[$item->get('id')]=$item;             
           }
         
           $this->all->loaded();     
            
        }
        return $this->all;
    }
    
    
    function getDepth()
    {
        if ($this->depth===null)
        {
            if ($this->isNotLoaded())
                return $this->depth=false;
            $db=mfSiteDatabase::getInstance()
                ->setParameters(array('lb'=>$this->get('lb'),'rb'=>$this->get('rb')))             
                ->setQuery("SELECT MAX(level) FROM ".SystemMenu::getTable().                    
                       " WHERE lb > {lb} AND rb < {rb}".                     
                       ";")      
               ->makeSqlQuery(); 
            $row=$db->fetchRow();
            $this->depth=(int)$row[0] - $this->get('level');
        }
        return $this->depth;
      /*  $depth=0;
        if($this->hasChildren())
        {
            $depth++;
            foreach ( $this->getChildren() as $child)
            {
                if($child->hasChildren())
                {   $depth++;
                    foreach($child->getChildren() as $child_1)
                    {
                         if($child_1->hasChildren())
                         {
                               $depth++;
                          
                         }

                    }
                }
          }                           
        }        
       return $depth; */
    }
}

