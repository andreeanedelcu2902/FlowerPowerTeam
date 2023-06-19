
-- Crearea tabelului pentru actori
CREATE TABLE actors (
  id INT AUTO_INCREMENT PRIMARY KEY,
  year INT,
  category VARCHAR(100),
  full_name VARCHAR(100),
  show_name VARCHAR(100),
  won BOOLEAN,
  bio TEXT
);

-- Crearea tabelului pentru producțiile cinematografice
CREATE TABLE films (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(100),
  release_date DATE,
  rating FLOAT,
  director VARCHAR(100)
);

-- Crearea tabelului pentru nominalizările actorilor
CREATE TABLE actor_nominees (
  id INT AUTO_INCREMENT PRIMARY KEY,
  year INT,
  category VARCHAR(100),
  actor_id INT,
  film_id INT,
  FOREIGN KEY (actor_id) REFERENCES actors(id),
  FOREIGN KEY (film_id) REFERENCES films(id)
);

-- Crearea tabelului pentru știri
CREATE TABLE news (
  id INT AUTO_INCREMENT PRIMARY KEY,
  actor_id INT,
  title VARCHAR(100),
  content TEXT,
  FOREIGN KEY (actor_id) REFERENCES actors(id)
);
