<?php

/**
 * 
 */
class Player
{
	public string $name;
	public int $coins;

	public function __construct($name, $coins)
	{
		$this->name = $name;
		$this->coins = $coins;

	}

	public function point($player)
	{
		$this->coins++;
		$player->coins--;
	}

	public function bankrupt()
	{
		return $this->coins == 0;
	}

	public function bank()
	{
		return $this->coins;
	}
}

/**
 * 
 */
class Game extends Player
{
	
	protected $player1;
	protected $player2;
	protected $flips = 1;

	public function __construct($player1, $player2)
	{
		$this->player1 = $player1;
		$this->player2 = $player2;
	}

	public function flip()
	{
		return rand(0, 1) ? "orel": "reshka";
	}

	public function start()
	{
		while (true) {
			if ($this->flip() == "orel") {
				$this->player1->point($this->player2);
			} else {
				$this->player2->point($this->player1);
			}

			if ($this->player1->bankrupt() || $this->player2->bankrupt()) {
				return $this->end();
			}
			$this->flips++;
		}
	}

	public function winner()
	{
		if ($this->player1->bank() > $this->player2->bank()) {
			return $this->player1;
		} else {
			return $this->player2;
		}
	}

	public function end()
	{
		echo <<<E0T
			Game over.

			Winner: {$this->winner()->name}
			Games: {$this->flips}
		E0T;
	}
}


$game = new Game (
	new Player("Abdulloh", 100),
	new Player("Sevinch", 100)
);

$game->start();

