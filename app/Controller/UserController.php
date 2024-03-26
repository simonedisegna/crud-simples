<?php

namespace Controller;

class UserController
{
    protected $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function index(){
        // Conectar ao banco de dados SQLite
        $dbFile = __DIR__ .'/../database/db.sqlite';
        $db = new \PDO('sqlite:' . $dbFile);
        $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        // Lógica para listar usuários
        $stmt = $db->query('SELECT * FROM users');
        $users = $stmt->fetchAll(\PDO::FETCH_ASSOC);

    }


    public function store($postData)
    {
        // Verificar se os dados do formulário foram recebidos corretamente
        if (isset($postData['name']) && isset($postData['email'])) {
            $name = $postData['name'];
            $email = $postData['email'];

            try {
                // Preparar a consulta SQL para inserir um novo usuário
                $stmt = $this->db->prepare("INSERT INTO users (name, email) VALUES (:name, :email)");
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':email', $email);
                $stmt->execute();

                $_SESSION['success_message'] = "Usuário adicionado com sucesso!";
                // Redirecionar para a página de listagem de usuários após a inserção
                header("Location: /");
                exit();
            } catch (\PDOException $e) {
                // Em caso de erro na inserção, exibir uma mensagem de erro
                echo "Erro ao inserir usuário: " . $e->getMessage();
            }
        } else {
            // Exibir uma mensagem de erro se os dados do formulário estiverem ausentes
            echo "Erro: Todos os campos são obrigatórios";
        }
    }

    public function show($userId)
    {
        // Preparar a consulta para selecionar o usuário pelo ID
        $stmt = $this->db->prepare('SELECT u.*, c.name AS color_name 
                                    FROM users u 
                                    LEFT JOIN user_colors uc ON u.id = uc.user_id
                                    LEFT JOIN colors c ON uc.color_id = c.id
                                    WHERE u.id = ?');
        // Executar a consulta passando o ID como parâmetro
        $stmt->execute([$userId]);
        // Buscar o usuário no banco de dados
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);

        // Retornar os dados do usuário
        return $user;
    }


    public function update($userId, $name,$email,$idColor)
    {
        try {
            // Preparar a consulta SQL para inserir um novo usuário
            $stmt = $this->db->prepare("UPDATE users SET name = :name, email = :email WHERE id = :id");
            $stmt->bindParam(':id', $userId);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            $verify = $this->verifyColor($userId);
           
            if($verify > 0){
                $stmtColor = $this->db->prepare("UPDATE user_colors SET color_id = :idColor WHERE user_id = :user_id");
                $stmtColor->bindParam(':idColor', $idColor);
                $stmtColor->bindParam(':user_id', $userId);
                $stmtColor->execute();
            }else{
                $stmtColor = $this->db->prepare("INSERT INTO user_colors(color_id, user_id) VALUES (:idColor, :user_id)");
                $stmtColor->bindParam(':idColor', $idColor); 
                $stmtColor->bindParam(':user_id', $userId);
                $stmtColor->execute();
                $stmt->execute();
            }

            $_SESSION['success_message'] = "Usuário editado com sucesso!";
            // Redirecionar para a página de listagem de usuários após a inserção
            header("Location: /");
            exit();
        } catch (\PDOException $e) {
            // Em caso de erro na inserção, exibir uma mensagem de erro
            echo "Erro ao inserir usuário: " . $e->getMessage();
        }

        $stmt = $this->db->prepare('');
        $stmt->execute([$name, $email, $userId]);
        echo "Usuário atualizado com sucesso!";
    }

    public function delete($userId)
    {
        try {
            // Excluir registros associados na tabela user_colors
            $stmt = $this->db->prepare('DELETE FROM user_colors WHERE user_id = ?');
            $stmt->execute([$userId]);

            // Excluir usuário da tabela users
            $stmtUser = $this->db->prepare('DELETE FROM users WHERE id = ?');
            $stmtUser->execute([$userId]);
           
            $_SESSION['success_message'] = "Usuário excluído com sucesso!";
            // Redirecionar para a página de listagem de usuários após a inserção
            header("Location: /");
            exit();
        } catch (\PDOException $e) {
            // Em caso de erro, exibir mensagem de erro
            echo "Erro ao excluir usuário: " . $e->getMessage();
        }
    }

    public function verifyColor($id){
        try {
            $stmt = $this->db->prepare('SELECT count(*) as total from user_colors where user_id = ?');
            $stmt->execute([$id]);
            $verify = $stmt->fetchColumn();
            
            // Retornar os dados do usuário
            return $verify;
        } catch (\PDOException $e) {
            // Em caso de erro na inserção, exibir uma mensagem de erro
            echo "Erro ao inserir usuário: " . $e->getMessage();
        } 
    }

}