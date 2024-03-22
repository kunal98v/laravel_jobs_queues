<?php

namespace App\Jobs\Test;

use App\Models\Books;

use Illuminate\Bus\Queueable;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

use Throwable;

class ConsumeApiServiceJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected $urlToConsume;
    public function __construct($url)
    {
        $this->urlToConsume = $url;
        Log::info('Job Constructor Invoked !');
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try{
            $response = Http::get($this->urlToConsume);
            echo $response;
            $dataArray = [];
            foreach ($response['entries'] as $key => $value) {
                $dataArray[] = [
                    "name" => $value['created']['value'],
                    "bio" => isset($value['description']['value']) ? $value['description']['value'] : "key not found !",
                    "title" => $value['title'],
                ];
            }

            Books::insert($dataArray);
           
            
            Log::info('response',[$response]);
        }catch(Throwable $e){
            Log::info($e->getMessage(),[$e->getTraceAsString()]);
        }
        Log:info('Job Invoked');
    }
}
