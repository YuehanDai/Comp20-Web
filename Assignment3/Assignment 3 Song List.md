# Assignment 3: Song List

**Student Name**: Yuehan Dai

**CS Login**: ydai05

## URL

Song List: http://comp20.great-site.net/Assignment3/songList.xml

## XML code

```xml
<?xml version="1.0" encoding="utf-8"?>
<?xml-stylesheet type="text/css" href="stylesheet.css"?>


<list>
	
	<heading>Song List</heading>

	<song>
		<title>Merry Christmas, Mr. Lawrence</title>
		<artist>Ryuichi Sakamoto(坂本龍一)</artist>
		<genre>Instrumental</genre>
		<year>1983</year>
		<link>https://www.youtube.com/watch?v=LGs_vGt0MY8</link>
	</song>

	<song>
		<title>Rain</title>
		<artist>Ryuichi Sakamoto(坂本龍一)</artist>
		<genre>Instrumental</genre>
		<year>1996</year>
		<link>https://www.youtube.com/watch?v=8tKfYwc4zxA</link>
	</song>

	<song>
		<title>Lemon</title>
		<artist>Yonezu Kenshi(米津玄師)</artist>
		<genre>J-pop</genre>
		<year>2018</year>
		<link>https://www.youtube.com/watch?v=7PowTFw-jAA</link>
	</song>

	<song>
		<title>Shape of My Heart</title>
		<artist>Sting</artist>
		<genre>	Pop rock</genre>
		<year>1993</year>
		<link>https://www.youtube.com/watch?v=QK-Z1K67uaA</link>
	</song>

	<song>
		<title>Explosive</title>
		<artist>David Garrett</artist>
		<genre>Classical</genre>
		<year>2015</year>
		<link>https://www.youtube.com/watch?v=vZvwg1p2OI4</link>
	</song>

	<song>
		<title>Faded</title>
		<artist>Alan Walker</artist>
		<genre>EDM</genre>
		<year>2015</year>
		<link>https://www.youtube.com/watch?v=60ItHLz5WEA</link>
	</song>

	<song>
		<title>Libertango</title>
		<artist>Yoyo Ma</artist>
		<genre>Classical</genre>
		<year>1997</year>
		<link>https://www.youtube.com/watch?v=WdoHeJBbNs0</link>
	</song>

	<song>
		<title>Anatani Deawanakereba Kasetsutouka</title>
		<artist>Aimer</artist>
		<genre>J-pop</genre>
		<year>2012</year>
		<link>https://www.youtube.com/watch?v=iA9Ctaqo3Zc</link>
	</song>

	<song>
		<title>The Humming</title>
		<artist>Enya</artist>
		<genre>Celtic</genre>
		<year>2015</year>
		<link>https://www.youtube.com/watch?v=FOP_PPavoLA</link>
	</song>

	<song>
		<title>Echoes in Rain</title>
		<artist>Enya</artist>
		<genre>New-age</genre>
		<year>2015</year>
		<link>https://www.youtube.com/watch?v=8DDHulO485k</link>
	</song>
	
</list>

```



## CSS code

```css
@charset "utf-8";
/* CSS Document */

*{
	font-family: Gotham, "Helvetica Neue", Helvetica, Arial, "sans-serif";
	background-color: #FFFFFF;
}

list {
	display: block;
	border:  5px solid #000;
	width: 70%;
	margin: 5%;
	background-color: #BBBBBB;
}

heading {
	display: block;
	border:  5px solid #000;
	font-size:40px;
	padding: 2%;
	margin: 1%;
	font-weight:bold;
	
}

song {
	display: block;
	border:  5px solid #000;
	padding: 2%;
	margin: 1%;
}

title {
	display: block;
	font-size: 24px;
	font-weight:bold;
	margin-bottom: 10px;
}

artist, genre, year, link{
	display: block;
}

artist:before{
	content: "Artist: ";
	text-decoration: underline;
	font-weight:bold;
}


genre:before {
	content: "Genre: ";
	text-decoration: underline;
	font-weight:bold;
}

year:before {
	content: "Year Released: ";
	text-decoration: underline;
	font-weight:bold;
}

link:before {
	content: "Link: ";
	text-decoration: underline;
	font-weight:bold;
}
```



## Question

#### Discuss a case study for using XML

Since XML is a suitable tool for information transformation, I would like to use it when I was writing a online manual for instruction of my application(project). If the manual is introducing the function of the application/project and how to use it, it have to be ensured to be readable by everyone and there should be no error of format, even for whose browser is old version. Therefore, XML is a perfect tool for the manual since I do not worry about the readability of the file. 

#### Do you like XML as a means of representing data.  Why or why not?

It is hard to say, since XML has its own advantages compared with HTML, but sometimes, XML is kind of harder to use than HTML. XML allows us to define the styles of each tag, which gives us way more possibility for editing and modifying. However, html is simpler for arrangement of  the elements, compared with XML. When HTML has all the predefined tags like the heading(from h1 to h5), or applications like table, form, and hyperlink, XML has to set all the styles by our own, which takes a lot of time to test. 