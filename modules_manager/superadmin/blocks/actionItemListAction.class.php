<?php

class modules_manager_actionItemListActionComponent extends mfActionComponent {
    
         
    function execute(mfWebRequest $request)
    {       
         $this->html=!$this->getParameter('JS',false);  
         if ($this->html)
         {               
            try
            { 
                $siteModules= new SiteModules($this->getParameter('site'));
                $this->uptodate=$siteModules->isUptodate();
                $this->modulesToUpdate=$siteModules->getModulesToUpdate();
                $this->forbidden=false;
            }
            catch (mfException $e)
            {
                $this->forbidden=$e->getMessage();
            }
         }
    } 
    
   
}

