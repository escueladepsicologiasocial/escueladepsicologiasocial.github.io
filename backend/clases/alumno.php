<?php
require_once "iPersona.php";

class Alumno implements IPersona
{
	public 	$id;
	public  $usuario;	
	public  $apellido;
	public 	$nombre;
	public 	$email;
	public	$aula;
	public	$activado;
	public	$telefonofijo;
	public	$telefonomovil;
	public	$termino;
	public	$deuda;
	public	$pedidoautn;
	public	$recibidodeutn;
	public	$entregado;
	public	$formaentrega;
	public	$numseguimento;
/* inicio funciones especiales para slimFramework*/	
	public  function TraerUno($request, $response, $args) {
		$argumentos=$request->getParsedBody();
		$filtro=$argumentos['filtro'];
		$filtro2=$argumentos['filtro2'];		
		$elAlumno=Alumno::TraerTodoLosAlumnos($filtro,$filtro2);			
		//generamos html para mostrar cuotas y pagos			
		$newResponse = Alumno::generarDivAlumno($elAlumno);
		/*
		$a= fopen("divResultado.txt","a");
		fwrite($a,$newResponse);
		fclose($a);
		*/
		return $newResponse;
	}	
	public  function TraerTodos($request, $response, $args) {
		$todosLosAlumnos=Alumno::TraerTodoLosAlumnos();
		
			$newResponse = Alumno::generarDivAlumno($todosLosAlumnos);  
			return $newResponse;
		/*
		$newResponse = $response->withJson($todosLosAlumnos, 200);  
		return $newResponse;*/
	}		
    public  function CargarUno($request, $response, $args) {
		$response->getBody()->write("<h1>Cargar uno nuevo</h1>");
		$ArrayDeParametros = $request->getParsedBody();
	    //var_dump($ArrayDeParametros);    	
		$miAlumno = new Alumno();	
	    
		$miAlumno->usuario=$ArrayDeParametros['usuario'];		
		$miAlumno->apellido=$ArrayDeParametros['apellido'];
		$miAlumno->nombre=$ArrayDeParametros['nombre'];
		$miAlumno->email=$ArrayDeParametros['email'];
	    $miAlumno->aula=$ArrayDeParametros['aula'];
		$miAlumno->activado=$ArrayDeParametros['activado'];
		$miAlumno->telefonofijo=$ArrayDeParametros['telefonofijo'];
	    $miAlumno->telefonomovil=$ArrayDeParametros['telefonomovil'];
		$miAlumno->termino=$ArrayDeParametros['termino'];
		$miAlumno->deuda=$ArrayDeParametros['deuda'];
	    $miAlumno->pedidoautn=$ArrayDeParametros['pedidoautn'];
		$miAlumno->recibidodeutn=$ArrayDeParametros['recibidodeutn'];
		$miAlumno->entregado=$ArrayDeParametros['entregado'];
	    $miAlumno->formaentrega=$ArrayDeParametros['formaentrega'];
		$miAlumno->numseguimento=$ArrayDeParametros['numseguimento'];		
		$resultado = $miAlumno->InsertarElAlumno();
		   	/*
				$resultadoCuotas = Alumno::guardarCuotasYPagos($cuotas);
			*/
	   	$objDelaRespuesta= new stdclass();
		$objDelaRespuesta->resultado=$resultado;
		//$objDelaRespuesta->resultadoCuotas=$resultadoCuotas;
		return $response->withJson($objDelaRespuesta, 200);
      	
    }
	public  function BorrarUno($request, $response, $args) {
     	$ArrayDeParametros = $request->getParsedBody();
     	$id=$ArrayDeParametros['id'];
     	$Alumno= new Alumno();
     	$Alumno->id=$id;
     	$cantidadDeBorrados=$Alumno->BorrarAlumno();

     	$objDelaRespuesta= new stdclass();
	    $objDelaRespuesta->cantidad=$cantidadDeBorrados;
	    if($cantidadDeBorrados>0)
	    	{
	    		 $objDelaRespuesta->resultado="Borrado!!!";
	    	}
	    	else
	    	{
	    		$objDelaRespuesta->resultado="Algo salió mal!!!";
	    	}
	    $newResponse = $response->withJson($objDelaRespuesta, 200);  
      	return $newResponse;
    }	
	public  function ModificarUno($request, $response, $args) {
		$ArrayDeParametros = $request->getParsedBody();
	    //var_dump($ArrayDeParametros);    	
	    $miAlumno = new Alumno();
		// CARGO OBJETO ALUMNO PARA PODER UPDATEAR
		$miAlumno->id=$ArrayDeParametros['id'];
		$miAlumno->usuario=$ArrayDeParametros['usuario'];		
		$miAlumno->apellido=$ArrayDeParametros['apellido'];
		$miAlumno->nombre=$ArrayDeParametros['nombre'];
		$miAlumno->email=$ArrayDeParametros['email'];
	    $miAlumno->aula=$ArrayDeParametros['aula'];
		$miAlumno->activado=$ArrayDeParametros['activado'];
		$miAlumno->telefonofijo=$ArrayDeParametros['telefonofijo'];
	    $miAlumno->telefonomovil=$ArrayDeParametros['telefonomovil'];
		$miAlumno->termino=$ArrayDeParametros['termino'];
		$miAlumno->deuda=$ArrayDeParametros['deuda'];
	    $miAlumno->pedidoautn=$ArrayDeParametros['pedidoautn'];
		$miAlumno->recibidodeutn=$ArrayDeParametros['recibidodeutn'];
		$miAlumno->entregado=$ArrayDeParametros['entregado'];
	    $miAlumno->formaentrega=$ArrayDeParametros['formaentrega'];
		$miAlumno->numseguimento=$ArrayDeParametros['numseguimento'];
		//var_dump($miAlumno);
	   	$resultado =$miAlumno->ModificarAlumno();
	   	$objDelaRespuesta= new stdclass();
		$objDelaRespuesta->resultado=$resultado;
		return $response->withJson($objDelaRespuesta, 200);		
    }
/* final funciones especiales para slimFramework*/
  	public function BorrarAlumno(){
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta("
			delete 
			from usuarios 				
			WHERE id=:id");	
			$consulta->bindValue(':id',$this->id, PDO::PARAM_INT);		
			$consulta->execute();
		return $consulta->rowCount();
	}	
	public function ModificarAlumno(){
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
		$consulta =$objetoAccesoDato->RetornarConsulta("
		UPDATE usuarios 
			SET 
				usuario=:usuario,
				apellido=:apellido,
				nombre=:nombre,
				email=:email,
				aula=:aula,
				activado=:activado,
				telefonofijo=:telefonofijo,
				telefonomovil=:telefonomovil,
				termino=:termino,
				deuda=:deuda,
				pedidoautn=:pedidoautn,
				recibidodeutn=:recibidodeutn,
				entregado=:entregado,
				formaentrega=:formaentrega,
				numseguimento=:numseguimento			
			WHERE id=:id");
		//BINDEAMOS VALORES
		$consulta->bindValue(':id',$this->id, PDO::PARAM_INT);
		$consulta->bindValue(':nombre',$this->nombre, PDO::PARAM_STR);
		$consulta->bindValue(':usuario', $this->usuario, PDO::PARAM_STR);
		$consulta->bindValue(':apellido', $this->apellido, PDO::PARAM_STR);		
		$consulta->bindValue(':aula',$this->aula, PDO::PARAM_STR);
		$consulta->bindValue(':activado', $this->activado, PDO::PARAM_STR);
		$consulta->bindValue(':telefonofijo', $this->telefonofijo, PDO::PARAM_STR);
		$consulta->bindValue(':telefonomovil',$this->telefonomovil, PDO::PARAM_STR);
		$consulta->bindValue(':termino', $this->termino, PDO::PARAM_STR);
		$consulta->bindValue(':deuda', $this->deuda, PDO::PARAM_STR);
		$consulta->bindValue(':pedidoautn',$this->pedidoautn, PDO::PARAM_STR);
		$consulta->bindValue(':recibidodeutn', $this->recibidodeutn, PDO::PARAM_STR);
		$consulta->bindValue(':entregado', $this->entregado, PDO::PARAM_STR);
		$consulta->bindValue(':formaentrega',$this->formaentrega, PDO::PARAM_STR);
		$consulta->bindValue(':numseguimento', $this->numseguimento, PDO::PARAM_STR);		
		$consulta->bindValue(':email', $this->email, PDO::PARAM_STR);
		return $consulta->execute();
	}
	public function InsertarElAlumno(){
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
		$consulta =$objetoAccesoDato->RetornarConsulta(
			"INSERT into alumnos 
			( 
				usuario,				
				apellido,
				nombre,
				email,
				aula,
				activado,
				telefonofijo,
				telefonomovil,
				termino,
				deuda,
				pedidoautn,
				recibidodeutn,
				entregado,
				formaentrega,
				numseguimento				
			)
				values
			(
				:usuario,				
				:apellido,
				:nombre,
				:email,
				:aula,
				:activado,
				:telefonofijo,
				:telefonomovil,
				:termino,
				:deuda,
				:pedidoautn,
				:recibidodeutn,
				:entregado,
				:formaentrega,
				:numseguimento
			)");		
		$consulta->bindValue(':nombre',$this->nombre, PDO::PARAM_STR);
		$consulta->bindValue(':usuario', $this->usuario, PDO::PARAM_STR);
		$consulta->bindValue(':apellido', $this->apellido, PDO::PARAM_STR);		
		$consulta->bindValue(':aula',$this->aula, PDO::PARAM_STR);
		$consulta->bindValue(':activado', $this->activado, PDO::PARAM_STR);
		$consulta->bindValue(':telefonofijo', $this->telefonofijo, PDO::PARAM_STR);
		$consulta->bindValue(':telefonomovil',$this->telefonomovil, PDO::PARAM_STR);
		$consulta->bindValue(':termino', $this->termino, PDO::PARAM_STR);
		$consulta->bindValue(':deuda', $this->deuda, PDO::PARAM_STR);
		$consulta->bindValue(':pedidoautn',$this->pedidoautn, PDO::PARPARAM_STRAM_INT);
		$consulta->bindValue(':recibidodeutn', $this->recibidodeutn, PDO::PARAM_STR);
		$consulta->bindValue(':entregado', $this->entregado, PDO::PARAM_STR);
		$consulta->bindValue(':formaentrega',$this->formaentrega, PDO::PARAM_STR);
		$consulta->bindValue(':numseguimento', $this->numseguimento, PDO::PARAM_STR);		
		$consulta->bindValue(':email', $this->email, PDO::PARAM_STR);

		$consulta->execute();		
		return $objetoAccesoDato->RetornarUltimoIdInsertado();
	}	
	//modificar para click colaps info con cuotas
	public static function generarDivAlumno($alumnos){
			
		/************************************************************************************************/
		/******************************************  ARMO SOLAPAS  **************************************/
			$estados = Alumno::Statics($alumnos);
		    $modales="";   
			$grilla2="<h2>Alumnos</h2>
						<form>
							<div class='form-row'>
								<div class='form-group col-xs-1' style='background-color:#f44242'>
									<label for='inputNoPed'><h4>no pedidos</h4></label>
									<input type='text' class='form-control' value={$estados->noPedido} id='inputNoPed' readonly>
								</div>
								<div class='form-group col-xs-1' style='background-color:#f49842'>
									<label for='inputNoRec'><h4>no recibido</h4></label>
									<input type='text' class='form-control' value={$estados->noRecibido} id='inputNoRec' readonly>
								</div>
								<div class='form-group col-xs-1' style='background-color:#fceb02'>
									<label for='inputNoEntregado'><h4>no entregado</h4></label>
									<input type='text' class='form-control' value={$estados->noEntregado} id='inputNoEntregado' readonly>
								</div>
								<div class='form-group col-xs-1' style='background-color:#1ca025'>
									<label for='inputTodoOk'><h4>todo ok</h4></label>
									<input type='text' class='form-control' value={$estados->todoOk} id='inputTodoOk' readonly>
								</div>
							</div>
						</form>

					<ul class='nav nav-tabs' id='myTab' role='tablist'>";
						
					//CARGO TAGS O SOLAPAS DE LA LISTA AGRUPADOS DE A 100
					if(is_array($alumnos)){
						$totalDeRegistros=count($alumnos);
						$cantDeAgrupamiento=100;
						$cantidadDeTabs=intdiv($totalDeRegistros,$cantDeAgrupamiento);
						$resto=$totalDeRegistros%$cantDeAgrupamiento;
						

						if(count($alumnos)%$cantDeAgrupamiento > 0){
							$cantidadDeTabs++;
						}
						for ($i=0; $i < $cantidadDeTabs; $i++) {
							if($i==0){
								$grilla2.=  "<li class='nav-item'>
												<a class='nav-link active' id='".($i+1)."-tab' data-toggle='tab' href='#".($i+1)."' role='tab' aria-controls='home' aria-selected='true'>".($i+1)."</a>
											</li>";
							}else{
								$grilla2.=  '<li class="nav-item">
												<a class="nav-link" id="'.($i+1).'-tab" data-toggle="tab" href="#'.($i+1).'" role="tab" aria-controls="profile" aria-selected="false">'.($i+1).'</a>
											</li>';                                
							}
						}
					}                       
					$grilla2.='</ul>';
		/************************************************************************************************/
		
		
		//  CARGO CONTENIDO DE HOJAS                
					$grilla2.=  '<div class="tab-content" id="myTabContent">';
					
					$encabezado=   '<table class="table-responsive table-editable">
										<thead class="bg-info">
											<tr>
																							
												<th scope="col">#</th>												
												<th scope="col">USUARIO</th>
												<th scope="col">APELLIDO</th>
												<th scope="col">NOMBRE</th>
												<th scope="col">EMAIL</th>
												<th scope="col">AULA</th>
												<th scope="col">¿ACTIVADO?</th>
												<th scope="col">TELEFONO FIJO</th>
												<th scope="col">TELEFONO MOVIL</th>
												<th scope="col">¿TERMINÓ?</th>
												<th scope="col">¿DEUDA?</th>
												<th scope="col">PEDIDO (UTN)</th>
												<th scope="col">RECIBIDO (UTN)</th>
												<th scope="col">ENTREGADO (ALUM)</th>
												<th scope="col">FORMA DE ENTREGA</th>
												<th scope="col">NUM. SEGUIMIENTO</th>												
												<th scope="col">ACCION</th>
											</tr>
										</thead>
									<tbody class="table-editable">';
		
		
			if(is_array($alumnos)){
			
				for ($i=0; $i < $cantidadDeTabs; $i++) { 
					
					if($i==0){                    
						$grilla2.='<div id="'.($i+1).'" class="tab-pane fade show active" role="tabpanel" aria-labelledby="'.($i+1).'-tab">';
							
					}else{
						$grilla2.='<div id="'.($i+1).'" class="tab-pane fade" role="tabpanel" aria-labelledby="'.($i+1).'-tab">';                                                       
					}
					
					$grilla2.=$encabezado;
					//  CARGAR TABLAS
					/*********************************************************************************** */
					/************************************solo el primera tanda ******************************** */
					/*********************************************************************************** */
						if($i==$cantidadDeTabs-1 && $resto>0){
							for ($j=$cantDeAgrupamiento*$i; $j <$cantDeAgrupamiento*$i+$resto ; $j++){
								//$valor= $usuarios[$j];
								//var_dump($alumnos[$j]->pedidoautn!="null");                            
								
							
								$valorE = json_encode($alumnos[$j]);
								$valorM = json_encode($alumnos[$j]);
									//
										$grilla2.=  		"<tr id='tr{$j}'>
																															
																<th scope='row' bgcolor='".Alumno::Estado($alumnos[$j])."'>".($j+1)."</th>																						
																<td id='tdUsuario{$j}' ><input type='text' placeholder=':agregar' value='{$alumnos[$j]->usuario}'/></td>
																<td id='tdApellido{$j}' ><input type='text' placeholder=':agregar' value='{$alumnos[$j]->apellido}'/></td>
																<td id='tdNombre{$j}' ><input type='text' placeholder=':agregar' value='{$alumnos[$j]->nombre}'/></td>
																<td id='tdEmail{$j}' ><input type='text' placeholder=':agregar' value='{$alumnos[$j]->email}'/></td>
																<td id='tdAula{$j}' ><input type='text' placeholder=':agregar' value='{$alumnos[$j]->aula}'/></td>
																<td id='tdActivado{$j}' ><input type='text' placeholder=':agregar' value='{$alumnos[$j]->activado}'/></td>
																<td id='tdTel1{$j}' ><input type='text' placeholder=':agregar' value='{$alumnos[$j]->telefonofijo}'/></td>
																<td id='tdTel2{$j}' ><input type='text' placeholder=':agregar' value='{$alumnos[$j]->telefonomovil}'/></td>
																<td id='tdTermino{$j}' ><input type='text' placeholder=':agregar' value='{$alumnos[$j]->termino}'/></td>
																<td id='tdDeuda{$j}' ><input type='text' placeholder=':agregar' value='{$alumnos[$j]->deuda}'/></td>";
																if($alumnos[$j]->pedidoautn!="0000-00-00"){
																	$grilla2.="<td id='tdPedUtn{$j}' ><input type='date' id='asd' value='{$alumnos[$j]->pedidoautn}'/></td>";	
																}else{
																	$grilla2.="<td id='tdPedUtn{$j}' ><input type='date' id='asd' /></td>";
																}
																if($alumnos[$j]->recibidodeutn!="0000-00-00"){
																	$grilla2.="<td id='tdRecUtn{$j}' ><input type='date' id='asd' value='{$alumnos[$j]->recibidodeutn}'/></td>";	
																}else{
																	$grilla2.="<td id='tdRecUtn{$j}' ><input type='date' id='asd'/></td>";
																}
																if($alumnos[$j]->entregado!="0000-00-00"){
																	$grilla2.="<td id='tdEntregado{$j}' ><input type='date' id='asd' value='{$alumnos[$j]->entregado}'/></td>";	
																}else{
																	$grilla2.="<td id='tdEntregado{$j}' ><input type='date' id='asd'/></td>";
																}

										$grilla2.=				"<td id='tdFormaEntrega{$j}' ><input type='text' placeholder=':agregar' value='{$alumnos[$j]->formaentrega}'/></td>
																<td id='tdNumSeg{$j}' ><input type='text' placeholder=':agregar' value='{$alumnos[$j]->numseguimento}'/></td>																
																<td>
																	<div class='btn-group' role='group' aria-label='Basic example'>
																	<button type='button' class='btn btn-warning' onclick='Test.modificarAlumno({$alumnos[$j]->id},{$j})'>MODIFICAR</button>
																	<button type='button' class='btn btn-danger' onclick='Test.eliminarUsuario({$valorE})' >ELIMINAR</button>                                                        
																	</div>
																</td>
															</tr>";													
							continue;   
							}
						}else{
							for ($j=$cantDeAgrupamiento*$i; $j <$cantDeAgrupamiento*($i+1) ; $j++){								
							
								$valorE = json_encode($alumnos[$j]);
								$valorM = json_encode($alumnos[$j]);
								
								$grilla2.=  "<tr id='tr{$j}'>													
													<th scope='row' bgcolor='".Alumno::Estado($alumnos[$j])."'>".($j+1)."</th>																						
													<td id='tdUsuario{$j}' ><input type='text' placeholder=':agregar' value='{$alumnos[$j]->usuario}'/></td>
													<td id='tdApellido{$j}' ><input type='text' placeholder=':agregar' value='{$alumnos[$j]->apellido}'/></td>
													<td id='tdNombre{$j}' ><input type='text' placeholder=':agregar' value='{$alumnos[$j]->nombre}'/></td>
													<td id='tdEmail{$j}' ><input type='text' placeholder=':agregar' value='{$alumnos[$j]->email}'/></td>
													<td id='tdAula{$j}' ><input type='text' placeholder=':agregar' value='{$alumnos[$j]->aula}'/></td>
													<td id='tdActivado{$j}' ><input type='text' placeholder=':agregar' value='{$alumnos[$j]->activado}'/></td>
													<td id='tdTel1{$j}' ><input type='text' placeholder=':agregar' value='{$alumnos[$j]->telefonofijo}'/></td>
													<td id='tdTel2{$j}' ><input type='text' placeholder=':agregar' value='{$alumnos[$j]->telefonomovil}'/></td>
													<td id='tdTermino{$j}' ><input type='text' placeholder=':agregar' value='{$alumnos[$j]->termino}'/></td>
													<td id='tdDeuda{$j}' ><input type='text' placeholder=':agregar' value='{$alumnos[$j]->deuda}'/></td>";
													if($alumnos[$j]->pedidoautn!="0000-00-00"){
														$grilla2.="<td id='tdPedUtn{$j}' ><input type='date' id='asd' value='{$alumnos[$j]->pedidoautn}'/></td>";	
													}else{
														$grilla2.="<td id='tdPedUtn{$j}' ><input type='date' id='asd'/></td>";
													}
													if($alumnos[$j]->recibidodeutn!="0000-00-00"){
														$grilla2.="<td id='tdRecUtn{$j}' ><input type='date' id='asd' value='{$alumnos[$j]->recibidodeutn}'/></td>";	
													}else{
														$grilla2.="<td id='tdRecUtn{$j}' ><input type='date' id='asd'/></td>";
													}
													if($alumnos[$j]->entregado!="0000-00-00"){
														$grilla2.="<td id='tdEntregado{$j}' ><input type='date' id='asd' value='{$alumnos[$j]->entregado}'/></td>";	
													}else{
														$grilla2.="<td id='tdEntregado{$j}' ><input type='date' id='asd'/></td>";
													}

							$grilla2.=				"<td id='tdFormaEntrega{$j}' ><input type='text' placeholder=':agregar' value='{$alumnos[$j]->formaentrega}'/></td>
													<td id='tdNumSeg{$j}' ><input type='text' placeholder=':agregar' value='{$alumnos[$j]->numseguimento}'/></td>																
													<td>
														<div class='btn-group' role='group' aria-label='Basic example'>
														<button type='button' class='btn btn-warning' onclick='Test.modificarAlumno({$alumnos[$j]->id},{$j})'>MODIFICAR</button>
														<button type='button' class='btn btn-danger' onclick='Test.eliminarUsuario({$valorE})' >ELIMINAR</button>                                                       
														</div>
													</td>
												</tr>";								
							}
						}   
						$grilla2.="</tbody>";

						$grilla2.=	"</table>";
					$grilla2.="</div>";

				}
								
				
						
			}else{  
				if($alumnos!=false){// encontró 1 solo usuario 
					$valorE = json_encode($alumnos);
					$valorM = json_encode($alumnos);
					$grilla2.=	'<div id="1" class="tab-pane fade show active" role="tabpanel" aria-labelledby="1-tab">';
					$grilla2.=$encabezado;
					$j=0;					
					$grilla2.=   		"<tbody>  
											<tr id='tr1' >
												
												<th scope='row' bgcolor='".Alumno::Estado($alumnos)."'>".($j+1)."</th>																						
												<td id='tdUsuario{$j}' ><input type='text' placeholder=':agregar' value='{$alumnos->usuario}'/></td>
												<td id='tdApellido{$j}' ><input type='text' placeholder=':agregar' value='{$alumnos->apellido}'/></td>
												<td id='tdNombre{$j}' ><input type='text' placeholder=':agregar' value='{$alumnos->nombre}'/></td>
												<td id='tdEmail{$j}' ><input type='text' placeholder=':agregar' value='{$alumnos->email}'/></td>
												<td id='tdAula{$j}' ><input type='text' placeholder=':agregar' value='{$alumnos->aula}'/></td>
												<td id='tdActivado{$j}' ><input type='text' placeholder=':agregar' value='{$alumnos->activado}'/></td>
												<td id='tdTel1{$j}' ><input type='text' placeholder=':agregar' value='{$alumnos->telefonofijo}'/></td>
												<td id='tdTel2{$j}' ><input type='text' placeholder=':agregar' value='{$alumnos->telefonomovil}'/></td>
												<td id='tdTermino{$j}' ><input type='text' placeholder=':agregar' value='{$alumnos->termino}'/></td>
												<td id='tdDeuda{$j}' ><input type='text' placeholder=':agregar' value='{$alumnos->deuda}'/></td>";
												if($alumnos->pedidoautn!="0000-00-00"){
													$grilla2.="<td id='tdPedUtn{$j}' ><input type='date' id='asd' value='{$alumnos->pedidoautn}'/></td>";	
												}else{
													$grilla2.="<td id='tdPedUtn{$j}' ><input type='date' id='asd'/></td>";
												}
												if($alumnos->recibidodeutn!="0000-00-00"){
													$grilla2.="<td id='tdRecUtn{$j}' ><input type='date' id='asd' value='{$alumnos->recibidodeutn}'/></td>";	
												}else{
													$grilla2.="<td id='tdRecUtn{$j}' ><input type='date' id='asd'/></td>";
												}
												if($alumnos->entregado!="0000-00-00"){
													$grilla2.="<td id='tdEntregado{$j}' ><input type='date' id='asd' value='{$alumnos->entregado}'/></td>";	
												}else{
													$grilla2.="<td id='tdEntregado{$j}' ><input type='date' id='asd'/></td>";
												}

						$grilla2.=				"<td id='tdFormaEntrega{$j}' ><input type='text' placeholder=':agregar' value='{$alumnos->formaentrega}'/></td>
												<td id='tdNumSeg{$j}' ><input type='text' placeholder=':agregar' value='{$alumnos->numseguimento}'/></td>																
												<td>
													<div class='btn-group' role='group' aria-label='Basic example'>
													<button type='button' class='btn btn-warning' onclick='Test.modificarAlumno({$alumnos->id},{$j})'>MODIFICAR</button>
													<button type='button' class='btn btn-danger' onclick='Test.eliminarUsuario({$valorE})' >ELIMINAR</button>                                                       
													</div>
												</td>
											</tr>
											
																					
										</tbody>										
									</table>						
									
								</div>";//
				}else{//si no encontró ningun ALUMNO con el filtro
					return false;
				}
			}
			$grilla2.="</div>";
			//var_dump($grilla);


			

			return $grilla2;       

	}	
	public static function generarModalCuotasYPagos($cuotasPagos,$nombre,$apellido){
		$modal="				
				<div class='modal-dialog modal-lg'>
					<div class='modal-content'>
						<div class='modal-header'>
							<h4 class='modal-title'>Cuotas y Pagos de: ".$apellido.", ".$nombre."</h4>
							<button type='button' class='close' data-dismiss='modal'>&times;</button>                                
						</div>
						<div class='modal-body'>
							<div class='container-fluid'>
								<div class='row'>
									<div class='col-md-6'>";
										$modal.=Cuotas::generarDivCuotasDeUnAlumno($cuotasPagos->cuotas).
									"</div>
									<div class='col-md-6'>";
										$modal.=Pagos::generarDivPagosDeUnAlumno($cuotasPagos->pagos).
									"</div>
								</div>
							</div>								
						</div>
						<div class='modal-footer'>
							<button type='button' class='btn btn-default' data-dismiss='modal'>Cerrar</button>
						</div>
					</div>
				</div>";
		return $modal;
                
	}
	public static function TraerTodoLosAlumnos($filt=null,$filt2=null){
		$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
		if($filt==null){
			$consulta =$objetoAccesoDato->RetornarConsulta("select * from usuarios");
			$consulta->execute();			
			return $consulta->fetchAll(PDO::FETCH_CLASS, "Alumno");
		}else{
			if ($filt2==null) {
				$consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM usuarios WHERE aula LIKE :aula");
				$consulta->bindValue(':aula',"%".$filt."%", PDO::PARAM_STR);
				$consulta->execute();
				$respuesta = $consulta->fetchAll(PDO::FETCH_CLASS, "Alumno");

				$consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM usuarios WHERE nombre LIKE :nombre");
				$consulta->bindValue(':nombre',"%".$filt."%", PDO::PARAM_STR);
				$consulta->execute();
				$respuesta2 = $consulta->fetchAll(PDO::FETCH_CLASS, "Alumno");

				$consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM usuarios WHERE apellido LIKE :apellido");
				$consulta->bindValue(':apellido',"%".$filt."%", PDO::PARAM_STR);
				$consulta->execute();
				$respuesta3 = $consulta->fetchAll(PDO::FETCH_CLASS, "Alumno");

				foreach ($respuesta2 as $unAlumno) {
					array_push($respuesta,$unAlumno);
				}
				foreach ($respuesta3 as $unAlumno2) {
					array_push($respuesta,$unAlumno2);
				}
				return $respuesta; 		
			}else {
				$consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM usuarios WHERE apellido LIKE :apellido  AND nombre LIKE :nombre ");
				$consulta->bindValue(':apellido',"%".$filt."%", PDO::PARAM_STR);
				$consulta->bindValue(':nombre',"%".$filt2."%", PDO::PARAM_STR);
				$consulta->execute();
				$respuesta = $consulta->fetchAll(PDO::FETCH_CLASS, "Alumno");
				return $respuesta; 
			}
			
		}						
	}
	public static function TraerUnAlumno($filt){
				$objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso(); 
				$consulta =$objetoAccesoDato->RetornarConsulta("SELECT * FROM usuarios WHERE dni=:dni OR nombre= :nombre OR apellido= :apellido");
				$consulta->bindValue(':dni',$filt, PDO::PARAM_INT);
				$consulta->bindValue(':nombre',$filt, PDO::PARAM_STR);
				$consulta->bindValue(':apellido',$filt, PDO::PARAM_STR);
				$consulta->execute();
				$alumnoBuscado= $consulta->fetchObject('Alumno');
				return $alumnoBuscado;      			
	}		
	public static function Statics($Todos){		
		$todoOk=0;
		$noPedido=0;
		$noRecibido=0;
		$noEntregado=0;
		for($i=0;$i<count($Todos);$i++){
			$valor = Alumno::Estado($Todos[$i]);
			switch ($valor) {
				case "#f44242":
					$noPedido++;
					break;
				case "#f49842":					
					$noRecibido++;
					break;
				case "#fceb02":					
					$noEntregado++;
					break;
				case "#1ca025":					
					$todoOk++;
					break;
			}
		}
		$respesta = new stdclass();
		$respesta->noPedido=$noPedido;
		$respesta->noRecibido=$noRecibido;
		$respesta->noEntregado=$noEntregado;
		$respesta->todoOk=$todoOk;

		return $respesta;

	}
	public static function Estado($alum){
		if($alum->pedidoautn=="0000-00-00"){        	//                		pedido? 
			$estado="#f44242";//rojo "no pedido"

		}else if($alum->recibidodeutn=="0000-00-00"){	//ya pedido.   			recibido?
			$estado="#f49842";// naranja "pedido, pero no recibido"

		}else if($alum->entregado=="0000-00-00"){		//ya pedido y recibido. Entregado?
			$estado="#fceb02";//amarillo "pedido y recibido, no entregado"
		}else{
			$estado="#1ca025";// pedido, recibido y entregado.
		}
		return $estado;
	}
}

