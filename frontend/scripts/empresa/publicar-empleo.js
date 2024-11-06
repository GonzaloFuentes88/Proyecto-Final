document.addEventListener('DOMContentLoaded', async function() {
    let response = await cargarModalidades()
    response = await cargarJornadas()

    console.log(response)

})
async function cargarModalidades() {
    const select = document.getElementById('modalidad');
    let response = await fetch('http://localhost/Proyecto-Final-Back/controllers/EmpresaController.php?modalidades')
    response = await response.json()
    response.body.forEach(option => {
        const newOption = document.createElement('option')
        newOption.value = option.id
        newOption.textContent = option.descripcionModalidad
        select.appendChild(newOption)
    });
    return response 
}
async function cargarJornadas() {
    const select = document.getElementById('jornada');
    let response = await fetch('http://localhost/Proyecto-Final-Back/controllers/EmpresaController.php?jornadas')
    response = await response.json()
    response.body.forEach(option => {
        const newOption = document.createElement('option')
        newOption.value = option.id
        newOption.textContent = option.descripcionJornada
        select.appendChild(newOption)
    });
    return response 
}