<?php

declare(strict_types=1);

return [
    'accepted'               => 'Este campo deve ser aceite.',
    'accepted_if'            => 'Este campo deve ser aceite quando :other é :value.',
    'active_url'             => 'A Url é inválida.',
    'after'                  => 'Esta deve ser uma data após :date.',
    'after_or_equal'         => 'Esta deve ser uma data posterior ou igual a :date.',
    'alpha'                  => 'Este campo pode conter apenas letras.',
    'alpha_dash'             => 'Este campo pode conter apenas letras, números, traços e o caractere de sublinhado.',
    'alpha_num'              => 'Este campo pode conter apenas letras e números',
    'any_of'                 => 'This field is invalid.',
    'array'                  => 'Este campo deve ser uma matriz.',
    'ascii'                  => 'Este campo deve conter apenas caracteres alfanuméricos de byte único e símbolos.',
    'before'                 => 'Esta deve ser uma data anterior a :date.',
    'before_or_equal'        => 'Esta deve ser uma data anterior ou igual a :date.',
    'between'                => [
        'array'   => 'Este conteúdo deve estar entre :min e :max itens.',
        'file'    => 'Este ficheiro deve estar entre :min e :max kilobytes.',
        'numeric' => 'Este valor deve estar entre :min e :max.',
        'string'  => 'Esta cadeia de texto deve estar entre :min e :max caracteres.',
    ],
    'boolean'                => 'Este campo deve ser verdadeiro ou falso.',
    'can'                    => 'Este campo contém um valor não autorizado.',
    'confirmed'              => 'A confirmação não corresponde.',
    'contains'               => 'O campo não possui um valor obrigatório.',
    'current_password'       => 'A palavra-passe está incorreta.',
    'date'                   => 'Esta não é uma data válida.',
    'date_equals'            => 'Esta deve ser uma data igual a :date.',
    'date_format'            => 'Isto não corresponde ao formato :format.',
    'decimal'                => 'Este campo deve ter :decimal casas decimais.',
    'declined'               => 'Este valor deve ser recusado.',
    'declined_if'            => 'Este valor deve ser recusado quando :other é :value.',
    'different'              => 'Este valor deve ser diferente de :other.',
    'digits'                 => 'Este valor deve ter :digits digitos.',
    'digits_between'         => 'Este valor deve estar entre :min e :max digitos.',
    'dimensions'             => 'Esta imagem tem dimensões inválidas.',
    'distinct'               => 'Este campo tem um valor duplicado.',
    'doesnt_end_with'        => 'Este campo não pode terminar com um dos seguintes valores: :values.',
    'doesnt_start_with'      => 'Este campo não pode começar com um dos seguintes valores: :values.',
    'email'                  => 'Este deve ser um endereço de e-mail válido.',
    'ends_with'              => 'Este campo deve terminar com um dos seguintes valores :values.',
    'enum'                   => 'O valor selecionado é inválido.',
    'exists'                 => 'O valor selecionado é inválido.',
    'extensions'             => 'Este campo deve ter uma das seguintes extensões: :values.',
    'file'                   => 'O conteúdo deve ser um ficheiro.',
    'filled'                 => 'Este campo deve ter um valor.',
    'gt'                     => [
        'array'   => 'O conteúdo deve ter mais de :value itens.',
        'file'    => 'O tamanho do ficheiro deve ser maior que :value kilobytes.',
        'numeric' => 'O valor deve ser maior que :value.',
        'string'  => 'A cadeia de texto deve ser maior que :value caracteres.',
    ],
    'gte'                    => [
        'array'   => 'O conteúdo deve ter :value itens ou mais.',
        'file'    => 'O tamanho do ficheiro deve ser maior ou igual :value kilobytes.',
        'numeric' => 'O valor deve ser maior ou igual :value.',
        'string'  => 'A cadeia de texto deve ser maior ou igual a :value caracteres.',
    ],
    'hex_color'              => 'Este campo deve ter uma cor hexadecimal válida.',
    'image'                  => 'Deve ser uma imagem.',
    'in'                     => 'O valor selecionado é inválido.',
    'in_array'               => 'Este valor não existe em :other.',
    'integer'                => 'Este deve ser um número inteiro.',
    'ip'                     => 'Este deve ser um endereço IP válido.',
    'ipv4'                   => 'Este deve ser um endereço IPv4 válido.',
    'ipv6'                   => 'Este deve ser um endereço IPv6 válido.',
    'json'                   => 'Essa deve ser uma cadeia de texto JSON válida.',
    'list'                   => 'Este campo deve ser uma lista.',
    'lowercase'              => 'Este campo deve ser em minúsculas.',
    'lt'                     => [
        'array'   => 'O conteúdo deve ter menos de :value itens.',
        'file'    => 'O tamanho do ficheiro deve ser menor que :value kilobytes.',
        'numeric' => 'O valor deve ser menor que :value.',
        'string'  => 'A cadeia de texto deve ser menor que :value caracteres.',
    ],
    'lte'                    => [
        'array'   => 'O conteúdo não deve ter mais do que :value itens.',
        'file'    => 'O tamanho do ficheiro deve ser menor ou igual :value kilobytes.',
        'numeric' => 'O valor deve ser menor ou igual :value.',
        'string'  => 'A cadeia de texto deve ser menor ou igual :value caracteres.',
    ],
    'mac_address'            => 'O valor deve ser um endereço MAC válido.',
    'max'                    => [
        'array'   => 'O conteúdo pode não ter mais do que :max itens.',
        'file'    => 'O tamanho do ficheiro não pode ser maior que :max kilobytes.',
        'numeric' => 'O valor não pode ser maior que :max.',
        'string'  => 'A cadeia de texto não pode ser maior que :max caracteres.',
    ],
    'max_digits'             => 'Este campo não pode ter mais do que :max digítos.',
    'mimes'                  => 'Este deve ser um ficheiro do tipo: :values.',
    'mimetypes'              => 'Este deve ser um ficheiro do tipo: :values.',
    'min'                    => [
        'array'   => 'O valor deve ter pelo menos :min itens.',
        'file'    => 'O tamanho do ficheiro deve ser pelo menos :min kilobytes.',
        'numeric' => 'O valor deve ser pelo menos :min.',
        'string'  => 'A cadeia de texto deve ser pelo menos :min characters.',
    ],
    'min_digits'             => 'Este campo deve ter pelo menos :min digítos.',
    'missing'                => 'Este campo deve estar faltando.',
    'missing_if'             => 'Este campo deve estar ausente quando :other for :value.',
    'missing_unless'         => 'Este campo deve estar ausente, a menos que :other seja :value.',
    'missing_with'           => 'Este campo deve estar ausente quando :values estiver presente.',
    'missing_with_all'       => 'Este campo deve estar ausente quando :values estiverem presentes.',
    'multiple_of'            => 'O valor deve ser um múltiplo de :value',
    'not_in'                 => 'O valor selecionado é inválido.',
    'not_regex'              => 'Este formato é inválido.',
    'numeric'                => 'Este deve ser um número.',
    'password'               => [
        'letters'       => 'A palavra-passe deve conter pelo menos uma letra.',
        'mixed'         => 'A palavra-passe deve conter pelo menos uma letra maiúscula e uma minúscula.',
        'numbers'       => 'A palavra-passe deve conter pelo menos um número.',
        'symbols'       => 'A palavra-passe deve conter pelo menos um símbolo.',
        'uncompromised' => 'A palavra-passe apareceu numa fuga de dados. Por favor, escolha um campo diferente.',
    ],
    'present'                => 'Este campo deve estar presente.',
    'present_if'             => 'Este campo deve estar presente quando :other for :value.',
    'present_unless'         => 'Este campo deve estar presente, a menos que :other seja :value.',
    'present_with'           => 'Este campo deve estar presente quando :values estiver presente.',
    'present_with_all'       => 'Este campo deve estar presente quando :values estiverem presentes.',
    'prohibited'             => 'Este campo é proibido.',
    'prohibited_if'          => 'Este campo é proibido quando :other é :value.',
    'prohibited_if_accepted' => 'This field is prohibited when :other is accepted.',
    'prohibited_if_declined' => 'This field is prohibited when :other is declined.',
    'prohibited_unless'      => 'Este campo é proibido a menos que :other esteja em :values.',
    'prohibits'              => 'Este campo proíbe :other de estarem presente.',
    'regex'                  => 'Este formato é inválido.',
    'required'               => 'Este campo é obrigatório.',
    'required_array_keys'    => 'Este campo deve conter entradas para: :values',
    'required_if'            => 'Este campo é obrigatório quando :other é :value.',
    'required_if_accepted'   => 'Este campo é obrigatório quando :other foi aceite.',
    'required_if_declined'   => 'Este campo é obrigatório quando :other foi recusado.',
    'required_unless'        => 'Este campo é obrigatório, a menos que :other esteja em :values.',
    'required_with'          => 'Este campo é obrigatório quando :values estiverem presentes.',
    'required_with_all'      => 'Este campo é obrigatório quando :values estão presentes.',
    'required_without'       => 'Este campo é obrigatório quando :values não estão presentes.',
    'required_without_all'   => 'Este campo é obrigatório quando nenhum dos :values estiver presente.',
    'same'                   => 'O valor desse campo deve corresponder ao valor de :other.',
    'size'                   => [
        'array'   => 'O conteúdo deve conter :items de tamanho.',
        'file'    => 'O tamanho do ficheiro deve ser :size kilobytes.',
        'numeric' => 'Este campo deve ser :size.',
        'string'  => 'A cadeia de texto deve ser :size  de tamanho.',
    ],
    'starts_with'            => 'Este campo deve começar com um dos seguintes valores: :values.',
    'string'                 => 'Este campo deve ser uma cadeia de texto.',
    'timezone'               => 'Esta deve ser uma zona válida.',
    'ulid'                   => 'Este campo deve ser um ULID válido.',
    'unique'                 => 'Isso já foi utilizado.',
    'uploaded'               => 'Falhou ao carregar.',
    'uppercase'              => 'Este campo deve ser em maiúsculas.',
    'url'                    => 'Este formato é inválido.',
    'uuid'                   => 'Este deve ser um UUID válido.',
    'attributes'             => [
        'address'                  => 'morada',
        'affiliate_url'            => 'URL de afiliado',
        'age'                      => 'idade',
        'amount'                   => 'quantidade',
        'announcement'             => 'anúncio',
        'area'                     => 'área',
        'audience_prize'           => 'prêmio do público',
        'audience_winner'          => 'audience winner',
        'available'                => 'disponível',
        'birthday'                 => 'aniversário',
        'body'                     => 'corpo',
        'city'                     => 'cidade',
        'company'                  => 'company',
        'compilation'              => 'compilação',
        'concept'                  => 'conceito',
        'conditions'               => 'condições',
        'content'                  => 'conteúdo',
        'contest'                  => 'contest',
        'country'                  => 'país',
        'cover'                    => 'cobrir',
        'created_at'               => 'criado em',
        'creator'                  => 'criador',
        'currency'                 => 'moeda',
        'current_password'         => 'senha atual',
        'customer'                 => 'cliente',
        'date'                     => 'data',
        'date_of_birth'            => 'data de nascimento',
        'dates'                    => 'datas',
        'day'                      => 'dia',
        'deleted_at'               => 'apagado em',
        'description'              => 'descrição',
        'display_type'             => 'Tipo de exibição',
        'district'                 => 'distrito',
        'duration'                 => 'duração',
        'email'                    => 'e-mail',
        'excerpt'                  => 'excerto',
        'filter'                   => 'filtro',
        'finished_at'              => 'terminou em',
        'first_name'               => 'primeiro nome',
        'gender'                   => 'género',
        'grand_prize'              => 'grande Prêmio',
        'group'                    => 'grupo',
        'hour'                     => 'hora',
        'image'                    => 'imagem',
        'image_desktop'            => 'imagem da área de trabalho',
        'image_main'               => 'imagem principal',
        'image_mobile'             => 'imagem móvel',
        'images'                   => 'imagens',
        'is_audience_winner'       => 'é vencedor de audiência',
        'is_hidden'                => 'está escondido',
        'is_subscribed'            => 'está inscrito',
        'is_visible'               => 'é visível',
        'is_winner'                => 'é vencedor',
        'items'                    => 'Unid',
        'key'                      => 'chave',
        'last_name'                => 'apelido',
        'lesson'                   => 'lição',
        'line_address_1'           => 'primeira linha da morada',
        'line_address_2'           => 'segunda linha da morada',
        'login'                    => 'Conecte-se',
        'message'                  => 'mensagem',
        'middle_name'              => 'nome do meio',
        'minute'                   => 'minuto',
        'mobile'                   => 'telemóvel',
        'month'                    => 'mês',
        'name'                     => 'nome',
        'national_code'            => 'código nacional',
        'number'                   => 'número',
        'password'                 => 'senha',
        'password_confirmation'    => 'confirmação da senha',
        'phone'                    => 'telefone',
        'photo'                    => 'foto',
        'portfolio'                => 'portfólio',
        'postal_code'              => 'código postal',
        'preview'                  => 'visualização',
        'price'                    => 'preço',
        'product_id'               => 'ID do produto',
        'product_uid'              => 'UID do produto',
        'product_uuid'             => 'UUID do produto',
        'promo_code'               => 'Código promocional',
        'province'                 => 'província',
        'quantity'                 => 'quantidade',
        'reason'                   => 'razão',
        'recaptcha_response_field' => 'campo de resposta recaptcha',
        'referee'                  => 'juiz',
        'referees'                 => 'árbitros',
        'reject_reason'            => 'rejeitar a razão',
        'remember'                 => 'lembrar',
        'restored_at'              => 'restaurado em',
        'result_text_under_image'  => 'texto do resultado sob a imagem',
        'role'                     => 'função',
        'rule'                     => 'regra',
        'rules'                    => 'regras',
        'second'                   => 'segundo',
        'sex'                      => 'sexo',
        'shipment'                 => 'envio',
        'short_text'               => 'texto curto',
        'size'                     => 'tamanho',
        'skills'                   => 'habilidades',
        'slug'                     => 'lesma',
        'specialization'           => 'especialização',
        'started_at'               => 'começou às',
        'state'                    => 'estado',
        'status'                   => 'status',
        'street'                   => 'rua',
        'student'                  => 'estudante',
        'subject'                  => 'sujeito',
        'tag'                      => 'marcação',
        'tags'                     => 'Tag',
        'teacher'                  => 'professor',
        'terms'                    => 'termos',
        'test_description'         => 'descrição de teste',
        'test_locale'              => 'idioma de teste',
        'test_name'                => 'nome de teste',
        'text'                     => 'texto',
        'time'                     => 'tempo',
        'title'                    => 'título',
        'type'                     => 'tipo',
        'updated_at'               => 'atualizado em',
        'user'                     => 'do utilizador',
        'username'                 => 'nome de utilizador',
        'value'                    => 'valor',
        'winner'                   => 'winner',
        'work'                     => 'work',
        'year'                     => 'ano',
    ],
];
