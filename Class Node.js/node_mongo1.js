const MongoClient = require('mongodb').MongoClient;
const url = "mongodb+srv://Yuri:<PEA6dzeDnzSpSl97>@cluster0.p5voe.mongodb.net/textbooks?retryWrites=true&w=majority";

  MongoClient.connect(url, function(err, db) {
  if(err) { return console.log(err); return;}
  
    var dbo = db.db("textbooks");
	var collection = dbo.collection('books');
	
	console.log("Success!");
	db.close();
 
});



