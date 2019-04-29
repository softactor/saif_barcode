<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
            //load library
		$this->load->library('zend');
		//load in folder Zend
		$this->zend->load('Zend/Barcode');
		//generate barcode
                $code   =   "";
                $code.="M/C: ACS Charger";
                $code.="Value: BDT 404 Crore";
                $code.="Invoice Date: 27/08/2018"; 
                $code.="Supplier: Nafiz Power Limited";
		$data['barcode_data'] =   Zend_Barcode::render('code128', 'image', array('text'=>$code), array());
		$this->load->view('barcode', $data);
	}
        public function gen_qrcode(){
            $this->load->library('Ciqrcode');
            $path               =   FCPATH.'qrcodes/'.time().'.png';
            $code   =   "";
            $code.="M/C: ACS Charger"."\n";
            $code.="Value: BDT 404 Crore"."\n";
            $code.="Invoice Date: 27/08/2018"."\n"; 
            $code.="Supplier: Nafiz Power Limited"."\n";
            $params['data']     = $code;
            $params['level']    = 'H';
            $params['size']     = 10;
            $params['savename'] = $path;
            $this->ciqrcode->generate($params);
        }
}
