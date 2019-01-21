<?php

use yii\db\Schema;
use yii\db\Migration;

class m190121_170751_language_insert extends Migration
{

    public function init()
    {
        $this->db = 'db';
        parent::init();
    }

    public function safeUp()
    {
        $this->batchInsert('{{%language}}',
                           ["code", "name", "local_name"],
                            [
    [
        'code' => 'af',
        'name' => 'Afrikaans',
        'local_name' => 'Afrikaans',
    ],
    [
        'code' => 'af-ZA',
        'name' => 'Afrikaans (South Africa)',
        'local_name' => 'Afrikaans (Suid Afrika)',
    ],
    [
        'code' => 'am-ET',
        'name' => 'Amharic (Ethiopia)',
        'local_name' => 'አማርኛ (ኢትዮጵያ)',
    ],
    [
        'code' => 'ar',
        'name' => 'Arabic',
        'local_name' => 'العربية',
    ],
    [
        'code' => 'ar-AE',
        'name' => 'Arabic (U.A.E.)',
        'local_name' => 'العربية (الإمارات العربية المتحدة)',
    ],
    [
        'code' => 'ar-BH',
        'name' => 'Arabic (Bahrain)',
        'local_name' => 'العربية (البحرين)',
    ],
    [
        'code' => 'ar-DZ',
        'name' => 'Arabic (Algeria)',
        'local_name' => 'العربية (الجزائر)',
    ],
    [
        'code' => 'ar-EG',
        'name' => 'Arabic (Egypt)',
        'local_name' => 'العربية (مصر)',
    ],
    [
        'code' => 'ar-IQ',
        'name' => 'Arabic (Iraq)',
        'local_name' => 'العربية (العراق)',
    ],
    [
        'code' => 'ar-JO',
        'name' => 'Arabic (Jordan)',
        'local_name' => 'العربية (الأردن)',
    ],
    [
        'code' => 'ar-KW',
        'name' => 'Arabic (Kuwait)',
        'local_name' => 'العربية (الكويت)',
    ],
    [
        'code' => 'ar-LB',
        'name' => 'Arabic (Lebanon)',
        'local_name' => 'العربية (لبنان)',
    ],
    [
        'code' => 'ar-LY',
        'name' => 'Arabic (Libya)',
        'local_name' => 'العربية (ليبيا)',
    ],
    [
        'code' => 'ar-MA',
        'name' => 'Arabic (Morocco)',
        'local_name' => 'العربية (المملكة المغربية)',
    ],
    [
        'code' => 'ar-OM',
        'name' => 'Arabic (Oman)',
        'local_name' => 'العربية (عمان)',
    ],
    [
        'code' => 'ar-QA',
        'name' => 'Arabic (Qatar)',
        'local_name' => 'العربية (قطر)',
    ],
    [
        'code' => 'ar-SA',
        'name' => 'Arabic (Saudi Arabia)',
        'local_name' => 'العربية (المملكة العربية السعودية)',
    ],
    [
        'code' => 'ar-SY',
        'name' => 'Arabic (Syria)',
        'local_name' => 'العربية (سوريا)',
    ],
    [
        'code' => 'ar-TN',
        'name' => 'Arabic (Tunisia)',
        'local_name' => 'العربية (تونس)',
    ],
    [
        'code' => 'ar-YE',
        'name' => 'Arabic (Yemen)',
        'local_name' => 'العربية (اليمن)',
    ],
    [
        'code' => 'arn-CL',
        'name' => 'Mapudungun (Chile)',
        'local_name' => 'Mapudungun (Chile)',
    ],
    [
        'code' => 'as-IN',
        'name' => 'Assamese (India)',
        'local_name' => 'অসমীয়া (ভাৰত)',
    ],
    [
        'code' => 'az',
        'name' => 'Azeri',
        'local_name' => 'Azərbaycan­ılı',
    ],
    [
        'code' => 'az-Cyrl-AZ',
        'name' => 'Azeri (Cyrillic, Azerbaijan)',
        'local_name' => 'Азәрбајҹан (Азәрбајҹан)',
    ],
    [
        'code' => 'az-Latn-AZ',
        'name' => 'Azeri (Latin, Azerbaijan)',
        'local_name' => 'Azərbaycan­ılı (Azərbaycanca)',
    ],
    [
        'code' => 'ba-RU',
        'name' => 'Bashkir (Russia)',
        'local_name' => 'Башҡорт (Россия)',
    ],
    [
        'code' => 'be',
        'name' => 'Belarusian',
        'local_name' => 'Беларускі',
    ],
    [
        'code' => 'be-BY',
        'name' => 'Belarusian (Belarus)',
        'local_name' => 'Беларускі (Беларусь)',
    ],
    [
        'code' => 'bg',
        'name' => 'Bulgarian',
        'local_name' => 'български',
    ],
    [
        'code' => 'bg-BG',
        'name' => 'Bulgarian (Bulgaria)',
        'local_name' => 'български (България)',
    ],
    [
        'code' => 'bn-BD',
        'name' => 'Bengali (Bangladesh)',
        'local_name' => 'বাংলা (বাংলাদেশ)',
    ],
    [
        'code' => 'bn-IN',
        'name' => 'Bengali (India)',
        'local_name' => 'বাংলা (ভারত)',
    ],
    [
        'code' => 'bo-CN',
        'name' => 'Tibetan (People\'s Republic of China)',
        'local_name' => 'བོད་ཡིག (ཀྲུང་ཧྭ་མི་དམངས་སྤྱི་མཐུན་རྒྱལ་ཁབ།)',
    ],
    [
        'code' => 'br-FR',
        'name' => 'Breton (France)',
        'local_name' => 'brezhoneg (Frañs)',
    ],
    [
        'code' => 'bs-Cyrl-BA',
        'name' => 'Bosnian (Cyrillic) (Bosnia and Herzegovina)',
        'local_name' => 'босански (Босна и Херцеговина)',
    ],
    [
        'code' => 'bs-Latn-BA',
        'name' => 'Bosnian (Latin) (Bosnia and Herzegovina)',
        'local_name' => 'bosanski (Bosna i Hercegovina)',
    ],
    [
        'code' => 'ca',
        'name' => 'Catalan',
        'local_name' => 'català',
    ],
    [
        'code' => 'ca-ES',
        'name' => 'Catalan (Catalan)',
        'local_name' => 'català (català)',
    ],
    [
        'code' => 'co-FR',
        'name' => 'Corsican (France)',
        'local_name' => 'Corsu (France)',
    ],
    [
        'code' => 'cs',
        'name' => 'Czech',
        'local_name' => 'čeština',
    ],
    [
        'code' => 'cs-CZ',
        'name' => 'Czech (Czech Republic)',
        'local_name' => 'čeština (Česká republika)',
    ],
    [
        'code' => 'cy-GB',
        'name' => 'Welsh (United Kingdom)',
        'local_name' => 'Cymraeg (y Deyrnas Unedig)',
    ],
    [
        'code' => 'da',
        'name' => 'Danish',
        'local_name' => 'dansk',
    ],
    [
        'code' => 'da-DK',
        'name' => 'Danish (Denmark)',
        'local_name' => 'dansk (Danmark)',
    ],
    [
        'code' => 'de',
        'name' => 'German',
        'local_name' => 'Deutsch',
    ],
    [
        'code' => 'de-AT',
        'name' => 'German (Austria)',
        'local_name' => 'Deutsch (Österreich)',
    ],
    [
        'code' => 'de-CH',
        'name' => 'German (Switzerland)',
        'local_name' => 'Deutsch (Schweiz)',
    ],
    [
        'code' => 'de-DE',
        'name' => 'German (Germany)',
        'local_name' => 'Deutsch (Deutschland)',
    ],
    [
        'code' => 'de-LI',
        'name' => 'German (Liechtenstein)',
        'local_name' => 'Deutsch (Liechtenstein)',
    ],
    [
        'code' => 'de-LU',
        'name' => 'German (Luxembourg)',
        'local_name' => 'Deutsch (Luxemburg)',
    ],
    [
        'code' => 'dsb-DE',
        'name' => 'Lower Sorbian (Germany)',
        'local_name' => 'dolnoserbšćina (Nimska)',
    ],
    [
        'code' => 'dv',
        'name' => 'Divehi',
        'local_name' => 'ދިވެހިބަސް',
    ],
    [
        'code' => 'dv-MV',
        'name' => 'Divehi (Maldives)',
        'local_name' => 'ދިވެހިބަސް (ދިވެހި ރާއްޖެ)',
    ],
    [
        'code' => 'el',
        'name' => 'Greek',
        'local_name' => 'ελληνικά',
    ],
    [
        'code' => 'el-GR',
        'name' => 'Greek (Greece)',
        'local_name' => 'ελληνικά (Ελλάδα)',
    ],
    [
        'code' => 'en',
        'name' => 'English',
        'local_name' => 'English',
    ],
    [
        'code' => 'en-029',
        'name' => 'English (Caribbean)',
        'local_name' => 'English (Caribbean)',
    ],
    [
        'code' => 'en-AU',
        'name' => 'English (Australia)',
        'local_name' => 'English (Australia)',
    ],
    [
        'code' => 'en-BZ',
        'name' => 'English (Belize)',
        'local_name' => 'English (Belize)',
    ],
    [
        'code' => 'en-CA',
        'name' => 'English (Canada)',
        'local_name' => 'English (Canada)',
    ],
    [
        'code' => 'en-GB',
        'name' => 'English (United Kingdom)',
        'local_name' => 'English (United Kingdom)',
    ],
    [
        'code' => 'en-IE',
        'name' => 'English (Ireland)',
        'local_name' => 'English (Eire)',
    ],
    [
        'code' => 'en-IN',
        'name' => 'English (India)',
        'local_name' => 'English (India)',
    ],
    [
        'code' => 'en-JM',
        'name' => 'English (Jamaica)',
        'local_name' => 'English (Jamaica)',
    ],
    [
        'code' => 'en-MY',
        'name' => 'English (Malaysia)',
        'local_name' => 'English (Malaysia)',
    ],
    [
        'code' => 'en-NZ',
        'name' => 'English (New Zealand)',
        'local_name' => 'English (New Zealand)',
    ],
    [
        'code' => 'en-PH',
        'name' => 'English (Republic of the Philippines)',
        'local_name' => 'English (Philippines)',
    ],
    [
        'code' => 'en-SG',
        'name' => 'English (Singapore)',
        'local_name' => 'English (Singapore)',
    ],
    [
        'code' => 'en-TT',
        'name' => 'English (Trinidad and Tobago)',
        'local_name' => 'English (Trinidad y Tobago)',
    ],
    [
        'code' => 'en-US',
        'name' => 'English (United States)',
        'local_name' => 'English (United States)',
    ],
    [
        'code' => 'en-ZA',
        'name' => 'English (South Africa)',
        'local_name' => 'English (South Africa)',
    ],
    [
        'code' => 'en-ZW',
        'name' => 'English (Zimbabwe)',
        'local_name' => 'English (Zimbabwe)',
    ],
    [
        'code' => 'es',
        'name' => 'Spanish',
        'local_name' => 'español',
    ],
    [
        'code' => 'es-AR',
        'name' => 'Spanish (Argentina)',
        'local_name' => 'Español (Argentina)',
    ],
    [
        'code' => 'es-BO',
        'name' => 'Spanish (Bolivia)',
        'local_name' => 'Español (Bolivia)',
    ],
    [
        'code' => 'es-CL',
        'name' => 'Spanish (Chile)',
        'local_name' => 'Español (Chile)',
    ],
    [
        'code' => 'es-CO',
        'name' => 'Spanish (Colombia)',
        'local_name' => 'Español (Colombia)',
    ],
    [
        'code' => 'es-CR',
        'name' => 'Spanish (Costa Rica)',
        'local_name' => 'Español (Costa Rica)',
    ],
    [
        'code' => 'es-DO',
        'name' => 'Spanish (Dominican Republic)',
        'local_name' => 'Español (República Dominicana)',
    ],
    [
        'code' => 'es-EC',
        'name' => 'Spanish (Ecuador)',
        'local_name' => 'Español (Ecuador)',
    ],
    [
        'code' => 'es-ES',
        'name' => 'Spanish (Spain)',
        'local_name' => 'español (España)',
    ],
    [
        'code' => 'es-GT',
        'name' => 'Spanish (Guatemala)',
        'local_name' => 'Español (Guatemala)',
    ],
    [
        'code' => 'es-HN',
        'name' => 'Spanish (Honduras)',
        'local_name' => 'Español (Honduras)',
    ],
    [
        'code' => 'es-MX',
        'name' => 'Spanish (Mexico)',
        'local_name' => 'Español (México)',
    ],
    [
        'code' => 'es-NI',
        'name' => 'Spanish (Nicaragua)',
        'local_name' => 'Español (Nicaragua)',
    ],
    [
        'code' => 'es-PA',
        'name' => 'Spanish (Panama)',
        'local_name' => 'Español (Panamá)',
    ],
    [
        'code' => 'es-PE',
        'name' => 'Spanish (Peru)',
        'local_name' => 'Español (Perú)',
    ],
    [
        'code' => 'es-PR',
        'name' => 'Spanish (Puerto Rico)',
        'local_name' => 'Español (Puerto Rico)',
    ],
    [
        'code' => 'es-PY',
        'name' => 'Spanish (Paraguay)',
        'local_name' => 'Español (Paraguay)',
    ],
    [
        'code' => 'es-SV',
        'name' => 'Spanish (El Salvador)',
        'local_name' => 'Español (El Salvador)',
    ],
    [
        'code' => 'es-US',
        'name' => 'Spanish (United States)',
        'local_name' => 'Español (Estados Unidos)',
    ],
    [
        'code' => 'es-UY',
        'name' => 'Spanish (Uruguay)',
        'local_name' => 'Español (Uruguay)',
    ],
    [
        'code' => 'es-VE',
        'name' => 'Spanish (Venezuela)',
        'local_name' => 'Español (Republica Bolivariana de Venezuela)',
    ],
    [
        'code' => 'et',
        'name' => 'Estonian',
        'local_name' => 'eesti',
    ],
    [
        'code' => 'et-EE',
        'name' => 'Estonian (Estonia)',
        'local_name' => 'eesti (Eesti)',
    ],
    [
        'code' => 'eu',
        'name' => 'Basque',
        'local_name' => 'euskara',
    ],
    [
        'code' => 'eu-ES',
        'name' => 'Basque (Basque)',
        'local_name' => 'euskara (euskara)',
    ],
    [
        'code' => 'fa',
        'name' => 'Persian',
        'local_name' => 'فارسى',
    ],
    [
        'code' => 'fa-IR',
        'name' => 'Persian (Iran)',
        'local_name' => 'فارسى (ايران)',
    ],
    [
        'code' => 'fi',
        'name' => 'Finnish',
        'local_name' => 'suomi',
    ],
    [
        'code' => 'fi-FI',
        'name' => 'Finnish (Finland)',
        'local_name' => 'suomi (Suomi)',
    ],
    [
        'code' => 'fil-PH',
        'name' => 'Filipino (Philippines)',
        'local_name' => 'Filipino (Pilipinas)',
    ],
    [
        'code' => 'fo',
        'name' => 'Faroese',
        'local_name' => 'føroyskt',
    ],
    [
        'code' => 'fo-FO',
        'name' => 'Faroese (Faroe Islands)',
        'local_name' => 'føroyskt (Føroyar)',
    ],
    [
        'code' => 'fr',
        'name' => 'French',
        'local_name' => 'français',
    ],
    [
        'code' => 'fr-BE',
        'name' => 'French (Belgium)',
        'local_name' => 'français (Belgique)',
    ],
    [
        'code' => 'fr-CA',
        'name' => 'French (Canada)',
        'local_name' => 'français (Canada)',
    ],
    [
        'code' => 'fr-CH',
        'name' => 'French (Switzerland)',
        'local_name' => 'français (Suisse)',
    ],
    [
        'code' => 'fr-FR',
        'name' => 'French (France)',
        'local_name' => 'français (France)',
    ],
    [
        'code' => 'fr-LU',
        'name' => 'French (Luxembourg)',
        'local_name' => 'français (Luxembourg)',
    ],
    [
        'code' => 'fr-MC',
        'name' => 'French (Principality of Monaco)',
        'local_name' => 'français (Principauté de Monaco)',
    ],
    [
        'code' => 'fy-NL',
        'name' => 'Frisian (Netherlands)',
        'local_name' => 'Frysk (Nederlân)',
    ],
    [
        'code' => 'ga-IE',
        'name' => 'Irish (Ireland)',
        'local_name' => 'Gaeilge (Éire)',
    ],
    [
        'code' => 'gl',
        'name' => 'Galician',
        'local_name' => 'galego',
    ],
    [
        'code' => 'gl-ES',
        'name' => 'Galician (Galician)',
        'local_name' => 'galego (galego)',
    ],
    [
        'code' => 'gsw-FR',
        'name' => 'Alsatian (France)',
        'local_name' => 'Elsässisch (Frànkrisch)',
    ],
    [
        'code' => 'gu',
        'name' => 'Gujarati',
        'local_name' => 'ગુજરાતી',
    ],
    [
        'code' => 'gu-IN',
        'name' => 'Gujarati (India)',
        'local_name' => 'ગુજરાતી (ભારત)',
    ],
    [
        'code' => 'ha-Latn-NG',
        'name' => 'Hausa (Latin) (Nigeria)',
        'local_name' => 'Hausa (Nigeria)',
    ],
    [
        'code' => 'he',
        'name' => 'Hebrew',
        'local_name' => 'עברית',
    ],
    [
        'code' => 'he-IL',
        'name' => 'Hebrew (Israel)',
        'local_name' => 'עברית (ישראל)',
    ],
    [
        'code' => 'hi',
        'name' => 'Hindi',
        'local_name' => 'हिंदी',
    ],
    [
        'code' => 'hi-IN',
        'name' => 'Hindi (India)',
        'local_name' => 'हिंदी (भारत)',
    ],
    [
        'code' => 'hr',
        'name' => 'Croatian',
        'local_name' => 'hrvatski',
    ],
    [
        'code' => 'hr-BA',
        'name' => 'Croatian (Latin) (Bosnia and Herzegovina)',
        'local_name' => 'hrvatski (Bosna i Hercegovina)',
    ],
    [
        'code' => 'hr-HR',
        'name' => 'Croatian (Croatia)',
        'local_name' => 'hrvatski (Hrvatska)',
    ],
    [
        'code' => 'hsb-DE',
        'name' => 'Upper Sorbian (Germany)',
        'local_name' => 'hornjoserbšćina (Němska)',
    ],
    [
        'code' => 'hu',
        'name' => 'Hungarian',
        'local_name' => 'magyar',
    ],
    [
        'code' => 'hu-HU',
        'name' => 'Hungarian (Hungary)',
        'local_name' => 'magyar (Magyarország)',
    ],
    [
        'code' => 'hy',
        'name' => 'Armenian',
        'local_name' => 'Հայերեն',
    ],
    [
        'code' => 'hy-AM',
        'name' => 'Armenian (Armenia)',
        'local_name' => 'Հայերեն (Հայաստան)',
    ],
    [
        'code' => 'id',
        'name' => 'Indonesian',
        'local_name' => 'Bahasa Indonesia',
    ],
    [
        'code' => 'id-ID',
        'name' => 'Indonesian (Indonesia)',
        'local_name' => 'Bahasa Indonesia (Indonesia)',
    ],
    [
        'code' => 'ig-NG',
        'name' => 'Igbo (Nigeria)',
        'local_name' => 'Igbo (Nigeria)',
    ],
    [
        'code' => 'ii-CN',
        'name' => 'Yi (People\'s Republic of China)',
        'local_name' => 'ꆈꌠꁱꂷ (ꍏꉸꏓꂱꇭꉼꇩ)',
    ],
    [
        'code' => 'is',
        'name' => 'Icelandic',
        'local_name' => 'íslenska',
    ],
    [
        'code' => 'is-IS',
        'name' => 'Icelandic (Iceland)',
        'local_name' => 'íslenska (Ísland)',
    ],
    [
        'code' => 'it',
        'name' => 'Italian',
        'local_name' => 'italiano',
    ],
    [
        'code' => 'it-CH',
        'name' => 'Italian (Switzerland)',
        'local_name' => 'italiano (Svizzera)',
    ],
    [
        'code' => 'it-IT',
        'name' => 'Italian (Italy)',
        'local_name' => 'italiano (Italia)',
    ],
    [
        'code' => 'iu-Cans-CA',
        'name' => 'Inuktitut (Canada)',
        'local_name' => 'ᐃᓄᒃᑎᑐᑦ (ᑲᓇᑕ)',
    ],
    [
        'code' => 'iu-Latn-CA',
        'name' => 'Inuktitut (Latin) (Canada)',
        'local_name' => 'Inuktitut (Kanatami) (kanata)',
    ],
    [
        'code' => 'ja',
        'name' => 'Japanese',
        'local_name' => '日本語',
    ],
    [
        'code' => 'ja-JP',
        'name' => 'Japanese (Japan)',
        'local_name' => '日本語 (日本)',
    ],
    [
        'code' => 'ka',
        'name' => 'Georgian',
        'local_name' => 'ქართული',
    ],
    [
        'code' => 'ka-GE',
        'name' => 'Georgian (Georgia)',
        'local_name' => 'ქართული (საქართველო)',
    ],
    [
        'code' => 'kk',
        'name' => 'Kazakh',
        'local_name' => 'Қазащb',
    ],
    [
        'code' => 'kk-KZ',
        'name' => 'Kazakh (Kazakhstan)',
        'local_name' => 'Қазақ (Қазақстан)',
    ],
    [
        'code' => 'kl-GL',
        'name' => 'Greenlandic (Greenland)',
        'local_name' => 'kalaallisut (Kalaallit Nunaat)',
    ],
    [
        'code' => 'km-KH',
        'name' => 'Khmer (Cambodia)',
        'local_name' => 'ខ្មែរ (កម្ពុជា)',
    ],
    [
        'code' => 'kn',
        'name' => 'Kannada',
        'local_name' => 'ಕನ್ನಡ',
    ],
    [
        'code' => 'kn-IN',
        'name' => 'Kannada (India)',
        'local_name' => 'ಕನ್ನಡ (ಭಾರತ)',
    ],
    [
        'code' => 'ko',
        'name' => 'Korean',
        'local_name' => '한국어',
    ],
    [
        'code' => 'ko-KR',
        'name' => 'Korean (Korea)',
        'local_name' => '한국어 (대한민국)',
    ],
    [
        'code' => 'kok',
        'name' => 'Konkani',
        'local_name' => 'कोंकणी',
    ],
    [
        'code' => 'kok-IN',
        'name' => 'Konkani (India)',
        'local_name' => 'कोंकणी (भारत)',
    ],
    [
        'code' => 'ky',
        'name' => 'Kyrgyz',
        'local_name' => 'Кыргыз',
    ],
    [
        'code' => 'ky-KG',
        'name' => 'Kyrgyz (Kyrgyzstan)',
        'local_name' => 'Кыргыз (Кыргызстан)',
    ],
    [
        'code' => 'lb-LU',
        'name' => 'Luxembourgish (Luxembourg)',
        'local_name' => 'Lëtzebuergesch (Luxembourg)',
    ],
    [
        'code' => 'lo-LA',
        'name' => 'Lao (Lao P.D.R.)',
        'local_name' => 'ລາວ (ສ.ປ.ປ. ລາວ)',
    ],
    [
        'code' => 'lt',
        'name' => 'Lithuanian',
        'local_name' => 'lietuvių',
    ],
    [
        'code' => 'lt-LT',
        'name' => 'Lithuanian (Lithuania)',
        'local_name' => 'lietuvių (Lietuva)',
    ],
    [
        'code' => 'lv',
        'name' => 'Latvian',
        'local_name' => 'latviešu',
    ],
    [
        'code' => 'lv-LV',
        'name' => 'Latvian (Latvia)',
        'local_name' => 'latviešu (Latvija)',
    ],
    [
        'code' => 'mi-NZ',
        'name' => 'Maori (New Zealand)',
        'local_name' => 'Reo Māori (Aotearoa)',
    ],
    [
        'code' => 'mk',
        'name' => 'Macedonian',
        'local_name' => 'македонски јазик',
    ],
    [
        'code' => 'mk-MK',
        'name' => 'Macedonian (Former Yugoslav Republic of Macedonia)',
        'local_name' => 'македонски јазик (Македонија)',
    ],
    [
        'code' => 'ml-IN',
        'name' => 'Malayalam (India)',
        'local_name' => 'മലയാളം (ഭാരതം)',
    ],
    [
        'code' => 'mn',
        'name' => 'Mongolian',
        'local_name' => 'Монгол хэл',
    ],
    [
        'code' => 'mn-MN',
        'name' => 'Mongolian (Cyrillic, Mongolia)',
        'local_name' => 'Монгол хэл (Монгол улс)',
    ],
    [
        'code' => 'mn-Mong-CN',
        'name' => 'Mongolian (Traditional Mongolian) (People\'s Republic of China)',
        'local_name' => 'ᠮᠤᠨᠭᠭᠤᠯ ᠬᠡᠯᠡ (ᠪᠦᠭᠦᠳᠡ ᠨᠠᠢᠷᠠᠮᠳᠠᠬᠤ ᠳᠤᠮᠳᠠᠳᠤ ᠠᠷᠠᠳ ᠣᠯᠣᠰ)',
    ],
    [
        'code' => 'moh-CA',
        'name' => 'Mohawk (Canada)',
        'local_name' => 'Kanien\'kéha (Canada)',
    ],
    [
        'code' => 'mr',
        'name' => 'Marathi',
        'local_name' => 'मराठी',
    ],
    [
        'code' => 'mr-IN',
        'name' => 'Marathi (India)',
        'local_name' => 'मराठी (भारत)',
    ],
    [
        'code' => 'ms',
        'name' => 'Malay',
        'local_name' => 'Bahasa Malaysia',
    ],
    [
        'code' => 'ms-BN',
        'name' => 'Malay (Brunei Darussalam)',
        'local_name' => 'Bahasa Malaysia (Brunei Darussalam)',
    ],
    [
        'code' => 'ms-MY',
        'name' => 'Malay (Malaysia)',
        'local_name' => 'Bahasa Malaysia (Malaysia)',
    ],
    [
        'code' => 'mt-MT',
        'name' => 'Maltese (Malta)',
        'local_name' => 'Malti (Malta)',
    ],
    [
        'code' => 'nb-NO',
        'name' => 'Norwegian, Bokmål (Norway)',
        'local_name' => 'norsk, bokmål (Norge)',
    ],
    [
        'code' => 'ne-NP',
        'name' => 'Nepali (Nepal)',
        'local_name' => 'नेपाली (नेपाल)',
    ],
    [
        'code' => 'nl',
        'name' => 'Dutch',
        'local_name' => 'Nederlands',
    ],
    [
        'code' => 'nl-BE',
        'name' => 'Dutch (Belgium)',
        'local_name' => 'Nederlands (België)',
    ],
    [
        'code' => 'nl-NL',
        'name' => 'Dutch (Netherlands)',
        'local_name' => 'Nederlands (Nederland)',
    ],
    [
        'code' => 'nn-NO',
        'name' => 'Norwegian, Nynorsk (Norway)',
        'local_name' => 'norsk, nynorsk (Noreg)',
    ],
    [
        'code' => 'no',
        'name' => 'Norwegian',
        'local_name' => 'norsk',
    ],
    [
        'code' => 'nso-ZA',
        'name' => 'Sesotho sa Leboa (South Africa)',
        'local_name' => 'Sesotho sa Leboa (Afrika Borwa)',
    ],
    [
        'code' => 'oc-FR',
        'name' => 'Occitan (France)',
        'local_name' => 'Occitan (França)',
    ],
    [
        'code' => 'or-IN',
        'name' => 'Oriya (India)',
        'local_name' => 'ଓଡ଼ିଆ (ଭାରତ)',
    ],
    [
        'code' => 'pa',
        'name' => 'Punjabi',
        'local_name' => 'ਪੰਜਾਬੀ',
    ],
    [
        'code' => 'pa-IN',
        'name' => 'Punjabi (India)',
        'local_name' => 'ਪੰਜਾਬੀ (ਭਾਰਤ)',
    ],
    [
        'code' => 'pl',
        'name' => 'Polish',
        'local_name' => 'polski',
    ],
    [
        'code' => 'pl-PL',
        'name' => 'Polish (Poland)',
        'local_name' => 'polski (Polska)',
    ],
    [
        'code' => 'prs-AF',
        'name' => 'Dari (Afghanistan)',
        'local_name' => 'درى (افغانستان)',
    ],
    [
        'code' => 'ps-AF',
        'name' => 'Pashto (Afghanistan)',
        'local_name' => 'پښتو (افغانستان)',
    ],
    [
        'code' => 'pt',
        'name' => 'Portuguese',
        'local_name' => 'Português',
    ],
    [
        'code' => 'pt-BR',
        'name' => 'Portuguese (Brazil)',
        'local_name' => 'Português (Brasil)',
    ],
    [
        'code' => 'pt-PT',
        'name' => 'Portuguese (Portugal)',
        'local_name' => 'português (Portugal)',
    ],
    [
        'code' => 'qut-GT',
        'name' => 'K\'iche (Guatemala)',
        'local_name' => 'K\'iche (Guatemala)',
    ],
    [
        'code' => 'quz-BO',
        'name' => 'Quechua (Bolivia)',
        'local_name' => 'runasimi (Bolivia Suyu)',
    ],
    [
        'code' => 'quz-EC',
        'name' => 'Quechua (Ecuador)',
        'local_name' => 'runasimi (Ecuador Suyu)',
    ],
    [
        'code' => 'quz-PE',
        'name' => 'Quechua (Peru)',
        'local_name' => 'runasimi (Peru Suyu)',
    ],
    [
        'code' => 'rm-CH',
        'name' => 'Romansh (Switzerland)',
        'local_name' => 'Rumantsch (Svizra)',
    ],
    [
        'code' => 'ro',
        'name' => 'Romanian',
        'local_name' => 'română',
    ],
    [
        'code' => 'ro-RO',
        'name' => 'Romanian (Romania)',
        'local_name' => 'română (România)',
    ],
    [
        'code' => 'ru',
        'name' => 'Russian',
        'local_name' => 'русский',
    ],
    [
        'code' => 'ru-RU',
        'name' => 'Russian (Russia)',
        'local_name' => 'русский (Россия)',
    ],
    [
        'code' => 'rw-RW',
        'name' => 'Kinyarwanda (Rwanda)',
        'local_name' => 'Kinyarwanda (Rwanda)',
    ],
    [
        'code' => 'sa',
        'name' => 'Sanskrit',
        'local_name' => 'संस्कृत',
    ],
    [
        'code' => 'sa-IN',
        'name' => 'Sanskrit (India)',
        'local_name' => 'संस्कृत (भारतम्)',
    ],
    [
        'code' => 'sah-RU',
        'name' => 'Yakut (Russia)',
        'local_name' => 'саха (Россия)',
    ],
    [
        'code' => 'se-FI',
        'name' => 'Sami (Northern) (Finland)',
        'local_name' => 'davvisámegiella (Suopma)',
    ],
    [
        'code' => 'se-NO',
        'name' => 'Sami (Northern) (Norway)',
        'local_name' => 'davvisámegiella (Norga)',
    ],
    [
        'code' => 'se-SE',
        'name' => 'Sami (Northern) (Sweden)',
        'local_name' => 'davvisámegiella (Ruoŧŧa)',
    ],
    [
        'code' => 'si-LK',
        'name' => 'Sinhala (Sri Lanka)',
        'local_name' => 'සිංහ (ශ්‍රී ලංකා)',
    ],
    [
        'code' => 'sk',
        'name' => 'Slovak',
        'local_name' => 'slovenčina',
    ],
    [
        'code' => 'sk-SK',
        'name' => 'Slovak (Slovakia)',
        'local_name' => 'slovenčina (Slovenská republika)',
    ],
    [
        'code' => 'sl',
        'name' => 'Slovenian',
        'local_name' => 'slovenski',
    ],
    [
        'code' => 'sl-SI',
        'name' => 'Slovenian (Slovenia)',
        'local_name' => 'slovenski (Slovenija)',
    ],
    [
        'code' => 'sma-NO',
        'name' => 'Sami (Southern) (Norway)',
        'local_name' => 'åarjelsaemiengiele (Nöörje)',
    ],
    [
        'code' => 'sma-SE',
        'name' => 'Sami (Southern) (Sweden)',
        'local_name' => 'åarjelsaemiengiele (Sveerje)',
    ],
    [
        'code' => 'smj-NO',
        'name' => 'Sami (Lule) (Norway)',
        'local_name' => 'julevusámegiella (Vuodna)',
    ],
    [
        'code' => 'smj-SE',
        'name' => 'Sami (Lule) (Sweden)',
        'local_name' => 'julevusámegiella (Svierik)',
    ],
    [
        'code' => 'smn-FI',
        'name' => 'Sami (Inari) (Finland)',
        'local_name' => 'sämikielâ (Suomâ)',
    ],
    [
        'code' => 'sms-FI',
        'name' => 'Sami (Skolt) (Finland)',
        'local_name' => 'sääm´ǩiõll (Lää´ddjânnam)',
    ],
    [
        'code' => 'sq',
        'name' => 'Albanian',
        'local_name' => 'shqipe',
    ],
    [
        'code' => 'sq-AL',
        'name' => 'Albanian (Albania)',
        'local_name' => 'shqipe (Shqipëria)',
    ],
    [
        'code' => 'sr',
        'name' => 'Serbian',
        'local_name' => 'srpski',
    ],
    [
        'code' => 'sr-Cyrl-BA',
        'name' => 'Serbian (Cyrillic) (Bosnia and Herzegovina)',
        'local_name' => 'српски (Босна и Херцеговина)',
    ],
    [
        'code' => 'sr-Cyrl-CS',
        'name' => 'Serbian (Cyrillic, Serbia)',
        'local_name' => 'српски (Србија)',
    ],
    [
        'code' => 'sr-Latn-BA',
        'name' => 'Serbian (Latin) (Bosnia and Herzegovina)',
        'local_name' => 'srpski (Bosna i Hercegovina)',
    ],
    [
        'code' => 'sr-Latn-CS',
        'name' => 'Serbian (Latin, Serbia)',
        'local_name' => 'srpski (Srbija)',
    ],
    [
        'code' => 'sv',
        'name' => 'Swedish',
        'local_name' => 'svenska',
    ],
    [
        'code' => 'sv-FI',
        'name' => 'Swedish (Finland)',
        'local_name' => 'svenska (Finland)',
    ],
    [
        'code' => 'sv-SE',
        'name' => 'Swedish (Sweden)',
        'local_name' => 'svenska (Sverige)',
    ],
    [
        'code' => 'sw',
        'name' => 'Kiswahili',
        'local_name' => 'Kiswahili',
    ],
    [
        'code' => 'sw-KE',
        'name' => 'Kiswahili (Kenya)',
        'local_name' => 'Kiswahili (Kenya)',
    ],
    [
        'code' => 'syr',
        'name' => 'Syriac',
        'local_name' => 'ܣܘܪܝܝܐ',
    ],
    [
        'code' => 'syr-SY',
        'name' => 'Syriac (Syria)',
        'local_name' => 'ܣܘܪܝܝܐ (سوريا)',
    ],
    [
        'code' => 'ta',
        'name' => 'Tamil',
        'local_name' => 'தமிழ்',
    ],
    [
        'code' => 'ta-IN',
        'name' => 'Tamil (India)',
        'local_name' => 'தமிழ் (இந்தியா)',
    ],
    [
        'code' => 'te',
        'name' => 'Telugu',
        'local_name' => 'తెలుగు',
    ],
    [
        'code' => 'te-IN',
        'name' => 'Telugu (India)',
        'local_name' => 'తెలుగు (భారత దేశం)',
    ],
    [
        'code' => 'tg-Cyrl-TJ',
        'name' => 'Tajik (Cyrillic) (Tajikistan)',
        'local_name' => 'Тоҷикӣ (Тоҷикистон)',
    ],
    [
        'code' => 'th',
        'name' => 'Thai',
        'local_name' => 'ไทย',
    ],
    [
        'code' => 'th-TH',
        'name' => 'Thai (Thailand)',
        'local_name' => 'ไทย (ไทย)',
    ],
    [
        'code' => 'tk-TM',
        'name' => 'Turkmen (Turkmenistan)',
        'local_name' => 'türkmençe (Türkmenistan)',
    ],
    [
        'code' => 'tn-ZA',
        'name' => 'Setswana (South Africa)',
        'local_name' => 'Setswana (Aforika Borwa)',
    ],
    [
        'code' => 'tr',
        'name' => 'Turkish',
        'local_name' => 'Türkçe',
    ],
    [
        'code' => 'tr-TR',
        'name' => 'Turkish (Turkey)',
        'local_name' => 'Türkçe (Türkiye)',
    ],
    [
        'code' => 'tt',
        'name' => 'Tatar',
        'local_name' => 'Татар',
    ],
    [
        'code' => 'tt-RU',
        'name' => 'Tatar (Russia)',
        'local_name' => 'Татар (Россия)',
    ],
    [
        'code' => 'tzm-Latn-DZ',
        'name' => 'Tamazight (Latin) (Algeria)',
        'local_name' => 'Tamazight (Djazaïr)',
    ],
    [
        'code' => 'ug-CN',
        'name' => 'Uighur (People\'s Republic of China)',
        'local_name' => 'ئۇيغۇر يېزىقى (جۇڭخۇا خەلق جۇمھۇرىيىتى)',
    ],
    [
        'code' => 'uk',
        'name' => 'Ukrainian',
        'local_name' => 'україньска',
    ],
    [
        'code' => 'uk-UA',
        'name' => 'Ukrainian (Ukraine)',
        'local_name' => 'україньска (Україна)',
    ],
    [
        'code' => 'ur',
        'name' => 'Urdu',
        'local_name' => 'اُردو',
    ],
    [
        'code' => 'ur-PK',
        'name' => 'Urdu (Islamic Republic of Pakistan)',
        'local_name' => 'اُردو (پاکستان)',
    ],
    [
        'code' => 'uz',
        'name' => 'Uzbek',
        'local_name' => 'U\'zbek',
    ],
    [
        'code' => 'uz-Cyrl-UZ',
        'name' => 'Uzbek (Cyrillic, Uzbekistan)',
        'local_name' => 'Ўзбек (Ўзбекистон)',
    ],
    [
        'code' => 'uz-Latn-UZ',
        'name' => 'Uzbek (Latin, Uzbekistan)',
        'local_name' => 'U\'zbek (U\'zbekiston Respublikasi)',
    ],
    [
        'code' => 'vi',
        'name' => 'Vietnamese',
        'local_name' => 'Tiếng Việt',
    ],
    [
        'code' => 'vi-VN',
        'name' => 'Vietnamese (Vietnam)',
        'local_name' => 'Tiếng Việt (Việt Nam)',
    ],
    [
        'code' => 'wo-SN',
        'name' => 'Wolof (Senegal)',
        'local_name' => 'Wolof (Sénégal)',
    ],
    [
        'code' => 'xh-ZA',
        'name' => 'isiXhosa (South Africa)',
        'local_name' => 'isiXhosa (uMzantsi Afrika)',
    ],
    [
        'code' => 'yo-NG',
        'name' => 'Yoruba (Nigeria)',
        'local_name' => 'Yoruba (Nigeria)',
    ],
    [
        'code' => 'zh-CHS',
        'name' => 'Chinese (Simplified)',
        'local_name' => '中文(简体)',
    ],
    [
        'code' => 'zh-CHT',
        'name' => 'Chinese (Traditional)',
        'local_name' => '中文(繁體)',
    ],
    [
        'code' => 'zh-CN',
        'name' => 'Chinese (People\'s Republic of China)',
        'local_name' => '中文(中华人民共和国)',
    ],
    [
        'code' => 'zh-HK',
        'name' => 'Chinese (Hong Kong S.A.R.)',
        'local_name' => '中文(香港特别行政區)',
    ],
    [
        'code' => 'zh-MO',
        'name' => 'Chinese (Macao S.A.R.)',
        'local_name' => '中文(澳門特别行政區)',
    ],
    [
        'code' => 'zh-SG',
        'name' => 'Chinese (Singapore)',
        'local_name' => '中文(新加坡)',
    ],
    [
        'code' => 'zh-TW',
        'name' => 'Chinese (Taiwan)',
        'local_name' => '中文(台灣)',
    ],
    [
        'code' => 'zu-ZA',
        'name' => 'isiZulu (South Africa)',
        'local_name' => 'isiZulu (iNingizimu Afrika)',
    ],
]
        );
    }

    public function safeDown()
    {
        //$this->truncateTable('{{%language}} CASCADE');
    }
}
