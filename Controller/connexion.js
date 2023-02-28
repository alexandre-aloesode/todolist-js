const connexion_form = document.querySelector("#connexion_form");

const connexion_button = document.querySelector("#connexion_button");


connexion_button.addEventListener("click", function(ev) {

    ev.preventDefault();

    const request_connexion = new FormData(connexion_form);

    const connexion_error =  document.querySelector("#connexion_error");
    
    const connexion_login = document.querySelector("#connexion_login")
    const connexion_login_input = connexion_login.value;
    
    const connexion_password = document.querySelector("#connexion_password");
    const connexion_password_input = connexion_password.value;
    

        fetch("../Controller/register_connect.php", {

            method: "POST",

            body: request_connexion
        })

            .then((response) => {

                return response.json();

            })

            .then(data => {

                if(data.success == false) {
                    
                    connexion_error.innerHTML = data.message;

                }

                else if(data.success == true) {
                    
                    window.location = "../View/todolist.php";

                }
            })
    })

// })