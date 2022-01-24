<?php

namespace ModernJukebox\Bundle\Common\Enums;

enum StationState: string
{
    /*
     * The station is currently running, but does not have any active jobs.
     */
    case IDLE = 'idle';
    /*
     * The station is currently running, and is acting as a client.
     */
    case CLIENT = 'client';
    /*
     * The station is currently running, and is acting as a server.
     */
    case SERVER = 'server';
    /*
     * The station is currently running, and is currently transitioning between a state.
     *
     * Possible transitions:
     *  - IDLE -> CLIENT
     *  - IDLE -> SERVER
     *  - CLIENT -> SERVER
     *  - CLIENT -> IDLE
     *  - SERVER -> CLIENT
     *  - SERVER -> IDLE
     *
     */
    case TRANSITION = 'transition';
    /*
     * The station is currently in maintenance mode.
     */
    case MAINTENANCE = 'maintenance';
    /*
     * The station is currently not available.
     */
    case OFFLINE = 'offline';
}
