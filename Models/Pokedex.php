<?php 

class Pokedex {

    public function pokemons_or_type($url) {
    
        $init = curl_init();
        curl_setopt($init, CURLOPT_URL, $url);
        curl_setopt($init, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($init);

        if (curl_errno($init)) echo curl_error($init);
        else  $decode = json_decode($response, true);
        curl_close($init);
        
        if (strpos($url,"pokeapi.co/api/v2/pokemon")) return $decode;
        else if (strpos($url,"pokeapi.co/api/v2/type/")) {
            $n = 0;
            $data = array();
            foreach($decode['pokemon'] as $pokes) {
                
                $data['results'][$n] = $pokes['pokemon'];
                $n++;
            }
            $data['previous'] = NULL;
            $data['next'] = NULL;
            
        return $data;
        }
    }


    public function get_data($url, $pokemon = "") { 
        $init = curl_init();
        if ( (strpos($url,"pokeapi.co/api/v2/pokemon/") && $pokemon == "") || ( strpos($url,"pokeapi.co/api/v2/evolution-chain/") ) || (strpos($url,"pokeapi.co/api/v2/type") && $pokemon == "") ) curl_setopt($init, CURLOPT_URL, "$url");
        if ( (strpos($url,"pokeapi.co/api/v2/pokemon/") && $pokemon !== "") || ( strpos($url,"pokeapi.co/api/v2/pokemon-species/") )) curl_setopt($init, CURLOPT_URL, "$url$pokemon");
        curl_setopt($init, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($init);
        if (curl_errno($init)) echo curl_error($init);
        else  $decode = json_decode($response, true);
        curl_close($init);
        if (strpos($url,"pokeapi.co/api/v2/pokemon/") && $pokemon == "") {
            
            if(!empty($decode)) {
                !empty($decode["sprites"]["other"]["home"]["front_default"])
                ?$data = array('img'=>$decode["sprites"]["other"]["home"]["front_default"], 'id'=>$decode["id"])
                :$data = array('img'=>$decode["sprites"]["front_default"]) ;  
                return $data;
                } 
        }
        else if (strpos($url,"pokeapi.co/api/v2/pokemon/") && $pokemon !== "") {
            $data = array(
                    'img'=>$decode["sprites"]["other"]["home"]["front_default"],
                    'weight'=>$decode["weight"],
                    'height'=>$decode["height"],
                    'types'=>$decode["types"],
                    'abilities'=>$decode["abilities"],
                    'stats'=>$decode["stats"],
                    'id'=>$decode["id"]);   
            return $data;
        } else if ( strpos($url,"pokeapi.co/api/v2/pokemon-species/") ) {
            if (!empty($decode)) {   
                $data = array(
                    'legendary'=>$decode['is_legendary'],
                    'mythical'=>$decode['is_mythical'],
                );
                if (isset($decode['evolution_chain']['url'])) $data['evolution_chain'] = $decode['evolution_chain']['url'];
                return $data;
            }   
        } else if (strpos($url,"pokeapi.co/api/v2/evolution-chain/")) {
            if (!empty($decode)) {
                $data = array();
                $path = $decode['chain'];
                $count = 0;

                while (!isset($bucle)) {
                    $data["name$count"] = $path['species']['name'];
                    $count++;
                    !empty($path['evolves_to'][0])
                    ? $path = $path['evolves_to'][0]
                    : $bucle = "stop";
                    
                }
            return $data;
            }   
        } else if (strpos($url,"pokeapi.co/api/v2/type") && $pokemon == "") {
            if (!empty($decode)) {  
                $data = $decode['results'];
                return $data;
            }
        }  
    } 
}      
?>