
CREATE TABLE Aines(
    aines_id SERIAL PRIMARY KEY, --aineksen uniikki tunniste
    nimi varchar(50)NOT NULL, --aineksen nimi, esim. ananasmehu, Midori Melon
    alkpitoisuus decimal --aineksen alkoholipitoisuus prosentteina
);

CREATE TABLE Drinkki(
    drinkki_id SERIAL PRIMARY KEY, --Drinkin uniikki tunniste
    nimi varchar(50) NOT NULL, --drinkin nimi
    tyyppi varchar(30), --shotti, cocktail tms
    alkoholiton boolean, --onko juoma täysin alkoholiton
    kuvaus text, --selitysteksti juomalle
    lasi varchar(30) --käytettävä lasi
);

CREATE TABLE Drinkkiainekset(
    id SERIAL PRIMARY KEY,
    drinkki_id INTEGER REFERENCES Drinkki(drinkki_id),
    aines_id INTEGER REFERENCES Aines(aines_id)
);

CREATE TABLE Kayttaja(
    kayttaja_id SERIAL PRIMARY KEY, --id
    kayttajanimi varchar(20), --
    salasana varchar(20)
);
