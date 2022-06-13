// -----------------------------------------------------------------------------
// les catégories dans le formulaire de création d'article
// -----------------------------------------------------------------------------

jQuery(document).ready(function($){
    $(".name-author").hide();   
    $(".format-poster").hide();
    $(".format-sign").hide();
    $(".name-public").hide();
});


$("#select-block").change(function() {

    if($("#select-block").val() == "default"){
        $(".name-public").hide();
        $(".name-author").hide();
        $(".format-sign").hide();
        $(".format-poster").hide();
    }

    else if ( $("#select-block").val() == "4" ){
        
        $(".name-public").hide();
        $(".name-author").hide();
        $(".format-sign").show();
        $(".format-poster").show();

    }else{
         
        $(".format-flyer").hide();
        $(".format-sign").hide();
        $(".format-poster").hide();
        $(".name-author").show();
        $(".name-public").show();
    }

});
