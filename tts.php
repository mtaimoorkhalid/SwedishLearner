<?php
// tts.php - A simple proxy to fetch Google TTS audio
if (isset($_GET['q'])) {
    $text = urlencode($_GET['q']);
    // This is the Google TTS URL
    $url = "https://translate.google.com/translate_tts?ie=UTF-8&client=tw-ob&tl=sv&q=" . $text;

    // Initialize cURL (This allows your server to download the file)
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    // FAKE USER AGENT: This tricks Google into thinking we are a browser
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36");
    
    $audio = curl_exec($ch);
    curl_close($ch);

    // Send the audio back to your website
    header('Content-Type: audio/mpeg');
    echo $audio;
}
?>