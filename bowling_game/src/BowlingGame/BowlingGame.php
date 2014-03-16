<?php
namespace BowlingGame;

class BowlingGame
{
    protected $rolls = array();

    public function roll($pins)
    {
        $this->rolls[] = $pins;
    }

    public function score()
    {
        $total = 0;
        $firstInFrame = 0;

        for ($frame = 0; $frame < 10; $frame += 1) {
            if ($this->isStrike($firstInFrame)) {
                $firstInFrame += 1;
                $total += 10 + $this->strikeBonus($firstInFrame);
            } elseif ($this->isSpare($firstInFrame)) {
                $firstInFrame += 2;
                $total += 10 + $this->spareBonus($firstInFrame);
            } else {
                $total += $this->rolls[$firstInFrame] + $this->rolls[$firstInFrame + 1];
                $firstInFrame += 2;
            }
        }

        return $total;
    }

    protected function isStrike($firstInFrame)
    {
        return $this->rolls[$firstInFrame] == 10;
    }

    protected function isSpare($firstInFrame)
    {
        return $this->rolls[$firstInFrame] + $this->rolls[$firstInFrame + 1] == 10;
    }

    protected function strikeBonus($firstInFrame)
    {
        return $this->rolls[$firstInFrame] + $this->rolls[$firstInFrame + 1];
    }

    protected function spareBonus($firstInFrame)
    {
        return $this->rolls[$firstInFrame];
    }
}