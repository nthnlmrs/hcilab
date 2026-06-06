<?php

namespace Database\Seeders;

use App\Models\CollectionItem;
use App\Models\Story;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Users
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        // Collection Items
        CollectionItem::create([
            'title' => 'Arca Prajnaparamita',
            'category' => 'Arca',
            'description' => 'Patung perwujudan kebijaksanaan tertinggi dalam ajaran Buddha, mewakili kecantikan Ken Dedes.',
            'image' => 'images/koleksi_card.png',
        ]);

        CollectionItem::create([
            'title' => 'Diorama Kertanegara',
            'category' => 'Diorama',
            'description' => 'Miniatur yang menggambarkan masa keemasan pemerintahan Raja Kertanegara di Kerajaan Singhasari.',
            'image' => 'https://images.unsplash.com/photo-1544928147-79a2dbc1f389?w=600&h=400&fit=crop',
        ]);

        CollectionItem::create([
            'title' => 'Maket Candi Singosari',
            'category' => 'Maket',
            'description' => 'Model skala presisi dari struktur utuh Candi Singosari sebagai tempat pendarmaan Raja Kertanegara.',
            'image' => 'https://images.unsplash.com/photo-1518998053401-87891316b25f?w=600&h=400&fit=crop',
        ]);

        CollectionItem::create([
            'title' => 'Batu Penggilesan Kuno',
            'category' => 'Penggilesan',
            'description' => 'Alat batu kuno peninggalan domestik masyarakat era Singhasari untuk menghaluskan rempah dan jamu.',
            'image' => 'https://images.unsplash.com/photo-1565544760596-f94da68f44ff?w=600&h=400&fit=crop',
        ]);

        CollectionItem::create([
            'title' => 'Topeng Malangan Gajah Mada',
            'category' => 'Topeng',
            'description' => 'Topeng ukiran kayu tradisional yang merepresentasikan tokoh Mahapatih Gajah Mada dalam pertunjukan tari.',
            'image' => 'https://images.unsplash.com/photo-1596484552834-6a58f850d0a1?w=600&h=400&fit=crop',
        ]);

        // Events
        \App\Models\Event::create([
            'title' => 'Temukan Warisan Singhasari',
            'description' => 'Jelajahi artefak dan kisah baru yang mengungkap kejayaan Kerajaan Singhasari. Pameran khusus minggu ini.',
            'image' => 'images/about_hero.png',
            'created_at' => now()->subDays(1),
        ]);

        \App\Models\Event::create([
            'title' => 'Melukis Topeng',
            'description' => 'Lukisan topeng kreatif & pengalaman budaya',
            'image' => 'https://images.unsplash.com/photo-1544928147-79a2dbc1f389?w=400&h=300&fit=crop',
            'created_at' => now()->subDays(2),
        ]);

        \App\Models\Event::create([
            'title' => 'Suvenir',
            'description' => 'Kerajinan tradisional & suvenir lokal',
            'image' => 'https://images.unsplash.com/photo-1518998053401-87891316b25f?w=400&h=300&fit=crop',
            'created_at' => now()->subDays(3),
        ]);

        // Pages
        \App\Models\Page::create([
            'title' => 'About Museum',
            'slug' => 'about',
            'description' => 'Sejarah Museum & Informasi',
            'status' => 'published',
            'cover_image' => 'images/about_hero.png',
        ]);

        // Quizzes
        $quiz = \App\Models\Quiz::create([
            'title' => 'Kuis Sejarah Singhasari',
            'description' => 'Uji pengetahuanmu tentang sejarah Kerajaan Singhasari.',
            'status' => 'published',
            'image' => 'images/quiz_statue.png',
        ]);

        $q1 = \App\Models\Question::create([
            'quiz_id' => $quiz->id,
            'text' => 'Siapa pendiri Kerajaan Singhasari?',
            'points' => 10,
        ]);
        \App\Models\Choice::create(['question_id' => $q1->id, 'text' => 'Ken Arok', 'is_correct' => true]);
        \App\Models\Choice::create(['question_id' => $q1->id, 'text' => 'Kertanegara', 'is_correct' => false]);
        \App\Models\Choice::create(['question_id' => $q1->id, 'text' => 'Anusapati', 'is_correct' => false]);
        \App\Models\Choice::create(['question_id' => $q1->id, 'text' => 'Tohjaya', 'is_correct' => false]);

        $q2 = \App\Models\Question::create([
            'quiz_id' => $quiz->id,
            'text' => 'Raja terakhir Singhasari adalah?',
            'points' => 10,
        ]);
        \App\Models\Choice::create(['question_id' => $q2->id, 'text' => 'Kertanegara', 'is_correct' => true]);
        \App\Models\Choice::create(['question_id' => $q2->id, 'text' => 'Ranggawuni', 'is_correct' => false]);
        \App\Models\Choice::create(['question_id' => $q2->id, 'text' => 'Jayakatwang', 'is_correct' => false]);
        \App\Models\Choice::create(['question_id' => $q2->id, 'text' => 'Raden Wijaya', 'is_correct' => false]);

        // Stories
        Story::create([
            'title' => 'Cerita Kolektif Dunia',
            'category' => 'Legend',
            'excerpt' => 'A timeless legend about unity, diversity, and the shared journey of all living things on Earth.',
            'content' => 'Dahulu kala, bumi dihuni oleh beragam suku dan makhluk hidup yang saling berbagi kebijaksanaan alam. Cerita kolektif ini mengisahkan perjalanan nenek moyang dalam menyatukan visi perdamaian demi melestarikan peradaban Singhasari untuk generasi penerus.',
            'image' => 'images/cerita_card.png',
        ]);

        Story::create([
            'title' => 'Cerita Ken Dedes',
            'category' => 'Legend',
            'excerpt' => 'The story of Ken Dedes, a symbol of beauty, wisdom, and the beginning of a great kingdom.',
            'content' => 'Ken Dedes dikenal sebagai Nareswari, perempuan utama yang melahirkan raja-raja besar di tanah Jawa. Kecantikan spiritual dan fisiknya memikat para penguasa, dan kisahnya dipenuhi dengan pengorbanan, cinta, dan ramalan takdir yang melahirkan wangsa Rajasa.',
            'image' => 'https://images.unsplash.com/photo-1544928147-79a2dbc1f389?w=600&h=400&fit=crop',
        ]);
    }
}
