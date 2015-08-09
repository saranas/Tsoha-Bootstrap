
--Aines-taulun testidata
INSERT INTO Aines (nimi, alkpitoisuus) VALUES ('Ananasmehu', '0.0');
INSERT INTO Aines (nimi, alkpitoisuus) VALUES ('Original Lime', '4.5');

--Lasi-taulun testidata
INSERT INTO Lasi (nimi) VALUES ('Cocktail-lasi');
INSERT INTO Lasi (nimi) VALUES ('Hurrikaanilasi');

--Drinkki-taulun testidata
INSERT INTO Drinkki (nimi, tyyppi, alkoholiton, kuvaus, lasi) VALUES ('Testidrinkki', 'Cocktail', false, 'Testidrinkki on herkullinen alkoholiton versio Pina Coladasta. Drinkin voi 
    valmistaa myös kaupasta saatavasta pina colada -siirapista, mutta tuoreilla 
    aineksilla lopputulos on paljon maukkaampi.', 1);
INSERT INTO Drinkki (nimi, tyyppi, alkoholiton, kuvaus, lasi) VALUES ('Mehumehu', 'Smoothie', true, 'Mehumehu on herkullinen alkoholiton versio Pina Coladasta. Drinkin voi 
    valmistaa myös kaupasta saatavasta pina colada -siirapista.', 1);

--Drinkkiainekset-taulun testidata
INSERT INTO Drinkkiainekset (drinkki_id, aines_id) VALUES (1, 1);

--Kayttaja-taulun testidata
INSERT INTO Kayttaja (kayttajanimi, salasana) VALUES ('saara', 'saara123');