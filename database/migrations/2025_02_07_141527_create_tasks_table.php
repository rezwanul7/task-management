<?php

use App\Enums\TaskPriority;
use App\Enums\TaskStatus;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->text('description')->nullable();

            $table->enum('status', TaskStatus::values())->default(TaskStatus::PENDING->value);
            $table->enum('priority', TaskPriority::values())->default(TaskPriority::MEDIUM->value);

            $table->timestamp('due_at')->nullable();
            $table->timestamp('start_at')->nullable();
            $table->timestamp('end_at')->nullable();

            $table->foreignIdFor(User::class, 'assigned_to_id')
                ->constrained()
                ->nullOnDelete();

            $table->foreignIdFor(User::class,'assigned_by_id')
                ->constrained()
                ->nullOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
