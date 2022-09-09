<?php 
    $pokename = $_POST['name'];
    
    $poke = new Pokedex();

    $pokedata = $poke->get_data("https://pokeapi.co/api/v2/pokemon/", $pokename);
    $pokedataspecie = $poke->get_data("https://pokeapi.co/api/v2/pokemon-species/", $pokedata['id']);
    if(isset($pokedataspecie['evolution_chain'])) $pokedatachain = $poke->get_data($pokedataspecie['evolution_chain']);
    $template = "   
    <div class='conteiner_poke-info'>
        <div class='flex poke-info'>
            <div class='back_poke-info'>
                <div>
                    <figcaption class='poke-info_name'>$pokename</figcaption>";
    !empty($pokedata['img'])
        ?$template .= '
                    <img class="poke-info_img" src='.$pokedata['img'].' alt="pókemon-img" id="prueba">'
        :$template .= '
                    <img class="poke-info_img" height="150" src="public/img/pokemon_not_found.png" alt="pókemon-not-found" id="prueba">';
        $template .= '
                </div>';
    if(!empty($pokedata['img'])) $template .= '<input class="i_shiny" type="button" value="" id="buttonShiny">';
        $template .='
                <div class="conteiner_datas">
                    <div class="box_data">
                    <p class="poke-info_data-name">Data</p>
                        <div class="poke-info_data">
                            <p class="white">Altura:</p>
                            <p>'.$pokedata['height'].'M</p>
                            <p class="white">Ancho:</p>
                            <p>'.$pokedata['weight'].'Kg</p>';
    if(!empty($pokedataspecie['mythical'])) {
        if($pokedataspecie['legendary']) $template .= '
                            <p>Is legendary</p>';
        if($pokedataspecie['mythical']) $template .=   '
                            <p>Is Mythical</p>';
    }
    $template .= '      </div>
                    </div>
                    <div class="box_data">
                    <p class="poke-info_data-name">Types</p>
                        <div class="poke-info_data types_t">';     
    for($n = 0; $n < count($pokedata['types']); $n++) {
        $template .='       <img class="small_types" id="type" height="130" src="public/img/'.$pokedata['types'][$n]['type']['name'].'.png" alt="pókemon">';
    }
    $template .= '      </div>
                    </div>
                    <div class="box_data">
                    <p class="poke-info_data-name">Abilities</p>
                        <div class="poke-info_data">';      
    for($n = 0; $n < count($pokedata['abilities']); $n++) {       
        $template .= "      <p>". $pokedata['abilities'][$n]['ability']['name'] . "</p>";
        $pokedata['abilities'][$n]['is_hidden']
        ?$template .= "     <p class='white'> Ability ocult</p>"
        :$template .= "     <p class='white'> Ability </p>";
    }
    $template .= '      </div>
                    </div>
                </div>
            </div>';
    for($n = 0; $n < count($pokedata['stats']); $n++) {
        $template .="
            <div class='conteiner_stat'>
                <div class='line-stat' id='stat$n' value='".$pokedata['stats'][$n]['base_stat']."'>
                    <p class='stat'>".$pokedata['stats'][$n]['stat']['name']." ".$pokedata['stats'][$n]['base_stat']."</p>
                </div>
            </div>";   
    }
    
    if(isset($pokedataspecie['evolution_chain'])) {
        $arraypokemonchain = array();
        foreach($pokedatachain as $data) {
            $array = array('pokemon'=>$data);
            $img = $poke->get_data("https://pokeapi.co/api/v2/pokemon/".$data);
            $data = array_merge($array, $img);
            array_push($arraypokemonchain, $data);
        }

        if(count($arraypokemonchain) !== 1) {
            $template .= '
            <p class="evo_title">Evolution Chain</p>';
            $template .= '
            <div class="conteiner_card-chain">';
            for($n = 0; $n < count($arraypokemonchain); $n++) {
                $template .='
                <div class="conteiner_cards">
                    <label>
                    <form class="form_cards-poke" action="poke-info" method="POST">';
                $arraypokemonchain[$n]['img']
                ? $template .= '
                        <img width="200" height="200" src="'.$arraypokemonchain[$n]['img'].'" alt="'.$arraypokemonchain[$n]['pokemon'].'">'
                : $template .= '
                        <img width="200" height="200" src="public/img/pokemon_not_found.png" alt="'.$arraypokemonchain[$n]['pokemon'].'">';
                
                $template .= '
                        <figcaption>'. $arraypokemonchain[$n]['pokemon'].'</figcaption>
                        <input type="hidden" name="name" value="'.$arraypokemonchain[$n]['pokemon'].'">
                        <input class="cards-poke_i" type="submit" value="Info">  
                    </form>
                    </label>
                </div>';
                if($n < (count($arraypokemonchain) - 1)){
                    $template .='
                <img class="evo_row" src="https://cdn-icons-png.flaticon.com/512/188/188966.png" alt="rows">';
                }
            }
        $template .= '
            </div>';
        }     
    }
    $template .= '
        </div>
    </div>
    <script src="public/js/color.js"></script>   
    <script type="module" src="public/js/prueba.js"></script>
    <script type="module" src="public/js/porc.js"></script>';
    print($template);
?>

