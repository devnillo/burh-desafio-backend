# 📝 Teste Técnico - Desenvolvedor Backend Júnior (PHP)

## 📌 Descrição do Projeto

Desenvolver uma **API REST** para um sistema de vagas de emprego, permitindo que empresas gerenciem suas vagas e usuários possam se candidatar às oportunidades disponíveis.

---

## ⚙️ Requisitos Técnicos

-   **Laravel** 12+
-   **PHP** 8.2+
-   **Banco de Dados**: MySQL ou PostgreSQL

---

## 🚀 Funcionalidades

### 🏢 Empresa

-   **Criar Empresa**
    -   **Endpoint**: `POST /api/company/register`
    -   **Campos obrigatórios**: `name`, `description`, `cnpj`, `plan`

### 📌 Vagas

-   **Mostrar Vaga pelo ID**

    -   **Endpoint**: `GET /api/vacancy/{id}`

-   **Criar Vaga**
    -   **Endpoint**: `POST /api/vacancy/register`
    -   **Campos obrigatórios**: `title`, `description`, `type`, `salary`, `working_hours`, `company_id`

### 👤 Usuários

-   **Buscar Usuário**

    -   **Endpoint**: `GET /api/user/search?parametro=`
    -   **Parâmetros de busca**: `name`, `email`, `cpf`

-   **Criar Usuário**
    -   **Endpoint**: `POST /api/user/register`
    -   **Campos obrigatórios**: `name`, `email`, `cpf`, `age`

### 📝 Candidaturas

-   **Candidatar Usuário a Vaga**
    -   **Endpoint**: `POST /api/application/register`
    -   **Campos obrigatórios**: `user_id`, `vacancy_id`

---

## 🐳 Docker e Ambiente

O projeto está configurado para rodar em **Docker**, garantindo que todas as dependências sejam executadas em containers e eliminando a necessidade de configurar o ambiente manualmente.  
Um arquivo **`docker-compose.yml`** já está incluído no repositório para facilitar a inicialização do projeto.

---

## ▶️ Como Rodar o Projeto

1. Clone o repositório.
2. Execute `docker-compose up -d` para rodar o PostgreSQL.
3. Instale as dependências com `composer install`.
4. Configure o arquivo `.env` para apontar para o banco de dados no Docker.
5. Execute as migrations com `php artisan migrate`.
6. Inicie o servidor com `php artisan serve`.
