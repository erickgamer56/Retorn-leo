window.addEventListener("scroll" ,()=>{
    var navbar = document.querySelectorAll(".navbar")
    var header = document.querySelector("header")
    var initofside = document.querySelector(".init_of_side")
    if (document.documentElement.scrollTop >= 1){
      navbar.forEach(element => {
         element.classList.add("fixed")
      });
       header.classList.add("margin_navbar")
    }else{
      navbar.forEach(element => {
         element.classList.remove("fixed")
      });
       header.classList.remove("margin_navbar")
    }
})
