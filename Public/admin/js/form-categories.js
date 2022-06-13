// -----------------------------------------------------------------------------
// les catégories dans le formulaire de création d'article
// -----------------------------------------------------------------------------

jQuery(document).ready(function($){  
    $(".format-poster").hide();
    $(".format-sign").hide();
    $(".format-kakemono").hide();
});


$("#select-block").change(function() {

    if($("#select-block").val() == "default"){
        $(".format-sign").hide();
        $(".format-poster").hide();
        $(".format-kakemono").hide();
    }

    else if ( $("#select-block").val() == "4" ){
    
        $(".format-sign").show();
        $(".format-poster").show();
        $(".format-kakemono").show();

    }else{
         
        $(".format-sign").hide();
        $(".format-kakemono").hide();
        $(".format-poster").hide();
    }

});
