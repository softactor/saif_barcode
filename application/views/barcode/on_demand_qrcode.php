<?php echo $header; ?>
<!-- Example row of columns -->
<div class="row">
    <div class="col-md-8">
        <h2><?php echo $title; ?></h2>
        <form action="<?php echo base_url('index.php/Qrcode_operation/gen_qrcode'); ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="text">Information:</label>
                <textarea cols="50" rows="15" name="qr_text"></textarea>
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
        </form>
    </div>
    <div class="col-md-4">
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
                @media print {
                    html, body {
                        width: 105mm;
                        height: 287mm;
                      }
                    img{
                        width: 90%;
                        padding: 5px;
                        border: 1px solid black;
                    }
                }
            </style>
            <div class="print_section">
                <?php
                $qr_image_url = $this->session->userdata('qr_image_url');
                if (isset($qr_image_url) && !empty($qr_image_url)) {
                    ?>
                    <img src="<?php echo base_url() . $qr_image_url ?>" width="150"/>
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