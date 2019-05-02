    <!-- Site footer -->
    <footer class="footer">
        <p>&copy; <?php echo date('Y') ?> 72, Mohakhali C/A, (8th Floor), Rupayan Center, Dhaka-1212, Bangladesh.</p>
    </footer>

    </div> <!-- /container -->
    <script type="text/javascript" src="<?php echo base_url() ?>public/js/jquery-3.4.0.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>public/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>public/js/global_url.js"></script>
    <script type="text/javascript">
        function getSheetwiseQrData(){
            var sheet_id    =   $('#sheet_id').val();
            if(sheet_id){
                $.ajax({
                url:base_url_addr+"Qrcode_operation/get_sheetwise_qrData",
                type:'POST',
                dataType:'json',
                data: 'sheet_id='+$('#sheet_id').val(),
                success: function(response) {
                    if(response.status == 'success'){
                        $('#qrcode_data_list_section').html(response.data);
                    }
                }
            });
            }
        }
        function printQrcode(section_id){
            var divToPrint=document.getElementById(section_id);
            newWin= window.open("");
            newWin.document.write(divToPrint.outerHTML);
            newWin.print();
            newWin.close();

        }
    </script>
    </body>
  </html>