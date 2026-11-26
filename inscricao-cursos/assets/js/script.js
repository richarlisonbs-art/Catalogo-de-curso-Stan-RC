// Todos os handlers ficam dentro do $(document).ready(), garantindo que
// o HTML já foi carregado antes de o jQuery procurar os elementos.
$(document).ready(function () {

    var $mensagem = $('#mensagem');

    // Exibe uma mensagem na área #mensagem. tipo: 'info' | 'erro'
    // Usamos .text() (e não .html()) para evitar XSS com o texto digitado.
    function mostrarMensagem(texto, tipo) {
        $mensagem
            .removeClass('info erro')
            .addClass(tipo || 'info')
            .text(texto)
            .show();
    }

    function limparMensagem() {
        $mensagem.removeClass('info erro').text('').hide();
    }

    // 1) click() no botão Limpar: zera todos os campos e a área de mensagem
    $('#btnLimpar').click(function () {
        $('#formInscricao')[0].reset(); // reseta inputs e select
        limparMensagem();
        $('#nome').focus();
    });

    // 2) evento 'input' no nome (dispara a cada caractere, inclusive colar):
    //    mostra "Olá, [nome]!" enquanto o usuário digita
    $('#nome').on('input', function () {
        var nome = $.trim($(this).val());
        if (nome !== '') {
            mostrarMensagem('Olá, ' + nome + '!', 'info');
        } else {
            limparMensagem();
        }
    });

    // 3) change() no select: informa o curso escolhido
    $('#curso').change(function () {
        var curso = $(this).val();
        if (curso !== '') {
            mostrarMensagem('Curso selecionado: ' + curso, 'info');
        } else {
            limparMensagem();
        }
    });

    // 4) submit() do formulário: valida TODOS os campos.
    //    Se algo estiver inválido, event.preventDefault() cancela o envio.
    //    As mesmas regras são repetidas no resultado.php (validação server-side).
    $('#formInscricao').submit(function (event) {
        var nome  = $.trim($('#nome').val());
        var email = $.trim($('#email').val());
        var idade = $.trim($('#idade').val());
        var curso = $('#curso').val();
        var erros = [];

        if (nome === '')  { erros.push('nome'); }

        // Regex simples de e-mail (o PHP usa FILTER_VALIDATE_EMAIL)
        if (email === '' || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            erros.push('e-mail válido');
        }

        // Idade: inteiro positivo (>= 1), igual ao filter_var do PHP
        if (!/^\d+$/.test(idade) || parseInt(idade, 10) < 1) {
            erros.push('idade (número inteiro maior que 0)');
        }

        if (!curso) { erros.push('curso'); }

        if (erros.length > 0) {
            event.preventDefault(); // impede o envio ao servidor
            mostrarMensagem('Preencha corretamente: ' + erros.join(', ') + '.', 'erro');
        }
    });
});
