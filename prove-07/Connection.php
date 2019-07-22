<?php

/**
 * Created by IntelliJ IDEA.
 * User: cameronlewis
 * Date: 2/15/17
 * Time: 10:26 PM
 */
require "../../../vendor/autoload.php";
use Abraham\TwitterOAuth\TwitterOAuth;

# Imports the Google Cloud client library
use Google\Cloud\NaturalLanguage\NaturalLanguageClient;

class Connection
{
    private $dbUrl;
    private $dbopts;
    private $host;
    private $port;
    private $user;
    private $pass;
    private $db;
    private $connection;

    private $consumer_key;
    private $consumer_secret;
    private $access_token;
    private $access_token_secret;

    function __construct()
    {
        # variables needed to connect to Heroku Postgres database
        $this->dbUrl = getenv('HEROKU_POSTGRESQL_ORANGE_URL');
        $this->dbopts = parse_url($this->dbUrl);
        $this->host = $this->dbopts["host"];
        $this->port = $this->dbopts["port"];
        $this->user = $this->dbopts["user"];
        $this->pass = $this->dbopts["pass"];
        $this->db = ltrim($this->dbopts["path"], '/');
        $this->connection = null;

        # variables needed to connect to Twitter APIs
        $this->consumer_key = getenv('CONSUMER_KEY');
        $this->consumer_secret = getenv('CONSUMER_SECRET');
        $this->access_token = getenv('ACCESS_TOKEN');
        $this->access_token_secret = getenv('ACCESS_TOKEN_SECRET');
    }

    function connectHeroku()
    {
        # Connect to Heroku Postgres database
        $this->connection = pg_connect("host=$this->host port=$this->port 
        dbname=$this->db user=$this->user password=$this->pass sslmode=require");

        return $this->connection;
    }

    function connectTwitter(){
        return $twitter_connection = new TwitterOAuth($this->consumer_key,
            $this->consumer_secret,
            $this->access_token, $this->access_token_secret);
        # Make sure Twitter credentials worked
        //$content = $twitter_connection->get("account/verify_credentials");
    }

    function connectGoogleCloud(){
        $projectId = 'cs313-project';
        # Analyze sentiment now
        putenv('GOOGLE_APPLICATION_CREDENTIALS=service-account-credentials.json');

        return $language = new NaturalLanguageClient();
    }

};