<?php

use App\Models\Employer;
use App\Models\Job;

it('Belongs to an Employer', function () {
    // Arrange
    $employer = Employer::factory()->create();
    $job = Job::factory()->create([
        'employer_ie' => $employer->id,
    ]);

    // Act and Assert
    expect($job->employer->is($employer))->toBeTrue();
    //
});
