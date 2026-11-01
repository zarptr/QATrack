<?php

namespace Database\Seeders;

use App\Models\Bug;
use App\Models\Project;
use App\Models\User;
use App\Notifications\BugNotification;
use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $yoda = User::where('role', 'super_admin')->first() ?? User::where('email', 'yoda@jedi.com')->first();
        $obiwan = User::where('role', 'support_dev')->first() ?? User::where('email', 'obiwan@jedi.com')->first();
        $anakin = User::where('role', 'developer')->first() ?? User::where('email', 'anakin@jedi.com')->first();

        if (! $obiwan) {
            $obiwan = User::first();
        }

        // Seed default project folders directly into the system (Socuit, HaiHai, WCP, POCA)
        $projSocuit = Project::firstOrCreate(
            ['name' => 'Socuit'],
            [
                'description' => 'Aplikasi dan layanan platform Socuit',
                'created_by' => $obiwan->id,
            ]
        );

        $projHaiHai = Project::firstOrCreate(
            ['name' => 'HaiHai'],
            [
                'description' => 'Aplikasi platform interaksi dan komunikasi HaiHai',
                'created_by' => $obiwan->id,
            ]
        );

        $projWcp = Project::firstOrCreate(
            ['name' => 'WCP'],
            [
                'description' => 'Project Web Client Portal / Platform WCP',
                'created_by' => $obiwan->id,
            ]
        );

        $projPoca = Project::firstOrCreate(
            ['name' => 'POCA'],
            [
                'description' => 'Project Point of Customer Access / Aplikasi POCA',
                'created_by' => $obiwan->id,
            ]
        );

        // Ensure sample bugs exist with automated project folder grouping
        $bug1 = Bug::firstOrCreate(
            ['title' => 'Gateway Timeout saat Checkout'],
            [
                'project_id' => $projSocuit->id,
                'project' => $projSocuit->name,
                'priority' => 'p1',
                'status' => 'in_progress',
                'developer' => 'anakin',
                'description' => 'Gateway timeout 504 terjadi saat memproses pembayaran checkout dengan kartu kredit pada beban tinggi.',
                'reporter_id' => $obiwan->id,
            ]
        );
        $bug1->update(['project_id' => $projSocuit->id, 'project' => $projSocuit->name]);

        $bug2 = Bug::firstOrCreate(
            ['title' => 'Navigasi Mobile Macet saat Resize'],
            [
                'project_id' => $projHaiHai->id,
                'project' => $projHaiHai->name,
                'priority' => 'p2',
                'status' => 'open',
                'developer' => 'anakin',
                'description' => 'Drawer navigasi samping tidak merespon sentuhan saat dibuka pada layar resolusi mobile di bawah 768px.',
                'reporter_id' => $obiwan->id,
            ]
        );
        $bug2->update(['project_id' => $projHaiHai->id, 'project' => $projHaiHai->name]);

        $bug3 = Bug::firstOrCreate(
            ['title' => 'Memory Leak pada Report Export CSV'],
            [
                'project_id' => $projWcp->id,
                'project' => $projWcp->name,
                'priority' => 'p3',
                'status' => 'fixed',
                'developer' => 'anakin',
                'description' => 'Penggunaan RAM melonjak hingga 512MB saat melakukan export 10.000 data log ke format CSV.',
                'reporter_id' => $obiwan->id,
            ]
        );
        $bug3->update(['project_id' => $projWcp->id, 'project' => $projWcp->name]);

        // Clear existing notifications to avoid duplicates on re-seed
        $yoda->notifications()->delete();
        $obiwan->notifications()->delete();
        $anakin->notifications()->delete();

        // 1. Notifications for Super Admin (masteryoda)
        $yoda->notify(new BugNotification(
            title: 'Bug Baru Dilaporkan (P1)',
            message: "{$obiwan->name} melaporkan bug kritis #{$bug1->id}: '{$bug1->title}'",
            type: 'bug_created',
            bugId: $bug1->id,
            icon: 'bug_report',
            badgeColor: 'error'
        ));

        $yoda->notify(new BugNotification(
            title: 'Penugasan Developer',
            message: "{$anakin->name} ditugaskan untuk menangani bug #{$bug1->id}: '{$bug1->title}'",
            type: 'assigned',
            bugId: $bug1->id,
            icon: 'person_add',
            badgeColor: 'primary'
        ));

        $yoda->notify(new BugNotification(
            title: 'Bug Telah Diperbaiki',
            message: "{$anakin->name} menandai bug #{$bug3->id} ('{$bug3->title}') sebagai 'Fixed'",
            type: 'status_updated',
            bugId: $bug3->id,
            icon: 'check_circle',
            badgeColor: 'emerald'
        ));

        // 2. Notifications for Support / QA (obiwan)
        $obiwan->notify(new BugNotification(
            title: 'Status Bug Diperbarui',
            message: "{$anakin->name} mulai mengerjakan bug #{$bug1->id} ('{$bug1->title}') yang Anda laporkan.",
            type: 'status_updated',
            bugId: $bug1->id,
            icon: 'sync',
            badgeColor: 'primary'
        ));

        $obiwan->notify(new BugNotification(
            title: 'Bug Siap Di-retest',
            message: "Bug #{$bug3->id} ('{$bug3->title}') telah diperbaiki oleh {$anakin->name}. Siap untuk retest verifikasi.",
            type: 'status_updated',
            bugId: $bug3->id,
            icon: 'check_circle',
            badgeColor: 'emerald'
        ));

        $obiwan->notify(new BugNotification(
            title: 'Laporan Bug Diterima',
            message: "Laporan bug #{$bug2->id} ('{$bug2->title}') telah terdaftar dalam sistem antrean.",
            type: 'bug_created',
            bugId: $bug2->id,
            icon: 'task_alt',
            badgeColor: 'secondary'
        ));

        // 3. Notifications for Developer (anakin)
        $anakin->notify(new BugNotification(
            title: 'Penugasan Bug Baru',
            message: "Anda telah ditugaskan untuk menangani bug #{$bug1->id}: '{$bug1->title}'",
            type: 'assigned',
            bugId: $bug1->id,
            icon: 'person_add',
            badgeColor: 'primary'
        ));

        $anakin->notify(new BugNotification(
            title: 'Alert Bug Kritis (P1)',
            message: "Bug prioritas tinggi #{$bug1->id} ('{$bug1->title}') memerlukan perhatian segera.",
            type: 'critical',
            bugId: $bug1->id,
            icon: 'warning',
            badgeColor: 'error'
        ));

        $anakin->notify(new BugNotification(
            title: 'Bug Ditugaskan',
            message: "Anda ditugaskan ke bug #{$bug2->id}: '{$bug2->title}'. Prioritas P2.",
            type: 'assigned',
            bugId: $bug2->id,
            icon: 'person_add',
            badgeColor: 'primary'
        ));
    }
}
