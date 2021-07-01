CREATE TABLE users (
    id integer primary key auto_increment,
    username varchar(16) not null unique,
    password varchar(255) not null,
    email varchar(255) not null unique,
    nprodottipreferiti integer default 0,
    nprodotticarrello integer default 0
) Engine = InnoDB;

CREATE TABLE prodotti (
    id integer primary key auto_increment,
    nome varchar(16) not null,
    descrizione text,
    prezzo float (4) not null,
    url_immagine varchar(50),
    tipo varchar(20) not null
) Engine = InnoDB;

CREATE TABLE carrello (
    id integer primary key auto_increment,
    user_id integer not null,
    prodotto_id integer not null,
    quantity integer not null,
    foreign key(user_id) references users(id) on delete cascade on update cascade,
    foreign key(prodotto_id) references prodotti(id) on delete cascade on update cascade
) Engine = InnoDB;

CREATE TABLE preferiti (
    id integer primary key auto_increment,
    user_id integer not null,
    prodotto_id integer not null,
    foreign key(user_id) references users(id) on delete cascade on update cascade,
    foreign key(prodotto_id) references prodotti(id) on delete cascade on update cascade
) Engine = InnoDB;

CREATE TABLE ordini (
    id integer primary key auto_increment,
    user_id integer not null,
    foreign key(user_id) references users(id) on delete cascade on update cascade
) Engine = InnoDB;

CREATE TABLE info_ordini (
    id integer primary key auto_increment,
    ordine_id integer not null,
    prodotto_id integer not null,
    quantity integer not null,
    foreign key(ordine_id) references ordini(id) on delete cascade on update cascade,
    foreign key(prodotto_id) references prodotti(id) on delete cascade on update cascade
) Engine = InnoDB;

CREATE VIEW `statistiche_prodotti`  AS   
(select `p`.`id` AS `id`,`p`.`nome` AS `nome`,sum(`i`.`quantity`) AS `n_acquistati` from 
(`info_ordini` `i` join `prodotti` `p` on(`p`.`id` = `i`.`prodotto_id`)) group by `i`.`prodotto_id`)  ;

DELIMITER //
CREATE TRIGGER addCart_trigger
BEFORE INSERT ON carrello
FOR EACH ROW
BEGIN
UPDATE users 
SET nprodotticarrello = nprodotticarrello + new.quantity
WHERE id = new.user_id;
END //
DELIMITER ;


DELIMITER //
CREATE TRIGGER removeCart_trigger
BEFORE DELETE ON carrello
FOR EACH ROW
BEGIN
UPDATE users 
SET nprodotticarello = nprodotticarello - old.quantity
WHERE id = old.user_id;
END //
DELIMITER ;


DELIMITER //
CREATE TRIGGER updateNumberProduct_trigger 
BEFORE UPDATE ON carrello
FOR EACH ROW 
BEGIN
UPDATE users 
SET nprodotticarrello = nprodotticarrello - old.quantity + new.quantity
WHERE id = new.user_id;
END //
DELIMITER ;


DELIMITER //
CREATE TRIGGER addFavorite_trigger
BEFORE INSERT ON preferiti
FOR EACH ROW
BEGIN
UPDATE users 
SET nprodottipreferiti = nprodottipreferiti + 1
WHERE id = new.user_id;
END //
DELIMITER ;


DELIMITER //
CREATE TRIGGER removeFavorite_trigger
BEFORE DELETE ON preferiti
FOR EACH ROW
BEGIN
UPDATE users 
SET nprodottipreferiti = nprodottipreferiti -1
WHERE id = old.user_id;
END //
DELIMITER ;


INSERT INTO `prodotti` (`id`, `nome`, `descrizione`, `prezzo`, `url_immagine`, `tipo`) VALUES
(1, 'Proteine', 'Le proteine in polvere del siero del latte contribuiscono a sviluppare e mantenere la massa muscolare.\r\n', 15.99, 'prodotti/proteine.jpg', 'nutrizione'),
(2, 'Creatina', 'La creatina è un integratore che contribuisce ad aumentare le prestazioni fisiche e la forza.', 14.99, 'prodotti/creatina.jpg', 'nutrizione'),
(3, 'Multivaminico', 'Il nostro Multivitaminico contiene vitamine e minerali essenziali per la salute del tuo corpo e per il tuo benessere quotidiano.', 9.99, 'prodotti/multivitaminico.jpg', 'nutrizione'),
(4, 'Barrette proteiche', 'Le nostre barrette sono un ottimo snack versatile ricco di proteine.', 16.99, 'prodotti/barretta.jpg', 'nutrizione'),
(5, 'Burro d\'arachidi', 'Il nostro burro di arachidi è ricco di proteine e fibre, che lo rendono l’aggiunta ideale ai tuoi pasti post-workout.', 5.99, 'prodotti/burro.jpg', 'nutrizione'),
(6, 'Omega 3', 'Gli omega 3 sono dei acidi grassi esssenziali che svolgono un ruolo importante per la salute del cuore.', 4.99, 'prodotti/omega3.jpg', 'nutrizione'),
(7, 'Felpa', 'La nostra Felpa è realizzata in tessuto morbido a maggioranza cotone per donarti comodità anche mentre ti alleni.', 29.99, 'prodotti/felpa.jpg', 'abbigliamento'),
(8, 'Maglietta', 'Realizzata in tessuto leggero ed elastico per donarti freschezza e comfort in ogni momento.', 14.99, 'prodotti/maglietta.jpg', 'abbigliamento'),
(9, 'Pantaloni fitness', 'I nostri pantaloni sono la scelta ideale per un comfort assicurato.', 24.99, 'prodotti/pantaloni.jpg', 'abbigliamento'),
(10, 'Panca', 'Panca inclinabile e ricchiudibile con supporto per bilanciere.', 119.99, 'prodotti/panca.jpg', 'attrezzatura'),
(11, 'Parallele', 'Ottimo strumento per allenarsi ovunque a corpo libero.', 59.99, 'prodotti/parallele.jpg', 'attrezzatura'),
(12, 'Banda Elastica', NULL, 14.99, 'prodotti/banda.jpg', 'attrezzatura'),
(13, 'Fascia elastica', 'Ottimo strumento per chi ama allenarsi a corpo libero.', 29.99, 'prodotti/fascia.jpg', 'attrezzatura'),
(14, 'Cintura', 'La nostra cintura per sollevamento pesi ti aiuta a sollevare di più supportando allo stesso tempo la zona lombare quando ne hai più bisogno.', 49.99, 'prodotti/cintura.jpg', 'attrezzatura'),
(15, 'Pantaloncini', NULL, 24.99, 'prodotti/pantaloncini.jpg', 'abbigliamento');