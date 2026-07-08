<section class="login-container">

    <div class="login-card">

        <div class="login-header">
            <h1>
                Cadastro
            </h1>
        </div>


        <form action="?page=config-cad" method="POST" class="form-group">

            <input type="hidden" name="acao" value="cadastrar">


            <label>
                Nome
            </label>

            <input 
                type="text" 
                id="nome" 
                class="form-input" 
                name="nome" 
                placeholder="Escreva seu nome"
                required
            >


            <label>
                Email
            </label>

            <input 
                type="email" 
                id="email" 
                class="form-input" 
                name="email" 
                placeholder="Escreva seu email"
                required
            >


            <label>
                Login
            </label>

            <input 
                type="text" 
                id="login" 
                class="form-input" 
                name="login" 
                placeholder="Escolha seu login"
                required
            >


            <label>
                Senha
            </label>

            <input 
                type="password" 
                id="senha" 
                class="form-input" 
                name="senha" 
                placeholder="Escreva sua senha"
                required
            >


            <button type="submit" class="login-button" style="margin-top:10px;">
                Cadastrar
            </button>


            <div class="login-footer">

                <div style="margin-top:10px;">
                    <a href="index.php?page=login">
                        Já tenho uma conta
                    </a>
                </div>

            </div>

        </form>

    </div>

</section>