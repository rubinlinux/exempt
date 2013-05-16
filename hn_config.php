<?
        // ConfigArray
        $CAPTCHA_INIT = array(
            'tempfolder'     => '/data/web/afternet/www/lib/tmp/',      // string: absolute path (with trailing slash!) $
                        'TTF_folder'     => '/data/web/shared/dokuwiki/lib/plugins/exempt/ttf/', // string: absolute path (with trailing s$
                                // mixed (array or string): basename(s) of TrueType-Fontfiles
                        'TTF_RANGE'      => array('rans.ttf','b5.ttf', '215000EURO.ttf', 'NeoPrintM319.ttf', 'laundromat_1967.ttf', ' waltographUI.ttf'),
                //      'TTF_RANGE'      => 'rans.ttf',

            'chars'          => 6,       // integer: number of chars to use for ID
            'minsize'        => 20,      // integer: minimal size of chars
            'maxsize'        => 30,      // integer: maximal size of chars
            'maxrotation'    => 25,      // integer: define the maximal angle for char-rotation, good results are between 0 $

            'noise'          => TRUE,    // boolean: TRUE = noisy chars | FALSE = grid
            'websafecolors'  => FALSE,   // boolean
            'refreshlink'    => TRUE,    // boolean
            'lang'           => 'en',    // string:  ['en'|'de']
            'maxtry'         => 3,       // integer: [1-9]

            'badguys_url'    => '/',     // string: URL
            'secretstring'   => 'har har har har!',
            'secretposition' => 24,      // integer: [1-32]

            'debug'          => FALSE,

                        'counter_filename'              => '',              // string: absolute filename for textfile which $
                        'prefix'                                => 'hn_captcha_',   // string: prefix for the captcha-images$
                        'collect_garbage_after' => 20,             // integer: the garbage-collector run once after this num$
                        'maxlifetime'                   => 60              // integer: only imagefiles which are older than $

        );

?>
