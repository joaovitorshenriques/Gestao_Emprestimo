# Proposta de Trabalho Final

**Discente:** João Vitor Soares Henriques  
**Matrícula:** 22.2.8998  
---

## 1. Tema
O presente trabalho tem como objetivo o desenvolvimento de um **Sistema de Gestão de Crédito e Cobrança para Pequenos Negócios**.

A proposta consiste em criar uma solução que permita o controle eficiente de clientes, a concessão de crédito e o acompanhamento de pagamentos, sendo especialmente útil para empresas que operam com vendas a prazo ou financiamento direto ao consumidor.

O sistema deverá possibilitar o registro, consulta e gerenciamento das operações de crédito, além de incorporar mecanismos de avaliação de risco que auxiliem na tomada de decisão para liberação de novos créditos. Também serão aplicadas técnicas de validação de dados e geração de identificadores únicos, garantindo a integridade e a segurança das informações.

---

## 2. Escopo
O sistema proposto contemplará as seguintes funcionalidades:

### 2.1 Gestão de Clientes
* **Cadastro de informações:**
    * Nome completo
    * CPF/CNPJ
    * Endereço
    * Dados de contato
* **Persistência:** Possibilidade de armazenamento de clientes mesmo sem operações de crédito vinculadas.
* **Manutenção:** Atualização e consulta dos dados cadastrais.

### 2.2 Gestão de Operações de Crédito
* **Registro de operações contendo:**
    * Valor concedido
    * Prazo de pagamento
    * Taxa de juros aplicada
    * Classificação do cliente (pessoa física ou jurídica)
* **Identificação:** Geração de identificadores únicos para cada operação.
* **Vínculo:** Associação de operações de crédito a clientes cadastrados.
* **Consulta:** Visualização e atualização das informações das operações.

### 2.3 Avaliação de Risco de Crédito
* Implementação de critérios para análise da capacidade de pagamento dos clientes.
* **Definição de limites de crédito com base em:**
    * Histórico financeiro
    * Perfil do cliente
* Aplicação de regras que impeçam a concessão de crédito fora dos critérios estabelecidos.

### 2.4 Relatórios e Monitoramento
* **Geração de relatórios contendo:**
    * Operações de crédito ativas
    * Operações de crédito finalizadas
* **Identificação de status:**
    * Pagamentos pendentes
    * Pagamentos em atraso
* Visualização consolidada das operações por cliente.

### 2.5 Recursos Complementares
* Implementação de sistema de autenticação para controle de acesso administrativo.
* Desenvolvimento de interface para navegação e gerenciamento dos dados.
* Disponibilização de painel geral para acompanhamento das operações e clientes.

## 3. Protótipo da Interface
Para ilustrar a experiência do usuário e a estrutura visual do sistema, foram desenvolvidos protótipos das principais telas, focando em usabilidade e clareza das informações.

### 3.1 Autenticação e Acesso
A porta de entrada do sistema conta com uma interface limpa para login e registro, garantindo que apenas usuários autorizados acessem os dados sensíveis de crédito e clientes.

![Tela de Login e Registro](/Gestao_Emprestimo/prototipo/login.png)

### 3.2 Cadastro de Clientes
O formulário de cadastro permite a distinção entre Pessoa Jurídica e Física, coletando dados essenciais para a análise de risco, como CPF/CNPJ e renda mensal, de forma organizada.

![Interface de Cadastro de Cliente](/Gestao_Emprestimo/prototipo/cadastro%20de%20cliente.png)

### 3.3 Dashboard e Gestão Operacional
O painel principal oferece uma visão consolidada do negócio, apresentando métricas críticas (valores totais e status de empréstimos) e uma tabela interativa para busca, filtragem e acompanhamento detalhado das operações de crédito ativas e pendentes.

![Painel de Controle e Gestão](/Gestao_Emprestimo/prototipo/valores%20do%20cliente.png)


