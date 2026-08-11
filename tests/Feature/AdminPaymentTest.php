<?php

namespace Tests\Feature;

use App\Models\Member;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminPaymentTest extends TestCase
{
    use RefreshDatabase;

    public function test_payment_index_keeps_invoice_details_in_customer_detail(): void
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $member = Member::factory()->create(['name' => 'Test Member']);
        $payment = Payment::factory()->create([
            'member_id' => $member->id,
            'invoice_number' => 'INV-DETAIL-001',
        ]);

        $indexResponse = $this->actingAs($admin)->get(route('admin.payments.index'));

        $indexResponse->assertOk();
        $indexResponse->assertSee($member->name);
        $this->assertStringNotContainsString('>Invoice</th>', $indexResponse->getContent());

        $detailResponse = $this->actingAs($admin)
            ->get(route('admin.members.payments', $member));

        $detailResponse->assertOk();
        $detailResponse->assertSee($payment->invoice_number);
    }
}
