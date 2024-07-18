// seleciona o formulario de cadastro e seus elementos
const form = document.querySelector(".form form")
const price = form.querySelector(".price")
const button = form.querySelector("button")
const date = form.querySelector("input[type=date]")
const companySelected = form.querySelector("select")
const modal = document.querySelector(".modal")

// seleciona o formulario de filtro e seus elementos
const filter = document.querySelector("article header form")
const priceFilter = filter.querySelector(".price")
const dateFilter = filter.querySelector("input[type=date]")
const companySelectedFilter = filter.querySelector("#companies")
const buttonFilter = filter.querySelector("button")

// ao clicar no botao de cadastro e feito uma validação dos valores
button.addEventListener("click", function (e) {
    e.preventDefault()

    if (!date.value || !price.value || companySelected.value === "Empresas") {
        modal.classList.remove("none")
        return
    }
    modal.classList.add("none")

    form.submit()
})


/*
quando o formulario é submetido,
ocorre uma pequena validação do minimo necessario para haver um filtro
*/
filter.addEventListener("submit", function (e) {
    e.preventDefault()

    if (!priceFilter.value && !dateFilter.value && companySelectedFilter.value === "Empresas") return

    filter.submit()

})