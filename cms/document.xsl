<xsl:stylesheet version="1.0" xmlns:w="http://schemas.microsoft.com/office/word/2003/wordml" xmlns:aml="http://schemas.microsoft.com/aml/2001/core" xmlns:wpc="http://schemas.microsoft.com/office/word/2010/wordprocessingCanvas" xmlns:dt="uuid:C2F41010-65B3-11d1-A29F-00AA00C14882" xmlns:mo="http://schemas.microsoft.com/office/mac/office/2008/main" xmlns:mc="http://schemas.openxmlformats.org/markup-compatibility/2006" xmlns:mv="urn:schemas-microsoft-com:mac:vml" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w10="urn:schemas-microsoft-com:office:word" xmlns:wx="http://schemas.microsoft.com/office/word/2003/auxHint" xmlns:wne="http://schemas.microsoft.com/office/word/2006/wordml" xmlns:wsp="http://schemas.microsoft.com/office/word/2003/wordml/sp2" xmlns:sl="http://schemas.microsoft.com/schemaLibrary/2003/core" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet" xmlns:html="http://www.w3.org/TR/REC-html40" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:template match="/">
	<w:wordDocument xmlns:w="http://schemas.microsoft.com/office/word/2003/wordml" xmlns:wx="http://schemas.microsoft.com/office/word/2003/auxHint" xmlns:o="urn:schemas-microsoft-com:office:office" w:macrosPresent="no" w:embeddedObjPresent="no" w:ocxPresent="no" xml:space="preserve">
	    <w:fonts>
    <w:defaultFonts
       w:ascii="Times New Roman"
       w:fareast="Times New Roman"
       w:h-ansi="Times New Roman"
       w:cs="Times New Roman" />
  </w:fonts>
  <w:styles>
    <w:versionOfBuiltInStylenames w:val="4" />
    <w:latentStyles w:defLockedState="off" w:latentStyleCount="156" />
    <w:style w:type="paragraph" w:default="on" w:styleId="Normal">
      <w:name w:val="Normal" />
      <w:rPr>
        <wx:font wx:val="Times New Roman" />
        <w:sz w:val="24" />
        <w:sz-cs w:val="24" />
        <w:lang w:val="EN-US" w:fareast="EN-US" w:bidi="AR-SA" />
      </w:rPr>
    </w:style>
    <w:style w:type="paragraph" w:styleId="Heading1">
      <w:name w:val="heading 1" />
      <wx:uiName wx:val="Heading 1" />
      <w:basedOn w:val="Normal" />
      <w:next w:val="Normal" />
      <w:rsid w:val="00D93B94" />
      <w:pPr>
        <w:pStyle w:val="Heading1" />
        <w:keepNext />
        <w:spacing w:before="240" w:after="60" />
        <w:outlineLvl w:val="0" />
      </w:pPr>
      <w:rPr>
        <w:rFonts w:ascii="Arial" w:h-ansi="Arial" w:cs="Arial" />
        <wx:font wx:val="Arial" />
        <w:b />
        <w:b-cs />
        <w:kern w:val="32" />
        <w:sz w:val="32" />
        <w:sz-cs w:val="32" />
      </w:rPr>
    </w:style>
    <w:style w:type="character" w:default="on" w:styleId="DefaultParagraphFont">
      <w:name w:val="Default Paragraph Font" />
      <w:semiHidden />
    </w:style>
    <w:style w:type="table" w:default="on" w:styleId="TableNormal">
      <w:name w:val="Normal Table" />
      <wx:uiName wx:val="Table Normal" />
      <w:semiHidden />
      <w:rPr>
        <wx:font wx:val="Times New Roman" />
      </w:rPr>
      <w:tblPr>
        <w:tblInd w:w="0" w:type="dxa" />
        <w:tblCellMar>
          <w:top w:w="0" w:type="dxa" />
          <w:left w:w="108" w:type="dxa" />
          <w:bottom w:w="0" w:type="dxa" />
          <w:right w:w="108" w:type="dxa" />
        </w:tblCellMar>
      </w:tblPr>
    </w:style>
    <w:style w:type="list" w:default="on" w:styleId="NoList">
      <w:name w:val="No List" />
      <w:semiHidden />
    </w:style>
  </w:styles>
  <w:docPr>
    <w:view w:val="print" />
    <w:zoom w:percent="100" />
    <w:doNotEmbedSystemFonts />
    <w:proofState w:spelling="clean" w:grammar="clean" />
    <w:attachedTemplate w:val="" />
    <w:defaultTabStop w:val="720" />
    <w:punctuationKerning />
    <w:characterSpacingControl w:val="DontCompress" />
    <w:optimizeForBrowser />
    <w:validateAgainstSchema />
    <w:saveInvalidXML w:val="off" />
    <w:ignoreMixedContent w:val="off" />
    <w:alwaysShowPlaceholderText w:val="off" />
    <w:compat>
      <w:breakWrappedTables />
      <w:snapToGridInCell />
      <w:wrapTextWithPunct />
      <w:useAsianBreakRules />
      <w:dontGrowAutofit />
    </w:compat>
  </w:docPr>
		<w:body>
			<xsl:apply-templates />
		</w:body>
	</w:wordDocument>
</xsl:template>

<xsl:template match="page">
	<wx:sect>
		<w:p>
			<w:pPr>
				<w:pStyle w:val="Heading1" />
			</w:pPr>
				<w:r>
					<w:t><xsl:value-of select="pageTitle" /></w:t>
				</w:r>
			</w:p>

		<w:p />
			<w:p>
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

		<w:p />
			<w:p>
				<w:r>
					<w:t><xsl:value-of select="pageCont" /></w:t>
			</w:r>
		</w:p>
		<w:sectPr>
          <w:pgSz w:w="12240" w:h="15840" />
          <w:pgMar w:top="1440"
		   w:right="1800"
		   w:bottom="1440"
		   w:left="1800"
		   w:header="720"
		   w:footer="720"
		   w:gutter="0" />
          <w:cols w:space="720" />
          <w:docGrid w:line-pitch="360" />
        </w:sectPr>
	</wx:sect>
</xsl:template>
</xsl:stylesheet>