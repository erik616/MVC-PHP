/*
Neste aruivo JS esta uma mascara de preço,
ele seleciona todos os inputs com a classe price e formata seu valores
*/

const prices = document.querySelectorAll(".price")

prices.forEach(price => {
    price.addEventListener("input", function () {
        let price = this.value.replace(/\D/g, "")

        let valueFormart = ""
        if (price.length <= 2) {
            valueFormart += price
        } else if (price.length > 2) {
            valueFormart += `${price.substring(0, price.length - 2)},${price.substring(price.length - 2)}`
        }

        this.value = `${valueFormart}`
    })

})