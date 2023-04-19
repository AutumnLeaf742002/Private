class Perfil
{

    get_data_user(callback)
    {
        let request = new XMLHttpRequest()
        request.open('POST', '../controllers/app.php', true)
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
        request.onreadystatechange = function () {

            if (request.readyState == 4 && request.status == 200) {

                callback(request.responseText)
            }
        }

        request.send(`action=get_data_user`)
    }

    update_user(user, password, gender, callback)
    {
        let request = new XMLHttpRequest()
        request.open('POST', '../controllers/app.php', true)
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
        request.onreadystatechange = function () {

            if (request.readyState == 4 && request.status == 200) {

                callback(request.responseText)
            }
        }

        request.send(`user=${user}&password=${password}&gender=${gender}&action=update_user`)
    }

}

export default Perfil