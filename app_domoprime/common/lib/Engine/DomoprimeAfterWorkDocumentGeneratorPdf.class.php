<?php

//http://www.ecosol26.net/admin/applications/domoprime/admin/ExportPolluterAfterWorkDocumentPdf?Contract=647
/*
 *  0,0,595,843|1;0,100,595,843|1;0,0,595,843|2
 * 
 *  60,40,435,153|1
 * 
 *  153,300,435,153|1
 * 
 */
class DomoprimeAfterWorkDocumentGeneratorPdf {
    
    protected $afterwork_document=null,$document=null,$files=null;
    
    function __construct(DomoprimeAfterWorkDocumentPdf $afterwork_document,DomoprimePolluterAfterWork $document) {
        $this->document=$document; 
        $this->afterwork_document=$afterwork_document;
        $this->site=$afterwork_document->getSite();
    }
    
    function getSite()
    {
        return $this->site;
    }
    
    function getDocument()
    {
        return $this->document;
    }
    
    function getAfterWorkDocument()
    {
        return $this->afterwork_document;
    }
    
    function getDirectory()
    {
        return $this->directory=$this->directory===null?new FileSystemDirectory(mfConfig::get("mf_site_app_cache_dir")."/data/domoprime/afterwork/pdf/".mfTools::generateUniqueId()):$this->directory;
    }
    
    function getPagesDirectory()
    {
        return $this->pages=$this->pages===null?new FileSystemDirectory((string)$this->getDirectory()."/pages"):$this->pages;
    }
    
    function getSignaturesDirectory()
    {
        return (string)$this->getDirectory()."/signatures";
    }
    
  /*  function getLogosDirectory()
    {
        return $this->getDirectory()."/logos";
    }*/
    
    function getOutputDirectory()
    {
        return (string)$this->getDirectory()."/output";
    }
    
    
    
    function process()
    {            
        if ($this->getDocument()->getModel()->getOptions()->isEmpty())
            return $this;                   
        mfFileSystem::mkdir_multiple(array((string)$this->getPagesDirectory(),
                                           $this->getSignaturesDirectory()."/polluter",
                                           $this->getSignaturesDirectory()."/company",
                                           $this->getSignaturesDirectory()."/layer",
                                           $this->getSignaturesDirectory()."/partner",
                                           $this->getOutputDirectory()."/pages"));                       
        // extract all pages
        $pdftk=new SystemPdftk();
        $pdftk->addFile($this->getAfterWorkDocument()->getFilename());
        $pdftk->addOption('burst output '.(string)$this->getPagesDirectory().'/%d.pdf');
        $pdftk->execute();              
        // Generate signature                
        if ($this->getAfterWorkDocument()->getContract()->hasPolluter())
        {
            if ($this->getAfterWorkDocument()->getContract()->getPolluter()->hasLogo())
            {                                  
                // A4 = 595 x 842                
                foreach ($this->getDocument()->getModel()->getOptions()->getPolluter()->byPages() as  $signatures)
                {                    
                    foreach ($signatures as $signature)
                    {                            
                        $convert= new SystemImageMagick();                     
                        $convert->addOption($this->getAfterWorkDocument()->getContract()->getPolluter()->getLogo()->getFile().                                
                                     //   ($signature->getCanvas()->getWidth()||$signature->getCanvas()->getHeight()?" -resize ".$signature->getCanvas()->getWidth()."x".$signature->getCanvas()->getHeight():"").
                                      //  " -transparent white ".                             
                                      //  " -density 300x300".
                                     //   " -page a4+".$signature->getCanvas()->getX1()."+".$signature->getCanvas()->getY1().
                                        " -quality 100 ".
                                        " -units PixelsPerInch -density 300 ".
                                        $this->getSignaturesDirectory()."/polluter/tmp_".$signature->getID().".pdf");
                    //  $convert->debug();
                        $convert->convert();  
                        
                        $jam = new SystemPdfJam();
                        $jam->addOption(" --paper 'a4paper' ".
                                    " --scale ".$signature->getCanvas()->getRatio(). 
                                    " --offset '".$signature->getCanvas()->getX()."cm ".$signature->getCanvas()->getY()."cm' ".                                    
                                     $this->getSignaturesDirectory()."/polluter/tmp_".$signature->getID().".pdf".
                                     " --outfile ". $this->getSignaturesDirectory()."/polluter/".$signature->getID().".pdf"
                                      );
                        // $jam->debug();
                        $jam->execute();  
                    }
                }
            }
        }    
        
        //partner logo
         if ($this->getAfterWorkDocument()->getContract()->hasPartner())
        {
            if ($this->getAfterWorkDocument()->getContract()->getPartner()->hasLogo())
            {                                  
                // A4 = 595 x 842                
                foreach ($this->getDocument()->getModel()->getOptions()->getPartner()->byPages() as  $signatures)
                {                    
                    foreach ($signatures as $signature)
                    {                            
                        $convert= new SystemImageMagick();                     
                        $convert->addOption($this->getAfterWorkDocument()->getContract()->getPartner()->getLogo()->getFile().                                
                                     //   ($signature->getCanvas()->getWidth()||$signature->getCanvas()->getHeight()?" -resize ".$signature->getCanvas()->getWidth()."x".$signature->getCanvas()->getHeight():"").
                                      //  " -transparent white ".                             
                                      //  " -density 300x300".
                                     //   " -page a4+".$signature->getCanvas()->getX1()."+".$signature->getCanvas()->getY1().
                                        " -quality 100 ".
                                        " -units PixelsPerInch -density 300 ".
                                        $this->getSignaturesDirectory()."/partner/tmp_".$signature->getID().".pdf");
                    //  $convert->debug();
                        $convert->convert();  
                        
                        $jam = new SystemPdfJam();
                        $jam->addOption(" --paper 'a4paper' ".
                                    " --scale ".$signature->getCanvas()->getRatio(). 
                                    " --offset '".$signature->getCanvas()->getX()."cm ".$signature->getCanvas()->getY()."cm' ".                                    
                                     $this->getSignaturesDirectory()."/partner/tmp_".$signature->getID().".pdf".
                                     " --outfile ". $this->getSignaturesDirectory()."/partner/".$signature->getID().".pdf"
                                      );
                        // $jam->debug();
                        $jam->execute();  
                    }
                }
            }
        }    
        // die(__METHOD__);
        
        if ($this->getAfterWorkDocument()->getContract()->hasCompany())
        {                                   
            if ($this->getAfterWorkDocument()->getContract()->getCompany()->hasPicture())
            {                                   
                // A4 = 595 x 842                                                       
                foreach ($this->getDocument()->getModel()->getOptions()->getCompany()->byPages() as  $signatures)
                {         
                    foreach ($signatures as $signature)
                    {
                    $convert= new SystemImageMagick();    
                  //  var_dump($signature->getCanvas()->getX1(),$signature->getCanvas()->getY1()); die(__METHOD__);
                       // convert cee.pdf -resize 50% -transparent white -page a4+180+80 -quality 75 cee1.pdf
                    $convert->addOption($this->getAfterWorkDocument()->getContract()->getCompany()->getPicture()->getFile().
                                        //" -resize 30% ". 
                                    //    ($signature->getCanvas()->getWidth()||$signature->getCanvas()->getHeight()?" -resize ".$signature->getCanvas()->getWidth()."x".$signature->getCanvas()->getHeight():"").
                                    //    " -transparent white ".
                                   //     " -page a4+".$signature->getCanvas()->getX1()."+".$signature->getCanvas()->getY1().
                                         " -quality 100 ".
                                        " -units PixelsPerInch -density 300 ".
                                        $this->getSignaturesDirectory()."/company/tmp_".$signature->getID().".pdf");
                  //  $convert->debug();
                    $convert->convert();
                    
                    $jam = new SystemPdfJam();
                        $jam->addOption(" --paper 'a4paper' ".
                                    " --scale ".$signature->getCanvas()->getRatio(). 
                                    " --offset '".$signature->getCanvas()->getX()."cm ".$signature->getCanvas()->getY()."cm' ".                                    
                                     $this->getSignaturesDirectory()."/company/tmp_".$signature->getID().".pdf".
                                     " --outfile ". $this->getSignaturesDirectory()."/company/".$signature->getID().".pdf"
                                      );
                        // $jam->debug();
                        $jam->execute();  
                        
                    }
                }
            }
                        
            if ($this->getAfterWorkDocument()->getContract()->getCompany()->hasFooter())
            {                                  
                // A4 = 595 x 842                                                       
                foreach ($this->getDocument()->getModel()->getOptions()->getFooterCompany()->byPages() as  $signatures)
                {         
                    foreach ($signatures as $signature)
                    {
                    $convert= new SystemImageMagick();    
                  //  var_dump($signature->getCanvas()->getX1(),$signature->getCanvas()->getY1()); die(__METHOD__);
                       // convert cee.pdf -resize 50% -transparent white -page a4+180+80 -quality 75 cee1.pdf
                    $convert->addOption($this->getAfterWorkDocument()->getContract()->getCompany()->getFooter()->getFile().
                                        //" -resize 30% ". 
                                      //  ($signature->getCanvas()->getWidth()||$signature->getCanvas()->getHeight()?" -resize ".$signature->getCanvas()->getWidth()."x".$signature->getCanvas()->getHeight():"").
                                      //  " -transparent white ".
                                     //   " -page a4+".$signature->getCanvas()->getX1()."+".$signature->getCanvas()->getY1().
                                         " -quality 100 ".
                                        " -units PixelsPerInch -density 300 ".
                                        $this->getSignaturesDirectory()."/company/tmp_footer_".$signature->getID().".pdf");
                  //  $convert->debug();
                    $convert->convert();
                    
                      $jam = new SystemPdfJam();
                        $jam->addOption(" --paper 'a4paper' ".
                                    " --scale ".$signature->getCanvas()->getRatio(). 
                                    " --offset '".$signature->getCanvas()->getX()."cm ".$signature->getCanvas()->getY()."cm' ".                                    
                                     $this->getSignaturesDirectory()."/company/tmp_footer_".$signature->getID().".pdf".
                                     " --outfile ". $this->getSignaturesDirectory()."/company/footer_".$signature->getID().".pdf"
                                      );
                        // $jam->debug();
                        $jam->execute();  
                    }
                }
            }
            if ($this->getAfterWorkDocument()->getContract()->getCompany()->hasHeader())
            {              
                // A4 = 595 x 842                                                       
                foreach ($this->getDocument()->getModel()->getOptions()->getHeaderCompany()->byPages() as  $signatures)
                {         
                    foreach ($signatures as $signature)
                    {
                    $convert= new SystemImageMagick();    
                  //  var_dump($signature->getCanvas()->getX1(),$signature->getCanvas()->getY1()); die(__METHOD__);
                       // convert cee.pdf -resize 50% -transparent white -page a4+180+80 -quality 75 cee1.pdf
                    $convert->addOption($this->getAfterWorkDocument()->getContract()->getCompany()->getHeader()->getFile().
                                        //" -resize 30% ". 
                                     //   ($signature->getCanvas()->getWidth()||$signature->getCanvas()->getHeight()?" -resize ".$signature->getCanvas()->getWidth()."x".$signature->getCanvas()->getHeight():"").
                                    //    " -transparent white ".
                                   //     " -page a4+".$signature->getCanvas()->getX1()."+".$signature->getCanvas()->getY1().
                                         " -quality 100 ".
                                        " -units PixelsPerInch -density 300 ".
                                        $this->getSignaturesDirectory()."/company/tmp_header_".$signature->getID().".pdf");
                  //  $convert->debug();
                    $convert->convert();
                    
                      $jam = new SystemPdfJam();
                        $jam->addOption(" --paper 'a4paper' ".
                                    " --scale ".$signature->getCanvas()->getRatio(). 
                                    " --offset '".$signature->getCanvas()->getX()."cm ".$signature->getCanvas()->getY()."cm' ".                                    
                                     $this->getSignaturesDirectory()."/company/tmp_header_".$signature->getID().".pdf".
                                     " --outfile ". $this->getSignaturesDirectory()."/company/header_".$signature->getID().".pdf"
                                      );
                        // $jam->debug();
                        $jam->execute();  
                    }
                }
            }
        }  
        else
        {
            $company= SiteCompanyUtils::getSiteCompany($this->getSite());
            
            if ($company->hasPicture())
            {                                                          
                foreach ($this->getDocument()->getModel()->getOptions()->getCompany()->byPages() as  $signatures)
                {           
                     foreach ($signatures as $signature)
                    {
                    $convert= new SystemImageMagick();    
                  //  var_dump($signature->getCanvas()->getX1(),$signature->getCanvas()->getY1()); die(__METHOD__);
                       // convert cee.pdf -resize 50% -transparent white -page a4+180+80 -quality 75 cee1.pdf
                    $convert->addOption($company->getPicture()->getFile().
                                      //  " -resize 30% -transparent white ".
                                     //   ($signature->getCanvas()->getWidth()||$signature->getCanvas()->getHeight()?" -resize ".$signature->getCanvas()->getWidth()."x".$signature->getCanvas()->getHeight():"").
                                    //    " -transparent white ".
                                    //    " -page a4+".$signature->getCanvas()->getX1()."+".$signature->getCanvas()->getY1().
                                          " -quality 100 ".
                                        " -units PixelsPerInch -density 300 ".
                                        $this->getSignaturesDirectory()."/company/tmp_".$signature->getID().".pdf");
                  //  $convert->debug();
                    $convert->convert();
                    
                      $jam = new SystemPdfJam();
                        $jam->addOption(" --paper 'a4paper' ".
                                    " --scale ".$signature->getCanvas()->getRatio(). 
                                    " --offset '".$signature->getCanvas()->getX()."cm ".$signature->getCanvas()->getY()."cm' ".                                    
                                     $this->getSignaturesDirectory()."/company/tmp_".$signature->getID().".pdf".
                                     " --outfile ". $this->getSignaturesDirectory()."/company/".$signature->getID().".pdf"
                                      );
                        // $jam->debug();
                        $jam->execute();  
                    }
                }
            }
            if ($company->hasFooter())
            {                                             
                foreach ($this->getDocument()->getModel()->getOptions()->getFooterCompany()->byPages() as  $signatures)
                {           
                     foreach ($signatures as $signature)
                    {
                    $convert= new SystemImageMagick();    
                  //  var_dump($signature->getCanvas()->getX1(),$signature->getCanvas()->getY1()); die(__METHOD__);
                       // convert cee.pdf -resize 50% -transparent white -page a4+180+80 -quality 75 cee1.pdf
                    $convert->addOption($company->getFooter()->getFile().
                                      //  " -resize 30% -transparent white ".
                                     //   ($signature->getCanvas()->getWidth()||$signature->getCanvas()->getHeight()?" -resize ".$signature->getCanvas()->getWidth()."x".$signature->getCanvas()->getHeight():"").
                                      //  " -transparent white ".
                                    //    " -page a4+".$signature->getCanvas()->getX1()."+".$signature->getCanvas()->getY1().
                                          " -quality 100 ".
                                        " -units PixelsPerInch -density 300 ".
                                        $this->getSignaturesDirectory()."/company/tmp_footer_".$signature->getID().".pdf");
                  //  $convert->debug();
                    $convert->convert();
                    
                       $jam = new SystemPdfJam();
                        $jam->addOption(" --paper 'a4paper' ".
                                    " --scale ".$signature->getCanvas()->getRatio(). 
                                    " --offset '".$signature->getCanvas()->getX()."cm ".$signature->getCanvas()->getY()."cm' ".                                    
                                     $this->getSignaturesDirectory()."/company/tmp_footer_".$signature->getID().".pdf".
                                     " --outfile ". $this->getSignaturesDirectory()."/company/footer_".$signature->getID().".pdf"
                                      );
                        // $jam->debug();
                        $jam->execute();  
                    }
                }
            }
            if ($company->hasHeader())
            {                     
                foreach ($this->getDocument()->getModel()->getOptions()->getHeaderCompany()->byPages() as  $signatures)
                {           
                     foreach ($signatures as $signature)
                    {
                    $convert= new SystemImageMagick();    
                  //  var_dump($signature->getCanvas()->getX1(),$signature->getCanvas()->getY1()); die(__METHOD__);
                       // convert cee.pdf -resize 50% -transparent white -page a4+180+80 -quality 75 cee1.pdf
                    $convert->addOption($company->getHeader()->getFile().
                                      //  " -resize 30% -transparent white ".
                                      //  ($signature->getCanvas()->getWidth()||$signature->getCanvas()->getHeight()?" -resize ".$signature->getCanvas()->getWidth()."x".$signature->getCanvas()->getHeight():"").
                                      //  " -transparent white ".
                                     //   " -page a4+".$signature->getCanvas()->getX1()."+".$signature->getCanvas()->getY1().
                                          " -quality 100 ".
                                        " -units PixelsPerInch -density 300 ".
                                        $this->getSignaturesDirectory()."/company/tmp_header_".$signature->getID().".pdf");
                  //  $convert->debug();
                    $convert->convert();
                    
                      $jam = new SystemPdfJam();
                        $jam->addOption(" --paper 'a4paper' ".
                                    " --scale ".$signature->getCanvas()->getRatio(). 
                                    " --offset '".$signature->getCanvas()->getX()."cm ".$signature->getCanvas()->getY()."cm' ".                                    
                                     $this->getSignaturesDirectory()."/company/tmp_header_".$signature->getID().".pdf".
                                     " --outfile ". $this->getSignaturesDirectory()."/company/header_".$signature->getID().".pdf"
                                      );
                        // $jam->debug();
                        $jam->execute();  
                    }
                }
            }
        }    
        
         if ($this->getAfterWorkDocument()->getContract()->hasPartnerLayer())
        {            
            if ($this->getAfterWorkDocument()->getContract()->getPartnerLayer()->hasLogo())
            {                               
                // A4 = 595 x 842                
                foreach ($this->getDocument()->getModel()->getOptions()->getLayer()->byPages() as  $signatures)
                {
                      foreach ($signatures as $signature)
                    {
                  //  var_dump($this->getAfterWorkDocument()->getContract()->getPartnerLayer()->getLogo()->getFile());  die(__METHOD__);
                    $convert= new SystemImageMagick();    
                  //  var_dump($signature->getCanvas()->getX1(),$signature->getCanvas()->getY1()); die(__METHOD__);
                       // convert cee.pdf -resize 50% -transparent white -page a4+180+80 -quality 75 cee1.pdf
                    $convert->addOption($this->getAfterWorkDocument()->getContract()->getPartnerLayer()->getLogo()->getFile().
                                     //   " -resize 30% -transparent white ".
                                    //    " -page a4+".$signature->getCanvas()->getX1()."+".$signature->getCanvas()->getY1().
                                          " -quality 100 ".
                                        " -units PixelsPerInch -density 300 ".
                                        $this->getSignaturesDirectory()."/layer/tmp_".$signature->getID().".pdf");
                  //  $convert->debug();
                    $convert->convert();
                    
                     $jam = new SystemPdfJam();
                        $jam->addOption(" --paper 'a4paper' ".
                                    " --scale ".$signature->getCanvas()->getRatio(). 
                                    " --offset '".$signature->getCanvas()->getX()."cm ".$signature->getCanvas()->getY()."cm' ".                                    
                                     $this->getSignaturesDirectory()."/layer/tmp_".$signature->getID().".pdf".
                                     " --outfile ". $this->getSignaturesDirectory()."/layer/".$signature->getID().".pdf"
                                      );
                        // $jam->debug();
                        $jam->execute();  
                    }
                }
            }
        }   
                                
        // apply stamp on each page on signatures      
         if ($this->getAfterWorkDocument()->getContract()->hasPolluter())
        {
            if ($this->getAfterWorkDocument()->getContract()->getPolluter()->hasLogo())
            {
                foreach ($this->getDocument()->getModel()->getOptions()->getPolluter()->byPages() as $signatures)
                {
                    foreach ($signatures as $signature)
                    {
                        $pdftk=new SystemPdftk(); // // pdftk in.pdf stamp cee1.pdf  output out.pdf
                        $pdftk->addFile((string)$this->getPagesDirectory()."/".$signature->getPage().".pdf");
                        $pdftk->addOption("stamp ".$this->getSignaturesDirectory()."/polluter/".$signature->getID().".pdf");  
                        $pdftk->setOutput($this->getOutputDirectory()."/pages/".$signature->getPage().".pdf");
                     //   $pdftk->debug();
                        $pdftk->execute();

                        $file= new File($this->getOutputDirectory()."/pages/".$signature->getPage().".pdf");
                        $file->copy((string)$this->getPagesDirectory());      
                    }
                }    
            }
        }
        
         if ($this->getAfterWorkDocument()->getContract()->hasPartner())
        {
            if ($this->getAfterWorkDocument()->getContract()->getPartner()->hasLogo())
            {
                foreach ($this->getDocument()->getModel()->getOptions()->getPartner()->byPages() as $signatures)
                {
                    foreach ($signatures as $signature)
                    {
                        $pdftk=new SystemPdftk(); // // pdftk in.pdf stamp cee1.pdf  output out.pdf
                        $pdftk->addFile((string)$this->getPagesDirectory()."/".$signature->getPage().".pdf");
                        $pdftk->addOption("stamp ".$this->getSignaturesDirectory()."/partner/".$signature->getID().".pdf");  
                        $pdftk->setOutput($this->getOutputDirectory()."/pages/".$signature->getPage().".pdf");
                     //   $pdftk->debug();
                        $pdftk->execute();

                        $file= new File($this->getOutputDirectory()."/pages/".$signature->getPage().".pdf");
                        $file->copy((string)$this->getPagesDirectory());      
                    }
                }    
            }
        }
        
        if ($this->getAfterWorkDocument()->getContract()->hasCompany())
        {                                   
            if ($this->getAfterWorkDocument()->getContract()->getCompany()->hasPicture())
            { 
                foreach ($this->getDocument()->getModel()->getOptions()->getCompany()->byPages() as $signatures)
                 {
                     foreach ($signatures as $signature)
                    {
                      $pdftk=new SystemPdftk(); // // pdftk in.pdf stamp cee1.pdf  output out.pdf
                      $pdftk->addFile((string)$this->getPagesDirectory()."/".$signature->getPage().".pdf");
                      $pdftk->addOption("stamp ".$this->getSignaturesDirectory()."/company/".$signature->getID().".pdf");  
                      $pdftk->setOutput($this->getOutputDirectory()."/pages/".$signature->getPage().".pdf");
                   //   $pdftk->debug();
                      $pdftk->execute();

                      $file= new File($this->getOutputDirectory()."/pages/".$signature->getPage().".pdf");
                      $file->copy((string)$this->getPagesDirectory());
                    }
                 }   
            }
             if ($this->getAfterWorkDocument()->getContract()->getCompany()->hasHeader())
            { 
                foreach ($this->getDocument()->getModel()->getOptions()->getHeaderCompany()->byPages() as $signatures)
                 {
                     foreach ($signatures as $signature)
                    {
                      $pdftk=new SystemPdftk(); // // pdftk in.pdf stamp cee1.pdf  output out.pdf
                      $pdftk->addFile((string)$this->getPagesDirectory()."/".$signature->getPage().".pdf");
                      $pdftk->addOption("stamp ".$this->getSignaturesDirectory()."/company/".$signature->getID().".pdf");  
                      $pdftk->setOutput($this->getOutputDirectory()."/pages/".$signature->getPage().".pdf");
                   //   $pdftk->debug();
                      $pdftk->execute();

                      $file= new File($this->getOutputDirectory()."/pages/".$signature->getPage().".pdf");
                      $file->copy((string)$this->getPagesDirectory());
                    }
                 }   
            }
             if ($this->getAfterWorkDocument()->getContract()->getCompany()->hasFooter())
            { 
                foreach ($this->getDocument()->getModel()->getOptions()->getFooterCompany()->byPages() as $signatures)
                 {
                     foreach ($signatures as $signature)
                    {
                      $pdftk=new SystemPdftk(); // // pdftk in.pdf stamp cee1.pdf  output out.pdf
                      $pdftk->addFile((string)$this->getPagesDirectory()."/".$signature->getPage().".pdf");
                      $pdftk->addOption("stamp ".$this->getSignaturesDirectory()."/company/".$signature->getID().".pdf");  
                      $pdftk->setOutput($this->getOutputDirectory()."/pages/".$signature->getPage().".pdf");
                   //   $pdftk->debug();
                      $pdftk->execute();

                      $file= new File($this->getOutputDirectory()."/pages/".$signature->getPage().".pdf");
                      $file->copy((string)$this->getPagesDirectory());
                    }
                 }   
            }
        }
        else
        {
            $company= SiteCompanyUtils::getSiteCompany($this->getSite());
            if ($company->hasPicture())
            {
                foreach ($this->getDocument()->getModel()->getOptions()->getCompany()->byPages() as $signatures)
                 {
                     foreach ($signatures as $signature)
                    {
                      $pdftk=new SystemPdftk(); // // pdftk in.pdf stamp cee1.pdf  output out.pdf
                      $pdftk->addFile((string)$this->getPagesDirectory()."/".$signature->getPage().".pdf");
                      $pdftk->addOption("stamp ".$this->getSignaturesDirectory()."/company/".$signature->getID().".pdf");  
                      $pdftk->setOutput($this->getOutputDirectory()."/pages/".$signature->getPage().".pdf");
                   //   $pdftk->debug();
                      $pdftk->execute();

                      $file= new File($this->getOutputDirectory()."/pages/".$signature->getPage().".pdf");
                      $file->copy((string)$this->getPagesDirectory());
                    }
                 }   
            } 
            if ($company->hasFooter())
            {
                foreach ($this->getDocument()->getModel()->getOptions()->getFooterCompany()->byPages() as $signatures)
                 {
                     foreach ($signatures as $signature)
                    {
                      $pdftk=new SystemPdftk(); // // pdftk in.pdf stamp cee1.pdf  output out.pdf
                      $pdftk->addFile((string)$this->getPagesDirectory()."/".$signature->getPage().".pdf");
                      $pdftk->addOption("stamp ".$this->getSignaturesDirectory()."/company/footer_".$signature->getID().".pdf");  
                      $pdftk->setOutput($this->getOutputDirectory()."/pages/".$signature->getPage().".pdf");
                   //   $pdftk->debug();
                      $pdftk->execute();

                      $file= new File($this->getOutputDirectory()."/pages/".$signature->getPage().".pdf");
                      $file->copy((string)$this->getPagesDirectory());
                    }
                 }   
            } 
            if ($company->hasHeader())
            {
                foreach ($this->getDocument()->getModel()->getOptions()->getHeaderCompany()->byPages() as $signatures)
                 {
                     foreach ($signatures as $signature)
                    {
                      $pdftk=new SystemPdftk(); // // pdftk in.pdf stamp cee1.pdf  output out.pdf
                      $pdftk->addFile((string)$this->getPagesDirectory()."/".$signature->getPage().".pdf");
                      $pdftk->addOption("stamp ".$this->getSignaturesDirectory()."/company/header_".$signature->getID().".pdf");  
                      $pdftk->setOutput($this->getOutputDirectory()."/pages/".$signature->getPage().".pdf");
                   //   $pdftk->debug();
                      $pdftk->execute();

                      $file= new File($this->getOutputDirectory()."/pages/".$signature->getPage().".pdf");
                      $file->copy((string)$this->getPagesDirectory());
                    }
                 }   
            } 
        }    
        
        if ($this->getAfterWorkDocument()->getContract()->hasPartnerLayer())
        {            
            if ($this->getAfterWorkDocument()->getContract()->getPartnerLayer()->hasLogo())
            {  
                foreach ($this->getDocument()->getModel()->getOptions()->getLayer()->byPages() as $signatures)
                {
                     foreach ($signatures as $signature)
                    {
                        $pdftk=new SystemPdftk(); // // pdftk in.pdf stamp cee1.pdf  output out.pdf
                        $pdftk->addFile((string)$this->getPagesDirectory()."/".$signature->getPage().".pdf");
                        $pdftk->addOption("stamp ".$this->getSignaturesDirectory()."/layer/".$signature->getID().".pdf");  
                        $pdftk->setOutput($this->getOutputDirectory()."/pages/".$signature->getPage().".pdf");
                      //   $pdftk->debug();
                        $pdftk->execute();

                        $file= new File($this->getOutputDirectory()."/pages/".$signature->getPage().".pdf");
                        $file->copy((string)$this->getPagesDirectory());
                    }
                }   
            }
        }    
     
        // pdftk in.pdf stamp cee1.pdf  output out.pdf
        $this->files =new mfArray();
        for ($page=1;$page <= $this->getPagesDirectory()->getNumberOfFiles();$page++)
        {          
               $this->files[]=(string)$this->getPagesDirectory()."/".$page.".pdf";
        }          
        // merge
        $merger=new SystemGhostScript();
        $merger->setOutput((string)$this->getDirectory()."/output.pdf");
        $merger->setFiles($this->files);
        $merger->execute(); 
        // clean up
          mfFileSystem::net_rmdirs(array(
            (string)$this->getPagesDirectory(),
             $this->getSignaturesDirectory(),
             $this->getOutputDirectory()
        ));  
        return $this;
    }
    
    function getName()
    {       
        return $this->getAfterWorkDocument()->getName();
    }
    
    function getFilename()
    {
        if ($this->getDocument()->getModel()->getOptions()->isEmpty())
           return $this->getAfterWorkDocument()->getFilename(); 
        return (string)$this->getDirectory()."/output.pdf";
    }
}
