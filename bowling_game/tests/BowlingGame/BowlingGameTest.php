<?php
namespace BowlingGameTest;

use BowlingGame\BowlingGame;

require_once __DIR__ . "/../bootstrap.php";


class BowlingGameTest extends \PHPUnit_Framework_TestCase
{
    /** @var  BowlingGame */
    protected $bowlingGame;

    protected function rollManyWithZero($nrRolls)
    {
        for ($i = 0; $i < $nrRolls; $i += 1) {
            $this->bowlingGame->roll(0);
        }
    }

    public function setUp()
    {
        $this->bowlingGame = new BowlingGame();
    }

    /**
     * @test
     */
    public function run_game_with_no_knock()
    {
        $this->rollManyWithZero(20);
        $this->assertEquals(0, $this->bowlingGame->score());
    }

    /**
     * @test
     */
    public function it_should_calculate_score_for_regular_knock()
    {
        $this->bowlingGame->roll(1);
        $this->bowlingGame->roll(4);
        $this->rollManyWithZero(18);
        $this->assertEquals(1 + 4, $this->bowlingGame->score());
    }

    /**
     * @test
     */
    public function it_should_calculate_score_for_a_spare()
    {
        $this->bowlingGame->roll(6);
        $this->bowlingGame->roll(4);

        $this->bowlingGame->roll(5);
        $this->bowlingGame->roll(2);

        $this->rollManyWithZero(16);
        $this->assertEquals(10 + 5 + 5 + 2, $this->bowlingGame->score());
    }

    /**
     * @test
     */
    public function it_should_calculate_score_for_a_strike()
    {
        $this->bowlingGame->roll(10);
        $this->bowlingGame->roll(5);
        $this->bowlingGame->roll(2);
        $this->rollManyWithZero(18);
        $this->assertEquals(10 + 5 + 2 + 5 + 2, $this->bowlingGame->score());
    }
}