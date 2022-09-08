USE pokemons;

INSERT INTO pokemons (name, weight, height, types, abilities, hp, attack, defense, special_attack, special_defense, speed, type_img, name_img, date_img, pokes_chain)
VALUES ('pikacho', 56, 13, 'fairy', 'ojete', 56, 78, 255, 10, 20, 4, 'image/png', 'pokacho', '2020-03-25', 'pikacho, raicho' ); 

INSERT INTO pokemons (name, weight, height, types, abilities, hp, attack, defense, special_attack, special_defense, speed, type_img, name_img, date_img, pokes_chain)
VALUES ('pikachos', 56, 13, 'fairys', 'ojete', 56, 78, 255, 10, 20, 4, 'image/png', 'pokacho', '2020-03-25', 'pikachos, raichos' ); 
SELECT * FROM pokemons;
DELETE FROM pokemons WHERE id = 3;
TRUNCATE TABLE pokemons;

ALTER TABLE pokemons.pokemons MODIFY COLUMN name VARCHAR(150) UNIQUE NOT NULL;