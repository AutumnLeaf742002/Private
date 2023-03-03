//init
    const tuerca = document.getElementById('tuerca')
    const menu = document.getElementById('menu')

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

    tuerca.addEventListener('click', show_menu)