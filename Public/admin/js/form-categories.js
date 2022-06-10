// -----------------------------------------------------------------------------
// les catégories dans le formulaire de création d'article
// -----------------------------------------------------------------------------

jQuery(document).ready(function($){
    $(".format-game").hide();
    $(".name-author").hide();   
    $(".format-poster").hide();
    $(".format-sign").hide();
    $(".name-public").hide();
});


$("#select-block").change(function() {

    if ( $("#select-block").val() == "1" ){
        
        $(".format-sign").hide();
        $(".format-poster").hide();

        $(".format-game").show();
        $(".name-public").show();    
        $(".name-author").show();    
    }
    
    if ( $("#select-block").val() == "3" ){ 
        
        $(".format-sign").hide();
        $(".format-poster").hide();
        $(".format-game").hide();
        
        $(".name-author").show();
        $(".name-public").show();
    }
   
    if ( $("#select-block").val() == "2" ){
        
        
        $(".format-flyer").hide();
        $(".format-game").hide();
        $(".format-sign").hide();
        $(".format-poster").hide();

        $(".name-author").show();
        $(".name-public").show();

    }

    if ( $("#select-block").val() == "4" ){
        
        $(".format-game").hide();
        $(".name-public").hide();
        $(".name-author").hide();

        $(".format-sign").show();
        $(".format-poster").show();

    }

});
