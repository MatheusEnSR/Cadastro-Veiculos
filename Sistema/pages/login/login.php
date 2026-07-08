<section class="login-container">
        <div class="login-card">
            <div class="login-header">
                <h1>
                    Login
                </h1>
                <p>
                </p>
            </div>

            <form action="?page=salvar" method="POST" class="form-group">
                <input type="hidden" name="acao" value="login">

                <label>
                    Login
                </label>
                <input type="text" id="login" class="form-input" name="login" placeholder="Escreva seu login">

                <label>
                    Senha
                </label>
                <input type="password" id="senha" class="form-input" name="senha" placeholder="Escreva sua senha">

                <button  href="index.php?page=salvar" type="submit" class="login-button" style="margin-top: 10px;">
                    Entrar
                </button>
                <div class="login-footer">
                    <p></p>
                    <div style="margin-top: 10px;">
                        <a href="index.php?page=cad-login">Cadastre-se</a>
                    </div>
                </div>
        </div>
    </section>