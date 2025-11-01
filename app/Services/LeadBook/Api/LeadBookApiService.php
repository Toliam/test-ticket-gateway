<?php
declare(strict_types=1);

namespace App\Services\LeadBook\Api;

use App\Http\DTO\ReservePlacesDTO;
use App\Services\LeadBook\DTO\JsonResponseDTO;
use GuzzleHttp\Exception\RequestException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use RuntimeException;
use Symfony\Component\HttpFoundation\Response;

readonly class LeadBookApiService implements LeadBookApiServiceInterface
{
    private const DEFAULT_TIMEOUT = 5;
    private const MAX_REDIRECTS = 3;

    private const RETRY_DELAYS = [100,200,300];

    public function __construct(
        protected string $apiHost,
        protected string $apiKey,
    ) {
    }

    public function fetchShows(): JsonResponseDTO
    {
        $url = "$this->apiHost/shows";

        return $this->fetch($url);
    }

    public function fetchEvents(int $id): JsonResponseDTO
    {
        $url = "$this->apiHost/shows/$id/events";

        return $this->fetch($url);
    }

    public function fetchPlaces(int $eventId): JsonResponseDTO
    {
        $url = "$this->apiHost/events/$eventId/places";

        return $this->fetch($url);
    }

    /**
     * @throws HttpException
     */
    public function storePlaces(ReservePlacesDTO $DTO): JsonResponseDTO
    {
        $url = "$this->apiHost/events/$DTO->eventId/reserve";

        return $this->handleResponse(
            fn() => $this->buildClient()->asMultipart()->post($url, $DTO->toArray())
        );
    }

    /**
     * @param array $headers
     * @return PendingRequest
     */
    protected function buildClient(array $headers = []): PendingRequest
    {
        return Http::replaceHeaders($headers)
            ->acceptJson()
            ->withToken($this->apiKey)
            ->timeout(self::DEFAULT_TIMEOUT)
            ->connectTimeout(self::DEFAULT_TIMEOUT)
            ->maxRedirects(self::MAX_REDIRECTS)
            ->retry(self::RETRY_DELAYS); // 3 times after 100,200,300 milliseconds
    }

    /**
     * Handle HTTP response and extract data or throw exceptions
     *
     * @param callable $httpCall
     * @return JsonResponseDTO
     * @throws HttpException
     * @throws RuntimeException
     */
    private function handleResponse(callable $httpCall): JsonResponseDTO
    {
        try {
            /** @var \Illuminate\Http\Client\Response $response */
            $response = $httpCall();
        } catch (ConnectionException|RequestException $e) {
            throw new HttpException(Response::HTTP_BAD_GATEWAY, 'LeadBook connection failed.');
        }

        if ($response->successful()) {
            return new JsonResponseDTO($response->json('response'));
        }

        $status = $response->status();
        $body = $response->json();

        $message = is_array($body) && array_key_exists('error', $body)
            ? (string) $body['error']
            : ($response->body() ?: 'Unknown error');

        throw new HttpException($status ?: Response::HTTP_BAD_GATEWAY, $message);
    }

    /**
     * Fetch data from LeadBook API with Error Handling
     *
     * @param string $url
     * @return JsonResponseDTO
     * @throws HttpException - known exception, catch in bootstrap/app.php
     */
    private function fetch(string $url): JsonResponseDTO
    {
        return $this->handleResponse(
            fn() => $this->buildClient(['Content-Type' => 'application/json'])->get($url)
        );
    }
}


