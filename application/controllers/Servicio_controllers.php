<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Servicio_controllers extends CI_Controller {

	public function index()
	{
		//$this->load->view('welcome_message');
	}
	public function Actividades()
	{
		$this->servicios_model->Actividades();
	}
	public function articulos()
	{
		$this->servicios_model->Articulos();
	}
	public function cumple()
	{
		$this->servicios_model->uptCumple();
	}
	public function ClientesMora()
	{
		$this->servicios_model->ClienteMora($_POST['mVendedor']);
	}
	public function ClientesIndicadores()
	{
		$this->servicios_model->ClienteIndicadores($_POST['mVendedor']);
	}
	public function Clientes()
	{
		$this->servicios_model->Clientes($_POST['mVendedor']);
		//$this->servicios_model->Clientes("f03");
	}
	public function Historial()
	{
		$this->servicios_model->Historial($_POST['mVendedor']);
	}
	public function Puntos()
	{
		$this->servicios_model->Puntos($_POST['mVendedor']);
	}
	public function Agenda()
	{
		$this->servicios_model->Agenda($_POST['mVendedor']);
	}
	public function InsertCobros()
	{
		//$cobros = '[{"mCliente":"00998","mFecha":"2017-06-20 18:04:47","mIdCobro":"F09-C200617201","mImporte":"15000","mObservacion":"COBRO EXCESIVO","mRuta":"F09","mTipo":"EFECTIVO"},{"mCliente":"03408","mFecha":"2017-06-20 18:05:04","mIdCobro":"F09-C200617202","mImporte":"160","mObservacion":"EKISDE","mRuta":"F09","mTipo":"EFECTIVO"}]';
		$this->servicios_model->InsertCobros($_POST['pCobros']);
		//$this->servicios_model->InsertCobros($cobros);
	}
	public function InsertVisitas()
	{
		$this->servicios_model->InsertVisitas($_POST['mVisitas']);
	}
	public function InsertAgenda()
	{
		$this->servicios_model->InsertAgenda($_POST['mAgenda']);
	}
	public function LoginUsuario()
	{
		$this->servicios_model->LoginUsuario($_POST['usuario'],$_POST['pass']);
	}
	public function insertPedidos()
	{		
		//$PEDIDOS = '[{"detalles":{"nameValuePairs":{"ID0":"F09P20061731","ARTICULO0":"10311092","DESC0":"Zanate (Deltametrina) 0.219 mg Loción 30 ml/Frasco 1/Caja (Ramos)","CANT0":"2.0","TOTAL0":"21","BONI0":"0","ID1":"F09P20061731","ARTICULO1":"10520042","DESC1":"Sales de Rehidratación Oral 28.1g/Sobre Polvo para 1 Litro Sabor Manzana 20/Caja (Intermed)","CANT1":"123.0","TOTAL1":"120","BONI1":"100+40"}},"mCliente":"00991","mComentario":"","mEstado":"0","mFecha":"2017-06-20 18:04:27","mIdPedido":"F09P20061731","mNombre":"FARMACIA INMACULADA ruc 0922610600001W","mPrecio":"14802.0","mVendedor":"F09"}]';
		$this->servicios_model->insertPedidos($_POST['PEDIDOS']);
		//$this->servicios_model->insertPedidos($PEDIDOS);
	}
	public function updatePedidos()
	{
		$this->servicios_model->updatePedidos($_POST['PEDIDOS']);
	}
	public function insertRazones()
	{
		$this->servicios_model->insertRazones($_POST['RAZONES']);
	}
	public function lotes()
	{
		$this->servicios_model->lotes();
	}
	public function CONSECUTIVO()
	{
		$this->servicios_model->CONSECUTIVO($_POST['usuario']);
		//$this->servicios_model->CONSECUTIVO("F09");
	}
}