CREATE DATABASE empresax;

USE empresax;

CREATE TABLE IF NOT EXISTS tblusuario (
    id_tblusuario INT(111) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome_tblusuario VARCHAR(150) NOT NULL,
    email_tblusuario VARCHAR(150) NOT NULL,
    idade_tblusuario INT(3) NOT NULL,
    senha_tblusuario LONGTEXT NOT NULL,
    opc_pergunta_secreta VARCHAR(30) NOT NULL,
    resp_pergunta_secreta LONGTEXT NOT NULL,
    tipo_tblusuario VARCHAR(30) NOT NULL,
    UNIQUE (email_tblusuario)
) ENGINE= InnoDB;