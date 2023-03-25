//init
    const tuerca = document.getElementById('tuerca')
    const menu = document.getElementById('menu')
    const c_search_contacts = document.getElementById('c-search-contacts')
    const c_all = document.getElementById('c-all')

    let sw = 0

    // functions for hide search
    function show_search()
    {
        const c_search_dom = document.getElementById("c-search")
        const input_search = document.getElementById("input-search")
        c_search_dom.style.height = "100%"
    }

    function hide_search()
    {
        const c_search_dom = document.getElementById("c-search")
        const input_search = document.getElementById("input-search")
        c_search_dom.style.height = "0%"
        input_search.value = ""
    }

    // function for show/hide menu
    let show = false
    function show_menu()
    {
        if(show == false)
        {
            menu.style.transform = "translateX(0%)"
            show = true
        }
        else if(show == true)
        {
            menu.style.transform = "translateX(100%)"
            show = false
        }
    }

    // function for show add-contact
    function open_add_contact()
    {
        c_all.style.filter = "brightness(40%)"
        c_search_contacts.style.display = "flex"

        setTimeout(function(){

            sw = 1
        }, 500)
    }
    function close_add_contact()
    {
        c_all.style.filter = "brightness(100%)"
        c_search_contacts.style.display = "none"
        sw = 0
    }

    // evento for close window add-contact when click outside
    c_all.addEventListener('click', function(){

        if(sw == 1)
        {
            close_add_contact()
        }
    })

    tuerca.addEventListener('click', show_menu)