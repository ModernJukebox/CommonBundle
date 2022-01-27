<?php

namespace ModernJukebox\Bundle\Common\Enums;

enum StationClientState: string
{
    /*
     * The client station is currently not running.
     */
    case IDLE = 'idle';
    /*
     * The client station is currently listening to sound.
     */
    case LISTENING = 'listening';
    /*
     * The client station is currently transitioning to a new state
     */
    case TRANSITION = 'transition';
    /*
     * The client station is currently in maintenance mode.
     */
    case MAINTENANCE = 'maintenance';
    /*
     * The client station is currently in an error state.
     */
    case ERROR = 'error';
    /*
     * The client station is currently not available.
     */
    case OFFLINE = 'offline';
}
