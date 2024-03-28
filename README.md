# :computer: Documentação do Projeto CRUD Simples em PHP  :computer:
## 1. Introdução
Este projeto consiste em um aplicativo CRUD (Create, Read, Update, Delete) simples desenvolvido em PHP, sem a utilização de frameworks. O objetivo é permitir que os usuários possam gerenciar informações de usuários, incluindo a associação de cores aos mesmos.

## 2. Visão Geral
O sistema oferece funcionalidades básicas para criar, visualizar, editar e excluir usuários. Além disso, os usuários podem associar uma ou várias cores a cada registro de usuário.

## 3. Requisitos

### Requisitos Funcionais:
- Criar um novo usuário com nome, e-mail e cores associadas.
- Visualizar a lista de usuários cadastrados.
- Editar informações de um usuário existente.
- Excluir um usuário.

### Requisitos Não Funcionais:
- O sistema deve ser desenvolvido em PHP sem a utilização de frameworks.
- Deve ser utilizado um banco de dados SQLite para armazenar os dados.
- A interface deve ser simples e intuitiva.

## 4. Tecnologias Utilizadas
- PHP
- HTML
- CSS
- SQLite
- JavaScript
- Bootstrap

## 5. Estrutura do Projeto
- **app/**:
  - **Controller/**: Controladores PHP para gerenciar a lógica de negócios.
  - **Model/**: Classes PHP que representam os modelos de dados.
  - **View/**: Arquivos HTML para a interface do usuário.
- **Database/**:Arquivos relacionados ao banco de dados SQLite.
- **public/**: Arquivos acessíveis publicamente, como CSS, JavaScript e imagens.
- **vendor/**:Dependências do Composer.
 
## 6. Arquitetura do Sistema

O sistema segue uma arquitetura MVC (Model-View-Controller) simplificada, onde:

- Model: Classes PHP representando os modelos de dados (usuários e cores).
- View: Arquivos HTML para a interface do usuário.
- Controller: Controladores PHP que gerenciam a lógica de negócios e a interação entre modelos e visualizações.

## 7. Modelagem de Dados
O sistema possui duas tabelas principais:

1. users: Armazena informações sobre os usuários, incluindo nome e e-mail.
2. colors: Contém informações sobre as cores disponíveis.
3. user_colors: Tabela de associação entre usuários e cores.

## 8. Fluxo de Funcionalidades
- Criar Usuário: O usuário preenche um formulário com nome, e-mail e cores associadas.
- Visualizar Usuários: Uma lista de usuários cadastrados é exibida.
- Editar Usuário: O usuário pode modificar as informações de um usuário existente, incluindo as cores associadas.
- Excluir Usuário: O usuário pode remover um usuário da lista.

## 9. Implementação
- Lógica de negócios para cada funcionalidade do CRUD.
- Interpretação de solicitações HTTP para determinar a ação a ser executada.
- Integração com o banco de dados SQLite para persistência de dados.

## 10. sistema
- tela principal
![Disegna](https://raw.githubusercontent.com/simonedisegna/crud-simples/main/public/img/principal.jpg)
- tela edição
- **Aprimorada a funcionalidade de seleção de cores para permitir que o usuário salve várias cores. As cores selecionadas são exibidas no lado esquerdo da lista de opções após serem salvas, e o usuário pode remover as cores selecionadas clicando nelas novamente.**
![Disegna](https://raw.githubusercontent.com/simonedisegna/crud-simples/main/public/img/edicao.jpg)

## 11. Testes
• Testes unitários para verificar a funcionalidade de cada método do controlador.
• Testes de integração para garantir a integridade dos dados após a interação do usuário.

## 12. Instalação

1. **Clone o Repositório:**
   ```bash
   git clone https://github.com/simonedisegna/crud-simples.git
   ```
2. **Configurar o ambiente:**

- Certifique-se de ter um servidor web configurado (Apache, Nginx, etc.).
- Garanta que o PHP esteja instalado na sua máquina.

4. **Configurar o banco de dados:**

- O projeto utiliza um banco de dados SQLite.
- Certifique-se de que o PHP tenha suporte ao SQLite.
- O arquivo de banco de dados db.sqlite está localizado na pasta database.

5. **Executar o projeto:**

- Navegue até o diretório do projeto no terminal.
- Inicie o servidor web na pasta raiz do projeto.
- Acesse o projeto pelo navegador.

## Estrutura do Banco de Dados
O banco de dados do projeto consiste em três tabelas:

1. **Tabela users:**

- Responsável por armazenar os dados dos usuários.
- Campos: id, name, email.

2. **Tabela colors:**

- Contém as cores disponíveis para associação aos usuários.
- Campos: id, name, hexadecimal.

3. **Tabela colors:**

- Estabelece a relação entre usuários e cores.
- Campos: color_id, user_id.
- Chave primária composta pelos campos color_id e user_id.

## Funcionalidades

**Cadastro de Usuários:**
***Permite criar novos usuários fornecendo nome e email.**

**Edição de Usuários:**
***Permite editar os dados dos usuários existentes.***

**Exclusão de Usuários:**
***Permite excluir usuários do sistema.***

**Vinculação/Desvinculação de Cores:**
***Permite associar ou desassociar várias cores a cada usuário.***

## 12. Conclusão
Este projeto demonstra a implementação de um CRUD simples em PHP, fornecendo uma base sólida para o gerenciamento de informações de usuários. Futuras melhorias podem incluir a adição de recursos de autenticação de usuários, validação de formulários e melhorias na interface do usuário.
