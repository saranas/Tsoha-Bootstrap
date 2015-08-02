
--Aines-taulun testidata
INSERT INTO Aines (nimi, alkpitoisuus) VALUES ('Ananasmehu', '0.0');
INSERT INTO Aines (nimi, alkpitoisuus) VALUES ('Original Lime', '4.5');

--Lasi-taulun testidata
INSERT INTO Lasi (nimi) VALUES ('Cocktail-lasi');
INSERT INTO Lasi (nimi) VALUES ('Hurrikaanilasi');

--Drinkki-taulun testidata
INSERT INTO Drinkki (nimi, tyyppi, alkoholiton, lasi) VALUES ('Testidrinkki', 'Cocktail', false, 1);
INSERT INTO Drinkki (nimi, tyyppi, alkoholiton, lasi) VALUES ('Mehumehu', 'Smoothie', true, 1);

--Lasi-taulun testidata
--INSERT INTO Aines (nimi, alkpitoisuus) VALUES ('Original Lime', '4.5');

--Kayttaja-taulun testidata
INSERT INTO Kayttaja (kayttajanimi, salasana) VALUES ('saara', 'saara123');