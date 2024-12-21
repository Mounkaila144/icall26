<?php

class UserProfileImportXML  {
    
    protected $xml=null,$options=array();
    
    function __construct( $file,$options=array()) {       
          $this->xml=new File(is_string($file)?$file:$file->getTempName());  
          $this->options=$options;
          $this->configure();
    }
    
    function getOptions()
    {
        return $this->options;
    }
    
    function getOption($name,$defaults=null)
    {
       return isset($this->options[$name])?$this->options[$name]:$defaults; 
    }        
       
    
    function configure()
    {
        
        
        return $this;
    }
    
    function getXml()
    {
        return $this->xml;
    }
    
    
     
    
    function process()
    {          
     
        if (!$xml=simplexml_load_file($this->getXml()->getFile(),'SimpleXMLElement'))
           throw new mfException(__('File is invalid.'));
        
        /* ---------- profile ---------- */
            $profile=new UserProfile();
            $profile->set('name',$xml->name);
            if ($profile->isExist())
                $profile->set('name',"1-".$profile->get('name'));
            $profile->save();
        
        
        /* ---------- profile i18n ---------- */
            $profile_i18n=new UserProfileI18n();
            $profile_i18n->add(array('value'=>$xml->i18n->value,'lang'=>$xml->i18n->lang));
            if ($profile_i18n->isExist())
                $profile_i18n->set('value',"1-".$profile_i18n->get('value'));
            $profile_i18n->set('profile_id',$profile->get('id'));  
            $profile_i18n->save(); 



           $functions =new UserFunctionCollection();
            $functions_i18n =new UserFunctionI18nCollection();
            $ProfileFunctions =new UserProfileFunctionCollection();
        
        // ---------- function ---------- 
            foreach ($xml->functions->function as $item){                        
                $function=new UserFunction($item->name);
                if (!$function->isExist()){                
                    $function_i18n=new UserFunctionI18n(array('value'=>$item->i18n->value,'lang'=>$item->i18n->lang));
                    $function->setI18n($function_i18n);
                }
                $functions[(string)$item->name]=$function;
            }
            $functions->save();
        
        
        // ---------- function i18n ---------- 
            foreach ($functions as $item){
                $functions[(string)$item->name]->getI18n()->set('function_id',$functions[(string)$item->name]->get('id'));
                $functions_i18n[]=$functions[(string)$item->name]->getI18n();
            }
            $functions_i18n->save();
	
        // ---------- profile function ---------- 
            foreach ($functions as $item){
            
                $profile_function=new UserProfileFunction();
                $profile_function->add(array('function_id'=>$item,'profile_id'=>$profile->get('id')));
                $ProfileFunctions[]= $profile_function;
            }

            $ProfileFunctions->save();


            $Groups =new GroupCollection();
            $ProfileGroups =new UserProfileGroupCollection();
            $Permissions =new PermissionCollection();
            $GroupPermissions =new GroupPermissionCollection();
        
        /* ---------- group ---------- */
            foreach ($xml->groups->group as $group_item){

                $group=new Group(null,'admin');
                $group->add(array('is_active'=>$group_item->is_active,'name'=>(string)$group_item->name));
                $name=$group->get('name');
                if ($group->isExist())
                    $group->set('name',"1-".$group->get('name'));           
                $Groups[$name]=$group;                                     
            }
            $Groups->save();
        
        /* ---------- profile group ---------- */
            foreach ($Groups as $item){            
                $profile_group=new UserProfileGroup();
                $profile_group->add(array('group_id'=>$item,'profile_id'=>$profile->get('id')));
                $ProfileGroups[]=$profile_group;    
            }
            $ProfileGroups->save();
        
             
        /* ---------- permission ---------- */
            foreach ($xml->groups->group as $group_item){
                foreach ($group_item->permissions->permission as $permission_item){
                    $permission=new Permission((string)$permission_item,'admin');
                    $Permissions[(string)$permission_item]=$permission; 
                }
            }
           $Permissions->save();

        /* ---------- group permission ---------- */
            foreach ($xml->groups->group as $group_item){

             foreach ($group_item->permissions->permission as $permission_item){
                    $group_permission=new GroupPermission();                      
                    $group_permission->add(array('group_id'=>$Groups[(string)$group_item->name],
                                                 'permission_id'=>$Permissions[(string)$permission_item]));
                    $GroupPermissions[]=$group_permission;
                }
            }

            $GroupPermissions->save();  
                    
       return $this;
    }
    
}

