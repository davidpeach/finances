<?php

namespace Tests\Unit\Jobs;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ForecastGeneratorTest extends TestCase
{
    use RefreshDatabase;

    public function a_forecast_can_be_generated_based_on_known_financial_commitments()
    {
        // Given that there are some monthly financial commitments

        // When generating a financial forecast between two dates

        // Then future transactions should be plotted out on the correct dates.
        // along with amount remaining after each transaction.
    }
}
