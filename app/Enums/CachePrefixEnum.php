<?php

namespace App\Enums;

enum CachePrefixEnum: string
{
    case SHOWS_LIST = 'external_shows_list';
    case EVENT_LIST = 'external_events_list_by_show_id_%d';
    case PLACES_LIST = 'external_places_list_by_event_id_%d';


    public static function getEventListPrefix(int $showId): string
    {
        return sprintf(self::EVENT_LIST->value, $showId);
    }

    public static function getPlacesListPrefix(int $eventId): string
    {
        return sprintf(self::PLACES_LIST->value, $eventId);
    }
}
