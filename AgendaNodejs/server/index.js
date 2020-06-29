const http = require('http'),
      path= require('path'),
      Routing = require('./rutas.js'),
      express = require('express'),
      bodyParser = require('body-parser'),
      mongoose = require('mongoose');

const PORT = 8082
const app = express()

const Server = http.createServer(app)

app.use(express.static('client'))
app.use(bodyParser.json())
app.use(bodyParser.urlencoded({extended:true}))


Server.listen(PORT, function(){
    console.log('El servidor esta escuchando en puerto:' + PORT)
})

