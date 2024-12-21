<?php

//http://www.ecosol0.net/superadmin/system/resources/admin/PdftkTest

class system_resources_PdftkTestAction extends mfAction {
    
       
    function execute(mfWebRequest $request)
    {
         echo __METHOD__;
                
         
         $pdf=new SystemPdftk(); //array('fill_form'),array('flatten'));
      /*   $pdf->addFile(__DIR__."/../data/pdftk/src.pdf");
         $pdf->setXMlDataFileForForm(__DIR__."/../data/pdftk/fdf.xml");
         $pdf->setOutput(__DIR__."/../data/pdftk/output.pdf");
         $pdf->execute();*/
         echo $pdf->getVersion();
         
         return mfView::NONE;
    }
    
}

