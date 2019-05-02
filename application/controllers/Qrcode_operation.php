<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Qrcode_operation extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('common_model');
    }

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
    public function qrcode_list(){
        $data['sheet_data'] = $this->common_model->sheetno_from_qrhistory();
        $data['title']      =   "Excel Qrcode List";
        $data['header']     = $this->load->view('barcode/layout/header', $data, true);
        $data['top_menu']   = $this->load->view('barcode/layout/top_menu', $data, true);
        $data['footer']     = $this->load->view('barcode/layout/footer', '', true);
        $this->load->view('barcode/qrcode_list_page', $data);
    }
    public function get_sheetwise_qrData(){
        $sheet_id       =   $this->input->post('sheet_id');
        $param['table'] =   'qrcode_history';
        $param['where'] =   [
            'sheet_id'=>$sheet_id
        ];
        $data['qrdata']     =   $this->common_model->get_all_data($param);
        $qrcodeTableData    =   $this->load->view('barcode/qrcode_table_data', $data, true);
        $feedbackData   =   [
            'status'    => 'success',
            'message'   => 'Data found',
            'sheetno'   => $sheet_id,
            'data'      => $qrcodeTableData,
        ];
        echo json_encode($feedbackData);
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
            if(trim($sheetRow['A']) == 'CODE'){
                unset($allDataInSheet[$key]);
            }
            
            
        }// end of foreach
        
        foreach($allDataInSheet as $qrcode){
            // generate qrcode and get the path:
            $lrparam['table']   =   'qrcode_history';
            $qrcodeslno             = substr(trim($qrcode['A']), -3);
            $param  =   [
                'code'      =>   $qrcodeslno,
                'text'      =>   trim($qrcode['B']),
                'last_row'  =>   $this->common_model->get_last_row_id($lrparam)
            ];
            $qrcode_path    =   $this->gen_qrcode_nget_path($param);
            $qr_data = [
                'sheet_id'      => 'S-001',
                'code'          => $qrcode['A'],
                'description'   => $qrcode['B'],
                'qrimage_path'  => $qrcode_path,
                'qrslno'        => $qrcodeslno,
                'print_status'  => 0
            ];
            $insert_data['fields']  = $qr_data;
            $insert_data['table']   = 'qrcode_history';
            $insert_result          = $this->common_model->common_table_data_insert($insert_data);            
        } // end of for each
        $redirect_url = base_url() . "Qrcode_operation/excel_to_qrcode";
        redirect($redirect_url);
    }
    public function gen_qrcode_nget_path($param){
        $qr_text        =   $param['text'];
        $productCode    =   $param['code'];
        $this->load->library('Ciqrcode');
        $path   =   'qrcodes/'.time().'_'.$param['last_row'].'.png';
        $params['data']     = $qr_text;
        $params['level']    = 'H';
        $params['size']     = 10;
        $params['savename'] = FCPATH.$path;
        $this->ciqrcode->generate($params);
        return $path;
    }
    public function ondemand_gen_qrcode(){
        $data['title']      =   "Qrcode";
        $data['header']     = $this->load->view('barcode/layout/header', $data, true);
        $data['top_menu']   = $this->load->view('barcode/layout/top_menu', $data, true);
        $data['footer']     = $this->load->view('barcode/layout/footer', '', true);
        $this->load->view('barcode/on_demand_qrcode', $data);
    }
    public function gen_qrcode(){
        $qr_text        =   $this->input->post('qr_text');
        $productCode    =   $this->input->post('code');
        $this->load->library('Ciqrcode');
        $path   =   'qrcodes/'.time().'.png';
        $params['data']     = $qr_text;
        $params['level']    = 'H';
        $params['size']     = 10;
        $params['savename'] = FCPATH.$path;
        $this->ciqrcode->generate($params);
        $this->session->set_flashdata('success_message','QRcode code has been successfully created.');
        $this->session->set_flashdata('qr_image_url',$path);
        $this->session->set_flashdata('productCode',$productCode);
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
