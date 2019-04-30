<?php echo $header; ?>
<!-- Example row of columns -->
<div class="row">
	<img src="<?php echo base_url() ?>public/images/logo.png"  />
</div>
<div class="row">
    <div class="col-md-8">
        <h2><?php echo $title; ?></h2>
        <form action="<?php echo base_url('index.php/Qrcode_operation/gen_qrcode'); ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="text">Code:</label>
                <input type="text" name="code" class="form-control" style="width: 62%" />
            </div>
            <div class="form-group">
                <label for="text">Information:</label>
                <textarea cols="50" rows="15" name="qr_text"></textarea>
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
        </form>
    </div>
    <div class="col-md-4">
        <h2>Output</h2>
		<span id="successfull_message_section">
            <?php
            $success_message = $this->session->userdata('success_message');
            if (isset($success_message) && !empty($success_message)) {
                echo $success_message;
            }
            ?>                
        </span>
        <div id="product_qr_sec">
            <style type="text/css">
                @media screen {
                    @page {
                        size: 3.0in 1.0in ;
                        margin: 0;
                      }
                    html, body {
                        margin: 0;
                      }
                    img{
                        width: 1.95in;
                        height: 1.3in;
                        float: left;
                        margin-left: .1in;
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
                        text-align: center;
                        font-size: 7px;
                        float: left;
                        writing-mode: vertical-lr; 
                        transform: rotate(180deg);
                        margin-top: 22px; 
                        margin-left: -15px;
                    }
                }
            </style>
            <div class="print_section">
                <?php
                $qr_image_url = $this->session->userdata('qr_image_url');
                $productCode  = $this->session->userdata('productCode');
                if (isset($qr_image_url) && !empty($qr_image_url)) {
                    ?>
                    <img src="<?php echo base_url() . $qr_image_url ?>"/>
                    <div class="code_style"><?php echo $productCode; ?></div>
                    <img src="<?php echo base_url() . $qr_image_url ?>" style="margin-left: .35in;" />
                    <div class="code_style"><?php echo $productCode; ?></div>
                    <br>
                    <button type="button" class="btn btn-success" onclick="printQrcode('product_qr_sec');" id="print_id_button">Print</button>
                <?php }
                ?>
            </div>
        </div>
    </div>
</div>

<!-- Site footer -->

<?php echo $footer; ?>