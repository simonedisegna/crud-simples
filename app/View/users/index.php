<?php
/// Prepara a consulta SQL para selecionar todos os usuários e suas cores associadas
$stmt = $pdo->query('SELECT u.*, c.name AS color_name , c.hexadecimal
                        FROM users u 
                        LEFT JOIN user_colors uc ON uc.user_id = u.id
                        LEFT JOIN colors c ON uc.color_id = c.id
                        ORDER BY u.name ASC');

// Obtém todos os usuários como um array associativo
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
    <div class="container" id='principal'>
    <h1><center>Listagem de Usuários</center></h1>
    <a href="/users/create" class="btn btn-success">Novo Usuário</a>
    <table class='table table-striped'>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Cor</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>                    
                    <td><?= $user['name'] ?></td>
                    <td><?= $user['email'] ?></td>
                    <td class="color-cell" style="background-color:<?=$user['hexadecimal']?>; color:#fff"><center><?= $user['color_name'] ?></center></td>                 
                    <td>
                        <a href="/users/<?= $user['id'] ?>/edit" class="btn btn-primary">Editar</a>
                        <form action="/users/" method="POST" style="display: inline;">
                            <input type="hidden" name="_method" value="DELETE" />
                            <input type="hidden" name="id" id="id" value="<?= $user['id'] ?>" />
                            <button type="submit" onclick="return confirm('Tem certeza que deseja excluir este usuário?')" class="btn btn-danger">Excluir</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>


