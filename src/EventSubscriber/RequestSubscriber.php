<?php

namespace App\EventSubscriber;

use App\Repository\TypeRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Twig\Environment;

class RequestSubscriber implements EventSubscriberInterface
{
    /**
     * @var Environment
     */
    protected $twig;

    /**
     * @var TypeRepository
     */
    protected $typeRepository;

    /**
     * RequestSubscriber constructor.
     *
     * @param Environment $twig
     */
    public function __construct(Environment $twig, TypeRepository $typeRepository)
    {
        $this->twig = $twig;
        $this->typeRepository = $typeRepository;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents(): array
    {
        return [
            RequestEvent::class => 'onKernelRequest',
        ];
    }

    /**
     * @param RequestEvent $event
     */
    public function onKernelRequest(RequestEvent $event)
    {
        $this->twig->addGlobal('menuTypes', $this->typeRepository->findAll());
    }
}