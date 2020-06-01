# Zero Waste Foods App

> The application is built using Slim framework

### Server Environment
The app has the following server requirements:
  - PHP >= 5.3.0
  - BCMath PHP Extension
  - Ctype PHP Extension
  - JSON PHP Extension
  - Mbstring PHP Extension
  - OpenSSL PHP Extension
  - PDO PHP Extension
  - Tokenizer PHP Extension
  - XML PHP Extension

### Deployment Instructions

  - Create .htaccess file in the public directory for Apache Server. The content of the file shall be: 
  >RewriteEngine On
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^ index.php [QSA,L]
  - Configure the web server's document/web root to be the public directory
  - The index.php should be in the root folder of the project (www root).
  - Confirm that bootstrap/cache directory is writable by the server. The .htaccess file requires URL rewriting. Make sure to enable Apache’s mod_rewrite module and your virtual host is configured with the AllowOverride option so that the .htaccess rewrite rules can be used:
 >AllowOverride All

  - Update the database credentials in the app.php file. For example, for localhost it is
 > $app = new \Slim\App([
  'settings' => [
    'displayErrorDetails' => true,
    'db' => [
      'driver' => 'mysql',
      'host' => '127.0.0.1',
      'port' => '8889',
      'database' => 'zerowasteslim',
      'username' => 'root',
      'password' => 'root',
      'charset' => 'utf8',
      'collation' => 'utf8_unicode_ci',
      'prefix' => ''
    ]
  ]

]);
  - Migrate the MySQL database

### Key Frameworks
Zero Waste Foods App uses a number of frameworks and libraries:
* HTML, markup used for view layouts
* Twig in combination with HTML used for page layouts 
* Bootstrap, a CSS framework aimed to deliver responsive UI for both mobile and web. In Zero Waste Foods app takes care of buttons, nav bar, cart table and data containers
* Slim, back-end PHP microframework for web app development. In Zero Waste Foods app it is used for API development, Controllers, Models and their relationships

### Load Balancing
Load balancing depends on the actual server being utilised. Progressive hosting solutions are capable of excellent load balancing. The application is not expected to handle multiple requests, therefore, there is no need in additional servers.

### SEO
To make the application visible for search engines the source code has to be optimised with the following:
  * Related Title Tag
  * Comprehensive meta description in the Meta tag. For Zero Waste Foods app an example is:
> <meta name="description" content="This Zero Waste restaurant lets you and us plan daily meals in advance to minimaze food waste. If you care about pollution, future of our planet and zero waste lifestyle visit our app to book your lunch now!" />

  * Related H1 Title Tag
  * Use of Image tags <img src=""/> for Zero Waste Foods logo or lunch photos
