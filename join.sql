SELECT 
    t1.name,
    t2.name
FROM 
    superheroe AS t1
INNER JOIN superheroe_has_supernaughty AS t3 ON t1.id = t3.superheroe_id
INNER JOIN supernaughty AS t2 ON t2.id = t3.supernaughty_id
WHERE 
    t1.id = 7


SELECT 
    t1.name,
    t2.name
FROM 
    superheroe AS t1
INNER JOIN superheroe_has_supernaughty AS t3 ON t1.id = t3.superheroe_id
INNER JOIN supernaughty AS t2 ON t2.id = t3.supernaughty_id
WHERE 
    t2.id = 9


CREATE TABLE supernaughty (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR(45),
    hobby VARCHAR(45),
    identity VARCHAR(45),
    universe VARCHAR(45),
    PRIMARY KEY (id)
)

CREATE TABLE superheroe_has_supernaughty (
    superheroe_id INT UNSIGNED,
    supernaughty_id INT UNSIGNED
)