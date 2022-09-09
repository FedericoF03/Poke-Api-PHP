<?php 
    if(!isset($_POST['crud'])) {
        $poke = new PokedexDb;
        $poke->set_query("SELECT * FROM types;");
        $Arraypoke = $poke->get_query();
        $template =
        '<div class="conteiner_form">
            <form method="post" enctype="multipart/form-data">
                <div  class="add">
                    <h2 class="add_title">Add Pokemon</h2>
                    <input class="add_i-name" type="text" name="name" placeholder="Name*" required>
                    <input class="add_i" type="number" name="weight" placeholder="Weight*" required>
                    <input class="add_i" type="number" name="height" placeholder="Height*" required>  
                    <input name="types" autocomplete="off" placeholder="types*" list="types" required>  
                    <datalist class="add_i" id="types">';    
        foreach($Arraypoke as $array) {
            $template .= '
                        <option value="'.$array['id'].'">'.$array['types'].'</option >';
        }
        $template .= '
                    </datalist>
                    <input name="types2" autocomplete="off" placeholder="types2" list="types2" required>  
                    <datalist class="add_i" id="types2">';
        foreach($Arraypoke as $array) {
            $template .= '
                        <option value="'.$array['id'].'">'.$array['types'].'</option >';
        }
        $template .='
                    </datalist>
                    <input class="add_i" type="text" name="abilities" placeholder="Abilities*" required>
                    <input class="add_i" type="text" name="abilities2" placeholder="Abilities2">
                    <input class="add_type" type="number" min="1" max="255" name="hp" placeholder="Hp*" required>
                    <input class="add_type" type="number" min="1" max="255" name="attack" placeholder="Attack*" required>
                    <input class="add_type" type="number" min="1" max="255" name="defense" placeholder="Defense*" required>
                    <input class="add_type" type="number" min="1" max="255" name="special_attack" placeholder="Special attack*" required>
                    <input class="add_type" type="number" min="1" max="255" name="special_defense" placeholder="Special defense*" required>
                    <input class="add_type" type="number" min="1" max="255" name="speed" placeholder="Speed*" required>
                    <input class="add_i" type="file" accept="image/png, image/jpeg, image/jpg" name="image" required>
                    <p>Adding the evolution chain separates the names with "," and in the order you want them, apply the same in the future</p>
                    <input  type="text" name="pokes_chain" placeholder="Poke chain add">
                    <div>
                        <input type="checkbox" id="l" name="is_legendary">
                        <label for="l">Legendary</label>
                    </div>
                    <div>
                        <input type="checkbox" id="m" name="is_mythical" >
                        <label for="m">Mythical</label>
                    </div>
                    <div >
                        <input type="submit" class="button_add" value="Add">
                        <input type="hidden" name="crud" value="set">
                    </div>
                </div>   
            </form>
        </div>';
        print($template);
    } else {
        $poke = new PokedexDb;
        $poke->set_query("INSERT INTO pokemons (name, weight, height, types, types2, abilities, abilities2, hp, attack, defense, special_attack, special_defense, speed, type_img, name_img, image, date_img, pokes_chain, is_legendary, is_mythical )
        VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $poke->set();
        print(
        '<div class="conteiner_save">
            <p>Su Pokemon fue salvado!</p>
            <form action="pokedex" method="post">
                <input type="hidden" name="data" value="db">
                <input type="submit" value="Volver a pokedex">
            </form>
        </div>');
    }   
?>



