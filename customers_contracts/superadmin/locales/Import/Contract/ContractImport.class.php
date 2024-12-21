<?php

require_once dirname(__FILE__)."/Forms/ContractImportForm.class.php";
require_once dirname(__FILE__)."/Forms/ContractImportFileForm.class.php";

class ContractImport extends ImportCore {
              
    function __construct($file, $type, $site = null) {
        parent::__construct($file, $type, $site);
        if ($type=='zip')
        {    
            $this->loader=new ImportZip('Contract',$site);
            $res=$this->getLoader()->open($file);       
            if ($res=$this->getLoader()->open($file)!==true)                
                throw new mfException(__("zip file [%s] can not be opened.",basename($file)));                  
            $this->getLoader()->extract();
            $this->getLoader()->close();      
            $file=$this->getLoader()->getPath()."/contracts.csv";           
            $this->setPathForResources($this->getSourcePathForFiles());
        }           
        $this->import=new csvImport($file,array(),$site); 
    }               
            
    function execute() 
    {                  
        try
        {     
           $this->setForm(new ContractImportForm($this->getSourcePathForFiles(),$this->getSite()));  
           $this->verifyHeader();
           $this->initialize();          
           while ($line=$this->getImport()->fetchArray())
           {                                                      
                $this->getForm()->setDefaults($line);                
                $this->getForm()->bind($line);                  
                if ($this->getForm()->isValid())
                {                         
                    // Check if joined objects exist
                    $product=$this->getForm()->getProduct();                      
                    if ($product->isNotLoaded())
                        $this->getMessages()->addWarning(__("Line %d : product [%s] doesn't exist.",array($this->current_line,$product->get('meta_title'))));
                    $status_i18n=$this->getForm()->getStatusI18n();
                    if ($status_i18n->isNotLoaded())
                        $this->getMessages()->addWarning(__("Line %d : status [%s] doesn't exist.",array($this->current_line,$this->getForm()->getValue('status'))));                    
                    if ($this->getForm()->hasSale1() && $this->getForm()->getSale1()->isNotLoaded())
                        $this->getMessages()->addWarning(__("Line %d : sale1 [%s] doesn't exist.",array($this->current_line,$this->getForm()->getValue('sale1'))));                   
                    if ($this->getForm()->hasSale2() && $this->getForm()->getSale2()->isNotLoaded())
                        $this->getMessages()->addWarning(__("Line %d : sale2 [%s] doesn't exist.",array($this->current_line,$this->getForm()->getValue('sale2'))));                    
                    $customer=$this->getForm()->getCustomer();
                    if ($customer->isNotLoaded())
                        $this->getMessages()->addWarning(__("Line %d : customer phone [%s] doesn't exist.",array($this->current_line,$this->getForm()->getValue('phone'))));                    
                    if ($this->getMessages()->hasWarnings())
                        return ;
                    $contract=$this->getForm()->getContract();                      
                    if ($contract->isLoaded())
                        $this->object_updated++;
                    else
                        $this->object_inserted++;                     
                    // Status
                    $contract->set('state_id',$status_i18n->getCustomerContractStatus());                                   
                    // Sale1
                    $contract->set('sale_1_id',$this->getForm()->getSale1());         
                    // Sale2
                    $contract->set('sale_2_id',$this->getForm()->getSale2());                              
                    // Telepro
                    // @TODO
                    // Manager
                    // @TODO
                    // Amount
                    $contract->set('total_price_with_taxe',$this->getForm()->getValue('amount'));                                     
                    $contract->save();
                      // Foreign keys                    
                    // Contributors  
                    $contract->createContributors();  
                     // Join Product
                    $contract_product=new CustomerContractProduct(array('product_id'=>$product->get('id'),'contract_id'=>$contract->get('id')),$this->getSite());          
                    $contract_product->set('details',$this->getForm()->getValue('details'));
                    $contract_product->save();                                        
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


