
CREATE DATABASE IF NOT EXISTS pokemons;

CREATE TABLE IF NOT EXISTS pokemons (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    weight INT NULL,
    height INT NULL,
    types INT NOT NULL,
    types2 INT NULL,
    abilities VARCHAR(50) NOT NULL,
    abilities2 VARCHAR(50) NULL,
    hp INT NOT NULL,
    attack INT NOT NULL,
    defense INT NOT NULL,
    special_attack INT NOT NULL,
    special_defense INT NOT NULL,
    speed INT NOT NULL,
    type_img VARCHAR(30) NOT NULL,
    name_img VARCHAR(200) NOT NULL,
    image LONGBLOB NOT NULL,
    date_img INT NOT NULL,
    pokes_chain VARCHAR(100) NULL,
    is_legendary BOOLEAN NULL,
    is_mythical BOOLEAN NULL,
    FOREIGN KEY (types) REFERENCES types(id)
	  ON DELETE RESTRICT ON UPDATE CASCADE,
	FOREIGN KEY (types2) REFERENCES types(id)
	  ON DELETE RESTRICT ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS types (
    id INT PRIMARY KEY AUTO_INCREMENT,
    types VARCHAR(50) NULL
);

