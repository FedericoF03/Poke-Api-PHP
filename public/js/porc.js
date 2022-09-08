import { d } from './color.js';
let porc0 = d.getElementById('stat0');
let porc1 = d.getElementById('stat1');
let porc2 = d.getElementById('stat2');
let porc3 = d.getElementById('stat3');
let porc4 = d.getElementById('stat4');
let porc5 = d.getElementById('stat5');

let porcStat = ()=>{
    porc0.style.width = (porc0.attributes.value.value * 100) / 255 + '%';
    porc1.style.width = (porc1.attributes.value.value * 100) / 255 + '%';
    porc2.style.width = (porc2.attributes.value.value * 100) / 255 + '%';
    porc3.style.width = (porc3.attributes.value.value * 100) / 255 + '%';
    porc4.style.width = (porc4.attributes.value.value * 100) / 255 + '%';
    porc5.style.width = (porc5.attributes.value.value * 100) / 255 + '%';
    }
    
porcStat();

