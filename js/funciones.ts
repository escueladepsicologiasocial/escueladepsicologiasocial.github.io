///<reference path="../libs/jquery/index.d.ts"/>

namespace Test{

    /********************************************** GRILLAS *************************************************/    
        export function grillaAlumnos():void {
            let pagina = "backend/a/todos";
            //let datoObjeto = {"miPersona" : { "nombre" : "JUAN", "edad" : 52 } };        

            //LIMPIO EL CONTENIDO DEL DIV    
            $("#divResultado").html("");

            $.ajax({
                type: 'POST',
                url: pagina,
                dataType: "html"
            })
            .done(function (objHTML:any) {
                //console.log(objHTML);
                
                $("#divResultado").html(objHTML);
            })
            .fail(function (jqXHR:any, textStatus:any, errorThrown:any) {
                alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
            });
        }
    /********************************************* FORMS ALTAS **********************************************/
        export function formAltaUsuario():void {
            let grilla ='<input type="text" id="idUsuario" name="idUsuario" style="visibility:hidden">';
                grilla +="<div class='container'>";            
                    grilla +="<div class='row'>";
                        grilla +="<div class='form-group col-md-3'>";
                            grilla +="<label for='inputNombre'>Nombre</label>";
                            grilla +="<input type='text' class='form-control' id='inputNombre' placeholder='Nombre'>";
                        grilla +="</div>";
                        grilla +="<div class='form-group col-md-3'>";
                            grilla +="<label for='inputApellido'>Apellido</label>";
                            grilla +="<input type='text' class='form-control' id='inputApellido' placeholder='Apellido'>";
                        grilla +="</div>";
                        grilla +="<div class='form-group col-md-3'>";
                            grilla +="<label for='inputDni'>DNI</label>";
                            grilla +="<input type='text' class='form-control' id='inputDni' placeholder='D.N.I.'>";
                        grilla +="</div>";
                        grilla +="<div class='form-group col-md-3'>";
                            grilla +="<label for='inputEmail'>Fecha de Cumpleaños</label>";
                            grilla +="<input type='date' class='form-control' id='inputCumpleanios' placeholder='Fecha de Cumpleaños'>";
                        grilla +="</div>";
                        grilla +="<div class='form-group col-md-3'>";
                            grilla +="<label for='inputEmail'>Email</label>";
                            grilla +="<input type='email' class='form-control' id='inputEmail' placeholder='Email'>";
                        grilla +="</div>";
                        grilla +="<div class='form-group col-md-3'>";
                            grilla +="<label for='inputUsuario'>Usuario</label>";
                            grilla +="<input type='text' class='form-control' id='inputUsuario' placeholder='Usuario'>";
                        grilla +="</div>";
                        grilla +="<div class='form-group col-md-3'>";
                            grilla +="<label for='inputPassword'>Password</label>";
                            grilla +="<input type='password' class='form-control' id='inputPassword' placeholder='Password'>";
                        grilla +="</div>";
                        grilla +="<div class='form-group col-md-3'>";
                            grilla +="<label for='inputPerfil'>Perfil</label>";
                            grilla +="<select id='inputPerfil' class='form-control'>";
                                grilla +="<option selected>Choose...</option>";
                                grilla +="<option>Usuario</option>";
                                grilla +="<option>Admin</option>";
                                grilla +="<option>WebMaster</option>";
                                
                            grilla +="</select>";
                        grilla +="</div>";
                        grilla +="<div class='form-group col-md-3'>";
                            grilla +="<label for='inputTurno'>Turno</label>";
                            grilla +="<input type='text' class='form-control' id='inputTurno'>";
                        grilla +="</div>";
                        grilla +="<div class='form-group col-md-3'>";
                            grilla +="<label for='inputTel'>TEL</label>";
                            grilla +="<input type='text' class='form-control' id='inputTel'>";
                        grilla +="</div>";
                    
                        grilla +="<div class='form-group col-md-3'>";
                            grilla +="<label for='inputCel'>Celular</label>";
                            grilla +="<input type='text' class='form-control' id='inputCel'>";
                        grilla +="</div>";
                        grilla +="<div class='form-group col-md-3'>";
                            grilla +="<label for='inputAddress'>Direccion</label>";
                            grilla +="<input type='text' class='form-control' id='inputAddress' placeholder='Direccion 1'>";
                        grilla +="</div>";
                        grilla +="<div class='form-group col-md-3'>";
                            grilla +="<label for='inputAddress2'>Direccion 2</label>";
                            grilla +="<input type='text' class='form-control' id='inputAddress2' placeholder='Direccion 2'>";
                        grilla +="</div>";
                        
                        grilla +="<div class='form-group col-md-3'>";
                            grilla +="<label for='inputCity'>Ciudad</label>";
                            grilla +="<input type='text' class='form-control' id='inputCity'>";
                        grilla +="</div>";
                        grilla +="<div class='form-group col-md-3'>";
                            grilla +="<label for='inputState'>Provincia</label>";
                            grilla +="<select id='inputState' class='form-control'>";
                                grilla +="<option selected>Choose...</option>";
                                grilla +="<option value='BuenosAires'>Buenos Aires</option>";
                                grilla +="<option value='Catamarca'>Catamarca</option>";
                                grilla +="<option value='Chaco'>Chaco</option>";
                                

                            grilla +="</select>";
                        grilla +="</div>";
                        grilla +="<div class='form-group col-md-3'>";
                            grilla +="<label for='inputZip'>Zip</label>";
                            grilla +="<input type='text' class='form-control' id='inputZip'>";
                        grilla +="</div>";                
                        grilla +="<button id='btnAgregar' class='btn btn-primary' onclick='Test.agregarUsuario()'>Agregar</button>";
                    grilla +="</div>";            
                grilla +="</div>";

            $("#divResultado").html(grilla);
                
            
        }
        export function formAltaAlumno():void {
            	
            let grilla ='<input type="text" id="idAlumno" name="idAlumno" style="visibility:hidden">';
                grilla +="<div class='container'>";
                    grilla +="<h2> FICHA DE INSCRIPCIÓN </h2>";
                    grilla +="<hr/>";                          
                    grilla +="<div class='row'>";
                        grilla +="<div class='form-group col-md-3'>";
                            grilla +="<label for='inputLegajo'>Legajo</label>";
                            grilla +="<input type='text' class='form-control' id='inputLegajo' placeholder='Legajo'>";
                        grilla +="</div>";
                        grilla +="<div class='form-group col-md-3'>";
                            grilla +="<label for='inputCursoCarrera'>Curso/Carrera</label>";//hacer combo con los id pero muestre los nombres
                            grilla +="<input type='text' class='form-control' id='inputCursoCarrera' placeholder='Curso/Carrera'>";
                        grilla +="</div>";
                        grilla +="<div class='form-group col-md-3'>";
                            grilla +="<div class='checkbox'>";
                                grilla +="<label><input id='checkActivo' type='checkbox' value='1' checked>Activo</label>";
                            grilla +="</div>";
                        grilla +="</div>";
                        grilla +="<div class='form-group col-md-3'>";
                            grilla +="<label for='inputInscripcion'>Fecha de Inscripción</label>";
                            grilla +="<input type='date' class='form-control' id='inputInscripcion' placeholder='Fecha de Inscripción'>";
                        grilla +="</div>";
                        grilla +="<div class='form-group col-md-3'>";
                            grilla +="<label for='inputModalidad'>Modalidad</label>";//hacer combo con las modalidades
                            grilla +="<input type='text' class='form-control' id='inputModalidad' placeholder='Modalidad'>";
                        grilla +="</div>";
                        grilla +="<div class='form-group col-md-3'>";
                            grilla +="<label for='inputTurno'>Turno</label>";//hacer combo con las Turnos
                            grilla +="<input type='text' class='form-control' id='inputTurno' placeholder='Turno'>";
                        grilla +="</div>";
                        grilla +="<div class='form-group col-md-3'>";
                            grilla +="<label for='inputAnio'>Año</label>";//hacer combo con las Años segun carreras si se puede
                            grilla +="<input type='text' class='form-control' id='inputAnio' placeholder='Año'>";
                        grilla +="</div>";

                        grilla +="<hr/>"; 

                        grilla +="<div class='form-group col-md-3'>";
                            grilla +="<label for='inputDni'>DNI</label>";
                            grilla +="<input type='text' class='form-control' id='inputDni' placeholder='D.N.I.'>";
                        grilla +="</div>";
                        grilla +="<div class='form-group col-md-3'>";
                            grilla +="<label for='inputApellido'>Apellido</label>";
                            grilla +="<input type='text' class='form-control' id='inputApellido' placeholder='Apellido'>";
                        grilla +="</div>";
                        grilla +="<div class='form-group col-md-3'>";
                            grilla +="<label for='inputNombre'>Nombre</label>";
                            grilla +="<input type='text' class='form-control' id='inputNombre' placeholder='Nombre'>";
                        grilla +="</div>";
                        grilla +="<div class='form-group col-md-3'>";
                            grilla +="<label for='inputSexo'>Sexo</label>";
                            grilla +="<input type='text' class='form-control' id='inputSexo' placeholder='Sexo'>";
                        grilla +="</div>";
                        
                        grilla +="<hr/>";
                                                
                        grilla +="<div class='form-group col-md-3'>";
                            grilla +="<label for='inputEmail'>Fecha de Cumpleaños</label>";
                            grilla +="<input type='date' class='form-control' id='inputCumpleanios' placeholder='Fecha de Cumpleaños'>";
                        grilla +="</div>";
                        grilla +="<div class='form-group col-md-3'>";
                            grilla +="<label for='inputAddress'>Direccion</label>";
                            grilla +="<input type='text' class='form-control' id='inputAddress' placeholder='Direccion'>";
                        grilla +="</div>";
                        grilla +="<div class='form-group col-md-3'>";
                            grilla +="<label for='inputTel'>TEL</label>";
                            grilla +="<input type='text' class='form-control' id='inputTel'>";
                        grilla +="</div>";                    
                        grilla +="<div class='form-group col-md-3'>";
                            grilla +="<label for='inputCel'>Celular</label>";
                            grilla +="<input type='text' class='form-control' id='inputCel'>";
                        grilla +="</div>";
                        grilla +="<div class='form-group col-md-3'>";
                            grilla +="<label for='inputEstadoCivil'>Estado Civil</label>";
                            grilla +="<input type='text' class='form-control' id='inputEstadoCivil'>";//hacer combo con estados
                        grilla +="</div>";                    
                        grilla +="<div class='form-group col-md-3'>";
                            grilla +="<label for='inputSecundario'>Secundario</label>";
                            grilla +="<input type='text' class='form-control' id='inputSecundario'>";
                        grilla +="</div>";
                        grilla +="<div class='form-group col-md-3'>";
                            grilla +="<label for='inputEmail'>Email</label>";
                            grilla +="<input type='email' class='form-control' id='inputEmail' placeholder='Email'>";
                        grilla +="</div>";
                        grilla +="<div class='form-group col-md-3'>";
                            grilla +="<label for='inputFacebook'>Facebook</label>";
                            grilla +="<input type='email' class='form-control' id='inputFacebook' placeholder='Facebook'>";
                        grilla +="</div>";

                        grilla +="<hr/>";

                        grilla +="<div class='form-group col-md-3'>";
                            grilla +="<div class='checkbox'>";
                                grilla +="<label><input id='checkTrabajo' type='checkbox' value='1' >¿Trabaja?</label>";
                            grilla +="</div>";
                        grilla +="</div>";
                        grilla +="<div class='form-group col-md-5'>";
                            grilla +="<label for='inputPerfil'>¿Cómo nos conoció?</label>";
                            grilla +="<select id='inputConocer' class='form-control'>";
                                grilla +="<option selected>Choose...</option>";
                                grilla +="<option>Internet</option>";
                                grilla +="<option>Recomendado</option>";
                                grilla +="<option>Pasacalle</option>";
                                grilla +="<option>Otro</option>";                              
                            grilla +="</select>";
                        grilla +="</div>";
                        //Documentacion
                        grilla +="<div class='form-group col-md-4'>";
                            grilla +="<label for='inputPerfil'>Documentación Entregada</label>";
                            grilla +="<div class='checkbox'>";
                                grilla +="<label><input id='checkTitulo' type='checkbox' value='1'>Titulo Secundario</label>";
                            grilla +="</div>";
                            grilla +="<div class='checkbox'>";
                                grilla +="<label><input id='checkDNI' type='checkbox' value='1'>Fotocopia DNI</label>";
                            grilla +="</div>";
                            grilla +="<div class='checkbox'>";
                                grilla +="<label><input id='checkFoto' type='checkbox' value='1'>2 Foto</label>";
                            grilla +="</div>";

                            grilla +="<div class='form-group row'>";
                                grilla +="<label for='inputPago' class='col-sm-2 col-form-label'>Pago</label>";
                                grilla +="<div>";
                                    grilla +="<input type='text' class='form-control' id='inputPago'>";
                                grilla +="</div>";
                            grilla +="</div>";

                            grilla +="<label for='inputPerfil'>Comprende</label>";
                            grilla +="<div class='checkbox'>";
                                grilla +="<label><input id='checkMatricula' type='checkbox' value='1'>Matricula</label>";
                            grilla +="</div>";
                            grilla +="<div class='checkbox'>";
                                grilla +="<label><input id='checkCuotas' type='checkbox' value='1'>Cuotas( )</label>";
                            grilla +="</div>";
                            grilla +="<div class='checkbox'>";
                                grilla +="<label><input id='checkCertificacion' type='checkbox' value='1'>Certificacion</label>";
                            grilla +="</div>";

                        grilla +="</div>";

                        grilla +="<div class='form-group col-md-4'>";
                            grilla +="<div class='form-group'>";
                                grilla +="<label for='inputMat'>matricula</label>";
                                grilla +="<input type='text' class='form-control' id='inputMat' placeholder='precio'>";
                            grilla +="</div>";
                            grilla +="<div class='form-group'>";
                                grilla +="<label for='inputCuota'>Cuota</label>";
                                grilla +="<input type='text' class='form-control' id='inputCuota' placeholder='precio'>";
                            grilla +="</div>";
                            grilla +="<div class='form-group'>";
                                grilla +="<label for='inputCantCuota'>Cant. Cuotas</label>";
                                grilla +="<input type='text' class='form-control' id='inputCantCuota' placeholder='cantidad'>";
                            grilla +="</div>";
                            grilla +="<div class='form-group'>";
                                grilla +="<label for='inputDescuento'>Descuento</label>";
                                grilla +="<input type='text' class='form-control' id='inputDescuento' placeholder='valor'>";
                            grilla +="</div>";
                            grilla +="<div class='form-group'>";
                                grilla +="<label for='inputTotal'>Total</label>";//autocompletar
                                grilla +="<input type='text' class='form-control' id='inputTotal' placeholder='valor'>";
                            grilla +="</div>";                            
                        grilla +="</div>";

                        grilla +="<div class='form-group col-md-4'>";
                            grilla +="<label for='inputPromo'>Promo Actual</label>";
                            grilla +="<textarea id='inputPromo' class='form-control'></textarea>";
                        grilla +="</div>";

                        grilla +="<hr/>"; 

                        grilla +="<div class='form-group col-md-12'>";
                            grilla +="<label for='inputPromo'>Observaciones</label>";
                            grilla +="<textarea id='inputPromo' class='form-control'></textarea>";
                        grilla +="</div>";
                        
                        grilla +="<hr/>";
                        
                        
                                       
                        grilla +="<button id='btnAgregar' class='btn btn-primary' onclick='Test.agregarUsuario()'>Agregar</button>";
                    grilla +="</div>";            
                grilla +="</div>";

            $("#divResultado").html(grilla);
                
            
        }       
    /************************************************ MENUS *************************************************/
        export function home():void {
            $("#divResultado").html("");    
            $("#divMenu").html("");
        }
        export function menuUsuarios():void {
            $("#divResultado").html("");
            let grilla="<div class='float-sm-left'>";
                    grilla+="<div class='row'>";
                        grilla+="<div class='btn-group-vertical'>";
                            grilla+="<input class='form-control mr-sm-2 ' id='txtSearch'  placeholder='DNI, Apellido, Nombre' aria-label='Search'>";
                            grilla+="<button class='btn btn-outline-success my-2 my-sm-0 ' onclick='Test.buscarPorDniApellidoCarrera()'>Buscar</button>";               
                            grilla+="<button type='button' class='btn btn-secondary' onclick='Test.formAltaUsuario()' >Agregar Usuario</button>";
                            grilla+="<button type='button' onclick='Test.grillaUsuarios()' class='btn btn-secondary'>Lista Usuarios</button>";                
                        grilla+="</div>";                                    
                    grilla+="</div>";
                grilla+="</div>";
            //mando el HTML
            $("#divMenu").html(grilla);
            
        }
        //Empezar-modificar menu Alumno
        export function menuAlumnos():void {
            $("#divResultado").html("");
            let grilla="<div class='row'>";
                    grilla+="<div class='btn-group-vertical'>";
                        grilla+="<input class='form-control mr-sm-2' id='txtSearch' placeholder='usuario, Apellido, Carrera' aria-label='Search'>";
                        grilla+="<input class='form-control mr-sm-2' id='txtSearch2' placeholder='nombre' aria-label='Search'>";
                        grilla+="<button class='btn btn-outline-success my-2 my-sm-0' onclick='Test.buscarPorDniApellidoCarrera()'>Buscar Alumno</button>";               
                        grilla+="<button type='button' class='btn btn-secondary' onclick='Test.formAltaAlumno()' disabled>Agregar Alumno</button>";
                        grilla+="<button type='button' onclick='Test.grillaAlumnos()' class='btn btn-secondary'>Lista Alumno</button>";
                        grilla+="<button type='button' onclick='' class='btn btn-secondary'disabled>Listar por carrera</button>";                
                        
                    grilla+="</div>";                                    
                grilla+="</div>";
            //mando el HTML
            $("#divMenu").html(grilla);
            
        }
    //LINKS BUTONS        
        export function buscarPorDniApellidoCarrera():void{
            
            let pagina = "backend/a/filtro";
            let filtro = $('#txtSearch').val();
            let filtro2 = $('#txtSearch2').val();
            let datoObjeto = {
                    "filtro" : filtro,
                    "filtro2" : filtro2
                };        

            //LIMPIO EL CONTENIDO DEL DIV    
            $("#divResultado").html("");

            $.ajax({
                type: 'POST',            
                url: pagina,
                dataType: "html",
                data : datoObjeto,
                async: true
            })
            .done(function (objHTML:any) {
                //$("#divResultado").html('');
                if( objHTML!=false){
                    //console.log(objHTML);
                    $("#divResultado").html(objHTML);
                }else{
                    alert("No se encontró ingun usuario con el filtro:  "+filtro+" !!!")
                }
            })
            .fail(function (jqXHR:any, textStatus:any, errorThrown:any) {
                alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
            });

        }
        /*
        export function agregarUsuario(id:any,i:any):void{
            console.log(id);
            console.log(i);
            console.log(id!=undefined && i!=undefined);
            if (id!=undefined && i!=undefined){//viene del modificar 

                
                let pagina = "backend/a/";
                let Alumno:any={};
                Alumno.id=id;
                Alumno.$('#tdUsuario'+i).val();
                Alumno.$('#tdApellido'+i).val();
                Alumno.$('#tdNombre'+i).val();
                Alumno.$('#tdEmail'+i).val();
                Alumno.$('#tdAula'+i).val();
                Alumno.$('#tdActivado'+i).val();
                Alumno.$('#tdTel1'+i).val();
                Alumno.$('#tdTel2'+i).val();
                Alumno.$('#tdTermino'+i).val();
                Alumno.$('#tdDeuda'+i).val();
                Alumno.$('#tdPedUtn'+i).val();
                Alumno.$('#tdRecUtn'+i).val();
                Alumno.$('#tdEntregado'+i).val();
                Alumno.$('#tdFormaEntrega'+i).val();
                Alumno.$('#tdNumSeg'+i).val();
                console.log(JSON.stringify(Alumno));

            }else{// viene del agregar            
                let pagina = "backend/uss/";           
                
                
                
                
                //LIMPIO EL CONTENIDO DEL DIV    
                $("#divResultado").html("");

                $.ajax({
                    type: 'POST',            
                    url: pagina,
                    dataType: "text",
                    data : datoObjeto,
                    async: true
                })
                .done(function (resultado) {
                    //$("#divResultado").html('');
                    //console.log(objJSON);
                    
                    if (resultado!=null) {
                        
                        $("#divResultado").html("");
                        alert("Usuario Agregado Con Exito!!!");
                    }
                    
                })
                .fail(function (jqXHR:any, textStatus:any, errorThrown:any) {
                    alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
                });
            }

        }*/
        export function eliminarUsuario(usuario:any):void{
            
            let opcion = confirm("Está seguro que desea eliminar a "+usuario.apellido+", "+usuario.nombre+"?");
            if (opcion == true) {
                let pagina = "backend/a/";
                let datoObjeto = {
                                    "id" : usuario.id,                                
                                };        

                //LIMPIO EL CONTENIDO DEL DIV    
                //

                $.ajax({
                    type: 'DELETE',            
                    url: pagina,
                    dataType: "text",
                    data : datoObjeto,
                    async: true
                })
                .done(function (resultado) {
                    //$("#divResultado").html('');
                    //console.log(objJSON);
                    
                    if (resultado!=false){                        
                        alert("Usuario Eliminado Con Exito!!!");
                        $("#divResultado").html("");
                        buscarPorDniApellidoCarrera();
                        //grillaAlumnos();
                    }else{
                        console.log("no borro nada");
                    }
                    
                })
                .fail(function (jqXHR:any, textStatus:any, errorThrown:any) {
                    alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
                });

            } else {
                
            }
            
        }
        export function modificarAlumno(id:any,idtr:any):void{

                let pagina = "backend/a/";
                idtr= "tr"+idtr;
                //let tr2 = (<any>$(idtr)).cells;  
                var tr:any = document.getElementById(idtr);
                var tdsTr = tr.getElementsByTagName("input");                                
                let datoObjeto = {
                                
                                "id": id,
                                "usuario":tdsTr[0].value,
                                "apellido": tdsTr[1].value,
                                "nombre": tdsTr[2].value,
                                "email": tdsTr[3].value,
                                "aula": tdsTr[4].value,
                                "activado":tdsTr[5].value,
                                "telefonofijo":tdsTr[6].value,
                                "telefonomovil":tdsTr[7].value,
                                "termino":tdsTr[8].value,
                                "deuda":tdsTr[9].value,                                
                                "pedidoautn":tdsTr[10].value,                                
                                "recibidodeutn":tdsTr[11].value,
                                "entregado":tdsTr[12].value,
                                "formaentrega":tdsTr[13].value,
                                "numseguimento":tdsTr[14].value
                            };                
                $.ajax({
                    type: 'PUT',            
                    url: pagina,
                    dataType: "text",
                    data : datoObjeto,
                    async: true
                })
                .done(function (resultado) {                   
                    
                    if (resultado!=false){                        
                        console.log("Usuario Modificado Con Exito!!!");
                        alert("Aumno Modificado Con Exito!!!");
                        //buscarPorDniApellidoCarrera();                      
                    }else{
                        alert(resultado);
                        console.log("no modifico nada ");
                    }
                    
                })
                .fail(function (jqXHR:any, textStatus:any, errorThrown:any) {
                    alert(jqXHR.responseText + "\n" + textStatus + "\n" + errorThrown);
                });

            
            
        }
    //    
}   