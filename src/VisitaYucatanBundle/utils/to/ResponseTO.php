<?php
/**
 * User: ricardo
 * Date: 4/01/16
 */

namespace VisitaYucatanBundle\utils\to;


class ResponseTO{
    private $status;
    private $typeStatus;
    private $message;
    private $code;

    /**
     * ResponseTO constructor.
     */
    public function __construct($estatus, $message, $typeStatus, $code) {
        $this->status = $estatus;
        $this->message = $message;
        $this->typeStatus = $typeStatus;
        $this->code = $code;
    }


    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * @return mixed
     */
    public function getTypeStatus()
    {
        return $this->typeStatus;
    }

    /**
     * @param mixed $typeStatus
     */
    public function setTypeStatus($typeStatus)
    {
        $this->typeStatus = $typeStatus;
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param mixed $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }


}