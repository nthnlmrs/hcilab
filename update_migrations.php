<?php

$files = glob("database/migrations/*.php");
foreach ($files as $file) {
    $content = file_get_contents($file);
    if (strpos($file, 'users_table') !== false) {
        $content = str_replace(
            '$table->string(\'password\');',
            "\$table->string('password');\n            \$table->string('role')->default('user');",
            $content
        );
    } elseif (strpos($file, 'create_pages_table') !== false) {
        $content = str_replace(
            '$table->id();',
            "\$table->id();\n            \$table->string('title');\n            \$table->string('slug')->unique();\n            \$table->string('qr_code_path')->nullable();",
            $content
        );
    } elseif (strpos($file, 'create_page_blocks_table') !== false) {
        $content = str_replace(
            '$table->id();',
            "\$table->id();\n            \$table->foreignId('page_id')->constrained()->cascadeOnDelete();\n            \$table->string('type'); // title, desc, image, card, button\n            \$table->text('content')->nullable(); // JSON or text depending on type\n            \$table->integer('order')->default(0);",
            $content
        );
    } elseif (strpos($file, 'create_quizzes_table') !== false) {
        $content = str_replace(
            '$table->id();',
            "\$table->id();\n            \$table->string('title');\n            \$table->text('description')->nullable();",
            $content
        );
    } elseif (strpos($file, 'create_questions_table') !== false) {
        $content = str_replace(
            '$table->id();',
            "\$table->id();\n            \$table->foreignId('quiz_id')->constrained()->cascadeOnDelete();\n            \$table->text('text');\n            \$table->string('image_path')->nullable();\n            \$table->text('description')->nullable();",
            $content
        );
    } elseif (strpos($file, 'create_choices_table') !== false) {
        $content = str_replace(
            '$table->id();',
            "\$table->id();\n            \$table->foreignId('question_id')->constrained()->cascadeOnDelete();\n            \$table->string('text');\n            \$table->boolean('is_correct')->default(false);",
            $content
        );
    } elseif (strpos($file, 'create_quiz_scores_table') !== false) {
        $content = str_replace(
            '$table->id();',
            "\$table->id();\n            \$table->foreignId('user_id')->nullable()->constrained()->cascadeOnDelete();\n            \$table->foreignId('quiz_id')->constrained()->cascadeOnDelete();\n            \$table->integer('score');",
            $content
        );
    }
    file_put_contents($file, $content);
}
