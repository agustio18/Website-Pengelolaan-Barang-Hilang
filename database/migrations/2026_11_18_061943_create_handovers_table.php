
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('handovers', function (Blueprint $table) {
            $table->id();

            $table->foreignId('report_id')
                ->unique()
                ->constrained()
                ->cascadeOnDelete();

            $table->string('recipient_name');
            $table->string('recipient_identity');
            $table->date('handover_date');
            $table->string('officer_name');
            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('handovers');
    }
};
