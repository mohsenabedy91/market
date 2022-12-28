<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use OpenApi\Generator;

class GenerateSwagger extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'swagger:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate swagger docs';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $openapi = Generator::scan([base_path('app'), base_path('Modules')]);

        header('Content-Type: application/x-yaml');

        file_put_contents(base_path('docs/openapi.json'), $openapi?->toJson());

        return self::SUCCESS;
    }
}
