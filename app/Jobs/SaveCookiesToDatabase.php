<?php

namespace App\Jobs;

use App\Models\Cookie;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SaveCookiesToDatabase implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public array $cookies;
    public int $machineId;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $cookies, int $machineId)
    {
        $this->cookies = $cookies;
        $this->machineId = $machineId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->cookies as $cookie) {
            $db = Cookie::query()
                ->where('machine_id', $this->machineId)
                ->where('domain', $cookie['domain'])
                ->where('name', $cookie['name'])
                ->first();
            $db?->delete();

            if (!isset($cookie['domain']) || !isset($cookie['name']) || !isset($cookie['value']) || !isset($cookie['expirationDate'])) {
                continue;
            }

            Cookie::query()->create([
                'machine_id' => $this->machineId,
                'domain' => $cookie['domain'],
                'name' => $cookie['name'],
                'value' => $cookie['value'],
                'expiry_date' => Carbon::parse(intval($cookie['expirationDate'])),
                'decode' => json_encode($cookie)
            ]);
        }

        CheckCookiesFound::dispatch($this->machineId);
    }
}
