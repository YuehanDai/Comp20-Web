# Assignment 9: JSON Song List

Student Name: Yuehan Dai

CS login: 1319141

## url

html: https://yuehandai.github.io/Comp20-Web/Assignment9/songList.html

json: https://yuehandai.github.io/Comp20-Web/Assignment9/songs.json



## Question

**Which do you prefer:  XML or JSON? And why?**

I prefer JSON because JSON is closer to the classes or the objects in c++ and it has a lot of flexibility to work on. Also, JSON is compatible with HTML which I like a lot for formatting, and compared with JSON, XML is not compatible with HTML and also less convenient for the styling.

## Code

### Html

```html
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Song List</title>
<script   src="https://code.jquery.com/jquery-3.1.1.min.js"   integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="   crossorigin="anonymous"></script>
<link rel="stylesheet" href="style.css">
<script language = "javascript">
    var jsondata = [];
    var list = [];
    var filterSong = [];

    function write(){
        $.get( "https://raw.githubusercontent.com/YuehanDai/Comp20-Web/main/Assignment9/songs.json", 
        function( data ) {
            jsondata = JSON.parse(data);
            writeRaw();
            writeList();
            writeFilter();
        })    
    }

    function writeRaw(){
        str = JSON.stringify(jsondata) + "</div>";
        e = document.getElementById("raw");
        e.innerHTML = str;
    }

    function writeList(){
        var strHTML = "" ;
        jsondata.forEach(function(song) {  
        strHTML += "<div id = 'oneSong'><h3>"
            + song.name + "</h3>"
            + "<strong>Artist: </strong>"
            + song.artist + "<br>"
            + "<strong>Genre: </strong>";
            for (i = 0; i < song.genre.length; i++){
                if (i == 0){
                    strHTML += song.genre[i];
                } else {
                    strHTML += ", " + song.genre[i];
                }
            }
        strHTML += "<br>" 
            + "<strong>Year Released: </strong>"
            + song.year + "<br>"
            + "<strong>Link: </strong><a href='"
            + song.link + "'>"
            + song.link
            + "</a> <br>"
        strHTML += "</div>";
        }) 
        e = document.getElementById("songs");
        e.innerHTML = strHTML;
    }

    function writeFilter(){
        readGenre();
        writeSelect();
    }

    function readGenre(){        
        jsondata.forEach(function(song){
            song.genre.forEach(function(genres){
                if(!inList(genres)){
                    list.push(genres);
                }                
            });
        });
    }

    function inList(genreName){
        var result = false;
        list.forEach(function(genreInList){
            if (genreInList == genreName){
                result = true;
            }
        })
        return result;
    }

    function writeSelect(){
        list.sort();
        str = "<select name='genre' id = 'genre' size='1'>";
        list.forEach(function(genres){
            str += "<option>" + genres + "</option>";
        })
        str += "</select>"
            + "</form>";
        e = document.getElementById("selections");
        e.innerHTML = str;
    }


    function filter(){
        filterSong = [];
        userchoice = readChoice();
        jsondata.forEach(function(song){
            song.genre.forEach(function(genres){
                if (genres == userchoice){
                    filterSong.push(song.name);
                }
            })
        })
        writeSongs();
    }

    function readChoice(){
        tag = $('#genre').find(":selected").text();;
        return tag;
    }

    function writeSongs(){
        str = "<ul>";
        filterSong.forEach(function(songName){
            str +="<li>" 
                + songName
                + "</li>";
        })
        str += "</ul>";
        e = document.getElementById("result");
        e.innerHTML = str;
    }
</script>
</head>

<body>
    <h1>Assignment 9: JSON Song List</h1>
    <h2>Raw String</h2>
    <div id = "raw">&nbsp;</div>

    <h2>Song List</h2>
    <div id = "songs">&nbsp;</div>

    <h2>View by Filter: </h2>
    <div>
        <form>
        <div id = 'selections'>&nbsp;</div>
        <input type='button' value='Search by Genre' onclick = "filter()">
        </form>
    </div> 

    <div id = 'result'>&nbsp;</div>

    <script language = "javascript">write()</script>     
 
</body>
</html>
```

### Json

```json
[
{
	"name" : "Merry Christmas, Mr. Lawrence",
	"artist" : "Ryuichi Sakamoto(坂本龍一)",
	"genre" : ["Instrumental"],
	"year" : 1983,
	"link" : "https://www.youtube.com/watch?v=LGs_vGt0MY8"
},
{
	"name" : "Rain",
	"artist" : "Ryuichi Sakamoto(坂本龍一)",
	"genre" : ["Instrumental"],
	"year" : 1996,
	"link" : "https://www.youtube.com/watch?v=8tKfYwc4zxA"
}, 
{
	"name" : "Lemon",
	"artist" : "Yonezu Kenshi(米津玄師)",
	"genre" : ["J-pop", "Japanese"],
	"year" : 2018,
	"link" : "https://www.youtube.com/watch?v=7PowTFw-jAA"
}, 
{
	"name" : "Shape of My Heart",
	"artist" : "Sting",
	"genre" : ["Pop rock", "English"],
	"year" : 1993,
	"link" : "https://www.youtube.com/watch?v=QK-Z1K67uaA"
}, 
{
	"name" : "Explosive",
	"artist" : "David Garrett",
	"genre" : ["Classical", "Instrumental"],
	"year" : 2015,
	"link" : "https://www.youtube.com/watch?v=vZvwg1p2OI4"
}, 
{
	"name" : "Faded",
	"artist" : "Alan Walker",
	"genre" : ["EDM", "English"],
	"year" : 2015,
	"link" : "https://www.youtube.com/watch?v=60ItHLz5WEA"
}, 
{
	"name" : "Libertango",
	"artist" : "Yoyo Ma",
	"genre" : ["Classical", "Instrumental"],
	"year" : 1997,
	"link" : "https://www.youtube.com/watch?v=WdoHeJBbNs0"
}, 
{
	"name" : "Anatani Deawanakereba Kasetsutouka",
	"artist" : "Aimer",
	"genre" : ["J-pop", "Japanese"],
	"year" : 2012,
	"link" : "https://www.youtube.com/watch?v=iA9Ctaqo3Zc"
}, 
{
	"name" : "The Humming",
	"artist" : "Enya",
	"genre" : ["Celtic", "English"],
	"year" : 2015,
	"link" : "https://www.youtube.com/watch?v=FOP_PPavoLA"
}, 
{
	"name" : "Echoes in Rain",
	"artist" : "Enya",
	"genre" : ["New-age", "English"],
	"year" : 2015,
	"link" : "https://www.youtube.com/watch?v=8DDHulO485k"
}

]
```

### CSS

```css
@charset "utf-8";
/* CSS Document */

*{
	font-family: Gotham, "Helvetica Neue", Helvetica, Arial, "sans-serif";
}

body {
    display: block;
	border:  5px solid #000;
	width: 70%;
	margin: 5%;
}

h1 {
    display: block;
	border:  5px solid #000;
	font-size:40px;
	padding: 2%;
	margin: 1%;
	font-weight:bold;
}

h2 {
    display: block;
	border:  5px solid #000;
	font-size:25px;
	padding: 1%;
	margin: 1%;
   
}

input {
    display: inline-block;
}

li {
    display: inline-block;
    border:  2px solid #000;
    margin: 1%;
    padding: 0.5%;
}

a {
    text-decoration: none;
    color: #000;
}

a:hover {
    text-decoration: underline;
}

#raw {
    display: block;
	border:  5px solid #000;
	font-size:15px;
	padding: 1%;
	margin: 1%;
    font-family: Georgia, serif;
}

#selections {
    display: inline-block;
}

#oneSong {
    border:  5px solid #000;
	font-size:15px;
	padding: 1%;
	margin: 1%;
}

#oneSong h3 {
    text-decoration: underline;
}

form {
    border:  5px solid #000;
	padding: 1%;
    margin: 1%;
}

#result {
    border:  5px solid #000;
    margin: 1%;
    padding: 0%;
}

ul {
    padding: 0;
    margin: 0;
}
```

