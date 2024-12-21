<?php

//http://www.ecosol26.net/admin/applications/domoprime/admin/ExportPolluterPreMeetingDocumentPdf?Contract=647
/*
 *  0,0,595,843|1;0,100,595,843|1;0,0,595,843|2
 * 
 *  60,40,435,153|1
 * 
 *  153,300,435,153|1
 * 
 */
class DomoprimePreMeetingDocumentGeneratorPdf {
    
    protected $premeeting_document=null,$document=null,$files=null;
    
    function __construct(DomoprimePreMeetingDocumentPdf $premeeting_document,DomoprimePolluterPreMeeting $document) {
        $this->document=$document; 
        $this->premeeting_document=$premeeting_document;
        $this->site=$premeeting_document->getSite();
    }
    
    function getSite()
    {
        return $this->site;
    }
    
    function getDocument()
    {
        return $this->document;
    }
    
    function getPreMeetingDocument()
    {
        return $this->premeeting_document;
    }
    
    function getDirectory()
    {
        return $this->directory=$this->directory===null?new FileSystemDirectory(mfConfig::get("mf_site_app_cache_dir")."/data/domoprime/premeeting/pdf/".mfTools::generateUniqueId()):$this->directory;
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
        if (mfContext::getInstance()->getUser()->hasCredential(array(array('superadmin_debug'))) && mfContext::getInstance()->getRequest()->getGetParameter('debug')=="model")
        {
            echo "<pre>"; 
            var_dump($this->getDocument()->getModel()->getOptions()); 
            echo "Document =".$this->getDocument()->get('id')."<br/>";
            echo "Model =".$this->getDocument()->getModel()->get('id')."<br/>";
            die();
        }
        
        if ($this->getDocument()->getModel()->getOptions()->isEmpty())
            return $this;     
      
        mfFileSystem::mkdir_multiple(array((string)$this->getPagesDirectory(),
                                           $this->getSignaturesDirectory()."/polluter",
                                           $this->getSignaturesDirectory()."/company",
                                           $this->getSignaturesDirectory()."/layer",
                                           $this->getOutputDirectory()."/pages"));                       
        // extract all pages
        $pdftk=new SystemPdftk();
        $pdftk->addFile($this->getPreMeetingDocument()->getFilename());
        $pdftk->addOption('burst output '.(string)$this->getPagesDirectory().'/%d.pdf');
        $pdftk->execute();              
        // Generate signature                
        if ($this->getPreMeetingDocument()->getContract()->hasPolluter())
        {
            if ($this->getPreMeetingDocument()->getContract()->getPolluter()->hasLogo())
            {                                  
                // A4 = 595 x 842                
                foreach ($this->getDocument()->getModel()->getOptions()->getPolluter()->byPages() as  $signatures)
                {                    
                    foreach ($signatures as $signature)
                    {                            
                        $convert= new SystemImageMagick();                     
                        $convert->addOption($this->getPreMeetingDocument()->getContract()->getPolluter()->getLogo()->getFile().                                
                                      //  ($signature->getCanvas()->getWidth()||$signature->getCanvas()->getHeight()?" -resize ".$signature->getCanvas()->getWidth()."x".$signature->getCanvas()->getHeight():"").
                                        " -transparent white ".                             
                                      //  " -density 300x300".
                                       // " -page a4+".$signature->getCanvas()->getX1()."+".$signature->getCanvas()->getY1().
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
        // die(__METHOD__);
        
        if ($this->getPreMeetingDocument()->getContract()->hasCompany())
        {                                   
            if ($this->getPreMeetingDocument()->getContract()->getCompany()->hasPicture())
            {                                   
                // A4 = 595 x 842                                                       
                foreach ($this->getDocument()->getModel()->getOptions()->getCompany()->byPages() as  $signatures)
                {         
                    foreach ($signatures as $signature)
                    {
                    $convert= new SystemImageMagick();    
                  //  var_dump($signature->getCanvas()->getX1(),$signature->getCanvas()->getY1()); die(__METHOD__);
                       // convert cee.pdf -resize 50% -transparent white -page a4+180+80 -quality 75 cee1.pdf
                    $convert->addOption($this->getPreMeetingDocument()->getContract()->getCompany()->getPicture()->getFile().
                                        //" -resize 30% ". 
                                      //  ($signature->getCanvas()->getWidth()||$signature->getCanvas()->getHeight()?" -resize ".$signature->getCanvas()->getWidth()."x".$signature->getCanvas()->getHeight():"").
                                      //  " -transparent white ".
                                      //  " -page a4+".$signature->getCanvas()->getX1()."+".$signature->getCanvas()->getY1().
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
             if ($this->getPreMeetingDocument()->getContract()->getCompany()->hasFooter())
            {                                   
                // A4 = 595 x 842                                                       
                foreach ($this->getDocument()->getModel()->getOptions()->getFooterCompany()->byPages() as  $signatures)
                {         
                    foreach ($signatures as $signature)
                    {
                    $convert= new SystemImageMagick();    
                  //  var_dump($signature->getCanvas()->getX1(),$signature->getCanvas()->getY1()); die(__METHOD__);
                       // convert cee.pdf -resize 50% -transparent white -page a4+180+80 -quality 75 cee1.pdf
                    $convert->addOption($this->getPreMeetingDocument()->getContract()->getCompany()->getFooter()->getFile().
                                        //" -resize 30% ". 
                                      //  ($signature->getCanvas()->getWidth()||$signature->getCanvas()->getHeight()?" -resize ".$signature->getCanvas()->getWidth()."x".$signature->getCanvas()->getHeight():"").
                                       // " -transparent white ".
                                       // " -page a4+".$signature->getCanvas()->getX1()."+".$signature->getCanvas()->getY1().
                                       // " -quality 75 ".
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
             if ($this->getPreMeetingDocument()->getContract()->getCompany()->hasHeader())
            {                                   
                // A4 = 595 x 842                                                       
                foreach ($this->getDocument()->getModel()->getOptions()->getHeaderCompany()->byPages() as  $signatures)
                {         
                    foreach ($signatures as $signature)
                    {
                    $convert= new SystemImageMagick();    
                  //  var_dump($signature->getCanvas()->getX1(),$signature->getCanvas()->getY1()); die(__METHOD__);
                       // convert cee.pdf -resize 50% -transparent white -page a4+180+80 -quality 75 cee1.pdf
                    $convert->addOption($this->getPreMeetingDocument()->getContract()->getCompany()->getHeader()->getFile().
                                        //" -resize 30% ". 
                                       // ($signature->getCanvas()->getWidth()||$signature->getCanvas()->getHeight()?" -resize ".$signature->getCanvas()->getWidth()."x".$signature->getCanvas()->getHeight():"").
                                       // " -transparent white ".
                                      //  " -page a4+".$signature->getCanvas()->getX1()."+".$signature->getCanvas()->getY1().
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
                                     //   " -transparent white ".
                                     //   " -page a4+".$signature->getCanvas()->getX1()."+".$signature->getCanvas()->getY1().
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
                                      //  ($signature->getCanvas()->getWidth()||$signature->getCanvas()->getHeight()?" -resize ".$signature->getCanvas()->getWidth()."x".$signature->getCanvas()->getHeight():"").
                                      //  " -transparent white ".
                                      //  " -page a4+".$signature->getCanvas()->getX1()."+".$signature->getCanvas()->getY1().
                                         " -quality 100 ".
                                        " -units PixelsPerInch -density 300 ".
                                        $this->getSignaturesDirectory()."/company/tmp_footer_".$signature->getID().".pdf");
                  //   $convert->debug();
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
                                      //  " -page a4+".$signature->getCanvas()->getX1()."+".$signature->getCanvas()->getY1().
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
        
         if ($this->getPreMeetingDocument()->getContract()->hasPartnerLayer())
        {            
            if ($this->getPreMeetingDocument()->getContract()->getPartnerLayer()->hasLogo())
            {                               
                // A4 = 595 x 842                
                foreach ($this->getDocument()->getModel()->getOptions()->getLayer()->byPages() as  $signatures)
                {
                      foreach ($signatures as $signature)
                    {
                  //  var_dump($this->getPreMeetingDocument()->getContract()->getPartnerLayer()->getLogo()->getFile());  die(__METHOD__);
                    $convert= new SystemImageMagick();    
                  //  var_dump($signature->getCanvas()->getX1(),$signature->getCanvas()->getY1()); die(__METHOD__);
                       // convert cee.pdf -resize 50% -transparent white -page a4+180+80 -quality 75 cee1.pdf
                    $convert->addOption($this->getPreMeetingDocument()->getContract()->getPartnerLayer()->getLogo()->getFile().
                                      //  " -resize 30% -transparent white ".
                                       // " -page a4+".$signature->getCanvas()->getX1()."+".$signature->getCanvas()->getY1().
                                         " -quality 100 ".
                                        " -units PixelsPerInch -density 300 ".
                                        $this->getSignaturesDirectory()."/layer/tmp_".$signature->getID().".pdf");
                  //  $convert->debug();
                    $convert->convert();
                    
                       $jam = new SystemPdfJam();
                        $jam->addOption(" --paper 'a4paper' ".
                                    " --scale ".$signature->getCanvas()->getRatio(). 
                                    " --offset '".$signature->getCanvas()->getX()."cm ".$signature->getCanvas()->getY()."cm' ".                                    
                                     $this->getSignaturesDirectory()."/layery/tmp_".$signature->getID().".pdf".
                                     " --outfile ". $this->getSignaturesDirectory()."/layer/".$signature->getID().".pdf"
                                      );
                        // $jam->debug();
                        $jam->execute(); 
                    }
                }
            }
        }   
                                
        // apply stamp on each page on signatures      
         if ($this->getPreMeetingDocument()->getContract()->hasPolluter())
        {
            if ($this->getPreMeetingDocument()->getContract()->getPolluter()->hasLogo())
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
        
        if ($this->getPreMeetingDocument()->getContract()->hasCompany())
        {                                   
            if ($this->getPreMeetingDocument()->getContract()->getCompany()->hasPicture())
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
             if ($this->getPreMeetingDocument()->getContract()->getCompany()->hasHeader())
            { 
                foreach ($this->getDocument()->getModel()->getOptions()->getHeaderCompany()->byPages() as $signatures)
                 {
                     foreach ($signatures as $signature)
                    {
                      $pdftk=new SystemPdftk(); // // pdftk in.pdf stamp cee1.pdf  output out.pdf
                      $pdftk->addFile((string)$this->getPagesDirectory()."/".$signature->getPage().".pdf");
                      $pdftk->addOption("stamp ".$this->getSignaturesDirectory()."/company/foorter_".$signature->getID().".pdf");  
                      $pdftk->setOutput($this->getOutputDirectory()."/pages/".$signature->getPage().".pdf");
                   //   $pdftk->debug();
                      $pdftk->execute();

                      $file= new File($this->getOutputDirectory()."/pages/".$signature->getPage().".pdf");
                      $file->copy((string)$this->getPagesDirectory());
                    }
                 }   
            } 
            if ($this->getPreMeetingDocument()->getContract()->getCompany()->hasFooter())
            { 
                foreach ($this->getDocument()->getModel()->getOptions()->getFooterCompany()->byPages() as $signatures)
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
          
        if ($this->getPreMeetingDocument()->getContract()->hasPartnerLayer())
        {            
            if ($this->getPreMeetingDocument()->getContract()->getPartnerLayer()->hasLogo())
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
     
         if (mfContext::getInstance()->getUser()->hasCredential(array(array('superadmin_debug'))) && mfContext::getInstance()->getRequest()->getGetParameter('debug')=="files")
        {
            echo "<pre>"; 
            var_dump($this->files->toArray());           
            die();
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
        return $this->getPreMeetingDocument()->getName();
    }
    
    function getFilename()
    {
        if ($this->getDocument()->getModel()->getOptions()->isEmpty())
           return $this->getPreMeetingDocument()->getFilename(); 
        return (string)$this->getDirectory()."/output.pdf";
    }
}
