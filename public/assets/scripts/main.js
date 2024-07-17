// capturo todos os butoes de ações (editar, pagar e deletar)
const buttons = document.querySelectorAll("[data-id]")

// seleciono meu formulario de atualizar conta e seus elementos
const modalUpdate = document.querySelector(".modal_update")
const formUpdate = modalUpdate.querySelector("form")
const inputUpdate = modalUpdate.querySelector("input[type=text]")
const dateUpdate = modalUpdate.querySelector("input[type=date]")
const title = modalUpdate.querySelector("h1")
const buttonUpdate = modalUpdate.querySelector("button")

// percorro todos os meus butoes de ação e defino um evento de click para cada um
buttons.forEach((button) => {

    button.addEventListener("click", function () {
        // pego o tipo de ação a ser executada e o id da conta
        const method = button.classList[1]
        const id = button.dataset.id

        // seleciono a linha da conta seleciona junto as informações importantes para a função
        const parentButton = button.parentNode.parentNode
        const price = parentButton.children[1].innerText.substr(3)
        const date = parentButton.children[2].innerText

        if (method === "pay") return pay(id) // função para pagar a conta
        if (method === "edit") return edit(id, price, date) // função para editar a conta
        if (method === "delete") return delet(id) // função para apagar a conta

    })

})

/* 
função executada ao clicar no botao de atualizar a conta,
ela valida as inforamções antes de ser execuatada
*/
buttonUpdate.addEventListener("click", function (e) {
    e.preventDefault()

    const id = title.innerText.split("#")[1]
    if (!inputUpdate.value || !dateUpdate.value) {
        this.textContent = "Verifique os campus!"
        this.style.background = "#9b0707"
        return
    }

    formUpdate.action = `/edit-bill/${id}` // rota de edição definida em routes.php 
    formUpdate.submit()
})

// abre um modal para atualizar a conta
modalUpdate.addEventListener("click", function (e) {
    const element = e.target

    if (!element.classList.contains("modal_update")) return
    this.classList.add("none")
})

async function pay(id) {
    window.location = `/pay-bill/${id}` // rota de edição definida em routes.php 
}

/*
insere as informações da conta a ser editada nos devidos campos,
localizados no formulario do modal  
*/
function edit(...params) {
    const [id, price, date] = params

    const [day, month, year] = date.split("/")


    let newDate = new Date(`${month}-${day}-${year}`).toISOString().substring(0, 10)

    inputUpdate.value = price
    dateUpdate.value = newDate

    title.querySelector("p").textContent = `#${id}`

    modalUpdate.classList.remove("none")
}

function delet(id) {
    window.location = `/delete/${id}` // rota de edição definida em routes.php 
}
