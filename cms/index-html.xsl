<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
                version="1.0">
<xsl:output indent="yes" method="html"/>
<xsl:template match="/">
   <html>
     <head>
       <title>Mitt rum</title>
     </head>
     <body>
       <table border="1">
          <xsl:apply-templates select="//page"/>
       </table>
     </body>
   </html>
</xsl:template>

<xsl:template match="page">
          <xsl:value-of select="pageTitle"/>
          <xsl:value-of select="pageCont"/>
          <br />
</xsl:template>

</xsl:stylesheet>