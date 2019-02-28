<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
{foreach from=$data item=link}
<url>
    <loc>{$link->loc}</loc>
    <lastmod>{$link->lastmod}</lastmod>
    <changefreq>{$link->changefreq}</changefreq>
    {if !empty($link->priority)}
    <priority>{$link->priority}</priority>
    {/if}
</url>
{/foreach}
</urlset>
