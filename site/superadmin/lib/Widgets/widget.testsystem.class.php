<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of smartylang
 *
 * @author fred
 */
class widgetTestSystem {
    
    protected $adresse;
    
    public $adresse2='mon adresse n°2';
    
    function set($value)
    {
        $this->adresse=$value;
    }
    
    function get()
    {
        return $this->adresse;
    }
    
    function __toString()
    {
        return "[*".$this->adresse."*]";
    }
    
    function voir()
    {
        $this->adresse="[<<====".$this->adresse."====]";
       // var_dump($this);
        return $this;
    }
    
    function test()
    {
        return "test bon 125689";
    }
}
