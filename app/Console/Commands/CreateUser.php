<?php

namespace App\Console\Commands;

use App\Models\Role;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Создает пользователя';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name = $this->ask('Введите имя пользователя');
        $password = $this->ask('Введите пароль');
        $ref = $this->ask('Введите реферальный код (по нему будут показываться логи)');

        User::query()->create([
            'name' => $name,
            'password' => Hash::make($password),
            'referral_code' => $ref,
            'role_id' => Role::query()->where('slug', 'spammer')->value('id')
        ]);

        $this->info('Пользователь создан');

        return 0;
    }
}
