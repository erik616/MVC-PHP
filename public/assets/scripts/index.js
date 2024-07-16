const form = document.querySelector(".form")
const price = form.querySelector(".price")
const button = form.querySelector("button")
const date = form.querySelector("input[type=date]")
const companySelected = form.querySelector("select")
const modal = document.querySelector(".modal")

const filter = document.querySelector("article header form")
const priceFilter = filter.querySelector(".price")
const dateFilter = filter.querySelector("input[type=date]")
const companySelectedFilter = filter.querySelector("#companies")
const buttonFilter = filter.querySelector("button")


button.addEventListener("click", function (e) {
    e.preventDefault()

    // console.log(date.value,price.value,companySelected.value);

    if (!date.value || !price.value || companySelected.value === "Empresas") {
        modal.classList.remove("none")
        return
    }
    modal.classList.add("none")

    form.submit()
})

filter.addEventListener("submit", function (e) {
    e.preventDefault()

    if (!priceFilter.value && !dateFilter.value && companySelectedFilter.value === "Empresas") return

    filter.submit()

})