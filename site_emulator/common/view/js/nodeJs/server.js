var WebSocket = require("ws");
var WebSocketServer = require('ws').Server;
//var mysql = require('mysql');
var wss = new WebSocketServer({port: process.argv[2]});
var userid=null;
/*var con = mysql.createConnection({
  host: "localhost",
  user: "root",
  password: "",
  database: "site_iso6b"
});*/
console.log("server started on "+process.argv[2]);
process.argv.forEach(function (val, index) {
  console.log(index + ': ' + val);
});

/*con.connect(function(err) {
  if (err) throw err;
  console.log("Connected to mysql database!");
});*/



var wsList = [];

wss.on('listening',function(){
    console.log('ok, server is running ');
});

wss.on('connection', function(ws){
    console.log("WS connection established!");
    wsList.push(ws);
   // console.log("=======Separator=======");
    //console.log(ws);

    ws.on('close', function(){
        wsList.splice(wsList.indexOf(ws),1);
        console.log("WS closed!");
    });

    ws.on('message', function(message){
        
            console.log("Got ws message: "+message);
            for(var i=0;i<wsList.length;i++){
                // send to everybody on the site               
                if(wsList[i].readyState != wsList[0].OPEN){
                    console.error('Client state is ' + wsList[i].readyState);
                }
                else{
                     wsList[i].send(message);
                }
            }

    });
    
});

wss.on('close',function(){
    console.log('server is stopping!!');
});



var express = require('express'),
    app = express();

app.use(express.static(__dirname + '/static'));
app.set('port',process.env.PORT||8888);
app.listen(8888/*app.get('port')*/);