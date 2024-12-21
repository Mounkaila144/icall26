<?php

class mfTabsConfigHandler extends mfFileLoaderConfigHandler {
                       
  /*  function getModules($configFiles)
    {
        $modules=array();
        foreach  ($configFiles as $file)
        {
            $file=explode("/",str_replace(mfConfig::get('mf_modules_dir')."/","",$file));
            $modules[]=$file[0];
        }
        // Here we have module used
        // May be remove configFiles where module is not enabled
    }*/
    
    function execute($configFiles) {     
        TabsTranslator::removeCache('tabs');// Remove i18n cache
        $selectorName=$this->getParameters()->get('parameters');   
        $site=$this->getParameters()->get('site');     
        $classModuleManager=$this->getParameters()->get('class');
        if ($classModuleManager && class_exists($classModuleManager))
        {
            $configFiles=$classModuleManager::getInstance()->getConfigFiles($configFiles,$site);        
        }              
        $data=array();
        foreach ($this->buildTabs($configFiles,$selectorName,$selectorName."_tabs") as $name=>$tab)
        {
            $data[$name]=new Tab($name,$tab);
        }           
        $translator=array();
        $translator[]=sprintf("if (mfConfig::get('mf_i18n')) {\n\t\$translator=new TabsTranslator(array('culture'=>\$request->getCulture(),'name'=>'%s','type'=>'tabs'),\$site);",$selectorName);
        $translator[]=sprintf("\t\$translator->translate(\$this->tabs);");     
        $translator[]=sprintf("\t\$translator->setI18nSource();\n}\n");
        $retval=sprintf("<?php\n".
                   "// auto-generated by ".get_class($this)."\n".
                   "// date: %s\n\$this->tabs=unserialize('%s');\n".
                   "%s", date('Y/m/d H:i:s'),serialize($data),implode("\n",$translator)
        );
        return $retval;
    }

    function getModuleFromConfigFile($file)
    {
        $file=explode("/",str_replace(mfConfig::get('mf_modules_dir')."/","",$file));
        return $file[0];
    }
    
    function parse($configFiles)
    {
        $infos=array();
        foreach ($configFiles as $file)
        {
          $infos=mfTools::arrayDeepMerge($infos, include $file);        
          // Fixed module in tab
          foreach ($infos as $name=>$info)
          {
              foreach ($info as $action=>$tab)
              {
                 if (!isset($tab['module'])) 
                    $infos[$name][$action]['module']=$this->getModuleFromConfigFile($file); 
              }    
          }
        }             
        return $infos;
    }          
    
    function buildTabs($configFiles,$selectorName,$name)
    {                
        $data=$this->parse($configFiles);
        if (isset($data[$selectorName]))
        {
            return $data[$selectorName];
        }
        return array();
    }
    
}
