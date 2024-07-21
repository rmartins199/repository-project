# Repositório de conteúdos da licenciatura em TIWM

O objetivo do Repositório de conteúdos da licenciatura em TIWM (Instituto Politécnico da Maia) é disponibilizar aos docentes uma ferramenta colaborativa onde podem ser colocados trabalhos (enunciados) as suas correções ou simplesmente enunciados de forma a construir um portfólio do curso. Podem ser disponibilizados trabalhos realizados por alunos que tenham interesse para a UC em causa por serem exemplos de boas práticas ou más práticas.

## Estrutura
```bash
# /repository-project
│
├── /includes
│   ├── home.php           # Conteúdo da página inicial
│   ├── login.php          # Formulário de login
│   ├── registration.php   # Formulário de registo
│   ├── publish.php        # Formulário de publicação de novos relatórios
│   ├── collections.php    # Lista de coleções existentes na base de dados 
│   ├── dateissued.php     # Lista de relatórios publicados por data 
│   ├── author.php         # Lista de autores com publicações efetuadas
│   ├── type.php           # Lista de publicações por tipo
│   ├── logged.php         # Área privada após login
│
├── /assets
│   ├── /bootstrap-5.0.2            # Diretório do framework Bootstrap versão 5.0.2 
│   ├── /bootstrap-icons-1.11.3     # Diretório do framework Bootstrap versão 5.0.2 
│   ├── /css               # Diretório dos ficheiros de css
│   ├── /images            # Diretório das imagens utilizadas
│   └── /scripts           # Diretório dos scripts utilizados
│
├── index.php             # Script principal de entrada que carrega paginas no diretorio /includes
└── publication.php       # Pagina que permite ver publicação efetuada pelo Aluno com opção de pré visualizar ficheiro PDF.
