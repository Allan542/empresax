CREATE DATABASE empresax;

USE empresax;

CREATE TABLE IF NOT EXISTS tblusuario (
    id_tblusuario INT(111) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome_tblusuario VARCHAR(150) NOT NULL,
    email_tblusuario VARCHAR(150) NOT NULL,
    idade_tblusuario INT(3) NOT NULL,
    senha_tblusuario LONGTEXT NOT NULL,
    foto_perfil_tblusuario VARCHAR(255), 
    opc_pergunta_secreta LONGTEXT NOT NULL,
    resp_pergunta_secreta LONGTEXT NOT NULL,
    tipo_tblusuario VARCHAR(30) NOT NULL,
    UNIQUE (email_tblusuario)
) ENGINE= InnoDB;

CREATE TABLE IF NOT EXISTS senhas_antigas (
    id_senha_antiga INT(111) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome_senhas_antigas VARCHAR(150) NOT NULL,
    senha_antiga LONGTEXT NOT NULL,
    id_tblusuario INT(111) NOT NULL,
    CONSTRAINT fk_tblusuario_senhas_antigas FOREIGN KEY (id_tblusuario) REFERENCES tblusuario(id_tblusuario)
    ON UPDATE CASCADE
    ON DELETE CASCADE
) ENGINE= InnoDB;