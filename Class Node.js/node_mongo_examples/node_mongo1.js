const MongoClient = require('mongodb').MongoClient;
const url = "";  // connection string goes here

  MongoClient.connect(url, { useUnifiedTopology: true }, function(err, db) {
  if(err) { return console.log(err); return;}
  
    var dbo = db.db("textbooks");
	var collection = dbo.collection('books');
	
	console.log("Success!");
	db.close();
 
});



