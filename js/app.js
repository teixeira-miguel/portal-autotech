document.addEventListener("DOMContentLoaded", () => {
    // Marca automaticamente a página atual no menu.
    const paginaAtual = window.location.pathname.split("/").pop() || "index.php";
    document.querySelectorAll(".menu a").forEach(link => {
        const destino = link.getAttribute("href")?.split("/").pop();
        if (destino === paginaAtual) link.classList.add("ativo");
    });

    // Pesquisa:
    // - Sem texto: todos os cards permanecem visíveis na tela inicial.
    // - Com texto: mostra somente os cards que correspondem à pesquisa.
    const busca = document.querySelector("#buscar-ferramenta");
    const cards = [...document.querySelectorAll(".card[data-nome]")];
    const contador = document.querySelector("#contador-ferramentas");
    const vazio = document.querySelector("#sem-resultados");

    function filtrar() {
        if (!busca || !cards.length) return;

        const termo = busca.value.trim().toLowerCase();
        let visiveis = 0;

        cards.forEach(card => {
            const nome = (card.dataset.nome || "").toLowerCase();
            const texto = card.textContent.toLowerCase();

            // Sem pesquisa, mostra todos.
            // Com pesquisa, mostra apenas o solicitado.
            const mostrar = termo.length === 0 || nome.includes(termo) || texto.includes(termo);

            card.style.display = mostrar ? "flex" : "none";
            if (mostrar) visiveis++;
        });

        if (contador) {
            contador.textContent = termo
                ? `${visiveis} ${visiveis === 1 ? "resultado encontrado" : "resultados encontrados"}`
                : `${visiveis} ferramentas disponíveis`;
        }

        if (vazio) {
            vazio.style.display = termo && visiveis === 0 ? "block" : "none";
        }
    }

    busca?.addEventListener("input", filtrar);

    // Inicialmente, todos os cards ficam na tela.
    filtrar();

    // Mantém o ano do rodapé atualizado.
    document.querySelectorAll(".ano-atual").forEach(el => {
        el.textContent = new Date().getFullYear();
    });
});
