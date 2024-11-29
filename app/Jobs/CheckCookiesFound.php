<?php

namespace App\Jobs;

use App\Models\Cookie;
use App\Models\CookieFound;
use App\Models\CookieSetting;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CheckCookiesFound implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $machineId;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(int $machineId)
    {
        $this->machineId = $machineId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $cookies = Cookie::query()->where('machine_id', $this->machineId)->get();
        $settings = CookieSetting::query()->get();

        $collection = [];

        foreach ($cookies as $cookie) {
            foreach ($settings as $setting) {
                if (strpos($cookie['domain'], $setting['url'])) {
                    $collection[$setting->id][] = $cookie;
                }
            }
        }

        foreach ($collection as $key => $value) {
            $db = CookieFound::query()
                ->where('machine_id', $this->machineId)
                ->where('cookie_setting_id', $key)
                ->first();

            if ($db) {
                $db->update([
                    'cnt' => count($value)
                ]);
            } else {
                CookieFound::query()->create([
                    'machine_id' => $this->machineId,
                    'cookie_setting_id' => $key,
                    'cnt' => count($value)
                ]);
            }
        }
    }
}
