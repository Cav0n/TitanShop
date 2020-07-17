<?php

namespace App\Console\Commands\Create;

use App\Console\Commands\TitanshopCommand;
use App\Models\Administrator as ModelsAdministrator;
use Illuminate\Support\Facades\Hash;

class Administrator extends TitanshopCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'titanshop:create:administrator';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a brand new administrator';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        parent::handle();

        $firstname = $this->ask('Firstname');
        $lastname = $this->ask('Lastname');
        $nickname = $this->ask('Nickname');
        $email = $this->ask('Email');
        $password = Hash::make($this->ask('Password'));
        $lang = $this->ask('Lang (could be empty for "fr")');
        $isActivated = $this->confirm('The administrator account is activated ?');

        $administrator = new ModelsAdministrator();
        $administrator->firstname = $firstname;
        $administrator->lastname = $lastname;
        $administrator->nickname = $nickname;
        $administrator->email = $email;
        $administrator->password = $password;
        $administrator->lang = $lang ?? 'fr';
        $administrator->isActivated = $isActivated;
        $administrator->save();

        $this->info('Administrator successfully created.');
    }
}
