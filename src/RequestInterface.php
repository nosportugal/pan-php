<?php declare(strict_types=1);

namespace PAN;

/**
 * Request interface for sending HTTP requests.
 */
interface RequestInterface
{
    /**
     * Send an HTTP request GET.
     *
     * @param string $path Path to send to request.
     * @param array  $options Request options to apply to the given
     *                        request and to the transfer.
     *
     * @return promise
     */
    public function get(string $path, array $options);

    /**
     * Send an HTTP request POST.
     *
     * @param string $path Path to send to request.
     * @param array  $options Request options to apply to the given
     *                        request and to the transfer.
     *
     * @return promise
     */
    public function post(string $path, array $options);

    /**
     * Send an HTTP request PUT.
     *
     * @param string $path Path to send to request.
     * @param array  $options Request options to apply to the given
     *                        request and to the transfer.
     *
     * @return promise
     */
    public function put(string $path, array $options);

    /**
     * Send an HTTP request DELETE.
     *
     * @param string $path Path to send to request.
     * @param array  $options Request options to apply to the given
     *                        request and to the transfer.
     *
     * @return promise
     */
    public function delete(string $path, array $options);
}
