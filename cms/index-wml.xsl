<?xml version="1.0"?>

   <xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
                xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
                xmlns:rss="http://purl.org/rss/1.0/"
                version="1.0"
		exclude-result-prefixes="xsl rdf rss">
   
<xsl:output method="xml" 
	doctype-public="-//WAPFORUM//DTD WML 1.1//EN" 
	media-type="text/vnd.wap.wml" 
	doctype-system="http://www.wapforum.org/DTD/wml_1.1.xml" 
	indent="yes" /> 
	
  <xsl:template match="/">
    <wml>
      <xsl:apply-templates select="//word"/>
    </wml>
  </xsl:template>

	<xsl:template match="word">      
		<card id="{generate-id(finnish)}" title="Finnish">
			 <p><xsl:value-of select="finnish"/></p>
			 <p>
			     <xsl:if test="preceding-sibling::word[position()=1]">
			         <anchor>
			             prev
			             <go href="#{generate-id(preceding-sibling::word[position()=1]/child::swedish)}"/>
			         </anchor>
			     </xsl:if>
			     |
			     <anchor>
			         next
			         <go href="#{generate-id(swedish)}"/>
			     </anchor>
			 </p>
		</card>
		<card id="{generate-id(swedish)}" title="Swedish">
			 <p><xsl:value-of select="swedish"/></p>
			 <p>
			     <anchor>
			         prev
			         <go href="#{generate-id(finnish)}"/>
			     </anchor> 
			     | 
			     <xsl:if test="following-sibling::word[position()=1]">
    			     <anchor>
	       		         next
			              <go href="#{generate-id(following-sibling::word[position()=1]/child::finnish)}"/>
			         </anchor>
			     </xsl:if>
			     
			 </p>
		</card>
  </xsl:template>

  <xsl:template match="*"/>

</xsl:stylesheet>


