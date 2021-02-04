<IfModule mod_rewrite.c>
    <IfModule mod_negotiation.c>
        Options -MultiViews -Indexes
    </IfModule>

    RewriteEngine On

    ErrorDocument 404 /404.html

    # Handle Authorization Header
    RewriteCond %{HTTP:Authorization} .
    RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]

    # Redirect Trailing Slashes If Not A Folder...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_URI} (.+)/$
    RewriteRule ^ %1 [L,R=301]

    # Handle Front Controller...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f

    @foreach($routes as $path => $names)
        RewriteRule ^{{ $path }}$ /index.php [L] # route name(s): {{ implode(', ',$names) }}
    @endforeach
    RewriteRule ^ - [L,R=404]

    <Files "index.html">
    Require all denied
    </Files>
</IfModule>