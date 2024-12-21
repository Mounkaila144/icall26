<?php


class MicrosoftDocxExtractor  {
   
    protected $options=null,$file=null,$output=null;
    function __construct(File $file,File $output=null,File $output_text=null,$options=array())
    {
        $this->file=$file;       
        if ($output===null && $file!=null)      
            $this->output=new File($file->getDirectory()."/docx/output.txt");
        else
        {                
            $this->output=$output;
        }    
        if ($this->output)
            mfFileSystem::mkdirs($this->output->getDirectory());           
       $this->output_text=($output_text===null)?new File($this->getOutput()->getDirectory()."/text.txt"):$output_text;
       if ($this->output_text)
            mfFileSystem::mkdirs($this->output_text->getDirectory());  
       $this->output_custom_xml=new File($this->getOutput()->getDirectory()."/custom.txt");    
       $this->options= new mfArray($options);     
       $this->errors=new mfArray();      
    }
    
    function getFile()
    {
        return $this->file;
    }
    
    function getOutput()
    {
        return $this->output;
    }
    
    function getPictures()
    {
        if ($this->pictures===null)
        {
            $this->pictures=new mfArray();
            foreach (glob($this->getOutput()->getDirectory()."/word/media/*") as $img)
                $this->pictures[]=basename($img); 
        }   
        return $this->pictures;
    }
    
    function getDirectoryPictures()
    {
        return $this->getOutput()->getDirectory()."/word/media";
    }
    
    function getTextFile()
    {
        return $this->output_text;
    }
    
    function getText()
    {       
        if ($this->text===null)
        {    
            $this->text="";
            $dom = new DOMDocument( '1.0', 'utf-8' );        
            if ($dom->load( $this->getOutput()->getDirectory()."/word/document.xml")===false)
            {           
                    return false;
            }        
            for($i = 0, $list = $dom->getElementsByTagNameNS( '*', 't' ); $i < $list->length; $i++ )
            {                
                    $this->text.= $list->item($i)->nodeValue;               
            }
            if ($this->getOption('text',false))
            {                                     
                file_put_contents($this->getTextFile()->getFile(), $this->text);
            }    
        }
        return $this->text;
    }
    
     function getCustomXMLFile()
    {
        return $this->output_custom_xml;
    }
    
    function getCustomXML()
    {
        if ($this->custom_xml===null)
        {    
            $this->custom_xml=new mfArray();
            $dom = new DOMDocument( '1.0', 'utf-8' );                  
            if ($dom->load( $this->getOutput()->getDirectory()."/docProps/custom.xml")===false)
            {           
               return $this->custom_xml;
            }                             
            for($i = 0, $list = $dom->getElementsByTagName( 'property' ); $i < $list->length; $i++ )
            {                
                 if ($i == 0) 
                   continue ;
                 $this->custom_xml[]=$list->item($i)->getAttribute('name');
            }                       
            if ($this->getOption('custom',false))
            {                                     
                file_put_contents($this->getCustomXMLFile()->getFile(), $this->custom_xml->implode("\n"));
            }    
        }
        return $this->custom_xml;
    }
    
    function getDocumentRelationsXML()
    {
        
        if ($this->document_relations_xml===null)
        {    
            $this->document_relations_xml=new mfArray();
            $dom = new DOMDocument('1.0', 'utf-8' );                             
            if ($dom->load( $this->getOutput()->getDirectory()."/word/_rels/document.xml.rels")===false)               
               return $this->document_relations_xml;                      
            $xpath=new DOMXPath($dom);
            $xpath->registerNamespace('r', 'http://schemas.openxmlformats.org/package/2006/relationships');
            foreach ($xpath->query("/r:Relationships/r:Relationship[contains(@Type,'image')]") as $node)             
                 $this->document_relations_xml[]=$node->getAttribute('Target');            
        }
        return $this->document_relations_xml;
    }
    
    function execute()
    {
        $zip = new ZipArchive();
	$zip_result = $zip->open( $this->getFile()->getFile());
        if ( $zip_result !== true )
            return false;       
        $zip->extractTo($this->getOutput()->getDirectory());
        $zip->close();
        return $this;
    }
    
    function getOption($name,$default=null)
    {
        return isset($this->options[$name])?$this->options[$name]:$default;
    }
}

