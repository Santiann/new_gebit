<?php
namespace App\Console\Commands;

use Webklex\IMAP\Commands\ImapIdleCommand;
use Webklex\PHPIMAP\Message;

class checarImap extends ImapIdleCommand {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'checar_imap';

    /**
     * Holds the account information
     *
     * @var string|array $account
     */
    protected $account = "default";

    public function handle(){
        $client = \Webklex\IMAP\Facades\Client::account('default');
        $client->connect();
        $folder = $client->getFolder('INBOX');

        $query = $folder->messages()->since(date("d.m.Y"))->unseen();
        $messages = $query->get();
        
        foreach ($messages as $message) {
            event(new \Webklex\IMAP\Events\MessageNewEvent([$message]));
            $message->setFlag('Seen');
        }
    }

}