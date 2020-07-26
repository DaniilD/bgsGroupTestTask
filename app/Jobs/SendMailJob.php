<?php


namespace App\Jobs;




class SendMailJob extends Job
{
    protected $mailTo;
    protected $mailFrom;
    protected $text;

    public function __construct($mailTo, $mailFrom, $text)
    {
        $this->mailFrom = $mailFrom;
        $this->mailTo = $mailTo;
        $this->text = $text;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        info($this->text);
    }
}
