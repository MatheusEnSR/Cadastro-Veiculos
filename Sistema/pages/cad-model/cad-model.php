
       <?php
// Detecta se é edição: precisa vir explicitamente por GET, não só ter um id qualquer solto
$modoEdicao = isset($_GET['acao']) && $_GET['acao'] === 'editar' && isset($_GET['id']);
$modeloAtual = null;

if ($modoEdicao) {
    $stmt = $conn->prepare("SELECT * FROM modelos WHERE id = ?");
    $stmt->bind_param("i", $_GET['id']);
    $stmt->execute();
    $modeloAtual = $stmt->get_result()->fetch_object();
    $stmt->close();
}
?>

<div class="lista-model">
    <main class="cards">
        <header>
            <nav class="navag">
                <div class="nav-left"></div>
                <div class="nav-right">
                    <button class="btn-novo" id="abrir">+ Novo modelo</button>
                </div>
            </nav>
        </header>

        <?php 
        $sql = "SELECT * FROM modelos";
        $res = $conn->query($sql);
        $qtd = $res->num_rows;

        if ($qtd > 0) {
            print "<div class='dash-grid'>";
            print "<div class='card'>";
            print "<div class='card-head'><span class='card-title'>Listagem de modelos</span></div>";
            print "<div class='tbl-wrap'>";
            print "<table>";
            print "<thead><tr><th>Id</th><th>Nome do modelo</th><th>Marca do veículo</th><th>Ações</th></tr></thead>";
            print "<tbody>";

            while ($row = $res->fetch_object()) {
                print "<tr>";
                print "<td class='bold'>" . $row->id . "</td>";
                print "<td><span>" . htmlspecialchars($row->nome) . "</span></td>";
                print "<td><span>" . htmlspecialchars($row->marca) . "</span></td>";
                print "<td>
                    <button class='btn btn-success btn-editar' type='button' data-id='" . $row->id . "'>Editar</button>
                    <button onclick=\"if (confirm('Tem certeza que deseja excluir?')) {
                        location.href='index.php?page=config-model&acao=excluir&id=" . $row->id . "';
                    }\" class='btn btn-danger'>Excluir</button>
                </td>";
                print "</tr>";
            }

            print "</tbody></table></div></div></div>";
        } else {
            print "<p>Nenhum modelo cadastrado.</p>";
        }
        ?>
    </main>
</div>

<div class="model-overlay" style="display:none;" id="overlay">
    <dialog class="proj-modal" id="cadPOPUP" style="border: none; padding:0;">

        <div class="proj-modal-head">
            <span class="proj-modal-titulo"><?= $modoEdicao ? 'Editar modelo' : '+ Novo projeto' ?></span>
            <button class="proj-modal-fechar" id="fechar" type="button">×</button>
        </div>

        <form action="index.php?page=config-model" method="POST">
            <input type="hidden" name="acao" value="<?= $modoEdicao ? 'editar' : 'cadastrar' ?>">
            <?php if ($modoEdicao): ?>
                <input type="hidden" name="id" value="<?= $modeloAtual->id ?>">
            <?php endif; ?>

            <div class="proj-modal-body">
                <div>
                    <label class="f-label">Nome do modelo *</label>
                    <input class="f-input" name="nome" placeholder="Ex: Civic"
                           value="<?= $modoEdicao ? htmlspecialchars($modeloAtual->nome) : '' ?>" required>
                </div>

                <div>
                    <label class="f-label">Marca do veículo*</label>
                    <input class="f-input" name="marca" placeholder="Ex: Toyota"
                           value="<?= $modoEdicao ? htmlspecialchars($modeloAtual->marca) : '' ?>" required>
                </div>
            </div>

            <div class="proj-modal-footer">
                <button type="button" class="btn-cancelar" id="cancelar">Cancelar</button>
                <button type="submit" class="btn-salvar"><?= $modoEdicao ? 'Salvar alterações' : 'Cadastrar modelo' ?></button>
            </div>
        </form>
    </dialog>
</div>

<script>
    const botaoAbrir = document.getElementById("abrir");
    const botaoFechar = document.getElementById("fechar");
    const botaoCancelar = document.getElementById("cancelar");
    const overlay = document.getElementById("overlay");
    const popup = document.getElementById("cadPOPUP");

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

    // Botões "Editar" recarregam a página com os parâmetros certos,
    // o PHP acima detecta isso e já abre o modal preenchido.
    document.querySelectorAll(".btn-editar").forEach(btn => {
        btn.addEventListener("click", () => {
            const id = btn.dataset.id;
            location.href = `?page=home&view=cad-model&acao=editar&id=${id}`;
        });
    });

    <?php if ($modoEdicao): ?>
    // Já abre o modal automaticamente ao recarregar em modo edição
    window.addEventListener("DOMContentLoaded", abrirModal);
    <?php endif; ?>
</script>