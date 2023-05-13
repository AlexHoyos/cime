function saveEmail(){

    let correo = $("#correo").val()
    window.localStorage.setItem("correo", correo);
    insertParam("step", 2)

}

function updateSubtotal(){

    let precio_adulto = $("#precioAdulto").val()
    let precio_adol = $("#precioAdol").val()
    let precio_nino = $("#precioNino").val()

    let cant_adulto = $("#cant_adultos").val()
    let cant_adols = $("#cant_adols").val()
    let cant_ninos = $("#cant_ninos").val()

    if(cant_adulto <= 0){
        $("#cant_adultos").val(0)
        cant_adulto = 0
    }
    
    if(cant_adols <= 0){
        $("#cant_adols").val(0)
        cant_adols = 0
    }

    if(cant_ninos <= 0){
        $("#cant_ninos").val(0)
        cant_ninos = 0
    }

    let subtotal = parseFloat(precio_adulto*cant_adulto)
    subtotal += parseFloat(precio_adol*cant_adols)
    subtotal += parseFloat(precio_nino*cant_ninos)

    subtotal = subtotal.toFixed(2)

    

    if(subtotal >= 0){
        $("#subtotal").text("$"+subtotal)
        window.localStorage.setItem("subtotal", subtotal)
    }
       

}

function saveBoletos(){
    let cant_adulto = parseInt($("#cant_adultos").val())
    let cant_adols = parseInt($("#cant_adols").val())
    let cant_ninos = parseInt($("#cant_ninos").val())

    let total_asientos = cant_adulto+cant_adols+cant_ninos

    if(total_asientos <= 0){
        alert("Debes seleccionar al menos un boleto")
    }
    else if(cant_ninos > 0 && cant_adulto == 0){
        alert("Si van niños debe ir por lo menos un adulto!")
    } else {
        window.localStorage.setItem("adultos", cant_adulto)
        window.localStorage.setItem("adols", cant_adols)
        window.localStorage.setItem("ninos", cant_ninos)
        window.localStorage.setItem("total_asientos", total_asientos)
        insertParam("step", 3)
    }
        

}

function selectAsiento(asiento){
    
    if(window.localStorage.getItem("asientos") == null)
        window.localStorage.setItem("asientos", "")

    var total_asientos = window.localStorage.getItem("total_asientos")
    console.log(total_asientos)
    if(total_asientos){
        console.log("not null")
        total_asientos = parseInt(total_asientos)
        var asientos_seleccionandos = window.localStorage.getItem("tmp_asientos").split(',')
        if(total_asientos > 0){

            var asientoID = asiento.getAttribute("data-asientoID")
            if( asientos_seleccionandos.includes(asientoID)){
                // Lo eliminamos de la lista y le quitamos el color
                let posAsiento = asientos_seleccionandos.indexOf(asientoID)
                if(posAsiento > -1)
                    asientos_seleccionandos.splice(posAsiento, 1)
                
                asiento.classList.remove("bg-primary")
                asiento.classList.add("bg-warning")

            } else {

                // Revisamos que no haya superado el limite
                console.log(asientos_seleccionandos.length)
                if(asientos_seleccionandos.length <= total_asientos){
                    // Lo agregamos a la lista y le agregamos el color
                    asientos_seleccionandos.push(asientoID)
                    asiento.classList.remove("bg-warning")
                    asiento.classList.add("bg-primary")
                }


            }

        }

        window.localStorage.setItem("tmp_asientos", asientos_seleccionandos.join(','))

    } else {
        console.log("null")
    }
}

function saveAsientos(){
    var total_asientos = parseInt(window.localStorage.getItem("total_asientos"))
    var asientos_seleccionandos = window.localStorage.getItem("tmp_asientos").split(',')
    asientos_seleccionandos.splice(0, 1)
    console.log(asientos_seleccionandos)

    if(total_asientos == asientos_seleccionandos.length)
    {
        window.localStorage.setItem("asientos",  asientos_seleccionandos.join(',') )
        insertParam("step", 4)
    } else{
        alert("No has seleccionado todos los asientos!")
    }
    
}

window.addEventListener("load", function(event){
    var step = document.getElementById("step").value;

    if(step==4){
        var adultos = window.localStorage.getItem("adultos")
        var adols = window.localStorage.getItem("adols")
        var ninos = window.localStorage.getItem("ninos")
        var asientos = window.localStorage.getItem("asientos")
        var total_asientos = window.localStorage.getItem("total_asientos")
        var subtotal = window.localStorage.getItem("subtotal")
        var correo = window.localStorage.getItem("correo")

        this.document.getElementById("total_asientos").innerText = total_asientos
        this.document.getElementById("asientos_adultos").innerText = adultos
        this.document.getElementById("asientos_adols").innerText = adols
        this.document.getElementById("asientos_ninos").innerText = ninos
        this.document.getElementById("subtotal").innerText = "$"+subtotal

        this.document.getElementById("adultos").value = adultos
        this.document.getElementById("adols").value = adols
        this.document.getElementById("ninos").value = ninos
        this.document.getElementById("asientos").value = asientos
        this.document.getElementById("correo").value = correo

    }

})

window.onload = window.localStorage.setItem("tmp_asientos", "")