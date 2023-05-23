<style type="text/css">
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }
</style>
<script type="text/javascript">
    function tukarMode(a) {
        if(a == 1) a = "&training="+a;
        else a = "";
        document.location.href = '<?php echo($curURL2); ?>'+a;
    }
</script>