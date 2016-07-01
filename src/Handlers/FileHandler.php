<?php
/**
 * This file is part of {@see arabcoders\profiler} package.
 *
 * (c) 2014-2016 Abdul.Mohsen B. A. A.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace arabcoders\profiler\Handlers;

use \SplFileObject;
use arabcoders\profiler\
{
    Interfaces\HandlerInterface,
    Exceptions\HandlerException
};

/**
 * Handler: File.
 *
 * @author Abdul.Mohsen B. A. A. <admin@arabcoders.org>
 */
class FileHandler implements HandlerInterface
{
    protected $name = null;

    protected $path = null;

    /**
     * FileHandler constructor.
     *
     * @param string $path
     * @param array  $options
     */
    public function __construct( string $path, array $options = [ ] )
    {
        if ( !is_dir( $path ) )
        {
            throw new HandlerException( "Provided Path is not valid directory - {$path}" );
        }

        if ( !is_writable( $path ) )
        {
            throw new HandlerException( "Provided Path is not writable." );
        }

        $this->path = rtrim( $path, '/' );
    }

    /**
     * Save Profiler Data.
     *
     * @param array $data
     * @param array $options
     *
     * @return bool
     * @throws HandlerException if saving failed.
     */
    public function save( array $data, array $options = [ ] ): bool
    {
        try
        {
            ( new SplFileObject( $this->path . DIRECTORY_SEPARATOR . $this->getName(), 'w' ) )
                ->fwrite( json_encode( $data ) );
        }
        catch ( \Exception $e )
        {
            throw new HandlerException( $e->getMessage(), $e->getCode(), $e->getPrevious() );
        }

        return true;
    }

    /**
     * Set File name.
     *
     * @param string $name filename.
     *
     * @return FileHandler
     */
    public function setName( string $name ): FileHandler
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get file name.
     *
     * @return string
     */
    protected function getName(): string
    {
        if ( empty( $this->name ) )
        {
            $this->name = 'prun.' . microtime( true ) . '_' . bin2hex( random_bytes( 16 ) ) . '.json';
        }

        return $this->name;
    }

}