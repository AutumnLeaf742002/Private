import Register from '../modules/register.js'
import Login from '../modules/login.js'
import Chat from '../modules/chat.js'
import Contacts from '../modules/contacts.js'
import Perfil from '../modules/perfil.js'
import component_loading_action from '../components/loading-action.js'

// Botones para los eventos
const btn_sigin = document.getElementById('btn-sigin')
const alert = document.getElementById('alert')
const btn_login = document.getElementById('btn-login')
const cerrar_sesion_dom = document.getElementById('cerrar_sesion')
const btn_send = document.getElementById('btn-send')
const input_send = document.getElementById('input-send')

// Clases para los modulos
let register = new Register()
let login = new Login()
let chat = new Chat()
let contacts = new Contacts()
let perfil = new Perfil()

// create user
function create_user()
{
    const user = document.getElementById('user').value
    const password = document.getElementById('password').value
    const terms = document.getElementById('terms')

    if(terms.checked)
    {
        if(user.length > 7 && password.length > 7 && gender.length > 0 && gender.length < 3)
        {
            if(user.length < 17 && password.length < 17)
            {
                component_loading_action.component_loading_action()

                register.create_user(user, password, gender, function(res) {

                    component_loading_action.delete_component_action()
                    
                    if(res == "Correct")
                    {
                        alert_success("Usuario creado correctamente. Redireccionando...")

                        login.login_user(user, password, function(res){

                            if(res == 1)
                            {
                                setTimeout(function(){

                                    window.location.href = "chat.html"
                                }, 3000)
                            }
                            else
                            {
                                console.log(res)
                            }
                        })

                    }
                    else if(res.includes("for key 'User'"))
                    {
                        alert_error("Este nombre de usuario ya esta en uso. Intenta con otro")
                    }
                    else
                    {
                        alert_error(res)
                    }
                })
            }
            else
            {
                alert_error("Nombre de usuario o clave demasiado largos")
            }
        }
        else
        {
            alert_error("Los campos deben tener entre 8 y 16 carácteres. También debes seleccionar un género")
        }
    }
    else
    {
        alert_error("Debes aceptar los términos para completar el registro")
    }
}
try
{
    btn_sigin.addEventListener("click", function(){

        create_user()
    })

    if(document.title == "Registrarse")
    {
        window.addEventListener('keydown', function(event){

            if(event.keyCode === 13)
            {
                create_user()
            }
        })
    }
}
catch(error)
{
    console.log(error)
}

// Login user
function login_user()
{

    const user = document.getElementById('user').value
    const password = document.getElementById('password').value

    if(user.length > 7 && password.length > 7 && user.length < 17 && password.length < 17)
    {
        component_loading_action.component_loading_action()

        login.login_user(user, password, function(res){

            component_loading_action.delete_component_action()

            if(res == 1)
            {
                window.location.href = "chat.html"
            }
            else if(res == 0)
            {
                alert_error("Usuario o clave incorrectos")
            }
            else
            {
                console.log(res)
            }
        })
    }
    else
    {
        alert_error("Los campos deben tener entre 8 y 16 carácteres")
    }
}
try
{
    btn_login.addEventListener("click", function(){

        login_user()
    })

    if(document.title == "Iniciar sesión")
    {
        window.addEventListener('keydown', function(event){

            if(event.keyCode === 13)
            {
                login_user()
            }
        })
    }
}
catch(error)
{
    console.log(error)
}

// cerrar sesion
function cerrar_sesion()
{
    component_loading_action.component_loading_action()
    chat.cerrar_sesion(function(res){

        if(res == 1)
        {
            window.location.href = "login.html";
        }
        else
        {
            console.log(res)
        }
    })
}
try
{
    cerrar_sesion_dom.addEventListener('click', cerrar_sesion)
}
catch(error)
{
    console.log(error)
}

// get contacts
function get_contacts()
{
    let contacts_dom = document.getElementById('contacts')

    contacts.get_contacts(function(res){

        contacts_dom.innerHTML = res

        set_chat()
    })

}
if(document.title == "Private-Chat")
{
    get_contacts()
}

// set profile
function set_profile()
{
    let c_self = document.getElementById('c-self')

    contacts.set_profile(function(res){

        c_self.innerHTML = res
    })
}
if(document.title == "Private-Chat")
{
    set_profile()
}

// set chat
function set_chat()
{
    const list_contacts = document.querySelectorAll('.contact')
        list_contacts.forEach((item) => {

            item.addEventListener("click", function(event){

                try
                {
                    let current = event.currentTarget
                    let current_child = current.querySelector('.pending')
                    current.removeChild(current_child)
                }
                catch(error)
                {
                    console.log(error)
                }

                const id = event.currentTarget.dataset.value

                list_contacts.forEach(item => {

                    item.classList.remove('actual-contact')
                })

                event.currentTarget.classList.add('actual-contact')

                chat.set_chat(id, function(res){

                    const header_chat = document.getElementById('header-chat')
                    header_chat.innerHTML = res

                    get_messeges()
                })
            })
        })
}

// get messeges
function get_messeges()
{
    const c_messeges = document.getElementById("c-messeges")
    chat.get_messeges(function(res){

        c_messeges.innerHTML = res
        scroll_messege()
    })
}

// add messege
function add_messege()
{
    const messege = input_send.value

    if(messege.length > 0 && messege.length <= 300)
    {
        chat.add_messege(messege, function(res){

            if(res == "Correct")
            {
                get_messeges()
                input_send.value = ""
                scroll_messege()
            }
        })
    }
}
if(document.title == "Private-Chat")
{
    btn_send.addEventListener('click', add_messege)
    input_send.addEventListener('keydown', function(event){

        if(event.keyCode === 13)
        {
            add_messege()
        }
    })
}

// buscar contactos para agregar
function get_add_contacts_by_input(input)
{
    input.addEventListener('keyup', function(){

        const value = input.value

        if(value == "")
        {
            get_all_contacts()
        }
        else
        {
            chat.get_contacts_by_input(value, function(res){

                results.innerHTML = res
                set_event_btn_add_contact()
            })
        }
    })
}
if(document.title == "Private-Chat")
{
    const input_search_contact = document.getElementById('input-search-contact')
    get_add_contacts_by_input(input_search_contact)
    get_all_contacts()
}

function get_all_contacts()
{

    const value = "empty"

    chat.get_contacts_by_input(value, function (res) {

        results.innerHTML = res
        set_event_btn_add_contact()
    })
}

// agregar eventos a los botones de accion de agregar contacto
function set_event_btn_add_contact()
{
    try
    {
        const array_result = document.querySelectorAll('.c-btn-result')
        array_result.forEach(function(item){

            item.addEventListener('click', function(){

                const split = item.dataset.value.split("-")
                const id = split[0]
                const id_contact = split[1]
                const estatus = split[2]

                if(estatus == "noamigos")
                {
                    chat.add_relationship(id, id_contact)
                    const input_search_contact = document.getElementById('input-search-contact')
                    let value = input_search_contact.value

                    if(value == "")
                    {
                        value = "empty"
                    }

                    chat.get_contacts_by_input(value, function(res){

                        results.innerHTML = res
                        set_event_btn_add_contact()
                    })
                }
                else if(estatus == "amigos")
                {
                    console.log(estatus)
                    chat.delete_relationship(id, id_contact)

                    const input_search_contact = document.getElementById('input-search-contact')
                    let value = input_search_contact.value

                    if(value == "")
                    {
                        value = "empty"
                    }

                    chat.get_contacts_by_input(value, function(res){

                        results.innerHTML = res
                        set_event_btn_add_contact()
                    })
                }
            })
        })

    }catch(error)
    {
        console.log(error)
    }
}

// private-perfil
function set_values()
{
    let user_dom = document.getElementById('input_user')
    let password_dom = document.getElementById('input_password')
    let select_gender_dom = document.getElementById('select_gender')
    let data

    perfil.get_data_user(function(res){

        data = res.split("/")
        user_dom.value = data[0]
    })

    const btn_guardar = document.getElementById('btn-guardar')
    btn_guardar.addEventListener('click', function(){

        const user = user_dom.value
        let password = password_dom.value
        let gender = select_gender_dom.value

        if(gender == 0)
        {
            gender = data[1]
        }

        if(password.length == 0)
        {
            password = "not_password"
        }

        if(user.length > 7 && password.length > 7 && user.length < 17 && password.length < 17)
        {
            perfil.update_user(user, password, gender, function(res){

                if(res == "Correct")
                {
                    window.alert("Cambios realizados con exito")
                    window.location.href = 'private-perfil.html'
                }
            })
        }
        else
        {
            window.alert("Los campos de texto deben estar entre 8 y 16 caracteres")
        }
    })
}
if(document.title == 'Private-perfil')
{
    set_values()
}

// others

const gender_dom = document.querySelectorAll('.checkbox_gender')
var gender = 0

function scroll_messege()
{
    const c_messeges = document.getElementById("c-messeges")
    const newMessageHeight = c_messeges.scrollHeight;
    c_messeges.scrollTo(0, newMessageHeight);
}

gender_dom.forEach(element => {
    
    element.addEventListener("click", function(){

        gender = element.value
    })
});

function alert_success(messege)
{
    alert.textContent = messege
    alert.classList.remove("alert-error")
    alert.classList.add("alert-success")
}

function alert_error(messege)
{
    alert.textContent = messege
    alert.classList.remove("alert-success")
    alert.classList.add("alert-error")
}

// actualizacion del chat para recibir mensaje nuevo sin recargar
setInterval(function(){

    const c_messeges = document.getElementById("c-messeges")
    chat.get_messeges(function(res){

        c_messeges.innerHTML = res
    })
}, 1000)

setInterval(function(){

    get_contacts()
}, 1000)