function sesion_confirm()
{
    let request = new XMLHttpRequest()
    request.open('POST', '../controllers/sesion-confirm.php', true)
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
    request.onreadystatechange = function () {

        if (request.readyState == 4 && request.status == 200) {

            const page_title = document.title

            if(request.responseText == "true")
            {
                if(page_title == "Iniciar sesión" || page_title == "Registrarse")
                {
                    window.location.href = "chat.html"
                }
            }
            else if(request.responseText == "false")
            {
                if(page_title == "Private-Chat")
                {
                    window.location.href = "login.html"
                }
            }
            else
            {
                console.log(request.responseText)
            }
        }
    }

    request.send(`n=d`)
}

sesion_confirm()