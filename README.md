<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

.htaccess file in your www folder

<pre>
&ltIfModule mod_rewrite.c>
RewriteEngine On
RewriteRule ^(.*)$ /laravel_practice/public/$1 [L]
&lt/IfModule>
</pre>

TO DO:
<li>hide blogpost form if not logged in
<li>disable 'update' if not logged in

to install: 

composer install
npm build
artisan migrate
edit .htaccess