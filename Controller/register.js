const register_form = document.querySelector("#register_form");

const register_button = document.querySelector("#register_button");


register_button.addEventListener("click", function(ev) {

    ev.preventDefault();

    const request_register = new FormData(register_form);

    const login_error =  document.querySelector("#login_error");

    const password_error =  document.querySelector("#password_error");
    
    const register_login = document.querySelector("#register_login")
    const register_login_input = register_login.value;
    
    const register_password = document.querySelector("#register_password");
    const register_password_input = register_password.value;
    
    const register_confirm_password = document.querySelector("#register_confirm_password");
    const register_confirm_password_input = register_confirm_password.value;
    
    let register_check = 1;
    
    
    if(!register_login_input.trim()){

        register_check = 0;

        login_error.innerHTML = "Votre pseudo est vide";

    }
    


    if(register_check == 1 && !register_password_input.trim()){

        register_check = 0;

        password_error.innerHTML = "Votre mot de passe est vide";

    }



    // if(register_check == 1 && register_login_input.length < 5) {

    //     register_check = 0;

    //     login_error.innerHTML = "Votre pseudo doit contenir au moins 5 caractères"
        
    // }



    // if(register_check == 1 && register_password_input.length < 8) {

    //     register_check = 0;

    //     password_error.innerHTML = "Votre mot de passe doit contenir au moins 8 caractères"
        
    // }


    if(register_check == 1 && register_password_input !== register_confirm_password_input) {

        register_check = 0;

        password_error.innerHTML = "Les mots de passe ne correspondent pas"
    }


    if(register_check == 1) {

        fetch("../Controller/register_connect.php", {

            method: "POST",

            body: request_register
        })

            .then((response) => {

                return response.json();

            })

            .then(data => {

                if(data.success == false) {

                    register_check = 0;
                    
                    login_error.innerHTML = data.message;

                }

                else if(data.success == true) {

                    alert(data.message);
                }
            })
    }

})
