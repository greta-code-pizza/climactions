let selectBlock = document.getElementById('select-block');

let formCreate = document.getElementById('form-create-article');

selectBlock.onchange = function(){

    if(this.value == 1){
        formCreate.action = 'indexAdmin.php?action=create-game';
    }
    else if(this.value == 4){
        formCreate.action = 'indexAdmin.php?action=create-expo';
    }
    else{
        formCreate.action = 'indexAdmin.php?action=create';
    }
}







