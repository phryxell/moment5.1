# Moment 5.1

Detta repository innehåller kod som skapar ett REST-API, [moment5.1](https://studenter.miun.se/~phno1900/moment5/api/read.php).
Live-versionen är databasansluten till studentmysql, koden i detta repository är baserat på localhost.

Alla metoder ligger i mappen api.

Tillgängliga metoder:
* GET - api/read.php & api/readOne.php. read läser ut alla tillgängliga kurser ur databasen medan readOne hämtar en kurs med ett angivet id, kurs med id 1 = readOne.php?id=1
* POST - api/create.php, måste ges information i dess 'request body' i JSON. Exempelvis:
```
    {
        "id":"1",
        "code":"DT057G",
        "course_name":"Webbutveckling I",
        "progression":"A",
        "syllabus":"https:\/\/www.miun.se\/utbildning\/kursplaner-och-utbildningsplaner\/Sok-kursplan\/kursplan\/?kursplanid=17948"
    }
```
* PUT - api/update.php. Uppdaterar en kurs ur databasen baserat på 'request body', formatteras på samma sätt likt POST-metoden.
* DELETE - api/delete.php. Raderar data ur databasen baserat på angivet ID.

#### Steg för steg:

```
 - Klona projektet genom $ git clone https://github.com/phryxell/moment5.1.git 
```