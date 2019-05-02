<div class="table-responsive">          
    <table class="table">
        <thead>
            <tr>
                <th style="text-align: center;">#</th>
                <th style="text-align: center;">Code</th>
                <th style="text-align: center;">Description</th>
                <th style="text-align: center;">Qr short code</th>
                <th style="text-align: center;">Image</th>
                <th style="text-align: center;">Print</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $slno   =   1;
                if(isset($qrdata) && !empty($qrdata)){
                    foreach($qrdata as $key=>$data){  
            ?>
            <tr>
                <td><?php echo $slno; ?></td>
                <td><?php echo $data['code']; ?></td>
                <td><?php echo $data['description']; ?></td>
                <td><?php echo $data['qrslno']; ?></td>
                <td>
                    <?php
                    $qr_image_url   = $data['qrimage_path'];
                    $productCode    = $data['qrslno'];
                    $product_qr_sec =   'product_qr_sec'.$key;
                    ?>
                    <div id="<?php echo $product_qr_sec; ?>">
                        <style type="text/css">
                            @media screen {
                                html, body {
                                    margin: 0;
                                  }
                                  .code_style{
                                      display: none;
                                  }
                                img{
                                    width: 65px;
                                    height: 65px;
                                    float: left;
                                    margin-left: 5px;;
                                }
                            }
                            @media print {
                                @page {
                                    size: 3.30in 1.0in ;
                                    margin: 0;
                                  }
                                html, body {
                                    margin: 0;
                                  }
                                img{
                                    width: 1.25in;
                                    height: .8in;
                                    float: left;
                                    margin: .15in .15in 0 .15in;
                                }
                                .code_style{
                                    display: inline-block;
                                    text-align: center;
                                    font-size: 10px;
                                    float: left;
                                    writing-mode: vertical-lr; 
                                    transform: rotate(180deg);
                                    margin-top: 35px; 
                                    margin-left: -15px;
                                }
                            }
                        </style>
                        <div class="print_section">
                            <?php
                            if (isset($qr_image_url) && !empty($qr_image_url)) {
                                ?>
                                <img src="<?php echo base_url() . $qr_image_url ?>"/>
                                <div class="code_style"><?php echo $productCode; ?></div>
                                <img src="<?php echo base_url() . $qr_image_url ?>" style="margin-left: .35in;" />
                                <div class="code_style"><?php echo $productCode; ?></div>
                                <br>
                            <?php }
                            ?>
                        </div>
                    </div>
                </td>
                <td><button type="button" class="btn btn-success" onclick="printAutoQrcode( '<?php echo $product_qr_sec; ?>');" id="print_id_button">Print</button></td>
            </tr>
            <?php }} ?>
        </tbody>
    </table>
</div>