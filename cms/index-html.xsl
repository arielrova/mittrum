<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
                version="1.0">
<xsl:output indent="yes" method="html"/>
<xsl:template match="/">
   <html>
     <link rel="stylesheet" type="text/css" href="page.css"/>
     <head>
       <title><xsl:value-of select="site/siteTitle"/></title>
     </head>
      <h1><xsl:value-of select="site/siteTitle"/></h1>
     <body>
         <div style="display:flex;justify-content:center;align-items:center;">
           <div style="width:100px;height:100px;">
             <xsl:apply-templates match="site" />
             <!-- Facebook like & share -->
             <script language="javascript">
           window.fbAsyncInit = function() {
             FB.init({
               appId      : '929169097205196',
               xfbml      : true,
               version    : 'v2.5'
             });
           };

           (function(d, s, id){
              var js, fjs = d.getElementsByTagName(s)[0];
              if (d.getElementById(id)) {return;}
              js = d.createElement(s); js.id = id;
              js.src = "//connect.facebook.net/en_US/sdk.js";
              fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));

            FB.ui({
              method: 'share',
              href: 'https://developers.facebook.com/docs/',
            }, function(response){});
             </script>
            <div class="fb-like"
              data-share="true"
              data-width="450"
              data-show-faces="true">
            </div>
            <!-- Facebook like & share -->
        </div>
      </div>
     </body>
     <footer>
     </footer>
   </html>
</xsl:template>
<xsl:template match="site">
  <xsl:for-each select="//page">
    <xsl:sort select="starteventdate" />
     <div class="card">
        <div class="pageTitle">
          <xsl:value-of select="pageTitle"/>
        </div>
        <div class="pageCont">
          <xsl:value-of select="pageCont"/>
        </div>
        <div class="date">
          <xsl:value-of select="starteventdate" /><xsl:text> to </xsl:text><xsl:value-of select="endeventdate" />
        </div>
        <br />
      </div>
    </xsl:for-each>
</xsl:template>

</xsl:stylesheet>