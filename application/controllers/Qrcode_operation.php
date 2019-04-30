<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Qrcode_operation extends CI_Controller {

    /**
     * Index Page for this controller.
     */
    public function excel_to_qrcode(){
        $data['title']      =   "Excel to Qrcode";
        $data['header']     = $this->load->view('barcode/layout/header', $data, true);
        $data['top_menu']   = $this->load->view('barcode/layout/top_menu', $data, true);
        $data['footer']     = $this->load->view('barcode/layout/footer', '', true);
        $this->load->view('barcode/excel_to_qr', $data);
    }
    public function excel_upload_process(){
        $this->load->library('PHPExcel');
        $path = FCPATH.'excel_files/'; 
        $config['upload_path'] = $path;
        $config['allowed_types'] = 'xlsx|xls|jpg|png';
        $config['remove_spaces'] = TRUE;
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('product_file')) {
            $error = array('error' => $this->upload->display_errors());
        } else {
            $data = array('upload_data' => $this->upload->data());
        }

        if (!empty($data['upload_data']['file_name'])) {
            $import_xls_file = $data['upload_data']['file_name'];
        } else {
            $import_xls_file = 0;
        }
        $inputFileName = $path . $import_xls_file;
        
        try {
            $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($inputFileName);
        } catch (Exception $e) {
            die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
                    . '": ' . $e->getMessage());
        }
        $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
        unset($allDataInSheet[1]);
        foreach($allDataInSheet as $key=>$sheetRow){
            if(!isset($sheetRow['A'])){
                unset($allDataInSheet[$key]);
            }
            
        }// end of foreach
        print '<pre>';
        print_r($allDataInSheet);
        print '</pre>';
        exit;
        
        
    }
    public function ondemand_gen_qrcode(){
        $data['title']      =   "Qrcode";
        $data['header']     = $this->load->view('barcode/layout/header', $data, true);
        $data['top_menu']   = $this->load->view('barcode/layout/top_menu', $data, true);
        $data['footer']     = $this->load->view('barcode/layout/footer', '', true);
        $this->load->view('barcode/on_demand_qrcode', $data);
    }
    public function gen_qrcode(){
        $qr_text    =   $this->input->post('qr_text');
        $this->load->library('Ciqrcode');
        $path   =   'qrcodes/'.time().'.png';
        $params['data']     = $qr_text;
        $params['level']    = 'H';
        $params['size']     = 10;
        $params['savename'] = FCPATH.$path;
        $this->ciqrcode->generate($params);
        $this->session->set_flashdata('success_message','QRcode code has been successfully created.');
        $this->session->set_flashdata('qr_image_url',$path);
        $redirect_url = base_url() . "index.php/Qrcode_operation/ondemand_gen_qrcode";
        redirect($redirect_url);
    }
    public function csvToArray($filename = '', $delimiter = ',') {
        if (!file_exists($filename) || !is_readable($filename))
            return false;

        $header = null;
        $data = array();
        $count  =   1;
        if (($handle = fopen($filename, 'r')) !== false) {
            while ($row = fgetcsv($handle)) {
                if($count==1){
                    $count++;
                    continue;
                }
                $data[]     =     $row;
                
            }
            fclose($handle);
        }

        return $data;
    } // end of method  
}
