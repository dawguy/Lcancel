<?php

namespace App\Repositories;
use App\Matches;
use App\User;
use App\Character;
use Log;
use DB;

class DbCharacterMatchupRepository {
    public function getAll($character){
        $won_matches_by_character = Matches::select('loser_character as character', 'winner_stocks', DB::raw('count(*) as matches_count') )
                                    ->groupBy( 'loser_character' )
                                    ->groupBy( 'winner_stocks')
                                    ->where( 'winner_character', '=', $character )
                                    ->get();

        $lost_matches_by_character = Matches::select('winner_character as character', 'winner_stocks', DB::raw('count(*) as matches_count') )
                                    ->groupBy( 'winner_character' )
                                    ->groupBy( 'winner_stocks' )
                                    ->where( 'loser_character', '=', $character )
                                    ->get();

        $matches = [
            'character' => $character,
            'won' => $this->group_matches_by_character( $won_matches_by_character ),
            'lost' => $this->group_matches_by_character( $lost_matches_by_character )
        ];

        return $matches;
    }

    private function group_matches_by_character( $matches ){
        $grouped_matches = [];

        foreach( $matches as $match ){
            $this->add_match_to_array($grouped_matches, $match);
        }

        return $grouped_matches;
    }

    /*
    * Adds a match to matches
    * @matches array
    * @match array
    * @won   boolean
    */
    private function add_match_to_array(&$matches, $match){
        $character = $match['character'];
        $stocks = $match['winner_stocks'];

        if( !array_key_exists( $character, $matches) ){
            $matches[$character] = [];
        }

        $matches[$character][$stocks] = $match['matches_count'];
    }
}
