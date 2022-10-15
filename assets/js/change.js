document.getElementById("file").addEventListener("change", function(event){
    var output = URL.createObjectURL(event.target.files[0]);
    console.log(output)
    var uimg = document.getElementById("uimg")
    document.getElementById("icam").style.display='none'
    uimg.src=output
    uimg.style.display='flex'
})