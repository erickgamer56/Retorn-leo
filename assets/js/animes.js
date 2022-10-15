window.addEventListener("load" , ()=>{
    var form = document.querySelector(".form_login")
    form.classList.add("ativeform")
})
document.querySelector(".btn_right").addEventListener("click"  , ()=>{
    document.querySelector(".product_div").scrollBy(300, 0)
    var left = document.querySelector(".product_div").scrollLeft
    if (left >= 0){
        document.querySelector(".btn_left").classList.add("show")
    }
})
document.querySelector(".btn_left").addEventListener("click"  , ()=>{
    var left = document.querySelector(".product_div").scrollLeft
    console.log(left)
    if (left == 0 ){
        document.querySelector(".btn_left").classList.remove("show")
    }
    document.querySelector(".product_div").scrollBy(-300, 0)
})
