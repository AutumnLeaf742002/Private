class Register
{
    constructor(user, password, gender)
    {
        this._user = user
        this._password = password
        this._gender = gender
    }

    create_user(callback)
    {
        let request = new XMLHttpRequest()
        request.open('POST', '../controllers/app.php', true)
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
        request.onreadystatechange = function () {

            if (request.readyState == 4 && request.status == 200) {

                callback(request.responseText)
            }
        }

        request.send(`user=${this._user}&password=${this._password}&gender=${this._gender}&action=create_user`)
    }
}

export default Register