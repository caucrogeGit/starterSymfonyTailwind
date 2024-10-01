<?php
namespace App\Tests\Functional\Post;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class PostTest extends WebTestCase
{
    /**
     * Teste que la page d'accueil du blog fonctionne correctement.
     */
    public function testPostPageWorks(): void
    {
        $client = static::createClient();
        $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);

        $this->assertSelectorExists('h1');
        $this->assertSelectorTextContains('h1', 'Mon Blog');
    }

    /**
     * Teste que la pagination fonctionne correctement.
     */
    public function testPaginationWorks(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        // Vérifie que la réponse est réussie et que le code de statut est 200
        $this->assertResponseIsSuccessful();
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);

        // Vérifie qu'il y a 9 éléments avec la classe 'div.card' sur la page
        $posts = $crawler->filter('div.card');
        $this->assertEquals(9, count($posts));

        // Sélectionne le lien de la page 2 et fait une requête GET sur ce lien
        $link = $crawler->selectLink('2')->extract(['href'])[0];
        $crawler = $client->request('GET', $link);

        // Vérifie que la réponse est réussie et que le code de statut est 200
        $this->assertResponseIsSuccessful();
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);

        // Vérifie qu'il y a au moins 1 élément avec la classe 'div.card' sur la page 2
        $posts = $crawler->filter('div.card');
        $this->assertGreaterThanOrEqual(1, count($posts));
    }
}