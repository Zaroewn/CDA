//  Récupération du h4 via son id
let ajouterCategory = document.getElementById('addCategory');

// Création d'une surcouche en arrière plan pour éviter toutes interaction avec la partie arrière.
let glass = document.createElement("div");
    glass.classList.add("glass");
    
    // Ajout Ëcouteur événement au clic sur le h4
    ajouterCategory.addEventListener("click", () => {
        document.body.appendChild(glass);

        // Création de la Pop-up pour ajouter une catégorie.
        let popUp = document.createElement("div");
        popUp.classList.add("popUp");
        document.body.appendChild(popUp);

        let popUpTopDiv = document.createElement("div");
        popUpTopDiv.classList.add("popUpTopDiv");
        popUp.appendChild(popUpTopDiv);

        // Création bouton fermer le Pop-up
        let fermerPopUp = document.createElement("img");
        fermerPopUp.src ="../src/Cercle-croix.svg";
        fermerPopUp.classList.add("img");
        popUpTopDiv.appendChild(fermerPopUp);

            // Ajout d'un écouteur d'événement pour fermer le Pop-up
            fermerPopUp.addEventListener("click", () => {
                popUp.remove();
                glass.remove();

            })

        let form = document.createElement("form");
        form.setAttribute("method", "post");
        form.setAttribute("action", "ajouterCategorie.php");
        form.classList.add("form");
        popUp.appendChild(form);

        let label = document.createElement("label")
        label.innerHTML = "Nom de la nouvelle catégorie :";
        form.appendChild(label);

        let inputCat = document.createElement("input");
        inputCat.type ="text";
        inputCat.setAttribute("name", "nom");
        inputCat.id = "nom"
        form.appendChild(inputCat);

        let submit = document.createElement("input");
        submit.setAttribute("type", "submit");
        form.appendChild(submit);
    });


    