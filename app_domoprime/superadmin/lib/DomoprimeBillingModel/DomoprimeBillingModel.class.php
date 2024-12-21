<?php

class DomoprimeBillingModel extends DomoprimeBillingModelBase {
     
     static function createFromFile(File $file,$site=null)
     {
         $model=new DomoprimeBillingModel(null,$site);
         $model->set('name',$file->getFilename())->save();
         $model_i18n=new DomoprimeBillingModelI18n(null,$site);
         $model_i18n->add(array('value'=>$file->getFilename(),
                           'lang'=>'fr',
                           'body'=>$file->getContent(),
                           'model_id'=>$model))->save();
     }    
     
     static function createFromDirectory($directory,$site=null)
     {
       foreach (glob($directory."/*.txt") as $file)
       {           
           self::createFromFile(new File($file),$site);          
       }  
     }   
}
