<?php

declare(strict_types=1);

return [
    'accepted'               => 'This field must be accepted.',
    'accepted_if'            => 'This field must be accepted when :other is :value.',
    'active_url'             => 'This must be a valid URL.',
    'after'                  => 'This must be a date after :date.',
    'after_or_equal'         => 'This must be a date after or equal to :date.',
    'alpha'                  => 'The value must only contain letters.',
    'alpha_dash'             => 'The value must only contain letters, numbers, dashes, and underscores.',
    'alpha_num'              => 'The value must only contain letters and numbers.',
    'array'                  => 'This field must contain an array.',
    'ascii'                  => 'The value must only contain single-byte alphanumeric characters and symbols.',
    'before'                 => 'This must be a date before :date.',
    'before_or_equal'        => 'This must be a date before or equal to :date.',
    'between'                => [
        'array'   => 'The value must have between :min and :max items.',
        'file'    => 'The file must be between :min and :max kilobytes.',
        'numeric' => 'The value must be between :min and :max.',
        'string'  => 'The string must be between :min and :max characters.',
    ],
    'boolean'                => 'The value must be true or false.',
    'can'                    => 'The value is unauthorized.',
    'confirmed'              => 'The confirmation does not match.',
    'contains'               => 'This field is missing a required value.',
    'current_password'       => 'The password is incorrect.',
    'date'                   => 'This is not a valid date.',
    'date_equals'            => 'This must be a date equal to :date.',
    'date_format'            => 'The value must match the format :format.',
    'decimal'                => 'The value must have :decimal decimal places.',
    'declined'               => 'This field must be declined.',
    'declined_if'            => 'This field must be declined when :other is :value.',
    'different'              => 'The value and :other must be different.',
    'digits'                 => 'The value must be :digits digits.',
    'digits_between'         => 'The value must be between :min and :max digits.',
    'dimensions'             => 'The content has invalid dimensions.',
    'distinct'               => 'This field contains a duplicate value.',
    'doesnt_end_with'        => 'The string must not end with one of the following: :values.',
    'doesnt_start_with'      => 'The string must not start with one of the following: :values.',
    'email'                  => 'The value must be a valid email address.',
    'ends_with'              => 'The string must end with one of the following: :values.',
    'enum'                   => 'The selected value is invalid.',
    'exists'                 => 'The selected value is invalid.',
    'extensions'             => 'The file must have one of the following extensions: :values.',
    'file'                   => 'This must be a file.',
    'filled'                 => 'This field must have a value.',
    'gt'                     => [
        'array'   => 'This field must contain more than :value items.',
        'file'    => 'The file must be greater than :value kilobytes.',
        'numeric' => 'The value must be greater than :value.',
        'string'  => 'The string must be greater than :value characters.',
    ],
    'gte'                    => [
        'array'   => 'This field must contain :value items or more.',
        'file'    => 'The file must be greater than or equal to :value kilobytes.',
        'numeric' => 'The value must be greater than or equal to :value.',
        'string'  => 'The string must be greater than or equal to :value characters.',
    ],
    'hex_color'              => 'The value must be a valid hexadecimal color.',
    'image'                  => 'The value must be an image.',
    'in'                     => 'The selected value is invalid.',
    'in_array'               => 'The value does not exist in :other.',
    'integer'                => 'The value must be an integer.',
    'ip'                     => 'The value must be a valid IP address.',
    'ipv4'                   => 'The value must be a valid IPv4 address.',
    'ipv6'                   => 'The value must be a valid IPv6 address.',
    'json'                   => 'The value must be a valid JSON string.',
    'list'                   => 'The value must be a list.',
    'lowercase'              => 'The value must be lowercase.',
    'lt'                     => [
        'array'   => 'This field must contain less than :value items.',
        'file'    => 'The file must be less than :value kilobytes.',
        'numeric' => 'The value must be less than :value.',
        'string'  => 'The string must be less than :value characters.',
    ],
    'lte'                    => [
        'array'   => 'This field must not contain more than :value items.',
        'file'    => 'The file must be less than or equal to :value kilobytes.',
        'numeric' => 'The value must be less than or equal to :value.',
        'string'  => 'This field must be less than or equal to :value characters.',
    ],
    'mac_address'            => 'This must be a valid MAC address.',
    'max'                    => [
        'array'   => 'This field must not contain more than :max items.',
        'file'    => 'The file must not be greater than :max kilobytes.',
        'numeric' => 'The value must not be greater than :max.',
        'string'  => 'The string must not be greater than :max characters.',
    ],
    'max_digits'             => 'The value must not have more than :max digits.',
    'mimes'                  => 'This must be a file of type: :values.',
    'mimetypes'              => 'This must be a file of type: :values.',
    'min'                    => [
        'array'   => 'This field must contain at least :min items.',
        'file'    => 'The file must be at least :min kilobytes.',
        'numeric' => 'The value must be at least :min.',
        'string'  => 'The string must be at least :min characters.',
    ],
    'min_digits'             => 'The value must have at least :min digits.',
    'missing'                => 'This field must be missing.',
    'missing_if'             => 'This field must be missing when :other is :value.',
    'missing_unless'         => 'This field must be missing unless :other is :value.',
    'missing_with'           => 'This field must be missing when :values is present.',
    'missing_with_all'       => 'This field must be missing when :values are present.',
    'multiple_of'            => 'This value must be a multiple of :value.',
    'not_in'                 => 'The selected value is invalid.',
    'not_regex'              => 'This format is invalid.',
    'numeric'                => 'This must be a number.',
    'password'               => [
        'letters'       => 'The string must contain at least one letter.',
        'mixed'         => 'The string must contain at least one uppercase and one lowercase letter.',
        'numbers'       => 'The string must contain at least one number.',
        'symbols'       => 'The string must contain at least one symbol.',
        'uncompromised' => 'The given string has appeared in a data leak. Please choose a different one.',
    ],
    'present'                => 'This field must be present.',
    'present_if'             => 'This field must be present when :other is :value.',
    'present_unless'         => 'This field must be present unless :other is :value.',
    'present_with'           => 'This field must be present when :values is present.',
    'present_with_all'       => 'This field must be present when :values are present.',
    'prohibited'             => 'This field is prohibited.',
    'prohibited_if'          => 'This field is prohibited when :other is :value.',
    'prohibited_if_accepted' => 'This field is prohibited when :other is accepted.',
    'prohibited_if_declined' => 'This field is prohibited when :other is declined.',
    'prohibited_unless'      => 'This field is prohibited unless :other is in :values.',
    'prohibits'              => 'This field prohibits :other from being present.',
    'regex'                  => 'The format is invalid.',
    'required'               => 'This field is required.',
    'required_array_keys'    => 'This field must contain entries for: :values.',
    'required_if'            => 'This field is required when :other is :value.',
    'required_if_accepted'   => 'This field is required when :other is accepted.',
    'required_if_declined'   => 'This field is required when :other is declined.',
    'required_unless'        => 'This field is required unless :other is in :values.',
    'required_with'          => 'This field is required when :values is present.',
    'required_with_all'      => 'This field is required when :values are present.',
    'required_without'       => 'This field is required when :values is not present.',
    'required_without_all'   => 'This field is required when none of :values are present.',
    'same'                   => 'The value must match :other.',
    'size'                   => [
        'array'   => 'This field must contain :size items.',
        'file'    => 'The file must be :size kilobytes.',
        'numeric' => 'The value must be :size.',
        'string'  => 'The string must be :size characters.',
    ],
    'starts_with'            => 'This must start with one of the following: :values.',
    'string'                 => 'This must be a string.',
    'timezone'               => 'This must be a valid timezone.',
    'ulid'                   => 'This must be a valid ULID.',
    'unique'                 => 'This has already been taken.',
    'uploaded'               => 'The file failed to upload.',
    'uppercase'              => 'This must be uppercase.',
    'url'                    => 'This must be a valid URL.',
    'uuid'                   => 'This must be a valid UUID.',
    'attributes'             => [
        'address'                  => 'address',
        'affiliate_url'            => 'affiliate URL',
        'age'                      => 'age',
        'amount'                   => 'amount',
        'announcement'             => 'announcement',
        'area'                     => 'area',
        'audience_prize'           => 'audience prize',
        'audience_winner'          => 'audience winner',
        'available'                => 'available',
        'birthday'                 => 'birthday',
        'body'                     => 'body',
        'city'                     => 'city',
        'company'                  => 'company',
        'compilation'              => 'compilation',
        'concept'                  => 'concept',
        'conditions'               => 'conditions',
        'content'                  => 'content',
        'contest'                  => 'contest',
        'country'                  => 'country',
        'cover'                    => 'cover',
        'created_at'               => 'created at',
        'creator'                  => 'creator',
        'currency'                 => 'currency',
        'current_password'         => 'current password',
        'customer'                 => 'customer',
        'date'                     => 'date',
        'date_of_birth'            => 'date of birth',
        'dates'                    => 'dates',
        'day'                      => 'day',
        'deleted_at'               => 'deleted at',
        'description'              => 'description',
        'display_type'             => 'display type',
        'district'                 => 'district',
        'duration'                 => 'duration',
        'email'                    => 'email',
        'excerpt'                  => 'excerpt',
        'filter'                   => 'filter',
        'finished_at'              => 'finished at',
        'first_name'               => 'first name',
        'gender'                   => 'gender',
        'grand_prize'              => 'grand prize',
        'group'                    => 'group',
        'hour'                     => 'hour',
        'image'                    => 'image',
        'image_desktop'            => 'desktop image',
        'image_main'               => 'main image',
        'image_mobile'             => 'mobile image',
        'images'                   => 'images',
        'is_audience_winner'       => 'is audience winner',
        'is_hidden'                => 'is hidden',
        'is_subscribed'            => 'is subscribed',
        'is_visible'               => 'is visible',
        'is_winner'                => 'is winner',
        'items'                    => 'items',
        'key'                      => 'key',
        'last_name'                => 'last name',
        'lesson'                   => 'lesson',
        'line_address_1'           => 'line address 1',
        'line_address_2'           => 'line address 2',
        'login'                    => 'login',
        'message'                  => 'message',
        'middle_name'              => 'middle name',
        'minute'                   => 'minute',
        'mobile'                   => 'mobile',
        'month'                    => 'month',
        'name'                     => 'name',
        'national_code'            => 'national code',
        'number'                   => 'number',
        'password'                 => 'password',
        'password_confirmation'    => 'password confirmation',
        'phone'                    => 'phone',
        'photo'                    => 'photo',
        'portfolio'                => 'portfolio',
        'postal_code'              => 'postal code',
        'preview'                  => 'preview',
        'price'                    => 'price',
        'product_id'               => 'product ID',
        'product_uid'              => 'product UID',
        'product_uuid'             => 'product UUID',
        'promo_code'               => 'promo code',
        'province'                 => 'province',
        'quantity'                 => 'quantity',
        'reason'                   => 'reason',
        'recaptcha_response_field' => 'recaptcha response field',
        'referee'                  => 'referee',
        'referees'                 => 'referees',
        'reject_reason'            => 'reject reason',
        'remember'                 => 'remember',
        'restored_at'              => 'restored at',
        'result_text_under_image'  => 'result text under image',
        'role'                     => 'role',
        'rule'                     => 'rule',
        'rules'                    => 'rules',
        'second'                   => 'second',
        'sex'                      => 'sex',
        'shipment'                 => 'shipment',
        'short_text'               => 'short text',
        'size'                     => 'size',
        'skills'                   => 'skills',
        'slug'                     => 'slug',
        'specialization'           => 'specialization',
        'started_at'               => 'started at',
        'state'                    => 'state',
        'status'                   => 'status',
        'street'                   => 'street',
        'student'                  => 'student',
        'subject'                  => 'subject',
        'tag'                      => 'tag',
        'tags'                     => 'tags',
        'teacher'                  => 'teacher',
        'terms'                    => 'terms',
        'test_description'         => 'test description',
        'test_locale'              => 'test locale',
        'test_name'                => 'test name',
        'text'                     => 'text',
        'time'                     => 'time',
        'title'                    => 'title',
        'type'                     => 'type',
        'updated_at'               => 'updated at',
        'user'                     => 'user',
        'username'                 => 'username',
        'value'                    => 'value',
        'winner'                   => 'winner',
        'work'                     => 'work',
        'year'                     => 'year',
    ],
];
