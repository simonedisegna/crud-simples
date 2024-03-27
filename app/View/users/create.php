<style>
    #CreateForm {
        margin-top: 5%;
        box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.75);
        border-radius: 10px;
        width: 50%;
        padding: 20px 20px 20px 20px
    }
</style>
<div class="container" id='CreateForm'>
    <h1>Novo Usuário</h1>
    <form action="/users/create" method="post">
        <div class="form-group">
            <label for="name">Nome:</label><br>
            <input type="text" class="form-control" id="name" name="name" />
        </div>
        <div class="form-group">
            <label for="email">Email:</label><br>
            <input type="email" class="form-control" id="email" name="email" />
        </div><br>
        <div class="form-group" style='margin-top:20px;'>
            <button type="submit" class="btn btn-primary" style='font-size:20px'>Salvar</button>
            <a href='\' class="btn btn-success" style='font-size:20px'>Voltar</a>
        </div>
    </form>
</div>