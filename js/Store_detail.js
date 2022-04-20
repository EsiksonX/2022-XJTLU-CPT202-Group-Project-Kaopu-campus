function UPDATE(){
    $.ajax({
        type: "POST",
        url: "php/Store_detail.php",
        data: '1',
        success: function (data){
            store_info = jQuery.parseJSON(data);
        }

    })

    document.getElementById('Store_name').innerHTML=store_info[0].name;




}