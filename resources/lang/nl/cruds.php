<?php

return [
    'userManagement' => [
        'title'          => 'Vrijwilligers',
        'title_singular' => 'Vrijwilligers',
    ],
    'permission' => [
        'title'          => 'Permissies',
        'title_singular' => 'Permissie',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'title'             => 'Title',
            'title_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'role' => [
        'title'          => 'Rollen',
        'title_singular' => 'Rol',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'title'              => 'Title',
            'title_helper'       => ' ',
            'permissions'        => 'Permissions',
            'permissions_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'user' => [
        'title'          => 'Vrijwilligers',
        'title_singular' => 'Vrijwilliger',
        'fields'         => [
            'id'                             => 'ID',
            'id_helper'                      => ' ',
            'name'                           => 'Achternaam',
            'name_helper'                    => ' ',
            'email'                          => 'E-mail',
            'email_helper'                   => ' ',
            'email_verified_at'              => 'E-mail verificatie op',
            'email_verified_at_helper'       => ' ',
            'password'                       => 'Wachtwoord',
            'password_helper'                => ' ',
            'roles'                          => 'Rollen',
            'roles_helper'                   => ' ',
            'remember_token'                 => 'Remember Token',
            'remember_token_helper'          => ' ',
            'created_at'                     => 'Created at',
            'created_at_helper'              => ' ',
            'updated_at'                     => 'Updated at',
            'updated_at_helper'              => ' ',
            'deleted_at'                     => 'Deleted at',
            'deleted_at_helper'              => ' ',
            'photo'                          => 'Foto',
            'photo_helper'                   => ' ',
            'firstname'                      => 'Voornaam',
            'firstname_helper'               => ' ',
            'emailprivate'                   => 'E-mail privé',
            'emailprivate_helper'            => ' ',
            'rkid'                           => 'RK ID',
            'rkid_helper'                    => ' ',
            'dghid'                          => 'DGH ID',
            'dghid_helper'                   => ' ',
            'phone'                          => 'Telefoon',
            'phone_helper'                   => ' ',
            'pagerid'                        => 'Pager ADCi',
            'pagerid_helper'                 => ' ',
            'two_factor'                     => 'Two-Factor Auth',
            'two_factor_helper'              => ' ',
            'two_factor_code'                => 'Two-factor code',
            'two_factor_code_helper'         => ' ',
            'two_factor_expires_at'          => 'Two-factor expires at',
            'two_factor_expires_at_helper'   => ' ',
            'birthdate'                      => 'Geboortedatum',
            'birthdate_helper'               => ' ',
            'created_by'                     => 'Aangemaakt door',
            'created_by_helper'              => ' ',
            'city'                           => 'Woonplaats',
            'city_helper'                    => ' ',
            'active'                         => 'Actief',
            'active_helper'                  => ' ',
            'competenceregistrations'        => 'Competenties',
            'competenceregistrations_helper' => ' ',
        ],
    ],
    'auditLog' => [
        'title'          => 'Audit Logs',
        'title_singular' => 'Audit Log',
        'fields'         => [
            'id'                  => 'ID',
            'id_helper'           => ' ',
            'description'         => 'Description',
            'description_helper'  => ' ',
            'subject_id'          => 'Subject ID',
            'subject_id_helper'   => ' ',
            'subject_type'        => 'Subject Type',
            'subject_type_helper' => ' ',
            'user_id'             => 'User ID',
            'user_id_helper'      => ' ',
            'properties'          => 'Properties',
            'properties_helper'   => ' ',
            'host'                => 'Host',
            'host_helper'         => ' ',
            'created_at'          => 'Created at',
            'created_at_helper'   => ' ',
            'updated_at'          => 'Updated at',
            'updated_at_helper'   => ' ',
        ],
    ],
    'prev' => [
        'title'          => 'Preventieves',
        'title_singular' => 'Preventiefe',
        'fields'         => [
            'id'                         => 'ID',
            'id_helper'                  => ' ',
            'name'                       => 'Naam',
            'name_helper'                => ' ',
            'date'                       => 'Datum',
            'date_helper'                => ' ',
            'created_at'                 => 'Created at',
            'created_at_helper'          => ' ',
            'updated_at'                 => 'Updated at',
            'updated_at_helper'          => ' ',
            'deleted_at'                 => 'Deleted at',
            'deleted_at_helper'          => ' ',
            'starttime'                  => 'Start',
            'starttime_helper'           => ' ',
            'endtime'                    => 'Einde',
            'endtime_helper'             => ' ',
            'rvtime'                     => 'RV',
            'rvtime_helper'              => ' ',
            'location'                   => 'Locatie',
            'location_helper'            => ' ',
            'created_by'                 => 'Created By',
            'created_by_helper'          => ' ',
            'description'                => 'Omschrijving',
            'description_helper'         => ' ',
            'prevtype'                   => 'Type',
            'prevtype_helper'            => ' ',
            'papyrus'                    => 'In Papyrus',
            'papyrus_helper'             => ' ',
            'prima'                      => 'PRIMA',
            'prima_helper'               => ' ',
            'internalinfo'               => 'Interne Info',
            'internalinfo_helper'        => ' ',
            'prevresponsible'            => 'PHA verantwoordelijke',
            'prevresponsible_helper'     => ' ',
            'amount'                     => 'Gefactureerd bedrag',
            'amount_helper'              => 'Gefactureerd bedrag',
            'cares'                      => 'Aantal verzorgingen',
            'cares_helper'               => 'Aantal verzorgingen',
            'ambulancetransports'        => 'Aantal afvoeren',
            'ambulancetransports_helper' => 'Aantal afvoeren met de ziekenwagen',
            'report'                     => 'Verslag',
            'report_helper'              => 'Verslag voor volgende editie',
            'status'                     => 'Status',
            'status_helper'              => ' ',
        ],
    ],
    'management' => [
        'title'          => 'Beheer',
        'title_singular' => 'Beheer',
    ],
    'note' => [
        'title'          => 'Notities',
        'title_singular' => 'Notity',
        'fields'         => [
            'id'                  => 'ID',
            'id_helper'           => ' ',
            'userid'              => 'Gebruiker',
            'userid_helper'       => 'Gebruiker die de notitie heeft aangemaakt',
            'note'                => 'Notitie',
            'note_helper'         => ' ',
            'relationtype'        => 'Relationtype',
            'relationtype_helper' => ' ',
            'relationid'          => 'Relationid',
            'relationid_helper'   => ' ',
            'created_at'          => 'Created at',
            'created_at_helper'   => ' ',
            'updated_at'          => 'Updated at',
            'updated_at_helper'   => ' ',
            'deleted_at'          => 'Deleted at',
            'deleted_at_helper'   => ' ',
            'visability'          => 'Zichtbaarheid',
            'visability_helper'   => 'Bepaalt wie de notitie kan zien',
        ],
    ],
    'preventiefe' => [
        'title'          => 'Preventieves',
        'title_singular' => 'Preventiefe',
    ],
    'location' => [
        'title'          => 'Locaties',
        'title_singular' => 'Locaty',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'name'               => 'Naam',
            'name_helper'        => ' ',
            'street'             => 'Straat',
            'street_helper'      => ' ',
            'number'             => 'Huisnummer',
            'number_helper'      => ' ',
            'zip'                => 'Postcode',
            'zip_helper'         => ' ',
            'city'               => 'Gemeente',
            'city_helper'        => ' ',
            'description'        => 'Omschrijving',
            'description_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
            'created_by'         => 'Aangemaakt door',
            'created_by_helper'  => ' ',
        ],
    ],
    'competence' => [
        'title'          => 'Competenties',
        'title_singular' => 'Competenty',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'key'               => 'Key',
            'key_helper'        => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'type'              => 'Type',
            'type_helper'       => ' ',
            'color'             => 'Kleur',
            'color_helper'      => ' ',
            'expirable'         => 'Vervalt',
            'expirable_helper'  => ' ',
        ],
    ],
    'competenceregistration' => [
        'title'          => 'Competentie Registraties',
        'title_singular' => 'Competentie Registraty',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'user'              => 'Gebruiker',
            'user_helper'       => ' ',
            'competence'        => 'Competentie',
            'competence_helper' => ' ',
            'startdate'         => 'Start Datum',
            'startdate_helper'  => ' ',
            'enddate'           => 'Einddatum',
            'enddate_helper'    => ' ',
            'regnotes'          => 'Notitie',
            'regnotes_helper'   => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'prevregistration' => [
        'title'          => 'PHA registraties',
        'title_singular' => 'PHA registraty',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'user'              => 'Gebruiker',
            'user_helper'       => ' ',
            'prev'              => 'Prev',
            'prev_helper'       => ' ',
            'regnotes'          => 'Regnotes',
            'regnotes_helper'   => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'resource' => [
        'title'          => 'Materiaal',
        'title_singular' => 'Materiaal',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Naam',
            'name_helper'       => 'Naam van het middel (bv ziekenwagen, hulptas)',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'type'              => 'Type',
            'type_helper'       => 'Type materiaal',
            'idtag'             => 'ID label',
            'idtag_helper'      => 'Uniek label dat op het materiaal hangt (label, nummerplaat,...)',
        ],
    ],
    'task' => [
        'title'          => 'Taken',
        'title_singular' => 'Taken',
        'fields'         => [
            'id'                  => 'ID',
            'id_helper'           => ' ',
            'createduser'         => 'Aangemaakt door',
            'createduser_helper'  => ' ',
            'assigneduser'        => 'Toegewezen aan',
            'assigneduser_helper' => ' ',
            'description'         => 'Description',
            'description_helper'  => ' ',
            'created_at'          => 'Created at',
            'created_at_helper'   => ' ',
            'updated_at'          => 'Updated at',
            'updated_at_helper'   => ' ',
            'deleted_at'          => 'Deleted at',
            'deleted_at_helper'   => ' ',
            'completed'           => 'Uitgevoerd',
            'completed_helper'    => ' ',
            'relationtype'        => 'Relationtype',
            'relationtype_helper' => ' ',
            'relationid'          => 'Relationid',
            'relationid_helper'   => ' ',
        ],
    ],
    'event' => [
        'title'          => 'Evenementen',
        'title_singular' => 'Evenementen',
        'fields'         => [
            'id'                  => 'ID',
            'id_helper'           => ' ',
            'name'                => 'Naam',
            'name_helper'         => ' ',
            'type'                => 'Type',
            'type_helper'         => 'Soort event',
            'description'         => 'Omschrijving',
            'description_helper'  => ' ',
            'internalinfo'        => 'Interne Info',
            'internalinfo_helper' => ' ',
            'date'                => 'Datum',
            'date_helper'         => ' ',
            'starttime'           => 'Start',
            'starttime_helper'    => ' ',
            'endtime'             => 'Einde',
            'endtime_helper'      => ' ',
            'location'            => 'Locatie',
            'location_helper'     => ' ',
            'created_by'          => 'Created By',
            'created_by_helper'   => ' ',
            'created_at'          => 'Created at',
            'created_at_helper'   => ' ',
            'updated_at'          => 'Updated at',
            'updated_at_helper'   => ' ',
            'deleted_at'          => 'Deleted at',
            'deleted_at_helper'   => ' ',
        ],
    ],
    'eventmenu' => [
        'title'          => 'Events',
        'title_singular' => 'Event',
    ],
    'eventregistration' => [
        'title'          => 'Event Registraties',
        'title_singular' => 'Event Registraty',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'user'              => 'Gebruiker',
            'user_helper'       => ' ',
            'event'             => 'Event',
            'event_helper'      => ' ',
            'regnotes'          => 'Regnotes',
            'regnotes_helper'   => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'incident' => [
        'title'          => 'Incidenten',
        'title_singular' => 'Incidenten',
        'fields'         => [
            'id'                  => 'ID',
            'id_helper'           => ' ',
            'name'                => 'Naam',
            'name_helper'         => ' ',
            'type'                => 'Type',
            'type_helper'         => 'Soort event',
            'description'         => 'Omschrijving',
            'description_helper'  => ' ',
            'internalinfo'        => 'Verslag',
            'internalinfo_helper' => ' ',
            'date'                => 'Datum',
            'date_helper'         => ' ',
            'starttime'           => 'Start',
            'starttime_helper'    => ' ',
            'endtime'             => 'Einde',
            'endtime_helper'      => ' ',
            'created_by'          => 'Created By',
            'created_by_helper'   => ' ',
            'resources'           => 'Materiaal',
            'resources_helper'    => ' ',
            'users'               => 'Vrijwilligers',
            'users_helper'        => ' ',
            'created_at'          => 'Created at',
            'created_at_helper'   => ' ',
            'updated_at'          => 'Updated at',
            'updated_at_helper'   => ' ',
            'deleted_at'          => 'Deleted at',
            'deleted_at_helper'   => ' ',
        ],
    ],
    'comlog' => [
        'title'          => 'Communicatie log',
        'title_singular' => 'Communicatie log',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'from'              => 'From',
            'from_helper'       => ' ',
            'to'                => 'To',
            'to_helper'         => ' ',
            'subject'           => 'Subject',
            'subject_helper'    => ' ',
            'message'           => 'Message',
            'message_helper'    => ' ',
            'type'              => 'Type',
            'type_helper'       => ' ',
            'extrainfo'         => 'Extrainfo',
            'extrainfo_helper'  => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'user'              => 'User',
            'user_helper'       => ' ',
        ],
    ],
    'userAlert' => [
        'title'          => 'User Alerts',
        'title_singular' => 'User Alert',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'alert_text'        => 'Alert Text',
            'alert_text_helper' => ' ',
            'alert_link'        => 'Alert Link',
            'alert_link_helper' => ' ',
            'user'              => 'Users',
            'user_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
        ],
    ],
];