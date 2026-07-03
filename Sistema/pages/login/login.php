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
                    Email
                </label>
                <input type="email" id="email" class="form-input" name="email" placeholder="Escreva seu email">

                <label>
                    Senha
                </label>
                <input type="password" id="senha" class="form-input" name="senha" placeholder="Escreva sua senha">

                <button type="submit" class="login-button">
                    Entrar
                </button>
                <div class="login-footer">
                    <p></p>
                    <div style="margin-top: 10px;">
                        <a href="index.php?page=cad-user">Cadastre-se</a>
                    </div>
                </div>
        </div>
    </section>