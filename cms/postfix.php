<?php
//put XML content in a string
$xmlstr=ob_get_contents();
ob_end_clean(); 

// Load the XML string into a DOMDocument
$xml = new DOMDocument;
$xml->loadXML($xmlstr);

// Make a DOMDocument for the XSL stylesheet
$xsl = new DOMDocument;

$url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

if (strpos($url,'download') !== false) {
    header('Content-Type: text/doc');
    header('Content-Disposition: attachment; filename=myroom.doc');
    header('Pragma: no-cache');

    $xmlDocument = new DOMDocument();
    $xmlDocument->$xmlstr;

    $xsl = new DOMdocument();
    $xsl->load("document.xsl");

    $proc = new XSLTProcessor;
    $proc->importStyleSheet($xsl); 
} else {
   
  // See which user agent is connecting
  $UA = getenv('HTTP_USER_AGENT');
  if (ereg("Symbian", $UA) | ereg("Opera", $UA) | ereg("Motorola", $UA) | ereg("Nokia", $UA) | ereg("Siemens", $UA) | ereg("Samsung", $UA) | ereg("Ericsson", $UA) | ereg("LG", $UA) | ereg("NEC", $UA) |ereg("SEC", $UA) |ereg("MIDP", $UA) | ereg("Windows CE", $UA)) 
    {
      // if a mobile phone, use a wml stylesheet and set appropriate MIME type
      header("Content-type:text/vnd.wap.wml");
      $xsl->load('index-wml.xsl');
    } else {
      // if not a mobile phone, use a html stylesheet
      header("Content-type:text/html");
      $xsl->load('index-html.xsl');
      //WML TEST below
      //header("Content-type:text/vnd.wap.wml");
      //$xsl->load('index-wml.xsl');
    }
  }

$proc = new XSLTProcessor;
$proc->importStyleSheet($xsl);  
echo $proc->transformToXML($xml);
?>
