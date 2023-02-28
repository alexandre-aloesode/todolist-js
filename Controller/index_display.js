const show_register_form = document.querySelector("#show_register_form");

const show_connexion_form = document.querySelector("#show_connexion_form");

show_connexion_form.addEventListener("click", function() {

    register_form.style.display = "none";

    connexion_form.style.display = "flex";
})

show_register_form.addEventListener("click", function() {

    connexion_form.style.display = "none";

    register_form.style.display = "flex";   
})