<?php

class sFtp
{
    private $stream;
    private $sftp;
    protected $errors=null;

	
        function hasErrors()
        {
            return !$this->errors->isEmpty();
        }
        
        function getErrors()
        {
            return $this->errors;
        }
     
        function getHost()
    {
        return $this->host;
    }
    
    function getPort()
    {
        return $this->port;
    }
    
    public function __construct($host, $port=2666)
    {
        $this->errors=new mfArray();
         $this->host=$host;
        $this->port=$port;     
    }
    
    
    function connect()
    {
        $this->stream = @ssh2_connect($this->host, $this->port);
        return $this->stream;
    }

    function getSFtp()
    {
        return $this->sftp;
    }
    
    public function login($username, $password)
    {
        if (! @ssh2_auth_password($this->stream, $username, $password))
        {        
           $this->errors[]="Could not authenticate with username ".$username." and password ".$password;        
           return false;
        }           
        if (!$this->sftp=@ssh2_sftp($this->stream))
        {    
            $this->errors[]="Could not initialize SFTP subsystem.";
            return false;
        }    
        return $this;
    }

    public function upload($local_file)
    {
        $sftp = $this->sftp;
        $stream = @fopen("ssh2.sftp://$sftp$remote_file", 'r');


        if (! $stream)
            throw new Exception("Could not open file: $remote_file");

        $data_to_send = @file_get_contents($local_file);
        if ($data_to_send === false)
            throw new Exception("Could not open local file: $local_file.");

        if (@fwrite($stream, $data_to_send) === false)
            throw new Exception("Could not send data from file: $local_file.");
        
        $fred = @fread($stream, filesize('ssh2.sftp://' . intval($sftp) . '/page22.html') );
        echo $fred ;

        @fclose($stream);
    }
    
	
    public function mkdir($directory)
    {
     
		return $this;	 
    }
	
	function rmdir($directory)
	{
		
		return $this;
	}
	
	function rm($file)
	{
		
		return $this;
	}
	
	function unlink()
	{
		return $this;
	}
	
	function link($link)
	{
		return $this;
	}
	
	public function rename($name)
    {
       
	   return $this;
    }
	
	public function download($file)
	{
		
		return $this;
	}
	
	public function chdir($name)
    {
       
	   return $this;
    }
	
	public function chmod($name)
    {
       
	   return $this;
    }
	
	public function glob($pattern)
    {
       
	   return $this;
    }
	
	public function getFiles()
    {
       
	   return $this;
    }
	
	public function getDirectories()
    {
       
	   return $this;
    }
	
	function close()
	{
		
		return $this;
	}
	
	function disconnect()
	{
		
		return $this;
	}
        
        function hasStream()
    {
        return $this->stream;
    }
    
    
    function opendir($directory="/.")
    {
         $this->dh=opendir("ssh2.sftp://".intval($this->sftp).$directory);       
         return $this;
    }
    
    
    
    function readdir()
    {
        return readdir($this->dh);
    }
    
    function rawlist($directory="/")
    {
        $list=new sFtpItemCollection();           
        $directory=in_array($directory,array('/',''))?"/.":$directory;           
        $this->opendir($directory);           
       if ($this->dh===false)
            return $list;
        while (($file = $this->readdir()) !== false) {                   
             if (in_array($file,array('.','..')))
                  continue;               
             $list[]=new SFtpItem($this->getSFtp(),$file,$directory);            
       } 
        return $list;
    }
        
    
     public function __call($func,$a){        
        if(function_exists("ssh2_".$func)){
            array_unshift($a,$this->stream);
            return call_user_func_array("ssh2_".$func,$a);
        }
        throw new mfException('class '.get_class($this).' => Method ' . $func . ' not exists.');
    } 
}



