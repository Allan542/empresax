CREATE TABLE IF NOT EXISTS tbl_bandas (
    id_tbl_bandas INT(111) NULL AUTO_INCREMENT PRIMARY KEY,
    nome_tbl_bandas VARCHAR(150) NOT NULL
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS tbl_discos (
    id_tbl_discos INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    titulo_tbl_discos VARCHAR(255) NOT NULL,
    ano_tbl_discos YEAR(4) NOT NULL,
    capa_tbl_discos VARCHAR(255) NOT NULL,
    id_tbl_bandas INT(111) NOT NULL,
    CONSTRAINT fk_tbl_discos_tbl_bandas FOREIGN KEY (id_tbl_bandas) REFERENCES tbl_bandas(id_tbl_bandas)
    ON UPDATE CASCADE
    ON DELETE CASCADE
) ENGINE = InnoDB;

INSERT INTO tbl_bandas (nome_tbl_bandas) VALUES
     ('Pearl Jam'),
     ('Ramones'),
     ('Foo Figthers');

INSERT INTO tbl_discos (titulo_tbl_discos, ano_tbl_discos, capa_tbl_discos, id_tbl_bandas) VALUES
     ('Ten', 1991, 'images/ten.jpg', 1),
     ('VS', 1993, 'images/vs.jpg', 1),
     ('Vitalogy', 1994, 'images/vitalogy.jpg', 1),
     ('No Code', 1996, 'images/nocode.jpg', 1),
     ('Yeld', 1998, 'images/yield.jpg', 1),
     ('Binaural', 2000, 'images/binaural.jpg', 1),
     ('Riot Act', 2002, 'images/riotact.jpg', 1),
     ('Pearl Jam', 2006, 'images/pearljam.jpg', 1),
     ('Ten (Reissue)', 2009, 'images/tenII.jpg', 1),
     ('Backspacer', 2009, 'images/backspacer.jpg', 1),
     ('VS. and Vitalogy', 2011, 'images/vs_vit.jpg', 1),
     ('Lightning Bolt', 2013, 'images/lightning_bolt.png', 1),
     ('Ramones', 1976, 'images/ramones_1976.jpg', 2),
     ('Leave Home', 1977, 'images/LeaveHome.jpg', 2),
     ('Rocket to Russia', 1977, 'images/RockettoRussia.jpg', 2),
     ('Road to Ruin', 1978, 'images/RoadtoRuin.jpg', 2),
     ('Its Alive', 1979, 'images/itsalive.jpg', 2),
     ('Rock N Roll High School', 1979, 'images/RockNRollHighSchool.jpg', 2),
     ('End of the Century', 1980, 'images/EndoftheCentury.jpg', 2),
     ('Pleasant Dreams', 1981, 'images/PleasantDreams.jpg', 2),
     ('Subterranean Jungle', 1983, 'images/SubterraneanJungle.jpg', 2),
     ('Too Tough to Die', 1984, 'images/TooToughToDie.jpg', 2),
     ('Animal Boy', 1986, 'images/AnimalBoy.jpg', 2),
     ('Halfway to Sanity', 1987, 'images/HalfwayToSanity.jpg', 2),
     ('Mania', 1988, 'images/Mania.jpg', 2),
     ('Brain Drain', 1989, 'images/BrainDrain.jpg', 2),
     ('Loco Live', 1991, 'images/locolive.jpg', 2),
     ('Mondo Bizarro', 1992, 'images/MondoBizarro.jpg', 2),
     ('Acid Eaters', 1993, 'images/AcidEaters.jpg', 2),
     ('Adios Amigos', 1995, 'images/AdiosAmigos.jpg', 2),
     ('Greatest Hits Live', 1996, 'images/ramones-greatesthitslivecd.jpg', 2),
     ('We re Outta Here', 1997, 'images/ramones-wereouttahere.jpg', 2),
     ('Anthology', 1999, 'images/Anthology.jpg', 2),
     ('Greatest Hits', 2006, 'images/GreatestHits.jpg', 2),
     ('Foo Fighters', 1995, 'images/Foo_Fighters1995.png ', 3),
     ('The Colour and the Shape ', 1997, 'images/Foo_Fighters1997.jpg', 3),
     ('There Is Nothing Left to Lose', 1999, 'images/Foo_Fighters1999.jpg', 3),
     ('One by One', 2002, 'images/Foo_Fighters2002.jpg', 3),
     ('In Your Honor', 2006, 'images/Foo_Fighters2005.jpg', 3),
     ('Echoes, Silence, Patience and Grace', 2007, 'images/Foo_Fighters2007.jpg', 3),
     ('Wasting Light', 2011, 'images/Foo_Fighters2011.jpg', 3),
     ('Sonic Highways', 2014, 'images/Foo_Fighters2014.jpg', 3);

USE empresax;