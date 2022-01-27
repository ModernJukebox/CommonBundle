<?php

namespace ModernJukebox\Bundle\Common\Enums;

enum StationServerState: string
{
    /*
     * The server station is currently not running.
     */
    case IDLE = 'idle';

    /*
     * The server station is currently serving sound.
     */
    case SERVING = 'serving';

    /*
     * The server station is currently transitioning to a new state
     */
    case TRANSITION = 'transition';

    /*
     * The server station is currently in maintenance mode.
     */
    case MAINTENANCE = 'maintenance';

    /*
     * The server station is currently in an error state.
     */
    case ERROR = 'error';

    /*
     * The server station is currently not available.
     */
    case OFFLINE = 'offline';
}
