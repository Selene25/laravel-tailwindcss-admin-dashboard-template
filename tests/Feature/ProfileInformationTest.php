<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Jetstream\Http\Livewire\UpdateProfileInformationForm;
use Livewire\Livewire;
use Tests\TestCase;

class ProfileInformationTest extends TestCase
{
    use RefreshDatabase;

    public function test_current_profile_information_is_available(): void
    {
        $this->actingAs($user = User::factory()->createOne());

        $component = Livewire::test(UpdateProfileInformationForm::class);

        $this->assertEquals($user->fname, $component->state['fname']);
        $this->assertEquals($user->lname, $component->state['lname']);
        $this->assertEquals($user->email, $component->state['email']);
    }

    public function test_profile_information_can_be_updated(): void
    {
        $this->actingAs($user = User::factory()->create());

        Livewire::test(UpdateProfileInformationForm::class)
            ->set('state', ['fname' => 'Test Name', 'email' => 'test@example.com'])
            ->call('updateProfileInformation');

        $this->assertEquals('Test', $user->fresh()->fname);
        $this->assertEquals('Name', $user->fresh()->lname);
        $this->assertEquals('test@example.com', $user->fresh()->email);
    }
}
