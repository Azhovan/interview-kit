<?php

namespace Project\Controllers;

use BadMethodCallException;
use Illuminate\Container\Container;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Response;
use Illuminate\Translation\FileLoader;
use Illuminate\Translation\Translator;
use Illuminate\Validation\Factory;
use Illuminate\Validation\Validator;

abstract class Controller
{

    /**
     * Execute an action on the controller.
     *
     * @param string $method
     * @param array $parameters
     * @return mixed
     */
    public function callAction($method, $parameters)
    {
        return call_user_func_array([$this, $method], $parameters);
    }

    /**
     * Handle calls to missing methods on the controller.
     *
     * @param string $method
     * @param array $parameters
     * @return mixed
     *
     * @throws BadMethodCallException
     */
    public function __call($method, $parameters)
    {
        throw new BadMethodCallException(sprintf(
            'Method %s::%s does not exist.',
            static::class, $method
        ));
    }

    /**
     * Generate response object
     *
     * @param array $content
     * @param int $code
     * @param array $headers
     * @return Response
     */
    public function response(array $content = [], int $code = 200, array $headers = []): Response
    {
        return Response::create($content, $code, $headers);
    }

    /**
     * Validate data based on the input rules
     *
     * @param array $data
     * @param array $rules
     * @param array $messages
     * @return Validator
     */
    public function validate(array $data, array $rules, array $messages = [])
    {
        $translator = new Translator(
            new FileLoader(new Filesystem, 'lang'), 'en'
        );
        $validation = new Factory($translator, new Container);
        return $validation->make($data, $rules, $messages);
    }
}
