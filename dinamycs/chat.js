//init
const c_search_dom = document.getElementById("c-search")
const svg_quit_dom = document.getElementById("svg-quit")
const search_dom = document.getElementById("search")
const input_search = document.getElementById("input-search")


// functions for hide search
function show_search()
{
    c_search_dom.style.height = "100%"
}

function hide_search()
{
    c_search_dom.style.height = "0%"
    input_search.value = ""
}

search_dom.addEventListener("click", show_search)
svg_quit_dom.addEventListener("click", hide_search)