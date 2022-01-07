<?php

namespace Tests\Unit\Jobs;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class GenerateForecastTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_forecast_can_be_generated_based_on_known_financial_commitments()
    {
        // Given there are some monthly financial commitments
        $commitmentA = Commitment::factory()->create([
            'amount' => 100,
            'date' => 5,
        ]);

        $commitmentB = Commitment::factory()->create([
            'amount' => 200,
            'date' => 10,
        ]);

        $commitmentC = Commitment::factory()->create([
            'amount' => 50,
            'date' => 20,
        ]);

        // When generating a financial forecast between two dates
        GenerateForecast::dispatch(
            $from = new Carbon('1st January 2000'),
            $to = new Carbon('31st March 2000')
        );

        // Then future transactions should be plotted out on the correct dates.
        $this->assertDatabaseHas('transactions', [

            // January Transactions
            [
                'due_date' => new Carbon('5th January 2000'),
                'amount' => 100,
            ],
            [
                'due_date' => new Carbon('10th January 2000'),
                'amount' => 200,
            ],
            [
                'due_date' => new Carbon('20th January 2000'),
                'amount' => 50,
            ],

            // February Transactions
            [
                'due_date' => new Carbon('5th February 2000'),
                'amount' => 100,
            ],
            [
                'due_date' => new Carbon('10th February 2000'),
                'amount' => 200,
            ],
            [
                'due_date' => new Carbon('20th February 2000'),
                'amount' => 50,
            ],

            // March Transactions
            [
                'due_date' => new Carbon('5th March 2000'),
                'amount' => 100,
            ],
            [
                'due_date' => new Carbon('10th March 2000'),
                'amount' => 200,
            ],
            [
                'due_date' => new Carbon('20th March 2000'),
                'amount' => 50,
            ],
        ]);
    }
}
