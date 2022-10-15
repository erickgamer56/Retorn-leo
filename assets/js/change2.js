document.getElementById("file").addEventListener("change", function(event){
    var output = URL.createObjectURL(event.target.files[0]);
    console.log(output)
    var uimg = document.getElementById("uimg")
    document.getElementById("icam").style.display='none'
    uimg.src=output
    uimg.style.display='flex'
    var show = document.getElementById("show")
    show.classList.add("showshow")
})
document.getElementById("r").addEventListener("click", ()=>{
    var show = document.getElementById("show")
    show.classList.remove("showshow")
})
var nome = document.getElementById("name")
nome.addEventListener("input", function(){
    var show = document.getElementById("show")
    show.classList.add("showshow")
})