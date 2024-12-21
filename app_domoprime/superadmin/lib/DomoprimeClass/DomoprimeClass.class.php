<?php

class DomoprimeClass extends DomoprimeClassBase {
     
   
    
    static function update_0122($site=null)
    {
        $class_i18n= new DomoprimeClassI18n(array('lang'=>'fr','value'=>'INTERMEDIAIRE'),$site);
        if ($class_i18n->isLoaded())
        {
           $class_i18n->getClass()->add(array('name'=>3,'coef'=>0.28,
                                'multiple'=>1.0,
                                'multiple_floor'=>1.0,
                                'multiple_top'=>1.0,
                                'multiple_wall'=>1.0,))->save(); 
           $class=$class_i18n->getClass();
        }   
        else
        {    
            $class= new DomoprimeClass(null,$site);
            $class->add(array('name'=>3,'coef'=>0.28, 'multiple'=>1.0,
                                'multiple_floor'=>1.0,
                                'multiple_top'=>1.0,
                                'multiple_wall'=>1.0))->save();
            $class_i18n= new DomoprimeClassI18n(null,$site);
            $class_i18n->add(array('class_id'=>$class,'lang'=>'fr','value'=>'INTERMEDIAIRE'))->save();
        }
        return $class;
    }        
    
    
     static function update_0124($site=null)
    {
        $class_i18n= new DomoprimeClassI18n(array('lang'=>'fr','value'=>'INTERMEDIAIRE'),$site);
        if ($class_i18n->isLoaded())
        {
           $class_i18n->getClass()->add(array('name'=>3,'coef'=>0.28,
                                'multiple'=>1.0,
                                'multiple_floor'=>1.0,
                                'multiple_top'=>1.0,
                                'multiple_wall'=>1.0,))->save(); 
           $class=$class_i18n->getClass();
        }   
        else
        {    
            $class= new DomoprimeClass(null,$site);
            $class->add(array('name'=>3,'coef'=>0.28, 'multiple'=>1.0,
                                'multiple_floor'=>1.0,
                                'multiple_top'=>1.0,
                                'multiple_wall'=>1.0))->save();
            $class_i18n= new DomoprimeClassI18n(null,$site);
            $class_i18n->add(array('class_id'=>$class,'lang'=>'fr','value'=>'INTERMEDIAIRE'))->save();
        }
        return $class;
    }      
}
