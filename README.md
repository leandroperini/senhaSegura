# senhaSegura - Uma POC sobre criptografia.

Este projeto foi implementado sem uso de bibliotecas de terceiros exceto bibliotecas para front-end.

A arquitetura segue os moldes do MVC onde foi criado uma espécie de microframework para a implementação das models, views e controllers.

O Sistema foi desenhado para funcionar sob o ambiente LAMP sendo necessário:
 * Apache 2.4 sem mod_rewrite
 * MariaDB ou MySQL 
 * PHP 5.6

Para a configuração do Apache foi utilizado o fallbackResource como alternativa ao mod_rewrite veja na seção [Instalação](#instalacao).
Foi necessário fazer uso de arquivos .htaccess para complementar a limitação de acesso aos arquivos.

# Comentários sobre o código.

### Controle de Dispositivos (CRUD)

Esse segmento é corriqueiro, foi utilizado o método de http post sem ajax para manter a simplicidade, fazer uso mais intenso do MVC e evitar uso de biliotecas de terceiros.

Também não foi utilizado nenhuma espécie de validação de formulário via Javascript, apenas HTML5 foi usado como ferramenta para validação de formato dos dados (atributo pattern) e obrigatorietade do preenchimento (atributo required).

Dificuldades: - 

Pontos de melhorias: Realizar submit via ajax, validação de formulario com Javascript, aplicar paginação na listagem de dispositivos para evitar possíveis problemas de performance.

### Integração SSH

Nesse módulo foi criado um formulário para permitir o login via SSH no dispositivo préviamente cadastrado e exibindo uma interface semelhante à um terminal.

A conexão SSH no PHP foi desenhada de modo que fosse mantida na session, bem como o histórico de comandos executados e sus resultados.

Inicialmente foi utilizado a biblioteca nativa para [SSH (libssh2)](http://php.net/manual/en/book.ssh2.php) por questões de segurança e integridade, no entando não o sucesso não foi obtido com erro de "tela branca da morte" onde nenhuma mensagem de erro ou log era gerado.

Posteriormente foi usada a biblioteca [phpseclib](https://github.com/phpseclib/phpseclib) como forma de abstração na implementação do SSH, contudo o mesmo resultado de tela branca foi obtido.

Foram executados testes preliminares via php-cli demonstrando chances de sucesso, indicando uma possível limitação no uso das bibliotecas supracitadas na execução via browser.

Dificuldades: Implementar bibliotecas [SSH2](http://php.net/manual/en/book.ssh2.php) e [phpseclib](https://github.com/phpseclib/phpseclib)

Pontos de melhorias: Uso da biblioteca [TerminalJS](http://erikosterberg.com/terminaljs/) como emulador de interface shell.

### Criptografia

Os modos de criptografia implementados foram:

1. Cifra de César
2. AES256 com SALT.
3. Cifra de César com palavra-chave

A cifra de César foi implementada utilizando um array préviamente definido para o alfabeto base e string para o texto de entrada, pois a linguagem PHP possui muitas ferramentas para array e string, podendo-se intercambear entre uma representação e outra. Essa mesma decisão foi aplicada na cifra de César com chave.

A encriptação AES256 foi implementada seguindo os padrões mercadológicos limitando-se às funções nativas da linguagem. A preocupação aqui foi garantir um salt complexo e randômico.

Dificuldades: -

Pontos de melhorias: -

### Comparação de Hashes

Os modos de cáculo de hash implementados foram:

1. SHA512 com 5.000 rounds
2. MD5 HMAC
3. Whirlpool

Nesse caso o PHP fornece um leque de funções facilmente implementáveis e seguras, deste modo os padrões da documentação foram seguidos. A preocupação aqui foi em evitar timing attack no momento da comparação, o que foi solucionado com o uso da função hash_equals. 

Dificuldades: -

Pontos de melhorias: Gerar possíbilidade de calculo de hash de arquivos.

# Instalação

### Configuração do Apache.
Para utilizar o sistema é preciso configurar o VirtualHost do Apache com a seguinte configuração: 

```xhtml
    <VirtualHost *:80>
        ServerAdmin webmaster@dummy-host2.example.com
        DocumentRoot "H:/xampp/htdocs/senhaSegura"
        ServerName senha.env
        ErrorLog "H:/xampp/htdocs/log/senha-error.log"
        CustomLog "H:/xampp/htdocs/log/senha-access.log" common	 
	    <Directory "H:/xampp/htdocs/senhaSegura">
	        #As duas linhas à seguir garantem que toda request será redirecionada para o arquivo index.php. 	
		    DirectoryIndex /index.php
		    FallbackResource /index.php
		    Options FollowSymLinks MultiViews
		    AllowOverride All
            Order allow,deny
    		Allow from all
	    </Directory>
	    #Abaixo a segmentação do acesso para as pastas de assets que não devem sofre redireção e não possui directory index.
	    <Directory "H:/xampp/htdocs/senhaSegura/assets">
	        #À seguir a remoção da redireção é feita, garantindo acesso direto aos arquivos como imagens, documentos, css, js, binarios...
		    FallbackResource disabled
		    Options -indexes
		    AllowOverride All
            Order allow,deny
    		Allow from all
	    </Directory>
    </VirtualHost>
```
Isso garante a redireção de todas requests para o arquivo index.php para só então a estrutura MVC poder ser carregada, bem como possíveis bibliotecas.

### Configuração do Banco de dados.
Após configurado o Apache é necessário executar o código de abaixo no banco MySQL ou MariaDB para criar as estruturas de tabelas adequadas. 

```sql

-- Estrutura do banco de dados para senha_segura
CREATE DATABASE IF NOT EXISTS `senha_segura` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_bin */;
USE `senha_segura`;

-- Estrutura para tabela senha_segura.devices
CREATE TABLE IF NOT EXISTS `devices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hostname` varchar(100) COLLATE utf8_bin NOT NULL,
  `ip` varchar(15) COLLATE utf8_bin NOT NULL,
  `type_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `type_id` (`type_id`),
  CONSTRAINT `FK_devices_device_types` FOREIGN KEY (`type_id`) REFERENCES `device_types` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Estrutura para tabela senha_segura.device_types
CREATE TABLE IF NOT EXISTS `device_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_bin NOT NULL,
  `machine_name` varchar(100) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Dados para a tabela senha_segura.device_types: ~7 rows (aproximadamente)
/*!40000 ALTER TABLE `device_types` DISABLE KEYS */;
INSERT INTO `device_types` (`id`, `name`, `machine_name`) VALUES
	(1, 'Servidor', 'servidor'),
	(3, 'Switch', 'switch'),
	(5, 'Notebook', 'notebook'),
	(6, 'Celular', 'celular'),
	(7, 'Telefone VOIP', 'telefone_voip'),
	(8, 'Desktop', 'desktop'),
	(9, 'Roteador', 'roteador');
/*!40000 ALTER TABLE `device_types` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
```

###Configuração da aplicação.

Uma vez executado os passos anteriores, deve-se configurar os dados de acesso de banco para que a aplicação póssa rodar sem problemas.

Para isso, no arquivo [database.php](https://github.com/leandroperini/senhaSegura/blob/master/core/database.php) é preciso inserir os dados de autenticação no banco.

```php
 6.    private $db_conf    = [
 7.          'default' => [
 8.               'host' => '192.168.10.1',
 9.               'user' => 'root',
 10.              'pass' => 'root',
 11.              'db'   => 'senha_segura',
 12.         ],
 13.   ];
```

Lembrando que mais de um acesso pode ser configurado e nesta versão apenas MySQL e MariaDB são suportados.

