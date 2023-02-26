const contacts_dom = document.getElementById("contacts")

/* Agrega una clase CSS a la barra de desplazamiento cuando el usuario está desplazando */
contacts_dom.addEventListener("scroll", function() {

    contacts_dom.classList.add("scrolling");
    contacts_dom.classList.remove("not_scrolling");
    
    setTimeout(function(){

        contacts_dom.classList.remove("scrolling");
        contacts_dom.classList.add("not_scrolling");
    }, 1500)
});