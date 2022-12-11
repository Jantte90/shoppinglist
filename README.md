Tietokantaohjelmoinnin harjoitustyö.

Yksinkertainen ostoslista PHP backend tietokantoineen, johon on käyttäjiä ja adminkäyttäjiä.

Tavalliset käyttäjät voivat hakea tietoa. Ainoastaan adminkäyttäjä voi lisätä tai poistaa.

Testaukseen käytetty Postmania, tarkemmat tiedot on repossa JSON muodossa. 
Testit siis: 
POST Luo uusi käyttäjä, tarkistaa onko olemassa.
POST Login
POST Logout
GET tarkistaa onko kirjauduttu sisään
GET hae ostoslistan tuotteet
GET hae käyttäjät
POST lisää tuote ostoslistaan (vaatii admin)
POST poista tuote ostoslistasta (vaatii admin)



