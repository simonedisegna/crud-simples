<?php
$stmt = $pdo->query('SELECT * FROM colors;');
?>
<style>
    #editprin {
        margin-top: 5%;
        box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.75);
        border-radius: 10px;
        width: 70%;
        padding: 20px 20px 20px 20px
    }
</style>
<!-- CSS do Select2 -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- JavaScript do Select2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>


<div class="container" id='editprin'>
    <h1>Editar Usuário</h1>
    <form action="/users/edit/" method="post">
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="id" id="id" value="<?= $user['id'] ?>">
        <div class="form-group">
            <label for="name">Nome:</label><br>
            <input type="text" class="form-control" id="name" name="name" value="<?= $user['name'] ?>">
        </div>
        <div class="form-group" style='margin-top:20px;'>
            <label for="email">Email:</label><br>
            <input type="email" class="form-control" id="email" name="email" value="<?= $user['email'] ?>">
        </div>

        <div class="form-group" style='margin-top:20px;'>
            <?php
            // Consulta SQL para obter os IDs das cores associadas ao usuário
            $stmtCores = $pdo->prepare('SELECT color_id FROM user_colors WHERE user_id = :user_id');
            $stmtCores->bindParam(':user_id', $userId);
            $stmtCores->execute(); // Executar a consulta
            // Recuperar os IDs das cores associadas ao usuário
            $coresAssociadas = $stmtCores->fetchAll(PDO::FETCH_COLUMN);

            // Consulta SQL para obter os detalhes das cores associadas ao usuário
            $stmtDetalhesCores = $pdo->prepare('SELECT id, name, hexadecimal FROM colors WHERE id IN (' . implode(',', $coresAssociadas) . ')');
            $stmtDetalhesCores->execute(); // Executar a consulta

            // Recuperar os detalhes das cores associadas ao usuário
            $coresDoUsuario = $stmtDetalhesCores->fetchAll(PDO::FETCH_ASSOC);
            ?>

            <table style='width:100%'>
                <tr>
                    <td><label for="email">Selecione as cores que deseja incluir em sua escolha:</label><br /><br />
                        <select class="form-control js-example-basic-multiple" style='height:200px' name="cores[]" multiple="multiple">
                            <?php
                            // Se o usuário não tiver cores associadas, exibe todas as cores disponíveis
                            foreach ($stmt as $cores) {
                                echo "<option value='{$cores['id']}' style='background-color:{$cores['hexadecimal']}; color:#fff;'>{$cores['name']}</option>";
                            }
                            ?>
                        </select>
                        <label class="custom-file-label"><b>Precione a tecla ctrl para escolher mais de uma cor</b></label>
                    </td>
                    <td><label for="email">Cores já selecionadas anteriormente:</label><br /><br />
                        <select class="form-control js-example-basic-multiple" style='height:200px' name="coresUser[]" multiple="multiple">
                            <?php
                            // Exibir as opções do select com as cores associadas ao usuário
                            foreach ($coresDoUsuario as $cor) {
                                echo "<option value='{$cor['id']}' style='background-color:{$cor['hexadecimal']}; color:#fff;'>{$cor['name']}</option>";
                            }
                            ?>
                        </select>
                        <label class="custom-file-label"><b>Precione a tecla ctrl seleciona para remover</b></label>
                    </td>
                </tr>
            </table>

        </div>
        <div class="form-group" style='margin-top:20px;'>
            <button type="submit" class="btn btn-primary" style='font-size:20px'>Salvar</button>
            <a href='\' class="btn btn-success" style='font-size:20px'>Voltar</a>
        </div>
    </form>
</div>

<script>
    $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
    });
</script>