<xsl:stylesheet version="1.0" xmlns:w="http://schemas.microsoft.com/office/word/2003/wordml" xmlns:aml="http://schemas.microsoft.com/aml/2001/core" xmlns:wpc="http://schemas.microsoft.com/office/word/2010/wordprocessingCanvas" xmlns:dt="uuid:C2F41010-65B3-11d1-A29F-00AA00C14882" xmlns:mo="http://schemas.microsoft.com/office/mac/office/2008/main" xmlns:mc="http://schemas.openxmlformats.org/markup-compatibility/2006" xmlns:mv="urn:schemas-microsoft-com:mac:vml" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w10="urn:schemas-microsoft-com:office:word" xmlns:wx="http://schemas.microsoft.com/office/word/2003/auxHint" xmlns:wne="http://schemas.microsoft.com/office/word/2006/wordml" xmlns:wsp="http://schemas.microsoft.com/office/word/2003/wordml/sp2" xmlns:sl="http://schemas.microsoft.com/schemaLibrary/2003/core" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet" xmlns:html="http://www.w3.org/TR/REC-html40" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:template match="/">
	<w:wordDocument>
		<w:body>
			<xsl:apply-templates />
		</w:body>
	</w:wordDocument>
</xsl:template>

<xsl:template match="page">
	<w:p w:rsidR="004A00C6" w:rsidRDefault="00A92946" w:rsidP="00A92946">
		<w:pPr>
			<wx:font wx:val="Times New Roman"/>
        	<w:sz w:val="24"/>
        	<w:sz-cs w:val="24"/>
			<w:pStyle w:val="Heading1"/>
			</w:pPr>
			<w:bookmarkStart w:id="0" w:name="_GoBack"/>
			<w:bookmarkEnd w:id="0"/>
			<w:r>
				<w:t><xsl:value-of select="pageTitle" /></w:t>
			</w:r>
		</w:p>

		<w:p w:rsidR="00A92946" w:rsidRDefault="00A92946"/>
			<w:p w:rsidR="00A92946" w:rsidRDefault="00A92946" w:rsidP="00A92946">
				<w:pPr>
					<w:pStyle w:val="Heading2"/>
				</w:pPr>
				<w:r>
					<w:t>
						<xsl:value-of select="starteventdate" />
						<xsl:text> - </xsl:text>
						<xsl:value-of select="endeventdate" />
					</w:t>
				</w:r>
		</w:p>

		<w:p w:rsidR="00A92946" w:rsidRDefault="00A92946" w:rsidP="00A92946"/>
			<w:p w:rsidR="00A92946" w:rsidRPr="00A92946" w:rsidRDefault="00A92946" w:rsidP="00A92946">
				<w:r>
					<w:t><xsl:value-of select="pageCont" /></w:t>
				</w:r>
			</w:p>
</xsl:template>
</xsl:stylesheet>