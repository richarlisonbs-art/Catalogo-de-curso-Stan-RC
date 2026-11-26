<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscrição em Cursos de Programação</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <main class="container">
        <h1>Inscrição em Cursos de Programação</h1>

        <!-- method="POST": dados pessoais nunca devem ir na URL (GET) -->
        <form id="formInscricao" action="resultado.php" method="POST" novalidate>
            <div class="campo">
                <label for="nome">Nome completo</label>
                <input type="text" id="nome" name="nome" required>
            </div>

            <div class="campo">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="campo">
                <label for="idade">Idade</label>
                <input type="number" id="idade" name="idade" min="1" required>
            </div>

            <div class="campo">
                <label for="curso">Curso</label>
                <select id="curso" name="curso" required>
                    <option value="">-- Selecione --</option>
                    <option value="PHP">PHP</option>
                    <option value="Python">Python</option>
                    <option value="JavaScript">JavaScript</option>
                    <option value="Java">Java</option>
                </select>
            </div>

            <!-- Área de feedback visual controlada pelo jQuery -->
            <div id="mensagem" aria-live="polite"></div>

            <div class="botoes">
                <button type="button" id="btnLimpar" class="btn btn-secundario">Limpar</button>
                <button type="submit" id="btnEnviar" class="btn btn-primario">Enviar</button>
            </div>
        </form>
    </main>

    <!-- jQuery precisa ser carregado ANTES do script.js, que depende dele -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>
</html>
