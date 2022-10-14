<?php

namespace App\Controller;

use App\Repository\SymfonyReleaseRepository;
use DateInterval;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Cache\CacheInterface;

class TestCacheController extends AbstractController
{

    private SymfonyReleaseRepository $symfonyReleaseRepository;
    private CacheInterface $redisAdapter;

    public function __construct(SymfonyReleaseRepository $symfonyReleaseRepository, CacheInterface $redisAdapter)
    {
        $this->symfonyReleaseRepository = $symfonyReleaseRepository;
        $this->redisAdapter = $redisAdapter;
    }

    #[Route('/test/cache', name: 'app_test_cache')]
    public function index(): Response
    {
        $response = $this->render('test_cache/index.html.twig', [
            'controller_name' => 'TestCacheController',
        ]);

        $response->setPublic();
        return $response;
    }

    #[Route('/test/cache/esi/releases', name: 'app_test_cache_esi')]
    public function symfonyReleaseList(): Response
    {
        return $this->render('test_cache/release.html.twig', [
            'symfony_releases' => $this->symfonyReleaseRepository->findAll()
        ]);
    }

    #[Route('/test/cache/redis', name: 'app_test_cache_redis')]
    public function triggerRedis(): Response
    {
        $cacheKey = 'thisIsACacheKey';
        $item = $this->redisAdapter->getItem($cacheKey);

        $itemCameFromCache = true;
        if (!$item->isHit()) {
            $itemCameFromCache = false;
            $item->set('this is some data to cache');
            $item->expiresAfter(new DateInterval('PT60S')); // the item will be cached for 10 seconds
            $this->redisAdapter->save($item);
        }

        return $this->render('test_cache/trigger_redis.html.twig', [
            'isCached' => $itemCameFromCache ? 'true' : 'false'
        ]);
    }
}
