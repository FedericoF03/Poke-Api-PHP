<?php 
    $pokename = $_POST['name'];
    $poke = new PokedexDb();

    $poke->set_query("SELECT p.name, p.weight, p.height, p.types, p.types2, p.abilities, p.abilities2, p.hp, p.attack, p.defense, p.special_attack, p.special_defense, p.speed, p.type_img, p.name_img, p.image, p.date_img, p.pokes_chain, p.is_legendary, p.is_mythical, t.types FROM pokemons as p
        INNER JOIN types as t
        ON p.types = t.id
        WHERE p.name = '$pokename';");
    $Arraypokemonsold = $poke->get_query();

    $poke->set_query("SELECT p.types2, t.types FROM pokemons as p
        INNER JOIN types as t
        ON p.types2 = t.id
        WHERE p.name = '$pokename';");
    $Arraypokemonsold = $poke->get_query();

    $string = explode(",", $Arraypokemonsold[0]["pokes_chain"]);
    
    $pokeevo = new PokedexDb();
  
    for($n = 0; $n < count($string); $n++) {
        $name = $string[$n];
        $name = trim($name);
        $pokeevo->set_query("SELECT type_img, name, image FROM pokemons WHERE name = '$name';");
        $pokeevo2 = $pokeevo->get_query();
    }

    if(!empty($Arraypokemonsold)) {
        $template = '   
    <div class="conteiner_poke-info">
        <div class="flex poke-info">
            <div class="back_poke-info">
                <div>';       
        $template .="
                    <figcaption class='poke-info_name'>$pokename</figcaption>";   
        $type = $Arraypokemonsold[0]['type_img'];
        $encode = $Arraypokemonsold[0]['image'];
        $template .="
                    <img class='poke-info_img' src='data:$type; base64,".base64_encode($encode)."'>
                </div>";
        $template .='
                <div class="conteiner_datas">
                    <div class="box_data">
                    <p class="poke-info_data-name">Data</p>
                        <div class="poke-info_data">
                            <p>Height:</p>
                            <p>'.($Arraypokemonsold[0]['height'] / 100).'M</p>
                            <p>Weight:</p>
                            <p>'.$Arraypokemonsold[0]['weight'].'Kg</p>';
        if($Arraypokemonsold[0]['is_legendary'] ) $template .= '
                            <p>Is legendary</p>';
        if($Arraypokemonsold[0]['is_mythical'] ) $template .= '
                            <p>Is Mythical</p>';  
        $template .= '  </div>
                    </div>
                    <div class="box_data">
                        <p class="poke-info_data-name">Types</p>
                        <div class="poke-info_data types_t">';
        $template .='       <img class="small_types" id="type" height="130" width="110" src="public/img/'.$Arraypokemonsold[0]['types'].'.png" alt="'.$Arraypokemonsold[0]['types'].'">';
        if(!empty($Arraypokemonsold[1]['types']) && $Arraypokemonsold[1]['types'] != 21 )  $template .='
                            <img class="small_types" height="130" width="110" src="public/img/'.$Arraypokemonsold[1]['types'].'.png" alt="'.$Arraypokemonsold[1]['types'].'">';
        $template .= '  </div>
                    </div>
                    <div class="box_data">
                        <p class="poke-info_data-name">Abilities</p>
                        <div class="poke-info_data">';   
        $template .= "      <p>".$Arraypokemonsold[0]['abilities']."</p>";
        if(isset($Arraypokemonsold[0]['abilities2'])) $template .= "
                            <p>".$Arraypokemonsold[0]['abilities2']."</p>";
        $template .= '  </div>
                    </div>
                </div>
            </div>';
        $stats = array(
        array($Arraypokemonsold[0]['hp'], "hp"),
        array($Arraypokemonsold[0]['attack'], "attack"),
        array($Arraypokemonsold[0]['defense'], "defense"),
        array($Arraypokemonsold[0]['special_attack'], "special_attack"), 
        array($Arraypokemonsold[0]['special_defense'], "special_defense"), 
        array($Arraypokemonsold[0]['speed'], "speed"));

        for($n = 0; $n < count($stats); $n++) {
            $template .="
                <div class='conteiner_stat'>
                    <div class='line-stat' id='stat$n' value='".$stats[$n][0]."'>
                        <p class='stat'>".$stats[$n][1]." ".$stats[$n][0]."</p>
                    </div>
                </div>";   
        }
        $template .= '
                <p class="evo_title"class="evo_text">Evolution Chain</p>
                <div class="conteiner_card-chain">';
        for($n = 0; $n < count($string); $n++) {
            if(!empty($pokeevo2[$n])) {
                $img_type = $pokeevo2[$n]['type_img'];
                $name = $pokeevo2[$n]['name'];
                $encode = $pokeevo2[$n]['image'];
        $template .="
                    <div class='conteiner_cards'>
                        <label>
                        <form class='form_cards-poke' action='poke-info-db' method='POST' > 
                            <img height='150' src='data:$img_type;base64 ,".base64_encode($encode)."'>
                            <figcaption>$name</figcaption>
                            <input type='hidden' name='name' value='$name'>
                            <input class='cards-poke_i' type='submit' value='Info'>  
                        </form>
                        </label>
                    </div>";
            if($n < (count($pokeevo2) - 1)) $template .='
                    <img class="evo_row" src="https://cdn-icons-png.flaticon.com/512/188/188966.png" alt="rows">'; 
            }          
        }
        $template .= '
                </div>
            </div>
        </div> 
    <script src="public/js/color.js"></script> 
    <script type="module" src="public/js/prueba.js"></script>
    <script type="module" src="public/js/porc.js"></script>';
        print($template);
    }
?>
