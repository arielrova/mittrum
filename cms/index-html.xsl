<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
                version="1.0">
<xsl:output indent="yes" method="html"/>
<xsl:template match="/">
   <html>
     <link rel="stylesheet" type="text/css" href="page.css"/>
     <head>
       <title>Mitt rum</title>
     </head>
      <h1>Mitt rum</h1>
     <body>
         <div style="display:flex;justify-content:center;align-items:center;">
           <div style="width:100px;height:100px;">
             <xsl:apply-templates match="site" />
        </div>
      </div>
     </body>
   </html>
</xsl:template>
<!-- Bygga in funktionalitet för att hantera tidslinje
-->
<xsl:template match="site">
  <xsl:for-each select="//page">
    <xsl:sort select="starteventdate" />
     <div class="card">
        <div class="pageTitle">
          <strong><xsl:value-of select="pageTitle"/></strong>
        </div>
        <div class="pageCont">
          <xsl:value-of select="pageCont"/>
        </div>
        <div>
          <xsl:text> StartDate  </xsl:text>
          <br />
          <xsl:value-of select="starteventdate" />
          <br />
          <xsl:text> EndDate  </xsl:text>
          <br />
          <xsl:value-of select="endeventdate" />
        </div>
        <br />
      </div>
    </xsl:for-each>
</xsl:template>

</xsl:stylesheet>