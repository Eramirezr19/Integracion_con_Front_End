const express = require('express');
const MongoClient = require('mongodb').MongoClient;
const url ="mongodb://localhost:27017/agenda_db";
const router = express.Router();

router.get("/all", function (req, res){
	
	if (req.session.email_user){
		MongoClient.connect(url, function (err, db){ 
			let base = db.db("agenda_db");
			let coleccion = base.collection("eventos");
			coleccion.find({fk_usuario: req.session.email_user}).toArray(function (error, eventos){
				if (error) throw erro;				
				res.send(eventos);
			});
		  db.close();	
		});
	}else{
		res.send("noLOGIN");
	}

});


router.post("/new", function (req, res){
if (req.session.email_user){
	MongoClient.connect(url, function(err, db){
		if (err) throw err;
		let base = db.db("agenda_db");
		let coleccion = base.collection("eventos");
		let nID = req.body.title.trim() + Math.floor(Math.random(0),100 )+1;
		
		coleccion.save({
			_id:nID, 
			title:req.body.title, 
			start:req.body.start,
			end: req.body.end,
			start_hour: req.body.start_hour,
			end_hour: req.body.end_hour, 
			fk_usuario: req.session.email_user
		});
		
		
		db.close();
	});
}	else{
	res.send("noLOGIN");
}

});

router.post("/delete", function (req, res){

	MongoClient.connect(url, function(err, db){
		if (err) throw err;
		let base = db.db("agenda_db");
		let coleccion = base.collection("eventos");
		
		try{
		coleccion.remove({
			_id:req.body.id, 
			fk_usuario: req.session.email_user
		});
		res.send("Se ha borrado el evento con éxito!");
		}catch (err){
			res.send(err);		
		}	

		
		
		db.close();
	});
});

router.post("/update", function (req, res){

	MongoClient.connect(url, function(err, db){
		if (err) throw err;
		let base = db.db("agenda_db");
		let coleccion = base.collection("eventos");
		try {
			coleccion.update(
				{_id:req.body.id },
				{$set:{
						start: req.body.start,
						end: req.body.end,
						end_hour: req.body.end_hour,
						start_hour: req.body.start
					}
				}
			);
			res.send("El evento se ha cambiado exitosamente");
		} catch(e){
			console.log(e);
		}
		db.close();
	});
});

router.get("/logout", function (req,res){
	req.session.email_user= false;
	req.session.destroy(function(err) {
  			res.send("adios");
	})
});

router.get("/", function (req,res){
	
	console.log("TODO OK");
	res.status(200);
	
});


module.exports = router;