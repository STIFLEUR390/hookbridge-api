<?php

declare(strict_types=1);

return [
    'accepted'               => 'Dit veld moet geaccepteerd zijn.',
    'accepted_if'            => 'Dit veld moet worden geaccepteerd wanneer :other gelijk is aan :value.',
    'active_url'             => 'Dit veld is geen geldige URL.',
    'after'                  => 'Dit veld moet een datum na :date zijn.',
    'after_or_equal'         => 'Dit veld moet een datum na of gelijk aan :date zijn.',
    'alpha'                  => 'Dit veld mag alleen letters bevatten.',
    'alpha_dash'             => 'Dit veld mag alleen letters, nummers, underscores (_) en streepjes (-) bevatten.',
    'alpha_num'              => 'Dit veld mag alleen letters en nummers bevatten.',
    'any_of'                 => 'This field is invalid.',
    'array'                  => 'Dit veld moet geselecteerde elementen bevatten.',
    'ascii'                  => 'Dit veld mag alleen alfanumerieke tekens en symbolen van één byte bevatten.',
    'before'                 => 'Dit veld moet een datum voor :date zijn.',
    'before_or_equal'        => 'Dit veld moet een datum voor of gelijk aan :date zijn.',
    'between'                => [
        'array'   => 'Dit veld moet tussen :min en :max items bevatten.',
        'file'    => 'Dit veld moet tussen :min en :max kilobytes zijn.',
        'numeric' => 'Dit veld moet tussen :min en :max zijn.',
        'string'  => 'Dit veld moet tussen :min en :max karakters zijn.',
    ],
    'boolean'                => 'Dit veld moet ja of nee zijn.',
    'can'                    => 'Dit veld bevat een waarde waar je niet bevoegd voor bent.',
    'confirmed'              => 'De bevestiging komt niet overeen.',
    'contains'               => 'Dit veld mist een vereiste waarde.',
    'current_password'       => 'Huidig wachtwoord is onjuist.',
    'date'                   => 'Dit veld is geen geldige datum',
    'date_equals'            => 'Dit veld moet een datum gelijk aan :date zijn.',
    'date_format'            => 'Dit veld voldoet niet aan het formaat :format.',
    'decimal'                => 'Dit veld moet :decimal decimalen bevatten.',
    'declined'               => 'Dit veld moet afgewezen worden.',
    'declined_if'            => 'Dit veld moet afgewezen worden wanneer :other gelijk is aan :value.',
    'different'              => 'Dit veld en :other moeten verschillend zijn.',
    'digits'                 => 'Dit veld moet bestaan uit :digits cijfers.',
    'digits_between'         => 'Dit veld moet bestaan uit minimaal :min en maximaal :max cijfers.',
    'dimensions'             => 'Deze afbeelding heeft geen geldige afmetingen.',
    'distinct'               => 'Dit veld heeft een dubbele waarde.',
    'doesnt_end_with'        => 'Dit veld mag niet eindigen met één van de volgende waarden: :values.',
    'doesnt_start_with'      => 'Dit veld mag niet beginnen met één van de volgende waarden: :values.',
    'email'                  => 'Dit veld is geen geldig e-mailadres.',
    'ends_with'              => 'Dit veld moet met één van de volgende waarden eindigen: :values.',
    'enum'                   => 'De geselecteerde waarde is ongeldig.',
    'exists'                 => 'De geselecteerde waarde bestaat niet.',
    'extensions'             => 'Dit veld moet een van de volgende bestandsextensies hebben: :values.',
    'file'                   => 'Dit veld moet een bestand zijn.',
    'filled'                 => 'Dit veld is verplicht.',
    'gt'                     => [
        'array'   => 'De inhoud moet meer dan :value waardes bevatten.',
        'file'    => 'Het bestand moet groter zijn dan :value kilobytes.',
        'numeric' => 'De waarde moet groter zijn dan :value.',
        'string'  => 'De waarde moet meer dan :value tekens bevatten.',
    ],
    'gte'                    => [
        'array'   => 'De inhoud moet :value waardes of meer bevatten.',
        'file'    => 'Het bestand moet groter of gelijk zijn aan :value kilobytes.',
        'numeric' => 'De waarde moet groter of gelijk zijn aan :value.',
        'string'  => 'De waarde moet minimaal :value tekens bevatten.',
    ],
    'hex_color'              => 'Dit veld moet een geldige hexadecimale kleurcode zijn.',
    'image'                  => 'Dit veld moet een afbeelding zijn.',
    'in'                     => 'De geselecteerde waarde is ongeldig.',
    'in_array'               => 'Deze waarde bestaat niet in :other.',
    'integer'                => 'Dit veld moet een getal zijn.',
    'ip'                     => 'Dit veld moet een geldig IP-adres zijn.',
    'ipv4'                   => 'Dit veld moet een geldig IPv4-adres zijn.',
    'ipv6'                   => 'Dit veld moet een geldig IPv6-adres zijn.',
    'json'                   => 'Dit veld moet een geldige JSON-string zijn.',
    'list'                   => 'Dit veld moet een lijst zijn.',
    'lowercase'              => 'Dit veld mag alleen kleine letters bevatten.',
    'lt'                     => [
        'array'   => 'De inhoud moet minder dan :value waardes bevatten.',
        'file'    => 'Het bestand moet kleiner zijn dan :value kilobytes.',
        'numeric' => 'De waarde moet kleiner zijn dan :value.',
        'string'  => 'De waarde moet minder dan :value tekens bevatten.',
    ],
    'lte'                    => [
        'array'   => 'De inhoud moet :value waardes of minder bevatten.',
        'file'    => 'Het bestand moet kleiner of gelijk zijn aan :value kilobytes.',
        'numeric' => 'De waarde moet kleiner of gelijk zijn aan :value.',
        'string'  => 'De waarde moet maximaal :value tekens bevatten.',
    ],
    'mac_address'            => 'De waarde moet een geldig MAC-adres zijn.',
    'max'                    => [
        'array'   => 'De inhoud mag niet meer dan :max items bevatten.',
        'file'    => 'Het bestand mag niet meer dan :max kilobytes zijn.',
        'numeric' => 'De waarde mag niet hoger dan :max zijn.',
        'string'  => 'De waarde mag niet uit meer dan :max tekens bestaan.',
    ],
    'max_digits'             => 'Dit veld mag niet uit meer dan :max cijfers bestaan.',
    'mimes'                  => 'Dit moet een bestand zijn van het bestandstype :values.',
    'mimetypes'              => 'Dit moet een bestand zijn van het bestandstype :values.',
    'min'                    => [
        'array'   => 'De inhoud moet minimaal :min items bevatten.',
        'file'    => 'Het bestand moet minimaal :min kilobytes zijn.',
        'numeric' => 'De waarde moet minimaal :min zijn.',
        'string'  => 'De waarde moet minimaal :min tekens zijn.',
    ],
    'min_digits'             => 'Dit veld moet minimaal uit :min cijfers bestaan.',
    'missing'                => 'Dit veld moet ontbreken.',
    'missing_if'             => 'Dit veld moet ontbreken als :other :value is.',
    'missing_unless'         => 'Dit veld moet ontbreken tenzij :other :value is.',
    'missing_with'           => 'Dit veld moet ontbreken wanneer :values aanwezig is.',
    'missing_with_all'       => 'Dit veld moet ontbreken wanneer er :values aanwezig zijn.',
    'multiple_of'            => 'De waarde moet een veelvoud van :value zijn.',
    'not_in'                 => 'De geselecteerde waarde is ongeldig.',
    'not_regex'              => 'Dit formaat is ongeldig.',
    'numeric'                => 'Dit veld moet een nummer zijn',
    'password'               => [
        'letters'       => 'Dit veld moet minimaal één letter bevatten.',
        'mixed'         => 'Dit veld moet minimaal één kleine letter en één hoofdletter bevatten.',
        'numbers'       => 'Dit veld moet minimaal één cijfer bevatten.',
        'symbols'       => 'Dit veld moet minimaal één vreemd teken bevatten.',
        'uncompromised' => 'De opgegeven waarde komt voor in een datalek. Kies een ander waarde.',
    ],
    'present'                => 'Dit veld moet bestaan.',
    'present_if'             => 'Dit veld moet aanwezig zijn als :other :value is.',
    'present_unless'         => 'Dit veld moet aanwezig zijn tenzij :other :value is.',
    'present_with'           => 'Dit veld moet aanwezig zijn als :values aanwezig is.',
    'present_with_all'       => 'Dit veld moet aanwezig zijn als :values aanwezig zijn.',
    'prohibited'             => 'Dit veld is verboden.',
    'prohibited_if'          => 'Dit veld is verboden indien :other gelijk is aan :value.',
    'prohibited_if_accepted' => 'This field is prohibited when :other is accepted.',
    'prohibited_if_declined' => 'This field is prohibited when :other is declined.',
    'prohibited_unless'      => 'Dit veld is verboden tenzij :other gelijk is aan :values.',
    'prohibits'              => 'Dit veld verbiedt de aanwezigheid van :other.',
    'regex'                  => 'Dit formaat is ongeldig.',
    'required'               => 'Dit veld is verplicht.',
    'required_array_keys'    => 'Dit veld moet waardes bevatten voor :values.',
    'required_if'            => 'Dit veld is verplicht indien :other gelijk is aan :value.',
    'required_if_accepted'   => 'Dit veld is verplicht indien :other is geaccepteerd.',
    'required_if_declined'   => 'Dit veld is verplicht indien :other is geweigerd.',
    'required_unless'        => 'Dit veld is verplicht tenzij :other gelijk is aan :values.',
    'required_with'          => 'Dit veld is verplicht i.c.m. :values',
    'required_with_all'      => 'Dit veld is verplicht i.c.m. :values',
    'required_without'       => 'Dit veld is verplicht als :values niet ingevuld is.',
    'required_without_all'   => 'Dit veld is verplicht als :values niet ingevuld zijn.',
    'same'                   => 'De waarde van dit veld en :other moeten overeenkomen.',
    'size'                   => [
        'array'   => 'De inhoud moet :size items bevatten.',
        'file'    => 'Het bestand moet :size kilobyte zijn.',
        'numeric' => 'De waarde moet :size zijn.',
        'string'  => 'De waarde moet :size tekens zijn.',
    ],
    'starts_with'            => 'Dit veld moet starten met een van de volgende: :values.',
    'string'                 => 'Dit veld moet een tekst zijn.',
    'timezone'               => 'Dit veld moet een geldige tijdzone bevatten.',
    'ulid'                   => 'Dit veld moet een geldige ULID bevatten.',
    'unique'                 => 'Deze is al in gebruik',
    'uploaded'               => 'Het uploaden hiervan is mislukt.',
    'uppercase'              => 'Dit veld mag alleen hoofdletters bevatten.',
    'url'                    => 'Dit veld moet een geldige URL bevatten.',
    'uuid'                   => 'Dit veld moet een geldige UUID bevatten.',
    'attributes'             => [
        'address'                  => 'adres',
        'affiliate_url'            => 'partner-URL',
        'age'                      => 'leeftijd',
        'amount'                   => 'bedrag',
        'announcement'             => 'aankondiging',
        'area'                     => 'gebied',
        'audience_prize'           => 'publieksprijs',
        'audience_winner'          => 'publiekswinnaar',
        'available'                => 'beschikbaar',
        'birthday'                 => 'verjaardag',
        'body'                     => 'inhoud',
        'city'                     => 'stad',
        'company'                  => 'bedrijf',
        'compilation'              => 'compilatie',
        'concept'                  => 'concept',
        'conditions'               => 'voorwaarden',
        'content'                  => 'inhoud',
        'contest'                  => 'wedstrijd',
        'country'                  => 'land',
        'cover'                    => 'omslag',
        'created_at'               => 'aangemaakt op',
        'creator'                  => 'maker',
        'currency'                 => 'valuta',
        'current_password'         => 'huidig wachtwoord',
        'customer'                 => 'klant',
        'date'                     => 'datum',
        'date_of_birth'            => 'geboortedatum',
        'dates'                    => 'datums',
        'day'                      => 'dag',
        'deleted_at'               => 'verwijderd op',
        'description'              => 'omschrijving',
        'display_type'             => 'weergavetype',
        'district'                 => 'wijk',
        'duration'                 => 'tijdsduur',
        'email'                    => 'e-mailadres',
        'excerpt'                  => 'uittreksel',
        'filter'                   => 'filter',
        'finished_at'              => 'klaar om',
        'first_name'               => 'voornaam',
        'gender'                   => 'geslacht',
        'grand_prize'              => 'grote prijs',
        'group'                    => 'groep',
        'hour'                     => 'uur',
        'image'                    => 'afbeelding',
        'image_desktop'            => 'bureaubladafbeelding',
        'image_main'               => 'hoofdafbeelding',
        'image_mobile'             => 'mobiele afbeelding',
        'images'                   => 'afbeeldingen',
        'is_audience_winner'       => 'is publiekswinnaar',
        'is_hidden'                => 'is verborgen',
        'is_subscribed'            => 'is geabonneerd',
        'is_visible'               => 'is zichtbaar',
        'is_winner'                => 'is winnaar',
        'items'                    => 'artikels',
        'key'                      => 'sleutel',
        'last_name'                => 'achternaam',
        'lesson'                   => 'les',
        'line_address_1'           => 'adresregel 1',
        'line_address_2'           => 'adresregel 2',
        'login'                    => 'login',
        'message'                  => 'bericht',
        'middle_name'              => 'tweede naam',
        'minute'                   => 'minuut',
        'mobile'                   => 'mobiel',
        'month'                    => 'maand',
        'name'                     => 'naam',
        'national_code'            => 'landcode',
        'number'                   => 'nummer',
        'password'                 => 'wachtwoord',
        'password_confirmation'    => 'wachtwoordbevestiging',
        'phone'                    => 'telefoonnummer',
        'photo'                    => 'foto',
        'portfolio'                => 'portfolio',
        'postal_code'              => 'postcode',
        'preview'                  => 'voorbeeld',
        'price'                    => 'prijs',
        'product_id'               => 'product-ID',
        'product_uid'              => 'product-UID',
        'product_uuid'             => 'product-UUID',
        'promo_code'               => 'promo-code',
        'province'                 => 'provincie',
        'quantity'                 => 'hoeveelheid',
        'reason'                   => 'reden',
        'recaptcha_response_field' => 'recaptcha-antwoordveld',
        'referee'                  => 'scheidsrechter',
        'referees'                 => 'scheidsrechters',
        'reject_reason'            => 'afwijsreden',
        'remember'                 => 'onthouden',
        'restored_at'              => 'hersteld op',
        'result_text_under_image'  => 'antwoord tekst onder afbeelding',
        'role'                     => 'rol',
        'rule'                     => 'regel',
        'rules'                    => 'regels',
        'second'                   => 'seconde',
        'sex'                      => 'geslacht',
        'shipment'                 => 'verzending',
        'short_text'               => 'korte tekst',
        'size'                     => 'grootte',
        'skills'                   => 'vaardigheden',
        'slug'                     => 'slug',
        'specialization'           => 'specialisatie',
        'started_at'               => 'gestart op',
        'state'                    => 'staat',
        'status'                   => 'status',
        'street'                   => 'straat',
        'student'                  => 'leerling',
        'subject'                  => 'onderwerp',
        'tag'                      => 'label',
        'tags'                     => 'labels',
        'teacher'                  => 'docent',
        'terms'                    => 'voorwaarden',
        'test_description'         => 'testomschrijving',
        'test_locale'              => 'testlandinstelling',
        'test_name'                => 'testnaam',
        'text'                     => 'tekst',
        'time'                     => 'tijd',
        'title'                    => 'titel',
        'type'                     => 'type',
        'updated_at'               => 'bijgewerkt op',
        'user'                     => 'gebruiker',
        'username'                 => 'gebruikersnaam',
        'value'                    => 'waarde',
        'winner'                   => 'winnaar',
        'work'                     => 'werk',
        'year'                     => 'jaar',
    ],
];
