<?php

namespace Database\Seeders;

use App\Models\Choice;
use App\Models\CollectionItem;
use App\Models\Event;
use App\Models\Page;
use App\Models\Question;
use App\Models\Quiz;
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
        Event::create([
            'title' => 'Temukan Warisan Singhasari',
            'description' => 'Jelajahi artefak dan kisah baru yang mengungkap kejayaan Kerajaan Singhasari. Pameran khusus minggu ini.',
            'image' => 'images/about_hero.png',
            'category' => 'Pameran Terbaru',
            'event_date' => '2026-05-20',
            'location' => 'Galeri Utama',
            'duration' => '3 Bulan',
            'created_at' => now()->subDays(1),
        ]);

        $event1 = Event::create([
            'title' => 'Melukis Topeng',
            'description' => 'Ikuti workshop Melukis Topeng kami dan temukan seni melukis topeng tradisional yang terinspirasi dari warisan Singhasari. Ekspresikan kreativitas Anda sambil mempelajari makna di balik setiap warna dan motif.',
            'image' => 'https://images.unsplash.com/photo-1544928147-79a2dbc1f389?w=400&h=300&fit=crop',
            'category' => 'Lukisan topeng kreatif & pengalaman budaya',
            'event_date' => '2026-05-20',
            'location' => 'Pendopo Luar',
            'duration' => '120 min',
            'max_participants' => 15,
            'target_audience' => 'Semua Usia',
            'features' => ['materials', 'instructor', 'certificate', 'drinks'],
            'created_at' => now()->subDays(2),
        ]);

        $event1->schedules()->createMany([
            ['date' => '2026-05-20', 'start_time' => '09:00:00', 'end_time' => '11:00:00'],
            ['date' => '2026-05-20', 'start_time' => '11:30:00', 'end_time' => '13:30:00'],
            ['date' => '2026-05-20', 'start_time' => '14:00:00', 'end_time' => '16:00:00'],
            ['date' => '2026-05-20', 'start_time' => '16:30:00', 'end_time' => '18:30:00'],
            ['date' => '2026-05-20', 'start_time' => '19:00:00', 'end_time' => '21:00:00'],

            ['date' => '2026-05-21', 'start_time' => '09:00:00', 'end_time' => '11:00:00'],
            ['date' => '2026-05-21', 'start_time' => '14:00:00', 'end_time' => '16:00:00'],
        ]);

        Event::create([
            'title' => 'Suvenir',
            'description' => 'Kerajinan tradisional & suvenir lokal',
            'image' => 'https://images.unsplash.com/photo-1518998053401-87891316b25f?w=400&h=300&fit=crop',
            'category' => 'Suvenir',
            'event_date' => '2026-06-20',
            'location' => 'Toko Museum',
            'duration' => 'Permanen',
            'created_at' => now()->subDays(3),
        ]);

        // Pages
        Page::create([
            'title' => 'About Museum',
            'slug' => 'about',
            'description' => 'Sejarah Museum & Informasi',
            'status' => 'published',
            'cover_image' => 'images/about_hero.png',
        ]);

        // Quizzes
        $quiz = Quiz::create([
            'title' => 'Kuis Sejarah Singhasari',
            'description' => 'Uji pengetahuanmu tentang sejarah Kerajaan Singhasari.',
            'status' => 'published',
            'image' => 'images/quiz_statue.png',
        ]);

        $q1 = Question::create([
            'quiz_id' => $quiz->id,
            'text' => 'Siapa pendiri Kerajaan Singhasari?',
            'points' => 10,
        ]);
        Choice::create(['question_id' => $q1->id, 'text' => 'Ken Arok', 'is_correct' => true]);
        Choice::create(['question_id' => $q1->id, 'text' => 'Kertanegara', 'is_correct' => false]);
        Choice::create(['question_id' => $q1->id, 'text' => 'Anusapati', 'is_correct' => false]);
        Choice::create(['question_id' => $q1->id, 'text' => 'Tohjaya', 'is_correct' => false]);

        $q2 = Question::create([
            'quiz_id' => $quiz->id,
            'text' => 'Raja terakhir Singhasari adalah?',
            'points' => 10,
        ]);
        Choice::create(['question_id' => $q2->id, 'text' => 'Kertanegara', 'is_correct' => true]);
        Choice::create(['question_id' => $q2->id, 'text' => 'Ranggawuni', 'is_correct' => false]);
        Choice::create(['question_id' => $q2->id, 'text' => 'Jayakatwang', 'is_correct' => false]);
        Choice::create(['question_id' => $q2->id, 'text' => 'Raden Wijaya', 'is_correct' => false]);

        // Stories
        Story::create([
            'title' => 'Cerita Kolektif Dunia',
            'category' => 'Legenda',
            'excerpt' => 'Legenda abadi tentang persatuan, keragaman, dan perjalanan bersama semua makhluk hidup di Bumi.',
            'content' => 'Dahulu kala, bumi dihuni oleh beragam suku dan makhluk hidup yang saling berbagi kebijaksanaan alam. Cerita kolektif ini mengisahkan perjalanan nenek moyang dalam menyatukan visi perdamaian demi melestarikan peradaban Singhasari untuk generasi penerus.',
            'image' => 'images/cerita_card.png',
            'themes' => [
                [
                    'title' => 'Koleksi',
                    'description' => 'Artefak sejarah dari era Kerajaan Singhasari.',
                    'icon' => 'fas fa-map',
                ],
                [
                    'title' => 'Pameran',
                    'description' => 'Pameran permanen dan sementara untuk semua usia.',
                    'icon' => 'fas fa-image',
                ],
                [
                    'title' => 'Edukasi',
                    'description' => 'Program pembelajaran tentang sejarah.',
                    'icon' => 'fas fa-graduation-cap',
                ],
            ],
            'historical_significance' => 'Legenda ini mencerminkan nilai-nilai yang dianut oleh masyarakat Kerajaan Singhasari—kerjasama, rasa hormat, dan keseimbangan. Legenda ini mengajarkan bahwa kemakmuran tidak hanya ditemukan dalam kekuasaan, tetapi dalam harmoni antara manusia, alam, dan jiwa.',
            'did_you_know' => 'Cerita seperti ini diteruskan dari generasi ke generasi melalui tradisi lisan, membentuk kepercayaan, seni, dan kehidupan sehari-hari masyarakat di Jawa kuno.',
        ]);

        Story::create([
            'title' => 'Cerita Ken Dedes',
            'category' => 'Legenda',
            'excerpt' => 'Sebuah kisah tentang pengabdian, cinta, dan takdir.',
            'content' => 'Dahulu kala, di pusat Tumapel (sebelum Kerajaan Singhasari), hiduplah seorang pejuang pemberani bernama Ken Arok. Ambisi dan keberaniannya membawanya untuk...',
            'image' => 'https://images.unsplash.com/photo-1544928147-79a2dbc1f389?w=600&h=400&fit=crop',
            'characters' => [
                [
                    'name' => 'Ken Dedes',
                    'image' => 'https://images.unsplash.com/photo-1544928147-79a2dbc1f389?w=100&h=100&fit=crop',
                ],
                [
                    'name' => 'Tunggul Ametung',
                    'image' => 'https://images.unsplash.com/photo-1518998053401-87891316b25f?w=100&h=100&fit=crop',
                ],
            ],
            'historical_significance' => 'Kisah Ken Arok dan Ken Dedes bukan hanya sebuah roman, tetapi juga simbol dari awal era baru di Jawa Timur. Warisan mereka dikenang sebagai bagian dari fondasi Kerajaan Singhasari yang besar.',
            'did_you_know' => 'Nama "Singhasari" diyakini berasal dari kata "Singa" (singa) dan "Sari" (inti), melambangkan kekuatan dan kebesaran.',
        ]);
    }
}
