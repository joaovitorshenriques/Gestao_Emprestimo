# CSI606-2026-01 - Remoto - Trabalho Final - Resultados

**Discente:** João Vitor Soares Henriques (22.2.8998)

## Resumo

Este trabalho apresenta o desenvolvimento do **Nexo Credito**, um sistema web para gestão de crédito, clientes, empréstimos e pagamentos. A aplicação foi pensada para pequenos negócios que precisam controlar clientes, registrar operações de empréstimo, acompanhar parcelas e visualizar a situação financeira geral em um painel simples.

As principais funcionalidades implementadas incluem autenticação de usuários, cadastro de clientes, cadastro de empréstimos, cálculo de parcelas, registro de pagamentos, acompanhamento de status dos empréstimos e visualização de indicadores no dashboard. O sistema também recebeu uma interface personalizada para facilitar a apresentação e diferenciar a identidade visual do projeto.

## 1. Tecnologias utilizadas - Backend e Frontend

### Backend

- PHP 8.4
- Laravel
- SQLite
- Composer
- Eloquent ORM
- Migrations
- Controllers
- Form Requests
- Services
- Repositories

### Frontend

- Blade
- Bootstrap
- Sass
- Vite
- JavaScript
- jQuery
- Font Awesome
- Bootstrap Icons

## 2. Funcionalidades implementadas

- Cadastro, login e logout de usuarios.
- Proteção das rotas internas por autenticação.
- Cadastro de clientes com dados pessoais, contato e renda.
- Consulta e listagem de clientes cadastrados.
- Cadastro de empréstimos vinculados a clientes.
- Calculo de juros simples e compostos.
- Geração de parcelas do empréstimo.
- Registro opcional de garantia para o empréstimo.
- Análise de risco baseada nos dados do cliente e do empréstimo.
- Dashboard com resumo de clientes, empréstimos e valores.
- Filtros para acompanhar empréstimos por status.
- Visualização de parcelas, garantias e detalhes do empréstimo.
- Registro de pagamento de parcelas.
- Atualização do status do empréstimo conforme os pagamentos.

## 3. Funcionalidades previstas e não implementadas

- Geração de relatórios em PDF ou planilhas.
- Envio automático de cobranças ou notificações.
- Integração com serviços externos de pagamento.
- Controle avançado de perfis e permissões.
- Histórico financeiro mais detalhado por cliente.


## 4. Principais desafios e dificuldades

Um dos principais desafios foi organizar a estrutura do backend de forma clara, separando responsabilidades entre controllers, requests, services e repositories. Isso ajudou a manter o código mais organizado e facilitou a manutenção das regras de negócio.

Outro desafio importante foi lidar com as regras de empréstimos, como cálculo de parcelas, tipos de juros, status dos pagamentos e atualização da situação do empréstimo. Também foi necessário configurar corretamente o ambiente local com PHP, Composer, Node.js, banco SQLite e build do frontend.

Na parte visual, a dificuldade foi adaptar a interface para que o sistema tivesse uma aparência diferente da versão original, mantendo a navegação simples e adequada para uma apresentação acadêmica.

## 5. Instruções para instalação e execução

### Requisitos

- PHP 8.4 ou superior
- Composer
- Node.js e npm
- Git

### Passo a passo

1. Clonar o repositorio:

```bash
git clone <https://github.com/joaovitorshenriques/Gestao_Emprestimo.git>
```

2. Entrar na pasta do projeto:

```bash
cd Gestao_Emprestimo
```

3. Instalar as dependências do Laravel:

```bash
composer install
```

4. Instalar as dependências do frontend:

```bash
npm install
```

5. Criar o arquivo de ambiente:

```bash
cp .env.example .env
```

No Windows, também é possível copiar manualmente o arquivo `.env.example` e renomear a cópia para `.env`.

6. Gerar a chave da aplicação:

```bash
php artisan key:generate
```

7. Configurar o banco SQLite no arquivo `.env`:

```env
DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite
```

8. Criar o arquivo do banco de dados:

```bash
type nul > database/database.sqlite
```

No Windows, também é possível criar manualmente um arquivo vazio chamado `database.sqlite` dentro da pasta `database`.

9. Executar as migrações:

```bash
php artisan migrate
```

10. Gerar os arquivos do frontend:

```bash
npm run build
```

11. Iniciar o servidor local:

```bash
php artisan serve
```

Depois disso, o sistema pode ser acessado pelo navegador em:

```text
http://127.0.0.1:8000
```

## 7. Referências

- Documentação oficial do Laravel: https://laravel.com/docs
- Documentação oficial do PHP: https://www.php.net/docs.php
- Documentação oficial do Composer: https://getcomposer.org/doc/
- Documentação oficial do Bootstrap: https://getbootstrap.com/docs/
- Documentação oficial do Vite: https://vite.dev/guide/
- Documentação do SQLite: https://www.sqlite.org/docs.html
