# 📝 Teste Técnico - Desenvolvedor Backend Júnior (PHP)

## 📌 Descrição do Projeto

Desenvolver uma **API REST** para um sistema de vagas de emprego, permitindo que empresas gerenciem suas vagas e usuários possam se candidatar às oportunidades disponíveis.

---

## ⚙️ Requisitos Técnicos

-   **Laravel** 12+
-   **PHP** 8.2+
-   **Docker**

---

## 🚀 Funcionalidades

### 🏢 Empresa

-   **Criar Empresa**
    -   **Endpoint**: `POST /api/company/register`
    -   **Campos obrigatórios**: `name`, `description`, `cnpj`, `plan`

### 📌 Vagas

-   **Mostrar Vaga pelo ID**

    -   **Endpoint**: `GET /api/vacancy/{id}`
-   **Mostrar Todas as Vagas Cadastradas**

    -   **Endpoint**: `GET /api/vacancy/all`
    

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
2. Execute `docker-compose up -d --build` para rodar os containers.
3. Instale as dependências com `docker exec -it laravel-app composer install`.
4. gere a key: `docker exec -it laravel-app php artisan key:generate`.
5. Execute as migrations com `docker exec -it laravel-app php artisan migrate`.

A API ficará exposta por padrão em http://localhost:8000/api/. Caso não esteja acessível nessa rota, rode:`docker exec -it laravel-app php artisan serve --host=0.0.0.0 --port=8000`