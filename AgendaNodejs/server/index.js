
const BodyParser =  require("body-parser");
const express    =  require("express");
const MongoClient=  require("mongodb").MongoClient;
const session    =  require("express-session");
const http       =  require("http");
const events     =  require("./router");


const url = "mongodb://localhost:27017/agenda_db";
const PORT= 3000;
const app = express();


app.use(BodyParser.json());
app.use(BodyParser.urlencoded({extended: true}));
app.use(express.static("client"));
app.use(session({
	secret: "123456X",
	resave: false,
	saveUninitialized: false
}));



http.createServer(app);


app.post("/login",function (req, res){
	
	let user = req.body.user;
	let pass = req.body.pass;
	
	MongoClient.connect(url, function (err, db){
		if (err)throw err; 
		let base = db.db("agenda_db");
		let coleccion = base.collection("usuarios");
		coleccion.findOne({email: user, pass: pass}, function (error, user){
			if (error) throw error;
			if (user){
				req.session.email_user = user.email;
				res.send("Validado");
			}else{
				res.send("Usuario o contraseña no son correctos.");
			}
		});
		  db.close();

	});


}); 



app.use("/events", events);

app.listen(PORT, function (){
	console.log(`El servidor agenda_db está corriendo por el servidor : ${PORT}`);
});


