<?php


class LoginController extends AppController {

    public function index($param) {
        $this->page = 'login/login';
        
        /*
         * 
        $user       = $_POST["user"];
        $password   = $_POST["password"];
        
        // Verifica se o usuário digitou o usuário e a senha        
        if (!empty($_POST) && empty($_POST['user'])) {//Não use AND use &&
            echo "<script language='javascript' type='text/javascript'>"
            . "alert('Usuário ou Senha não digitado!');window.location.href='/login'</script>";
            
        } 
        // Se tiver digitado usuário e senha, procede com a validação no banco
        else {
//            "@duvida_perini"; estava dando erro porque o banco tava dando erro de constraint, alguma chave está errada
//            ajustei para a função db->execute exibir a mensagem de erro quando der erro
            $sql = $this->db->execute("SELECT `nome_user` FROM `user` WHERE `nome_user` = $user");
             
//            $query = mysqli_query($this->db, $sql); não é necessário a função db->execute já executa e retorna o valor, o que acontecia é que dava erro e tetornava false;
//            "@duvida_perini";
            if (mysqli_num_rows($this->db, $query) != 1) {
            // Mensagem de erro quando os dados são inválidos e/ou o usuário não foi encontrado
            echo "<script language='javascript' type='text/javascript'>"
            . "alert('Usuário não cadastrado, consulte o administrador');"
                  . "</script>";
            
            } else {
              // Salva os dados encontados na variável $resultado
              $resultado = mysqli_fetch_assoc($query);
//              "@duvida_perini"; não há necessidade de manipular o retorno do select, a função db->execute() já retorna o valor pronto para ser usado.
            }
        }
         * 
         */
    }
    
    public function recuperarSenha($param) {
        $this->page = 'login/recuperarSenha';

    }

    public function cadastroNovo($params) {
        
        $query = $this->db->execute("SELECT * FROM cargo");
        $this->cargosUsuarios = $query;
        
        $this->page = 'login/cadastrar';
        
        if (isset($_POST["nome"]) && isset($_POST["user"]) && isset($_POST["senha"])) {
            $nome   = $_POST["nome"];
            $user   = $_POST["user"];
            $senha  = MD5($_POST["senha"]);
            $email  = $_POST["email"];
            $cargo  = $_POST["cargo"];
            $status = $_POST["status"];

            if (isset($_POST["submit"])) {
                $resultado = $this->db->execute("INSERT user (nome_user, email_user, cargo_user, senha_user, status_user) values (?, ?, ?, ?, ?);", [
                'values' => [
                    $user,
                    $email,
                    $cargo,
                    $senha,
                    $status,
                ],
                'types'  => [
                    's',
                    's',
                    'i',
                    's',
                    'i',
                ],
            ]);
            header('Location: /login/cadastrado');
            } else {
                echo "<script language='javascript' type='text/javascript'>alert('Preencha pelo menos um dos campos!');window.location.href='login.html'</script>";
            }   
        }
    }

    public function cadastroSalvo($param) {
        $this->page = 'login/cadastrado';
    }

    public function usuarios($param) {
        $this->page = 'login/usuarios';

        $query = $this->db->execute("SELECT * FROM user");

        $this->usuariosCadastrados = $query; // aqui é como você passa uma variável para a view assim pode preencher o html com o conteúdo dela, na view ela terá o mesmo nome, vá até a view para entender o resto
//        esses são outros exemplos de variaveis que pode passar todas elas serão acessiveis na view através de: $class->nomeVariavel, por boa prática atribua os valores que serão passados para a view sempre no fim da função
        $this->usuarioLogado       = true;
        $this->horaAtual           = '10:35';
        $this->quantidadeDeAcessos = 66;
    }

}
