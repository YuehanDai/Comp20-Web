const MongoClient = require('mongodb').MongoClient;
const url = "";  // connection string goes here


  MongoClient.connect(url, { useUnifiedTopology: true }, function(err, db) {
    if(err) { console.log("Connection err: " + err); return; }
  
    var dbo = db.db("textbooks");
	var coll = dbo.collection('books');
	
	console.log("before find");
	var s = coll.find().stream();
	s.on("data", function(item) {console.log("Data "+ item.title)});
	s.on("end", function() {console.log("end of data"); db.close();});
	console.log("after close");
});  //end connect





