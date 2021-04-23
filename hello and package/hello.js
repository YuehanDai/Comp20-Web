var http = require('http');

http.createServer(function (req, res) {
  res.writeHead(200, {'Content-Type': 'text/html'});
  res.write("<h2>Node js demo</h2>");
  res.write("Hello World</br>");
  res.write("Yuehan Dai</br>");
  res.write("</br>");
  res.end();
}).listen(8080);