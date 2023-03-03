class Register
{
    create_user(_user, _password, _gender, callback)
    {
        let request = new XMLHttpRequest()
        request.open('POST', '../controllers/app.php', true)
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
        request.onreadystatechange = function () {

            if (request.readyState == 4 && request.status == 200) {

                callback(request.responseText)
            }
        }

        request.send(`user=${_user}&password=${_password}&gender=${_gender}&action=create_user`)
    }
}

export default Register