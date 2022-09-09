import { d } from './color.js';
let shiny = d.getElementById("prueba");
let shinyButton = d.getElementById("buttonShiny");

let actionsPage = ($action = "")=>{
    if($action == "") {
        d.addEventListener('click', e=>{
            let pattern = /\d/;
            let result = pattern.exec(shiny.src);
            let result1 = shiny.src.slice(result['index']);
            if(e.target.id == shiny.id || e.target.id == shinyButton.id ) {
                    
                if (!shiny.src.match("shiny")) {
                    let urlshiny = `https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/home/shiny/${result1}`
                    shiny.src = urlshiny     
                } else {
                    let urlnormal = `https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/home/${result1}`
                    shiny.src = urlnormal  
                }
            }
        })

    }        
}

actionsPage();
actionsPage('mouseover');
actionsPage('mouseout');

