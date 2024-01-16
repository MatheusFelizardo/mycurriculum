<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use OpenAI;

class ChatGPTController extends Controller
{
    public function __construct() {
        $this->apiKey = env('OPEN_AI_KEY');
        $this->client = OpenAI::client($this->apiKey);
    }

    public function sendChatGTPText($content)
    {
        
        $result = $this->client->chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'system', 'content'=> "Read the text below carefully and adjust its formatting.
                Unbreakable rules, pay close attention to the rules as well:
                - Keep the original language of the resume. If the copy of the resume is in portuguese, keep it in portuguese, if is in english keep in english, and so on;
                - Personal data (name, phone number, address, email) should come at the beginning of the text;
                - Do not change any words;
                - Where there is a link, use the link text, not the word 'Website' For example, if it is http://mysite.com, do not create a hyperlink to the site; instead, use the text http://mysite.com;
                - Pay extra attention to personal data, it should be at the beginning of the text, before all other information;"],
                ['role' => 'user', 'content' => $content],
            ],
        ]);
        return $result->choices[0]->message->content; 
    }

    public function improveCVWithChatGPT($content, $cvText) {
        $result = $this->client->chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'system', 'content'=> "Observe the job description below: $content
                Follow the following inviolable rules:
                - Improve the resume to attract more attention to the specific position;
                - Do not include the text from the job description in the new resume;
                - Do not include any falsehoods; for example, if the user's experience does not include C#, do not add that experience;
                - Do not add the responsibilities, overview, or qualifications from the job description to the new resume;
                - Do not include any links that do not exist;
                - Add A field Objectives explaining something related to the job description;
                - Make the resume well formated as a professional resume;"],
                ['role' => 'user', 'content' => "$cvText"],
            ],
        ]);

        return $result->choices[0]->message->content;
    }
}

