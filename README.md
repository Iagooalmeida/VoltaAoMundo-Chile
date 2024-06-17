# Projeto "Volta ao Mundo - Chile"  

**Desenvolvido por:** *Iago de Oliveira Almeida*

Fatec Itapira - "Ogari Castro Pacheco"

## Descrição  

Este projeto é um site dedicado a informações sobre o Chile, incluindo suas atrações turísticas, gastronomia e cultura. Além disso, o site possui um painel administrativo que permite a moderação de comentários dos usuários. O site foi desenvolvido com foco em segurança, incluindo proteção contra SQL Injection e senhas criptografadas para os usuários.

### Estrutura do Site  

O site possui as seguintes páginas:

- **Home**: Página inicial com informações gerais e destaques sobre o Chile.
- **Sobre o Chile**: Informações detalhadas sobre a história, cultura e geografia do Chile.
- **Gastronomia**: Destaques da culinária chilena.
- **Pontos Turísticos**: Descrição dos principais pontos turísticos do Chile.
- **Galeria**: Galeria de fotos e vídeos sobre o Chile.
- **Comentários**: Seção onde os usuários podem enviar seus comentários sobre o Chile.

### Painel Administrativo

O painel administrativo oferece as seguintes funcionalidades:

1. **Sistema de Autenticação**: Apenas usuários autenticados podem acessar o painel administrativo.
2. **Proteção contra SQL Injection**: O sistema foi desenvolvido com medidas de segurança para proteger contra ataques de SQL Injection.
3. **Cadastro de Novo Usuário**: Permite o cadastro de novos usuários com senhas criptografadas.
4. **Página “Envie um Comentário”**: Permite que os usuários enviem comentários que são gravados no banco de dados.
5. **Listagem de Comentários**: Exibe os comentários enviados pelos usuários, permitindo a consulta ao banco de dados.
6. **Moderação de Comentários**: Permite aos administradores aprovar ou reprovar comentários, alterando o status no banco de dados.
7. **Importação de Comentários via JSON**: Permite a importação de comentários através de um arquivo JSON, facilitando a inclusão em massa de comentários.

### Tecnologias Utilizadas  

- **Frontend**: HTML, CSS, JavaScript, Bootstrap
- **Backend**: PHP
- **Banco de Dados**: MySQL
- **Bibliotecas Adicionais**: jQuery, SweetAlert2

### Instalação

1. Clone o repositório:

    ```bash

    git clone https://github.com/Iagooalmeida/VoltaAoMundo-Chile.git
    ```

2. Navegue até o diretório do projeto:

    ```bash
    cd voltaaomundo-chile
    ```

3. Configure o banco de dados:
    - Crie um banco de dados MySQL.
    - Importe o arquivo `voltaaomundo_chile.sql` para criar as tabelas necessárias.
    - Atualize as credenciais de conexão com o banco de dados no arquivo `sql/conexao.php`.

4. Inicie um servidor local para executar o projeto (por exemplo, usando o XAMPP ou WAMP).

### Uso

- **Login**: Acesse a página de login (`login/index.php`) para entrar no painel administrativo.
- **Cadastro de Usuário**: Use a página de cadastro (`login/register.php`) para criar novos usuários.
- **Envio de Comentários**: Os usuários podem enviar comentários através da página `comentarios/enviar.php`.
- **Painel Administrativo**: Acesse o painel administrativo para gerenciar comentários (`admin/index.php`).

### Importar Comentários

Para importar comentários via JSON:

1. Acesse o painel administrativo.

2. Utilize o formulário de importação de comentários, selecionando o arquivo JSON e o status desejado para os comentários.

### Segurança

- **Senhas Criptografadas**: Todas as senhas de usuários são armazenadas de forma criptografada.
  
- **Proteção contra SQL Injection**: Todas as consultas ao banco de dados são feitas utilizando prepared statements para evitar SQL Injection.

### Contribuição

Contribuições são bem-vindas! Sinta-se à vontade para abrir issues e pull requests para melhorias.

---

Fatec Itapira - "Ogari Castro Pacheco"  
