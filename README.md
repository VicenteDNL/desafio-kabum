
# Desafio Kabum

Projeto Desenvolvido para o processo seletivo Desenvolvedor(a) Fullstack SR na Kabum

## Descrição do Desafio

Construa seu Portal Administrativo! 🛡️💻

### Objetivo Geral 🎯

Criar um Portal Administrativo para gestão de clientes, acessado por usuários devidamente autenticados (login e senha).

#### Detalhamento da Missão 🔍

1️⃣ Desenvolver uma área administrativa onde os Guardiões (usuários) devem acessar com login e senha

2️⃣ Construir um Gerenciador de Clientes com as seguintes funcionalidades

- Listar Clientes
- Incluir Clientes
- Editar Clientes
- Excluir Clientes

##### Detalhes do Cadastro de Cliente 📋

Nome
Data de Nascimento
CPF
RG
Telefone
Relacionamento Especial: O cliente pode ter 1 ou N endereços cadastrados!

### Requisitos Técnicos (A Arte do Código) ⚙️

- Linguagem Principal: **PHP** (proibido o uso de frameworks como Laravel ou CodeIgniter – é hora de mostrar sua essência ninja!).
- Banco de Dados: MySQL.
- Front-End: Escolha livre, conforme suas habilidades de combate!
- README: Deve conter os passos para inicializar o projeto e guiar futuros aliados!

### Bônus (Diferenciais para ganhar XP) 🏆

1️⃣ Utilização dos princípios SOLID para fortalecer sua arquitetura de código.
2️⃣ Implementação de Testes Automatizados – garanta a segurança do sistema!
3️⃣ Estrutura com Camadas Desacopladas, garantindo modularidade.
4️⃣ Design e estrutura voltados à Escalabilidade – pensando no futuro da missão.

## Instalação

Para executar esse projeto é necessario o [Docker](https://www.docker.com) instalado na sua máaquina.

### Passo 1

Clonar projeto

 ```bash
  git clone https://github.com/VicenteDNL/desafio-kabum-api.git
```

### Passo 2

Acessar o diretório

 ```bash
  cd desafio-kabum-api
```

### Passo 3

Fazer uma copía do .env.example. Para facilitar a inicialização do projeto todas as variavés necessárias já estão contidas no .env.example

 ```bash
  cp .env.example .env
```

### Passo 4

Iniciar os container docker.

 ```bash
  docker compose up -d
```

### Passo 5

Criar as tabelas do banco de dados.

 ```bash
  docker exec -it desafio-api php script/run_migrate.php
```

### Passo 6 (Opcional)

Popular o banco de dados.

 ```bash
  docker exec -it desafio-api php script/run_seeders.php
```
