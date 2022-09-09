<?php 
    empty($_POST['type'])
    ?$type = "Types"
    :$type = $_POST['type'];

    empty($_POST['pag'])
    ?$pag = 0
    :$pag = $_POST['pag'];
    
    empty($_POST['data'])
    ?$data = "api"
    :$data = $_POST['data'];

    empty($_POST['list'])
    ?$list = 0
    :$list = $_POST['list'];

    empty($_POST['limit']) 
    ?$limit = 20
    :$limit = $_POST['limit'];
    
    if(empty($_POST['data'])){

        $pokemons = new Pokedex; 
        empty($_POST['type'])
        ? $url = "https://pokeapi.co/api/v2/pokemon?offset=$list&limit=$limit"
        : $url = "https://pokeapi.co/api/v2/type/$type?offset=$list&limit=$limit";
          
        
        if(!empty($_POST['search'])) $Arraypokemonsold['results'] = array( 
            array(  'name' => $_POST['search'],
                    'url' => "https://pokeapi.co/api/v2/pokemon/".$_POST['search'] ));
        
        else { $Arraypokemonsold = $pokemons->pokemons_or_type($url);
            $types_array = $pokemons->get_data('https://pokeapi.co/api/v2/type');
        }

    } else {
        $pokemons = new PokedexDb;
        if(!empty($_POST['search'])) {
            $search =  $_POST['search'];
            $pokemons->set_query("SELECT name, type_img, image as img, id  FROM pokemons WHERE name LIKE '%$search%'");
            $Arraypokemonsold = $pokemons->get_query();
        } else {
            $pokemons->set_query("SELECT name, type_img, image as img, id  FROM pokemons;");
            $Arraypokemonsold = $pokemons->get_query();
        } 
    }   

    if(empty($Arraypokemonsold) &&  $_POST['data'] == 'api') print('
    <div>
        <p>No hay Pokemons, revise si la URL es correcta.</p>
    </div>');

    else {
        $template ="
    <div id='charge' class='charge'>
        <img src='./public/img/charge.gif' alt='charge' />
        <figcaption>Cargando</figcaption>
    </div>
    <div class='conteiner_pokedex'>
        <div>
            <form id='formFilters' method='POST'>
                <div class='conteiner_search'>
                    <input class='search_text-box' type='text' name='search' placeholder='Search Pokemon only' >
                    <input class='search_button' type='submit' value=''>
                </div>
                <input type='hidden' name='list' value='$list'>
                <input type='hidden' name='pag' value='$pag'>
                <input type='hidden' name='limit' value='$limit'>";

        if ((empty($_POST['type']) && empty($_POST['data'])) && empty($_POST['search']) ) {
            $template .="
                <div class='conteiner_limits'>
                    <div class='limits_box'>
                        <input class='limits' type='submit' name='limit' value='5'>
                        <input class='limits' type='submit' name='limit' value='20'>
                        <input class='limits' type='submit' name='limit' value='50'>
                        <input class='limits' type='submit' name='limit' value='100'>
                    </div>
                </div>";              
        }

        if (empty($_POST['data']) && empty($_POST["search"])) {
            $template .= "
                <div class='conteiner_types'>
                    <input class='select_i' id='check' type='text' autocomplete='off' placeholder='$type'  list='type' name='type' />
                    <datalist id='type'>";
            for ($i=0; $i < count($types_array) - 2; $i++) { 
                $template .='
                        <option value="'.$types_array[$i]['name'].'"></option>';
            }
            $template .="
                    </datalist>
                </div>";
        } 
        $template .="
                <div class='conteiner_orders'>
                    <select class='select_i' id='check'  name='order' >
                        <optgroup label='NAME'>";
        !empty($_POST['order']) && $_POST['order'] == 'Z-A'
        ? $template .="     <option value='Z-A' selected>Z-A</option>"
        : $template .="     <option value='Z-A'>Z-A</option>";

        !empty($_POST['order'] ) && $_POST['order'] == 'A-Z'
        ? $template .="     <option value='A-Z' selected>A-Z</option>"
        : $template .="     <option value='A-Z'>A-Z</option>";
        $template .="   </optgroup>
                        <optgroup label='ID'>";
        empty($_POST['order'])
        ? $template .='     <option value="" selected>asc</option>'
        : $template .='     <option value="">asc</option>';

        !empty($_POST['order'] ) && $_POST['order'] == 'desc'
        ? $template .='     <option value="desc" selected>desc</option>'
        : $template .='     <option value="desc">desc</option>';
        $template .='   </optgroup>
                    </select>';

        $template .='
                    <select class="select_i" id="check" name="data">                  
                        <option value="">api</option>';
        !empty($_POST['data'] ) && $_POST['data'] == 'db'
        ? $template .=' <option value="db" selected>db</option>'  
        : $template .=' <option value="db">db</option>';                        
        $template .='
                    </select>
                </div>
            </form>
        </div>';

        $Arraypokemonsnew = array();
        
        if(empty($_POST['data'])) {
            foreach( $Arraypokemonsold['results'] as $data ) {
                $img = $pokemons->get_data($data['url']);

                if(empty($img)) $template .='
        <div class="conteiner_no-pokes>
            <p>No se encontro un pokemon coincidente</p>
            <input type="button" value="Volver atras" onclick="history.back()">
        </div>';
                else {
                    $data = array_merge($data, $img);
                    array_push($Arraypokemonsnew, $data);
                } 
            }
        } else foreach( $Arraypokemonsold as $data ) { 
            array_push($Arraypokemonsnew, $data); 
        }
                
        $template .='
        <div class="conteiner_cards">';
        
        if(!empty($_POST['order']) && $_POST['order'] == 'Z-A') rsort($Arraypokemonsnew);
        if(!empty($_POST['order']) && $_POST['order'] == 'A-Z') sort($Arraypokemonsnew);
        if(empty($_POST['order']) || $_POST['order'] !== 'desc') {

            for($n = 0; $n < count($Arraypokemonsnew); $n++) {   
                $template .='
            <div class="cards-pokemons">';
                if(empty($_POST["data"])) {
                    $template .='
                <form class="form_cards-poke" action="poke-info" method="POST" >
                <label class="cards_label">
                <div class="cards_poke-data">';
                    !empty($Arraypokemonsnew[$n]['id']) 
                    ?$template .='
                    <p class="cards_id">N°'.$Arraypokemonsnew[$n]['id'].'</p>'
                    :$template .='
                    <p class="cards_id">???</p>';
                    $template .='
                    <figcaption>'.$Arraypokemonsnew[$n]['name'].'</figcaption>
                </div>';
                    !empty($Arraypokemonsnew[$n]['img']) 
                    ?$template .='
                <img class="cards_img" src="'.$Arraypokemonsnew[$n]['img'].'" alt="'.$Arraypokemonsnew[$n]['name'].'">'
                    :$template .='
                <img class="cards_img" src="public/img/pokemon_not_found.png" alt="'.$Arraypokemonsnew[$n]['name'].'">';
                } else {
                    $type = $Arraypokemonsnew[$n]['type_img'];
                        $encode = $Arraypokemonsnew[$n]['img'];
                        $data = base64_encode($encode);
                        $template .="
                    <form class='form_cards-poke' action='poke-info-db' method='POST'>
                        <div class='cards_poke-data'>
                            <figcaption>".$Arraypokemonsnew[$n]['name']."</figcaption>
                        </div>
                        <img class='cards_img' src='data:$type; base64,$data'>";
                }
                $template .= ' 
                    <input type="hidden" name="name" value="'.$Arraypokemonsnew[$n]['name'].'">
                    <input class="cards_i" type="submit" value="Catch!"> 
                    </label> 
                </form>  
            </div>';
                }
        } else if ($_POST['order'] == 'desc') {
            for( $n = count($Arraypokemonsnew)-1; $n >= 0; $n-- ) {                        
                $template .='
            <div class="cards-pokemons">';
                if(empty($_POST["data"])) {
                    $template .='
                    <form class="form_cards-poke" action="poke-info" method="POST" >
                    <label class="cards_label">
                    <div class="cards_poke-data">';
                        !empty($Arraypokemonsnew[$n]['id']) 
                        ?$template .='
                        <p class="cards_id">N°'.$Arraypokemonsnew[$n]['id'].'</p>'
                        :$template .='
                        <p class="cards_id">???</p>';
                        $template .='
                        <figcaption>'.$Arraypokemonsnew[$n]['name'].'</figcaption>
                    </div>';
                        !empty($Arraypokemonsnew[$n]['img']) 
                        ?$template .='
                    <img class="cards_img" src="'.$Arraypokemonsnew[$n]['img'].'" alt="'.$Arraypokemonsnew[$n]['name'].'">'
                        :$template .='
                    <img class="cards_img" src="public/img/pokemon_not_found.png" alt="'.$Arraypokemonsnew[$n]['name'].'">';
                    } else {
                        $type = $Arraypokemonsnew[$n]['type_img'];
                        $encode = $Arraypokemonsnew[$n]['img'];
                        $data = base64_encode($encode);
                        $template .="
                    <form class='form_cards-poke' action='poke-info-db' method='POST'>
                        <div class='cards_poke-data'>
                            <figcaption>".$Arraypokemonsnew[$n]['name']."</figcaption>
                        </div>
                        <img class='cards_img' src='data:$type; base64,$data'>";
                }
                $template .= ' 
                    <input type="hidden" name="name" value="'.$Arraypokemonsnew[$n]['name'].'">
                    <input class="cards_i" type="submit" value="Catch!"> 
                    </label> 
                </form>  
            </div>';                          
            }
        } 

        if(!empty($_POST['data'])) {
            $template .='
            <form  action="pokedex-add" method="POST">
                <input class="add_button" type="submit" value="+">   
            </form> ';
        }
        $template .='
        </div>
        <div class="conteiner_arrows-box">'; 
        if (empty($_POST['type']) && empty($_POST['data']) && empty($_POST["search"])) {

            if (!empty($Arraypokemonsold['previous'])) {
                $template .="
            <form method='POST'>
                <input type='hidden' name='limit' value='$limit'>
                <input type='hidden' name='list' value='".$list - $limit."'>
                <input type='hidden' name='pag' value='". $pag - 1 ."'>
                <input class='arrow_left' type='submit' value=''>
            </form>" ;
            }

            $template .='
            <div class="conteiner_pag">';         
                for($n = -3; $n <= 3; $n++) {
                    if($n + $pag > -1 && $n + $pag <= floor(1154/$limit)) {
                        $template .= "
                <form form='pokedex' method='post'>
                    <input type='hidden' name='limit' value='$limit'>
                    <input type='hidden' name='list' value='".$limit * ($n + $pag)."'>
                    <input type='hidden' name='pag' value='".$n + $pag."'>";
                    $pag == $n + $pag
                    ?$template .='
                    <input class="pag pag-num pag_now" type="submit" value="'.$n + $pag.'">'
                    :$template .='
                    <input class="pag pag-num" type="submit" value="'.$n + $pag.'">';
                    $template .='
                </form>';
                                
                    }    
                }
            $template .='
            </div>';
            
            if (!empty($Arraypokemonsold['next'])) {
                $template .= "
            <form method='POST'>
                <input type='hidden' name='limit' value='$limit'>
                <input type='hidden' name='list' value='".$list + $limit."'>
                <input type='hidden' name='pag' value='". 1 + $pag."'>
                <input class='arrow_right' type='submit' value=''>
            </form>";
            }
        }
        $template .='
        </div>
        <script src="./public/js/submit.js"></script>
    </div>';
        print($template);
    }     
?>
