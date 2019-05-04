<?php echo $header; ?>
<!-- Example row of columns -->
<div class="row">
    <div class="col-lg-4">
        <h3><?php echo $title; ?></h3>
        <form action="<?php echo base_url('index.php/Qrcode_operation/excel_upload_process'); ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="pwd">Sheet No:</label>
                <input type="text" class="form-control" id="sheet_id_show" name="sheet_id_show" value="<?php echo $sheetno; ?>" readonly>
                <input type="hidden" class="form-control" id="sheet_id" name="sheet_id" value="<?php echo $sheetno; ?>">
            </div>
            <div class="form-group">
                <label for="pwd">Excel File:</label>
                <input type="file" class="form-control" id="product_file" name="product_file">
            </div>
            <button type="submit" class="btn btn-default">Submit</button>
        </form>
    </div>
</div>

<!-- Site footer -->

<?php echo $footer; ?>