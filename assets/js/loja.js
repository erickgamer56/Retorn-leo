window.addEventListener("load",()=>{
    if (localStorage.getItem("sabao") == 1){
        var productsabao = document.querySelectorAll('#product_sabao')
        productsabao.forEach(element => {
            element.click()
        });
    }else{
        var product_pontos = document.querySelectorAll('#product_pontos')
        product_pontos.forEach(element =>{
            element.click() 
        })
    }
})

var productsabao = document.querySelectorAll('#product_sabao')
productsabao.forEach(element => {
    element.addEventListener("click", ()=>{
        localStorage.setItem("sabao", 1)

        var product_pontos = document.querySelectorAll('#product_pontos')
        product_pontos.forEach(element => {
            element.classList.remove("active_boder_categ")
        })

        element.classList.add("active_boder_categ")
        var sabao = document.querySelectorAll('#sabao')
        sabao.forEach(element => {
            element.classList.remove("desative")
        });
        var produto = sabao = document.querySelectorAll('#produto')
        produto.forEach(element => {
            element.classList.add("desative")
        });
    })
});
var product_pontos = document.querySelectorAll('#product_pontos')
product_pontos.forEach(element => {
    element.addEventListener("click", ()=>{
        localStorage.setItem("sabao", 0)
        var productsabao = document.querySelectorAll('#product_sabao')
        productsabao.forEach(element => {
            element.classList.remove("active_boder_categ")
        })

        element.classList.add("active_boder_categ")
        var sabao = document.querySelectorAll('#sabao')
        sabao.forEach(element => {
            element.classList.add("desative")
        });
        var produto = sabao = document.querySelectorAll('#produto')
        produto.forEach(element => {
            element.classList.remove("desative")
        });
    })
});