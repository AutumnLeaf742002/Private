class Chat
{
    cerrar_sesion(callback)
    {
        let request = new XMLHttpRequest()
        request.open('POST', '../controllers/app.php', true)
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
        request.onreadystatechange = function () {

            if (request.readyState == 4 && request.status == 200) {

                callback(request.responseText)
            }
        }

        request.send(`action=cerrar_sesion`)
    }

    set_chat(id, callback)
    {
        let request = new XMLHttpRequest()
        request.open('POST', '../controllers/app.php', true)
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
        request.onreadystatechange = function () {

            if (request.readyState == 4 && request.status == 200) {

                callback(request.responseText)
            }
        }

        request.send(`id=${id}&action=set_chat`)
    }

    get_messeges(callback)
    {
        let request = new XMLHttpRequest()
        request.open('POST', '../controllers/app.php', true)
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
        request.onreadystatechange = function () {

            if (request.readyState == 4 && request.status == 200) {

                callback(request.responseText)
            }
        }

        request.send(`action=get_messeges`)
    }

    add_messege(messege, callback)
    {
        let request = new XMLHttpRequest()
        request.open('POST', '../controllers/app.php', true)
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
        request.onreadystatechange = function () {

            if (request.readyState == 4 && request.status == 200) {

                callback(request.responseText)
            }
        }

        request.send(`messege=${messege}&action=add_messege`)
    }

    get_contacts_by_input(value, callback)
    {
        let request = new XMLHttpRequest()
        request.open('POST', '../controllers/app.php', true)
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
        request.onreadystatechange = function () {

            if (request.readyState == 4 && request.status == 200) {

                callback(request.responseText)
            }
        }

        request.send(`value=${value}&action=get_contacts_by_input`)
    }

    add_relationship(id, id_contact)
    {
        let request = new XMLHttpRequest()
        request.open('POST', '../controllers/app.php', true)
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
        request.onreadystatechange = function () {

            if (request.readyState == 4 && request.status == 200) {

                console.log(request.responseText)
            }
        }

        request.send(`id=${id}&id_contact=${id_contact}&action=add_relationship`)
    }

    delete_relationship(id, id_contact)
    {
        let request = new XMLHttpRequest()
        request.open('POST', '../controllers/app.php', true)
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
        request.onreadystatechange = function () {

            if (request.readyState == 4 && request.status == 200) {

                console.log(request.responseText)
            }
        }

        request.send(`id=${id}&id_contact=${id_contact}&action=delete_relationship`)
    }
}

export default Chat