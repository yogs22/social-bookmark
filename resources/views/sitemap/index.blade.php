<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
  <sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <sitemap>
      <loc>{{ url('sitemap/content') }}</loc>
      <lastmod>{{ $content->created_at->toAtomString() }}</lastmod>
    </sitemap>
  </sitemapindex>
