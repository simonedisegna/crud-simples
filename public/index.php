<?php session_start();
    // Verificar se há uma mensagem de sucesso na sessão
    if (isset($_SESSION['success_message'])) {
        // Exibir a mensagem de sucesso como um alerta
        echo "<script>alert('" . $_SESSION['success_message'] . "')</script>";

        unset($_SESSION['success_message']);
    }

    // Carrega o autoload do Composer
    require_once __DIR__ . '/../vendor/autoload.php';

    // Importa o namespace completo do UserController
    use Controller\UserController;

    // Captura a solicitação atual
    $requestMethod = $_SERVER['REQUEST_METHOD'];
    $requestUri = $_SERVER['REQUEST_URI'];

    $dsn = 'sqlite:' . __DIR__ . '/../database/db.sqlite';

    try {
        // Tentar estabelecer a conexão
        $pdo = new PDO($dsn);

    } catch (PDOException $e) {
        // Se ocorrer uma exceção, exibir mensagem de erro
        echo "Erro de conexão: " . $e->getMessage();
        echo "<br>";
        echo "DSN: " . $dsn;
    }
?>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de Usuários</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/estilo.css" rel="stylesheet" />
</head>
<body>
<?php
    // Definir o caminho base das views
    define('VIEWS_PATH', '../app/View/');

    // Roteamento básico
    if ($requestUri === '/') {
        // Roteie para a página inicial ou outra página de destino
        require VIEWS_PATH . 'users/index.php';
    }elseif (strpos($requestUri, '/users') === 0) {

        // Roteie solicitações relacionadas a usuários para o controlador apropriado
        $controller = new UserController($pdo);
        
        switch ($requestMethod) {
            case 'GET':
                if ($requestUri === '/users/create') {               
                    require VIEWS_PATH . 'users/create.php';
                } elseif (preg_match('/\/users\/(\d+)\/edit/', $requestUri, $matches)) {
                    $userId = $matches[1];
                    // Buscar o usuário pelo ID
                    $user = $controller->show($userId);
                    // Incluir o arquivo de edição do usuário e passar os dados do usuário
                    require VIEWS_PATH . 'users/edit.php';
                } else {
                    require VIEWS_PATH . '/';
                }
                break;
            case 'POST':
                if (isset($_POST['_method']) && $_POST['_method'] === 'DELETE') {                
                    $id = $_POST['id'];               
                    $controller->delete($id); //da erro não esta acessando a função
                }else{
                    
                    // Verifica se os campos obrigatórios estão presentes
                    if (isset($_POST['name']) && isset($_POST['email'])) {
                        
                        // Captura os valores dos campos do formulário
                        $name = $_POST['name'];
                        $email = $_POST['email'];
                        $cores = $_POST['cores'];
                        $coresUser = $_POST['coresUser'];
                        
                        if (strpos($requestUri, '/create') !== false) {
                            // Chama o método store() do UserController
                            $controller->store(['name' => $name, 'email' => $email]);
                        }else{
                            $controller->update($_POST['id'],$name,$email,$cores,$coresUser);
                        }                    
                    }
                }
                die();
                break;
        }
    }else {
        // Página não encontrada
        http_response_code(404);
        echo "Página não encontrada";
    }
?>
</body>
</html>

<!-- Adicione os arquivos JavaScript do Bootstrap e do jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>