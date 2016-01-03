<?xml version="1.0"?>

<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
	<xsl:template match="site">
		<html>
			<head>
				<title>Vgurra</title>
			</head>

			<body>
				<h2>Education</h2>
				<xsl:apply-templates select="//post[@category = 'education']" />

				<h2>Work</h2>
				<xsl:apply-templates select="//post[@category = 'employment']" />
			</body>
		</html>
	</xsl:template>

	<xsl:template match="post">
		<h3><xsl:value-of select="name" /></h3>
		<p><xsl:value-of select="description" /></p>
		<p><a><xsl:value-of select="link" /></a></p>
	</xsl:template>

</xsl:stylesheet>