<?php echo $header; ?>
<!-- Example row of columns -->
<div class="row">
    <div class="col-md-12">
        <h2>QR code List Page</h2>
        <div class="row">
            <div class="col-md-12">
                <form action="<?php echo base_url('Qrcode_operation/excel_upload_process'); ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <div class="col-sm-4">
                            <select class="form-control" id="sheet_id" name="sheet_id">
                                <option value="">Select Sheet Number</option>
                                <?php
                                if (isset($sheet_data) && !empty($sheet_data)) {
                                    foreach ($sheet_data as $sheetno) {
                                        ?>
                                        <option value="<?php echo $sheetno->sheet_id; ?>"><?php echo $sheetno->sheet_id; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <button type="button" class="btn btn-default" onclick="getSheetwiseQrData()">Get Qrcode</button>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div id="qrcode_data_list_section"></div>
            </div>
        </div>
    </div>
</div>

<!-- Site footer -->

<?php echo $footer; ?>