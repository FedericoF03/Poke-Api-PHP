const d = document;
const back = d.querySelector(".back_poke-info");
const namePoke = d.querySelector(".poke-info_name");
const backData = d.querySelectorAll(".poke-info_data");
const types = d.querySelectorAll("#type");
const type = types[0].src.split("public/img/");
export {d};
switch(type[1]) {
    case "grass.png":
        back.style.setProperty("background-color","#38dd51");
        back.style.setProperty("background-color","#38dd51");
        namePoke.style.setProperty("background-color","#378d1fea");
        for(let i = 0; i < backData.length; i++) {
            backData[i].style.setProperty("background-color","#4e9129");}
    break;
    case "fire.png":
        back.style.backgroundColor = 'rgb(221 56 56)';
        namePoke.style.setProperty("background-color","#8d1f1fea");
        for(let i = 0; i < backData.length; i++) {
            backData[i].style.setProperty("background-color","rgb(145 41 41)");}
    break;
    case "water.png":
        back.style.setProperty("background-color","rgb(56 163 221)");
        namePoke.style.setProperty("background-color","rgb(31 118 141)");
        for(let i = 0; i < backData.length; i++) {
            backData[i].style.setProperty("background-color","rgb(41 118 145)");}
    break;
    case "bug.png":
        back.style.setProperty("background-color","rgb(161 221 56)");
        namePoke.style.setProperty("background-color","rgb(106 141 31)");
        for(let i = 0; i < backData.length; i++) {
            backData[i].style.setProperty("background-color","rgb(102 145 41)");}
    break;
    case "ground.png":
        back.style.setProperty("background-color","rgb(221 152 56)");
        namePoke.style.setProperty("background-color","#db8635");
        for(let i = 0; i < backData.length; i++) {
            backData[i].style.setProperty("background-color","#916529");}
    break;
    case "rock.png":
        back.style.setProperty("background-color","rgb(100 46 27)");
        namePoke.style.setProperty("background-color","rgb(66 27 16)");
        for(let i = 0; i < backData.length; i++) {
            backData[i].style.setProperty("background-color","rgb(68 24 20)");}
    break;
    case "flying.png":
        back.style.setProperty("background-color","rgb(138 176 219)");
        namePoke.style.setProperty("background-color","rgb(78 123 143)");
        for(let i = 0; i < backData.length; i++) {
            backData[i].style.setProperty("background-color","rgb(71 122 145)");}
    break;
    case "normal.png":
        back.style.setProperty("background-color","rgb(227 119 192)");
        namePoke.style.setProperty("background-color","rgb(171 95 163)");
        for(let i = 0; i < backData.length; i++) {
            backData[i].style.setProperty("background-color","rgb(177 93 168)");}
    break;
    case "fighting.png":
        back.style.setProperty("background-color","rgb(221 98 56)");
        namePoke.style.setProperty("background-color","rgb(141 69 31)");
        for(let i = 0; i < backData.length; i++) {
            backData[i].style.setProperty("background-color","rgb(145 68 41)");}
    break;
    case "poison.png":
        back.style.setProperty("background-color","rgb(116 56 221)");
        namePoke.style.setProperty("background-color","rgb(71 31 141)");
        for(let i = 0; i < backData.length; i++) {
            backData[i].style.setProperty("background-color","rgb(79 41 145)");}
    break;
    case "ghost.png":
        back.style.setProperty("background-color","rgb(101 56 221)");
        namePoke.style.setProperty("background-color","rgb(74 40 167)");
        for(let i = 0; i < backData.length; i++) {
            backData[i].style.setProperty("background-color","rgb(69 41 145)");}
    break;
    case "steel.png":
        back.style.setProperty("background-color","rgb(157 189 176)");
        namePoke.style.setProperty("background-color","rgb(119 145 135)");
        for(let i = 0; i < backData.length; i++) {
            backData[i].style.setProperty("background-color","rgb(93 129 113)");}
    break;
    case "electric.png":
        back.style.setProperty("background-color","rgb(255 247 82)");
        namePoke.style.setProperty("background-color","rgb(237 219 50)");
        for(let i = 0; i < backData.length; i++) {
            backData[i].style.setProperty("background-color","rgb(227 218 52)");}
    break;
    case "psychic.png":
        back.style.setProperty("background-color","rgb(219 54 156)");
        namePoke.style.setProperty("background-color","rgb(141 31 114)");
        for(let i = 0; i < backData.length; i++) {
            backData[i].style.setProperty("background-color","rgb(145 41 120)");}
    break;
    case "ice.png":
        back.style.setProperty("background-color","rgb(124 165 221)");
        namePoke.style.setProperty("background-color","rgb(82 121 147)");
        for(let i = 0; i < backData.length; i++) {
            backData[i].style.setProperty("background-color","rgb(83 113 137)");}
    break;
    case "dragon.png":
        back.style.setProperty("background-color","rgb(56 179 221)");
        namePoke.style.setProperty("background-color","rgb(31 118 141)");
        for(let i = 0; i < backData.length; i++) {
            backData[i].style.setProperty("background-color","rgb(41 123 145)");}
    break;
    case "dark.png":
        back.style.setProperty("background-color","rgb(19 21 60)");
        namePoke.style.setProperty("background-color","rgb(7 12 34)");
        for(let i = 0; i < backData.length; i++) {
            backData[i].style.setProperty("background-color","rgb(8 11 44)");
            backData[i].style.setProperty("color","#ffffff");}
    break;
    case "fairy.png":
        back.style.setProperty("background-color","rgb(221 56 113)");
        namePoke.style.setProperty("background-color","rgb(141 31 69)");
        for(let i = 0; i < backData.length; i++) {
            backData[i].style.setProperty("background-color","rgb(145 41 72)");}
    break;
    case "unknown.png":
        back.style.setProperty("background-color","rgb(56 221 157)");
        namePoke.style.setProperty("background-color","rgb(31 141 108)");
        for(let i = 0; i < backData.length; i++) {
            backData[i].style.setProperty("background-color","rgb(41 145 100)");}
    break;
    default:
}
