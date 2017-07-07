<div class="container col-md-4 col-md-offset-4">
    <p>
        <?php if(isset($_REQUEST["message"])){
        echo '<div class="alert alert-warning alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        '.$_REQUEST["message"].' 
                    </div>';
        }?>
        <form class="form-signin" method="post" action="session.php">
            <h2 class="form-signin-heading">VaptVupt- Efetuar Login</h2>
            <label for="login" class="sr-only">Login</label>
            <input type="login" id="login" class="form-control" placeholder="Login" required="" autofocus="" name="login">
            <label for="senha" class="sr-only">Senha</label>
            <input type="password" id="senha" class="form-control" placeholder="Senha" required="" name="senha">
            <div class="form-group">           
                    <input type="radio" name="tipoLogin" value="1" checked=""> Cliente
                    <input type="radio" name="tipoLogin" value="2"> Funcionário
            </div>
            <button class="btn btn-lg btn-success btn-block" type="submit">Efetuar Login</button>
            <!-- <div class="text-center">
                <a href="index.php?module=usuario&action=create" class="link">Cadastre seu usuário aqui</a>
            </div> -->
        </form>
    </p>
</div>