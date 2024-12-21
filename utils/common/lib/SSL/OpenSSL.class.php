<?php


class OpenSSL {
   
    protected $public_key=null,$public_key_file=null,$private_key=null,$private_key_file=null,$passphrase="",$options=array();
     
    function __construct($options=array()) { //$private_key_file=null,$public_key_file=null,$passphrase="") {
      $this->setOptions(array_merge($options,array('digest_alg'=>'sha512', 
                                                   "private_key_bits" => 1024,                                  
                                                   "private_key_type" => OPENSSL_KEYTYPE_RSA)));
     //   $this->passphrase=$passphrase;
      /*  $this->private_key_file=new File($private_key_file);
        if (!$this->private_key_file->isExist())        
            throw new mfException(__('File is not exist'));
        $this->private_key=openssl_pkey_get_private($this->private_key_file->getContent(),$passphrase);     */  
      /*  $this->public_key_file=new File($public_key_file);
        if (!$this->public_key_file->isExist())
             throw new mfException(__('File is not exist'));
        $this->public_key=openssl_pkey_get_public($this->public_key_file->getContent());*/
    }
       
   /* function generatePrivateKey($passphrase)
    {
        $this->passphrase=$passphrase;
        $this->private_key=openssl_pkey_get_private($this->private_key_file->getContent(),$passphrase);      
        return $this;
    }*/
    
    function setPrivateKeyFromFile($private_key_file,$passphrase)
    {
         $this->private_key_file=new File($private_key_file);
        if (!$this->private_key_file->isExist())        
            throw new mfException(__('File is not exist'));
        $this->private_key=openssl_pkey_get_private($this->private_key_file->getContent(),$passphrase); 
        return $this;
    }
    
    function setPublicKeyFromFile($public_key_file)
    {
         $this->public_key_file=new File($public_key_file);
        if (!$this->public_key_file->isExist())
             throw new mfException(__('File is not exist'));
        $this->public_key=openssl_pkey_get_public($this->public_key_file->getContent());
        return $this;
    }
    
    protected static function exportPrivateKey($config,$private_file,$passphrase)
    {
       $file=new File($private_file);
       if (strtoupper(substr(PHP_OS, 0, 3))==='WIN')
       {                   
            $config['config']="C:/wamp/bin/apache/apache2.4.4/conf/openssl.cnf";
          //    $config['config']="c:/usr/local/ssl/openssl.cnf";
       }   
       $private_key=openssl_pkey_new($config);      
       openssl_pkey_export_to_file($private_key,$file->getFile(),$passphrase,$config); 
       return $private_key;
    }
    
   /* static function exportKeys($config,$private_file,$public_file,$passphrase)
    {       
       $file=new File($public_file);
       $key_details = openssl_pkey_get_details(self:: exportPrivateKey($config,$private_file,$passphrase));
       $file->putContent($key_details['key']);              
    }  */      
    
    function setPublicKeyFile($file)
    {
        $this->public_key_file=$file;
        return $this;
    }        
             
    
    function setPrivateKey($key,$passphrase)
    {
        $this->private_key=openssl_pkey_get_private($key,$passphrase); 
        return $this;
    }
    
    function setPublicKey($key)
    {
        $this->public_key=openssl_pkey_get_public($key); 
        return $this;
    }
    
    function getPrivateKey()
    {
        return $this->private_key;
    }
    
     function getPublicKey()
    {
        return $this->public_key;        
    }
    
     function setPrivateKeyFile($file)
    {
        $this->private_key_file=$file;
    }
    
    function encryptFromPrivate($data)
    {
       $encrypt="";     
        openssl_private_encrypt($data,$encrypt,$this->private_key);
        return $encrypt;
    }
    
     function encryptFromPublic($data)
    {
       $encrypt="";
        openssl_public_encrypt($data,$encrypt,$this->public_key);      
        return $encrypt;
    }
    
    function decryptFromPublic($data)
    {
        $decrypt="";     
         openssl_public_decrypt($data,$decrypt,$this->public_key);        
        return $decrypt;
    }
    
    function decryptFromPrivate($data)
    {
        $decrypt="";
        openssl_private_decrypt($data,$decrypt,$this->private_key);       
        return $decrypt;
    }
    
    function setOptions($options)
    {
        $this->options=$options;
        return $this;
    }
    
    function getOptions()
    {
        return $this->options;
    }
    
    function getConfigs()
    {
       $config=$this->getOptions();
       if (strtoupper(substr(PHP_OS, 0, 3))==='WIN')
          $config['config']="C:/wamp/bin/apache/apache2.4.18/conf/openssl.cnf";
       return $config;
    }
    
    function generateKeysExportToFile($private_file,$public_file,$passphrase)
    {
       $file_pv=new File($private_file);     
       $private_key=openssl_pkey_new($this->getConfigs());      
       openssl_pkey_export_to_file($private_key,$file_pv->getFile(),$passphrase,$this->getConfigs()); 
       
       $file_pu=new File($public_file);
       $key_details = openssl_pkey_get_details($private_key);
       $file_pu->putContent($key_details['key']);   
       return $this;
    }
    
    function generateKeys($passphrase)
    {      
       $private_key=openssl_pkey_new($this->getConfigs());             
       openssl_pkey_export($private_key,$this->private_key,$passphrase,$this->getConfigs());              
       $key_details = openssl_pkey_get_details($private_key);
       $this->public_key=$key_details['key'];   
       return $this;
    }
    
    
   /* function 
    {
        openssl_cipher_iv_length
    }*/
}


