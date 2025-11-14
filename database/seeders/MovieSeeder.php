<?php

namespace Database\Seeders;

use App\Models\Movie;
use Illuminate\Database\Seeder;

class MovieSeeder extends Seeder
{
    public function run(): void
    {
        $movies = [
            [
                'title' => 'Fight Club',
                'genre' => 'Drama',
                'release_date' => '1999-10-15',
                'description' => 'An insomniac and a soap salesman start an underground fight club.',
                'poster' => 'fight-club.jpg',
            ],
            [
                'title'=> 'Inception',
                'genre' => 'Sci-Fi',
                'release_date' => '2010-07-16',
                'description' => 'A thief who steals corporate secrets through dream-sharing technology.',
                'poster' => 'inception.jpg',   
            ],
            [
                'title' => 'Memento',
                'genre' => 'Thriller',
                'release_date' => '2000-09-05',
                'description' => 'A man with short-term memory loss hunts his wife\'s killer.',
                'poster' => 'memento.jpg',
            ],
            [
                'title' => 'Interstellar',
                'genre' => 'Sci-Fi',
                'release_date' => '2014-11-07',
                'description' => 'A team of explorers travel through a wormhole in space.',
                'poster' => 'interstellar.jpg',
            ],
            [
                'title' => 'The Dark Knight',
                'genre' => 'Action',
                'release_date' => '2008-07-18',
                'description' => 'Batman faces the Joker in a battle for Gotham\'s soul.',
                'poster' => 'the-dark-knight.jpg',
            ],
            [
                'title' => 'The Shawshank Redemption',
                'genre' => 'Drama',
                'release_date' => '1994-09-23',
                'description' => 'Two imprisoned men bond over decades, finding redemption.',
                'poster' => 'shawshank-redemption.jpg',
            ],
            [
                'title' => 'Parasite',
                'genre' => 'Thriller',
                'release_date' => '2019-05-30',
                'description' => 'A poor family infiltrates a wealthy household.',
                'poster' => 'parasite.jpg',
            ],
            [
                'title' => 'Pulp Fiction',
                'genre' => 'Crime',
                'release_date' => '1994-10-14',
                'description' => 'Interwoven stories of crime and redemption in LA.',
                'poster' => 'pulp-fiction.jpg',
            ],
            [
                'title' => 'Seven',
                'genre' => 'Thriller',
                'release_date' => '1995-09-22',
                'description' => 'Two detectives hunt a serial killer using the seven deadly sins.',
                'poster' => 'seven.jpg',
            ],
            [
                'title' => 'The Prestige',
                'genre' => 'Drama',
                'release_date' => '2006-10-20',
                'description' => 'Two magicians engage in a battle of obsession and betrayal.',
                'poster' => 'the-prestige.jpg',
            ],
        ];

        foreach ($movies as $movie) {
            Movie::updateOrCreate(
                ['title' => $movie['title']], // Prevent duplicates
                $movie
            );
        }
    }
}