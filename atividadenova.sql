

USE exemplo;
CREATE TABLE pessoas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255),
     sexo VARCHAR(1),
     idade INT
);
INSERT INTO pessoas(nome, idade, sexo)
VALUES
('joão', '25', 'M')

INSERT INTO pessoas(nome, idade, sexo)
VALUES
('Maria', 20, 'F')