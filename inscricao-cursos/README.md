# 📚 Sistema Interativo de Inscrição em Cursos

Formulário de inscrição em cursos de programação feito com **HTML5, CSS3, jQuery 3.7.1 e PHP puro**, com validação no cliente e no servidor e proteção contra XSS.

> Projeto acadêmico — sem frameworks e sem banco de dados.

## ✨ Funcionalidades

- Inscrição com **nome, e-mail, idade e curso** (PHP, Python, JavaScript ou Java)
- Mensagens interativas com jQuery:
  - `click` — botão **Limpar** apaga campos e mensagens
  - `input` — exibe **"Olá, [nome]!"** enquanto o usuário digita
  - `change` — mostra **"Curso selecionado: [curso]"**
  - `submit` — valida **todos** os campos e bloqueia o envio se houver erro
- Página de resultado com confirmação dos dados ou lista de erros
- Layout centralizado e responsivo (mobile-friendly)

## 🔒 Segurança

- Envio via **POST** (dados pessoais fora da URL)
- **Validação espelhada**: as mesmas regras no jQuery e no PHP
- PHP valida com `trim()`, `empty()`, `FILTER_VALIDATE_EMAIL`, `FILTER_VALIDATE_INT` e lista branca de cursos
- Toda saída escapada com `htmlspecialchars($valor, ENT_QUOTES, 'UTF-8')`
- jQuery insere texto com `.text()`, nunca `.html()`

## 📁 Estrutura

```
inscricao-cursos/
├── index.php          # Formulário
├── resultado.php      # Processamento e validação server-side
└── assets/
    ├── css/style.css  # Estilos
    └── js/script.js   # Eventos e validação jQuery
```

## 🚀 Como executar

**Com XAMPP / WAMP / Laragon:** copie a pasta para `htdocs` (ou `www`) e acesse
`http://localhost/inscricao-cursos/`

**Com o servidor embutido do PHP:**

```bash
php -S localhost:8080
```

Depois abra `http://localhost:8080`.

> ⚠️ O Live Server do VS Code não executa PHP — use uma das opções acima.

## 🛠️ Tecnologias

![HTML5](https://img.shields.io/badge/HTML5-E34F26?logo=html5&logoColor=white)
![CSS3](https://img.shields.io/badge/CSS3-1572B6?logo=css3&logoColor=white)
![jQuery](https://img.shields.io/badge/jQuery-3.7.1-0769AD?logo=jquery&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.x-777BB4?logo=php&logoColor=white)
