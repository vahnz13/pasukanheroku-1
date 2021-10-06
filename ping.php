<?php
set_time_limit(999999);

$sitemaps = array(
  "http://turnstyle.musicglue.com/sitemap_index.xml",
  "http://turnstyle.musicglue.com/sitemap/submap_1.xml",
  "http://turnstyle.musicglue.com/sitemap/submap_2.xml",
  "http://turnstyle.musicglue.com/sitemap/submap_3.xml",
  "http://turnstyle.musicglue.com/sitemap/submap_4.xml",
  "http://turnstyle.musicglue.com/sitemap/submap_5.xml",
  "http://turnstyle.musicglue.com/sitemap/submap_6.xml",
  "http://turnstyle.musicglue.com/sitemap/submap_7.xml",
);

// cUrl handler to ping the Sitemap submission URLs for Search Engines…
function Submit($url){
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_HEADER, 0);
  curl_exec($ch);
  $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  curl_close($ch);
  return $httpCode;
}

function SubmitSiteMap($url) {
  $returnCode = Submit($url);
  if ($returnCode != 200) {
    echo "Error $returnCode: $url <BR/>";
  } else {
    echo "Submitted $returnCode: $url <BR/>";
  }
}

foreach ($sitemaps as $sitemapUrl) {
  $sitemapUrl = htmlentities($sitemapUrl);

  //Google  
  $url = "http://www.google.com/webmasters/sitemaps/ping?sitemap=".$sitemapUrl;
  SubmitSiteMap($url);
  
  //Bing / MSN
  $url = "http://www.bing.com/webmaster/ping.aspx?siteMap=".$sitemapUrl;
  SubmitSiteMap($url);
  
  // Live
  $url = "http://webmaster.live.com/ping.aspx?siteMap=".$sitemapUrl;
  SubmitSiteMap($url);
  
  // moreover
  $url = "http://api.moreover.com/ping?sitemap=".$sitemapUrl;
  SubmitSiteMap($url);
}