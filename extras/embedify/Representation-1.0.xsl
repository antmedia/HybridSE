<?xml version="1.0" encoding="utf-8"?>
<!--
Compatibility List:
- EmbeddedReprUrl-1.0.0.js-->
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
  <xsl:output method="text"/>
  <xsl:template match="/PageRepresentation">
    <![CDATA[<div class="embeddedUrlRepresentation">]]><![CDATA[
      <div class="embeddedUrlLink">
        <a href="]]><xsl:value-of select="Url"/><![CDATA[" title="]]><xsl:value-of select="Title"/><![CDATA[" target="_blank">]]><xsl:choose>
      <xsl:when test="Title!='' and Title!='null'">
        <xsl:value-of select="Title"/>
      </xsl:when>
      <xsl:otherwise>
        <xsl:value-of select="Url"/>
      </xsl:otherwise>
    </xsl:choose><![CDATA[</a>
    </div>]]><![CDATA[
    <div class="embeddedUrlDomainLink">
        <a href="]]><xsl:value-of select="Domain"/><![CDATA[" target="_blank">]]><xsl:value-of select="Domain"/><![CDATA[</a>
    </div>]]>
    <xsl:if test="AuthorName!='' and AuthorName!='null'">
      <![CDATA[<div class="embeddedUrlSeparator"/>
          <div class="embeddedUrlAuthor">]]><xsl:value-of select="AuthorName"/><![CDATA[</div>]]>
    </xsl:if>
    <xsl:variable name="pictureCount">
      <xsl:value-of select="count(Pictures/*)-3"/>
    </xsl:variable>
    <xsl:variable name="pictureWidthHeight">
      <xsl:choose>
        <xsl:when test="Pictures/PagePicture[1]/Width!='0'">
          <![CDATA[width="]]><xsl:value-of select="Pictures/PagePicture[1]/Width"/><![CDATA["]]>
        </xsl:when>
      </xsl:choose>
      <xsl:choose>
        <xsl:when test="Pictures/PagePicture[1]/Height!='0'">
          <![CDATA[height="]]><xsl:value-of select="Pictures/PagePicture[1]/Height"/><![CDATA["]]>
        </xsl:when>
      </xsl:choose>
    </xsl:variable>
    <xsl:variable name="videoWidthHeight">
      <![CDATA[width="]]><xsl:if test="Videos/PageVideo[1]/Width!='0'">
        <xsl:value-of select="Videos/PageVideo[1]/Width"/>
      </xsl:if><![CDATA[" height="]]><xsl:if test="Videos/PageVideo[1]/Height!='0'">
        <xsl:value-of select="Videos/PageVideo[1]/Height"/>
      </xsl:if><![CDATA["]]>
    </xsl:variable>
    <xsl:variable name="playerId">
      <xsl:choose>
        <xsl:when test="Videos/PageVideo[1]/PlayerId!='' and Videos/PageVideo[1]/PlayerId!='null'">
          <xsl:value-of select="Videos/PageVideo[1]/PlayerId"/>
        </xsl:when>
        <xsl:otherwise>
          <xsl:text>ytapiplayer</xsl:text>
        </xsl:otherwise>
      </xsl:choose>
    </xsl:variable>
    <xsl:variable name="pictureRender">
      <xsl:choose>
        <xsl:when test="(Pictures/PagePicture[1]/Url='' or Pictures/PagePicture[1]/Url='null') and (Videos/PageVideo[1]/VideoSources/PageVideoSources[1]/Url='' or Videos/PageVideo[1]/VideoSources/PageVideoSources[1]/Url='null')"></xsl:when>
        <xsl:otherwise>
          <![CDATA[
      <div class="pictureAndThumb"><div class="embeddedUrlPictureWrapper boxgrid captionfull ]]><xsl:choose>
            <xsl:when test="Pictures/PagePicture[1]/Url!='' and Pictures/PagePicture[1]/Url!='null'"></xsl:when>
            <xsl:otherwise><![CDATA[nopicture]]></xsl:otherwise>
          </xsl:choose><![CDATA[">
        <img class="embeddedUrlPicture ]]><xsl:choose>
            <xsl:when test="Pictures/PagePicture[1]/Url!='' and Pictures/PagePicture[1]/Url!='null'"></xsl:when>
            <xsl:otherwise><![CDATA[nopicture]]></xsl:otherwise>
          </xsl:choose><![CDATA[" src="]]><xsl:choose>
            <xsl:when test="Pictures/PagePicture[1]/Url!='' and Pictures/PagePicture[1]/Url!='null'">
              <xsl:value-of select="Pictures/PagePicture[1]/Url"/>
            </xsl:when>
            <xsl:otherwise>
              <xsl:value-of select="BlankIcon"/>
            </xsl:otherwise>
          </xsl:choose><![CDATA[" alt="]]><xsl:value-of select="Pictures/PagePicture[1]/Alt"/><![CDATA[" title="]]><xsl:value-of select="Pictures/PagePicture[1]/Title"/><![CDATA["]]><![CDATA[/>]]>
          <xsl:if test="Videos/PageVideo[1]/VideoSources/PageVideoSources[1]/Url!='' and Videos/PageVideo[1]/VideoSources/PageVideoSources[1]/Url!='null'">
            <![CDATA[<div class="cover boxcaption">
          <img class="playvideo" src="]]><xsl:value-of select="PlayIcon"/><![CDATA[" width="32" height="32" onclick="var xslLib = new EmbeddedRepresentationXsl();xslLib.LoadVideo($(this).parent().parent(),']]><xsl:value-of select="Videos/PageVideo[1]/Html"/><![CDATA[',']]><xsl:value-of select="$playerId"/><![CDATA[',']]><xsl:value-of select="Videos/PageVideo[1]/UsedWidth"/><![CDATA[',']]><xsl:value-of select="Videos/PageVideo[1]/UsedHeight"/><![CDATA[','.nonVisibleInVideoPreview');">]]>
            <![CDATA[</div>]]>
          </xsl:if>
          <![CDATA[</div>]]><xsl:if test="$pictureCount>1">
            <![CDATA[<div class="thumbSelect nonVisibleInPost nonVisibleInVideoPreview"><div class="prevThumbContainer"><img src="]]><xsl:value-of select="PrevThumbIcon"/><![CDATA[" class="prevThumb thumbNavDisabled" onclick="var xslLib = new EmbeddedRepresentationXsl();xslLib.Navigate($(this),$(this).parent().next().next().children(':first-child'),-1,']]><xsl:value-of select="Pictures/PictureUrls"/><![CDATA[',']]><xsl:value-of select="Pictures/PictureWidths"/><![CDATA[',']]><xsl:value-of select="Pictures/PictureHeights"/><![CDATA[','thumbNavDisabled',$(this).parent().parent().prev().children(':first-child'),$(this).parent().next())"/></div><div class='thumbNavStatus'>1/]]><xsl:value-of select="$pictureCount"/><![CDATA[</div><div class="nextThumbContainer"><img  src="]]><xsl:value-of select="NextThumbIcon"/><![CDATA[" class="nextThumb " onclick="var xslLib = new EmbeddedRepresentationXsl();xslLib.Navigate($(this).parent().prev().prev().children(':first-child'),$(this),1,']]><xsl:value-of select="Pictures/PictureUrls"/><![CDATA[',']]><xsl:value-of select="Pictures/PictureWidths"/><![CDATA[',']]><xsl:value-of select="Pictures/PictureHeights"/><![CDATA[','thumbNavDisabled',$(this).parent().parent().prev().children(':first-child'),$(this).parent().prev())"/></div></div>]]>
          </xsl:if><![CDATA[</div>]]>
          <xsl:if test="Videos/PageVideo[1]/VideoSources/PageVideoSources[1]/Url!='' and Videos/PageVideo[1]/VideoSources/PageVideoSources[1]/Url!='null'">
            <![CDATA[<div style="display:none;padding-top: 10px;]]><xsl:value-of select="Videos/PageVideo[1]/ContainerStyle"/><![CDATA["><div id="]]><xsl:value-of select="$playerId"/><![CDATA["></div></div>]]>
          </xsl:if>
        </xsl:otherwise>
      </xsl:choose>
    </xsl:variable>
    <xsl:value-of select="$pictureRender"/>
    <xsl:if test="Description!='' and Description!='null'">
      <![CDATA[<div class="embeddedUrlSeparator"/>
          <div class="embeddedUrlDescription">]]><xsl:value-of select="Description"/><![CDATA[</div>]]>
    </xsl:if>
    <![CDATA[</div>]]>

  </xsl:template>

</xsl:stylesheet>
