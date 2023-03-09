const to_do_area = document.querySelector("#to_do_area");
const to_do_list = document.querySelector("#to_do");

const done_area = document.querySelector("#done_area");
const done_list = document.querySelector("#done");

const display_task_board = document.querySelector("#display_task_board");

const task_form = document.querySelector("#list_form");

const boards_list = document.querySelector("#boards_list");
const boards_select = document.querySelector("#boards_select");

const users_button = document.querySelector("#users_button");
users_button.addEventListener("click", show_users_window);

const users_management = document.querySelector("#users_management");

const invited_list = document.querySelector("#invited_list");

const add_invited_button = document.querySelector("#add_invited_button");
add_invited_button.addEventListener("click", add_invited)

const add_invited_form = document.querySelector("#add_invited_form");

const task_cross = document.querySelector("#task_cross");
task_cross.addEventListener("click", close_task_window);

const users_cross = document.querySelector("#users_cross");
users_cross.addEventListener("click", close_users_window);


function display_board() {
    
    fetch("../Controller/select_tasks.php")

        .then((response) => {

            return response.json();

        })

        .then(data => {

            for(let x in data) {

                if(data[x].finie == "NON") {

                    display_to_do_tasks(data[x].date_debut, data[x].title, data[x].id, data[x].id_utilisateur);
                }

                else if(data[x].finie == "OUI") {

                    display_done_tasks(data[x].date_debut, data[x].date_fin, data[x].title, data[x].id, data[x].id_utilisateur)
                }
            }
        })
}



function display_invited_board() {

    to_do_list.innerHTML = "";

    done_list.innerHTML = "";

    const invited_form = new FormData();

    invited_form.append("invited_id", boards_select.value);
    
    fetch("../Controller/select_invited_tasks.php", {

        method: "POST",

        body: invited_form
    })

        .then((response) => {

            return response.json();

        })

        .then(data => {

            for(let x in data) {

                if(data[x].finie == "NON") {

                    display_to_do_tasks(data[x].date_debut, data[x].title, data[x].id, data[x].id_utilisateur);
                }

                else if(data[x].finie == "OUI") {

                    display_done_tasks(data[x].date_debut, data[x].date_fin, data[x].title, data[x].id, data[x].id_utilisateur)
                }
            }
        })
}




function display_to_do_tasks(start_date, title, id_task, id_user) {

    const task_to_do_title = document.createElement("h2");

    task_to_do_title.setAttribute("class", "task_title")

    task_to_do_title.innerHTML = title;

    const task_to_do_date = document.createElement("h3");

    task_to_do_date.setAttribute("class", "task_date")

    task_to_do_date.innerHTML = start_date;


    const end_task = document.createElement("button");

    end_task.setAttribute("class", "task_button");

    end_task.setAttribute("value", id_task);

    end_task.innerHTML = "Terminer";

    end_task.addEventListener("click", () => {
        
        end_event(id_task);
    });



    const modif_task = document.createElement("button");

    modif_task.setAttribute("class", "task_button");

    modif_task.innerHTML = "Modifier";

    modif_task.addEventListener("click", () => {
        
        display_event(id_task); 
    });


    const task_box = document.createElement("div");

    task_box.setAttribute("id", `task${id_task}`)
    
    task_box.setAttribute("class", "task_box");

    task_box.appendChild(task_to_do_title);

    task_box.appendChild(task_to_do_date);

    task_box.appendChild(end_task);

    task_box.appendChild(modif_task);

    to_do_list.append(task_box);

}




function display_done_tasks(start_date, end_date, title, id_task, id_user) {

    console.log(id_task)

    const task_done_title = document.createElement("h2");

    task_done_title.setAttribute("class", "task_title");

    task_done_title.innerHTML = title;

    const task_done_date = document.createElement("h3");

    task_done_date.setAttribute("class", "task_date");

    task_done_date.innerHTML = end_date;

    const task_box = document.createElement("div");

    task_box.setAttribute("id", `task${id_task}`)
    
    task_box.setAttribute("class", "task_box");

    const restore_task = document.createElement("button");

    restore_task.setAttribute("class", "task_button");

    restore_task.setAttribute("value", id_task);

    restore_task.innerHTML = "Restaurer";

    restore_task.addEventListener("click", () => {
        
        restore_event(id_task);
    });

    const delete_task = document.createElement("button");

    delete_task.setAttribute("class", "task_button");

    delete_task.setAttribute("value", id_task);

    delete_task.innerHTML = "Supprimer";

    delete_task.addEventListener("click", () => {
        
        delete_event(id_task);
    });

    task_box.appendChild(task_done_title);

    task_box.appendChild(task_done_date);

    task_box.appendChild(restore_task);

    task_box.appendChild(delete_task);

    done_list.append(task_box);

}




function end_event(task_number) {

    const end_form = new FormData();

    end_form.append("end_task", task_number);

    fetch("../Controller/manage_task.php", {

        method: "POST",

        body: end_form
    })

        .then((response) => {

            return response.json();

        }).then((data) => {

            console.log(data)
            display_done_tasks(data.date_debut, data.date_fin, data.title, data.id, data.id_user);

            const task_to_remove = document.querySelector(`#task${task_number}`);

            to_do_list.removeChild(task_to_remove)

        })

}



function restore_event(task_number) {
    

    const restore_form = new FormData();

    restore_form.append("restore_task", task_number);

    fetch("../Controller/manage_task.php", {

        method: "POST",

        body: restore_form
    })

        .then((response) => {

            return response.json();

        })
        
        .then((data) => {

            if(data.success == true) {
                
                refresh_board();
            }
        })

}




function delete_event(task_number) {

    const delete_form = new FormData();

    delete_form.append("delete_task", task_number);

    fetch("../Controller/manage_task.php", {

        method: "POST",

        body: delete_form
    })

        .then((response) => {

            return response.json();

        }).then((data) => {

            if(data.success == true) {

                const task_to_delete = document.querySelector(`#task${task_number}`);

                done_list.removeChild(task_to_delete)
            }

        })

}




function modify_event(task_number) {

    const modify_form = new FormData();

    const modify_title_input = document.querySelector("#modify_title_input");

    modify_form.append("modify_task", task_number);

    modify_form.append("title_task", modify_title_input.value);

    fetch("../Controller/manage_task.php", {

        method: "POST",

        body: modify_form
    })

        .then((response) => {

            return response.json();

        }).then((data) => {

            if(data.success == true) {

                const task_to_modify = document.querySelector(`#task${task_number}`);

                // done_list.removeChild(task_to_modify)
            }

        })

}




const add_task_button = document.querySelector("#add_task_button");


add_task_button.addEventListener("click", function() {

    const task_content = new FormData(task_form);

    fetch("../Controller/add_task.php", {

        method: "POST",

        body: task_content
    })

        .then((response) => {

            return response.json();

        })

        .then(data => {

            display_to_do_tasks(data.date_debut, data.title, data.id, data.id_utilisateur);

        })

    const list_input = document.querySelector("#list_input");

    list_input.value = "";

 })
 


 function display_event(task_number) {

    const display_title_input = document.querySelector("#modify_title_input");

    const display_start_date = document.querySelector("#display_start_date");

    const modify_title_button = document.querySelector("#modify_title_button");

    const display_form = new FormData();

    display_form.append("task_number", task_number);

    fetch("../Controller/select_single_task.php", {

        method: "POST",

        body: display_form
    })

        .then((response) => {

            return response.json();

        })

        .then(data => {

            modify_title_button.addEventListener("click", ()=> {

                modify_event(data.id)
            })

            display_title_input.setAttribute("value", data.title)

            display_start_date.innerHTML = data.date_debut;

            to_do_area.style.opacity = 0.1;

            done_area.style.opacity = 0.1;

            task_form.style.display = "none";

            users_button.style.display = "none";

            display_task_board.style.display = "flex";

            display_task_board.style.zIndex = 2;    

        })

}



function close_task_window() {

    display_task_board.style.display = "none";

    users_management.style.display = "none";

    task_form.style.display = "flex";
    
    users_button.style.display = "flex";

    to_do_area.style.opacity = 1;

    done_area.style.opacity = 1;

    boards_list.style.opacity = 1;
}



function show_users_window() {

    boards_list.style.opacity = 0.1;

    to_do_area.style.opacity = 0.1;

    done_area.style.opacity = 0.1;

    task_form.style.display = "none";

    users_button.style.display = "none";

    display_task_board.style.display = "none";

    users_management.style.display = "flex";

    users_management.style.zIndex = 2;

    display_invitations();

    display_invited();
}



function close_users_window() {

    display_task_board.style.display = "none";

    users_management.style.display = "none";

    task_form.style.display = "flex";
    
    users_button.style.display = "flex";

    to_do_area.style.opacity = 1;

    done_area.style.opacity = 1;

    boards_list.style.opacity = 1;
}



function load_invitations_list() {

    const load_invitations_form = new FormData();

    load_invitations_form.append("load_list", "load_list");

    fetch("../Controller/invitations.php", {

        method: "POST",

        body: load_invitations_form

    })

        .then((response) => {

            return response.json();

        })

        .then(data => {
            
            for(let i in data) {

                const select_user = document.createElement("option");

                select_user.innerHTML = data[i][0].login;
                select_user.value = data[i][0].id;
                // select_user.style.backgroundColor = "rgba(0, 0, 0, 0)";
                
                boards_select.appendChild(select_user);

            }

            if(data) {

                const change_user_button = document.createElement("button");

                change_user_button.setAttribute("name", "change_user");

                change_user_button.innerHTML = "Changer";

                change_user_button.setAttribute("id", "change_user_button");

                change_user_button.addEventListener("click", () => {
                    
                    display_invited_board()

                });

                boards_list.appendChild(change_user_button);
            }
        })
}



function display_invitations() {

    const invitations_list = document.querySelector("#invitations_list");

    invitations_list.innerHTML= "";

    const display_invitations_form = new FormData();

    display_invitations_form.append("display_list", "display_list");

    fetch("../Controller/invitations.php", {

        method: "POST",

        body: display_invitations_form

    })

        .then((response) => {

            return response.json();

        })

        .then(data => {
            
            for(let y in data) {

                const display_invitations = document.createElement("p");

                display_invitations.innerHTML = data[y][0].login;

                invitations_list.appendChild(display_invitations);
            }
        })
}




function display_invited() {

    const set_display_invited = new FormData();

    set_display_invited.append("launch_invited", "launch_invited");

    invited_list.innerHTML= "";

    fetch("../Controller/invited_users.php", {

        method: "POST",

        body: set_display_invited

    })

        .then((response) => {

            return response.json();

        })

        .then(data => {
            
            for(let y in data) {

                const display_invited = document.createElement("p");

                display_invited.innerHTML = data[y][0].login;

                const invited_cross = document.createElement("i");

                invited_cross.setAttribute("class", "fa-regular fa-circle-xmark");
                invited_cross.addEventListener("click", () => {

                    delete_invited(data[y][0].id)
                });

                const invited_line = document.createElement("div");
                invited_line.setAttribute("class", "invited_line");
                invited_line.setAttribute("id", `invited_line${data[y][0].id}`);


                invited_line.appendChild(display_invited);
                invited_line.appendChild(invited_cross);

                invited_list.appendChild(invited_line);
            }
        })
}




function add_invited(ev) {

    ev.preventDefault();

    const add_invited_content = new FormData(add_invited_form);

    fetch("../Controller/invited_users.php", {

        method: "POST",

        body: add_invited_content
    })

        .then((response) => {

            return response.json();

        })

        .then(data => {
            
            alert(data.message);

        })

            
    display_invited();
      
}




function delete_invited(invited_id) {

    const launch_delete_invited = new FormData();

    launch_delete_invited.append("delete_invited", invited_id);

    fetch("../Controller/invited_users.php", {

        method: "POST",

        body: launch_delete_invited

    })

        .then((response) => {

            return response.json();

        })

        .then(data => {
            
            if(data.success == true) {
                
                alert(data.message);
                
                const invited_to_delete = document.querySelector(`#invited_line${invited_id}`)
                // console.log(invited_to_delete)
                invited_list.removeChild(invited_to_delete);
            
            }
            
        })

}




const suggestions = document.querySelector("#suggestions");
const search_input = document.querySelector("#add_invited_input");
search_input.addEventListener("keyup", auto_search_name);

function auto_search_name () {

    if(suggestions.children.length > 0) suggestions.innerHTML = "";

    fetch('../Controller/auto_search.php?search=' + search_input.value, {

        method : "GET"
    })

        .then(response => response.json())

        .then((data) => {
        
            for(let x in data) {

                let contain_name = document.createElement("p");
                contain_name.setAttribute("class", "auto_search_line")

                contain_name.innerHTML = data[x].login;

                contain_name.addEventListener("click", function() {

                    search_input.value = contain_name.innerHTML;
                })

                suggestions.appendChild(contain_name);
            }
            
        });                  
}



function refresh_board() {

    to_do_list.innerHTML = "";

    done_list.innerHTML = "";

    display_board();

}


display_board();

load_invitations_list();
