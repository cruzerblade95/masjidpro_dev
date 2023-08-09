<?php
if((($jumpa > 0 || $jumpa3 > 0) && $id_masjid == $id_masjid2) || ($no_ic != NULL && $jumpa == 0 && $jumpa3 == 0 && $jumpa2 == 0 && $jumpa4 == 0) || ($no_ic != NULL && $tajuk_button != 'Semak Semula')) {
?>
<script>
    $(document).ready(function () {

        $('#oku').on('change', function() {
            if(this.value == 1) {
                $('#extra_oku').show();
            }
            else if(this.value == 2) {
                $('#extra_oku').hide();
            }
            else {
                $('#extra_oku').hide();
            }
        });
		
    });
</script>
<?php } ?>