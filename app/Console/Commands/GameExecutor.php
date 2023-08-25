<?php

namespace App\Console\Commands;

use App\Events\RemainingTimeChanged;
use App\Events\WinnerNumberGenerated;
use Illuminate\Console\Command;

class GameExecutor extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'game:execute';

    private $time = 15;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start executing the game';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
      While(true){
         broadcast(new RemainingTimeChanged($this->time. 's'));
         $this->time--;
         sleep(1);

         if($this->time == 0){
             $this->time = 'waiting to start';
             broadcast(new RemainingTimeChanged($this->time));

             broadcast(new WinnerNumberGenerated(mt_rand(1,12)));

             sleep(5);
             $this->time = 15;
         }
      }
    }
}
