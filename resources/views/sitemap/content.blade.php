<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
  @foreach ($contents as $content)
    <url>
      <loc>{{ route('home.single', $content->slug) }}</loc>
      <lastmod>{{ $content->created_at->toAtomString() }}</lastmod>
      <changefreq>weekly</changefreq>
      <priority>0.6</priority>
    </url>
  @endforeach
</urlset>
