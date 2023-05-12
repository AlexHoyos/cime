<?php

use CIME\Filters\SessionFilter;
use CIME\Models\Asiento;
use CIME\Models\AsientoReservado;
use CIME\Models\Boleto;
use CIME\Models\Funcion;
use CIME\Models\Usuario;

include_once '../main.php';

if(isset($_POST["asientos"], $_POST["adultos"], $_POST["adols"], $_POST["ninos"], $_GET["funcion_id"], $_POST["correo"])){
    
    $asientos = [];

    $asientosRaw = explode(",", $_POST["asientos"]);
    foreach($asientosRaw as $asientoID){
        if(intval($asientoID) > 0)
            $asientos[] = intval($asientoID);
    }

    $adultos = intval($_POST["adultos"]);
    $adols = intval($_POST["adols"]);
    $ninos = intval($_POST["ninos"]);
    $funcion_id = intval($_GET["funcion_id"]);
    $correo = $_POST["correo"];

    if(count($asientos) > 0){

        $funcion = Funcion::getById(intval($funcion_id));
        if($funcion instanceof Funcion){

            $clasificacion = $funcion->getPelicula()->getClasificacionInstance();
            $total_asientos = $adultos;
            $subtotal = 0;
            if($adultos > 0 || $clasificacion->isForAdolAdult()){

                $ventaPermitida = true;
                if( $ninos > 0 ){
                    if($adultos <= 0 || $clasificacion->isForNinos() == false)
                        $ventaPermitida = false;
                    else
                        $total_asientos += $ninos;
                }
                    

                if($adols > 0){

                    if($clasificacion->isForAdolAdult() && $adultos <= 0)
                        $ventaPermitida = false;
                    else if($clasificacion->isForAdolescentes() == false)
                        $ventaPermitida = false;
                    else
                        $total_asientos += $adols;
                }

                if($ventaPermitida){

                   if($total_asientos > 0){

                        if($total_asientos == count($asientos)){

                            $userSession = SessionFilter::getUserBySession();

                            if(filter_var($correo, FILTER_VALIDATE_EMAIL) || $userSession instanceof Usuario){

                                $userId = ($userSession == null) ? "NULL" : $userSession->getId();
                                $correo = ($userSession == null) ? $correo : $userSession->getCorreo();

                                $subtotal += floatval($adultos*$funcion->getPrecioAdulto());
                                $subtotal += floatval($adols*$funcion->getPrecioAdol());
                                $subtotal += floatval($ninos*$funcion->getPrecioNino());

                                $asientosValidos = true;

                                foreach($asientos as $asientoID){
                                    $asiento = Asiento::getById($asientoID);
                                    $disponible = AsientoReservado::isAsientoDisponible($asientoID, $funcion_id);
                                    if($disponible == false || $asiento == null){
                                        $asientosValidos = false;
                                        break;
                                    }
                                        
                                }

                                if($asientosValidos){
                                    
                                    $boleto = new Boleto(NULL, 5, $adultos, $adols, $ninos, $userId, $correo, $funcion_id, false);
                                    
                                    if($boleto->create()){
                                        
                                        $boletoID = 0;
                                        $boletosPage = Boleto::getAll([], "id_funcion = {$funcion_id} AND correo = '{$correo}' AND id_usuario = {$userId}", "ORDER BY id DESC")->page(1);
                                        if(isset($boletosPage[0]))
                                            $boletoID = $boletosPage[0]["id"];

                                        if($boletoID > 0){
                                            
                                            foreach($asientos as $asientoID){
                                                $asiento = new AsientoReservado($asientoID, $funcion_id, $boletoID);
                                                $asiento->create();
                                            }

                                            try {

                                                $paypalResponse = $gateway->purchase([
                                                    "amount" => $subtotal,
                                                    "currency" => PAYPAL_CURRENCY,
                                                    "returnUrl" => WEB_URL."/app/Controllers/AcompletarVenta.php?boleto_id=".$boletoID,
                                                    "cancelUrl" => WEB_URL."/app/Controllers/CancelarVenta.php?boleto_id=".$boletoID
                                                ])->send();
        
                                                if($paypalResponse->isRedirect()){
        
                                                    $paypalResponse->redirect();
    
        
                                                } else {

                                                    $boleto->getById($boletoID);
                                                    if($boleto instanceof Boleto)
                                                        $boleto->delete();
                                                    header("Location: ". WEB_URL . "/reservar.php?funcion={$funcion_id}&step=4&error=Hubo un error al hacer el pago");
                                                }
        
                                            } catch(Exception $e){
                                                header("Location: ". WEB_URL . "/reservar.php?funcion={$funcion_id}&step=2&error=".$e->getMessage());
                                            }

                                        } else {
                                            header("Location: ". WEB_URL . "/reservar.php?funcion={$funcion_id}&step=4&error=Hubo un error al crear el boleto!");
                                        }

                                    } else {
                                        header("Location: ". WEB_URL . "/reservar.php?funcion={$funcion_id}&step=4&error=Hubo un error al crear el boleto!");
                                    }

                                } else {
                                    header("Location: ". WEB_URL . "/reservar.php?funcion={$funcion_id}&step=3&error=Algunos asientos seleccionados estan ocupados!");
                                }

                            } else {
                                header("Location: ". WEB_URL . "/reservar.php?funcion={$funcion_id}&step=1&error=Correo invalido!");
                            }

                        } else {
                            header("Location: ". WEB_URL . "/reservar.php?funcion={$funcion_id}&step=2&error=El total de personas no coincide con el total de asientos!");
                        }

                   } else {
                        header("Location: ". WEB_URL . "/reservar.php?funcion={$funcion_id}&step=2&error=Debe seleccionar al menos un asiento!");
                   }

                } else {
                    header("Location: ". WEB_URL . "/reservar.php?funcion={$funcion_id}&step=2&error=No se puede hacer la venta por la restriccion de la clasificacion!");
                }

            } else {
                header("Location: ". WEB_URL . "/reservar.php?funcion={$funcion_id}&step=2&error=Al menos un adulto debe estar acompañando!");
            }

        } else {
            header("Location: ". WEB_URL . "/reservar.php?funcion={$funcion_id}&step=2&error=No se encontró la función");
        }

    } else {
        header("Location: ". WEB_URL . "/reservar.php?funcion={$funcion_id}&step=2&error=No se han seleccionado asientos");
    }

} else {
    header("Location: ". WEB_URL . "/?error=No se recibieron todos los parametros esperados");
}
