<?php
class servicios_model extends CI_Model
{
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
    public function Articulos()
    {
        $i=0;
        $rtnArticulo=array();
        $query = $this->sqlsrv->fetchArray("SELECT * FROM GMV_mstr_articulos",SQLSRV_FETCH_ASSOC);
        foreach($query as $key){
            $rtnArticulo['results'][$i]['mCodigo']     = $key['ARTICULO'];
            $rtnArticulo['results'][$i]['mName']  = $key['DESCRIPCION'];
            $rtnArticulo['results'][$i]['mExistencia']   = number_format($key['EXISTENCIA'],2,'.','');
            $rtnArticulo['results'][$i]['mUnidad']       = $key['UNIDAD'];
            $rtnArticulo['results'][$i]['mPrecio']       = number_format($key['PRECIO'],2,'.','');
            $rtnArticulo['results'][$i]['mPuntos']       = $key['PUNTOS']   ;
            $rtnArticulo['results'][$i]['mReglas']       = $key['REGLAS'];
            $rtnArticulo['results'][$i]['mUnidadMedida'] = $key['UNIDAD_MEDIDA'];
            $i++;
        }
        echo json_encode($rtnArticulo);
        $this->sqlsrv->close();
    }


    public function Clientes($Vendedor)
    {
        $i=0;
        $rtnCliente=array();
        $query = $this->sqlsrv->fetchArray("SELECT * FROM GMV_Clientes WHERE VENDEDOR='".$Vendedor."'",SQLSRV_FETCH_ASSOC);
        foreach($query as $key){
            $Cumple = $this->Cumple($key['CLIENTE']);
            $rtnCliente['results'][$i]['mCliente']      = $key['CLIENTE'];
            $rtnCliente['results'][$i]['mNombre']       = $key['NOMBRE'];
            $rtnCliente['results'][$i]['mDireccion']    = $key['DIRECCION'];
            $rtnCliente['results'][$i]['mRuc']          = $key['RUC'];
            $rtnCliente['results'][$i]['mPuntos']       = $key['RUBRO1_CLI'];
            $rtnCliente['results'][$i]['mMoroso']       = $key['MOROSO'];
            $rtnCliente['results'][$i]['mCredito']      = number_format($key['CREDITO'],2, '.', '');
            $rtnCliente['results'][$i]['mSaldo']        = number_format($key['SALDO'],2, '.', '');
            $rtnCliente['results'][$i]['mDisponible']   = number_format($key['DISPONIBLE'],2, '.', '');
            $rtnCliente['results'][$i]['mCumple']       = $Cumple;
            $rtnCliente['results'][$i]['mMes']          = intval(substr($Cumple,3,2));
            $i++;
        }
        echo json_encode($rtnCliente);
        $this->sqlsrv->close();
    }

    public function porcentaje($actual,$meta)
    {
        if ($meta != 0) {
            return number_format((($actual/$meta)*100),0,',','');
        }return 0;
    }

    public function Historial($Vendedor)
    {
        $i=0;
        $rtnCliente=array();
        $query = $this->sqlsrv->fetchArray("SELECT * FROM GMV_hstCompra_3M WHERE VENDEDOR='".$Vendedor."' ",SQLSRV_FETCH_ASSOC);
        foreach($query as $key){
            $rtnCliente['results'][$i]['mArticulo']      = $key['ARTICULO'];
            $rtnCliente['results'][$i]['mNombre']       = $key['DESCRIPCION'];
            $rtnCliente['results'][$i]['mCantidad']    = number_format($key['CANTIDAD'],0);
            $rtnCliente['results'][$i]['mFecha']          = $key['Dia'];
            $rtnCliente['results'][$i]['mCliente']       = $key['Cliente'];
            $rtnCliente['results'][$i]['mVendedor']       = $key['VENDEDOR'];
            $i++;
        }
        echo json_encode($rtnCliente);
        $this->sqlsrv->close();
    }
    private function Cumple($Codigo)
    {
        $i=0;
        $rtnCliente="00-00-0000";
        $query = $this->sqlsrv->fetchArray("SELECT convert(varchar, Fecha, 105) as Fecha FROM tblcumplenero WHERE Codigo='".$Codigo."'",SQLSRV_FETCH_ASSOC);
        foreach($query as $key){
            $rtnCliente = $key['Fecha'];
            $i++;
        }
        return  $rtnCliente;
        $this->sqlsrv->close();
    }
    public function ClienteMora($Vendedor)
    {
        $i=0;
        $rtnCliente=array();
        $query = $this->sqlsrv->fetchArray("SELECT * FROM GMV_ClientesPerMora WHERE VENDEDOR='".$Vendedor."'",SQLSRV_FETCH_ASSOC);
        foreach($query as $key){
            $rtnCliente['results'][$i]['mCliente']      = $key['CLIENTE'];
            $rtnCliente['results'][$i]['mNombre']       = $key['NOMBRE'];
            $rtnCliente['results'][$i]['mVencidos']   = number_format($key['NoVencidos'],2,'.','');
            $rtnCliente['results'][$i]['mD30']       = number_format($key['Dias30'],2,'.','');
            $rtnCliente['results'][$i]['mD60']       = number_format($key['Dias60'],2,'.','');
            $rtnCliente['results'][$i]['mD90']       = number_format($key['Dias90'],2,'.','');
            $rtnCliente['results'][$i]['mD120']      = number_format($key['Dias120'],2,'.','');
            $rtnCliente['results'][$i]['mMd120']       = number_format($key['Mas120'],2,'.','');
            $i++;
        }
        echo json_encode($rtnCliente);
        $this->sqlsrv->close();
    }
    public function ClienteIndicadores($Vendedor)
    {
        $i=0;
        $rtnCliente=array();
        $query = $this->sqlsrv->fetchArray("SELECT * FROM GMV_indicadores_clientes WHERE VENDEDOR='".$Vendedor."'",SQLSRV_FETCH_ASSOC);
        foreach($query as $key){
            $rtnCliente['results'][$i]['mCliente']           = $key['CLIENTE'];
            $rtnCliente['results'][$i]['mNombre']            = $key['NombreCliente'];
            $rtnCliente['results'][$i]['mVendedor']          = $key['VENDEDOR'];
            $rtnCliente['results'][$i]['mMetas']             = number_format($key['MetaVentaEnValores'],2,'.','');
            $rtnCliente['results'][$i]['mVentasActual']      = number_format($key['VentaEnValoresAct'],2,'.','');
            $rtnCliente['results'][$i]['mPromedioVenta3M']   = number_format($key['VentaEnValores3MAnt'],2,'.','');
            $rtnCliente['results'][$i]['mCantidadItems3M']   = number_format($key['NumItemFac3MAnt'],2,'.','');
            $rtnCliente['results'][$i]['mCumplimiento']      = $this->porcentaje($key['VentaEnValoresAct'],$key['MetaVentaEnValores']);
            $i++;
        }
        echo json_encode($rtnCliente);
        $this->sqlsrv->close();
    }
    public function Puntos($Vendedor)
    {
        $i=0;
        $rtnCliente=array();
        $query = $this->sqlsrv->fetchArray("SELECT CLIENTE,CONVERT(VARCHAR(50),FECHA,110) AS FECHA,FACTURA,SUM(TT_PUNTOS) AS TOTAL,RUTA FROM vtVS2_Facturas_CL WHERE RUTA = '".$Vendedor."'
                        GROUP BY FACTURA,FECHA,RUTA,CLIENTE",SQLSRV_FETCH_ASSOC);
       foreach($query as $key){
            $Remanente = number_format($this->FacturaSaldo($key['FACTURA'],$key['TOTAL']),2,'.','');
            if (intval($Remanente) > 0.00 ) {
                $rtnCliente['results'][$i]['mFecha']            = $key['FECHA'];
                $rtnCliente['results'][$i]['mCliente']            = $key['CLIENTE'];
                $rtnCliente['results'][$i]['mFactura']          = $key['FACTURA'];
                $rtnCliente['results'][$i]['mPuntos']           = number_format($key['TOTAL'],2,'.','');
                $rtnCliente['results'][$i]['mRemanente']        = $Remanente;
                $i++;
            }
            
        }

        echo json_encode($rtnCliente);

        $this->sqlsrv->close();
    }
    public function FacturaSaldo($id,$pts){        
        $this->db->where('Factura',$id);
        $this->db->select('Puntos');
        $query = $this->db->get('visys.rfactura');
        if($query->num_rows() > 0){
            $parcial = $query->result_array()[0]['Puntos'];
        } else {
            $parcial = $pts;
        }
        return $parcial;
    }
    public function LoginUsuario($usuario,$pass){
        $i=0;
        $rtnUsuario = array();

        $this->db->where('Usuario',$usuario);
        $this->db->where('Password',$pass);
        $query = $this->db->get('usuario');

            
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $key) {
                $rtnUsuario['results'][$i]['mUsuario'] = $key['Usuario'];
                $rtnUsuario['results'][$i]['mNombre'] = $key['Nombre'];
                $rtnUsuario['results'][$i]['mIdUser'] = $key['IdUser']; 
                $rtnUsuario['results'][$i]['mPass'] = $key['Password']; 
            }            
        }
        echo json_encode($rtnUsuario);
    }
    public function uptCumple(){
        $query = $this->db->get('cumpleanero.tblcumplenero');
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $key) {
                $tmp = new Cumpleannos();
                $cu = substr($key['cedula'],4,strlen($key['cedula']));
                $cu = substr($cu,0,strpos($cu, "-"));
                $tmp->setCodigo($this->Strg_ID_CLIENTE($key['Codigo']));
                $tmp->setCedula($this->getDateString($cu));
                $tmp->setRuta($key['ruta']);
                $this->db->where('Codigo', $key['Codigo']);
                $this->db->update('cumpleanero.tblcumplenero', $tmp);
            }

        }
    }
    public function getDateString($str){
        if($str!=""){
            return substr($str,0,2)."-".substr($str,2,2)."-19".substr($str,4,2);
        }
        return "";
    }
    public function Strg_ID_CLIENTE($str){
        switch (strlen($str)) {
            case '1':
                $varreturn="0000".$str;
                break;
            case '2':
                $varreturn="000".$str;
                break;
            case '3':
                $varreturn="00".$str;
                break;
            case '4':
                $varreturn="0".$str;
                break;
            case '5':
                $varreturn=$str;
                break;
            default;
                $varreturn=$str;
                break;

        }
        return $varreturn;
    }
    public function Agenda($Ruta){
        $i=0;
        $rtnAgenda = array();
        $this->db->where('Ruta',$Ruta);
        $this->db->where('Estado',1);
        $query = $this->db->get('vtsplanes');


        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $key) {
                $rtnAgenda['results'][$i]['mIdPlan']        = $key['IdPlan'];
                $rtnAgenda['results'][$i]['mVendedor']      = $key['Vendedor'];
                $rtnAgenda['results'][$i]['mRuta']          = $key['Ruta'];
                $rtnAgenda['results'][$i]['mInicia']        = $key['Inicia'];
                $rtnAgenda['results'][$i]['mTermina']       = $key['Termina'];
                $rtnAgenda['results'][$i]['mZona']          = $key['Zona'];
                $rtnAgenda['results'][$i]['mEstado']        = $key['Estado'];
                $rtnAgenda['results'][$i]['mLunes']         = $key['Lunes'];
                $rtnAgenda['results'][$i]['mMartes']        = $key['Martes'];
                $rtnAgenda['results'][$i]['mMiercoles']     = $key['Miercoles'];
                $rtnAgenda['results'][$i]['mJueves']        = $key['Jueves'];
                $rtnAgenda['results'][$i]['mViernes']       = $key['Viernes'];
            }
        }
        echo json_encode($rtnAgenda);
    }
  public function InsertCobros($json){
    $cobros = '';
    $jsonCobro = array();
    $i = 0;
        foreach(json_decode($json, true) as $key){
            $cobros .= "'".$key['mIdCobro']."',";
            $Cobros = array(
                'IDCOBRO'     => $key['mIdCobro'],
                'CLIENTE'     => $key['mCliente'],
                'RUTA'        => $key['mRuta'],
                'TIPO'        => $key['mTipo'],
                'IMPORTE'     => $key['mImporte'],
                'OBSERVACION' => $key['mObservacion'],
                'FECHA'       => $key['mFecha']);
           $query = $this->db->insert('cobros', $Cobros);
        }
        $query22 = $this->db->query("SELECT IDCOBRO FROM cobros WHERE IDCOBRO IN (".substr($cobros, 0,-1).")");
        if ($query22->num_rows()>0)
        {
            $cobros = '';
            foreach ($query22->result_array() as $key)
            {
                $cobros .= "'".$key['IDCOBRO']."',";
            }
            $jsonCobro['results'][$i]['mIdCobro'] = substr($cobros, 0,-1);
        }
        echo json_encode($jsonCobro);
    }
    public function InsertVisitas($json){
        foreach(json_decode($json, true) as $key){
            $Visitas = array(
                'IdPlan'       => $key['mIdPlan'],
                'IdCliente'    => $key['mIdCliente'],
                'Fecha'        => $key['mFecha'],
                'Lati'         => $key['mLati'],
                'Logi'         => $key['mLogi'],
                'Local'        => $key['mLocal'],
                'Inicio'       => $key['mInicio'],
                'Fin'          => $key['mFin'],
                'Observacion'  => $key['mObservacion'],
                'Accion'       => $key['mTipo']);
            $query = $this->db->insert('visitas', $Visitas);
        }
        echo json_encode($query);
    }

    public function InsertAgenda($json){
        foreach(json_decode($json, true) as $key){
            $AgendaTop = array(
                'IdPlan'      => $key['mIdPlan'],
                'Vendedor'    => $key['mVendedor'],
                'Ruta'        => $key['mRuta'],
                'Inicia'      => $key['mInicia'],
                'Termina'     => $key['mTermina'],
                'Zona'        => $key['mZona']);
            $this->db->insert('agenda', $AgendaTop);

            $AgendaTop = array(
                'IdPlan'       => $key['mIdPlan'],
                'Lunes'        => $key['mLunes'],
                'Martes'       => $key['mMartes'],
                'Miercoles'    => $key['mMiercoles'],
                'Jueves'       => $key['mJueves'],
                'Viernes'      => $key['mViernes']);
            $query = $this->db->insert('vclientes', $AgendaTop);
        }
        echo json_encode($query);
    }

    public function insertPedidos($Data){
        $i = 0;
        $rtnPedidos = array();
        $cadena = "";

        foreach(json_decode($Data, true) as $key){
            $resp = "NINGUNO";
            $responsable = $this->db->query("SELECT ResponsableUsuario FROM view_grupoasignacion WHERE Ruta = '".$key['mVendedor']."'");
            if ($responsable->num_rows()>0) {
                $resp = $responsable->result_array()[0]['ResponsableUsuario'];
            }

            $query = $this->db->query("SELECT IDPEDIDO FROM pedido WHERE IDPEDIDO = '".$key['mIdPedido']."'");
            
            $cadena .= "'".$key['mIdPedido']."',";

            if ($query->num_rows() == 0){
                $this->db->query("UPDATE llaves SET pedido = pedido+1 WHERE RUTA ='".$key['mVendedor']."'");

                $insert = $this->db->query('CALL SP_pedidos ("'.$key['mIdPedido'].'","'.$key['mVendedor'].'","'.$key['mCliente'].'",
                                            "'.str_replace("'", "", $key['mNombre']).'","'.$key['mFecha'].'","'.$key['mPrecio'].'","'.$key['mEstado'].'",
                                            "'.$resp.'","'.$key['mComentario'].'")');


                for ($e=0; $e <(count($key['detalles']['nameValuePairs']))/6; $e++){
                    $datos = array('IDPEDIDO'   => $key['detalles']['nameValuePairs']['ID'.$i],
                                   'ARTICULO'   => $key['detalles']['nameValuePairs']['ARTICULO'.$i],
                                   'DESCRIPCION'=> str_replace("'", "", $key['detalles']['nameValuePairs']['DESC'.$i]),
                                   'CANTIDAD'   => $key['detalles']['nameValuePairs']['CANT'.$i],
                                   'TOTAL'      => number_format(str_replace(",", "", $key['detalles']['nameValuePairs']['TOTAL'.$i]),2),
                                   'BONIFICADO' => $key['detalles']['nameValuePairs']['BONI'.$i]
                                );
                    $this->db->insert('pedido_detalle',$datos);
                    $i++;
                }
            }else{
                for ($e=0; $e <(count($key['detalles']['nameValuePairs']))/6; $e++){
                    $i++;
                }
            }
        }
        $query22 = $this->db->query("SELECT IDPEDIDO,ESTADO,COMENTARIO,IFNULL(COMENTARIO_CONFIR,'') COMENTARIO_CONFIR FROM pedido WHERE IDPEDIDO IN (".substr($cadena, 0,-1).")");
        
        if ($query22->num_rows()>0)
        {
            $i = 0;
            foreach ($query22->result_array() as $key)
            {
                $rtnPedidos['results'][$i]['mIdPedido'] = $key['IDPEDIDO'];
                $rtnPedidos['results'][$i]['mEstado'] = $key['ESTADO'];
                $rtnPedidos['results'][$i]['mComentario'] = $key['COMENTARIO'];
                $rtnPedidos['results'][$i]['mConfirmacion'] = $key['COMENTARIO_CONFIR'];
                $i++;
            }
        }else{
            $rtnPedidos['results'][$i]['mIdPedido'] = "";
            $rtnPedidos['results'][$i]['mEstado'] = "";
            $rtnPedidos['results'][$i]['mComentario'] = "";
            $rtnPedidos['results'][$i]['mConfirmacion'] = "";
        }
        echo json_encode($rtnPedidos);
    }

    public function insertRazones($Post){
        $i = 0;
        $rtnUsuario = array();
        $cadena = "";

        foreach(json_decode($Post, true) as $key){
            $cadena = "'".$key['mIdRazon']."',";

                $datos = array('IdRazon' => $key['mIdRazon'],
                                'Vendedor' => $key['mVendedor'],
                                'Cliente' => $key['mCliente'],
                                'Fecha' => $key['mFecha'],
                                'Observacion' => $key['mObservacion']
                            );
                $insert= $this->db->insert('RAZON',$datos);

                
                for ($e=0; $e <(count($key['detalles']['nameValuePairs']))/6; $e++){
                    $datos2 = array('IdRazon'   => $key['detalles']['nameValuePairs']['IdRazon'.$i],
                                   'IdAE'   => $key['detalles']['nameValuePairs']['IdAE'.$i],
                                   'Actividad'=> $key['detalles']['nameValuePairs']['Actividad'.$i],
                                   'Categoria'   => $key['detalles']['nameValuePairs']['Categoria'.$i]
                                );
                    $this->db->insert('razon_detalle',$datos2);
                    $i++;
                }                
            }
        
        $query = $this->db->query("SELECT IdRazon FROM RAZON WHERE IdRazon IN (".substr($cadena, 0,-1).")");
        if ($query->num_rows()>0) {
            $rtnUsuario['results'][0]['mEstado'] = "RAZONEZ ENVIADAS...";
        }else{
            $rtnUsuario['results'][0]['mEstado'] = "ERROR EN RAZONES, INTENTELO MAS TARDE";
        }
        echo json_encode($rtnUsuario);
    }

    public function updatePedidos($Post){
        $i = 0;
        $rtnPedido = array();
        foreach(json_decode($Post, true) as $key){
            $this->db->where('IDPEDIDO',$key['mIdPedido']);
            $this->db->select('IDPEDIDO,ESTADO');
            $query = $this->db->get('pedido');
            if ($query->num_rows()>0) {
                foreach ($query->result_array() as $key) {
                    $rtnPedido['results'][$i]['mIdPedido']  = $key['IDPEDIDO'];
                    $rtnPedido['results'][$i]['mEstado']    = $key['ESTADO'];
                    $i++;
                }
            }else{
                    $rtnPedido['results'][$i]['mIdPedido']  = " ";
                    $rtnPedido['results'][$i]['mEstado']    = " ";
            }
        }
        echo json_encode($rtnPedido);
    }

    public function Actividades(){
        $i=0;
        $rtnActividad = array();
        $query=$this->db->get('actividades');

        if ($query->num_rows()>0)
        {
            foreach ($query->result_array() as $key)
            {
                $rtnActividad['results'][$i]['mIdAE'] = $key['IDACTIVIDAD'];
                $rtnActividad['results'][$i]['mCategoria'] = $key['CATEGORIA'];
                $rtnActividad['results'][$i]['mActividad'] = $key['ACTIVIDAD'];
                $i++;
            }
        }
        echo json_encode($rtnActividad);
    }
    public function lotes(){
        $i=0;
        $rtnCliente=array();
        $query = $this->sqlsrv->fetchArray("SELECT * FROM GMV_LOTES",SQLSRV_FETCH_ASSOC);
        foreach($query as $key){
            $rtnCliente['results'][$i]['mCodigo']          = $key['ARTICULO'];
            $rtnCliente['results'][$i]['mLote']              = $key['LOTE'];
            $rtnCliente['results'][$i]['mUnidad']          = number_format($key['CANT_DISPONIBLE'],2,'.','');
            $rtnCliente['results'][$i]['mFecha']              = $key['FECHA_VENCIMIENTO'];
            
            $i++;
        }
        echo json_encode($rtnCliente);
        $this->sqlsrv->close();
    }
    public function CONSECUTIVO($usuario)
    {
        $i=0;
        $array = array();
        $query = $this->db->query("SELECT * FROM llaves WHERE RUTA = '".$usuario."'");

        if ($query->num_rows()>0)
        {
            foreach ($query->result_array() as $key)
            {
                $array['results'][$i]['mPedido'] = $key['PEDIDO'];
                $array['results'][$i]['mCobro'] = $key['COBRO'];
                $array['results'][$i]['mRazon'] = $key['RAZON'];
                $i++;
            }
        }
        echo json_encode($array);

    }
}
?>
