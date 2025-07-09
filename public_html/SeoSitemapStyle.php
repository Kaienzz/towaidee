<?php
/**********************************************************************************
* SeoSitemapStyle.php														  	  *															
***********************************************************************************
*																				  *
* SMFPacks SEO v2.2															 	  *
* Copyright (c) 2011-2017 by SMFPacks.com. All rights reserved.					  *
* Powered by www.smfpacks.com													  *
* Created by NIBOGO for SMFPacks.com											  *
*																				  *
***********************************************************************************
* You can't redistribute this program, this is a PAID Mod and only can be		  *
* downloaded from the SMFPacks site (http://www.smfpacks.com if you downloaded	  *
* this package from another website please report it to the SMFPacks Team.		  *
**********************************************************************************/

	global $txt, $mbname;

	if (file_exists(dirname(__FILE__) . '/SSI.php') && !defined('SMF'))
		require_once(dirname(__FILE__) . '/SSI.php');
	elseif (!defined('SMF'))
		die('Hacking attempt...');
		
	loadLanguage('Seo');
	header('Content-type: text/xml');
			
	echo'<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet 
  version="1.0"
  xmlns:sm="http://www.sitemaps.org/schemas/sitemap/0.9"
  xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
  xmlns:image="http://www.google.com/schemas/sitemap-image/1.1"
  xmlns:fo="http://www.w3.org/1999/XSL/Format"
  xmlns="http://www.w3.org/1999/xhtml">
    <xsl:output method="html" indent="yes" encoding="UTF-8"/>
    <xsl:template match="/">
        <html>
            <head>
                <title>', sprintf($txt['seo_sitemap_xml_title'], $mbname), '</title>
                <style type="text/css">
                body
                {
                        background-color: #e0e0e0;
                        margin: 0;
                        text-align: center;
                        font-family: Helvetica, Arial, sans-serif;
                        
                }
                .content
                {
                        border: 1px solid #b5b5b5;
                        margin: 10px auto;
                        width: 80%;
                        text-align:left;
                        -moz-border-radius:5px;
                        -webkit-border-radius:5px;
                        border-top-left-radius:5px;
                        background-color: #fff;
                }
                a:link
                {
                        color: #0180AF;
                        text-decoration: none;
                }
                a:visited
                {
                        color: #0180AF;
                        text-decoration: underline;
                }
                h1
                {
                        background-color: #8F8D8D;
                        padding: 8px;
                        color: #fff;
                        text-align: left;
                        font-size: 20px;
                        margin: 0px;
                        -moz-border-radius-topleft:5px;
                        -moz-border-radius-topright:5px;
                        -webkit-border-top-left-radius:5px;
                        -webkit-border-top-right-radius:5px;
                        border-top-left-radius:5px;
                        border-top-right-radius:5px;
                }
                h3
                {
                        font-size: 12px;
                        margin: 0px;
                        padding: 5px;
                        font-weight: normal;
                }
                table
                {
                	overflow: hidden;
                }
                th
                {
                        text-align: center;
                        background: #e0e0e0;
                        color: #000;
                        padding: 4px;
                        font-weight: normal;
                        font-size: 12px;
                        text-align: left;
                        font-family: Helvetica, Arial, sans-serif;
                }
                td
                {
                        font-size:12px;
                        font-family: Helvetica, Arial, sans-serif;
                        padding:6px 4px;
                        text-align:left;
                        overflow: hidden;
                        color: #8F8D8D;
                }
                td a
                {
                	color: #8F8D8D;
                	text-decoration: none;
                }
                td a:visited
                {
                	color: #8F8D8D;
                }
                tr
                {
                    background: #fff;
                }
                tr:nth-child(odd)
                {
                	background: #EBEBEB;
                }
                .footer
                {
                        background:#8F8D8D;
                        color: #fff;
                        padding:5px;
                        -moz-border-radius-bottomleft:5px;
                        -moz-border-radius-bottomright:5px;
                        -webkit-border-bottom-left-radius:5px;
                        -webkit-border-bottom-right-radius:5px;
                        border-bottom-left-radius:5px;
                        border-bottom-right-radius:5px;
                        font-size: 12px;
                }
                .footer a
                {
                	color: #fff;
                }
                .changefreq
                {
                	text-align: center;
                }
                </style>
            </head>
            <body>
                <div class="content">
                    <h1>', sprintf($txt['seo_sitemap_xml_title'], $mbname), '</h1>
                    <h3>
                        <xsl:choose>
                            <xsl:when test="sm:sitemapindex"> 
                                ', $txt['seo_sitemap_number_sitemap'], ': <xsl:value-of select="count(sm:sitemapindex/sm:sitemap)"/>
                            </xsl:when>
                            <xsl:otherwise> 
                                ', $txt['seo_sitemap_number_urls'], ': <xsl:value-of select="count(sm:urlset/sm:url)"/>
                            </xsl:otherwise>
                        </xsl:choose>
                    </h3>
                    <xsl:apply-templates/>
                    <div class="footer">
                    	<a href="http://www.smfpacks.com/">
                    		Created by SMFPacks SEO Pro Mod
                    	</a>
                    </div>
                </div>
            </body>
        </html>
    </xsl:template>
    <xsl:template match="sm:sitemapindex">
        <table cellspacing="0" cellpadding="0" width="100%">
            <tr>
                <th>', $txt['seo_sitemap_url'], '</th>
                <th />
                <th>', $txt['seo_sitemap_last'], '</th>
            </tr>
            <xsl:for-each select="sm:sitemap">
                <tr>
                    <xsl:variable name="loc">
                        <xsl:value-of select="sm:loc" />
                    </xsl:variable>
                    <xsl:variable name="lastmodified">
                        <xsl:value-of select="sm:lastmodified"/>
                    </xsl:variable>
                    <td><a href="{$loc}"><xsl:value-of select="sm:loc"/></a></td>
                    <td><xsl:value-of select="sm:lastmodified"/></td>
                    <xsl:apply-templates/>
                </tr>
            </xsl:for-each>
        </table>
    </xsl:template>
    <xsl:template match="sm:urlset">
        <table cellspacing="0" cellpadding="0" width="100%">
            <tr>
                <th width="5%" />
                <th width="50%">', $txt['seo_sitemap_url'], '</th>
                <th width="20%">', $txt['seo_sitemap_last'], '</th>
                <th width="15%" class="changefreq">', $txt['seo_sitemap_change'], '</th>
                <th width="10%" class="changefreq">', $txt['seo_sitemap_priority'], '</th>
            </tr>
            <xsl:for-each select="sm:url">
                <tr>
                    <xsl:variable name="loc">
                        <xsl:value-of select="sm:loc"/>
                    </xsl:variable>
          			<xsl:variable name="priority">
                        <xsl:value-of select="sm:priority"/>
                    </xsl:variable>
                    <xsl:variable name="lastmodified">
                        <xsl:value-of select="sm:lastmodified"/>
                    </xsl:variable>
                    <xsl:variable name="changefreq">
                        <xsl:value-of select="sm:changefreq"/>
                    </xsl:variable>
                    <xsl:variable name="pos">
                            <xsl:value-of select="position()"/>
                    </xsl:variable>
		    <td><xsl:value-of select="$pos"/></td>
                    <td><div class="overflow"><a href="{$loc}" target="_blank"><xsl:value-of select="sm:loc"/></a></div></td>
                    <xsl:apply-templates/>
                </tr>
            </xsl:for-each>
        </table>
    </xsl:template>
    <xsl:template match="sm:loc|image:image">
    </xsl:template>
    <xsl:template match="sm:lastmod">
    <td>
    	<xsl:apply-templates/>
    </td>
    </xsl:template>
    <xsl:template match="sm:changefreq|sm:priority">
    <td class="changefreq">
    	<xsl:apply-templates/>
    </td>
    </xsl:template>
</xsl:stylesheet>';