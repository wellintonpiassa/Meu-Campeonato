<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Utils\Utils;
use App\Models\Championship;
use App\Models\Historic;

class ChampionshipController extends Controller
{

    public function simulate(Request $request) {
        
        $newChampionship = Championship::create([
            'name' =>  $request->input('championshipName')
        ]);

        $teams = Utils::matrixElementsToObject($request->input('teams'));

        // Montando estrutura das quartas de finais, simulando-as e montando as semifinais
        $quartas = array();
        $semifinais = array();
        $wins = array();
        
        $numLoopsQuartas = 6;
        $numChaves = 0;
        $numWins = 0;
        $numSemifinal = 0;

        // Diputa das quartas de finais
        for ($i=0; $i<=$numLoopsQuartas; $i+=2) {
            $quartas[$numChaves] = array($teams[$i], $teams[$i+1]);
            $gameResult = self::getWinAndLoser($quartas[$numChaves]);
            $quartas[$numChaves]['scoreboard'] = $gameResult->scoreboard;
            $wins[$numWins] = $gameResult->winner;
            if ($numWins % 2 != 0) {
                $semifinais[$numSemifinal] = array($wins[$numWins-1], $wins[$numWins]);
                $numSemifinal++;
            }
            $numWins++;
            $numChaves++;
        }
                
        // Disputas das semifinais
        $thirdPlaceDispute = array();
        $final = array();
        $nLoopsSemi = 2;
        for($i=0; $i<$nLoopsSemi; $i++) {
            $gameResult = self::getWinAndLoser($semifinais[$i]);
            $final[$i] = $gameResult->winner;
            $thirdPlaceDispute[$i] = $gameResult->loser;
            $semifinais[$i]['scoreboard'] = $gameResult->scoreboard;
        }
        
        // Disputas de terceiro
        $gameResult = self::getWinAndLoser($thirdPlaceDispute);
        $thirdPlaceDispute['scoreboard'] = $gameResult->scoreboard;
        $fourthPlace = $gameResult->loser;
        $thirdplace = $gameResult->winner;
        
        // Final
        $gameResult = self::getWinAndLoser($final);
        $secondPlace = $gameResult->loser;
        $firstPlace = $gameResult->winner;
        $final['scoreboard'] = $gameResult->scoreboard;

        Historic::create([
            'championship_id' => $newChampionship->id,
            'fourth_place_team_id' => $fourthPlace->id,
            'third_place_team_id' => $thirdplace->id,
            'second_place_team_id' => $secondPlace->id,
            'first_place_team_id' => $firstPlace->id
        ]);

        return response()->json([
            'quartas' => $quartas,
            'semifinais' => $semifinais,
            'disputaTerceiro' => $thirdplace,
            'final' => $final,
            'fourthPlace' => $fourthPlace,
            'thirdplace' => $thirdplace,
            'secondPlace' => $secondPlace,
            'firstPlace' => $firstPlace
        ]);
        
    }

    private function getWinAndLoser($teams) {
        $teamOne = $teams[0];
        $teamTwo = $teams[1];
        
        // results[0]: Gols marcados pelo time 1 (casa)
        // results[1]: Gols marcados pelo time 2 (visitante)
        // results[2]: Caso o jogo empatasse, nessa posição estão salvos os penaltis convertidos pelo time 1 (casa)
        // results[3]: Caso o jogo empatasse, nessa posição estão salvos os penaltis convertidos pelo time 2 (visitante)
        // Ps. Os resultados dos pênaltis nunca são iguais pela regra implementada no script python
        // Ps. Pênaltis não são contabilizados nos pontos do time, somente para critério de desempate
        $results = self::runScriptPython(); 

        // Setando pontos dos times
        if (!isset($teamOne->poins))
            $teamOne->points = 0;
        $teamOne->points += intval($results[0]); // Somando pontos com os gols marcados
        $teamOne->points -= intval($results[1]); // Subtraindo pontos por conta dos gols sofridos
        
        if (!isset($teamTwo->poins))
            $teamTwo->points = 0;
        $teamTwo->points += intval($results[1]); // Somando pontos com os gols marcados
        $teamTwo->points -= intval($results[0]); // Subtraindo pontos por conta dos gols sofridos
        
        $criterionHome = $results[0];
        $criterionVistitant = $results[1];

        if ($results[0] == $results[1]) { // Significa que o jogo deu empate, portanto o jogo deve ser desempatado nos pênaltis
            $criterionHome = $results[2];
            $criterionVistitant = $results[3];
        } 

        if ($criterionHome > $criterionVistitant)
            $retorno = (Object) array(
                'winner' => $teamOne,
                'loser' => $teamTwo, 
                'scoreboard' => $results
            );
        else
            $retorno = (Object) array(
                'winner' => $teamTwo,
                'loser' => $teamOne, 
                'scoreboard' => $results
            );

        return $retorno;
    }
   
    private function runScriptPython() {
        $fileName = "teste.py";
        $path = "/var/www/";
        $results = explode(" ", shell_exec("python3 $path$fileName"));
        return $results;
    }
}
