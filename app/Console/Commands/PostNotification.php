<?php

namespace App\Console\Commands;

use App\Models\Post;
use App\Models\Subscriber;
use App\Notifications\PostPublished;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Notification;
use Symfony\Component\Console\Command\Command as CommandAlias;

class PostNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'post:notify {postId}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notify Subscribers for a post';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $post = Post::find($this->argument('postId'));

        foreach (Subscriber::byWebsite($post->website_id) as $subscriber) {
            Notification::send($subscriber, new PostPublished($post));
        }

        return CommandAlias::SUCCESS;
    }
}
