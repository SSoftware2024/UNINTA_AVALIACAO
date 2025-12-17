<?php

use App\Enum\ListItemStatus;
use App\Models\ListItem;
use App\Models\TaskList;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('list_items', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->enum('status', ListItemStatus::cases())->default(ListItemStatus::PENDING->value)->nullable();
            $table->foreignIdFor(TaskList::class)->nullable()->constrained();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('list_items');
    }
};
