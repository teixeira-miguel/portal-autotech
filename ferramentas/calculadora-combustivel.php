<?php
$resultado = null;
$erro = null;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $distancia = (float) str_replace(",", ".", $_POST["distancia"] ?? 0);
    $litros = (float) str_replace(",", ".", $_POST["litros"] ?? 0);
    $precoLitro = (float) str_replace(",", ".", $_POST["preco_litro"] ?? 0);

    if ($distancia <= 0 || $litros <= 0) {
        $erro = "Informe uma distância e uma quantidade de litros maiores que zero.";
    } else {
        $consumoMedio = $distancia / $litros;
        $custoTotal = $litros * $precoLitro;
        $custoPorKm = $custoTotal / $distancia;

        // Observação: a atividade original trazia uma tabela/imagem de classificação
        // que não pôde ser extraída do documento. As faixas abaixo são uma referência
        // razoável — ajuste os valores conforme a tabela repassada pelo professor.
        if ($consumoMedio < 8) {
            $classificacao = "Consumo alto (baixa eficiência)";
        } elseif ($consumoMedio <= 12) {
            $classificacao = "Consumo médio";
        } else {
            $classificacao = "Consumo econômico";
        }

        $resultado = compact("distancia", "litros", "precoLitro", "consumoMedio", "custoTotal", "custoPorKm", "classificacao");
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
<title>Calculadora de Combustível - Portal AutoTech</title>
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
<h2>⛽ Calculadora de Combustível</h2>
<p class="subtitulo">Avalie o consumo médio e o custo do combustível do veículo.</p>

<form class="formulario" method="post" action="calculadora-combustivel.php">
<div class="campo">
<label for="distancia">Distância percorrida (km)</label>
<input type="text" id="distancia" name="distancia" placeholder="Ex: 400" required
       value="<?= $resultado !== null ? htmlspecialchars($resultado["distancia"]) : "" ?>">
</div>

<div class="campo">
<label for="litros">Quantidade de litros consumidos</label>
<input type="text" id="litros" name="litros" placeholder="Ex: 35" required
       value="<?= $resultado !== null ? htmlspecialchars($resultado["litros"]) : "" ?>">
</div>

<div class="campo">
<label for="preco_litro">Preço do litro do combustível (R$)</label>
<input type="text" id="preco_litro" name="preco_litro" placeholder="Ex: 6,00" required
       value="<?= $resultado !== null ? htmlspecialchars($resultado["precoLitro"]) : "" ?>">
</div>

<button type="submit" class="botao enviar">Calcular consumo</button>
</form>

<?php if ($erro !== null): ?>
<div class="erro"><?= htmlspecialchars($erro) ?></div>
<?php endif; ?>

<?php if ($resultado !== null): ?>
<div class="resultado">
    <h3><span class="resultado-icone" aria-hidden="true">⛽</span> Resultado do consumo</h3>
    <div class="resultado-linhas">
        <div class="resultado-linha"><span>Distância percorrida:</span><strong><?= formatarNumero($resultado["distancia"]) ?> km</strong></div>
        <div class="resultado-linha"><span>Litros consumidos:</span><strong><?= formatarNumero($resultado["litros"]) ?> L</strong></div>
        <div class="resultado-divisor"></div>
        <div class="resultado-linha"><span>Consumo médio:</span><strong><?= formatarNumero($resultado["consumoMedio"]) ?> km/L</strong></div>
        <div class="resultado-linha"><span>Custo total:</span><strong><?= formatarMoeda($resultado["custoTotal"]) ?></strong></div>
        <div class="resultado-linha"><span>Custo por km:</span><strong><?= formatarMoeda($resultado["custoPorKm"]) ?></strong></div>
        <div class="resultado-linha"><span>Classificação:</span><strong><?= htmlspecialchars($resultado["classificacao"]) ?></strong></div>
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
