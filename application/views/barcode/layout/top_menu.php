<!-- The justified navigation menu is meant for single line per list item.
           Multiple lines will require custom code not provided by Bootstrap. -->
<div class="masthead">
    <h3 class="text-muted">Project Qrcode</h3>
    <nav>
        <ul class="nav nav-justified">
            <li><a href="<?php echo base_url().'index.php/Qrcode_operation/gen_qrcode' ?>">On-demand</a></li>
            <li><a href="<?php echo base_url().'index.php/Qrcode_operation/excel_to_qrcode' ?>">Import Excel Sheet</a></li>
            <li><a href="<?php echo base_url().'index.php/Qrcode_operation/qrcode_list' ?>">Qrcode List</a></li>
        </ul>
    </nav>
</div>