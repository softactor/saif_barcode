<!-- The justified navigation menu is meant for single line per list item.
           Multiple lines will require custom code not provided by Bootstrap. -->
<div class="masthead">
    <!-- Example row of columns -->
    <div class="row">
        <div class="col-md-3">
            <img src="<?php echo base_url() ?>public/images/logo.png"  />
        </div>
        <div class="col-md-9"><h3 class="text-muted text-right">Project Qrcode</h3></div>
    </div>
    
    <nav>
        <ul class="nav nav-justified">
            <li><a href="<?php echo base_url() . 'index.php/Qrcode_operation/gen_qrcode' ?>">On-demand</a></li>
            <li><a href="<?php echo base_url() . 'index.php/Qrcode_operation/excel_to_qrcode' ?>">Import Excel Sheet</a></li>
            <li><a href="<?php echo base_url() . 'index.php/Qrcode_operation/qrcode_list' ?>">Qrcode List</a></li>
        </ul>
    </nav>
</div>