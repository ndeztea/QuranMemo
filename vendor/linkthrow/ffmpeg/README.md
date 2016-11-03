# FFMPEG (Laravel 5 Package)
[![Latest Stable Version](https://poser.pugx.org/closca/FFMPEG/v/stable.png)](https://packagist.org/packages/linkthrow/ffmpeg)


**** NOTE ****
This is a duplicate of https://github.com/closca/FFMPEG. I have duplicated because the original package was not working with the latest Laravel psr-4 loaders and hasn't been updated for a while!

FFMPEG is a tool designed to leverage the power of **Laravel 5** and **(C library FFMPEG)** to perform tasks such as:

* Audio/Video conversion
* Video thumbnail generation
* Metadata manipulation

## Quick Start

### Setup

Update your `composer.json` file and add the following under the `require` key

	"linkthrow/ffmpeg": "dev-master"

Run the composer update command:

	$ composer update

In your `config/app.php` add `'LinkThrow\Ffmpeg\Provider\FfmpegServiceProvider'` to the end of the `$providers` array

    'providers' => array(

        'Illuminate\Foundation\Providers\ArtisanServiceProvider',
        'Illuminate\Auth\AuthServiceProvider',
        ...
        'LinkThrow\Ffmpeg\Provider\FfmpegServiceProvider',

    ),

Still under `config/app.php` add `'FFMPEG' => 'LinkThrow\Ffmpeg\Facade\FfmpegFacade'` to the `$aliases` array

    'aliases' => array(

        'App'             => 'Illuminate\Support\Facades\App',
        'Artisan'         => 'Illuminate\Support\Facades\Artisan',
        ...
        'FFMPEG'           => 'LinkThrow\Ffmpeg\Facade\FfmpegFacade',

    ),

Run the `artisan` command below to publish the configuration file

	$ php artisan vendor:publish

Navigate to `app/config/ffmpeg.php` and update all four parameters

### Examples

Here is a simple example of a file being converted from FLAC to AAC:

	FFMPEG::convert()->input('foo.flac')->bitrate(128)->output('bar.aac')->go();

FFMPEG can also convert video files:

	FFMPEG::convert()->input('foo.avi')->bitrate(300, 'video')->output('bar.flv')->go();

FFMPEG can also return media information as an array or json

    FFMPEG::getMediaInfo('foo.mov');

FFMPEG can also easily generate smart movie thumbnails like this

    FFMPEG::getThumbnails('foo.mp4', 'foo-thumb', 5); // Yields 5 thumbnails

FFMPEG can also thumbnify your movie (create thumbs for a short preview)

    FFMPEG::thumbnify('foo.mp4', 'foo-thumb', 40, '400'); // Yields 40 thumbnails (every 10 seconds) and video has 400 secs

Although FFMPEG contains several preset parameters, you can also pass your own

	FFMPEG::convert()->input('foo.flac')->output('bar.mp3')->go('-b:a 64k -ac 1');

### Tracking progress

Make sure the `progress` and `tmp_dir` options are set correctly in the config.php file

    'progress'      => true,
    ...
    'tmp_dir'      => '/Applications/ffmpeg/tmp/'

Pass the progress method when initiating a conversion

    FFMPEG::convert()->input('foo.avi')->output('bar.mp3')->progress('uniqueid')->go();

Now you can write a controller action to return the progress for the job id you passed and call it using any flavor of JavaScript you like

    public function getJobProgress($id)
    {
        return FFMPEG::getProgress('uniqueid');
    }


### Security and Compatibility

FFMPEG uses PHP's [shell_exec](http://us3.php.net/shell_exec) function to perform ffmpeg and ffprobe commands. This command is disabled if you are running PHP 5.3 or below and [safe mode](http://us3.php.net/manual/en/features.safe-mode.php) is enabled.

Please make sure that ffmpeg and ffprobe are at least the following versions:

* ffmpeg: 2.1.*
* ffprobe: 2.0.*

Also, remember that filepaths must be relative to the location of FFMPEG on your system. To ensure compatibility, it is good practice to pass the full path of the input and output files. Here's an example working in Laravel:

    $file_in  = Input::file('audio')->getRealPath();
    $file_out = '\path\to\my\file.mp3'; 
    FFMPEG::convert()->input($file_in)->output($file_out)->go();

Lastly, FFMPEG will only convert to formats which ffmpeg supports. To check if your version of ffmpeg is configured to encode or decode a specific format you can run the following commands using `php artisan tinker`

    var_dump(FFMPEG::canEncode('mp3'));
    var_dump(FFMPEG::canDecode('mp3'));

To get a list of all supported formats you can run

    var_dump(FFMPEG::getSupportedFormats());

## Troubleshooting

Please make sure the following statements are true before opening an issue:

1) I am able to access FFMPEG on terminal using the same path I defined in the FFMPEG configuration file

2) I have checked the error logs for the webserver and found no FFMPEG output messages

Usually all concerns are taken care of by following these two steps. If you still find yourself having issues you can always open a trouble ticket.


## License

FFMPEG is free software distributed under the terms of the MIT license.

## Aditional information

Any questions, feel free to contact me.

Any issues, please [report here](https://github.com/closca/FFMPEG/issues)
