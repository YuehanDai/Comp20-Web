const MongoClient = require('mongodb').MongoClient;
const url = "";  // connection string goes here


function main() 
{
  MongoClient.connect(url, { useUnifiedTopology: true }, function(err, db) {
  if(err) { return console.log(err); }
  
    var dbo = db.db("textbooks");
	var collection = dbo.collection('books');
	
	var newData = {"title": "Who Ate the Cheese", "author": "Fin Haddie",pages:2};
	collection.insertOne(newData, function(err, res) {
    if(err) { console.log("query err: " + err); return; }
    console.log("new document inserted");
	}   );
	
	console.log("Success!");
 
});
}

main();


