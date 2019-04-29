<?php echo $header; ?>
<!-- Example row of columns -->
<div class="row">
    <div class="col-lg-4">
        <h2><?php echo $title; ?></h2>
        <form action="<?php echo base_url('Qrcode_operation/excel_upload_process'); ?>" method="post" enctype="multipart/form-data">
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