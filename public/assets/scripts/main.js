const buttons = document.querySelectorAll("[data-id]")
const modalUpdate = document.querySelector(".modal_update")
const formUpdate = modalUpdate.querySelector("form")
const inputUpdate = modalUpdate.querySelector("input[type=text]")
const dateUpdate = modalUpdate.querySelector("input[type=date]")
const title = modalUpdate.querySelector("h1")

const buttonUpdate = modalUpdate.querySelector("button")

buttons.forEach((button) => {

    button.addEventListener("click", function () {
        // console.log(button.classList[1], button.dataset.id)

        const method = button.classList[1]
        const id = button.dataset.id

        const parentButton = button.parentNode.parentNode
        const price = parentButton.children[1].innerText.substr(3)
        const date = parentButton.children[2].innerText

        if (method === "pay") return pay(id)
        if (method === "edit") return edit(id, price, date)
        if (method === "delete") return delet(id)

    })


})

buttonUpdate.addEventListener("click", function (e) {
    e.preventDefault()

    const id = title.innerText.split("#")[1]
    if (!inputUpdate.value || !dateUpdate.value){ 
        this.textContent = "Verifique os campus!"
        this.style.background = "#9b0707" 
        return
    }

    formUpdate.action = `/edit-bill/${id}`
    formUpdate.submit()
})

modalUpdate.addEventListener("click", function (e) {
    const element = e.target

    if (!element.classList.contains("modal_update")) return
    this.classList.add("none")
})

async function pay(id) {
    window.location = `/pay-bill/${id}`
}

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
    window.location = `/delete/${id}`
}
