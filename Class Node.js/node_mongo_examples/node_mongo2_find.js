const MongoClient = require('mongodb').MongoClient;

const url =  "";  // connection string goes here

  MongoClient.connect(url, { useUnifiedTopology: true }, function(err, db) {
    if(err) { 
		console.log("Connection err: " + err); return; 
	}
  
    var dbo = db.db("textbooks");
	var coll = dbo.collection('books');
	console.log("before find");
	//theQuery = {author:"Bob Smith"};
	theQuery="";
	coll.find(theQuery).toArray(function(err, items) {
	  if (err) {
		console.log("Error: " + err);
	  } 
	  else 
	  {
		console.log("Items: ");
		for (i=0; i<items.length; i++)
			console.log(i + ": " + items[i].title + " by: " + items[i].author);				
	  }   
	  db.close();
	console.log("after close");
	});  //end find		
});  //end connect





