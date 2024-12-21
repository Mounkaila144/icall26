<?php

class mfWebRequest extends mfRequest {
  
    
  function __construct($parameters = array(), $attributes = array(), $options = array());
  
  function initialize($parameters = array(), $attributes = array(), $options = array());
  
  public function getUserAgent();
  public function getHost();
  public function getLanguages();
  public function splitHttpAcceptHeader($header); 
  public function getPathInfo($prefix="");
  public function setCulture($langue);
  public function getURI();
  public function getPartialURI();
  public function getURIExtension();
  public function addRequestParameters($parameters);
  public function addRequestParameter($name,$value);
  public function getRequestParameter($name, $default = null);
  public function getRequestParameters();
   public function getPreferredCulture(array $cultures = null);
  public function getPreferredLanguage();
  public function getPreferredCountry();
  public function getCountry();
  function getForcedCulture();
  function getCulture();
  function isCultureForced();
  public function getGetParameter($name, $default = null);
   public function getGetParameters();
  public function getPostParameter($name, $default = null);
  public function getPostParameters();
   public function isXmlHttpRequest();
  public function forceXMLRequest();
  public function isSecure();  
  protected function isForwardedSecure();
   public function getRequestContext();
  public function getReferer();
  public function getRefererWithoutHost();
  public function getHttpHeader($name, $prefix = 'http');
  public function getFiles($key = null);  
  public function getContentType($trim = true);
   public function getCookie($name, $defaultValue = null);
  public function getIP();
  public function getAction();
  public function getUriPrefix();
  public function getPartialReferer();
  public function isLocalHost();
  public function getGetParametersForURL();
        
}