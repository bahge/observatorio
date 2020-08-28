/*Banco de dados gesconsultoria*/

/* Cria a tabela de users */
CREATE TABLE users (
id INT(11) AUTO_INCREMENT PRIMARY KEY,
nome VARCHAR(150) NOT NULL,
email VARCHAR(150) NOT NULL,
pass VARCHAR(40)  NOT NULL,
nivel INT(11) NOT NULL,
status INT(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/* Popular tabelas*/
INSERT INTO users
    (nome, email, pass, nivel, status) 
VALUES 
    ('Leandro Costa Garcia', 'leandrobage@gmail.com', 'adcd7048512e64b48da55b027577886ee5a36350', 1, 1);

CREATE TABLE projects ( 
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(150) NOT NULL,
    descricao VARCHAR(150) NOT NULL,
    objetivo VARCHAR(500) NULL,
    justificativa VARCHAR(500) NULL,
    atuacao VARCHAR(500) NULL,
    maisInformacao VARCHAR(500) NULL,
    foto VARCHAR(50) NULL,
    telefone VARCHAR(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE team ( 
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(150) NOT NULL,
    link VARCHAR(150) NOT NULL,
    foto VARCHAR(50) NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;