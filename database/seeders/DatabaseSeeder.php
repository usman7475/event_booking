<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Event;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create test users
        $user1 = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password')
        ]);

        $user2 = User::factory()->create([
            'name' => 'Event Organizer',
            'email' => 'organizer@example.com',
            'password' => bcrypt('password')
        ]);

        $user3 = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password')
        ]);

        // Create sample events
        Event::create([
            'title' => 'Laravel Development Conference 2026',
            'description' => 'Join us for an amazing Laravel development conference featuring industry experts, hands-on workshops, and networking sessions. Learn about the latest Laravel features and best practices.',
            'location' => 'New York Convention Center',
            'event_datetime' => Carbon::now()->addDays(30)->setTime(9, 0),
            'total_seats' => 500,
            'available_seats' => 450,
            'user_id' => $user2->id,
        ]);

        Event::create([
            'title' => 'Web Design & UX Workshop',
            'description' => 'Comprehensive workshop on modern web design principles and user experience design. Learn to create beautiful, functional interfaces that users love.',
            'location' => 'San Francisco Tech Hub',
            'event_datetime' => Carbon::now()->addDays(15)->setTime(14, 0),
            'total_seats' => 100,
            'available_seats' => 45,
            'user_id' => $user2->id,
        ]);

        Event::create([
            'title' => 'Cloud Computing Fundamentals',
            'description' => 'Learn the fundamentals of cloud computing including AWS, Azure, and Google Cloud. Perfect for developers and IT professionals looking to expand their skills.',
            'location' => 'Seattle Innovation Center',
            'event_datetime' => Carbon::now()->addDays(45)->setTime(10, 0),
            'total_seats' => 200,
            'available_seats' => 200,
            'user_id' => $user3->id,
        ]);

        Event::create([
            'title' => 'JavaScript Advanced Techniques',
            'description' => 'Master advanced JavaScript concepts including closures, prototypes, async/await, and functional programming. Ideal for intermediate developers.',
            'location' => 'Boston Tech Academy',
            'event_datetime' => Carbon::now()->addDays(20)->setTime(13, 0),
            'total_seats' => 150,
            'available_seats' => 25,
            'user_id' => $user2->id,
        ]);

        Event::create([
            'title' => 'Data Science & Machine Learning',
            'description' => 'Dive deep into data science and machine learning with Python. Cover data analysis, visualization, and building predictive models.',
            'location' => 'Austin Data Science Center',
            'event_datetime' => Carbon::now()->addDays(60)->setTime(11, 0),
            'total_seats' => 300,
            'available_seats' => 300,
            'user_id' => $user3->id,
        ]);

        Event::create([
            'title' => 'DevOps & CI/CD Pipeline',
            'description' => 'Learn to automate your development pipeline with Docker, Kubernetes, and CI/CD tools. Essential skills for modern development teams.',
            'location' => 'Chicago Tech Hub',
            'event_datetime' => Carbon::now()->addDays(35)->setTime(15, 30),
            'total_seats' => 120,
            'available_seats' => 0,
            'user_id' => $user2->id,
        ]);

        Event::create([
            'title' => 'Mobile App Development with React Native',
            'description' => 'Build cross-platform mobile applications using React Native. Learn to create iOS and Android apps with a single codebase.',
            'location' => 'Los Angeles Tech Campus',
            'event_datetime' => Carbon::now()->addDays(25)->setTime(9, 30),
            'total_seats' => 80,
            'available_seats' => 80,
            'user_id' => $user3->id,
        ]);

        Event::create([
            'title' => 'Security & Ethical Hacking',
            'description' => 'Comprehensive guide to web security and ethical hacking. Learn to identify vulnerabilities and secure your applications.',
            'location' => 'Washington DC Security Institute',
            'event_datetime' => Carbon::now()->addDays(50)->setTime(10, 0),
            'total_seats' => 100,
            'available_seats' => 50,
            'user_id' => $user2->id,
        ]);
    }
}
