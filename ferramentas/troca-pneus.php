<?php
$resultado = null;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $marca = trim($_POST["marca"] ?? "");
    $preco = (float) str_replace(",", ".", $_POST["preco"] ?? 0);
    $quantidade = (int) ($_POST["quantidade"] ?? 0);
    $montagem = (float) str_replace(",", ".", $_POST["montagem"] ?? 0);
    $balanceamento = (float) str_replace(",", ".", $_POST["balanceamento"] ?? 0);

    $valorPneus = $preco * $quantidade;
    $valorMontagem = $montagem * $quantidade;
    $valorBalanceamento = $balanceamento * $quantidade;
    $total = $valorPneus + $valorMontagem + $valorBalanceamento;

    $resultado = compact(
        "marca", "preco", "quantidade", "montagem", "balanceamento",
        "valorPneus", "valorMontagem", "valorBalanceamento", "total"
    );
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
<title>Simulador de Troca de Pneus - Portal AutoTech</title>
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
<h2><span class="icone-pneu" aria-hidden="true">
<img src="../img/pneu2.png" width="50" height="50">
</span> Calculadora de Pneus</h2>
<p class="subtitulo">Calcule o valor total da troca, incluindo montagem e balanceamento.</p>

<form class="formulario" method="post" action="troca-pneus.php">
<div class="campo">
<label for="marca">Marca ou modelo do pneu</label>
<input type="text" id="marca" name="marca" placeholder="Ex: Pirelli Cinturato" required
       value="<?= $resultado !== null ? htmlspecialchars($resultado["marca"]) : "" ?>">
</div>

<div class="campo">
<label for="preco">Preço de cada pneu (R$)</label>
<input type="text" id="preco" name="preco" placeholder="Ex: 380,00" required
       value="<?= $resultado !== null ? htmlspecialchars($resultado["preco"]) : "" ?>">
</div>

<div class="campo">
<label for="quantidade">Quantidade de pneus</label>
<input type="number" id="quantidade" name="quantidade" min="1" placeholder="Ex: 4" required
       value="<?= $resultado !== null ? htmlspecialchars($resultado["quantidade"]) : "" ?>">
</div>

<div class="campo">
<label for="montagem">Valor da montagem por pneu (R$)</label>
<input type="text" id="montagem" name="montagem" placeholder="Ex: 25,00" required
       value="<?= $resultado !== null ? htmlspecialchars($resultado["montagem"]) : "" ?>">
</div>

<div class="campo">
<label for="balanceamento">Valor do balanceamento por pneu (R$)</label>
<input type="text" id="balanceamento" name="balanceamento" placeholder="Ex: 20,00" required
       value="<?= $resultado !== null ? htmlspecialchars($resultado["balanceamento"]) : "" ?>">
</div>

<button type="submit" class="botao enviar">Calcular valor total</button>
</form>

<?php if ($resultado !== null): ?>
<div class="resultado">
    <h3><span class="resultado-icone" aria-hidden="true">🛞</span> Resultado da troca de pneus</h3>
    <div class="resultado-linhas">
        <div class="resultado-linha"><span>Pneu:</span><strong><?= htmlspecialchars($resultado["marca"]) ?> (x<?= $resultado["quantidade"] ?>)</strong></div>
        <div class="resultado-divisor"></div>
        <div class="resultado-linha"><span>Pneus:</span><strong><?= formatarMoeda($resultado["valorPneus"]) ?></strong></div>
        <div class="resultado-linha"><span>Montagem:</span><strong><?= formatarMoeda($resultado["valorMontagem"]) ?></strong></div>
        <div class="resultado-linha"><span>Balanceamento:</span><strong><?= formatarMoeda($resultado["valorBalanceamento"]) ?></strong></div>
        <div class="resultado-divisor"></div>
        <div class="resultado-linha resultado-total"><span>Total:</span><strong><?= formatarMoeda($resultado["total"]) ?></strong></div>
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
