<div class="lista-model">
    <main class="cards">
        <header>
            <nav class="navag">
                <div class="nav-left">
                </div>
                <div class="nav-right">
                    <button class="btn-novo" id="abrir">+ Novo projeto</button>
                </div>
            </nav>
        </header>

        <?php 
        
        $sql = "SELECT * FROM modelos";

        $res = $conn->query($sql);

        $qtd = $res->num_rows;

$sql = "SELECT * FROM modelos";
$res = $conn->query($sql);
$qtd = $res->num_rows;

if ($qtd > 0) {
    print "<div class='dash-grid'>";
    print "<div class='card'>";
    print "<div class='card-head'><span class='card-title'>Listagem de modelos</span></div>";
    print "<div class='tbl-wrap'>";
    print "<table>";
    print "<thead>";
    print "<tr>";
    print "<th>Id</th>";
    print "<th>Nome do modelo</th>";
    print "<th>Marca do veículo</th>";
    print "<th>Ações</th>";
    print "</tr>";
    print "</thead>";
    print "<tbody>";

    while ($row = $res->fetch_object()) {
        print "<tr>";
        print "<td class='bold'>" . $row->id . "</td>";
        print "<td><span>" . htmlspecialchars($row->nome) . "</span></td>";
        print "<td><span>" . htmlspecialchars($row->marca) . "</span></td>";
        print "<td>
            <button type='button' onclick=\"location.href='?page=home&view=cad-model&acao=editar&id=" . $row->id . "'\">Editar</button>
        </td>";
        print "</tr>";
    }

    print "</tbody>";
    print "</table>";
    print "</div>";
    print "</div>";
    print "</div>";
} else {
    print "<p>Nenhum modelo cadastrado.</p>";
}
?>
    </main>
</div>

<div class="model-overlay" style="display:none;" id="overlay">
    <dialog class="proj-modal" id="meuPopup" style="border: none; padding:0;">

        <div class="proj-modal-head">
            <span class="proj-modal-titulo">+ Novo projeto</span>
            <button class="proj-modal-fechar" id="fechar" type="button">×</button>
        </div>

        <form action="?page=config-model" method="POST">
            <input type="hidden" name="acao" value="cadastrar">
            <input type="hidden" name="tipo" id="tipoInput" value="unico">

            <div class="proj-modal-body">

                <div>
                    <label class="f-label">Nome do modelo *</label>
                    <input class="f-input" name="nome-modelo" placeholder="Ex: Civic" required>
                </div>

                <div>
                    <label class="f-label">Marca do veículo*</label>
                    <input class="f-input" name="marca-modelo" placeholder="Ex: Toyota" required>
                </div>

            </div>

            <div class="proj-modal-footer">
                <button type="button" class="btn-cancelar" id="cancelar">Cancelar</button>
                <button type="submit" class="btn-salvar">Cadastrar modelo</button>
            </div>

        </form>

    </dialog>
</div>

<script>
    const botaoAbrir  = document.getElementById("abrir");
    const botaoFechar = document.getElementById("fechar");
    const botaoCancelar = document.getElementById("cancelar");
    const overlay = document.getElementById("overlay");
    const popup   = document.getElementById("meuPopup");

    function abrirModal() {
        overlay.style.display = "flex";
        popup.showModal();
    }

    function fecharModal() {
        popup.close();
        overlay.style.display = "none";
    }

    botaoAbrir.addEventListener("click", abrirModal);
    botaoFechar.addEventListener("click", fecharModal);
    botaoCancelar.addEventListener("click", fecharModal);

    // Toggle Serviço único / Plano
    const tipoInput = document.getElementById("tipoInput");
    document.querySelectorAll(".tipo-btn").forEach(btn => {
        btn.addEventListener("click", () => {
            document.querySelectorAll(".tipo-btn").forEach(b => b.classList.remove("ativo"));
            btn.classList.add("ativo");
            tipoInput.value = btn.dataset.tipo;
        });
    });
</script>