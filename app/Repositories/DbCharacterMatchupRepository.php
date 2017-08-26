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

    public function getAllByCharacterMatchup($first_character, $second_character){
        $matches = Matches::select('id', 'winner_character', 'loser_character', 'winner_stocks', 'loser_stocks', 'stage' )
                                    ->where( function ($query) use ($first_character, $second_character) {
                                        $query->where( 'winner_character', '=', $first_character)
                                              ->where( 'loser_character', '=', $second_character);
                                    })
                                    ->orWhere( function ($query) use ($first_character, $second_character) {
                                        $query->where( 'winner_character', '=', $second_character)
                                              ->where( 'loser_character', '=', $first_character);
                                    })
                                    ->with( 'winner_character' )
                                    ->with( 'loser_character' )
                                    ->get();
        return $matches;
    }

    public function getAllByPlayerMatchup($first_player, $second_player){
        $matches = Matches::select('id', 'winner_character', 'loser_character', 'winner_stocks', 'loser_stocks', 'winner', 'loser', 'stage' )
                                    ->where( function ($query) use ($first_player, $second_player) {
                                        $query->where( 'winner', '=', $first_player)
                                              ->where( 'loser', '=', $second_player);
                                    })
                                    ->orWhere( function ($query) use ($first_player, $second_player) {
                                        $query->where( 'winner', '=', $second_player)
                                              ->where( 'loser', '=', $first_player);
                                    })
                                    ->with( 'winner_character' )
                                    ->with( 'loser_character' )
                                    ->with( 'winner' )
                                    ->with( 'loser' )
                                    ->get();
        return $matches;
    }

    public function getCountsByCharacterMatchup($winner_character, $loser_character){
        $winner_matches = DB::table('matches')
                    ->where( 'winner_character', '=', $winner_character )
                    ->where( 'loser_character', '=', $loser_character )
                    ->count();

        $loser_matches = DB::table('matches')
                    ->where( 'winner_character', '=', $winner_character )
                    ->where( 'loser_character', '=', $loser_character )
                    ->count();

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
