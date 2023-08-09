<script id="modal_delete_akaun">
    function modal_delete_akaun(a, b, c) {
        jQuery('#pastiAkaun').attr('href','<?php echo $curURL; ?>'+c);
        jQuery('#exampleModalCenterTitleAkaun').html(a);
        jQuery('#badan2Akaun').html(b);
        jQuery('#exampleModalCenterAkaun').modal('show');
    }
</script>
<div class="modal fade" id="exampleModalCenterAkaun" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitleAkaun" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content"><div class="modal-header"><h5 class="modal-title" id="exampleModalCenterTitleAkaun"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>
            <div id="badan2Akaun" class="modal-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                <a id="pastiAkaun" href="#"><button type="button" class="btn btn-primary">Ya</button></a>
            </div>
        </div>
    </div>
</div>