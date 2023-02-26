// component loading
function component_loading()
{
    const body = document.getElementsByTagName('body')[0]
    const component = document.createElement("div")

    component.innerHTML = `
    <div id="loading">
        <div id="circle">
            
        </div>
    </div>`

    body.insertBefore(component, body.firstChild)
}

// comportamientos del component
// delete component
function delete_component(component)
{
    component_dom = document.getElementById(`${component}`)
    component_dom.remove()
}


// exec component
component_loading()


// exec comportamientos del component
const component_delete = "loading"

window.addEventListener('load', () => {

    delete_component(component_delete)
});