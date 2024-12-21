<?php

//http://www.ecosol0.net/superadmin/system/resources/admin/PdftkMultiTest

class system_resources_PdftkMultiTestAction extends mfAction {
    
       
    function execute(mfWebRequest $request)
    {
         echo __METHOD__;
           
         $pdf=new SystemPdftk();
         $pdf->addFile(__DIR__."/../data/pdftk/multiple/1.pdf")
          ->addFile(__DIR__."/../data/pdftk/multiple/2.pdf")
          ->addFile(__DIR__."/../data/pdftk/multiple/3.pdf")
          ->addFile(__DIR__."/../data/pdftk/multiple/4.pdf")
          ->setOutput(__DIR__."/../data/pdftk/output.pdf")
       //   ->debug()
          ->execute();
       //  $pdf=new SystemPdftk(); //array('fill_form'),array('flatten'));
      /*   $pdf->addFile(__DIR__."/../data/pdftk/src.pdf");
         $pdf->setXMlDataFileForForm(__DIR__."/../data/pdftk/fdf.xml");
         $pdf->setOutput(__DIR__."/../data/pdftk/output.pdf");
         $pdf->execute();*/
       //  echo $pdf->getVersion();
         die();
         return mfView::NONE;
    }
    
}

