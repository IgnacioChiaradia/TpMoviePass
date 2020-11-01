drop database if exists dbmoviepass;
CREATE DATABASE dbmoviepass;

USE dbmoviepass;

CREATE TABLE genres
(
  id_genre INT,
  description VARCHAR (300),

  CONSTRAINT pk_id_genre PRIMARY KEY (id_genre)
);

CREATE TABLE movies
(
  id_movie INT,
  title VARCHAR(100),
  poster_path VARCHAR(100),
  overview VARCHAR(300),
  release_data DATE,
  genre_ids VARCHAR(50),
  original_language VARCHAR(30),
  vote_count INT,
  popularity INT,
  runtime INT,
  vote_average INT,

  CONSTRAINT pk_id_movie PRIMARY KEY (id_movie)
);

CREATE TABLE movies_x_genres
(
  id_movies_x_genre INT,
  id_movie INT,
  id_genre INT,

  CONSTRAINT pk_id_movies_x_genre PRIMARY KEY (id_movies_x_genre),
  CONSTRAINT fk_id_movie_movie_x_genre FOREIGN KEY (id_movie) REFERENCES movies(id_movie),
  CONSTRAINT fk_id_genre_movie_x_genre FOREIGN KEY (id_genre) REFERENCES genres(id_genre)
);


CREATE TABLE cinemas
(
  id_cinema INT AUTO_INCREMENT,
  state BOOLEAN,
  name VARCHAR (50), 
  address VARCHAR (50),

  CONSTRAINT pk_id_cinema PRIMARY KEY (id_cinema),
  CONSTRAINT uniq_name UNIQUE (name),
  CONSTRAINT uniq_address UNIQUE (address)
);

  CREATE TABLE movie_theaters
  (
    id_movie_theater INT AUTO_INCREMENT,
    state BOOLEAN,
    name VARCHAR (50),
    current_capacity INT, /*capacidad actual*/
    price INT, /*valor de la entrada*/
    total_capacity INT,

    id_cinema INT,

    CONSTRAINT pk_id_movie_theater PRIMARY KEY (id_movie_theater),
    CONSTRAINT fk_id_cinema FOREIGN KEY (id_cinema) REFERENCES cinemas (id_cinema) ON DELETE CASCADE
);

CREATE TABLE functions
      (
        id_function INT AUTO_INCREMENT,
        day DATE,
        hour TIME,
        
        id_movie_theater INT,
        
        CONSTRAINT pk_id_function PRIMARY KEY (id_function),
        CONSTRAINT fk_id_movie_theater FOREIGN KEY (id_movie_theater) REFERENCES movie_theaters (id_movie_theater) ON DELETE CASCADE
);