<?php
$resultado = null;
$erro = null;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $distancia = (float) str_replace(",", ".", $_POST["distancia"] ?? 0);
    $consumo = (float) str_replace(",", ".", $_POST["consumo"] ?? 0);
    $preco = (float) str_replace(",", ".", $_POST["preco"] ?? 0);
    $tipoViagem = $_POST["tipo_viagem"] ?? "ida";

    if ($consumo <= 0) {
        $erro = "O consumo médio do veículo deve ser maior que zero.";
    } else {
        $distanciaTotal = ($tipoViagem === "ida_volta") ? $distancia * 2 : $distancia;
        $litrosNecessarios = $distanciaTotal / $consumo;
        $custoEstimado = $litrosNecessarios * $preco;

        $resultado = compact("distancia", "distanciaTotal", "consumo", "preco", "tipoViagem", "litrosNecessarios", "custoEstimado");
    }
}

function formatarMoeda($valor) {
    return "R$ " . number_format($valor, 2, ",", ".");
}
function formatarNumero($valor, $casas = 2) {
    return number_format($valor, $casas, ",", ".");
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Ferramenta AutoTech para oficina mecânica.">
<title>Simulador de Viagem - Portal AutoTech</title>
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
<h2>🛣️ Simulador de Viagem</h2>
<p class="subtitulo">Estime quanto o cliente irá gastar com combustível na viagem.</p>

<form class="formulario" method="post" action="simulador-viagem.php">
<div class="campo">
<label for="distancia">Distância da viagem (km)</label>
<input type="text" id="distancia" name="distancia" placeholder="Ex: 500" required
       value="<?= $resultado !== null ? htmlspecialchars($resultado["distancia"]) : "" ?>">
</div>

<div class="campo">
<label for="consumo">Consumo médio do veículo (km/L)</label>
<input type="text" id="consumo" name="consumo" placeholder="Ex: 12" required
       value="<?= $resultado !== null ? htmlspecialchars($resultado["consumo"]) : "" ?>">
</div>

<div class="campo">
<label for="preco">Preço do combustível (R$)</label>
<input type="text" id="preco" name="preco" placeholder="Ex: 6,00" required
       value="<?= $resultado !== null ? htmlspecialchars($resultado["preco"]) : "" ?>">
</div>

<div class="campo">
<label for="tipo_viagem">Tipo de viagem</label>
<select id="tipo_viagem" name="tipo_viagem">
<option value="ida" <?= ($resultado !== null && $resultado["tipoViagem"] === "ida") ? "selected" : "" ?>>Somente ida</option>
<option value="ida_volta" <?= ($resultado !== null && $resultado["tipoViagem"] === "ida_volta") ? "selected" : "" ?>>Ida e volta</option>
</select>
</div>

<button type="submit" class="botao enviar">Calcular estimativa</button>
</form>

<?php if ($erro !== null): ?>
<div class="erro"><?= htmlspecialchars($erro) ?></div>
<?php endif; ?>

<?php if ($resultado !== null): ?>
<div class="resultado">
    <h3><span class="resultado-icone" aria-hidden="true">🛣️</span> Resultado da viagem</h3>
    <div class="resultado-linhas">
        <div class="resultado-linha"><span>Distância total:</span><strong><?= formatarNumero($resultado["distanciaTotal"], 0) ?> km</strong></div>
        <div class="resultado-linha"><span>Tipo de viagem:</span><strong><?= $resultado["tipoViagem"] === "ida_volta" ? "Ida e volta" : "Somente ida" ?></strong></div>
        <div class="resultado-divisor"></div>
        <div class="resultado-linha"><span>Consumo:</span><strong><?= formatarNumero($resultado["consumo"]) ?> km/L</strong></div>
        <div class="resultado-linha"><span>Combustível necessário:</span><strong><?= formatarNumero($resultado["litrosNecessarios"]) ?> L</strong></div>
        <div class="resultado-linha"><span>Custo estimado:</span><strong><?= formatarMoeda($resultado["custoEstimado"]) ?></strong></div>
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
