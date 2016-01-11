<?xml version="1.0" encoding="UTF-8"?>

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
      <xsl:apply-templates select="//page"/>
    </wml>
  </xsl:template>

	<xsl:template match="page">      
		<card>
			<xsl:attribute name="id">
				<xsl:value-of select="id" />
			</xsl:attribute>

		 <p><b><xsl:value-of select="pageTitle"/></b></p>
		 <p><i><xsl:value-of select="starteventdate" /> <xsl:text> - </xsl:text> <xsl:value-of select="endeventdate" /></i></p>
		 <p><xsl:value-of select="pageCont" /></p>

		 <p>
			<xsl:if test="preceding-sibling::*[position()=1]">
				<anchor>
					prev
					<prev />
				</anchor>
			</xsl:if>
		 </p>

		 <p>
		 	<xsl:if test="position()!=last()">
			 	<anchor>
			 		next
			 		<go href="#{following-sibling::*/id}"/>
			 	</anchor>
		 	</xsl:if>
		 </p>

		</card>
  </xsl:template>

  <xsl:template match="*"/>

</xsl:stylesheet>


