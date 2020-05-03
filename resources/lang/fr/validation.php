<?php

return [

    /*
    |--------------------------------------------------------------------------
    | FR - Validation des lignes de language
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'Le :attribute doit être accepté.',
    'active_url' => 'Le :attribute n\est pas un URL valide.',
    'after' => 'Le :attribute doit être une date après :date.',
    'after_or_equal' => 'Le :attribute doit être une date supérieur ou égal à :date.',
    'alpha' => 'Le :attribute ne peut contenir que des lettres.',
    'alpha_dash' => 'Le :attribute ne peut contenir uniquement des lettres, nombres, tirets et sous-tiret.',
    'alpha_num' => 'Le :attribute ne peut contenir que des lettres ou des nombres.',
    'array' => 'Le :attribute doit être une liste.',
    'before' => 'Le :attribute doit être une date avant :date.',
    'before_or_equal' => 'Le :attribute doit être une date avant ou égale à :date.',
    'between' => [
        'numeric' => 'Le :attribute doit être entre :min et :max.',
        'file' => 'Le :attribute doit être entre :min et :max kilobytes.',
        'string' => 'Le :attribute doit être compris entre :min et :max caractères.',
        'array' => 'Le :attribute doit avoir entre :min et :max éléments.',
    ],
    'boolean' => 'Le champ de :attribute doit être vrai ou faux.',
    'confirmed' => 'Le :attribute confirmation ne correspond pas.',
    'date' => 'Le :attribute n\est pas une date valide.',
    'date_equals' => 'Le :attribute doit être une date égal à :date.',
    'date_format' => 'Le :attribute ne correspond pas au format :format.',
    'different' => 'Le :attribute et :other doivent être différents.',
    'digits' => 'Le :attribute doit être :digits digits.',
    'digits_between' => 'Le :attribute doit être entre :min et :max digits.',
    'dimensions' => 'Le :attribute a des dimensions d\image non valides.',
    'distinct' => 'Le :attribute a une valeur dupliquée.',
    'email' => 'Le :attribute doit être une adresse mail valide.',
    'ends_with' => 'Le :attribute doit se terminer par l\un des éléments suivants : :values.',
    'exists' => 'Le :attribute séléctionné est invalide.',
    'file' => 'Le :attribute doit être un fichier.',
    'filled' => 'Le champ de :attribute  doit avoir une valeur.',
    'gt' => [
        'numeric' => 'Le :attribute doit être supérieur à :value.',
        'file' => 'Le :attribute doit être supérieur à :value kilobytes.',
        'string' => 'Le :attribute doit être supérieur à :value caractères.',
        'array' => 'Le :attribute doit avoir plus que :value éléments.',
    ],
    'gte' => [
        'numeric' => 'Le :attribute doit être supérieur ou égal à :value.',
        'file' => 'Le :attribute doit être supérieur ou égal à :value kilobytes.',
        'string' => 'Le :attribute doit être supérieur ou égal à :value characters.',
        'array' => 'Le :attribute doit avoir :value éléments ou plus.',
    ],
    'image' => 'Le :attribute doit être une image.',
    'in' => 'Le :attribute séléctioné est invalide.',
    'in_array' => 'Le champ de :attribute  n\existe pas dans :other.',
    'integer' => 'Le :attribute doit être un entier.',
    'ip' => 'Le :attribute doit être une adresse IP valide.',
    'ipv4' => 'Le :attribute doit être une adresse IPv4 valide.',
    'ipv6' => 'Le :attribute doit être une adresse IPv6 valide.',
    'json' => 'Le :attribute doit être une chaîne de caractères JSON valide.',
    'lt' => [
        'numeric' => 'Le :attribute doit être inférieur à :value.',
        'file' => 'Le :attribute doit avoir moins que :value kilobytes.',
        'string' => 'Le :attribute doit avoir moins que :value caractères.',
        'array' => 'Le :attribute doit avoir moins que :value éléments.',
    ],
    'lte' => [
        'numeric' => 'Le :attribute doit être inférieur ou égal à :value.',
        'file' => 'Le :attribute doit être inférieur ou égal à :value kilobytes.',
        'string' => 'Le :attribute doit être inférieur ou égal à :value caractères.',
        'array' => 'Le :attribute ne doit pas avoir plus de :value éléments.',
    ],
    'max' => [
        'numeric' => 'Le :attribute ne doit pas être supérieur à :max.',
        'file' => 'Le :attribute ne doit pas être supérieur à :max kilobytes.',
        'string' => 'Le :attribute ne doit pas être supérieur à :max caractères.',
        'array' => 'Le :attribute ne doit pas avoir plus de :max éléments.',
    ],
    'mimes' => 'Le :attribute doit être un fichier de type : :values.',
    'mimetypes' => 'Le :attribute doit être un fichier de type : :values.',
    'min' => [
        'numeric' => 'Le :attribute doit être au moins :min.',
        'file' => 'Le :attribute doit être au moins :min kilobytes.',
        'string' => 'Le :attribute doit contenir au moins :min caractères.',
        'array' => 'Le :attribute doit avoir au moins :min éléments.',
    ],
    'not_in' => 'Le :attribute séléctionné est invalide.',
    'not_regex' => 'Le :attribute à un format invalide.',
    'numeric' => 'Le :attribute doit être un nombre.',
    'password' => 'Le mot de passe est incorrect.',
    'present' => 'Le champ de:attribute doit être présent .',
    'regex' => 'Le :attribute à un format invalide.',
    'required' => ':attribute est requis.',
    'required_if' => 'Le champ de :attribute est requis quand :other est :value.',
    'required_unless' => 'Le champ de :attribute requiert au moins :other est dans :values.',
    'required_with' => 'Le champ de :attribute est requis quand :values est présent.',
    'required_with_all' => 'Le champ de :attribute est requis quand :values sont présents.',
    'required_without' => 'Le champ de :attribute est requis quand :values n\est pas présent.',
    'required_without_all' => 'Le champ de :attribute est requis quand il n\y a pas de :values présents.',
    'same' => 'Le :attribute et :other doivent correspondre.',
    'size' => [
        'numeric' => 'Le :attribute doit être :size.',
        'file' => 'Le :attribute doit être :size kilobytes.',
        'string' => 'Le :attribute doit être :size caractères.',
        'array' => 'Le :attribute doit contenir :size éléments.',
    ],
    'starts_with' => 'Le :attribute doit commencer avec un des suivants : :values.',
    'string' => 'Le :attribute doit être une chaîne de caractères de caractères.',
    'timezone' => 'Le :attribute doit être une zone valide.',
    'unique' => 'Le :attribute a déja été pris.',
    'uploaded' => 'Le :attribute à échoué à uploader.',
    'url' => 'Le :attribute à un format invalide.',
    'uuid' => 'Le :attribute doit être un UUID valide.',

    /*
    |--------------------------------------------------------------------------
    | FR - Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | FR - Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
