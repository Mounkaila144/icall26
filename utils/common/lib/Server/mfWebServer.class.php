<?php


 class mfWebServer extends mfServer {

   protected static $instance=null;
   
   protected $context=null;
   
   static function getInstance($parameters = array(), $attributes = array(), $options = array())
   {
       if (self::$instance===null)
           self::$instance=new self($parameters, $attributes , $options);           
       return self::$instance;       
   }
   
   
  public function __construct($context,$parameters = array(), $attributes = array(), $options = array())
  {
    $this->context=$context;
    $this->initialize( $_SERVER, $attributes, $options);
  }
  
  function getContext()
  {
      return $this->context;
  }

   function getSoftware()
   {
       return $this->getParameter('SERVER_SOFTWARE');
   }
   
   function getProtocol()
   {
       return $this->getParameter('SERVER_PROTOCOL');
   }
   
   function getScheme()
   {
       return $this->getParameter('REQUEST_SCHEME');
   }
   
   function getIP()
   {
       return $this->getParameter('SERVER_ADDR');
   }
   
   function getPort()
   {
       return $this->getParameter('SERVER_PORT');
   }     
   
   function getName()
   {
       return $this->getParameter('SERVER_NAME');
   }
   
   function getDocumentRoot()
   {
       return $this->getParameter('DOCUMENT_ROOT');
   }
   
   function getAdmin()
   {
       return $this->getParameter('SERVER_ADMIN');
   }
   
    function getSignature()
   {
       return $this->getParameter('SERVER_SIGNATURE');
   }
   
   function getPhpVersion()
   {
       return $this->getParameter('PHP_VER');
   }   
   
   function getScriptName()
   {
       return $this->getParameter('SCRIPT_NAME');
   }
}

