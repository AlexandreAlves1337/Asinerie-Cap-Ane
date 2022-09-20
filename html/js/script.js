// affiche l'image selectionné dans le formulaire avant validation

window.onload = function() {

    let fileInput = document.getElementById('fileInput');
    let fileDisplayArea = document.getElementById('fileDisplayArea');
    let fileInputt = document.getElementById('fileInputt');
    let fileDisplayAreat = document.getElementById('fileDisplayAreat');

    if(fileInput) {
    fileInput.addEventListener('change', function(e) {
        let file = fileInput.files[0];
        let imageType = /image.*/;

        if (file.type.match(imageType)) {
            let reader = new FileReader();

            reader.onload = function(e) {
                fileDisplayArea.innerHTML = "";

                let img = new Image();
                img.src = reader.result;

                fileDisplayArea.appendChild(img);
            }

            reader.readAsDataURL(file);	
        } else {
            fileDisplayArea.innerHTML = "Veuillez choisir une image"
        }
    })};
    if(fileInputt) {
      fileInputt.addEventListener('change', function(e) {
          let file = fileInputt.files[0];
          let imageType = /image.*/;
    
          if (file.type.match(imageType)) {
              let reader = new FileReader();
    
              reader.onload = function(e) {
                  fileDisplayAreat.innerHTML = "";
    
                  let img = new Image();
                  img.src = reader.result;
    
                  fileDisplayAreat.appendChild(img);
              }
    
              reader.readAsDataURL(file);	
          } else {
              fileDisplayAreat.innerHTML = "Veuillez choisir une image"
          }
      })};

}

// menu responsive

let navbar = document.querySelector(".navlist");
let menu = document.querySelector(".hamburger");

menu.onclick = function () {
  navbar.classList.toggle("show");
  menu.classList.toggle("fa-times");
};

//Add class name to the nav menu item, depending on the active page
$(function(){
	//Cycles through each of the links in the nav
	$('.navlist a').each(function() {
		//Compares the href of the nav a element to the URL page
        if ($(this).attr('href') == window.location.pathname) {
        	//If they match, add class name to the parent li element
            $(this).addClass('is-selected');
            $(this).addClass('disabled');
        } else {
          $(this).removeClass('is-selected');
        }
    });
});


// fonctions qui anime la carousel d'image

$(document).ready(function(){
  $(".pic").first().addClass("visible");
});


function picShiffter(){
    let done = false;
    const pictures = document.querySelectorAll('.pic');
    
    pictures.forEach((pic, index, array)=>{
    if(done) return;
      if(pic.classList.contains('visible')){
        pic.classList.remove('visible');
        array[(index+1) % array.length].classList.add('visible');
        done=true;
      };    
    });
  }
  
  setInterval(picShiffter, 5000);

  // fonction qui modifie le DOM de la page du formulaire d'insertion de photo selon la page choisi

  $(document).ready(function(){
    $("select#id_cat").change(function(){
      let selecteur = $(this).children("option:selected").val();
      if (selecteur == 1) {
        $(".photopage").hide();
      } else {
        $(".photopage").show();
      }
      if (selecteur == 5) {
        $("#labeldp").html("Ecrire ici le nom du chantier :");
        $(".photot").show();
        $(".photopage").hide();
        $("#ajoutPhoto").html("Ajouter ces photos");
        $("#label1").html("Sélectionnez la photo avant :");
      } else {
        $("#labeldp").html("Donnez ici la description de l'âne :");
        $(".photot").hide();
        $("#ajoutPhoto").html("Ajouter cette photo");
        $("#label1").html("Sélectionnez la photo que vous souhaitez ajouter :");
      }
      if (selecteur == 4 || selecteur == 5) {
        $(".descriptionPage").show();
      } else {
        $(".descriptionPage").hide();
      }
    });
  });

    // fonction ajax ajout d'un produit au panier depuis la page boutique

  $(document).ready(function(){
    $(".subbout").click(function(e){
      e.preventDefault(); // retire l'action du clic
      let obj = $(this);
      $.ajax({
        type: 'get',
        url: 'AjoutPanier',
        data: 'idb=' + obj.attr('rel'),
        success: function () {
          $("#numpan").load("Boutique #numpan");
          $("#panbou").load("Boutique #panbou");
          // $('#res').html("Produit bien ajouté au panier");
        }
      }); 
    return false;
    });
  });

    // fonction ajax ajout d'un produit au panier depuis la page panier

    $(document).ready(function(){
      $(".pluspan").click(function(e){
        e.preventDefault(); // retire l'action du clic
        let obj = $(this);
        $.ajax({
          type: 'get',
          url: 'AjoutPanier',
          data: 'idp=' + obj.attr('rel'),
          success: function () {
            location.reload(); 
          }
        }); 
      return false;
      });
    });

    // fonction ajax modification de la quantité en négatif depuis la page panier

    $(document).ready(function(){
      $(".moinspan").click(function(e){
        e.preventDefault(); // retire l'action du clic
        let obj = $(this);
        $.ajax({
          type: 'get',
          url: 'EnleverPanier',
          data: 'id=' + obj.attr('rel'),
          success: function () {
            location.reload(); 
          }
        }); 
      return false;
      });
    });
    
    // fonction ajax suppression d'un produit dans le panier depuis la page panier

    $(document).ready(function(){
      $(".delbout").click(function(e){
        e.preventDefault(); // retire l'action du clic
        let obj = $(this);
        $.ajax({
          type: 'get',
          url: 'DeletePanier',
          data: 'del=' + obj.attr('rel'),
          success: function () {
            location.reload(); 
          }
        }); 
      return false;
      });
    });

    // fonction modification du texte du lien de suppression de produit sur la page panier selon la taille de l'écran

    $( window ).resize( function() {
      if ( window.matchMedia( '(max-width:600px)' ).matches ) {
        $(".sup_produit").html("<i title=\"Supprimer ce produit du panier\" class=\"fa-solid fa-rectangle-xmark\"></i>");
      } else {
        $(".sup_produit").html("Supprimer ce produit du panier");
      }
    });
    $( window ).resize();

    
    // fonctions qui montre ou masque le mot de passe saisi

    $(".toggle-password").click(function() {

      $(this).toggleClass("fa-eye fa-eye-slash");
      var input = $($(this).attr("toggle"));
      if (input.attr("type") == "password") {
        input.attr("type", "text");
      } else {
        input.attr("type", "password");
      }
    });

    $(".toggle-repassword").click(function() {

      $(this).toggleClass("fa-eye fa-eye-slash");
      var input = $($(this).attr("toggle"));
      if (input.attr("type") == "password") {
        input.attr("type", "text");
      } else {
        input.attr("type", "password");
      }
    });
  
        