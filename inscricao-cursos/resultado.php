<?php
/**
 * resultado.php — processa a inscrição enviada via POST.
 * O PHP valida TUDO de novo: a validação do jQuery pode ser desligada
 * ou burlada pelo usuário, então nunca confiamos só nela.
 */

// Função auxiliar: escapa qualquer dado do usuário antes de exibir (anti-XSS)
function e($valor)
{
    return htmlspecialchars((string) $valor, ENT_QUOTES, 'UTF-8');
}

$erros   = [];
$sucesso = false;

// Só aceita requisições POST (dados pessoais não trafegam por GET)
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $erros[] = 'Acesso inválido. Envie o formulário de inscrição.';
} else {
    // trim() remove espaços; o ?? '' evita aviso se o campo não vier
    $nome  = trim($_POST['nome']  ?? '');
    $email = trim($_POST['email'] ?? '');
    $idade = trim($_POST['idade'] ?? '');
    $curso = trim($_POST['curso'] ?? '');

    // 1) Campos obrigatórios — mesmas regras do script.js
    // Obs.: empty('0') é true; idade "0" também é inválida, então serve aqui.
    if (empty($nome))  { $erros[] = 'O nome é obrigatório.'; }
    if (empty($email)) { $erros[] = 'O e-mail é obrigatório.'; }
    if (empty($idade)) { $erros[] = 'A idade é obrigatória.'; }
    if (empty($curso)) { $erros[] = 'O curso é obrigatório.'; }

    // 2) Formato do e-mail
    if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        $erros[] = 'Informe um e-mail válido.';
    }

    // 3) Idade: inteiro positivo (min_range = 1)
    if (!empty($idade)) {
        $idadeInt = filter_var($idade, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
        if ($idadeInt === false) {
            $erros[] = 'A idade deve ser um número inteiro maior que zero.';
        }
    }

    // 4) Curso precisa ser uma das opções do select (lista branca)
    $cursosValidos = ['PHP', 'Python', 'JavaScript', 'Java'];
    if (!empty($curso) && !in_array($curso, $cursosValidos, true)) {
        $erros[] = 'Curso inválido.';
    }

    $sucesso = empty($erros);
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado da Inscrição</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <main class="container">
        <h1>Resultado da Inscrição</h1>

        <?php if ($sucesso): ?>
            <p class="sucesso">Inscrição realizada com sucesso!</p>
            <!-- Toda saída passa por e() = htmlspecialchars(..., ENT_QUOTES, 'UTF-8') -->
            <ul class="dados">
                <li><strong>Nome:</strong> <?= e($nome) ?></li>
                <li><strong>E-mail:</strong> <?= e($email) ?></li>
                <li><strong>Idade:</strong> <?= e($idadeInt) ?> anos</li>
                <li><strong>Curso:</strong> <?= e($curso) ?></li>
            </ul>
            <a href="index.php" class="btn btn-primario voltar">Nova inscrição</a>
        <?php else: ?>
            <div class="erro-box">
                <p><strong>Não foi possível concluir a inscrição:</strong></p>
                <ul>
                    <?php foreach ($erros as $erro): ?>
                        <li><?= e($erro) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <a href="index.php" class="btn btn-secundario voltar">Voltar ao formulário</a>
        <?php endif; ?>
    </main>
</body>
</html>
