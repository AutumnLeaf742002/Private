export default 
{
    component_loading_action()
    {
        const body = document.getElementsByTagName('body')[0]
        const component = document.createElement("div")

        component.innerHTML = `
        <div id="loading-action">
            <div class="circle-action">
                
            </div>
        </div>`

        body.insertBefore(component, body.firstChild)
    },
    delete_component_action()
    {
        component_dom = document.getElementById('loading-action')
        component_dom.remove()
    }
}