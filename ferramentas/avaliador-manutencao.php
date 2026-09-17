<?php
$resultado = null;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $tipoVeiculo = $_POST["tipo_veiculo"] ?? "carro";
    $kmAtual = (float) str_replace(",", ".", $_POST["km_atual"] ?? 0);
    $kmUltimaManutencao = (float) str_replace(",", ".", $_POST["km_manutencao"] ?? 0);

    $kmPercorridos = $kmAtual - $kmUltimaManutencao;

    if ($tipoVeiculo === "moto") {
        if ($kmPercorridos <= 3000) {
            $situacao = "Manutenção em dia";
            $statusClasse = "status-ok";
        } elseif ($kmPercorridos <= 6000) {
            $situacao = "Manutenção recomendada";
            $statusClasse = "status-atencao";
        } else {
            $situacao = "Manutenção necessária";
            $statusClasse = "status-critico";
        }
    } else {
        if ($kmPercorridos <= 5000) {
            $situacao = "Manutenção em dia";
            $statusClasse = "status-ok";
        } elseif ($kmPercorridos <= 10000) {
            $situacao = "Manutenção recomendada";
            $statusClasse = "status-atencao";
        } else {
            $situacao = "Manutenção necessária";
            $statusClasse = "status-critico";
        }
    }

    $resultado = compact("tipoVeiculo", "kmAtual", "kmUltimaManutencao", "kmPercorridos", "situacao", "statusClasse");
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Ferramenta AutoTech para oficina mecânica.">
<title>Avaliador de Manutenção - Portal AutoTech</title>
<link rel="stylesheet" href="../css/style.css">
<script src="../js/app.js" defer></script>
</head>
<body>

<header class="topo">
<div class="logo">
<h1>Auto<span>Tech</span></h1>
<p>OFICINA MECÂNICA</p>
</div>
<div class="informacao">
<h3>PORTAL DE FERRAMENTAS</h3>
<p>Soluções rápidas para o dia a dia da oficina</p>
</div>
</header>

<nav class="menu" aria-label="Navegação principal">
<a href="../index.php">⌂ Início</a>
<a href="calculadora-orcamento.php">Orçamento</a>
<a href="troca-pneus.php">Pneus</a>
<a href="calculadora-combustivel.php">Combustível</a>
<a href="avaliador-manutencao.php">Serviço</a>
<a href="simulador-viagem.php">Viagem</a>
</nav>

<section class="conteudo">
<h2>🔧 Avaliador de Manutenção</h2>
<p class="subtitulo">Veja se o veículo está em dia com a manutenção preventiva.</p>

<form class="formulario" method="post" action="avaliador-manutencao.php">
<div class="campo">
<label for="tipo_veiculo">Tipo de veículo</label>
<select id="tipo_veiculo" name="tipo_veiculo">
<option value="carro" <?= ($resultado !== null && $resultado["tipoVeiculo"] === "carro") ? "selected" : "" ?>>Carro</option>
<option value="moto" <?= ($resultado !== null && $resultado["tipoVeiculo"] === "moto") ? "selected" : "" ?>>Motocicleta</option>
</select>
</div>

<div class="campo">
<label for="km_atual">Quilometragem atual do veículo</label>
<input type="text" id="km_atual" name="km_atual" placeholder="Ex: 45000" required
       value="<?= $resultado !== null ? htmlspecialchars($resultado["kmAtual"]) : "" ?>">
</div>

<div class="campo">
<label for="km_manutencao">Quilometragem da última manutenção</label>
<input type="text" id="km_manutencao" name="km_manutencao" placeholder="Ex: 36000" required
       value="<?= $resultado !== null ? htmlspecialchars($resultado["kmUltimaManutencao"]) : "" ?>">
</div>

<button type="submit" class="botao enviar">Verificar situação</button>
</form>

<?php if ($resultado !== null): ?>
<div class="resultado">
    <h3><span class="resultado-icone" aria-hidden="true">🔧</span> Resultado da manutenção</h3>
    <div class="resultado-linhas">
        <div class="resultado-linha"><span>Tipo de veículo:</span><strong><?= $resultado["tipoVeiculo"] === "moto" ? "Motocicleta" : "Carro" ?></strong></div>
        <div class="resultado-linha"><span>Km percorridos desde a última manutenção:</span><strong><?= number_format($resultado["kmPercorridos"], 0, ",", ".") ?> km</strong></div>
        <div class="resultado-divisor"></div>
        <div class="resultado-linha"><span>Situação:</span><strong class="<?= $resultado["statusClasse"] ?>"><?= $resultado["situacao"] ?></strong></div>
    </div>
</div>
<?php endif; ?>

<a href="../index.php" class="voltar">← Voltar para o portal</a>
</section>

<footer class="rodape">
    <div class="rodape-grid">
        <div class="rodape-coluna">
            <h3>Auto<span style="color:#e52525;">Tech</span></h3>
            <p>Portal de ferramentas para oficina mecânica.</p>
        </div>
        <div class="rodape-coluna">
            <h3>Ferramentas</h3>
            <p><a href="calculadora-orcamento.php">Orçamento</a></p>
            <p><a href="troca-pneus.php">Pneus</a></p>
            <p><a href="calculadora-combustivel.php">Combustível</a></p>
        </div>
        <div class="rodape-coluna">
            <h3>AutoTech</h3>
            <p>Qualidade em cada quilômetro.</p>
            <p><a href="../index.php">← Voltar ao portal</a></p>
        </div>
    </div>
    <div class="copyright">© <span class="ano-atual">2026</span> AutoTech - Portal de Ferramentas</div>
</footer>

</body>
</html>
