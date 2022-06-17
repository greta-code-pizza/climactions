let del = document.getElementsByClassName(".delete");

console.log(del);

let favDialog = document.querySelector(".favDialog");

let outputBox = document.querySelector(".output");

let confirmBtn = document.querySelector(".confirmBtn");

let cancelBtn = document.querySelector(".cancelBtn");

// Le lien  ouvre le <dialogue> ;

// Bouton supprimer

// ouvre la boite modale

del.addEventListener("click", function onOpen() {
  if (typeof favDialog.showModal === "function") {
    // let i;
    let dataId = del.dataset.id;
    console.log(dataId); die();
    // for (i = 0; i < dataId.length; i++) {
      favDialog.showModal();
      // ++i;
    // }
  } else {
    // message d'erreur dans la console
    console.error(
      "L'API <dialog> n'est pas prise en charge par ce navigateur."
    );
  }
});

// confirmer la suppression

confirmBtn.addEventListener("click", function () {
  let dataId = del.dataset.id;
  console.log(dataId);
  // récupération de l'action

  fetch(`indexAdmin.php?action=deleteInfo&id=${dataId}`).then(function (
    response
  ) {
    // fermer la boite modale
    favDialog.close();
    // cacher l'élément
    del.parentNode.parentNode.parentNode.style.display = "none";
  });
});

// fermer la boite modale au clic (bouton Annuler)

cancelBtn.addEventListener("click", function () {
  favDialog.close();
});
