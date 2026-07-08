
       <?php

$modoEdicao = isset($_GET['acao']) && $_GET['acao'] === 'editar' && isset($_GET['id']);
$veiAtual = null;

if ($modoEdicao) {
    $stmt = $conn->prepare("SELECT * FROM veiculos WHERE id = ?");
    $stmt->bind_param("i", $_GET['id']);
    $stmt->execute();
    $veiAtual = $stmt->get_result()->fetch_object();
    $stmt->close();
}
?>

<div class="lista-model">
    <main class="cards">
        <header>
            <nav class="navag">
                <div class="nav-left"></div>
                <div class="nav-right">
                    <button class="btn-novo" id="abrir">+ Novo veículo</button>
                </div>
            </nav>
        </header>

        <?php 
      $sql = "SELECT
            veiculos.*,
            modelos.nome AS modelos
        FROM veiculos
        INNER JOIN modelos
            ON veiculos.modelo_id = modelos.id";
        $res = $conn->query($sql);
        $qtd = $res->num_rows;

        if ($qtd > 0) {
            print "<div class='dash-grid'>";
            print "<div class='card'>";
            print "<div class='card-head'><span class='card-title'>Listagem de veiculos</span></div>";
            print "<div class='tbl-wrap'>";
            print "<table>";
            
            print "<thead>
            <tr>
            <th>Id</th>
            <th>Placa</th>
            <th>Cor</th>
            <th>Ano</th>
            <th>Modelo</th>
            <th>Ações</th>
            </tr>
            </thead>";

            print "<tbody>";

            while ($row = $res->fetch_object()) {
                print "<tr>";
                print "<td class='bold radius1'>" . $row->id . "</td>";
                print "<td><span>" . htmlspecialchars($row->placa) . "</span></td>";
                print "<td><span>" . htmlspecialchars($row->cor) . "</span></td>";
                print "<td><span>" . htmlspecialchars($row->ano) . "</span></td>";
                print "<td><span>" . htmlspecialchars($row->modelos) . "</span></td>";
                print "<td class='radius2'>
                    <button class='btn btn-success btn-editar' type='button' data-id='" . $row->id . "'>Editar</button>
                    <button onclick=\"if (confirm('Tem certeza que deseja excluir?')) {
                        location.href='index.php?page=config-vei&acao=excluir&id=" . $row->id . "';
                    }\" class='btn btn-danger'>Excluir</button>
                </td>";
                print "</tr>";
            }

            print "</tbody></table></div></div></div>";
        } else {
            print "<p class='p'>Nenhum veículo cadastrado.</p>";
        }
        ?>
    </main>
</div>

<div class="model-overlay" style="display:none;" id="overlay">
    <dialog class="proj-modal" id="cadPOPUP" style="border: none; padding:0;">

        <div class="proj-modal-head">
            <span class="proj-modal-titulo"><?= $modoEdicao ? 'Editar veículo' : '+ Novo veículo' ?></span>
            <button class="proj-modal-fechar" id="fechar" type="button">×</button>
        </div>

        <form action="index.php?page=config-vei" method="POST">
            <input type="hidden" name="acao" value="<?= $modoEdicao ? 'editar' : 'cadastrar' ?>">
            <?php if ($modoEdicao): ?>
                <input type="hidden" name="id" value="<?= $veiAtual->id ?>">
            <?php endif; ?>

            <div class="proj-modal-body">
                <div>
                    <label class="f-label">Placa do veículo *</label>
                    <input class="f-input" name="placa" placeholder="Ex: ABC1B34"
                           value="<?= $modoEdicao ? htmlspecialchars($veiAtual->placa) : '' ?>"
required>
                </div>

                <div>
                    <label class="f-label">Cor do veículo*</label>
                    <input class="f-input" name="cor" placeholder="Ex: Azul"
                        value="<?= $modoEdicao ? htmlspecialchars($veiAtual->cor) : '' ?>" required>
                </div>

                <div>
                    <label class="f-label">Ano do veículo*</label>
                    <input type="number" class="f-input" name="ano" placeholder="Ex: 1996"
                          value="<?= $modoEdicao ? htmlspecialchars($veiAtual->ano) : '' ?>"required>
                </div>

                <div>
    <label class="f-label">Modelo *</label>

    <select class="f-input" name="modelo_id" required>

        <option value="">Selecione um modelo</option>

        <?php
        $sqlModelos = "SELECT * FROM modelos ORDER BY nome";
        $resModelos = $conn->query($sqlModelos);

        while($modelo = $resModelos->fetch_object()){

            $selected = "";

            if($modoEdicao && $veiAtual->modelo_id == $modelo->id){
                $selected = "selected";
            }

            echo "<option value='$modelo->id' $selected>
                    $modelo->nome - $modelo->marca
                  </option>";
        }
        ?>

    </select>
</div>
            </div>


            <div class="proj-modal-footer">
                <button type="button" class="btn-cancelar" id="cancelar">Cancelar</button>
                <button type="submit" class="btn-salvar"><?= $modoEdicao ? 'Salvar alterações' : 'Cadastrar veiculo' ?></button>
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


    document.querySelectorAll(".btn-editar").forEach(btn => {
        btn.addEventListener("click", () => {
            const id = btn.dataset.id;
            location.href = `?page=home&view=cad-vei&acao=editar&id=${id}`;
        });
    });

    <?php if ($modoEdicao): ?>

    window.addEventListener("DOMContentLoaded", abrirModal);
    <?php endif; ?>
</script>