//TODOS LOS CAMPOS CON CLASE ID TENDRÁN ESTA FUNCIÓN CUANDO SE PRESIONE ENTER
$(document).on('keydown', '.id', function(e) {
    if (e.keyCode == 13) {
        e.preventDefault();
        // Button value
        var id = document.getElementsByClassName('id');
        var nombre = document.getElementsByClassName('nombre');
        var precio = document.getElementsByClassName('precio');
        // or, let buttonValue = document.getElementById("#myButtonId").value;
        for(let i=0; i<id.length; i++){
            // Send the POST request
            $.ajax({
                url: "database/sql-registrar-venta.php", 
                type: "POST",
                data: 'id_prod=' + id[i].textContent,
                success: function(result){
                    result = JSON.parse(result);
                    nombre[i].innerHTML = result.nombre;
                    precio[i].innerHTML = result.precio;
                    console.log(result);
                },
                error: function (err) {
                    nombre.innerHTML = 'Email and Password send failed!'
                }
            });
        }
    }
});


//FUNCIÓN PARA CREAR MÁS CAMPOS
function crearMas(){
	var d1 = document.getElementById('elementos');
	var hola = '<td><a class="cut">-</a><br><span contenteditable class="id" id="id_prod" name="id_prod"></span></td>'+
    '<td><span class="nombre" id="nombre" name="nombre"><?php echo $nombre; ?></span></td>'+
    '<td><span class="precio" id="precio" name="precio"><?php echo $precio; ?></span></td>'+
    '<td><span class="cantidad" id="cantidad" name="cantidad" contenteditable></span></td>'+
    '<td><span class="totalF" id="totalF" name="totalF"></span></td>'
    
    d1.insertAdjacentHTML('afterend',hola);
    //document.getElementById("tbody").insertRow().innerHTML = hola;
}


//FUNCIÓN PARA CALCULAR EL VALOR TOTAL DE LA VENTA
function updateInvoice() {
	var total = 0;
	var cells, price, total, a, i;

	// update inventory cells
	// ======================

	for (var a = document.querySelectorAll('table.inventory tbody tr'), i = 0; a[i]; ++i) {
		// get inventory row cells
		cells = a[i].querySelectorAll('span:last-child');

		// set price as cell[2] * cell[3]
		price = parseFloatHTML(cells[2]) * parseFloatHTML(cells[3]);

		// add price to total
		total += price;

		// set row total
		cells[4].innerHTML = price;
	}

	// update balance cells
	// ====================

	// get balance cells
	cells = document.querySelectorAll('table.balance td:last-child span:last-child');

	// set total
	cells[0].innerHTML = total;
}


//FUNCION PARA AGREGAR EN LA TABLA VENTA
function realizar_venta(){

    var totalT = document.querySelectorAll('table.balance td:last-child span:last-child');
    var totalF = totalT[0].textContent;

    var id_venta = document.getElementById("id_venta").textContent;

    var dni = document.getElementById("dni").textContent;

    var fecha = document.getElementById("fecha").textContent;
    

    $.ajax({
    url: "database/sql-registrar-venta.php", 
    type: "POST",
    data: {
        'id_venta': id_venta,
        'dni': dni,
        'fecha': fecha,
        'total': totalF
    },

    success: function(result){
        mensaje = JSON.parse(result); // MENSAJE = MENSAJE['ERROR'] = 1
        //error.innerHTML = mensaje.error;
        if(mensaje.error == 1){ // SI ES 1
            error.innerHTML = "ID YA USADO";
        }else{
            detalle_venta();
            error.innerHTML = "VENTA REGISTRADA CON ÉXITO";
        }
        console.log("Agregado con éxito");
        setTimeout(function() {
            window.location.reload()
        }, 1000);
    },
    error: function (err) {
        nombre.innerHTML = 'Email and Password send failed!'
    }
    
});
}


//FUNCION PARA AGREGAR EL DETALLE_VENTA ACTUAL
function detalle_venta(){
    for(var a = document.querySelectorAll('table.inventory tbody tr'), i = 0; a[i]; ++i){
        //FILAS DE LOS PRODUCTOS
        var inventario = a[i].querySelectorAll('span:last-child');
    
        //CONSEGUIR EL ID DE VENTA
        var id_venta = document.getElementById("id_venta").textContent;
    
        //CONSEGUIR EL ID PRODUCTO
        var id_prod = inventario[0].textContent;
    
        //CONSEGUIR LA CANTIDAD
        var cantidad = inventario[3].textContent;
    
        //TOTAL PRECIO
        var precio_total = inventario[4].textContent;
    
        var precio_unitario = inventario[2].textContent;
    
        $.ajax({
            url: "database/sql-registrar-venta.php", 
            type: "POST",
            data: {
                'id_venta': id_venta,
                'id_prod': id_prod,
                'cantidad': cantidad,
                'precio_unitario': precio_unitario,
                'precio_total': precio_total
            },
            
            success: function(result){
                console.log("Agregado con éxito");
            },
            error: function (err) {
                nombre.innerHTML = 'Email and Password send failed!'
            }
        });
    
        /*console.log("ID VENTA" + id_venta);
        console.log("ID PRODUCTO" + id_prod)
        console.log("CANTIDAD" + cantidad);
        console.log("PRECIO UNITARIO" + precio_unitario);
        console.log("PRECIOS" + precio_total);
        */
    }
}


function funciones(){
    var id_venta = document.getElementById("id_venta").textContent;

    var dni = document.getElementById("dni").textContent;

    var totalT = document.querySelectorAll('table.balance td:last-child span:last-child');
    var totalF = totalT[0].textContent;

    if(!id_venta || !dni || totalF == 0){
        error.innerHTML = "Ingresa el ID, DNI e ingresa un producto";
    }else{
        //detalle_venta();
        realizar_venta();
    }
}


