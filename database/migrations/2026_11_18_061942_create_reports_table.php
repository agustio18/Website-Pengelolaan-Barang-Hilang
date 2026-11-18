
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();

            $table->enum('type', ['lost', 'found']);

            $table->string('reporter_name');
            $table->string('reporter_phone');

            $table->foreignId('category_id')
                ->constrained()
                ->restrictOnDelete();

            $table->string('item_name');
            $table->text('description');

            $table->string('location');
            $table->date('event_date');

            $table->string('photo')->nullable();

            $table->enum('status', [
                'pending',
                'verified',
                'rejected',
                'returned'
            ])->default('pending');

            $table->text('admin_note')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
