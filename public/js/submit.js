let d = document;
let elemenTest = d.querySelectorAll("#check");
let form = d.getElementById("formFilters");
const charge = d.getElementById("charge");
console.log(charge);

d.addEventListener("change", (e)=>{

    for(let i = 0; i < elemenTest.length; i++) {
        if(elemenTest[i] == e.target) {
            form.submit();
        }
    }    
})


d.addEventListener("DOMContentLoaded", ()=>{
    charge.style.display = "none";
})