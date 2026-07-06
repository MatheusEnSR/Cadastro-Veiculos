<section class="login-container">
        <div class="login-card">
            <div class="login-header">
                <h1>
                    Cadastre-se
                </h1>
                <p>
                </p>
            </div>

           <form action="?page=config-cad" method="POST" class="form-group">
                <input type="hidden" name="acao" value="cadastrar">

                <label>
                    Nome
                </label>
                <input type="text" id="nome" class="form-input" name="nome" placeholder="Escreva seu nome">


                <label>
                    Email
                </label>
                <input type="email" id="email" class="form-input" name="email" placeholder="Escreva seu email">

                <label>
                    Senha
                </label>
                <input type="password" id="senha" class="form-input" name="senha" placeholder="Escreva sua senha">

              <button href="index.php?page=login" type="submit" class="login-button" style="margin-top: 10px;">
                    Entrar
                </button>
            </form>
        </div>
    </section>