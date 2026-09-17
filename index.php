<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Portal AutoTech — ferramentas rápidas para oficina mecânica.">
<title>Portal AutoTech</title>
<link rel="stylesheet" href="css/style.css">
<script src="js/app.js" defer></script>
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
    <a href="index.php">⌂ Início</a>
    <a href="ferramentas/calculadora-orcamento.php">Orçamento</a>
    <a href="ferramentas/troca-pneus.php">Pneus</a>
    <a href="ferramentas/calculadora-combustivel.php">Combustível</a>
    <a href="ferramentas/avaliador-manutencao.php">Serviço</a>
    <a href="ferramentas/simulador-viagem.php">Viagem</a>
</nav>

<main class="ferramentas">
    <div class="hero-home">
        <div>
            <h2>Pesquisar ferramentas</h2>
            <p>Digite o nome de uma ferramenta para mostrar somente o que você pesquisou.</p>
        </div>
        <div class="painel-contagem" id="contador-ferramentas">Digite para pesquisar</div>
    </div>

    <div class="filtro-ferramentas">
        <input
            type="search"
            id="buscar-ferramenta"
            placeholder="🔎 Digite o que deseja pesquisar..."
            aria-label="Buscar ferramenta"
        >
    </div>

    <section class="grid-ferramentas" aria-label="Ferramentas AutoTech">

        <article class="card" data-nome="orçamento peças mão de obra">
            <div class="icone" aria-hidden="true">💰</div>
            <h3>Calculadora de Orçamento</h3>
            <p>Calcule rapidamente o valor de peças e mão de obra para apresentar um orçamento.</p>
            <a href="ferramentas/calculadora-orcamento.php" class="botao">Acessar →</a>
        </article>

        <article class="card" data-nome="pneus troca montagem balanceamento">
            <div class="icone" aria-hidden="true"><img src="img/pneu2.png" width="50" height="50"></div>
            <h3>Calculadora de Pneus</h3>
            <p>Some pneus, montagem e balanceamento para chegar ao valor total do serviço.</p>
            <a href="ferramentas/troca-pneus.php" class="botao">Acessar →</a>
        </article>

        <article class="card" data-nome="combustível consumo gasolina etanol">
            <div class="icone" aria-hidden="true">⛽</div>
            <h3>Calculadora de Combustível</h3>
            <p>Analise consumo médio, custo total e custo por quilômetro do veículo.</p>
            <a href="ferramentas/calculadora-combustivel.php" class="botao">Acessar →</a>
        </article>

        <article class="card" data-nome="manutenção serviço revisão veículo">
            <div class="icone" aria-hidden="true">🔧</div>
            <h3>Avaliador de Manutenção</h3>
            <p>Verifique a situação da manutenção preventiva com base na quilometragem.</p>
            <a href="ferramentas/avaliador-manutencao.php" class="botao">Acessar →</a>
        </article>

        <article class="card" data-nome="viagem estrada combustível rota">
            <div class="icone" aria-hidden="true">🛣️</div>
            <h3>Simulador de Viagem</h3>
            <p>Estime litros necessários e custo de combustível para uma viagem de ida ou ida e volta.</p>
            <a href="ferramentas/simulador-viagem.php" class="botao">Acessar →</a>
        </article>

    </section>

    <div class="sem-resultados" id="sem-resultados">
        Nenhuma ferramenta encontrada. Tente outro termo.
    </div>
</main>

<footer class="rodape">
    <div class="rodape-grid">
        <div class="rodape-coluna">
            <h3>Auto<span style="color:#e52525;">Tech</span></h3>
            <p>Portal de ferramentas para oficina mecânica.</p>
        </div>
        <div class="rodape-coluna">
            <h3>Ferramentas</h3>
            <p><a href="ferramentas/calculadora-orcamento.php">Orçamento</a></p>
            <p><a href="ferramentas/troca-pneus.php">Pneus</a></p>
            <p><a href="ferramentas/calculadora-combustivel.php">Combustível</a></p>
        </div>
        <div class="rodape-coluna">
            <h3>AutoTech</h3>
            <p>Qualidade em cada quilômetro.</p>
            <p>Santana de Parnaíba - SP</p>
        </div>
    </div>
    <div class="copyright">© <span class="ano-atual">2026</span> AutoTech - Portal de Ferramentas</div>
</footer>

</body>
</html>
