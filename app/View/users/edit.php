<?php 
    $stmt = $pdo->query('SELECT * FROM colors;');
?>
<style>
#editprin{
    margin-top:5%; box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.75); border-radius: 10px; width:70%; padding:20px 20px 20px 20px
}
</style>

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
            <label for="email">Cor preferida:</label><br>
            <select class="form-control" name='cor' id='cor'>
                <option></option>
                <?php            
                foreach ($stmt as $cores) {
                    $colorName = $cores['name']; // Corrigido para acessar o nome da cor atual
                    // Verifica se a cor atual é a mesma que a cor associada ao usuário
                    if ($colorName === $user['color_name']) {
                        // Se for a mesma cor, define o atributo "selected" para a opção e define a cor de fundo
                        echo "<option value='{$cores['id']}' style='background-color:{$cores['hexadecimal']}; color:#fff' selected>{$cores['name']}</option>";
                    } else {
                        // Caso contrário, apenas exibe a opção sem o atributo "selected"
                        echo "<option value='{$cores['id']}' style='background-color:{$cores['hexadecimal']}; color:#fff'>{$cores['name']}</option>";
                    }
                }
                ?>
            </select>
        </div>
        <div class="form-group" style='margin-top:20px;'>
            <button type="submit" class="btn btn-primary" style='font-size:20px'>Salvar</button>
            <a href='\' class="btn btn-success" style='font-size:20px'>Voltar</a>
        </div>
    </form>
</div>


