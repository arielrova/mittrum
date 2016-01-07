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
          <xsl:apply-templates select="//page"/>
        </div>
      </div>
     </body>
   </html>
</xsl:template>
<!-- Bygga in funktionalitet för att hantera tidslinje
-->


<xsl:template match="page">
  <div class="card">
        <div class="pageTitle">
          <strong><xsl:value-of select="pageTitle"/></strong>
        </div>
        <div class="pageCont">
          <xsl:value-of select="pageCont"/>
        </div>
        <br />
  </div>
</xsl:template>

</xsl:stylesheet>