<?php namespace Bugotech\Events;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;

class EventServiceProvider extends \Illuminate\Events\EventServiceProvider
{
    /**
     * The event handler mappings for the application.
     *
     * @var array
     */
    protected $listen = [];

    /**
     * The subscriber classes to register.
     *
     * @var array
     */
    protected $subscribe = [];

    /**
     * Register the application's event listeners.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        // Carregar configurações
        $this->app->configure('events', __DIR__ . '/../config/events.php');
        $this->app->configure('queue', __DIR__ . '/../config/queue.php');

        // Registrar lista: listens
        foreach ($this->listens() as $event => $listeners) {
            foreach ($listeners as $listener) {
                $events->listen($event, $listener);
            }
        }

        // Registrar lista: subscribes
        foreach ($this->subscribes() as $subscriber) {
            $events->subscribe($subscriber);
        }
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        parent::register();

        // Alias
        $this->app->alias('events', 'Illuminate\Contracts\Events\Dispatcher');
        //'Illuminate\Contracts\Queue\Factory' => 'queue',
        //'Illuminate\Contracts\Queue\Queue' => 'queue.connection',
    }

    /**
     * Get the events and handlers.
     *
     * @return array
     */
    public function listens()
    {
        $listen = config('events.listen', []);
        $listen = array_merge([], $this->listen, $listen);

        return $listen;
    }

    /**
     * Get the subscribes and handlers.
     *
     * @return array
     */
    public function subscribes()
    {
        $subscribe = config('events.subscribes', []);
        $subscribe = array_merge([], $this->subscribe, $subscribe);

        return $subscribe;
    }
}