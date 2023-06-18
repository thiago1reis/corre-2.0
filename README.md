<p style="text-align: center;"><img  style="background-color: white; padding: 0.8rem;" src="public/imagens/logo_corre.png" alt="logo-corre"></p>

# C.O.R.R.E - 2.0

[![Laravel](https://img.shields.io/badge/Laravel-9.52-orange.svg)](https://laravel.com/docs/9.x)
[![PHP](https://img.shields.io/badge/PHP-%5E8.0-233D8F.svg)](https://www.php.net)
[![Livewire](https://img.shields.io/badge/Livewire-2.12-pink.svg)](https://laravel-livewire.com/docs/2.x/quickstart)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-5.2-purple.svg)](https://getbootstrap.com/docs/5.2/getting-started/introduction/)
[![by Thiago Alexandre Reis](https://img.shields.io/badge/%20by-Thiago_Alexandre_Reis-informational?color=blue)](https://www.linkedin.com/in/thiago1reis/)


C.O.R.R.E. (Cadastro de Ocorrências Escolares) é um protótipo de sistema desenvolvido como parte do meu trabalho de conclusão de curso em Licenciatura em Computação no Instituto Federal do Tocantins, campus Porto Nacional. Este projeto foi concebido para atender às necessidades de registro de ocorrências em ambiente escolar.

Agora, realizei uma nova versão deste projeto, utilizando tecnologias de ponta do mercado. Com a incorporação dessas novas tecnologias, o C.O.R.R.E. oferece recursos mais avançados, maior desempenho e uma experiência de uso aprimorada. Estou entusiasmado em compartilhar essa nova versão do sistema, que representa um salto significativo em termos de inovação e eficiência.

## Trabalho de Conclusão de Curso (TCC)

Para obter mais detalhes sobre o projeto, você pode acessar o meu Trabalho de Conclusão de Curso (TCC) completo no formato PDF.

- [Clique aqui para visualizar o TCC](https://drive.google.com/drive/folders/1bhDuFsKJz-JdkRC3du6vAuxT1-Qt2xpL?usp=sharing)


## Instalação

Siga as etapas abaixo para instalar e configurar o projeto em seu ambiente local.

### Pré-requisitos

- [PHP ^8.0](https://www.php.net/downloads)
- [Composer 2.5](https://getcomposer.org)
- [Node 19.3](https://nodejs.org/pt-br)
- Banco de dados MySQL

### Passo a passo

1. Clone o projeto do repositório para o seu ambiente local:
    ```shell
    git clone https://github.com/thiago1reis/corre-2.0.git
    ```
2. Acesse a pasta do projeto:

    ```shell
    cd corre-2.0
    ```
3. Instale as dependências do projeto com o Composer:    
     ```shell
     composer install
     ```
4. Copie o arquivo .env.example para .env:
    ```shell
    cp .env.example .env
    ```
5. Edite o arquivo .env e configure as informações do seu banco de dados:
    ```shell
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=corre_2.0
    DB_USERNAME=root
    DB_PASSWORD=
    ```
6. Gere a chave de criptografia do aplicativo:
    ```shell
    php artisan key:generate
    ```
7. Execute as migrações do banco de dados para criar as tabelas:
    ```shell
    php artisan migrate --seed
    ```
8. Instale as demais dependências:    
     ```shell
     npm install
     npm run dev
     ```
9. Inicie o servidor de desenvolvimento:
    ```shell
    php artisan serve
    ```
Agora você pode acessar o projeto em seu navegador pelo endereço http://localhost:8000.

## Informações

O projeto está disponível para acesso em:

- URL de deploy: [http://corre.infinityfreeapp.com/](http://corre.infinityfreeapp.com/)

Aqui estão as credenciais de acesso:

- Usuário admin:
    - Email: adm@corre.com
    - Senha: 4a6d3m

- Usuário padrão:
    - Email: pdr@corre.com
    - Senha: 9p6d2r

Certifique-se de utilizar as credenciais corretas ao acessar o sistema. Em caso de dúvidas ou problemas, não hesite em entrar em contato.

## Contribuição
Se você tiver problemas ou sugestões, sinta-se à vontade para abrir uma issue, enviar um pull request ou me contatar por e-mail. O seu feedback é bem-vindo e contribui para melhorar o projeto
