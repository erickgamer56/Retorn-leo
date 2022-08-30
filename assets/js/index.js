window.addEventListener("scroll" ,()=>{
    var navbar = document.querySelector(".navbar")
    var header = document.querySelector("header")
    var initofside = document.querySelector(".init_of_side")
    if (document.documentElement.scrollTop >= 1){
       navbar.classList.add("fixed")
       header.classList.add("margin_navbar")
    }else{
       navbar.classList.remove("fixed")
       header.classList.remove("margin_navbar")
    }
})