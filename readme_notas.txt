20220615
para crear dominio virtual :
- D:\xampp\apache\conf\extra\httpd-vhosts.conf

<VirtualHost *:80>
    DocumentRoot "D:/xampp/htdocs/apirest-php"
    ServerName apirest-php.com
	</VirtualHost>

- C:\Windows\System32\drivers\etc

 127.0.0.1       apirest-php.com
 -----------------------------------------------------------------
$_SERVER['´PHP_AUTH_USER']
$_SERVER['´PHP_AUTH_PW']
$_SERVER['REQUEST_URI']
$_SERVER['REQUEST_METHOD']