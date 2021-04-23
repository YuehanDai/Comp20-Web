var http = require('http');
var url = require('url');

http.createServer(function (req, res) {
  res.writeHead(200, {'Content-Type': 'text/html'});
  var qobj = url.parse(req.url, true).query;
  var txt = qobj.id;   // id is querystring parameter
  res.write("The value is: " + txt);
  res.end();
}).listen(8080);
