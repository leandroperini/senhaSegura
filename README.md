# senhaSegura - Uma POC sobre encriptação.

Este projeto foi implementado sem uso de bibliotecas de terceiros exceto bibliotecas para front-end.

A arquitetura segue os moldes do MVC onde foi criado uma espécie de microframework para a implementação das models, views e controllers.

O Sistema foi desenhado para funcionar sob o ambiente LAMP sendo necessário:
 * Apache 2.4 sem mod_rewrite
 * MariaDB ou MySQL 
 * PHP 5.6

Para a configuração do Apache foi utilizado o fallbackResource como alternativa ao mod_rewrite:
```xml
    <VirtualHost *:80>
        ServerAdmin webmaster@dummy-host2.example.com
        DocumentRoot "H:/xampp/htdocs/senhaSegura"
        ServerName senha.env
        ErrorLog "H:/xampp/htdocs/log/senha-error.log"
        CustomLog "H:/xampp/htdocs/log/senha-access.log" common	 
	    <Directory "H:/xampp/htdocs/senhaSegura">	
		    DirectoryIndex /index.php
		    FallbackResource /index.php
		    Options FollowSymLinks MultiViews
		    AllowOverride All
            Order allow,deny
    		Allow from all
	    </Directory>
	    <Directory "H:/xampp/htdocs/senhaSegura/assets">
		    FallbackResource disabled
		    Options -indexes
		    AllowOverride All
            Order allow,deny
    		Allow from all
	    </Directory>
    </VirtualHost>
```
Foi necessário fazer uso de arquivos .htaccess para complementar a limitação de acesso aos arquivos.

# Comentários sobre o código.



