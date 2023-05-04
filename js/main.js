/**
 * @file Script contenant les fonctions de base
 * @author Jonathan Martel (jmartel@cmaisonneuve.qc.ca)
 * @version 0.1
 * @update 2019-01-21
 * @license Creative Commons BY-NC 3.0 (Licence Creative Commons Attribution - Pas d’utilisation commerciale 3.0 non transposé)
 * @license http://creativecommons.org/licenses/by-nc/3.0/deed.fr
 *
 */

//const BaseURL = "https://jmartel.webdev.cmaisonneuve.qc.ca/n61/vino/";
const BaseURL = document.baseURI;
console.log(BaseURL);
window.addEventListener('DOMContentLoaded', function(){

  let btnModifierNouvelleBouteille = document.querySelector("[name='modifierBouteilleCellier']");
  console.log(btnModifierNouvelleBouteille)
  if(btnModifierNouvelleBouteille){
    btnModifierNouvelleBouteille.addEventListener("click", function(evt){
      let form = document.querySelector('form');
      var param = {
        "id_cellier":form.id_cellier.value,
        "id_bouteille":form.id_bouteille.value,
        "date_achat":form.date_achat.value,
        "garde_jusqua":form.garde_jusqua.value,
        "notes":form.notes.value,
        "prix":form.prix.value,
        "quantite":form.quantite.value,
        "millesime":form.millesime.value,
      };
      let requete = new Request(BaseURL+"index.php?requete=modifierBouteilleCellier", {method: 'POST', body: JSON.stringify(param)});
        fetch(requete)
            .then(response => {
                if (response.status === 200) {
                  return response;
                } else {
                  throw new Error('Erreur');
                }
              })
              .then(response => {

              }).catch(error => {
                console.error(error);
              });

    });

  }


    document.querySelectorAll("[data-js-qte]").forEach(function(element){
        element.addEventListener("click", function(evt){
          let id = evt.target.parentElement.dataset.id;
          console.log(id)
          let qte = parseInt(evt.target.dataset.jsQte)

            let requete = new Request(BaseURL+`index.php?requete=modifierQuantiteBouteilleCellier&id=${id}&nombre=${qte}`);

            fetch(requete)
            .then(response => {
                if (response.status === 200) {
                  console.log(response)
                  return response;
                } else {
                  throw new Error('Erreur');
                }
              })
              .then(response => {
                let eQuantite = evt.target.parentElement.parentElement.querySelector('.quantite');
                let quantite = parseInt(eQuantite.innerHTML.split(':')[1].trim());
                eQuantite.innerHTML = `Quantité : ${quantite+parseInt(qte)}`;
              }).catch(error => {
                console.error(error);
              });
        })
    });

    let inputNomBouteille = document.querySelector("[name='nom_bouteille']");
    console.log(inputNomBouteille);
    let liste = document.querySelector('.listeAutoComplete');

    if(inputNomBouteille){
      inputNomBouteille.addEventListener("keyup", function(evt){
        console.log(evt);
        let nom = inputNomBouteille.value;
        liste.innerHTML = "";
        if(nom){
          let requete = new Request(BaseURL+"index.php?requete=autocompleteBouteille", {method: 'POST', body: '{"nom": "'+nom+'"}'});
          fetch(requete)
              .then(response => {
                  if (response.status === 200) {
                    return response.json();
                  } else {
                    throw new Error('Erreur');
                  }
                })
                .then(response => {
                  console.log(response);


                  response.forEach(function(element){
                    liste.innerHTML += "<li data-id='"+element.id +"'>"+element.nom+"</li>";
                  })
                }).catch(error => {
                  console.error(error);
                });
        }


      });

      let bouteille = {
        nom : document.querySelector(".nom_bouteille"),
        millesime : document.querySelector("[name='millesime']"),
        quantite : document.querySelector("[name='quantite']"),
        date_achat : document.querySelector("[name='date_achat']"),
        prix : document.querySelector("[name='prix']"),
        garde_jusqua : document.querySelector("[name='garde_jusqua']"),
        notes : document.querySelector("[name='notes']"),
      };


      liste.addEventListener("click", function(evt){
        console.dir(evt.target)
        if(evt.target.tagName == "LI"){
          bouteille.nom.dataset.id = evt.target.dataset.id;
          bouteille.nom.innerHTML = evt.target.innerHTML;

          liste.innerHTML = "";
          inputNomBouteille.value = "";

        }
      });

      let btnAjouterNouvelleBouteille = document.querySelector("[name='ajouterBouteilleCellier']");
      console.log(btnAjouterNouvelleBouteille)
      if(btnAjouterNouvelleBouteille){
        btnAjouterNouvelleBouteille.addEventListener("click", function(evt){
          var param = {
            "id_bouteille":bouteille.nom.dataset.id,
            "date_achat":bouteille.date_achat.value,
            "garde_jusqua":bouteille.garde_jusqua.value,
            "notes":bouteille.date_achat.value,
            "prix":bouteille.prix.value,
            "quantite":bouteille.quantite.value,
            "millesime":bouteille.millesime.value,
          };
          let requete = new Request(BaseURL+"index.php?requete=ajouterNouvelleBouteilleCellier", {method: 'POST', body: JSON.stringify(param)});
            fetch(requete)
                .then(response => {
                    if (response.status === 200) {
                      return response.json();
                    } else {
                      throw new Error('Erreur');
                    }
                  })
                  .then(response => {

                  }).catch(error => {
                    console.error(error);
                  });

        });
      }




  }

})


