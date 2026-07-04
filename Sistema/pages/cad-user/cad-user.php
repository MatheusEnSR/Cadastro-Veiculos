<?php
// Detecta se é edição: precisa vir explicitamente por GET, não só ter um id qualquer solto
$modoEdicao = isset($_GET['acao']) && $_GET['acao'] === 'editar' && isset($_GET['id']);
$userAtual = null;

if ($modoEdicao) {
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE id = ?");
    $stmt->bind_param("i", $_GET['id']);
    $stmt->execute();
    $userAtual = $stmt->get_result()->fetch_object();
    $stmt->close();
}
?>

<div class="lista-model">
    <main class="cards">
        <header>
            <nav class="navag">
                <div class="nav-left"></div>
                <div class="nav-right">
                    <button class="btn-novo" id="abrir">+ Novo usuário</button>
                </div>
            </nav>
        </header>

        <?php 
        $sql = "SELECT * FROM usuarios";
        $res = $conn->query($sql);
        $qtd = $res->num_rows;

        if ($qtd > 0) {
            print "<div class='dash-grid'>";
            print "<div class='card'>";
            print "<div class='card-head'><span class='card-title'>Listagem de usuarios</span></div>";
            print "<div class='tbl-wrap'>";
            print "<table>";
            print "<thead>
            <tr>
            <th>Id</th>
            <th>Nome do usuario</th>
            <th>email</th>
            <th>login</th>
            <th>status</th>
            <th>Ações</th>
            </tr>
            </thead>";
            print "<tbody>";

            while ($row = $res->fetch_object()) {
                print "<tr>";
                print "<td class='bold'>" . $row->id . "</td>";
                print "<td><span>" . htmlspecialchars($row->nome) . "</span></td>";
                print "<td><span>" . htmlspecialchars($row->email) . "</span></td>";
                print "<td><span>" . htmlspecialchars($row->login) . "</span></td>";
                print "<td><span>" . htmlspecialchars($row->status) . "</span></td>";
                print "<td>
                    <button class='btn btn-success btn-editar' type='button' data-id='" . $row->id . "'>Editar</button>
                    <button onclick=\"if (confirm('Tem certeza que deseja excluir?')) {
                        location.href='index.php?page=config-user&acao=excluir&id=" . $row->id . "';
                    }\" class='btn btn-danger'>Excluir</button>
                </td>";
                print "</tr>";
            }

            print "</tbody></table></div></div></div>";
        } else {
            print "<p>Nenhum usuarios cadastrado.</p>";
        }
        ?>
    </main>
</div>

<div class="model-overlay" style="display:none;" id="overlay">
    <dialog class="proj-modal" id="cadPOPUP" style="border: none; padding:0;">

        <div class="proj-modal-head">
            <span class="proj-modal-titulo"><?= $modoEdicao ? 'Editar usuario' : '+ Novo usuario' ?></span>
            <button class="proj-modal-fechar" id="fechar" type="button">×</button>
        </div>

        <form action="index.php?page=config-user" method="POST">
            <input type="hidden" name="acao" value="<?= $modoEdicao ? 'editar' : 'cadastrar' ?>">
            <?php if ($modoEdicao): ?>
                <input type="hidden" name="id" value="<?= $userAtual->id ?>">
            <?php endif; ?>

            <div class="proj-modal-body">
                <div>
                    <label class="f-label">Nome do usuario *</label>
                    <input type="text" class="f-input" name="nome" placeholder="Ex: Matheus"
                           value="<?= $modoEdicao ? htmlspecialchars($userAtual->nome) : '' ?>" required>
                </div>

                <div>
                    <label class="f-label">Email do usuario*</label>
                    <input type="email" class="f-input" name="email" placeholder="Ex: matheus@gamil.com"
                           value="<?= $modoEdicao ? htmlspecialchars($userAtual->email) : '' ?>" required>
                </div>
                <div>
                    <label class="f-label">Login do usuario*</label>
                    <input class="f-input" name="login" placeholder="Ex: matheus-123"
                           value="<?= $modoEdicao ? htmlspecialchars($userAtual->login) : '' ?>" required>
                </div>
                <div>
                    <label class="f-label">Senha do usuario<?= $modoEdicao ? ' (deixe em branco para manter a atual)' : '*' ?></label>
                    <input type="password" class="f-input" name="senha" placeholder="Ex: xxxxxxxxx"
                           value="" <?= $modoEdicao ? '' : 'required' ?>>
                </div>
            </div>

            <div class="proj-modal-footer">
                <button type="button" class="btn-cancelar" id="cancelar">Cancelar</button>
                <button type="submit" class="btn-salvar"><?= $modoEdicao ? 'Salvar alterações' : 'Cadastrar usuario' ?></button>
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

    if (botaoAbrir) botaoAbrir.addEventListener("click", abrirModal);
    if (botaoFechar) botaoFechar.addEventListener("click", fecharModal);
    if (botaoCancelar) botaoCancelar.addEventListener("click", fecharModal);

    // Botões "Editar" recarregam a página com os parâmetros certos,
    // o PHP acima detecta isso e já abre o modal preenchido.
    document.querySelectorAll(".btn-editar").forEach(btn => {
        btn.addEventListener("click", () => {
            const id = btn.dataset.id;
            location.href = `?page=home&view=cad-user&acao=editar&id=${id}`;
        });
    });

    <?php if ($modoEdicao): ?>
    // Já abre o modal automaticamente ao recarregar em modo edição
    window.addEventListener("DOMContentLoaded", abrirModal);
    <?php endif; ?>
</script>