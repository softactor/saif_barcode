    <!-- Site footer -->
    <footer class="footer">
        <p>&copy; <?php echo date('Y') ?> 72, Mohakhali C/A, (8th Floor), Rupayan Center, Dhaka-1212, Bangladesh.</p>
    </footer>

    </div> <!-- /container -->
    <script type="text/javascript" src="<?php echo base_url() ?>public/js/jquery-3.4.0.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url() ?>public/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        function printQrcode(section_id){
            $('#print_id_button').hide();
            var divToPrint=document.getElementById(section_id);
            newWin= window.open("");
            newWin.document.write(divToPrint.outerHTML);
            newWin.print();
            newWin.close();

        }
    </script>
    </body>
  </html>