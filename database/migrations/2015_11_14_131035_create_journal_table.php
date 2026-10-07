<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateJournalTable extends Migration
{
    public function up(): void
    {
        Schema::create('journal', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('owner_id');
            $table->string('owner_type');
            $table->index(['owner_id', 'owner_type']);
            $table->unsignedInteger('entity_id')->nullable()->default(null)->index('entity_id');
            $table->string('entity_type');
            $table->index(['entity_type', 'entity_id'], 'entity_type');
            $table->enum('type', ['created', 'updated', 'deleted', 'restored', 'forceDeleted']);
            $table->longText('previous')->nullable()->default(null);
            $table->longText('current')->nullable()->default(null);
            $table->timestamp('created_at')->nullable()->index('created_at');
            $table->index(['type', 'entity_type'], 'type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('journal');
    }
}
