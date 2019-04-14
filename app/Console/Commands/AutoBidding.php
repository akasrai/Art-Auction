<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\UserService;

class AutoBidding extends Command
{
    protected $signature = 'autobid:product';

    protected $description = 'Auto bid product';

    public function __construct(UserService $userService)
    {
        parent::__construct();
        $this->userService = $userService;
    }
    
    public function handle()
    {
        $id = Auth::user()->id;
        $this->userService->resendEmailVerificationLink($id);
    }
}
