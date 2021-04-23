var http = require('http');
var dt = require('./datemodule.js');

/*http.createServer(function (req, res) {
  res.writeHead(200, {'Content-Type': 'text/html'});
  res.write("Current date/time: " + dt.getDate());

  res.end();
}).listen(8080);
*/
console.log(dt.getDate());