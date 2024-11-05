<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return 'It Works!';
});




















// All the weather code to create a gif of the pressure at our location

// // Increase the maximum execution time to 300 seconds (5 minutes)
// ini_set('max_execution_time', 600);

// // Increase the memory limit to 1G
// ini_set('memory_limit', '1G');


// Route::get('/download-images', function () {
//     $date = '09';

//     // make an http request to https://moe.met.fsu.edu/~mnissenbaum/RadarArchive/KTBW/2024/10/10/ and list the files in the directory
//     $url = 'https://moe.met.fsu.edu/~mnissenbaum/RadarArchive/KTBW/2024/10/' . $date . '/';

//     $data = Http::withOptions(['verify' => false])->get($url)->body();

//     $files = [];

//     preg_match_all('/<a href="([^"]+)">([^<]+)<\/a>/', $data, $matches);

//     foreach ($matches[1] as $value) {
//         $files[] = $value;
//     }

//     collect($files)->filter(function ($file) {
//         return strpos($file, '.png') !== false;
//     })->each(function ($file) use ($url, $date) {
//         // download the files to local storage
//         $response = Http::withOptions(['verify' => false])->get($url . $file);

//         // remove 'KTBW' from the file name
//         $fileName = str_replace('KTBW', '', $file);

//         file_put_contents(storage_path('app/weather/' . $date . '/' . $fileName), $response->body());
//     });

//     return 'Files downloaded successfully!';
// });


// make a route that will take an image and put a red dot on the image at a specific x and y coordinate
// Route::get('/add-graphics', function () {

//     // get all the images from the storage folder and put a red dot on the image at a specific x and y coordinate
//     collect(scandir(storage_path('app/weather-red-dot/all-raw/')))->filter(function ($file) {
//         // filter out anything thats not a png file
//         return strpos($file, '.png') !== false;
//     })->each(function ($file) {
//         $image = imagecreatefrompng(storage_path('app/weather-red-dot/all-raw/' . $file));

//         // Ensure the image is in true color mode
//         $trueColorImage = imagecreatetruecolor(imagesx($image), imagesy($image));
//         imagecopy($trueColorImage, $image, 0, 0, 0, 0, imagesx($image), imagesy($image));
//         imagedestroy($image);

//         $text = number_format(round(Pressure::getPressureClosestToTimeStamp(Carbon::parse(str_replace('.png', '', $file)))->millibars, 2), 2, '.', '') . ' mb';
//         $fontSize = 30; // Increased font size for TrueType font
//         $fontPath = storage_path('app/fonts/Arial.ttf'); // Path to the TrueType font file

//         // Calculate the position to place the text in the top left
//         $textBox = imagettfbbox($fontSize, 0, $fontPath, $text);
//         $textWidth = $textBox[2] - $textBox[0];
//         $textHeight = $textBox[1] - $textBox[7];
//         $x = 20; // 10 pixels from the left edge
//         $y = $textHeight + 130; // 10 pixels from the top edge

//         imagettftext($trueColorImage, $fontSize, 0, $x, $y, imagecolorallocate($trueColorImage, 255, 255, 255), $fontPath, $text);

//         // Add a bold red X at a specific x, y coordinate
//         $xCoord = 1240; // Specific X coordinate
//         $yCoord = 844; // Specific Y coordinate
//         $red = imagecolorallocate($trueColorImage, 255, 0, 0);

//         // Draw multiple lines to make the X larger but thinner
//         for ($i = -2; $i <= 5; $i++) {
//             imageline($trueColorImage, $xCoord - 10 + $i, $yCoord - 10, $xCoord + 10 + $i, $yCoord + 10, $red);
//             imageline($trueColorImage, $xCoord + 10 + $i, $yCoord - 10, $xCoord - 10 + $i, $yCoord + 10, $red);
//         }

//         imagepng($trueColorImage, storage_path('app/weather-red-dot/red-dot-and-pressure/' . $file));

//         imagedestroy($trueColorImage);
//     });

//     return 'Image updated successfully!';
// });


// Route::get('/gif', function () {
//     // ffmpeg -framerate 10 -pattern_type glob -i '*.png' -c:v libx264 out.mp4
// });


// Route::get('/inject-data', function () {
//     // get the csv file from the storage folder and inject the data into the database
//     // app/weather/raw_weather_data.csv

//     $data = file_get_contents(storage_path('app/weather/raw_weather_data.csv'));

//     $rows = explode("\n", $data);

//     $header = str_getcsv(array_shift($rows));

//     foreach ($rows as $row) {
//         $row = str_getcsv($row);

//         $data = array_combine($header, $row);

//         // insert the data into the database
//         \App\Models\Pressure::create([
//             'millibars' => $data['pressure'],
//             'measurement_time' => Carbon::parse($data['event_time']),
//         ]);
//     }

//     return 'Files downloaded successfully!';
// });
