<?php
$resultado = null;
$alertaAltoValor = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $servico = trim($_POST["servico"] ?? "");
    $pecas = (float) str_replace(",", ".", $_POST["pecas"] ?? 0);
    $maoDeObra = (float) str_replace(",", ".", $_POST["mao_obra"] ?? 0);

    $total = $pecas + $maoDeObra;

    if ($total > 1000) {
        $alertaAltoValor = true;
    }

    $resultado = [
        "servico" => $servico,
        "pecas" => $pecas,
        "mao_obra" => $maoDeObra,
        "total" => $total
    ];
}

function formatarMoeda($valor) {
    return "R$ " . number_format($valor, 2, ",", ".");
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Ferramenta AutoTech para oficina mecânica.">
<title>Calculadora de Orçamento - Portal AutoTech</title>
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
<h2>💰 Calculadora de Orçamento</h2>
<p class="subtitulo">Informe os dados do serviço para calcular o valor total do orçamento.</p>

<form class="formulario" method="post" action="calculadora-orcamento.php">
<div class="campo">
<label for="servico">Descrição do serviço</label>
<input type="text" id="servico" name="servico" placeholder="Ex: Troca de pastilhas de freio" required
       value="<?= htmlspecialchars($resultado["servico"] ?? "") ?>">
</div>

<div class="campo">
<label for="pecas">Valor das peças (R$)</label>
<input type="text" id="pecas" name="pecas" placeholder="Ex: 450,00" required
       value="<?= $resultado !== null ? htmlspecialchars($resultado["pecas"]) : "" ?>">
</div>

<div class="campo">
<label for="mao_obra">Valor da mão de obra (R$)</label>
<input type="text" id="mao_obra" name="mao_obra" placeholder="Ex: 200,00" required
       value="<?= $resultado !== null ? htmlspecialchars($resultado["mao_obra"]) : "" ?>">
</div>

<button type="submit" class="botao enviar">Calcular orçamento</button>
</form>

<?php if ($resultado !== null): ?>
<div class="resultado">
    <h3><span class="resultado-icone" aria-hidden="true">💰</span> Resultado do orçamento</h3>
    <div class="resultado-linhas">
        <div class="resultado-linha"><span>Serviço:</span><strong><?= htmlspecialchars($resultado["servico"]) ?></strong></div>
        <div class="resultado-divisor"></div>
        <div class="resultado-linha"><span>Peças:</span><strong><?= formatarMoeda($resultado["pecas"]) ?></strong></div>
        <div class="resultado-linha"><span>Mão de obra:</span><strong><?= formatarMoeda($resultado["mao_obra"]) ?></strong></div>
        <div class="resultado-divisor"></div>
        <div class="resultado-linha resultado-total"><span>Total:</span><strong><?= formatarMoeda($resultado["total"]) ?></strong></div>
    </div>
</div>
<?php if ($alertaAltoValor): ?>
<div class="aviso">⚠️ Orçamento de alto valor. Consulte as condições de pagamento.</div>
<?php endif; ?>
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
