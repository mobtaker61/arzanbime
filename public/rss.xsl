<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0"
    xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    xmlns="http://www.w3.org/1999/xhtml">
    <xsl:output method="html" indent="yes"/>

    <xsl:template match="/">
        <html>
            <head>
                <title>RSS Feed</title>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                    }
                    h2 {
                        color: #2E8B57;
                    }
                    .item {
                        margin-bottom: 20px;
                        border-bottom: 1px solid #ccc;
                        padding-bottom: 10px;
                    }
                    .title {
                        font-size: 1.2em;
                        font-weight: bold;
                    }
                    .description {
                        margin: 10px 0;
                    }
                    .pubDate {
                        color: #888;
                    }
                </style>
            </head>
            <body>
                <h2>RSS Feed</h2>
                <xsl:for-each select="rss/channel/item">
                    <div class="item">
                        <div class="title">
                            <a href="{link}"><xsl:value-of select="title"/></a>
                        </div>
                        <div class="description">
                            <xsl:value-of select="description"/>
                        </div>
                        <div class="pubDate">
                            <xsl:value-of select="pubDate"/>
                        </div>
                    </div>
                </xsl:for-each>
            </body>
        </html>
    </xsl:template>
</xsl:stylesheet>
