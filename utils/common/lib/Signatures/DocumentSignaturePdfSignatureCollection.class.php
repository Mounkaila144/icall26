<?php


class  DocumentSignaturePdfCollection extends mfArray {
    
    protected $pages=null,$by_pages=null;
    
      function __construct($data = null) {
          if ($data==null)
              return ;
          foreach (explode(";",$data) as $value)         
              $this[]=new DocumentSignaturePdf($value);          
      }
   
      
      function getPages()
      {
          if ($this->pages===null)
          {
              $this->pages=new mfArray();
              foreach ($this as $item)
                  $this->pages[]=$item->getPage();
          }   
          return $this->pages;
      }
      
      function byPages()
      {
          if ($this->by_pages===null)
          {
              $this->by_pages=new mfArray();
              foreach ($this as $signature)
              {
                  if (!isset($this->by_pages[$signature->getPage()]))
                     $this->by_pages[$signature->getPage()]=new DocumentSignaturePdfCollection();
                  $this->by_pages[$signature->getPage()]->push($signature);
              }    
          }   
          return $this->by_pages;
      }
}
