const MongoClient = require('mongodb').MongoClient;
const url = "";  // connection string goes here

  MongoClient.connect(url, { useUnifiedTopology: true }, function(err, db) {
  if(err) { return console.log(err); }
  
    var dbo = db.db("textbooks");
	var collection = dbo.collection('books');
	
	var theQuery = { title: /^Who/ };
    collection.deleteMany(theQuery, function(err, obj) {
    if (err) throw err;
    console.log("document(s) deleted");
    });


});



