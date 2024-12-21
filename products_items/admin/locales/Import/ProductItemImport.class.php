<?php

require_once dirname(__FILE__)."/Forms/ProductItemImportForm.class.php";
require_once dirname(__FILE__)."/Forms/ProductItemImportFileForm.class.php";

class ProductItemImport extends ImportCore {
              
    function __construct($file, $type) {
        parent::__construct($file, $type);
      /*  if ($type=='zip')
        {    
            $this->loader=new ImportZip('Products');
            $res=$this->getLoader()->open($file);       
            if ($res=$this->getLoader()->open($file)!==true)                
                throw new mfException(__("zip file [%s] can not be opened.",basename($file)));                  
            $this->getLoader()->extract();
            $this->getLoader()->close();      
            $file=$this->getLoader()->getPath()."/products.csv";           
            $this->setPathForResources($this->getSourcePathForFiles());
        }      */     
        $this->import=new CsvImport($file); 
    }               
            
    function execute() 
    {                  
        try
        {     
           $this->setForm(new ProductItemImportForm());  
           $this->verifyHeader();
           $this->initialize();          
           while ($line=$this->getImport()->fetchArray())
           {                                                      
                $this->getForm()->setDefaults($line);                
                $this->getForm()->bind($line);                  
                if ($this->getForm()->isValid())
                {      
                    $product_item=$this->getForm()->getProductItem();
                    if ($product_item->isLoaded())
                        $this->object_updated++;
                    else
                        $this->object_inserted++; 
                     // Foreign keys
                    if ($this->getForm()->getValue('tva'))                                   
                        $product_item->set('tva_id',$this->getForm()->getTax());    
                    $product_item->save();            
                }   
                else 
                {      
                     $errors=array();
                     foreach ($this->getForm()->getFields() as $name)
                     {                       
                        if ($this->form[$name]->hasError())
                           $errors[]=sprintf("%s: ",$name).$this->form[$name]->getError();
                     }  
                     throw new ImportException(ImportException::ERROR_IMPORT_FIELDS_ERROR,array('errors'=>$errors,'line'=>$this->current_line));                    
                } 
                $this->current_line++;      
           }
        }
        catch (ImportException $e)
        {
            throw new mfException($e->getI18nMessage());
        }   
       // var_dump($this->getMessages());
        // Warning if file has no line
        // Put number of line managed
        $this->close();
    }
       
    
    
}


