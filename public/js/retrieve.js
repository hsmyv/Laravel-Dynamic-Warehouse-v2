   $(".edit").click(function(e){
        var mysql = require('mysql');
        var con = mysql.createConnection({
        host: "localhost",
        user: "root",
        password: "",
        database: "warehouse-v2"
        });
        con.connect(function(err) {
        if (err) throw err;
        con.query("SELECT * FROM products", function (err, result, fields) {
            if (err) throw err;
            console.log(result);
        });
        });
    });
