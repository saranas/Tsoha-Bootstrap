
--Aines-taulun testidata
INSERT INTO Aines (nimi, alkpitoisuus) VALUES ('Ananasmehu', '0.0');
INSERT INTO Aines (nimi, alkpitoisuus) VALUES ('Original Lime', '4.5');

--Drinkki-taulun testidata
INSERT INTO Drinkki (nimi, tyyppi, alkoholiton,tyovaiheet, kuvaus, lasi) VALUES ('Testidrinkki', 'Cocktail', false,'Kaada ainekset lasiin ja sekoita baarilusikalla.', 'Testidrinkki on herkullinen alkoholiton versio Pina Coladasta. Drinkin voi 
    valmistaa myös kaupasta saatavasta pina colada -siirapista, mutta tuoreilla 
    aineksilla lopputulos on paljon maukkaampi.', 'Hurrikaanilasi');
INSERT INTO Drinkki (nimi, tyyppi, alkoholiton, tyovaiheet, kuvaus, lasi) VALUES ('Mehumehu', 'Smoothie', true,'Laita ainekset blenderiin ja sekoita pari kertaa pulse-toiminnolla.
Kaada lasiin ja koristele kirsikalla', 'Mehumehu on herkullinen alkoholiton versio Pina Coladasta. Drinkin voi 
    valmistaa myös kaupasta saatavasta pina colada -siirapista.', 'Cocktail-lasi');

--Drinkkiainekset-taulun testidata
INSERT INTO Drinkkiainekset (drinkki_id, aines_id) VALUES (1, 1);

--Kayttaja-taulun testidata
INSERT INTO Kayttaja (kayttajanimi, salasana) VALUES ('saara', 'saara123');