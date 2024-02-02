# Desafio Campsoft

# Requisitos
- PHP 7.4.3
- MySQL
- Apache

## Configurando

Antes de tudo é necessário ter o PHP (no mínimo 7.4.3), Apache e o MySQL instalados para facilitar recomendo o [XAMPP](https://sourceforge.net/projects/xampp/files/XAMPP%20Windows/7.4.33/), não esquecer de instalar o phpmyadmin para ajuda, além de instalar o Apache e o MySQL.

Baixar o projeto e configurar o arquivo api/Model/DB.php alterando a base e as outras informações caso necessário.

Usar os modelos abaixo para criar a tabela e fazer as requisições.

## Rotas

```sh
*GET* /users
*GET* /users/{id}
*POST* /users
*PUT* /users/{id}
*DELETE* /users/{id}
```

## Estrutura Banco de dados

```sh
CREATE TABLE users (
    id integer primary key AUTO_INCREMENT,
    name varchar(100) NOT NULL,
    email varchar(80),
    phone varchar(11),
    cpf varchar(11) NOT NULL UNIQUE,
    address varchar(150),
    birth DATE NOT NULL
);
```

## Exemplo de requisição

```sh
{
	"name": "willian",
	"email": "willianp.developer@gmail.com",
	"phone": "5511948956237",
	"cpf": "42863157035",
	"address": "Rua das Antenas, 42",
	"birth": "1996-06-03"
}
```
